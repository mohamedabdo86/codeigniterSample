<?php
$page_title = "Pages";
$single_term = "page";
$plural_term = "pages";

$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = "pages.php";
$this_table_name = "pages";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];


?>
<?php include("header.php"); ?>
<?php
$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term);

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
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$form_array = array
(
	array("database_name" => "pages_title" , "title" => "Page Name" , "type" => "text" , "required" => "1" ,"current_value"=> $display['pages_title'] ) ,
	array("database_name" => "pages_single" , "title" => "Single" , "type" => "text" , "required" => "1" ,"current_value"=> $display['pages_single'] ) ,
	array("database_name" => "pages_plural" , "title" => "Plural" , "type" => "text" , "required" => "1" ,"current_value"=> $display['pages_plural'] ) ,
	
	array("database_name" => "id" , "title" => "Description" , "type" => "hidden" , "required" => "0" ,"value"=> $id  )
	
);


?>

<section id="main" class="column">

<?php
if($filter == "delete" )
{
	
}
elseif($filter == "add" )
{
	$generator->prepare_add_form($form_array);
}
elseif($filter == "edit" )
{
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
}
if(!isset($filter)):

$display = $db->querySelect("select * from pages ");


//Table Header
	$table_header = array
	(
		array("title" => "Page Name" , "url_sort" => $this_page_name_with_varibles , "order" => "name" , "index" => "0" , "type"=> "text"),		
		array("title" => "Single" , "url_sort" => $this_page_name_with_varibles , "order" => "email" , "index" => "1" , "type"=> "text")	,
		array("title" => "Plural" , "url_sort" => $this_page_name_with_varibles , "order" => "dob" , "index" => "2" , "type"=> "text")	,
		array("title" => "Active?" , "url_sort" => $this_page_name_with_varibles , "order" => "area" , "index" => "3" , "type"=> "text") ,
		 
		
					
	
	);
	$additional_options = array(
	array("title" => "Manage Attr." , "url" => "pages_attr.php?filter=edit" , "pass_varible" => "page_id"),
	array("title" => "Manage Headers" , "url" => "pages_headers.php?filter=edit" , "pass_varible" => "page_id")
	
	);
	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> "1" , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> "1" , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=> "1" , "url" =>$this_page_name_with_varibles ) ,
				"extra" => $additional_options
	 );
	 
	 $data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		
		$data[$i]['ID'] = $display[$i]['pages_ID'];
		$data[$i][0] = $display[$i]['pages_title'];
		$data[$i][1] = $display[$i]['pages_single'];
		$data[$i][2] = $display[$i]['pages_plural'];
		$data[$i][3] = $display[$i]['pages_isdisabled']==0 ? "Active" : "Inactive";
	
	}
	$generator->display_table($table_header,$data,$options);
?>
		

<?php
endif;
?>	 
</section>

