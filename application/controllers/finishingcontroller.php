<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class FinishingController extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('logincontroller');
		} else {
			if ($this->session->userdata('hak_akses') != 'Finishing') {
				redirect('logoutcontroller');
			}
		}
		$this->load->model('Finishing');
		$this->load->model('Percetakan');
	} 

	public function index(){
		$this->load->model('Pengguna');
		$user = $this->session->userdata();
		$pengguna = $this->Pengguna->select()->result();

		$data = array('data_pengguna' => $pengguna, 'data_user' => $user);
		$this->template->load('static','finishing/dashboard', $data);
	}

	public function status(){
		$this->load->model('Cetak');
		$cetak = $this->Cetak->selectGroup()->result();
		$finishing = $this->Finishing->select()->result();

		$data = array('data_finishing' => $finishing, 'data_cetak' => $cetak);
		$this->template->load('static','finishing/status', $data);
	}

	public function tambahProses(){
		$this->load->model('Cetak');

		$tanggal = substr(date('Y-m-d'), 8, 2);
		$bulan = substr(date('Y-m-d'), 5, 2);
		$tahun = substr(date('Y-m-d'), 0, 4);
		$tanggal_mantap = $tahun.'-'.$bulan.'-'.$tanggal;

		// AMBIL ID PERCETAKAN
			$where_p = array('tanggal' => $tanggal_mantap, 'nama_koran' => ucwords($this->input->post('nama_koran', TRUE)) );
			$data_p = $this->Percetakan->get($where_p)->result();

			$id_p = $data_p[0]->id_percetakan;

		// CEK DATA CETAK (DATA CETAK PASTI ADA, TINGGAL CEK STATUS SESI TERAKHIR)
			$where_c = array('b.id_percetakan' => $id_p);
			$check_c = $this->Cetak->get($where_c)->result();

			$sesi_max = 1;
			foreach ($check_c as $v) {
				if ($v->sesi >= $sesi_max) {
					$sesi_max = $v->sesi;
					$status_c = $v->status;
				}
			}

			if (($status_c != 'Selesai') && ($this->input->post('status', TRUE) == 'Proses')) {
				$this->session->set_flashdata('tambah_finishing_3','Aktivitas baru tidak berhasil ditambahkan, aktivitas divisi cetak belum selesai');
				redirect('finishingcontroller/status');
			}
			
		if ($this->input->post('status', TRUE) == 'Menunggu') {
			$mulai = '00:00:00';
		} else {
			$mulai = date('H:i:s');
		}

		$data = array('username' => $this->input->post('user'), 'id_percetakan' => $data_p[0]->id_percetakan, 'jam_masuk_finishing' => $mulai, 'jam_selesai_finishing' => '00:00:00', 'jumlah_edaran' => $this->input->post('jumlah_edaran', TRUE), 'status' => ucwords($this->input->post('status', TRUE)) );
		

		// JIKA DATA FINISHING TELAH DIINPUTKAN SEBELUMNYA
			$where_p = array('b.id_percetakan' => $data_p[0]->id_percetakan);

			$check_f = $this->Finishing->get($where_p)->result();
			
			if (count($check_f) != 0) {
				$this->session->set_flashdata('tambah_finishing_2','Aktivitas baru tidak berhasil ditambahkan, aktivitas sudah diinputkan sebelumnya');
				redirect('finishingcontroller/status');
			}

		// INPUT DATA FINISHING
			$insert = $this->Finishing->insert($data);

			if ($insert) {
				$this->session->set_flashdata('tambah_finishing_1','Aktivitas baru berhasil ditambahkan');
			} else {
				$this->session->set_flashdata('tambah_finishing_0','Aktivitas baru tidak berhasil ditambahkan, silahkan coba lagi');
			}
			redirect('finishingcontroller/status');
	}

	public function editProses(){
		$this->load->model('Cetak');

		$tanggal = substr($this->input->post('tanggal', TRUE), 3, 2);
		$bulan = substr($this->input->post('tanggal', TRUE), 0, 2);
		$tahun = substr($this->input->post('tanggal', TRUE), 6, 4);

		$tanggal_mantap = $this->input->post('tanggal', TRUE);

		$id_f = array('id_finishing' => $this->input->post('id_finishing', TRUE)); ;
		$id_p = array('id_percetakan' => $this->input->post('id_percetakan', TRUE));

		// JIKA GANTI NAMA KORAN 
			if ($this->input->post('nama_koran-old', TRUE) != $this->input->post('nama_koran', TRUE)) {
				$data_p = array('tanggal' => $tanggal_mantap, 'nama_koran' => $this->input->post('nama_koran', TRUE));
				$check_p = $this->Percetakan->get($data_p)->result();

				// CEK APAKAH AKTIVITAS BARU SUDAH ADA PADA TABEL FINISHING
					$check_f = $this->Finishing->get(array('b.id_percetakan' => $check_p[0]->id_percetakan))->result();

					// JIKA TIDAK ADA DATA AKTIVITAS YANG SAMA PADA TABEL FINISHING
					if (count($check_f) == 0) {
						$data_f = array('id_percetakan' => $check_p[0]->id_percetakan);
												
						// SEBELUM GANTI NAMA KORAN, CEK STATUS TERLEBIH DAHULU
							$where_c = array('b.id_percetakan' => $check_p[0]->id_percetakan);
							$check_c = $this->Cetak->get($where_c)->result();

							$sesi_max = 1;
							foreach ($check_c as $v) {
								if ($v->sesi >= $sesi_max) {
									$sesi_max = $v->sesi;
									$status_c = $v->status;
								}
							}

							if (($status_c != 'Selesai') && ($this->input->post('status', TRUE) == 'Proses')) {
								$this->session->set_flashdata('edit_finishing_3','Aktivitas baru tidak berhasil diupdate, aktivitas divisi cetak belum selesai');
								redirect('finishingcontroller/status');
							}
						
						// GANTI ID PERCETAKAN PADA TABEL FINISHING
						$update_f = $this->Finishing->update($id_f, $data_f);
						if ($update_f) {
							$id_p = array('id_percetakan' => $check_p[0]->id_percetakan );
						}
					} 
					// JIKA ADA
					else {
						$this->session->set_flashdata('edit_finishing_2','Data aktivitas tidak berhasil diupdate, aktivitas sudah diinputkan sebelumnya');
						redirect('finishingcontroller/status');
					}				
			}

		// CEK DATA CETAK (TINGGAL CEK STATUS SESI TERAKHIR DATA CETAK)
			$where_c = array('b.id_percetakan' => $id_p['id_percetakan']);
			$check_c = $this->Cetak->get($where_c)->result();

			$sesi_max = 1;
			foreach ($check_c as $v) {
				if ($v->sesi >= $sesi_max) {
					$sesi_max = $v->sesi;
					$status_c = $v->status;
				}
			}

			if (($status_c != 'Selesai') && ($this->input->post('status', TRUE) == 'Proses')) {
				$this->session->set_flashdata('edit_finishing_3','Aktivitas baru tidak berhasil diupdate, aktivitas divisi cetak belum selesai');
				redirect('finishingcontroller/status');
			}

		// DATA INPUT 
			switch ($this->input->post('status', TRUE)) {
				case 'Menunggu':
					$data = array('id_percetakan' => $id_p['id_percetakan'], 'jam_masuk_finishing' => strtotime('00:00:00'), 'jumlah_edaran' => $this->input->post('jumlah_edaran', TRUE), 'status' => $this->input->post('status', TRUE), 'username' => $this->input->post('user', TRUE));
				break;

				case 'Proses':
					$mulai = date('H:i:s');
					$data = array('id_percetakan' => $id_p['id_percetakan'], 'jam_masuk_finishing' => $mulai, 'jumlah_edaran' => $this->input->post('jumlah_edaran', TRUE), 'status' => $this->input->post('status', TRUE), 'username' => $this->input->post('user', TRUE));
				break;

				case 'Selesai':
					$selesai = date('H:i:s');
					$data = array('id_percetakan' => $id_p['id_percetakan'], 'jam_selesai_finishing' => $selesai, 'jumlah_edaran' => $this->input->post('jumlah_edaran', TRUE), 'status' => $this->input->post('status', TRUE), 'username' => $this->input->post('user', TRUE));
				break;
			}
		
		// UPDATE DATA FINISHING
			// JIKA NAMA KORAN DIUBAH
			$update_x = $this->Finishing->update($id_f, $data);
			if ($update_x) { // SELALU MENAMPILKAN HASIL FALSE
				$this->session->set_flashdata('edit_finishing_1','Data aktivitas berhasil diupdate');
			} else {
				$this->session->set_flashdata('edit_finishing_1','Data aktivitas berhasil diupdate');
			}
			redirect('finishingcontroller/status');
	}

	public function laporan(){
		$this->load->model('Cetak');

		$percetakan = $this->Percetakan->select()->result();
		$finishing = $this->Finishing->select()->result();
		$cetak = $this->Cetak->select()->result();

		$data = array('data_finishing' => $finishing, 'data_cetak' => $cetak, 'data_percetakan' => $percetakan);
		$this->template->load('static','finishing/laporan', $data);
	}

}
