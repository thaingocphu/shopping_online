<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class DashboardController extends CI_Controller {
	public function checklogin() {
		if(!$this->session->userdata("LoggedIn")) {
			redirect("/login");
		}
	}
	public function index()	{
		$this->checklogin();
		$this->load->view("admin_template/header");
		$this->load->view("admin_template/navbar");
		$this->load->view("dashboard/index");
		$this->load->view("admin_template/footer");
	}
}
