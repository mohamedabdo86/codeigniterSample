<?php
$page_title = "Recipes";
$single_term = "recipe";
$plural_term = "recipes";

$parent_page_title = "Recipes";
$parent_page_name = "recipes_temp.php";

$filter = $_GET['filter'];
$id = (int)$_GET['id'];
$forignkey = (int) $_GET['forignkey'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "recipes";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

//Search Handle
//$search_query = $_GET['search_query'];
//$search_headers_attr = "gallery_album_title"; //Seperate with semicolumns;

$order = $_GET['order']!="" ? $_GET['order'] : $this_table_name."_ID";
$direction = $_GET['dir']=="" || $_GET['dir']==0  ? "desc" : "asc";
$page = (int)$_GET['page']!="" 	? (int)$_GET['page'] : 1;

//Handle Access Attr.
$add_item_flag = false;
$edit_item_flag = true;
$delete_item_flag = false;
$view_access_token = "can_view";
$add_access_token = "can_add";
$edit_access_token = "can_edit";
$delete_access_token = "can_delete";




?>
<?php include("header.php");?> 

<?php
//Add New Item Link
$add_extra_add_item_when_edit_form = false;
if($add_item_flag && in_array($add_access_token, $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
}

?>

<?php
//Add New Item Link
$add_extra_add_item_when_edit_form = false;
if($add_item_flag && in_array("can_add", $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
}

?>
<script>
$(document).ready(function(e) {
    
	$("input").prop('disabled', true);
	$("select").prop('disabled', true);
	$("textarea").prop('disabled', true);
});
</script>
<?php
$current_upload_directory = $images_dir['articles'];

//INitilize Fields with input File  , IMPORTANT for tobesaved generator

//Pictures Columns inilitize
$pictures_columns = array();
$pictures_columns[0] = "recipes_image";
$pictures_columns[1] = "recipes_nutrition_facts_image_ar";
$pictures_columns[2] = "recipes_nutrition_facts_image";



$files_array_search = array ($pictures_columns[0],$pictures_columns[1],$pictures_columns[2]); 
$files_array = array 
(
	$pictures_columns[0] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),
	$pictures_columns[1] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),
	$pictures_columns[2] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),

);


//Apply Image Crop0
$crop_settings = array();
$current_cropsettings_index = 0 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "1";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 115;

//Apply Image Crop1
$crop_settings_1 = array();
$current_cropsettings_index = 1 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "4:3";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 200;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 150;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 280;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 210;

//Apply Image Crop2
$crop_settings_2 = array();
$current_cropsettings_index = 2 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "4:3";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 200;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 150;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 280;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 210;

$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);

//echo $generator->generate_javascript_imagecrop($crop_settings);


//IF a Form is submitted
if($_POST['submit'] == "Edit" ||  $_POST['submit'] == "Add" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);

	 
	if($_POST['submit'] == "Add" )
	{
		$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=1");
	}
	
	
}
?>

<script>
$(document).ready(function(e) {
   var recipes_ingredients = $('#recipes_ingredients').val();
   $('#recipes_ingredients').remove();
  // $('#fieldset_recipes_ingredients').css('padding','15px')
 //  $('#fieldset_recipes_ingredients').append(recipes_ingredients);
   
   var recipes_ingredients_ar = $('#recipes_ingredients_ar').val();
   $('#recipes_ingredients_ar').remove();
   $('#fieldset_recipes_ingredients_ar').css('padding','15px')
   $('#fieldset_recipes_ingredients_ar').append(recipes_ingredients_ar);
   
   var recipes_directions = $('#recipes_directions').val();
   $('#recipes_directions').remove();
   $('#fieldset_recipes_directions').css('padding','15px')
   $('#fieldset_recipes_directions').append(recipes_directions);
   
   var recipes_directions_ar = $('#recipes_directions_ar').val();
   $('#recipes_directions_ar').remove();
   $('#fieldset_recipes_directions_ar').css('padding','15px')
   $('#fieldset_recipes_directions_ar').append(recipes_directions_ar);
});
</script>
<?php

$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID =".$forignkey); 

$display_product = $db->querySelect('select recipes_products_ID as "id" , recipes_products_name as "value" from recipes_products');
$display_cuisines = $db->querySelect('select cuisines_ID as "id" , cuisines_name as "value" from cuisines');
$display_selection = $db->querySelect('select selection_ID as "id" , selection_name as "value" from selection');
$display_dish = $db->querySelect('select dish_ID as "id" , dish_name as "value" from dish');
$display_active = array(array("id" => "-1" , "value" => "Active"), array("id" => "0" , "value" => "Not Active"));

$form_array = array
(
	array("database_name" => "recipes_product_id" , "title" => "Product" , "type" => "select" , "required" => "1" ,"attached_options" => $display_product ,"current_value"=> $display['recipes_product_id'] ) ,
	array("database_name" => "recipes_dish_id" , "title" => "Dish" , "type" => "select" , "required" => "1" ,"attached_options" => $display_dish ,"current_value"=> $display['recipes_dish_id'] ) ,
	array("database_name" => "recipes_cuisine_id" , "title" => "Cuisine" , "type" => "select" , "required" => "1" ,"attached_options" => $display_cuisines ,"current_value"=> $display['recipes_cuisine_id'] ) ,
	array("database_name" => "recipes_selection_id" , "title" => "Selection" , "type" => "select" , "required" => "0" ,"attached_options" => $display_selection ,"current_value"=> $display['recipes_selection_id'] ) ,

	array("database_name" => "recipes_title" , "title" => "Title (English)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['recipes_title'] ) ,
	array("database_name" => "recipes_title_ar" , "title" => "Title (Arabic)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['recipes_title_ar'] ) ,
	array("database_name" => $pictures_columns[0] , "title" => "Image" , "type" => "image" , "required" => "1" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[0]]) ,

	array("database_name" => "recipes_ingredients" , "title" => "Ingredients (English)" , "type" => "textarea" , "required" => "0" ,"current_value"=> $display['recipes_ingredients'] ) ,
	array("database_name" => "recipes_ingredients_ar" , "title" => "Ingredients (Arabic)" , "type" => "textarea" , "required" => "0" ,"current_value"=> $display['recipes_ingredients_ar'] ) ,

	array("database_name" => "recipes_brief" , "title" => "Berif (English)" , "type" => "textarea" , "required" => "0" ,"current_value"=> $display['recipes_brief'] ) ,
	array("database_name" => "recipes_brief_ar" , "title" => "Berif (Arabic)" , "type" => "textarea" , "required" => "0" ,"current_value"=> $display['recipes_brief_ar'] ) ,


	array("database_name" => "recipes_directions" , "title" => "Directions (English)" , "type" => "textarea" , "required" => "0" ,"current_value"=> $display['recipes_directions'] ) ,
	array("database_name" => "recipes_directions_ar" , "title" => "Directions (Arabic)" , "type" => "textarea" , "required" => "0" ,"current_value"=> $display['recipes_directions_ar'] ) ,

	array("database_name" => $pictures_columns[1] , "title" => "Image" , "type" => "image" , "required" => "1" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[1]]) ,
	array("database_name" => $pictures_columns[2] , "title" => "Image" , "type" => "image" , "required" => "1" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[2]]) ,

	array("database_name" => "recipes_keywords" , "title" => "Keywords (English)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['recipes_keywords'] ) ,
	array("database_name" => "recipes_keywords_ar" , "title" => "Keywords (Arabic)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['recipes_keywords_ar'] ) ,

	array("database_name" => "recipes_calories" , "title" => "Calories" , "type" => "text" , "required" => "0" ,"current_value"=> $display['recipes_calories'] ) ,
	array("database_name" => "recipes_preptime" , "title" => "Prepare Time" , "type" => "text" , "required" => "0" ,"current_value"=> $display['recipes_preptime'] ) ,
	array("database_name" => "recipes_cookingtime" , "title" => "Cooking Time" , "type" => "text" , "required" => "0" ,"current_value"=> $display['recipes_cookingtime'] ) ,
	array("database_name" => "recipes_servings" , "title" => "Servings" , "type" => "text" , "required" => "0" ,"current_value"=> $display['recipes_servings'] ) ,
	array("database_name" => "Active" , "title" => "Active" , "type" => "select" ,"attached_options" => $display_active, "required" => "0" ,"current_value"=> $display['Active'] ) ,	
  
	array("database_name" => "id"  , "type" => "hidden" ,"value"=> $id  )
	
);


?>

<!-- start content-outer -->
<section id="main" class="column">
 
<?php

if(!isset($filter)):


	if(!in_array($edit_access_token, $current_array_of_actions) || !$edit_item_flag )
	echo "<script type='text/javascript'>location.href='no_access.php'</script>";
	
	if($state!=""):
	?>
	<script type="text/javascript">
	$(document).ready(
	function()
	{
		 <?php
					$message_array = Messages::get_notifications_message("item_updated");
					echo Messages::green_ballon($message_array['title'],$message_array['msg']);
		?>
		
	}
	);
	</script>
	<?php
	endif;
	$generator->prepare_edit_form($form_array);


endif;
?>	 

</section>
