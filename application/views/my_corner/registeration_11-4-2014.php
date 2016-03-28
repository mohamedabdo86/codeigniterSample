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
<script>
$(document).ready(function(e) {
		
	$("#create_member_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();

		if( $("#first_name").val() == "" )
		{
			$("#first_name_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#last_name").val() == "" )
		{
			$("#last_name_error").fadeIn("fast");
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
		
		if( $("#repeat_password").val() == "" )
		{
			$("#repeat_password_error").fadeIn("fast");
			state = false;
		}
		if($("#approve_privacy").is(':checked'))
		{
			
		}
		else
		{
			$("#approve_privacy_error").fadeIn("fast");
			state = false;
		}
		/*if($('#approve_privacy').prop('checked', false))
		{
			$("#approve_privacy_error").fadeIn("fast");
			state = false;
		}
*/
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script>
  $(function() {
    //$("#datepicker").datepicker("dateFormat", "yy-mm-dd");
	$("#datepicker").datepicker({ 
		changeMonth: true,
      	changeYear: true,
	  	yearRange: '1950:2003',
	  	dateFormat: 'yy-mm-dd',
	  })
  });
  </script>

<style>
.registration_banner
{
	width:100%;
	margin-top:10px;
}
.registration_banner .horizontal_line
{
	height:11px;
	width:100%;
	
}
.registration_banner .banner
{
	position:relative;
	width:100%;
}
.registration_banner .banner .fb_reg_button
{
	position:absolute;
	top:109px;
	right:144px;
}
.registration_banner .banner .fb_reg_button:active
{
	top:111px;
}
</style>
<div class="registration_banner">
	<div class="horizontal_line terms_conditions_background_color"></div>
	<div class="banner">
    	<img src="<?php echo base_url()."images/mycorner/registeration_banner.jpg"; ?>" />
		
		<?php
        require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '699451000078016',
  'secret' => 'd879904c2f8d717febd5292ab49d26c7',
));

// Get User ID
$user = $facebook->getUser();


if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
    
    if ($user)
	{
      try {

        $user_profile = $facebook->api('/me','GET');

      } catch(FacebookApiException $e) {

        $login_url = $facebook->getLoginUrl(); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } 
	else 
	{
      // No user, print a link for the user to login
	  $params = array(
	  'scope' => 'read_stream,email , friends_likes,user_birthday , user_location, user_work_history, user_hometown,',
	);
	
	$loginUrl = $facebook->getLoginUrl($params);
	  
	  echo '<a class="fb_reg_button" href="'.$loginUrl.'"><img src="'.base_url().'images/mycorner/fb_reg_button.png" /></a>';

    }
		?>
        </div>
</div>

<div class="white_background_color top_radius_5 height_40">
    <div class="sections_wrapper_margin global_sperator_margin_top ">
       <h1 class="terms_conditions_color innertitle"><?php echo lang('mycorner_registration'); ?> </h1>
    </div> 
</div>
<div class="thick_line terms_conditions_background_color"></div>

<div class="background" style="height:auto;border:1px solid #FFF;">	


<div class="inner_body" >
    <div class="container" style="position:relative;">
    
    	<h2 style="color:#7c7c7c;font:inherit;font-size: 35px;font-weight: bold;"> <?php echo lang('mycorner_welcome'); ?> </h2>
        
        	<div class="welcome_circle">
            	<div class="first_border"></div>
                <div class="circleheader num_of_circle"> 1</div>
                <div class="second_border"></div>
                <div class="circleheadersecond num_of_circle" style="color:#CCC;">2</div>
                <div class="last_border"></div>
            </div>
            
            <div class="show_the_num">
                
                <p class="num_of_page"> 1  </p>
            </div>
        		
        		        
    		 <div class="clear"></div>
             
		<div class="ineer_form">
        	<?php  
			$attributes = array('class' => '', 'id' => 'create_member_form');

			echo form_open_multipart('',$attributes);
			
			
			if($user)
			{
				$facebook->setExtendedAccessToken();
				$access_token =  $facebook->getAccessToken();
				
				$member_fb_id = $user_profile['id'];
				
				$data=array('type'=>'hidden' ,'name' => 'members_fb_id' ,'value' => $member_fb_id , 'id' => ''); 		 
				echo form_input($data);	 
				
				$data=array('type'=>'hidden' ,'name' => 'members_access_token' ,'value' => $access_token , 'id' => ''); 		 
				echo form_input($data);
								
				if(isset($user_profile['first_name']))
				{
					$member_fb_first_name = $user_profile['first_name'];
				}
				else
				{
					$member_fb_first_name = '';
				}
				if(isset($user_profile['last_name']))
				{
					$member_fb_last_name = $user_profile['last_name'];
				}
				else
				{
					$member_fb_last_name = '';
				}
				if(isset($user_profile['email']))
				{
					$member_fb_email = $user_profile['email'];
				}
				else
				{
					$member_fb_email = '';
				}
				if(isset($user_profile['birthday']))
				{
					$member_fb_birthday = date('Y-m-d',strtotime($user_profile['birthday']));
				}
				else
				{
					$member_fb_birthday = '';
				}
			}
			else
			{
				$member_fb_first_name = '';
				$member_fb_last_name = '';
				$member_fb_email = '';
				$member_fb_birthday = '';
			}
			
			?>
            
            <div style="width:375px;" class="float_left">
             <label for="nickname" class="fontweight"><?php echo lang('mycorner_username'); ?> </label>  <br />
             <input type="text" name="nickname" class="large_text" />
             </div>
             
            <div class="float_right" style="width:500px;">
            
              <div class="float_left" style="width:250px;">
              <label for="user_name" class="fontweight"><?php echo lang('mycorner_firstname');?> </label> <br/>
              <?php
              $data=array( 'name' => 'first_name' ,'id' => 'first_name','class'=>'small_text' , 'value' => ''.$member_fb_first_name.'');                  
              echo form_input($data);	
			  echo form_error('first_name'); 
			  echo '<p id="first_name_error" class="field_error">'. lang("bestcook_field_required").'</p>';
			  ?>
              </div>


                
              <div class="float_right"  style="width:250px;">
              <label for="user_name" class="fontweight"><?php echo lang('mycorner_lastname');?> </label> <br/>
              <?php
              $data=array( 'name' => 'last_name' ,'id' => 'last_name','class'=>'small_text' , 'value' => $member_fb_last_name);                  
              echo form_input($data);	
			  echo form_error('last_name'); 
			  echo '<p id="last_name_error" class="field_error">'. lang("bestcook_field_required").'</p>';
			  ?>
               </div>
            </div> <!--end of first div user name-->
           	<div class="clear"></div>
                
            <div style="width:744px;" class="float_left">
                <div class="float_left">
                    <label for="members_password" class="fontweight"><?php echo lang('mycorner_password'); ?> </label> <br/>
                     <?php 
					  $data=array( 'name' => 'members_password' , 'id' => 'members_password', 'value' => "" ,'class'=>'large_text'); 
					  echo form_password($data);
					  echo form_error('members_password');
					  echo '<p id="members_password_error" class="field_error">'. lang("bestcook_field_required").'</p>'; 
					  ?>
                </div>
                <div class="float_right">
                    <label for="repeat_password" class="fontweight"> <?php echo lang('mycorner_confirmpasssword');?> </label> <br/>
                     <?php 
					  $data=array( 'name' => 'repeat_password' , 'id' => 'repeat_password', 'value' => "" ,'class'=>'large_text'); 
					  echo form_password($data);
					  echo form_error('repeat_password');
					  echo '<p id="repeat_password_error" class="field_error">'. lang("bestcook_field_required").'</p>'; 
					  echo '<p id="repeat_password_identical_error" class="field_error">Password Not Identical</p>'; 
					  ?>
                    
                </div>
                <div class="clear"></div>
                
            </div> <!--end of second div password-->
                
                
                  <div style="width:749px;" class="float_left">
                	<div class="float_left">
                    	<label for="members_email" class="fontweight"><?php echo lang('mycorner_email');?>  </label> <br/>
                         <?php 
							$data=array( 'name' => 'members_email' ,  'id' => 'members_email' ,'class'=>'large_text' , 'value' => $member_fb_email); 			 
							echo form_input($data);	
							echo form_error('members_email');
							echo '<p id="members_email_error" class="field_error">'. lang("bestcook_field_required").'</p>'; 
							echo '<p id="members_email_format_error" class="field_error">Please enter a valid email address. </p>'; 
							?>
                    </div>
                    <div class="float_right">
                    	<label for="members_mobile" class="fontweight"> <?php echo lang('mycorner_mobile');?></label> <br/>
                        <input type="text" name="members_mobile" class="large_text" />
                        
                    </div>
                    <div class="clear"></div>
                	
                </div> <!--end of third div password-->
                
                	<div class="clear"></div>
                
            	<div class="img_birthday">
                
                <div class="float_left" style="width:400px;">
                    <label for="day" class="fontweight"><?php echo lang('mycorner_birthdate');?>  </label> <br/>
                     <?php 
                    $data=array( 'name' => 'members_birthdate' , 'id' => 'datepicker', 'class' => 'large_text' , 'value' => $member_fb_birthday); 		 
           		   echo form_input($data); 
             		?>
                 </div>
                 <div class="imgcontainer float_right">
                    <label for="day" class="fontweight"> <?php echo lang('mycorner_chose_lang');?> </label> <br/>
                    
                    <div style="width:200px;margin-top: 10px;" class="float_left"> 
                        <div class="float_left" style="width: 86px;">
                            <label style="margin-top: -4px;line-height: 32px;" for="members_lang" class="fontweight float_right">العربية</label> 
                            <?php $data = array( 'name' => 'members_lang' ,'class' => 'radio float_left' , 'value' => 'arabic');
                                echo form_radio($data);
                            ?>
                            <div class="clear"></div>
                        </div>
                        <div class="float_right">
                            <label for="members_lang"  style="margin-top: -4px;line-height: 32px;" class="fontweight float_right"> English </label> 
                            <?php $data = array( 'name' => 'members_lang' ,'class' => 'radio float_left' , 'value' => 'english');
                            echo form_radio($data);
                            ?>
                        </div>
                    <div class="clear"></div>
                    </div>
                    
                  </div>
                    <div class="clear"></div>
                </div> <!--end of container language -->

                   
                 	<div class="clear"></div>
                    
					</div> <!--end of birthdate and language-->
                    <?php /*?><div class="float_left" style="margin-top:20px;">
                     	<label for="martial_status" class="float_left fontweight"> <?php echo lang('mycorner_marital_status'); ?></label>
						<?php
                            echo form_dropdown('members_relationship_id', $relationship, 'class="small_text"');
                         ?>
                     </div><?php */?>
                     	<div class="clear"></div>
                     
                    
                     
                    <div class="float_left">
                 
                    <?php 
					$data = array( 'name' => 'newsletter' ,'class' => 'float_left checkbox',  'value' => 1,);
					echo form_checkbox($data);
					?>
                    <label style="font:inherit;margin-right:9px;"><?php echo lang('mycorner_updates');?> </label>
                	</div>
                    <div class="clear"></div>
                            
                    
                    <div class="float_left">
                        <div class="triangleboxshadow float_left" style=""></div>
                    <div class="box_shadow float_left">
                        <p style="text-align:center;white-space:normal;"><?php echo lang('mycorner_receive_information');?></p>
                            
                   <table width="100%" border="0" class="float_left direction">
					  <?php 

                      for($i = 0; $i<sizeof($newsletter); $i++)
                      {
                          $newsletter_id = $newsletter[$i]['newsletter_types_ID'];
                          $newsletter_name = $newsletter[$i]['newsletter_types_title'.$current_language_db_prefix];
                          echo '<tr><td>';
                          $data = array('name'  => 'newsletter_members_members_id[]','class' => 'newsletter','value'  => $newsletter_id,'checked' => FALSE);
                          echo form_checkbox($data);
                          echo '<label for="newsletter_type">'.$newsletter_name.'</label>';
            
                          echo '</td></tr>';
                      }
                            
                      ?>                       
                    </table>
                   
                    </div>  <!--end of box shadow-->
                         
                  </div>
                           
                <div class="clear"></div> 
                <br />
                        
            	<div class="float_left">
                	<?php
					$data = array( 'name' => 'approve_privacy' ,'id' => 'approve_privacy' ,'class' => 'float_left checkboxsecond',);
					echo form_checkbox($data);
					 ?>
                     <h2 style="font-size:20px;"> <?php echo lang('mycorner_approve');?></h2>
                     	
         			 <p class="float_left" style="white-space:normal;font-weight:bold;">
                   <?php echo lang('mycorner_register_approve');?> <span class="red"><a href="<?php echo site_url();?>/terms_conditions"><?php echo lang('mycorner_terms_conditions');?></a>
                   </span> <?php echo lang('mycorner_and');?> <span class="red"> <a href="<?php echo site_url();?>/privacy_policy"> <?php echo lang('mycorner_privacypolicy');?></a></span>
                    <?php echo lang('mycorner_required');?>
                        <span class="red"><?php echo lang('mycorner_fill_all_info');?></span>
                     </p>
                </div>
            			<div class="clear"></div>
                         <?php
                        echo form_error('approve_privacy');
						
						echo '<p id="approve_privacy_error" class="field_error">'. lang("mycorner_must_approve").'</p>';
						
						?>
        		
              <div  class="float_right" style="background-color:red;border-radius:10px;width:135px;height: 40px;margin-top:10px;">
              	
                <div> 
					<?php
                        $data = array('name' => 'register','class' => 'registerbtn');
                        echo  form_submit($data,lang('mycorner_register'));
                     ?>
                      <?php  echo form_close(); ?>
                </div>
               </div>
              <div class="clear"></div>
                
       </div> <!-- End OF ineer_form -->
   
    	</div><!-- End OF container -->
        
			</div>	<!-- End OF inner body -->
	
    	</div> 	<!-- End OF white background -->





