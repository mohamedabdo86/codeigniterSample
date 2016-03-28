<?php
class dynamic_posts_pages
{
	private $page_id;
	public $page_title;
	public $single_term;
	public $plural_term;
	public $this_page_name;
	public $this_table_name;
	public $this_page_name_with_varibles; 
	
	public function __construct($page_id)
	{
		$this->page_id = $page_id ;
		
		$this->this_table_name = "posts";
		$this->generate_main_varibles();
		
	}
	
	public static function get_full_type_name($type_id)
	{
		$type_field_name = '';
		switch($type_id)
				{
					case "text": $type_field_name = "Text Field"; break;
					case "textarea":$type_field_name = "Text Area"; break;
					case "date":$type_field_name = "Date"; break;
					case "select":$type_field_name = "Select"; break;
					
				}
		return $type_field_name;
	}
	
	private function generate_main_varibles()
	{
		global $db;
		//get options
		$display = $db->querySelectSingle("select * from pages where pages_ID=".$this->page_id);
		$this->page_title = $display['pages_title'];
		$this->single_term = $display['pages_single'];
		$this->plural_term = $display['pages_plural'];
		$this->this_page_name = "posts.php"."?page_ID=".$this->page_id;
		$this->this_page_name_with_varibles = $this->this_page_name;
		
		
		
	}
	public function generate_form_array($id=0,$type="Add")
	{
		global $db;
		//get Attr. from database
		$attr_display = $db->querySelect("select * from pages_attr where pages_attr_pages_ID=".$this->page_id." order by pages_attr_order");
		
		$form_array_preparation = array();
		
		if( $type == "Edit" )
		{
			$display = $this->get_all_post_details($id);
			//After we get the Main display ,start to get the cust. attr.
			
			
		}
		
		$added_value = 2;//to be used to increase the index of i 
		
		$form_array_preparation[0]['database_name'] = "posts_title";
		$form_array_preparation[0]['title'] = "Title";
		$form_array_preparation[0]['type'] = "text";
		$form_array_preparation[0]['required'] = 1;
		$form_array_preparation[0]['current_value'] = $display['posts_title'];
		
		$form_array_preparation[1]['database_name'] = "id";
		$form_array_preparation[1]['title'] = "Title";
		$form_array_preparation[1]['type'] = "hidden";
		$form_array_preparation[1]['required'] = 0;
		$form_array_preparation[1]['value'] = $id;
		
		for($i=0;$i<sizeof($attr_display);$i++):
		$form_array_preparation[($i+$added_value)]['database_name'] = $attr_display[$i]['pages_attr_value_ID'];
		$form_array_preparation[($i+$added_value)]['title'] = $attr_display[$i]['pages_attr_title'];
		$form_array_preparation[($i+$added_value)]['type'] = $attr_display[$i]['pages_attr_type'];
		$form_array_preparation[($i+$added_value)]['required'] = $attr_display[$i]['pages_attr_req'];
		$form_array_preparation[($i+$added_value)]['current_value'] = $display[$attr_display[$i]['pages_attr_value_ID']];
		endfor;
		
		
		return $form_array_preparation;
		
		
		
		
	}
	public function generate_auto_tobesaved_array($tobesaved_old)
	{
		global $db;
		$tobesaved = array();
		
		//Check Status 
		if($_POST['submit'] == "Add" )
		{
			//Add New Post
			$tobesaved['posts_title']  = $tobesaved_old['posts_title'];
			$tobesaved['posts_create_date'] = time();
			$tobesaved['posts_admin']  = 0; //to be implemnted
			$tobesaved['posts_parent_page']  = $this->page_id;
			$tobesaved['posts_parent_post']  = 0;//to be implemnted
			$tobesaved['posts_status']  = "publish";//to be implemnted
			$tobesaved['posts_slug']  = "slug here";//to be implemnted
			$state = $db->insert("posts",$tobesaved);
			//insert add. varibles
			unset($tobesaved);
			foreach($tobesaved_old as $key => $value):
			if($key == "posts_title" ) continue;
			$tobesaved['posts_extra_data_posts_ID'] = $state;
			$tobesaved['posts_extra_data_varible_ID'] = $key;
			$tobesaved['posts_extra_data_varible_value'] = $value;
			$db->insert("posts_extra_data",$tobesaved);
			endforeach;
			
			
			return $state;
			
		}
		
		if($_POST['submit'] == "Edit" )
		{
			//Edit Existing Post
			$tobesaved['posts_title']  = $tobesaved_old['posts_title'];
			$tobesaved['posts_parent_post']  = 0;//to be implemnted
			$tobesaved['posts_status']  = "publish";//to be implemnted
			$tobesaved['posts_slug']  = "slug here";//to be implemnted
			$state = $db->update("posts",$tobesaved,$this->this_table_name."_ID=".$_POST['id']);
			//insert add. varibles
			unset($tobesaved);
			//delete old varibles
			$db->query("delete from posts_extra_data where posts_extra_data_posts_ID=".$this->page_id);
			foreach($tobesaved_old as $key => $value):
			if($key == "posts_title" ) continue;
			$tobesaved['posts_extra_data_posts_ID'] = $_POST['id'];
			$tobesaved['posts_extra_data_varible_ID'] = $key;
			$tobesaved['posts_extra_data_varible_value'] = $value;
			$db->insert("posts_extra_data",$tobesaved);
			endforeach;
			
			
			return $state;
			
		}
		
	}
	
	public function get_all_post_details($id)
	{
		global $db;
		$display = array();
		
		$display = $db->querySelectSingle("select * from posts where posts_ID=".$id);
		
		//Get Addition options
		
		$attr_add_options = $db->querySelect("select * from posts_extra_data where posts_extra_data_posts_ID=".$id);
		for($i=0;$i<sizeof($attr_add_options);$i++)
		{
			$display[$attr_add_options[$i]['posts_extra_data_varible_ID']] = $attr_add_options[$i]['posts_extra_data_varible_value'];
		}
		
		return $display;
	}
	public function generate_headers()
	{
		global $db;
		$get_table_headers  = $db->	querySelect("select * from pages_header where pages_header_pages_ID=".$this->page_id." order by pages_header_order");
		
		$display = array();
		
		for($i=0;$i<sizeof($get_table_headers);$i++):
		//get detailed attr.
		$attr_display  = $db->querySelectSingle("select * from pages_attr where pages_attr_value_ID='".$get_table_headers[$i]['pages_header_pages_attr_value_ID']."' and pages_attr_pages_ID=".$this->page_id);
		$display[$i]['title'] = $attr_display['pages_attr_title'];
		$display[$i]['index'] = $i;
		$display[$i]['type'] =  $attr_display['pages_attr_type'];
		endfor;
		
		return $display;
		
		
	}
	
	public function generate_data()
	{
		global $db;
		$display = $db->querySelect("select * from posts where posts_parent_page=".$this->page_id);
		$headers = $db->querySelect("select * from pages_header where pages_header_pages_ID	=".$this->page_id." order by pages_header_order");
		$data = array(); 
		for($i=0;$i<sizeof($display);$i++):
		$detailed_post = $this->get_all_post_details($display[$i]['posts_ID']);
		$data[$i]['ID'] = $display[$i]['posts_ID'];
		//get selected attr
		 	for($j=0;$j<sizeof($headers);$j++):
			$data[$i][$j] = $detailed_post[$headers[$j]['pages_header_pages_attr_value_ID']];
			endfor;
		endfor;
		
		return $data;
		
	}
	
	
}
?>