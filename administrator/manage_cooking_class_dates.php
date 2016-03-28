<?php
$page_title = "Manage Cooking Classes dates";
$single_term = "date";
$plural_term = "dates";

$parent_page_title = "Manage Cooking Classes";
$parent_page_name = "manage_cooking_classes.php";

$filter = $_GET['filter'];
$id = (int)$_GET['id'];
$fkey = (int) $_GET['fkey'];

if($fkey == "" )
$fkey = $_POST['cooking_classes_dates_cooking_classes_ID'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "cooking_classes_dates";
$this_page_name_with_varibles = "{$this_page_name}?fkey=$fkey";
$state = $_GET['state'];

//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "cooking_classes_title;cooking_classes_title_ar"; //Seperate with semicolumns;

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
$display_parent = $db->querySelectSingle("select * from cooking_classes where cooking_classes_ID={$fkey}");

?>
<?php
//Add New Item Link
$add_extra_add_item_when_edit_form = false;
if($add_item_flag && in_array("$add_access_token", $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
}

?>

<?php
$current_upload_directory = $images_dir['cooking_classes'];

//INitilize Fields with input File  , IMPORTANT for tobesaved generator

//Pictures Columns inilitize
$pictures_columns = array();
$pictures_columns[0] = "cooking_classes_image";

$files_array_search = array ($pictures_columns[0]); 
$files_array = array 
(
	$pictures_columns[0] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),
);


//Apply Image Crop0
$crop_settings = array();
$current_cropsettings_index = 0 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "20:13";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 200;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 130;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 200;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 130;

$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);


//IF a Form is submitted
if($_POST['submit'] == "Add" ||  $_POST['submit'] == "Edit" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);
	
		
	
	
	if($_POST['submit'] == "Add" )
	{
		//First Unset ID before ADD
		//$tobesaved['articles_date']  = date('Y-m-d');
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


$display_active = array(array("id" => "1" , "value" => "Active"),array("id" => "0" , "value" => "Not Active"));
$display_months = array(
				array("id" => "1" , "value" => "January"),
				array("id" => "2" , "value" => "February"),
				array("id" => "3" , "value" => "March"),
				array("id" => "4" , "value" => "April"),
				array("id" => "5" , "value" => "May"),
				array("id" => "6" , "value" => "June"),
				array("id" => "7" , "value" => "July"),
				array("id" => "8" , "value" => "August"),
				array("id" => "9" , "value" => "September"),
				array("id" => "10" , "value" => "October"),
				array("id" => "11" , "value" => "November"),
				array("id" => "12" , "value" => "December")
				);
$display_days = 
array
(
  array("id" => "Sunday","value"=>"Sunday","default"=>true),
  array("id" => "Monday","value"=>"Monday","default"=>true),
  array("id" => "Tuesday","value"=>"Tuesday","default"=>true),
  array("id" => "Wednesday","value"=>"Wednesday","default"=>true),
  array("id" => "Thursday","value"=>"Thrusday","default"=>true),
  array("id" => "Friday","value"=>"Friday","default"=>true),
  array("id" => "Saturday","value"=>"Saturday","default"=>true),
  
);

$form_array = array
(
	array("database_name" => "cooking_classes_dates_date" , "title" => "Date" , "type" => "date" , "required" => "1" ,"current_value"=> $display['cooking_classes_dates_date'] ) ,
	array("database_name" => "cooking_classes_dates_cooking_classes_ID"  , "type" => "hidden" ,"value"=> $fkey  ),
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
<script type="text/javascript">
$(document).ready(function(e) {
	
	
		$( ".datepicker" ).datepicker( "option", "minDate", new Date(<?php echo $display_parent['cooking_classes_year']; ?>, <?php echo ($display_parent['cooking_classes_month']-1); ?>, 1));		
		$( ".datepicker" ).datepicker( "option", "maxDate", new Date(<?php echo $display_parent['cooking_classes_year']; ?>, <?php echo ($display_parent['cooking_classes_month']-1); ?>, 31));	
		$( ".datepicker" ).datepicker( "option", "beforeShowDay", setCustomDate );	



	 
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
function setCustomDate(date)   {
        var day = date.getDay();
		
		<?php
		$return_string_display = "";
		
		$array_of_days = explode(";",$display_parent['cooking_classes_days'] );	
		$return_string_display = "";
		for($i=0 ; $i< sizeof($array_of_days) ; $i++):
			$return_string_display.= "day !=";
			$current_day = $array_of_days[$i];
			
			switch($array_of_days[$i])
			{
				case "Sunday":$return_string_display.="0";break;
				case "Monday":$return_string_display.="1";break;
				case "Tuesday":$return_string_display.="2";break;
				case "Wednesday":$return_string_display.="3";break;
				case "Thursday":$return_string_display.="4";break;
				case "Friday":$return_string_display.="5";break;
				case "Saturday":$return_string_display.="6";break;
			}
			
			if($i< (sizeof($array_of_days)-1))
			{
				$return_string_display.= " && ";
			}
		
		endfor;
		
		?>
		
       // return [!(day != 3 && day != 0)];
	   return [!(<?php echo $return_string_display; ?>)];
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

$list_per_page = 10;

//Where Conditions
$search_query_string = $generator->generate_search_query($search_headers_attr,$search_query);


	
//Filters 
/*if($sub_section_filter)
$sub_section_string = " and sub_sections_sections_ID = ".$sub_section_filter;

if($parent_filter)
$parent_string = " and sub_sections_parent = ".$parent_filter;*/

//if ( $start_date_filter != "" )
//$start_date_filter_string = " and schedule_start_date='".$start_date_filter."'";

//Order by
$sort_by_query = "order by ".$order." ".$direction ;



//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name {$join} where cooking_classes_dates_cooking_classes_ID = {$fkey} {$search_query_string} ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array("$view_access_token", $current_array_of_actions))

echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name {$join} where cooking_classes_dates_cooking_classes_ID = {$fkey}  {$search_query_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"cooking_classes_dates_date", "title" => "Name" , "url_sort" => $this_page_name_with_varibles , "order" => "cooking_classes_dates_date" ,"type"=> "text"),
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
	
	$additional_options = array(

	array("title" => "View Recipies" , "url" => "manage_cooking_classes_recipes.php?", "pass_varible" => "fkey"),
	 
		
	);
	

	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array("$add_access_token", $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array("$edit_access_token", $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array("$delete_access_token", $current_array_of_actions) , "url" =>$this_page_name_with_varibles ),
				 /*"extra" =>$additional_options*/
	 );
	 
	$data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		$data[$i]['ID'] = $display[$i]['cooking_classes_dates_ID'];
		$data[$i]['cooking_classes_dates_date'] = $display[$i]['cooking_classes_dates_date'];
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
