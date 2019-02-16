<?php

	class Teacher_model extends CI_Model
	{
		private $username;
		public function insertTeacherDetails($data)
		{
			$this->db->insert('teacher_master',$data);
		}
		public function is_teacher_exists($email)
		{
			$sql = "SELECT COUNT(*) AS ct FROM teacher_master WHERE email_id = '".$email."' AND is_deleted = 1";
			return $this->db->query($sql)->result_array();
		}
		public function getAllTeachers($id,$teacher_id = '')
		{ 
			if($teacher_id == '')
			{
				$sql = "SELECT * FROM teacher_master WHERE admin_id = '".$id."' AND is_deleted = 1";
				return $this->db->query($sql)->result_array();	
			}
			else
			{
				$sql = "SELECT * FROM teacher_master WHERE admin_id = '".$id."' AND id = '".$teacher_id."' AND is_deleted = 1";
				return $this->db->query($sql)->result_array();
			}
		}
		public function changeTeacherDetails($arr)
		{
			if(isset($arr['teacher_id']) && isset($arr['teacher_name']) && isset($arr['address']) && isset($arr['contact_no']) && isset($arr['sex']) && isset($arr['age']) && isset($arr['education']) && isset($arr['subject']) && isset($arr['experience']))
			{
				$sql = "UPDATE teacher_master set address = '".$arr['address']."',contact_no = '".$arr['contact_no']."',teacher_name = '".$arr['teacher_name']."', sex = '".$arr['sex']."', age = '".$arr['age']."', education = '".$arr['education']."', subject = '".$arr['subject']."', experience = '".$arr['experience']."' WHERE is_deleted = 1 AND id = '".$arr['teacher_id']."' AND admin_id = '".$arr['admin_id']."'";
				return $this->db->query($sql);
			}
			else
			{
				return 0;
			}
		}
		public function Delete_teahcer($admin_id,$teacher_id)
		{
			$sql = "UPDATE teacher_master set is_deleted = '0' WHERE id = '".$teacher_id."' AND admin_id = '".$admin_id."'";
			$this->db->query($sql);
		}
	}
?>