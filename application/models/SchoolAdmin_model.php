<?php

	class SchoolAdmin_model extends CI_Model
	{
		private $username;
		public function insertSchoolAdminDetails($data)
		{
			$this->db->insert('schoolAdmin_master',$data);
		}
		public function is_schholAdmin_exists($email)
		{
			$sql = "SELECT COUNT(*) AS ct FROM schoolAdmin_master WHERE email_id = '".$email."' AND is_deleted = 1";
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
		
		public function changeSchoolAdminDetails($arr)
		{
			if(isset($arr['schoolAdmin_id']) && isset($arr['schoolAdmin_name']) && isset($arr['schoolAdmin_address']) && isset($arr['contact_no']) && isset($arr['email_id']) && isset($arr['admin_id']))
			{
				$sql = "UPDATE schoolAdmin_master set schoolAdmin_address = '".$arr['schoolAdmin_address']."',contact_no = '".$arr['contact_no']."',schoolAdmin_name = '".$arr['schoolAdmin_name']."' WHERE is_deleted = 1 AND id = '".$arr['schoolAdmin_id']."' AND admin_id = '".$arr['admin_id']."'";
				return $this->db->query($sql);
			}
			else
			{
				return 0;
			}
		}
		public function Delete_schoolAdmin($admin_id,$schoolAdmin_id)
		{
			$sql = "UPDATE schoolAdmin_master set is_deleted = '0' WHERE id = '".$schoolAdmin_id."' AND admin_id = '".$admin_id."'";
			$this->db->query($sql);
		}
	}
?>