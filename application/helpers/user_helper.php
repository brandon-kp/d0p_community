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
	
	//check for new comments
	$coms = $ci->user_helper->check_new_comments($id);
	if($ci->session->userdata('id') !== '' AND count($coms) > 0)
	{
		$notification['new_comments'] = TRUE;
	}
	else
	{
		$notification['new_comments'] = FALSE;
	}
	return $notification;
	
}

function postcount_taglines($count)
{
	$tags = array(
	'0'=>' - No posts... How is this even here?',
	'1'=>' - Not a virgin? ... Skank.',
	'2'=>' - You\'re on a roll, keep going!',
	'3'=>' - It\'s getting fun, huh?',
	'5'=>' - At this point you may as well become a "regular".',
	'8'=>' - You sure know how to carry a conversation.',
	'13'=>' - A few people know your name by now.',
	'21'=>' - Somewhere between legal drinking age and Rob Quivers\' narcissism score.',
	'34'=>' - Shouldn\'t you be in bed by now?',
	'55'=>' Brilliant contributions.',
	'89'=>' - Basically a regular.'
	);
	//144 233 377 610 987 1597 2584 4181 6765
	
	foreach($tags as $key=>$value)
	{
		if($count <= $key)
		{
			return $value;
		}
	}
}

function format_tutorial_tags($tags)
{
	#$tags = str_replace(', ', ',', $tags);
	$tags = explode(',',$tags);
	foreach($tags as $tag)
	{
		$newtags[] = '<a href="'.site_url('tutorials/tag/'.rawurlencode($tag)).'">'.$tag.'</a>';
	}
	
	$tags = implode(', ',$newtags);
	
	return $tags;
}