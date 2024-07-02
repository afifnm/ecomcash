<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	public function index(){
		$data = array(
			'judul_halaman' => 'Login',
		);
		$this->load->view('login',$data);
	}
    public function profile(){
		$data = array(
			'judul_halaman' => 'Profile',
            'profil'        => $this->db->from('konfigurasi')->get()->row()
		);
		$this->template->load('temp','profile',$data);
	}
    public function update(){
        $data = array(
            'nama_cv'      => $this->input->post('nama_cv'),
            'alamat'     => $this->input->post('alamat'),
            'telp'     => $this->input->post('telp'),
            'email'     => $this->input->post('email'),
        );
        $where = array('id_konfigurasi'   => $this->input->post('id') );
        $this->db->update('konfigurasi',$data,$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Berhasil diperbarui</div>
        ');
        redirect('auth/profile');
    }
    public function login(){
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $this->db->from('user')->where('username',$username);
        $cek = $this->db->get()->row();
        if($cek==NULL){
            $this->session->set_flashdata('notifikasi','
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Username tidak ditemukan</div>
            ');
            redirect('auth');
        } else if($cek->password==$password){
            $data = array(
                'id_user'   => $cek->id_user,
                'username'   => $cek->username,
                'level'   => $cek->level,
                'nama'   => $cek->nama,
            );
            $this->session->set_userdata($data);
            redirect('admin/home');
        } else {
            $this->session->set_flashdata('notifikasi','
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Password salah!</div>
            ');
            redirect('auth');
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('auth');
    }
}