<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class CategoryController extends CI_Controller {

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

		$this->load->Model("CategoryModel");
		$data['categories'] = $this->CategoryModel->getdata();

		$this->load->view("category/list", $data);
		$this->load->view("admin_template/footer");

	}

	public function create() {
		$this->checklogin();
		$this->load->view("admin_template/header");
		$this->load->view("admin_template/navbar");
		$this->load->view("category/create");
		$this->load->view("admin_template/footer");
	}

	public function store() {
		$this->load->model('CategoryModel');

		$this->form_validation->set_rules('title', 'title', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('slug', 'slug', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('desc', 'desc', 'required', ['required' => 'you must require %s']);
		if($this->form_validation->run() == TRUE) {
			//upload file:
			$ori_filename  = $_FILES['image']['name'];
			$newname = time()."".str_replace(' ', '_', $ori_filename);
			$config = [
				'upload_path' => './uploads/category',
				'allowed_types' => 'gif|jpg|png|jpeg',
				'file_name' => $newname
			];
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('image')) {
				$error = array('error'=> $this->upload->display_errors());
				$this->load->view("admin_template/header");
				$this->load->view("admin_template/navbar");
				$this->load->view("category/create", $error);
				$this->load->view("admin_template/footer");			
			} else {
				$category_name = $this->upload->data("file_name");
				$data = [
					'title' => $this->input->post('title'),
					'slug'=> $this->input->post('slug'),
					'description' => $this->input->post('desc'),
					'image' => $category_name,
					'status' => $this->input->post('status'),
				];
	
				
				$this->CategoryModel->insertcategory($data);
				$this->session->set_flashdata('success','insert data successful');
				redirect(base_url('category/list'));
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

		$this->load->Model("CategoryModel");
		$data['category'] = $this->CategoryModel->selectcategoryById($id);

		$this->load->view("category/edit", $data);

		$this->load->view("admin_template/footer");
	}
	public function update($id){
		$this->load->model('CategoryModel');

		$this->form_validation->set_rules('title', 'title', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('slug', 'slug', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('desc', 'desc', 'required', ['required' => 'you must require %s']);
		if($this->form_validation->run() == TRUE) {

			if(!empty($_FILES['image']['name'])){
			//upload file:
				$ori_filename  = $_FILES['image']['name'];
				$newname = time()."".str_replace(' ', '-', '_', $ori_filename);
				$config = [
					'upload_path' => './uploads/category',
					'allowed_types' => 'gif|jpg|png|jpeg',
					'file_name' => $newname
				];
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('image')) {
					$error = array('error'=> $this->upload->display_errors());
					$this->load->view("admin_template/header");
					$this->load->view("admin_template/navbar");
					$this->load->view("category/create", $error);
					$this->load->view("admin_template/footer");			
				} else {
					$category_name = $this->upload->data("file_name");
					$data = [
						'title' => $this->input->post('title'),
						'slug'=> $this->input->post('slug'),
						'description' => $this->input->post('desc'),
						'image' => $category_name,
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
			$this->CategoryModel->updatecategory($id,$data);
			$this->session->set_flashdata('success','update data successful');
			redirect(base_url('category/list'));
		}
		else{
			$this->edit($id);
		}
	}

	public function delete($id){
		$this->load->model('CategoryModel');

		$this->CategoryModel->deletecategory($id);
		$this->session->set_flashdata('success','delete data successful');
		redirect(base_url('category/list'));
	
	}
}
