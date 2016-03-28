<?php
//Single Page Temple
$page_title = "Terms and conditions";
$single_term = "record";
$plural_term = "records";


$filter = $_GET['filter'];
$id = 6;


$form_submit = "Edit";


$this_page_name = basename(__FILE__);
$this_table_name = "static";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

$add_item_flag = false;
$edit_item_flag = true;
$delete_item_flag = false;



?>
<?php include("header.php");?> 
<?php
//Add New Item Link
$add_extra_add_item_when_edit_form = false;
?>

<?php
/*$current_upload_directory = $images_dir['static'];
//INitilize Fields with input File  , IMPORTANT for tobesaved generator

//Pictures Columns inilitize
$pictures_columns = array();
$pictures_columns[0] = "static_image";


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
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 115;
*/
$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);


//IF a Form is submitted
if($_POST['submit'] == "Add" ||  $_POST['submit'] == "Edit" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);

	
	if($_POST['submit'] == "Edit" )
	{
		 
		
		
		$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&id=".$_POST['id']."' </script>");
		}
		
	}
	
	
}

$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$form_array = array
(
	array("database_name" => "static_name_ar" , "title" => "Title (Arabic)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['static_name_ar']  ) ,
	array("database_name" => "static_text_ar" , "title" => "Description (Arabic)" , "type" => "editor" , "required" => "0" ,"current_value"=> $display['static_text_ar'] , "message" => "Always press CTRL + ALT + V when pasting from Word Document"   ) ,
	array("database_name" => "static_name" , "title" => "Title (English)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['static_name']  ) ,
	array("database_name" => "static_text" , "title" => "Description (English)" , "type" => "editor" , "required" => "0" ,"current_value"=> $display['static_text'] , "message" => "Always press CTRL + ALT + V when pasting from Word Document"   ) ,

	array("database_name" => "id"  , "type" => "hidden" ,"value"=> $id )
	
);


?>

<!-- start content-outer -->
<section id="main" class="column">
 
<?php

	if(!in_array("can_edit", $current_array_of_actions) || !$edit_item_flag )
	echo "<script type='text/javascript'>location.href='no_access.php'</script>";
	
	if($state!=""):
	?>
	<script type="text/javascript">
	$(document).ready(
	function()
	{
		   $.gritter.add({
					class_name: 'notification_green_color',
					title: 'Updated!',
					text: 'Data are Updated.',
					sticky: false,
					time: '2500',
					fade_out_speed : 1500
						});
		
	}
	);
	</script>
	<?php
	endif;
	$generator->prepare_edit_form($form_array);
//}
?>

</section>


<?php include("footer.php"); ?>