<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class ProductModel extends CI_Model {
	public function insertproduct($data) {
		$query = $this->db->insert('products',$data);
		return $query;
	}

	public function getdata() {
		$query = $this->db->select('products.*, categories.title as ctitle, brands.title as btitle')
		->from('products')
		->join('categories','products.category_id = categories.id')
		->join('brands','products.brand_id = brands.id')
		->get();
		return $query->result();
	}

	public function selectproductById($id) {
		$query = $this->db->get_where('products',['id' => $id]);
		return $query->row();
	}

	public function updateproduct($id, $data) {
		$query = $this->db->update('products',$data, ['id'=> $id]);
		return $query;
	}

	public function deleteproduct($id) {
		$query = $this->db->delete('products',['id'=>$id]);
		return $query;
		
	}
}
