<?php
$page_title = "Points";
$single_term = "points";
$plural_term = "points";


$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "points";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];


//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "points_id"; //Seperate with semicolumns;


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
<?php if($filter == 'shift') { ?>
<script type="text/javascript">
$(function(){
	$('form[name=handle_from]').submit(function(){
		if(isNaN($('#minutes').val()))
		{
			alert('Please enter a correct number.');
			return false;
		}
	});
});
</script>
<?php } ?>
<?php

//Any Database Connections Must start from this LINE

//Declare History Varibles
$log_handler = new history();
$log_handler->id = $_SESSION['backend_id'];
$log_handler->db_table_name = $this_table_name ;
$log_handler->table_name = $page_title;

if(isset($_FILES['excel_file']))
{
	error_reporting(E_ALL ^ E_NOTICE);
	//require_once 'scripts/excel_reader2.php';
	require_once("scripts/spreadsheet-reader/php-excel-reader/excel_reader2.php");
	require_once("scripts/spreadsheet-reader/SpreadsheetReader.php");

	$id = $_POST['id'];
	
	$excel = new Spreadsheet_Excel_Reader();

	$excel->read($_FILES['excel_file']['tmp_name']); // set the excel file name here   
	$x=1;
	while($x<=$excel->sheets[0]['numRows']) 
	{ 
		// reading row by row 
		$array[] = array($excel->sheets[0]['cells'][$x][0],$excel->sheets[0]['cells'][$x][1],$excel->sheets[0]['cells'][$x][2],$excel->sheets[0]['cells'][$x][3],$excel->sheets[0]['cells'][$x][4],$excel->sheets[0]['cells'][$x][5],$excel->sheets[0]['cells'][$x][6],$excel->sheets[0]['cells'][$x][7]);
		$x++;
	}
        
	$shift_array = array_slice($array,1);

	foreach ($shift_array as $display)
    {
       $start_date = $display[1];
	   $start_time = $display[2];
	   $end_time = $display[3];
	   $program = $display[4];
	   $type = $display[5];
	   $premiere = $display[6];
	   $exception = $display[7];
	   
	   if(!$program || $start_date == "1969-12-31") continue;
	   
	   //Channel ID 
	   $tobesaved['schedule_channels_ID'] = $id;
	   //Start Date 
	   $tobesaved['schedule_start_date'] = $start_date;
	   //End Date 
	   if($exception == 1)
	   {
		   $end_date = strtotime("+1 day", strtotime($start_date));
		   $tobesaved['schedule_end_date'] = date("Y-m-d",$end_date) ;
	   }
	   else
	   {
			$tobesaved['schedule_end_date'] = $start_date;
	   }
	   //Start Time 
	   $tobesaved['schedule_start_time'] = $start_time;
	   //End Time 
	   $tobesaved['schedule_end_time'] = $end_time;
	   //if program show for first time 
	   $tobesaved['schedule_premiere'] = $premiere;
	   
		//check if this program exists
		$program_exists = $db->querySelectSingle("SELECT * FROM programs WHERE programs_name = '" . $db->escape($program) . "'");
		//if exists get it's id
		if($program_exists) $tobesaved['schedule_programs_ID'] = $program_exists['programs_ID'];
		//else add new then return it's id
		else $tobesaved['schedule_programs_ID']  = $db->insert('programs', array('programs_name'=>$program, 'programs_type'=>$type));
                
                //check if this channel have a programs in this time
		$channel_exists = $db->numRows("SELECT * FROM schedule WHERE schedule_start_date = '" . $db->escape($start_date) . "' AND schedule_start_time = '" . $db->escape($start_time) . "' AND schedule_channels_ID = '" . $db->escape($id) . "'");
//		if programe not exists insert into database
                if($channel_exists == 0) $db->insert('schedule', $tobesaved);
                else{
                    echo 'This programe '.$program.' which start date '.$start_date.' and start time '.$start_time.' is not inserted.</br>';
                }
//                $state = $db->insert('schedule', $tobesaved);
                
	}
        echo 'All records are inserted successfully.';
        die();
	
}

if(isset($_FILES['osn_excel_file'])){
		error_reporting(E_ALL ^ E_NOTICE);
	//require_once 'scripts/excel_reader2.php';
	require_once("scripts/spreadsheet-reader/excel_reader22.php");
	require_once("scripts/spreadsheet-reader/SpreadsheetReader.php");



        $excel = new Spreadsheet_Excel_Reader();

	$excel->read($_FILES['osn_excel_file']['tmp_name']); 


        $x=1;
	while($x<=$excel->sheets[0]['numRows']) 
	{ 
		// reading row by row 
		$array[] = array($excel->sheets[0]['cells'][$x][0],$excel->sheets[0]['cells'][$x][1],$excel->sheets[0]['cells'][$x][2],$excel->sheets[0]['cells'][$x][3],$excel->sheets[0]['cells'][$x][4],$excel->sheets[0]['cells'][$x][5],$excel->sheets[0]['cells'][$x][6],$excel->sheets[0]['cells'][$x][7] ,$excel->sheets[0]['cells'][$x][8],$excel->sheets[0]['cells'][$x][9],$excel->sheets[0]['cells'][$x][10],$excel->sheets[0]['cells'][$x][11],$excel->sheets[0]['cells'][$x][12]);
		$x++;
	}


       $shift_array2 = array_slice($array,1);
       
	for($i=0 ; $i< sizeof($shift_array2) ; $i++){
	 $channel =  $shift_array2[$i][1]; 
         $start_date =date('Y-m-d', strtotime($shift_array2[$i][3]));
         $start_time =date('H:i:s', strtotime($shift_array2[$i][6]));
         $end_time = date('H:i:s', strtotime($shift_array2[$i+1][6]));
	 $name = $shift_array2[$i][10];
         $type = $shift_array2[$i][12];
     
	 $differ_time=((int) date('H', strtotime($shift_array2[$i+1][6])) - (int) date('H', strtotime($shift_array2[$i][6])));

         if(((int) date('H', strtotime($shift_array2[$i+1][6]))) == 0){
		  $exception=0;
		 }else if ($differ_time < 0){
		 $exception=1;
		 }else{
			 $exception=0;
			 }
	 if($exception == 1)
	   {
		   $end_date = strtotime("+1 day", strtotime($start_date));
		   $tobesaved['schedule_end_date'] = date("Y-m-d",$end_date) ;
	   }
	   else
	   {
			$tobesaved['schedule_end_date'] = $start_date;
	   }	
	   
	   $tobesaved['schedule_start_time'] = $start_time;
	   //End Time 
	   $tobesaved['schedule_end_time'] = $end_time;
           
           //Start Date Ayman modify
           $tobesaved['schedule_start_date'] = $start_date;
	   
         $channel_exists = $db->querySelectSingle("SELECT * FROM channels WHERE channels_name = '" . $db->escape($channel) . "'");
                //if exists get it's id
		if($channel_exists) $tobesaved['schedule_channels_ID'] = $channel_exists['channels_ID'];
		//else add new then return it's id
		else $tobesaved['schedule_channels_ID'] = $db->insert('channels', array('channels_name'=>$channel));

	   $program_exists = $db->querySelectSingle("SELECT * FROM programs WHERE programs_name = '" . $db->escape($name) . "'");
		//if exists get it's id
		if($program_exists) $tobesaved['schedule_programs_ID'] = $program_exists['programs_ID'];
		//else add new then return it's id
		else $tobesaved['schedule_programs_ID']  = $db->insert('programs', array('programs_name'=>$name, 'programs_type'=>$type));

                $channel_ID = $tobesaved['schedule_channels_ID'];
                $program_ID = $tobesaved['schedule_programs_ID'];
//              check if this channel have a programs in this time
		$channel_exists_schedule = $db->numRows("SELECT * FROM schedule WHERE schedule_start_date = '" . $db->escape($start_date) . "' AND schedule_start_time = '" . $db->escape($start_time) . "' AND schedule_channels_ID = '" . $db->escape($channel_ID) . "' AND schedule_programs_ID = '" . $db->escape($program_ID) . "'");
//		if programe not exists insert into database
                if($channel_exists == 0) $db->insert('schedule', $tobesaved);
                    else{
                          echo 'This programe '.$name.' which start date '.$start_date.' and start time '.$start_time.' is not inserted.</br>';
                        }
//		$state = $db->insert('schedule', $tobesaved);
		}
                echo 'All records are inserted successfully.';
         
	}







$genre_display = $db->querySelect("select genres_ID as 'id' , genres_name as 'value' from genres order by genres_name ");

if($filter == "edit" || $filter == "channels_parenting" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$form_array = array
(
		
	array("database_name" => "channels_name" , "title" => "Name" , "type" => "text" , "required" => "1" , "current_value"=>$display['channels_name']) ,	
	array("database_name" => "channels_name_ar" , "title" => "Arabic Name" , "type" => "text" , "required" => "0" , "current_value"=>$display['channels_name_ar']) ,	
	array("database_name" => $pictures_columns[0] , "title" => "Upload Image" , "type" => "image" , "required" => "1" , "message" => "Only jpg Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[0]]) ,
	array("database_name" => "channels_stream_url" , "title" => "Youtube Stream URL" , "type" => "text" , "required" => "0" , "current_value"=>$display['channels_stream_url']) ,	
	array("database_name" => "channels_desc" , "title" => "Description" , "type" => "editor" , "required" => "0" , "current_value"=>$display['channels_desc']) ,	
	array("database_name" => "channels_desc_ar" , "title" => "Arabic Description" , "type" => "editor" , "required" => "0" , "current_value"=>$display['channels_desc_ar']) ,	
	array("database_name" => "id" , "title" => "Description" , "type" => "hidden" , "required" => "0" ,"value"=> $id  ),
	array("database_name" => "channels_genre" , "title" => "Genre" , "type" => "select" , "attached_options"=> $genre_display , "required" => "1" , "current_value" => $display['channels_genre']),
	array("database_name" => "channels_network" , "title" => "Network" , "type" => "text" , "required" => "0" , "current_value" => $display['channels_network']),
	array("database_name" => "channels_frequency" , "title" => "Frequency" , "type" => "text" , "required" => "0" , "current_value" => $display['channels_frequency']),
	array("database_name" => "channels_location" , "title" => "Location" , "type" => "text" , "required" => "0" , "current_value" => $display['channels_location'])

);

$form_array_2 = array
(
	array("database_name" => "excel_file" , "title" => "Excel File" , "type" => "file" , "required" => "1"  , "image_only" => $display['excel_file'] , "allowed" => "xls", "message" => "Only .xls Files" ),
	array("database_name" => "id" , "title" => "" , "type" => "hidden" , "required" => "0" , "value" => $_GET['id']),
	
);

$form_array_3 = array
(
	array("database_name" => "minutes" , "title" => "Shift by (+ or -)" , "type" => "text" , "required" => "1", "message"=>'in minutes'),
	array("database_name" => "limit" , "title" => "Shift until" , "type" => "date" , "required" => "0"),
	array("database_name" => "id" , "title" => "" , "type" => "hidden" , "required" => "0" , "value" => $_GET['id']),
	
);


$form_array_4 = array
(
	array("database_name" => "osn_excel_file" , "title" => "OSN Excel File" , "type" => "file" , "required" => "1"  , "image_only" => $display['osn_excel_file'] , "allowed" => "xls", "message" => "Only .xls Files" )
	
);

$display_channels = $db->querySelect("select channels_ID as 'id',channels_name as 'value' from channels order by channels_name ");
$add_none_option = array("id" =>"0" , "value" => "NONE");
$display_channels[] = $add_none_option;
$form_array_5 = array
(
	array("database_name" => "channels_parent_channels_ID" , "title" => "Select Parent Channel" , "type" => "select" , "required" => "1" , "attached_options" => $display_channels , "current_value" => $display['channels_parent_channels_ID']),
	array("database_name" => "channels_time_add_by" , "title" => "Hours Padding?" , "type" => "text" , "required" => "1", "current_value"=>$display['channels_time_add_by'] ),
	array("database_name" => "id" , "title" => "Description" , "type" => "hidden" , "required" => "0" ,"value"=> $id  ),
	
	
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
			  url: "ajax/toggle_channel_items.php",
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
elseif($filter == "shift" )
{
	$generator->prepare_add_form($form_array_3);
}
elseif($filter == "osn_import" )
{
	$generator->prepare_add_form($form_array_4);
}
elseif($filter == "channels_parenting" )
{
	$generator->prepare_edit_form($form_array_5);
}


if(!isset($filter)):

//Where Conditions	
$search_query_string = $generator->generate_search_query($search_headers_attr,$search_query);

//Filters 


 
//Order by
$sort_by_query = "order by ".$order." ".$direction ;




//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name where 1 {$search_query_string} {$regions_filter_string} ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where 1 {$search_query_string} {$regions_filter_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"channels_name" , "title" => "Name" , "url_sort" => $this_page_name_with_varibles , "order" => "channels_name" , "type"=> "text"),		
		array("ID"=> $pictures_columns[0] ,"title" => "Images" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "image" , "image_dir"=> $current_upload_directory ,"image_version" => "src" ) ,
		array("ID"=>"channels_stream_url" , "title" => "Youtube Stream URL" , "url_sort" => $this_page_name_with_varibles , "order" => "channels_stream_url" , "type"=> "text")	,
		array("ID"=>"channels_featured" , "title" => "Featured" , "url_sort" => $this_page_name_with_varibles , "order" => "channels_featured" , "type"=> "text")	,
		array("ID"=>"channels_sponsored" , "title" => "Sponsored" , "url_sort" => $this_page_name_with_varibles , "order" => "channels_sponsored"  , "type"=> "text")	,		
		array("ID"=>"channels_showing" , "title" => "Now Showing" , "url_sort" => $this_page_name_with_varibles , "order" => "channels_showing" , "type"=> "text")			

	);
	
	$additional_options = array(
		array("title" => "Toggle Featured" , "url" => "{$this_page_name_with_varibles}", "additional_attr" => "channels_featured" , "pass_varible" => "" , "class_name"=>"approve_toggle" ,"icon" => "icon-3"),
		array("title" => "Toggle Sponsored" , "url" => "{$this_page_name_with_varibles}" , "additional_attr" => "channels_sponsored" , "pass_varible" => "" ,  "class_name"=>"approve_toggle" ,"icon" => "icon-3"),
		array("title" => "View in Now Showing" , "url" => "{$this_page_name_with_varibles}" , "additional_attr" => "channels_showing" , "pass_varible" => "" ,  "class_name"=>"approve_toggle" ,"icon" => "icon-3"),
		array("title" => "Import XLS" , "url" => "{$this_page_name_with_varibles}" , "pass_varible" => "filter=import&id" , "icon" => "icon-1"),
		array("title" => "Shift Schedule" , "url" => "{$this_page_name_with_varibles}" , "pass_varible" => "filter=shift&id" , "icon" => "icon-1"),
		array("title" => "Manage Parenting" , "url" => "{$this_page_name_with_varibles}" , "pass_varible" => "filter=channels_parenting&id" , "icon" => "icon-1"),
		array("title" => "View Schedule" , "url" => "schedule.php?" , "pass_varible" => "cid" , "icon" => "view-icon"),
		
	);
	
	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array($add_access_token, $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array($edit_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array($delete_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"extra" =>$additional_options
				 
	 );
	 
	//Get Data From Database

	//$display = $db->querySelect("select * from  $this_table_name $where $sort_by_query $paging_query  ");
	$data = array();
	for($i=0;$i<sizeof($display);$i++)
	{

		
		$data[$i]['ID'] = $display[$i]['channels_ID'];
		$data[$i]['channels_name'] = $display[$i]['channels_name'];
		$data[$i]['channels_image'] = $display[$i]['channels_image'];
		$data[$i]['channels_stream_url'] = $display[$i]['channels_stream_url'];
		$data[$i]['channels_featured'] = $display[$i]['channels_featured'] == 0 ? "No" : "Yes";
		$data[$i]['channels_sponsored'] = $display[$i]['channels_sponsored'] == 0 ? "No" : "Yes";	
		$data[$i]['channels_showing'] = $display[$i]['channels_showing'] == 0 ? "No" : "Yes";	
		
	}
	//Display Table Here
	echo '<div id="result"></div>';
	$additional_right = '<a href="channels.php?filter=osn_import" class="bt_green float_left"><span class="bt_green_lft"></span><strong>Import OSN Excel File</strong><span class="bt_green_r"></span></a><form>
	<input name="query" type="text" class="float_left inp-form" value="' . $_GET['query'] . '">
	<a href="javascript:;" onclick="$(this).parent().submit();" style="margin-top:0" class="bt_green float_left"><span class="bt_green_lft"></span><strong>Search</strong><span class="bt_green_r"></span></a>
	</form>';
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>


