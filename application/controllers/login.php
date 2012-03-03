<?php
class Login extends CI_Controller {
	
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('user_agent');
		if($this->session->userdata('login_session'))
		{
			redirect('myaccount');
			exit;
		}
	}
	
	public function index()
	{
		$this->template
			->inject_partial('errors', $this->session->userdata('errors'))
			->build('partials/login_form', $this->data);
		$this->session->unset_userdata('errors');
	}
	
	public function process()
	{
		$this->load->library('form_validation');
		$this->load->model('login_model','login');
		
		$this->form_validation->set_rules('email', 'Email', 'required|min_length[3]|max_length[100]|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		
		$email    = $this->input->post('email');
		$password = sha1(md5($this->input->post('password').$this->config->item('salt'))); 

		if($this->login->validate_user($email, $password) == true)
		{
			$login_session = md5($password.time());
			$this->login->login_user($email, $password, $login_session, time());
			$this->session->set_userdata(array('login_session'=>$login_session));
			redirect('myaccount');
		}
		else
		{
			$this->session->set_userdata(array('errors'=>'Invalid login credentials, try again.'));
			redirect('login');
		}
	}
	
}