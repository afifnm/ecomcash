<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_model extends CI_Model{
    public function get_kategori(){
        $this->db->order_by('kategori', 'ASC')->from('kategori');
        return $this->db->get()->result_array();
    }
    public function get_pelanggan(){
        $this->db->order_by('nama', 'ASC')->from('pelanggan')->where('id_pelanggan !=','1');
        return $this->db->get()->result_array();
    }
    public function get_produk_foto($id_produk){
        $this->db->where('id_produk', $id_produk)->from('produk');
        return $this->db->get()->row()->foto;
    }
    public function get_kategori_foto($id_kategori){
        $this->db->where('id_kategori', $id_kategori)->from('kategori');
        return $this->db->get()->row()->foto;
    }
    public function get_pelanggan_nama($id_pelanggan){
        $this->db->where('id_pelanggan', $id_pelanggan)->from('pelanggan');
        return $this->db->get()->row()->nama;
    }
    public function get_produk_terbaru($limit){
        $this->db->from('produk')->order_by('id_produk', 'DESC')->limit($limit);  // Batasi hasil menjadi 8
        return $this->db->get()->result_array();
    }
    public function get_produk_terlaris($limit){
		$this->db->select('b.*, sum(jumlah) as total')->from('detail_penjualan a');
		$this->db->order_by('total','DESC');
		$this->db->group_by('id_produk');
		$this->db->join('produk b','a.id_produk=b.id_produk','left');
		$this->db->limit($limit);
        return $this->db->get()->result_array();
    }
}