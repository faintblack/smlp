<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
	} 

	public function index(){
		$this->load->model('Pengguna');
		$user = $this->session->userdata();
		$pengguna = $this->Pengguna->select()->result();

		$data = array('data_pengguna' => $pengguna, 'data_user' => $user);
		$this->template->load('static','finishing/dashboard', $data);
	}

	public function status(){
		$finishing = $this->Finishing->select()->result();

		$data = array('data_finishing' => $finishing);
		$this->template->load('static','finishing/status', $data);
	}

	public function tambahProses(){
		$tanggal = substr($this->input->post('tanggal', TRUE), 3, 2);
		$bulan = substr($this->input->post('tanggal', TRUE), 0, 2);
		$tahun = substr($this->input->post('tanggal', TRUE), 6, 4);
		$tanggal_mantap = $tahun.'-'.$bulan.'-'.$tanggal;

		$mulai = $this->input->post('waktu_mulai', TRUE).':00';
		$selesai = $this->input->post('waktu_selesai', TRUE).':00';

		$data = array('tanggal' => $tanggal_mantap, 'nama_koran' => $this->input->post('nama_koran', TRUE), 'jam_masuk_finishing' => $mulai, 'jam_selesai_finishing' => $selesai, 'jumlah_edaran' => $this->input->post('jumlah_edaran', TRUE), 'status' => $this->input->post('status', TRUE));
		
		// JIKA DATA TELAH DIINPUTKAN SEBELUMNYA
			$where = array('tanggal' => $tanggal_mantap, 'nama_koran' => $this->input->post('nama_koran', TRUE));

			$check = $this->Finishing->get($where)->result();
			
			if (count($check) != 0) {
				$this->session->set_flashdata('tambah_finishing_2','Aktivitas baru tidak berhasil ditambahkan, aktivitas sudah diinputkan sebelumnya');
				redirect('finishingcontroller/status');
			}

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

		$tanggal_mantap = $tahun.'-'.$bulan.'-'.$tanggal;
		$mulai = $this->input->post('waktu_mulai', TRUE).':00';
		$selesai = $this->input->post('waktu_selesai', TRUE).':00';

		$id = array('id_finishing' => $this->input->post('id_finishing', TRUE)); ;

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
