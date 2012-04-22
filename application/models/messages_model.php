<?php
class Messages_model extends CI_Model {
	
	public function get_all_messages($id)
	{
		return $this->db
					->order_by('date','desc')
					->join('user_profile','user_profile.id = user_messages.from')
					->get_where('user_messages', array('to'=>$id))->result_array();
	}
	
	public function get_sent_messages($id)
	{
		return $this->db
					->order_by('date','desc')
					->join('user_profile','user_profile.id = user_messages.from')
					->get_where('user_messages', array('from'=>$id))->result_array();
	}
	
	public function get_message($hash, $id)
	{
		$query = $this->db
					->join('user_profile','user_profile.id = user_messages.from')
					->get_where('user_messages', array('hash'=>$hash))->result_array();
		return $query[0];
	}
	
	public function send_message($to, $from, $subject, $text)
	{
		$this->db->insert('user_messages',array(
			'to'=>$to,
			'from'=>$from,
			'subject'=>$subject,
			'text'=>$text,
			'date'=> time(),
			'hash'=>uniqid(),
			'status'=>'0',
		));
	}	
	
	public function mark_as_read($hash)
	{
		$this->db
			->where('hash',$hash)
			->update('user_messages',array('status'=>'1'));
	}
	
}