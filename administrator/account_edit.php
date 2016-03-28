<?php
$page_title = "Users";
$single_term = "user";
$plural_term = "users";


$filter = $_GET['filter'];



$form_submit = "Edit";


$this_page_name = basename(__FILE__);
$this_table_name = "users";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

$search_headers_attr = "users_name;users_email"; //Seperate with semicolumns;
$search_select_attr = "users_ID;users_name";



?>
<?php include("header.php");?> 
<?php
$id = $current_user_id;
?>

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
	
	if($_POST['submit'] == "Edit" )
	{
		$error = Administrator::password_complex($_POST['users_password']);
		
		if($error)
		{
			$state = false;
			echo "Password validation failure(your choise is weak ): <br/> $error";
		} 
		else 
		{
			$tobesaved['users_orignal_password'] = $_POST['users_password'];
			$tobesaved['users_password'] = crypt(sha1(md5($db->escape($_POST['users_password']))), 'st') ;
			$tobesaved['users_updated_date'] = time();
			
			$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);
			if($state != false)
			{
				die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
			}	
		}
		
	}
	
	
}




$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$form_array = array
(
	array("database_name" => "users_email" , "title" => "Email" , "type" => "text" , "required" => "1" ,"current_value"=> $display['users_email'] ) ,
	array("database_name" => "users_password" , "title" => "Password" , "type" => "password" , "required" => "1" ,"current_value"=> $display['users_password'] ) ,
	array("database_name" => "users_name" , "title" => "Full Name" , "type" => "text","read_only"=>false , "required" => "1" ,"current_value"=> $display['users_name'] ) ,
	
	array("database_name" => "id" , "title" => "Description" , "type" => "hidden" , "required" => "0" ,"value"=> $id  )
	
);


?>

<!-- start content-outer -->
<section id="main" class="column">
 
<?php


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

?>	 

</section>

