<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ztemplate extends CI_Controller
{
    public function index()
    {
        $page = "template/";
        // hapus style dan script jika tidak ada
        $data = array(
            'title' => 'This is just a templating',
            'style' => $page . 'style',
            'body' => $page . 'index',
            'script' => $page . 'script',
            'modal' => $page.'modal'
        );
        $this->load->view('layout/app', $data);
    }
}
