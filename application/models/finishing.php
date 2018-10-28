<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finishing extends CI_Model {

	public function select(){
		$this->db->select('*');
    $this->db->from('finishing a'); 
    $this->db->join('percetakan b', 'b.id_percetakan = a.id_percetakan', 'left');
    $this->db->order_by('tanggal desc, id_finishing desc,jam_masuk_finishing desc');
    $query = $this->db->get(); 
    return $query;
	}

	public function selectGroup() {
		$this->db->from('finishing');
		$this->db->group_by('nama_koran');
		$this->db->group_by('tanggal');
		$this->db->order_by('tanggal desc, nama_koran asc'); 
		$query = $this->db->get(); 
		return $query;
	}

	public function get($id){
		$this->db->from('finishing a');
		$this->db->join('percetakan b', 'b.id_percetakan = a.id_percetakan', 'left');
		$this->db->where($id);
		$this->db->order_by('tanggal desc, nama_koran asc, jam_masuk_finishing desc'); 
		$query = $this->db->get();
		return $query;
	}

	public function insert($data) {
		$this->db->insert('finishing', $data);
		return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
	}

	public function update($id, $data){
		$this->db->where($id);
		$check = $this->db->update('finishing',$data);
		if ($check) {
			return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
		} else {
			return FALSE;
		}
	}

}
?>