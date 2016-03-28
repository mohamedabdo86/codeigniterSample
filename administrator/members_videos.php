<?php
$page_title = "Members Videos";
$single_term = "record";
$plural_term = "records";

$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "videos";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

//Search Handle
//$search_query = $_GET['search_query'];
//$search_headers_attr = "news_ID;news_title"; //Seperate with semicolumns;

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

include("header.php");
require_once("nestle/pointssystem.php");
?> 


<?php
//Add New Item Link
$add_extra_add_item_when_edit_form = false;
if($add_item_flag && in_array($add_access_token, $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
}

?>

<?php

/*$current_upload_directory = $images_dir['ads'];
//INitilize Fields with input File  , IMPORTANT for tobesaved generator

//Pictures Columns inilitize
$pictures_columns = array();
$pictures_columns[0] = "ads_thumb";


$files_array_search = array ($pictures_columns[0]); 
$files_array = array 
(
	$pictures_columns[0] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" )
);

//Apply Image Crop
$crop_settings = array();
$current_cropsettings_index = 0 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "1";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 115;*/

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
		if($tobesaved['videos_approved_old'] != $tobesaved['videos_approved'])
			{
				$points_handler = new Pointssystem();
				if($tobesaved['videos_approved'] == 1)
				{
					$member = $db->querySelectSingle("select * from members_recipes join members on members_ID = members_recipes_members_id	 where members_recipes_ID = ".$tobesaved['videos_foreign_id']);
					
					$points_handler->approve_action($member['members_ID'] , $points_handler->upload_video_points, "upload_video", $_POST['id']);
				}
				else
				{
					$member = $db->querySelectSingle("select * from members_recipes join members on members_ID = members_recipes_members_id	 where members_recipes_ID = ".$tobesaved['videos_foreign_id']);

					$points_handler->disapprove_action($member['members_ID'] , $points_handler->upload_video_points);
				}
			}
			unset($tobesaved['videos_approved_old']);
	
		
		$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);
		//Check For trophies
		$trophies_handler = new Trophiessystem(2 , $member['members_ID']);
		$trophies_handler->check_requirments_of_member();
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
		}
		
	}
	
	
}

if($filter == "edit" )
$display = $db->querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$display_recipes = $db->querySelect("Select members_recipes_ID as 'id', members_recipes_name as 'value' from members_recipes");
$display_boolean = array(array("id"=>0,"value"=>"NO"),array("id"=>1, "value"=>"YES") );

$form_array = array
(	

	array("database_name" => "videos_name" , "title" => "Name" , "type" => "text" , "required" => "0" ,"current_value"=> $display['videos_name'] ) ,
	array("database_name" => "videos_foreign_id" , "title" => "Recipes" , "type" => "select" , "required" => "0" , "attached_options" => $display_recipes ,"current_value"=> $display['videos_foreign_id'] ) ,
	array("database_name" => "videos_url" , "title" => "Url" , "type" => "text" , "required" => "0" ,"current_value"=> $display['videos_url'] ) ,

  	array("database_name" => "videos_approved" , "title" => "Approve" , "type" => "select" , "required" => "1" ,"attached_options" => $display_boolean ,"current_value"=> $display['videos_approved'] ) ,
	array("database_name" => "videos_featured" , "title" => "Featured" , "type" => "select" , "required" => "0" , "current_value"=>$display['videos_featured'] , "attached_options" => $display_boolean ),	

	array("database_name" => "videos_approved_old"  , "type" => "hidden" ,"value"=>  $display['videos_approved']  ),


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

	$generator->prepare_add_form($form_array);
}
elseif($filter == "edit" )
{
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
}
if(!isset($filter)):

//Where Conditions	
$search_query_string = $generator->generate_search_query($search_headers_attr,$search_query);

//Order by
$sort_by_query = "order by ".$order." ".$direction ;


//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name where videos_member_flag = 1 {$search_query_string}  ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where videos_member_flag = 1 {$search_query_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"videos_name","title" => "Name" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "text" ),
		array("ID"=>"videos_foreign_id","title" => "Recipes" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "select" ,"attached_options" => $display_recipes )	,
		array("ID"=>"videos_member_name","title" => "Member" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "text" )	,
		array("ID"=>"videos_url","title" => "Url" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "text" )	,
		array("ID"=>"videos_approved" , "title" => "Approve" , "url_sort" => $this_page_name_with_varibles , "order" => "videos_approved" , "type"=> "select" , "attached_options" => $display_boolean)	,	
		array("ID"=>"videos_featured" , "title" => "Featured" , "url_sort" => $this_page_name_with_varibles , "order" => "videos_featured" , "type"=> "select" , "attached_options" => $display_boolean )	,
	);
	
	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array($add_access_token, $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array($edit_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array($delete_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				/*"extra" =>$additional_options*/
				 
	 );
	 
	 
	 $data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		$data[$i]['ID'] = $display[$i]['videos_ID'];
		$data[$i]['videos_name'] = $display[$i]['videos_name'];
		$data[$i]['videos_foreign_id'] = $display[$i]['videos_foreign_id'];
		
		$member = $db->querySelectSingle("select * from members_recipes join members on members_ID = members_recipes_members_id	 where members_recipes_ID = ".$display[$i]['videos_foreign_id']);
		
		$data[$i]['videos_member_name'] = $member['members_first_name']." ".$member['members_last_name'];
		$data[$i]['videos_url'] = "<a href='".$display[$i]['videos_url']."' target='_blank'><img src='".youtube($display[$i]['videos_url'])."' /></a>"; 		
		$data[$i]['videos_approved'] = $display[$i]['videos_approved'];
		$data[$i]['videos_featured'] = $display[$i]['videos_featured'] ;
	 
	}
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>


