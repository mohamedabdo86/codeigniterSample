<?php
$page_title = "Polls";
$single_term = "question";
$plural_term = "questions";


$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "polls_question";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];


//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "poll_question_title"; //Seperate with semicolumns;
$this_page_name_with_varibles = "{$this_page_name}?";
 

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

$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);



//echo $generator->generate_javascript_imagecrop($crop_settings);


//IF a Form is submitted
if($_POST['submit'] == "Add" ||  $_POST['submit'] == "Edit" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);
	unset($tobesaved['answers_options']);
	unset($tobesaved['answers_options_ar']);

	//Prepare answers array for english answer
	$array_of_answers = explode(";",$_POST['answers_options'] );
	
	//Prepare answers array for arabic answer
	$array_of_answers_ar = explode(";",$_POST['answers_options_ar'] );

	if($_POST['submit'] == "Add" )
	{
		//First Unset ID before ADD
		$state = $db -> insert($this_table_name, $tobesaved);
		for($i=0;$i<sizeof($array_of_answers);$i++)
		{
			unset($tobesaved_answer);
			$tobesaved_answer['polls_answer_question_id'] = $state;
			$tobesaved_answer['polls_answer_title'] = $array_of_answers[$i];
			$tobesaved_answer['polls_answer_title_ar'] = $array_of_answers_ar[$i];
			$tobesaved_answer['polls_answer_ord'] = ($i+1);
			$db->insert("polls_answer" , $tobesaved_answer);
			
		}
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=added&filter=edit&id={$state}' </script>");
		}
		
	}
	if($_POST['submit'] == "Edit" )
	{
		 		
		$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);
		$db->query("delete from polls_answer where polls_answer_question_id	 =".$_POST['id']);
		for($i=0;$i<sizeof($array_of_answers );$i++)
		{
			unset($tobesaved_answer);
			$tobesaved_answer['polls_answer_question_id'] = $_POST['id'];
			$tobesaved_answer['polls_answer_title'] = $array_of_answers[$i];
			$tobesaved_answer['polls_answer_title_ar'] = $array_of_answers_ar[$i];
			$tobesaved_answer['polls_answer_ord'] = ($i+1);
			$db->insert("polls_answer" , $tobesaved_answer);
			
		}
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
		}
		
	}
		
	
}

if($filter == "edit" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$display_brand = $db->querySelect('select products_brand_ID as "id" , products_brand_name as "value" from products_brand order by products_brand_ID');
$display_active = array(array('id'=>'1','value'=>'Yes'),array('id'=>'0','value'=>'No'));

if($filter == "edit" )
{
	//get current answers 
	$display_answers = $db->querySelect("select polls_answer_ID as id , polls_answer_title as value from polls_answer where polls_answer_question_id = ".$id." order by polls_answer_ord ");
	$mcq_current_options = "";
	for($i=0 ; $i<sizeof($display_answers) ; $i++)
	{
		$mcq_current_options.=$display_answers[$i]['value'];
		$mcq_current_options.= ($i<sizeof($display_answers)-1) ? ";" :   "";
	}
	
	$display_answers_ar = $db->querySelect("select polls_answer_ID as id , polls_answer_title_ar as value from polls_answer where polls_answer_question_id = ".$id." order by polls_answer_ord ");
	$mcq_current_options_ar = "";
	for($i=0 ; $i<sizeof($display_answers_ar) ; $i++)
	{
		$mcq_current_options_ar.=$display_answers_ar[$i]['value'];
		$mcq_current_options_ar.= ($i<sizeof($display_answers_ar)-1) ? ";" :   "";
	}
}

$form_array = array
(
	array("database_name" => "products_brand_ID" , "title" => "Product brand" , "type" => "select" , "required" => "1" ,"current_value"=> $display['products_brand_ID'] ,"attached_options" => $display_brand ) ,

	array("database_name" => "polls_question_title" , "title" => "Title(English)" , "type" => "text" , "required" => "1" ,"current_value"=> $display['polls_question_title'] ) ,
	array("database_name" => "answers_options" , "title" => "Choices (English): (seperate questions by putting ' ; ' ) " ,"message" => "This field will be neglected if type of questions is written" , "type" => "text" , "required" => "0" ,"current_value"=>$mcq_current_options ) , 
	
	array("database_name" => "polls_question_title_ar" , "title" => "Title(Arabic)" , "type" => "text" , "required" => "1" ,"current_value"=> $display['polls_question_title_ar'] ) ,
	array("database_name" => "answers_options_ar" , "title" => "Choices (Arabic): (seperate questions by putting ' ; ' ) " ,"message" => "This field will be neglected if type of questions is written" , "type" => "text" , "required" => "0" ,"current_value"=>$mcq_current_options_ar ) , 
	
	array("database_name" => "polls_active" , "title" => "Active" , "type" => "select" ,"attached_options" => $display_active, "required" => "0" ,"current_value"=> $display['polls_active'] ) ,
 
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
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name where 1 {$search_query_string} ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where 1 {$search_query_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"products_brand_ID","title" => "Product Brand" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "select" ,'attached_options' =>$display_brand  ),
		array("ID"=>"polls_question_title","title" => "Question (English)" , "url_sort" => $this_page_name_with_varibles , "order" => "polls_question_title", "type"=> "text") ,
		array("ID"=>"polls_question_title_ar","title" => "Question (Arabic)" , "url_sort" => $this_page_name_with_varibles , "order" => "polls_question_title_ar", "type"=> "text") ,
		array("ID"=>"polls_active","title" => "Active" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "select" ,'attached_options' =>$display_active  ),	
	);
	
	$additional_options = array(

	array("title" => "View List of questions" , "url" => "manage_questions.php?", "pass_varible" => "fkey")
		
	);
	
	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array($add_access_token, $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array($edit_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array($delete_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				/*"extra" =>$additional_options*/
	 );
	 
	$data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		$data[$i]['ID'] = $display[$i]['polls_question_ID'];
		$data[$i]['products_brand_ID'] = $display[$i]['products_brand_ID'];
		$data[$i]['polls_question_title'] = $display[$i]['polls_question_title'];
		$data[$i]['polls_question_title_ar'] = $display[$i]['polls_question_title_ar'];
		$data[$i]['polls_active'] = $display[$i]['polls_active'];
		
	}
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>