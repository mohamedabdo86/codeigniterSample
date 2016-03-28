<?php
/* 
Current Version  : 2.2.3
Last update  : 02/12/2013 by AMAKKI

*/
/*
13/1/2012
Example:
//Array of inputs for add,edit form
$array_test = array
(
	array("database_name" => "test_columnQQ" , "title" => "Title 1" , "type" => "text" , "required" => "1" , "message" => "Numbers Only" , "consts" => "only_number" ,"current_value"=>"QQ1" ) ,
	array("database_name" => "test_column2" , "title" => "Title 2" , "type" => "text" , "required" => "1" ,"consts" => "email"  ,"current_value"=>"Q12" ) ,
	array("database_name" => "test_column3" , "title" => "Title 3" , "type" => "file" , "required" => "1" , "message" => "Images Only like png,jpg,gif"  ,"current_value"=>"../$users_images_upload_dir"."ml_logo.jpg" ) ,
	array("database_name" => "test_column4" , "title" => "Title 4" , "type" => "select" , "required" => "0" , "attached_options" => $options_col4 ,"current_value"=>"Q2") ,
	array("database_name" => "test_column5" , "title" => "Title 5" , "type" => "textarea" , "required" => "1" ,"current_value"=>"QQ5" ) ,
	array("database_name" => "test_column7" , "title" => "Date!" , "type" => "date" , "required" => "0" ,"current_value"=>"2012-01-15" ) ,
	array("database_name" => "test_column8" , "title" => "Date 2!" , "type" => "date" , "required" => "0" ,"current_value"=>"2011-01-12" ) ,
	array("database_name" => "test_column6" , "title" => "Title 6" , "type" => "radio" , "required" => "0" , "attached_options" => $radio_box_options  ,"current_value"=>"R1" )
);

//Array of radion options
$radio_box_options = array
(
	array("id" => "R1" , "value" => "Radio1" , "default" => "1") , array("id" => "R2" , "value" => "Radio2" , "default" => "0")
	
);

//Array of Images and Files inputs for tobesaved generator function
$files_array_search = array ("test_column3"); 
$files_array = array 
(
	"test_column3" => array("file_type" => "document" , "file_dir" => "images" , "file_name" => "dir2") //new file name to be uploaded with it
);


//Examples for display arrays
$table_header = array
(
	array("title" => "First Name" , "url_sort" => "test.php?sid=5" , "order" => "col1" , "index" => "0" , "type"=> "text" ) ,
	array("title" => "Last Name" , "url_sort" => "test.php?sid=5", "order" => "col2" ,"index" => "1" , "type"=> "text" ),
	array("title" => "Email" , "url_sort" => "test.php?sid=5" , "order" => "col3" ,"index" => "2" , "type"=> "file" , "image_dir"=> "images" ),
	array("title" => "Due" , "url_sort" => "test.php?sid=5", "order" => "col4"  ,"index" => "3", "type"=> "text" ),
	array("title" => "Website" , "url_sort" => "test.php?sid=5", "order" => "col5" ,"index" => "4", "type"=> "text"  )
);

$data = array 
(
	array("ID" => "1","Ahmed" , "Makki" , "ml_logo.jpg" , "Due" , "Website") ,
	array("ID" => "1","Ahm3ed" , "Mak3ki" , "ml_logo.jpg" , "Du3e" , "Web3site") ,
	array("ID" => "3","A5hmed" , "Ma55kki" , "ml_logo.jpg" , "D5ue" , "Web5site")
) ;


$addition_icons = array
(
	array("title" => "Add Image" , "url" => "home.php?" , "pass_varible" => "did" , "icon" => "icon-5") ,
	array("title" => "Edit Image" , "url" => "home.php?" , "pass_varible" => "sid" , "icon" => "icon-3") 
);

$options = array (
			"add" => array ( "placeicon"=> "1" , "url" => "test.php?" ) ,
			"edit" => array ( "placeicon"=> "1" , "url" => "test.php?" ) ,
			"delete" => array ( "placeicon"=> "1" , "url" => "test.php?" ) ,
			"extra" => $addition_icons
 );



Important Array varibles Form
database_name = name of column at the database
title = Title of the field
type = type of input
attached_options = very important for select and radiobutton options, it contains a 2d array of id and value 
requiried = Is is required or can left empty
message  = Display Addition messages
consts = Field has constrains , like 'only_number' for numbers only textfields , 'email' for emails validation
current_value = current value of the textfield (for edit form)

*/
error_reporting(E_ERROR | E_PARSE);
class Display
{
	public $display_array;
	public $tobesaved_status_array;//introduced at version 2.2
	private $action_form;
	private $action_type;
	
	private $page_name ;
	private $this_page_name_with_varibles;
	private $single_term ;
	private $plural_term ;
	
	
	private $preform_code;
	private $postform_code;
	
	private $pre_validate_generate_form;
	private $post_validate_generate_form;
	private $hide_all_error_messages;
	private $validate_textfield_is_empty;
	private $validate_textfield_consts;
	
	private $pre_display_table;
	private $post_display_table;
	
	private $search_for_ids_special_chars_array;
	private $replace_for_ids_special_chars_array;
	
	private $tobesaved;
	private $crop_settings;
	
	public function __construct($action_type="Add",$action_form,$page_name,$single_term,$plural_term,$crop_settings="",$this_page_name_with_varibles="",$add_extra_add_item_when_edit_form=false){
		
	$this->search_for_ids_special_chars_array = array ( "[" , "]");
	$this->replace_for_ids_special_chars_array = array ( "_" , "_");
	
	$this->page_name = $page_name;
	$this->this_page_name_with_varibles = $this_page_name_with_varibles;
	$this->single_term = $single_term;
	$this->plural_term = $plural_term;
	$this->crop_settings = $crop_settings;
	
	
  	$this->display_array  = array();
	$this->tobesaved_status_array = array();
	$this->action_form = $action_form;
	$this->action_type = $action_type;
	$this->hide_all_error_messages = '';
	$this->validate_textfield_is_empty = '';
	$this->validate_textfield_consts = '';
	$this->tobesaved = array();
	
	$add_extra_add_item_when_edit_form_text = ($add_extra_add_item_when_edit_form && $action_type == "Edit" ) ? "<small><a href='{$this_page_name_with_varibles}&filter=add'>Add new ".$this->single_term."</a></small>" : "";
	$this->preform_code = '
	<form name="handle_from" method="post" enctype="multipart/form-data"  onsubmit="return validate_generate_form();" action="'.$this->action_form.'" >
	
		<article class="module width_full">
			<header><h3>'.$action_type.'  '.$this->single_term.' '.$add_extra_add_item_when_edit_form_text .' </h3></header>
			<div class="module_content">
	';
	
	
	$this->postform_code = '
	</div>
	<footer>
				<div class="submit_link">
					
					<input type="submit" name="submit" value="'.$action_type.'" class="alt_btn">
					<input type="reset" value="Reset">
				</div>
			</footer>
		</article><!-- end of post new article -->
	';

	$this->pre_validate_generate_form = '<script type="text/javascript"> 
	function validate_generate_form()
	 {
		 $("form fieldset").removeClass("error");
		  var state=new Boolean();
		  state= true;';
	$this->post_validate_generate_form = '
	if(!state)
	{
		$.gritter.add({
					class_name: "notification_red_color",
					title: "Error!",
					text: "Please Make sure that the the required field are not empty and valid data.",
					sticky: false,
					time: 2500,
					fade_out_speed : 1500
						});
	}
	return state;} 
</script>';

	$this->pre_display_table ='	
	
	';
	
	$this->post_display_table ='
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
';
  }
  
  
  //Replace ID special characters with _
  private function replace_characters($text)
  {
	  $replaced_title = str_replace($this->search_for_ids_special_chars_array,$this->replace_for_ids_special_chars_array,$text);
	  
	  return $replaced_title;
  }
  
  
  //Returns Message for requried Fields
  private function generate_error_message($error_flag,$database_name,$consts)
  {
	  if($error_flag)
	  {
		  $class_error = " error";
		  $message_error = '<div class="error-inner">Required.</div>';
		  $this->hide_all_error_messages .='';
		  $this->hide_all_error_messages .=
		  '
		  if (document.handle_from.'.$database_name.'.value == "")
			{
			
				document.handle_from.'.$database_name.'.focus();
				$("#fieldset_'.$database_name.'").addClass("error");
				state = false;

			}
		  ';
	  }
	  elseif($consts!="" && !$error_flag)
	  {
		  $class_error = '';
		  $message_error = '<div class="error-inner">Required.</div>';
		 
	  }
	  else
	  {
		  $class_error = '';
		  $message_error = '';
	  }
	  
	  return array($class_error , $message_error ) ;
	  
  }
  
  //Returns Addition message  for certain Fields
  private function generate_addition_message($message)
  {
	  if($message!="")
	  {
	   	$warning_message = '<div class="error-inner blue_warning">
			 '.$message.'</div>
			';
	  }
	  else
	  {
		  $warning_message = '';
	  }
			
	
		return $warning_message;
	  
  }
  private function generate_constrains_messages($consts_flag, $database_name)
  {
	  if($consts_flag != "" )
	  {
		  //Check Type of consts
		  if($consts_flag == "only_number")
		  {
			  //Type is only_number
			  $this->validate_textfield_consts .='
			  if (isNaN(document.handle_from.'.$database_name.'.value)) 
			  {
				document.handle_from.'.$database_name.'.focus();
				$("#fieldset_'.$database_name.'").addClass("error");
				
				state = false; 
			  }
			  ';
			  
		  }//End of $consts_flag == "only_number"
		 if($consts_flag == "email")
		  {
			  $this->validate_textfield_consts .='
			  var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
     		  if (document.handle_from.'.$database_name.'.value.search(emailRegEx) == -1) 
			  {
    			document.handle_from.'.$database_name.'.focus();
				$("#fieldset_'.$database_name.'").addClass("error");
				
				state = false; 
				  
			  }
			  ';
			  
		  }

	  }//End of $consts_flag
	  
  }
  
  
  public function prepare_add_form($temp_array)
  {
	  $this->display_array = $temp_array;
  	  $date_code_jquery_print = '';
	  //Write Preform Html code
	  echo $this->preform_code;
	 
	 
	 foreach($this->display_array as $key => $value)
	 {
		 
		 //Check if Edit only is true
		 if ( $value['edit_only'] )  continue;
		 
		 
		 //Check If field is required
		 list($class_error,$message_error) = $this->generate_error_message($value['required'],$this->replace_characters($value['database_name']),$value['consts']);
		 
		 //Check For addition Required Message
		 $this->generate_constrains_messages($value['consts'],$value['database_name']);
	


		 
		 //Check Type of Input
		 if($value['type']=="text" || $value['type']=="password" )
		 {
			 $read_only = '';
			 if($value['read_only'])
			 $read_only = "readonly";
			 $class_field = "inp-form ";
			 
			if($value['isarabic'])
			$class_field .="isarabic ";
			 
						 
			 
			 $input_format = '<input name="'.$value['database_name'].'" id="'.$this->replace_characters($value['database_name']).'" '.$read_only.' type="'.$value['type'].'" class="'.$class_field.$class_error.'" />';
		 }
		 elseif($value['type'] == "textarea" )
		 {
			 $read_only = '';
			 if($value['read_only'])
			 $read_only = "readonly";
			 
			 $class_field = "form-textarea ";
			 
			 if($value['isarabic'])
			 $class_field .="isarabic ";
			 
			 
			 $input_format = '<textarea id="'.$this->replace_characters($value['database_name']).'" name="'.$value['database_name'].'" rows="5" cols="" '.$read_only.' class="'.$class_field.$class_error.'"></textarea>';
			 
			 
		 }
		 elseif($value['type']=="hidden" )
		 {
			 $input_format = '<input id="'.$value['database_name'].'" name="'.$value['database_name'].'" type="hidden" value="'.$value['value'].'" />';
		 }
		 elseif($value['type'] == "file" || $value['type'] == "image" )
		 {
			 $class_field = "file_1 ";
			 $input_format = '<input name="'.$value['database_name'].'" id="'.$this->replace_characters($value['database_name']).'" type="file" class="'.$class_field.$class_error.'" />';
		 }
		 elseif($value['type'] == "select" )
		 {
			 $class_field = "styledselect_form_1 ";
			 $input_format= '';
			 $input_format .= '<select id="'.$this->replace_characters($value['database_name']).'" name="'.$value['database_name'].'" class="'.$class_field.$class_error.'">';
			 //Display Singe Empty optoin if true
			  $add_empty_option = $value['add_empty_option'];
			  if($add_empty_option) $input_format .='<option value="">Select ...</option>';
			 //Display Options with their values here
			 $options = $value['attached_options'];
			 foreach($options as $inner_key => $options_array)
			 {
				 $input_format .='<option value="'.$options_array['id'].'">'.$options_array['value'].'</option>';
			 }
			 
			 
			 $input_format .='</select>';
			 
		 }
		 elseif($value['type'] == "radio" )
		 {
			 $class_field = '';
			 $input_format = '';
			 
			 //Display options with their values
			  $options = $value['attached_options'];
			  foreach($options as $inner_key => $options_array)
			 {
				 $checked = "";
				 if($options_array['default'])
					 $checked = "checked";

				 $input_format .=' <label><input '.$checked.' type="radio" name="'.$value['database_name'].'" value="'.$options_array['id'].'" />'.$options_array['value'].' </label><br /><br />';
			 }
			 
		 }
		 elseif($value['type'] == "checkbox" )
		 {
			 $class_field = '';
			 $input_format = '';
			 
			 //Display options with their values
			  $options = $value['attached_options'];
			  foreach($options as $inner_key => $options_array)
			 {
				 $checked = "";
				 if($options_array['default'] ==  true )
					 $checked = "checked";

				 $input_format .=' <label><input '.$checked.' type="checkbox"  name="'.$value['database_name'].'[]" value="'.$options_array['id'].'" />'.$options_array['value'].' </label><br /><br />';
			 }
			 
		 }	
		  elseif($value['type'] == "date" )
		 {
			// $explode_date = explode("-" , date('Y-m-d'));
			 
			 
			 $input_format = '<input name="'.$value['database_name'].'" id="'.$this->replace_characters($value['database_name']).'" '.$read_only.' type="text" class="'.$class_field.$class_error.' datepicker" />';

			 
		 }
		 
		 //Check If input should output a blue message
		 $warning_message  = $this->generate_addition_message($value['message']);
		
		 
		 if($value['type'] == "editor" )
		 {
			
			 
			 $tr_class = '';
			 if($value['tr_class'] !="" )
			 $tr_class = 'class="'.$value['tr_class'].'"';  
			 
			echo "<fieldset id='fieldset_".$value['database_name']."' ".$tr_class." >";
			  echo '<label>'.$value['title'].'</label>'.$message_error.$warning_message."<div class='clear'>&nbsp;</div><div style='padding:15px'>";
			
			$sBasePath = $_SERVER['PHP_SELF'] ;
		 	$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, $this->action_form) ) ;
			//echo $sBasePath;
			$oFCKeditor = new FCKeditor($value['database_name']) ;
			$oFCKeditor->BasePath = $sBasePath.'scripts/editor/' ;
			$oFCKeditor->Height = 400;
			$oFCKeditor->Width =700;
			$oFCKeditor->ToolbarSet = "Customized";
			$oFCKeditor->Config['SkinPath'] = $sBasePath.'scripts/editor/editor/skins/silver/';
			$oFCKeditor->Create(); 
			
			
			 
			   echo "</div></fieldset>";	
			 
			 
		 }
		 elseif($value['type']!="hidden" )
		 {
			 $tr_class = '';
			 if($value['tr_class'] !="" )
			 $tr_class = 'class="'.$value['tr_class'].'"';    
			 
			 echo "<fieldset id='fieldset_".$value['database_name']."' ".$tr_class." >";
			 echo '<label>'.$value['title'].'</label>'.$message_error.$warning_message."<div class='clear'>&nbsp;</div>";
			 echo $input_format;
			 //echo ''..'';		 
			  echo "</fieldset>";	
		 }
		 elseif($value['type']=="hidden" )
		 {
			 echo $input_format;
		 }
		 	
	 }//End of  foreach($this->display_array as $key => $value)
	 
	   echo $this->postform_code;
	   
	   $this->generate_validate_function();
	   
	
  }//End of prepare_add_form
  
  public function prepare_edit_form($temp_array)
  {
	  global $db;
	  $this->display_array = $temp_array;
	  $date_code_jquery_print = '';
	  //Write Preform Html code
	  echo $this->preform_code;
	 
	 
	 foreach($this->display_array as $key => $value)
	 {
		 
		 
		 //Check if Add only is true
		 if ( $value['add_only'] )  continue;
		
		
		 //Check If field is required
		 if($value['type']!= "image" && $value['type']!= "file"  )
		 list($class_error,$message_error) = $this->generate_error_message($value['required'],$this->replace_characters($value['database_name']),$value['consts']);
		 
		 //Check For addition Required Message
		 
		 $this->generate_constrains_messages($value['consts'],$value['database_name']);
	


		 
		 //Check Type of Input
		 if($value['type']=="text" || $value['type']=="password" )
		 {
			 $read_only = '';
			 if($value['read_only'])
			 $read_only = "readonly";
			 $class_field = "inp-form ";
			 
			 if($value['isarabic'])
			 $class_field .="isarabic ";
			 
			 
			 $input_format = '<input name="'.$value['database_name'].'" id="'.$this->replace_characters($value['database_name']).'" '.$read_only.' type="'.$value['type'].'" class="'.$class_field.$class_error.'" value="'.htmlspecialchars($value['current_value']).'" />';
		 }
		 elseif($value['type'] == "textarea" )
		 {
			 if($value['read_only'])
			 $read_only = "readonly";
			 
			 $class_field = "form-textarea ";
			 if($value['isarabic'])
			 $class_field .="isarabic ";
			 
			 $input_format = '<textarea id="'.$this->replace_characters($value['database_name']).'" name="'.$value['database_name'].'" rows="5" cols="" '.$read_only.' class="'.$class_field.$class_error.'">'.$value['current_value'].'</textarea>';
			 
			 
		 }
		 elseif($value['type']=="hidden" )
		 {
			 $input_format = '<input name="'.$value['database_name'].'" type="hidden" value="'.$value['value'].'" />';
		 }
		 elseif($value['type'] == "file" || $value['type'] == "image" )
		 {
			 $class_field = "file_1 ";
			 $input_format = '<input name="'.$value['database_name'].'" id="'.$this->replace_characters($value['database_name']).'" type="file" class="'.$class_field.'" />';
			 
			 
			 if($value['type'] == "image" ) {
				 if($value['image_only']!="") {
					 $crop_ratio = explode(":",$this->crop_settings[$value['database_name']]['aspect_ratio']);
					 $crop_settings_url =  "&ratio_1=".$crop_ratio[0];
					 if($crop_ratio[1] != "") $crop_settings_url .= "&ratio_2=".$crop_ratio[1];
					 $crop_settings_url .= '&target_w='.$this->crop_settings[$value['database_name']]['thumbnail_final_width'];
					 $crop_settings_url .= '&target_h='.$this->crop_settings[$value['database_name']]['thumbnail_final_height'];
					 
					

					 //Option to remove pic only if not requiried
					 $remove_pic_option =  "";
					 
					/* if(!$value['required']) $remove_pic_option = '&nbsp;
					<a class="removepic"  data-id="'.$value['database_name'].'" href="test.php">Remove Picture</a>';*/
					 
					$get_image_src = $db-> querySelectSingle("select * from images where images_ID=".$value['image_only']);
					$input_format .= '<div class="image_extra_info" >Current Image: <a class="fancybox" href="'.$value['current_value'].$get_image_src['images_src'].'" ><img src="'.$value['current_value'].$get_image_src['images_src'].'" width="50"  border="0" />
					</a>
					&nbsp;
					Current Thumbnail: <a class="fancybox" href="'.$value['current_value']."thumb_".$get_image_src['images_src'].'" ><img src="'.$value['current_value']."thumb_".$get_image_src['images_src'].'" width="50"  border="0" />
					</a>
					&nbsp;
					<a class="fancybox fancybox.ajax" href="ajax/change_thumbnail_pic.php?id='.$get_image_src['images_ID'].'&dir='.$value['current_value'].$crop_settings_url.'">Change Thumbnail</a>
					'.$remove_pic_option.'
					</div>';
				 } else {
					 $message_error  = '<div class="image_extra_info" >Current Image: No Image Uploaded</div>
					<br /><br />
					<div class="clear">&nbsp;</div>';
				 }
			 }
			 if($value['type'] == "file" ) {
				 if($value['image_only']!="") {
					$message_error  = 'Current File: <a href="'.$value['current_value'].'" target="_blank">Open File</a>
					<br /><br />
					<div class="clear">&nbsp;</div>';
				 } else {
					 $message_error  = 'Current File: No File Uploaded
					<br /><br />
					<div class="clear">&nbsp;</div>';
				 }
			 }

		 } elseif($value['type'] == "select" ) {
			 $class_field = "styledselect_form_1 ";
			 $input_format= '';
			 $input_format .= '<select id="'.$this->replace_characters($value['database_name']).'" name="'.$value['database_name'].'" class="'.$class_field.$class_error.'">';
			  //Display Singe Empty optoin if true
			  $add_empty_option = $value['add_empty_option'];
			  if($add_empty_option) $input_format .='<option value="">Select ...</option>';
			 //Display Options with their values here
			 $options = $value['attached_options'];
			 foreach($options as $inner_key => $options_array)
			 {
				  $selected = "";
				 if($options_array['id'] ==  $value['current_value'])
					 $selected = "selected";
					 
				 $input_format .='<option value="'.$options_array['id'].'" '.$selected.' >'.$options_array['value'].'</option>';
			 }
			 
			 
			 $input_format .='</select>';
			 
		 }
		 elseif($value['type'] == "radio" )
		 {
			 $class_field = '';
			 $input_format = '';
			 
			 //Display options with their values
			  $options = $value['attached_options'];
			  foreach($options as $inner_key => $options_array)
			 {
				 $checked = "";
				 if($options_array['id'] ==  $value['current_value'])
					 $checked = "checked";

				 $input_format .=' <label><input '.$checked.' type="radio" name="'.$value['database_name'].'" value="'.$options_array['id'].'" />'.$options_array['value'].' </label><br /><br />';
			 }
			 
		 }
		 elseif($value['type'] == "checkbox" )
		 {
			 $class_field = '';
			 $input_format = '';
			 
			 //Display options with their values
			  $options = $value['attached_options'];
			  foreach($options as $inner_key => $options_array)
			 {
				 $checked = "";
				// if($options_array['id'] ==  $value['current_value'])
				 if (in_array($options_array['id'], $value['current_value'])) // bermawy 1/5/2014
					 $checked = "checked";

				 $input_format .=' <label><input '.$checked.' type="checkbox" name="'.$value['database_name'].'[]" value="'.$options_array['id'].'" />'.$options_array['value'].' </label><br /><br />';
			 }
			 
		 }
		 elseif($value['type'] == "date" )
		 {
			 $input_format = '<input name="'.$value['database_name'].'" id="'.$this->replace_characters($value['database_name']).'" '.$read_only.' type="text" class="'.$class_field.$class_error.' datepicker" value="'.$value['current_value'].'" />';
			 
		 }
		 
		 //Check If input should output a blue message
		 $warning_message  = $this->generate_addition_message($value['message']);
		
		 if($value['type'] == "editor" )
		 {
			 $tr_id = '';
			 if($value['tr_id'] !="" )
			 $tr_id = 'id="'.$value['tr_id'].'"'; 
			 
			 $tr_class = '';
			 if($value['tr_class'] !="" )
			 $tr_class = 'class="'.$value['tr_class'].'"';   
			 
			echo "<fieldset id='fieldset_".$value['database_name']."' ".$tr_class." >";
			  echo '<label>'.$value['title'].'</label>'.$message_error.$warning_message."<div class='clear'>&nbsp;</div><div style='padding:15px'>";
			 $sBasePath = $_SERVER['PHP_SELF'] ;
		 	$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, $this->action_form) ) ;
			//echo $sBasePath;
			$oFCKeditor = new FCKeditor($value['database_name']) ;
			$oFCKeditor->BasePath = $sBasePath.'scripts/editor/' ;
			$oFCKeditor->Height = 400;
			$oFCKeditor->Width = 450;
			$oFCKeditor->ToolbarSet = "Customized";
			$oFCKeditor->Config['SkinPath'] = $sBasePath.'scripts/editor/editor/skins/silver/';
			$oFCKeditor->Value = $value['current_value'];
			$oFCKeditor->Create(); 
			echo "</div></fieldset>";	
			 
			 
		 }
		 elseif($value['type']!="hidden" )
		 {
			 
			 
			 $tr_class = '';
			 if($value['tr_class'] !="" )
			 $tr_class = 'class="'.$value['tr_class'].'"';      
			 
			 echo "<fieldset  id='fieldset_".$value['database_name']."'  ".$tr_class." >";
			 echo '<label>'.$value['title'].'</label>'.$message_error.$warning_message."<div class='clear'>&nbsp;</div>";
			 echo $input_format;
			  echo "</fieldset>";	
		 }
		 elseif($value['type']=="hidden" )
		 {
			 echo $input_format;
		 }
	 }//End of  foreach($this->display_array as $key => $value)
	 
	   echo $this->postform_code;
	   
	   $this->generate_validate_function();
	
  }//End of prepare_edit_form
  
  
private function generate_validate_function()
  {
	  echo $this->pre_validate_generate_form;
	  
	  //Hide All Old Messages
	  echo $this->hide_all_error_messages;
	  
	  //Validate All Requried Fields
	  echo $this->validate_textfield_is_empty;
	  
	  //Validate ALl Const
	  echo $this->validate_textfield_consts;
	  
	  //Close Function
	  echo $this->post_validate_generate_form;
	  
  }//End  of generate_validate_function()
  

  
  //=============================Preparing the tobesaved array
  public function  prepare_tobesaved_array($files_array_search,$files_array)
  {	
  	global $db,$local_path,$path;
	
	
  
  	$current_action = $_POST['submit'];
	
	
	foreach($_POST as $key => $value)
	{
		//echo "Test".$_FILES['test_column3']['name'];
		//Start of code edited by Mark Y. Morcos on 6/5/2012
		$this->tobesaved[$key] = $value;
		//End of code edited by Mark Y. Morcos on 6/5/2012
	}
	//ALl Posts Finished
	//Now Check Files
	if(isset($files_array_search) && isset($files_array) )
	{
		foreach($files_array_search as $key => $value)
		{
			
			//If File is Image
			if($files_array[$value]['file_type']=="image")
			{
				if($_FILES[$value]['name']!="")
				{
					
					//Check Restrictions
					//$filteraction_form = $this->action_type == "Add" ? "add" : "edit"; // Bermawy04-08-2015
					$filteraction_form = $current_action == "Add" ? "add" : "edit";
					
					$uploaded_image_info = getimagesize($_FILES[$value]["tmp_name"]);
					
					//Check Width Restrictions
		
		
					if($files_array[$value]['width_restriction']!="" )
					{
						if($uploaded_image_info[0]!= $files_array[$value]['width_restriction']  ) 
						{
							die("<script>location.href = '".$this->this_page_name_with_varibles."&error_code=width_restriction&state=error&filter={$filteraction_form}&id=".$this->tobesaved['id']."' </script>");

						}
						
						
					}
					
				
					//Check Height Restrictions
					if($files_array[$value]['height_restriction']!="" )
					{
						if($uploaded_image_info[1]!= $files_array[$value]['height_restriction']  ) 
						{
							die("<script>location.href = '".$this->this_page_name_with_varibles."&error_code=height_restriction&state=error&filter={$filteraction_form}&id=".$this->tobesaved['id']."' </script>");
						}
						
						
					}
					
	 				
					list($file,$error) = @UploadImage($value,'../'.$files_array[$value]['file_dir'],'jpeg,gif,png,jpg,bmp',204800,$files_array[$value]['file_name'],2,$image_width,$image_height,$this->crop_settings[$value]['thumbnail_final_width'],$this->crop_settings[$value]['thumbnail_final_height']);
						
						if($error['error']) {
							if($filteraction_form == "add") {
								die("<script>location.href = '".$this->this_page_name_with_varibles."&error_code=".$error['code']."&state=error&filter={$filteraction_form}"."' </script>");
							} elseif($filteraction_form == "edit") {
								die("<script>location.href = '".$this->this_page_name_with_varibles."&error_code=".$error['code']."&state=error&filter={$filteraction_form}&id=".$this->tobesaved['id']."' </script>");
							}
						} else {
							
							//$this->tobesaved[$value]=$file;
							
							if($current_action == "Edit")
							{
								
								//Get Photo ID
								$get_photo = $db -> querySelectSingle("select $value from ".$files_array[$value]['database_name']." where ".$files_array[$value]['id_column']."=".$_POST['id']);
								//get photo souce
								if($get_photo[$value] != "0"  )
								$get_photo_src = $db->querySelectSingle("select images_src from images where images_ID = ".$get_photo[$value]);
								unset($tobesaved_image);
								$tobesaved_image['images_src'] =  $file; 
								$tobesaved_image['images_dir'] =  $local_path.$files_array[$value]['file_dir']."/"; 
								$tobesaved_image['images_date'] =  time(); 
								$tobesaved_image['images_cord'] =  ""; 
								
								if($get_photo[$value] != "0")
								$db->update("images",$tobesaved_image," images_ID=".$get_photo[$value]);
								elseif($get_photo[$value] == "0")
								$this->tobesaved[$value] = $db->insert("images",$tobesaved_image);
								//Delete old image and its thumb
								if(file_exists("../".$files_array[$value]['file_dir']."/".$get_photo_src['images_src']))
								 unlink("../".$files_array[$value]['file_dir']."/".$get_photo_src['images_src']);
								 
								 //thumb
								 if(file_exists("../".$files_array[$value]['file_dir']."/thumb_".$get_photo_src['images_src']))
								 unlink("../".$files_array[$value]['file_dir']."/thumb_".$get_photo_src['images_src']);
							}
							elseif($current_action == "Add")
							{
								unset($tobesaved_image);
								$tobesaved_image['images_src'] =  $file; 
								$tobesaved_image['images_date'] = time();
								$tobesaved_image['images_dir'] =  $local_path.$files_array[$value]['file_dir']."/"; 
								
								$this->tobesaved[$value] = $db->insert("images",$tobesaved_image);
								
								
							}
						}
				}// ENd of $_FILES[$value]['name']!="")
			
				
				
			}//End of if file is image
			if($files_array[$value]['file_type']=="document")
			{
				if($_FILES[$value]['name']!="")
				{
					$filteraction_form = $this->action_type == "Add" ? "add" : "edit";
					if($files_array[$value]['allowed']) $allowed = $files_array[$value]['allowed'];
					else $allowed = 'zip,rar,doc,docx,pdf';
					list($file,$error) = @Upload($value,'../'.$files_array[$value]['file_dir'],$allowed,5000000,$files_array[$value]['image_name']);
						if($error['error'])
						{
							
							die("<script>location.href = '".$this->this_page_name_with_varibles."&error_code=".$error['code']."&state=error&filter={$filteraction_form}&id=".$this->tobesaved['id']."' </script>");
						}
						else
						{
							$this->tobesaved[$value]=$file;
							if($current_action == "Edit")
							{
								global $db;
								$get_photo = $db -> querySelectSingle("select $value from ".$files_array[$value]['database_name']." where ".$files_array[$value]['id_column']."=".$_POST['id']);
								
								if(file_exists("../".$files_array[$value]['file_dir']."/".$get_photo[$value]))
								 unlink("../".$files_array[$value]['file_dir']."/".$get_photo[$value]);
							}
						}
				}//End of if($_FILES[$value]['name']!="")
				
			}//End of if($files_array[$key]['file_type']=="document")
					
				
	
					
				
				
		}//End of foreach($files_array_search as $key => $value)
	}//End of if(isset($files_array_search) && isset($files_array) )
	
	unset($this->tobesaved['submit']);
	
	return $this->tobesaved;
	  
  }//ENd of prepare_tobesaved function
	
	
  public function display_table($headers,$data,$options,$addition_left_field="",$filters_array="") {
	  global $db;
	  $counter_columns = 1;
	  
	  
	  echo '
	  <script type="text/javascript">
	$(document).ready(
	function()
	{
		$("body").on("click",".delete_single_item", function(event){
 			 
			 //Get ID
			 var id = $(this).data("id");
			 
			 //Make the Background coloured red
			 $(".displaytables tr#"+id).addClass("about_to_delete");
			 
			 //Ask Confirm message
			  $.gritter.add({
					class_name: \'notification_red_color\',
					title: \'Delete?!\',
					text: \'Are you sure you want to delete the highlighted row? <br /><br /> <a data-id="\'+id+\'" data-confirmed="1" class="confirm_delete_single_item">Yes</a><a data-id="\'+id+\'"   data-confirmed="0" class="confirm_delete_single_item">No</a>\',
					sticky: false,
					time: \'2500\',
					fade_out_speed : 1500,
					before_close: function(){
						$(".displaytables tr#"+id).removeClass("about_to_delete");
					},
					before_open: function(){
						if($(".gritter-item-wrapper").length == 1)
						{
							// Returning false prevents a new gritter from opening
							return false;
						}
					}
						});
			 
			 //
		});
		$("body").on("click",".confirm_delete_single_item", function(event){
 			
			 $.gritter.removeAll();

			 //Get ID
			 var id = $(this).data("id");
			  var action = $(this).data("confirmed");
			  	 
			  if(action == 0)
			  {
				   $(".displaytables tr#"+id).removeClass("about_to_delete");				  
			  }
			  else
			  {
				  $(".displaytables tr#"+id).addClass("destroy_tr").bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){ prepare_to_delete(id); });
				  					  
			  }
			 
			
			 
			 //
		});
	}
	);
	  </script>
	  ';
	  
	  
	  
	   if($addition_left_field!="")
	  echo '<div style="float:right;margin: 20px 3% 0 3%;display: block;line-height: 22px;">'.$addition_left_field.'</div>';
	 
	  
	  $add_button_option = '';
	  //Check For Add button
	  if($options['add']['placeicon'])
	  $add_button_option = '<small><a href="'.$options['add']['url'].'&filter=add">-Add New '.$this->single_term.'-</a></small>';
	  
	  if(!empty($filters_array))
	  echo $this->generate_filters_form($filters_array);
	  
	  echo '
	  <article class="module width_full">
	   <header><h3 class="tabs_involved">'.$this->page_name.' '.$add_button_option.' </h3>
		
	   </header>
	   
	  
	   <script type="text/javascript"> 
	   
	  $(document).ready(function(){ 
    $("#selecctall").change(function(){
      $(".table_checkbox_class").prop("checked", $(this).prop("checked"));
      });
});

	function validate_bulkaction_form()
	 {
		 
		  var state=new Boolean();
		  state= true;
		  if (document.tableview_form.bulk_action.value == "")
			{
			
				document.tableview_form.bulk_action.focus();
				 
				state = false;

			}

			  
			if(!state)
			{
				$.gritter.add({
							class_name: "notification_red_color",
							title: "Error!",
							text: "You didn\'t select any action.",
							sticky: false,
							time: 2500,
							fade_out_speed : 1500
								});
			}
		return state;}
		
</script>	 


	   <div class="tab_container">
			<div id="tab1" class="tab_content">
			<form name="tableview_form" action="" method="post" onsubmit="return validate_bulkaction_form();" >
			<table id="datatable_view" class="tablesorter displaytables" cellspacing="0">
			';
	  //Write Headers
	  echo '<thead><tr>';
	  echo '<th><input type="checkbox" id="selecctall"></th> ';
	  foreach($headers as $key => $value) {
		  $url_sort = '';
		  if($value['order'] != "")
		  $url_sort = 'href="'.$value['url_sort'].'&order='.$value['order'];
		  
		  if($_GET['order'] == $value['order'])
		  {
			  $dir = $_GET['dir'] == "" || $_GET['dir'] == 0 ?  1 : 0;
			   $url_sort.= "&dir={$dir}";
		  }
		  
		  
		   $url_sort.= '" ';
		  
		  if($value['type']=="image" || $value['type']=="file" || $value['type']=="youtube")
		  $url_sort = "";
		  echo '<th><a '.$url_sort.' >'.$value['title'].'</a></th>';
 		  $counter_columns++;
	  }
	  echo '<th>Actions</th>';
	  echo '</tr></thead>';
	   echo '<tbody>';
	  
	  //Header are complete
	  
	  //Start Show data
	  if(empty($data)) {
		  echo '<tr><td colspan="'.($counter_columns+1).'">No '.$this->plural_term.' were added Yet</td></tr>';
	  }
	  for($i=0;$i<sizeof($data);$i++) {
		  $current_id = $data[$i]['ID'];
		    
		  echo '<tr id="'.$current_id.'" >';
		  echo '<td class="checkbox">
		  <input class="table_checkbox_class" name="items_checkbox[]" value="'.$current_id.'" type="checkbox" />
		  ';
		  
		   //Check For Extra Icons
		  if(isset($options['extra'])) {		
		  	  echo '<div class="options_row">Addition Options: ';  
			  foreach($options['extra'] as $key => $value) {
				  $class_name = $value['class_name'] ==""  ? "" : $value['class_name'];
				  $additional_attr = $value['additional_attr'] ==""  ? "" : $value['additional_attr']; // Bermawy 6/24/2013
				   
				  echo '<a data-id="'.$current_id.'" additional_attr="'.$additional_attr.'" class="'.$class_name.'" href="'.$value['url'].'&'.$value['pass_varible'].'='.$current_id.'" title="'.$value['title'].'" >'.$value['title'].'</a>';
			  }
			  echo '</div>';
		  }
		  
		  echo '</td>';
		  
		  unset($data[$i]['ID']);
		  foreach($headers as $key => $value) {
			  //Column Values 
			 
			$value = $data[$i][$headers[$key]['ID']] ;
			$column_class = $headers[$key]['ID'];
			$code_value = '';
			
			if($headers[$key]['type'] == "image") {
				//Get Image Source From images table 
				if($value != ""){
				$get_image_dir = get_image_picture($value);
				$code_value = '<td class="'. $column_class.'" ><a class="fancybox" href="../'.$headers[$key]['image_dir'].'/'.$get_image_dir['images_'.$headers[$key]['image_version']].'" target="_blank" ><img src="../'.$headers[$key]['image_dir'].'/'.$get_image_dir['images_'.$headers[$key]['image_version']].'" height="50"  border="0" /></a></td>';}
				else
				echo '<td>No Image Uploaded</td>';
				
				//Get File Source From table
			} elseif($headers[$key]['type'] == "file") {
				if($value != "") {
					$get_file_dir = get_image_picture($value);
					$file_name = $get_file_dir['images_src'];
					$exten_file = new SplFileInfo($file_name);		
					$exten_file = strtolower($exten_file->getExtension());		// Extension of file ..
					
					if($exten_file == "jpg" || $exten_file == "jpeg" || $exten_file == "png") {
						$code_value = '<td class="'. $column_class.'" ><a class="fancybox" href="../'.$headers[$key]['image_dir'].'/'.$file_name.'" target="_blank" ><img src="../'.$headers[$key]['image_dir'].'/'.$file_name.'" height="50"  border="0" /></a></td>';
					} else {
						$code_value = '<td  class="'. $column_class.'" ><a href="../'.$headers[$key]['image_dir'].'/'.$file_name.'" target="_blank" >Open File</a></td>';	
					}
				} else {
					echo '<td>No File Uploaded</td>';
				}
			} elseif($headers[$key]['type']=="youtube") {
				
			} elseif($headers[$key]['type']=="date") {
				$code_value ='<td  class="'. $column_class.'" >'.display_custom_date($value).'</td>'; 
			} elseif($headers[$key]['type']=="select") {
				$attached_options = $headers[$key]['attached_options'];
				//Get Value of attached options ID
				$code_value ='<td  class="'. $column_class.'" >'.$this->get_value_from_attached_options($value,$attached_options).'</td>'; 
			}
			elseif($headers[$key]['type']=="bool")
			{
				if($value == 0 || $value == "0"  || $value == "false"  )  $code_value ='<td class="'. $column_class.'" >No</td>'; 
				if($value == 1|| $value == "1"  || $value == "true")  $code_value ='<td class="'. $column_class.'"  >Yes</td>'; 
			}
			else
			{
			  $code_value ='<td  class="'. $column_class.'" >'.$value.'</td>'; 
			}
			echo $code_value;	
		  }
		  echo '<td  class="options_col" >'; //Start of Options
		  
		 
		  if($options['view']['placeicon'])
		  echo '<a target="_blank" href="'.$options['view']['url'].'&filter=edit&readonly&id='.$current_id.'" title="View" class="icon-1 info-tooltip"><img class="icons"   src="images/icn_view.png" title="View Full Details"></a>';
		  if($options['edit']['placeicon'])
		  echo '<a target="_blank" href="'.$options['edit']['url'].'&filter=edit&id='.$current_id.'" title="Edit" class="icon-1 info-tooltip"><img class="icons" src="images/icn_edit.png" title="Edit"></a>';
		  if($options['delete']['placeicon'])
		  echo '<a   class="delete_single_item" data-id="'.$current_id.'"  title="Delete" class="icon-2 info-tooltip"><img class="icons" src="images/icn_trash.png" title="Trash"></a>';
		  
		  echo '</td>';//End of OPtions 
		  
		   
		  echo "</tr>";
		  
		  
	  }
	  
	  //Get Bulk Actions
	  //First of all , Check delete array
	  $bullk_action_string = '';
	  if($options['delete']['placeicon'])
	  $bullk_action_string.= '<option value="delete_all">Delete Checkmarked items</option>';
	  
	  if($options['sendEmail']['placeicon'])
	  $bullk_action_string.= '<option value="send_all">Send Email</option>';
	  $bulk_options_array = $options['bulk_actions'];
	  
	  for($i=0;$i<sizeof($bulk_options_array);$i++)
	  {
		$bullk_action_string.='<option   value="'.$bulk_options_array[$i]['id'].'">'.$bulk_options_array[$i]['value'].'</option>';
	   }
		
	  echo '
	  </tbody> 
	  <tfoot>
	  <tr>
	  <td colspan="20">
	  <select name="bulk_action">
	  <option value="">Select Action</option>
	  '.$bullk_action_string.'
	  </select>
	  &nbsp;
	  <input type="submit" value="Submit" style="width:70px" />
	  </td>
	  </tr>
	  </tfoot>
			</table>
			</form>
			  
			
			</div><!-- end of #tab1 -->
			
			<!-- end of #tab2 -->
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
	  ';	  
	 
	  
  }//End of display table
  
  private function generate_filters_form($filters_array)
  {
	  $filters_string = "";
	  
	  $filters_string.= '<form name="filters_array_form" action="'.$this->this_page_name_with_varibles.'" method="get">';
	  
	  for($i=0;$i<sizeof($filters_array);$i++):
	  if($filters_array[$i]['type'] == "select")
	  {
		  //Check if it is already selected
		  //Fix for the 0 selected problem
		  $flag_null_selected = false;
		  $null_string_selected = "";
		  if( !isset($_GET[$filters_array[$i]['ID']]) || $_GET[$filters_array[$i]['ID']] == ""  )
		  {
			  $flag_null_selected = true;
			  $null_string_selected = "selected";
			  
		  }
		  //End of fix
		  $filters_string.='<label>'.$filters_array[$i]['title'].'</label>';
		  $filters_string.= '<select name="'.$filters_array[$i]['ID'].'">';
		  $filters_string.='<option '.$null_string_selected.'  value="">Display All</option>';
		  $options = $filters_array[$i]['attached_options'];
			for($j=0;$j<sizeof($options);$j++)
			{
				
				$selected = (!$flag_null_selected && ( $_GET[$filters_array[$i]['ID']] == $options[$j]['id']) ) ? "selected" : "";
				
				$filters_string.='<option '.$selected.' value="'.$options[$j]['id'].'">'.$options[$j]['value'].'</option>';
			}
		  
		  $filters_string.= '</select>';
	  }
	  elseif($filters_array[$i]['type'] == "hidden")
	  {
		   $filters_string.= '<input name="'.$filters_array[$i]['ID'].'" type="hidden" value="'.$filters_array[$i]['value'].'" />';
	  }
	  endfor;
	  
	  $filters_string.= '<input type="submit" value="Submit" />';
	  $filters_string.= "</form><div class='clear'></div>";
	  return $filters_string;
  }
  
  private function get_value_from_attached_options($searchfor,$attached_options)
  {
	  
	  $result_value = false;
	  for($i=0;$i<sizeof($attached_options);$i++):
	  if($attached_options[$i]['id'] == $searchfor)
	  {
		   $result_value = $attached_options[$i]['value'];
		   break;
		   return $result_value;
	  }
	  endfor;
	  if(!$result_value) $result_value = "( N/A )";
	  return $result_value;
  }//ENd of get_value_from_attached_options
  
  ///Generate Search query 
  public function generate_search_query($search_headers_attr,$string_query)
  {
	  $display_search_string = "";
	  $array_of_lists = explode(";",$search_headers_attr);
	  
	  if($string_query == "" ) return "";
	  
	  $display_search_string.= " and ( ";
	  for($i=0;$i<sizeof($array_of_lists);$i++)
	  {
		  $display_search_string.= " ".$array_of_lists[$i]." Like '%{$string_query}%' ";
		  if($i<sizeof($array_of_lists)-1) $display_search_string.= " or ";
		
	  }
	  $display_search_string.= " ) ";
	  
	  return $display_search_string;
	  
  }
    
}
?>
