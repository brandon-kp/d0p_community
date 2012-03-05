<?php
class Userprofile_model extends CI_Model {
	
	public function userprofile($id)
	{
		$query = $this->db->get_where('user_profile',array('id'=>$id))->result_array();
		
		/*count how many photos the user has in their gallery*/
		$query[0]['gallery_count'] = $this->db->select('user_id')->get_where('user_photos',array('user_id'=>$id))->result_array();
		$query[0]['gallery_count'] = count($query[0]['gallery_count']);
		
		return $query[0];
	}
	
	/*we need this to determine whether to insert, or update*/
	public function _has_relationship($ext_id, $cur_id)
	{
		$query1 = $this->db->get_where('user_relationships',array('user_1'=>$ext_id, 'user_2'=>$cur_id))->result_array();
		$query2 = $this->db->get_where('user_relationships',array('user_2'=>$ext_id, 'user_1'=>$cur_id))->result_array();
		$array = array_merge($query1, $query2);
		
		return $array;
	}
	
	public function check_if_buddy($ext_id, $cur_id)
	{
		$query = $this->db
				->where('user_1',$ext_id)
				->where('user_2',$cur_id)
				->where('buddy','1')
				->get('user_relationships')
				->result_array();
		if(count($query) > 0)
		{
			return true;
		}
		return false;
	}
	
	public function check_if_blocked($ext_id, $cur_id)
	{
		$query = $this->db
				->where('user_1',$ext_id)
				->where('user_2',$cur_id)
				->where('block','1')
				->get('user_relationships')
				->result_array();
		if(count($query) > 0)
		{
			return true;
		}
		return false;
	}
	
	public function addbuddy($ext_id, $cur_id, $buddy_msg)
	{
		$this->db->insert('user_relationships', array('user_1'=>$ext_id,'user_2'=>$cur_id,'buddy'=>'1', 'relationship_number'=>$ext_id.'_'.$cur_id, 'buddy_msg'=>$buddy_msg, 'buddy_status'=>'0'));
	}
	
	public function blockuser($ext_id, $cur_id)
	{
		$this->db->insert('user_relationships', array('user_1'=>$ext_id,'user_2'=>$cur_id,'buddy'=>NULL, 'relationship_number'=>$ext_id.'_'.$cur_id, 'block'=>'1'));
	}
	
	public function get_buddies($id)
	{
		$query1 = $this->db
					->join('user_profile','user_profile.id=user_relationships.user_2')
					->where('user_1',$id)
					->where('buddy','1')
					->where('buddy_status','1')
					->get('user_relationships')
					->result_array();
					
		$query2 = $this->db
					->join('user_profile','user_profile.id=user_relationships.user_1')
					->where('user_2',$id)
					->where('buddy','1')
					->where('buddy_status','1')
					->get('user_relationships')
					->result_array();
					
		$query = array_merge($query1, $query2);
		return $query;
	}
	
	public function get_comments($id, $limit='15', $offset='0')
	{
		$this->db->where(array('area'=>'0',
							   'read'=>'0',
							   'to'=>$id))
				 ->update('user_comments',array('read'=>'1'));
		return $this->db
				->order_by('date','desc')
				->join('user_profile','user_profile.id=user_comments.from')
				->select('user_profile.photo, user_profile.name, user_comments.*')
				->get_where('user_comments',array('to'=>$id, 'area'=>'0'), $limit, $offset)->result_array();
	}
	
	public function post_comment($to, $from, $text)
	{
		$this->db->insert('user_comments',array('to'=>$to,
												'from'=>$from,
												'text'=>$text,
												'area'=>'0',
												'date'=>time(),
		));
	}
	

}