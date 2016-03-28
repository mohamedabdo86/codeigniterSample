<?php
$page_title = "Manage Quizes result";
$single_term = "item";
$plural_term = "items";
$quize_id=$_GET['fkey'];

$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "quizes_result";

$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];


//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "quizes_title"; //Seperate with semicolumns;


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
//$current_upload_directory = $images_dir['quizes'];
//
//$pictures_columns = array();
//$pictures_columns[0] = "quizes_image";
//$pictures_columns[1] = "quizes_image_ar";
//
//
//
//$files_array_search = array ($pictures_columns[0],$pictures_columns[1]); 
//$files_array = array 
//(
//	$pictures_columns[0] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),
//	$pictures_columns[1] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),
//
//);
//
//
////Apply Image Crop
//$crop_settings = array();
//$current_cropsettings_index = 0 ;
//$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "222:166";
//$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 222;
//$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 166;
//$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 222;
//$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 166;
//
////Apply Image Crop1
//$crop_settings_1 = array();
//$current_cropsettings_index = 1 ;
//$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "4:3";
//$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 200;
//$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 150;
//$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 280;
//$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 210;
//
//
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
$display = $db-> querySelectSingle("select * from $this_table_name where quize_result_quizes_ID ={$quize_id}"); 


$display_boolean = array(array("id" => 0, "value" => 'No') , array("id" => 1 , "value" => "Yes") ) ;
$form_array = array
(
	array("database_name" => "quizes_title" , "title" => "Title (English)" , "type" => "text" , "required" => "1" ,"current_value"=> $display['quizes_title'] ) ,
	array("database_name" => "quizes_title_ar" , "title" => "Title (Arabic)" , "type" => "text" , "required" => "1" ,"current_value"=> $display['quizes_title_ar'] ) ,
	array("database_name" => $pictures_columns[0] , "title" => "Image (English)" , "type" => "image" , "required" => "1" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[0]]) ,
	array("database_name" => $pictures_columns[1] , "title" => "Image (Arabic)" , "type" => "image" , "required" => "1" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[1]]) ,
	array("database_name" => "quizes_active" , "title" => "Active" , "type" => "select" , "required" => "0" , "current_value"=>$display['quizes_active'] , "attached_options" => $display_boolean ),
	array("database_name" => "quizes_flag"  , "type" => "hidden" ,"value"=> 'quiz'  ),
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


 



//Bulk Action
$bulk_actions_handler = $_POST['bulk_action'];

if($bulk_actions_handler == "delete_all")
{
	$bulk_actions_items = $_POST['items_checkbox'];
	for($i=0;$i<sizeof($bulk_actions_items);$i++):
	$db->query("delete from {$this_table_name} where quize_result_quizes_ID = ".$bulk_actions_items[$i]);
	endfor;
	
	
	echo "<script type='text/javascript'>location.href='{$this_page_name_with_varibles}&state=deletedall_success'</script>";
	
}

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



//Where Conditions	
$search_query_string = $generator->generate_search_query($search_headers_attr,$search_query);



 
//Order by
$sort_by_query = "order by ".$order." ".$direction ;


//Extra Query Attr

 







//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name  where quize_result_quizes_ID = '$id'  ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from  $this_table_name  where quize_result_quizes_ID = '$id'  {$search_query_string}  {$sort_by_query} {$paging_query} ");



//Table Header
	$table_header = array
	(
		array("ID"=>"quizes_title", "title" => "Title (English)" , "url_sort" => $this_page_name_with_varibles , "order" => "quizes_title" ,"type"=> "text"),
		array("ID"=>"quizes_title_ar", "title" => "Title (Arabic)" , "url_sort" => $this_page_name_with_varibles , "order" => "quizes_title_ar" ,"type"=> "text"),
		array("ID"=>"quizes_image","title" => "Image (English)" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "image" , "image_dir"=> $current_upload_directory ,"image_version" => "thumb" ),		
		array("ID"=>"quizes_image_ar","title" => "Image (Arabic)" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "image" , "image_dir"=> $current_upload_directory ,"image_version" => "thumb" ),		
		array("ID"=>"quizes_active" , "title" => "Active" , "url_sort" => $this_page_name_with_varibles , "order" => "quizes_active" , "type"=> "text"),
		 
	);

	 	$additional_options = array(
		array("title" => "View List of questions" , "url" => "manage_questions.php?", "pass_varible" => "fkey"),
		array("title" => "Active" , "url" => "{$this_page_name_with_varibles}", "additional_attr" => "quizes_active" , "pass_varible" => "" , "class_name"=>"approve_toggle" ,"icon" => "icon-3"),
	);
		 
	
	 
	
	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array($add_access_token, $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array($edit_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array($delete_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles )  ,
				"extra" =>$additional_options
				 
				 
	 );
	
	 
	 
	$data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		$data[$i]['ID'] = $display[$i]['quizes_ID'];
		$data[$i]['quizes_title'] = $display[$i]['quizes_title'];
		$data[$i]['quizes_title_ar'] = $display[$i]['quizes_title_ar'];
		$data[$i]['quizes_image'] = $display[$i]['quizes_image'];
		$data[$i]['quizes_image_ar'] = $display[$i]['quizes_image_ar'];
		$data[$i]['quizes_active'] = $display[$i]['quizes_active'] == 0 ? "No" : "Yes";
	
	}
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 
 
</section>

