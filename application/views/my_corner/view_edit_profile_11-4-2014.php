<link href="<?php echo base_url(); ?>css/mycorner.css" rel="stylesheet">

<!-- Upload Function -->
<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">-->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.fileupload.css">
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url(); ?>js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url(); ?>js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url(); ?>js/jquery.fileupload.js"></script>
<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
	
	//Hide Progress Bar
	
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : '<?php echo base_url(); ?>server/php/';
    $('#fileupload').fileupload({
			url: url,
			dataType: 'json',
			done: function (e, data) {
				$.each(data.result.files, function (index, file) {
					/*$('<p/>').text(file.name).appendTo('#files');*/
					$('#image_preview').attr("src","<?php echo base_url(); ?>server/php/files/"+file.name);
					$('#progress').hide();
					//$('.checkbox_wrapper').fadeIn("fast");
					$('#image_uploaded_flag').val(1);
					$('#image_uploaded_name').val(file.name);
					
					
				});
				$('#status_text').html("<?php echo lang("bestcook_uploadrecipe_loading_complete"); ?>");
			},
			add: function (e, data) {
			var goUpload = true;
			var uploadFile = data.files[0];
			if (!(/\.(gif|jpg|jpeg|png)$/i).test(uploadFile.name)) {
				//common.notifyError('You must select an image file only');
				$('#status_text').fadeIn("fast").html("<?php echo lang("bestcook_uploadrecipe_invalid_format_image"); ?>");
				goUpload = false;
			}
			if (uploadFile.size > 2000000) { // 2mb
				//common.notifyError('Please upload a smaller image, max size is 2 MB');
				$('#status_text').fadeIn("fast").html("<?php echo lang("bestcook_uploadrecipe_invalid_size_image"); ?>");
				goUpload = false;
			}
			if (goUpload == true) {
				data.submit();
			}
  	  	},
        progressall: function (e, data) {
			$('#progress').fadeIn("fast");
			$('#status_text').fadeIn("fast");
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
			$("#status_text").html("<?php echo lang("bestcook_uploadrecipe_loading_message"); ?> "+progress+'%');
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
<script>
	jQuery(function(){
		jQuery('#progress').hide();
		jQuery('#status_text').hide();
		/*jQuery('#progress .progress-bar').css({
    	'background-image': 'none',
    	'background-color': '#e82327'
}		);*/

	});
</script>


<!--Date picker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
$(function() {
//$("#datepicker").datepicker("dateFormat", "yy-mm-dd");
$("#datepicker").datepicker({ 
	dateFormat: "yy-mm-dd" ,
	changeMonth: true,
	changeYear: true ,
  })
});
</script>
<script type="text/javascript">
$(document).ready(function(e) {
	$('.edit_button').click(function(e) {
        var type = $(this).attr('id');
		//alert(type);
		//$(this).children('.load_async').show();
    });
    
});
</script>
<style>
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
$current_relatoin = $members_info[0]['members_relationship_id'];
$image = $members_info[0]['images_src'];

$address = $members_info[0]['members_address'];
$current_city = $members_info[0]['members_city_id'];
$email = $members_info[0]['members_email'];
$mobile = $members_info[0]['members_mobile'];

$childern = $members_info[0]['members_children'];


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
        <div class="float_left m_10_5" style=" width:720px;">
          <?php 
		   $attributes = array('class' => '', 'id' => 'upload_member_form');
		   echo form_open_multipart('my_corner/edit_profile', $attributes); 
		   ?>
      <table width="100%" border="0" class="float_left direction">
		<tr>
        	<td width="25%"><h5><?php echo lang('mycorner_firstname');?> </h5></td>
        	<td width="65%">
			<?php 
			$data=array( 'name' => 'members_first_name' , 'value' => $first_name, 'size' => 50);                  
            echo form_input($data);	 
            ?>
            </td>
        </tr>   
        <tr>        
            <td><h5><?php echo lang('mycorner_lastname');?> </h5></td>
       		<td>
         	<?php 
			$data=array( 'name' => 'members_last_name' ,'value' => $last_name, 'size' => 50); 			 
			echo form_input($data);	 
			?>
            </td>
        </tr>
        <tr>        
            <td><h5><?php echo lang('mycorner_marital_status');?></h5></td>
       		<td>
         	<?php 		 
			echo form_dropdown('members_relationship_id', $relationship, $current_relatoin);
			?>
            </td>
        </tr>
       
         <?php /*?><tr>
         	  <td><h5> change password</h5></td>  
              <td>
              <?php 
		 	  $data=array( 'name' => 'changepassword' ,'value' => "" , 'size' => 50); 
			  echo form_password($data);
			  ?>
            </td>
         </tr><?php */?>
        
        <tr>
             <td><h5><?php echo lang('mycorner_birthdate');?></h5></td>
             <td>
                 <?php 
				 $data=array( 'name' => 'members_birthdate' , 'id' => 'datepicker','value' => $birthdate , 'size' => 50); 		 
				  echo form_input($data); 
			     ?>
             </td>
        </tr>
        <?php /*?><tr>
        	<td><h5>children</h5></td>
            <td>
            	<?php 
		 		$data=array( 'name' => 'children' ,'value' => $members_info[0]['members_children'] , 'size' => 50); 		 
				echo form_input($data);	 
				?> 
            </td>
 		</tr>
        <tr> 
        	<td><h5>news letters</h5></td>
            <td>
             <?php 
					if($members_info[0]['members_newsletter'] == '-1')
					{
						$data=array('name' =>'newsletter','value' =>'-1' ,'checked' => true);  
					}
					else
					{
						$data=array('name' =>'newsletter','value' =>'-1' ); 
					}
					 echo  form_checkbox($data);
			?> 
            </td>
		</tr><?php */?>
        <?php /*?><tr>
        	<td><h5>change image </h5></td>
            <td><input id="fileupload" type="file" name="files[]" multiple /></td>
   		</tr><?php */?>
        <tr>
        <td colspan="2">
        <div class="upload_button_wrapper">
                <div class="float_left">
                	<div class="btn btn-success fileinput-button">
        			<i class="glyphicon glyphicon-plus"></i>
        			<span ><?php echo lang('mycorner_choose_image'); ?></span>
        			<!-- The file input field used as target for the file upload widget -->
        			<input id="fileupload" type="file" name="files[]" multiple />
    				</div>
                </div>
                <div id="status_image_wrapper" align="left" style="width: 60%;float: left;margin-top: -25px;">
                		<p id="status_text" style="line-height: 0px;color: #0154a0;"></p> 
						<div style="position:relative;top:5px;" id="progress" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" ></div></div><!-- ENd of progress -->
                        <div style=" width:100%" id="image_error" class="bubble"></div>
                </div><!-- ENd of status_image_wrapper -->
              </div><!-- End of upload_button_wrapper -->
        <td>
        </tr>
        <tr>
        	<td colspan="2"><?php echo form_submit('update',lang('mycorner_update')) ?></td>
        </tr>
        
        <?php 
			$data=array('type'=>'hidden' ,'name' => 'image_uploaded_flag' ,'value' => 0 , 'id' => 'image_uploaded_flag'); 		 
			echo form_input($data);	 
			
			$data=array('type'=>'hidden' ,'name' => 'image_uploaded_name' ,'value' => '' , 'id' => 'image_uploaded_name'); 		 
			echo form_input($data);
			
			$data=array('type'=>'hidden' ,'name' => 'edit_type' ,'value' => $type , 'id' => 'edit_type'); 		 
			echo form_input($data);
		?>
       
        <?php //echo form_close(); ?>
        </table>
                
        </div>
        
        <div id="upload_image_location" class="float_right m_10_5">
        	 <div class="image_wrapper">
            	<img style="width: 230px; height:265px;" id="image_preview" class="member_image" src="<?php echo base_url()."uploads/members/".$image; ?>" />
        	</div>
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
        <div class="float_left m_10_5" style=" width:720px; ">
          <?php 
		   $attributes = array('class' => '', 'id' => 'upload_member_form');
		   echo form_open_multipart('my_corner/edit_profile', $attributes); 
		   ?>
      <table width="100%" border="0" class="float_left direction">
		<tr>
        	<td width="25%"><h5><?php echo lang('mycorner_address');?> </h5></td>
        	<td width="65%">
			<?php 
			$data=array( 'name' => 'members_address' , 'value' => $address, 'size' => 50);                  
            echo form_textarea($data);	 
            ?>
            </td>
        </tr>   
        <tr>        
            <td><h5> <?php echo lang('mycorner_governorate');?></h5></td>
       		<td>
         	<?php 		 
			echo form_dropdown('members_city_id', $city, $current_city);
			?>
            </td>
        </tr>
        <tr>
        	<td><h5><?php echo lang('mycorner_email');?></h5></td>
            <td>
            <?php 
			$data=array( 'name' => 'members_email' ,'value' => $email, 'size' => 50	); 			 
			echo form_input($data);	
			?>
            </td>        

         </tr>  
         	<td><h5> <?php echo lang('mycorner_mobile');?></h5></td>
			<td>
             	<?php 
			 	$data=array( 'name' => 'members_mobile' ,'value' => $mobile , 'size' => 50 ); 
			  	echo form_input($data);	 
			 	?>
            </td>
        </tr>
        
        <tr>
        	<td colspan="2"><?php echo form_submit('update',lang('mycorner_update')) ?></td>
        </tr>
        
        <?php 
			$data=array('type'=>'hidden' ,'name' => 'edit_type' ,'value' => $type , 'id' => 'edit_type'); 		 
			echo form_input($data);
		?>
       
        <?php //echo form_close(); ?>
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
    <script type="text/javascript">
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
        
            <?php /*?><tr>
                <td>
                    <h5>اسم الطفل</h5>
                </td>
                <td>
                    <input type="text" name="children_name[]" id="field_2" value="">
                </td>
                <td>
                    <h5>عمر الطفل</h5>
                </td>
                <td>
                    <input type="text" name="children_age[]" id="field_2" value=""><a href="#" class="removeclass float_right" style=" font-family: Verdana, Geneva, sans-serif;"> X </a>
                </td>
            </tr><?php */?>
        </table>
        <table width="100%" border="0" class="float_left direction">
            <tr>
                <td class="small">
                    <a href="#" id="AddMoreFileBox" class="btn btn-info"><?php echo lang('mycorner_add_child');?></a>
                </td>
            </tr>
            <tr>
                <td colspan="2"><?php echo form_submit('update',lang('mycorner_update'),'class="btn btn-info"') ?></td>
            </tr>
        </table>
        </div>
                
        <div class="clear"></div>
        <?php  echo form_close(); ?>

    </div><!--End of .third_row-->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <?php
	}
    else if($type == 'interested')
	{
	?>
    
    <div id="fourth_row">
        <div class="float_left m_10_5" style=" width:720px; ">
          <?php 
		   $attributes = array('class' => '', 'id' => 'upload_member_form');
		   echo form_open_multipart('my_corner/edit_profile', $attributes); 

			$data=array('type'=>'hidden' ,'name' => 'edit_type' ,'value' => $type , 'id' => 'edit_type'); 		 
			echo form_input($data);

		   ?>
           <h5><?php echo lang('mycorner_interested_in');?></h5>
           
      <table width="100%" border="0" class="float_left direction">
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
				
		  ?>                       
        </table>
        
        <table width="100%" border="0" class="float_left direction">
            <tr>
                <td colspan="2"><?php echo form_submit('update',lang('mycorner_update') ,'class="btn btn-info"') ?></td>
            </tr>
        </table>
        </div>
                
        <div class="clear"></div>
        <?php  echo form_close(); ?>

    </div><!--End of .third_row-->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <?php
	}

	?>
    
</div><!--End of .profile_container-->

