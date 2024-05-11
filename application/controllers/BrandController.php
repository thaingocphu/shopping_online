<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class BrandController extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	public function checklogin() {
		if(!$this->session->userdata("LoggedIn")) {
			redirect("/login");
		}
	}
	public function list() {
		$this->checklogin();
		$this->load->view("admin_template/header");
		$this->load->view("admin_template/navbar");

		$this->load->Model("BrandModel");
		$data['brands'] = $this->BrandModel->getdata();

		$this->load->view("brand/list", $data);
		$this->load->view("admin_template/footer");

	}

	public function create() {
		$this->checklogin();
		$this->load->view("admin_template/header");
		$this->load->view("admin_template/navbar");
		$this->load->view("brand/create");
		$this->load->view("admin_template/footer");
	}

	public function store() {
		$this->load->model('BrandModel');

		$this->form_validation->set_rules('title', 'title', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('slug', 'slug', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('desc', 'desc', 'required', ['required' => 'you must require %s']);
		if($this->form_validation->run() == TRUE) {
			//upload file:
			$ori_filename  = $_FILES['image']['name'];
			$newname = time()."".str_replace(' ', '_', $ori_filename);
			$config = [
				'upload_path' => './uploads/brand',
				'allowed_types' => 'gif|jpg|png|jpeg',
				'file_name' => $newname
			];
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('image')) {
				$error = array('error'=> $this->upload->display_errors());
				$this->load->view("admin_template/header");
				$this->load->view("admin_template/navbar");
				$this->load->view("brand/create", $error);
				$this->load->view("admin_template/footer");			
			} else {
				$brand_name = $this->upload->data("file_name");
				$data = [
					'title' => $this->input->post('title'),
					'slug'=> $this->input->post('slug'),
					'description' => $this->input->post('desc'),
					'image' => $brand_name,
					'status' => $this->input->post('status'),
				];
	
				
				$this->BrandModel->insertbrand($data);
				$this->session->set_flashdata('success','insert data successful');
				redirect(base_url('brand/list'));
			}
		}
		else{
			$this->create();
		}
	}
	public function edit($id){
		$this->checklogin();
		$this->load->view("admin_template/header");
		$this->load->view("admin_template/navbar");

		$this->load->Model("BrandModel");
		$data['brand'] = $this->BrandModel->selectbrandById($id);

		$this->load->view("brand/edit", $data);

		$this->load->view("admin_template/footer");
	}
	public function update($id){
		$this->load->model('BrandModel');

		$this->form_validation->set_rules('title', 'title', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('slug', 'slug', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('desc', 'desc', 'required', ['required' => 'you must require %s']);
		if($this->form_validation->run() == TRUE) {

			if(!empty($_FILES['image']['name'])){
			//upload file:
				$ori_filename  = $_FILES['image']['name'];
				$newname = time()."".str_replace(' ', '-', '_', $ori_filename);
				$config = [
					'upload_path' => './uploads/brand',
					'allowed_types' => 'gif|jpg|png|jpeg',
					'file_name' => $newname
				];
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('image')) {
					$error = array('error'=> $this->upload->display_errors());
					$this->load->view("admin_template/header");
					$this->load->view("admin_template/navbar");
					$this->load->view("brand/create", $error);
					$this->load->view("admin_template/footer");			
				} else {
					$brand_name = $this->upload->data("file_name");
					$data = [
						'title' => $this->input->post('title'),
						'slug'=> $this->input->post('slug'),
						'description' => $this->input->post('desc'),
						'image' => $brand_name,
						'status' => $this->input->post('status'),
					];
				}
			}else{
				$data = [
					'title' => $this->input->post('title'),
					'slug'=> $this->input->post('slug'),
					'description' => $this->input->post('desc'),
					'status' => $this->input->post('status'),
				];
			}
			$this->BrandModel->updatebrand($id,$data);
			$this->session->set_flashdata('success','update data successful');
			redirect(base_url('brand/list'));
		}
		else{
			$this->edit();
		}
	}

	public function delete($id){
		$this->load->model('BrandModel');

		$this->BrandModel->deletebrand($id);
		$this->session->set_flashdata('success','delete data successful');
		redirect(base_url('brand/list'));
	
	}
}
