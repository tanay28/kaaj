<?php

	class Affiliation_model extends CI_Model
	{
		private $username;
		public function insertAffiliationDetails($data)
		{
			$this->db->insert('affiliation_master',$data);
		}
		public function is_affiliation_exists($code)
		{
			$sql = "SELECT COUNT(*) AS ct FROM affiliation_master WHERE affiliation_code = '".$code."' AND is_deleted = 1";
			return $this->db->query($sql)->result_array();
		}
		public function getAllAffiliations($id,$affiliation_id = '')
		{ 
			if($affiliation_id == '')
			{
				$sql = "SELECT * FROM affiliation_master WHERE admin_id = '".$id."' AND is_deleted = 1";
				return $this->db->query($sql)->result_array();	
			}
			else
			{
				$sql = "SELECT * FROM affiliation_master WHERE admin_id = '".$id."' AND id = '".$affiliation_id."' AND is_deleted = 1";
				return $this->db->query($sql)->result_array();
			}
		}
		public function changeAffiliationDetails($arr)
		{
			if(isset($arr['affiliation_id']) && isset($arr['affiliation_name']) && isset($arr['affiliation_code']) && isset($arr['admin_id']))
			{
				$sql = "UPDATE affiliation_master set affiliation_name = '".$arr['affiliation_name']."',affiliation_code = '".$arr['affiliation_code']."'  WHERE is_deleted = 1 AND id = '".$arr['affiliation_id']."' AND admin_id = '".$arr['admin_id']."'";
				return $this->db->query($sql);
			}
			else
			{
				return 0;
			}
		}
		public function Delete_affiliation($admin_id,$affiliation_id)
		{
			$sql = "UPDATE affiliation_master set is_deleted = '0' WHERE id = '".$affiliation_id."' AND admin_id = '".$admin_id."'";
			$this->db->query($sql);
		}
	}
?>