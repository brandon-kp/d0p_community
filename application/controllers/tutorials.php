<?php
class Tutorials extends CI_Controller {
	
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->data['notifications'] = check_notifications();
		$this->load->model('myaccount_model','myaccount');
		$this->load->model('tutorials_model','tutorials');
		$this->load->helper('form');
		$this->load->library('Tutorials_Library');
		$this->data['userprofile'] = $this->myaccount->for_account_page($this->session->userdata('login_session'));
		
		if($this->session->userdata('login_session'))
		{
			$this->template->set_layout('logged_in.php');
		}
	}
	
	public function index()
	{
		$this->data['cats'] = $this->tutorials_library->get_all_categories();
		$this->data['top_rated'] = $this->tutorials_library->top_rated_tutorials();
		$this->data['newest'] = $this->tutorials_library->newest_tutorials();
		$this->template
			->title('.^. Skem9 :: Tutorials .^.')
			->build('partials/tutorials/view_tutorials',$this->data);
	}
	
	public function addtutorial()
	{
		check_login();
		$this->data['errors'] = $this->tutorials_library->handle_post($this->input->post());
		$this->data['categories'] = $this->tutorials_library->get_categories();
		$this->data['types'] = $this->tutorials_library->get_subcategories();
		$this->template
			->title('.^. Skem9 :: Add Tutorial .^.')
			->build('partials/tutorials/add_tutorial', $this->data);
	}
	
	public function viewtutorial()
	{
		$this->data['tutorial'] = $this->tutorials_library->get_tutorial();
		$this->template
			->title('.^. Skem9 :: '.$this->data['tutorial']['title'].' .^.')
			->build('partials/tutorials/view_tutorial', $this->data);
	}
	
	public function rate()
	{
		$this->tutorials_library->rate();
	}
	
}