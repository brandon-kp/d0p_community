<?php
class Layouts extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->data['notifications'] = check_notifications();
		$this->load->model('myaccount_model','myaccount');
		$this->load->model('layouts_model','layouts');
		$this->load->helper('form');
		$this->data['userprofile'] = $this->myaccount->for_account_page($this->session->userdata('login_session'));
		
		if($this->session->userdata('id') !=='')
		{
			$this->template->set_layout('logged_in.php');
		}
	}
	
	//create	
	public function addlayout()
	{
		check_login();
		$this->data['errors'] = array();
		if($this->input->post())
		{
			$this->data['errors'] = $this->_addlayout_process($this->input->post());
		}
		
		$this->data['categories'] = $this->layouts->get_categories();
		$this->data['types'] = $this->layouts->get_types();
		$this->template
			->title('.^. Skem9 :: Add a Layout .^.')
			->build('partials/layouts/add_layout', $this->data);
	}
	
	public function _addlayout_process($post)
	{
		$errors = array();
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_width']  = '300';
		$config['max_height']  = '300';

		$this->load->library('upload', $config);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title','Title', 'required');
		//$this->form_validation->set_rules('userfile','Preview Image', 'required');
		$this->form_validation->set_rules('notes','Notes', 'required');
		$this->form_validation->set_rules('tos','Terms of Service', 'required');
		
		if (!$this->upload->do_upload())
		{
			$errors = array('error' => $this->upload->display_errors());
			var_dump($errors);
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
			
			if($this->form_validation->run() == TRUE)
			{
				$this->layouts->addlayout($json['hash'], $post['notes'], $post['code'], $this->session->userdata('id'), $post['category'], $post['type'], $post['title']);	
			}
			else
			{
				$errors = validation_errors();
			}			
		}
		
		return $errors;
	}
	
	
	
	//read
	public function index()
	{
		$this->data['categories'] = $this->layouts->get_categories();
		$this->data['types'] = $this->layouts->get_types();
		$this->template
			->title('.^. Skem9 :: Profile Layouts .^.')
			->build('partials/layouts/layouts_home', $this->data);
	}
	
	public function site()
	{
		$this->params = $this->uri->uri_to_assoc(2);
		$this->load->library('pagination');
		
		if(array_key_exists('page',$this->params) AND $this->params['page'] >1)
		{
			$offset = (
						(20) * $this->params['page'] //20 * (example) 2 = 40
						/
						$this->params['page'] //40 divided by 2 = 20
					); //and that's how you choose where to start selecting rows from the database
		}
		else
		{
			$offset = 0;
		}
		
		$this->data['type'] = $this->layouts->get_single_type($this->params['site']);
		$this->data['cats'] = $this->layouts->list_categories();
		$this->data['site'] = $this->uri->segment(3);
		
		if(!isset($this->params['category']))
		{
			$this->data['layouts'] = $this->layouts->get_layouts($offset, $this->params['site']);
		}
		else
		{
			$this->data['layouts'] = $this->layouts->get_layouts($offset, $this->params['site'], $this->params['category']);
		}
		
		$config['base_url'] = site_url('layouts/site/'.$this->data['site'].'/page/');
		$config['total_rows'] = count($this->data['layouts']);
		$config['per_page'] = 10;
		$config['uri_segment'] = 4;
		$config['num_links'] = 10;
		$config['use_page_numbers'] = TRUE;
		$config['cur_tag_open'] = '<span>';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		$this->data['pages'] = $this->pagination->create_links();
		
		$this->template
			->title('.^. Skem9 :: Profile Layouts .^.')
			->build('partials/layouts/layouts_site', $this->data);
	}
	
	public function review()
	{	
		$this->load->library('Comments');
		
		$this->data['id'] = $this->uri->segment(3);
		$this->data['layout'] = $this->layouts->get_single_layout($this->data['id']);
		$this->data['layout']['comment_form'] = $this->comments->post_comment('1', $this->data['id']);
		$this->data['layout']['comments'] = $this->comments->get_comments('1', $this->data['id']);
		
		$this->template
			->title('.^. Skem9 :: Review Layout .^.')
			->build('partials/layouts/layout_review', $this->data);
	}
	
	public function rate()
	{
		$this->data['id'] = $this->input->post('to');
		$this->data['layout'] = $this->layouts->get_single_layout($this->data['id']);
		$voted_by = explode(',',$this->data['layout']['voted_by']);
		$thumbs_up = $this->data['layout']['thumbs_up'];
		$thumbs_down = $this->data['layout']['thumbs_down'];
		if(in_array($this->session->userdata('id'),$voted_by))
		{
			return false;
		}
		else
		{
			$voted_by = $this->session->userdata('id').',';
			if($this->input->post('thumbs_up'))
			{
				$this->layouts->rate($thumbs_up+1,$thumbs_down,$this->data['id'],$voted_by);
			}
			elseif($this->input->post('thumbs_down'))
			{
				$this->layouts->rate($thumbs_up,$thumbs_down+1,$this->data['id'],$voted_by);
			}
		}
	}
	
	public function userlayouts()
	{
		
	}
	
}