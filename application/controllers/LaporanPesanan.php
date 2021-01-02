<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanPesanan extends CI_Controller
{
    public function index()
    {
        $awal = date('Y-m-d');
        $akhir = date('Y-m-d');
        $jenis = '';
        if (isset($_REQUEST['awal']) && isset($_REQUEST['akhir']) && isset($_REQUEST['jenis'])) {
            $awal = $_REQUEST['awal'];
            $akhir = $_REQUEST['akhir'];
            $jenis = $_REQUEST['jenis'];
        }

        $page = "laporan/pesanan/";
        $this->db->where('tanggal_pesanan <=', $akhir)
            ->where('tanggal_pesanan >=', $awal);
        if ($jenis) {
            if ($jenis == 'V') {
                $this->db->where('void_pesanan', 'Y');
            } else if ($jenis == 'L') {
                $this->db->where('proses_pesanan', 'Y');
            } else if ($jenis == 'B') {
                $this->db->where('void_pesanan', null)
                    ->where('proses_pesanan', null);
            }
        }
        $query = $this->db->get('pesanan')
            ->result();
        $data = array(
            'title' => 'Laporan Pesanan',
            'body' => $page . 'index',
            'script' =>  $page . 'script',
            'data' => $query,
            'awal' => $awal,
            'akhir' => $akhir,
            'jenis' => $jenis,
        );
        $this->load->view('layout/app', $data);
    }

    public function detail($id)
    {
        $page = "laporan/pesanan/";
        $pesanan = $this->db->where('id_pesanan', $id)->get('pesanan')->row();
        $detail = $this->db->join('barang', 'pesanan_detail.id_barang = barang.id_barang')->where('id_pesanan', $id)->get('pesanan_detail')->result();
        $data = array(
            'title' => 'Pesanan Detail',
            'body' => $page . 'detail',
            'data' => $pesanan,
            'detail' => $detail
        );

        $this->load->view('layout/app', $data);
    }

    public function cetak()
    {
        $awal = date('Y-m-d');
        $akhir = date('Y-m-d');
        $jenis = '';
        if (isset($_REQUEST['awal']) && isset($_REQUEST['akhir']) && isset($_REQUEST['jenis'])) {
            $awal = $_REQUEST['awal'];
            $akhir = $_REQUEST['akhir'];
            $jenis = $_REQUEST['jenis'];
        }
        $this->load->library('Pdf');

        $this->db->where('tanggal_pesanan <=', $akhir)
            ->where('tanggal_pesanan >=', $awal);
        if ($jenis) {
            if ($jenis == 'V') {
                $this->db->where('void_pesanan', 'Y');
            } else if ($jenis == 'L') {
                $this->db->where('proses_pesanan', 'Y');
            } else if ($jenis == 'B') {
                $this->db->where('void_pesanan', null)
                    ->where('proses_pesanan', null);
            }
        }
        $pesanan = $this->db->get('pesanan')
            ->result();

        $file = 'Laporan pesanan per ' . $awal . '-' . $akhir . '.pdf';

        $awal = date('d-m-Y', strtotime($awal));
        $akhir = date('d-m-Y', strtotime($akhir));

        if ($jenis == 'V') {
            $jenis = 'Void';
        } else if ($jenis == 'L') {
            $jenis = 'Sudah Bayar';
        } else if ($jenis == 'B') {
            $jenis = 'Belum Bayar';
        }

        $data = array(
            'title' => 'Cetak Laporan pesanan',
            'file'    => $file,
            'data' => $pesanan,
            'awal' => $awal,
            'akhir' => $akhir,
            'jenis' => $jenis
        );


        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = $file . '.pdf';
        $this->pdf->load_view('laporan/pesanan/cetak', $data);
    }
}
