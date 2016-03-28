<?php
$page_title = "Members Recipes";
$single_term = "recipe";
$plural_term = "recipes";


$filter = $_GET['filter'];
$id = (int)$_GET['id'];

$approve_filter = (int) $_GET['approve'];

$sub_section_filter = (int) $_GET['sub_section'];
$parent_filter = (int) $_GET['parent'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "members_recipes";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "members_recipes_ID;members_recipes_name"; //Seperate with semicolumns;

$order = $_GET['order']!="" ? $_GET['order'] : $this_table_name."_ID";
$direction = $_GET['dir']=="" || $_GET['dir']==0  ? "desc" : "asc";
$page = (int)$_GET['page']!="" 	? (int)$_GET['page'] : 1;

//Handle Access Attr.
$add_item_flag = false;
$edit_item_flag = true;
$delete_item_flag = true;
$view_access_token = "can_view";
$add_access_token = "can_add";
$edit_access_token = "can_edit";
$delete_access_token = "can_delete";

?>
<?php include("header.php");?>
<?php
require_once("nestle/pointssystem.php");
require_once("nestle/trophiessystem.php");
?>
<script type="text/javascript">
$(document).ready(function(e) {
	 <?php
	if($filter == "add")
	{
	?>
    $('#articles_section').prepend("<option value='' selected >Choose One...</option>");

	<?php
	}
	?>
	
    $("#articles_section").change(function(e) {
        
		var aid = $(this).val();
		$("#articles_sections_ID").html("<option value=''>Loading...</option>");
		
		if( aid == "") {$("#articles_sections_ID").html("<option value=''></option>");return false;} 
		$.ajax({
			  url: "ajax/get_sections.php",
			  type: "POST",
			  data: {aid: aid , type : 'sub_section' },
			  cache: false,
			  dataType: "json",
			  success: function(success_array)
			  {
				  $("#articles_sections_ID").html(success_array.sections_list);
				  
			  },
			  error: function(xhr, ajaxOptions, thrownError)
			  {
			  }
			  
		});
    });//End of change
});
</script>
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
if($add_item_flag && in_array("$add_access_token", $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
}

?>

<?php
$current_upload_directory = $images_dir['users_recipes'];

//INitilize Fields with input File  , IMPORTANT for tobesaved generator

//Pictures Columns inilitize
$pictures_columns = array();
$pictures_columns[0] = "members_recipes_image";



$files_array_search = array ($pictures_columns[0]); 
$files_array = array 
(
	$pictures_columns[0] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),

);


//Apply Image Crop
$crop_settings = array();
$current_cropsettings_index = 0 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "1";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 220;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 170;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 220;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 170;


$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);


//IF a Form is submitted
if($_POST['submit'] == "Add" ||  $_POST['submit'] == "Edit" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);

	
	if($_POST['submit'] == "Add" )
	{
		//First Unset ID before ADD
		//$tobesaved['articles_date']  = date('Y-m-d');
		$state = $db -> insert($this_table_name, $tobesaved);
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=added&filter=edit&id={$state}' </script>");
		}
		
	}
	if($_POST['submit'] == "Edit" )
	{
		
		if($tobesaved['members_recipes_approved_old'] != $tobesaved['members_recipes_approved'])
		{
			$points_handler = new Pointssystem();
			if($tobesaved['members_recipes_approved'] == 1)
			{

				$points_handler->approve_action($tobesaved['members_recipes_members_id'] , $points_handler->upload_recipe_points,"upload_recipe",$_POST['id']);

				
				
				
				
			}
			else
			{
				$points_handler->disapprove_action($tobesaved['members_recipes_members_id'] , $points_handler->upload_recipe_points);
			}
		}
		$member_id_temp = $tobesaved['members_recipes_members_id'];
		unset($tobesaved['members_recipes_members_id']);
		unset($tobesaved['members_recipes_approved_old']);
		$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);
		//Check For trophies
		$trophies_handler = new Trophiessystem(2 , $member_id_temp);
		$trophies_handler->check_requirments_of_member();
		
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
		}
		
	}
	
	
}



if($filter == "edit" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$display_product = $db->querySelect('select recipes_products_ID as "id" , recipes_products_name as "value" from recipes_products');
$display_cuisines = $db->querySelect('select cuisines_ID as "id" , cuisines_name as "value" from cuisines');
$display_selection = $db->querySelect('select selection_ID as "id" , selection_name as "value" from selection');
$display_dish = $db->querySelect('select dish_ID as "id" , dish_name as "value" from dish');
$display_active = array(array("id" => "-1" , "value" => "Active"), array("id" => "0" , "value" => "Not Active"));
$display_approve = array(array("id"=>0,"value"=>"NO"),array("id"=>1, "value"=>"YES") );

$form_array = array
(
	array("database_name" => "members_recipes_name" , "title" => "Title" , "type" => "text" , "required" => "0" ,"current_value"=> $display['members_recipes_name'] ) ,
	array("database_name" => "members_recipes_product_id" , "title" => "Product" , "type" => "select" , "required" => "1" ,"attached_options" => $display_product ,"current_value"=> $display['members_recipes_product_id'] ) ,
	array("database_name" => "members_recipes_dish_id" , "title" => "Dish" , "type" => "select" , "required" => "1" ,"attached_options" => $display_dish ,"current_value"=> $display['members_recipes_dish_id'] ) ,
	array("database_name" => "members_recipes_cuisine_id" , "title" => "Cuisine" , "type" => "select" , "required" => "1" ,"attached_options" => $display_cuisines ,"current_value"=> $display['members_recipes_cuisine_id'] ) ,
	array("database_name" => "members_recipes_selection_id" , "title" => "Selection" , "type" => "select" , "required" => "0" ,"attached_options" => $display_selection ,"current_value"=> $display['members_recipes_selection_id'] ) ,

	
	array("database_name" => "members_recipes_directions" , "title" => "Directions" , "type" => "textarea" , "required" => "0" ,"current_value"=> $display['members_recipes_directions'] ) ,

	array("database_name" => $pictures_columns[0] , "title" => "Image" , "type" => "image" , "required" => "1" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[0]]) ,
	array("database_name" => "members_recipes_cookingtime" , "title" => "Cooking Time" , "type" => "text" , "required" => "0" ,"current_value"=> $display['members_recipes_cookingtime'] ) ,
	array("database_name" => "members_recipes_calories" , "title" => "Calories" , "type" => "text" , "required" => "0" ,"current_value"=> $display['members_recipes_calories'] ) ,
	
  	array("database_name" => "members_recipes_approved" , "title" => "Approve" , "type" => "select" , "required" => "1" ,"attached_options" => $display_approve ,"current_value"=> $display['members_recipes_approved'] ) ,
	
	//array("database_name" => "members_recipes_approved" , "title" => "Status" , "type" => "select" ,"attached_options" => $display_approved, "required" => "0" ,"current_value"=> $display['members_recipes_approved'] ) ,	
	array("database_name" => "members_recipes_approved_old"  , "type" => "hidden" ,"value"=>  $display['members_recipes_approved']  ),
	
	
	array("database_name" => "members_recipes_members_id"  , "type" => "hidden" ,"value"=>  $display['members_recipes_members_id']  ),
	
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

//Where Conditions
$search_query_string = $generator->generate_search_query($search_headers_attr,$search_query);


	
//Filters 
if($sub_section_filter)
$sub_section_string = " and sub_sections_sections_ID = ".$sub_section_filter;

if($parent_filter)
$parent_string = " and sub_sections_parent = ".$parent_filter;

if($approve_filter)
$approve_string = " and members_recipes_approved = ".$approve_filter;

//if ( $start_date_filter != "" )
//$start_date_filter_string = " and schedule_start_date='".$start_date_filter."'";

//Order by
$sort_by_query = "order by ".$order." ".$direction ;

$join = " INNER JOIN members ON members_ID=members_recipes_members_id ";



//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name {$join} where 1 {$search_query_string} {$sub_section_string} {$parent_string} {$approve_string}");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array("$view_access_token", $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name {$join} where 1 {$search_query_string}  {$sub_section_string} {$parent_string} {$approve_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"members_recipes_name", "title" => "Name" , "url_sort" => $this_page_name_with_varibles , "order" => "members_recipes_name" ,"type"=> "text"),
		array("ID"=>"members_first_name", "title" => "Name" , "url_sort" => $this_page_name_with_varibles , "order" => "members_first_name" ,"type"=> "text"),
		array("ID"=>"members_recipes_image","title" => "Image" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "image" , "image_dir"=> $current_upload_directory ,"image_version" => "thumb" ),		
		array("ID"=>"members_recipes_approved" , "title" => "Approve" , "url_sort" => $this_page_name_with_varibles , "order" => "members_recipes_approved" , "type"=> "text")	,	

		//array("ID"=>"Active","title" => "Active" , "url_sort" => $this_page_name_with_varibles , "order" => "Active", "type"=> "text")	,
	
	);
	
	//Filters Options

	$filter_options= array(
		array("ID"=>"approve","title" => "Approve" ,"type" => "select" , "attached_options" =>$display_approve),
		);
	
	/*$additional_options = array(
	array("title" => "Toggle Approve" , "url" => "{$this_page_name_with_varibles}", "additional_attr" => "members_recipes_approved" , "pass_varible" => "" , "class_name"=>"approve_toggle" ,"icon" => "icon-3"),
	);*/
	
	
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
		
		$data[$i]['ID'] = $display[$i]['members_recipes_ID'];
		$data[$i]['members_recipes_name'] = $display[$i]['members_recipes_name'];
		$data[$i]['members_recipes_image'] = $display[$i]['members_recipes_image'];
		$data[$i]['members_first_name'] = $display[$i]['members_first_name']." ".$display[$i]['members_last_name'];
		$data[$i]['members_recipes_approved'] = $display[$i]['members_recipes_approved'] == 0 ? "No" : "Yes";
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