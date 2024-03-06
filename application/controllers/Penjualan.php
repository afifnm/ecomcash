<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Penjualan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level')==NULL){
			redirect('auth');
		}
	}
	public function index(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('y-m-d');
		$this->db->select('*');
		$this->db->from('penjualan a')->order_by('a.tanggal','DESC');
		//$this->db->where('a.tanggal',$tanggal);
		$this->db->join('pelanggan b','a.id_pelanggan=b.id_pelanggan','left');
        $user = $this->db->get()->result_array();
		$this->db->from('pelanggan')->order_by('id_pelanggan','ASC');
        $pelanggan = $this->db->get()->result_array();
		$data = array(
			'judul_halaman' => 'Penjualan',
			'user'			=> $user,
			'pelanggan'		=> $pelanggan
		);
		$this->template->load('temp','penjualan_index',$data);
	}
	public function laporan(){
		$tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
		$this->db->from('penjualan a')->order_by('a.tanggal','ASC');
		$this->db->where('a.tanggal <=', $tanggal2);
        $this->db->where('a.tanggal >=', $tanggal1); 
		$this->db->join('pelanggan b','a.id_pelanggan=b.id_pelanggan','left');
        $penjualan = $this->db->get()->result_array();
		$data = array(
			'penjualan'		=> $penjualan,
			'tanggal1'		=> $tanggal1,
			'tanggal2'		=> $tanggal2
		);
		$this->load->view('penjualan_laporan',$data);
	}
	public function transaksi($id_pelanggan){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m');
		$this->db->from('penjualan');
		$this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
		$jumlah = $this->db->count_all_results()+1;
		$nota = date('ymd').$jumlah;
		$this->db->from('produk')->where('stok >',0)->order_by('nama','ASC');
		$produk = $this->db->get()->result_array();

		$this->db->from('pelanggan')->where('id_pelanggan',$id_pelanggan);
		$namapelanggan = $this->db->get()->row()->nama;

		$this->db->from('detail_penjualan a');
		$this->db->join('produk b','a.id_produk=b.id_produk','left');
		$this->db->where('a.kode_penjualan',$nota);
		$detail = $this->db->get()->result_array();

		$this->db->from('temp a');
		$this->db->join('produk b','a.id_produk=b.id_produk','left');
		$this->db->where('a.id_user',$this->session->userdata('id_user'));
		$this->db->where('a.id_pelanggan',$id_pelanggan);
		$temp = $this->db->get()->result_array();
		$data = array(
			'judul_halaman' => 'Transaksi Penjualan '.$nota,
			'nota'			=> $nota,
			'produk'		=> $produk,
			'id_pelanggan'	=> $id_pelanggan,
			'namapelanggan' => $namapelanggan,
			'detail'		=> $detail,
			'temp'			=> $temp
		);
		$this->template->load('temp','penjualan_transaksi',$data);
	}
	public function tambahkeranjang(){
		$this->db->from('detail_penjualan');
		$this->db->where('id_produk',$this->input->post('id_produk'));
		$this->db->where('kode_penjualan',$this->input->post('kode_penjualan'));
		$cek = $this->db->get()->result_array();
		$this->db->from('produk')->where('id_produk',$this->input->post('id_produk'));
		$harga = $this->db->get()->row()->harga;
		$this->db->from('produk')->where('id_produk',$this->input->post('id_produk'));
		$stok_lama = $this->db->get()->row()->stok;
		$stok_sekarang = $stok_lama-$this->input->post('jumlah');
		$sub_total = $this->input->post('jumlah')*$harga;
		$data = array (
			'kode_penjualan' => $this->input->post('kode_penjualan'),
			'id_produk' => $this->input->post('id_produk'),
			'jumlah' => $this->input->post('jumlah'),
			'sub_total ' => $sub_total,
		);
		if($cek<>NULL){
			$this->session->set_flashdata('notifikasi','
			<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk berhasil ditambahkan jumlahnya!</div>
			');
			$this->db->from('detail_penjualan');
			$this->db->where('id_produk',$this->input->post('id_produk'));
			$this->db->where('kode_penjualan',$this->input->post('kode_penjualan'));
			$jumlah_sekarang = $this->db->get()->row()->jumlah;
			$where = array(
				'kode_penjualan'	=> $this->input->post('kode_penjualan'),
				'id_produk'			=> $this->input->post('id_produk'),
			);
			$data = array(
				'jumlah'			=> $jumlah_sekarang+$this->input->post('jumlah')
			);
			$this->db->update('detail_penjualan',$data,$where);
			$data2 = array( 'stok' => $stok_sekarang );
			$where2 = array( 'id_produk' => $this->input->post('id_produk') );
			$this->db->update('produk',$data2,$where2);
			redirect($_SERVER["HTTP_REFERER"]);
		}
		if($stok_lama>=$this->input->post('jumlah')){
			$this->db->insert('detail_penjualan',$data);
			$data2 = array( 'stok' => $stok_sekarang );
			$where = array( 'id_produk' => $this->input->post('id_produk') );
			$this->db->update('produk',$data2,$where);
			$this->session->set_flashdata('notifikasi','
			<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk berhasil ditambahkan</div>
			');
		} else {
			$this->session->set_flashdata('notifikasi','
			<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk yang dipilih tidak mencukupi stok.</div>
			');
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
	public function hapus($id_detail,$id_produk){
		$this->db->from('detail_penjualan')->where('id_detail',$id_detail);
		$jumlah = $this->db->get()->row()->jumlah;
		$this->db->from('produk')->where('id_produk',$id_produk);
		$stok_lama = $this->db->get()->row()->stok;
		$stok_sekarang  = $jumlah+$stok_lama;
		$data2 = array( 'stok' => $stok_sekarang );
		$where = array( 'id_produk' => $id_produk );
		$this->db->update('produk',$data2,$where);
		$where = array('id_detail'   => $id_detail );
        $this->db->delete('detail_penjualan',$where);
        $this->session->set_flashdata('notifikasi','
		<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk telah dihapus dari keranjang.</div>
        ');
		redirect($_SERVER["HTTP_REFERER"]);
	}
	public function hapus_temp($id_temp){
		$where = array('id_temp'   => $id_temp );
        $this->db->delete('temp',$where);
        $this->session->set_flashdata('notifikasi','
		<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk telah dihapus dari keranjang.</div>
        ');
		redirect($_SERVER["HTTP_REFERER"]);
	}
	public function bayar(){
		if($this->input->post('bayar')<$this->input->post('total_harga')){
			$this->session->set_flashdata('notifikasi','
			<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Pembayaran kurang dari total tagihan.</div>
			');
			redirect($_SERVER["HTTP_REFERER"]);
		}
		$data = array(
			'kode_penjualan'  => $this->input->post('kode_penjualan'),
			'id_pelanggan'  => $this->input->post('id_pelanggan'),
			'total_harga'      => $this->input->post('total_harga'),
			'bayar'      => $this->input->post('bayar'),
			'tanggal'     => date('Y-m-d'),
		);
		$this->db->insert('penjualan',$data);
		$this->session->set_flashdata('notifikasi','
		<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Transaksi penjualan berhasil dilakukan</div>
		');
		redirect('penjualan/invoice/'.$this->input->post('kode_penjualan'));
	}
	public function invoice($kode_pelanjualan){
		$this->db->select('*');
		$this->db->from('penjualan a')->order_by('a.tanggal','DESC')->where('a.kode_penjualan',$kode_pelanjualan);
		$this->db->join('pelanggan b','a.id_pelanggan=b.id_pelanggan','left');
        $penjualan = $this->db->get()->row();

		$this->db->from('detail_penjualan a');
		$this->db->join('produk b','a.id_produk=b.id_produk','left');
		$this->db->where('a.kode_penjualan',$kode_pelanjualan);
		$detail = $this->db->get()->result_array();

		$data = array(
			'judul_halaman' => 'Invoice '.$kode_pelanjualan,
			'nota'			=> $kode_pelanjualan,
			'penjualan'		=> $penjualan,
			'detail'		=> $detail,
			'profil'		=> $this->db->from('konfigurasi')->get()->row()
		);
		$this->template->load('temp','invoice',$data);
	}
	public function cek(){
		$kode_pelanjualan = $this->input->get('kode_penjualan');
		$this->db->select('*');
		$this->db->from('penjualan')->where('kode_penjualan',$kode_pelanjualan);
        $penjualan = $this->db->get()->row();
		if($penjualan==NULL){
			$this->session->set_flashdata('notifikasi','
			<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Nomor nota tidak ditemukan.</div>
			');
			redirect($_SERVER["HTTP_REFERER"]);
		} else {
			redirect('penjualan/invoice/'.$kode_pelanjualan);
		}
	}
	public function nota($kode_pelanjualan){
		$this->db->select('*');
		$this->db->from('penjualan a')->order_by('a.tanggal','DESC')->where('a.kode_penjualan',$kode_pelanjualan);
		$this->db->join('pelanggan b','a.id_pelanggan=b.id_pelanggan','left');
        $penjualan = $this->db->get()->row();

		$this->db->from('detail_penjualan a');
		$this->db->join('produk b','a.id_produk=b.id_produk','left');
		$this->db->where('a.kode_penjualan',$kode_pelanjualan);
		$detail = $this->db->get()->result_array();

		$data = array(
			'judul_halaman' => 'Invoice '.$kode_pelanjualan,
			'nota'			=> $kode_pelanjualan,
			'penjualan'		=> $penjualan,
			'detail'		=> $detail,
			'profil'		=> $this->db->from('konfigurasi')->get()->row()
		);
		$this->load->view('nota',$data);
	}
	public function addtemp(){
		$this->db->from('produk')->where('id_produk',$this->input->post('id_produk'));
		$stok_lama = $this->db->get()->row()->stok;

		$this->db->from('temp');
		$this->db->where('id_produk',$this->input->post('id_produk'));
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$this->db->where('id_pelanggan',$this->input->post('id_pelanggan'));
		$cek = $this->db->get()->result_array();

		if($stok_lama<$this->input->post('jumlah')){
			$this->session->set_flashdata('notifikasi','
			<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk yang dipilih tidak mencukupi stoknya.</div>
			');
		} else if($cek<>NULL){
			$this->session->set_flashdata('notifikasi','
			<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk berhasil ditambahkan jumlahnya!</div>
			');
			$this->db->from('temp');
			$this->db->where('id_user',$this->session->userdata('id_user'));
			$this->db->where('id_pelanggan',$this->input->post('id_pelanggan'));
			$jumlah_sekarang = $this->db->get()->row()->jumlah;
			$jumlah_now = $jumlah_sekarang+$this->input->post('jumlah');
			if($stok_lama<$jumlah_now){
				$this->session->set_flashdata('notifikasi','
				<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk yang dipilih tidak mencukupi stoknya.</div>
				');
				redirect($_SERVER["HTTP_REFERER"]);
			}
			$where = array(
				'id_user'			=> $this->session->userdata('id_user'),
				'id_pelanggan'		=> $this->input->post('id_pelanggan'),
				'id_produk'			=> $this->input->post('id_produk'),
			);
			$data = array(
				'jumlah'			=> $jumlah_now
			);
			$this->db->update('temp',$data,$where);
			redirect($_SERVER["HTTP_REFERER"]);
		} else {
			$data = array (
				'id_pelanggan' => $this->input->post('id_pelanggan'),
				'id_user' => $this->session->userdata('id_user'),
				'id_produk' => $this->input->post('id_produk'),
				'jumlah' => $this->input->post('jumlah')
			);
			$this->db->insert('temp',$data);
			$this->session->set_flashdata('notifikasi','
			<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk berhasil ditambahkan</div>
			');
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
	public function bayarv2(){
		//bagian pembuatan nota
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m');
		$this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
		$jumlah = $this->db->count_all_results();
		$nota = date('ymd').$jumlah+1;

		$this->db->from('temp a');
		$this->db->join('produk b','a.id_produk=b.id_produk','left');
		$this->db->where('a.id_user',$this->session->userdata('id_user'));
		$this->db->where('a.id_pelanggan',$this->input->post('id_pelanggan'));
		$temp = $this->db->get()->result_array();
		$total = 0;
		foreach($temp as $row){
			if($row['stok']<$row['jumlah']){
				$this->session->set_flashdata('notifikasi','
				<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk dipilih tidak mencukupi.</div>
				');
				redirect($_SERVER["HTTP_REFERER"]);
			}
			$total = $total+$row['jumlah']*$row['harga'];
			//input ke tabel detail penjualan 
			$data = array (
				'kode_penjualan' => $nota,
				'id_produk' => $row['id_produk'],
				'jumlah' => $row['jumlah'],
				'sub_total ' => $row['jumlah']*$row['harga'],
			);
			$this->db->insert('detail_penjualan',$data);
			//update tabel produk stoknya
			$data2 = array( 'stok' => $row['stok']-$row['jumlah']);
			$where = array( 'id_produk' => $row['id_produk']);
			$this->db->update('produk',$data2,$where);
			//hapus dari tabel temp 
			$where2 = array(
				'id_pelanggan' => $this->input->post('id_pelanggan'),
				'id_user' => $this->session->userdata('id_user')
			);
			$this->db->delete('temp',$where2);
		}
		//bagian input ke tabel penjualan
		$data = array(
			'kode_penjualan'  => $nota,
			'id_pelanggan'  => $this->input->post('id_pelanggan'),
			'total_harga'      => $total,
			'tanggal'     => date('Y-m-d'),
		);
		$this->db->insert('penjualan',$data);
		$this->session->set_flashdata('notifikasi','
		<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Penjualan berhasil.</div>
		');
		redirect('penjualan/invoice/'.$nota);
	}
}
