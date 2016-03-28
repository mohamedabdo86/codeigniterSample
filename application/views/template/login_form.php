<script>
$(document).ready(function() {
	$(".various").fancybox({
		maxWidth	: 200,
		maxHeight	: 80,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
	
	$( ".form_intiate" ).click(function() {
  		$( ".form_box" ).slideToggle( "slow" );
		$( ".arrow-up" ).slideToggle( "slow" );
		return false;
	});
});
</script>
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
		
		if( $("#password").val() == "" )
		{
			$("#password_error").fadeIn("fast");
			state = false;
		}
		
		return state;
        
    });
});
</script>
<div id="login_wrapper" class="">
	<div class="login_form float_right">
    <ul>
        <li class="float_right" ><a class="sing_up" href="<?php echo site_url('my_corner/create_my_corner'); ?>"><?php echo lang('globals_lform_signup'); ?></a></li>
    	<li class="float_right" style="margin:0 19px;"><a class="sing_in form_intiate" href="#"><?php echo lang('globals_lform_signin'); ?></a></li>
    </ul>
     <?php 
		 $attributes = array('class' => '', 'id' => 'login_form');
		 echo form_open_multipart('my_corner/validate',$attributes);
	  ?>
     <div class="float_right">
        <div class="arrow-up"></div>
            <div class="form_box">
            <div class="float_right">
            <input type="hidden" name="redirect" value="<?php echo current_url(); ?>" />
            <ul>
            <li><input type="text" id="email" style="width:268px;" class="input_text" name="email" AUTOCOMPLETE="off" placeholder="<?php echo lang('globals_lform_email'); ?>">
             <?php echo '<p id="email_error" class="field_error">'. lang("bestcook_field_required").'</p>'; ?>
            </li>
            <li><input type="password" id="password" style="width:268px;"  class="input_text" name="password" AUTOCOMPLETE="off" placeholder="<?php echo lang('globals_lform_password'); ?>">
            <?php echo '<p id="password_error" class="field_error">'. lang("bestcook_field_required").'</p>'; ?>
            </li>
            <li><button type="submit" name="submit" class="log_in float_right"><?php echo lang('globals_lform_signin'); ?></button>
                <div class="float_left" style="width: 180px;">
                <a class="newsletter_choices_button fancybox fancybox.ajax" style="font-size: 14px;padding: 5px;color:#666;line-height: 33px;" href="<?php echo site_url("my_corner/forgot_your_password"); ?>"><?php echo lang('globals_lform_forgot_your_password'); ?></a></td>
                <div class="" style="float:right">
                    
                </div>
                <div class="clear"></div>
            </div>
            </li>
            <div class="clear"></div>
            </ul>
    
            </div>
            <div class="clear"></div>
            
            </div>
            <div class="clear"></div>
        </div>
		<div class="clear"></div>
        <?php echo form_close(); ?>
	</div>
    <div style="width:215px;" class="banner float_right">
    	<?php /*?><img src="<?php echo base_url(); ?>images/login_banner.png"/><?php */?>
        <?php
		$get_whyjoin_slideshows = $this->globalmodel->get_whyjoin_slideshow($current_language_db_prefix);
		?>
        <ul class="gallery clearfix">
        <?php
		for($i = 0 ;$i < sizeof($get_whyjoin_slideshows) ; $i++):
		$image = base_url()."uploads/slideshows/".$get_whyjoin_slideshows[$i]['images_src'];
			?>
            <li><a href="<?php echo $image; ?>" rel="prettyPhoto[gallery4]"  ><img style="border:none;" src="<?php echo base_url(); ?>images/login_banner<?php echo $current_language_db_prefix; ?>.png"/></a></li>
            <?php
		endfor;
		?>
			</ul>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>

