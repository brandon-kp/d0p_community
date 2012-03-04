<?php
class Userprofile extends CI_Controller {
	
	public $data = array();
	public $id;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('userprofile_model','userprofile');
		$this->load->helper('date');
		$this->data['notifications'] = check_notifications();
		
		if($this->session->userdata('login_session') !== '')
		{
			$this->template->set_layout('logged_in.php');
		}
		else
		{
			$this->template->set_layout('default.php');
		}
		
		$this->load->model('myaccount_model','myaccount');
		$this->data['userprofile'] = $this->myaccount->for_account_page($this->session->userdata('login_session'));
		$this->id = str_replace('~','',$this->uri->segment(3));
	}
	public function index()
	{
		$this->load->helper('form');
		$this->data['profiledata'] = $this->userprofile->userprofile($this->id);
		$this->data['buddies']     = $this->userprofile->get_buddies($this->id);
		$this->data['comments']    = $this->userprofile->get_comments($this->id);
		$this->data['profiledata']
				   ['show_form']   = $this->_show_com_form();
		
		$this->template
			->title('.^. Skem9 :: View Profile::. '.$this->data['profiledata']['name'].'.^.')
			->append_metadata('<link rel="stylesheet" href="'.base_url('/assets/css/userprofile.css').'" />') //gotta change this in a bit
			->build('partials/user_profile', $this->data);
	}
	
	public function addbuddy()
	{
		check_login();
		$this->load->helper('form');
		$id = $this->uri->segment(3);
		$this->data['userprofile'] = $this->userprofile->userprofile($id);
			
		if(!is_numeric($this->uri->segment(3)))
		{
			show_error($this->lang->line('error_invalid_id'));
		}
		elseif($this->uri->segment(3) == $this->session->userdata('id'))
		{
			show_error($this->lang->line('error_add_self'));
		}
		elseif($this->userprofile->check_if_buddy($this->uri->segment(3), $this->session->userdata('id')))
		{
			show_error($this->lang->line('error_already_friends'));
		}
		elseif($this->userprofile->check_if_blocked($this->uri->segment(3), $this->session->userdata('id')))
		{
			show_error($this->lang->line('error_already_friends'));
		}
		
		$this->template
			->set_layout('logged_in.php')
			->title('.^.Skem9 :: Add Buddy .^.')
			->build('partials/add_buddy', $this->data);
	}
	
	public function addbuddy_process()
	{
		$this->userprofile->addbuddy($this->input->post('id'), $this->session->userdata('id'), $this->input->post('buddy_message'));
		echo "Now added to friends";
	}
	
	public function blockuser()
	{
		check_login();
		$this->load->helper('form');
		$id = $this->uri->segment(3);
		$this->data['userprofile'] = $this->userprofile->userprofile($id);
		
		if(!is_numeric($this->uri->segment(3)))
		{
			show_error('invalid user id');
		}
		elseif($this->uri->segment(3) == $this->session->userdata('id'))
		{
			show_error("you can't block yourself");
		}
		elseif($this->userprofile->check_if_blocked($this->session->userdata('id'), $this->uri->segment(3)))
		{
			show_error("Already blocked");
		}
		
		$this->template
			->set_layout('logged_in.php')
			->title('.^.Skem9 :: Block User .^.')
			->build('partials/block_user', $this->data);
	}
	
	public function blockuser_process()
	{
		$this->userprofile->blockuser($this->input->post('id'), $this->session->userdata('id'));
		echo "User is blocked";
	}
	
	/*
	 * check if the user is logged in
	 * if so: show comment form,
	 * else, return false
	 */
	public function _show_com_form()
	{
		if($this->session->userdata('login_session') == '')
		{
			return false;
		}
		return true;
	}
	
	
	public function allcomments()
	{
		$this->load->helper('form');
		$this->load->library('pagination');
		
		if($this->uri->segment(4) >1)
		{
			$offset = (
						(20) * $this->uri->segment(4) //20 * (example) 2 = 40
						/
						$this->uri->segment(4) //40 divided by 2 = 20
					); //and that's how you choose where to start selecting rows from the database
		}
		else
		{
			$offset = 0;
		}
		
		$this->data['comments']    = $this->userprofile->get_comments($this->id, '20', $offset);
		$this->data['profiledata'] = $this->userprofile->userprofile($this->id);
		$this->data['profiledata']
				   ['show_form']   = $this->_show_com_form();
		
		$config['base_url'] = site_url('userprofile/allcomments/'.$this->id.'/');
		$config['total_rows'] = count($this->data['comments']);
		$config['per_page'] = 10;
		$config['uri_segment'] = 4;
		$config['num_links'] = 10;
		$config['use_page_numbers'] = TRUE;
		$config['cur_tag_open'] = '<span>';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		$this->data['pages'] = $this->pagination->create_links();
		
		$this->template
			->title('.^. Skem9 :: View Comments::. '.$this->data['profiledata']['name'].'.^.')
			->build('partials/user_comments', $this->data);
	}
	
	/*
	 * process the comment submitted
	 * the goal here is to make this function work for wherever
	 * comments can be posted from
	 */
	public function comments_process()
	{
		var_dump($this->input->post());
		$this->userprofile->post_comment($this->input->post('to'), $this->session->userdata('id'), $this->input->post('text'));
	}

}