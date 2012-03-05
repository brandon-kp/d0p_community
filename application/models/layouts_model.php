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
			'title'=>$title
		));
	}
	
	public function get_categories()
	{
		return $this->db->get('layout_categories')->result_array();
	}
	public function get_types()
	{
		return $this->db->get('layout_types')->result_array();
	}
	
}