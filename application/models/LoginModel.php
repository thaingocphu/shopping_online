<?php 
defined("BASEPATH") OR exit("No direct script access allowed");

	class LoginModel extends CI_Model {
		public function checkLogin($email, $password) {
			$query = $this->db->where("email", $email)->where("password", $password)->get("users");
			return $query->result();
		}
	}
