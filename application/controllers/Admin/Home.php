<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('login')!=="Backend"){
			redirect('auth');
		}
	}
	public function index(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m');
		$online = $this->db->from('penjualan')
				->where("status", 'proses')
				->count_all_results();

		$tanggal = date("Y-m-d");
        $this->db->select('sum(total_harga) as total')
				->from('penjualan')
				->where('status', 'selesai')
				->where("DATE_FORMAT(tanggal,'%Y-%m-%d')", $tanggal);
        $hari_ini = $this->db->get()->row()->total;
		if($hari_ini==NULL){ $hari_ini =0; }

		$tanggal = date("Y-m");
        $this->db->select('sum(total_harga) as total')
				->from('penjualan')
				->where('status', 'selesai')
				->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
        $bulan_ini = $this->db->get()->row()->total;
		if($bulan_ini==NULL){ $bulan_ini =0; }

		$this->db->select('*')
				->from('penjualan')
				->order_by('kode_penjualan','DESC')
				->limit(7,0);
        $recent = $this->db->get()->result_array();

		$this->db->select('b.*, sum(jumlah) as total')
				->from('detail_penjualan a')
				->order_by('total','DESC')
				->group_by('id_produk')
				->join('produk b','a.id_produk=b.id_produk','left')
				->join('penjualan c','a.kode_penjualan=c.kode_penjualan','left')
				->where('c.status', 'selesai')
				->limit(5,0);
        $produk5 = $this->db->get()->result_array();

		$this->db->from('penjualan')
				->order_by('kode_penjualan','DESC')
				->where('status', 'selesai')
				->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
        $user = $this->db->get()->result_array();
		
		$data = array(
			'judul_halaman' => 'Dashboard',
			'online'		=> $online,
			'hari_ini'		=> $hari_ini,
			'bulan_ini'		=> $bulan_ini,
			'produk'		=> $this->db->from('produk')->count_all_results(),
			'recent'		=> $recent,
			'user'			=> $user,
			'produk5'		=> $produk5,
			'pelanggan'		=> $this->View_model->get_pelanggan()
		);
		$this->template->load('temp','dashboard',$data);
	}
}
