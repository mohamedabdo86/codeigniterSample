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
<script>
$(document).ready(function(e) {
    
	$("#notification_form").submit(function(e) {
	
		var state = true;
		$(".field_error").hide();
		
		var mail = $("#nestle_fit_health_mail").val();
		
		if(mail == "" )
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
<style>
.fancybox-inner
{
	width: 100% !important;
	overflow:hidden !important;
	  
}
.float{
float:right;	
}

.english .float{
float:left;	
}
#weekly_notification , #daily_notification{
margin-right: 20px;
}

.english #weekly_notification , .english #daily_notification{
margin-left: 20px;
}

@media (max-width: 414px){.fancybox-inner{height: 400px !important;}}
@media (max-width: 735px) and (min-width: 415px){.fancybox-inner{height: 430px !important;}}
@media (max-width: 799px) and  (min-width: 736px){.fancybox-inner{height: 570px !important;}}
@media (min-width: 800px){.fancybox-inner{height: 570px !important;}}
</style>
<div class="row">
  <div id="ask_exper_contanier" class="col-xs-2 col-xs-offset-5">
   <img src="<?php echo $user_img_url;  ?>" class="img-responsive" style="margin-bottom: 10px;"/> 
   </div>
  <div id="ask_title" class="col-xs-12 col-sm-12 col-md-12">
    <div class="col-xs-10">
      <h3 style="margin: 12px 0px; width: 80%;"><?php echo lang('nestlefit_remember_me'); ?></h3>
    </div>
    <div class="col-xs-2"> <img id="ask-img" src="<?php echo base_url() . "images/nestle_fit/email_icon.png"; ?>" class="img-responsive" style="padding-top: 5px;"/> </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4 form-position">
  
  <?php  $attributes = array('class' => 'form-inline dir', 'id' => 'notification_form' ,'role'=>'form' , 'data-ajax'=>'false');
    echo form_open_multipart('ajax/best_life_update_notifications_mobile',$attributes);?>
    <input type="hidden" value="<?php echo $nestle_fit_health_member_id ?>" name="nestle_fit_health_member_id"  />
    <div class="form-group">
    <label class="control-label" for="nestle_fit_health_mail"><?php echo lang('cooking_class_email')?></label>
    
        <input name="nestle_fit_health_mail" id="nestle_fit_health_mail" value="<?php echo $mail;?>" type="text">
       <?php echo '<p id="nestle_fit_health_mail_format_error" class="field_error">'.lang('globals_lform_not_vaild_format').'</p>'; ?>
       <?php echo '<p id="nestle_fit_health_mail_required" class="field_error">'.lang('globals_field_required').'</p>'; ?>
    
  </div>
  <div class="form-group" style="width: 100%; clear: both;">
    <label class="control-label float" for="nestle_fit_health_mail"><?php echo lang('nestlefit_daily_notification')?></label>
    
      <?php   $daily = array(
        'name'        => 'daily_notification',
        'id'          => 'daily_notification',
        'value'       => '1',
        'checked'       => $daily_checked,
        
        );
    
    echo form_checkbox($daily);?>
   
  </div>
  
   <div class="form-group" style="width: 100%; clear: both;">
    <label class="control-label float" for="nestle_fit_health_mail"><?php echo lang('nestlefit_weekly_notification')?></label>
    
      <?php       $weekly = array(
        'name'        => 'weekly_notification',
        'id'          => 'weekly_notification',
        'checked'     => $weekly_checked,
        'value'       => '1',
        );
    
    echo form_checkbox($weekly);?>
    
  </div>
   <div class="form-group">        
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-push-1 col-md-push-2">
      <?php $data = array('name' => 'submit','id' => 'submit_notification','class' => 'button_style float_right');
            echo  form_submit($data,lang('globals_send'));?>
      </div>
    </div>
     <?php echo form_close();?>
   </div>
</div>
