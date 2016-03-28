<?php
$page_title = "Users";
$single_term = "user";
$plural_term = "users";


$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "users";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];


//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "users_email;users_name"; //Seperate with semicolumns;




$order = $_GET['order']!="" ? $_GET['order'] : $this_table_name."_ID";
$direction = $_GET['dir']=="" || $_GET['dir']==0  ? "desc" : "asc";
$page = (int)$_GET['page']!="" 	? (int)$_GET['page'] : 1;

//Handle Access Attr.
$add_item_flag = true;
$edit_item_flag = true;
$delete_item_flag = true;
$view_access_token = "view_users";
$add_access_token = "add_users";
$edit_access_token = "edit_users";
$delete_access_token = "delete_users";




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

/*$current_upload_directory = $images_dir['gallery'];*/
//INitilize Fields with input File  , IMPORTANT for tobesaved generator

//Pictures Columns inilitize
/*$pictures_columns = array();
$pictures_columns[0] = "gallery_album_thumb";*/


/*$files_array_search = array ($pictures_columns[0]); 
$files_array = array 
(
	$pictures_columns[0] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" )
);
*/

//Apply Image Crop
/*$crop_settings = array();
$current_cropsettings_index = 0 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "1";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 115;*/

$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);



//echo $generator->generate_javascript_imagecrop($crop_settings);


//IF a Form is submitted
if($_POST['submit'] == "Add" ||  $_POST['submit'] == "Edit" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);

	
	if($_POST['submit'] == "Add" )
	{
		$error = Administrator::password_complex($_POST['users_password']);
		if($error)
		{
			$state = false;
			echo "Password validation failure(your choise is weak ): <br/> $error";
		} 
		else 
		{
			//First Unset ID before ADD
			$tobesaved['users_created_date'] = time();
			$tobesaved['users_orignal_password'] = $_POST['users_password'];
			$tobesaved['users_password'] = crypt(sha1(md5($db->escape($_POST['users_password']))), 'st') ;
			
			$state = $db -> insert($this_table_name, $tobesaved);
			if($state != false)
			{
				die("<script>location.href = '{$this_page_name_with_varibles}&state=added&filter=edit&id={$state}' </script>");
			}
		}
		
	}
	if($_POST['submit'] == "Edit" )
	{
		$error = Administrator::password_complex($_POST['users_password']);
		
		if($error)
		{
			$state = false;
			echo "Password validation failure(your choise is weak ): <br/> $error";
		} 
		else 
		{
			$tobesaved['users_orignal_password'] = $_POST['users_password'];
			$tobesaved['users_password'] = crypt(sha1(md5($db->escape($_POST['users_password']))), 'st') ;
			
			$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);
			if($state != false)
			{
				die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
			}	
		}		
	}
	
	
}
$display_types = array (
array("id"=>"Administrator","value"=>"Administrator"),array("id"=>"Marketing","value"=>"Marketing"),array("id"=>"Data Entry","value"=>"Data Entry"),array("id"=>"Limited","value"=>"Limited")
);

if($filter == "edit" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$display_boolean = array(array("id" => 0, "value" => 'No') , array("id" => 1 , "value" => "Yes") ) ;

$form_array = array
(
	array("database_name" => "users_email" , "title" => "Email" , "type" => "text" , "required" => "1" ,"current_value"=> $display['users_email'] ) ,
	array("database_name" => "users_password" , "title" => "Password" , "type" => "password" , "required" => "1" ,"current_value"=> $display['users_password'] ) ,
	array("database_name" => "users_name" , "title" => "Full Name" , "type" => "text",  "required" => "1" ,"current_value"=> $display['users_name'] ) ,
	array("database_name" => "users_type" , "title" => "Type" , "type" => "select", "attached_options" => $display_types , "required" => "1", "current_value"=>$display['users_type']) ,
	array("database_name" => "users_active" , "title" => "Active" , "type" => "select" , "required" => "0" , "current_value"=>$display['users_active'] , "attached_options" => $display_boolean ),
	 
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
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name where 1 {$search_query_string}   ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where 1 {$search_query_string}   {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID" => "users_name" ,"title" => "Full Name" , "url_sort" => $this_page_name_with_varibles , "order" => "" , "index" => "0" , "type"=> "text"),		
		array("ID" => "users_email" ,"title" => "Email" , "url_sort" => $this_page_name_with_varibles , "order" => "" , "index" => "1" , "type"=> "text")	,
		array("ID" => "users_type" ,"title" => "Type" , "url_sort" => $this_page_name_with_varibles , "order" => "" , "index" => "2" , "type"=> "text")	,
	 
		array("ID" => "users_created_date" ,"title" => "Created Date" , "url_sort" => $this_page_name_with_varibles , "order" => "" , "index" => "44" , "type"=> "text") ,
		 
		
					
	
	);
	
	 
	
	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array($add_access_token, $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array($edit_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array($delete_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				 
				 
	 );
	 
	 
	 $data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		
		$data[$i]['ID'] = $display[$i]['users_ID'];
		$data[$i]['users_name'] = $display[$i]['users_name'];
		$data[$i]['users_email'] = $display[$i]['users_email'];
		$data[$i]['users_type'] = $display[$i]['users_type'];
		 
		$data[$i]['users_created_date'] = date('Y-m-d',$display[$i]['users_created_date']);
		
	}
	$generator->display_table($table_header,$data,$options,"");
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>