<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pembelian extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('login')!=="Backend"){
			redirect('auth');
		}
	}
	public function index(){
		$this->db->from('pembelian')->order_by('id_pembelian','DESC');
        $user = $this->db->get()->result_array();
		$data = array(
			'judul_halaman' => 'Pembelian',
			'user'			=> $user,
			'pelanggan'		=> $this->View_model->get_pelanggan()
		);
		$this->template->load('temp','pembelian_index',$data);
	}
	public function laporan(){
		$tanggal1 = $this->input->get('tanggal1');
        $tanggal2 = $this->input->get('tanggal2');
        $jenis = $this->input->get('jenis');
		$this->db->from('penjualan a')->order_by('a.tanggal','ASC');
		$this->db->where('a.tanggal <=', $tanggal2);
        $this->db->where('a.tanggal >=', $tanggal1); 
		if($jenis<>0){
			$this->db->where('a.jenis', $jenis); 
		}
        $penjualan = $this->db->get()->result_array();
		$data = array(
			'penjualan'		=> $penjualan,
			'tanggal1'		=> $tanggal1,
			'tanggal2'		=> $tanggal2,
			'jenis'		    => $jenis,
		);
		$this->load->view('penjualan_laporan',$data);
	}
	public function transaksi(){
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m');
		$this->db->from('pembelian');
		$this->db->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
		$jumlah = $this->db->count_all_results()+1;
		$nota = date('ymd').$jumlah;
		$this->db->from('produk')->where('stok >',0)->order_by('nama','ASC');
		$produk = $this->db->get()->result_array();

		$this->db->from('detail_pembelian a');
		$this->db->join('produk b','a.id_produk=b.id_produk','left');
		$this->db->where('a.kode_pembelian',$nota);
		$detail = $this->db->get()->result_array();

		$this->db->from('temp2 a');
		$this->db->join('produk b','a.id_produk=b.id_produk','left');
		$this->db->where('a.id_user',$this->session->userdata('id_user'));
		$temp = $this->db->get()->result_array();
		$data = array(
			'judul_halaman' => 'Transaksi Pembelian '.$nota,
			'nota'			=> $nota,
			'produk'		=> $produk,
			'detail'		=> $detail,
			'temp'			=> $temp,
		);
		$this->template->load('temp','pembelian_transaksi',$data);
	}
	public function hapus_temp($id_temp){
		$where = array('id_temp'   => $id_temp );
        $this->db->delete('temp2',$where);
        $this->session->set_flashdata('notifikasi','
		<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk telah dihapus dari keranjang.</div>
        ');
		redirect($_SERVER["HTTP_REFERER"]);
	}
	public function invoice($kode_pembelian){
		$this->db->select('*');
		$this->db->from('pembelian')->order_by('tanggal','DESC')->where('kode_pembelian',$kode_pembelian);
        $pembelian = $this->db->get()->row();

		$this->db->select('a.*, b.nama, b.kode_produk');
		$this->db->from('detail_pembelian a');
		$this->db->join('produk b','a.id_produk=b.id_produk','left');
		$this->db->where('a.kode_pembelian',$kode_pembelian);
		$detail = $this->db->get()->result_array();

		$data = array(
			'judul_halaman' => 'Invoice '.$kode_pembelian,
			'nota'			=> $kode_pembelian,
			'pembelian'		=> $pembelian,
			'detail'		=> $detail,
			'profil'		=> $this->db->from('konfigurasi')->get()->row()
		);
		$this->template->load('temp','invoice2',$data);
	}
	public function addtemp(){
		$this->db->from('produk')->where('id_produk',$this->input->post('id_produk'));
		$stok_lama = $this->db->get()->row()->stok;

		$this->db->from('temp2');
		$this->db->where('id_produk',$this->input->post('id_produk'));
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$cek = $this->db->get()->result_array();

        if($cek<>NULL){
			$this->db->from('temp2');
			$this->db->where('id_user',$this->session->userdata('id_user'));
            $this->db->where('id_produk',$this->input->post('id_produk'));
			$jumlah_sekarang = $this->db->get()->row()->jumlah;
			$jumlah_now = $jumlah_sekarang+$this->input->post('jumlah');
			$where = array(
				'id_user'			=> $this->session->userdata('id_user'),
				'id_produk'			=> $this->input->post('id_produk'),
			);
			$data = array(
				'jumlah'			=> $jumlah_now
			);
			$this->db->update('temp2',$data,$where);
			$this->session->set_flashdata('notifikasi','
			<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Jumlah beli produk berhasil ditambahkan!</div>
			');
			redirect($_SERVER["HTTP_REFERER"]);
		} else {
			$data = array (
				'id_user'		=> $this->session->userdata('id_user'),
				'id_produk'		=> $this->input->post('id_produk'),
				'harga'         => $this->input->post('harga'),
				'jumlah'		=> $this->input->post('jumlah')
			);
			$this->db->insert('temp2',$data);
			$this->session->set_flashdata('notifikasi','
			<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk berhasil ditambahkan</div>
			');
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
	public function bayarv2(){ 
		$bayar = $this->input->post('bayar');
		//bagian pembuatan nota
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m');
		$this->db->from('pembelian')->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
		$jumlah = $this->db->count_all_results();
		$nota = date('ymd')."0".$jumlah+1;
		$config['upload_path']          = 'assets/bukti/';
		$config['max_size'] = 500 * 1024; //3 * 1024 * 1024; //3Mb; 0=unlimited
		$config['allowed_types']        = '*';
		$config['overwrite']            = TRUE;
		$config['file_name']            = $nota.".jpg";
		$this->load->library('upload', $config);
		if($_FILES['bukti']['size'] >= 500 * 1024){
			$this->session->set_flashdata('notifikasi','
			<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Ukuran foto terlalu besar, upload dibawah ukuran 500 KB.</div>
			');
			redirect($_SERVER['HTTP_REFERER']);
		}  elseif( ! $this->upload->do_upload('bukti')){
			$error = array('error' => $this->upload->display_errors());
		}else{
			$data = array('upload_data' => $this->upload->data());
		} 
		$this->db->from('temp2 a')
				->join('produk b','a.id_produk=b.id_produk','left')
				->where('a.id_user',$this->session->userdata('id_user'));
		$temp = $this->db->get()->result_array();
		$total = 0; //nilai awal
		foreach($temp as $row){
			$total = $total+$row['jumlah']*$row['harga'];
			
			$data = array (
				'kode_pembelian' => $nota,
				'id_produk' => $row['id_produk'],
				'jumlah' => $row['jumlah'],
				'harga ' => $row['harga'],
			);
			$this->db->insert('detail_pembelian',$data); //input ke tabel detail pembelian 
			
			$data2 = array( 'stok_gudang' => $row['stok_gudang']+$row['jumlah']);
			$where = array( 'id_produk' => $row['id_produk']);
			$this->db->update('produk',$data2,$where); //update tabel produk pada stok gudang
			
			$where2 = array(
				'id_user'		=> $this->session->userdata('id_user')
			);
			$this->db->delete('temp2',$where2); //hapus dari tabel temp 
		}
		//bagian input ke tabel pembelian
		$data = array(
			'kode_pembelian' 	=> $nota,
			'bayar'				=> $total,
			'supplier'  		=> $this->input->post('supplier'),
			'bukti'				=> $nota.'.jpg',
			'status'			=> 'selesai',
			'tanggal'			=> date('Y-m-d'),
		);
		$this->db->insert('pembelian',$data);
		$this->session->set_flashdata('notifikasi','
		<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Pembelian berhasil.</div>
		');
		redirect('admin/pembelian/invoice/'.$nota);
	}
}