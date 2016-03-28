<?php	

	if($member_data[0]['nestle_fit_health_mail'] == '')
	{
		$mail = $this->members->members_email;
	}
	else
	{
		$mail = $member_data[0]['nestle_fit_health_mail'];
	}
	
	if($member_data[0]['nestle_fit_health_daily_notifications'] == '' or $member_data[0]['nestle_fit_health_daily_notifications'] == '0')
	{
		$daily_checked= FALSE;
	}
	else if($member_data[0]['nestle_fit_health_daily_notifications'] == '1')
	{
		$daily_checked = TRUE;
	}
	
	if($member_data[0]['nestle_fit_health_weekly_notifications'] == '' or $member_data[0]['nestle_fit_health_weekly_notifications'] == '0')
	{
		$weekly_checked= FALSE;
	}
	else if($member_data[0]['nestle_fit_health_weekly_notifications'] == '1')
	{
		$weekly_checked = TRUE;
	}

	$user_img_url = base_url()."uploads/members/".$this->members->members_image;
	$nestle_fit_health_member_id = $member_data[0]['nestle_fit_health_ID'];
?>
<style>
.fancybox-wrap
{
	width: 550px !important;
	height: 430px !important;
}
.fancybox-inner
{
	width: 520px !important;
	height: 400px !important;
	overflow:hidden !important;
}
#nestle_fit_newsletter
{
	width:520px;
	height:400px;
}
#newsletter_img_container
{
	text-align:center;
	margin-bottom:10px;
}
#newsletter_img_container img
{
	width:150px;
	height:150px;
	border-radius: 50%;
	-moz-border-radius:50%;
	-webkit-border-radius:50%;
}
#newsletter_title
{
	width: 100%;
	background-color: #b6b8b8;
	height: 45px;
	text-align:center;
}
#newsletter_title h3
{
	font-size:16px;
	line-height:67px;
}
#newsletter_title h3 img
{
	padding: 5px;
}

#newsletter_title h3 span
{
	padding: 5px;
	position: relative;
	bottom: 13px;
}
#newsletter_form_container
{
	margin-top:10px;
}
.button_style
{
	-webkit-border-radius: 16px;
	-moz-border-radius: 16px;
	border-radius: 16px;
	display:inline-block;
	color:#ffffff;
	font-size:15px;
	line-height:20px;
	font-weight:bold;
	padding: 10px 22px;
	text-align:center;
	margin-top:25px;
}
.button_style:active
{
	position:relative;
	top:1px;
}
#submit_notification 
{
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #b8b8b8), color-stop(1, #c9c5c9) );
	background:-moz-linear-gradient( center top, #b8b8b8 5%, #c9c5c9 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#b8b8b8', endColorstr='#c9c5c9');
	border:1px solid #dcdcdc;
	background-color:#b8b8b8;
}
#submit_notification:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #c9c5c9), color-stop(1, #b8b8b8) );
	background:-moz-linear-gradient( center top, #c9c5c9 5%, #b8b8b8 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#c9c5c9', endColorstr='#b8b8b8');
	background-color:#c9c5c9;
}
</style>
<script>
$(document).ready(function(e) {
    
	$("#notification_form").submit(function(e) {
		var state = true;
		$(".field_error").hide();
		
		var mail = $("#nestle_fit_health_mail").val();
		
		if(mail = "" )
		{
			$("#nestle_fit_health_mail_required").fadeIn("fast");
			state = false;
		}
	
		if(mail != "" )
		{
			 var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			 if( !emailReg.test($("#nestle_fit_health_mail").val() ) ) 
			 {
				  $("#nestle_fit_health_mail_format_error").fadeIn("fast");
				  state = false;
			 } 
		}
		return state;
	
	});
	
});
</script>

<div id="nestle_fit_newsletter">

    <div id="newsletter_img_container">
    	<img src="<?php echo $user_img_url;  ?>" >
    </div>
    
     <div id="newsletter_title">
        <h3 class="white_color"><img id="ask-img" src="<?php echo base_url() . "images/nestle_fit/email_icon.png"; ?>"/><span><?php echo lang('nestlefit_remember_me'); ?></span></h3>
    </div>
    
    <div id="newsletter_form_container" class="dir">
    <?php
    $attributes = array('class' => '', 'id' => 'notification_form');
    echo form_open_multipart('ajax/best_life_update_notifications',$attributes);
    ?>
	<input type="hidden" value="<?php echo $nestle_fit_health_member_id ?>" name="nestle_fit_health_member_id"  />
 	<label class="form_label"><?php echo lang('cooking_class_email')?></label>
    <input class="form_input_larg" name="nestle_fit_health_mail" id="nestle_fit_health_mail" value="<?php echo $mail;?>" id="best_life_mail" type="text" style="height: 30px;margin: 8px;">
   
    <?php echo '<p id="nestle_fit_health_mail_format_error" class="field_error">'.lang('globals_lform_not_vaild_format').'</p>'; ?>
    <?php echo '<p id="nestle_fit_health_mail_required" class="field_error">'.lang('globals_field_required').'</p>'; ?>

    <div style="width:515px; height:45px;">
    <?php
    
    $daily = array(
        'name'        => 'daily_notification',
        'id'          => 'daily_notification',
        'value'       => '1',
        'checked'       => $daily_checked,
        'style'       => 'margin:10px',
        );
    
    echo form_checkbox($daily);
	echo '<label class="form_label">'.lang('nestlefit_daily_notification').'</label>';
    
    echo '<br>';
    
    
    $weekly = array(
        'name'        => 'weekly_notification',
        'id'          => 'weekly_notification',
        'checked'     => $weekly_checked,
        'value'       => '1',
        'style'       => 'margin:10px',
        );
    
    echo form_checkbox($weekly);
	echo '<label class="form_label">'.lang('nestlefit_weekly_notification').'</label>';
   
    ?>
    </div>
    
  
	<?php
        
            $data = array('name' => 'submit','id' => 'submit_notification','class' => 'button_style float_right');
            echo  form_submit($data,lang('globals_send'));
            
            echo form_close();
    ?>   
	</div><!--End of form-->
</div>
<div class="clear"></div>

