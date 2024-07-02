<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
class Produk extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level')!=='Admin'){
			redirect('home');
		}
	}
	public function index(){
        $this->db->select('*')->from('produk a')->join('kategori b','a.id_kategori=b.id_kategori','left');
        $this->db->order_by('a.nama','ASC');
        $user = $this->db->get()->result_array();
		$data = array(
			'judul_halaman' => 'Produk',
            'user'          => $user,
            'kategori'      => $this->View_model->get_kategori()
		);
		$this->template->load('temp','produk_index',$data);
	}
    public function kategori($id_kategori){
        $this->db->select('*')->from('produk a')->join('kategori b','a.id_kategori=b.id_kategori','left');
        $this->db->order_by('a.nama','ASC')->where('a.id_kategori',$id_kategori);
        $user = $this->db->get()->result_array();
		$data = array(
			'judul_halaman' => 'Produk',
            'user'          => $user,
            'kategori'      => $this->View_model->get_kategori()
		);
		$this->template->load('temp','produk_index',$data);
	}
    public function simpan(){
        $this->db->from('produk')->where('kode_produk',$this->input->post('kode_produk'));
        $cek = $this->db->get()->result_array();
        if($cek==NULL){
            date_default_timezone_set("Asia/Jakarta");
            $namafoto = date('YmdHis').'.jpg';
            $config['upload_path']          = 'assets/produk/';
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
                'kode_produk'  => $this->input->post('kode_produk'),
                'stok'         => $this->input->post('stok'),
                'nama'         => $this->input->post('nama'),
                'harga'        => $this->input->post('harga'),
                'id_kategori'  => $this->input->post('id_kategori'),
                'jenis'        => $this->input->post('jenis'),
                'foto'         => $namafoto,
            );
            $this->db->insert('produk',$data);
            $this->session->set_flashdata('notifikasi','
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk berhasil ditambahkan.</div>
            ');
        } else {
            $this->session->set_flashdata('notifikasi','
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Kode produk sudah digunakan, silahkan ulangi lagi.</div>
            ');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function hapus($id_produk){
        $namafile = $this->View_model->get_produk_foto($id_produk);
        $filename=FCPATH.'/assets/produk/'.$namafile;
        if (file_exists($filename)){
            unlink("./assets/produk/".$namafile);
        }
        $where = array('id_produk'   => $id_produk );
        $this->db->delete('produk',$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk sudah dihapus.</div>
        ');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function update(){
        date_default_timezone_set("Asia/Jakarta");
        $namafoto = $this->View_model->get_produk_foto($this->input->post('id_produk'));
        $config['upload_path']          = 'assets/produk/';
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
            'kode_produk'  => $this->input->post('kode_produk'),
            'stok'         => $this->input->post('stok'),
            'nama'         => $this->input->post('nama'),
            'harga'        => $this->input->post('harga'),
            'id_kategori'  => $this->input->post('id_kategori'),
            'jenis'        => $this->input->post('jenis'),
        );
        $where = array('id_produk'   => $this->input->post('id_produk') );
        $this->db->update('produk',$data,$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk berhasil diperbarui.</div>
        ');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function import_excel()	{
        $file_mimes = array(
            'application/octet-stream', 
            'application/vnd.ms-excel', 
            'application/x-csv', 
            'text/x-csv', 
            'text/csv', 
            'application/csv', 
            'application/excel', 
            'application/vnd.msexcel', 
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['file']['name']);
            $extension = end($arr_file);
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            for($i = 1;$i < count($sheetData);$i++){
                $kode_produk = $sheetData[$i]['0'];
                $nama = $sheetData[$i]['1'];
                $stok = $sheetData[$i]['2'];
                $harga = $sheetData[$i]['3'];
                $ceknomor = $this->db->where('kode_produk', $kode_produk)->count_all_results('produk');
                if ($ceknomor > 0) {
                    $this->session->set_flashdata('notifikasi','
                    <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Gagal melakukan import pada produk '.$nama.' dikarenakan
                    kode produk '.$kode_produk.' sudah digunakan. Cek kembali data excel.</div>
                    ');
                    redirect('produk');
                } 
                $data = array(
                    'nama'              => $nama,
                    'harga'             => $harga,
                    'stok'              => $stok,
                    'kode_produk'       => $kode_produk,
                    );  
                $this->db->Insert('produk', $data);
            }
            $this->session->set_flashdata('notifikasi','
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Berhasil melakukan import.</div>
            ');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('notifikasi','
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">File yang dipilih tidak valid. Pilih file excel yang disediakan untuk mengimport data..</div>
            ');
            redirect($_SERVER['HTTP_REFERER']);
        }
	}
}
