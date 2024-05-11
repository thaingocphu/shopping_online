<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class CategoryModel extends CI_Model {
	public function insertcategory($data) {
		$query = $this->db->insert('categories',$data);
		return $query;
	}

	public function getdata() {
		$query = $this->db->get('categories');	
		return $query->result();
	}

	public function selectcategoryById($id) {
		$query = $this->db->get_where('categories',['id' => $id]);
		return $query->row();
	}

	public function updatecategory($id, $data) {
		$query = $this->db->update('categories',$data, ['id'=> $id]);
		return $query;
	}

	public function deletecategory($id) {
		$query = $this->db->delete('categories',['id'=>$id]);
		return $query;
		
	}
}
