<?php defined('BASEPATH') or exit('No direct script access allowed');
class Produk extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index($page=NULL){ //tampil semua produk
        $site = $this->Konfigurasi_model->listing();
        $config['base_url'] = base_url().'produk/index/';
        $config['total_rows'] = $this->db->count_all('produk'); // Total produk
        $config['per_page'] = 20; // Produk per halaman
        $config['uri_segment'] = 3; // Segment URI yang digunakan untuk pagination
        // Styling pagination dengan Tailwind CSS
        $config['full_tag_open'] = '<ul class="flex justify-center space-x-1">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['num_tag_open'] = '<li class="px-3 py-2 bg-white border border-gray-300 text-gray-700">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="px-3 py-2 bg-red-500 text-white border border-red-500">';
        $config['cur_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="px-3 py-2 bg-white border border-gray-300 text-gray-700">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="px-3 py-2 bg-white border border-gray-300 text-gray-700">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="px-3 py-2 bg-white border border-gray-300 text-gray-700">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="px-3 py-2 bg-white border border-gray-300 text-gray-700">';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        // Ambil nomor halaman dari URI segment
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // Get data produk dengan pagination
        $produk = $this->View_model->get_produk_pagination($config['per_page'], $page);
        $data = array(
            'title'                 => 'Mulai belanja | '.$site['nama_cv'],
            'site'                  => $site,
            'judul'                 => 'SEMUA  PRODUK',
            'produk'                => $produk,
            'pagination'            => $this->pagination->create_links(),
            'kategori'              => $this->View_model->get_kategori_dan_jumlah_produk()
        );
        $this->load->view('public/produkAll',array_merge($data));
    }
    public function k($slug,$id=NULL){ //berdasarkan kategori
        $site = $this->Konfigurasi_model->listing();
        $judul = $this->View_model->get_kategori_nama($slug);
        $config['base_url'] = site_url('produk/k/'.$slug); // Base URL untuk pagination
        $config['total_rows'] = $this->View_model->get_produkKategori_total($slug); // Total produk
        $config['per_page'] = 20; // Produk per halaman
        $config['full_tag_open'] = '<ul class="flex justify-center space-x-1">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="px-3 py-2 bg-white border border-gray-300 text-gray-700">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="px-3 py-2 bg-white border border-gray-300 text-gray-700">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="px-3 py-2 bg-white border border-gray-300 text-gray-700">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="px-3 py-2 bg-white border border-gray-300 text-gray-700">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="px-3 py-2 bg-red-500 text-white border border-red-500">';
        $config['cur_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li class="px-3 py-2 bg-white border border-gray-300 text-gray-700">';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $data = array(
            'title'                 => $judul. ' | '.$site['nama_cv'],
            'site'                  => $site,
            'judul'                 => $judul,
            'produk'                => $this->View_model->get_produkKategori_pagination($slug,$config['per_page'], $id),
            'pagination'            => $this->pagination->create_links(),
            'kategori'              => $this->View_model->get_kategori_dan_jumlah_produk()
        );
        $this->load->view('public/produkAll',array_merge($data));
    }
    public function p(){ //berdasarkan kategori
        $site = $this->Konfigurasi_model->listing();
        $keyword = $this->input->get('keyword', TRUE);
        $this->db->like('nama', $keyword);
        $query = $this->db->get('produk'); // Sesuaikan nama tabel Anda
        $produk = $query->result_array();
        if($produk==NULL){
            $judul = 'Produk tidak ditemukan';
        } else {
            $judul = $keyword;
        }
        $data = array(
            'title'                 => $judul. ' | '.$site['nama_cv'],
            'site'                  => $site,
            'judul'                 => $judul,
            'produk'                => $produk,
            'kategori'              => $this->View_model->get_kategori_dan_jumlah_produk()
        );
        $this->load->view('public/produkAll',array_merge($data));
    }
    public function v($slug){ //detail produk
        $site = $this->Konfigurasi_model->listing();
        $namaProduk = $this->View_model->get_produk_nama($slug);
        $data = array(
            'title'                 => $namaProduk.' | '.$site['nama_cv'],
            'site'                  => $site,
            'produk'                => $this->View_model->get_produk($slug)
        );
        $this->load->view('public/produk',array_merge($data));
    }
}