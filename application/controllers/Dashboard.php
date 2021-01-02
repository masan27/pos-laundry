<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        $page = "dashboard/";

        $pesanan = $this->db->where('proses_pesanan', null)->where('void_pesanan', null)
            ->like('tanggal_pesanan', date('Y-m'), 'after')
            ->select('COALESCE(SUM(jumlah_pesanan),0) as jumlah')->get('pesanan')->row()->jumlah;

        $penjualan = $this->db->like('tanggal_penjualan', date('Y-m'), 'after')
            ->select('COALESCE(SUM(jumlah_penjualan),0) as jumlah')->get('penjualan')->row()->jumlah;

        $pending = $this->db->where('proses_pesanan', null)->where('void_pesanan', null)
            ->select('COUNT(id_pesanan) as jumlah')->get('pesanan')->row()->jumlah;

        $data = array(
            'title' => 'Dashboard',
            'body' => $page . 'index',
            'script' => $page . 'script',
            'pesanan' => $pesanan,
            'penjualan' => $penjualan,
            'pending' => $pending,
        );
        $this->load->view('layout/app', $data);
    }

    public function summary()
    {
        $now = date('Y-01');
        $data = array();
        for ($i = 0; $i < 12; $i++) {
            $penjualan = $this->db->like('tanggal_penjualan', $now, 'after')
                ->select('COALESCE(SUM(jumlah_penjualan),0) as jumlah')->get('penjualan')->row()->jumlah;
            $data += array(
                'n' . $i => $penjualan
            );
            $now = date('Y-m', strtotime($now . '+1 month'));
        }
        echo json_encode($data);
    }
}
