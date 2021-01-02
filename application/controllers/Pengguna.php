<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    public function index()
    {
        $page = "pengguna/";
        $query = $this->db->get('user')->result();
        $data = array(
            'title' => 'Pengguna',
            'body' => $page . 'index',
            'style' =>  $page . 'style',
            'data' => $query
        );
        $this->load->view('layout/app', $data);
    }

    public function tambah()
    {
        $page = "pengguna/";

        $i = $this->input->post();
        $valid = $this->form_validation;
        $valid->set_rules('username', 'Username', 'required|is_unique[user.username]');
        $valid->set_rules('nama_user', 'Nama Pengguna', 'required');
        $valid->set_rules('password', 'Password', 'required');
        $valid->set_rules('role', 'Jabatan', 'required');

        $data = array(
            'title' => 'Pengguna',
            'body' => $page . 'tambah',
        );

        if ($valid->run()) {

            $input = array(
                'username' => $i['username'],
                'nama_user' => $i['nama_user'],
                'password' => sha1('pos-sian ' . $i['password']),
                'role' => $i['role'],
            );

            $this->db->insert('user', $input);
            $this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan');
            return redirect(base_url('pengguna'));
        }
        $this->load->view('layout/app', $data);
    }

    public function edit($id)
    {
        $page = "pengguna/";

        $old = $this->db->where('id_user', $id)->get('user')->row();

        $i = $this->input->post();
        $valid = $this->form_validation;
        $valid->set_rules('username', 'Username', 'required');
        $valid->set_rules('nama_user', 'Nama Pengguna', 'required');
        $valid->set_rules('role', 'Jabatan', 'required');

        if ($old->username != $i['username']) {
            $valid->set_rules('username', 'Username', 'is_unique[user.username]');
        }

        $data = array(
            'title' => 'Pengguna',
            'body' => $page . 'edit',
            'data' => $old
        );

        if ($valid->run()) {

            $input = array(
                'username' => $i['username'],
                'nama_user' => $i['nama_user'],
                'role' => $i['role'],
            );

            if ($i['password']) {
                $input += array(
                    'password' => sha1('pos-sian ' . $i['password']),
                );
            }

            $this->db->where('id_user', $id)->update('user', $input);
            $this->session->set_flashdata('success', 'Pengguna berhasil diperbaharui');
            return redirect(base_url('pengguna'));
        }
        $this->load->view('layout/app', $data);
    }

    public function profil($id = false)
    {
        $page = "pengguna/";

        $old = $this->db->where('id_user', $this->session->id_user)->get('user')->row();

        $i = $this->input->post();
        $valid = $this->form_validation;
        $valid->set_rules('username', 'Username', 'required');
        $valid->set_rules('nama_user', 'Nama Pengguna', 'required');
        $valid->set_rules('role', 'Jabatan', 'required');

        if ($i) {
            if ($old->username != $i['username']) {
                $valid->set_rules('username', 'Username', 'is_unique[user.username]');
            }
        }

        $data = array(
            'title' => 'Profile',
            'body' => $page . 'profil',
            'data' => $old
        );

        if ($valid->run()) {

            $input = array(
                'username' => $i['username'],
                'nama_user' => $i['nama_user'],
                'role' => $i['role'],
            );

            if ($i['password']) {
                $input += array(
                    'password' => sha1('pos-sian ' . $i['password']),
                );
            }

            $this->db->where('id_user', $id)->update('user', $input);

            $data_session = array(
                'nama_user' => $i['nama_user'],
                'role' => $i['role'],
            );

            $this->session->set_userdata($data_session);
            $this->session->set_flashdata('success', 'Profile berhasil diperbaharui');
            return redirect(base_url('pengguna/profil'));
        }
        $this->load->view('layout/app', $data);
    }

    public function hapus($id)
    {
        if (!$id) {
            $this->session->set_flashdata('error', 'URL tidak valid');
            return redirect(base_url('pengguna'));
        }
        $this->db->where('id_user', $id)->delete('user');
        $this->session->set_flashdata('success', 'Pengguna berhasil dihapus');
        return redirect(base_url('pengguna'));
    }
}
