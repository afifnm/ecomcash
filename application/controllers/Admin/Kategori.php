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
		$data = array(
			'judul_halaman' => 'kategori',
            'user'          => $this->View_model->get_kategori()
		);
		$this->template->load('temp','kategori_index',$data);
	}
    public function simpan(){
        $this->db->from('kategori')->where('slug',create_slug($this->input->post('kategori')));
        $cek = $this->db->get()->result_array();
        if($cek<>NULL){
            $this->session->set_flashdata('notifikasi','
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Kategori produk sudah ada</div>
            ');
            redirect($_SERVER['HTTP_REFERER']);            
        }
        date_default_timezone_set("Asia/Jakarta");
        $namafoto = date('YmdHis').'.jpg';
        $config['upload_path']          = 'assets/kategori/';
        $config['max_size'] = 500 * 1024; //3 * 1024 * 1024; //3Mb; 0=unlimited
        $config['allowed_types']        = '*';
        $config['overwrite']            = TRUE;
        $config['file_name']            = $namafoto;
        $this->load->library('upload', $config);
        if($_FILES['foto']['size'] >= 500 * 1024){
            $this->session->set_flashdata('notifikasi','
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Ukuran foto terlalu besar, upload dibawah ukuran 500 KB.</div>
            ');
            redirect($_SERVER['HTTP_REFERER']);
        }  elseif( ! $this->upload->do_upload('foto')){
            $error = array('error' => $this->upload->display_errors());
        }else{
            $data = array('upload_data' => $this->upload->data());
        }   
        $data = array(
            'kategori'  => $this->input->post('kategori'),
            'slug'      => create_slug($this->input->post('kategori')),
            'foto'      => $namafoto,
        );
        $this->db->insert('kategori',$data);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Kategori produk berhasil disimpan</div>
        ');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function hapus($id_kategori){
        $namafile = $this->View_model->get_kategori_foto($id_kategori);
        $filename=FCPATH.'/assets/kategori/'.$namafile;
        if (file_exists($filename)){
            unlink("./assets/kategori/".$namafile);
        }
        $where = array('id_kategori'   => $id_kategori );
        $this->db->delete('kategori',$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Kategori berhasil dihapus</div>
        ');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function update(){
        $namafoto = $this->View_model->get_kategori_foto($this->input->post('id_kategori'));
        $config['upload_path']          = 'assets/kategori/';
        $config['max_size'] = 500 * 1024; //3 * 1024 * 1024; //3Mb; 0=unlimited
        $config['allowed_types']        = '*';
        $config['overwrite']            = TRUE;
        $config['file_name']            = $namafoto;
        $this->load->library('upload', $config);
        if($_FILES['foto']['size'] >= 500 * 1024){
            $this->session->set_flashdata('notifikasi','
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Ukuran foto terlalu besar, upload dibawah ukuran 500 KB.</div>
            ');
            redirect($_SERVER['HTTP_REFERER']);
        }  elseif( ! $this->upload->do_upload('foto')){
            $error = array('error' => $this->upload->display_errors());
        }else{
            $data = array('upload_data' => $this->upload->data());
        }   
        $data = array(
            'kategori'  => $this->input->post('kategori'),
            'slug'      => create_slug($this->input->post('kategori')),
        );
        $where = array('id_kategori'   => $this->input->post('id_kategori') );
        $this->db->update('kategori',$data,$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Kategori berhasil diperbarui</div>
        ');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
