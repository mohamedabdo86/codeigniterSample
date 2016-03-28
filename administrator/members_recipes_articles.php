<?php
$page_title = "Favourit Recipes And Articles";
$single_term = "Favourit Recipes And Articles";
$plural_term = "Favourit Recipes And Articles";

$filter = $_GET['filter'];
$id = (int)$_GET['id'];
$forignkey = (int) $_GET['forignkey'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "members_favorites";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "members_favorites_ID;members_favorites_members_id;members_favorites_type"; //Seperate with semicolumns;

$order = $_GET['order']!="" ? $_GET['order'] : $this_table_name."_ID";
$direction = $_GET['dir']=="" || $_GET['dir']==0  ? "desc" : "asc";
$page = (int)$_GET['page']!="" 	? (int)$_GET['page'] : 1;

//Handle Access Attr.
$add_item_flag = false;
$edit_item_flag = false;
$delete_item_flag = true;
$view_access_token = "can_view";
//$add_access_token = "can_add";
//$edit_access_token = "can_edit";
$delete_access_token = "can_delete";

include("header.php");

?> 


<?php
//Add New Item Link
$add_extra_add_item_when_edit_form = false;
if($add_item_flag && in_array($add_access_token, $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
}

?>

<?php

/*$current_upload_directory = $images_dir['ads'];
//INitilize Fields with input File  , IMPORTANT for tobesaved generator

//Pictures Columns inilitize
$pictures_columns = array();
$pictures_columns[0] = "ads_thumb";


$files_array_search = array ($pictures_columns[0]); 
$files_array = array 
(
	$pictures_columns[0] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" )
);

//Apply Image Crop
$crop_settings = array();
$current_cropsettings_index = 0 ;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['aspect_ratio'] = "1";
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_preview_height'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_width'] = 115;
$crop_settings[$pictures_columns[$current_cropsettings_index]]['thumbnail_final_height'] = 115;*/

$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);

//IF a Form is submitted

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
$total_numbers_of_rows = $db->numRows("select * from $this_table_name where members_favorites_members_id = $forignkey {$search_query_string}  ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where members_favorites_members_id = $forignkey {$search_query_string} {$sort_by_query} {$paging_query} ");

//Table Header
	$table_header = array
	(
		array("ID"=>"members_favorites_foreign_id","title" => "Favourit Name" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "text" ),
		array("ID"=>"members_favorites_type","title" => "Favourit Type" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "text" ),
		array("ID"=>"members_favorites_section_id","title" => "Favourit Top Section Type" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "text" ),
		array("ID"=>"members_favorites_added_date","title" => "Favourit Added Date" , "url_sort" => $this_page_name_with_varibles , "order" => "", "type"=> "text" ),
	
	);
	
	
	
	//Don't Input Filter at URL ! 
	$options = array (
				//"add" => array ( "placeicon"=> $add_item_flag  && in_array($add_access_token, $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array($edit_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array($delete_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				
				 
	 );
	 
	 
	 $data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		$data[$i]['ID'] = $display[$i]['members_favorites_ID'];
		
		//check if $display[1]['members_favorites_foreign_id'] is article or recipes
		if($display[$i]['members_favorites_type'] == 'articles')
		{
			$article_id = $display[$i]['members_favorites_foreign_id'];
			$article_name = $db->querySelectSingle("select * from articles where articles_ID = $article_id");
			$data[$i]['members_favorites_foreign_id'] = $article_name['articles_title'];
		}else
		{
			$recipes_id = $display[$i]['members_favorites_foreign_id'];
			$recipes_name = $db->querySelectSingle("select * from recipes where recipes_ID = $recipes_id");
			$data[$i]['members_favorites_foreign_id'] = $recipes_name['recipes_title'];
		}
		
		$data[$i]['members_favorites_type'] = $display[$i]['members_favorites_type'];
		
		$section_id = $display[$i]['members_favorites_section_id'];
		$section_name = $db->querySelectSingle("select * from sections where sections_ID = $section_id");
		$data[$i]['members_favorites_section_id'] = $section_name['sections_name'];
		
		$data[$i]['members_favorites_added_date'] = $display[$i]['members_favorites_added_date'];
		
	}
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>


