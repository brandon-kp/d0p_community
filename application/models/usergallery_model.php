<?php
class Usergallery_model extends CI_Model {
	
	public function get_user_photos($id)
	{
		$query = $this->db->get_where('user_photos',array('user_id'=>$id))->result_array();
		return $query;
	}
	
	public function get_single_photo($hash)
	{
		$query = $this->db
					->join('user_profile','user_profile.id=user_photos.user_id')
					->get_where('user_photos', array('hash'=>$hash))
					->result_array();
		return $query[0];
	}
	
}