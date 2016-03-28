<link href="<?php echo base_url(); ?>css/mycorner.css" rel="stylesheet">
<?php
$this->load->view('my_corner/validation_form');
?>

<script>
$(document).ready(function(e) {
	
	$("#members_password").keyup(function(){
		
    	var passwd = $("#members_password").val();
		
		var intScore   = 0
		var strVerdict = "";
		
		if ( passwd.length < 5 )                         // length 4 or less
		{
			intScore = ( intScore + 3 )
		}
		else if ( passwd.length > 4 && passwd.length < 8 ) // length between 5 and 7
		{
			intScore = ( intScore + 6 )
		}
		else if ( passwd.length > 7 )// length 8 or more
		{
			intScore = ( intScore + 12 )
		}
		/*else if (passwd.length>20)                    // length 16 or more
		{
			intScore = (intScore+18)
		}*/
		
		// LETTERS (Not exactly implemented as dictacted above because of my limited understanding of Regex)
		if ( passwd.match(/[a-z]/) )                              // [verified] at least one lower case letter
		{
			intScore = ( intScore + 1 )
		}
		
		if ( passwd.match(/[A-Z]/) )                              // [verified] at least one upper case letter
		{
			intScore = ( intScore + 5 )
		}
		
		// NUMBERS
		if ( passwd.match(/\d+/) )                                 // [verified] at least one number
		{
			intScore = ( intScore + 5 )
		}
		
		/*if (passwd.match(/(.*[0-9].*[0-9].*[0-9])/))             // [verified] at least three numbers
		{
			intScore = (intScore+5)
		}*/
		
		// SPECIAL CHAR
		if ( passwd.match(/.[!,@,#,$,%,^,&,*,?,_,~]/) )            // [verified] at least one special character
		{
			intScore = ( intScore + 5 )
		}
									 
		if (passwd.match(/(.*[!,@,#,$,%,^,&,*,?,_,~].*[!,@,#,$,%,^,&,*,?,_,~])/)) // [verified] at least two special characters
		{
			intScore = ( intScore + 5 )
		}
		
		// COMBOS
		if (passwd.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))        // [verified] both upper and lower case
		{
			intScore = ( intScore + 2 )
		}

		if (passwd.match(/([a-zA-Z])/) && passwd.match(/([0-9])/)) // [verified] both letters and numbers
		{
			intScore = ( intScore + 2 )
		}
 
									// [verified] letters, numbers, and special characters
		if (passwd.match(/([a-zA-Z0-9].*[!,@,#,$,%,^,&,*,?,_,~])|([!,@,#,$,%,^,&,*,?,_,~].*[a-zA-Z0-9])/))
		{
			intScore = ( intScore + 2 )
		}
		
		if( intScore < 15 ) {
			
		   strVerdict = "<?php echo lang('mycorner_very_week_password'); ?>";
		
		} else if ( intScore >= 15 && intScore < 27 ) {
			
		   strVerdict = "<?php echo lang('mycorner_week_password'); ?>";
		
		} else if ( intScore >= 27 && intScore < 34 ) {
			
		   strVerdict = "<?php echo lang('mycorner_medium_password'); ?>";
		
		} else if ( intScore >= 34 && intScore < 45 ) {
			
		   strVerdict = "<?php echo lang('mycorner_good_password'); ?>";
		
		} else {
			
			strVerdict = "<?php echo lang('mycorner_strong_password'); ?>";
		}
		
		$("#members_password_complexity_score").val(intScore);
		$("#members_password_complexity").text(strVerdict);
		
		if(intScore > 33) {
			$("#members_password_complexity").addClass('green_color');
		} else {
			$("#members_password_complexity").removeClass('green_color');
		}
  	});
				
	$("#create_member_form").submit(function(e) {
		
		var state = true;
		$(".field_error").hide();
		
		var password = $("#members_password").val();
		var repeat_password = $("#repeat_password").val();
		var score = $("#members_password_complexity_score").val();
		
		if(password == "" )
		{
			$("#members_password_error").fadeIn("fast");
			$("#members_password_validation").fadeOut("fast");
			
			state = false;
		}
		
		if(repeat_password == "" )
		{
			$("#repeat_password_error").fadeIn("fast");
			$("#members_password_validation").fadeOut("fast");
			state = false;
		}
				
		if(password != repeat_password )
		{
			$("#error_message").fadeIn("fast");
			state = false;
		}
		if(score != "")
			{
		if (score < 33 )
		{
			$("#members_password_complexity_check").fadeIn("fast");
			state = false;
		}
			}
		if( $(".child_name").val() == "" )
		{
			$("#borthday_box1").find("#members_child_error").fadeIn("fast");
			$("#borthday_box2").find("#members_child_error").fadeIn("fast");
			//$("#members_child_error").fadeIn("fast");
			state = false;
		}
		
		if( $(".child_age").val() == "" )
		{
			$("#borthday_box1").find("#members_child_error").fadeIn("fast");
			$("#borthday_box2").find("#members_child_error").fadeIn("fast");
			//$("members_child_error").fadeIn("fast");
			state = false;
		}

		if($( ".newsletter_type[value=2]" ).attr("checked"))
		{
			if( $("#baby_month ").val() == 0 )
			{
				//alert(1);
				$("#pregnancy_month_error").fadeIn("fast");
				state = false;
			}
		}
			
		if( $("#username").val() == "" )
		{
			$("#username_error").fadeIn("fast");
			state = false;
		}
		
		

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
		
		
		
		if( $("#mobile_number").val() == "" )
		{
			$("#mobile_number_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#email_flag").val() == 0 )
		{
			$('#members_email_validation').fadeIn("fast");
			state = false;
		}
		
		if( $("#username_flag").val() == 0 )
		{
			$('#members_username_validation').fadeIn("fast");
			state = false;
		}
		
		if( $("#members_email").val() == "" )
		{
			$("#members_email_validation").hide();
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
		
		
		if($("#approve_privacy").is(':checked'))
		{
			
		}
		else
		{
			$("#approve_privacy_error").fadeIn("fast");
			state = false;
		}
		
		if(state == false) {
			$('html, body').animate({
				 scrollTop: $("#create_member_form").offset().top
			}, 800);
			return false;
		}
		return state;
	});
	
});

</script>
<script type="text/javascript">
	$(document).ready(function() {
	
		var MaxInputs       = 8; //maximum input boxes allowed
		var InputsWrapper   = $("#InputsWrapper"); //Input boxes wrapper ID
		var AddButton       = $("#AddMoreFileBox"); //Add button ID
		
		var x = InputsWrapper.length; //Add button ID
		
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

			   $(InputsWrapper).append('<tr><td><h5>'+ Childage +'</h5></td><td><input type="text" class="datepicker date_text" name="children_age[]" id="field_'+ FieldCount +'" value=""></td><td><h5>'+ Childname +'</h5></td><td><input type="text" class="date_text" name="children_name[]" id="field_'+ FieldCount +'" value=""/><a href="#" class="removeclass float_right" style=" font-family: Verdana, Geneva, sans-serif;margin-top: 11px;"> X </a></td></tr>');
				//add input box
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

<script type="text/javascript">
$(document).ready(function(e) {
	
	$('.newsletter_type').change(function(){
		//var c = this.checked ? '#f00' : '#09f';
		var checked =  this.checked;
		
		if(checked)
		{
			$('#newsletter').attr('checked',true);
		}
	});
	
	$('.newsletter_type').change(function(){
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

});
</script>


<style>
body.arabic .white_space
{
	white-space:normal;
}
.registration_banner
{
	width:100%;
	margin-top:10px;
}
.green_color
{
	color: #197C21 !important;
}
.red_color
{
	white-space:normal;
	color: #e82327 !important;
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
#members_password_complexity
{
	border:none;
	background: transparent;
	color: #e82327;
}
.registration_banner .banner .fb_reg_button:active
{
	top:111px;
}
body.arabic .availability_email
{
	position: relative;
	right: -35px;
	top: 8px;
	display:none;
	width: 24px;
}
.availability_email
{
	position: relative;
	right: 35px;
	top: 8px;
	width: 24px;
	display: none;
}
body.arabic .availability_username
{
	position: relative;
	right: -35px;
	top: 8px;
	display:none;
	width: 24px;
}
.availability_username
{
	position: relative;
	right: 35px;
	top: 8px;
	width: 24px;
	display: none;
}
#borthday_box{font-size:12px;}
#borthday_box1{font-size:12px;}
#borthday_box2{font-size:12px;}
.add_child_link{font-size: 11px; color: #666;}
.add_child_link:hover{color:#999;text-decoration:underline;}
#close_field{margin: 13px; font-size: 20px;}
</style>
<div class="registration_banner">
	<div class="horizontal_line terms_conditions_background_color"></div>
	<div class="banner">
    	<img src="<?php echo base_url()."images/mycorner/registeration_banner".$current_language_db_prefix.".jpg"; ?>" />
		
		<?php
        require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '1424984977747397',
  'secret' => 'cb0b67c5019dc5d4886b815cc086449d',
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
	  'scope' => 'public_profile,read_stream,email ,user_birthday ',
	);
	
	$loginUrl = $facebook->getLoginUrl($params);
	  
	  echo '<a class="fb_reg_button" href="'.$loginUrl.'"><img src="'.base_url().'images/mycorner/fb_reg_button'.$current_language_db_prefix.'.png" /></a>';

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
                <div class="circleheader num_of_circle"><?php echo ($current_language_db_prefix == "_ar")?  '١' :  ' 1 '; ?></div>
                <div class="second_border"></div>
                <div class="circleheadersecond num_of_circle" style="color:#CCC;"><?php echo ($current_language_db_prefix == "_ar")?  '٢' :  ' 2 '; ?></div>
                <div class="last_border"></div>
            </div>
            
            <div class="show_the_num">
                
                <p class="num_of_page"><?php echo ($current_language_db_prefix == "_ar")?  '١' :  ' 1 '; ?></p>
            </div>
        		
    		 <div class="clear"></div>
             
		<div class="ineer_form">
        	<?php  
			$attributes = array('class' => '', 'id' => 'create_member_form','name'=>'create_member_form');

			echo form_open_multipart('',$attributes);
			
			if($key != ""){
				?>
                <input type="hidden" name="key" value="<?php echo $key ?>" />
                <?php
			}
			
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
            <p><?php echo lang('mycorner_required_caution'); ?></p>
            <?php
            $data=array('type'=>'hidden' ,'name' => 'email_flag' ,'value' => 0 , 'id' => 'email_flag'); 		 
			echo form_input($data);
			
			$data=array('type'=>'hidden' ,'name' => 'email_facebook_flag' ,'value' => 1 , 'id' => 'email_facebook_flag'); 		 
			echo form_input($data);
			
			$data=array('type'=>'hidden' ,'name' => 'username_flag' ,'value' => 0 , 'id' => 'username_flag'); 		 
			echo form_input($data);
			
			?>
            <!--Member user name-->
	<?php $this->form_validation->set_error_delimiters('<p class="red_color">', '</p>');?> 
             <div style="width:744px;padding: 5px 0;" class="float_left">
              <!--Member first name-->
              <div class="float_left" >
              <label for="user_name" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_username'); ?></label> <br/>
              <?php
			   if($current_language_db_prefix == "_ar")
				{
					echo '<img class="availability_username" src="'.base_url().'images/camera-loader.gif" />';
				}
				
              	$data=array( 'name' => 'username' ,'id' => 'username','AUTOCOMPLETE'=>'off','class'=>'large_text', 'value' => set_value('username'),'onkeypress'=>'return onlyenglishandNumber(event);');                  
              	echo form_input($data);
			  	if(!$current_language_db_prefix == "_ar")
				{
					echo '<img class="availability_username" src="'.base_url().'images/camera-loader.gif" />';
				}

				echo form_error('username');
							  	
			  	echo '<p id="username_error" class="field_error red_color white_space">'. lang("bestcook_field_required").'</p>';
				echo '<p id="username_error2" class="field_error red_color white_space">'.lang("mycorner_caution_username_min").'</p>';
			  	echo '<p id="members_username_validation" class="field_error red_color"></p>'; 
			  	echo '<p id="members_username_format_error" class="field_error red_color white_space">'.lang('mycorner_unavailable_username').'</p>';
			  ?>
              </div>
             </div>
             
			 <div style="width:744px;padding: 5px 0;" class="float_left">
              <!--Member first name-->
              <div class="float_left" >
              <label for="user_name" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_firstname');?></label> <br/>
              <?php
              $data_input_val = empty($member_fb_first_name) ? set_value('first_name') : $member_fb_first_name ;
              
              $data=array( 'name' => 'first_name' ,'id' => 'first_name','class'=>'large_text' , 'value' => $data_input_val,'onkeypress'=>'return onlyAlphabets(event,this);');                  
              echo form_input($data);	
			 // echo '<p class="field_error red_color">'. form_error('first_name') .'</p>';
			  echo form_error('first_name'); 
			  
			  echo '<p id="first_name_error" class="field_error red_color">'. lang("bestcook_field_required").'</p>';
			  ?>
              </div>
              <!--Member last name-->
              <div class="float_right">
              <label for="user_name" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_lastname');?></label> <br/>
              <?php
              $data_input_val = empty($member_fb_last_name) ? set_value('last_name') : $member_fb_last_name ;
              
              $data=array( 'name' => 'last_name' ,'id' => 'last_name','class'=>'large_text' , 'value' => $data_input_val,'onkeypress'=>'return onlyAlphabets(event,this);');                  
              echo form_input($data);	
			  //echo '<p class="field_error red_color">'. form_error('last_name') .'</p>';
			  echo form_error('last_name'); 
			  
			  echo '<p id="last_name_error" class="field_error red_color">'. lang("bestcook_field_required").'</p>';
			  ?>
              </div>
           
           	<div class="clear"></div>
              </div> 
              
            <div style="width:744px;padding: 5px 0;" class="float_left">
             <!--Member Password--> 
                <div class="float_left">
                    <label for="members_password" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_password'); ?></label> <br/>
                     <?php 
					  $data=array( 'name' => 'members_password' , 'id' => 'members_password','AUTOCOMPLETE'=>'off', 'value' => "" ,'class'=>'large_text'); 
					  echo form_password($data);
					 // echo '<p class="field_error red_color">'. form_error('members_password') .'</p>';
					  echo form_error('members_password'); 
					  
					  echo '<p id="members_password_error" class="field_error red_color white_space">'. lang("bestcook_field_required").'</p>'; 
					  echo '<p id="members_password_validation" class="field_error red_color white_space"></p>'; 
					  echo '<p id="members_password_complexity_check"  class="field_error red_color white_space">'. lang("mycorner_caution_password").'</p>';
					  echo '<p id="members_password_complexity" class="white_space"></p>';
					  ?>
                      <input type="hidden" id="members_password_complexity_score" name="members_password_complexity_score" >
                </div>
                 <!--Member Repeat Password--> 
                <div class="float_right">
                    <label for="repeat_password" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_confirmpasssword');?> </label> <br/>
                     <?php 
					  $data=array( 'name' => 'repeat_password' , 'id' => 'repeat_password','AUTOCOMPLETE'=>'off', 'value' => "" ,'class'=>'large_text'); 
					  echo form_password($data);
					 // echo '<p class="field_error red_color">'. form_error('repeat_password') .'</p>';
					  echo form_error('repeat_password'); 
					  
					  echo '<p id="repeat_password_error" class="field_error red_color white_space">'. lang("bestcook_field_required").'</p>'; 
					  echo '<p id="repeat_password_identical_error" class="field_error red_color white_space">Password Not Identical</p>'; 
					  ?>
                    
                </div>
                <div class="clear"></div>
                
            </div> <!--end of second div password-->
                
                
                  <div style="width:749px;padding: 5px 0;" class="float_left">
                   <!--Member Email--> 
                	<div class="float_left">
                    
                    	<label for="members_email" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_email');?></label> <br/>
                         <?php 
							 if($current_language_db_prefix == "_ar")
							 {
								 echo '<img class="availability_email" src="'.base_url().'images/camera-loader.gif" />';
							 }
							 
							$data_input_val = empty($member_fb_email) ? set_value('members_email') : $member_fb_email ;
							 
							$data=array( 'name' => 'members_email' ,  'id' => 'members_email' ,'class'=>'large_text' , 'value' => $data_input_val); 			 
							echo form_input($data);
							if(!$current_language_db_prefix == "_ar")
							{
								echo '<img class="availability_email" src="'.base_url().'images/camera-loader.gif" />';
							}
							
							//echo '<p class="field_error red_color">'. form_error('members_email') .'</p>';
						    echo form_error('members_email'); 
							echo '<p id="members_email_error" class="field_error red_color white_space">'. lang("bestcook_field_required").'</p>';
							echo '<p id="members_email_validation" class="field_error red_color white_space"></p>'; 
							echo '<p id="members_email_format_error" class="field_error red_color white_space">'.lang('globals_lform_not_vaild_format').'</p>'; 
							?>
                         

                    </div>
                     <!--Member Mobile--> 
                    <div class="float_right">
                    	<label for="members_mobile" class="fontweight"><span style="color:red">*</span><?php echo lang('mycorner_mobile');?></label> <br/>
                        <?php                        
						  $mobil_data=array( 'name' => 'members_mobile' ,'maxlength' => '11','class'=>'large_text', 'id' => 'mobile_number', value => set_value('members_mobile'),'onkeypress'=>'return isNumberKey(event)');                  
						  echo form_input($mobil_data);	
						  
						  echo '<p class="field_error red_color">'. lang('mycorner_caution_mobile') .'</p>';
						  echo form_error('members_mobile'); 
						  
						  echo '<p id="mobile_number_error" class="field_error red_color">'. lang("bestcook_field_required").'</p>';
						?>
                    </div>
                    <div class="clear"></div>
                	
                </div> <!--end of third div password-->
                
                	<div class="clear"></div>
                
            	<div class="img_birthday">
                 <!--Member Birthday--> 
                <div class="float_left" style="width:400px;">
                    <label for="day" class="fontweight"><?php echo lang('mycorner_birthdate');?>  </label> <br/>
                     <?php 
                    $data=array( 'name' => 'members_birthdate' , 'id' => 'datepicker', 'class' => 'large_text datepicker' , 'value' => $member_fb_birthday, 'readonly'=> 'readonly'); 		 
           		   echo form_input($data); 
             		?>
                 </div>
                 <div class="imgcontainer float_right">
                  <!--Member Language--> 
                    <label for="day" class="fontweight"> <?php echo lang('mycorner_chose_lang');?> </label> <br/>
                    
                    <div style="width:200px;margin-top: 10px;padding: 5px 0;" class="float_left"> 
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
                    
				 <!--end of birthdate and language-->
                    <?php /*?><div class="float_left" style="margin-top:20px;">
                     	<label for="martial_status" class="float_left fontweight"> <?php echo lang('mycorner_marital_status'); ?></label>
						<?php
                            echo form_dropdown('members_relationship_id', $relationship, 'class="small_text"');
                         ?>
                     </div><?php */?>
                     	<div class="clear"></div>
                     
                    
                     
                    <div class="float_left">
                 
                    <?php 
					$data = array( 'name' => 'newsletter' ,'id'=>'newsletter' , 'class' => 'float_left checkbox',  'value' => 1,);
					echo form_checkbox($data);
					?>
                    <label style="font:inherit;margin-right:9px;line-height:30px;"><?php echo lang('mycorner_updates');?> </label>
                	</div>
                    <div class="clear"></div>
                            
                    
                    <div class="float_left">
                        <div class="triangleboxshadow float_left" style=""></div>
                    <div class="box_shadow float_left">
                        <p style="text-align:center;white-space:normal;"><?php echo lang('mycorner_receive_information');?></p>
                            
                   <table width="550" border="0" class="float_left direction">
					  <?php
                      for($i = 0; $i<sizeof($newsletter); $i++)
                      {
                          $newsletter_id = $newsletter[$i]['newsletter_types_ID'];
                          $newsletter_name = $newsletter[$i]['newsletter_types_title'.$current_language_db_prefix];
                          echo '<tr><td>';
                          $data = array('name'  => 'newsletter_members_members_id[]','class' => 'newsletter_type','value'  => $newsletter_id,'checked' => FALSE);
                          echo form_checkbox($data);
                          echo '<label for="newsletter_type">'.$newsletter_name.'</label>';
            
                          echo '</td></tr>';
                      }
                          echo '<tr id="month" style="display:none">';
						  echo '<td style="width:60px;">'.lang('mycorner_pregnancy_month').'';
						  echo '<select name="baby_month" id="baby_month" style="width: 60px;margin: 0px 20px;">';
								//echo '<option value="">اختارى شهر الحمل</option>';
							  for($i=0 ; $i<=8;$i++)
							  {
								  if($i == 0){
								  echo '<option value="'.($i).'" ></option>';
								  }else{
								  echo '<option value="'.($i).'" >'.($i).'</option>';
								  }
							  }
							  echo '</select>';	
						  echo '</td></tr>';
						  echo '<tr><td><p id="pregnancy_month_error" class="field_error">'. lang("bestcook_field_required").'</p></td></tr>';
						     
                      ?>                       
                    </table>
                   
                    </div>  <!--end of box shadow-->
                         
                  </div>
                           
                <div class="clear"></div> 
                
                <!--Member Chidern-->
                <!--<div id="third_row" class="baby_birthday1"><div class="float_left m_10_5" style=" width:720px; "><table id="InputsWrapper" width="100%" border="0" class="float_left direction"></table><table width="100%" border="0" class="float_left direction"><tr><td class="small"><div><a href="#" id="AddMoreFileBox" class="mycorner_button" ><?php //echo lang('mycorner_add_child');?></a></div></td></tr></table></div><div class="clear"></div></div>-->
                        
            	<div class="float_left">
                	<?php
					$data = array( 'name' => 'approve_privacy' ,'id' => 'approve_privacy' ,'class' => 'float_left checkboxsecond',);
					echo form_checkbox($data);
					 ?>
                     <h2 style="font-size:20px;"> <?php echo lang('mycorner_approve');?></h2>
                     	
         			 <p class="float_left" style="white-space:normal;font-weight:bold;">
                   <?php echo lang('mycorner_register_approve');?> <span class="red"><a target="_blank" href="<?php echo site_url("terms_conditions");?>"><?php echo lang('mycorner_terms_conditions');?></a>
                   </span> <?php echo lang('mycorner_and');?> <span class="red"> <a  target="_blank" href="<?php echo site_url("privacy_policy");?>"> <?php echo lang('mycorner_privacypolicy');?></a></span>
                    <?php echo lang('mycorner_required');?>
                        <span class="red"><?php echo lang('mycorner_fill_all_info');?></span>
                     </p>
                </div>
            			<div class="clear"></div>
                         <?php
                        echo form_error('approve_privacy');
						
						echo '<p id="approve_privacy_error" class="field_error">'. lang("mycorner_must_approve").'</p>';
						
						?>
        		
              <div  class="float_right">
              	
                <div> 
					<?php
                        $data = array('name' => 'register','class' => 'mycorner_button');
                        echo  form_submit($data,lang('mycorner_register'));
                     ?>
                      
                </div>
               </div>
              <div class="clear"></div>
             <?php  echo form_close(); ?>   
       </div> <!-- End OF ineer_form -->
   
    	</div><!-- End OF container -->
        
			</div>	<!-- End OF inner body -->
	
    	</div> 	<!-- End OF white background -->



<script>
$(document).ready(function(e) {
	//$("#third_row").hide();
$( ".newsletter_type[value=6]" ).live("change",function(){
	var item = $(this);
	var checked =  this.checked;
		if(checked)
		{
			item.parent().append('<div id="baby_birthday1" class="float_left" style=" width:720px; "><table id="InputsWrapper" width="100%" border="0" class="float_left direction"></table><table width="100%" border="0" class="float_left direction"><tr><td class="small"><div><a href="#" id="AddMoreFileBox" class="add_child_link" ><?php echo lang('mycorner_add_child');?></a></div></td></tr></table></div><div class="clear"></div>');
			item.parent().append('<div id="borthday_box1"><tr><td><?php echo lang('mycorner_child_age'); ?></td><td><input style="width:120px;border-radius: 8px;margin:0 7px;" type="text" class="datepicker child_age" name="children_age[]" id="field_'+ x +'" value=""></td></tr> <tr><td><?php echo lang('mycorner_child_name'); ?></td><td><input style="width:120px;border-radius: 8px;margin:0 7px;" type="text" class="child_name" name="children_name[]" id="field_'+ x +'" value=""/><a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');
			$("#borthday_box2").remove();
			$("#baby_birthday2").remove();
		}else{
			$("#baby_birthday1").remove();
			$("#borthday_box1").remove();
		}
});

$( ".newsletter_type[value=5]" ).live("change",function(){
	var item = $(this);
	var checked =  this.checked;
		
		if(checked)
		{
			item.parent().append('<div id="baby_birthday2" class="float_left" style=" width:720px; "><table id="InputsWrapper" width="100%" border="0" class="float_left direction"></table><table width="100%" border="0" class="float_left direction"><tr><td class="small"><div><a href="#" id="AddMoreFileBox" class="add_child_link" ><?php echo lang('mycorner_add_child');?></a></div></td></tr></table></div><div class="clear"></div>');
			item.parent().append('<div id="borthday_box2"><tr><td><?php echo lang('mycorner_child_age'); ?></td><td><input style="width:120px;border-radius: 8px;margin:0 7px;" type="text" class="datepicker child_age" name="children_age[]" id="field_'+ x +'" value=""></td></tr><tr><td><?php echo lang('mycorner_child_name'); ?></td><td><input style="width:120px;border-radius: 8px;margin:0 7px;" type="text" class="child_name" name="children_name[]" id="field_'+ x +'" value=""/><a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');
			$("#baby_birthday1").remove();
			$("#borthday_box1").remove();
		}else{
			$("#baby_birthday2").remove();
			$("#borthday_box2").remove();
		}
	
});
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

$('#first_name').change(function(e) {
		var first_name = $(this).val();
		if(first_name === ""){
			$("#first_name_error").fadeIn("fast");
			state = false;
		}else{
			$("#first_name_error").fadeOut("fast");
		}
});

$('#last_name').change(function(e) {
	var last_name = $(this).val();
		if(last_name === ""){
			$("#last_name_error").fadeIn("fast");
			state = false;
		}else{
			$("#last_name_error").fadeOut("fast");
		}
});

$('#members_password').change(function(e) {
		var members_password = $(this).val();
		if(members_password === ""){
			$("#members_password_error").fadeIn("fast");
			$('#members_password_validation').fadeOut("fast");
			state = false;
		}else{
			$("#members_password_error").fadeOut("fast");
			$('#members_password_validation').fadeIn("fast");
		}
});

$('#repeat_password').change(function(e) {
	  var repeat_password = $(this).val();
		if(repeat_password === ""){
			$("#repeat_password_error").fadeIn("fast");
			state = false;
		}else{
			$("#repeat_password_error").fadeOut("fast");
		}
});


/*
$('#mobile_number').change(function(e) {
		  var mobile_number = $(this).val();
		if(mobile_number === ""){
			$("#mobile_number_error").fadeIn("fast");
			state = false;
		}else{
			$("#mobile_number_error").fadeOut("fast");
		}
});*/

$('#baby_month').change(function(e) {
		var baby_month = $(this).val();
		if(baby_month === ""){
			$("#pregnancy_month_error").fadeIn("fast");
			state = false;
		}else{
			$("#pregnancy_month_error").fadeOut("fast");
		}
});

});
</script>