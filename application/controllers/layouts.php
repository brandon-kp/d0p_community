<?php
class Layouts extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->data['notifications'] = check_notifications();
		$this->load->model('myaccount_model','myaccount');
		$this->load->model('layouts_model','layouts');
		$this->load->helper('form');
		$this->data['userprofile'] = $this->myaccount->for_account_page($this->session->userdata('login_session'));
		
		$this->template->set_layout('logged_in.php');
	}
	
	//create
	public function addlayout()
	{
		check_login();
		$this->data['errors'] = array();
		if($this->input->post())
		{
			$this->data['errors'] = $this->_addlayout_process($this->input->post());
		}
		
		$this->data['categories'] = $this->layouts->get_categories();
		$this->data['types'] = $this->layouts->get_types();
		$this->template
			->title('.^. Skem9 :: Add a Layout .^.')
			->build('partials/layouts/add_layout', $this->data);
	}
	
	public function _addlayout_process($post)
	{
		$errors = array();
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_width']  = '300';
		$config['max_height']  = '300';

		$this->load->library('upload', $config);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title','Title', 'required');
		$this->form_validation->set_rules('userfile','Preview Image', 'required');
		$this->form_validation->set_rules('notes','Notes', 'required');
		$this->form_validation->set_rules('tos','Terms of Service', 'required');
		
		if (!$this->upload->do_upload())
		{
			$errors = array('error' => $this->upload->display_errors());
		}
		else
		{
			$upload_info = array('upload_data'=>$this->upload->data());
			$file        = $upload_info['upload_data']['full_path'];
			$handle = fopen($file, "r");
			$data = file_get_contents($file);
			
			$pvars = array(
				'image' => base64_encode($data),
				'key' => '4d81f67729bb978c5a4539dc3645e154',
				'title' => '',
				'caption' => '',
			);
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, 'http://api.imgur.com/2/upload.json');
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
			
			$json = json_decode(curl_exec($curl),true); $json = $json['upload']['image'];
			curl_close ($curl);
			unlink($file);
		}
		if($this->form_validation->run() == TRUE)
		{
			$this->layouts->addlayout($json['hash'], $post['notes'], $post['code'], $this->session->userdata('id'), $post['category'], $post['type'], $post['title']);	
		}
		else
		{
			$errors = validation_errors();
		}
		
		return $errors;
	}
	
	
	
	//read
	public function index()
	{
		$this->data['categories'] = $this->layouts->get_categories();
		$this->data['types'] = $this->layouts->get_types();
		$this->template
			->title('.^. Skem9 :: Profile Layouts .^.')
			->build('partials/layouts/layouts_home', $this->data);
	}
	
}