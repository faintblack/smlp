<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pre_Cetak extends CI_Model {

	public function select(){
		$this->db->select('*');
    $this->db->from('pre_cetak a'); 
    $this->db->join('percetakan b', 'b.id_percetakan = a.id_percetakan', 'left');
    $this->db->order_by('tanggal desc, jam_masuk_pre_cetak desc, sesi desc');
    $query = $this->db->get(); 
    return $query;
	}

	public function get($id){
		$this->db->from('pre_cetak a');
		$this->db->join('percetakan b', 'b.id_percetakan = a.id_percetakan', 'left');
		$this->db->where($id);
		$this->db->order_by('tanggal desc, nama_koran asc, jam_masuk_pre_cetak desc'); 
		$query = $this->db->get();
		return $query;
	}

	public function selectGroup() {
    $this->db->select('*');
    $this->db->from('pre_cetak a'); 
    $this->db->join('percetakan b', 'b.id_percetakan = a.id_percetakan', 'left');
    $this->db->order_by('tanggal desc, jam_masuk_pre_cetak desc');
    $this->db->group_by('a.id_percetakan');
    $query = $this->db->get(); 
    return $query;
	}

	public function insert($data) {
		$this->db->insert('pre_cetak', $data);
		return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
	}

	public function update($id, $data){
		$this->db->where($id);
		$check = $this->db->update('pre_cetak',$data);
		if ($check) {
			return ($this->db->affected_rows() != 1) ? FALSE : TRUE;
		} else {
			return FALSE;
		}
	}

}
?>