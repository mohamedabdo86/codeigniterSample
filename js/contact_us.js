
$(document).ready(function(e) {
	
	var step_1 = 0;
	var step_2 = 0;
	var step_3 = 0;
	var step_4 = 0;
	$("#scenario_1").hide();
	$("#scenario_2").hide();
	if($("#contact_message_textarea_1").val() != "" || $("#contact_message_textarea_2").val() != ""){
		step_1 = 1;
		step_2 = 1;
		
		$("#contact_reason").hide();
		$("#contact_message_textarea_1").show();
		$("#personal_info").show();
		$("#step_3").css('border-bottom', '1px dashed #A0A0A0');
		$("#step_1").css('border', 'none');
		
		if($("#contact_message_textarea_1").val() != ""){
			$("#scenario_1").show();
			$("#scenario_2").hide();
		}else{
			$("#scenario_2").show();
			$("#scenario_1").hide();
		}
		
	}else{
		step_1 = 0;
		step_2 = 0;
		$("#contact_reason").show();
		$("#personal_info").hide();
		$("#step_1").css('border-bottom', '1px dashed #A0A0A0');
		$("#step_3").css('border', 'none');
	}
	
	var scenario_1 = 0;
	var scenario_2 = 0;
	

	//$("#contact_reason").hide();
	//$('#contact_reason').show();
	//$("#step_1").css('border-bottom', '1px dashed #A0A0A0');
	$("#contact_message").hide();
	//$("#personal_info").hide();
	$('#contact_method').hide();
	$("#telephone_radio").hide();
	$('#email_radio').hide();
	$(".contact_message_textarea_1_error_message").hide();
	$(".contact_message_textarea_2_error_message").hide();
	
    $("#step_1").live("click", function(){
		var item = $(this);
		
		$("#contact_message").slideUp("slow");
		$("#step_2").css('border', 'none');
		
		$("#personal_info").slideUp("slow");
		$("#step_3").css('border', 'none');
		
		$("#contact_method").slideUp("slow");
		$("#step_4").css('border', 'none');
		
		var $t = $('#contact_reason');

    	if ($t.is(':visible')) {
       	 $t.slideUp();
		 item.css('border', 'none');
        // Other stuff to do on slideUp
    	} else {
      	  $t.slideDown();
		  item.css('border-bottom', '1px dashed #A0A0A0');
        // Other stuff to down on slideDown
    	}
	});
	$('#radio_reason_button').prop('checked', true);
	//$('#respond_ID').prop('checked', true);
	
	$(".respond_4").live("change",function() {
		if($(".respond_2").is(':checked') == false  && $(".respond_3").is(':checked') == false){
			$(this).attr('checked', true);
		}else if(this.checked) {
        	$(".respond_3").attr('checked', false);
			$(".respond_2").attr('checked', false);
			$('#email_radio').hide();
			$("#telephone_radio").hide();
			$("#contact_method").css('height', '160px');
    	}
	});
	
	$(".respond_3").live("change",function() {
		if(this.checked) {
		  var email_val = $("#Email").val();
		  $(".email_radio").val(email_val);
		  if($(".respond_2").is(':checked') == true){
		  	  $("#contact_method").css('height', '290px');
		  }else{
			  $("#contact_method").css('height', '255px');
		  }
		  $('#email_radio').show();
		  $(".respond_4").attr('checked', false);
		}else if($(".respond_2").is(':checked') == false){
			$(".respond_4").attr('checked', true);
			$('#email_radio').hide();
			$("#contact_method").css('height', '160px');
		}else{
			$('#email_radio').hide();
			$("#contact_method").css('height', '255px');
		}
		
	});
	
	$(".respond_2").live("change",function() {
		if(this.checked) {
		  var telephone_val = $("#telephone").val();
		  var mobile_val = $("#mobile").val();
		  if(telephone_val != '' && mobile_val != '')
		  {
			  $("#telephone_respond").val(mobile_val);
		  }
		  else if(telephone_val != '' && mobile_val == '')
		  {
			  $("#telephone_respond").val(telephone_val);
		  }
		   else if(telephone_val == '' && mobile_val != '')
		  {
			  $("#telephone_respond").val(mobile_val);
		  }
		  
		  if($(".respond_3").is(':checked') == true)
		  {
		  	  $("#contact_method").css('height', '290px');
		  }
		  else
		  {
			  $("#contact_method").css('height', '255px');
		  }
		  $("#telephone_radio").show();
		  $(".respond_4").attr('checked', false);
		}else if($(".respond_3").is(':checked') == false){
			$(".respond_4").attr('checked', true);
			$("#telephone_radio").hide();
			$("#contact_method").css('height', '160px');
		}else{
			$("#telephone_radio").hide();
			$("#contact_method").css('height', '255px');
		}
		
		
	});
	
	$("#option_link").hide();
	$("#reason_next").live("click", function(){
		
		step_1 = 1;
		
		var id=$('input[name=reason_ID]:checked').val();
		
        var dataString = 'id='+ id;
		if(id == 5 || id == 6){
			$("#scenario_1").hide();
			$("#scenario_2").show();
			scenario_2 = 1;
			scenario_1 = 0;
		}else{
			$("#scenario_1").show();
			$("#scenario_2").hide();
			scenario_2 = 0;
			scenario_1 = 1;
		}
		
		if(id == 3){
			$("#option_link").show();
			$("#option_link").css('color', '#E82327');
			$(".diet_app_option").hide();
			$(".dros_tab5_option").show();
		}else if(id == 4){
			$("#option_link").show();
			$("#option_link").css('color', '#658E15 !important');
			$(".diet_app_option").show();
			$(".dros_tab5_option").hide();
		}else{
			$("#option_link").hide();
		}
		
		$("#contact_reason").slideUp("slow");
		$("#step_1").css('border', 'none');
		 
		$("#contact_message").slideDown("slow");
		$("#step_2").css('border-bottom', '1px dashed #A0A0A0');
		$("#step_2").css('margin-bottom', '5px');
		
		return false;
	});
	
	$("#step_2").live("click", function(){
		var item = $(this);
		step_1 = 1;
			
		var id=$('input[name=reason_ID]:checked').val();
		
        var dataString = 'id='+ id;
		if(id == 5 || id == 6){
			$("#scenario_1").hide();
			$("#scenario_2").show();
			scenario_2 = 1;
			scenario_1 = 0;
		}else{
			$("#scenario_1").show();
			$("#scenario_2").hide();
			scenario_2 = 0;
			scenario_1 = 1;
		}
		
		if(id == 3){
			$("#option_link").show();
			$("#option_link").css('color', '#E82327');
			$(".diet_app_option").hide();
			$(".dros_tab5_option").show();
		}else if(id == 4){
			$("#option_link").show();
			$("#option_link").css('color', '#658E15 !important');
			$(".diet_app_option").show();
			$(".dros_tab5_option").hide();
		}else{
			$("#option_link").hide();
		}
			
			$("#contact_reason").slideUp("slow");
			$("#step_1").css('border', 'none');
			
			$("#personal_info").slideUp("slow");
		    $("#step_3").css('border', 'none');
			
			$("#contact_method").slideUp("slow");
		    $("#step_4").css('border', 'none');
			
			var $x = $('#contact_message');
			if ($x.is(':visible')) {
       			 $x.slideUp();
				 item.css('border', 'none');
       			 // Other stuff to do on slideUp
    		} else {
      	 		 $x.slideDown();
		 		 $($x).slideDown("slow");
				 $(item).css('border-bottom', '1px dashed #A0A0A0');
				 $(item).css('margin-bottom', '5px');
       		 	// Other stuff to down on slideDown
    		}
	});
	
	$("#message_next").live("click", function(){
		
		var status_1 = true;
		var status_2 = true;
		
		if(scenario_1 == 1 && scenario_2 == 0){
			if( $("#contact_message_textarea_1").val() == "" ){

                $(".yourmsg_1").css('border', '1px solid #FF3C3C');
				$(".contact_message_textarea_1_error_message").fadeIn("slow");
				status_1 = false;
            }else{
				$(".yourmsg_1").css('border', '1px solid #ccc');
				$(".contact_message_textarea_1_error_message").fadeOut("slow");
				status_1 = true;
			}
			
			if(status_1 == true){
				step_2 = 1;
				$("#contact_message").slideUp("slow");
				$("#step_2").css('border', 'none'); 
				$("#personal_info").slideDown("slow");
				$("#step_3").css('border-bottom', '1px dashed #A0A0A0');
			}
			
		}else if(scenario_1 == 0 && scenario_2 == 1){
			
			if( $("#contact_message_textarea_2").val() == "" ){
                $(".yourmsg_2").css('border', '1px solid #FF3C3C');
				$(".contact_message_textarea_2_error_message").fadeIn("slow");
				status_2 = false;
            }else{
				$(".yourmsg_2").css('border', '1px solid #ccc');
				$(".contact_message_textarea_2_error_message").fadeOut("slow");
			}
			
			if( $("#product_ID").val() == 0 ){
                $("#product_ID").css('border', '1px solid #FF3C3C');
				status_2 = false;
            }else{
				$("#product_ID").css('border', '1px solid #ccc');
			}
			
			if(status_2 == true){
				$("#contact_message").slideUp("slow");
				$("#step_2").css('border', 'none'); 
				$("#personal_info").slideDown("slow");
				$("#step_3").css('border-bottom', '1px dashed #A0A0A0');
			}
		}
		return false;
		
	});
	
	$("#step_3").live("click", function(){
		var status_1 = true;
		var status_2 = true;
		
		if(scenario_1 == 1 && scenario_2 == 0){
			if( $("#contact_message_textarea_1").val() == "" ){

                $(".yourmsg_1").css('border', '1px solid #FF3C3C');
				$(".contact_message_textarea_1_error_message").fadeIn("slow");
				status_1 = false;
            }else{
				$(".yourmsg_1").css('border', '1px solid #ccc');
				$(".contact_message_textarea_1_error_message").fadeOut("slow");
				status_1 = true;
			}
			
			if(status_1 == true){
				step_2 = 1;
				$("#contact_message").slideUp("slow");
				$("#step_2").css('border', 'none'); 
				$("#personal_info").slideDown("slow");
				$("#step_3").css('border-bottom', '1px dashed #A0A0A0');
			}
			
		}else if(scenario_1 == 0 && scenario_2 == 1){
			
			if( $("#contact_message_textarea_2").val() == "" ){
                $(".yourmsg_2").css('border', '1px solid #FF3C3C');
				$(".contact_message_textarea_2_error_message").fadeIn("slow");
				status_2 = false;
            }else{
				$(".yourmsg_2").css('border', '1px solid #ccc');
				$(".contact_message_textarea_2_error_message").fadeOut("slow");
			}
			
			if( $("#product_ID").val() == 0 ){
				step_2 = 1;
                $("#product_ID").css('border', '1px solid #FF3C3C');
				status_2 = false;
            }else{
				$("#product_ID").css('border', '1px solid #ccc');
			}
			
			if(status_2 == true){
				$("#contact_message").slideUp("slow");
				$("#step_2").css('border', 'none'); 
				$("#personal_info").slideDown("slow");
				$("#step_3").css('border-bottom', '1px dashed #A0A0A0');
			}
		}
		
	});
	
	function isValidEmailAddress(emailAddress) {
   	 var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    	return pattern.test(emailAddress);
	};
	
	$("#info_next").live("click", function(){
		$(".field_error").hide();
		
		var status_3 = true;
		var validate_email = true;
		
		if( $("#fname").val() != "")
		{
			if($.isNumeric( $("#fname").val() ) == false){
				//$("#fname").css('border', '1px solid #ccc');
				$(".firstname_error").fadeOut("slow");
				status_3 = true;
			}else{
				status_3 = false;
				//$("#fname").css('border', '1px solid #FF3C3C');
				$(".firstname_error").fadeIn("slow");
				
			}
		}
		
		if( $("#lname").val() == "" )
		{
        	//$("#lname").css('border', '1px solid #FF3C3C');
			$(".lastname_error").fadeIn("slow");
			
			status_3 = false;
        }
		/*else{
			$("#lname").css('border', '1px solid #ccc');
		}*/
		
		if( $("#lname").val() != "")
		{
			if($.isNumeric( $("#lname").val() ) == false)
			{
				//$("#lname").css('border', '1px solid #ccc');
				$(".lastname_error").fadeOut("slow");
				status_3 = true;
			}
			else
			{
				status_3 = false;
				//$("#lname").css('border', '1px solid #FF3C3C');
				$(".lastname_error").fadeIn("slow");
				
			}
		}

		
		if( $("#Email").val() == "" )
		{
			//$("#Email").css('border', '1px solid #FF3C3C');
			$(".email_error_format").fadeOut("slow");
			$(".email_error").fadeIn("slow");
			status_3 = false;
        }
		else
		{
			if(!isValidEmailAddress( $("#Email").val() )){
				//$("#Email").css('border', '1px solid #FF3C3C');
				$(".email_error").fadeOut("fast");
				$(".email_error_format").fadeIn("slow");
				status_3 = false;
			}else{
				
				//$("#Email").css('border', '1px solid #ccc');
				$(".email_error_format").fadeOut("slow");
				$(".email_error").fadeOut("slow");
			}
			
		}
		
		if( $("#fname").val() == "" )
		{
        	//$("#fname").css('border', '1px solid #FF3C3C');
			$(".firstname_error").fadeIn("slow");
			
			status_3 = false;
		
        }
		
		if(status_3 == true)
		{
			step_3 = 1;
			$("#personal_info").slideUp("slow");
			$("#step_3").css('border', 'none');
	
			$("#contact_method").slideDown("slow");
			$("#step_4").css('border-bottom', '1px dashed #A0A0A0');
		}
		
		return false;
	});
	
	$("#step_4").live("click", function(){
		
		$(".field_error").hide();
		var status_3 = true;
		var validate_email = true;
		
		if( $("#fname").val() != "")
		{
			if($.isNumeric( $("#fname").val() ) == false){
				$(".firstname_error").fadeOut("slow");
				status_3 = true;
			}else{
				status_3 = false;
				$(".firstname_error").fadeIn("slow");
			}
		}
		
		if( $("#lname").val() == "" )
		{
			$(".lastname_error").fadeIn("slow");
			status_3 = false;
        }
		
		if( $("#lname").val() != "")
		{
			if($.isNumeric( $("#lname").val() ) == false)
			{
				$(".lastname_error").fadeOut("slow");
				status_3 = true;
			}
			else
			{
				status_3 = false;
				$(".lastname_error").fadeIn("slow");
				
			}
		}

		
		if( $("#Email").val() == "" )
		{
			$(".email_error_format").fadeOut("slow");
			$(".email_error").fadeIn("slow");
			status_3 = false;
        }
		else
		{
			if(!isValidEmailAddress( $("#Email").val() )){
				$(".email_error").fadeOut("fast");
				$(".email_error_format").fadeIn("slow");
				status_3 = false;
			}else{
				$(".email_error_format").fadeOut("slow");
				$(".email_error").fadeOut("slow");
			}
			
		}
		
		if( $("#fname").val() == "" )
		{
			$(".firstname_error").fadeIn("slow");
			
			status_3 = false;
        }
		
		if(status_3 == true)
		{
			if($("#contact_message_textarea_1").val() != "" || ($("#contact_message_textarea_2").val() != "" && $("#product_ID").val() != 0)){
				step_3 = 1;
				$("#personal_info").slideUp("slow");
				$("#step_3").css('border', 'none');
		
				$("#contact_method").slideDown("slow");
				$("#step_4").css('border-bottom', '1px dashed #A0A0A0');
			}
		}
	});
	
	$(".disabled").prop('disabled', true);
	//Hide error 
	$(".telephone_error_2").hide();
	$(".email_error_2").hide();
	$(".email_error_format_2").hide();
	
	$("#contact_us_form").submit(function(){
		var submit_status = new Boolean();
		submit_status = true;
		
		$("#checkapprove_error").hide();
		$(".telephone_error_2").hide();
		$(".email_error_2").hide();
		$(".email_error_format_2").hide();

		//this check if user enter his phone number in respomd way
		if($(".respond_2").is(':checked'))
		{
			if($('#telephone_respond').val() == "")
			{
				$(".telephone_error_2").show();
				submit_status = false;			
			}
		}
		//this check if user enter his email in respomd way
		if($(".respond_3").is(':checked'))
		{
			if($('#email_respond').val()  == "")
			{
				$(".email_error_2").show();
				submit_status = false;
			}
			
			if($("#email_respond").val() != "")
			{
				 var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
				 if( !emailReg.test($("#email_respond").val() ) ) 
				 {
					  $(".email_error_format_2").show();
					  submit_status = false;
				 } 
			}
			
			if($('#email_respond').val()  == "")
			{
				$(".email_error_2").show();
				submit_status = false;
			}

		}
		//this check if user approve on privacy policy
		if(!$("#checkapprove").is(':checked'))
		{
			$("#checkapprove_error").show();
			submit_status = false;
		}
		return submit_status;	
	});
	
	$("#contact_us_submit").live("click" ,function(){
		var respond_id_val = $('input:radio[name=respond_ID]:checked').val();
		var status_4 = true;
		if(respond_id_val == 2){
				if($(".telephone_radio").val() == ""){
					$(".telephone_radio").css("border", "1px solid rgba(228, 15, 15, 0.88)");
					$(".email_radio").css("border", "1px solid #ccc");
					status_4 = false; 
				}else if($.isNumeric( $(".telephone_radio").val() ) == false){
					$(".telephone_radio").css('border', '1px solid #FF3C3C');
					$(".telephone_error").fadeIn("slow");
					status_4 = false;
				}else{
					$(".telephone_radio").css('border', '1px solid #ccc');
					$(".telephone_error").fadeOut("slow");
					status_4 = true;
				}
		}else if(respond_id_val == 3){
			if($(".email_radio").val() == ""){
				$(".email_radio").css("border", "1px solid rgba(228, 15, 15, 0.88)");
				$(".telephone_radio").css("border", "1px solid #ccc");
				status_4 = false;
			}else if(!isValidEmailAddress( $(".email_radio").val() )){
				$(".email_radio").css('border', '1px solid #FF3C3C');
				$(".email_error").fadeIn("slow");
				status_4 = false;
			}else{
				$(".email_radio").css('border', '1px solid #ccc');
				$(".email_error").fadeOut("slow");
				status_4 = true;
			}
		}
		return status_4;
	});
});
