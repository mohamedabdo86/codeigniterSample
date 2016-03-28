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
	width:550px;
	position:relative;
	
}
body.arabic #newsletter_form_main_wrapper
{
	direction:rtl;
}
#newsletter_form
{
	width:100%;
}
#newsletter_form th
{
	width:25%;
}
#newsletter_form td
{
	width:25%;
}
#newsletter_loadable_message
{
	white-space:normal;
}

</style>
<script>
$( document ).on( "pageinit", function() {    	 	     
    $( "#externalpage" ).on({
        popupbeforeposition: function( event, ui ) {  
            console.log( event.target );
        }
    });
});
</script>
<script>
$(document).ready(function(e) {
	
	$("#newsletter_add_email").submit(function(e) {
		//e.preventDefault();
        $('#newsletter_loadable_message').hide();
		var state = new Boolean();
		state = true;
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test(document.newsletter_add_email.newsletter_email.value) == false)
		{
			$('#newsletter_loadable_message').html("<?php echo lang("newsletter_validate_email_format"); ?>");
			$('#newsletter_loadable_message').fadeIn("slow");
			document.newsletter_add_email.newsletter_email.focus();
			state = false;	
			
		}
		if(document.newsletter_add_email.newsletter_email.value == "")
		{
			$('#newsletter_loadable_message').html("<?php echo lang("newsletter_validate_email_empty"); ?>");
			$('#newsletter_loadable_message').fadeIn("slow");
			document.newsletter_add_email.newsletter_email.focus();
			state = false;			
		}
		
		if(state)
		{
			$('#newsletter_loadable_message').fadeIn("slow").html("<?php echo lang("newsletter_please_wait"); ?>");
			$.ajax({
				  url:  "<?php echo  site_url("newsletter/add_data_action"); ?>",
				  type: "POST",
				  data: $('#newsletter_add_email').serialize(),
				  cache: false,
				  dataType: "json",
				  success: function(success_array)
				  {
					
					  //alert("success"+success_array.status);
					  if(success_array.status == 1)
					  {
						  $('#newsletter_loadable_message').fadeIn("slow").html("<?php echo lang("newsletter_validate_status_1"); ?>");
					  }
					  if(success_array.status == 0)
					  {
						  $('#newsletter_loadable_message').fadeIn("slow").html("<?php echo lang("newsletter_validate_status_0"); ?>");
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
    
    <div data-role="popup" id="externalpage">
    <iframe src="http://www.bbc.com" width="480" height="320" seamless></iframe>
</div>




<h2 class="newsletter_service float_left"><?php echo lang('newsletter_service'); ?></h2>
<form name="newsletter_add_email" id="newsletter_add_email" >


<?php echo lang("newsletter_title"); ?>
<?php echo $title ?>

<?php echo lang("newsletter_enter_email"); ?>
<input type="text" name="newsletter_email" />



<?php echo lang('newsletter_pregnancy_month'); ?>
<select name="baby_month" id="baby_month" style="width: 182px;">
<?php
 for($i=0 ; $i<=8;$i++)
  {
	  echo '<option value="'.($i+1).'" >'.($i+1).'</option>';
  }

?>
</select>

<input type="hidden" name="newsletter_type" value="<?php echo $id; ?>" />
<input type="submit" class="newsletter_submit" value="<?php echo lang('newsletter_send_button'); ?>" />


<div id="newsletter_loadable_message"></div>


</form>
</div>