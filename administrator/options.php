<?php
$page_title = "Options";
$single_term = "option";
$plural_term = "options";

/*
$filter = $_GET['filter'];
$id = (int)$_GET['id'];

*/
$form_submit = "Edit";


$this_page_name = "options.php";
$this_table_name = "options";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];



?>
<?php include("header.php");
?> 

<?php





$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles);



//echo $generator->generate_javascript_imagecrop($crop_settings);


//IF a Form is submitted
if($_POST['submit'] == "Edit" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);
	if($_POST['submit'] == "Edit" )
	{
		
		
		foreach($tobesaved as $key => $value ):
		unset($tobesaved_options);
		$tobesaved_options['options_value'] = $value;
		$state = $db->update($this_table_name , $tobesaved_options , $this_table_name."_key='".$key."'");		
		endforeach;
		
		
		 
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated' </script>");
		}
		
	}
	
	
}

$display_types = array (
array("id"=>"Administrator","value"=>"Administrator"),array("id"=>"Limited","value"=>"Limited")
);


$display = $db-> querySelect("select * from $this_table_name order by options_ID"); 



$options_array = get_options_attr($display);

$form_array = array
(
	array("database_name" => "website_name" , "title" => "Website Name" , "type" => "text" , "required" => "1" ,"current_value"=> $options_array['website_name'] ) ,
	array("database_name" => "website_default_path" , "title" => "Local Path" , "type" => "text" , "required" => "1" ,"current_value"=> $options_array['website_default_path'] , "message" => "Must end with ' / ' "  ) ,
	array("database_name" => "website_current_path" , "title" => "Current Path" , "type" => "text" , "required" => "1" ,"current_value"=> $options_array['website_current_path'] , "message" => "Must end with ' / ' "  ) ,
	array("database_name" => "website_admin" , "title" => "Website Admin" , "type" => "text" , "required" => "1" ,"current_value"=> $options_array['website_admin'] ) ,
	array("database_name" => "id" , "title" => "Description" , "type" => "hidden" , "required" => "0" ,"value"=> $id  )
	
);


?>

<!-- start content-outer -->
<section id="main" class="column">
 
<?php
 
	if($state!=""):
	
	if(!in_array("can_edit", $current_array_of_actions)   )
	echo "<script type='text/javascript'>location.href='no_access.php'</script>";
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
 

?>	 

</section>


