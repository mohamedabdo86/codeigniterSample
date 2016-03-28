<?php
class Commentmodel extends CI_Model
{
	
	function __construct()
    {
        parent::__construct();
    }
	
	public function check_member_recipe($id){
		$this->db->select('*');
		$this->db->from('members_recipes');
		$this->db->join('members', 'members_ID = members_recipes_members_id');
		$this->db->where('members_recipes_ID', $id);
		  
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function insert_comments_to_db($tobesaved)
	{
		if(!empty($_POST))
		{
		$this->db->insert('comments',$tobesaved);
		}
	}
	
	function get_comments_from_db($table,$foreign_id)
	{
		$this->db->select('*');
		$this->db->from('comments');
		$this->db->where('comments_foreign_id', $foreign_id);
		$this->db->where('comments_type', $table);
		//$this->db->where('comments_members_id', $member_id);
		$this->db->where('comments_approve', 1);
		  
		$query = $this->db->get();
		return $query->result_array();
		  
	}
	
	public function insert_book_to_db()
	{
		if(!empty($_POST))
		{
			$members_id = $this->input->post('members_id');
			$foreign_id = $this->input->post('foreign_id');
			$section_id = $this->input->post('section_id');
			$section_type = $this->input->post('section_type');
			$type = $this->input->post('type');
			
			date_default_timezone_set('Africa/Cairo');
			$date = date("Y-m-d H:i:s");
			
			$tobesaved = array(
			'members_favorites_members_id'=>$members_id, 
			'members_favorites_foreign_id'=>$foreign_id, 
			'members_favorites_section_id'=>$section_id, 
			'members_favorites_section_type'=>$section_type,
			'members_favorites_type'=>$type, 
			'members_favorites_added_date'=>$date
			);
		
		$this->db->insert('members_favorites',$tobesaved);
		}
	}
	
	public function check_book_found()
	{
		$members_id = $this->input->post('members_id');
		$foreign_id = $this->input->post('foreign_id');
		$section_id = $this->input->post('section_id');
		$section_type = $this->input->post('section_type');
		$type = $this->input->post('type');
		
		$this->db->select('*');
		$this->db->from('members_favorites');
		$this->db->where('members_favorites_members_id', $members_id);
		$this->db->where('members_favorites_foreign_id', $foreign_id);
		$this->db->where('members_favorites_section_id', $section_id);
		$this->db->where('members_favorites_section_type', $section_type);
		$this->db->where('members_favorites_type', $type);
		
		$query = $this->db->get();
		return $query->result_array();
	}


}

?>