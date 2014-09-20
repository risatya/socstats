<?php

if (!defined('BASEPATH'))
    exit('No Direct Access Allowed !');

class login extends CI_Controller {
    
    public function index() {
        $this->load->model('m_login');
        $cek = $this->session->userdata('logged_in');
        if (empty($cek)) {
            $this->load->view('welcome_message');
            $p = $this->input->post('password');
            $this->m_login->getLogin($p);
        } else {
          header('location:' . site_url('administrator'));
        }
    }
    
    public function logout(){
        $this->session->sess_destroy();
        header('location:' . site_url(''));
    }
}