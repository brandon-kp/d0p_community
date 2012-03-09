<?php

/*
 * Skem9 Comments class
 */

class Comments {
	
	private $_ci;
	private $_to;
	private $_from = '';
	private $_area;
	
	public function __construct()
	{
		$this->_ci =& get_instance();
	}
	
	public function initialize($config, $authenticate='true')
	{
		if($this->_ci->session->userdata('login_session') == '' AND $authenticate = 'true')
		{
			return $this->_ci->load->view('errors/logged_in_to_comment');
		}
	}
	
	
	/*
	 * [C]reate
	 * [R]
	 * [U]
	 * [D]
	 */
	public function post_comment($area,$to)
	{
		if($this->_ci->session->userdata('login_session') == '')
		{
			return $this->_ci->load->view('errors/logged_in_to_comment', '', true);
		}
		else
		{
			$this->_ci =& get_instance();
			$comment_data = array();
			$this->_ci->load->helper('form');
			$comments_data['to'] = $to;
			
			if($this->_ci->input->post('submit_comment'))
			{
				if($this->_ci->session->userdata('id') == $to)
				{
					return $this->_ci->load->view('errors/cant_comment_self');
				}			
				$this->_ci->load->model('Comments_library_model','comments_m');
				$this->_ci->comments_m->post_comment($to, $this->_ci->session->userdata('id'), $this->_ci->input->post('text'), $area);
			}
			return $this->_ci->load->view('chunks/comment_form', $comments_data, true);
		}
	}
	
	public function get_comments($area, $to)
	{
		$this->_ci->load->model('Comments_library_model','comments_m');
		$comments_content['coms'] = $this->_ci->comments_m->get_comments($to, $area);
		
		return $this->_ci->load->view('chunks/comment_content', $comments_content, true);
	}
	
}