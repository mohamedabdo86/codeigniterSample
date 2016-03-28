<?php
class Ratemodel extends CI_Model
{
	
	function __construct()
    {
        parent::__construct();
    }
	
	function get_rate_from_db($table,$foreign_id)
	{
		$table_ID = $table.'_ID';
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($table_ID, $foreign_id);
		
		$query = $this->db->get();
		return $query->row_array();

	}
	
	function check_rate($table,$foreign_id,$member_id)
	{
		$this->db->select('*');
		$this->db->from('members_rate');
		$this->db->where('members_rate_type', $table);
		$this->db->where('members_rate_foreign_id', $foreign_id);
		$this->db->where('members_rate_members_id', $member_id);
		
		$query = $this->db->get();
		return $query->num_rows();

	}
	
	function get_member_rate_from_db($type,$foreign_id,$member_id)
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