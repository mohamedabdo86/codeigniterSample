<?php
class Staticmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	/* Function : get_privacy_policy_desc */
	function get_privacy_policy_desc()
    {
		$this->db->select('*');
		$this->db->from('static');
		$this->db->where('static_ID', 7);

		$query = $this->db->get();
		return $query->result_array();
    }
	
	/* Function : get_privacy_policy_question_answer */
	function get_privacy_policy_question_answer()
    {
		$this->db->select('*');
		$this->db->from('privacy_policy');
		
		$query = $this->db->get();
		return $query->result_array();

    }
		/* Function : get_terms_conditions_desc*/
	function get_terms_conditions_desc()
	{
		$this->db->select('*');
		$this->db->from('static');
		$this->db->where('static_ID',6);
		
		$query = $this->db->get();
		return $query->result_array();
		
		
	} 
	
	
	/* Function : get_faq_desc */
	function get_faq_desc()
    {
		$this->db->select('*');
		$this->db->from('static');
		$this->db->where('static_ID', 8);

		$query = $this->db->get();
		return $query->result_array();
    }
	
	/* Function : get_email_admin_section */
	function get_email_admin_section($section_id) {
		$this->db->select('*');
		$this->db->from('static');
		$this->db->where('static_foreign_id',$section_id);

		$query = $this->db->get();		   
		return $query->result_array();				 
	}
	
	/*Function : get_all_from_static*/
	function get_all_from_static(){
			$this->db->select('*');
			$this->db->from('static');
	
			$query = $this->db->get();		   
			return $query->result_array();
		}
	
}
?>