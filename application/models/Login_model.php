<?php
	
	class Login_model extends CI_Model
    {
        public $title;
        public $content;
        public $date;

        public function authentication($username,$password)
        {
            $sql = "SELECT type FROM users WHERE username='".$username."' AND password= '".md5($password)."'";
            return $this->db->query($sql)->result_array();
        }
        
    }
?>