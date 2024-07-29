<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Supplier extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('login')!=="Backend"){
			redirect('auth');
		}
	}
	public function index(){
		$data = array(
			'judul_halaman' => 'Supplier',
            'user'          => $this->View_model->get_supplier()
		);
		$this->template->load('temp','supplier_index',$data);
	}
    public function simpan(){
        $this->db->from('supplier')->where('nama',create_slug($this->input->post('nama')));
        $cek = $this->db->get()->result_array();
        if($cek<>NULL){
            $this->session->set_flashdata('notifikasi','
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Supplier sudah ada</div>
            ');
            redirect($_SERVER['HTTP_REFERER']);            
        } 
        $data = array(
            'nama'      => $this->input->post('nama'),
            'no_telp'   => $this->input->post('no_telp'),
        );
        $this->db->insert('supplier',$data);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Supplier berhasil ditambahkan</div>
        ');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function hapus($id_supplier){
        $where = array('id_supplier'   => $id_supplier );
        $this->db->delete('supplier',$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">supplier berhasil dihapus</div>
        ');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function update(){
        $data = array(
            'nama'      => $this->input->post('nama'),
            'no_telp'   => $this->input->post('no_telp'),
        );
        $where = array('id_supplier'   => $this->input->post('id_supplier') );
        $this->db->update('supplier',$data,$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Supplier berhasil diperbarui</div>
        ');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
