<?php
class DashModel extends CI_Model {
 
	public function validProj(){
		
		$this->db->select('pid');
		$allproj = $this->db->get_where('projassign', array('uid'=>$_SESSION['id']))->result_array();
		$assignproj = array_column($allproj, 'pid');
		// var_dump($allproj);exit;
		// $projview = array();
		// foreach($assignproj as $id){
			// echo $id;
			// $projview[] = $this->db->get_where('project', array('id'=>$id))->row_array();
		// }
		// var_dump($assignproj);exit;
		return $assignproj;
	}
	public function validWork(){
		$assignproj = $this->validProj();
		// var_dump($assignproj);exit;
		$assignwork = array();
		
		$this->db->select('*');
		$this->db->from('project');
		$this->db->join('workhour', 'project.id = workhour.proid');
		$this->db->order_by("pname", "asc");
		$query = $this->db->get()->result_array();
		// var_dump($query);exit;
		
		foreach($query as $row){
			// echo $id;
			if(in_array($row['proid'], $assignproj)){
				$assignwork[] = $row;
			}
		}
		// var_dump($assignwork);exit;
		return $assignwork;
	}
	public function allWork(){
		$this->db->select('*');
		$this->db->from('project');
		$this->db->join('workhour', 'project.id = workhour.proid');
		$this->db->order_by("pname", "asc");
		$query = $this->db->get()->result_array();
		// var_dump($query);exit;

		return $query;
	}
	public function dashboardvalue(){
		$count = array();
		$count['role'] = $this->db->get('role')->num_rows();
		$count['user'] = $this->db->get('login')->num_rows();
		$count['project'] = $this->db->get('project')->num_rows();
		$count['work'] = $this->db->get('workhour')->num_rows();
		// var_dump($count);exit;
		return $count;
	}
	public function projectDetail(){
		// echo "hell world";exit;
		$projDetail = array();
		$assignproj = $this->validProj();
		foreach($assignproj as $id){
			$projDetail[$id] = $this->db->get_where('project', array('id'=>$id))->row_array();
			$this->db->select_sum('duration');
			$tot = $this->db->get_where('workhour', array('proid'=>$id))->row_array();
			// var_dump($tot);
			if($tot['duration'] == null){
				$tot['duration'] = "No Work Available";
			}
			else{$time = $tot['duration'];
			$time /= 100;
			$mns = $time%100;$time /= 100;
			$hrs = $time%100;
			// $days = 0;
				while($mns > 59){
					$mns /= 60;
					$hrs++;
				}//echo $mns;exit;
				while($hrs > 23){
					$hrs /= 24;
					$days++;
				}//echo $days;exit;
				$elapsed = "Hours=".$hrs.", Minutes=".$mns;//var_dump( $elapsed);
				$tot['duration'] = $elapsed;
			}
			$projDetail[$id] += $tot;
			
		}
		// var_dump($projDetail);exit;
		return $projDetail;
	}
}
?>






















