<style>
.fancybox-skin
{
	padding: 0px !important; 
	width: auto;
	height: auto;
}
.fancybox-inner
{
	overflow:hidden !important;
}


#newsletter_form_main_wrapper
{
	width:550px;
	position:relative;
	height:210px;
}

#newsletter_form #forgot_your_password_email
{
	width:100%;
	height:25px;
}
.newsletter_submit
{
	text-align: center;
	background: #AFAFAF;
	color: #fff;
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
	cursor: pointer;
	padding: 4px 6px;
	position:relative
	line-height: 20px;
}
.newsletter_submit:active
{
	top:1px;
}
.newsletter_submit:hover
{
	color:#666;
	background: #EEE;
	border:1px solid #ccc;
}
#newsletter_loadable_message
{
	white-space:normal;
}

.newsletter_service
{
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

</style>
<script>
$(document).ready(function(e) {

	$('#forgot_your_password_email').hover(function(){
          this.focus();

     });

	$("#forgot_your_password_form").submit(function(e) {
		//e.preventDefault();
        $('#newsletter_loadable_message').hide();
		var state = new Boolean();
		state = true;
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test(document.forgot_your_password_form.forgot_your_password_email.value) == false)
		{
			$('#newsletter_loadable_message').html("<?php echo lang("newsletter_validate_email_format"); ?>");
			$('#newsletter_loadable_message').fadeIn("slow");
			document.forgot_your_password_form.forgot_your_password_email.focus();
			state = false;	
			
		}
		if(document.forgot_your_password_form.forgot_your_password_email.value == "")
		{
			$('#newsletter_loadable_message').html("<?php echo lang("newsletter_validate_email_empty"); ?>");
			$('#newsletter_loadable_message').fadeIn("slow");
			document.forgot_your_password_form.forgot_your_password_email.focus();
			state = false;			
		}
		
		if(state)
		{
			$('#newsletter_loadable_message').fadeIn("slow").html("<?php echo lang("newsletter_please_wait"); ?>");
			$.ajax({
				  url:  "<?php echo  site_url("my_corner/forgot_your_password_action"); ?>",
				  type: "POST",
				  data: $('#forgot_your_password_form').serialize(),
				  cache: false,
				  dataType: "json",
				  success: function(success_array)
				  {
					  //alert("success"+success_array.status);
					  if(success_array.status == 1)
					  {
						  $('#newsletter_loadable_message').fadeIn("slow").html("<?php echo lang("mycorner_rest_password_status_1"); ?>");
					  }
					  if(success_array.status == 0)
					  {
						  $('#newsletter_loadable_message').fadeIn("slow").html("<?php echo lang("mycorner_rest_password_status_0"); ?>");
					  }
					
				  },
				  error: function(xhr, ajaxOptions, thrownError)
				  {
					//alert("wrong"+thrownError);
				  }
				  
			});
		}
		
		return false;
    });
    
});
</script>
<div class="row">
<div id="newsletter_form_main_wrapper" class="dir">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<h2 class="newsletter_service float_left"><?php echo lang("mycorner_forgot_my_password_title"); ?></h2>
 </div>   
 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <form name="forgot_your_password_form" id="forgot_your_password_form"  role="form" class="form-horizontal">
    <div class="form-group">
       <div class="col-sm-4">
       <label for="forgot_your_password_email"> <?php echo lang("mycorner_forgot_my_password_email"); ?></label>
        </div>
          <div class="col-sm-8 forget-focus">
            	<input type="text" id="forgot_your_password_email" size="30" name="forgot_your_password_email"/>
          </div>      
      </div>
            	<div id="newsletter_loadable_message"></div>
            
            	<input type="submit" class="newsletter_submit" value="<?php echo lang('newsletter_send_button'); ?>" />
         
    </form>
  </div> 
</div>
</div>