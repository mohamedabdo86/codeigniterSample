<?php
$page_title = "Contact US";
$single_term = "record";
$plural_term = "records";

$filter = $_GET['filter'];
$id = (int)$_GET['id'];

if($filter == "edit")
$form_submit = "Edit";
else $form_submit = "Add";

$this_page_name = basename(__FILE__);
$this_table_name = "contactus";
$this_page_name_with_varibles = "{$this_page_name}?";
$state = $_GET['state'];

//Search Handle
$search_query = $_GET['search_query'];
$search_headers_attr = "contactus_fname;contactus_lname;contactus_email";  //Seperate with semicolumns;

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

?>

<?php
	$current_upload_directory = $images_dir['contact_us'];
	//INitilize Fields with input File  , IMPORTANT for tobesaved generator

	//Pictures Columns inilitize
	$pictures_columns = array();
	$pictures_columns[0] = "contactus_file";
	
	$files_array_search = array($pictures_columns[0]); 
	$files_array = array 
	(
		$pictures_columns[0] => array("file_type" => "image" , "file_dir" => $current_upload_directory , "file_name" => "" , "database_name" => $this_table_name ,"id_column" => "{$this_table_name}_ID" )
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
if($_POST['submit'] == "Add" ||  $_POST['submit'] == "Edit" ) {
	$tobesaved = $generator->prepare_tobesaved_array($files_array_search,$files_array);
	unset($tobesaved['id']);
	
	if($_POST['submit'] == "Add" ) {
		//First Unset ID before ADD
		$state = $db -> insert($this_table_name, $tobesaved);
		if($state != false) {
			die("<script>location.href = '{$this_page_name_with_varibles}&state=added&filter=edit&id={$state}' </script>");
		}
		
	}
	if($_POST['submit'] == "Edit" ) {		
		$state = $db->update($this_table_name , $tobesaved , $this_table_name."_ID=".$_POST['id']);
		if($state != false) {
			die("<script>location.href = '{$this_page_name_with_varibles}&state=updated&filter=edit&id=".$_POST['id']."' </script>");
		}
		
	}
	
	
}

if($filter == "edit" )
$display = $db-> querySelectSingle("select * from $this_table_name where {$this_table_name}_ID ={$id}"); 
$city = $db->querySelect("Select city_ID as id , city_title as value from city order by city_title_ar");
$respond = $db->querySelect("Select respond_ID as id , respond_title as value from respond order by respond_title_ar");
$reason = $db->querySelect("Select reason_ID as id , reason_title as value from reason order by reason_title_ar");
$product = $db->querySelect("Select products_brand_ID as id , products_brand_name as value from products_brand order by products_brand_name");
//$product = $db->querySelect("Select images_ID as id , products_brand_name as value from products_brand order by products_brand_name");
//$date = $db->querySelect("Select contactus_date from contactus"); images_ID


$form_array = array (
	array("database_name" => "contactus_fname" , "title" => "First Name" , "type" => "text" , "required" => "0" ,"current_value"=> $display['contactus_fname'] ) ,
	array("database_name" => "contactus_lname" , "title" => "Last Name" , "type" => "text" , "required" => "0" ,"current_value"=> $display['contactus_lname'] ) ,
	array("database_name" => "contactus_email" , "title" => "E-mail" , "type" => "text" , "required" => "0" ,"current_value"=> $display['contactus_email'] ) ,
	array("database_name" => "contactus_phone" , "title" => "Phone" , "type" => "text" , "required" => "0" ,"current_value"=> $display['contactus_phone'] ) ,
	array("database_name" => "contactus_mobile" , "title" => "Mobile" , "type" => "text" , "required" => "0" ,"current_value"=> $display['contactus_mobile'] ) ,
	array("database_name" => "contactus_respond" , "title" => "Reaspond" , "type" => "select" , "required" => "0" ,"current_value"=> $display['contactus_how_to_contact_method'],'attached_options' =>$respond ) ,
	array("database_name" => "contactus_reason" , "title" => "Reason" , "type" => "select" , "required" => "0" ,"current_value"=> $display['contactus_reason'],'attached_options' =>$reason ) ,
	array("database_name" => "contactus_city" , "title" => "City" , "type" => "select" , "required" => "0" ,"current_value"=> $display['contactus_city'],'attached_options' =>$city ) ,
	array("database_name" => "contactus_products" , "title" => "Product" , "type" => "select" , "required" => "0" ,"current_value"=> $display['contactus_products'],'attached_options' =>$product) ,
	array("database_name" => "contactus_code" , "title" => "Code" , "type" => "text" , "required" => "0" ,"current_value"=> $display['contactus_code'] ) ,
	array("database_name" => "contactus_address" , "title" => "Address" , "type" => "textarea" , "required" => "0" ,"current_value"=> $display['contactus_address'] ) ,
	array("database_name" => "contactus_message" , "title" => "Message" , "type" => "editor" , "required" => "0" ,"current_value"=> $display['contactus_message'] ) ,
	/*array("database_name" => "contactus_file" , "title" => "File" , "type" => "file" , "required" => "0" , "current_value"=> $display['contactus_file'] ) ,*/
	array("database_name" => $pictures_columns[0] , "title" => "File" , "type" => "file" , "required" => "0" , "current_value"=>"../$current_upload_directory/" , "image_only" => $display[$pictures_columns[0]]) ,
	array("database_name" => "contactus_date" , "title" => "Date" , "type" => "date" , "required" => "0" , "current_value"=> $display['contactus_date'] ) ,
	array("database_name" => "id"  , "type" => "hidden" ,"value"=> $id  )
	
);


?>
<script>
 
function prepare_to_delete(id) {
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
			  error: function(xhr, ajaxOptions, thrownError) {
				
			  }
			  
	});
	
}
</script>
<!-- start content-outer -->
<section id="main" class="column">
 
<?php
if($filter == "add" ) {
	//Current User has access
	if(!in_array($add_access_token, $current_array_of_actions) || !$add_item_flag )
	echo "<script type='text/javascript'>location.href='no_access.php'</script>";
	
	echo Messages::generate_notification_ballon($state);

	$generator->prepare_add_form($form_array);
} elseif($filter == "edit" ) {
	if(!in_array($edit_access_token, $current_array_of_actions) || !$edit_item_flag )
	echo "<script type='text/javascript'>location.href='no_access.php'</script>";
	
	
	echo Messages::generate_notification_ballon($state);
	
	$generator->prepare_edit_form($form_array);
}
if(!isset($filter)):

//Where Conditions	
$search_query_string = $generator->generate_search_query($search_headers_attr,$search_query);

//Order by
$sort_by_query = "order by ".$order." ".$direction ;

//Pagination Handle
$total_numbers_of_rows = $db->numRows("select * from  $this_table_name where 1 {$search_query_string} {$section_string} {$approve_string} ");
$paging = new Pagination($page,$list_per_page,$total_numbers_of_rows,$this_page_name_with_varibles );
$paging_query =  "LIMIT ".$list_per_page." OFFSET ".$paging->offset();

//Current User has access
if(!in_array($view_access_token, $current_array_of_actions))
echo "<script type='text/javascript'>location.href='no_access.php'</script>";

$display = $db->querySelect("select * from $this_table_name where 1 {$search_query_string} {$section_string} {$approve_string} {$sort_by_query} {$paging_query} ");


//Table Header



	$table_header = array(
		array("ID"=>"contactus_name", "title" => "Name" , "url_sort" => $this_page_name_with_varibles , "order" => "contactus_name" ,"type"=> "text"),
		array("ID"=>"contactus_email", "title" => "E-mail" , "url_sort" => $this_page_name_with_varibles , "order" => "contactus_email" ,"type"=> "text"),
		array("ID"=>"contactus_message", "title" => "Message" , "url_sort" => $this_page_name_with_varibles , "order" => "contactus_message" ,"type"=> "text"),
		array("ID"=>"contactus_file", "title" => "File" , "url_sort" => $this_page_name_with_varibles , "order" => "contactus_file", "type"=> "file" , "image_dir"=> $current_upload_directory , "image_version" => "src" )
	);
	
	//Filters Options

	
	//Don't Input Filter at URL ! 
	$options = array (
				"add" => array ( "placeicon"=> $add_item_flag  && in_array($add_access_token, $current_array_of_actions) , "url" => $this_page_name_with_varibles ) ,
				"edit" => array ( "placeicon"=> $edit_item_flag && in_array($edit_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				"delete" => array ( "placeicon"=>$delete_item_flag && in_array($delete_access_token, $current_array_of_actions) , "url" =>$this_page_name_with_varibles ) ,
				//"extra" =>$additional_options
				 
	 );
	 
	 
	$data = array();
	for($i=0; $i < sizeof($display); $i++) {
		
		/*$id_file = $display[$i]['contactus_file'];
		if($id_file != "") {
			$get_image_dir = get_image_picture($id_file);
			$file = $get_image_dir['images_src'];  			// name of file ex: "file.php"
			$exten_file = new SplFileInfo($file);			
			$exten_file = $exten_file->getExtension();		// extension of file ex: "php"
			
			if($exten_file == "jpg" || $exten_file == "jpeg" || $exten_file == "png") {
				$result = $display[$i]['contactus_file'];
			} else {
				$result = '<a href="../'.$current_upload_directory.'/'.$file.'" target="_blank" >Open File</a>';
			}
		}*/
		
		$data[$i]['ID'] = $display[$i]['contactus_ID'];
		$data[$i]['contactus_name'] = $display[$i]['contactus_fname']." ".$display[$i]['contactus_lname'];
		$data[$i]['contactus_email'] = $display[$i]['contactus_email'];
		$data[$i]['contactus_message'] = $display[$i]['contactus_message'];
		$data[$i]['contactus_file'] = $display[$i]['contactus_file'];
	}
	$generator->display_table($table_header,$data,$options,"<a style='float:right' href='scripts/contactus_export.php'>Export to Excel Sheet</a>",$filter_options);
	if(!empty($display))
	$paging->display_pag();	
?>
		

<?php
endif;
?>	 

</section>


