<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanPenjualan extends CI_Controller
{
    public function index()
    {
        $awal = date('Y-m-d');
        $akhir = date('Y-m-d');
        if (isset($_REQUEST['awal']) && isset($_REQUEST['akhir'])) {
            $awal = $_REQUEST['awal'];
            $akhir = $_REQUEST['akhir'];            
        }
        
        $page = "laporan/penjualan/";
        $query = $this->db
            ->where('tanggal_penjualan <=', $akhir)
            ->where('tanggal_penjualan >=', $awal)
            ->get('penjualan')
            ->result();
        $data = array(
            'title' => 'Laporan Penjualan',
            'body' => $page . 'index',
            'script' =>  $page . 'script',
            'data' => $query,
            'awal' => $awal,
            'akhir' => $akhir,
        );
        $this->load->view('layout/app', $data);
    }

    public function detail($id)
    {
        $page = "laporan/penjualan/";
        $penjualan = $this->db->where('id_penjualan', $id)->get('penjualan')->row();
        $detail = $this->db->join('barang', 'penjualan_detail.id_barang = barang.id_barang')->where('id_penjualan', $id)->get('penjualan_detail')->result();
        $data = array(
            'title' => 'Penjualan Detail',
            'body' => $page . 'detail',
            'data' => $penjualan,
            'detail' => $detail
        );

        $this->load->view('layout/app', $data);
    }

    public function cetak()
    {
        $awal = date('Y-m-d');
        $akhir = date('Y-m-d');
        if (isset($_REQUEST['awal']) && isset($_REQUEST['akhir'])) {
            $awal = $_REQUEST['awal'];
            $akhir = $_REQUEST['akhir'];
        }

        $this->load->library('Pdf');

        $penjualan = $this->db
            ->where('tanggal_penjualan <=', $akhir)
            ->where('tanggal_penjualan >=', $awal)
            ->get('penjualan')
            ->result();

        $file = 'Laporan Penjualan per ' . $awal . '-' . $akhir . '.pdf';

        $awal = date('d-m-Y', strtotime($awal));
        $akhir = date('d-m-Y', strtotime($akhir));

        $data = array(
            'title' => 'Cetak Laporan Penjualan',
            'file'    => $file,
            'data' => $penjualan,
            'awal' => $awal,
            'akhir' => $akhir,
        );


        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = $file . '.pdf';
        $this->pdf->load_view('laporan/penjualan/cetak', $data);
    }
}
