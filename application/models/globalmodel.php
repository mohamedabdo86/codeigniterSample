<?php
class Globalmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	/*
	Function : check_viewed_before */
	function check_viewed_before($item_type , $item_id ,  $member_id , $ip ,$user_agent )
    {
		$this->db->select('*');
		$this->db->from('views');
		$this->db->where('views_type',$item_type);
		$this->db->where('views_item_id',$item_id);
		$this->db->where('views_ip',$ip);
		$this->db->where('views_user_agent',$user_agent);
		
		if($member_id != false)//IF member is logged in , search by members
		$this->db->where('views_members_ID',$member_id);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 0 ) return false;
		 
		return true;
    }//End of function check_viewed_before
	
	/*
	Function : add_view_to_view_table */
	function add_view_to_view_table($item_type , $item_id ,  $member_id , $user_ip_address , $user_agent )
    {
		 $form_data['views_type'] = $item_type;
		 $form_data['views_item_id'] = $item_id;
		 $form_data['views_date'] = date("Y-m-d H:i:s");
		 $form_data['views_members_ID'] = $member_id == false ? 0 : $member_id;
		 $form_data['views_ip'] = $user_ip_address;
		 $form_data['views_user_agent'] = $user_agent;
		 
		 $this->db->insert('views', $form_data);
		 
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
    }//End of function add_view_to_view_table
	
	
	/*
	Function : add_view_to_main_table */
	function add_view_to_main_table($item_id , $item_table_name , $item_table_column )
    {
	 
		 $this->db->set($item_table_column, $item_table_column.'+1', FALSE);
		 $this->db->where($item_table_name."_ID", $item_id);
		 
		 $this->db->update($item_table_name);
		 
		 
		 
		 
		 if ($this->db->affected_rows() == '1')
			{
				return TRUE;
			}
		
		return FALSE;
    }//End of function add_view_to_main_table
	
	/*
	Function : get_whyjoin_slideshow*/
	function get_whyjoin_slideshow($current_language_db_prefix = "")
    {
		$this->db->select('*');
		$this->db->from('gallery_images');
		$this->db->join('images', 'images_ID = gallery_images_src'.$current_language_db_prefix);
		$this->db->where('gallery_images_gallery_album_ID',2);
		$this->db->order_by('gallery_images_order','Asc');
		
		$query = $this->db->get();
		return $query->result_array();
	}//End of function get_whyjoin_slideshow
	
	/* Function : get_sections_slideshow */
	function get_sections_slideshow($id,$current_language_db_prefix = "")
    {
		$this->db->select('*');
		$this->db->from('section_slidesshow');
		$this->db->join('images', 'images_ID = section_slidesshow_image'.$current_language_db_prefix);
		$this->db->where('section_slidesshow_section_id',$id);
		$this->db->where('section_slidesshow_active',1);
		$this->db->order_by('section_slidesshow_ID','DESC');
		
		$query = $this->db->get();
		return $query->result_array();
	}//End of function get_sections_slideshow
	
	/* Function : get_sections_slideshow */
	function get_homepage_slideshow($current_language_db_prefix = "")
    {
		$this->db->select('*');
		$this->db->from('slidesshow');
		$this->db->join('images', 'images_ID = slidesshow_image'.$current_language_db_prefix);
		$this->db->where('slidesshow_active' , 1);
		$this->db->order_by('slidesshow_ID','DESC');
		
		$query = $this->db->get();
		return $query->result_array();
	}//End of function get_sections_slideshow
	
	/*Funcrion : get_section_tips*/
	function get_sections_tips($id)
	{
		$this->db->select('*');
		$this->db->from('section_tips');
		$this->db->where('section_tips_section_id' , $id);
		$this->db->order_by('section_tips_ID', 'RANDOM' );
		$this->db->limit(1);
		$query = $this->db->get();
		
		return $query->result_array();
		
	}//End of get_section_tips
	
	/*function get_sections_tips($id)
	{
		$this->db->select('*');
		$this->db->from('section_tips');
		$this->db->where('section_tips_section_id' , $id);
		$this->db->order_by('section_tips_ID');
		$query = $this->db->get();
		
		return $query->result_array();
		
	}//End of get_section_tips*/
	
	/*Funcrion : get_section_tips*/
	function get_section_data($id)
	{
		$this->db->select('*');
		$this->db->from('sub_sections');
		$this->db->where('sub_sections_ID' , $id);
		$query = $this->db->get();
		
		return $query->result_array();
		
	}//End of get_section_tips
	
	/*
	Function : get_ask_expert_questions*/
	function get_ask_expert_questions($limit,$start,$section_id, $language="", $flag = "")
    {
		$this->db->select('*');
		$this->db->from('ask_expert');
		$this->db->where('ask_expert_section_ID',$section_id);
		if($flag ==1 ){
		$this->db->where('ask_expert_question'.$language.' != ',"");
		}
		$this->db->where('ask_expert_approve',1);
		$this->db->order_by('ask_expert_ID','Desc');
		
		$query = $this->db->get();
		
		$total_numbers_of_rows = $query->num_rows();
		
		$get_last_generated_query = $this->db->last_query();
		//echo $get_last_generated_query;
		
		//Apply the limit
		$query = $this->db->query($get_last_generated_query." Limit {$start},{$limit} ");
		
		return array($query->result_array() , $total_numbers_of_rows);
	}//End of function get_ask_expert_questions
	
	/*
	Function : get_ask_expert_questions_mobile
	for mobile version
	*/
	function get_ask_expert_questions_mobile($section_id, $language="", $flag = "")
    {
		$this->db->select('*');
		$this->db->from('ask_expert');
		$this->db->where('ask_expert_section_ID',$section_id);
		if($flag ==1 )
		{
			$this->db->where('ask_expert_question'.$language.' != ',"");
		}
		$this->db->where('ask_expert_approve',1);
		$this->db->order_by('ask_expert_ID','Desc');
		
		$query = $this->db->get();
		
		return $query->result_array();
	
	}//End of function get_ask_expert_questions
	
	function get_ask_expert_answer_id($answer_id){
		$this->db->select('*');
		$this->db->from('ask_expert');
		$this->db->where('ask_expert_ID',$answer_id);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	/*
	Function : get_ask_expert_questions*/
	function get_applications($current_language_db_prefix="",$section_id , $subsection_id)
    {
		$this->db->select('*');
		$this->db->from('applications');
		$this->db->where('applications_sections_ID',$section_id);
		$this->db->where('applications_sub_sections_ID',$subsection_id);
		$this->db->where('applications_ishidden',0);
		$this->db->join('images', 'images_ID = applications_image'.$current_language_db_prefix, 'left');
		//$this->db->order_by('applications_order'.$current_language_db_prefix,'Asc');
		$this->db->order_by('applications_order','Asc');
		
		$query = $this->db->get();
		
		return $query->result_array();
		
	}//End of function get_ask_expert_questions
	
	function get_applications_mobile($current_language_db_prefix="",$section_id , $subsection_id)
    {
		$this->db->select('*');
		$this->db->from('applications');
		$this->db->where('applications_sections_ID',$section_id);
		$this->db->where('applications_sub_sections_ID',$subsection_id);
		$this->db->where('applications_ishidden',0);
		$this->db->where('applications_mobile',1);
		
		$this->db->join('images', 'images_ID = applications_image'.$current_language_db_prefix, 'left');
		//$this->db->order_by('applications_order'.$current_language_db_prefix,'Asc');
		$this->db->order_by('applications_order','Asc');
		
		$query = $this->db->get();
		
		return $query->result_array();
		
	}
	
	/*
	Function : get_application_details*/
	function get_application_details($id)
    {
		$this->db->select('*');
		$this->db->from('applications');
		$this->db->where('applications_ID',$id);
				
		$query = $this->db->get();
		
		return $query->result_array();
		
	}//End of function get_application_details
	
	
	/*Function : get_games*/
	function get_games($current_language_db_prefix="" , $subsection_id)
    {
		$this->db->select('*');
		$this->db->from('games');
		$this->db->where('games_subsection_ID',$subsection_id);
		$this->db->where('games_featured	',1);
		$this->db->where('Active',1);
		$this->db->join('images', 'images_ID = games_image', 'left');
		$this->db->order_by('games_name'.$current_language_db_prefix,'Asc');
		
		$query = $this->db->get();
		
		return $query->result_array();
		
	}//End of function get_games

	
	
	function get_image_src($id)
	{
		$this->db->select('images_src');
		$this->db->from('images');
		$this->db->where('images_ID',$id);
		
		$query = $this->db->get();
		
		if( $query->num_rows() == 0 )
		return false;
		
		$results = $query->result_array();
		
		return $results[0]['images_src'];
	}
	
	//get_ask_expert_banner
	function get_ask_expert_banner($id,$current_language_db_prefix)
	{
		$this->db->select('*');
		$this->db->from('static');
		$this->db->join('images', 'images_ID = static_banner'.$current_language_db_prefix.'');
		$this->db->where('static_var' , $id);
		$query = $this->db->get();
		
		return $query->result_array();
		
	}
	
	//Start of get_expert
	function get_expert($section_id)
	{
		$this->db->select('*');
		$this->db->from('static');
		$this->db->join('images', 'images_ID = static_image');
		$this->db->where('static_foreign_id' , $section_id);
		$this->db->where('static_type' , 'ask_expert');
		$query = $this->db->get();
		
		return $query->result_array();
		
	}//End of get_best_advice

		/*
	Function : get_ask_expert_questions*/
	function get_ask_expert_homepage($section_id,$limit,$lang)
    {
		$this->db->select('*');
		$this->db->from('ask_expert');
		$this->db->where('ask_expert_section_ID',$section_id);
		$this->db->where('ask_expert_question'.$lang.' != ',"");
		$this->db->where('ask_expert_approve',1);
		$this->db->order_by('ask_expert_ID','RANDOM');
		$this->db->limit($limit);
		$query = $this->db->get();
		
		return $query->result_array();
	}//End of function get_ask_expert_questions
	
	/**
	* Get random products's videos 
	* @return array
	*/
	function get_random_product_videos(){
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('videos_section_id',30);
		$this->db->order_by('videos_section_id', 'RANDOM');
		$this->db->limit(3);
		$query = $this->db->get();
		
		return $query->result_array();
		
	}
	//Get Latest 3 videos for the homepage
	function get_latest_videos_homepage()
	{
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('videos_approved' , 1);
		$this->db->order_by('videos_ID', 'DESC');
		$this->db->limit(3);
		$query = $this->db->get();
		
		return $query->result_array();
		
	}
	
	function set_submenu_active($id){
		$row = array('sub_section_active_url' => 0);
		$update = $this->db->update('sub_sections', $row);
		
		$data = array(
			'sub_section_active_url' => 1
		);
		$this->db->where('sub_sections_ID', $id);
		$update = $this->db->update('sub_sections', $data);
		
	}
	
	function get_products_promotions(){
		$this->db->select('*');
		$this->db->from('products_promotions');
		$this->db->join('images', 'images_ID = products_promotions_promotion_image');
		$this->db->where('products_promotions_active', 1);
		$this->db->order_by('products_promotions_id', 'RANDOM');
		$this->db->limit(4);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	function date_of_locked()
	{
		$this->db->select('*');
		$this->db->from('static');
		$this->db->where('static_ID', 10);
		$query = $this->db->get();
		
		return $query->result_array();
	}

}