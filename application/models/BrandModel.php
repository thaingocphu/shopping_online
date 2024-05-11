<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class BrandModel extends CI_Model {
	public function insertbrand($data) {
		$query = $this->db->insert('brands',$data);
		return $query;
	}

	public function getdata() {
		$query = $this->db->get('brands');	
		return $query->result();
	}

	public function selectbrandById($id) {
		$query = $this->db->get_where('brands',['id' => $id]);
		return $query->row();
	}

	public function updatebrand($id, $data) {
		$query = $this->db->update('brands',$data, ['id'=> $id]);
		return $query;
	}

	public function deletebrand($id) {
		$query = $this->db->delete('brands',['id'=>$id]);
		return $query;
		
	}
}
