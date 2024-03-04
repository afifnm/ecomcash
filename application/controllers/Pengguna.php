<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengguna extends CI_Controller {
    public function __construct(){
		parent::__construct();
		if($this->session->userdata('level')!='Admin'){
			redirect('home');
		}
	}
	public function index(){
        $this->db->select('*')->from('user');
        $this->db->order_by('nama','ASC');
        $user = $this->db->get()->result_array();
		$data = array(
			'judul_halaman' => 'Data Pengguna',
            'data2'          => $user
		);
		$this->template->load('temp','pengguna_index',$data);
	}
    public function simpan(){
        $this->db->from('user')->where('username',$this->input->post('username'));
        $cek = $this->db->get()->result_array();
        if($cek==NULL){
            $data = array(
                'username'  => $this->input->post('username'),
                'password'  => md5($this->input->post('password')),
                'nama'      => $this->input->post('nama'),
                'level'     => $this->input->post('level'),
            );
            $this->db->insert('user',$data);
            $this->session->set_flashdata('notifikasi','
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Pengguna baru berhasil disimpan.</div>
            ');
        } else {
            $this->session->set_flashdata('notifikasi','
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Username sudah digunakan!</div>
            ');
        }
        redirect('pengguna');
    }
    public function hapus($id_user){
        $where = array('id_user'   => $id_user );
        $this->db->delete('user',$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Data pengguna berhasil dihapus</div>
        ');
        redirect('pengguna');
    }
    public function update(){
        $data = array(
            'nama'      => $this->input->post('nama'),
            'level'     => $this->input->post('level'),
        );
        $where = array('id_user'   => $this->input->post('id') );
        $this->db->update('user',$data,$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Pengguna berhasil diperbarui</div>
        ');
        redirect('pengguna');
    }
    public function reset($id_user){
        $data = array(
            'password'      => md5('1234'),
        );
        $where = array('id_user'   => $id_user );
        $this->db->update('user',$data,$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Reset password pengguna telah dirubah menjadi 1234</div>
        ');
        redirect('pengguna');  
    }
}
