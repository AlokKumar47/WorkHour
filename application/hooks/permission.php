<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission {
	var $CI;
	public function __construct(){
		$this->CI =& get_instance();
	}
	public function role(){
		if($this->CI->session->userdata('id'))
		{
			$rid = $this->CI->session->userdata('roleid');
			
			$query=$this->CI->db->where(['rid'=>$rid])
                        ->get('permission');
			$n = $query->num_rows();
			$perm = $query->result_array('prem');
			
			// echo "<pre>";
			// print_r($perm);exit;
			
			for( $i=1; $i<$n; $i++){
				// echo $record[$i]['perm'];
				$this->CI->session->set_userdata($record[$i]['perm'],$record[$i]['perm']);
				// $this->session->userdata('roleid',$query->row()->rid);
			}
        }
		else{
			echo "Hello World"; exit;
			
			$rid = $this->CI->session->userdata('roleid');
			echo $rid;
			// $query=$this->db->where(['roleid'=>$rid])
                        // ->get('permission');

			// if($query->num_rows()){
				// $this->session->set_userdata('uname',$query->row()->uname);
				// $this->session->userdata('roleid',$query->row()->rid);
				
				// return $query->row()->id;
			// }else{
				// $this->form_validation->set_message('validatepass', 'Invalid Login Details');
				// return False;
			// }
			
			// return redirect('Login/welcome');
		}
	}
}