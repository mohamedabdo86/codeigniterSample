<link rel="stylesheet" href="<?php echo base_url()."css/main_styles.css"?>"  />
<style>
.fancybox-skin{
padding: 0px !important; 
width: 310px;
height: 215px;
}
.fancybox-inner{
	overflow:hidden !important;
	height: 227px !important;
	width: 310px !important;
}
#mainheader_wrapper
{
	width: 100%;
	height: 215px;
	margin:0;	
}
#loginform
{
	height:133px;
}
#mainheader_wrapper .main_member_area_wrapper
{
	height:162px;
}
#mainheader_wrapper #login_wrapper
{
	height:165px;
}
#mainheader_wrapper #login_wrapper .login_form
{
	height: 148px;
}
.main_member_area_wrapper , #login_wrapper
{
	height:160px;
}
.fancybox-wrap
{
	width: 310px !important;
}

.input_form_login
{
	width:205px;
}
</style>
<script type="text/javascript">

    var parentURL = window.parent.location.href
    $('#redirect').val(parentURL);

</script>
<script>
$(document).ready(function(e) {
    $('#loginform').submit(function(e) {
		
		var state = true;
		$(".field_error").hide();
		
		if( $("#email_form").val() == "" )
		{
			// ayman edit hide members_email_format_error
			//$(".display_none_mail_form").css('display', 'none');
			
			$("#email_form_error").fadeIn("fast");
			state = false;
		}
		
			//if( $("#email_form").val() != "" )
//		{
//			 var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
//			 if( !emailReg.test($("#email_form").val() ) ) 
//			 {
//				  // ayman edit hide email_form_error
//				  $(".display_none_mail").css('display', 'none');
//				  $(".display_none_mail_form").css('display', 'block');
//				  
//				  $("#members_email_format_error").fadeIn("fast");
//				  state = false;
//			 } 
//		}
		
		if( $("#password_form").val() == "" )
		{
			$("#password_form_error").fadeIn("fast");
			state = false;
		}
		
		return state;
        
    });
});
</script>
<script type="text/javascript">
    //var parentURL = window.parent.location.href;
	var parentURL = window.location.href.split('?')[0];
	$("#loginform").append("<input type='hidden' name='redirect' value='"+ parentURL +"' />");
</script>

<div id="mainheader_wrapper" class="mainheader_wrapper dir">
    <div class="main_member_area_wrapper" id="login_register_container"> 
        <div id="login_wrapper" style="width:310px">
            <div class="login_form float_right" style="width: 310px;">
             <?php
			 	$data = array('class' => '', 'id' => 'loginform');
			    echo form_open('my_corner/validate',$data) ?>
                    <input type="hidden" name="redirect" value="<?php echo current_url(); ?>" />
                    <table class="float_left dir">
                    	<tr align="center">
                            <td ><input style="width:270px" type="text" id="email_form" class="input_form_login input_text" name="email" AUTOCOMPLETE="off" placeholder="<?php echo lang('globals_lform_email'); ?>"></td>
                        	<div class="clear"></div>
                        </tr>
                        <tr align="center">
                        	<td ><?php echo '<p id="email_form_error" class="field_error">'. lang("globals_required_email").'</p>'; ?></td>
                            <!--<td > <?php //echo '<p id="members_email_format_error" class="field_error red_color white_space">'.lang('globals_lform_not_vaild_format').'</p>';?> </td>-->   
                            <div class="clear"></div>
                        </tr>
                        <tr align="center">
                        	<td ><input style="width:270px" type="password" id="password_form" class="input_form_login input_text" name="password" AUTOCOMPLETE="off" placeholder="<?php echo lang('globals_lform_password'); ?>"></td>
                            <div class="clear"></div>
                        </tr>
                        <tr align="center">
                        	<td ><?php echo '<p id="password_form_error" class="field_error">'. lang("globals_required_password").'</p>'; ?></td>
                        	<div class="clear"></div>
                        </tr>
                   </table>
                                  
                <div class="float_right" style="width: 310px;margin: 10px;">
                    <div class="float_left">
                        <a class="float_right" style="padding:4px" href="<?php echo site_url("my_corner/create_my_corner");?>"><button type="button" name="register" class="sing_up"><?php echo lang('globals_lform_signup'); ?></button></a>
                        <button type="submit" style="padding: 3px 22px;margin: 4px;" name="submit" class="sing_in float_left"><?php echo lang('globals_lform_signin'); ?></button>
                    	<div class="clear"></div>
                    </div>
                    <a class="fancybox fancybox.ajax float_left" style="font-size: 14px;padding: 5px;line-height: 33px;" href="<?php echo site_url('my_corner/forgot_your_password'); ?>"><?php echo lang('globals_lform_forgot_your_password'); ?></a></td>
                    
                    <div class="clear"></div>
                </div>       
                <div class="clear"></div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<div class="global_sperator_height" style="width:100%"></div>