<?php
function check_login()
{
	$ci =& get_instance();
	
	if($ci->session->userdata('login_session') == '')
	{
		redirect('login');
		exit;
	}
}

function check_admin()
{
	$ci =& get_instance();
	$ci->load->model('user_helper');
	
	$login_session = $ci->session->userdata('login_session');
	$id            = $ci->user_helper->get_current_user($login_session);
	
	if(get_account_type($id) == '3') // 3 == admin
	{
		return true;
	}
	
	redirect('login');
}

function get_account_type($id)
{
	$ci =& get_instance(); 
	
	$ci->load->model('user_helper');
	return $ci->user_helper->get_account_type($id);
}

function get_current_user_profile($login_session)
{
	$ci =& get_instance();
	$ci->load->model('user_helper');
	$login_session = $ci->session->userdata('login_session');
	
	$data = $ci->user_helper->get_current_user_profile($login_session);
	return $data;
}

function check_notifications()
{
	$ci =& get_instance();
	$ci->load->model('user_helper');
	$id = $ci->session->userdata('id');
	$notification = array();
	
	//check for new private messages
	$msgs = $ci->user_helper->check_new_messages($id);
	if(count($msgs) > 0)
	{
		$notification['new_messages'] = TRUE;
	}
	else
	{
		$notification['new_messages'] = FALSE;
	}
	
	
	//check for new buddy requests
	$reqs = $ci->user_helper->check_buddy_requests($id);
	if(count($reqs) > 0)
	{
		$notification['buddy_requests'] = TRUE;
	}
	else
	{
		$notification['buddy_requests'] = FALSE;
	}
	return $notification;
	
}