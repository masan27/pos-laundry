<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function index()
    {
        $page = "barang/";
        $query = $this->db->get('barang')->result();
        $data = array(
            'title' => 'Barang',
            'body' => $page . 'index',
            'style' =>  $page . 'style',
            'data' => $query
        );
        $this->load->view('layout/app', $data);
    }

    public function call($kode)
    {
        $data = $this->db->where('kode_barang', $kode)->get('barang')->row();

        echo json_encode($data);
    }

    public function tambah()
    {
        $kategori = $this->db->get('kategori_barang')->result();
        $page = "barang/";

        $i = $this->input->post();
        $valid = $this->form_validation;
        $valid->set_rules('nama_barang', 'Nama Barang', 'required');
        $valid->set_rules('harga_laundry_barang', 'Harga Laundry Barang', 'required');
        $valid->set_rules('harga_dry_barang', 'Harga Dry Clean Barang', 'required');
        $valid->set_rules('id_kategori_barang', 'Kategori Barang', 'required');

        $data = array(
            'title' => 'Barang',
            'body' => $page . 'tambah',
            'script' => $page . 'script',
            'style' =>  $page . 'style',
            'kategori' => $kategori,
        );

        if ($valid->run()) {
            $kode = 'B' . mt_rand(1000, 9999);

            $input = array(
                'kode_barang' => $kode,
                'nama_barang' => $i['nama_barang'],
                'harga_laundry_barang' => str_replace(',', '', $i['harga_laundry_barang']),
                'harga_dry_barang' => str_replace(',', '', $i['harga_dry_barang']),
                'id_kategori_barang' => $i['id_kategori_barang'],
            );

            if (!empty($_FILES['gambar_barang']['name'])) {
                $config['upload_path']          = './asset/img/barang/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000;
                $config['file_name']            = $kode;
                $config['overwrite']            = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar_barang')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    return $this->load->view('layout/app', $data);
                } else {
                    $image = $this->upload->data();
                    $input += array('gambar_barang' => $image['file_name']);
                }
            } else {
                $input += array('gambar_barang' => 'box.png');
            }
            $this->db->insert('barang', $input);
            $this->session->set_flashdata('success', 'Barang berhasil ditambahkan');
            return redirect(base_url('barang'));
        }
        $this->load->view('layout/app', $data);
    }

    public function edit($id)
    {
        $kategori = $this->db->get('kategori_barang')->result();
        $query = $this->db->where('id_barang', $id)->get('barang')->row();
        $page = "barang/";

        $i = $this->input->post();
        $valid = $this->form_validation;
        $valid->set_rules('nama_barang', 'Nama Barang', 'required');
        $valid->set_rules('harga_laundry_barang', 'Harga Laundry Barang', 'required');
        $valid->set_rules('harga_dry_barang', 'Harga Dry Clean Barang', 'required');
        $valid->set_rules('id_kategori_barang', 'Kategori Barang', 'required');

        $data = array(
            'title' => 'Barang',
            'body' => $page . 'edit',
            'script' => $page . 'script',
            'style' =>  $page . 'style',
            'kategori' => $kategori,
            'data'  => $query
        );

        if ($valid->run()) {

            $input = array(
                'nama_barang' => $i['nama_barang'],
                'harga_laundry_barang' => str_replace(',', '', $i['harga_laundry_barang']),
                'harga_dry_barang' => str_replace(',', '', $i['harga_dry_barang']),
                'id_kategori_barang' => $i['id_kategori_barang'],
            );

            if (!empty($_FILES['gambar_barang']['name'])) {
                $path = base_url('asset/img/barang/' . $query->gambar_barang);
                if ($path) {
                    unlink($path);
                }
                $config['upload_path']          = './asset/img/barang/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000;
                $config['file_name']            = $query->kode_barang;
                $config['overwrite']            = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar_barang')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    return $this->load->view('layout/app', $data);
                } else {
                    $image = $this->upload->data();
                    $input += array('gambar_barang' => $image['file_name']);
                }
            }
            $this->db->where('id_barang', $id)->update('barang', $input);
            $this->session->set_flashdata('success', 'Barang berhasil diperbaharui');
            return redirect(base_url('barang'));
        }
        $this->load->view('layout/app', $data);
    }

    public function detail($id)
    {
        $query = $this->db->where('id_barang', $id)->get('barang')->row();
        $kategori = $this->db->where('id_kategori_barang', $query->id_kategori_barang)->get('kategori_barang')->row();
        $page = "barang/";

        $data = array(
            'title' => 'Barang',
            'body' => $page . 'detail',
            'style' =>  $page . 'style',
            'kategori' => $kategori,
            'data'  => $query
        );

        $this->load->view('layout/app', $data);
    }

    public function hapus($id)
    {
        if (!$id) {
            $this->session->set_flashdata('error', 'URL tidak valid');
            return redirect(base_url('barang'));
        }
        $this->db->where('id_barang', $id)->delete('barang');
        $query = $this->db->where('id_barang', $id)->get('barang')->row();
        $path = base_url('asset/img/barang/' . $query->gambar_barang);
        if ($path) {
            unlink($path);
        }
        $this->session->set_flashdata('success', 'Barang berhasil dihapus');
        return redirect(base_url('barang'));
    }
}
