<?php
$page_title = "Newsletter Members";
$single_term = "newsletter member";
$plural_term = "newsletter members";


$filter = $_GET['filter'];
$id = (int)$_GET['id'];
//$forignkey = (int) $_GET['forignkey']; // forignkey of brand table
//$forignkey_colm = 'newsletter_members_newsletter_types_id'; // column of forignkey

//if($forignkey == "" )
//$forignkey = $_POST[$forignkey_colm];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "newsletter_members";
$this_page_name_with_varibles = "{$this_page_name}?forignkey=".$forignkey;
$state = $_GET['state'];

//handle Filters
//$product_brand_filter = (int) $_GET['product_brand_id'];

//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "newsletter_members_ID"; //Seperate with semicolumns;

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

//$location =  'http://' . $_SERVER['HTTP_HOST'] . '/~devarea/nestle/uploads/products/';

//Add New Item Link
$add_extra_add_item_when_edit_form = false;
if($add_item_flag && in_array("$add_access_token", $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
}

?>

<?php

$current_upload_directory = $images_dir['products'];
//INitilize Fields with input File  , IMPORTANT for tobesaved generator

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
$display = $db->querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$display_type = $db->querySelect('select newsletter_types_ID as "id" , newsletter_types_title as "value" from newsletter_types order by newsletter_types_title');

$display_active = array(array('id'=>'1','value'=>'Yes'),array('id'=>'0','value'=>'No'));

				
					

$form_array = array
(

	array("database_name" => "newsletter_members_ID" , "title" => "Newsletter Member" , "type" => "text" , "required" => "0" ,"current_value"=> $display['newsletter_members_ID'] ) ,

	array("database_name" => "newsletter_members_members_emails" , "title" => "E-mail" , "type" => "text" , "required" => "0" ,"current_value"=> $display['newsletter_members_members_emails'] , ) ,
	
	array("database_name" => "newsletter_members_month_baby" , "title" => "Baby's Month" , "type" => "text" , "required" => "0" ,"current_value"=> $display['newsletter_members_month_baby'] , ) ,
	
	array("database_name" => "newsletter_members_mom_name" , "title" => "Mother's Name" , "type" => "text" , "required" => "0" ,"current_value"=> $display['newsletter_members_mom_name'] , ) ,
	
	array("database_name" => "newsletter_members_baby_name" , "title" => "Baby's Name" , "type" => "text" , "required" => "0" ,"current_value"=> $display['newsletter_members_baby_name'] , ) ,

	
	array("database_name" => "newsletter_members_baby_birthdate" , "title" => "Baby's Birthdate" , "type" => "text" , "required" => "0" ,"current_value"=> $display['newsletter_members_baby_birthdate'] , ) ,
	
	array("database_name" => "newsletter_members_mobile_number" , "title" => "Mobile Number" , "type" => "text" , "required" => "0" ,"current_value"=> $display['newsletter_members_mobile_number'] , ) ,
	

	array("database_name" => "newsletter_members_home_address" , "title" => "Home Address" , "type" => "text" , "required" => "0" ,"current_value"=> $display['newsletter_members_home_address'] , ) ,
	
	array("database_name" => "newsletter_members_awarness" , "title" => "Awarness Source" , "type" => "text" , "required" => "0" ,"current_value"=> $display['newsletter_members_awarness'] , ) ,

    array("database_name" => "newsletter_members_newsletter_types_id" , "title" => "Newsletter Type" , "type" => "select" , "required" => "0" ,"current_value"=> $display['newsletter_members_newsletter_types_id'], "attached_options" => $display_type ) ,
	
	array("database_name" => "id"  , "type" => "hidden" ,"value"=> $id  ),
	array("database_name" => $forignkey_colm , "type" => "hidden" ,"value"=> $forignkey  ),
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
			  data: {id : id,this_table_name:this_table_name},
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

/*
//Where Conditions 
if($_GET['search_query'] != "")
{
	$search_query = $_GET['search_query'];
	$search_query_string = "";
}*/

// Join


//Where Conditions
$search_query_string = $generator->generate_search_query($search_headers_attr,$search_query);
	
//Filters 
//if ( $product_brand_filter != "" )
//$product_brand_string = " and products_products_brand_id=".$product_brand_filter;

//Order by
$sort_by_query = "order by ".$order." ".$direction ;


//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name where 1 {$search_query_string}");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array("$view_access_token", $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where 1 ");






//Table Header
	$table_header = array
	(
		
		array("ID"=>"newsletter_members_members_emails","title" => "E-mail" , "url_sort" => $this_page_name_with_varibles , "order" => "products_name", "type"=> "text" ,  ),
		
		array("ID"=>"newsletter_members_month_baby","title" => "Baby's Month" , "url_sort" => $this_page_name_with_varibles , "order" => "products_name_ar", "type"=> "text" ,  ),
			
		array("ID"=>"newsletter_members_mom_name","title" => "Mother's Name" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "text" ),
		
		array("ID"=>"newsletter_members_baby_name","title" => "Baby's Name" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "text" ),
		
		array("ID"=>"newsletter_members_baby_birthdate","title" => "Baby's Birthdate" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "text" ),
		
		array("ID"=>"newsletter_members_mobile_number","title" => "Mobile Number" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "text" ),
		
		array("ID"=>"newsletter_members_home_address","title" => "Home Address" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "text" ),
		
		array("ID"=>"newsletter_members_awarness","title" => "Awarness Source" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "text" ),
		
		array("ID"=>"newsletter_members_newsletter_types_id","title" => "Newsletter Type" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "text" ),

	);
		
	//$additional_options = array(
//		array("title" => "View Flavours" , "url" => "products_flavour.php?", "pass_varible" => "forignkey")
//	);

	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array("$add_access_token", $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array("$edit_access_token", $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array("$delete_access_token", $current_array_of_actions) , "url" =>$this_page_name_with_varibles ),
				//"extra" =>$additional_options
	 );
	 
	//Filters Options
	//$filter_options= array
//	(
//		array("ID"=>"product_brand_id","title" => " Products Brand " ,"type" => "select"  , "attached_options" =>$display_brand)
//	);
	
	
	 
	$data = array();
	for($i=0;$i<sizeof($display);$i++)
	{		
		$display_type = $db->querySelectSingle("select * from newsletter_types where newsletter_types_ID = " .$display[$i]['newsletter_members_newsletter_types_id']);

		$data[$i]['ID'] = $display[$i]['newsletter_members_ID'];
		$data[$i]['newsletter_members_members_emails'] = $display[$i]['newsletter_members_members_emails'];
		$data[$i]['newsletter_members_month_baby'] = $display[$i]['newsletter_members_month_baby'];
		$data[$i]['newsletter_members_mom_name'] = $display[$i]['newsletter_members_mom_name'];
		$data[$i]['newsletter_members_baby_name'] = $display[$i]['newsletter_members_baby_name'];
		$data[$i]['newsletter_members_baby_birthdate'] = $display[$i]['newsletter_members_baby_birthdate'];
		$data[$i]['newsletter_members_mobile_number'] = $display[$i]['newsletter_members_mobile_number'];
		$data[$i]['newsletter_members_home_address'] = $display[$i]['newsletter_members_home_address'];
		$data[$i]['newsletter_members_awarness'] = $display[$i]['newsletter_members_awarness'];
		$data[$i]['newsletter_members_newsletter_types_id'] = $display_type['newsletter_types_title'];
	 
	}
	
	$generator->display_table($table_header,$data,$options,"<a style='float:right' href='scripts/newsletter_member_export.php'>Export to Excel Sheet</a>");

	$generator->display_table($table_header,$data,$options,"");
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>


<?php include("footer.php"); ?>