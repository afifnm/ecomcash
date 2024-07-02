<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kategori extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level')==NULL){
			redirect('auth');
		}
	}
	public function index(){
        $this->db->select('*')->from('kategori');
        $this->db->order_by('id_kategori','ASC');
        $user = $this->db->get()->result_array();
		$data = array(
			'judul_halaman' => 'kategori',
            'user'          => $user
		);
		$this->template->load('temp','kategori_index',$data);
	}
    public function simpan(){
        $data = array(
            'kategori'  => $this->input->post('kategori')
        );
        $this->db->insert('kategori',$data);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Kategori produk berhasil disimpan</div>
        ');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function hapus($id_kategori){
        $where = array('id_kategori'   => $id_kategori );
        $this->db->delete('kategori',$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Kategori berhasil dihapus</div>
        ');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function update(){
        $data = array(
            'kategori'  => $this->input->post('kategori')
        );
        $where = array('id_kategori'   => $this->input->post('id_kategori') );
        $this->db->update('kategori',$data,$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Kategori berhasil diperbarui</div>
        ');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
