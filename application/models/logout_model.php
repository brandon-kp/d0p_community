<?php
class Logout_model extends CI_Model {
	
	public function logout($login_session)
	{
		$this->db->where('login_session',$login_session)->update('user_profile',array('login_session'=>''));
	}
	
}