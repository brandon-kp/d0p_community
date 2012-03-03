<?php
class Logout extends CI_Controller {
	public $data = array();
	
	public function index()
	{
		$this->data['notifications'] = check_notifications();
		$login_session = $this->session->userdata('login_session');
		$this->session->sess_destroy();
		$this->load->model('logout_model','logout');
		redirect('login');
	}
	
}