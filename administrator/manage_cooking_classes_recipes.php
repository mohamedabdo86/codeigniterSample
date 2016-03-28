<?php
$page_title = "Recipes";
$single_term = "item";
$plural_term = "items";

$parent_page_title = "Manage Cooking Classes";
$parent_page_name = "manage_cooking_classes.php";


$this_page_name = basename(__FILE__);
$fkey = (int)$_GET['fkey'];
 
if(!isset($_GET['fkey']))
	$fkey = $_POST['fkey'];
 
$this_page_name_with_varibles = "{$this_page_name}?type=$type&fkey=$fkey";
$where = "WHERE cooking_classes_recipes_cooking_classes_ID = $fkey";

//$filter = $_GET['filter'];
$id = (int)$_GET['id'];

$filter = 'Edit';
//if($filter == "edit")
$form_submit = "Edit";
//else $form_submit = "Add";



$this_table_name = "cooking_classes_recipes";
$state = $_GET['state'];


//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "celebrities_name;celebrities_name_ar"; //Seperate with semicolumns;


$order = $_GET['order']!="" ? $_GET['order'] : $this_table_name."_ID";
$direction = $_GET['dir']=="" || $_GET['dir']==0  ? "desc" : "asc";
$page = (int)$_GET['page']!="" 	? (int)$_GET['page'] : 1;

//Handle Access Attr.
$add_item_flag = false;
$edit_item_flag = true;
$delete_item_flag = false;
$view_access_token = "can_view";
$add_access_token = "can_add";
$edit_access_token = "can_edit";
$delete_access_token = "can_delete";

?>
<?php include("header.php");?>
<script>
$(function(){
	var json_elements = <?php echo json_encode($db->querySelect("select cooking_classes_recipes_recipes_ID as id from $this_table_name where cooking_classes_recipes_cooking_classes_ID ={$fkey}  ")); ?>;
	for(i = 0; i < json_elements.length; i++)
	{
		$('#cooking_classes_recipes_recipes_ID option').each(function(){
			if($(this).attr('value') == json_elements[i].id)
				$(this).addClass('selected');
		});
	}
	$('#cooking_classes_recipes_recipes_ID').fcbkcomplete();
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

$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);



//IF a Form is submitted
if($_POST['submit'] == "Add" ||  $_POST['submit'] == "Edit" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);
	unset($tobesaved['fkey']);
	unset($tobesaved['type']);

	
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
		$celebrities = $_POST['cooking_classes_recipes_recipes_ID'];
		$current_celeb = $db->querySelect("SELECT * FROM  cooking_classes_recipes INER JOIN recipes ON cooking_classes_recipes_recipes_ID = recipes_ID WHERE cooking_classes_recipes_cooking_classes_ID = '$fkey' ");
		foreach($current_celeb as $cc)
			$db->query("DELETE FROM cooking_classes_recipes WHERE cooking_classes_recipes_recipes_ID = '" . $cc['cooking_classes_recipes_recipes_ID'] . "'");
		$state = true;
		for($i = 0; $i < sizeof($celebrities); $i++)
		{
			$tobesaved['cooking_classes_recipes_cooking_classes_ID'] = $fkey;
			$tobesaved['cooking_classes_recipes_recipes_ID'] = $celebrities[$i];
			if(!$db->insert('cooking_classes_recipes', $tobesaved)) $state = false;
		}
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated' </script>");
		}
		
	}
	
	
}

if($filter == "edit" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_programs_ID ={$fkey}");

$display_celebrities = $db->querySelect("SELECT recipes_ID as id, recipes_title as value FROM recipes ");
//Prepare Form (add and edit)
$form_array = array
(
	array("database_name" => "cooking_classes_recipes_recipes_ID" , "title" => "" , "type" => "select" , "required" => "0" , "current_value"=>$display['cooking_classes_recipes_recipes_ID'], "attached_options" => $display_celebrities) ,	
	array("database_name" => "fkey" , "title" => "" , "type" => "hidden" , "required" => "0" ,"value"=> $fkey  ),
	array("database_name" => "type" , "title" => "" , "type" => "hidden" , "required" => "0" ,"value"=> $type )
	
	
);


?>
<!-- start content-outer -->
<section id="main" class="column">
<?php $display_program = $db->querySelectSingle('SELECT * FROM cooking_classes WHERE cooking_classes_ID = ' . $fkey); ?>
<h3 style="position: relative;top: 45px;left: 143px;"> to " <?php echo $display_program['cooking_classes_title']; ?> "</h3>
<?php

	if(!in_array("can_edit", $current_array_of_actions) || !$edit_item_flag )
	echo "<script type='text/javascript'>location.href='no_access.php'</script>";
	
	if($state!=""):
	?>
	<script type="text/javascript">
	$(document).ready(
	function()
	{
		   $.gritter.add({
					class_name: 'notification_green_color',
					title: 'Updated!',
					text: 'Data are Updated.',
					sticky: false,
					time: '2500',
					fade_out_speed : 1500
						});
		
	}
	);
	</script>
	<?php
	endif;
	$generator->prepare_edit_form($form_array);
	
//}
?>

</section>
