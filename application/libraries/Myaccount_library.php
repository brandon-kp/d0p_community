<?php
class Myaccount_library {
	
	private $ci;
	
	public function __construct()
	{
		$this->ci =& get_instance();
	}
	
	public function get_birthdays()
	{
		$today = date('d-m');
		$users = array();
		
		$this->ci->load->model('myaccount_library_model','mlm');
		$buddies = $this->ci->mlm->get_buddies('34');
		
		foreach($buddies as $buddy)
		{
			if(date('d-m',$buddy['birthday']) == $today)
			{
				array_push($users,$buddy);
			}
		}
		
		return $users;
	}
	
	public function get_buddy_layouts()
	{
		$layouts = array();
		$this->ci->load->model('myaccount_library_model','mlm');
		$buddies = $this->ci->mlm->get_buddies('36');
		$layouts = $this->ci->mlm->get_users_latest_layout($buddies);
		
		return $layouts;
	}
	
}