<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	
	public function __construct(){
		parent:: __construct();
		if ($this->session->userdata('isLogin') == TRUE) {
			switch ($this->session->userdata('hak_akses')) {
				case 'Admin':
					redirect('admincontroller');
				break;
				
				case 'Pimpinan':
					redirect('pimpinancontroller');
				break;

				case 'Pre Cetak':
					redirect('precetakcontroller');
				break;

				case 'Cetak':
					redirect('cetakcontroller');
				break;

				case 'Finishing':
					redirect('finishingcontroller');
				break;

			}
		}
		$this->load->model('Pengguna');
	} 

	public function index(){
		$this->load->view('LoginView');
	}

	public function verifikasi(){
		$data = array('username' => $this->input->post('username', TRUE), 'password' => md5($this->input->post('password', TRUE)));
		$cek = $this->Pengguna->validasi($data)->result();

		if (count($cek) == 1) {
			foreach ($cek as $v) {
				$session_data['isLogin'] = TRUE;
				$session_data['username'] = $v->username;
				$session_data['nama_pengguna'] = $v->nama_pengguna;
				$session_data['hak_akses'] = $v->hak_akses;
				$this->session->set_userdata($session_data);
			}
			
			switch ($this->session->userdata('hak_akses')) {
				case 'Admin':
					redirect('admincontroller');
				break;

				case 'Pimpinan':
					redirect('pimpinancontroller');
				break;

				case 'Pre Cetak':
					redirect('precetakcontroller');
				break;

				case 'Cetak':
					redirect('cetakcontroller');
				break;

				case 'Finishing':
					redirect('finishingcontroller');
				break;
			}
		} else {
			echo "<script>alert('Username atau password anda salah. Silahkan login kembali');history.go(-1);</script>";
		}
	}
}
