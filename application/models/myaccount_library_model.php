<?php
class Myaccount_library_model extends CI_Model{
	
	public function get_buddies($id)
	{
		$query1 = $this->db
					->select('user_relationships.user_1, user_relationships.buddy, user_relationships.buddy_status, user_profile.name, user_profile.birthday, user_profile.id')
					->join('user_profile','user_profile.id=user_relationships.user_2')
					->where('user_1',$id)
					->where('buddy','1')
					->where('buddy_status','1')
					->get('user_relationships')
					->result_array();
					
		$query2 = $this->db
					->select('user_relationships.user_1, user_relationships.buddy, user_relationships.buddy_status, user_profile.name, user_profile.birthday, user_profile.id')
					->join('user_profile','user_profile.id=user_relationships.user_1')
					->where('user_2',$id)
					->where('buddy','1')
					->where('buddy_status','1')
					->get('user_relationships')
					->result_array();
					
		$query = array_merge($query1, $query2);
		return $query;
	}
	
}