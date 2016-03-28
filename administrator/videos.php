<?php
$page_title = "Videos";
$single_term = "video";
$plural_term = "videos";

$filter = $_GET['filter'];
$id = (int)$_GET['id'];
$section_filter = (int) $_GET['section'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "videos";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

//$search_headers_attr = "videos_name"; //Seperate with semicolumns;
//$search_select_attr = "videos_ID;videos_name";

$search_query = $_GET['search_query'];
$search_headers_attr = "videos_ID;videos_name";

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
<?php include("header.php");

//Add New Item Link
$add_extra_add_item_when_edit_form = false;
if($add_item_flag && in_array("$add_access_token", $current_array_of_actions))
{
	$add_extra_add_item_when_edit_form = true;	
}

$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$crop_settings,$this_page_name_with_varibles,$add_extra_add_item_when_edit_form);

//IF a Form is submitted
if($_POST['submit'] == "Add" ||  $_POST['submit'] == "Edit" )
{
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);

	
	if($_POST['submit'] == "Add" )
	{
		//First Unset ID before ADD
		
		$section = $_POST['videos_section_id'];
		if($section == 10)
		{
			unset($tobesaved['videos_foreign_id']);
			unset($tobesaved['videos_recipes_id']);
			unset($tobesaved['videos_recipes_ajax_id']);
		}
		elseif($section == 2)
		{
			unset($tobesaved['videos_recipes_id']);
			$tobesaved['videos_foreign_id'] = $_POST['videos_recipes_ajax_id'];
			unset($tobesaved['videos_recipes_ajax_id']);
		}
		else
		{
			unset($tobesaved['videos_recipes_id']);
			unset($tobesaved['videos_recipes_ajax_id']);
		}
		
		//check if videos_featured=1  
		if($tobesaved['videos_featured'] == 1)
		{
			$db->query("update {$this_table_name} set {$this_table_name}_featured = '0' where {$this_table_name}_section_id = $section");
		}
		
		$state = $db -> insert($this_table_name, $tobesaved);
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=added&filter=edit&id={$state}' </script>");
		}
		
	}
	if($_POST['submit'] == "Edit" )
	{
		$section = $_POST['videos_section_id'];
		if($section == 10)
		{
			unset($tobesaved['videos_foreign_id']);
			unset($tobesaved['videos_recipes_id']);
			unset($tobesaved['videos_recipes_ajax_id']);
		}
		elseif($section == 2)
		{
			unset($tobesaved['videos_recipes_id']);
			$tobesaved['videos_foreign_id'] = $_POST['videos_recipes_ajax_id'];
			unset($tobesaved['videos_recipes_ajax_id']);
		}
		else
		{
			unset($tobesaved['videos_recipes_id']);
			unset($tobesaved['videos_recipes_ajax_id']);
		}
		//check if videos_featured=1  
		if($tobesaved['videos_featured'] == 1)
		{
			$db->query("update {$this_table_name} set {$this_table_name}_featured = '0' where {$this_table_name}_section_id = $section");
		}
		$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
		}
	}
}

if($filter == "edit" )
{
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 
$display_recipe = $db->querySelectSingle('select * from recipes where recipes_ID='.$display['videos_foreign_id']);
}

$display_section = array(array("id" => 0, "value" => 'Please Select Section') , array("id"=>2 , "value"=>"Best Cook") , array("id" => 10 , "value" => "Best Me") , array("id" => 30 , "value" => "Nestle Product") ) ;
$display_product = $db->querySelect('select products_brand_ID as "id" , products_brand_name as "value" from products_brand ');
$display_recipes = $db->querySelect('select recipes_ID as "id" , recipes_title_ar  as "value" from recipes ');
// CONCAT(recipes_title_ar , " - ", recipes_title)
$display_boolean = array(array("id" => 0, "value" => 'No') , array("id" => 1 , "value" => "Yes") ) ;


$form_array = array
(
	array("database_name" => "videos_section_id" , "title" => "Section" , "type" => "select" , "required" => "1" ,"attached_options" => $display_section ,"current_value"=> $display['videos_section_id'] ) ,
	array("database_name" => "videos_foreign_id" , "title" => "Product Brand " , "type" => "select" , "required" => "1" ,"attached_options" => $display_product ,"current_value"=> $display['videos_foreign_id'] ) ,
//	array("database_name" => "videos_recipes_id" , "title" => "Recipes Name " , "type" => "select" , "required" => "0" ,"attached_options" => $display_recipes ,"current_value"=> $display['videos_foreign_id'] ) ,
	array("database_name" => "videos_recipes_id" , "title" => "Recipes Name " , "type" => "text" , "required" => "0" ,"current_value"=> $display_recipe['recipes_title_ar'] ) ,
	array("database_name" => "videos_name" , "title" => "Title" , "type" => "text" , "required" => "1" ,"current_value"=> $display['videos_name'] ) ,
	array("database_name" => "videos_url" , "title" => "Link" , "type" => "text" ,"message" => "Only standard link like http://www.youtube.com/watch?v=DElrTdIwde4", "required" => "0", "current_value"=>$display['videos_url']) ,	
	array("database_name" => "videos_approved" , "title" => "Approved" , "type" => "select" , "required" => "0" , "current_value"=>$display['videos_approved'] , "attached_options" => $display_boolean ),	
	array("database_name" => "videos_featured" , "title" => "Featured" , "type" => "select" , "required" => "0" , "current_value"=>$display['videos_featured'] , "attached_options" => $display_boolean ),	
	array("database_name" => "videos_recipes_ajax_id"  , "type" => "hidden" ,"value"=>"" ),
	array("database_name" => "id"  , "type" => "hidden" ,"value"=> $id  )
	
);

?>
<style>
.ui-autocomplete { max-height:300px; width:400px !important;overflow:auto; }/*overflow:auto;*/
.ui-autocomplete-loading 
{
    background: white url("images/indicator.gif") left center no-repeat;
	background-position: right !important;
}
</style>
<script type="text/javascript">
$(document).ready(function(e) {
	
	$('#videos_recipes_id').change(function(e) 
	{
		$('#videos_recipes_ajax_id').val("");
    });
    
	var choose_id = $('#videos_section_id').val();
	if(choose_id == "30")
	{
		
		$('#fieldset_videos_foreign_id').show();
		$('#fieldset_videos_name').show();
		$('#fieldset_videos_url').show();
		$('#fieldset_videos_approved').show();
		$('#fieldset_videos_featured').show();
		$('#fieldset_videos_recipes_id').hide();
	}
	else if(choose_id == "2")
	{
		$('#fieldset_videos_recipes_id').show();
		$('#fieldset_videos_name').show();
		$('#fieldset_videos_url').show();
		$('#fieldset_videos_approved').show();
		$('#fieldset_videos_featured').show();
		$('#fieldset_videos_foreign_id').hide();
	}
	else if(choose_id == "0")
	{
		$('#fieldset_videos_name').hide();
		$('#fieldset_videos_url').hide();
		$('#fieldset_videos_approved').hide();
		$('#fieldset_videos_featured').hide();
		$('#fieldset_videos_foreign_id').hide();
		$('#fieldset_videos_recipes_id').hide();
	} else {
		$('#fieldset_videos_name').show();
		$('#fieldset_videos_url').show();
		$('#fieldset_videos_approved').show();
		$('#fieldset_videos_featured').show();
	}
	
	$('#videos_section_id').change(function(e) {
		var choose_id = $(this).val();
        if(choose_id == "30")
		{
			$('#fieldset_videos_foreign_id').show();
			$('#fieldset_videos_name').show();
			$('#fieldset_videos_url').show();
			$('#fieldset_videos_approved').show();
			$('#fieldset_videos_featured').show();
			$('#fieldset_videos_recipes_id').hide();
		}
		else if(choose_id == "2")
		{
			$('#fieldset_videos_recipes_id').show();
			$('#fieldset_videos_name').show();
			$('#fieldset_videos_url').show();
			$('#fieldset_videos_approved').show();
			$('#fieldset_videos_featured').show();
			$('#fieldset_videos_foreign_id').hide();
		}
		else if(choose_id == "0")
		{
			$('#fieldset_videos_name').hide();
			$('#fieldset_videos_url').hide();
			$('#fieldset_videos_approved').hide();
			$('#fieldset_videos_featured').hide();
			$('#fieldset_videos_foreign_id').hide();
			$('#fieldset_videos_recipes_id').hide();
		} else {
			$('#fieldset_videos_name').show();
			$('#fieldset_videos_url').show();
			$('#fieldset_videos_approved').show();
			$('#fieldset_videos_featured').show();
			$('#fieldset_videos_foreign_id').hide();
			$('#fieldset_videos_recipes_id').hide();
		}
    });
	
});

</script>
<script type="text/javascript">
$(document).ready(function(e) {
    $( "#videos_recipes_id" ).autocomplete({
		  minLength: 2,
		  source: function( request, response ) {
			 /* var term = request.term;
			if ( term in cache ) {
			  response( cache[ term ] );
			  return;
			}*/ // mofified 29-7-2013 - by bermawy
	 
			$.getJSON("https://stag.mynestle.com.eg/administrator/ajax/search_recipes.php", request, function( data, status, xhr ) {
			 //cache[ term ] = data; // mofified 29-7-2013 - by bermawy
	
			   response( $.map( data.geonames, function( item ) {
				   $('#videos_recipes_id').removeClass('ui-autocomplete-loading ');
				  return {
				   id : item.value,
				   label: item.name ,
				   value: item.name
				  }
				}));
			});
			 
		  },select: function( event, ui ) {
		   /*var id = ui.item.id;$('input[name=search_h]').val(id);*/
		   var id = ui.item.id;
		   
		   $('#videos_recipes_ajax_id').val(id);
		   $('#videos_recipes_id').removeClass('ui-autocomplete-loading ');
		  /* ui.item.value = ui.item.label;*/
		  // location.href = path + 'programs' + '.php?id=' + id;
	
		  },
		});
		
});
</script>

<script type="text/javascript">
$(document).ready(function(e) {
	 
 /*   $('.approve_toggle').click(function(e) {*/
		$("body").on("click", ".approve_featured", function(e){
		//get id
		var id = $(this).data("id");
		//var column_required_to_toggle = "entry_approved";
		var this_table_name = "<?php echo $this_table_name; ?>";

		var column_required_to_toggle = $(this).attr('additional_attr');

		$.ajax({
			  url: "ajax/videos_featured_toogle.php",
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

<script type="text/javascript">
$(document).ready(function(e) {
	 
 /*   $('.approve_toggle').click(function(e) {*/
		$("body").on("click", ".approve_active", function(e){
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
<p id="filter" data-type="<?php echo $filter?>"></p>
 
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

//Filters 
if($section_filter)
$section_string = " and videos_section_id = ".$section_filter;

//Order by
$sort_by_query = "order by ".$order." ".$direction ;


//Pagination Handle
//echo "select * from $this_table_name where videos_member_flag = 0  {$search_query_string} {$section_string} {$sort_by_query} {$paging_query}";
//exit;
$total_numbers_of_rows = $db->numRows("select * from $this_table_name where videos_member_flag = 0 {$search_query_string} {$section_string}");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array("$view_access_token", $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where videos_member_flag = 0  {$search_query_string} {$section_string} {$sort_by_query} {$paging_query} ");


//Table Header
	$table_header = array
	(
		array("ID"=>"videos_name", "title" => "Title" , "url_sort" => $this_page_name_with_varibles , "order" => "videos_name" ,"type"=> "text"),
		array("ID"=>"videos_section_id", "title" => "Section" , "url_sort" => $this_page_name_with_varibles , "order" => "videos_section_id" ,"type"=> "select" , "attached_options" => $display_section ),
		array("ID"=>"videos_url","title" => "URL" , "url_sort" => $this_page_name_with_varibles , "order" => "videos_url", "type"=> "text")	 ,
		array("ID"=>"videos_approved" , "title" => "Approved" , "url_sort" => $this_page_name_with_varibles , "order" => "videos_approved" , "type"=> "select" , "attached_options" => $display_boolean )	,	
		array("ID"=>"videos_featured" , "title" => "Featured" , "url_sort" => $this_page_name_with_varibles , "order" => "videos_featured" , "type"=> "select" , "attached_options" => $display_boolean )	,	


	);
	
	$section = array(array("id"=>2 , "value"=>"Best Cook") , array("id" => 10 , "value" => "Best Me") , array("id" => 30 , "value" => "Nestle Product") ) ;

	$filter_options= array(
		array("ID"=>"section","title" => "Sections" ,"type" => "select" , "attached_options" =>$section),
		);	
		
		
 	$additional_options = array(
		array("title" => "Toggle Active" , "url" => "{$this_page_name_with_varibles}", "additional_attr" => "videos_approved" , "pass_varible" => "" , "class_name"=>"approve_active" ,"icon" => "icon-3"),
		array("title" => "Toggle Featured" , "url" => "{$this_page_name_with_varibles}", "additional_attr" => "videos_featured" , "pass_varible" => "" , "class_name"=>"approve_featured" ,"icon" => "icon-3"),
	);
	
	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array("$add_access_token", $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array("$edit_access_token", $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array("$delete_access_token", $current_array_of_actions) , "url" =>$this_page_name_with_varibles ),
				"extra" => $additional_options
	 );
	 
	 $data = array();
	for($i=0;$i<sizeof($display);$i++)
	{

		$url = $display[$i]['videos_url'];
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		$image = $my_array_of_vars['v'];   
		   
		$data[$i]['ID'] = $display[$i]['videos_ID'];
		$data[$i]['videos_name'] = $display[$i]['videos_name'];
		$data[$i]['videos_section_id'] = $display[$i]['videos_section_id'];
		$data[$i]['videos_url'] = '<a target="_blank" href="'.$display[$i]['videos_url'].'"><img height="100" src="http://img.youtube.com/vi/'.$image.'/0.jpg" alt="" /></a>';
		$data[$i]['videos_approved'] = $display[$i]['videos_approved'] ;
		$data[$i]['videos_featured'] = $display[$i]['videos_featured'] ;
	}
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
	
?>
		

<?php
endif;
?>	 
<?php

?>
</section>