<?php
$page_title = "Members";
$single_term = "record";
$plural_term = "records";

$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "members";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "members_first_name;members_last_name;members_email;members_nickname"; //Seperate with semicolumns;

$order = $_GET['order']!="" ? $_GET['order'] : $this_table_name."_ID";
$direction = $_GET['dir']=="" || $_GET['dir']==0  ? "desc" : "asc";
$page = (int)$_GET['page']!="" 	? (int)$_GET['page'] : 1;

//Handle Access Attr.
$add_item_flag = true;
$edit_item_flag = true;
$delete_item_flag = true;
$view_access_token = "can_view";
//$add_access_token = "can_add";
$edit_access_token = "can_edit";
$delete_access_token = "can_delete";

include("header.php");

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


if(isset($_FILES['excel_file']))
{
	error_reporting(E_ALL ^ E_NOTICE);
	
	require_once("scripts/excelsheet_reader/excel_reader2.php");
	require_once("scripts/excelsheet_reader/SpreadsheetReader.php");
		
	$excel = new Spreadsheet_Excel_Reader();
	echo $_FILES['excel_file']['error'] .'<br>';
	if($_FILES['excel_file']['error'] == 1){
		echo 'error ';
		}
	$excel->read($_FILES['excel_file']['name']); // set the excel file name here 
	  
	$x=1;
	while($x<=$excel->sheets[0]['numRows']) 
	{ 
		// reading row by row 
		$array[] = array($excel->sheets[0]['cells'][$x][0],$excel->sheets[0]['cells'][$x][1],$excel->sheets[0]['cells'][$x][2],$excel->sheets[0]['cells'][$x][3],$excel->sheets[0]['cells'][$x][4],$excel->sheets[0]['cells'][$x][5],$excel->sheets[0]['cells'][$x][6]);
		$x++;
	}
        
	$shift_array = array_slice($array,1);
	
	print_r($shift_array);
	die();
	for($i=0 ; $i< sizeof($shift_array2) ; $i++){
		   $points_id = $shift_array[$i][1];
		   $points_user_id = $shift_array[2];
		   $points_type = $shift_array[3];
		   $points_number = $shift_array[4];
		   $points_key = $shift_array[5];
		   $points_timestamp = $shift_array[6];
		   $points_date = $shift_array[7];
		  
		   $tobesaved['points_id'] = $points_id;
		   $tobesaved['points_user_id'] = $points_user_id;
		   $tobesaved['points_type'] = $points_type;
		   $tobesaved['points_number'] = $points_number;
		   $tobesaved['points_key'] = $points_key;
		   $tobesaved['points_timestamp'] = $points_timestamp;
		   $tobesaved['points_date'] = $points_date;
		}
	//foreach ($shift_array as $display)
//    {
//       $points_id = $display[1];
//	   $points_user_id = $display[2];
//	   $points_type = $display[3];
//	   $points_number = $display[4];
//	   $points_key = $display[5];
//	   $points_timestamp = $display[6];
//	   $points_date = $display[7];
//	  
//	   $tobesaved['points_id'] = $points_id;
//	   $tobesaved['points_user_id'] = $points_user_id;
//	   $tobesaved['points_type'] = $points_type;
//	   $tobesaved['points_number'] = $points_number;
//	   $tobesaved['points_key'] = $points_key;
//	   $tobesaved['points_timestamp'] = $points_timestamp;
//	   $tobesaved['points_date'] = $points_date;
//      	
//	   //$state = $db->insert('points', $tobesaved);
//                
//	}
        echo 'All records are inserted successfully.';
        //die();
	
}


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
		//Check For trophies
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
		}
		
	}
	
	
}

if($filter == "edit" )
$display = $db->querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

//$display_recipes = $db->querySelect("Select members_recipes_ID as 'id', members_recipes_name as 'value' from members_recipes");
$display_boolean = array(array("id"=>0,"value"=>"NO"),array("id"=>1, "value"=>"YES") );

$form_array = array
(	

	array("database_name" => "members_first_name" , "title" => "First Name" , "type" => "text" , "required" => "0" ,"current_value"=> $display['members_first_name'] ) ,
	array("database_name" => "members_last_name" , "title" => "Last name" , "type" => "text" , "required" => "0" ,"current_value"=> $display['members_last_name'] ) ,
	array("database_name" => "members_email" , "title" => "E-mail" , "type" => "text" , "required" => "0" ,"current_value"=> $display['members_email'] ) ,
	array("database_name" => "members_salt" , "title" => "salt" , "type" => "text" , "required" => "0" ,"current_value"=> $display['members_salt'] ) ,
	array("database_name" => "members_birthdate" , "title"=>"birthdate", "type" => "text" , "required" => "0" ,"current_value"=> $display['members_birthdate'] ) ,
	array("database_name" => "members_mobile" , "title" => "mobile" , "type" => "text" , "required" => "0" ,"current_value"=> $display['members_mobile'] ) ,
	array("database_name" => "members_address" , "title" => "address" , "type" => "text" , "required" => "0" ,"current_value"=> $display['members_address'] ) ,
	array("database_name" => "members_activated" , "title" => "members activated" , "type" => "text" , "required" => "0" ,"current_value"=> $display['members_activated'] ) ,
	array("database_name" => "members_reset_password_active" , "title" => "members reset password active" , "type" => "text" , "required" => "0" ,"current_value"=> $display['members_reset_password_active'] ) ,
	array("database_name" => "id"  , "type" => "hidden" ,"value"=> $id  )
	
);

$form_array_2 = array
(
	array("database_name" => "excel_file" , "title" => "Excel File" , "type" => "file" , "required" => "1"  , "image_only" => $display['excel_file'] , "allowed" => "xls", "message" => "Only .xls Files" ),
	array("database_name" => "id" , "title" => "" , "type" => "hidden" , "required" => "0" , "value" => $_GET['id']),
	
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
elseif($filter == "import" )
{
	$generator->prepare_add_form($form_array_2);
}
if(!isset($filter)):

//Where Conditions	
$search_query_string = $generator->generate_search_query($search_headers_attr,$search_query);

//Order by
$sort_by_query = "order by ".$order." ".$direction ;

//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from $this_table_name where 1 {$search_query_string}  ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where 1 {$search_query_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"members_first_name","title" => "First Name" , "url_sort" => $this_page_name_with_varibles , "order" => "members_first_name", "type"=> "text" ),
		array("ID"=>"members_last_name","title" => "Last Name" , "url_sort" => $this_page_name_with_varibles , "order" => "members_last_name", "type"=> "text" )	,
		array("ID"=>"members_email","title" => "Member Email" , "url_sort" => $this_page_name_with_varibles , "order" => "members_email", "type"=> "text" )	,
		array("ID"=>"members_addeddate","title" => "Added Date" , "url_sort" => $this_page_name_with_varibles , "order" => "members_addeddate", "type"=> "date" )	,
		array("ID"=>"members_activated","title" => "Active" , "url_sort" => $this_page_name_with_varibles , "order" => "members_activated", "type"=> "text" )	,
	
	);
	
	$additional_options = array(
		array("title" => "View Points" , "url" => "members_points.php?", "pass_varible" => "forignkey"),
		array("title" => "View Favourit Recipes" , "url" => "members_recipes_articles.php?", "pass_varible" => "forignkey"),
	);
	
	//Don't Input Filter at URL ! 
	$options = array (
				//"add" => array ( "placeicon"=> $add_item_flag  && in_array($add_access_token, $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array($edit_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array($delete_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"extra" =>$additional_options
				 
	 );
	 
	 
	 $data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		$data[$i]['ID'] = $display[$i]['members_ID'];
		$data[$i]['members_first_name'] = $display[$i]['members_first_name'];
		$data[$i]['members_last_name'] = $display[$i]['members_last_name'];
		$data[$i]['members_email'] = $display[$i]['members_email'];
		$data[$i]['members_addeddate'] = strtotime($display[$i]['members_addeddate']);
		$data[$i]['members_activated'] = $display[$i]['members_activated'] == "1" ? "Yes" : "No";
		
	}
	$generator->display_table($table_header,$data,$options,"<a href='scripts/members_export.php'>Export Members to Excel Sheet</a> | <a href='scripts/points_export.php'>Export Points to Excel Sheet</a>",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>


