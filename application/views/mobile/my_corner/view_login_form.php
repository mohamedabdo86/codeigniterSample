<style>
.field_error{
	display:none;
	color:red;
	}
</style>
<script>
$(document).ready(function(e) {
    $('#login_form').submit(function(e) {
		
		var state = true;
		$(".field_error").hide();
		
		if( $("#email").val() == "" )
		{
			$("#email_error").fadeIn("fast");
			state = false;
		}
		
		//if( $("#email").val() != "" )
		//{
			// var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			 //if( !emailReg.test($("#email").val() ) ) 
			 //{
				//  $("#members_email_format_error").fadeIn("fast");
				  //state = false;
			 //} 
		//}
		
		if( $("#password").val() == "" )
		{
			$("#password_error").fadeIn("fast");
			state = false;
		}
		
		return state;
        
    });
});
</script>
<script type="text/javascript">
	var parentURL = window.location.href.split('?')[0];
    $('#redirect-val').val(parentURL);


</script>
<?php 

		 			$attributes = array('class' => '', 'id' => 'login_form', 'data-ajax' => 'false' );
					echo form_open_multipart('mobile/my_corner/validate',$attributes);
	  				?>
                	<p><label for="email"><?php echo lang('globals_lform_email'); ?>:</label><input type="text" id="email" name="email" /></p>
                    <?php echo '<p id="email_error" class="field_error">'. lang("bestcook_field_required").'</p>'; ?>
                    <?php echo '<p id="members_email_format_error" class="field_error red_color white_space">'.lang('globals_lform_not_vaild_format').'</p>';?> 
                    <p><label for="password"><?php echo lang('globals_lform_password'); ?>:</label><input type="password" id="password" name="password" /></p>
                     <?php echo '<p id="password_error" class="field_error">'. lang("bestcook_field_required").'</p>'; ?>
                    <input type="hidden" name="redirect" id="redirect-val" value="" />
                    <input rel="external" class="btn btn-blue" type="submit" style="padding:5px 15px;" value="<?php echo lang("globals_lform_signin"); ?>"/>
                     <a class="fancybox fancybox.ajax" style="font-size: 14px;padding: 5px;color:#666;line-height: 33px;" href="<?php echo site_url("mobile/my_corner/forgot_your_password"); ?>"><?php echo lang('globals_lform_forgot_your_password'); ?></a>
                    <?php 
					echo form_close();
	  				?>