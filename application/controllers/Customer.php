<?php defined('BASEPATH') or exit('No direct script access allowed');
class Customer extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('login')!=="Frontend"){
			redirect('login');
		}
	}
    public function index(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Customer | '.$site['nama_cv'],
            'site'                  => $site,
        );
        $this->load->view('public/customerProfile',array_merge($data));
    }
    public function password(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Ganti Password | '.$site['nama_cv'],
            'site'                  => $site,
        );
        $this->load->view('public/customerPassword',array_merge($data));
    }
    public function keranjang(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Keranjang Belanja | '.$site['nama_cv'],
            'site'                  => $site,
            'keranjang'             => $this->View_model->get_keranjang($this->session->userdata('id_pelanggan'))
        );
        $this->load->view('public/customerKeranjang',array_merge($data));
    }
    public function update(){
        $data = array(
            'nama'         => $this->input->post('nama'),
            'alamat'       => $this->input->post('alamat'),
            'telp'         => $this->input->post('telp')
        );
        $where = array('email'   => $this->input->post('email') );
        $this->db->update('pelanggan',$data,$where);
        $this->session->set_userdata($data);
        $this->session->set_flashdata('notifikasi','
        <h2 class="block w-full py-2 text-center text-white bg-primary border border-primary rounded">
        Berhasil memperbarui biodata. </h2>
        ');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function updatePassword(){
        $data = array(
            'password'         => $this->input->post('passwordBaru')
        );
        $where = array('email'   => $this->session->userdata('email'));
        $this->db->update('pelanggan',$data,$where);
        $this->session->set_userdata($data);
        $this->session->set_flashdata('notifikasi','
        <h2 class="block w-full py-2 text-center text-white bg-primary border border-primary rounded">
        Berhasil memperbarui password. </h2>
        ');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function addKeranjang(){
        $id_produk = $this->input->post('id_produk');
        $stok = $this->db->from('produk')->where('id_produk',$id_produk)->get()->row()->stok;
        $jumlah = $this->input->post('jumlah');
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $this->db->from('keranjang')->where('id_produk',$id_produk)->where('id_pelanggan',$id_pelanggan);
		$cek = $this->db->get()->row();
        if($jumlah>$stok){
            $this->session->set_flashdata('notifikasi','
            <h2 class="block w-full py-2 text-center text-white bg-primary border border-primary rounded">
            Jumlah produk yang dibeli melebihi stok jumlah.</h2>
            ');
            redirect($_SERVER["HTTP_REFERER"]);
        } else if($cek<>NULL){
            $jumlah = $cek->jumlah+$jumlah;
			if($jumlah>$stok){
                $this->session->set_flashdata('notifikasi','
                <h2 class="block w-full py-2 text-center text-white bg-primary border border-primary rounded">
                Produk sudah ada di dalam keranjang, jumlah produk yang dibeli melebihi stok jumlah.</h2>
                ');
				redirect($_SERVER["HTTP_REFERER"]);
			}
			$where = array(
				'id_produk'			=> $this->input->post('id_produk'),
				'id_pelanggan'		=> $id_pelanggan,
			);
			$data = array(
				'jumlah'			=> $jumlah
			);
			$this->db->update('keranjang',$data,$where);
			$this->session->set_flashdata('notifikasi','
                <h2 class="block w-full py-2 text-center text-white bg-primary border border-primary rounded">
                Jumlah produk pada keranjang yang dibeli berhasil diperbarui.</h2>
                ');
				redirect($_SERVER["HTTP_REFERER"]);
		} else {
            $data = array(
                'id_produk'    => $this->input->post('id_produk'),
                'id_pelanggan' => $this->session->userdata('id_pelanggan'),
                'jumlah'       => $this->input->post('jumlah')
            );
            $this->db->insert('keranjang',$data);
            $this->session->set_flashdata('notifikasi','
            <h2 class="block w-full py-2 text-center text-white bg-primary border border-primary rounded">
            Produk berhasil ditambahkan dalam keranjang.</h2>
            ');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function hapusKeranjang($id_keranjang){
        $where = array(
            'id_keranjang'   => $id_keranjang,
            'id_pelanggan'   => $this->session->userdata('id_pelanggan') 
        );
        $this->db->delete('keranjang',$where);
        $this->session->set_flashdata('notifikasi','
        <h2 class="block w-full py-2 text-center text-white bg-primary border border-primary rounded">
        Produk berhasil dihapus dari keranjang belanja.</h2>
        ');
        redirect($_SERVER['HTTP_REFERER']);
    }
}