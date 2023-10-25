<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model{
	public function permlist($tid){
		$this->db->select('*');
		$this->db->from('permission');
		$this->db->join('role', 'permission.rid = role.id');
		$this->db->where('rid', $tid);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	public function projlist(){
		$this->db->select('*');
		$this->db->from('project');
		$this->db->order_by("pname", "asc");
		$query = $this->db->get();
		
		return $query->result_array();
	}
	public function rolelist(){		
		$this->db->select('*');
		$this->db->from('role');
		$this->db->order_by("roles", "asc");
		$query = $this->db->get();
		
		return $query->result_array();
	}
	public function userlist(){		
		$this->db->select('*');
		$this->db->from('login');
		$this->db->order_by('uname', "asc");
		// $rolelist = $this->db->get();
		$query = $this->db->get();
		
		return $query->result_array();
	}
	public function insertrole($roletxt, $perm){
		// echo "Inserting Role into DB".$roletxt;exit;
		$data = array(
			'roles' => $roletxt,
			'date' => date("Y-m-d H:i:s")
		);
		if($this->db->insert('role', $data)){
			$rid = $this->db->insert_id();
			for ($i=0; $i<sizeof($perm); $i++)
			{
				// echo $perm[$i];
				$data = array(
					'rid' => $rid,
					'perm' => $perm[$i],
					'value' => 'Y',
					'date' => date("Y-m-d H:i:s")
				);
				$this->db->insert('permission', $data);
			}
			$data = array(
				'trans_type' => 'Role',
				'transid' => $this->db->insert_id(),
				'activity' => 'Add Role',
				'remark' => 'New Role Added',
				'add_by' => $this->session->userdata('id'),
				'date' => date("Y-m-d H:i:s")
			);
			$this->db->insert('activity_sheet', $data);
		}	
	}
	public function updaterole($rid, $roletxt, $upchk){
		// echo $rid;
		// Remove previous permission
		$this->db->where('rid', $rid);
		$this->db->delete('permission');
		
		// Update new permission
		if(!$upchk == null){
			for ($i=0; $i<sizeof($upchk); $i++)
			{
				$data = array(
					'rid' => $rid,
					'perm' => $upchk[$i],
					'value' => 'Y',
					'date' => date("Y-m-d H:i:s")
				);
				$this->db->insert('permission', $data);
			}
			// echo $roletxt;
			// update new roletxt
			$this->db->set('roles', $roletxt);
			$this->db->where('id', $rid);
			$this->db->update('role');
			
			$data = array(
				'trans_type' => 'Role',
				'transid' => $this->db->insert_id(),
				'activity' => 'Update Role',
				'remark' => 'Old Role Update',
				'add_by' => $this->session->userdata('id'),
				'date' => date("Y-m-d H:i:s")
			);
			$this->db->insert('activity_sheet', $data);
		}

		return true;
	}
	public function updateuser($uid, $updtuname, $updtemail, $rid, $updtselrole, $plist){
		// Updating User Role
		if($rid != $updtselrole){
			$this->db->set('rid', $updtselrole, FALSE);
			$this->db->where('id', $uid);
			$this->db->update('login');
		}
		// Updating User Details
		$array = array(
				'uname' => $updtuname,
				'email' => $updtemail,
		);
		$this->db->set($array);
		$this->db->where('id', $uid);
		$this->db->update('login');
		
		// Updating User Projects
		// Remove previous Projects
		$this->db->where('uid', $uid);
		$this->db->delete('projassign');
		
		// Update new Projects
		if($plist != null){
			for ($i=0; $i<sizeof($plist); $i++)
			{
				$data = array(
					'uid' => $uid,
					'pid' => $plist[$i],
					'date' => date("Y-m-d H:i:s")
				);
				$this->db->insert('projassign', $data);
			}
		}
		// Activity Sheet
		$data = array(
				'trans_type' => 'User',
				'transid' => $uid,
				'activity' => 'Update User',
				'remark' => 'Old User Update',
				'add_by' => $this->session->userdata('id'),
				'date' => date("Y-m-d H:i:s")
			);
			$this->db->insert('activity_sheet', $data);
		return true;
	}
	public function user($uid){
		$this->db->select('id');
		$this->db->from('login');
		$this->db->where('id', $uid);
		$query = $this->db->get()->result();
		return $query;
	}
	public function projassign($uid,$selproj){
		for ($i=0; $i<sizeof($selproj); $i++)
		{
			$data = array(
				'uid' => $uid,
				'pid' => $selproj[$i],
				'date' => date("Y-m-d H:i:s")
			);
			$this->db->insert('projassign', $data);
		}
	}
}

?>