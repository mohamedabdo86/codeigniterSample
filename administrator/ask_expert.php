<?php
$page_title = "Ask an Expert";
$single_term = "record";
$plural_term = "records";

$filter = $_GET['filter'];
$id = (int)$_GET['id'];

$section_filter = (int) $_GET['section'];
$approve_filter = $_GET['approve'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "ask_expert";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "ask_expert_question;ask_expert_question_ar"; //Seperate with semicolumns;

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
<?php
//Add New Item Link
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
		$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);
		$question = $_POST['ask_expert_question_ar'];
		$name = $_POST['ask_expert_members_name'];
		
		$title = $_POST['ask_expert_question_ar'];
		
		
		$approve = $_POST['ask_expert_approve'];
		$email = mysql_real_escape_string($_POST['ask_expert_email']);
		$member_id = $_POST['ask_expert_members_id'];
		$query1 = "SELECT * FROM  `members` WHERE  `members_ID` ={$member_id}";
		$member_data = $db->querySelectSingle($query1);
		$language = "en";
		if($member_data['members_lang'] == "arabic"){
			$language = "ar";
		}
		$member_id = $member_data['members_ID'];
		$member_salt = $member_data['members_salt'];
		if($language == "en"){
			$title = $_POST['ask_expert_question'];
			if(mb_detect_encoding($name) != "ASCII"){
				$name = ucwords("{$_POST['ask_expert_members_name']} Hi");
			}else{
				$name = ucwords("Hi {$_POST['ask_expert_members_name']}");
			}
		}else{
			if(mb_detect_encoding($name) != "ASCII"){
				$name = ucwords("مرحبا {$_POST['ask_expert_members_name']}");
			}else{
				$name = ucwords("{$_POST['ask_expert_members_name']} مرحبا");
			}
		}
		$question_id = $_POST['id'];
		$section_id = $_POST['ask_expert_section_ID'];
		$ask_expert_id = $_POST['ask_expert_ID'];
		$display_section_title = $db->querySelectSingle('select * from sections where sections_ID = '.$section_id);
		$sections_title = $display_section_title['sections_title'];
		$url = "192.185.151.73/~devarea/nestle/index.php/".$language."/{$sections_title}/ask_an_expert/{$ask_expert_id}";
		
		
		include 'modules/mailer.php';
		if($language == "ar"){
			include 'scripts/ask_expert_answer.php';
		}else{
			include 'scripts/ask_expert_answer_en.php';
		}
		
		if($approve == 1){
		$status_email = sendMail($email, "Be At Your Best With Nestlé", 'info@mynestle.com.eg', '', '', 'A Reply added for your question', $msg);
		}
		
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
		}
		
	}
	
	
}

if($filter == "edit" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$display_section = $db->querySelect('select sections_ID as "id" ,sections_title as "sections_title" , sections_name as "value" from sections where sections_ID != 1');

$display_approve = array(array("id"=>0,"value"=>"NO"),array("id"=>1, "value"=>"YES") );

$form_array = array
(
	array("database_name" => "ask_expert_section_ID" , "title" => "Section" , "type" => "select" , "required" => "1" ,"attached_options" => $display_section ,"current_value"=> $display['ask_expert_section_ID'] ) ,
	array("database_name" => "ask_expert_email" , "type" => "hidden"  ,"value"=> $display['ask_expert_email'] ) ,
	array("database_name" => "ask_expert_members_id" , "type" => "hidden"  ,"value"=> $display['ask_expert_members_id'] ) ,
	array("database_name" => "ask_expert_ID" , "type" => "hidden"  ,"value"=> $display['ask_expert_ID'] ) ,
	array("database_name" => "ask_expert_members_name" , "type" => "hidden"  ,"value"=> $display['ask_expert_members_name'] ) ,
	array("database_name" => "ask_expert_question_ar" , "title" => "Question (Arabic)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['ask_expert_question_ar'] ) ,
	array("database_name" => "ask_expert_answer_ar" , "title" => "Answer (Arabic)" , "type" => "editor" , "required" => "0" ,"current_value"=> $display['ask_expert_answer_ar'] ) ,
	array("database_name" => "ask_expert_question" , "title" => "Question (English)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['ask_expert_question'] ) ,
	array("database_name" => "ask_expert_answer" , "title" => "Answer (English)" , "type" => "editor" , "required" => "0" ,"current_value"=> $display['ask_expert_answer'] ) ,
  	array("database_name" => "ask_expert_approve" , "title" => "Approve" , "type" => "select" , "required" => "1" ,"attached_options" => $display_approve ,"current_value"=> $display['ask_expert_approve'] ) ,

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

//Filters 
if($section_filter)
$section_string = " and ask_expert_section_ID = ".$section_filter;

if($approve_filter != NULL) 
$approve_string = " and comments_approve = ".$approve_filter." ";

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

//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name where 1 {$search_query_string} {$section_string} {$approve_string} ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where 1 {$search_query_string} {$section_string} {$approve_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"ask_expert_question_ar", "title" => "Question (Arabic)" , "url_sort" => $this_page_name_with_varibles , "order" => "ask_expert_question_ar" ,"type"=> "text"),
		array("ID"=>"ask_expert_question", "title" => "Question (English)" , "url_sort" => $this_page_name_with_varibles , "order" => "ask_expert_question" ,"type"=> "text"),
		array("ID"=>"ask_expert_section_ID","title" => "Section" , "url_sort" => $this_page_name_with_varibles , "order" => "ask_expert_section_ID", "type"=> "select"  ,"attached_options" => $display_section),
	 	array("ID"=>"ask_expert_approve" , "title" => "Approve" , "url_sort" => $this_page_name_with_varibles , "order" => "ask_expert_approve" , "type"=> "text")	,	

	);
	
	//Filters Options

	$filter_options= array(
		array("ID"=>"section","title" => "Section" ,"type" => "select" , "attached_options" =>$display_section),
		array("ID"=>"approve","title" => "Approve" ,"type" => "select" , "attached_options" =>$display_approve),
		);
	
	$additional_options = array(
	array("title" => "Toggle Approve" , "url" => "{$this_page_name_with_varibles}", "additional_attr" => "ask_expert_approve" , "pass_varible" => "" , "class_name"=>"approve_toggle" ,"icon" => "icon-3"),
	);
	
	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array($add_access_token, $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array($edit_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array($delete_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"extra" =>$additional_options
				 
	 );
	 
	 
	 $data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		$data[$i]['ID'] = $display[$i]['ask_expert_ID'];
		$data[$i]['ask_expert_question_ar'] = $display[$i]['ask_expert_question_ar'];
		$data[$i]['ask_expert_question'] = $display[$i]['ask_expert_question'];
		$data[$i]['ask_expert_section_ID'] = $display[$i]['ask_expert_section_ID'];
		$data[$i]['ask_expert_approve'] = $display[$i]['ask_expert_approve'] == 0 ? "No" : "Yes";
	 
	}
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>


