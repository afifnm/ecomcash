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
    public function get_pelanggan_nama($id_pelanggan){
        $this->db->where('id_pelanggan', $id_pelanggan)->from('pelanggan');
        return $this->db->get()->row()->nama;
    }
}