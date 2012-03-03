<?php
class Login_model extends CI_Model {
	
	public function validate_user($email, $password)
	{
		$query = $this->db
					  ->get_where('user_profile',array('email'=>$email, 'password'=>$password))
					  ->num_rows();
		if($query == 1)
		{
			return true;
		}
		return false;
	}
	
	public function login_user($email, $password, $login_session, $last_login)
	{
		$this->db
			 ->where(array('email'=>$email, 'password'=>$password))
			 ->update('user_profile',array('login_session'=>$login_session,'last_login'=>$last_login));
	}
	
}