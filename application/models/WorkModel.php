<?php
class workModel extends CI_Model {
 
	public function getproj(){
		
		$assignproj = $this->db->get_where('projassign', array('uid'=>$_SESSION['id']))->result_array();
		$assignproj = array_column($assignproj, 'pid');
		// var_dump($assignproj);exit;
		$projview = array();
		
		// $this->db->select('pid', 'pname');
		foreach($assignproj as $id){
			$projview[] = $this->db->get_where('project', array('id'=>$id))->row_array();
		}
		// var_dump($projview);exit;
		
		$default = array(''=>'Select');
		$pname = array_column($projview,'pname','id');
		
		$pname = $default + $pname;
		// var_dump($pname);exit;
		return $pname;
	}
	public function insert($selproj, $wname ,$wdesc, $dur){
		
		$data = array(
				'proid' => $selproj,
				'work' => $wname,
				'description' => $wdesc,
				'duration' => $dur,
				'date' => date("Y-m-d H:i:s")
		);
		
		if($this->db->insert('workhour', $data)){
			
				$data = array(
					'trans_type' => 'Workhour',
					'transid' => $this->db->insert_id(),
					'activity' => 'Add Work',
					'remark' => 'New Workhour Added',
					'add_by' => $this->session->userdata('id'),
					'date' => date("Y-m-d H:i:s")
				);
				$this->db->insert('activity_sheet', $data);
			
			
			return true;
			// echo "sucess";exit;
		}else{
			redirect('Dashboard/workmanag');
		}
	}

}
?>