<?php 
class Admin extends CI_Controller {
	
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		check_admin();
		$this->data['notifications'] = check_notifications();
		$this->load->model('myaccount_model','myaccount');
		$this->data['userprofile'] = $this->myaccount->for_account_page($this->session->userdata('login_session'));
		
		$this->template
			->set_layout('logged_in.php')
			->append_metadata('<link rel="stylesheet" href="'.base_url('assets/css/admin_panel/css/template.css').'" type="text/css" media="screen" charset="utf-8" />');

		$this->load->library('admin_library');
	}
	
	public function index()
	{
		$this->data['pending_layouts']   = $this->admin_library->pending_layouts();
		$this->data['pending_tutorials'] = $this->admin_library->pending_tutorials();
		$this->data['stats']             = $this->admin_library->compile_stats();
		$this->template
			->title('.^. Skem9 :: Admin Panel .^.')
			->build('partials/admin/admin_panel', $this->data);
		
	}
	
	public function layouts()
	{
		$params = $this->uri->uri_to_assoc(3);
		$this->admin_library->approve_deny_layouts($params);
	}
	
	public function tutorials()
	{
		$params = $this->uri->uri_to_assoc(3);
		$this->admin_library->approve_deny_tutorials($params);
	}
	
}