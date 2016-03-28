<?php
$page_title = "Comments";
$single_term = "comment";
$plural_term = "comments";


$filter = $_GET['filter'];
$id = (int)$_GET['id'];

$section_filter = (int) $_GET['section'];
$approve_filter = $_GET['approve'];
$type_filter = $_GET['type'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = "comments.php";
$this_table_name = "comments";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "comments_ID;comments_foreign_id"; //Seperate with semicolumns;

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
if($add_item_flag && in_array($add_access_token, $current_array_of_actions))
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
		
		$tobesaved['comments_date']  = date("Y-m-d H:i:s");
		$state = $db -> insert($this_table_name, $tobesaved);
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=added&filter=edit&id={$state}' </script>");
		}
		
	}
	if($_POST['submit'] == "Edit" )
	{
		if($tobesaved['comments_approve_old'] != $tobesaved['comments_approve'])
		{
		$member_id = $_POST['comments_members_id'];
		$comment_type = $_POST['comments_type'];
		$foreign_id = $_POST['comments_foreign_id'];
		$query1 = "SELECT * FROM  `members` WHERE  `members_ID` ={$member_id}";
		$query2 = "SELECT * FROM  `{$comment_type}` JOIN images ON images_ID={$comment_type}_image WHERE `{$comment_type}_ID` ={$foreign_id}";
		$query3 = "SELECT * FROM  `members_recipes` JOIN members ON members_ID=members_recipes_members_id WHERE `members_recipes_ID` ={$foreign_id}";
		$member_recipe_data = $db->querySelectSingle($query3);
		$comment_data = $db->querySelectSingle($query2);
		$member_data = $db->querySelectSingle($query1);
		$member_salt = $member_data['members_salt'];
		$name = $member_data['members_first_name'].$member_data['members_last_name'];
		if(mb_detect_encoding($name) != "ASCII"){
			$name = "مرحبا ".ucwords($member_data['members_first_name'])." ".ucwords($member_data['members_last_name']);
		}else{
			$name = ucwords($member_data['members_first_name'])." ".ucwords($member_data['members_last_name'])." مرحبا ";
		}
		$member_email = $member_recipe_data['members_email'];
		$comment_message = $_POST['comments_message'];
		$language_db_prefix = "";
		$language = "en";
		if($member_data['members_lang'] == "arabic"){
			$language = "ar";
			$language_db_prefix = "_ar";
		}else{
			if(mb_detect_encoding($name) != "ASCII"){
				$name = " Hi ".ucwords($member_data['members_first_name']." ".ucwords($member_data['members_last_name']));
			}else{
				$name = ucwords($member_data['members_first_name'])." ".ucwords($member_data['members_last_name'])." Hi ";
			}
		}
		$email = $member_data['members_email'];
		$approve = $_POST['comments_approve'];
		$url = "";
		$image_url = "";
		$image = $comment_data['images_src'];
		$comment_data_title = $comment_data[''.$comment_type.'_title'.$language_db_prefix.''];
		include 'modules/mailer.php';
		if($comment_type == "products"){
			$image_url = "http://192.185.151.73/~devarea/nestle/uploads/products_brand/{$image}";
			$url = "products/reviews/";
		}elseif($comment_type == "articles"){
			$image_url = "https://www.mynestle.com.eg/images/Articles/{$image}";
			$url = "best_me/inner_articles";
		}elseif($comment_type == "recipes"){
			$image_url = "https://www.mynestle.com.eg/images/Recipes/{$image}";
			$url = "best_cook/delicious_recipes/";
		}elseif($comment_type == "members_recipes"){
			$comment_data_title = $comment_data['members_recipes_name'];
			$image_url = "https://www.mynestle.com.eg/images/Users_Recipes/{$image}";
			$url = "best_cook/your_recipes/";
			if($language == "ar"){
				include 'scripts/bestcook_show_comment.php';
			}else{
				include 'scripts/bestcook_show_comment_en.php';
			}
			
			if($approve == 1){
				$send_email = sendMail($member_email, "Choose Wellness", 'info@mynestle.com.eg', '', '', 'Your recipe got a comment', $msg_comment);
			}
		}
		if($language == "ar"){
			include 'scripts/add_points.php';
		}else{
			include 'scripts/add_points_en.php';
		}
		
		if($approve == 1){
		$status_email = sendMail($email, "Choose Wellness", 'info@mynestle.com.eg', '', '', 'Added points', $msg);
		}
			$points_handler = new Pointssystem();
			if($tobesaved['comments_approve'] == 1)
			{
				
				$points_handler->approve_action($tobesaved['comments_members_id'] , $points_handler->new_comment_points, "new_comment",$_POST['id']);

			 }
			else
			{
				$points_handler->disapprove_action($tobesaved['comments_members_id'] , $points_handler->new_comment_points);
			}
		}
		unset($tobesaved['comments_approve_old']);
		
		$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);
		//Check For trophies
		$trophies_handler = new Trophiessystem($tobesaved['comments_section_id'] , $tobesaved['comments_members_id']);
		$trophies_handler->check_requirments_of_member();
		if($state != false)
		{
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
		}
		
	}
	
	
}



if($filter == "edit" )
{
	$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 
	//$member = $db->querySelectSingle('select  CONCAT(members_first_name," ",members_last_name) as "name" from members where members_ID ='.$display['comments_members_id'] );
}
$display_section = $db->querySelect('select sections_ID as "id" , sections_name as "value" from sections where sections_ID != 1');
$display_member = $db->querySelect('select members_ID as "id" , CONCAT(members_first_name," ",members_last_name) as "value" from members ');
$display_approve = array(array("id"=>0,"value"=>"NO"),array("id"=>1, "value"=>"YES") );

if($display['comments_type'] == 'articles')
{
	$display_array = $db->querySelect('select articles_ID as "id" , articles_title_ar as "value" from articles');
}
elseif($display['comments_type'] == 'recipes')
{
	$display_array = $db->querySelect('select recipes_ID as "id" , recipes_title_ar as "value" from recipes');
}
elseif($display['comments_type'] == 'members_recipes')
{
	$display_array = $db->querySelect('select members_recipes_ID as "id" , members_recipes_name as "value" from members_recipes');
}
elseif($display['comments_type'] == 'products')
{
	$display_array = $db->querySelect('select products_brand_ID as "id" , products_brand_name as "value" from products_brand');
}



$form_array = array
(
	array("database_name" => "comments_section_id" , "title" => "Section" , "type" => "select" , "required" => "1" ,"attached_options" => $display_section ,"current_value"=> $display['comments_section_id'] ) ,
	array("database_name" => "comments_foreign_id" , "title" => "Title" , "type" => "select" , "required" => "0" ,"attached_options" => $display_array ,"current_value"=> $display['comments_foreign_id'] ) ,
	array("database_name" => "comments_type" , "title" => "Type" , "type" => "text" , "required" => "0" ,"current_value"=> $display['comments_type'] ) ,
	//array("database_name" => "comments_members_id" , "title" => "Member Name" , "type" => "text" ,"read_only" => "readonly", "required" => "0" ,"current_value"=> $display['comments_members_id'] ) ,
	array("database_name" => "comments_message" , "title" => "Message" , "type" => "editor" , "required" => "0" ,"current_value"=> $display['comments_message'] ) ,
  	array("database_name" => "comments_approve" , "title" => "Approve" , "type" => "select" , "required" => "1" ,"attached_options" => $display_approve ,"current_value"=> $display['comments_approve'] ) ,
	array("database_name" => "comments_approve_old"  , "type" => "hidden" ,"value"=>  $display['comments_approve']  ),
	array("database_name" => "comments_member_email" , "type" => "hidden"  ,"value"=> $display['comments_member_email'] ) ,
    array("database_name" => "comments_members_id"  , "type" => "hidden" ,"value"=> $display['comments_members_id']  ),
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


//Where Conditions
$search_query_string = $generator->generate_search_query($search_headers_attr,$search_query);


	
//Filters 

if($section_filter)
$section_string = " and comments_section_id = ".$section_filter." ";

if($approve_filter != NULL) 
$approve_string = " and comments_approve = ".$approve_filter." ";


if($type_filter)
$type_string = " and comments_type = '".$type_filter."' ";


//if ( $start_date_filter != "" )
//$start_date_filter_string = " and schedule_start_date='".$start_date_filter."'";

//Order by
$sort_by_query = "order by ".$order." ".$direction ;



//Bulk Action
$bulk_actions_handler = $_POST['bulk_action'];

if($bulk_actions_handler == "delete_all")
{
	$bulk_actions_items = $_POST['items_checkbox'];
	for($i=0;$i<sizeof($bulk_actions_items);$i++):
	$db->query("delete from {$this_table_name} where {$this_table_name}_ID = ".$bulk_actions_items[$i]);
	endfor;
	
	
	echo "<script type='text/javascript'>location.href='{$this_page_name_with_varibles}&state=deletedall_success'</script>";
	
}


//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name where 1 {$search_query_string} {$section_string} {$approve_string} {$type_string}");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where 1 {$search_query_string}  {$section_string} {$approve_string} {$type_string} {$sort_by_query} {$paging_query} ");

//Table Header
	$table_header = array
	(
		array("ID"=>"comments_foreign_id", "title" => "Title" , "url_sort" => $this_page_name_with_varibles , "order" => "comments_foreign_id" ,"type"=> "text" ),
		array("ID"=>"comments_type", "title" => "Type" , "url_sort" => $this_page_name_with_varibles , "order" => "comments_type" ,"type"=> "text" ),
		array("ID"=>"comments_members_id", "title" => "Member" , "url_sort" => $this_page_name_with_varibles , "order" => "comments_members_id" ,"type"=> "select" ,"attached_options" => $display_member),
		array("ID"=>"comments_message", "title" => "Message" , "url_sort" => $this_page_name_with_varibles , "order" => "comments_message" ,"type"=> "text"),
		array("ID"=>"comments_section_id", "title" => "Section" , "url_sort" => $this_page_name_with_varibles , "order" => "comments_section_id" ,"type"=> "select" ,"attached_options" => $display_section),	
 		array("ID"=>"comments_approve" , "title" => "Approve" , "url_sort" => $this_page_name_with_varibles , "order" => "comments_approve" ,"type"=> "select" ,"attached_options" => $display_approve)	,	

	);
	
	$additional_options = array(
		array("title" => "Approve" , "url" => "{$this_page_name_with_varibles}", "additional_attr" => "comments_approve" , "pass_varible" => "" , "class_name"=>"approve_toggle" ,"icon" => "icon-3"),

	);
	
	//Filters Options
$display_type = array(array('id'=>'recipes' , 'value'=>'Recipes'), array('id'=>'articles', 'value'=>'Articles'), array('id'=>'members_recipes', 'value'=>'Members Recipes'), array('id'=>'products', 'value'=>'Products'));

	$filter_options= array(
		array("ID"=>"section","title" => "Section" ,"type" => "select" , "attached_options" =>$display_section),
		array("ID"=>"approve","title" => "Approve" ,"type" => "select" , "attached_options" =>$display_approve),
		array("ID"=>"type","title" => "Type" ,"type" => "select" , "attached_options" =>$display_type),
		);
	
	//Bermawy 5/04/2014 this will not work with the point system
	/*$additional_options = array(
	array("title" => "Toggle Approve" , "url" => "{$this_page_name_with_varibles}", "additional_attr" => "comments_approve" , "pass_varible" => "" , "class_name"=>"approve_toggle" ,"icon" => "icon-3"),
	);*/
	

	//Don't Input Filter at URL ! 
	$options = array (
		"add" => array ( "placeicon"=> $add_item_flag  && in_array($add_access_token, $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
		"edit" => array ( "placeicon"=> $edit_item_flag && in_array($edit_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
		"delete" => array ( "placeicon"=>$delete_item_flag && in_array($delete_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ),
		"extra" => $additional_options
	 );
	 
	 $data = array();
	for($i=0;$i<sizeof($display);$i++)
	{
		
		$data[$i]['ID'] = $display[$i]['comments_ID'];
		
		if($display[$i]['comments_type'] == 'articles')
		{
			$display_title = $db->querySelectSingle('select * from articles where articles_ID ='.$display[$i]['comments_foreign_id']);
			$display_current_title = $display_title['articles_title_ar'];
		}
		elseif($display[$i]['comments_type'] == 'recipes')
		{
			$display_title = $db->querySelectSingle('select * from recipes where recipes_ID ='.$display[$i]['comments_foreign_id']);
			$display_current_title = $display_title['recipes_title_ar'];
		}
		elseif($display[$i]['comments_type'] == 'members_recipes')
		{
			$display_title = $db->querySelectSingle('select * from members_recipes where members_recipes_ID ='.$display[$i]['comments_foreign_id']);
			$display_current_title = $display_title['members_recipes_name'];
		}
		elseif($display[$i]['comments_type'] == 'products')
		{
			$display_title = $db->querySelectSingle('select * from products_brand where products_brand_ID ='.$display[$i]['comments_foreign_id']);
			$display_current_title = $display_title['products_brand_name_ar'];
		}

		
		$data[$i]['comments_foreign_id'] = $display_current_title;
		$data[$i]['comments_type'] = $display[$i]['comments_type'];
		$data[$i]['comments_members_id'] = $display[$i]['comments_members_id'];
		$data[$i]['comments_message'] = $display[$i]['comments_message'];
		$data[$i]['comments_section_id'] = $display[$i]['comments_section_id'];
		$data[$i]['comments_approve'] = $display[$i]['comments_approve'];
		
		
	}
	$generator->display_table($table_header,$data,$options,"",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
<style>
.comments_message
{
	width:300px;
}
</style>	

<?php
endif;
?>	 

</section>


<?php include("footer.php"); ?>