<?php
class Recipesmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->load->library('encrypt');
    }
	
	/*
	Function : get_recent_recipes */
	function get_recent_recipes($limit = 6)
    {
		$this->db->select('*');
		$this->db->from('recipes');
		$this->db->join('images', 'images_ID = recipes_image');
		$this->db->where('flag' ,0);
		$this->db->where('Active' ,1);
		$this->db->order_by('recipes_ID','Desc');
		$this->db->limit($limit);
		
		$query = $this->db->get();
		return $query->result_array();

    }/* end of get_recent_recipes */
		
	/*Function : get_members_recipes*/
	function get_members_recipes($limit = 3, $language = "")
	{
		$this->db->select('*');
		$this->db->from('members_recipes');
		$this->db->join('images' , 'images_ID = members_recipes_image');
		$this->db->join('members' , 'members_recipes_members_id = members_ID');
		$this->db->where('members_recipes_approved' ,1);
		$this->db->limit($limit);
		if($language == ""){
			$this->db->where('members_recipes_name REGEXP' ,'[A-Za-z0-9]');
		}else{
			$this->db->where('members_recipes_name NOT REGEXP' ,'[A-Za-z0-9]');
		}
		$this->db->order_by('members_recipes_ID' , 'random');
		
		$query = $this->db->get();
		return $query->result_array();
	}

	
	/*
	Function : get_topics_recipes */
	function get_topics_recipes()
    {
		$this->db->select('*');
		$this->db->from('inseason_recipies');
		$this->db->join('images', 'images_ID = inseason_recipies_image');
		$this->db->order_by('inseason_recipies_ID','Desc');
		$this->db->where('inseason_recipies_isnormaltopic' , 1);
		
		$query = $this->db->get();
		return $query->result_array();

    }/* end of get_topics_recipes */
	
	/*
	Function : get_topics_description */
	function get_topic_description($id)
    {
		$this->db->select('*');
		$this->db->from('inseason_recipies');
		$this->db->join('images', 'images_ID = inseason_recipies_image');

		$this->db->where('inseason_recipies_ID' , $id);
		//$this->db->limit($limit);
		
		$query = $this->db->get();
		return $query->result_array();

    }/* end of get_topics_recipes */
	
	/*
	Function : get_random_recipes_images */
	function get_random_recipes_images($inseason_id){
		$this->db->select('*');
		$this->db->from('inseason_recipies_w_recipies');
		$this->db->join('recipes', 'recipes_ID = inseason_recipies_w_recipies_recipes_ID');
		$this->db->join('images', 'images_ID = recipes_image');
		$this->db->where('flag' ,0);
		$this->db->where('inseason_recipies_w_recipies_inseason_recipies_ID' , $inseason_id);
		//$this->db->order_by('recipes_ID', 'Desc');
		$this->db->order_by('inseason_recipies_w_recipies_ord','ASC');
		$this->db->limit(1);
		$query = $this->db->get();
		$ret = $query->row();
		$image = $ret->images_src;
		return $image;
	}
	
	/*
	Function : get_topics_list_of_recipes */
	function get_topics_list_of_recipes($id,$limit,$start)
    {
		$this->db->select('*');
		$this->db->from('inseason_recipies_w_recipies');
		$this->db->join('recipes', 'recipes_ID = inseason_recipies_w_recipies_recipes_ID');
		$this->db->join('images', 'images_ID = recipes_image');
		$this->db->where('flag' ,0);
		$this->db->where('inseason_recipies_w_recipies_inseason_recipies_ID' , $id);
		$this->db->where('Active' ,1);
		$this->db->order_by('inseason_recipies_w_recipies_ord','ASC');
		//$this->db->limit($limit);
		
		$query = $this->db->get();
		
		//Save Total Items before use the limit
		$total_numbers_of_rows = $query->num_rows();
		
		$get_last_generated_query = $this->db->last_query();
		
		//Apply the limit
		$query = $this->db->query($get_last_generated_query." Limit {$start},{$limit} ");
		
		
		return array($query->result_array() , $total_numbers_of_rows);

    }/* end of get_topics_list_of_recipes */
	
		/*
	Function : get_topics_list_of_recipes */
	function get_related_topics_recipes($topics_id,$recipes_id,$limit)
    {
		$this->db->select('*');
		$this->db->from('inseason_recipies_w_recipies');
		$this->db->join('recipes', 'recipes_ID = inseason_recipies_w_recipies_recipes_ID');
		$this->db->join('images', 'images_ID = recipes_image');
		$this->db->where('flag' ,0);
		$this->db->where('inseason_recipies_w_recipies_inseason_recipies_ID' , $topics_id);
		$this->db->where('Active' ,1);
		$this->db->where('recipes_ID <>', $recipes_id);
		$this->db->limit($limit);
		$this->db->order_by("recipes_ID", "random"); 
		
		$query = $this->db->get();
		return $query->result_array();
		
    }/* end of get_related_topics_recipes */
	
	/*
	Function : get_inseason_recipes */
	function get_inseason_recipes()
    {
		$this->db->select('*');
		$this->db->from('inseason_recipies');
		$this->db->join('images', 'images_ID = inseason_recipies_image');
		$this->db->order_by('inseason_recipies_ID','Desc');
		$this->db->where('inseason_recipies_hidden' , 0);
		$this->db->where('inseason_recipies_isnormaltopic' , 0);
		
		$query = $this->db->get();
	
		return $query->result_array();

    }/* end of get_inseason_recipes */
	
		/*
	Function : get_current_inseason_recipes */
	function get_current_inseason_recipes()
    {
		$this->db->select('*');
		$this->db->from('inseason_recipies');
		$this->db->join('images', 'images_ID = inseason_recipies_image');
		$this->db->order_by('inseason_recipies_ID','Desc');
		$this->db->where('inseason_recipies_isnormaltopic' , 0);
		$this->db->where('inseason_recipies_current_flag' , 1);
		
		$query = $this->db->get();
		

		return $query->result_array();

    }/* end of get_current_inseason_recipes */
	
	
	
	/*
	Function : get_delicious_recipes */
	function get_delicious_recipes($limit,$start,
		$selected_value_of_text="",
		$selected_value_of_dish="",
		$selected_value_of_cuisines="",
		$selected_value_of_nestle_products="",
		$selected_value_of_duration="",
		$selected_value_of_selections="",
		$selected_value_of_calories="")
    {
		$this->db->select('*');
		$this->db->from('recipes');
		$this->db->join('images', 'images_ID = recipes_image');
		$this->db->where('flag' ,0);
		$this->db->where('Active' ,1);
		$this->db->order_by('recipes_ID','Desc');
		
		
		//Check Searching Items
		if($selected_value_of_text != "" ){
			$escaped_selected_text = $this->db->escape( $selected_value_of_text );
		//	$this->db->like('recipes_title', $selected_value_of_text);
		//	$this->db->or_like('recipes_title_ar', $selected_value_of_text);
		 	$this->db->where("(recipes_title Like '%{$selected_value_of_text}%' OR recipes_title_ar Like '%{$selected_value_of_text}%' )");
		   
		}
		
		if($selected_value_of_dish != "")
		$this->db->where('recipes_dish_id' , $selected_value_of_dish);
		
		if($selected_value_of_cuisines != "")
		$this->db->where('recipes_cuisine_id' , $selected_value_of_cuisines);
		
		if($selected_value_of_nestle_products != "")
		$this->db->where('recipes_product_id' , $selected_value_of_nestle_products);
////////////////////////////////////////////////////////////////////////////Bermawy
		if($selected_value_of_duration != "")
		{
			if($selected_value_of_duration == 1)
			{
				$this->db->where('recipes_cookingtime <', 30);
			}
			else if($selected_value_of_duration == 2)
			{
				$this->db->where('recipes_cookingtime >', 30);
				$this->db->where('recipes_cookingtime <', 45);
			}
			else
			{
				$this->db->where('recipes_cookingtime >', 45);
			}
			
		}
		//$this->db->where('recipes_cookingtime' , $selected_value_of_duration);
		
		if($selected_value_of_selections != "")
		$this->db->where('recipes_selection_id' , $selected_value_of_selections);
////////////////////////////////////////////////////////////////////////////Bermawy		
		if($selected_value_of_calories != "")
		{
			if($selected_value_of_calories == 1)
			{
				$this->db->where('recipes_calories >', 30);
				$this->db->where('recipes_calories <=', 149);
			}
			else if($selected_value_of_calories == 2)
			{
				$this->db->where('recipes_calories >=', 150);
				$this->db->where('recipes_calories <=', 199);
			}
			else if($selected_value_of_calories == 3)
			{
				$this->db->where('recipes_calories >=', 200);
				$this->db->where('recipes_calories <=', 299);
			}
			else
			{
				$this->db->where('recipes_calories >=', 300);
			}
			
		}
		//$this->db->where('recipes_calories' , $recipes_calories);
		
		$query = $this->db->get();
		//Save Total Items before use the limit
		$total_numbers_of_rows = $query->num_rows();
		
		$get_last_generated_query = $this->db->last_query();
		
		//Apply the limit
		$query = $this->db->query($get_last_generated_query." Limit {$start},{$limit} ");

		 
		//echo "Test last query".$str;
		$data = $query->result_array();
		if($data){
		return array($data , $total_numbers_of_rows);
		}

    }/* end of get_delicious_recipes */
	
	/*
	Function : get_all_members_recipes */
	function get_all_members_recipes($limit,$start,$selected_value_of_text="",
		$selected_value_of_dish="",
		$selected_value_of_cuisines="",
		$selected_value_of_nestle_products="",
		$selected_value_of_duration="",
		$selected_value_of_selections="",
		$selected_value_of_calories="")
    {
		$this->db->select('*');
		$this->db->from('members_recipes');
		$this->db->join('images', 'images_ID = members_recipes_image');
		$this->db->where('members_recipes_approved' , 1);
		$this->db->order_by('members_recipes_ID','Desc');
		
		/*$this->db->limit(12);*/
		
		//Check Searching Items
		if($selected_value_of_text != "" ){
		 	$this->db->like("members_recipes_name" , $selected_value_of_text);
		   
		}
		
		if($selected_value_of_dish != "")
		$this->db->where('members_recipes_dish_id' , $selected_value_of_dish);
		
		if($selected_value_of_cuisines != "")
		$this->db->where('members_recipes_cuisine_id' , $selected_value_of_cuisines);
		
		if($selected_value_of_nestle_products != "")
		$this->db->where('members_recipes_product_id' , $selected_value_of_nestle_products);
		
		if($selected_value_of_duration != "")
		$this->db->where('members_recipes_cookingtime' , $selected_value_of_duration);
		
		if($selected_value_of_selections != "")
		$this->db->where('members_recipes_selection_id' , $selected_value_of_selections);
/////////////////////////////////////////////////////////////////////////////////////////ahmed bermawy		
		if($selected_value_of_calories != "")
		$this->db->where('members_recipes_calories' , $selected_value_of_calories); //  $recipes_calories
		
		 
		$query = $this->db->get();
		
		//Save Total Items before use the limit
		$total_numbers_of_rows = $query->num_rows();
		
		$get_last_generated_query = $this->db->last_query();
		
		//Apply the limit
		$query = $this->db->query($get_last_generated_query." Limit {$start},{$limit} ");
		
		
		return array($query->result_array() , $total_numbers_of_rows);

    }/* end of get_all_members_recipes */
	
	function get_all_recipes($limit,$start,
		$selected_value_of_text="",
		$selected_value_of_dish="",
		$selected_value_of_cuisines="",
		$selected_value_of_nestle_products="",
		$selected_value_of_duration="",
		$selected_value_of_selections="",
		$selected_value_of_calories="")
    {
		
		$where_1 = "where Active = 1 ";
		
		if($selected_value_of_text != "" )
		{
			$escaped_selected_text = $this->db->escape( $selected_value_of_text );
		 	$where_1 .= " and (recipes_title Like '%{$selected_value_of_text}%' OR recipes_title_ar Like '%{$selected_value_of_text}%' )";
		}
				
		if($selected_value_of_dish != "")
		$where_1 .= " and recipes_dish_id = {$selected_value_of_dish} ";
		
		if($selected_value_of_cuisines != "")
		$where_1 .= " and recipes_cuisine_id = {$selected_value_of_cuisines} ";
		
		if($selected_value_of_nestle_products != "")
		$where_1 .= " and recipes_product_id = {$selected_value_of_nestle_products} ";
		
		if($selected_value_of_selections != "")
		$where_1 .= " and  recipes_selection_id = {$selected_value_of_selections} ";

		if($selected_value_of_duration != "")
		{
			if($selected_value_of_duration == 1)
			{
				$where_1 .= " and  recipes_cookingtime < 45 ";
			}
			else if($selected_value_of_duration == 2)
			{
				$where_1 .= " and  recipes_cookingtime = 45 ";
			}
			else
			{
				$where_1 .= " and  recipes_cookingtime > 45 ";
			}
		}
		
		if($selected_value_of_calories != "")
		{
			if($selected_value_of_calories == 1)
			{
				$where_1 .= " and  recipes_calories > 30 and recipes_calories <= 149 ";
			}
			else if($selected_value_of_calories == 2)
			{
				$where_1 .= " and  recipes_calories >= 150 and recipes_calories <= 199 ";
			}
			else if($selected_value_of_calories == 3)
			{
				$where_1 .= " and  recipes_calories >= 200 and recipes_calories <= 299 ";
			}
			else
			{
				$where_1 .= " and  recipes_calories >= 300 ";
			}
		}
		


		$where_2 = "where members_recipes_approved = 1 ";
		
		if($selected_value_of_text != "" )
		{
		 	$where_2 .= " and members_recipes_name Like '%{$selected_value_of_text}%' ";
		}
		
		if($selected_value_of_dish != "")
		$where_2 .= " and members_recipes_dish_id = {$selected_value_of_dish} ";
		
		if($selected_value_of_cuisines != "")
		$where_2 .= " and  members_recipes_cuisine_id = {$selected_value_of_cuisines} ";
		
		if($selected_value_of_nestle_products != "")
		$where_2 .= " and members_recipes_product_id = {$selected_value_of_nestle_products} " ;
		
		if($selected_value_of_duration != "")
		{
			if($selected_value_of_duration == 1)
			{
				$where_2 .= " and  members_recipes_cookingtime < 45 ";
			}
			else if($selected_value_of_duration == 2)
			{
				$where_2 .= " and  members_recipes_cookingtime = 45 ";
			}
			else
			{
				$where_2 .= " and  members_recipes_cookingtime > 45 ";
			}
		}
		
		if($selected_value_of_selections != "")
		$where_2 .= " and members_recipes_selection_id = {$selected_value_of_selections} ";
		
		if($selected_value_of_calories != "")
		{
			if($selected_value_of_calories == 1)
			{
				$where_2 .= " and  members_recipes_calories > 30 and members_recipes_calories <= 149 ";
			}
			else if($selected_value_of_calories == 2)
			{
				$where_2 .= " and  members_recipes_calories >= 150 and members_recipes_calories <= 199 ";
			}
			else if($selected_value_of_calories == 3)
			{
				$where_2 .= " and  members_recipes_calories >= 200 and members_recipes_calories <= 299 ";
			}
			else
			{
				$where_2 .= " and  members_recipes_calories >= 300 ";
			}
		}
		
		
		$query = $this->db->query("SELECT recipes_ID as 'id',recipes_title as 'title',recipes_title_ar as 'title_ar','admin' as 'type_of_recipe' ,
						total_rate as 'rates',images_src as 'image','none' as 'name' , recipes_views as 'views' from recipes
						inner join images on images_ID = recipes_image {$where_1} UNION ALL SELECT members_recipes_ID as 'id', 
						members_recipes_name as 'title','none' as 'title_ar','member' as 'type_of_recipe', total_rate as 'rates' ,images_src as 'image' , 
						CONCAT(members_first_name, ' ', members_last_name) as 'name' , members_recipes_views as 'views'  from members_recipes 
						inner join images on images_ID = members_recipes_image 
						inner join members on members_ID = members_recipes_members_id {$where_2} ");

			
		
		//$query = $this->db->get();
		//Save Total Items before use the limit
		$total_numbers_of_rows = $query->num_rows();
		
		$get_last_generated_query = $this->db->last_query();
		
		//Apply the limit
		$query = $this->db->query($get_last_generated_query." Limit {$start},{$limit} ");

		 
		//echo "Test last query".$str;
		return array($query->result_array() , $total_numbers_of_rows);

    }/* end of get_delicious_recipes */

	
	/*
	Function : get_detailed_articles */
	function get_detailed_recipe($id)
    {
		$this->db->select('*');
		$this->db->from('recipes');
		$this->db->join('images', 'images_ID = recipes_image');
		$this->db->where('flag' ,0);
		$this->db->where('recipes_ID', $id);
		$this->db->where('Active' ,1);

		
		$query = $this->db->get();
		return $query->result_array();
		

    }
	
	
	/*
	Function : get_detailed_articles */
	function get_detailed_member_recipe($id)
    {
		$this->db->select('*');
		$this->db->from('members_recipes');
		$this->db->join('images', 'images_ID = members_recipes_image');
		$this->db->where('members_recipes_ID', $id);
		$this->db->where('members_recipes_approved', 1);
		
		$query = $this->db->get();
		return $query->result_array();
		

    }
	
	/*
	Function : get selections for use in advanced search or upload  */
	function get_selections($current_language_db_prefix , $export_for_select = true , $defaultvalue = "")
    {
		if($export_for_select)
		$this->db->select('selection_ID as id, selection_name'.$current_language_db_prefix.' as value');
		
		if(!$export_for_select)
		$this->db->select('*');
		
		$this->db->from('selection');
		$this->db->order_by('selection_order','Asc');

		
		$query = $this->db->get();
		
		if($export_for_select)
		{
			if($defaultvalue != "")
			$data['']=$defaultvalue;
			
			
			foreach($query->result_array() as $row)
			{
           		 $data[$row['id']]=$row['value'];
        	}
			
			return $data;
		}
		
		return $query->result_array();
		
	}/* end of get_selections */
	
	/*
	Function : get dishes for use in advanced search or upload  */
	function get_dishes($current_language_db_prefix , $export_for_select = true , $defaultvalue = "")
    {
		if($export_for_select)
		$this->db->select('dish_ID as id, dish_name'.$current_language_db_prefix.' as value');
		
		if(!$export_for_select)
		$this->db->select('*');
		
		$this->db->from('dish');
		$this->db->order_by('dish_ID','Asc');

		
		$query = $this->db->get();
		
		if($export_for_select)
		{
			if($defaultvalue != "")
			$data['']=$defaultvalue;
			
			
			foreach($query->result_array() as $row)
			{
           		 $data[$row['id']]=$row['value'];
        	}
			
			return $data;
		}
		
		return $query->result_array();
		
	}/* end of get_dishes */
	
	/*
	Function : get cuisines for use in advanced search or upload  */
	function get_cuisines($current_language_db_prefix , $export_for_select = true , $defaultvalue = "")
    {
		if($export_for_select)
		$this->db->select('cuisines_ID as id, cuisines_name'.$current_language_db_prefix.' as value');
		
		if(!$export_for_select)
		$this->db->select('*');
		
		$this->db->from('cuisines');
		$this->db->order_by('cuisines_ID','Asc');

		
		$query = $this->db->get();
		
		if($export_for_select)
		{
			if($defaultvalue != "")
			$data['']=$defaultvalue;
			
			
			foreach($query->result_array() as $row)
			{
           		 $data[$row['id']]=$row['value'];
        	}
			
			return $data;
		}
		
		return $query->result_array();
		
	}/* end of get_cuisines */
	
	/*
	Function : get recipe products for use in advanced search or upload  */
	function get_recipe_products($current_language_db_prefix , $export_for_select = true , $defaultvalue = "")
    {
		if($export_for_select)
		$this->db->select('recipes_products_ID as id, recipes_products_name'.$current_language_db_prefix.' as value');
		
		if(!$export_for_select)
		$this->db->select('*');
		
		$this->db->from('recipes_products');
		$this->db->order_by('recipes_products_ID','Asc');

		
		$query = $this->db->get();
		
		if($export_for_select)
		{
			if($defaultvalue != "")
			$data['']=$defaultvalue;
			
			
			foreach($query->result_array() as $row)
			{
           		 $data[$row['id']]=$row['value'];
        	}
			
			return $data;
		}
		
		return $query->result_array();
		
	}/* end of get_recipe_products */
	
	/*
	Function : get duration options  Static , no connnections to database */
	function get_duration_options($defaultvalue = "")
    {
		$set_array =  array(
				  ''  => $defaultvalue ,
                  '1' => lang('bestcook_advancedsearch_duration_1'),
                  '2' => lang('bestcook_advancedsearch_duration_2'),
                  '3' => lang('bestcook_advancedsearch_duration_3'),
				   
		);
		
		return $set_array;
		
	}/* end of get_duration_options */
	
	/*
	Function : get calories options  Static , no connnections to database */
	function get_calories_options($defaultvalue = "")
    {
		$set_array =  array(
				   '' => $defaultvalue ,
                  '1' => lang('bestcook_advancedsearch_calories_option_1'),
                  '2' => lang('bestcook_advancedsearch_calories_option_2'),
                  '3' => lang('bestcook_advancedsearch_calories_option_3'),
				  '4' => lang('bestcook_advancedsearch_calories_option_4'),
		);
		
		return $set_array;
		
	}/* end of get_calories_options */
	
	function get_related_recipes($id , $keywords , $current_language_db_prefix ,$dish_id, $limit)
    {
		//First, load helper
		//$ci =& get_instance();
		//$ci->load->helper('advanced_array');
		
		//Split Keywords
		//$array_of_words = multipleExplode($keywords);
		
		//Prepare for the database
		//$array_for_the_database  = fillKeyValue($array_of_words , "articles_title".$current_language_db_prefix);
		
		$this->db->select('*');
		$this->db->from('recipes');
		$this->db->join('images', 'images_ID = recipes_image');
		$this->db->where('flag' ,0);
		$this->db->where('recipes_ID <>', $id);
		$this->db->where('Active' ,1);
		$this->db->where('recipes_dish_id', $dish_id);
		$this->db->limit($limit);
		$this->db->order_by("recipes_ID", "random"); 
		
		$query = $this->db->get();
		return $query->result_array();
		

    }
	
	function get_members_related_recipes($id , $keywords , $current_language_db_prefix ,$dish_id , $limit)
    {
		//First, load helper
		//$ci =& get_instance();
		//$ci->load->helper('advanced_array');
		
		//Split Keywords
		//$array_of_words = multipleExplode($keywords);
		
		//Prepare for the database
		//$array_for_the_database  = fillKeyValue($array_of_words , "articles_title".$current_language_db_prefix);
		
		$this->db->select('*');
		$this->db->from('members_recipes');
		$this->db->join('images', 'images_ID = members_recipes_image');
		$this->db->where('members_recipes_ID <>', $id);
		$this->db->where('members_recipes_dish_id', $dish_id);
		$this->db->where('members_recipes_approved' , 1);
		$this->db->limit($limit);
		$this->db->order_by("members_recipes_ID", "random"); 
		
		$query = $this->db->get();
		return $query->result_array();
		
    }
	/*
	Function : get_last_recipes */
	function get_last_recipes()
    {
		$this->db->select('*');
		$this->db->from('recipes');
		$this->db->join('images', 'images_ID = recipes_image');
		$this->db->where('flag' ,0);
		$this->db->where('Active' ,1);
		$this->db->order_by('recipes_ID','random');
		$this->db->limit(1);
		
		$query = $this->db->get();
		return $query->result_array();
    }
	
	/*Function : get_last_members_recipes*/
	function get_last_members_recipes($language="")
	{
		$this->db->select('*');
		$this->db->from('members_recipes');
		$this->db->join('images' , 'images_ID = members_recipes_image');
		$this->db->join('members' , 'members_recipes_members_id = members_ID');
		$this->db->where('members_recipes_approved' ,1);
		if($language == ""){
			$this->db->where('members_recipes_name REGEXP' ,'[A-Za-z0-9]');
		}else{
			$this->db->where('members_recipes_name NOT REGEXP' ,'[A-Za-z0-9]');
		}
		$this->db->limit(1);
		$this->db->order_by('members_recipes_ID' , 'random');
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	/*Function : get_last_members_recipes*/
	function get_most_read_recipes($limit = 3)
	{
		$query = $this->db->query("SELECT recipes_ID as 'id',recipes_title as 'title',recipes_title_ar as 'title_ar',
			'delicious_recipes' as 'method' , recipes_views as 'views' from recipes where Active = 1 AND flag = 0 UNION ALL SELECT members_recipes_ID as 'id', members_recipes_name as 'title', 'none' as 'title_ar' ,
			'your_recipes' as 'method', members_recipes_views as 'views'  from members_recipes where members_recipes_approved = 1 order by views desc ");
		
		$get_last_generated_query = $this->db->last_query();
		
		//Apply the limit
		$query = $this->db->query($get_last_generated_query." Limit {$limit} ");
		
		//$query = $this->db->get();
		return $query->result_array();
	}
	
	/**
	* Get recipes of inseason recipes
	*/
   function get_current_inseason_recipes_of_recipes($limit,$start,$id)
    {
		$this->db->select('*');
		$this->db->from('inseason_recipies');
		$this->db->join('inseason_recipies_w_recipies', 'inseason_recipies_w_recipies_inseason_recipies_ID = inseason_recipies_ID');
		$this->db->join('recipes', 'recipes_ID = inseason_recipies_w_recipies_recipes_ID');
		$this->db->join('images', 'images_ID = recipes_image');
		$this->db->where('flag' ,'0');
		$this->db->where('inseason_recipies_w_recipies_inseason_recipies_ID' , $id);
		
		$query = $this->db->get();
		//Save Total Items before use the limit
		$total_numbers_of_rows = $query->num_rows();
		
		$get_last_generated_query = $this->db->last_query();
		
		//Apply the limit
		$query = $this->db->query($get_last_generated_query." Limit {$start},{$limit} ");

		 
		//echo "Test last query".$str;
		return array($query->result_array() , $total_numbers_of_rows);

    }
	
	function get_bestcook_applications($section_id, $current_language_db_prefix=""){
		$this->db->select('*');
		$this->db->from('applications');
		$this->db->join('images', 'images_ID = applications_image'.$current_language_db_prefix.'');
		$this->db->where('applications_sections_ID' , $section_id);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	
	function get_bestcook_recipes_pdf($current_language_db_prefix,$result){
		$this->db->select('*');
		$this->db->from('recipes');
		$recipes='recipes_pdf'.$current_language_db_prefix;
		$this->db->where('flag' ,0);
		$this->db->where($recipes,$result);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_recipe_video($id,$section_id)
	{
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('videos_foreign_id',$id);
		$this->db->where('videos_section_id',$section_id);
		$this->db->where('videos_approved' ,1);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_dish_type($id)
	{
		$this->db->select('*');
		$this->db->from('dish');
		$this->db->where('dish_ID',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_single_cuisine($id)
	{
		$this->db->select('*');
		$this->db->from('cuisines');
		$this->db->where('cuisines_ID',$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
		function recipe_featured_homepage_mobile($sec_id){
		$this->db->select('*');
		$this->db->from('recipes');
		$this->db->join('images', 'images_ID = recipes_image');
		$this->db->where('flag' ,0);
		$this->db->where('recipes_feat_mobile' , 1);
		$query = $this->db->get();
		return $query->result_array();
		}

}