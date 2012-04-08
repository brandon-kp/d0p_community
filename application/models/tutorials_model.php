<?php
class Tutorials_model extends CI_Model {
	
	public function get_categories()
	{
		return $this->db->get('tutorial_categories')->result_array();
	}
	
	public function get_subcategories()
	{
		return $this->db->get('tutorial_subcategories')->result_array();
	}
	
	public function add_tutorial($title, $submitter, $tags, $category, $subcategory, $description, $text)
	{
		$time = time();
		$this->db
			->insert('tutorials',array(
				'title'       => $title,
				'submitter'   => $submitter,
				'tags'        => $tags,
				'category'    => $category,
				'subcategory' => $subcategory,
				'description' => $description,
				'text'        => $text,
				'date'        => $time,
			));
		
		//this is so we can redirec to the tutorial afterward;
		$return = $this->db->get_where('tutorials',array('date'=>$time))->result_array();
		return $return[0]['id'];
	}
	
	public function get_tutorial($id)
	{
		$this->db->join('user_profile','user_profile.id=tutorials.submitter');
		$this->db->join('tutorial_categories','tutorials.category');
		$this->db->join('tutorial_subcategories','tutorials.subcategory');
		$this->db->select('user_profile.name AS username, tutorials.*, tutorial_categories.title AS category_title, tutorial_subcategories.title AS subcategory_title');
		$query = $this->db->get_where('tutorials',array('tutorials.id'=>$id))->result_array();
		return $query[0];
	}
	
	public function get_all_categories()
	{
		$cats['subcats'] = $this->db->get('tutorial_subcategories')->result_array();
		$cats['maincats'] = $this->db->get('tutorial_categories')->result_array();
		return $cats;
	}
	
	public function top_rated_tutorials()
	{
		$this->db->join('user_profile','user_profile.id=tutorials.submitter');
		$this->db->select('tutorials.title, tutorials.thumbs_up, user_profile.name, user_profile.id as userid, tutorials.date, tutorials.description');
		$top = $this->db->get('tutorials')->result_array();
		var_dump($top);
		return $top;
	}
	
}