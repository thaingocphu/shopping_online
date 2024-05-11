<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class OrderModel extends CI_Model {
	public function get_order(){
		$query =  $this->db->select('orders.*, shipping.*')
				->from('orders')
				->join('shipping', 'orders.shipping_id = shipping.id')
				->get()->result();
		return $query;

	}	
	public function get_order_details($id){
		$query = $this->db->select('order_details.*, products.*, order_details.quantity as qty')
		->from('order_details')
		->join('products', 'order_details.product_id = products.id')
		->where('order_code', $id)
		->get()->result();
		return $query;
	}
	public function delete_order($id){
		$this->db->trans_start();
			$result= $this->db->get_where('orders', ['order_code' => $id])->row();
			if($result){
			$ship_id =$result->shipping_id;
			$this->db->where('id', $ship_id)->delete('shipping');
		}
			$this->db->where('order_code', $id)->delete('orders');
			$this->db->where('order_code', $id)->delete('order_details');

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
		}
	}
}
