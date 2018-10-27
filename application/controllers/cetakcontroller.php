<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class CetakController extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('logincontroller');
		} else {
			if ($this->session->userdata('hak_akses') != 'Cetak') {
				redirect('logoutcontroller');
			}
		}
		$this->load->model('Cetak');
		$this->load->model('Percetakan');
	} 

	public function index(){
		$this->load->model('Pengguna');
		$user = $this->session->userdata();
		$pengguna = $this->Pengguna->select()->result();

		$data = array('data_pengguna' => $pengguna, 'data_user' => $user);
		$this->template->load('static','cetak/dashboard', $data);
	}

	public function status(){
		$this->load->model('Pre_Cetak');
		$pre_cetak = $this->Pre_Cetak->selectGroup()->result();
		$cetak = $this->Cetak->select()->result();

		$data = array('data_pre_cetak' => $pre_cetak, 'data_cetak' => $cetak);
		$this->template->load('static','cetak/status', $data);
	}

	public function tambahProses(){
		$tanggal = substr(date('Y-m-d'), 8, 2);
		$bulan = substr(date('Y-m-d'), 5, 2);
		$tahun = substr(date('Y-m-d'), 0, 4);
		$tanggal_mantap = $tahun.'-'.$bulan.'-'.$tanggal;

		// CEK DATA PERCETAKAN
			$where_p = array('tanggal' => $tanggal_mantap, 'nama_koran' => ucwords($this->input->post('nama_koran', TRUE)) );
			$check_p = $this->Percetakan->get($where_p)->result();
			
			// JIKA BELUM ADA DATA PERCETAKAN
			if (count($check_p) == 0) {
				// PERINGATAN BELUM ADA DATA PRECETAK
				$this->session->set_flashdata('tambah_cetak_3','Aktivitas baru tidak berhasil ditambahkan, aktivitas belum dimulai oleh divisi pre cetak');
				redirect('cetakcontroller/status');
			}

		$data_p = $this->Percetakan->get($where_p)->result();

		if ($this->input->post('status', TRUE) == 'Menunggu') {
			$mulai = '00:00:00';
		} else {
			$mulai = date('H:i:s');
		}

		$data = array('username' => $this->input->post('user'), 'id_percetakan' => $data_p[0]->id_percetakan, 'sesi' => $this->input->post('sesi', TRUE), 'jam_masuk_cetak' => $mulai, 'jam_selesai_cetak' => '00:00:00', 'jumlah_cetak' => $this->input->post('jumlah_cetak', TRUE), 'status' => ucwords($this->input->post('status', TRUE)) );
		
		// JIKA DATA CETAK TELAH DIINPUTKAN SEBELUMNYA
			$where = array('b.id_percetakan' => $data_p[0]->id_percetakan, 'sesi' => $this->input->post('sesi', TRUE));

			$check = $this->Cetak->get($where)->result();
			
			if (count($check) != 0) {
				$this->session->set_flashdata('tambah_cetak_2','Aktivitas baru tidak berhasil ditambahkan, aktivitas sudah diinputkan sebelumnya');
				redirect('cetakcontroller/status');
			}

		$insert = $this->Cetak->insert($data);

		if ($insert) {
			$this->session->set_flashdata('tambah_cetak_1','Aktivitas baru berhasil ditambahkan');
		} else {
			$this->session->set_flashdata('tambah_cetak_0','Aktivitas baru tidak berhasil ditambahkan, silahkan coba lagi');
		}
		redirect('cetakcontroller/status');
	}

	public function editProses(){
		$tanggal = substr($this->input->post('tanggal', TRUE), 3, 2);
		$bulan = substr($this->input->post('tanggal', TRUE), 0, 2);
		$tahun = substr($this->input->post('tanggal', TRUE), 6, 4);

		$tanggal_mantap = $this->input->post('tanggal', TRUE);

		$id_c = array('id_cetak' => $this->input->post('id_cetak', TRUE)); 
		$id_p = array('b.id_percetakan' => $this->input->post('id_percetakan', TRUE));

		// JIKA GANTI NAMA KORAN
			if ($this->input->post('nama_koran-old', TRUE) != $this->input->post('nama_koran', TRUE)) {
				$data_p = array('tanggal' => $tanggal_mantap, 'nama_koran' => $this->input->post('nama_koran', TRUE));
				$check_p = $this->Percetakan->get($data_p)->result();

				$data_c = array('id_percetakan' => $check_p[0]->id_percetakan);

				// UPDATE ID PERCETAKAN
				$update_c = $this->Cetak->update($id_c, $data_c);
				if ($update_c) {
					$id_p = array('b.id_percetakan' => $check_p[0]->id_percetakan );
				} else {
					$this->session->set_flashdata('edit_cetak_0','Data aktivitas tidak berhasil diupdate, silahkan coba lagi');
					redirect('precetakcontroller/status');
				}				
			}

		$data_c_check = $this->Cetak->get($id_p)->result();
		// DATA INPUT 
			switch ($this->input->post('status', TRUE)) {
				case 'Menunggu':
					$data = array('id_percetakan' => $id_p['b.id_percetakan'], 'sesi' => $this->input->post('sesi', TRUE), 'jumlah_cetak' => $this->input->post('jumlah_cetak', TRUE), 'status' => $this->input->post('status', TRUE), 'username' => $this->input->post('user', TRUE));
				break;

				case 'Proses':
					$mulai = date('H:i:s');
					$data = array('id_percetakan' => $id_p['b.id_percetakan'], 'sesi' => $this->input->post('sesi', TRUE), 'jam_masuk_cetak' => $mulai, 'jumlah_cetak' => $this->input->post('jumlah_cetak', TRUE), 'status' => $this->input->post('status', TRUE), 'username' => $this->input->post('user', TRUE));
				break;

				case 'Selesai':
					$selesai = date('H:i:s');
					$data = array('id_percetakan' => $id_p['b.id_percetakan'], 'sesi' => $this->input->post('sesi', TRUE), 'jam_selesai_pre_cetak' => $selesai, 'jumlah_cetak' => $this->input->post('jumlah_cetak', TRUE), 'status' => $this->input->post('status', TRUE), 'username' => $this->input->post('user', TRUE));
				break;
			}
		print_r($this->input->post('sesi', TRUE));exit();

		// UPDATE DATA CETAK
			// JIKA SESI DIUBAH
			if ($this->input->post('sesi-old', TRUE) != $this->input->post('sesi', TRUE)) {
				// JIKA SESI BARU SUDAH ADA PADA DATABASE
					foreach ($data_c_check as $v) {					
						if ($v->sesi == $this->input->post('sesi', TRUE)) {
							$this->session->set_flashdata('edit_cetak_2','Data aktivitas tidak berhasil diupdate, sesi sudah diinputkan sebelumnya');
							redirect('precetakcontroller/status');
						}
					}

				$update_c = $this->Cetak->update($id_c, $data);
			}

		/*-------------------------------------------------------------*/

		$data = array('tanggal' => $tanggal_mantap, 'nama_koran' => $this->input->post('nama_koran', TRUE), 'sesi' => $this->input->post('sesi', TRUE), 'jam_masuk_cetak' => $mulai, 'jam_selesai_cetak' => $selesai, 'jumlah_cetak' => $this->input->post('jumlah_cetak', TRUE), 'status' => $this->input->post('status', TRUE));

		// JIKA DATA TELAH DIINPUTKAN SEBELUMNYA
			if (($this->input->post('sesi-old', TRUE) != $this->input->post('sesi', TRUE)) || ($this->input->post('tanggal-old', TRUE) != $this->input->post('tanggal', TRUE)) || ($this->input->post('nama_koran-old', TRUE) != $this->input->post('nama_koran', TRUE)) ) {
				$where = array('tanggal' => $tanggal_mantap, 'nama_koran' => $this->input->post('nama_koran', TRUE), 'sesi' => $this->input->post('sesi', TRUE));

				$check = $this->Cetak->get($where)->result();
				
				if (count($check) != 0) {
					$this->session->set_flashdata('edit_cetak_2','Data aktivitas tidak berhasil diupdate, aktivitas sudah diinputkan sebelumnya');
					redirect('cetakcontroller/status');
				}
			}

		$update = $this->Cetak->update($id, $data);

		if ($update) {
			$this->session->set_flashdata('edit_cetak_1','Data aktivitas berhasil diupdate');
		} else {
			$this->session->set_flashdata('edit_cetak_0','Data aktivitas tidak berhasil diupdate, silahkan coba lagi');
		}
		redirect('cetakcontroller/status');
	}

	public function laporan(){
		$cetak = $this->Cetak->selectGroup()->result();
		$cetak_all = $this->Cetak->select()->result();

		$data = array('data_cetak' => $cetak, 'data_cetak_all' => $cetak_all);
		$this->template->load('static','cetak/laporan', $data);
	}

}
