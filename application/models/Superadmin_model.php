<?php

	class Superadmin_model extends CI_Model
	{
		private $username;
		public function getUsername($id)
		{ 
			$sql = "SELECT name FROM users WHERE username = '$id'";
			return $this->db->query($sql)->result_array();
		}
		public function CheckPassword($userid,$pass)
		{
			$sql = "SELECT COUNT(*) AS ct FROM users WHERE username = '".$userid."' AND password = '".md5($pass)."'";
			return $this->db->query($sql)->result_array();
		}
		public function UpdatePassword($userid,$pass)
		{
			$sql = "UPDATE users SET password = '".md5($pass)."' WHERE username = '".$userid."'";
			$this->db->query($sql);
		}
		
		public function get_no_of_schools($id)
		{
			$sql = "SELECT COUNT(*) AS ct FROM school_master WHERE admin_id ='".$id."' AND is_deleted = 1";
			return $this->db->query($sql)->result_array();
		}

		public function get_no_of_schoolAdmins($id)
		{
			$sql = "SELECT COUNT(*) AS ct FROM schoolAdmin_master WHERE admin_id ='".$id."' AND is_deleted = 1";
			return $this->db->query($sql)->result_array();
		}

		public function get_no_of_teachers($id)
		{
			$sql = "SELECT COUNT(*) AS ct FROM teacher_master WHERE admin_id ='".$id."' AND is_deleted = 1";
			return $this->db->query($sql)->result_array();
		}

		public function get_no_of_affiliations($id)
		{
			$sql = "SELECT COUNT(*) AS ct FROM affiliation_master WHERE admin_id ='".$id."' AND is_deleted = 1";
			return $this->db->query($sql)->result_array();
		}

		public function get_no_of_mapped_school($id)
		{
			$sql = "SELECT COUNT(*) AS ct FROM school_mapping ORDER BY id";
			return $this->db->query($sql)->result_array();
		}

		public function getAllSchool($username)
		{
			$sql = "SELECT * FROM school_master WHERE admin_id = '".$username."' AND is_deleted = 1";
			return $this->db->query($sql)->result_array();
		}

		public function getAllSchoolsAdmin($id,$schoolAdmin_id = '')
		{ 
			if($schoolAdmin_id == '')
			{
				$sql = "SELECT * FROM schoolAdmin_master WHERE admin_id = '".$id."' AND is_deleted = 1";
				return $this->db->query($sql)->result_array();	
			}
			if($schoolAdmin_id != '' && $id != '')
			{
				$sql = "SELECT * FROM schoolAdmin_master WHERE admin_id = '".$id."' AND id = '".$schoolAdmin_id."' AND is_deleted = 1";
				return $this->db->query($sql)->result_array();
			}
		}

		public function school_mapping_exists($school_id,$school_admin_id,$teacher_id)
		{
			$sql = "SELECT id FROM school_mapping WHERE school_id = '".$school_id."' AND school_admin_id = '".$school_admin_id."' AND teacher_id = '".$teacher_id."'";
			return $this->db->query($sql)->result_array();
		}
		public function Insert_school_mapping($arr)
		{
			$this->db->insert('school_mapping',$arr);
		}
		public function getAllTeachers($user)
		{
			$sql = "SELECT * FROM teacher_master WHERE admin_id = '".$user."'";
			return $this->db->query($sql)->result_array();
		}
		
	}
?>