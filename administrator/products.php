<?php
$page_title = "Products";
$single_term = "products";
$plural_term = "products";
$parent_page_title = "Products brand";
$parent_page_name = "products_brand.php";

$filter = $_GET['filter'];
$id = (int)$_GET['id'];
$forignkey = (int) $_GET['forignkey']; // forignkey of brand table
$forignkey_colm = 'products_products_brand_id'; // column of forignkey

if($forignkey == "" )
$forignkey = $_POST[$forignkey_colm];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "products";
$this_page_name_with_varibles = "{$this_page_name}?forignkey=".$forignkey;
$state = $_GET['state'];

//handle Filters
$product_brand_filter = (int) $_GET['product_brand_id'];

//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "products_ID;products_name_ar;products_name;products_products_brand_id"; //Seperate with semicolumns;

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

//$location =  'http://' . $_SERVER['HTTP_HOST'] . '/~devarea/nestle/uploads/products/';

//Add New Item Link
$add_extra_add_item_when_edit_form = false;
if($add_item_flag && in_array("$add_access_token", $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
}

?>

<?php

$current_upload_directory = $images_dir['products'];
//INitilize Fields with input File  , IMPORTANT for tobesaved generator

//Pictures Columns inilitize
$pictures_columns = array();
$pictures_columns[0] = "products_Image";
$pictures_columns[1] = "products_nutrition_image";
$pictures_columns[2] = "products_nutrition_image_ar";


$files_array_search = array ($pictures_columns[0],$pictures_columns[1],$pictures_columns[2]); 
$files_array = array 
(
	$pictures_columns[0] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),
	$pictures_columns[1] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),
	$pictures_columns[2] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),

);

//Apply Image Crop
$crop_settings = array();
$current_cropsettings_index = 0 ;

$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "1";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 115;


$current_cropsettings_index = 1 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "1";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 115;

$current_cropsettings_index = 2 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "1";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 115;

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

if($filter == "edit" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 

$display_brand = $db->querySelect('select products_brand_ID as "id" , products_brand_name as "value" from products_brand order by products_brand_name');
$display_active = array(array('id'=>'1','value'=>'Yes'),array('id'=>'0','value'=>'No'));



$form_array = array
(

	array("database_name" => "products_products_brand_id" , "title" => "Product brand" , "type" => "select" , "required" => "1" ,"current_value"=> $display['products_products_brand_id'] ,"attached_options" => $display_brand ) ,

	array("database_name" => "products_name" , "title" => "Title (English)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['products_name'] , ) ,
	array("database_name" => "products_name_ar" , "title" => "Title (Arabic)" , "type" => "text" , "required" => "0" ,"current_value"=> $display['products_name_ar'] , ) ,
	array("database_name" => $pictures_columns[0] , "title" => "Image" , "type" => "image" , "required" => "0" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[0]]) ,
	array("database_name" => $pictures_columns[1] , "title" => "Nutrition Image (English)" , "type" => "image" , "required" => "0" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[1]]) ,
	array("database_name" => $pictures_columns[2] , "title" => "Nutrition Image (Arabic)" , "type" => "image" , "required" => "0" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[2]]) ,
	
	array("database_name" => "products_available_sizes" , "title" => "Available Sizes (English)" , "type" => "textarea" , "required" => "0" ,"current_value"=> $display['products_available_sizes'] , ) ,
	array("database_name" => "products_available_sizes_ar" , "title" => "الأحجام (Arabic)" , "type" => "textarea" , "required" => "0" ,"current_value"=> $display['products_available_sizes_ar'] , ) ,

	
	array("database_name" => "products_brief_text" , "title" => "About Product (English)" , "type" => "editor" , "required" => "0" ,"current_value"=> $display['products_brief_text'] , ) ,
	array("database_name" => "products_brief_text_ar" , "title" => "عن المنتج (Arabic)" , "type" => "editor" , "required" => "0" ,"current_value"=> $display['products_brief_text_ar'] , ) ,

	array("database_name" => "products_text" , "title" => "How to Prepare (English) " , "type" => "editor" , "required" => "0" ,"current_value"=> $display['products_text'] , ) ,
	array("database_name" => "products_text_ar" , "title" => "طريقة التحضير (Arabic)" , "type" => "editor" , "required" => "0" ,"current_value"=> $display['products_text_ar'] , ) ,

    array("database_name" => "products_active" , "title" => "Active" , "type" => "select" ,"attached_options" => $display_active, "required" => "0" ,"current_value"=> $display['products_active'] ) ,
	array("database_name" => "products_keywords" , "title" => "Keywords" , "type" => "text" , "required" => "1" ,"current_value"=> $display['products_keywords'] , ) ,
	array("database_name" => "id"  , "type" => "hidden" ,"value"=> $id  ),
	array("database_name" => $forignkey_colm , "type" => "hidden" ,"value"=> $forignkey  ),
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
if ( $product_brand_filter != "" )
$product_brand_string = " and products_products_brand_id=".$product_brand_filter;

//Order by
$sort_by_query = "order by ".$order." ".$direction ;


//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name where 1 and {$forignkey_colm} = {$forignkey} {$search_query_string}");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array("$view_access_token", $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where 1 and {$forignkey_colm} = {$forignkey} {$search_query_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"products_products_brand_id","title" => "Brand" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "select" ,'attached_options' =>$display_brand  ),
		array("ID"=>"products_name","title" => "Title (English)" , "url_sort" => $this_page_name_with_varibles , "order" => "products_name", "type"=> "text" ,  ),
		array("ID"=>"products_name_ar","title" => "Title (Arabic)" , "url_sort" => $this_page_name_with_varibles , "order" => "products_name_ar", "type"=> "text" ,  ),	
		array("ID"=>"products_Image","title" => "Image" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "image" , "image_dir"=> $current_upload_directory ,"image_version" => "src" ),		

	);
		
	$additional_options = array(
		array("title" => "View Flavours" , "url" => "products_flavour.php?", "pass_varible" => "forignkey")
	);

	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array("$add_access_token", $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array("$edit_access_token", $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array("$delete_access_token", $current_array_of_actions) , "url" =>$this_page_name_with_varibles ),
				"extra" =>$additional_options
	 );
	 
	//Filters Options
	$filter_options= array
	(
		array("ID"=>"product_brand_id","title" => " Products Brand " ,"type" => "select"  , "attached_options" =>$display_brand)
	);
	 
	$data = array();
	for($i=0;$i<sizeof($display);$i++)
	{		
		//$display_brand = $db->querySelectSingle("select * from products_brand where products_brand_ID = " .$display[$i]['products_products_brand_id']);

		$data[$i]['ID'] = $display[$i]['products_ID'];
		$data[$i]['products_products_brand_id'] = $display[$i]['products_products_brand_id'];
		$data[$i]['products_name'] = $display[$i]['products_name'];
		$data[$i]['products_name_ar'] = $display[$i]['products_name_ar'];
		$data[$i]['products_Image'] = $display[$i]['products_Image'];	
	 
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