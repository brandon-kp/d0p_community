<?php
class Tutorials_library extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tutorials_model', 'tutorials');
	}
	
	public function get_categories()
	{
		return $this->tutorials->get_categories();
	}

	public function get_subcategories()
	{
		return $this->tutorials->get_subcategories();
	}
	
	public function handle_post($post)
	{
		if($post == false)
		{
			return false;
		}
		elseif(is_array($post))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('notes', 'Description', 'required');
			$this->form_validation->set_rules('code', 'Fulltext', 'required');
			
			if($this->form_validation->run() == TRUE)
			{
				$add = $this->tutorials->add_tutorial($post['title'], $this->session->userdata('id'), $post['tags'], $post['category'], $post['type'], $post['notes'], $post['code']);
				redirect('tutorials/viewtutorial/'.$add.'/');
			}
			else
			{
				return validation_errors();
			}
		}
	}
	
	public function get_tutorial()
	{
		return $this->tutorials->get_tutorial($this->uri->segment(3));
	}
	
	public function rate()
	{
		$this->data['id'] = $this->input->post('to');
		$this->data['tutorial'] = $this->tutorials->get_tutorial($this->data['id']);
		$voted_by = explode(',',$this->data['tutorial']['voted_by']);
		$thumbs_up = $this->data['tutorial']['thumbs_up'];
		$thumbs_down = $this->data['tutorial']['thumbs_down'];
		if(in_array($this->session->userdata('id'),$voted_by))
		{
			return false;
		}
		else
		{
			$voted_by = $this->session->userdata('id').',';
			if($this->input->post('thumbs_up'))
			{
				$this->tutorials->rate($thumbs_up+1,$thumbs_down,$this->data['id'],$voted_by);
			}
			elseif($this->input->post('thumbs_down'))
			{
				$this->tutorials->rate($thumbs_up,$thumbs_down+1,$this->data['id'],$voted_by);
			}
		}
	}
	
	public function get_all_categories()
	{
		return $this->tutorials->get_all_categories();
	}
	
	public function top_rated_tutorials()
	{
		return $this->tutorials->top_rated_tutorials();
	}
	
	public function newest_tutorials()
	{
		return $this->tutorials->newest_tutorials();
	}
	
	public function search_tag()
	{
		return $this->tutorials->search_tag($this->uri->segment(3));
	}
	
	public function get_for_cat()
	{
		return $this->tutorials->get_for_cat($this->uri->segment(3));
	}
	
}