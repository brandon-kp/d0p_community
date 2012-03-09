<?php
class Comments_library_model extends CI_Model {
	
	public function post_comment($to, $from, $text, $area)
	{
		$this->db->insert('user_comments',array('to'=>$to,
												'from'=>$from,
												'text'=>$text,
												'area'=>$area,
												'date'=>time(),
		));
	}
	
	public function get_comments($id, $area, $limit='15', $offset='0')
	{
		$this->db->where(array('area'=>$area,
							   'read'=>'0',
							   'to'=>$id))
				 ->update('user_comments',array('read'=>'1'));
		return $this->db
				->order_by('date','desc')
				->join('user_profile','user_profile.id=user_comments.from')
				->select('user_profile.photo, user_profile.name, user_comments.*')
				->get_where('user_comments',array('to'=>$id, 'area'=>$area), $limit, $offset)->result_array();
	}
	
}