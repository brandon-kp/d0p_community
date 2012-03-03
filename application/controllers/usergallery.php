<?php
class Usergallery extends CI_Controller {
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		check_login();
		$this->data['notifications'] = check_notifications();
		$this->load->model('myaccount_model','myaccount');
		$this->data['userprofile'] = $this->myaccount->for_account_page($this->session->userdata('login_session'));
		$this->load->model('usergallery_model','usergallery');
	}
	
	public function index()
	{
		$id = $this->uri->segment(3);
		$this->data['usergallery'] = $this->usergallery->get_user_photos($id);
		
		$this->template
			->title('.^. Skem9 :: View Gallery .^.')
			->set_layout('logged_in.php')
			->build('partials/user_gallery',$this->data);
	}
	
	public function viewimage()
	{
		$hash = $this->uri->segment(3);
		$this->data['usergallery'] = $this->usergallery->get_single_photo($hash);
		
		$this->template
			->title('.^. Skem9 :: View Gallery .^.')
			->set_layout('logged_in.php')
			->build('partials/view_image',$this->data);
	}
}