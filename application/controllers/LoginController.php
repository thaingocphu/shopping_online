<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class LoginController extends CI_Controller {

	public function __construct() {
		//load all model necessary when running function
		parent::__construct();
	}
	public function checklogin() {
		if(!$this->session->userdata("LoggedIn")) {
			redirect("login");
		}
	}
	public function index(){
		//views
		$this->load->view("template/header");
		$this->load->view("login/index");
		$this->load->view("template/footer");

	}
	public function login(){
		//set rule for login
		$this->form_validation->set_rules('email', 'Email', 'trim|required', ['required' => 'you must require %s']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => 'you must require %s']);

		if( $this->form_validation->run() 	){

			$this->load->model('LoginModel');

			$password = md5($this->input->post('password'));
			$email = $this->input->post('email');

			$result = $this->LoginModel->checkLogin($email, $password);
			//set SESSION
			if($result){
				$session_array = [
					"id" => $result[0]->id,
					"username" => $result[0]->username,
					"email"=> $result[0]->email,
				];
				
				$this->session->set_userdata('LoggedIn',$session_array);
				$this->session->set_flashdata('success','login successful');
	
				redirect(base_url('dashboard'));
			}else{	
				$this->session->set_flashdata('error','email or password is invalied');
				redirect(base_url('login'));
			}
		}else{
		$this->index() ;
		}
	}

	public function logout(){
		$this->checklogin();
		$this->session->unset_userdata('LoggedIn');
		$this->session->set_flashdata('success','logout successful');
		redirect(base_url('login'));
	}
}
