<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rolemanag extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->LoginModel->sessionvalid())
		{
			return redirect('Login');
		}
		
	}
	public function index(){
		if(isset($_SESSION["updtid"])){
			unset($_SESSION["updtid"]);
		}
		$permlist['permission'] = array_column($this->LoginModel->validPerm(), 'perm');
		// print_r($permlist['permission']);exit;
		$permlist['permlist'] = array('View Project Summery','View Project','Add Project','Update Project','Delete Project',
										'View Work','Add Work','Update Work','Delete Work',
										'View User','Add User','Update User','Delete User',
										'View Role','Add Role','Update Role','Delete Role');
		$this->load->view('pages/rolemanag', $permlist);
	}
	public function addrole(){
		$roletxt = $this->input->post('roletxt');
		$perm = $this->input->post('chk[]');
		
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		$this->form_validation->run('rolename');
		// echo validation_errors();exit;
		
		if($this->form_validation->run('rolename') == true){
			// echo "Validation Sucess";exit;
			$this->load->Model('UserModel');
			$this->UserModel->insertrole($roletxt, $perm);
			// $this->UserModel->insertperm($perm);
			
			$this->session->set_flashdata('success','Role Sucessfully Added'); 
			redirect('RoleManagement');
			// echo "Role Insert Sucess";exit;
		}else{
			$this->index();
		}
	}
	
	public function uniquerole($str)
	{
		$this->db->where('roles',$str);
		$query = $this->db->get('role');
		if ($query->num_rows() > 0){
			$this->form_validation->set_message('uniquerole', 'Role Name Already Exist');
			return false;
		}
		else{
			return true;
		}
	}
	public function roleedit(){
		$tid = $_POST['tid'];
		$this->load->Model('UserModel');
		$list = $this->UserModel->permlist($tid);
		$prem = array_column($list, 'perm');
		$prem = array_merge($prem, array("role"=>$list[0]['roles']));
		$_SESSION['updtid'] = $tid;
		
		echo json_encode($prem);
	}
	public function updaterole(){
		// echo "Update Role Controler";exit;
		$rid = $_SESSION['updtid'];
		$roletxt = $this->input->post('roletxt');
		$upchk = $this->input->post('upchk');
		
		// $this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		// $this->form_validation->run('updtrole');
		
		if($this->form_validation->run('updtrole') == true){
			$this->load->Model('UserModel');
			if($this->UserModel->updaterole($rid, $roletxt, $upchk)){
				$this->session->set_flashdata('successajax','Role Sucessfully Updated');
				echo json_encode(['code'=>200]);
			}
		}
		else{
			echo validation_errors();
			echo json_encode(['code'=>404]);
		}
	}
	public function countrole(){
		$query = $this->db->get_where('login', array('rid' => $_POST["id"]));
		$count = $query->num_rows();
		if($count > 0){
			echo json_encode(['code'=>200, 'count'=>$count]);
		}else{
			echo json_encode(['code'=>404, 'count'=>$count]);
		}
	}
	public function delrole($id){
		if($this->db->delete('role', array('id' => $id))){
			$data = array(
				'trans_type' => 'Role',
				'transid' => $id,
				'activity' => 'Delete Role',
				'remark' => 'Old Role Deleted',
				'add_by' => $this->session->userdata('id'),
				'date' => date("Y-m-d H:i:s")
			);
			$this->db->insert('activity_sheet', $data);
		}
		$this->session->set_flashdata('successajax','Role Sucessfully Deleted');
	redirect('RoleManagement');
	}
	public function assignrole(){
		$uid = $this->input->post('seluser');
		$rid = $this->input->post('selrole');
		// echo $uid, $rid; exit;
		$this->db->set('rid', $rid, FALSE);
		$this->db->where('id', $uid);
		if($this->db->update('login')){
			redirect('RoleManagement');
		}
	}
	public function fillrole(){
		$uid = $_POST['tid'];
		$this->load->Model('UserModel');
		$rid = $this->UserModel->user($uid);
		// echo 'Role ID='.$rid;exit;
		echo json_encode(['rid=>$rid']);
	}
}

?>