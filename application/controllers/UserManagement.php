<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserManagement extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->LoginModel->sessionvalid();
	}
	public function index(){
		if(isset($_SESSION["updtid"])){
			unset($_SESSION["updtid"]);
		}
		$this->load->model('UserModel');
		$list['projlist'] = $this->UserModel->projlist();
		$list['rolelist'] = $this->UserModel->rolelist();
		$list['userlist'] = $this->UserModel->userlist();
		$list['permission'] = array_column($this->LoginModel->validPerm(), 'perm');
		
		$this->load->view('pages/userManagement', $list);
	}
	public function adduser()
	{
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		$this->form_validation->run('register');
		// echo validation_errors();exit;
		if($this->form_validation->run('register')== TRUE)
		{
			// echo "Sucess Validation";
			$uname = $this->input->post('uname');
			$email = $this->input->post('email');
			$pass = md5($this->input->post('passs'));
			$selrole = $this->input->post('selrole');
			$selproj = $this->input->post('plist[]');
						
			$data = array(
				'uname' => $uname,
				'email' => $email,
				'password' => $pass,
				'rid' => $selrole,
				'date' => date("Y-m-d H:i:s")
			);
			if($this->db->insert('login', $data)){
				$uid = $this->db->insert_id();
				$data = array(
					'trans_type' => 'User',
					'transid' => $uid,
					'activity' => 'Add User',
					'remark' => 'New User Added',
					'add_by' => $this->session->userdata('id'),
					'date' => date("Y-m-d H:i:s")
				);
				$this->db->insert('activity_sheet', $data);
				
				// Insert data into project assign table
				$this->load->model('UserModel');
				$this->UserModel->projassign($uid,$selproj);
			}
			$this->session->set_flashdata('success','User Sucessfully Added'); 
			redirect('UserManagement');
		}
		else{
			$this->index();
		}
	}
	
	public function useredit(){
		$this->load->model('LoginModel');
		$this->LoginModel->sessionvalid();
		
		$tid = $_POST['tid'];
		
		$this->db->select('*');
		$this->db->from('login');
		$this->db->where('id', $tid);
		$query = $this->db->get();
		
		$name = $query->row()->uname;
		$email = $query->row()->email;
		// $pass = $query->row()->password;
		$rid = $query->row()->rid;
		
		//Get all project
		$allPro = $this->db->get('project')->result_array();
		
		//Get already assign project
		$this->db->select('pid');
		$pro = $this->db->get_where('projassign',array('uid'=>$tid))->result_array();
		$AlreadyAssign = array_column($pro, 'pid');
		
		$option='';
		foreach($allPro as $p)
		{
			$Checked='';	
			if (in_array($p['id'], $AlreadyAssign))
			{
				$Checked='Checked';	
			}
			$option.='<div class="checkbox"><label>
						<input type="checkbox" '.$Checked.' name="plist[]" class="updatechk" value="'.$p['id'].'">  '.$p['pname'].' 
					</label></div>';
		}
		$_SESSION['updtid'] = $tid;
		$_SESSION['updtrid'] = $rid;
		
		
		echo json_encode(array('name'=>$name, 'email'=>$email, 'rid'=>$rid, 'option'=>$option));
		exit;
	}
	public function updtuser(){
		$uid = $_SESSION['updtid'];
		$rid = $_SESSION['updtrid'];
		$updtuname = $this->input->post('updtuname');
		$updtemail = $this->input->post('updtemail');
		$updtselrole = $this->input->post('updtselrole');
		$plist = $this->input->post('plist');
		
		// echo $updtuname,",",$updtemail,",",$updtselrole,",",$plist;
		// exit;
		if($this->form_validation->run('updtuser') == true){
			
			$this->load->model('UserModel');
			if($this->UserModel->updateuser($uid, $updtuname, $updtemail, $rid, $updtselrole, $plist) == true){
				
				$this->session->set_flashdata('successajax','User Sucessfully Updated'); 
				echo json_encode(['code'=>200]);
			}else{
				echo json_encode(['code'=>404]);
			}
		}
		else{
			// echo validation_errors();
			// echo form_error('updtuname');exit;
			echo json_encode(['code'=>404,'updtuname'=>form_error('updtuname'),'updtemail'=>form_error('updtemail'),'updtselrole'=>form_error('updtselrole')]);
		}
	}
	public function countproj(){
		// $uid = $this->input->post('tid');
		$query = $this->db->get_where('projassign', array('uid' => $_POST["tid"]));
		$count = $query->num_rows();
		if($count > 0){
			echo json_encode(['code'=>200, 'count'=>$count]);
		}else{
			echo json_encode(['code'=>404]);
		}
	}
	public function deluser($id){
		if($this->db->delete('login', array('id' => $id))){
			$data = array(
				'trans_type' => 'User',
				'transid' => $id,
				'activity' => 'Delete User',
				'remark' => 'Old User Deleted',
				'add_by' => $this->session->userdata('id'),
				'date' => date("Y-m-d H:i:s")
			);
			$this->db->insert('activity_sheet', $data);
		}
		$this->session->set_flashdata('successajax','User Sucessfully Deleted'); 
	redirect('UserManagement');
	}
}
?>