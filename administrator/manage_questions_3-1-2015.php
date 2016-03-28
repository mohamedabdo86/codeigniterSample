<?php
$page_title = "Questions of Quiz";
$single_term = "question";
$plural_term = "questions";

$parent_page_title = "Quiz";
$parent_page_name = "manage_quizes.php";

$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "quizes_questions";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];


//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "quizes_questions_title"; //Seperate with semicolumns;

$fkey  = (int) $_GET['fkey'];
if( $fkey == ""  ) $fkey = $_POST['quizes_questions_quizes_ID'];
if( $fkey == ""  ) die("<script>location.href = 'manage_quizes.php' </script>");

$this_page_name_with_varibles = "{$this_page_name}?fkey=".$fkey;
 
 

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
<script>
var characters_of_choices=new Array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p");
$(document).ready(function(e) {
	
	$("#quizes_title").hide();
	
	$("#answers_options").blur(function(e) 
	{
		var string = $(this).val();
		
		var string_of_options = string.split(";");
		var new_options_string = "";
		
		for(i=0;i<string_of_options.length;i++)
		{
			new_options_string = new_options_string + '<option value="'+string_of_options[i]+'">'+characters_of_choices[i]+' ) '+string_of_options[i]+'</option>';
		}
	
		$("#correct_answer").html(new_options_string);
		
    });
	
	$("#answers_options_ar").blur(function(e) 
	{
		var string = $(this).val();
		
		var string_of_options_ar = string.split(";");
		var new_options_string_ar = "";
		
		for(i=0;i<string_of_options_ar.length;i++)
		{
			new_options_string_ar = new_options_string_ar + '<option value="'+string_of_options_ar[i]+'">'+characters_of_choices[i]+' ) '+string_of_options_ar[i]+'</option>';
		}
	
		$("#correct_answer_ar").html(new_options_string_ar);
		
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

?>

<?php


//forigen key data
$display_fkey_data = $db->querySelectSingle("select * from quizes where quizes_ID = ".$fkey);

$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);

//echo $generator->generate_javascript_imagecrop($crop_settings);


//IF a Form is submitted
if($_POST['submit'] == "Add" ||  $_POST['submit'] == "Edit" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);
	unset($tobesaved['quizes_title']);
	unset($tobesaved['answers_options']);
	unset($tobesaved['correct_answer']);
	unset($tobesaved['answers_options_ar']);
	unset($tobesaved['correct_answer_ar']);
	$correct_answer_id = -1;
	$correct_answer_id_ar = -1;
	if($tobesaved['questions_type_ismcq'] != 0)
	{
		//Prepare answers array
		$array_of_answers = explode(";",$_POST['answers_options'] );
		
		for($i=0;$i<sizeof($array_of_answers );$i++)
		{
			if( $array_of_answers[$i] == $_POST['correct_answer']  )
			$correct_answer_id = $i;
			
		}
		
		//Prepare answers array
		$array_of_answers_ar = explode(";",$_POST['answers_options_ar'] );
		
		for($i=0;$i<sizeof($array_of_answers_ar );$i++)
		{
			if( $array_of_answers_ar[$i] == $_POST['correct_answer_ar']  )
			$correct_answer_id_ar = $i;
			
		}
		
	}

	unset($tobesaved['questions_type_ismcq']);
		
	if($_POST['submit'] == "Add" )
	{
		//First Unset ID before ADD
		
		$state = $db -> insert($this_table_name, $tobesaved);
		for($i=0;$i<sizeof($array_of_answers );$i++)
		{
			//ashraf add it 
			$array_of_answer_and_unique_value = explode(",", $array_of_answers[$i]);
			
			
			unset($tobesaved_answer);
			$tobesaved_answer['quizes_answers_questions_ID'] 	 = $state;
			$tobesaved_answer['quizes_answers_title'] = $array_of_answer_and_unique_value[0];
			$tobesaved_answer['quizes_answers_correctanswer'] = $correct_answer_id == $i ? 1 : 0;
			$tobesaved_answer['quizes_answers_title_ar'] = $array_of_answers_ar[$i];
			$tobesaved_answer['quizes_answers_correctanswer_ar'] = $correct_answer_id_ar == $i ? 1 : 0;
			$tobesaved_answer['quizes_answers_ord'] = ($i+1);
			
			
	$tobesaved_answer['quizes_answers_quizes_unique_value_ID'] = $array_of_answer_and_unique_value[1];
	
			$db->insert("quizes_answers" , $tobesaved_answer);
			
		}
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=added&filter=edit&id={$state}' </script>");
		}
		
	}
	if($_POST['submit'] == "Edit" )
	{
		 
		
		
		$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);
		$db->query("delete from quizes_answers where quizes_answers_questions_ID =".$_POST['id']);
		for($i=0;$i<sizeof($array_of_answers );$i++)
		{
			//ashraf add it 
			$array_of_answer_and_unique_value = explode(",", $array_of_answers[$i]);
			
			unset($tobesaved_answer);
			$tobesaved_answer['quizes_answers_questions_ID'] 	 = $_POST['id'];
			$tobesaved_answer['quizes_answers_title'] = $array_of_answer_and_unique_value[0];
			$tobesaved_answer['quizes_answers_correctanswer'] = $correct_answer_id == $i ? 1 : 0;
			$tobesaved_answer['quizes_answers_title_ar'] = $array_of_answers_ar[$i];
			$tobesaved_answer['quizes_answers_correctanswer_ar'] = $correct_answer_id_ar == $i ? 1 : 0;
			$tobesaved_answer['quizes_answers_ord'] = ($i+1);
			
			$tobesaved_answer['quizes_answers_quizes_unique_value_ID'] = $array_of_answer_and_unique_value[1];
			$db->insert("quizes_answers" , $tobesaved_answer);
			
		}
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
		}
		
	}
		
	
}

$display_question_types = array ( array("id"=>0 , "value" => "Writter Question") , array("id"=>1 , "value" => "Mulitple Choice Question") ) ;
 


if($filter == "edit" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

if($filter == "edit" )
{
	//get current answers 
	$display_answers = $db->querySelect("select quizes_answers_ID as id , quizes_answers_title as value from quizes_answers where quizes_answers_questions_ID = ".$id." order by quizes_answers_ord");
	$mcq_current_options = "";
	for($i=0 ; $i<sizeof($display_answers) ; $i++)
	{
		$mcq_current_options.=$display_answers[$i]['value'];
		$mcq_current_options.= ($i<sizeof($display_answers)-1) ? ";" :   "";
	}
	//get correct answer value
	$display_correct_answer = $db->querySelectSingle("select quizes_answers_ID as id from quizes_answers where quizes_answers_correctanswer=1 and quizes_answers_questions_ID = ".$id);
	$mcq_current_answer = $display_correct_answer['id'];
	
	//For Arabic
	
	//get current answers 
	$display_answers_ar = $db->querySelect("select quizes_answers_ID as id , quizes_answers_title_ar as value from quizes_answers where quizes_answers_questions_ID = ".$id." order by quizes_answers_ord");
	$mcq_current_options_ar = "";
	for($i=0 ; $i<sizeof($display_answers_ar) ; $i++)
	{
		$mcq_current_options_ar.=$display_answers_ar[$i]['value'];
		$mcq_current_options_ar.= ($i<sizeof($display_answers_ar)-1) ? ";" :   "";
	}
	//get correct answer value
	$display_correct_answer_ar = $db->querySelectSingle("select quizes_answers_ID as id from quizes_answers where quizes_answers_correctanswer_ar =1 and quizes_answers_questions_ID = ".$id);
	$mcq_current_answer_ar = $display_correct_answer_ar['id'];

}

$form_array = array
(
	array("database_name" => "quizes_title" , "title" => "Exam title: &nbsp;&nbsp; '".$display_fkey_data['quizes_title']."'" , "type" => "text" , "required" => "0" ,"current_value"=> $display_fkey_data['quizes_title'] ) ,
	array("database_name" => "quizes_questions_title" , "title" => "Title (English)" , "type" => "text" , "required" => "1" ,"current_value"=> $display['quizes_questions_title'] ) ,
	array("database_name" => "quizes_questions_title_ar" , "title" => "Title (Arabic)" , "type" => "text" , "required" => "1" ,"current_value"=> $display['quizes_questions_title_ar'] ) ,
	
	//array("database_name" => "questions_type_ismcq" , "title" => "Type of Question" , "type" => "select","attached_options" =>$display_question_types , "required" => "1" ,"current_value"=> $display['questions_type_ismcq']   ) ,
	array("database_name" => "answers_options" , "title" => "Choices : (seperate questions by putting ' ; ' ) " ,"message" => "This field will be neglected if type of questions is written" , "type" => "text" , "required" => "0" ,"current_value"=>$mcq_current_options ) , 
	array("database_name" => "correct_answer" , "title" => "Correct Choice" ,"message" => "This field will be neglected if type of questions is written" , "type" => "select" , "attached_options" => $display_answers , "required" => "0" ,"current_value"=> $mcq_current_answer ) , 

	array("database_name" => "answers_options_ar" , "title" => "Choices : (seperate questions by putting ' ; ' ) (Arabic)" ,"message" => "This field will be neglected if type of questions is written" , "type" => "text" , "required" => "0" ,"current_value"=>$mcq_current_options_ar ) , 
	array("database_name" => "correct_answer_ar" , "title" => "Correct Choice (Arabic)" ,"message" => "This field will be neglected if type of questions is written" , "type" => "select" , "attached_options" => $display_answers_ar , "required" => "0" ,"current_value"=> $mcq_current_answer_ar ) , 
	
	array("database_name" => "questions_type_ismcq" , "title" => "Type of Question" , "type" => "hidden","value"=> 1  ) ,
  	array("database_name" => "quizes_questions_quizes_ID"  , "type" => "hidden" ,"value"=> $fkey  ),
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
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name where 1 and quizes_questions_quizes_ID={$fkey} {$search_query_string} ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where 1 and quizes_questions_quizes_ID={$fkey} {$search_query_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"quizes_title", "title" => "Exam Title" , "url_sort" => $this_page_name_with_varibles , "order" => "" ,"type"=> "text"),
		
		array("ID"=>"quizes_questions_title","title" => "Question (English)" , "url_sort" => $this_page_name_with_varibles , "order" => "quizes_questions_title", "type"=> "text") ,
		array("ID"=>"quizes_questions_title_ar","title" => "Question (Arabic)" , "url_sort" => $this_page_name_with_varibles , "order" => "quizes_questions_title_ar", "type"=> "text") ,

		//array("ID"=>"questions_type_ismcq", "title" => "No. Of Questions" , "url_sort" => $this_page_name_with_varibles , "order" => "questions_type_ismcq" ,"type"=> "select" , "attached_options" => $display_question_types ),
		//array("ID"=>"avail_answers", "title" => "Available Answers(Case of MCQ)" , "url_sort" => $this_page_name_with_varibles , "order" => "" ,"type"=> "text" ),
		//array("ID"=>"correct_answer", "title" => "Correct Answer (Case of MCQ)" , "url_sort" => $this_page_name_with_varibles , "order" => "" ,"type"=> "text"),
	
	
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
		unset($display_answers);
		unset($display_correct_answer);
		unset($mcq_current_options);
		unset($mcq_current_answer);
		if($display[$i]['questions_type_ismcq'] == 1 )
		{
			$display_answers = $db->querySelect("select quizes_answers_ID as id , quizes_answers_title as value from quizes_answers where quizes_answers_questions_ID = ".$display[$i]['questions_ID']." order by quizes_answers_ord");
			$mcq_current_options = "";
			for($j=0 ; $j<sizeof($display_answers) ; $j++)
			{
				$mcq_current_options.=$display_answers[$j]['value'];
				$mcq_current_options.= ($j<sizeof($display_answers)-1) ? "<br />" :   "";
			}
			//get correct answer value
			$display_correct_answer = $db->querySelectSingle("select quizes_answers_title as value from quizes_answers where quizes_answers_correctanswer=1 and quizes_answers_questions_ID = ".$display[$i]['questions_ID']);
			$mcq_current_answer = $display_correct_answer['value'];
		}
		
		$data[$i]['ID'] = $display[$i]['quizes_questions_ID'];
		$data[$i]['quizes_title'] = $display_fkey_data['quizes_title'];		
		$data[$i]['quizes_questions_title'] = $display[$i]['quizes_questions_title'];
		$data[$i]['quizes_questions_title_ar'] = $display[$i]['quizes_questions_title_ar'];
		//$data[$i]['questions_type_ismcq'] = $display[$i]['questions_type_ismcq'];
		//$data[$i]['avail_answers'] =$mcq_current_options == "" ? "N/A" :$mcq_current_options  ;
		//$data[$i]['correct_answer'] = $mcq_current_answer == "" ? "N/A" :$mcq_current_answer  ;
		 
	 
		
		
	}
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>


