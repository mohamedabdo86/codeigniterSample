<link href="<?php echo base_url(); ?>css/mycorner.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.fileupload.css">
<script type="text/javascript">
$(document).ready(function(e) {
	$('.edit_button').click(function(e) {
        var type = $(this).attr('id');
		//alert(type);
		//$(this).children('.load_async').show();
    });
	
	$("#update_order").fancybox({
		  width: 420,
          height: 150,
		  scrolling   : 'no',
		  autoSize : false,
          fitToView : false,
          helpers: {
              title : {
                  type : 'float'
              }
          },
		  afterLoad: function(){
   			setTimeout( function() {$.fancybox.close(); },2000); // 1000 = 3 secs
  		}
      });
	  
	  $("#send_invitation").fancybox({
		  width: 420,
          height: 150,
		  scrolling   : 'no',
		  autoSize : false,
          fitToView : false,
          helpers: {
              title : {
                  type : 'float'
              }
          },
		  afterLoad: function(){
   			setTimeout( function() {$.fancybox.close(); },2000); // 1000 = 3 secs
  		}
      });
	  
	  $("#upload_member_form").submit(function(e) {
		var state = true;
		$(".field_error").hide();
		if( $("#members_first_name").val() == "" )
		{
			$(".members_first_name_error").fadeIn("fast");
			state = false;
		}
		if( $("#members_last_name").val() == "" )
		{
			$(".members_last_name_error").fadeIn("fast");
			state = false;
		}
		if( $("#members_birthdate").val() == "" )
		{
			$(".members_birthdate_error").fadeIn("fast");
			state = false;
		}
		return state;
	  });
    $("#edit_member_form").submit(function(e){
		var state = true;
		$(".field_error").hide();
		if( $("#members_email").val() == "" )
		{
			$(".members_email_error").fadeIn("fast");
			state = false;
		}
		if( $("#members_mobile").val() == "" )
		{
			$(".members_mobile_error").fadeIn("fast");
			state = false;
		}
		return state;
		
	});
});
</script>
<?php
// if not logged in -> redirect to hompage
if (!$this->members->members_id) 
{
	redirect('welcome');
}

//$birthdate = date("d / m / Y" , strtotime($members_info[0]['members_birthdate']));

$first_name = $members_info[0]['members_first_name'];
$last_name = $members_info[0]['members_last_name'];
$birthdate = $members_info[0]['members_birthdate'];
//$current_relatoin = $members_info[0]['members_relationship_id'];
$image = $this->members->members_image;//$members_info[0]['images_src'];

$address = $members_info[0]['members_address'];
$current_city = $members_info[0]['members_city_id'];
$email = $members_info[0]['members_email'];
$mobile = $members_info[0]['members_mobile'];

//$childern = $members_info[0]['members_children'];

?>
<div class="clear"></div>

<div class="inner_title_wrapper" style="margin-top: 8px;">

<div class="sections_wrapper_padding white_background_color" >
<h1 class="<?php echo $current_section_color ?>"><?php echo lang('mycorner_edit_my_page'); ?></h1>
</div>

</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>" style="margin-top:0px; margin-bottom:0px;"></div>

<div class="profile_container global_background " style="background-image:url('<?php //echo base_url()."images/mycorner/profile_bg.jpg"; ?>')">
    <?php
    if($type == 'info')
	{
	?>
    <div id="first_row">
    
    <form method="post" style="position: relative;top: 200px;padding: 0 12px;" name="upload_image" enctype="multipart/form-data"  action="<?php echo site_url($this->router->class."/upload_member_image"); ?>">
    	<div class="btn btn-success fileinput-button" style="padding: 3px 0;height: 25px;margin-top: 13px;">
                <i class="glyphicon glyphicon-plus"></i>
                <span style="font-weight: bold;font-size: 13px;"><?php echo lang('mycorner_choose_image'); ?></span>
                <!-- The file input field used as target for the file upload widget -->
                <input style="width: 120px;height: 33px;" type="file" name="images" id="images" multiple />
                
        </div>
    	<button type="submit" style="display:none" id="btn"></button>
    </form>
    
    	<div id="upload_image_location" class="float_right m_10_5">
        	 <div style="position:relative;" class="image_wrapper" id="image_wrapper">
             	<img class="loading_image" src="<?php echo base_url()."images/loader.gif" ?>" />
            	<img style="width: 230px; height:265px;" id="image_preview" class="member_image" src="<?php echo base_url()."uploads/members/".$image; ?>" />
        	</div>
        </div>
        
<script>
(function () {
		$('.loading_image').hide();
	var input = document.getElementById("images"), 
		formdata = false;

	function showUploadedItem (source) {
  		var preview = document.getElementById("image_wrapper"),
	  		img  = document.getElementById("image_preview");
  		img.src = source;
	} 
	
	if (window.FormData) {
  		formdata = new FormData();
  		document.getElementById("btn").style.display = "none";
	}
	
 	input.addEventListener("change", function (e) {
		
	$('#status_error_size').html("");
	$('#status_text').html("");
	$('#status_text').html("<?php echo lang("globals_uploading"); ?>");
	$('#image_preview').addClass('image_opacity');
	$('.loading_image').fadeIn('fast');
	
	
	var file_list = e.target.files;

    for (var i = 0, file; file = file_list[i]; i++) 
	{
		var goUpload = true;
        var sFileName = file.name;
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
        var iFileSize = file.size;
        var iConvert = (file.size / 102400).toFixed(2);

		if (!(/\.(gif|jpg|jpeg|png)$/i).test(sFileName)) 
		{
			//common.notifyError('You must select an image file only');
			$('#status_text').fadeIn("fast").html("<?php echo lang("bestcook_uploadrecipe_invalid_format_image"); ?>");

			goUpload = false;
		}
		if (iFileSize > 2000000) // 2mb
		{ 
			//common.notifyError('Please upload a smaller image, max size is 2 MB');
			$('#status_error_size').fadeIn("fast").html("<?php echo lang("bestcook_uploadrecipe_invalid_size_image"); ?>");
			goUpload = false;
		}
		
		if (goUpload == false) 
		{
			formdata = false;
		}
    }	

 		var i = 0, len = this.files.length, img, reader, file;
	
		for ( ; i < len; i++ ) {
			file = this.files[i];
	
			if (!!file.type.match(/image.*/)) {
				if ( window.FileReader ) {
					reader = new FileReader();
					reader.onloadend = function (e) 
					{ 
						showUploadedItem(e.target.result, file.fileName);
					};
					reader.readAsDataURL(file);
				}
				if (formdata) {
					formdata.append("images[]", file);
				}
			}	
		}
	
		if (formdata) {
			$.ajax({
				url:  "<?php echo site_url($this->router->class."/upload_member_image"); ?>",
				type: "POST",
				data: formdata,
				dataType: "json",
				processData: false,
				contentType: false,
				success: function(success_array) 
				{
					$('#status_text').html("<?php echo lang("bestcook_uploadrecipe_loading_complete"); ?>");
					$('#image_preview').removeClass('image_opacity');
					$('.loading_image').fadeOut('fast');
					$('#image_uploaded_flag').val(1);
					$('#image_uploaded_name').val(success_array.name);
					$('#image_uploaded_id').val(success_array.id);
				}
			});
		}
	}, false);
}());
</script>
        
    	<?php 
	   	$attributes = array('class' => '', 'id' => 'upload_member_form' , 'name' => 'upload_member_form');
	   	echo form_open_multipart('my_corner/edit_profile', $attributes); 

		$data=array('type'=>'hidden' ,'name' => 'image_uploaded_flag' ,'value' => 0 , 'id' => 'image_uploaded_flag'); 		 
		echo form_input($data);	 
		
		$data=array('type'=>'hidden' ,'name' => 'image_uploaded_name' ,'value' => '' , 'id' => 'image_uploaded_name'); 		 
		echo form_input($data);
		
		$data=array('type'=>'hidden' ,'name' => 'image_uploaded_id' ,'value' => '' , 'id' => 'image_uploaded_id'); 		 
		echo form_input($data);
		
		$data=array('type'=>'hidden' ,'name' => 'edit_type' ,'value' => $type , 'id' => 'edit_type'); 		 
		echo form_input($data);
	   ?>
        <div class="float_left m_10_5" style=" width:720px;">
          
      <table width="100%" border="0" cellpadding="5" class="float_left direction">
		<tr>
        	<td width="25%"><h5><?php echo lang('mycorner_firstname');?> </h5></td>
        	<td width="65%">
			<?php 
			$data=array( 'name' => 'members_first_name' , 'id' => 'members_first_name','class'=>'date_text', 'value' => $first_name, 'size' => 50);                  
            echo form_input($data);	
			echo "<p class='members_first_name_error field_error'>".lang("bestcook_field_required")."</p>" 
            ?>
            </td>
        </tr>   
        <tr>        
            <td><h5><?php echo lang('mycorner_lastname');?> </h5></td>
       		<td>
         	<?php 
			$data=array( 'name' => 'members_last_name', 'id' => 'members_last_name' ,'class'=>'date_text' ,'value' => $last_name, 'size' => 50); 			 
			echo form_input($data);
			echo "<p class='members_last_name_error field_error'>".lang("bestcook_field_required")."</p>" 	 
			?>
            </td>
        </tr>
        <tr>
             <td><h5><?php echo lang('mycorner_birthdate');?></h5></td>
             <td>
                 <?php 
				 $data=array( 'name' => 'members_birthdate' , 'id' => 'members_birthdate' ,'class'=>'date_text datepicker', 'value' => $birthdate , 'size' => 50); 		 
				  echo form_input($data);
				  echo "<p class='members_birthdate_error field_error'>".lang("bestcook_field_required")."</p>" 	  
			     ?>
             </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <div id="status_image_wrapper" class="float_left" align="left">
                        <p id="status_text" style="line-height: 20px;color: #0154a0;"></p>
                        <p id="status_error_size" style="line-height: 20px;color: #0154a0;"></p> 
                </div><!-- ENd of status_image_wrapper -->
            </td>
        </tr>
		</table>
        </div><!--End of left.div-->
        
        <div class="clear"></div>
        
        <!--<div class="float_left m_10_5" style=" width:650px;margin-top: -70px">
        <table id="InputsWrapper" width="100%" cellpadding="5" border="0" class="float_left direction">-->
         <?php
		 	/*$display_sting = '';
			for($i = 0; $i<sizeof($members_children);$i++)
			{
				$name = $members_children[$i]['members_children_name'];
				$age = $members_children[$i]['members_children_age'];
				
				$display_sting .= '<tr>';
				$display_sting .= '<td><h5>'.lang("mycorner_child_age").'</h5></td>';
				$display_sting .= '<td><input type="text" class="datepicker date_text" name="children_age[]" id="field_'.($i+1).'" value="'.$age.'"></td>';
				$display_sting .= '<td><h5>'.lang("mycorner_child_name").'</h5></td>';
				$display_sting .= '<td><input type="text" class="date_text" name="children_name[]" id="field_'.($i+1).'" value="'.$name.'"><a href="#" class="removeclass float_right" style=" font-family: Verdana, Geneva, sans-serif;margin-top: 11px;"> X </a></td>';
				$display_sting .= '</tr>';
			}
				echo $display_sting;*/
			
			?>

        <!-- </table> -->
        <table class="float_left">
        	<?php /*?><tr class="small">
            	 <td><a href="#" id="AddMoreFileBox" class="mycorner_button"><?php echo lang('mycorner_add_child');?></a></td>
            </tr><?php */?>
            <tr>
            	<td><?php echo form_submit('update',lang('mycorner_update'),'class="mycorner_button"') ?></td>
            </tr>
        </table>

        <!-- </div> -->
        <div class="clear"></div>

        </div>
                
        <div class="clear"></div>
        <?php  echo form_close(); ?>

    </div><!--End of #first_row-->
    
    <div class="global_sperator_height" style="width:100%"></div>
	<?php
	}
    else if($type == 'address')
	{
	?>
    <div id="second_row">
        <div class="float_left m_10_5" style=" width:600px; ">
          <?php 
		   $attributes = array('class' => '', 'id' => 'edit_member_form');
		   echo form_open_multipart('my_corner/edit_profile', $attributes); 
		   ?>
      <table width="100%" border="0" class="float_left direction">
		<tr>
        	<td width="25%"><h5><?php echo lang('mycorner_address');?> </h5></td>
        	<td width="65%">
			<?php 
			$data=array( 'name' => 'members_address' , 'value' => $address, 'size' => 30);                  
            echo form_textarea($data);	 
            ?>
            </td>
        </tr>   
        <tr>        
            <td><h5> <?php echo lang('mycorner_governorate');?></h5></td>
       		<td>
         	<?php 		 
			echo form_dropdown('members_city_id', $city, $current_city, 'class="small_text" ');
			?>
            </td>
        </tr>
        <tr>
        	<td><h5><?php echo lang('mycorner_email');?></h5></td>
            <td>
            <?php 
			$data=array( 'name' => 'members_email', 'id' => 'members_email' ,'class' => 'small_text','value' => $email, 'size' => 50	); 			 
			echo form_input($data);	
			echo "<p class='members_email_error field_error'>".lang("bestcook_field_required")."</p>" 	  
			?>
            </td>        

         </tr>  
         	<td><h5> <?php echo lang('mycorner_mobile');?></h5></td>
			<td>
             	<?php 
			 	$data=array( 'name' => 'members_mobile', 'id' => 'members_mobile' ,'class' => 'small_text','value' => $mobile , 'size' => 50 ); 
			  	echo form_input($data);	 
			 	echo "<p class='members_mobile_error field_error'>".lang("bestcook_field_required")."</p>" 	  
				?>
            </td>
        </tr>
        
        <tr>
        	<td colspan="2"><?php echo form_submit('update',lang('mycorner_update'),'class="mycorner_button"') ?></td>
        </tr>
        
        <?php 
			$data=array('type'=>'hidden' ,'name' => 'edit_type' ,'value' => $type , 'id' => 'edit_type'); 		 
			echo form_input($data);
		?>
        </table>
                
        </div>
                
        <div class="clear"></div>
        <?php  echo form_close(); ?>

    </div><!--End of .second_row-->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <?php
	}
    else if($type == 'childern')
	{
	?>
<?php /*?>    <script type="text/javascript">
	$(document).ready(function() {
	
		var MaxInputs       = 8; //maximum input boxes allowed
		var InputsWrapper   = $("#InputsWrapper"); //Input boxes wrapper ID
		var AddButton       = $("#AddMoreFileBox"); //Add button ID
		
		var x = <?php echo count($members_children)?>; //Add button ID
		
		//var x = InputsWrapper.length; //initlal text box count
		//alert(x);
		var FieldCount=1; //to keep track of text box added
		var Childname = "<?php echo lang('mycorner_child_name');?>";
		
		var Childage = "<?php echo lang('mycorner_child_age');?>";
		
		$(AddButton).click(function (e)  //on add input button click
		{
				if(x <= MaxInputs) //max input box allowed
				{
					FieldCount++; //text box added increment
					//add input box
					//$(InputsWrapper).append('<div><input type="text" name="mytext[]" id="field_'+ FieldCount +'" value="Text '+ FieldCount +'"/><a href="#" class="removeclass"> &times; </a></div>');
					$(InputsWrapper).append('<tr><td><h5> '+ Childname +'</h5></td><td><input type="text" name="children_name[]" id="field_'+ FieldCount +'" value=""/></td><td><h5> '+ Childage +'</h5></td><td><input type="text" name="children_age[]" id="field_'+ FieldCount +'" value=""><a href="#" class="removeclass float_right" style=" font-family: Verdana, Geneva, sans-serif;"> X </a></td></tr>');

					x++; //text box increment
				}
		return false;
		});
		
		$("body").on("click",".removeclass", function(e){ //user click on remove text
		
		
				if( x > 1 ) 
				{
					$(this).parent().parent('tr').remove(); //remove text box
					x--; //decrement textbox
				}
		return false;
		}) 
		
	});
    </script>

    <div id="third_row">
        <div class="float_left m_10_5" style=" width:720px; ">
          <?php 
		   $attributes = array('class' => '', 'id' => 'upload_member_form');
		   echo form_open_multipart('my_corner/edit_profile', $attributes); 
		   ?>
      <table width="100%" border="0" class="float_left direction">
      	  <tr>
        	<td><h5><?php echo lang('mycorner_number_of_children');?></h5></td>
            <td colspan="3">
            <?php 
			$data=array( 'name' => 'members_children' ,'value' => $childern, 'size' => 50	); 			 
			echo form_input($data);	
			?>
            </td>        
          </tr>
                
        <?php 
			$data=array('type'=>'hidden' ,'name' => 'edit_type' ,'value' => $type , 'id' => 'edit_type'); 		 
			echo form_input($data);
		?>
       
        </table>
        <table id="InputsWrapper" width="100%" border="0" class="float_left direction">
         <?php
		 	$display_sting = '';
			for($i = 0; $i<sizeof($members_children);$i++)
			{
				$name = $members_children[$i]['members_children_name'];
				$age = $members_children[$i]['members_children_age'];
				
				$display_sting .= '<tr>';
				$display_sting .= '<td><h5><?php echo lang(mycorner_child_name);?></h5></td>';
				$display_sting .= '<td><input type="text" name="children_name[]" id="field_'.($i+1).'" value="'.$name.'"></td>';
				$display_sting .= ' <td><h5><?php echo lang(mycorner_child_age); ?></h5></td>';
				$display_sting .= '<td><input type="text" name="children_age[]" id="field_'.($i+1).'" value="'.$age.'"><a href="#" class="removeclass float_right" style=" font-family: Verdana, Geneva, sans-serif;"> X </a></td>';
				$display_sting .= '</tr>';
			}
				echo $display_sting;
			
			?>

        </table>
        <table width="100%" border="0" class="float_left direction">
            <tr>
                <td class="small">
                    <a href="#" id="AddMoreFileBox" class="mycorner_button"><?php echo lang('mycorner_add_child');?></a>
                </td>
            </tr>
            <tr>
                <td colspan="2"><?php echo form_submit('update',lang('mycorner_update'),'class="mycorner_button"') ?></td>
            </tr>
        </table>
        </div>
                
        <div class="clear"></div>
        <?php  echo form_close(); ?>

    </div><!--End of .third_row-->
    <?php */?>
    <div class="global_sperator_height" style="width:100%"></div>
    
    <?php
	}
    else if($type == 'interested')
	{
	?>
    <script type="text/javascript">
$(document).ready(function(e) {
    $("#insert_message").hide();
	$("#done_sending").hide();
	$( "#sortable" ).disableSelection();
	$( "#sortable" ).sortable();
	
		$('.newsletter').change(function(){
			var value = $(this).val();
			if(value == 2)
			{
				if(this.checked)
				{
					$("#month").show();  // checked
					$("#baby_month").attr("disabled",false);
				}
				else
				{
					$("#month").hide();
					$("#baby_month").attr("disabled",true);
				}
			}
		});
		
		if($( ".newsletter[value=2]" ).attr("checked"))
		{
			$("#month").show();  // checked
			$("#baby_month").attr("disabled",false);
		}
		else
		{
			$("#month").hide();
			$("#baby_month").attr("disabled",true);
		}
		
	$("#upload_member_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();
		
		if( $(".child_name").val() == "" )
		{
			//$("#borthday_box1").find("#members_child_error").fadeIn("fast");
			//$("#borthday_box2").find("#members_child_error").fadeIn("fast");
			$("#members_child_error").fadeIn("fast");
			state = false;
		}
		
		if( $(".child_age").val() == "" )
		{
			//$("#borthday_box1").find("#members_child_error").fadeIn("fast");
			//$("#borthday_box2").find("#members_child_error").fadeIn("fast");
			$("members_child_error").fadeIn("fast");
			state = false;
		}
		
		return state;
	});
	
	
	$('#update_order').click(function(e) {
		
        var member_id = '<?php echo $this->members->members_id; ?>'; 
		var listArray = new Array();
		$(".ui-state").each(function(index, element) {
				listArray.push($(this).attr("id"));
			});
			
		$.ajax({
			  url:  "<?php echo site_url($this->router->class."/section_order"); ?>",
			  type: "POST",
			  data: {data : listArray , member_id : member_id },
			  cache: false,
			  //dataType: "json",
			  success: function(success_array)
			  {
				$("#insert_message").show();
			  },
			  error: function(xhr, ajaxOptions, thrownError)
			  {
				
			  }
				  
			});
		
    });

});
</script>
    <div id="insert_message" style="display:none;"><div style="text-align:center;margin-top:60px;"><h1 style="margin-bottom:25px;"><?php echo lang('mycorner_homepage_section_order_done');?></h1></div></div>

    <div id="fourth_row">
        <div class="float_left m_10_5" style=" width:570px; ">
          <?php 
		   $attributes = array('class' => '', 'id' => 'upload_member_form');
		   echo form_open_multipart('my_corner/edit_profile', $attributes); 

			$data=array('type'=>'hidden' ,'name' => 'edit_type' ,'value' => $type , 'id' => 'edit_type'); 		 
			echo form_input($data);

		   ?>
           <h5><?php echo lang('mycorner_interested_in');?></h5>
           
      <table width="100%" height="350" border="0" class="float_left direction">
   		  <?php 

		  $items = array();
		  
			foreach($members_newsletter as $member_newsletter) 
			{
			   $items[] = $member_newsletter['newsletter_members_newsletter_types_id'];
			}

		  for($i = 0; $i<sizeof($newsletter); $i++)
		  {
			  $newsletter_id = $newsletter[$i]['newsletter_types_ID'];
			  $newsletter_name = $newsletter[$i]['newsletter_types_title'.$current_language_db_prefix];

				if (in_array($newsletter_id, $items)) 
				{
					$checked = TRUE;
				}
				else
				{
					$checked = FALSE;
				}
			  
			  echo '<tr><td>';
			  $data = array('name'  => 'newsletter_members_members_id[]','class' => 'newsletter','value'  => $newsletter_id,'checked' => $checked);
			  echo form_checkbox($data);
			  echo '<label for="newsletter_type">'.$newsletter_name.'</label>';

			  echo '</td></tr>';
		  }
		  if($get_pregnancy)
		  {
			  $show_pregnancy = 'display:block;';
			  $month = $get_pregnancy[0]['pregnancy_month'];
			  $insert_date = $get_pregnancy[0]['pregnancy_date'];
			  
			  $current_inserted_month =  date("m", strtotime($insert_date));
			  $current_month = date('m');
			  $incremented = $current_month - $current_inserted_month;
			  $current_pregnancy_month = $month + $incremented; 

		  }
		  else
		  {
			   $show_pregnancy = 'display:none;';
			   $current_pregnancy_month = "";
		  }
		  echo '<tr id="month" style="'.$show_pregnancy.'">';
		  echo '<td style="width:220px;">'.lang('mycorner_pregnancy_month').'</td>';
		  echo '<td><select name="baby_month" id="baby_month" style="width: 60px;">';
		  		//echo '<option value="">اختارى شهر الحمل</option>';
			  for($i=0 ; $i<=8;$i++)
			  {
				  if ($i+1==$current_pregnancy_month)
				  {
					  $select = "selected='selected'";
				  }
				  else
				  {
					  $select = "";
				  }
				  echo '<option value="'.($i+1).'" '.$select.' >'.($i+1).'</option>';
			  }
			  echo '</select>';	
		  echo '</td></tr>';
		  
			
		  ?>                       
        </table>
        
        <div class="imgcontainer float_left">
          <!--Member Language--> 
            <label for="day" class=""> <?php echo lang('mycorner_chose_lang');?> </label> <br/>
            
            <div style="width:200px;margin-top: 10px;" class="float_left"> 
                <div class="float_left" style="width: 86px;">
                <?php
                $lang = $members_info[0]['members_lang'];
				?>
                    <label style="margin-top: -4px;line-height: 32px;" for="members_lang" class=" float_right">العربية</label> 
                    <?php 
					($lang == 'arabic')? $checked = "TRUE" : $checked = "" ;
					$data = array( 'name' => 'members_lang' ,'class' => 'radio float_left' , 'value' => 'arabic' ,'checked'=>$checked );
                        echo form_radio($data);
                    ?>
                    <div class="clear"></div>
                </div>
                <div class="float_right">
                    <label for="members_lang"  style="margin-top: -4px;line-height: 32px;" class=" float_right"> English </label> 
                    <?php 
					($lang == 'english')? $checked = "TRUE" : $checked = "" ;
					$data = array( 'name' => 'members_lang' ,'class' => 'radio float_left' , 'value' => 'english' ,'checked'=> $checked);
                    echo form_radio($data);
                    ?>
                </div>
            <div class="clear"></div>
            </div>
            
          </div>

        <table width="100%" border="0" class="float_left direction">
            <tr>
                <td colspan="2"><?php echo form_submit('update',lang('mycorner_update') ,'class="mycorner_button"') ?></td>
            </tr>
        </table>
        </div>
        <div class="float_right" style="width:280px;">
            <h3 style="text-align:center;font-weight:bold;font-size:11px;"> <?php echo lang('mycorner_arrang_priorities');?></h3>
            
            <div class="float_right">
            <div class="circle"><h3 class="numbers"> 1</h3></div>
            <div class="circle"><h3 class="numbers"> 2</h3></div>
            <div class="circle"><h3 class="numbers"> 3</h3></div>
            <div class="circle"><h3 class="numbers"> 4</h3></div>
            </div>
            <div class="float_left">
                <ul id="sortable">
                <?php
				if($members_section_order)
				{
					for($i=0;$i<sizeof($members_section_order);$i++)
					{
						$section_id = $members_section_order[$i]['members_section_order_section_id'];
						$section_name = $members_section_order[$i]['sections_name'.$current_language_db_prefix];
						$section_title = $members_section_order[$i]['sections_title'];
						
						echo '<li id='.$section_id.'" class="ui-state"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class=" section_order '.$section_title.'_background_color"><h3>'.$section_name.'</h3></div></li>';
					}
				}
				else
				{?>
				 	<li id="2" class="ui-state"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class=" section_order best_cook_background_color"><h3><?php echo lang('globals_bestcook');?></h3></div></li>
                    <li id="10" class="ui-state"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class=" section_order best_me_background_color"><h3><?php echo lang('globals_bestme');?></h3></div></li>
                    <li id="27" class="ui-state"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class=" section_order best_mom_background_color"><h3><?php echo lang('globals_bestmom');?></h3></div></li>
                    <li id="28" class="ui-state"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class=" section_order best_time_background_color"><h3><?php echo lang('globals_besttime');?></h3></div></li>				
				<?php
				}
				?>
                   
                </ul>
            </div>
            <div class="clear"></div>
            <div>
                <h3 style="text-align:center;"><a href="#insert_message" class="mycorner_button" id="update_order"><?php echo lang('mycorner_update_order');?></a></h3>
            </div>
            
      </div>
            
    <div class="clear"></div>
    <?php  echo form_close(); ?>

    </div><!--End of .third_row-->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <?php
	}

	?>
</div><!--End of .profile_container-->
<!--Date picker-->
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript">
$( document ).on( "focus", "input.datepicker", function() {

    $( this ).datepicker({
       changeMonth: true,
      	changeYear: true,
	  	yearRange: '1950:2014',
	  	dateFormat: 'yy-mm-dd',
    });
});
</script>
<script>
$(document).ready(function(e) {
var checkbox_1 = $(".newsletter[value=6]").prop('checked');
var checkbox_2 = $(".newsletter[value=5]").prop('checked');
if(checkbox_2 == true){
if(checkbox_1 == true){
	$(".newsletter[value=6]").parent().append('<div id="baby_birthday1" class="float_left" style=" width:720px; "><table id="InputsWrapper" width="100%" border="0" class="float_left direction"></table><table width="100%" border="0" class="float_left direction"><tr><td class="small"><div><a href="#" id="AddMoreFileBox" class="add_child_link" ><?php echo lang('mycorner_add_child');?></a></div></td></tr></table></div><div class="clear"></div>');
	<?php 
			for($i = 0; $i<sizeof($members_children);$i++)
			{
				$name = $members_children[$i]['members_children_name'];
				$age = $members_children[$i]['members_children_age'];
			?>
			$(".newsletter[value=6]").parent().append('<div id="borthday_box1"><tr><td><?php echo addslashes(lang('mycorner_child_age')) ?></td><td><input style="width:120px;border-radius: 8px;" type="text" class="datepicker child_age" name="children_age[]" id="field_'+ x +'" value="<?php echo $age; ?>"></td></tr> <tr><td><?php echo addslashes(lang('mycorner_child_name')); ?></td><td><input style="width:120px;border-radius: 8px;" type="text" class="child_name" name="children_name[]" id="field_'+ x +'" value="<?php echo $name; ?>"/><a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');
			<?php } ?>
}
}
var num_of_childs= <?php $members_children ?>
$( ".newsletter[value=6]" ).live("change",function(){
	var item = $(this);
	var checked =  this.checked;
		if(checked)
		{
			item.parent().append('<div id="baby_birthday1" class="float_left" style=" width:720px; "><table id="InputsWrapper" width="100%" border="0" class="float_left direction"></table><table width="100%" border="0" class="float_left direction"><tr><td class="small"><div><a href="#" id="AddMoreFileBox" class="add_child_link" ><?php echo lang('mycorner_add_child');?></a></div></td></tr></table></div><div class="clear"></div>');
			<?php 
			for($i = 0; $i<sizeof($members_children);$i++)
			{
				$name = $members_children[$i]['members_children_name'];
				$age = $members_children[$i]['members_children_age'];
			?>
			item.parent().append('<div id="borthday_box1"><tr><td><?php echo addslashes(lang('mycorner_child_age')) ?></td><td><input style="width:120px;border-radius: 8px;" type="text" class="datepicker child_age" name="children_age[]" id="field_'+ x +'" value="<?php echo $age; ?>"></td></tr> <tr><td><?php echo addslashes(lang('mycorner_child_name')); ?></td><td><input style="width:120px;border-radius: 8px;" type="text" class="child_name" name="children_name[]" id="field_'+ x +'" value="<?php echo $name; ?>"/><a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');
			<?php } ?> 
			$("div#borthday_box2").remove();
			$("div#baby_birthday2").remove();
		}else{
			$("div#baby_birthday1").remove();
			$("div#borthday_box1").remove();
		}
});

$( ".newsletter[value=5]" ).live("change",function(){
	var item = $(this);
	var checked =  this.checked;
		if(checked)
		{
			item.parent().append('<div id="baby_birthday2" class="float_left" style=" width:720px; "><table id="InputsWrapper" width="100%" border="0" class="float_left direction"></table><table width="100%" border="0" class="float_left direction"><tr><td class="small"><div><a href="#" id="AddMoreFileBox" class="add_child_link" ><?php echo lang('mycorner_add_child');?></a></div></td></tr></table></div><div class="clear"></div>');
			
			<?php 
			for($i = 0; $i<sizeof($members_children);$i++)
			{
				$name = $members_children[$i]['members_children_name'];
				$age = $members_children[$i]['members_children_age'];
			?>
			item.parent().append('<div id="borthday_box2"><tr><td><?php echo addslashes(lang('mycorner_child_age')) ?></td><td><input style="width:120px;border-radius: 8px;" type="text" class="datepicker child_age" name="children_age[]" id="field_'+ x +'" value="<?php echo $age; ?>"></td></tr> <tr><td><?php echo addslashes(lang('mycorner_child_name')); ?></td><td><input style="width:120px;border-radius: 8px;" type="text" class="child_name" name="children_name[]" id="field_'+ x +'" value="<?php echo $name; ?>"/><a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');
			<?php } ?>
			
			$("div#baby_birthday1").remove();
			$("div#borthday_box1").remove();
		}else{
			$("div#baby_birthday2").remove();
			$("div#borthday_box2").remove();
		}
	
});
if(checkbox_1 == false){
if(checkbox_2 == true){
	$(".newsletter[value=5]").parent().append('<div id="baby_birthday1" class="float_left" style=" width:720px; "><table id="InputsWrapper" width="100%" border="0" class="float_left direction"></table><table width="100%" border="0" class="float_left direction"><tr><td class="small"><div><a href="#" id="AddMoreFileBox" class="add_child_link" ><?php echo lang('mycorner_add_child');?></a></div></td></tr></table></div><div class="clear"></div>');
	<?php 
			for($i = 0; $i<sizeof($members_children);$i++)
			{
				$name = $members_children[$i]['members_children_name'];
				$age = $members_children[$i]['members_children_age'];
			?>
			$(".newsletter[value=5]").parent().append('<div id="borthday_box1"><tr><td><?php echo addslashes(lang('mycorner_child_age')) ?></td><td><input style="width:120px;border-radius: 8px;" type="text" class="datepicker child_age" name="children_age[]" id="field_'+ x +'" value="<?php echo $age; ?>"></td></tr> <tr><td><?php echo addslashes(lang('mycorner_child_name')); ?></td><td><input style="width:120px;border-radius: 8px;" type="text" class="child_name" name="children_name[]" id="field_'+ x +'" value="<?php echo $name; ?>"/><a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');
			<?php } ?>
}
}
var x = $("#borthday_box").length + 1;
$("#AddMoreFileBox").live("click", function(){
	var item = $(this);
	if(x <= 7){
	   item.parent().parent().append('<div id="borthday_box"><tr><td><?php echo lang('mycorner_child_age'); ?></td><td><input style="width:120px;border-radius: 8px;" type="text" class="datepicker child_age" name="children_age[]" id="field_'+ x +'" value=""></td></tr> <tr><td><?php echo lang('mycorner_child_name'); ?></td><td><input style="width:120px;border-radius: 8px;" type="text" class="child_name" name="children_name[]" id="field_'+ x +'" value=""/><a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');
	x++;
	$(this).parent().parent('tr').remove(); 
	}
	return false;
});

$('#close_field').live("click", function(){
	x--;
	var item = $(this);
	item.parent().remove();
	return false;
});

});
</script>
<style>
#borthday_box{font-size:12px;}
#borthday_box1{font-size:12px;}
#borthday_box2{font-size:12px;}
.add_child_link{font-size: 11px; color: #666;}
.add_child_link:hover{color:#999;text-decoration:underline;}
#close_field{margin: 13px; font-size: 20px;}
.btn-info 
{
	color: #ffffff;
	background-color: #5bc0de;
	border-color: #46b8da;
}
.btn, #submit 
{
	display: inline-block;
	margin-bottom: 0;
	text-align: center;
	vertical-align: middle;
	cursor: pointer;
	background-image: none;
	border: 1px solid transparent;
	white-space: nowrap;
	padding: 6px 12px;
	border-radius: 4px;
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	-o-user-select: none;
	font-size: 12px;
}
</style>