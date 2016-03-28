
<?php
$page_title = "Personal Diet Application";
$single_term = "item";
$plural_term = "items";


$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "members_app";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];


//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "members_app_ID;members_app_name"; //Seperate with semicolumns;


$order = $_GET['order']!="" ? $_GET['order'] : $this_table_name."_ID";
$direction = $_GET['dir']=="" || $_GET['dir']==0  ? "desc" : "asc";
$page = (int)$_GET['page']!="" 	? (int)$_GET['page'] : 1;

//Handle Access Attr.
$add_item_flag = false;
$edit_item_flag = false;
$delete_item_flag = true;
$view_access_token = "can_view";
//$add_access_token = "can_add";
//$edit_access_token = "can_edit";
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

$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);




if($filter == "edit" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$form_array = array
(
	array("database_name" => "nestle_fit_option_title" , "title" => "Title (English)" , "type" => "text" , "required" => "1" ,"current_value"=> $display['nestle_fit_option_title'] ) ,
	array("database_name" => "nestle_fit_option_title_ar" , "title" => "Title (Arabic)" , "type" => "text" , "required" => "1" ,"current_value"=> $display['nestle_fit_option_title_ar'] ) ,

	array("database_name" => "nestle_fit_option_desc" , "title" => "Description (English)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['nestle_fit_option_desc'] ) ,
	array("database_name" => "nestle_fit_option_desc_ar" , "title" => "Description (Arabic)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['nestle_fit_option_desc_ar'] ) ,

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
 $db->query("delete from {$this_table_name} where {$this_table_name}_ID = ".$bulk_actions_items[$i]);
 endfor;
 
 
 echo "<script type='text/javascript'>location.href='{$this_page_name_with_varibles}&state=deletedall_success'</script>";
 
}

$bulk_actions_handler = $_POST['bulk_action'];

if($bulk_actions_handler == "delete_all")
{
	$bulk_actions_items = $_POST['items_checkbox'];
	for($i=0;$i<sizeof($bulk_actions_items);$i++):
	$db->query("delete from {$this_table_name} where {$this_table_name}_ID = ".$bulk_actions_items[$i]);
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
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name  where 1 {$search_query_string}  ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from  $this_table_name  where 1  {$search_query_string}  {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"members_app_name","title" => "Name" , "url_sort" => $this_page_name_with_varibles , "order" => "members_app_name", "type"=> "text" ),
		array("ID"=>"members_app_mail","title" => "Mail" , "url_sort" => $this_page_name_with_varibles , "order" => "members_app_mail", "type"=> "text" ),
		array("ID"=>"members_app_gender","title" => "Gender" , "url_sort" => $this_page_name_with_varibles , "order" => "members_app_gender", "type"=> "text" ),
		array("ID"=>"members_app_birthdate","title" => "Birthdate" , "url_sort" => $this_page_name_with_varibles , "order" => "members_app_birthdate", "type"=> "text" ),
		array("ID"=>"members_app_height","title" => "Height" , "url_sort" => $this_page_name_with_varibles , "order" => "members_app_height", "type"=> "text" ),
		array("ID"=>"members_app_weight","title" => "Weight" , "url_sort" => $this_page_name_with_varibles , "order" => "members_app_weight", "type"=> "text" ),
		array("ID"=>"members_app_sport","title" => "Sport" , "url_sort" => $this_page_name_with_varibles , "order" => "members_app_sport", "type"=> "text" ),
		array("ID"=>"members_app_healthy","title" => "Healthy" , "url_sort" => $this_page_name_with_varibles , "order" => "members_app_healthy", "type"=> "text" ),
		array("ID"=>"members_app_mobile","title" => "Mobile" , "url_sort" => $this_page_name_with_varibles , "order" => "members_app_mobile", "type"=> "text" ),
		array("ID"=>"members_app_phone","title" => "Phone" , "url_sort" => $this_page_name_with_varibles , "order" => "members_app_phone", "type"=> "text" ),
		array("ID"=>"members_app_call_time","title" => "Call Time" , "url_sort" => $this_page_name_with_varibles , "order" => "members_app_call_time", "type"=> "text" ),
	);

	
	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array($add_access_token, $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array($edit_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array($delete_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles )  ,
				 
	 );
	
	 
	 
	$data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		$data[$i]['ID'] = $display[$i]['members_app_ID'];
		$data[$i]['members_app_name'] = $display[$i]['members_app_name'];
		$data[$i]['members_app_mail'] = $display[$i]['members_app_mail'];
		$data[$i]['members_app_gender'] = $display[$i]['members_app_gender'];
		$data[$i]['members_app_birthdate'] = $display[$i]['members_app_birthdate'];
		$data[$i]['members_app_height'] = $display[$i]['members_app_height'];
		$data[$i]['members_app_weight'] = $display[$i]['members_app_weight'];
		$data[$i]['members_app_sport'] = $display[$i]['members_app_sport'];
		$data[$i]['members_app_healthy'] = $display[$i]['members_app_healthy'];
		$data[$i]['members_app_mobile'] = $display[$i]['members_app_mobile'];
		$data[$i]['members_app_phone'] = $display[$i]['members_app_phone'];
		$data[$i]['members_app_call_time'] = $display[$i]['members_app_call_time'];
	}
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 
 
</section>


