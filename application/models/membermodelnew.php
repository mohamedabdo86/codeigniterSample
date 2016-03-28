<?php
	
	class Membermodelnew extends CI_Model {

		function __construct()
		{
			parent::__construct();
			$this->load->library('encrypt');
		}
		
		function get_member_by_email($email) {
			$this->db->select('*');
			$this->db->from('members');
			$this->db->where('members_email',$email);
	
			$query = $this->db->get();
			return $query->result_array();
		}
		
		/*Function : get_awards_packages  */
		function get_awards_packages($id)
		{
			$this->db->select('*');
			$this->db->from('awards_package');
			//$this->db->join('images', 'images_ID = awards_images');
			$this->db->where('awards_package_awards_id', $id);
			
			$query = $this->db->get();
			return $query->result_array();
			
		}
		
		/*Function : get_awards  */
		function get_points_awards($points)
		{
			$this->db->select('awards_number, awards_package_title_ar, awards_package_title');
			$this->db->from('awards');
			$this->db->join('awards_package' , 'awards_ID = awards_package_awards_id');
			$this->db->where('awards_number >=', $points);
			$this->db->order_by('awards_number', 'asc');
			$this->db->limit(1);
			
			$query = $this->db->get();
			return $query->result_array();
			
		}
		
		function get_email_admin() {
			$query = $this->db->select('options_value')
				 		  ->from('options')
				 		  ->where('options_key', 'website_admin')
						  ->get()
						  ->result_array();
			return $query;
		}
			
	}
	
?>