<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class FinishingController extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login');
		} else {
			if ($this->session->userdata('hak_akses') != 'Finishing') {
				redirect('logout');
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
		$tanggal = substr(date('Y-m-d'), 8, 2);
		$bulan = substr(date('Y-m-d'), 5, 2);
		$tahun = substr(date('Y-m-d'), 0, 4);
		$tanggal_mantap = $tahun.'-'.$bulan.'-'.$tanggal;

		// AMBIL ID PERCETAKAN
			$where_p = array('tanggal' => $tanggal_mantap, 'nama_koran' => ucwords($this->input->post('nama_koran', TRUE)) );
			$data_p = $this->Percetakan->get($where_p)->result();
			
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
		$tanggal = substr($this->input->post('tanggal', TRUE), 3, 2);
		$bulan = substr($this->input->post('tanggal', TRUE), 0, 2);
		$tahun = substr($this->input->post('tanggal', TRUE), 6, 4);

		$tanggal_mantap = $this->input->post('tanggal', TRUE);

		$id_f = array('id_finishing' => $this->input->post('id_finishing', TRUE)); ;
		$id_p = array('b.id_percetakan' => $this->input->post('id_percetakan', TRUE));

		// JIKA GANTI NAMA KORAN (BAGAIMANA JIKA NAMA KORAN BARU SUDAH DIINPUTKAN)
			if ($this->input->post('nama_koran-old', TRUE) != $this->input->post('nama_koran', TRUE)) {
				$data_p = array('tanggal' => $tanggal_mantap, 'nama_koran' => $this->input->post('nama_koran', TRUE));
				$check_p = $this->Percetakan->get($data_p)->result();

				// CEK APAKAH AKTIVITAS BARU SUDAH ADA PADA TABEL FINISHING
					$check_f = $this->Finishing->get(array('b.id_percetakan' => $check_p[0]->id_percetakan))->result();

					// JIKA TIDAK ADA DATA AKTIVITAS YANG SAMA PADA TABEL FINISHING
					if (count($check_f) == 0) {
						$data_f = array('id_percetakan' => $check_p[0]->id_percetakan);

						// GANTI ID PERCETAKAN PADA TABEL FINISHING
						$update_f = $this->Finishing->update($id_f, $data_f);
						if ($update_f) {
							$id_p = array('b.id_percetakan' => $check_p[0]->id_percetakan );
						} else {
							$this->session->set_flashdata('edit_finishing_0','Data aktivitas tidak berhasil diupdate, silahkan coba lagi');
							redirect('finishingcontroller/status');
						}
					} 
					// JIKA ADA
					else {
						$this->session->set_flashdata('edit_finishing_2','Data aktivitas tidak berhasil diupdate, aktivitas sudah diinputkan sebelumnya');
						redirect('finishingcontroller/status');
					}				
			}

		print_r($id_p);exit();
		

		/*---------------------------------------------------------------*/

		$data = array('tanggal' => $tanggal_mantap, 'nama_koran' => $this->input->post('nama_koran', TRUE), 'jam_masuk_finishing' => $mulai, 'jam_selesai_finishing' => $selesai, 'jumlah_edaran' => $this->input->post('jumlah_edaran', TRUE), 'status' => $this->input->post('status', TRUE));

		// JIKA DATA TELAH DIINPUTKAN SEBELUMNYA
			if (($this->input->post('tanggal-old', TRUE) != $this->input->post('tanggal', TRUE)) || ($this->input->post('nama_koran-old', TRUE) != $this->input->post('nama_koran', TRUE)) ) {
				$where = array('tanggal' => $tanggal_mantap, 'nama_koran' => $this->input->post('nama_koran', TRUE));

				$check = $this->Finishing->get($where)->result();
				
				if (count($check) != 0) {
					$this->session->set_flashdata('edit_finishing_2','Data aktivitas tidak berhasil diupdate, aktivitas sudah diinputkan sebelumnya');
					redirect('finishingcontroller/status');
				}
			}

		$update = $this->Finishing->update($id, $data);

		if ($update) {
			$this->session->set_flashdata('edit_finishing_1','Data aktivitas berhasil diupdate');
		} else {
			$this->session->set_flashdata('edit_finishing_0','Data aktivitas tidak berhasil diupdate, silahkan coba lagi');
		}
		redirect('finishingcontroller/status');
	}

	public function laporan(){
		$this->load->model('Cetak');

		$finishing = $this->Finishing->selectGroup()->result();
		$cetak = $this->Cetak->select()->result();

		$data = array('data_finishing' => $finishing, 'data_cetak' => $cetak);
		$this->template->load('static','finishing/laporan', $data);
	}

}
