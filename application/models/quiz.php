<?php
class Quizes extends CI_Model
{
	
	function __construct()
    {
        parent::__construct();
    }
	
	function get_quizes()
	{
		$this->db->select('*');
		$this->db->from('quizes');
		
		$query = $this->db->get();
		return $query->row_array();

	}
	
	function get_question($table,$foreign_id,$member_id)
	{
		$this->db->select('*');
		$this->db->from('members_rate');
		$this->db->where('members_rate_type', $table);
		$this->db->where('members_rate_foreign_id', $foreign_id);
		$this->db->where('members_rate_members_id', $member_id);
		
		$query = $this->db->get();
		return $query->num_rows();

	}
	
	function get_answers($type,$foreign_id,$member_id)
	{
		$this->db->select('*');
		$this->db->from('members_rate');
		$this->db->where('members_rate_type', $type);
		$this->db->where('members_rate_foreign_id', $foreign_id);
		$this->db->where('members_rate_members_id', $member_id);
		  
		$query = $this->db->get();
		return $query->row_array();
		  
	}

}

?>