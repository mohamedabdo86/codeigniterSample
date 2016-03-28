<?php
$page_title = "Products brand";
$single_term = "products";
$plural_term = "products";

$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "products_brand";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "products_ID;products_name_ar;products_name"; //Seperate with semicolumns;

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
<style>
p
{
	width:300px;
	font-family:inherit;
}
</style>
<?php

//$location =  'http://' . $_SERVER['HTTP_HOST'] . '/~devarea/nestle/uploads/products/';

//Add New Item Link
$add_extra_add_item_when_edit_form = false;
if($add_item_flag && in_array($add_access_token, $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
}

?>

<?php

$current_upload_directory = $images_dir['products_brand'];
//INitilize Fields with input File  , IMPORTANT for tobesaved generator

//Pictures Columns inilitize
$pictures_columns = array();
$pictures_columns[0] = "products_brand_top_Image";
$pictures_columns[1] = "products_brand_top_Image_ar";
$pictures_columns[2] = "products_brand_banner";
$pictures_columns[3] = "products_brand_logo";


$files_array_search = array ($pictures_columns[0],$pictures_columns[1],$pictures_columns[2],$pictures_columns[3]); 
$files_array = array 
(
	$pictures_columns[0] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),
	$pictures_columns[1] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),
	$pictures_columns[2] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),
	$pictures_columns[3] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),
);

//Apply Image Crop
$crop_settings = array();
$current_cropsettings_index = 0 ;

$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "1";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 220;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 170;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 220;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 170;


$current_cropsettings_index = 1 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "1";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 220;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 170;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 220;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 170;

$current_cropsettings_index = 2 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "1";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 220;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 170;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 220;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 170;

$current_cropsettings_index = 3 ;
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


if($filter == "edit" ){
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 
$new_brand_order=$display['products_brand_order'];
}
//ashraf add this
if($filter == "add"){
$current_order = $db-> numRows("select * from $this_table_name"); 
$new_brand_order=$current_order+2;

}
$display_active = array(array('id'=>'1','value'=>'Yes'),array('id'=>'0','value'=>'No'));
 $is_recipe = array(array('id'=>'0','value'=>'No'),array('id'=>'-1','value'=>'Yes'));
//////end//
$form_array = array
(
	array("database_name" => "products_brand_name" , "title" => "Title (English)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['products_brand_name'] , ) ,
	array("database_name" => "products_brand_name_ar" , "title" => "Title (Arabic)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['products_brand_name_ar'] , ) ,
	array("database_name" => $pictures_columns[3] , "title" => "Logo (150x150)" , "type" => "image" , "required" => "0" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[3]]) ,
	array("database_name" => $pictures_columns[2] , "title" => "Top Banner(715x255) " , "type" => "image" , "required" => "0" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[2]]) ,
	//array("database_name" => $pictures_columns[0] , "title" => "Image (English)" , "type" => "image" , "required" => "0" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[0]]) ,
	//array("database_name" => $pictures_columns[1] , "title" => "Image (Arabic)" , "type" => "image" , "required" => "0" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[1]]) ,

	array("database_name" => "products_brand_desc" , "title" => "Description (English)" , "type" => "editor" , "required" => "0" ,"current_value"=> $display['products_brand_desc'] , ) ,
	array("database_name" => "products_brand_desc_ar" , "title" => "Description (Arabic)" , "type" => "editor" , "required" => "0" ,"current_value"=> $display['products_brand_desc_ar'] , ) ,
	array("database_name" => "products_brand_facebook_url" , "title" => "Facebook Page" , "type" => "text" , "required" => "0" ,"current_value"=> $display['products_brand_facebook_url'] , ) ,

	array("database_name" => "products_brand_font_color" , "title" => "Font Color" , "type" => "text" , "required" => "0" ,"current_value"=> $display['products_brand_font_color'] , ) ,
	array("database_name" => "products_brand_BGColor" , "title" => "Background Color" , "type" => "text" , "required" => "0" ,"current_value"=> $display['products_brand_BGColor'] , ) ,
    array("database_name" => "products_brand_active" , "title" => "Active" , "type" => "select" ,"attached_options" => $display_active, "required" => "0" ,"current_value"=> $display['products_brand_active'] ) ,
	array("database_name" => "products_brand_is_recipe" , "title" => "Used In A Recipe" , "type" => "select" ,"attached_options" => $is_recipe, "required" => "0" ,"current_value"=> $display['products_brand_is_recipe'] ) ,
	
	array("database_name" => "id"  , "type" => "hidden" ,"value"=> $id),

	array("database_name" => "products_brand_order"  , "type" => "hidden" ,"value"=> $new_brand_order)
	
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

$list_per_page = 10;

/*
//Where Conditions 
if($_GET['search_query'] != "")
{
	$search_query = $_GET['search_query'];
	$search_query_string = "";
}*/

// Join


//Where Conditions
$search_query_string = $generator->generate_search_query($search_headers_attr,$search_query);
	
//Filters 

//Order by
$sort_by_query = "order by ".$order." ".$direction ;


//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name where 1 {$search_query_string} ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array("$view_access_token", $current_array_of_actions))

echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where 1 {$search_query_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"products_brand_name","title" => "Title (English)" , "url_sort" => $this_page_name_with_varibles , "order" => "products_brand_name", "type"=> "text" ,  ),
		array("ID"=>"products_brand_name_ar","title" => "Title (Arabic)" , "url_sort" => $this_page_name_with_varibles , "order" => "products_brand_name_ar", "type"=> "text" ,  ),	
		array("ID"=>"products_brand_logo","title" => "Logo" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "image" , "image_dir"=> $current_upload_directory ,"image_version" => "src" ),		
		array("ID"=>"products_brand_banner","title" => "Banner" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "image" , "image_dir"=> $current_upload_directory ,"image_version" => "src" ),		
		//array("ID"=>"products_brand_top_Image","title" => "Image (English)" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "image" , "image_dir"=> $current_upload_directory ,"image_version" => "thumb" ),		
		//array("ID"=>"products_brand_top_Image_ar","title" => "Image (Arabic)" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "image" , "image_dir"=> $current_upload_directory ,"image_version" => "thumb" ),		

	);

	$additional_options = array(

	array("title" => "View Products" , "url" => "products.php?", "pass_varible" => "forignkey"),
	array("title" => "Promotions" , "url" => "brand_promotions.php?", "pass_varible" => "forignkey"),
	array("title" => "Order Products" , "url" => "products_order.php?", "pass_varible" => "forignkey")
		
	);

	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array($add_access_token, $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array($edit_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array($delete_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ),
				"extra" =>$additional_options
				 
	 );
	 
	$data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		$data[$i]['ID'] = $display[$i]['products_brand_ID'];
		$data[$i]['products_brand_name'] = $display[$i]['products_brand_name'];
		$data[$i]['products_brand_name_ar'] = $display[$i]['products_brand_name_ar'];
		//$data[$i]['products_brand_top_Image'] = $display[$i]['products_brand_top_Image'];	
		//$data[$i]['products_brand_top_Image_ar'] = $display[$i]['products_brand_top_Image_ar'];	
		$data[$i]['products_brand_banner'] = $display[$i]['products_brand_banner'];		
		$data[$i]['products_brand_logo'] = $display[$i]['products_brand_logo'];		
	 
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