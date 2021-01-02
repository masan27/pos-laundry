<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
{
    public function index()
    {
        $page = "pesanan/";
        $temp = $this->db->join('barang', 'temp.id_barang = barang.id_barang')
            ->where('id_user', $this->session->id_user)->get('temp')->result();
        $barang = $this->db->get('barang')->result();
        $pesanan = $this->db->where('proses_pesanan', null)
            ->where('void_pesanan', null)->get('pesanan')->result();
        $data = array(
            'title' => 'Pesanan',
            'body' => $page . 'index',
            'style' =>  $page . 'style',
            'script' =>  $page . 'script',
            'modal' =>  $page . 'modal',
            'temp' => $temp,
            'barang' => $barang,
            'data' => $pesanan
        );
        $this->load->view('layout/app', $data);
    }

    public function tambah()
    {
        $i = $this->input->post();
        $temp = $this->db->get('temp')->result();
        $last = $this->db->limit(1)->get('pesanan')->row();
        $kode = 1;
        if ($last) {
            $kode = substr($last->kode_pesanan, -2) + 1;
        }
        $kode = str_pad($kode, 2, '0', STR_PAD_LEFT);
        $kode = 'PO' . date('ym') . $kode;
        $data = array(
            'kode_pesanan'      => $kode,
            'tanggal_pesanan'   => date('Y-m-d'),
            'jumlah_pesanan'    => $i['jum'],
            'id_user'           => $this->session->id_user
        );
        $this->db->trans_start();
        $this->db->insert('pesanan', $data);
        $lastid = $this->db->insert_id();
        foreach ($temp as $list) {
            $detail[] = array(
                'id_pesanan'            => $lastid,
                'id_barang'             => $list->id_barang,
                'jumlah_barang_pesanan' => $list->banyak_barang_temp,
                'harga_barang_pesanan'  => $list->harga_barang_temp,
                'kategori_pesanan'      => $list->kategori_temp
            );
        }
        $this->db->insert_batch('pesanan_detail', $detail);
        $this->db->where('id_user', $this->session->id_user)->delete('temp');
        $this->db->trans_complete();
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Pesanan berhasil dibuat');
            $this->session->set_flashdata('cetak', $lastid);
        } else {
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('success', 'Terjadi kesalahan system');
            }
            $this->session->set_flashdata('success', 'Pesanan berhasil dibuat');
            $this->session->set_flashdata('cetak', $lastid);
        }
        return redirect(base_url('pesanan'));
    }

    public function detail($id)
    {
        $page = "pesanan/";
        $pesanan = $this->db->where('id_pesanan', $id)->get('pesanan')->row();
        $detail = $this->db->join('barang', 'pesanan_detail.id_barang = barang.id_barang')->where('id_pesanan', $id)->get('pesanan_detail')->result();
        $data = array(
            'title' => 'Pesanan',
            'body' => $page . 'detail',
            'data' => $pesanan,
            'detail' => $detail
        );

        $this->load->view('layout/app', $data);
    }

    public function cetak($id)
    {
        $this->load->library('Pdf');


        $pesanan = $this->db->where('id_pesanan', $id)->get('pesanan')->row();
        $detail = $this->db->join('barang', 'pesanan_detail.id_barang = barang.id_barang')->where('id_pesanan', $id)->get('pesanan_detail')->result();

        $file = 'Pesanan-' . $pesanan->kode_pesanan . '.pdf';

        $data = array(
            'title' => 'Cetak Pesanan',
            'file'    => $file,
            'data' => $pesanan,
            'detail' => $detail
        );


        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = $file . '.pdf';
        $this->pdf->load_view('pesanan/cetak', $data);
        // $this->load->view('pesanan/cetak', $data);
    }

    public function void($id)
    {
        $i = $this->input->post();
        $alasan = $i['alasan'];
        $data = array(
            'void_pesanan'          => 'Y',
            'alasan_void_pesanan'   => $alasan
        );
        $this->db->where('id_pesanan', $id)->update('pesanan', $data);

        $this->session->set_flashdata('success', 'Pesanan berhasil dibatalkan');
        return redirect(base_url('pesanan'));
    }
}
