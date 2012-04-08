<?php
class Forum_library {
	
	public $ci;
	
	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->model('forum_model');
	}
	
	public function get_categories()
	{
		return $this->ci->forum_model->get_categories();
	}
	
	public function cat_info($cat)
	{
		return $this->ci->forum_model->cat_info($cat);
	}
	
	public function get_cat_topics($cat)
	{
		return $this->ci->forum_model->get_cat_topics($cat);
	}
	
	public function postcount_taglines($count)
	{
		$tags = array(
		'1'=>' - No posts... How is this even here?',
		'2'=>' - Not a virgin? ... Skank.',
		'3'=>' - You\'re on a roll, keep going!',
		'5'=>' - It\'s getting fun, huh?',
		'8'=>' - At this point you may as well become a "regular".',
		'13'=>' - You sure know how to carry a conversation.',
		'21'=>' - A few people know your name by now.',
		'34'=>' - Between legal drinking age and Rob Quivers\' narcissism score.',
		'55'=>' - Shouldn\'t you be in bed by now?',
		'89'=>' Brilliant contributions.',
		'144'=>' - Basically a regular.'
		);
		//233 377 610 987 1597 2584 4181 6765
		
		foreach($tags as $key=>$value)
		{
			if($count <= $key)
			{
				return $value;
			}
		}
	}
	
	public function comments($topic,$id)
	{
		if($this->ci->uri->segment(5) >1)
		{
			$offset = (
						(15) * $this->ci->uri->segment(5) //20 * (example) 2 = 40
						/
						$this->ci->uri->segment(5) //40 divided by 2 = 20
					); //and that's how you choose where to start selecting rows from the database
		}
		else
		{
			$offset = 0;
		}
		return $this->ci->forum_model->comments($id, $topic, '15', $offset);
	}
	public function count_comments($topic)
	{
		return count($this->ci->forum_model->count_comments($topic));
	}
	
	public function forum_reply_box()
	{
		$forum = Forum::get_instance();
		if(
			$this->ci->session->userdata('login_session') == '' || 
			$forum->data['coms'][0]['locked'] == '1'
		)
		{
			return '';
		}
		else
		{
			return $this->ci->load->view('partials/forum/forum_reply_box','',true);
		}
	}
	
	public function handle_post($post)
	{
		$forum = Forum::get_instance();
		if($post == false)
		{
			return false;
		}
		elseif(is_array($post))
		{
			$topic = $this->ci->uri->segment(3);
			$category = $this->ci->uri->segment(4);
			
			if(isset($post['delete']))
			{
				$this->ci->forum_model->delete_comment($post['delete'],$this->ci->session->userdata('id'));
				return true;
			}
			if(isset($post['edit']))
			{
				$this->ci->forum_model->edit_comment($post['edit'], $this->ci->session->userdata('id'), $topic, $post['comment']);
				return true;
			}
			$this->ci->forum_model->make_new_comment($post['newcomment'], $this->ci->session->userdata('id'), $topic, $category);
		}
	}
	
	public function new_topic($post)
	{
		if($post == false)
		{
			return false;
		}
		elseif(is_array($post))
		{
			$category = $this->ci->uri->segment(3);
			$this->ci->forum_model->new_topic($post['title'], $this->ci->session->userdata('id'), $category, $post['text']);
		}
	}
	
	public function delete_topic($topic, $auth)
	{
		if($auth > 1)
		{
			$this->ci->forum_model->delete_topic($topic);
		}
		
		redirect('forum');
	}
	
	public function make_sticky($topic, $val, $auth)
	{
		if($auth > 1)
		{
			if($val == '1')
			{
				$this->ci->forum_model->make_sticky($topic, '0');
			}
			elseif($val == '0')
			{
				$this->ci->forum_model->make_sticky($topic, '1');
			}
		}
	}
	
	public function lock_topic($topic, $val, $auth)
	{
		if($auth > 1)
		{
			if($val == '1')
			{
				$this->ci->forum_model->lock_topic($topic, '0');
			}
			elseif($val == '0')
			{
				$this->ci->forum_model->lock_topic($topic, '1');
			}
		}
	}
	
}