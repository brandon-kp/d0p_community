<?php
class Signup extends CI_Controller {
	
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
	}
	
	public function index()
	{
		$this->template
			->inject_partial('errors', $this->session->userdata('errors'))
			->build('partials/signup_form', $this->data);
		$this->session->unset_userdata('errors');
	}
	
	public function tos()
	{
		$this->template->build('partials/tos');
		$this->session->set_userdata(array('tos_read'=>'true'));
	}
	
	public function process()
	{	
		$this->load->library('form_validation');
		$this->load->model('signup_model','signup');
		
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[40]');
		$this->form_validation->set_rules('email', 'Email', 'required|min_length[3]|max_length[100]|valid_email|is_unique[user_profile.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('password_conf', 'Password Confirmation', 'matches[password]');
		$this->form_validation->set_rules('year', 'Year', 'required|exact_length[4]|integer');
		$this->form_validation->set_rules('month', 'Month', 'required|exact_length[2]|integer|less_than[13]');
		$this->form_validation->set_rules('day', 'Day', 'required|exact_length[2]|integer|less_than[32]');
		$this->form_validation->set_rules('gender', 'Gender', 'required|max_length[7]|alpha');
		$this->form_validation->set_rules('tos', 'TOS', 'required');
		
		$username  = $this->input->post('username');
		$email     = $this->input->post('email');
		$password  = sha1(md5($this->input->post('password').$this->config->item('salt'))); 
		$birthday  = strtotime($this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day'));
		$gender    = $this->input->post('gender');
		$signed_up = time();
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata(array('errors'=>validation_errors()));
			redirect('signup');exit;
		}
		else
		{	
			$this->signup->new_user($username, $email, $password, $birthday, $gender, $signed_up);
			redirect('login');
		}	
	}
	
	public function test()
	{

	}
}