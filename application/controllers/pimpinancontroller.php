<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PimpinanController extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('logincontroller');
		} else {
			if ($this->session->userdata('hak_akses') != 'Pimpinan') {
				redirect('logoutcontroller');
			}
		}		
	} 

	public function index(){
		$this->template->load('static','pimpinan/dashboard');
	}

	public function monitoring(){
		$this->load->model('Pre_Cetak');
		$this->load->model('Cetak');
		$this->load->model('Finishing');

		$pre_cetak = $this->Pre_Cetak->select()->result();
		$cetak = $this->Cetak->select()->result();
		$finishing = $this->Finishing->select()->result();

		$data = array('data_pre_cetak' => $pre_cetak, 'data_cetak' => $cetak, 'data_finishing' => $finishing);

		$this->template->load('static','pimpinan/monitoring', $data);
	}

	public function laporanDivisi($divisi){
		switch ($divisi) {
			case 'precetak':
				$this->load->model('Pre_Cetak');
		
				$pre_cetak = $this->Pre_Cetak->selectGroup()->result();
				$pre_cetak_all = $this->Pre_Cetak->select()->result();

				$data = array('data_pre_cetak' => $pre_cetak, 'data_pre_cetak_all' => $pre_cetak_all);

				$this->template->load('static','pimpinan/laporanprecetak', $data);
			break;

			case 'cetak':
				$this->load->model('Cetak');

				$cetak = $this->Cetak->selectGroup()->result();
				$cetak_all = $this->Cetak->select()->result();

				$data = array('data_cetak' => $cetak, 'data_cetak_all' => $cetak_all);

				$this->template->load('static','pimpinan/laporancetak', $data);
			break;

			case 'finishing':
				$this->load->model('Finishing');
				$this->load->model('Cetak');

				$finishing = $this->Finishing->select()->result();
				$cetak = $this->Cetak->select()->result();

				$data = array('data_finishing' => $finishing, 'data_cetak' => $cetak);

				$this->template->load('static','pimpinan/laporanfinishing', $data);
			break;
			
		}
	}

}
