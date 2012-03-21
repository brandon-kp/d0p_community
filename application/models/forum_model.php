<?php
class Forum_model extends CI_Model {
	
	public function get_categories()
	{
		$query = $this->db
				->join('user_profile','user_profile.id=forum_categories.last_comment')
				->select('forum_categories.*, user_profile.name AS username')
				->get('forum_categories')->result_array();
		return $query;
	}
	
	public function cat_info($cat)
	{
		$query = $this->db
			->select('forum_categories.title, forum_categories.description, forum_categories.id')
			->get_where('forum_categories',array('id'=>$cat))
			->result_array();
		return $query[0];
	}
	
	public function get_cat_topics($cat)
	{
		$topics['sticky'] = $this->db
			->order_by('last_reply_date','DESC')
			->join('user_profile','user_profile.id=forum_topics.started_by')
			->join('user_profile AS user_profile2','user_profile2.id=forum_topics.last_reply_by')
			->select('forum_topics.*, user_profile.name, user_profile.id AS user_id, user_profile2.name AS last_reply_name, user_profile2.id AS last_reply_id')
			->get_where('forum_topics',array('category'=>$cat, 'sticky'=>'1'))
			->result_array();
		$topics['normal'] = $this->db
			->order_by('last_reply_date','DESC')
			->join('user_profile','user_profile.id=forum_topics.started_by')
			->join('user_profile AS user_profile2','user_profile2.id=forum_topics.last_reply_by')
			->select('forum_topics.*,user_profile.name, user_profile.id AS user_id, user_profile2.name AS last_reply_name, user_profile2.id AS last_reply_id')
			->get_where('forum_topics',array('category'=>$cat, 'sticky'=>'0'))
			->result_array();
		return $topics;
	}
	
	public function comments($id, $topic, $limit='15', $offset='0')
	{
		return $this->db
				->order_by('date','ASC')
				->join('forum_topics','forum_topics.id=forum_comments.topic')
				->join('user_profile','user_profile.id=forum_comments.poster')
				->select('forum_topics.sticky, forum_topics.locked, forum_topics.title,user_profile.signature,user_profile.birthday,user_profile.gender,user_profile.photo, user_profile.name, user_profile.post_count, user_profile.account_type,forum_comments.*')
				->get_where('forum_comments',array('topic'=>$topic), $limit, $offset)
				->result_array();
	}
	public function count_comments($topic)
	{
		return $this->db->select('id')->get_where('forum_comments',array('topic'=>$topic))->result_array();
	}
	
	public function make_new_comment($text, $poster, $topic, $category)
	{
		$this->db->insert('forum_comments',array(
			'text'=>$text,
			'poster'=>$poster,
			'topic'=>$topic,
			'date'=>time()
		));
		
		$reply_count = $this->db->select('reply_count')->get_where('forum_topics',array('id'=>$topic))->result_array();
		$reply_count = $reply_count[0]['reply_count']+1;
		
		$this->db->where('id',$topic)->update('forum_topics',array(
			'reply_count'=>$reply_count,
			'last_reply_date'=>time(),
			'last_reply_by'=>$poster
		));
		
		$post_count = $this->db->select('post_count')->get_where('forum_categories',array('id'=>$category))->result_array();
		$post_count = $post_count[0]['post_count']+1;
		
		$this->db->where('id',$category)->update('forum_categories',array(
			'post_count'=>$post_count,
			'last_comment'=>$poster,
			'last_comment_date'=>time(),
		));
		
		$user_post_count = $this->db->select('COUNT(*)')->get_where('forum_comments',array('poster'=>$poster))->result_array();
		$user_post_count = $user_post_count[0]["COUNT(*)"]+1;
		
		$this->db->where('id',$poster)->update('user_profile',array('post_count'=>$user_post_count));
	}
	
	public function edit_comment($text, $poster, $topic, $comment)
	{
		$this->db->where(array('id'=>$comment,'poster'=>$poster))->update('forum_comments',array(
			'edited'=>'1',
			'text'=>$text
		));
	}
	
	public function delete_comment($comment, $id)
	{
		$this->db->delete('forum_comments',array('poster'=>$id,'id'=>$comment));
	}
	
	public function new_topic($title, $poster, $category, $text)
	{
		$this->db->insert('forum_topics',array(
			'title'=>$title,
			'last_reply_by'=>$poster,
			'started_by'=>$poster,
			'category'=>$category,
			'start_date'=>time(),
			'last_reply_date'=>time()
		));
		
		$topic_id = $this->db->select('id')->get_where('forum_topics',array('title'=>$title))->result_array();
		$topic_id = $topic_id[0]['id'];
		
		$this->db->insert('forum_comments',array(
			'text'=>$text,
			'poster'=>$poster,
			'topic'=>$topic_id,
			'date'=>time(),
		));
		
		$topic_count = $this->db->select('topic_count')->get_where('forum_categories',array('id'=>$category))->result_array();
		$topic_count = $topic_count[0]['topic_count']+1;
		
		$this->db->where('id',$category)->update('forum_categories', array(
			'topic_count'=>$topic_count,
			'last_comment'=>$poster,
			'last_comment_date'=>time()
		));
	}
	
	public function delete_topic($topic)
	{
		$this->db->delete('forum_topics', array('id'=>$topic));
		$this->db->delete('forum_comments',array('topic'=>$topic));
	}
	
	public function make_sticky($topic, $val)
	{
		$this->db->where('id',$topic)->update('forum_topics',array('sticky'=>$val));
	}
	
	public function lock_topic($topic, $val)
	{
		$this->db->where('id',$topic)->update('forum_topics',array('locked'=>$val));
	}
}