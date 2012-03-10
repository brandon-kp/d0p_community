<?php
class Layouts_model extends CI_Model {
	
	public function addlayout($preview_image, $notes, $code, $submitted_by, $category, $type, $title)
	{
		$this->db->insert('user_layouts',array(
			'preview_image'=>$preview_image,
			'notes'=>$notes,
			'code'=>$code,
			'submitted_by'=>$submitted_by,
			'category'=>$category,
			'type'=>$type,
			'title'=>$title,
			'date'=>time()
		));
		
		/*update the count for layouts in a given category. mainly for the layouts page*/
		$count = $this->db->select('count')->get_where('layout_categories', array('id'=>$category))->result_array();
		$new_count = $count[0]['count']+1;
		
		$this->db
			->where('id',$category)
			->update('layout_categories', array('count'=>$new_count));
	}
	
	public function get_categories()
	{
		return $this->db->get('layout_categories')->result_array();
	}
	public function get_types()
	{
		return $this->db->get('layout_types')->result_array();
	}
	
	public function get_single_type($type)
	{
		$q = $this->db->get_where('layout_types',array('id'=>$type))->result_array();
		return $q[0];
	}
	
	public function list_categories()
	{
		return $this->db->order_by('title', 'ASC')->get('layout_categories')->result_array();
	}
	
	public function get_layouts($offset, $site, $category='null')
	{
		if(isset($site))
		{
			$this->db->where('type',$site);
		}
		if($category !== 'null')
		{
			$this->db->where('category',$category);
		}
		
		return $this->db
					->order_by('date','DESC')
					->select('user_layouts.*, user_profile.name, user_profile.id AS user_id')
					->join('user_profile', 'user_profile.id=user_layouts.submitted_by')
					->get('user_layouts', '15', $offset)->result_array();
	}
	
	public function get_single_layout($id)
	{
		$query = $this->db
					->select('
						user_layouts.*,
						,layout_types.id AS type_id,  layout_types.title AS type_title, layout_types.description AS type_description, layout_types.keyword AS type_keyword
						,user_profile.name, user_profile.id')
					->join('user_profile', 'user_profile.id=user_layouts.submitted_by')
					->join('layout_types', 'layout_types.id=user_layouts.type', 'LEFT')
					->get_where('user_layouts',array('user_layouts.id'=>$id))->result_array();
		return $query[0];
	}
	
	public function rate($thumbs_up,$thumbs_down,$id,$by)
	{
		$this->db
			->where('id',$id)
			->update('user_layouts',array('thumbs_up'=>$thumbs_up, 'thumbs_down'=>$thumbs_down, 'voted_by'=>$by));
	}
	
}