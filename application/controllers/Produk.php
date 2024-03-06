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
        $this->db->select('*')->from('produk');
        $this->db->order_by('nama','ASC');
        $user = $this->db->get()->result_array();
		$data = array(
			'judul_halaman' => 'Produk',
            'user'          => $user
		);
		$this->template->load('temp','produk_index',$data);
	}
    public function foto($id){
        $this->db->select('*')->from('produk');
        $this->db->where('id_produk',$id);
        $user = $this->db->get()->result_array();
		$data = array(
			'judul_halaman' => 'Foto Produk',
            'user'          => $user
		);
		$this->template->load('temp','produk_pict',$data);
	}
    public function simpan(){
        $this->db->from('produk')->where('kode_produk',$this->input->post('kode_produk'));
        $cek = $this->db->get()->result_array();
        if($cek==NULL){
            $data = array(
                'kode_produk'  => $this->input->post('kode_produk'),
                'stok'         => $this->input->post('stok'),
                'nama'         => $this->input->post('nama'),
                'harga'        => $this->input->post('harga'),
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
        redirect('produk');
    }
    public function hapus($id_produk){
        $where = array('id_produk'   => $id_produk );
        $this->db->delete('produk',$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk sudah dihapus.</div>
        ');
        redirect('produk');
    }
    public function update(){
        $data = array(
            'kode_produk'  => $this->input->post('kode_produk'),
            'stok'         => $this->input->post('stok'),
            'nama'         => $this->input->post('nama'),
            'harga'        => $this->input->post('harga'),
        );
        $where = array('id_produk'   => $this->input->post('id_produk') );
        $this->db->update('produk',$data,$where);
        $this->session->set_flashdata('notifikasi','
        <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk berhasil diperbarui.</div>
        ');
        redirect('produk');
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
            redirect('produk');
        } else {
            $this->session->set_flashdata('notifikasi','
            <div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">File yang dipilih tidak valid. Pilih file excel yang disediakan untuk mengimport data..</div>
            ');
            redirect('produk');
        }
	}
}
