<?php
$page_title = "Recipes";
$single_term = "recipe";
$plural_term = "recipes";


$filter = $_GET['filter'];
$id = (int)$_GET['id'];

$sub_section_filter = (int) $_GET['sub_section'];
$parent_filter = (int) $_GET['parent'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "recipes";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "recipes_ID;recipes_title;recipes_title_ar"; //Seperate with semicolumns;

$order = $_GET['order']!="" ? $_GET['order'] : $this_table_name."_ID";
$direction = $_GET['dir']=="" || $_GET['dir']==0  ? "desc" : "asc";
$page = (int)$_GET['page']!="" 	? (int)$_GET['page'] : 1;

//Handle Access Attr.
$add_item_flag = true;
$edit_item_flag = true;
$delete_item_flag = true;
$view_access_token = "can_view";
$add_access_token = "can_add";
$edit_access_token = "can_edit";
$delete_access_token = "can_delete";

?>
<?php include("header.php");?>
<script type="text/javascript">
$(document).ready(function(e) {
	 <?php
	if($filter == "add")
	{
	?>
    $('#articles_section').prepend("<option value='' selected >Choose One...</option>");

	<?php
	}
	?>
	
    $("#articles_section").change(function(e) {
        
		var aid = $(this).val();
		$("#articles_sections_ID").html("<option value=''>Loading...</option>");
		
		if( aid == "") {$("#articles_sections_ID").html("<option value=''></option>");return false;} 
		$.ajax({
			  url: "ajax/get_sections.php",
			  type: "POST",
			  data: {aid: aid , type : 'sub_section' },
			  cache: false,
			  dataType: "json",
			  success: function(success_array)
			  {
				  $("#articles_sections_ID").html(success_array.sections_list);
				  
			  },
			  error: function(xhr, ajaxOptions, thrownError)
			  {
			  }
			  
		});
    });//End of change
});
</script> 
<?php
//Add New Item Link
$add_extra_add_item_when_edit_form = false;
if($add_item_flag && in_array("$add_access_token", $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
}

?>

<?php
$current_upload_directory = $images_dir['recipes'];

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
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 220;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 170;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 220;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 170;

//Apply Image Crop1
$crop_settings_1 = array();
$current_cropsettings_index = 1 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "1";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 220;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 170;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 220;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 170;

//Apply Image Crop2
$crop_settings_2 = array();
$current_cropsettings_index = 2 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "1";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 220;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 170;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 220;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 170;



$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);


//IF a Form is submitted
if($_POST['submit'] == "Add" ||  $_POST['submit'] == "Edit" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);

	
	if($_POST['submit'] == "Add" )
	{
		// Mobile Homepage Featured
		if($_POST['recipes_feat_mobile'] == 1)
		{	
			$updt = $db->update($this_table_name , array('recipes_feat_mobile' => 0));
			
		}
		//First Unset ID before ADD
		$tobesaved['recipes_added_date']  = date("Y-m-d H:i:s");
		$tobesaved['recipes_measure_id']  = 1;
		$state = $db -> insert($this_table_name, $tobesaved);
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=added&filter=edit&id={$state}' </script>");
		}
		
	}
	if($_POST['submit'] == "Edit" )
	{
		// Mobile Homepage Featured
		if($_POST['recipes_feat_mobile'] == 1)
		{	
			$updt = $db->update($this_table_name , array('recipes_feat_mobile' => 0));
			
		}
		
		$tobesaved['recipes_update_date']  = date("Y-m-d H:i:s");
		$tobesaved['recipes_measure_id']  = 1;
		$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);

		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
		}
		
	}
	
	
}



if($filter == "edit" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$display_product = $db->querySelect('select recipes_products_ID as "id" , recipes_products_name as "value" from recipes_products');
$display_cuisines = $db->querySelect('select cuisines_ID as "id" , cuisines_name as "value" from cuisines');
$display_selection = $db->querySelect('select selection_ID as "id" , selection_name as "value" from selection');
$display_dish = $db->querySelect('select dish_ID as "id" , dish_name as "value" from dish');
$display_active = array(array("id" => "1" , "value" => "Yes"), array("id" => "0" , "value" => "No"));
$mobile_feat_home = array(array("id" => "1" , "value" => "Featured"), array("id" => "0" , "value" => "Not Featured"));

$form_array = array
(
	array("database_name" => "recipes_product_id" , "title" => "Product" , "type" => "select" , "required" => "1" ,"attached_options" => $display_product ,"current_value"=> $display['recipes_product_id'] ) ,
	array("database_name" => "recipes_dish_id" , "title" => "Dish" , "type" => "select" , "required" => "1" ,"attached_options" => $display_dish ,"current_value"=> $display['recipes_dish_id'] ) ,
	array("database_name" => "recipes_cuisine_id" , "title" => "Cuisine" , "type" => "select" , "required" => "1" ,"attached_options" => $display_cuisines ,"current_value"=> $display['recipes_cuisine_id'] ) ,
	array("database_name" => "recipes_selection_id" , "title" => "Selection" , "type" => "select" , "required" => "0" ,"attached_options" => $display_selection ,"current_value"=> $display['recipes_selection_id'] ) ,

	array("database_name" => "recipes_title" , "title" => "Title (English)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['recipes_title'] ) ,
	array("database_name" => "recipes_title_ar" , "title" => "Title (Arabic)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['recipes_title_ar'] ) ,
	array("database_name" => $pictures_columns[0] , "title" => "Image Max Size (200KB)" , "type" => "image" , "required" => "1" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[0]]) ,

	array("database_name" => "recipes_ingredients" , "title" => "Ingredients (English)" , "type" => "editor" ,"message" => "Please,Click ALT+CTRL+V to enter your text", "required" => "0" ,"current_value"=> $display['recipes_ingredients'] ) ,
	array("database_name" => "recipes_ingredients_ar" , "title" => "Ingredients (Arabic)" , "type" => "editor" ,"message" => "Please,Click ALT+CTRL+V to enter your text", "required" => "0" ,"current_value"=> $display['recipes_ingredients_ar'] ) ,

	array("database_name" => "recipes_brief" , "title" => "Berif (English)" , "type" => "textarea" , "required" => "0" ,"current_value"=> $display['recipes_brief'] ) ,
	array("database_name" => "recipes_brief_ar" , "title" => "Berif (Arabic)" , "type" => "textarea" , "required" => "0" ,"current_value"=> $display['recipes_brief_ar'] ) ,


	array("database_name" => "recipes_directions" , "title" => "Directions (English)" , "type" => "editor" ,"message" => "Please,Click ALT+CTRL+V to enter your text" , "required" => "0" ,"current_value"=> $display['recipes_directions'] ) ,
	array("database_name" => "recipes_directions_ar" , "title" => "Directions (Arabic)" , "type" => "editor" , "message" => "Please,Click ALT+CTRL+V to enter your text" , "required" => "0" ,"current_value"=> $display['recipes_directions_ar'] ) ,
    
	array("database_name" => $pictures_columns[2] , "title" => "Nutrition Facts (English)" , "type" => "image" , "required" => "0" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[2]]) ,
	array("database_name" => $pictures_columns[1] , "title" => "Nutrition Facts (Arabic)" , "type" => "image" , "required" => "0" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[1]]) ,
	

	array("database_name" => "recipes_keywords" , "title" => "Keywords (English)" , "type" => "text" , "required" => "0"  ,"message" => "seperate between words by ,","current_value"=> $display['recipes_keywords'] ) ,
	array("database_name" => "recipes_keywords_ar" , "title" => "Keywords (Arabic)" , "type" => "text" , "required" => "0" , "message" => "seperate between words by ,","current_value"=> $display['recipes_keywords_ar'] ) ,

	array("database_name" => "recipes_calories" , "title" => "Calories" , "type" => "text" , "required" => "0" ,"current_value"=> $display['recipes_calories'] ) ,
	array("database_name" => "recipes_preptime" , "title" => "Prepare Time" , "type" => "text" , "required" => "0" ,"current_value"=> $display['recipes_preptime'] ) ,
	array("database_name" => "recipes_cookingtime" , "title" => "Cooking Time" , "type" => "text" , "required" => "0" ,"current_value"=> $display['recipes_cookingtime'] ) ,
	array("database_name" => "recipes_servings" , "title" => "Servings" , "type" => "text" , "required" => "0" ,"current_value"=> $display['recipes_servings'] ) ,
	array("database_name" => "Active" , "title" => "Active" , "type" => "select" ,"attached_options" => $display_active, "required" => "0" ,"current_value"=> $display['Active'] ) ,	
  	array("database_name" => "recipes_feat_mobile" , "title" => "Mobile Homepage Featured" , "type" => "select" ,"attached_options" => $mobile_feat_home, "required" => "0" ,"current_value"=> $display['recipes_feat_mobile'] ) ,
	
	array("database_name" => "id"  , "type" => "hidden" ,"value"=> $id  )
	
);

?>

<script type="text/javascript">
$(document).ready(function(e) {
	 
 /*   $('.approve_toggle').click(function(e) {*/
		$("body").on("click", ".approve_toggle", function(e){
		//get id
		var id = $(this).data("id");
		var this_table_name = "<?php echo $this_table_name; ?>";
		//var column_required_to_toggle = "entry_approved";

		var column_required_to_toggle = $(this).attr('additional_attr');

		 
		$.ajax({
			  url: "ajax/toggle_item.php",
			  type: "POST",
			  data: {id : id , this_table_name:this_table_name ,column_required_to_toggle:column_required_to_toggle },
			  cache: false,
			  dataType: "json",
			  success: function(success_array)
			  {
				   $.gritter.add({
					class_name: 'notification_green_color',
					title: 'Updated!',
					text: 'Data are Updated.',
					sticky: false,
					time: '2500',
					fade_out_speed : 1500
						}); 
						
						//$(".displaytables tr[id="+id+"]  td.entry_approved").effect( "shake"  );

				   $(".displaytables tr[id="+id+"]  td."+column_required_to_toggle+"" ).css("color","green").html(success_array.returned_array ==0 ? "No" : "Yes");
				 
				
								 
			  },
			  error: function(xhr, ajaxOptions, thrownError)
			  {
				  
			  }
			  
	});
	
	e.preventDefault();
	
    });
	
});
</script>

<script>
 
function prepare_to_delete(id)
{
	var this_table_name = '<?php echo $this_table_name; ?>';
	var images_array = '<?php echo serialize($pictures_columns);  ?>';
	var images_dir = '<?php echo $current_upload_directory; ?>';
	
	//Delete 
	$.ajax({
			  url: "ajax/delete_single_item.php",
			  type: "POST",
			  data: {id : id,this_table_name:this_table_name , images_array : images_array,images_dir:images_dir },
			  cache: false,
			  dataType: "json",
			  success: function(success_array)
			  {			
			  		$.gritter.add({
						class_name: 'notification_green_color',
						title: 'Deleted!',
						text: 'Selected row deleted',
						sticky: false,
						time: '2500',
						fade_out_speed : 1500,
						 
					});
				 
				   $(".displaytables tr#"+id).remove();
				   
				   //Count no of lefted rows
				   var rows_length = $(".displaytables tr").length;
				   
				   if(rows_length == 1)
				   {
					   // Add new row
					   $(".displaytables").append("<tr><td colspan='10'>No <?php echo $plural_term; ?> were added yet</td></tr>");
					   
				   }
				
			  },
			  error: function(xhr, ajaxOptions, thrownError)
			  {
				
				 
				 
				
			  }
			  
	});
	
}
</script>

<!-- start content-outer -->
<section id="main" class="column">
 
<?php
if($filter == "add" )
{
	//Current User has access
	if(!in_array("$add_access_token", $current_array_of_actions) || !$add_item_flag )
	echo "<script type='text/javascript'>location.href='no_access.php'</script>";

	$generator->prepare_add_form($form_array);
}
elseif($filter == "edit" )
{
	if(!in_array("$edit_access_token", $current_array_of_actions) || !$edit_item_flag )
	echo "<script type='text/javascript'>location.href='no_access.php'</script>";
	
	if($state != "error"):
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
}
if(!isset($filter)):

$list_per_page = 10;

//Where Conditions
$search_query_string = $generator->generate_search_query($search_headers_attr,$search_query);


	
//Filters 
if($sub_section_filter)
$sub_section_string = " and sub_sections_sections_ID = ".$sub_section_filter;

if($parent_filter)
$parent_string = " and sub_sections_parent = ".$parent_filter;

//if ( $start_date_filter != "" )
//$start_date_filter_string = " and schedule_start_date='".$start_date_filter."'";

//Order by
$sort_by_query = "order by ".$order." ".$direction ;



//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name {$join} where 1 {$search_query_string} {$sub_section_string} {$parent_string}");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array("$view_access_token", $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name {$join} where 1 {$search_query_string}  {$sub_section_string} {$parent_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"recipes_title", "title" => "Name" , "url_sort" => $this_page_name_with_varibles , "order" => "recipes_title" ,"type"=> "text"),
		array("ID"=>"recipes_title_ar", "title" => "Name" , "url_sort" => $this_page_name_with_varibles , "order" => "recipes_title_ar" ,"type"=> "text"),
		array("ID"=>"recipes_link", "title" => "Recipe Link" , "url_sort" => $this_page_name_with_varibles , "order" => "" ,"type"=> "text"),
		array("ID"=>"recipes_image","title" => "Image" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "image" , "image_dir"=> $current_upload_directory ,"image_version" => "thumb" ),	
		array("ID"=>"Active","title" => "Active" , "url_sort" => $this_page_name_with_varibles , "order" => "Active", "type"=> "text")	,
		array("ID"=>"recipes_feat_mobile","title" => "Featured Home Mobile" , "url_sort" => $this_page_name_with_varibles , "order" => "recipes_feat_mobile", "type"=> "text")	,
	
	);
	
	// Additional Options
		$additional_options = array(
			array("title" => "Active" , "url" => "{$this_page_name_with_varibles}", "additional_attr" => "Active" , "pass_varible" => "" , "class_name"=>"approve_toggle" ,"icon" => "icon-3"),
		);
	
	//Filters Options
	/*if($sub_section_filter)
	{
		$display_parent = $db->querySelect("Select sub_sections_ID as 'id',sub_sections_name as 'value' from sub_sections where sub_sections_parent = ".$sub_section_filter);

		$filter_options= array(
			array("ID"=>"sub_section","title" => "Sub Sections" ,"type" => "select" , "attached_options" =>$display_section),
			array("ID"=>"parent","title" => "Parent" ,"type" => "select" , "attached_options" =>$display_parent),
			);
	}
	else
	{
		$filter_options= array(
		array("ID"=>"sub_section","title" => "Sub Sections" ,"type" => "select" , "attached_options" =>$display_section),
		);	
	}*/
	

	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array("$add_access_token", $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array("$edit_access_token", $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array("$delete_access_token", $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"extra" => $additional_options
				 
	 );
	 
	 $data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		
		$data[$i]['ID'] = $display[$i]['recipes_ID'];
		$data[$i]['recipes_title'] = $display[$i]['recipes_title'];
		$data[$i]['recipes_title_ar'] = $display[$i]['recipes_title_ar'];
		$data[$i]['recipes_link'] = '<a target="_blank" href="https://'.$_SERVER['HTTP_HOST'].'/ar/best_cook/delicious_recipes/'.$display[$i]['recipes_ID'].'/preview">Preview Link</a>';
		
		$data[$i]['recipes_image'] = $display[$i]['recipes_image'];
		$data[$i]['Active'] = $display[$i]['Active'] == "1" ? "Yes" : "No";
		$data[$i]['recipes_feat_mobile'] = $display[$i]['recipes_feat_mobile'] == "1" ? "Featured" : " ";
	
	}
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>


<?php include("footer.php"); ?>