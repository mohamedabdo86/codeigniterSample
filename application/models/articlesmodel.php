<?php
class Articlesmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	/*
	Function : get_recent_recipes */
	function get_recent_articles($limit = 6 , $array_of_sections,$order_by = "ID")
    {
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->join('images', 'images_ID = articles_image');
		$this->db->where_in('articles_sections_ID', $array_of_sections);
		$this->db->where('Active', 1);
		$this->db->order_by('articles_'.$order_by,'Desc');
		$this->db->limit($limit);
		
		$query = $this->db->get();
		return $query->result_array();
		

    }
	
	/*
	Function : get_recent_recipes */
	function get_most_read_articles($limit = 6 , $section_id)
    {
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->join('images', 'images_ID = articles_image');
		$this->db->where('articles_sections_ID', $section_id);
		$this->db->where('Active', 1);
		$this->db->order_by('articles_views','Desc');
		$this->db->limit($limit);
		
		$query = $this->db->get();
		return $query->result_array();
		

    }
	
	function get_random_articles($limit = 3 , $section_id)
    {
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->join('images', 'images_ID = articles_image');
		$this->db->where('articles_sections_ID', $section_id);
		$this->db->where('Active', 1);
		$this->db->order_by('articles_views','random');
		$this->db->limit($limit);
		
		$query = $this->db->get();
		return $query->result_array();

    }
	
	/*
	Function : get_articles */
	function get_all_articles($limit,$start,$section_id,$feat = false,$display_both_feat_and_regular = false, $order_by = 'DESC')
    {
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->join('images', 'images_ID = articles_image');
		$this->db->where('articles_sections_ID', $section_id);
		$this->db->where('Active', 1);
		
		
		if($feat) {$this->db->order_by('articles_feat', $order_by);}
		//$this->db->where('articles_feat', 1);
		else {
			$this->db->order_by('articles_ID',$order_by);
			
			if(!$display_both_feat_and_regular)
			$this->db->where('articles_feat', 0);		
		}
					
		$query = $this->db->get();
		
		//Save Total Items before use the limit
		$total_numbers_of_rows = $query->num_rows();
		
		$get_last_generated_query = $this->db->last_query();
		
		//Apply the limit
		$query = $this->db->query($get_last_generated_query." Limit {$start},{$limit} ");
		
		return array($query->result_array() , $total_numbers_of_rows);
    }
	
	/*
	Function : get_detailed_articles */
	function get_detailed_articles($id)
    {
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->join('images', 'images_ID = articles_image');
		$this->db->where('articles_ID', $id);
		//$this->db->where('Active', 1);
		
		$query = $this->db->get();
		return $query->result_array();
		

    }
	
	
	/*
	Function : get_related_articles */
	function get_related_articles($id , $keywords , $current_language_db_prefix ,$section_id , $limit = 6)
    {
		//First, load helper
		/*$ci =& get_instance();
		$ci->load->helper('advanced_array');*/
		
		//Split Keywords
		/*$array_of_words = multipleExplode($keywords);*/
		
		//Prepare for the database
		/*$array_for_the_database  = fillKeyValue($array_of_words , "articles_title".$current_language_db_prefix);*/
		
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->join('images', 'images_ID = articles_image');
		$this->db->where('articles_ID <>', $id);
		$this->db->where('articles_sections_ID', $section_id);
		$this->db->where('Active', 1);
		$this->db->order_by('articles_ID','random');
		$this->db->limit($limit);
		
		/*$this->db->where('articles_ID <>', $id);*/
		
		$query = $this->db->get();
		return $query->result_array();
		

    }
	
	function get_feautred_articles($section_id)
    {
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->join('images', 'images_ID = articles_image');
		$this->db->where('articles_sections_ID', $section_id);
		//$this->db->where('articles_feat' , 1);
		$this->db->where('Active', 1);
		$this->db->order_by('articles_ID','random');
		$this->db->limit(1);
		
		$query = $this->db->get();
		$arrayofResults =  $query->result_array();
		
		if(empty($arrayofResults))
		{
			$this->db->select('*');
			$this->db->from('articles');
			$this->db->join('images', 'images_ID = articles_image');
			$this->db->where('articles_sections_ID', $section_id);
			$this->db->where('Active', 1);
			$this->db->order_by('articles_ID','random');			
		
			$query = $this->db->get();
			$arrayofResults =  $query->result_array();
		}
		
		return $arrayofResults;
    }
	
	/*
	Function : get_recent_recipes */
	function get_featured_abwan($id , $limit = 4)
    {
		
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->join('images', 'images_ID = articles_image');
		$this->db->where('articles_sections_ID', $id);
		$this->db->where('Active', 1);
		$this->db->order_by('articles_views','Desc');
		$this->db->limit($limit);
		
		$query = $this->db->get();
		return $query->result_array();
    }
	
	function get_feautred_homepage_articles($section_id)
    {
		$this->db->select('*');
		$this->db->from('articles');
		//Bermawy updates 7-7-2015
		//$this->db->join('sub_sections','sub_sections_ID = articles_sections_ID');
		//$this->db->join('sections','sections_ID = sub_sections.sub_sections_sections_ID');
		$this->db->join('images', 'images_ID = articles_image');
		//check eif the $section_id is array or not 
		if(is_array($section_id))
		{
			$this->db->where_in('articles_sections_ID', $section_id);
		}
		else
		{
			$this->db->where('articles_sections_ID', $section_id);
		}
		
		$this->db->order_by('articles_ID' , 'random');
		$this->db->where('Active', 1);
		$this->db->limit(1);
		
		$query = $this->db->get();
		return $query->result_array();

    }
	
//	SELECT * 
//FROM articles
//INNER JOIN sub_sections ON sub_sections.sub_sections_ID = articles.articles_sections_ID
//INNER JOIN sections ON sections.sections_ID = sub_sections.sub_sections_sections_ID
//WHERE articles_feat_mobile =1
//AND sections_ID =10
	
	function articles_featured_homepage_mobile($sec_id){
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->join('sub_sections','sub_sections_ID = articles_sections_ID');
		$this->db->join('sections','sections_ID = sub_sections.sub_sections_sections_ID');
		$this->db->join('images', 'images_ID = articles_image');
		$this->db->where('sections_ID' , $sec_id);
		$this->db->where('articles_feat_mobile' , 1);
		$this->db->where('Active', 1);
		$query = $this->db->get();
		return $query->result_array();
		}

}