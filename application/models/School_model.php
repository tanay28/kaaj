<?php

	class School_model extends CI_Model
	{
		private $username;
		public function getAllAffiliations($id)
		{
			$sql = "SELECT affiliation_code FROM affiliation_master WHERE admin_id = '".$id."' AND is_deleted = 1";
			return $this->db->query($sql)->result_array();
		}
		public function insertSchoolDetails($data)
		{
			$this->db->insert('school_master',$data);
		}
		public function is_schhol_exists($school_name)
		{
			$sql = "SELECT COUNT(*) AS ct FROM school_master WHERE school_name = '".$school_name."' AND is_deleted = 1";
			return $this->db->query($sql)->result_array();
		}
		public function getAllSchools($id,$school_id = '')
		{ 
			if($school_id == '')
			{
				$sql = "SELECT * FROM school_master WHERE admin_id = '".$id."' AND is_deleted = 1";
				return $this->db->query($sql)->result_array();	
			}
			else
			{
				$sql = "SELECT * FROM school_master WHERE admin_id = '".$id."' AND id = '".$school_id."' AND is_deleted = 1";
				return $this->db->query($sql)->result_array();
			}
		}
		public function changeSchoolDetails($arr)
		{
			if(isset($arr['school_id']) && isset($arr['school_name']) && isset($arr['school_address']) && isset($arr['contact_no']) && isset($arr['affiliated_to']) && isset($arr['registered_on']) && isset($arr['admin_id']))
			{
				$sql = "UPDATE school_master set school_address = '".$arr['school_address']."',contact_no = '".$arr['contact_no']."',affiliated_to = '".$arr['affiliated_to']."',registered_on = '".$arr['registered_on']."' WHERE is_deleted = 1 AND id = '".$arr['school_id']."' AND admin_id = '".$arr['admin_id']."'";
				return $this->db->query($sql);
			}
			else
			{
				return 0;
			}
		}
		public function Delete_school($admin_id,$school_id)
		{
			$sql = "UPDATE school_master set is_deleted = '0' WHERE id = '".$school_id."' AND admin_id = '".$admin_id."'";
			$this->db->query($sql);
		}
	}
?>