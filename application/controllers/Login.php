<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        if (get_cookie('username') && get_cookie('password')) {
            $this->db->where('username', get_cookie('username'))
                ->where('password', get_cookie('password'))
                ->limit(1);
            $query = $this->db->get('user');
            $out = $query->row();

            if ($out) {

                $data_session = array(
                    'id_user' => $out->id_user,
                    'nama_user' => $out->nama_user,
                    'role' => $out->role,
                );

                $this->session->set_userdata($data_session);
                redirect(base_url('dashboard'));
            }

            echo $this->session->nama_user;
        }

        if ($this->session->id_user) {
            redirect(base_url('dashboard'));
        }

        $data = array(
            'title' => 'Login',
        );
        $this->load->view('auth/login', $data);
    }

    public function proses()
    {
        $input = $this->input->post();

        $this->db->where('username', $input['username'])
            ->where('password', sha1('pos-sian ' . $input['password']))
            ->limit(1);
        $query = $this->db->get('user');
        $out = $query->row();

        if ($out) {

            $data_session = array(
                'id_user' => $out->id_user,
                'nama_user' => $out->nama_user,
                'role' => $out->role,
            );

            if (isset($input['remember'])) {
                set_cookie('username', $out->username, time() + (86400 * 30 * 6));
                set_cookie('password', $out->password, time() + (86400 * 30 * 6));
            }

            $this->session->set_userdata($data_session);
            redirect(base_url('dashboard'));
        }

        $this->session->set_flashdata('message', 'Username atau Password Salah!');
        redirect(base_url('login'));
    }

    public function logout()
    {
        $this->session->sess_destroy();
        delete_cookie('username');
        delete_cookie('password');
        redirect(base_url('login'));
    }
}
