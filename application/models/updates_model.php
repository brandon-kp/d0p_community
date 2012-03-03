<?php
class Updates_model extends CI_Model {
	
	public function create_update($text, $poster, $location, $date)
	{
		$this->db->insert('update_entries',array('text'=>$text, 'poster'=>$poster, 'location'=>$location, 'date'=>$date));
	}
	
	public function read_updates()
	{
		return $this->db->get('update_entries')->result_array();
	}
	
}