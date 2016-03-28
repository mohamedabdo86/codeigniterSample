<?php
// Page title
$page_title = "Promotions"; // <--

// Signle item title
$single_term = "record";// <--

// Multi items title
$plural_term = "records";// <--


$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "products_promotions"; // <--
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];


//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "products_promotions_ID"; //Seperate with semicolumns;  // <--


$order = $_GET['order']!="" ? $_GET['order'] : $this_table_name."_ID";
$direction = $_GET['dir']=="" || $_GET['dir']==0  ? "desc" : "asc";
$page = (int)$_GET['page']!="" 	? (int)$_GET['page'] : 1;

//Handle Access Attr.
$add_item_flag = true; // <--
$edit_item_flag = true; // <--
$delete_item_flag = true; // <--
$view_access_token = "can_view"; 
$add_access_token = "can_add";  
$edit_access_token = "can_edit";
$delete_access_token = "can_delete";

 include("header.php");?> 


<?php
//Add New Item Link
$add_extra_add_item_when_edit_form = false;
if($add_item_flag && in_array($add_access_token, $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
}

?>

<?php

$current_upload_directory = $images_dir['promotions']; //<--
//INitilize Fields with input File  , IMPORTANT for tobesaved generator

//Pictures Columns inilitize
$pictures_columns = array();
$pictures_columns[0] = "products_promotions_promotion_image"; 
$pictures_columns[1] = "products_promotions_banner"; 


$files_array_search = array ($pictures_columns[0],$pictures_columns[1]); 
$files_array = array 
(
	$pictures_columns[0] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" ),
	$pictures_columns[1] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" )
);


//Apply Image Crop
$crop_settings = array();
$current_cropsettings_index = 0 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "1"; 
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 115;

//Apply Image Crop1
$crop_settings_1 = array();
$current_cropsettings_index = 1 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "4:3";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 200;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 150;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 280;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 210;

$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);



//echo $generator->generate_javascript_imagecrop($crop_settings);


//IF a Form is submitted
if($_POST['submit'] == "Add" ||  $_POST['submit'] == "Edit" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);

	
	if($_POST['submit'] == "Add" ) {
		$url = $_POST['products_promotions_flag'];
		if($url == 1) {
			
			unset($tobesaved['products_promotions_url']);
		
		} elseif($url == 2) {
		
			unset($tobesaved['products_promotions_product_id']);
			unset($tobesaved['products_promotions_banner']);
		
		}
		$state = $db -> insert($this_table_name, $tobesaved);
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=added&filter=edit&id={$state}' </script>");
		}
		
	}
	if($_POST['submit'] == "Edit" ) {
		$url = $_POST['products_promotions_flag'];
		if($url == 1) {
			
			unset($tobesaved['products_promotions_url']);
		
		} elseif($url == 2) {
		
			unset($tobesaved['products_promotions_product_id']);
			unset($tobesaved['products_promotions_banner']);
		
		}
		$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
		}
		
	}
	
	
}


$display_url = array(array("id" => 0, "value" => 'Please Select Product Or URL') , array("id" => 1, "value" => "Product") , array("id" => 2, "value" => "External URL")) ;

if($filter == "edit" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 
$display_boolean = array(array("id" => 0, "value" => 'No') , array("id" => 1 , "value" => "Yes") ) ;
$display_product = $db->querySelect('select products_brand_ID as "id" , products_brand_name as "value" from products_brand ');

$form_array = array // <--
(

	array("database_name" => "products_promotions_flag" , "title" => "Please Select Product Or URL" , "type" => "select" , "required" => "1" , "current_value"=>$display['products_promotions_flag'] , "attached_options" => $display_url ),
	array("database_name" => "products_promotions_url" , "title" => "URL", "message" => "EX. best_cook/ask_an_expert", "type" => "text" , "required" => "0" , "current_value"=>$display['products_promotions_url']),
	array("database_name" => "products_promotions_product_id" , "title" => "Product" , "type" => "select" , "required" => "1" ,"current_value"=> $display['products_promotions_product_id'] ,"attached_options" => $display_product  ) ,
	array("database_name" => $pictures_columns[0] , "title" => "Image (width 300px)" , "type" => "image" , "required" => "0" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[0]]) ,
	array("database_name" => $pictures_columns[1] , "title" => "Banner(width 700px & height 150)" , "type" => "image" , "required" => "0" , "message" => "Only png,jpg,gif Images"  ,"current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[1]]) ,
  	array("database_name" => "products_promotions_active" , "title" => "Active" , "type" => "select" , "required" => "0" , "current_value"=>$display['products_promotions_active'] , "attached_options" => $display_boolean ),	

	array("database_name" => "id"  , "type" => "hidden" ,"value"=> $id  )
	
);


?>

<script type="text/javascript">
$(document).ready(function(e) {
	
	var choose_id = $('#products_promotions_flag').val();
	if(choose_id == 1)
	{
		$('#fieldset_products_promotions_url').hide();
		$('#fieldset_products_promotions_product_id').show();
		$('#fieldset_products_promotions_banner').show();
		$('#fieldset_products_promotions_active').show();
		$('#fieldset_products_promotions_promotion_image').show();
	}
	else if(choose_id == 2)
	{
		$('#fieldset_products_promotions_url').show();
		$('#fieldset_products_promotions_active').show();
		$('#fieldset_products_promotions_promotion_image').show();
		$('#fieldset_products_promotions_product_id').hide();
		$('#fieldset_products_promotions_banner').hide();
	} else if(choose_id == 0) {
		$('#fieldset_products_promotions_url').hide();
		$('#fieldset_products_promotions_product_id').hide();
		$('#fieldset_products_promotions_banner').hide();
		$('#fieldset_products_promotions_promotion_image').hide();
		$('#fieldset_products_promotions_active').hide();
	}
	$('#products_promotions_flag').change(function(e) {
		var choose_id = $(this).val();
        if(choose_id == 1)
		{
			$('#fieldset_products_promotions_url').hide();
			$('#fieldset_products_promotions_product_id').show();
			$('#fieldset_products_promotions_banner').show();
			$('#fieldset_products_promotions_promotion_image').show();
			$('#fieldset_products_promotions_active').show();
		}
		else if(choose_id == 2)
		{
			$('#fieldset_products_promotions_url').show();
			$('#fieldset_products_promotions_active').show();
			$('#fieldset_products_promotions_promotion_image').show();
			$('#fieldset_products_promotions_product_id').hide();
			$('#fieldset_products_promotions_banner').hide();
		} else if(choose_id == 0) {
			$('#fieldset_products_promotions_url').hide();
			$('#fieldset_products_promotions_product_id').hide();
			$('#fieldset_products_promotions_banner').hide();
			$('#fieldset_products_promotions_promotion_image').hide();
			$('#fieldset_products_promotions_active').hide();
		}
    });
	
});

</script>

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
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name where 1 {$search_query_string} ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where 1 {$search_query_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array // <--
	(
		array("ID"=>"products_promotions_product_id", "title" => "Product" , "url_sort" => $this_page_name_with_varibles , "order" => "products_promotions_product_id" ,"type"=> "select" ,"attached_options" => $display_product ),
		array("ID"=>"products_promotions_promotion_image","title" => "Image" , "url_sort" => $this_page_name_with_varibles , "order" => "services_image", "type"=> "image" , "image_dir"=> $current_upload_directory ,"image_version" => "thumb" ) ,
		array("ID"=>"products_promotions_banner","title" => "Banner" , "url_sort" => $this_page_name_with_varibles , "order" => "services_image", "type"=> "image" , "image_dir"=> $current_upload_directory ,"image_version" => "thumb" ) ,
		array("ID"=>"products_promotions_active" , "title" => "Active" , "url_sort" => $this_page_name_with_varibles , "order" => "products_promotions_active" , "type"=> "text")	,	
 			
	);
	

	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array($add_access_token, $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array($edit_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array($delete_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				//"extra" =>$additional_options
				 
	 );
	 
	 
	 $data = array();
	for($i=0;$i<sizeof($display);$i++) // <--
	{
		
		$data[$i]['ID'] = $display[$i]['products_promotions_ID'];
		$data[$i]['products_promotions_product_id'] = $display[$i]['products_promotions_product_id'];		
		$data[$i]['products_promotions_promotion_image'] = $display[$i]['products_promotions_promotion_image'];
		$data[$i]['products_promotions_banner'] = $display[$i]['products_promotions_banner'];		
		$data[$i]['products_promotions_active'] = $display[$i]['products_promotions_active'] == 0 ? "No" : "Yes";
	 
	}
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>


