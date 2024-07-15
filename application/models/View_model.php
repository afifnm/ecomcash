<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_model extends CI_Model{
    //produk
    public function get_produk_nama($id_produk){
        $this->db->or_where('id_produk', $id_produk)
                 ->or_where('slug', $id_produk)
                 ->from('produk');
        return $this->db->get()->row()->nama;
    }
    public function get_produk($id_produk){
        $this->db->select('a.*,b.kategori')
                 ->or_where('a.id_produk', $id_produk)
                 ->or_where('a.slug', $id_produk)
                 ->from('produk a')
                 ->join('kategori b','a.id_kategori=b.id_kategori','left');
        return $this->db->get()->row();
    }
    public function get_produk_terbaru($limit){
        $this->db->from('produk')
                 ->order_by('id_produk', 'DESC')
                 ->limit($limit);  
        return $this->db->get()->result_array();
    }
    public function get_produk_terlaris($limit){
		$this->db->select('b.*, sum(jumlah) as total')->from('detail_penjualan a')
                 ->order_by('total','DESC')
		         ->group_by('id_produk')
		         ->join('produk b','a.id_produk=b.id_produk','left')
		         ->limit($limit);
        return $this->db->get()->result_array();
    }
    public function get_produk_foto($id_produk){
        $this->db->where('id_produk', $id_produk)->from('produk');
        return $this->db->get()->row()->foto;
    }
    public function get_produk_pagination($limit, $start) {
        $this->db->from('produk')
                 ->order_by('id_produk', 'DESC')
                 ->limit($limit, $start);
        return $this->db->get()->result_array();
    }
    public function get_produk_total() {
        return $this->db->count_all('produk');
    }
    public function get_produkKategori_pagination($slug,$limit, $start) {
        $this->db->where('slug', $slug)->from('kategori');
        $id = $this->db->get()->row()->id_kategori;
        $this->db->from('produk')
                 ->where('id_kategori',$id)
                 ->order_by('id_produk', 'DESC')
                 ->limit($limit, $start);
        return $this->db->get()->result_array();
    }
    public function get_produkKategori_total($slug) {
        $this->db->where('slug', $slug)->from('kategori');
        $id = $this->db->get()->row()->id_kategori;
        $this->db->where('id_kategori',$id);
        return $this->db->count_all('produk');
    }
    //kategori
    public function get_kategori(){
        $this->db->order_by('kategori', 'ASC')->from('kategori');
        return $this->db->get()->result_array();
    }
    public function get_kategori_nama($slug){
        $this->db->from('kategori')->or_where('id_kategori',$slug)->or_where('slug',$slug);
        return $this->db->get()->row()->kategori;
    }
    public function get_kategori_foto($id_kategori){
        $this->db->where('id_kategori', $id_kategori)->from('kategori');
        return $this->db->get()->row()->foto;
    }
    public function get_kategori_dan_jumlah_produk() {
        $this->db->select('kategori.*, COUNT(produk.id_produk) as jumlah_produk');
        $this->db->from('kategori');
        $this->db->join('produk', 'produk.id_kategori = kategori.id_kategori', 'left');
        $this->db->group_by('kategori.id_kategori');
        $this->db->order_by('kategori.kategori', 'ASC');
        return $this->db->get()->result_array();
    }
    //pelanggan
    public function get_pelanggan(){
        $this->db->order_by('nama', 'ASC')->from('pelanggan')->where('id_pelanggan !=','1');
        return $this->db->get()->result_array();
    }
    public function get_pelanggan_nama($id_pelanggan){
        $this->db->where('id_pelanggan', $id_pelanggan)->from('pelanggan');
        return $this->db->get()->row()->nama;
    }
    //customer
    public function get_jumlah_keranjang($id_pelanggan) {
        $this->db->where('id_pelanggan',$id_pelanggan);
        return $this->db->count_all('keranjang');
    }
    public function get_keranjang($id_pelanggan){
		$this->db->select('a.*, b.*, c.kategori')->from('keranjang a')
		         ->join('produk b','a.id_produk=b.id_produk','left')
		         ->join('kategori c','b.id_kategori=c.id_kategori','left');
        return $this->db->get()->result_array();
    }
    public function get_pesanan($id_pelanggan){
		$this->db->select('*')->from('penjualan')
                 ->order_by('kode_penjualan','DESC')
                 ->where('id_pelanggan',$id_pelanggan);
        return $this->db->get()->result_array();
    }
}