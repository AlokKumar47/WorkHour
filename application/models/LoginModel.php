<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model{
	
	public function validPerm(){
		// echo "Hello world";
		$roleid = $this->session->userdata('roleid');
		$userid = $this->session->userdata('id');
		
		$this->db->select('perm');
		$this->db->from('permission');
		$this->db->where('rid', $roleid);
		$query = $this->db->get()->result_array();
		$permission = $query;
		return $permission;
	}
	public function sessionvalid(){
		if($this->validatesession() == FALSE){
			if($this->input->is_ajax_request()) {
				$message = 'Session Expired. Please Login Again!';
				echo json_encode(['session'=> FALSE,'message'=>$message]);die;
			}
			else{
				return redirect('Login');
			}
		}
		else{
			return true;
		}
    }
	public function validatesession(){
		
		$id = $this->session->userdata('id');
		$eid = $this->session->userdata('email');
		$pass = $this->session->userdata('pass');
		
		if($id!= null && $eid!=null && $pass!=null){
			$query=$this->db->where(['email'=>$eid,'password'=>$pass])
							->get('login');
			
			if($id == $query->row('id') && $pass == $query->row('password')){
				return true;
			}
			else{
				return false;
			}
		}else{
			return redirect('Login/index');
		}
	}
}

?>