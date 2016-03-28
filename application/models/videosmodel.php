<?php
class Videosmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->load->library('encrypt');
    }
	/*Function get all videos*/
	
	function get_all_section_videos($section_id,$limit,$start) {
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('videos_section_id' , $section_id);
		$this->db->where('videos_approved' , 1);
		$this->db->where('videos_member_flag ' , 0);
		$this->db->order_by('videos_ID','DESC');
		
		$query = $this->db->get();
		
		$total_numbers_of_rows = $query->num_rows();
		
		$get_last_generated_query = $this->db->last_query();
		$query = $this->db->query($get_last_generated_query." Limit {$start},{$limit} ");
		
		return array($query->result_array() , $total_numbers_of_rows);
	}
	
	function get_featured_best_cook_videos($limit)
	{
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('videos_section_id' , 2);
		$this->db->where('videos_approved' , 1);
		$this->db->where('videos_featured' , 1);
		$this->db->order_by('videos_ID','DESC');
		$this->db->limit($limit);
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	/* Function get_featured_video */
	function get_featured_video($section_id,$limit)
	{
		  $this->db->select('*');
		  $this->db->from('videos');
		  $this->db->where('videos_section_id' , $section_id);
		  $this->db->where('videos_member_flag' , 0);
		  $this->db->where('videos_approved' , 1);
		  $this->db->order_by('videos_ID','DESC');
		  $this->db->limit($limit);
		  		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_best_cook_videos($limit,$start)
 	{
	  $this->db->select('*');
	  $this->db->from('videos');
	  $this->db->where('videos_section_id' , 2);
	  $this->db->where('videos_approved' , 1);
	  $this->db->where('videos_featured' , 1);
	  $this->db->order_by('videos_ID','DESC');
	  
	  $query = $this->db->get();
		
		$total_numbers_of_rows = $query->num_rows();
		
		$get_last_generated_query = $this->db->last_query();
		$query = $this->db->query($get_last_generated_query." Limit {$start},{$limit} ");
		
		return array($query->result_array() , $total_numbers_of_rows);
	}

	function get_all_videos($limit,$start)
	{
		$this->db->select('*');
		$this->db->from('recipes_videos');
		$this->db->order_by('recipes_videos_ID','DESC');
		
		$query = $this->db->get();
		
		$total_numbers_of_rows = $query->num_rows();
		
		//$get_last_generated_query = $this->db->last_query();
		//$query = $this->db->query($get_last_generated_query." Limit {$start},{$limit} ");
		
		$query = $this->db->query($query." Limit {$start},{$limit} ");
		
		return array($query->result_array() , $total_numbers_of_rows);
	}
	
	
}