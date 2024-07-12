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
    public function checkout(){
        $site = $this->Konfigurasi_model->listing();
        $data = array(
            'title'                 => 'Checkout | '.$site['nama_cv'],
            'site'                  => $site,
            'keranjang'             => $this->View_model->get_keranjang($this->session->userdata('id_pelanggan'))
        );
        $this->load->view('public/customerCheckout',array_merge($data));
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
    public function bayar(){ 
		$bayar = $this->input->post('bayar');
		$total_bayar = $this->input->post('total_harga');
		$id_pelanggan = $this->session->userdata('id_pelanggan');
		//bagian pembuatan nota
		date_default_timezone_set("Asia/Jakarta");
		$tanggal = date('Y-m');
		$this->db->from('penjualan')->where("DATE_FORMAT(tanggal,'%Y-%m')", $tanggal);
		$jumlah = $this->db->count_all_results();
		$nota = date('ymd')."0".$id_pelanggan."0".$jumlah+1;
		$config['upload_path']          = 'assets/bukti/';
		$config['max_size'] = 500 * 1024; //3 * 1024 * 1024; //3Mb; 0=unlimited
		$config['allowed_types']        = '*';
		$config['overwrite']            = TRUE;
		$config['file_name']            = $nota.".jpg";
		$this->load->library('upload', $config);
		if($_FILES['bukti']['size'] >= 500 * 1024){
			$this->session->set_flashdata('notifikasi','
			<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Ukuran foto terlalu besar, upload dibawah ukuran 500 KB.</div>
			');
			redirect($_SERVER['HTTP_REFERER']);
		}  elseif( ! $this->upload->do_upload('bukti')){
			$error = array('error' => $this->upload->display_errors());
		}else{
			$data = array('upload_data' => $this->upload->data());
		} 
		$this->db->from('temp a');
		$this->db->join('produk b','a.id_produk=b.id_produk','left');
		$this->db->where('a.id_user',$this->session->userdata('id_user'));
		$this->db->where('a.id_pelanggan',$this->input->post('id_pelanggan'));
		$temp = $this->db->get()->result_array();
		$total = 0; //nilai awal
		foreach($temp as $row){
			if($row['stok']<$row['jumlah']){ //jika ada produk yang stok kurang langsung pindah ke halaman transaksi
				$this->session->set_flashdata('notifikasi','
				<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Produk dipilih tidak mencukupi.</div>
				');
				redirect($_SERVER["HTTP_REFERER"]);
			}
			$total = $total+$row['jumlah']*$row['harga'];
			
			$data = array (
				'kode_penjualan' => $nota,
				'id_produk' => $row['id_produk'],
				'jumlah' => $row['jumlah'],
				'sub_total ' => $row['jumlah']*$row['harga'],
			);
			$this->db->insert('detail_penjualan',$data); //input ke tabel detail penjualan 
			
			$data2 = array( 'stok' => $row['stok']-$row['jumlah']);
			$where = array( 'id_produk' => $row['id_produk']);
			$this->db->update('produk',$data2,$where); //update tabel produk stoknya
			
			$where2 = array(
				'id_user'		=> $this->session->userdata('id_user'),
				'id_pelanggan'	=> $this->input->post('id_pelanggan')
			);
			$this->db->delete('temp',$where2); //hapus dari tabel temp 
		}
		//bagian input ke tabel penjualan
		$data = array(
			'kode_penjualan' 	=> $nota,
			'total_harga'		=> $total,
			'bayar'				=> $this->input->post('bayar'),
			'id_pelanggan'		=> $this->input->post('id_pelanggan'),
			'pembayaran'		=> $this->input->post('pembayaran'),
			'bukti'				=> $nota.'.jpg',
			'transaksi'			=> 'Offline',
			'status'			=> 'selesai',
			'tanggal'			=> date('Y-m-d'),
		);
		$this->db->insert('penjualan',$data);
		$this->session->set_flashdata('notifikasi','
		<div class="rounded-md px-5 py-4 mb-2 bg-theme-1 text-white">Penjualan berhasil.</div>
		');
		redirect('admin/penjualan/invoice/'.$nota);
	}
}