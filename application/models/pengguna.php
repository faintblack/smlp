<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Model {

	public function validasi($data) {
		$query = $this->db->get_where('pengguna', $data);
		return $query;
	}

	public function select(){
		$this->db->select('*');
    $this->db->from('pengguna'); 
    $this->db->order_by('nama_pengguna asc');
    $query = $this->db->get(); 
    return $query;
	}

	public function insert($data) {
		$tmp = array('username' => $data['username']);
		$cek = $this->db->get_where('pengguna', $tmp)->result();

		if (count($cek) == 0) {
			$this->db->insert('pengguna', $data);
			return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
		} else {
			return FALSE;
		}
	}

	public function update($username, $data){
		$this->db->where($username);
		$cek = $this->db->update('pengguna',$data);
		if ($cek) {
			return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
		} else {
			return FALSE;
		}		
	}

	public function delete($username){
		$this->db->where($username);
		$this->db->delete('pengguna');
		return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
	}
}
?>