<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index(){
		$this->load->view('pages/login');
	}
	public function registration()
	{
		$this->load->view('pages/registration');
	}
	public function validatepass(){
		$eid=$this->input->post('eid');
        $pass=md5($this->input->post('pass'));
	
        $query = $this->db->where(['email'=>$eid,'password'=>$pass])
                        ->get('login');

        if($query->num_rows() > 0)
		{
			$username = $this->session->set_userdata('uname',$query->row()->uname);
			$roleid = $this->session->set_userdata('roleid',$query->row()->rid);
			$this->session->set_userdata('id',$query->row()->id);
			$this->session->set_userdata('pass',$query->row()->password);
			$this->session->set_userdata('email',$query->row()->email);
		
			return true;
        }else{
			$this->form_validation->set_message('validatepass', 'Invalid Login Details');
			return FALSE;
        }
	}
	public function validation()
	{	
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		
		if($this->form_validation->run('login')== TRUE)
		{
			// echo "Sucess Validation";
			$eid = $this->input->post('eid');
            $pass = md5($this->input->post('pass'));
			
            $this->load->Model('Permission');
			$this->Permission->rolemanag();
			
			redirect ('Dashboard');
		}else{
			$this->load->view('pages/login');
		}
	}
	public function welcome(){
		redirect ('Dashboard');
	}
	public function changepass(){
		$this->load->Model('DashModel');
		$permlist['permission'] = array_column($this->LoginModel->validPerm(), 'perm');
		
		$this->load->view('pages/changepass', $permlist);
	}
	public function updtpass(){
		$this->load->Model('LoginModel');
		
		if($this->form_validation->run('changepass') == true){
			if($this->LoginModel->sessionvalid())
			{
				$oldpass = $this->input->post('oldpass');
				$newpass = $this->input->post('newpass');
				$id = $this->session->userdata('id');
				
				$this->db->where(array('id'=>$id,'password'=>md5($oldpass)));
				$this->db->update('login', array('password' =>md5($newpass)));
				
				session_destroy();
				$this->index();
			}		
		}else{
			$this->changepass();
		}
	}
	public function logout(){
		// echo "<pre>";
		// var_dump($_SESSION);exit;
		
		session_destroy();
		$this->load->view('pages/login');
	}
}
