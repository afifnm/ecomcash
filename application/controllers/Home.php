<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level')==NULL){
			redirect('auth');
		}
	}
	public function index(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m');
		$bulan = $this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal)->count_all_results();

		$tanggal = date("Y-m-d");
        $this->db->select('sum(total_harga) as total')->from('penjualan');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m-%d')", $tanggal);
        $hari_ini = $this->db->get()->row()->total;
		if($hari_ini==NULL){ $hari_ini =0; }

		$tanggal = date("Y-m");
        $this->db->select('sum(total_harga) as total')->from('penjualan');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
        $bulan_ini = $this->db->get()->row()->total;
		if($bulan_ini==NULL){ $bulan_ini =0; }

		$this->db->select('*')->from('penjualan a')->order_by('a.kode_penjualan','DESC');
		$this->db->join('pelanggan b','a.id_pelanggan=b.id_pelanggan','left');
		$this->db->limit(7,0);
        $recent = $this->db->get()->result_array();

		$this->db->select('b.*, sum(jumlah) as total')->from('detail_penjualan a');
		$this->db->order_by('total','DESC');
		$this->db->group_by('id_produk');
		$this->db->join('produk b','a.id_produk=b.id_produk','left');
		$this->db->limit(5,0);
        $produk5 = $this->db->get()->result_array();

		$this->db->from('penjualan a')->order_by('a.kode_penjualan','DESC');
		$this->db->where("DATE_FORMAT(a.tanggal,'%Y-%m')", $tanggal);
		$this->db->join('pelanggan b','a.id_pelanggan=b.id_pelanggan','left');
        $user = $this->db->get()->result_array();
		
		$data = array(
			'judul_halaman' => 'Dashboard',
			'pelanggan'		=> $this->db->from('pelanggan')->order_by('id_pelanggan','ASC')->get()->result_array(),
			'bulan'			=> $bulan,
			'hari_ini'		=> $hari_ini,
			'bulan_ini'		=> $bulan_ini,
			'produk'		=> $this->db->from('produk')->count_all_results(),
			'recent'		=> $recent,
			'user'			=> $user,
			'produk5'		=> $produk5,
		);
		$this->template->load('temp','dashboard',$data);
	}
}
