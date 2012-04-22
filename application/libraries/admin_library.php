<?php
class Admin_library extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin_model','am');
	}
	
	public function pending_tutorials()
	{
		return $this->am->pending_tutorials();
	}
	
	public function approve_deny_tutorials($params)
	{
		if($params['action'] == 'approve')
		{
			$this->am->approve_tutorial($params['id']);
		}
		elseif($params['action'] == 'deny')
		{
			$this->am->delete_tutorial($params['id']);
		}
	}
	
	public function pending_layouts()
	{
		return $this->am->pending_layouts();
	}
	
	public function approve_deny_layouts($params)
	{
		if($params['action'] == 'approve')
		{
			$this->am->approve_layout($params['id']);
		}
		elseif($params['action'] == 'deny')
		{
			$layout = $this->am->get_single_layout($params['id']);
			$this->am->send_message($layout['userid'], '34', 'Your Layout "'.$layout['title'].'" Was Denied', "However, your code is saved here.\r\n[textarea]".$layout['code']."[/textarea]");
			$this->am->delete_layout($params['id']);
		}
	}
	
	public function compile_stats()
	{
		return $this->am->compile_stats();
	}
	
}