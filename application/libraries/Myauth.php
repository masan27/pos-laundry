<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Myauth
{
    function __construct()
    {
        $this->CI = &get_instance();
        if (!$this->CI->session->id_user) {              
            if ($this->CI->uri->segment(1) != 'login' ) {                
                redirect(base_url('login'));
            }
        }
    }
}
