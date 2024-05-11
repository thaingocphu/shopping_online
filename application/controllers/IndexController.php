<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IndexController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('IndexModel');

		$this->data['categories'] = $this->IndexModel->get_AllCategories();
		$this->data['brands'] = $this->IndexModel->get_Allbrands();
		$this->data['products'] = $this->IndexModel->get_AllProducts();
	}
	public function index()
	{
		$this->data['products'];
		$this->load->view('page/template/header', $this->data);
		$this->load->view('page/template/slider');
		$this->load->view('page/home', $this->data);
		$this->load->view('page/template/footer');
	}
	public function category($id)
	{
		$this->data['categories_products'] = $this->IndexModel->get_CategoryProduct($id);
		$this->data['categoryTitle'] = $this->IndexModel->get_CategoryTitle($id);

		$this->load->view('page/template/header', $this->data);
		$this->load->view('page/category', $this->data);
		$this->load->view('page/template/footer');
	}
	public function brand($id)
	{
		$this->data['brands_products'] = $this->IndexModel->get_BrandProduct($id);
		$this->data['brandTitle'] = $this->IndexModel->get_BrandTitle($id);

		$this->load->view('page/template/header', $this->data);
		$this->load->view('page/brand', $this->data);
		$this->load->view('page/template/footer');
	}
	public function product($id)
	{
		$this->data['product'] = $this->IndexModel->getProductbyid($id);

		$this->load->view('page/template/header', $this->data);
		$this->load->view('page/product_details', 	$this->data);
		$this->load->view('page/template/footer');
	}
	public function cart()
	{

		$this->load->view('page/template/header', $this->data);
		$this->load->view('page/cart');
		$this->load->view('page/template/footer');
	}
	public function add_to_cart()
	{
		$quantity = $this->input->post('quantity');
		$product_id =  $this->input->post('product_id');

		$this->data['products_to_cart'] = $this->IndexModel->Product_cart_detail($product_id);
		foreach ($this->data['products_to_cart'] as $product_cart) {
			$cart = ([
				'id' => $product_id,
				'qty' => $quantity,
				'price' => $product_cart->price,
				'name' => $product_cart->title,
				'options' => (['image' => $product_cart->image]),
			]);
		}
		$this->cart->insert($cart);
		redirect(base_url() . 'cart', 'refresh');
	}
	public function delete_all_cart()
	{
		$this->cart->destroy();
		redirect(base_url() . 'cart', 'refresh');
	}
	public function delete_by_item($rowid)
	{
		$this->cart->remove($rowid);
		redirect(base_url() . 'cart', 'refresh');
	}
	public	function update_cart_item()
	{
		$rowid = $this->input->post('rowid');
		$quantity = $this->input->post('quantity');

		foreach ($this->cart->contents() as $item) {
			if ($rowid  == $item['rowid']) {
				$cart = ([
					'rowid' => $rowid,
					'qty' => $quantity,
				]);
			}
		}
		$this->cart->update($cart);
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function checkout()
	{
		if ($this->session->userdata('LoggedInCustomer')||$this->session->userdata('SignupCustomer')) {
			if($this->cart->contents()){
				$this->load->view('page/template/header', $this->data);
				$this->load->view('page/checkout');
				$this->load->view('page/template/footer');
			}
			else{
				redirect(base_url('cart'));
			}
		} else {
			redirect(base_url('dang-nhap'));
		}
	}
	public function confirm_checkout(){
		$this->form_validation->set_rules('email', 'email', 'trim|required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('phone', 'phone', 'trim|required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('name', 'name', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('address', 'address', 'required', ['required' => 'you must require %s']);
		if ($this->form_validation->run()) {
			$data = ([
				'name' => $this->input->post('name'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'method' => $this->input->post('payment'),
			]);
			$result = $this->IndexModel->add_shipping($data);
			if($result){
				//order
				$order_code = rand(0000,9999);
				$data_order = ([
					'order_code' => $order_code,
					'status' => 1,
					'shipping_id' => $result,
				]);
				$this->IndexModel->add_order($data_order);

				//order_detail
				foreach ($this->cart->contents() as $item) {
					$data_order_details = ([
						'order_code' => $order_code,
						'product_id' => $item['id'],
						'quantity' => $item['qty'],
					]);
					$this->IndexModel->add_order_detail($data_order_details);
				}
				$this->session->set_flashdata('success', 'Your order has been confirm successfully ');
				redirect(base_url('thanks'));
			}else{
				$this->session->set_flashdata('error', 'Failing to confirm your order');
				redirect(base_url('checkout'));
			}
		}else{
			$this->checkout();
		}
	}
	public function thanks(){
		$this->cart->destroy();
		$this->load->view('page/template/header', $this->data);
		$this->load->view('page/thanks');
		$this->load->view('page/template/footer');
	}

	public function login()
	{
		$this->load->view('page/template/header', $this->data);
		$this->load->view('page/login');
		$this->load->view('page/template/footer');
	}
	public function loginCustomer()
	{
		//set rule for login
		$this->form_validation->set_rules('email', 'email', 'trim|required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('password', 'password', 'trim|required', ['required' => 'you must require %s']);

		if ($this->form_validation->run()) {
			$password = md5($this->input->post('password'));
			$email = $this->input->post('email');

			$result = $this->IndexModel->checkloginCustomer($email, $password);
			//set SESSION
			if ($result) {
				$session_array = [
					"id" => $result[0]->id,
					"username" => $result[0]->username,
					"email" => $result[0]->email,
				];

				$this->session->set_userdata('LoggedInCustomer', $session_array);
				$this->session->set_flashdata('success', 'login successful');

				redirect(base_url());
			} else {
				$this->session->set_flashdata('error', 'email or password is invalied');
				redirect(base_url('dang-nhap'));
			}
		} else {
			$this->login();
		}
	}
	public function LogoutCustomer()
	{
		if($this->session->unset_userdata('LoggedInCustomer')){
			$this->session->unset_userdata('LoggedInCustomer');
		}elseif($this->session->unset_userdata('SignupCustomer')){
			$this->session->unset_userdata('SignupCustomer');
		}
		$this->session->set_flashdata('success', 'logout successfully');
		redirect(base_url('dang-nhap'));
	}
	public function SignupCustomer()
	{
		$this->form_validation->set_rules('email', 'email', 'trim|required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('password', 'password', 'trim|required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('name', 'name', 'required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('phone', 'number phone', 'required', ['required' => 'you must require %s']);
		if ($this->form_validation->run()) {
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$result = $this->IndexModel->check_signup_customer($email);
				if ($result->email == $email) {
					$this->session->set_flashdata('signup_error', 'This email is really exist');
					$this->login();
				} else {
					$data = ([
						'email' => $email,
						'password' => $password,
						'name' => $this->input->post('name'),
						'phone' => $this->input->post('phone'),
						'address' => $this->input->post('address'),
					]);
	
					$result_insert = $this->IndexModel->insert_signup_customer($data);
					if($result_insert){
						$this->session->set_userdata('SignupCustomer', $data);
					   	$this->session->set_flashdata('signup_success', 'Sign-up successful. Now, you can login the website');
					   	redirect(base_url());
					}
				}
		} else {
			$this->login();
		}
	}
}
