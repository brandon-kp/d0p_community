<?php
class Messages extends CI_Controller {
	
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		
		check_login();
		
		$this->data['notifications'] = check_notifications();
		
		$this->load->model('messages_model','messages');
		$this->load->model('myaccount_model','myaccount');
		
		$this->data['userprofile'] = $this->myaccount->for_account_page($this->session->userdata('login_session'));
		
		$this->template->set_layout('logged_in.php');
		
		$this->load->helper('date');
		$this->load->helper('form');
	}
	
	
	public function index()
	{
		$this->data['messages'] = $this->messages->get_all_messages($this->session->userdata('id'));
		$this->template
			->title('.^. Skem9 :: My Messages .^.')
			->build('partials/all_messages', $this->data);
	}
	
	public function read()
	{
		$this->data['message'] = $this->messages->get_message($this->uri->segment(3), $this->session->userdata('id'));
		
		$this->template
			->title('.^. Skem9 :: My Messages .^.')
			->build('partials/read_message', $this->data);
		
		$this->messages->mark_as_read($this->uri->segment(3));
	}
	
	public function send()
	{
		$this->load->model('userprofile_model','userprofile');
		$this->data['userbox'] = $this->userprofile->userprofile($this->uri->segment(3));
		$this->template
			->title('.^. Skem9 :: Send Message .^.')
			->build('partials/send_message', $this->data);
	}
	
	public function sendmessage_process()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
			$this->messages->send_message($this->input->post('to'), $this->session->userdata('id'), $this->input->post('subject'), $this->input->post('message'));
		}
	}
	
	public function reply_process()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
			$this->messages->send_message($this->input->post('to'), $this->session->userdata('id'), $this->input->post('subject'), $this->input->post('message'));
		}
	}
	
}