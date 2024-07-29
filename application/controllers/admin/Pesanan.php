<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pesanan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('login')!=="Backend"){
			redirect('auth');
		}
	}
	public function index(){
		$this->db->select('penjualan.*, pelanggan.nama')
                ->from('penjualan')
                ->order_by('id_penjualan','DESC')
                ->join('pelanggan', 'pelanggan.id_pelanggan = penjualan.id_pelanggan')
                ->where('transaksi','Online');
        $user = $this->db->get()->result_array();
		$data = array(
			'judul_halaman' => 'Pesanan Online',
			'user'			=> $user,
			'pelanggan'		=> $this->View_model->get_pelanggan()
		);
		$this->template->load('temp','pesanan_index',$data);
	}

	public function cek($kode_penjualan){
		$this->db->select('*');
		$this->db->from('penjualan')->order_by('tanggal','DESC')->where('kode_penjualan',$kode_penjualan);
        $penjualan = $this->db->get()->row();

		$this->db->from('detail_penjualan a');
		$this->db->join('produk b','a.id_produk=b.id_produk','left');
		$this->db->where('a.kode_penjualan',$kode_penjualan);
		$detail = $this->db->get()->result_array();

		$data = array(
			'judul_halaman' => 'Cek Pesanan '.$kode_penjualan,
			'nota'			=> $kode_penjualan,
			'penjualan'		=> $penjualan,
			'detail'		=> $detail,
			'profil'		=> $this->db->from('konfigurasi')->get()->row()
		);
		$this->template->load('temp','pesanan_cek',$data);
	}

	public function nota($kode_penjualan){
		$this->db->select('*');
		$this->db->from('penjualan ')->order_by('tanggal','DESC')->where('kode_penjualan',$kode_penjualan);
        $penjualan = $this->db->get()->row();

		$this->db->from('detail_penjualan a');
		$this->db->join('produk b','a.id_produk=b.id_produk','left');
		$this->db->where('a.kode_penjualan',$kode_penjualan);
		$detail = $this->db->get()->result_array();

		$data = array(
			'judul_halaman' => 'Invoice '.$kode_penjualan,
			'nota'			=> $kode_penjualan,
			'penjualan'		=> $penjualan,
			'detail'		=> $detail,
			'profil'		=> $this->db->from('konfigurasi')->get()->row()
		);
		$this->load->view('nota',$data);
	}
	public function approve($status,$kode_penjualan){
		if($status==1){
			$status = 'selesai';
		} else {
			$status = 'dibatalkan';
			$this->db->from('detail_penjualan a')
					->join('produk b','a.id_produk=b.id_produk','left')
					->where('a.kode_penjualan',$kode_penjualan);
			$detail = $this->db->get()->result_array();
			foreach($detail as $row){
				$data2 = array( 'stok' => $row['stok']+$row['jumlah']);
				$where = array( 'id_produk' => $row['id_produk']);
				$this->db->update('produk',$data2,$where); //update tabel produk stoknya
			}
		}
        $data = array(
            'status'  => $status,
        );
        $where = array('kode_penjualan'   => $kode_penjualan );
        $this->db->update('penjualan',$data,$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Transaksi penjualan telah '.$status.'.</div>
        ');
        redirect('admin/pesanan');
    }
}