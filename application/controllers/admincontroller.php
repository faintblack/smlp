<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('logincontroller');
		} else {
			if ($this->session->userdata('hak_akses') != 'Admin') {
				redirect('logoutcontroller');
			}
		}
		$this->load->model('Pengguna');
	} 

	public function index(){
		$this->template->load('static','admin/dashboard');
	}

	public function pengguna(){
		$pengguna = $this->Pengguna->select()->result();
		$data = array('data_pengguna' => $pengguna);
		$this->template->load('static','admin/pengguna', $data);
	}

	public function tambahPengguna(){
		$data = array('nama_pengguna' => $this->input->post('nama_pengguna', TRUE), 'username' => $this->input->post('username', TRUE), 'password' => md5($this->input->post('password', TRUE)), 'hak_akses' => $this->input->post('hak_akses', TRUE));

		$insert = $this->Pengguna->insert($data);
		if ($insert) {
			$this->session->set_flashdata('tambah_pengguna_1','Data pengguna berhasil ditambahkan');
		} else {
			$this->session->set_flashdata('tambah_pengguna_0','Data pengguna tidak berhasil ditambahkan, username sudah digunakan');
		}
		redirect('admincontroller/pengguna');
	}

	public function editPengguna(){
		$username = array('username' => $this->input->post('username', TRUE));
		if ($this->input->post('new_password', TRUE)) {
			$data = array('nama_pengguna' => $this->input->post('nama_pengguna', TRUE), 'password' => md5($this->input->post('new_password', TRUE)), 'hak_akses' => $this->input->post('hak_akses', TRUE));
		} else {
			$data = array('nama_pengguna' => $this->input->post('nama_pengguna', TRUE), 'hak_akses' => $this->input->post('hak_akses', TRUE));
		}

		$update = $this->Pengguna->update($username, $data);
		if ($update) {
			$this->session->set_flashdata('edit_pengguna_1','Data pengguna berhasil diupdate');
		} else {
			$this->session->set_flashdata('edit_pengguna_0','Data pengguna tidak berhasil diupdate, silahkan coba lagi');
		}
		redirect('admincontroller/pengguna');
	}

	public function hapusPengguna($username){
		$id = array('username' => $username);

		$delete = $this->Pengguna->delete($id);
		
		if ($delete) {
			$this->session->set_flashdata('hapus_pengguna_1','Data pengguna berhasil dihapus');
		} else {
			$this->session->set_flashdata('hapus_pengguna_0','Data pengguna tidak berhasil dihapus, silahkan coba lagi');
		}
		redirect('admincontroller/pengguna');
	}

}
