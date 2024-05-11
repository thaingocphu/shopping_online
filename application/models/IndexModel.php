<?php 
defined("BASEPATH") OR exit("No direct script access allowed");

class IndexModel extends CI_Model {
	public function get_AllCategories(){
		$query = $this->db->get_where("categories", ['status' => 1])->result();
		return $query;
	}
	public function get_Allbrands(){
		$query = $this->db->get_where("brands", ['status' => 1])->result();
		return $query;
	}
	public function get_AllProducts(){
		$query = $this->db->get_where('products', ['status' => 1])->result();
		return $query;
	}
	public function get_CategoryProduct($id){
		$query = $this->db->select('products.*')
		->from('products')
		->join('categories','products.category_id = categories.id')
		->where('products.category_id', $id)
		->where('products.status', 1)
		->get()->result();
		return $query;
	}
	public function get_CategoryTitle($id){
	$query = $this->db->get_where('categories', ['id'=> $id])->row();
	return $query;
	}
	public function get_BrandProduct($id){
		$query = $this->db->select('products.*')
		->from('products')
		->join('brands','products.brand_id = brands.id')
		->where('products.brand_id', $id)
		->where('products.status', 1)
		->get()->result();
		return $query;
	}
	public function get_BrandTitle($id){
	$query = $this->db->get_where('brands', ['id'=> $id])->row();
	return $query;
	}
	public function getProductbyid($id){
		$query = $this->db->select('products.*, categories.title as ctitle, brands.title as btitle')
		->from('products')
		->join('categories','products.category_id = categories.id')
		->join('brands','products.brand_id = brands.id')
		->where('products.id', $id)
		->get()->row();
		return $query;
	}

	public function Product_cart_detail($product_id){
		$query = $this->db->select('products.*, categories.title as ctitle, brands.title as btitle')
		->from('products')
		->join('categories','products.category_id = categories.id')
		->join('brands','products.brand_id = brands.id')
		->where('products.id', $product_id)
		->get();
		return $query->result();
	}
	public function add_shipping($data){
		$this->db->insert('shipping', $data);
		return $ship_id = $this->db->insert_id();
	}
	public function add_order($data_order){
		return $this->db->insert('orders', $data_order);
	}
	public function add_order_detail($data_order_details){

		return	$this->db->insert('order_details', $data_order_details);

	}
	public function checkloginCustomer($email, $password) {
		$query = $this->db->where("email", $email)->where("password", $password)->get("customers");
		return $query->result();
	}
	public function check_signup_customer($email) {
		$query = $this->db->select('email')->where('email', $email)->get('customers');
		return $query->row();

	}
	public function insert_signup_customer($data){
		return $this->db->insert('customers', $data);
	}
}
