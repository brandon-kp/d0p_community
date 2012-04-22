<?php
class Admin_model extends CI_Model {
	
	/*
	 * Tutorial Functions
	 */
	
	public function pending_tutorials($limit=5, $offset=0)
	{
		return $this->db
			->select('tutorials.title, tutorials.id')
			->get_where('tutorials',array('approved'=>0), $limit, $offset)
			->result_array();
	}
	
	public function approve_tutorial($id)
	{
		return $this->db->where('id',$id)->update('tutorials',array('approved'=>'1'));
	}
	
	public function delete_tutorial($id)
	{
		return $this->db->delete('tutorials', array('id' => $id));
	}
	
	
	/*
	 * Layout Functions
	 */
	
	public function pending_layouts($limit=5, $offset=0)
	{
		return $this->db
			->select('user_layouts.title, user_layouts.id')
			->get_where('user_layouts',array('approved'=>0), $limit, $offset)
			->result_array();
	}
	
	public function approve_layout($id)
	{
		return $this->db->where('id',$id)->update('user_layouts',array('approved'=>'1'));
	}
	
	public function get_single_layout($id)
	{
		$query = $this->db
					->select('
						user_layouts.*,
						,layout_types.id AS type_id,  layout_types.title AS type_title, layout_types.description AS type_description, layout_types.keyword AS type_keyword
						,user_profile.name, user_profile.id AS userid')
					->join('user_profile', 'user_profile.id=user_layouts.submitted_by')
					->join('layout_types', 'layout_types.id=user_layouts.type', 'LEFT')
					->get_where('user_layouts',array('user_layouts.id'=>$id))->result_array();
		return $query[0];
	}
	
	public function delete_layout($id)
	{
		return $this->db->delete('user_layouts', array('id' => $id));
	}
	
	
	/*
	 * Miscellaneous Functions
	 */
	
	public function compile_stats()
	{
		/*
		 * User generated numbers
		 */
		$stats['layouts']           = $this->db->count_all('user_layouts');
		$stats['tutorials']         = $this->db->count_all('tutorials');
		$stats['forum_topics']      = $this->db->count_all('forum_topics');
		$stats['forum_comments']    = $this->db->count_all('forum_comments');
		$stats['user_photos']       = $this->db->count_all('user_photos');
		$stats['profile_comments']  = $this->db->where('area','0')->from('user_comments')->count_all_results();
		$stats['layout_comments']   = $this->db->where('area','1')->from('user_comments')->count_all_results();
		$stats['tutorial_comments'] = $this->db->where('area','2')->from('user_comments')->count_all_results();
		
		/*
		 * Systemic numbers
		 */
		$stats['layout_categories']      = $this->db->count_all('layout_categories');
		$stats['layout_types']           = $this->db->count_all('layout_types');
		$stats['tutorial_categories']    = $this->db->count_all('tutorial_categories');
		$stats['tutorial_subcategories'] = $this->db->count_all('tutorial_subcategories');
		$stats['forum_categories']       = $this->db->count_all('forum_categories');
		
		return $stats;
	}
	
	public function send_message($to, $from, $subject, $text)
	{
		$this->db->insert('user_messages',array(
			'to'=>$to,
			'from'=>$from,
			'subject'=>$subject,
			'text'=>$text,
			'date'=> time(),
			'hash'=>uniqid(),
			'status'=>'0',
		));
	}
}