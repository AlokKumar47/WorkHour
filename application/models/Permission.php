<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Model{
	public function rolemanag(){
		// echo "Hello world";
		$roleid = $this->session->userdata('roleid');
		$userid = $this->session->userdata('id');
		
		$this->db->select('perm');
		$this->db->from('permission');
		$this->db->where('rid', $roleid);
		$query = $this->db->get()->result_array();
		$permission = $query;
		
		// print_r($permission);exit;
		
		return $permission;
		
	}
}
?>