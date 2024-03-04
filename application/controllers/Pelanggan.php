<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pelanggan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level')==NULL){
			redirect('auth');
		}
	}
	public function index(){
        $this->db->select('*')->from('pelanggan');
        $this->db->order_by('id_pelanggan','ASC');
        $user = $this->db->get()->result_array();
		$data = array(
			'judul_halaman' => 'Pelanggan',
            'user'          => $user
		);
		$this->template->load('temp','pelanggan_index',$data);
	}
    public function simpan(){
        $data = array(
            'alamat'  => $this->input->post('alamat'),
            'telp'         => $this->input->post('telp'),
            'nama'         => $this->input->post('nama')
        );
        $this->db->insert('pelanggan',$data);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Pelanggan berhasil disimpan</div>
        ');
        redirect('pelanggan');
    }
    public function hapus($id_pelanggan){
        $where = array('id_pelanggan'   => $id_pelanggan );
        $this->db->delete('pelanggan',$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Pengguna berhasil dihapus</div>
        ');
        redirect('pelanggan');
    }
    public function update(){
        $data = array(
            'alamat'         => $this->input->post('alamat'),
            'nama'         => $this->input->post('nama'),
            'telp'        => $this->input->post('telp'),
        );
        $where = array('id_pelanggan'   => $this->input->post('id_pelanggan') );
        $this->db->update('pelanggan',$data,$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Pengguna berhasil diperbarui</div>
        ');
        redirect('pelanggan');
    }
    public function transaksi($id_pelanggan){
		$this->db->from('penjualan a')->order_by('a.tanggal','DESC');
		$this->db->where('a.id_pelanggan',$id_pelanggan);
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
}
