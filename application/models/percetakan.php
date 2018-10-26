<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Percetakan extends CI_Model {

	public function select(){
    $this->db->from('percetakan'); 
    $this->db->order_by('tanggal desc, nama_koran asc');
    $query = $this->db->get(); 
    return $query;
	}

	public function get($id){
		$this->db->from('percetakan');
		$this->db->where($id);
		$this->db->order_by('tanggal desc, nama_koran asc');
		$query = $this->db->get();
		return $query;
	}

	public function insert($data) {
		$this->db->insert('percetakan', $data);
		return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
	}

	public function update($id, $data){
		$this->db->where($id);
		$check = $this->db->update('percetakan',$data);
		if ($check) {
			return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
		} else {
			return FALSE;
		}
	}

}
?>