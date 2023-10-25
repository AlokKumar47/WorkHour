<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export_model extends CI_Model
{
	public function worklist(){
		$this->db->select('*');
		$this->db->from('project');
		$this->db->order_by("pname", "asc");
		$this->db->join('workhour', 'project.id = workhour.proid');
		$query = $this->db->get();
		
		return $query->result();
	}
		
}
?>