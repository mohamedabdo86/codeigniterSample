<!--Date picker-->
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

	<script>
		$(function(){
			$( ".date-input-css" ).datepicker({
       changeMonth: true,
      	changeYear: true,
	  	yearRange: '1950:2014',
	  	dateFormat: 'yy-mm-dd',
		});	
		});
	</script>





<script type="text/javascript">
$(document).ready(function(e) {
	
	

	$('#username').change(function(e) {
		var username = $(this).val();
		if(username === ""){
			$("#username_error").fadeIn("fast");
			state = false;
		}else{
			$("#username_error").fadeOut("fast");
		}
	});
	
	$('#members_email').change(function(e) {
			var members_email = $(this).val();
			if(members_email === "")
			{
				$("#members_email_validation").fadeOut("fast");
				$("#members_email_format_error").fadeOut("fast");
				$("#members_email_error").fadeIn("fast");
				state = false;
			}
			else
			{
				$("#members_email_validation").fadeOut();
				$("#members_email_error").fadeOut("fast");
			}
	});
 	
	
		$('#members_email').change(function(e) {
		var email = $("#members_email").val();
		
		 var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if(email == "")
		{
			$("#members_email_validation").fadeOut();
			$("#members_email_error").fadeIn("fast");
		}
		else
		{
		 
		if(emailReg.test(email) ) 
		{

		$(".availability_email").show();
		$.ajax({
			 url:  "<?php echo site_url("ajax/check_valid_email"); ?>",
			type:"POST",
			data: {email : email },
			cach:"false",
			dataType: "json",
			success: function(success_array)
			  {
				//alert('Done');
				$(".availability_email").fadeOut("slow");
				if(success_array.state == true)
				{
					$('#email_flag').val(1);
					$('#members_email_validation').fadeIn("fast");
					$('#members_email_validation').html('<?php echo lang('globals_lform_email_available')?>') ;
					$('#members_email_validation').removeClass('red_color');
					$('#members_email_validation').addClass('green_color');
					$('#members_email_error').hide();
					$('#members_email_format_error').hide();
					
				}
				else
				{
					if($("#current_email").length)
					{
						var current_email = $('#current_email').val();
						if(email == current_email)
						{
							$('#email_flag').val(1);
							$('#members_email_validation').fadeOut("fast");
						}
						else
						{
							$('#email_flag').val(0);
							$('#members_email_validation').fadeIn("fast");
							$('#members_email_validation').html('<?php echo lang('globals_lform_email_not_available')?>') ;
							$('#members_email_error').hide();
							$('#members_email_validation').removeClass('green_color');
							$('#members_email_validation').addClass('red_color');
							$('#members_email_format_error').hide();
						}
					}
					else
					{
						$('#email_flag').val(0);
						$('#members_email_validation').fadeIn("fast");
						$('#members_email_validation').html('<?php echo lang('globals_lform_email_not_available')?>') ;
						$('#members_email_error').hide();
						$('#members_email_validation').removeClass('green_color');
						$('#members_email_validation').addClass('red_color');
						$('#members_email_format_error').hide();
					}
				}				
	
			  },
			error: function(xhr, ajaxOptions, thrownError)
			{
				alert('Error');
			}
				
			
			});
		 }
		 }
    });
	

	$('#username').change(function(e) {
		$("#username_error").fadeOut();
		
		var username = $(this).val();
		if(username == "")
		{
			$("#members_username_validation").fadeOut();
			$("#username_error").fadeIn("fast");
		}else if(username.length <4){
			$("#members_username_validation").fadeOut();
			$("#username_error2").fadeIn("fast");	
		}
		else
		{
		$(".availability_username").show();
		$.ajax({
			 url:  "<?php echo site_url("ajax/check_valid_username"); ?>",
			type:"POST",
			data: {username : username },
			cach:"false",
			dataType: "json",
			success: function(success_array)
			  {
				//alert('Done');
				$(".availability_username").fadeOut("slow");
				if(success_array.state == true)
				{
					$('#username_flag').val(1);
					$('#members_username_validation').fadeIn("fast");
					$('#members_username_validation').html('<?php echo lang('mycorner_available_username'); ?>') ;
					$('#members_username_validation').removeClass('red_color');
					$('#members_username_validation').addClass('green_color');
					$('#members_username_error').hide();
					$('#members_username_format_error').hide();
					
				}
				else
				{
					if($("#current_username").length)
					{
						var current_username = $('#current_username').val();
						if(username == current_username)
						{
							$('#username_flag').val(1);
							$('#members_username_validation').fadeOut("fast");
						}
						else
						{
							$('#username_flag').val(0);
							$('#members_username_validation').fadeIn("fast");
							$('#members_username_validation').html('<?php echo lang('mycorner_unavailable_username'); ?>') ;
							$('#members_username_error').hide();
							$('#members_username_validation').removeClass('green_color');
							$('#members_username_validation').addClass('red_color');
							$('#members_username_format_error').hide();
						}
					}
					else
					{
						$('#username_flag').val(0);
						$('#members_username_validation').fadeIn("fast");
						$('#members_username_validation').html('<?php echo lang('mycorner_unavailable_username'); ?>') ;
						$('#members_username_error').hide();
						$('#members_username_validation').removeClass('green_color');
						$('#members_username_validation').addClass('red_color');
						$('#members_username_format_error').hide();
					}
				}	
	
			  },
			error: function(xhr, ajaxOptions, thrownError)
			{
				alert('Error');
			}
				
			
			});
		}
	});
		
});
</script>