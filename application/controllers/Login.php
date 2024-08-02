<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
    public function index(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Login | '.$site['nama_cv'],
            'site'                  => $site,
        );
        $this->load->view('public/login',array_merge($data));
    }
	public function register(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Register | '.$site['nama_cv'],
            'site'                  => $site,
        );
        $this->load->view('public/register',array_merge($data));
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
    public function simpan(){
        $this->db->from('pelanggan')->where('email',$this->input->post('email'));
        $cek = $this->db->get()->result_array();
        if($cek==NULL){
            $data = array(
                'nama'         => $this->input->post('nama'),
                'alamat'       => $this->input->post('alamat'),
                'telp'         => $this->input->post('telp'),
                'email'        => $this->input->post('email'),
                'password'     => $this->input->post('password')
            );
            $this->db->insert('pelanggan',$data);
            $this->session->set_flashdata('notifikasi','
            <h2 class="block w-full py-2 text-center text-white bg-primary border border-primary rounded">
            Berhasil mendaftar silahkan login terlebih dahulu. </h2>
            ');
            redirect('login');
        } else {
            $this->session->set_flashdata('notifikasi','
            <h2 class="block w-full py-2 text-center text-white bg-primary border border-primary rounded">
            Email sudah digunakan, silahkan ulangi lagi dengan email yang belum digunakan. </h2>
            ');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function cek(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->db->from('pelanggan')->where('email',$email);
        $cek = $this->db->get()->row();
        if($cek==NULL){
            $this->session->set_flashdata('notifikasi','
            <h2 class="block w-full py-2 text-center text-white bg-primary border border-primary rounded">
            Email tidak terdaftar, cek email anda kembali. </h2>
            ');
        } else if($cek->password==$password){
            $data = array(
                'id_pelanggan'  => $cek->id_pelanggan,
                'nama'          => $cek->nama,
                'alamat'        => $cek->alamat,
                'telp'          => $cek->telp,
                'password'      => $cek->password,
                'email'         => $cek->email,
                'login'         => 'Frontend'
            );
            $this->session->set_userdata($data);
            redirect('produk');
        } else {
            $this->session->set_flashdata('notifikasi','
            <h2 class="block w-full py-2 text-center text-white bg-primary border border-primary rounded">
            Password yang dimasukan salah. </h2>
            ');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}