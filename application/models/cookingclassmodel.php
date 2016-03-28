<?php
class Cookingclassmodel extends CI_Model
{
	
	function __construct()
    {
        parent::__construct();
    }
	
	
	function get_lesson_feature_image(){
		$this->db->select('*');
		$this->db->from('cooking_classes');
		$this->db->join('images', 'images_ID = cooking_classes_featured_image');
		$this->db->where('cooking_classes_featured',1);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_current_month_lesson_image($month)
	{
		$this->db->select('*');
		$this->db->from('cooking_classes_recipes');
		$this->db->join('recipes', 'recipes_ID = cooking_classes_recipes_recipes_ID');
		$this->db->join('images', 'images_ID = recipes_image');
		$this->db->join('cooking_classes', 'cooking_classes_recipes_cooking_classes_ID = cooking_classes_ID');
		$this->db->where('cooking_classes_month', $month);
		$this->db->order_by('cooking_classes_recipes_ID', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$ret = $query->row();
		$image = $ret->images_src;
		return $image;
	}
	function get_current_month_image($month)
	{
		$this->db->select('*');
		$this->db->from('cooking_classes');
		$this->db->join('images', 'images_ID = cooking_classes_image');
		$this->db->where('cooking_classes_month',$month);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_image($image_id)
	{
		$this->db->select('*');
		$this->db->from('images');
		$this->db->where('images_ID = '.$image_id.'');
		
		$query = $this->db->get();
		$ret = $query->row();
		$image = $ret->images_src;
		return $image;
	}
	
	function get_latest_recipes(){
		$this->db->select('*');
		$this->db->from('cooking_classes_recipes');
		$this->db->join('recipes', 'recipes_ID = cooking_classes_recipes_recipes_ID');
		$this->db->join('images', 'images_ID = recipes_image');
		$this->db->join('cooking_classes', 'cooking_classes_recipes_cooking_classes_ID = cooking_classes_ID');
		$this->db->order_by('cooking_classes_recipes_ID', 'RANDOM');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_last_lessons()
	{
		date_default_timezone_set("Egypt"); //Ahmed Al Bermawy 09-01-2015
		$current_month =  date("m"); //("Y/m/d H:i:s"); //Ahmed Al Bermawy 09-01-2015
		$this->db->select('*');
		$this->db->from('cooking_classes');
		$this->db->join('images', 'images_ID = cooking_classes_image'); //Ahmed Al Bermawy 6/8/2015
		$this->db->where('cooking_classes_month !=' , $current_month); //Ahmed Al Bermawy 09-01-2015
		$this->db->where('cooking_classes_featured' , 0);		
		$this->db->where('cooking_classes_active' , 1);
		$this->db->order_by('cooking_classes_ID', 'desc');
		$this->db->limit(2);
		$query = $this->db->get();
		return $query->result_array();
	}


	function get_random_cooking_class_recipe_images($cooking_class_id)
	{
		$this->db->select('*');
		$this->db->from('cooking_classes_recipes');
		$this->db->join('recipes', 'recipes_ID = cooking_classes_recipes_recipes_ID');
		$this->db->join('images', 'images_ID = recipes_image');
		$this->db->join('cooking_classes', 'cooking_classes_ID = cooking_classes_recipes_cooking_classes_ID');
		$this->db->where('cooking_classes_recipes_cooking_classes_ID ' , $cooking_class_id);
		$this->db->where('cooking_classes_active' , 1);
		//$this->db->order_by('recipes_ID', 'Desc');
		$this->db->order_by('cooking_classes_recipes_recipes_ID','ASC');
		$this->db->limit(1);
		$query = $this->db->get();
		$ret = $query->row();
		$image = $ret->images_src;
		return $image;
	}
	
	function get_random_gallery_images()
	{
		$this->db->select('*');
		$this->db->from('cooking_classes_gallery_images');
		$this->db->join('images', 'images_ID = cooking_classes_gallery_images_image');
		$this->db->order_by('cooking_classes_gallery_images_ID', 'RANDOM');
		$this->db->join('cooking_classes_gallery', 'cooking_classes_gallery_ID = cooking_classes_gallery_images_cooking_classes_gallery_ID');
		$this->db->where('cooking_classes_gallery_active', 1);
		$this->db->limit(1);
		$query = $this->db->get();
		$ret = $query->row();
		$image = $ret->images_src;
		return $image;
	}
	
	function get_lessons_galleries(){
		$this->db->select('*');
		$this->db->from('cooking_classes_gallery');
		//$this->db->join('cooking_classes_gallery_images', 'cooking_classes_gallery_images_cooking_classes_gallery_ID = cooking_classes_gallery_ID');
		$this->db->join('cooking_classes', 'cooking_classes_ID = cooking_classes_gallery_cooking_classes_ID');
		$this->db->join('images', 'images_ID = cooking_classes_gallery_images');
		//$this->db->where("cooking_classes_active",1);
		$this->db->where("cooking_classes_gallery_active",1);
		$this->db->order_by('cooking_classes_gallery_ID', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_gallery_images($id){
		$this->db->select('*');
		$this->db->from('cooking_classes_gallery_images');
		$this->db->join('images', 'images_ID = cooking_classes_gallery_images_image');
		$this->db->where("cooking_classes_gallery_images_cooking_classes_gallery_ID",$id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function current_month_lesson($id = "")
	{
		if($id)
		{
			$current_month =  $id;
		}
		else
		{
			date_default_timezone_set("Egypt");
			$current_month =  date("m"); //("Y/m/d H:i:s");
		}
		$this->db->select('*');
		$this->db->from('cooking_classes');
		$this->db->join('images', 'images_ID = cooking_classes_image');
		$this->db->where('cooking_classes_month', $current_month);
		$query = $this->db->get();
		return $query->result_array();

	}
	
	function current_month_recipes($current_month_id)
	{
		$this->db->select('*');
		$this->db->from('cooking_classes_recipes');
		$this->db->join('recipes' , 'recipes_ID = cooking_classes_recipes_recipes_ID');
		$this->db->join('images' , 'recipes_image = images_ID');
		$this->db->where('cooking_classes_recipes_cooking_classes_ID', $current_month_id);
		$query = $this->db->get();
		return $query->result_array();

	}
	
	function current_month_days($current_month_id, $export_for_select = true , $defaultvalue = "")
	{
		if($export_for_select)
		$this->db->select('cooking_classes_dates_ID as id, cooking_classes_dates_date as value');
		
		if(!$export_for_select)
		$this->db->select('*');

		$this->db->from('cooking_classes_dates');
		$this->db->where('cooking_classes_dates_cooking_classes_ID', $current_month_id);
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
	}
	
	/*Function : insert_pregnancy  */
	function insert_member_lesson($form_data)
	{
		$this->db->insert('cooking_classes_members', $form_data);
		
			return TRUE;
	}

	
}
?>