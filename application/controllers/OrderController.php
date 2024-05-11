<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class OrderController extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('OrderModel');
	}
	public function checklogin() {
		if(!$this->session->userdata("LoggedIn")) {
			redirect("/login");
		}
	}
	public function index(){
		$this->checklogin();
		$data['orders'] =$this->OrderModel->get_order();
		$this->load->view("admin_template/header");
		$this->load->view("admin_template/navbar");
		$this->load->view("order/list",$data);
		$this->load->view("admin_template/footer");

	}
	public function view($id){
		$this->checklogin();
		$data['order_details'] =$this->OrderModel->get_order_details($id);
		$this->load->view("admin_template/header");
		$this->load->view("admin_template/navbar");
		$this->load->view("order/view",$data);
		$this->load->view("admin_template/footer");
	}
	public function delete($id){
		$this->OrderModel->delete_order($id);
		redirect(base_url('order/list'));
	}

}
