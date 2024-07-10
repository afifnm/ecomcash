<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
    public function index(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Login | '.$site['nama_cv'],
            'site'                  => $site,
        );
        $this->load->view('public/login',array_merge($data));
    }
	public function register(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Register | '.$site['nama_cv'],
            'site'                  => $site,
        );
        $this->load->view('public/register',array_merge($data));
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
}