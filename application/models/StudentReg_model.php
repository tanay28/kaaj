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
			$sql = "SELECT * FROM student_details ORDER BY id";
			return $this->db->query($sql)->result_array();
		}
		public function getStudentById($id)
		{
			$sql = "SELECT * FROM student_details WHERE student_id = '".$id."'";
			return $this->db->query($sql)->result_array();	
		}
	}
?>