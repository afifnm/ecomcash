<?php defined('BASEPATH') or exit('No direct script access allowed');
class Beranda extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('tgl_indo');
        $this->load->library('pagination');
    }
    public function index($id=NULL){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Beranda | '.$site['nama_cv'],
            'site'                  => $site,
        );
        $this->load->view('public/index',array_merge($data));
    }
    public function alur(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Alur Belanja | '.$site['nama_cv'],
            'site'                  => $site,
        );
        $this->load->view('public/alur',array_merge($data));
    }
}