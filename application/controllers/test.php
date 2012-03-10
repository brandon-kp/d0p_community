<?php
class Test extends CI_Controller {
	
	public function index()
	{	
		$this->load->library('Myaccount_library');
		$this->myaccount_library->get_buddy_layouts();
	}
	
}