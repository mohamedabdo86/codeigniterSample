<?php
$page_title = "Manage Cooking Classes";
$single_term = "class";
$plural_term = "classes";


$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "cooking_classes";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "cooking_classes_title;cooking_classes_title_ar"; //Seperate with semicolumns;

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
if($add_item_flag && in_array("$add_access_token", $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
}

?>

<?php
$current_upload_directory = $images_dir['cooking_classes'];

//INitilize Fields with input File  , IMPORTANT for tobesaved generator

//Pictures Columns inilitize
$pictures_columns = array();
$pictures_columns[0] = "cooking_classes_image";
$pictures_columns[1] = "cooking_classes_featured_image";

$files_array_search = array ($pictures_columns[0],$pictures_columns[1]); 
$files_array = array 
(
	$pictures_columns[0] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),
	$pictures_columns[1] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),

);


//Apply Image Crop0
$crop_settings = array();
$current_cropsettings_index = 0 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "20:13";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 200;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 130;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 200;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 130;

//Apply Image Crop1
$crop_settings_1 = array();
$current_cropsettings_index = 1 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "4:3";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 200;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 150;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 280;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 210;

$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);


//IF a Form is submitted
if($_POST['submit'] == "Add" ||  $_POST['submit'] == "Edit" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);
	
	$selected_week_days = $_POST['cooking_classes_days'];
	
	$tobesaved['cooking_classes_days'] = "";
	
	for($i=0 ; $i< sizeof($selected_week_days) ; $i++)
	{
		$tobesaved['cooking_classes_days'].=$selected_week_days[$i];
		
		if($i< (sizeof($selected_week_days)-1))
		{
			$tobesaved['cooking_classes_days'].= ";";
		}
	}
	
	if($_POST['submit'] == "Add" )
	{
		//First Unset ID before ADD
		$tobesaved['cooking_classes_year']  = date('Y');
		 //check if cooking_classes_featured = 1  
		if($tobesaved['cooking_classes_featured'] == 1)
		{
			$db->query("update {$this_table_name} set {$this_table_name}_featured = '0'");
		}
		$state = $db -> insert($this_table_name, $tobesaved);
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=added&filter=edit&id={$state}' </script>");
		}
		
	}
	if($_POST['submit'] == "Edit" )
	{
		 //check if cooking_classes_featured = 1  
		if($tobesaved['cooking_classes_featured'] == 1)
		{
			$db->query("update {$this_table_name} set {$this_table_name}_featured = '0'");
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


$display_active = array(array("id" => "1" , "value" => "Active"),array("id" => "0" , "value" => "Not Active"));
$display_months = array(
				array("id" => "01" , "value" => "January"),
				array("id" => "02" , "value" => "February"),
				array("id" => "03" , "value" => "March"),
				array("id" => "04" , "value" => "April"),
				array("id" => "05" , "value" => "May"),
				array("id" => "06" , "value" => "June"),
				array("id" => "07" , "value" => "July"),
				array("id" => "08" , "value" => "August"),
				array("id" => "09" , "value" => "September"),
				array("id" => "10" , "value" => "October"),
				array("id" => "11" , "value" => "November"),
				array("id" => "12" , "value" => "December")
				);
$display_days = 
array
(
  array("id" => "Sunday","value"=>"Sunday","default"=>true),
  array("id" => "Monday","value"=>"Monday","default"=>true),
  array("id" => "Tuesday","value"=>"Tuesday","default"=>true),
  array("id" => "Wednesday","value"=>"Wednesday","default"=>true),
  array("id" => "Thursday","value"=>"Thrusday","default"=>true),
  array("id" => "Friday","value"=>"Friday","default"=>true),
  array("id" => "Saturday","value"=>"Saturday","default"=>true),
  
);
$dispaly_options = array(array("id" => 0, "value" => 'No') , array("id" => 1 , "value" => "Yes") ) ;
$display_boolean = array(array("id" => 0, "value" => 'No') , array("id" => 1 , "value" => "Yes") ) ;
$checked = $display['cooking_classes_days'];
$pieces = explode(";", $checked);


$form_array = array
(
	array("database_name" => "cooking_classes_title" , "title" => "Title (English)" , "type" => "text" , "required" => "1" ,"current_value"=> $display['cooking_classes_title'] ) ,
	array("database_name" => "cooking_classes_title_ar" , "title" => "Title (Arabic)" , "type" => "text" ,"is_arabic" , "required" => "1" ,"current_value"=> $display['cooking_classes_title_ar'] ) ,
	array("database_name" => $pictures_columns[0] , "title" => "Image" , "type" => "image" , "required" => "0" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[0]]) ,

	array("database_name" => "cooking_classes_month" , "title" => "Month" , "type" => "select","attached_options" =>$display_months , "required" => "1" ,"current_value"=> $display['cooking_classes_month'] ) ,
	array("database_name" => "cooking_classes_days" , "title" => "Choose Days" , "type" => "checkbox" , "required" => "0" ,"current_value"=> $pieces,  "attached_options" => $display_days),
	array("database_name" => "cooking_classes_desc" , "title" => "Desc (English)" , "type" => "textarea" , "required" => "0" ,"current_value"=> $display['cooking_classes_desc'] ) ,
	array("database_name" => "cooking_classes_desc_ar" , "title" => "Desc (Arabic)" , "type" => "textarea" ,"is_arabic" , "required" => "0" ,"current_value"=> $display['cooking_classes_desc_ar'] ) ,
	
	array("database_name" => "cooking_classes_active" , "title" => "Active?" , "type" => "select" ,"attached_options" => $display_active, "required" => "0" ,"current_value"=> $display['cooking_classes_active'] ) ,
	array("database_name" => $pictures_columns[1] , "title" => "Featured Image 460*380" , "type" => "image" , "required" => "0" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[1]]) ,
	array("database_name" => "cooking_classes_featured" , "title" => "Featured" , "type" => "select" , "required" => "0" ,"attached_options" => $dispaly_options ,"current_value"=> $display['cooking_classes_featured'] ) ,

	
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
<script type="text/javascript">
$(document).ready(function(e) {

		$("body").on("click", ".approve_toggle", function(e){
		//get id
		var id = $(this).data("id");
		var this_table_name = "<?php echo $this_table_name; ?>";
		var column_required_to_toggle = $(this).attr('additional_attr');
		 
		$.ajax({
			  url: "ajax/featured_toogle.php",
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

				   $(".displaytables tr[id="+id+"]  td."+column_required_to_toggle+"" ).css("color","green").html(success_array.returned_array ==0 ? "No" : "Yes");
				   $(".displaytables tr[id="+success_array.last_id+"]  td."+column_required_to_toggle+"" ).css("color","black").html(success_array.last_id = "No");
				
								 
			  },
			  error: function(xhr, ajaxOptions, thrownError)
			  {
				  
			  }
			  
	});
	
	e.preventDefault();
	
    });
	
});
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
	
	if($state!="error"):
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

//Where Conditions
$search_query_string = $generator->generate_search_query($search_headers_attr,$search_query);


	
//Filters 
/*if($sub_section_filter)
$sub_section_string = " and sub_sections_sections_ID = ".$sub_section_filter;

if($parent_filter)
$parent_string = " and sub_sections_parent = ".$parent_filter;*/

//if ( $start_date_filter != "" )
//$start_date_filter_string = " and schedule_start_date='".$start_date_filter."'";

//Order by
$sort_by_query = "order by ".$order." ".$direction ;



//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name {$join} where 1 {$search_query_string} ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array("$view_access_token", $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name {$join} where 1  {$search_query_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"cooking_classes_title", "title" => "Name" , "url_sort" => $this_page_name_with_varibles , "order" => "cooking_classes_title" ,"type"=> "text"),
		array("ID"=>"cooking_classes_title_ar", "title" => "Name in Arabic" , "url_sort" => $this_page_name_with_varibles , "order" => "cooking_classes_title_ar" ,"type"=> "text"),
		array("ID"=>"cooking_classes_image","title" => "Image" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "image" , "image_dir"=> $current_upload_directory ,"image_version" => "thumb" ),	
		array("ID"=>"cooking_classes_month" , "title" => "Current Month" , "url_sort" => $this_page_name_with_varibles , "order" => "cooking_classes_month", "type"=> "select" , "attached_options" => $display_months),
		array("ID"=>"cooking_classes_days" , "title" => "Days" , "url_sort" => $this_page_name_with_varibles , "order" => "" , "type"=> "text" , "attached_options" => $display_days),
		array("ID"=>"cooking_classes_active","title" => "Status" , "url_sort" => $this_page_name_with_varibles , "order" => "cooking_classes_active", "type"=> "select" , "attached_options" => $display_active)	,
		array("ID"=>"cooking_classes_featured" , "title" => "Featured" , "url_sort" => $this_page_name_with_varibles , "order" => "cooking_classes_featured" , "type"=> "select" , "attached_options" => $display_boolean ),
	);
	
	//Filters Options
	/*if($sub_section_filter)
	{
		$display_parent = $db->querySelect("Select sub_sections_ID as 'id',sub_sections_name as 'value' from sub_sections where sub_sections_parent = ".$sub_section_filter);

		$filter_options= array(
			array("ID"=>"sub_section","title" => "Sub Sections" ,"type" => "select" , "attached_options" =>$display_section),
			array("ID"=>"parent","title" => "Parent" ,"type" => "select" , "attached_options" =>$display_parent),
			);
	}
	else
	{
		$filter_options= array(
		array("ID"=>"sub_section","title" => "Sub Sections" ,"type" => "select" , "attached_options" =>$display_section),
		);	
	}*/
	
	$additional_options = array(

	array("title" => "View Recipies" , "url" => "manage_cooking_classes_recipes.php?", "pass_varible" => "fkey"),
	array("title" => "View Dates" , "url" => "manage_cooking_class_dates.php?", "pass_varible" => "fkey"),
	array("title" => "Toggle Featured" , "url" => "{$this_page_name_with_varibles}", "additional_attr" => "cooking_classes_featured" , "pass_varible" => "" , "class_name"=>"approve_toggle" ,"icon" => "icon-3"),
	 
		
	);
	

	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array("$add_access_token", $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array("$edit_access_token", $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array("$delete_access_token", $current_array_of_actions) , "url" =>$this_page_name_with_varibles ),
				 "extra" =>$additional_options
	 );
	 
	$data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		
		$data[$i]['ID'] = $display[$i]['cooking_classes_ID'];
		$data[$i]['cooking_classes_title'] = $display[$i]['cooking_classes_title'];
		$data[$i]['cooking_classes_title_ar'] = $display[$i]['cooking_classes_title_ar'];
		$data[$i]['cooking_classes_image'] = $display[$i]['cooking_classes_image'];
		$data[$i]['cooking_classes_active'] = $display[$i]['cooking_classes_active'];
		$data[$i]['cooking_classes_month'] = $display[$i]['cooking_classes_month'];
		$data[$i]['cooking_classes_days'] = $display[$i]['cooking_classes_days'];
		$data[$i]['cooking_classes_featured'] = $display[$i]['cooking_classes_featured'];
	
	}
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>


<?php include("footer.php"); ?>
