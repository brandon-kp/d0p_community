<?php
class Updates extends CI_Controller {
	
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		check_login();
		check_admin();
		$this->data['notifications'] = check_notifications();
		$this->load->helper('form');
		$this->load->model('updates_model','updates');
		$this->load->model('myaccount_model','myaccount');
	}
	
	public function index()
	{
		$this->data['list_updates'] = $this->updates->read_updates();
		
		$this->template
			->inject_partial('errors', $this->session->userdata('errors'))
			->title('Manage Site Updates')
			->build('partials/manage_updates', $this->data);
	}
	
	public function process()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('location', 'Location', 'required');
		$this->form_validation->set_rules('text', 'Text', 'required');
		
		$location = $this->input->post('location');
		$text     = $this->input->post('text');
		$date     = date('Y-m-d');
		$poster   = $this->myaccount->for_account_page($this->session->userdata('login_session'));
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata(array('errors'=>validation_errors()));
			redirect('updates');
		}
		else
		{
			$this->updates->create_update($text, $poster['id'], $location, $date);
			redirect('myaccount');
		}
	}
	
}