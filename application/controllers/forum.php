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
		
		#var_dump($this->session);
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
		
		$this->data['cat_info'] = $this->forum_library->cat_info($this->uri->segment(4));
		$this->data['coms']     = $this->forum_library->comments($this->uri->segment(3),$this->uri->segment(4));
		$this->data['reply']    = $this->forum_library->forum_reply_box();
		
		$this->template
			->title('.^. Skem9 :: '.$this->data['coms'][0]['title'].' .^.')
			->build('partials/forum/comments', $this->data);
	}
	
	public function testing()
	{
		var_dump($this->forum_library->postcount_taglines('14'));
	}
	
}