<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function index($id = false)
    {
        $page = "penjualan/";
        $temp = $this->db->join('barang', 'temp.id_barang = barang.id_barang')
            ->where('id_user', $this->session->id_user)->get('temp')->result();
        $barang = $this->db->get('barang')->result();
        $penjualan = $this->db->get('penjualan')->result();
        $pesanan = $this->db->where('proses_pesanan', null)
            ->where('void_pesanan', null)->get('pesanan')->result();

        $data = array(
            'title' => 'Penjualan',
            'body' => $page . 'index',
            'style' =>  $page . 'style',
            'script' =>  $page . 'script',
            'modal' =>  $page . 'modal',
            'temp' => $temp,
            'barang' => $barang,
            'data' => $penjualan,
            'pesanan' => $pesanan,
        );
        if ($id) {
            $data += array(
                'id' => $id
            );
        }
        $this->load->view('layout/app', $data);
    }

    public function pesanan($id)
    {
        $detail = $this->db->join('barang', 'pesanan_detail.id_barang = barang.id_barang')->where('id_pesanan', $id)->get('pesanan_detail')->result();
        foreach ($detail as $list) {
            $input[] = array(
                'id_barang'             => $list->id_barang,
                'banyak_barang_temp'    => $list->jumlah_barang_pesanan,
                'kategori_temp'         => $list->kategori_pesanan,
                'harga_barang_temp'     => $list->harga_barang_pesanan,
                'id_user'               => $this->session->id_user
            );
        }
        $this->db->trans_start();
        $this->db->where('id_user', $this->session->id_user)->delete('temp');
        $this->db->insert_batch('temp', $input);
        $this->db->trans_complete();
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data pesanan berhasil diterapkan');
            // $this->session->set_flashdata('cetak', $lastid);
        } else {
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('success', 'Terjadi kesalahan system');
            }
            $this->session->set_flashdata('success', 'Data pesanan berhasil diterapkan');
            // $this->session->set_flashdata('cetak', $lastid);
        }
        // return redirect(base_url('penjualan'));
        return $this->index($id);
    }

    public function tambah()
    {
        $i = $this->input->post();        
        $temp = $this->db->get('temp')->result();
        $last = $this->db->limit(1)->get('penjualan')->row();
        $kode = 1;
        if ($last) {
            $kode = substr($last->kode_pesanan, -2) + 1;
        }
        $kode = str_pad($kode, 2, '0', STR_PAD_LEFT);
        $kode = 'PJ' . date('ym') . $kode;
        $data = array(
            'kode_penjualan'      => $kode,
            'tanggal_penjualan'   => date('Y-m-d'),
            'jumlah_penjualan'    => $i['jum'],
            'id_user'           => $this->session->id_user
        );
        $this->db->trans_start();
        $this->db->insert('penjualan', $data);
        $lastid = $this->db->insert_id();
        foreach ($temp as $list) {
            $detail[] = array(
                'id_penjualan'            => $lastid,
                'id_barang'             => $list->id_barang,
                'jumlah_barang_penjualan' => $list->banyak_barang_temp,
                'harga_barang_penjualan'  => $list->harga_barang_temp,
                'kategori_penjualan'      => $list->kategori_temp
            );
        }
        $this->db->insert_batch('penjualan_detail', $detail);
        $this->db->where('id_user', $this->session->id_user)->delete('temp');
        if(isset($i['id'])){
            $this->db->where('id_pesanan', $i['id'])->update('pesanan', ['proses_pesanan' => 'Y']);
        }
        $this->db->trans_complete();
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Penjualan berhasil dibuat');
            // $this->session->set_flashdata('cetak', $lastid);
        } else {
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('success', 'Terjadi kesalahan system');
            }
            $this->session->set_flashdata('success', 'Penjualan berhasil dibuat');
            // $this->session->set_flashdata('cetak', $lastid);
        }
        return redirect(base_url('penjualan'));
    }

    public function detail($id)
    {
        $page = "penjualan/";
        $penjualan = $this->db->where('id_penjualan', $id)->get('penjualan')->row();
        $detail = $this->db->join('barang', 'penjualan_detail.id_barang = barang.id_barang')->where('id_penjualan', $id)->get('penjualan_detail')->result();
        $data = array(
            'title' => 'Penjualan',
            'body' => $page . 'detail',
            'data' => $penjualan,
            'detail' => $detail
        );

        $this->load->view('layout/app', $data);
    }

    // public function cetak($id)
    // {
    //     $this->load->library('Pdf');


    //     $penjualan = $this->db->where('id_penjualan', $id)->get('penjualan')->row();
    //     $detail = $this->db->join('barang', 'penjualan_detail.id_barang = barang.id_barang')->where('id_penjualan', $id)->get('penjualan_detail')->result();

    //     $file = 'Penjualan-' . $penjualan->kode_penjualan . '.pdf';

    //     $data = array(
    //         'title' => 'Cetak Penjualan',
    //         'file'    => $file,
    //         'data' => $penjualan,
    //         'detail' => $detail
    //     );


    //     $this->pdf->setPaper('A4', 'potrait');
    //     $this->pdf->set_option('isRemoteEnabled', true);
    //     $this->pdf->filename = $file . '.pdf';
    //     $this->pdf->load_view('penjualan/cetak', $data);
    // }    
}
