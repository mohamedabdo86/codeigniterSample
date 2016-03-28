<?php
$page_title = "Awards E-mail";
$single_term = "record";
$plural_term = "records";

$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "awards_email";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "awards_email_member_id"; //Seperate with semicolumns;

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


$add_extra_add_item_when_edit_form = false;
if($add_item_flag && in_array($add_access_token, $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
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
		$approve = $tobesaved['awards_email_approve'];
		if($approve == 1)
		{
			$award_data = $db->querySelectSingle('Select * from awards where awards_ID = '.$tobesaved['awards_email_awards_id']);
			$award_points = $award_data['awards_number'];
			
			$member_data = $db->querySelectSingle('Select * from members where members_ID = '.$tobesaved['awards_email_member_id']);
			$member_points = $member_data['members_points'];
			
			$total_points = $member_points - $award_points;
			
			$tobesaved_2['members_points'] = $total_points;
			$update = $db->update('members' , $tobesaved_2 , "members_ID=".$tobesaved['awards_email_member_id']);			
			
		}
		$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
		}
		
	}
	
	
}

if($filter == "edit" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$display_member = $db->querySelect('select members_ID as "id" ,CONCAT(members_first_name," ",members_last_name)  as "value" from members ');
$display_award = $db->querySelect('select awards_ID as "id", awards_number as "value" from awards ');
$display_boolean = array(array("id" => 0, "value" => 'No') , array("id" => 1 , "value" => "Yes") ) ;

$form_array = array
(
	array("database_name" => "awards_email_member_id" , "title" => "Member" , "type" => "select" , "required" => "1" ,"attached_options"=>$display_member ,"current_value"=> $display['awards_email_member_id'] ) ,
	array("database_name" => "awards_email_awards_id" , "title" => "Award" , "type" => "select" , "required" => "1" ,"attached_options"=>$display_award ,"current_value"=> $display['awards_email_awards_id'] ) ,
	array("database_name" => "awards_email_date" , "title" => "Date" , "type" => "date" , "required" => " 0" ,"current_value"=> $display['awards_email_date'] ) ,
	array("database_name" => "awards_email_approve" , "title" => "Approve" , "type" => "select" , "required" => "0" ,"attached_options"=>$display_boolean,"current_value"=> $display['awards_email_approve'] ) ,

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
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name where 1 {$search_query_string} {$section_string}   ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where 1 {$search_query_string} {$section_string}   {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"awards_email_member_id", "title" => "Member" , "url_sort" => $this_page_name_with_varibles , "order" => "awards_email_member_id" ,"type"=> "select","attached_options"=>$display_member ),
		array("ID"=>"awards_email_awards_id", "title" => "Award" , "url_sort" => $this_page_name_with_varibles , "order" => "awards_email_awards_id" ,"type"=> "select","attached_options"=>$display_award ),
		array("ID"=>"awards_email_approve", "title" => "Approve" , "url_sort" => $this_page_name_with_varibles , "order" => "awards_email_approve" ,"type"=> "select","attached_options"=>$display_boolean ),

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
		$data[$i]['ID'] = $display[$i]['awards_email_ID'];
		$data[$i]['awards_email_member_id'] = $display[$i]['awards_email_member_id'];
		$data[$i]['awards_email_awards_id'] = $display[$i]['awards_email_awards_id'];
		$data[$i]['awards_email_approve'] = $display[$i]['awards_email_approve'];

	 
	}
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>


