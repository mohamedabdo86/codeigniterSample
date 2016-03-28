<style>
.fancybox-skin{
padding: 0px !important; 
width: auto;
height: auto;
}
.fancybox-inner{
	overflow:hidden !important;
}
.newsletter_submit{
text-align: center;
cursor: pointer;
width: 80px;
background: #AFAFAF;
color: #fff;
border-radius: 10px;
padding: 5px;
}
.newsletter_submit:hover{
color:#666;
background: #EEE;
border:1px solid $ccc;
}
.newsletter_service{
margin: 0px 29px 10px 29px;
background: #ccc;
padding: 10px;
-webkit-border-bottom-right-radius: 10px;
-webkit-border-bottom-left-radius: 10px;
-moz-border-radius-bottomright: 10px;
-moz-border-radius-bottomleft: 10px;
border-bottom-right-radius: 10px;
border-bottom-left-radius: 10px;
color: #fff;
text-align: center;
<?php
if($current_language_db_prefix != "_ar"){
	?>
	border-bottom-left-radius: 0px;
	border-bottom-right-radius: 12px;
	<?php
}
?>
}

#newsletter_form_main_wrapper
{
	width:580px;
	position:relative;
	height:300px;
}
body.arabic #newsletter_form_main_wrapper
{
	direction:rtl;
}
#newsletter_form
{
	width:90%;
}
#newsletter_form th
{
	width:25%;
}
#newsletter_form td
{
	width:40%;
}
#newsletter_loadable_message
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
.registration_banner .banner .fb_reg_button:active
{
	top:111px;
}


#members_password_complexity
{
	border:none;
	background: transparent;
	color: #e82327;
}
.message{margin-right: 255px; color:#030;}

</style>
<script>
$(document).ready(function(e) {
	$("#members_password").keyup(function(){
    	var passwd = $("#members_password").val();
		
		var intScore   = 0
		var strVerdict = "";
		
		if (passwd.length<5)                         // length 4 or less
		{
			intScore = (intScore+3)
		}
		else if (passwd.length>4 && passwd.length<8) // length between 5 and 7
		{
			intScore = (intScore+6)
		}
		else if (passwd.length>7)// length 8 or more
		{
			intScore = (intScore+12)
		}
		/*else if (passwd.length>20)                    // length 16 or more
		{
			intScore = (intScore+18)
		}*/
		
		// LETTERS (Not exactly implemented as dictacted above because of my limited understanding of Regex)
		if (passwd.match(/[a-z]/))                              // [verified] at least one lower case letter
		{
			intScore = (intScore+1)
		}
		
		if (passwd.match(/[A-Z]/))                              // [verified] at least one upper case letter
		{
			intScore = (intScore+5)
		}
		
		// NUMBERS
		if (passwd.match(/\d+/))                                 // [verified] at least one number
		{
			intScore = (intScore+5)
		}
		
		/*if (passwd.match(/(.*[0-9].*[0-9].*[0-9])/))             // [verified] at least three numbers
		{
			intScore = (intScore+5)
		}*/
		
		// SPECIAL CHAR
		if (passwd.match(/.[!,@,#,$,%,^,&,*,?,_,~]/))            // [verified] at least one special character
		{
			intScore = (intScore+5)
		}
									 
		if (passwd.match(/(.*[!,@,#,$,%,^,&,*,?,_,~].*[!,@,#,$,%,^,&,*,?,_,~])/)) // [verified] at least two special characters
		{
			intScore = (intScore+5)
		}
		
		// COMBOS
		if (passwd.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))        // [verified] both upper and lower case
		{
			intScore = (intScore+2)
		}

		if (passwd.match(/([a-zA-Z])/) && passwd.match(/([0-9])/)) // [verified] both letters and numbers
		{
			intScore = (intScore+2)
		}
 
									// [verified] letters, numbers, and special characters
		if (passwd.match(/([a-zA-Z0-9].*[!,@,#,$,%,^,&,*,?,_,~])|([!,@,#,$,%,^,&,*,?,_,~].*[a-zA-Z0-9])/))
		{
			intScore = (intScore+2)
		}
	
		if(intScore < 15)
		{
		   strVerdict = "<?php echo lang('mycorner_very_week_password'); ?>";
		}
		else if (intScore >= 15 && intScore < 27)
		{
		   strVerdict = "<?php echo lang('mycorner_week_password'); ?>";
		}
		else if (intScore >= 27 && intScore < 34)
		{
		   strVerdict = "<?php echo lang('mycorner_medium_password'); ?>";
		}
		else if (intScore >= 34 && intScore < 45)
		{
		   strVerdict = "<?php echo lang('mycorner_good_password'); ?>";
		}
		else
		{
			strVerdict = "<?php echo lang('mycorner_strong_password'); ?>";
		}
		
		$("#members_password_complexity_score").val(intScore);
		$("#members_password_complexity").val(strVerdict);
		
		if(intScore > 33)
		{
			$("#members_password_complexity").addClass('green_color');
		}
		else
		{
			$("#members_password_complexity").removeClass('green_color');
		}
  	});

		
	$("#reset_form").submit(function(e) {
		
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

		if(password == repeat_password)
		{
			if (score < 33 )
			{
				$("#members_password_complexity_check").fadeIn("fast");
				state = false;
			}
			else
			{
				data = $('#reset_form').serialize();
				$.post( "<?php echo site_url($this->router->class.'/change_password'); ?>", data, function( message ){
					if(message == 1){
						$(".ineer_form").html('<h2 class="float_left message"><?php echo lang('mycorner_rest_password_success'); ?></h2><br/><br/>');
						//window.location.replace("<?php echo site_url('welcome'); ?>");
					}else{
						$(".ineer_form").html('<h2 class="float_left message"><?php echo lang('mycorner_rest_password_error'); ?></h2><br/><br/>');
						//window.location.replace("<?php echo site_url('welcome'); ?>");
					}
				});
	
				state = false;
			}
		}
		
		return state;
		//event.preventDefault();
	});
	
});
</script>

<div id="newsletter_form_main_wrapper">
	<h2 class="newsletter_service float_left"><?php echo lang("mycorner_change_your_password"); ?></h2>
    <div>
            <?php
            $attributes = array('class' => '', 'id' => 'reset_form');

			echo form_open_multipart(site_url($this->router->class.'/reset_password'),$attributes);
            ?>
             
		<div class="ineer_form" style="margin:0;">

            <div style="width:530px; margin:10px" class="float_left">
            
             <!--Member Password--> 
                <div class="float_left" style="width:300px; height: 105px;">
                    <label for="members_password" class="fontweight"><?php echo lang('mycorner_password'); ?> </label> <br/>
                     <?php 
					  $data=array( 'name' => 'members_password' , 'id' => 'members_password', 'value' => "" ,'class'=>'date_text'); 
					  echo form_password($data);
					  echo form_error('members_password');
					  echo '<p id="members_password_error" class="field_error white_space">'. lang("bestcook_field_required").'</p>';
					  echo '<p id="members_password_validation" class="field_error white_space"></p>';
					  echo '<p id="members_password_complexity_check" class="field_error white_space">'. lang("mycorner_caution_password").'</p>';
					  echo '<input type="text" class="float_left" id="members_password_complexity" name="members_password_complexity" disabled>';
					  
					  ?>
                </div>
                <input type="hidden" id="members_password_complexity_score" name="members_password_complexity_score" >
                 <!--Member Repeat Password--> 
                <div class="float_right">
                    <label for="repeat_password" class="fontweight"> <?php echo lang('mycorner_confirmpasssword');?> </label> <br/>
                     <?php 
					  $data=array( 'name' => 'repeat_password' , 'id' => 'repeat_password', 'value' => "" ,'class'=>'date_text'); 
					  echo form_password($data);
					  echo form_error('repeat_password');
					  echo '<p id="repeat_password_error" class="field_error">'. lang("bestcook_field_required").'</p>'; 
					  echo '<p id="repeat_password_identical_error" class="field_error">'. lang("mycorner_caution_password_repeat").'</p>'; 
					  echo '<p id="error_message" class="field_error">'. lang('mycorner_caution_password_repeat').'</p>'; 
					  ?>
                    
                </div>
                <div class="clear"></div>
                
            </div> <!--end of second div password-->
                   
            <div class="clear"></div>
                		
              <div  class="float_right" style="margin:10px">
              	
                <div><br/> 
					<?php
                        $data = array('type' => 'submit','name' => 'submit','class' => 'mycorner_button', 'value' =>lang('globals_send') );
                        echo  form_submit($data);
                     ?>
                      
                </div>
               </div>
              <div class="clear"></div>
              
       		</div> <!-- End OF ineer_form -->
            <?php  echo form_close(); ?>  
    	</div>
    
</div>
