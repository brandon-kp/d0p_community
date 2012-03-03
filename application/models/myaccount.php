<?php
class Myaccount_model extends CI_Model {
	
	public function for_account_page($login_session)
	{
		$query = $this->db->get_where('user_profile',array('login_session'=>$login_session))->result_array();
		return $query[0];
	}
	
	public function read_account_updates()
	{
		$query = $this->db
					->order_by('date')
					->join('user_profile', 'user_profile.id = update_entries.poster')
					->get_where('update_entries',array('update_entries.location'=>'account_page'), 2,0)
					->result_array();
		return $query;
	}
	
	public function edit_profile($id,$login_session,$name,$location,$signature,$side_title,$side_table,$main_table,$extra_title1,$extra_table1,$extra_title2,$extra_table2)
	{
		$this->db
			->where('login_session',$login_session)
			->where('id',$id)
			->update('user_profile',array(
				'name'=>$name,
				'location'=>$location,
				'signature'=>$signature,
				'side_table'=>$side_table,
				'main_table'=>$main_table,
				'extra_table1'=>$extra_table1,
				'extra_table2'=>$extra_table2,
				'side_title'=>$side_title,
				'extra_title1'=>$extra_title1,
				'extra_title2'=>$extra_title2,
			));
	}
	
	public function upload_photo($user_id, $imgur_hash, $caption, $delete_hash, $type)
	{
		$this->db
			->insert('user_photos',array(
				'user_id'=>$user_id,
				'hash'=>$imgur_hash,
				'caption'=>$caption,
				'delete_hash'=>$delete_hash,
				'type'=>$type
			));
	}
	
	public function parse_photo($hash) //used in controllers/images.php
	{
		$query = $this->db->get_where('user_photos',array('hash'=>$hash))->result_array();
		return $query[0];
	}
	
	public function gallery($id)
	{
		$query = $this->db->get_where('user_photos',array('user_id'=>$id))->result_array();
		return $query;
	}
	
	public function delete_photo($hash)
	{
		if(is_array($hash))
		{
			foreach($hash as $hashes)
			{
				$this->db->delete('user_photos',array('hash'=>$hashes));
			}
		}
		else
		{
			$this->db->delete('user_photos',array('hash'=>$hash));
		}
		
	}
	
	public function set_default_photo($path, $id)
	{
		$this->db
			->where('id',$id)
			->update('user_profile',array('photo'=>$path));
	}
	
	public function pending_buddies($id)
	{
		$query = $this->db
					->join('user_profile','user_profile.id=user_relationships.user_1')
					->select('user_profile.photo,user_profile.name,user_relationships.user_2,user_profile.photo,user_relationships.buddy_msg')
					->get_where('user_relationships',array('user_2'=>$id, 'buddy_status'=>'0'))
					->result_array();
		return $query;
	}
	
	public function approve_buddy($user_id, $friend_id)
	{
		$this->db
			->where('user_id',$user_id)
			->where('friend_id',$friend_id)
			->update('user_relationships',array(
												'relationship'=>'1',
												'status'=>'1',
												'message'=>''));
	}
	
	public function deny_buddy($user_id, $friend_id)
	{
		$this->db->delete('user_relationships',array('user_id'=>$user_id,'friend_id'=>$friend_id));
			
	}
	
}