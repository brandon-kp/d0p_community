<?php
class User_helper extends CI_Model {
	
	public function get_account_type($id)
	{
		$query = $this->db
			->select('account_type')
			->get_where('user_profile',array('id'=>$id))
			->result_array();
		return $query[0]['account_type'];
	}
	
	public function get_current_user($login_session)
	{
		$query = $this->db
			->select('id')
			->get_where('user_profile',array('login_session'=>$login_session))
			->result_array();
		return $query[0]['id'];
	}
	
	public function get_current_user_profile($login_session)
	{
		$query = $this->db
			->get_where('user_profile',array('login_session'=>$login_session))
			->result_array();
		return $query[0];
	}
	
	public function check_new_messages($id)
	{
		return $this->db
					->select('user_messages.id')
					->join('user_profile','user_profile.id = user_messages.from')
					->get_where('user_messages', array('to'=>$id, 'status'=>'0'))->result_array();
	}
	
	public function check_buddy_requests($id)
	{
		return $this->db->get_where('user_relationships',array('user_2'=>$id, 'block'=>NULL, 'buddy'=>'0'))->result_array();
	}
	
	public function check_new_comments($id)
	{
		return $this->db->get_where('user_comments',array('to'=>$id, 'area'=>0, 'read'=>'0'))->result_array();
	}
	
	public function increase_tokens($for_user,$increase_by)
	{
		$tokens = $this->db->select('tokens')->where('id', $for_user)->get('user_profile')->result_array();
		$tokens = $tokens[0]['tokens']+$increase_by;
		$this->db->where('id', $for_user)->update('user_profile', array('tokens'=>$tokens));
	}
	
}