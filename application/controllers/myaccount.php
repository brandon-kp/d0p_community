<?php 
class Myaccount extends CI_Controller {
	
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
		check_login();
		$this->data['notifications'] = check_notifications();
		$this->load->model('myaccount_model','myaccount');
		$this->data['userprofile'] = $this->myaccount->for_account_page($this->session->userdata('login_session'));
		
		$this->template->set_layout('logged_in.php');
	}
	
	public function index()
	{
		$this->data['account_info']    = $this->myaccount->for_account_page($this->session->userdata('login_session'));
		$this->data['account_updates'] = $this->myaccount->read_account_updates();
		
		$account_type = $this->data['account_info']['account_type'];
		
		$this->template
			->title('.^. Skem9 :: My Account .^.')
			->set_partial('toolbar','chunks/toolbar_'.$account_type)
			->build('partials/myaccount', $this->data);
			
		$this->session->set_userdata(array(
			'id'=>$this->data['account_info']['id'],
			'username'=>$this->data['account_info']['name'],
		));
	}

	
	
	/*
	 * Path::. myaccount/editprofile
	 * Contains the form for users to edit the main information visible on their
	 * profiles (main table, display name, side table, all of that stuff.
	 * 
	 */
	public function editprofile()
	{
		$this->load->helper('form');
		
		$this->data['account_info'] = $this->myaccount->for_account_page($this->session->userdata('login_session'));
		$this->template
			->set_layout('logged_in.php')
			->title('.^. Skem9 :: Edit Profile .^.')
			->inject_partial('errors', $this->session->userdata('errors'))
			->set_partial('toolbar','chunks/toolbar_'.$this->data['account_info']['account_type'])
			->build('partials/editprofile', $this->data);
		//errors need to be cleared AFTER the template's been rendered
		$this->session->unset_userdata('errors');		
	}
	
	public function editprofile_process()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Display Name', 'required|min_length[3]|max_length[40]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_userdata(array('errors'=>validation_errors()));
		}
		else
		{	
			/*
			 * rather than manually make each form field
			 * into a variable, this loops through the POST
			 * array and makes the field name the variable
			 * name, and value of the form field = the value
			 * of the variable.
			 */
			foreach($this->input->post() as $field=>$val)
			{
				$$field = $val;
			}
			$this->myaccount->edit_profile($this->session->userdata('id'),$this->session->userdata('login_session'),$name,$location,$signature,$side_title,$side_table,$main_table,$extra_title1,$extra_table1,$extra_title2,$extra_table2);
			redirect('myaccount/editprofile');
		}		
	}

	
	
	/*
	 * Path::. myaccount/uploadphotos
	 * The below handles the uploading of photos, into the user's gallery
	 */
	public function uploadphotos()
	{
		$this->load->helper('form');
		$this->data['userphotos'] = $this->myaccount->gallery($this->session->userdata('id'));
		
		$this->template
			->title('.^. Skem9 :: Upload Photos .^.')
			->set_layout('logged_in.php')
			->inject_partial('errors', $this->session->userdata('errors'))
			->set_partial('toolbar','chunks/toolbar_'.$this->data['userprofile']['account_type'])
			->build('partials/upload_photos',$this->data);
	}
	
	public function uploadphotos_process()
	{
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'gif|jpg|png';

		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			var_dump($error);
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
			$this->myaccount->upload_photo($this->session->userdata('id'), $json['hash'], '', $json['deletehash'], $json['type']);
			
			redirect('myaccount/uploadphotos');
		}		
	}
	
	public function updatephotos_process()
	{	
		if ($this->input->post('delete'))
		{
			$this->myaccount->delete_photo($this->input->post('delete'));
		}
		if ($this->input->post('default'))
		{
			$path = 'images/index/'.$this->input->post('default').'s';
			$this->myaccount->set_default_photo($path, $this->session->userdata('id'));
		}
		redirect('myaccount/uploadphotos');
	}
	
	
	
	/*
	 * Path::. myaccount/managebuddies
	 * This is the page where the user can approve or deny
	 * their buddy requests.
	 */
	public function managebuddies()
	{
		$this->load->helper('form');
		$this->data['account_info'] = $this->myaccount->for_account_page($this->session->userdata('login_session'));
		$this->data['pending_buddies'] = $this->myaccount->pending_buddies($this->session->userdata('id'));
		
		$account_type = $this->data['account_info']['account_type'];
		
		$this->template
			->title('.^. Skem9 :: Approve/Deny Buddies .^.')
			->set_partial('toolbar','chunks/toolbar_'.$account_type)
			->build('partials/manage_buddies', $this->data);		
	}
	
	public function managebuddies_process()
	{
		if($this->input->post('approve'))
		{
			$this->myaccount->approve_buddy($this->session->userdata('id'), $this->input->post('approve'));
		}
		elseif($this->input->post('deny'))
		{
			$this->myaccount->deny_buddy($this->session->userdata('id'), $this->input->post('deny'));
		}
		redirect('myaccount/managebuddies');
	}
}

