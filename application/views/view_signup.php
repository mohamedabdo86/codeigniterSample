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
<script>
$(document).ready(function(e) {
		
	
	$("#create_member_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();
		
		if( $("#firstname").val() == "" )
		{
			$("#firstname_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#lastname").val() == "" )
		{
			$("#lastname_error").fadeIn("fast");
			state = false;
		}
		if( $("#members_email").val() == "" )
		{
			$("#members_email_error").fadeIn("fast");
			state = false;
		}
		if( $("#members_email").val() != "" )
		{
			 var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			 if( !emailReg.test($("#members_email").val() ) ) 
			 {
				  $("#members_email_format_error").fadeIn("fast");
				  state = false;
			 } 
		}
		

		if( $("#members_password").val() == "" )
		{
			$("#members_password_error").fadeIn("fast");
			state = false;
		}

		if( $("#repeat_password").val() == "" )
		{
			$("#repeat_password_error").fadeIn("fast");
			state = false;
		}
		
		if( ($("#repeat_password").val() != "") && ($("#password").val() != "") )
		{
			if( $("#members_password").val() != $("#repeat_password").val() )
			{
				$("#repeat_password_identical_error").fadeIn("fast");
				state = false;
			}
		}

		/*if( $("#image_uploaded_flag").val() == 1  )
		{
			$("#members_recipes_image_confirmation_error").fadeIn("fast");		 
			state = false;
			 
		}*/
		
		return state;
	
	
	});    
	
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



<div class="clear"></div>
<?php // echo $this->load->view('template/tree_menu_writer');   ?>

<div class="clear"></div>

<div class="inner_title_wrapper">

<div class="sections_wrapper_padding white_background_color" >
<h1 class="<?php echo $current_section_color ?>">التسجيل</h1>
</div>

</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>" style="margin-top:0px; margin-bottom:0px;"></div>

<div class="global_background">
	<div class="center">
		
    <div style="padding:10px" class="direction">
       <?php 
	   $attributes = array('class' => '', 'id' => 'create_member_form');
	   echo form_open_multipart('member/create_member', $attributes); ?>

    
    <table width="60%" border="0" class="float_left">
		<tr>
        	<td width="25%"><h5>First name</h5></td>
        	<td width="65%">
			<?php 
			$data=array( 'name' => 'firstname' ,'id' => 'firstname', 'size' => 50);                  
            echo form_input($data);	
			echo form_error('firstname');
    		echo '<p id="firstname_error" class="field_error">'. lang("bestcook_field_required").'</p>';
            ?>
            </td>
        </tr>   
        <tr>        
            <td><h5>Last name</h5></td>
       		<td>
         	<?php 
			$data=array( 'name' => 'lastname' , 'id' => 'lastname', 'size' => 50); 			 
			echo form_input($data);	
			echo form_error('lastname');
    		echo '<p id="lastname_error" class="field_error">'. lang("bestcook_field_required").'</p>'; 
			?>
            </td>
        </tr>
        <tr>
        	<td><h5>email</h5></td>
            <td>
            <?php 
			$data=array( 'name' => 'members_email' ,  'id' => 'members_email', 'value' => "" ,  'size' => 50); 			 
			echo form_input($data);	
			echo form_error('members_email');
    		echo '<p id="members_email_error" class="field_error">'. lang("bestcook_field_required").'</p>'; 
			echo '<p id="members_email_format_error" class="field_error">Please enter a valid email address. </p>'; 
			?>
            </td>        

         </tr>  
         <tr>
         	  <td><h5>Password</h5></td>  
              <td>
              <?php 
		 	  $data=array( 'name' => 'members_password' , 'id' => 'members_password', 'value' => "" , 'size' => 50); 
			  echo form_password($data);
			  echo form_error('members_password');
    		  echo '<p id="members_password_error" class="field_error">'. lang("bestcook_field_required").'</p>'; 
			  ?>
            </td>
         </tr>
         <tr>
         	  <td><h5>Repeat Password</h5></td>  
              <td>
              <?php 
		 	  $data=array( 'name' => 'repeat_password' , 'id' => 'repeat_password', 'value' => "" , 'size' => 50); 
			  echo form_password($data);
			  echo form_error('repeat_password');
    		  echo '<p id="repeat_password_error" class="field_error">'. lang("bestcook_field_required").'</p>'; 
			  echo '<p id="repeat_password_identical_error" class="field_error">Password Not Identical</p>'; 
			  ?>
            </td>
         </tr>
         <tr>
         	<td><h5>Mobile</h5></td>
			<td>
             	<?php 
			 	$data=array( 'name' => 'mobile' , 'size' => 50 ); 
			  	echo form_input($data);
				echo form_error('mobile');
    		    echo '<p id="mobile_error" class="field_error">'. lang("bestcook_field_required").'</p>'; 
			 	?>
            </td>
        </tr>
        <tr>
             <td><h5>Birthdate</h5></td>
             <td>
                 <?php 
				 $data=array( 'name' => 'birthdate' , 'id' => 'datepicker' , 'size' => 50); 		 
				  echo form_input($data); 
			     ?>
             </td>
        </tr>
        <tr>
        	<td><h5>Children</h5></td>
            <td>
            	<?php 
		 		$data=array( 'name' => 'children' , 'size' => 50); 		 
				echo form_input($data);	 
				?> 
            </td>
 		</tr>
        <tr> 
        	<td><h5>News letters</h5></td>
            <td>
             <?php 
				$data=array('name' =>'newsletter','value' =>'-1' ); 
				echo  form_checkbox($data);
			?> 
            </td>
		</tr>

        <tr>
        <td colspan="2">
        <div class="upload_button_wrapper">
                <div align="right">
                	<div class="btn btn-success fileinput-button">
        			<i class="glyphicon glyphicon-plus"></i>
        			<span>اختار الصورة</span>
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
        	<td colspan="2"><?php echo form_submit('register','Register') ?></td>
        </tr>
        
        <?php 
			$data=array('type'=>'hidden' ,'name' => 'image_uploaded_flag' ,'value' => 0 , 'id' => 'image_uploaded_flag'); 		 
			echo form_input($data);	 
			
			$data=array('type'=>'hidden' ,'name' => 'image_uploaded_name' ,'value' => '' , 'id' => 'image_uploaded_name'); 		 
			echo form_input($data);	 
		?>
       
        <?php //echo form_close(); ?>
        </table>

        
        <div id="upload_image_location" class="float_right" style="width:390px">
            	<div class="image_wrapper">
                    <img style="max-width: 390px;" id="image_preview" class="member_image" src= "<?php echo base_url() ?>images/bestcook/upload_recipe_image_preview.png " />
                </div>

            </div>

        <div class="clear"></div>
  
     	</div>
        

        <?php  echo form_close(); ?>
	   
        <div class="clear"></div>
	</div>
	
</div>








