<?php
$page_title = "Users";
$single_term = "user";
$plural_term = "users";


$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = "users.php";
$this_table_name = "users";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

$search_headers_attr = "users_name;users_email"; //Seperate with semicolumns;
$search_select_attr = "users_ID;users_name";



?>
<?php include("header.php");?> 


<?php
$current_upload_directory = "uploads/test";
//INitilize Fields with input File  , IMPORTANT for tobesaved generator
$files_array_search = array ("users_image"); 
$files_array = array 
(
	"users_image" => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" )
);


//Apply Image Crop
$crop_settings = array();
$crop_settings['users_image']['aspect_ratio'] = "4:3";
$crop_settings['users_image']['thumbnail_preview_width'] = 200;
$crop_settings['users_image']['thumbnail_preview_height'] = 150;
$crop_settings['users_image']['thumbnail_final_width'] = 280;
$crop_settings['users_image']['thumbnail_final_height'] = 210;

$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings);



//echo $generator->generate_javascript_imagecrop($crop_settings);


//IF a Form is submitted
if($_POST['submit'] == "Add" ||  $_POST['submit'] == "Edit" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);

	
	if($_POST['submit'] == "Add" )
	{
		$tobesaved['users_created_date'] = time();
		$tobesaved['users_active'] = 1;
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

$display_types = array (
array("id"=>"Administrator","value"=>"Administrator"),array("id"=>"Limited","value"=>"Limited")
);

if($filter == "edit" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$form_array = array
(
	array("database_name" => "users_email" , "title" => "Email" , "type" => "text" , "required" => "1" ,"current_value"=> $display['users_email'] ) ,
	array("database_name" => "users_password" , "title" => "Password" , "type" => "password" , "required" => "1" ,"current_value"=> $display['users_password'] ) ,
	array("database_name" => "users_name" , "title" => "Full Name" , "type" => "date","read_only"=>true , "required" => "1" ,"current_value"=> $display['users_name'] ) ,
	array("database_name" => "users_type" , "title" => "Type" , "type" => "select", "attached_options" => $display_types , "required" => "1", "current_value"=>$display['users_type']) ,
	array("database_name" => "users_image" , "title" => "Image" , "type" => "image" , "required" => "0" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display['users_image']) ,
	 
	
	array("database_name" => "id" , "title" => "Description" , "type" => "hidden" , "required" => "0" ,"value"=> $id  )
	
);


?>

<!-- start content-outer -->
<section id="main" class="column">
 
<?php
if($filter == "delete" )
{
	
}
elseif($filter == "add" )
{
	//Current User has access
	if(!in_array("add_users", $current_array_of_actions))
	echo "<script type='text/javascript'>location.href='no_access.php'</script>";

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

//Current User has access
if(!in_array("view_users", $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name");


//Table Header
	$table_header = array
	(
		array("ID" => "users_name" ,"title" => "Full Name" , "url_sort" => $this_page_name_with_varibles , "order" => "" , "index" => "0" , "type"=> "text"),		
		array("ID" => "users_email" ,"title" => "Email" , "url_sort" => $this_page_name_with_varibles , "order" => "" , "index" => "1" , "type"=> "text")	,
		array("ID" => "users_type" ,"title" => "Type" , "url_sort" => $this_page_name_with_varibles , "order" => "" , "index" => "2" , "type"=> "text")	,
		array("ID" => "users_active" ,"title" => "Active?" , "url_sort" => $this_page_name_with_varibles , "order" => "" , "index" => "3" , "type"=> "bool") ,
		array("ID" => "users_created_date" ,"title" => "Created Date" , "url_sort" => $this_page_name_with_varibles , "order" => "" , "index" => "44" , "type"=> "text") ,
		 
		
					
	
	);
	
	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> 1 && in_array("add_users", $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> 1 && in_array("edit_users", $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>1 && in_array("delete_users", $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) 
				 
	 );
	 
	 $data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		
		$data[$i]['ID'] = $display[$i]['users_ID'];
		$data[$i]['users_name'] = $display[$i]['users_name'];
		$data[$i]['users_email'] = $display[$i]['users_email'];
		$data[$i]['users_type'] = $display[$i]['users_type'];
		$data[$i]['users_active'] = $display[$i]['users_active']==1 ? "Active" : "Inactive";
		$data[$i]['users_created_date'] = date('Y-m-d',$display[$i]['users_created_date']);
	
	}
	$generator->display_table($table_header,$data,$options);
?>
		

<?php
endif;
?>	 

</section>


