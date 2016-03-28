<?php
class Sectionsmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	/*
	Function : get_children_sections */
	function get_children_sections($main_section_id,$type = "all")
    {
		$this->db->select('*');
		$this->db->from('sub_sections');
		$this->db->where('sub_sections_parent', $main_section_id); 
		$this->db->where('sub_sections_hide', 0); 
		$this->db->order_by('sub_sections_order', 'Asc'); 
		/*$this->db->join('images', 'sub_sections_image=images_src','left'); */
		
		if($type != "all")
		$this->db->where('sub_sections_type',$type ); 

		
		$query = $this->db->get();
		return $query->result_array();

    }
	
	/*
	Function : get_children_sections */
	function get_children_sections_mobile($main_section_id,$type = "all")
    {
		$this->db->select('*');
		$this->db->from('sub_sections');
		$this->db->where('sub_sections_parent', $main_section_id); 
		$this->db->where('sub_sections_hide', 0); 
		$this->db->where('sub_sections_mobile_hidden', 0);  
		$this->db->order_by('sub_sections_order', 'Asc'); 
		/*$this->db->join('images', 'sub_sections_image=images_src','left'); */
		
		if($type != "all")
		$this->db->where('sub_sections_type',$type ); 

		
		$query = $this->db->get();
		return $query->result_array();

    }
	
	
	/*
	Function : get_children_sections Over_ride */
	function get_children_sections_with_except($main_section_id,$type = "all" , $except)
    {
		$this->db->select('*');
		$this->db->from('sub_sections');
		$this->db->where('sub_sections_parent', $main_section_id); 
		$this->db->where('sub_sections_hide', 0); 
		$this->db->where('sub_sections_ID != ', $except); 
		$this->db->order_by('sub_sections_order', 'Asc'); 
		/*$this->db->join('images', 'sub_sections_image=images_src','left'); */
		
		if($type != "all")
		$this->db->where('sub_sections_type',$type ); 

		
		$query = $this->db->get();
		return $query->result_array();

    }
	
		/*
	Function : get_sections_details */
	function get_sections_details($id)
    {
		$this->db->select('*');
		$this->db->from('sub_sections');
		$this->db->where('sub_sections_ID', $id); 
		
		$query = $this->db->get();
		return $query->result_array();

    }
	
	function get_section_image($id)
    {
		$this->db->select('*');
		$this->db->from('sub_sections');
		$this->db->where('sub_sections_ID', $id); 
		$this->db->join('images', 'sub_sections_image=images_ID','left');
		
		$query = $this->db->get();
		$result =  $query->result_array();
		
		return $result[0]['images_src'];

    }
	
	
	function have_children($subsection_id,$special_type="")
	{
		$this->db->select('*');
		$this->db->from('sub_sections');
		$this->db->where('sub_sections_parent', $subsection_id);
		$this->db->where('sub_sections_hide',0); 
		if($special_type != "")
		$this->db->where('sub_sections_type',$special_type);
		
		$this->db->order_by('sub_sections_order', 'Asc');  
		
		$query = $this->db->get();
		$result_array = $query->result_array();
		
		if( empty ($result_array) )
		return FALSE;
		
		return $result_array;
		
	}
	
	function array_of_parent_ids($id)
	{
		$array_of_ids = array();
		$have_parent = true;
		
		$next_id_to_look_up = $id;
		
		$i = 0;
		
		while($have_parent)
		{
			unset($result_array);
			 
			$this->db->select('*');
			$this->db->from('sub_sections');
			$this->db->where('sub_sections_ID', $next_id_to_look_up); 
			$query = $this->db->get();
			$result_array = $query->result_array();
			
			$array_of_ids[] = $result_array[0]['sub_sections_ID'] ;
			
			if($result_array[0]['sub_sections_parent'] == 1 || $result_array[0]['sub_sections_parent'] == 2 ||  $result_array[0]['sub_sections_parent'] == 10 || $result_array[0]['sub_sections_parent'] == 27 || $result_array[0]['sub_sections_parent'] == 28 )
			{$have_parent = false;break;}

			
			
			$next_id_to_look_up = $result_array[0]['sub_sections_parent'] ;
			

		}
		
		return $array_of_ids;
		

	}
	
	/*
	Function : get_active_method id */
	function get_active_sub_section_data($current_method , $current_section ,$dynamic_id = false,$ignore_url = false)
	{
		
		//Important 
		///If Method is section, then we will apply more queries since section method is dynamic
		if($current_method == "section")
		{
			$this->db->where('sub_sections_ID', $dynamic_id); 
		}
		
		
		$this->db->select('*');
		$this->db->from('sub_sections');
		$this->db->where('sub_sections_sections_ID', $current_section); 
		if(!$ignore_url)
		$this->db->like('sub_sections_url', $current_method,'after'); 
		
		$query = $this->db->get();
		
		return $query->result_array();
		
	}/* End of get_active_sub_section_data */
	
	
	//Bermawy 29-01-2014
	function check_first_level($great_parent_id,$dynamic_id)
	{
		$this->db->select('*');
		$this->db->from('sub_sections');
		$this->db->where('sub_sections_ID', $dynamic_id);
		$this->db->where('sub_sections_sections_ID	', $great_parent_id);
		$this->db->where('sub_sections_parent', $great_parent_id);
		
		$query = $this->db->get();
		return $query->num_rows();

	}
	
	
	function get_other_sections($main_section,$current_sub_section_id,$type="")
	{
		$this->db->select('*');
		$this->db->from('sub_sections');
		$this->db->where('sub_sections_parent', $main_section);
		$this->db->where('sub_sections_hide',0); 
		$this->db->where('sub_sections_ID !=',$current_sub_section_id); 
		if($type != "")
		$this->db->where('sub_sections_type',$type); 
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_last_level_children($subsection_id,$special_type="")
	{		
		$tempChildren = $this->have_children($subsection_id,$special_type);
		$currentChildren = $tempChildren;
		while($tempChildren)
		{
			$tempChildren = $this->have_children($tempChildren[0]['sub_sections_ID'],$special_type);
			if($tempChildren)
			$currentChildren = $tempChildren;

		}
		return $currentChildren;
	}
	
	/*
	* Get Products Brand
	* @return array
	*/
	function get_products_brand(){
		$this->db->select('*');
		$this->db->from('products_brand');
		$this->db->join('images', 'images.images_ID = products_brand.products_brand_logo');
		$this->db->where('products_brand_active', "1");
		
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	function get_recipe_products_brand(){
		$this->db->select('*');
		$this->db->from('products_brand');
		$this->db->join('images', 'images.images_ID = products_brand.products_brand_logo');
		$this->db->where('products_brand_active', "1");
		$this->db->where('products_brand_is_recipe', "-1");
		
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	/*
	* Get Brand Order
	* @return number
	*/
	function get_brand_order($id){
		$this->db->select('products_brand_order');
		$this->db->from('products_brand');
		$this->db->where('products_brand_ID', $id);
		
		$query = $this->db->get();
		$result = $query->row();
		return $result->products_brand_order;
		
	}
	function getSectionNameByID($sectionID){
		$this->db->select('sections_name');
		$this->db->from('sections');
		$this->db->where('sections_ID' , $sectionID);
		$query->$this->db->get();
		$result = $query->row();
		return $result->sections_name;
		}
}