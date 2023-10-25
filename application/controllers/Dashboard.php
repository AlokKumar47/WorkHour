<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->LoginModel->sessionvalid();
		$permlist['permission'] = array_column($this->LoginModel->validPerm(), 'perm');
	}
	public function index()
	{
		$permlist['permission'] = array_column($this->LoginModel->validPerm(), 'perm');
		$this->load->Model('DashModel');
		$permlist['count'] = $this->DashModel->dashboardvalue();
		if(in_array("View Project Summery", $permlist['permission'])){
			// var_dump($permlist['permission']);exit;
			$permlist['projectDetail'] = $this->DashModel->projectDetail();
		}
		$this->load->view('pages/dashboard', $permlist);
	}
	public function projmanag(){
		if($this->session->userdata('id') == null){
            $this->load->view('pages/login');
        }
		else{
			if(isset($_SESSION["updtid"]) && isset($_SESSION["updtname"])){
				unset($_SESSION["updtid"]);
				unset($_SESSION["updtname"]);
			}
			$permlist['permission'] = array_column($this->LoginModel->validPerm(), 'perm');
			$this->load->Model('DashModel');
			$permlist['assignproj'] = $this->DashModel->validProj();
			$permlist['projview'] = $this->db->get('project')->result_array();
			$this->load->view('pages/projmanag', $permlist);
		}
	}
	public function workmanag(){
		if($this->session->userdata('id') == null){
            $this->load->view('pages/login');
        }
		else{
			$this->load->Model('WorkModel');
			$proj['pname'] = $this->WorkModel->getproj();
			$proj['permission'] = array_column($this->LoginModel->validPerm(), 'perm');
			$this->load->Model('DashModel');
			// $proj['assignwork'] = $this->DashModel->validProj();
			$proj['workview'] = $this->DashModel->validWork();
			$this->load->view('pages/workmanag', $proj);
		}
	}
	public function projadd(){
		$pname=$this->input->post('pname');
		
		$this->form_validation->set_rules('pname', 'Project Name', 'required|is_unique[project.pname]');
		if($this->form_validation->run() == true){
			$data = array(
				'pname' => $pname,
				'date' => date("Y-m-d H:i:s")
			);
			if($this->db->insert('project', $data)){
				$data = array(
					'trans_type' => 'Project',
					'transid' => $this->db->insert_id(),
					'activity' => 'Add Project',
					'remark' => 'New Project Added',
					'add_by' => $this->session->userdata('id'),
					'date' => date("Y-m-d H:i:s")
				);
				$this->db->insert('activity_sheet', $data);
			}
			$this->session->set_flashdata('success','Project Sucessfully Added'); 
			redirect('ProjectManagement');
		}
		$this->projmanag();
		// redirect('ProjectManagement');
	}
	public function workadd(){
		$selproj=$this->input->post('selproj');
		$wname=$this->input->post('wname');
		$wdesc=$this->input->post('wdesc');
		$hrs=$this->input->post('hrs');
		$mns=$this->input->post('mns');
		
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		
		$this->form_validation->run('work');
		// echo validation_errors();exit;
		
		if($this->form_validation->run('work') == true){
			$this->load->Model('WorkModel');
			$dur = $hrs.':'.$mns.':00';
			// echo $dur;
			$this->WorkModel->insert($selproj, $wname ,$wdesc, $dur);

			$this->session->set_flashdata('success','Work Sucessfully Added'); 
			redirect('WorkManagement');
			// echo "Work Insert Sucess";exit;
		}else{
			$this->workmanag();
		}
	}
	public function checkdur($str){
		$hrs=$this->input->post('hrs');
		$mns=$this->input->post('mns');
		// echo $str,$hrs,$mns;exit;
		if($hrs == 0 && $mns == 0){
			$this->form_validation->set_message('checkdur', 'Duration cannot be Zero');
			return false;
		}else{
			return true;
		}
	}
	public function projedit(){
		$this->load->model('LoginModel');
		$this->LoginModel->sessionvalid();
		
		$query = $this->db->get_where('project', array('id' => $_POST["tid"]));
		
		$id = $query->row('id');
		$name = $query->row('pname');
		
		$_SESSION["updtid"] = $id;
		$_SESSION["updtname"] = $name;
		
		echo json_encode(array('name'=>$name, 'id'=>$id));
	}
	public function workedit(){
		$this->load->model('LoginModel');
		$this->LoginModel->sessionvalid();
		
		$query = $this->db->get_where('workhour', array('id' => $_POST["tid"]));
		
		$wid = $query->row('id');
		$pid = $query->row('proid');
		$wname = $query->row('work');
		$wdesc = $query->row('description');
		$dur = $query->row('duration');
		extract(date_parse($dur));
		$hrs = $hour;
		$mns = $minute;
		$_SESSION["updtwid"] = $wid;
		$_SESSION["updtpid"] = $pid;
		
		echo json_encode(array('wid'=>$wid, 'pid'=>$pid, 'wname'=>$wname, 'wdesc'=>$wdesc, 'hrs'=>$hrs, 'mns'=>$mns));
	}

	public function delproj($id){
		if($this->db->delete('project', array('id' => $id))){
				$data = array(
					'trans_type' => 'Project',
					'transid' => $id,
					'activity' => 'Delete Project',
					'remark' => 'Old Project Deleted',
					'add_by' => $this->session->userdata('id'),
					'date' => date("Y-m-d H:i:s")
				);
				$this->db->insert('activity_sheet', $data);
			// Delete Project Assigned
			
			$this->db->where('pid', $id);
			$this->db->delete('projassign');
		}
		$this->session->set_flashdata('successajax','Project Sucessfully Deleted');
		redirect('ProjectManagement');
	}
	public function delwork(){
		// echo "hello world";exit;
		$this->load->model('LoginModel');
		$this->LoginModel->sessionvalid();
		
		$id = $this->input->post('tid');
		// echo "id =".$id;exit;
		if($this->db->delete('workhour', array('id' => $id))){
			$data = array(
				'trans_type' => 'Workhour',
				'transid' => $id,
				'activity' => 'Delete Work',
				'remark' => 'Old Work Deleted',
				'add_by' => $this->session->userdata('id'),
				'date' => date("Y-m-d H:i:s")
			);
			$this->db->insert('activity_sheet', $data);
			$this->session->set_flashdata('successajax','Work Sucessfully Deleted');
			echo json_encode(array('session'=>'Workhour Deleted'));
			// redirect('Dashboard/workmanag');
		}
	}
	public function update($updtnew){
		// $updtnew = $this->input->post('updt');
		
		if(isset($_SESSION["updtid"]) && isset($_SESSION["updtname"])){
			
			$this->db->set('pname', $updtnew);
			$this->db->where('id', $_SESSION["updtid"]);
			$this->db->where('pname', $_SESSION["updtname"]);
			if($this->db->update('project')){
				// Activity Sheet
				$data = array(
					'trans_type' => 'Project',
					'transid' => $_SESSION["updtid"],
					'activity' => 'Update Project',
					'remark' => 'Old Project Updated',
					'add_by' => $this->session->userdata('id'),
					'date' => date("Y-m-d H:i:s")
				);
				$this->db->insert('activity_sheet', $data);
				
				unset($_SESSION["updtid"]);
				unset($_SESSION["updtname"]);
				
				$this->session->set_flashdata('successajax','Project Sucessfully Updated'); 
				
				echo json_encode(['code'=>200, 'msg'=>'Update Sucessfull.']);die;
				// redirect('Dashboard/projmanag');
			}else{
				echo "Could not Update";exit;
			}
		}else{
			echo "Session Does not Exist";
		}
	}
	public function updatework($selproj, $wname, $wdesc, $hrs, $mns){
		$dur = $hrs.':'.$mns.':00';
		
		if(isset($_SESSION["updtwid"]) && isset($_SESSION["updtpid"])){
			$this->db->set('proid', $selproj);
			$this->db->set('work', $wname);
			$this->db->set('description', $wdesc);
			$this->db->set('duration', $dur);
			$this->db->where('id', $_SESSION["updtwid"]);
			if($this->db->update('workhour')){
				// Activity Sheet
				$data = array(
					'trans_type' => 'workhour',
					'transid' => $_SESSION["updtwid"],
					'activity' => 'Update Work',
					'remark' => 'Old Work Updated',
					'add_by' => $this->session->userdata('id'),
					'date' => date("Y-m-d H:i:s")
				);
				$this->db->insert('activity_sheet', $data);
				
				unset($_SESSION["updtwid"]);
				unset($_SESSION["updtpid"]);
				
				$this->session->set_flashdata('successajax','Work Sucessfully Updated'); 
				
				echo json_encode(['code'=>200, 'message'=>'Update Sucessfull.']);
			}else{
				echo "Could not Update";exit;
			}
		}else{
			echo "Session Does not Exist";
		}
	}
	public function validproj(){
		$this->load->model('LoginModel');
		$this->LoginModel->sessionvalid();
		
		$errorMSG = "";
		if($_POST["name"] == $_POST["oldname"]){
			echo json_encode(['code'=>404, 'msg'=>'Same Name as Before!']);die;
		}
		if (empty($_POST["name"])) {
			$errorMSG = "The Project Name field is required.";
		}
		$this->db->select("pname");
		$query = $this->db->get("project")->result_array();
		$query = array_column($query,'pname');
		if (in_array($_POST["name"], $query)) {
			$errorMSG = "The Project Name should be Unique.";
		}
		if (ctype_alpha(str_replace(' ', '', $_POST["name"])) === false) {
			$errorMSG = "Name must contain letters and spaces only";
		}
		if(empty($errorMSG)){
			$this->update($_POST["name"]);
		}else{
			echo json_encode(['code'=>404, 'msg'=>$errorMSG]);
		}
	}
	public function validwork(){
		$selproj=$this->input->post('selproj');
		$wname=$this->input->post('wname');
		$wdesc=$this->input->post('wdesc');
		$hrs=$this->input->post('hrs');
		$mns=$this->input->post('mns');
		
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		
		// $this->form_validation->run('work');
		// echo validation_errors();exit;
		
		if($this->form_validation->run('work') == true){
			$this->updatework($selproj, $wname, $wdesc, $hrs, $mns);
		}else{
			echo json_encode(['code'=>404, 'msg'=>"Validation Failed"]);
		}
	}
	public function close(){
		if(isset($_SESSION["updtid"]) && isset($_SESSION["updtname"])){
			unset($_SESSION["updtid"]);
			unset($_SESSION["updtname"]);
			redirect('ProjectManagement');
		}
		if(isset($_SESSION["updtwid"]) && isset($_SESSION["updtpid"])){
			unset($_SESSION["updtwid"]);
			unset($_SESSION["updtpid"]);
			redirect('WorkManagement');
		}
		
	}
	public function countwork(){
		$this->load->model('LoginModel');
		$this->LoginModel->sessionvalid();
		
		$id = $_POST["id"];
		$result = $this->db->query('SELECT id FROM workhour where proid='.$id.';');
		$count = $result->num_rows();
		echo json_encode(array('count'=>$count));
	}
}