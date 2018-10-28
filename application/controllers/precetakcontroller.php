<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class PreCetakController extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('logincontroller');
		} else {
			if ($this->session->userdata('hak_akses') != 'Pre Cetak') {
				redirect('logoutcontroller');
			}
		}
		$this->load->model('Pre_Cetak');
		$this->load->model('Percetakan');
	} 

	public function index(){
		$this->load->model('Pengguna');
		$user = $this->session->userdata();
		$pengguna = $this->Pengguna->select()->result();

		$data = array('data_pengguna' => $pengguna, 'data_user' => $user);
		$this->template->load('static','precetak/dashboard', $data);
	}

	public function status(){
		$pre_cetak = $this->Pre_Cetak->select()->result();

		$data = array('data_pre_cetak' => $pre_cetak);
		$this->template->load('static','precetak/status', $data);
	}

	public function tambahProses(){
		$tanggal = substr(date('Y-m-d'), 8, 2);
		$bulan = substr(date('Y-m-d'), 5, 2);
		$tahun = substr(date('Y-m-d'), 0, 4);
		$tanggal_mantap = $tahun.'-'.$bulan.'-'.$tanggal;

		// CEK DATA PERCETAKAN
			$where_p = array('tanggal' => $tanggal_mantap, 'nama_koran' => $this->input->post('nama_koran', TRUE));
			$check_p = $this->Percetakan->get($where_p)->result();

			// JIKA BELUM ADA DATA PERCETAKAN
			if (count($check_p) == 0) {
				// INPUT DATA PERCETAKAN
				$input_p = array('tanggal' => $tanggal_mantap, 'nama_koran' => ucwords($this->input->post('nama_koran', TRUE)));
				$insert = $this->Percetakan->insert($input_p);
			}

		$data_p = $this->Percetakan->get($where_p)->result();

		if ($this->input->post('status', TRUE) == 'Menunggu') {
			$mulai = '00:00:00';
		} else {
			$mulai = date('H:i:s');
		}
		
		$data_pc = array('username' => $this->input->post('user'), 'id_percetakan' => $data_p[0]->id_percetakan, 'sesi' => $this->input->post('sesi', TRUE), 'jam_masuk_pre_cetak' => $mulai, 'jam_selesai_pre_cetak' => '00:00:00', 'sumber_berita' => ucwords($this->input->post('sumber_berita', TRUE)), 'penerima_berita' => ucwords($this->input->post('penerima_berita', TRUE)), 'status' => ucwords( $this->input->post('status', TRUE)));

		// JIKA DATA PRE CETAK TELAH DIINPUTKAN SEBELUMNYA
			$where = array('b.id_percetakan' => $data_p[0]->id_percetakan, 'sesi' => $this->input->post('sesi', TRUE));

			$check = $this->Pre_Cetak->get($where)->result();
			
			if (count($check) != 0) {
				$this->session->set_flashdata('tambah_precetak_2','Aktivitas baru tidak berhasil ditambahkan, aktivitas sudah diinputkan sebelumnya');
				redirect('precetakcontroller/status');
			}

		$insert = $this->Pre_Cetak->insert($data_pc);

		if ($insert) {
			$this->session->set_flashdata('tambah_precetak_1','Aktivitas baru berhasil ditambahkan');
		} else {
			$this->session->set_flashdata('tambah_precetak_0','Aktivitas baru tidak berhasil ditambahkan, silahkan coba lagi');
		}
		redirect('precetakcontroller/status');
	}

	public function editProses(){
		$tanggal = substr($this->input->post('tanggal', TRUE), 3, 2);
		$bulan = substr($this->input->post('tanggal', TRUE), 0, 2);
		$tahun = substr($this->input->post('tanggal', TRUE), 6, 4);

		$tanggal_mantap = $tahun.'-'.$bulan.'-'.$tanggal;

		$id_pc = array('id_pre_cetak' => $this->input->post('id_pre_cetak', TRUE)); 
		$id_p = array('b.id_percetakan' => $this->input->post('id_percetakan', TRUE));

		// JIKA GANTI TANGGAL ATAU NAMA KORAN
			if (($this->input->post('tanggal-old', TRUE) != $this->input->post('tanggal', TRUE)) || ($this->input->post('nama_koran-old', TRUE) != $this->input->post('nama_koran', TRUE))) {
				$data_p = array('tanggal' => $tanggal_mantap, 'nama_koran' => $this->input->post('nama_koran', TRUE));
				$check_p = $this->Percetakan->get($data_p)->result();

				// JIKA BELUM ADA TANGGAL DAN NAMA KORAN, MAKA EDIT DATA PERCETAKAN
				if (count($check_p) == 0) {
					$id_p = array('id_percetakan' => $this->input->post('id_percetakan', TRUE));
					$update_p = $this->Percetakan->update($id_p, $data_p);					
					if ($update_p) {
						$id_p = array('b.id_percetakan' => $this->input->post('id_percetakan', TRUE) );
					} 
				} 
				// JIKA SUDAH ADA MUNCUL NOTIFIKASI GAGAL UPDATE AKTIVITAS
				else {
					$this->session->set_flashdata('edit_pre_cetak_0','Data aktivitas tidak berhasil diupdate, silahkan coba lagi');
					redirect('precetakcontroller/status');
				}
			}

		$data_pc_check = $this->Pre_Cetak->get($id_p)->result();
		// DATA INPUT 
			switch ($this->input->post('status', TRUE)) {
				case 'Menunggu':
					$data = array('id_percetakan' => $id_p['b.id_percetakan'], 'sesi' => $this->input->post('sesi', TRUE), 'sumber_berita' => $this->input->post('sumber_berita', TRUE), 'penerima_berita' => $this->input->post('penerima_berita', TRUE), 'status' => $this->input->post('status', TRUE), 'username' => $this->input->post('user', TRUE));
				break;

				case 'Proses':
					$mulai = date('H:i:s');
					$data = array('id_percetakan' => $id_p['b.id_percetakan'], 'sesi' => $this->input->post('sesi', TRUE), 'jam_masuk_pre_cetak' => $mulai, 'sumber_berita' => $this->input->post('sumber_berita', TRUE), 'penerima_berita' => $this->input->post('penerima_berita', TRUE), 'status' => $this->input->post('status', TRUE), 'username' => $this->input->post('user', TRUE));
				break;

				case 'Selesai':
					$selesai = date('H:i:s');
					$data = array('id_percetakan' => $id_p['b.id_percetakan'], 'sesi' => $this->input->post('sesi', TRUE), 'jam_selesai_pre_cetak' => $selesai, 'sumber_berita' => $this->input->post('sumber_berita', TRUE), 'penerima_berita' => $this->input->post('penerima_berita', TRUE), 'status' => $this->input->post('status', TRUE), 'username' => $this->input->post('user', TRUE));
				break;
			}

		// UPDATE DATA PRE CETAK
			// JIKA SESI DIUBAH
			if ($this->input->post('sesi', TRUE) != $this->input->post('sesi-old', TRUE)) {
				foreach ($data_pc_check as $v) {
					// JIKA SESI BARU SUDAH ADA PADA DATABASE
					if ($v->sesi == $this->input->post('sesi', TRUE)) {
						$this->session->set_flashdata('edit_pre_cetak_2','Data aktivitas tidak berhasil diupdate, sesi sudah diinputkan sebelumnya');
						redirect('precetakcontroller/status');
					}
				}

				$update_pc = $this->Pre_Cetak->update($id_pc, $data);					
				if ($update_pc) {
					$this->session->set_flashdata('edit_pre_cetak_1','Data aktivitas berhasil diupdate');
				} else {
					$this->session->set_flashdata('edit_pre_cetak_0','Data aktivitas tidak berhasil diupdate, silahkan coba lagi');
				}
				redirect('precetakcontroller/status');

			} else {
				$update_pc = $this->Pre_Cetak->update($id_pc, $data);					
				if ($update_pc) {
					$this->session->set_flashdata('edit_pre_cetak_1','Data aktivitas berhasil diupdate');
				} else {
					$this->session->set_flashdata('edit_pre_cetak_1','Data aktivitas berhasil diupdate');
				}
				redirect('precetakcontroller/status');
			}
	}

	public function laporan(){
		$percetakan = $this->Percetakan->select()->result();
		$pre_cetak = $this->Pre_Cetak->select()->result();

		$data = array('data_percetakan' => $percetakan, 'data_pre_cetak' => $pre_cetak);
		$this->template->load('static','precetak/laporan', $data);
	}

}
