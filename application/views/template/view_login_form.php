<style>
.mainheader_wrapper 
{
	width: 41% !important;
	height: 100px;
	margin: 0 29%;
}
.input_form_login
{
	width:200px;
}

</style>
<script>
$(document).ready(function(e) {
    $('#loginform').submit(function(e) {
		
		var state = true;
		$(".field_error").hide();
		
		if( $("#email_form").val() == "" )
		{
			$("#email_form_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#password_form").val() == "" )
		{
			$("#password_form_error").fadeIn("fast");
			state = false;
		}
		
		return state;
        
    });
});
</script>


<div class="global_sperator_height" style="width:100%"></div>
<div id="mainheader_wrapper" class="mainheader_wrapper" style="height:160px;">
    <div class="main_member_area_wrapper" id="login_register_container"> 
        <div id="login_wrapper" style="width:450px">
            <div class="login_form float_right" style="width:auto;">
             <?php
			 	$data = array('class' => '', 'id' => 'loginform');
			    echo form_open('my_corner/validate',$data) ?>
                    <input type="hidden" name="redirect" value="<?php echo current_url(); ?>" />
                    <table>
                    	<tr>
                        	
                            <td class="float_right"><input type="password" id="password_form" class="input_form_login input_text" name="password" AUTOCOMPLETE="off" placeholder="<?php echo lang('globals_lform_password'); ?>"></td>
                        	<td class="float_left"><input style="width:210px" type="text" id="email_form" class="input_form_login input_text" name="email" AUTOCOMPLETE="off" placeholder="<?php echo lang('globals_lform_email'); ?>"></td>
                            <div class="clear"></div>
                        </tr>
                        <tr>
                        	
                            <td class="float_right"><?php echo '<p id="password_form_error" class="field_error">'. lang("globals_required_password").'</p>'; ?></td>
                        	<td class="float_left"><?php echo '<p id="email_form_error" class="field_error">'. lang("globals_required_email").'</p>'; ?></td>
                            <div class="clear"></div>
                        </tr>
                   </table>
                                  
                <div class="float_right" style="width: 442px;margin-top: 5px;">
                    <a class="fancybox fancybox.ajax float_right" style="font-size: 14px;padding: 5px;line-height: 33px;" href="<?php echo site_url('my_corner/forgot_your_password'); ?>"><?php echo lang('globals_lform_forgot_your_password'); ?></a></td>
                    <div class="float_left">
                        <a class="float_right" style="padding: 2px 4px" href="<?php echo site_url("my_corner/create_my_corner");?>"><button type="button" name="register" class="sing_up"><?php echo lang('globals_lform_signup'); ?></button></a>
                        <button type="submit" style="padding: 3px 22px;margin: 4px;" name="submit" class="sing_in float_left"><?php echo lang('globals_lform_signin'); ?></button>
                    	<div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>       
                <div class="clear"></div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<div class="global_sperator_height" style="width:100%"></div>