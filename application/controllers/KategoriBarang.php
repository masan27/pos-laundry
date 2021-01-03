<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriBarang extends CI_Controller
{
    public function index()
    {
        $page = "kategori barang/";
        $query = $this->db->get('kategori_barang')->result();
        $data = array(
            'title' => 'Kategori Barang',
            'body' => $page . 'index',
            'script' => $page . 'script',
            'data' => $query
        );
        $this->load->view('layout/app', $data);
    }

    public function tambah()
    {
        $page = "kategori barang/";

        $i = $this->input->post();
        $valid = $this->form_validation;
        $valid->set_rules('nama_kategori_barang', 'Nama Kategori Barang', 'required');

        $data = array(
            'title' => 'Barang',
            'body' => $page . 'tambah',
        );

        if ($valid->run()) {

            $input = array(
                'nama_kategori_barang' => $i['nama_kategori_barang'],                
            );
            
            $this->db->insert('kategori_barang', $input);
            $this->session->set_flashdata('success', 'Kategori Barang berhasil ditambahkan');
            return redirect(base_url('kategoribarang'));
        }
        $this->load->view('layout/app', $data);
    }

    public function edit($id)
    {
        $page = "kategori barang/";

        $query = $this->db->where('id_kategori_barang', $id)->get('kategori_barang')->row();

        $i = $this->input->post();
        $valid = $this->form_validation;
        $valid->set_rules('nama_kategori_barang', 'Nama Kategori Barang', 'required');

        $data = array(
            'title' => 'Barang',
            'body' => $page . 'edit',
            'data' => $query,
        );

        if ($valid->run()) {

            $input = array(
                'nama_kategori_barang' => $i['nama_kategori_barang'],                
            );
            
            $this->db->where('id_kategori_barang', $id)->update('kategori_barang', $input);
            $this->session->set_flashdata('success', 'Kategori Barang berhasil diperbaharui');
            return redirect(base_url('kategoribarang'));
        }
        $this->load->view('layout/app', $data);
    }

    public function hapus($id)
    {
        if (!$id) {
            $this->session->set_flashdata('error', 'URL tidak valid');
            return redirect(base_url('kategoribarang'));
        }
        $this->db->where('id_kategori_barang', $id)->delete('kategori_barang');
        $this->session->set_flashdata('success', 'Kategori Barang berhasil dihapus');
        return redirect(base_url('kategoribarang'));
    }
}
