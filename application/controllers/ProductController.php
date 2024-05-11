<?php
defined("BASEPATH") or exit("No direct script access allowed");

class ProductController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
	public function checklogin()
	{
		if (!$this->session->userdata("LoggedIn")) {
			redirect("/login");
		}
	}
	public function list()
	{
		$this->checklogin();
		$this->load->view("admin_template/header");
		$this->load->view("admin_template/navbar");

		$this->load->Model("ProductModel");
		$data['products'] = $this->ProductModel->getdata();

		$this->load->view("product/list", $data);
		$this->load->view("admin_template/footer");
	}

	public function create()
	{
		$this->checklogin();
		$this->load->view("admin_template/header");
		$this->load->view("admin_template/navbar");
		//load BrandModel
		$this->load->model("BrandModel");
		$data['brands'] = $this->BrandModel->getdata();
		//load CategoryModel
		$this->load->model("CategoryModel");
		$data['categories'] = $this->CategoryModel->getdata();

		$this->load->view("product/create", $data);
		$this->load->view("admin_template/footer");
	}

	public function store()
	{
		$this->load->model('ProductModel');

		$this->form_validation->set_rules('price', 'price', 'required|numeric', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('title', 'title', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('slug', 'slug', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('desc', 'desc', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('quantity', 'quantity', 'required', ['required' => 'you must require %s']);
		if ($this->form_validation->run() == true) {
			//upload file:
			$ori_filename = $_FILES['image']['name'];
			$newname = time() . "" . str_replace(' ', '_', $ori_filename);
			$config = [
				'upload_path' => './uploads/product',
				'allowed_types' => 'gif|jpg|png|jpeg',
				'file_name' => $newname,
			];
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('image')) {
				$error = array('error' => $this->upload->display_errors());
				$this->load->view("admin_template/header");
				$this->load->view("admin_template/navbar");
				$this->load->view("product/create", $error);
				$this->load->view("admin_template/footer");
			} else {
				$product_name = $this->upload->data("file_name");
				$data = [
					'title' => $this->input->post('title'),
					'slug' => $this->input->post('slug'),
					'description' => $this->input->post('desc'),
					'image' => $product_name,
					'status' => $this->input->post('status'),
					'brand_id' => $this->input->post('brand_id'),
					'category_id' => $this->input->post('category_id'),
					'quantity' => $this->input->post('quantity'),
					'price' => $this->input->post('price'),

				];

				$this->ProductModel->insertproduct($data);
				$this->session->set_flashdata('success', 'insert data successful');
				redirect(base_url('product/list'));
			}
		} else {
			$this->create();
		}
	}
	public function edit($id)
	{
		$this->checklogin();
		$this->load->view("admin_template/header");
		$this->load->view("admin_template/navbar");
		//callProductModel
		$this->load->Model("ProductModel");
		$data['product'] = $this->ProductModel->selectproductById($id);
		$this->load->model("BrandModel");
		$data['brands'] = $this->BrandModel->getdata();
		//load CategoryModel
		$this->load->model("CategoryModel");
		$data['categories'] = $this->CategoryModel->getdata();

		$this->load->view("product/edit", $data);

		$this->load->view("admin_template/footer");
	}
	public function update($id)
	{
		$this->load->model('ProductModel');

		$this->form_validation->set_rules('price', 'price', 'required|numeric', ['require' => 'you must require %s']);
		$this->form_validation->set_rules('title', 'title', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('slug', 'slug', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('desc', 'desc', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('quantity', 'quantity', 'required', ['required' => 'you must require %s']);
		if ($this->form_validation->run() == true) {

			if (!empty($_FILES['image']['name'])) {
				//upload file:
				$ori_filename = $_FILES['image']['name'];
				$newname = time() . "" . str_replace(' ', '-', '_', $ori_filename);
				$config = [
					'upload_path' => './uploads/product',
					'upload_path' => './uploads/',
					'allowed_types' => 'gif|jpg|png|jpeg',
					'file_name' => $newname,
				];
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('image')) {
					$error = array('error' => $this->upload->display_errors());
					$this->load->view("admin_template/header");
					$this->load->view("admin_template/navbar");
					$this->load->view("product/create", $error);
					$this->load->view("admin_template/footer");
				} else {
					$product_name = $this->upload->data("file_name");
					$data = [
						'title' => $this->input->post('title'),
						'slug' => $this->input->post('slug'),
						'description' => $this->input->post('desc'),
						'image' => $product_name,
						'status' => $this->input->post('status'),
						'brand_id' => $this->input->post('brand_id'),
						'category_id' => $this->input->post('category_id'),
						'quantity' => $this->input->post('quantity'),
						'price' => $this->input->post('price'),

					];
				}
			} else {
				$data = [
					'title' => $this->input->post('title'),
					'slug' => $this->input->post('slug'),
					'description' => $this->input->post('desc'),
					'status' => $this->input->post('status'),
					'brand_id' => $this->input->post('brand_id'),
					'category_id' => $this->input->post('category_id'),
					'quantity' => $this->input->post('quantity'),
					'price' => $this->input->post('price'),

				];
			}
			$this->ProductModel->updateproduct($id, $data);
			$this->session->set_flashdata('success', 'update data successful');
			redirect(base_url('product/list'));
		} else {
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		$this->load->model('ProductModel');

		$this->ProductModel->deleteproduct($id);
		$this->session->set_flashdata('success', 'delete data successful');
		redirect(base_url('product/list'));
	}
}
