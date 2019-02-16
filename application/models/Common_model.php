<?php

	class Common_model extends CI_Model
	{
		public function loginInfo($username,$current_time)
        {
            $sql = "INSERT INTO users_session(user_id,login_at)VALUES('".$username."','".$current_time."')";
            $rs = $this->db->query($sql);
        }
		public function getLoginTime($username)
		{
			$sql = "SELECT login_at FROM users_session WHERE user_id = '".$username."'";
			return $this->db->query($sql)->result_array();
		}
		public function UpdateSignOutTime($username,$current_time,$loginTime,$minutes)
		{
			$sql = "UPDATE users_session set logout_at='".$current_time."', duration= '".$minutes."' WHERE user_id='".$username."' AND login_at= '".$loginTime."'";
			$this->db->query($sql);	
		}
	}
	
?>