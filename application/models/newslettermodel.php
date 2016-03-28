<?php
class Newslettermodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_newslettertypes_section($id)
    {
		$this->db->select('*');
		$this->db->from('newsletter_types');
		$this->db->where('newsletter_types_sections_ID', $id);
		$query = $this->db->get();
		return $query->result_array();
    }
	function get_newslettertypes_details($id)
    {
		$this->db->select('*');
		$this->db->from('newsletter_types');
		$this->db->where('newsletter_types_ID', $id);
		$query = $this->db->get();
		return $query->result_array();
    }
	
	function get_newslettertypes_mycorner_flag($id)
    {
		$this->db->select('*');
		$this->db->from('newsletter_types');
		$this->db->where('newsletter_types_sections_ID', $id);
		$this->db->where('newsletter_types_appear_at_mycorner', 1);
		$query = $this->db->get();
		return $query->result_array();
    }
	
	function check_newsletter_avialable($id)
    {
		$this->db->select('*');
		$this->db->from('pregnancy');
		$this->db->where('pregnancy_ID', $id);
		$query = $this->db->get();
		if($query->num_rows() == 0 ){
			return false;
		}else{
			return $query->result_array();
		}
    }
	
	/*
	Function : check_for_alreadyadded */
	function check_for_alreadyadded	($email , $type)
    {
		$this->db->select('*');
		$this->db->from('newsletter_members');
		$this->db->where('newsletter_members_newsletter_types_id', $type);
		$this->db->where('newsletter_members_members_emails', $email);
		$query = $this->db->get();
		return $query->result_array();
    }
	
	/*
	Function : add_new_record */
	function add_new_record($form_data)
    {
		$this->db->insert('newsletter', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;

    }
	
	function remove_record($email , $type)
    {
		$this->db->where('newsletter_email', $email);
		$this->db->where('newsletter_type_of_newsletter', $type);
		$this->db->delete('newsletter'); 
		return TRUE;
    }
	

}