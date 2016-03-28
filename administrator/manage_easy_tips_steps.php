<?php
$page_title = "Steps";
$single_term = "record";
$plural_term = "records";

$parent_page_title = "Manage Easy Tips";
$parent_page_name = "manage_easy_tips.php";

$filter = $_GET['filter'];
$id = (int)$_GET['id'];
$forignkey = (int) $_GET['forignkey'];

if($forignkey == "")
$forignkey = $_POST['easy_ideas_steps_easy_ideas_ID'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "easy_ideas_steps";
$this_page_name_with_varibles = "{$this_page_name}?forignkey=".$forignkey;
$state = $_GET['state'];

//Search Handle
//$search_query = $_GET['search_query'];
//$search_headers_attr = "gallery_album_title"; //Seperate with semicolumns;

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

<?php
//Add New Item Link
$add_extra_add_item_when_edit_form = false;
if($add_item_flag && in_array($add_access_token, $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
}

?>

<?php

$current_upload_directory = $images_dir['easy'];
//INitilize Fields with input File  , IMPORTANT for tobesaved generator

//Pictures Columns inilitize
$pictures_columns = array();
$pictures_columns[0] = "easy_ideas_steps_image";


$files_array_search = array ($pictures_columns[0]); 
$files_array = array 
(
	$pictures_columns[0] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" )
);

//Apply Image Crop
$crop_settings = array();
$current_cropsettings_index = 0 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "104:85";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 208;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 170;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 208;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 170;

$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);

//IF a Form is submitted
if($_POST['submit'] == "Add" ||  $_POST['submit'] == "Edit" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);
	
	if($_POST['submit'] == "Add" )
	{
		//First Unset ID before ADD
		$state = $db -> insert($this_table_name, $tobesaved);
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=added&filter=edit&id={$state}' </script>");
		}
		
	}
	if($_POST['submit'] == "Edit" )
	{		
		$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
		}
		
	}
	
	
}

if($filter == "edit" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$form_array = array
(
	array("database_name" => "easy_ideas_steps_title" , "title" => "Title" , "type" => "text" , "required" => "1" ,"current_value"=> $display['easy_ideas_steps_title'] ) ,
	array("database_name" => "easy_ideas_steps_title_ar" , "title" => "Title ( Arabic )" , "type" => "text" , "required" => "1" ,"current_value"=> $display['easy_ideas_steps_title_ar'] ) ,
	array("database_name" => $pictures_columns[0] , "title" => "Image" , "type" => "image" , "required" => "1" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[0]]) ,
	array("database_name" => "easy_ideas_steps_desc" , "title" => "Description" , "type" => "editor" , "required" => "0" ,"current_value"=> $display['easy_ideas_steps_desc'] ) ,
	array("database_name" => "easy_ideas_steps_desc_ar" , "title" => "Description (Arabic)" , "type" => "editor" , "required" => "0" ,"current_value"=> $display['easy_ideas_steps_desc_ar'] ) ,
	array("database_name" => "easy_ideas_steps_easy_ideas_ID"  , "type" => "hidden" ,"value"=> $forignkey  ),
	array("database_name" => "id"  , "type" => "hidden" ,"value"=> $id  )
);


?>
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
			  		//display here error message
					<?php
					$message_array = Messages::get_notifications_message("item_deleted");
					echo Messages::green_ballon($message_array['title'],$message_array['msg']);
					?>
				 
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
	if(!in_array($add_access_token, $current_array_of_actions) || !$add_item_flag )
	echo "<script type='text/javascript'>location.href='no_access.php'</script>";
	
	
	echo Messages::generate_notification_ballon($state);
	

	$generator->prepare_add_form($form_array);
}
elseif($filter == "edit" )
{
	if(!in_array($edit_access_token, $current_array_of_actions) || !$edit_item_flag )
	echo "<script type='text/javascript'>location.href='no_access.php'</script>";
	
	echo Messages::generate_notification_ballon($state);
	
	$generator->prepare_edit_form($form_array);
}
if(!isset($filter)):

//Where Conditions	
$search_query_string = $generator->generate_search_query($search_headers_attr,$search_query);

//Order by
$sort_by_query = "order by ".$order." ".$direction ;




//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name where 1 and easy_ideas_steps_easy_ideas_ID={$forignkey} {$search_query_string}");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where 1 and easy_ideas_steps_easy_ideas_ID={$forignkey} {$search_query_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"easy_ideas_steps_title", "title" => "Title" , "url_sort" => $this_page_name_with_varibles , "order" => "albums_name" ,"type"=> "text"),
		array("ID"=>"easy_ideas_steps_title_ar", "title" => "Title ( Arabic )" , "url_sort" => $this_page_name_with_varibles , "order" => "albums_name" ,"type"=> "text"),
		array("ID"=>"easy_ideas_steps_image","title" => "Image" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "image" , "image_dir"=> $current_upload_directory ,"image_version" => "thumb" ),		
		
		 );
	
	
	
	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array($add_access_token, $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array($edit_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array($delete_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles )
			
				 
	 );
	 
	 
	 //Filters Options
	 /*$filter_options= array(

	array("ID"=>"governments","title" => "Governments" ,"type" => "select" , "attached_options" =>$display_regions)
		
	);
	 */
	 
	 $data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		$data[$i]['ID'] = $display[$i]['easy_ideas_steps_ID'];		
		$data[$i]['easy_ideas_steps_title'] = $display[$i]['easy_ideas_steps_title'];
		$data[$i]['easy_ideas_steps_title_ar'] = $display[$i]['easy_ideas_steps_title_ar'];
		$data[$i]['easy_ideas_steps_image'] = $display[$i]['easy_ideas_steps_image'];
	 
	}
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>


