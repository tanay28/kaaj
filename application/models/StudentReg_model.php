<?php

	class StudentReg_model extends CI_Model
	{
		public function getLastId()
		{
			$sql = "SELECT student_id FROM student_details WHERE id = (SELECT MAX(id) FROM student_details)";
			return $this->db->query($sql)->result_array();
		}
		public function insert_student_details($arr)
		{
			$this->db->insert('student_details',$arr);
		}
		public function getAllStudents()
		{
			$sql = "SELECT * FROM student_details WHERE is_deleted = '1' ORDER BY id";
			return $this->db->query($sql)->result_array();
		}
		public function getStudentById($id)
		{
			$sql = "SELECT * FROM student_details WHERE student_id = '".$id."'";
			return $this->db->query($sql)->result_array();	
		}
		public function updateStudentDetails($arr)
		{
			if(isset($arr['data']) && count($arr['data'])>0)
			{
				$sql = "UPDATE student_details SET student_name = '".$arr['data']['student_name']."' , age = '".$arr['data']['age']."' , sex = '".$arr['data']['sex']."', father_name = '".$arr['data']['father_name']."', mother_name = '".$arr['data']['mother_name']."', father_occupation = '".$arr['data']['father_occupation']."', mother_occupation = '".$arr['data']['mother_occupation']."' , guardian_name = '".$arr['data']['guardian_name']."' , contact_no = '".$arr['data']['contact_no']."', student_address = '".$arr['data']['student_address']."', class = '".$arr['data']['class']."', section = '".$arr['data']['section']."', registered_on = '".$arr['data']['registered_on']."' WHERE student_id = '".$arr['student_id']."' AND admin_id = '".$arr['admin_id']."' AND is_deleted = '1'";
				/*echo $sql;
				die;*/
				$this->db->query($sql);
			}
		}
		public function del_student($id,$username)
		{
			$sql = "UPDATE student_details SET is_deleted = '0' WHERE student_id = '".$id."' AND admin_id = '".$username."'";
			$this->db->query($sql);
		}
	}
?>