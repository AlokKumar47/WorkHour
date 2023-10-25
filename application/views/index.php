<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
	
	public function index(){
		$this->load->model('loginModel');
		$this->loginModel->const();
		
		echo "hello world";
		$this->load->view('Login/index');
	}
}
?>

