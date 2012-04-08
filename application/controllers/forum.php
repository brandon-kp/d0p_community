<?php
class Forum extends CI_Controller {
	
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('forum_library');
		$this->load->helper('date');
		$this->load->helper('form');
		$this->load->model('myaccount_model','myaccount');
		$this->data['userprofile'] = $this->myaccount->for_account_page($this->session->userdata('login_session'));
		$this->data['notifications'] = check_notifications();
		
		if($this->session->userdata('login_session'))
		{
			$this->template->set_layout('logged_in.php');
		}
		
		$this->template->append_metadata('<link rel="stylesheet" type="text/css" href="'.base_url('/assets/css/forum.css').'" />');
	}
	
	public function index()
	{
		$this->data['categories'] = $this->forum_library->get_categories();

		$this->template
			->title('.^. Skem9 :: Forum .^.')
			->build('partials/forum/categories', $this->data);
	}
	
	public function category()
	{
		$this->load->library('Pagination');
		
		$this->data['cat_info'] = $this->forum_library->cat_info($this->uri->segment(3));
		$this->data['categories'] = $this->forum_library->get_categories();
		$this->data['topics']     = $this->forum_library->get_cat_topics($this->uri->segment(3));
		
		$this->template
			->title('.^. Skem9 :: '.$this->data['cat_info']['title'].' .^.')
			->build('partials/forum/topics', $this->data);
	}
	
	public function newtopic()
	{
		check_login();
		$this->data['cat_info'] = $this->forum_library->cat_info($this->uri->segment(3));
		
		$this->forum_library->new_topic($this->input->post());
		$this->template
			->title('.^. Skem9 :: New Topic .^.')
			->build('partials/forum/new_topic', $this->data);
	}
	
	public function deletetopic()
	{
		$this->forum_library->delete_topic($this->uri->segment(3), $this->data['userprofile']['account_type']);
	}
	
	public function makesticky()
	{
		$this->data['coms'] = $this->forum_library->comments($this->uri->segment(3),$this->uri->segment(4));
		$this->forum_library->make_sticky($this->uri->segment(3), $this->uri->segment(4), $this->data['userprofile']['account_type']);
	}
	
	public function locktopic()
	{
		$this->data['coms'] = $this->forum_library->comments($this->uri->segment(3),$this->uri->segment(4));
		$this->forum_library->lock_topic($this->uri->segment(3), $this->uri->segment(4), $this->data['userprofile']['account_type']);
	}
	
	public function comments()
	{
		//this is only executed if POST was sent
		$this->forum_library->handle_post($this->input->post());
		
		$this->load->library('Pagination');
		
		$this->data['cat_info'] = $this->forum_library->cat_info($this->uri->segment(4));
		$this->data['coms']     = $this->forum_library->comments($this->uri->segment(3),$this->uri->segment(4));
		$this->data['reply']    = $this->forum_library->forum_reply_box();
		
		$config['base_url'] = site_url('forum/comments/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/');
		$config['total_rows'] = $this->forum_library->count_comments($this->uri->segment(3));
		$config['per_page'] = '15';
		$config['uri_segment'] = 5;
		$config['first_link'] = '1';
		$config['cur_tag_open'] = '<span class="pdot">';
		$config['cur_tag_close'] = '</span>';
		$config['use_page_numbers'] = TRUE;
		$config['prev_link'] = FALSE;
		$config['next_link'] = FALSE;
		
		$this->pagination->initialize($config);
		$this->data['pages'] = $this->pagination->create_links();
		$this->template
			->title('.^. Skem9 :: '.$this->data['coms'][0]['title'].' .^.')
			->build('partials/forum/comments', $this->data);
	}
	
	public function testing()
	{
		$this->data['coms']     = $this->forum_library->comments($this->uri->segment(3),$this->uri->segment(4));
		$this->load->library('Pagination');
		
		$config['base_url'] = site_url('forum/comments/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/');
		$config['total_rows'] = $this->forum_library->count_comments();
		$config['per_page'] = '15';
		$config['uri_segment'] = 5;
		$config['first_link'] = '1';
		 
		echo $this->pagination->create_links();
		var_dump($this->data['coms']);
	}
	
}