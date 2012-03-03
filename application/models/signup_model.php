<?php
class Signup_model extends CI_Model {
	
	public function new_user($username, $email, $password, $birthday, $gender, $signed_up)
	{
			$this->db->insert('user_profile',array(
				'name'=>$username,
				'email'=>$email,
				'password'=>$password,
				'birthday'=>$birthday,
				'gender'=>$gender,
				'account_type'=>'1',
				'signed_up'=>$signed_up,
				'photo'=>'images/index/2aS7Rs'
			));
	}
	
	public function get_id($password)
	{
		$query = $this->db->select('id')->get_where('user_profile',array('password'=>$password))->result_array();
		return $query[0]['id'];
	}
	
	public function get_sess($password)
	{
		$query = $this->db->select('login_session')->get_where('user_profile',array('password'=>$password))->result_array();
		return $query[0]['login_session'];
	}
	
}