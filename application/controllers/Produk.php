<?php defined('BASEPATH') or exit('No direct script access allowed');
class Produk extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function v($slug){
        $site = $this->Konfigurasi_model->listing();
        $namaProduk = $this->View_model->get_produk_nama($slug);
        $data = array(
            'title'                 => $namaProduk.' | '.$site['nama_cv'],
            'site'                  => $site,
            'produk'                => $this->View_model->get_produk($slug)
        );
        $this->load->view('public/produk',array_merge($data));
    }
    public function k($slug){
        $site = $this->Konfigurasi_model->listing();
        $namaProduk = $this->View_model->get_produk_nama($slug);
        $data = array(
            'title'                 => $namaProduk.' | '.$site['nama_cv'],
            'site'                  => $site,
            'produk'                => $this->View_model->get_produk($slug)
        );
        $this->load->view('public/produKategori',array_merge($data));
    }
}