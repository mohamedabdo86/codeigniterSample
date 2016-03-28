$(document).ready(function(e) {
	
	var step_1 = 0;
	var step_2 = 0;
	var step_3 = 0;
	var step_4 = 0;
	
	var scenario_1 = 0;
	var scenario_2 = 0;
	
	$("#scenario_1").hide();
	$("#scenario_2").hide();
	$("#contact_reason").hide();
	$("#contact_message").hide();
	$("#personal_info").hide();
	$('#contact_method').hide();
	$("#telephone_radio").hide();
	$('#email_radio').hide();
	
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
	
	$('#respond_ID').live("click", function(){
		var rspond_id=$('input[name=respond_ID]:checked').val();
		var dataString = 'id='+ rspond_id;
		if(rspond_id == 2){
				var telephone_val = $("#telephone").val();
				$(".telephone_radio").val(telephone_val);
				$("#contact_method").css('height', '215px');
				$('#email_radio').hide();
				$("#telephone_radio").show();
		}else if(rspond_id == 3){
				var email_val = $("#Email").val();
				$(".email_radio").val(email_val);
				$("#contact_method").css('height', '215px');
				$("#telephone_radio").hide();
				$('#email_radio').show();
		}else if(rspond_id == 4){
			$("#contact_method").css('height', '145px');
			$("#telephone_radio").hide();
			$('#email_radio').hide();
		}
	});
	
	$("#reason_next").live("click", function(){
		
		step_1 = 1;
		
		var id=$('input[name=reason_ID]:checked').val();
		
        var dataString = 'id='+ id;
		if(id == 6 || id == 7){
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
		
		$("#contact_reason").slideUp("slow");
		$("#step_1").css('border', 'none');
		 
		$("#contact_message").slideDown("slow");
		$("#step_2").css('border-bottom', '1px dashed #A0A0A0');
		$("#step_2").css('margin-bottom', '5px');
		
		return false;
	});
	
	$("#step_2").live("click", function(){
		var item = $(this);
		if(step_1 == 1){
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
			
		}else{
			$("#contact_message").slideUp("slow");
			$("#step_2").css('border', 'none');
			
			$("#contact_reason").slideDown("slow");
			$("#step_1").css('border-bottom', '1px dashed #A0A0A0');
			
			$("#contact_reason").css("background", "rgba(191, 49, 49, 0.2)");
			setTimeout(function(){
				 $("#contact_reason").fadeIn(3000,function(){
		  			$("#contact_reason").css("background", "#FFF");
				 });
		}, 100);
		}
	});
	
	$("#message_next").live("click", function(){
		
		var status_1 = true;
		var status_2 = true;
		
		if(scenario_1 == 1 && scenario_2 == 0){
			if( $("#contact_message_textarea_1").val() == "" ){
                $(".yourmsg_1").css('border', '1px solid #FF3C3C');
				status_1 = false;
            }else{
				$(".yourmsg_1").css('border', '1px solid #ccc');
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
				status_2 = false;
            }else{
				$(".yourmsg_2").css('border', '1px solid #ccc');
			}
			if( $("#product_ID").val() == 0 ){
                $("#product_ID").css('border', '1px solid #FF3C3C');
				status_2 = false;
            }else{
				$("#product_ID").css('border', '1px solid #ccc');
			}
			/*if( $("#code_montag").val() == "" ){
                $("#code_montag").css('border', '1px solid #FF3C3C');
				status_2 = false;
            }else{
				$("#code_montag").css('border', '1px solid #ccc');
			}*/
			
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
		var item = $(this);
		if(step_2 == 1){
			
		$("#contact_reason").slideUp("slow");
		$("#step_1").css('border', 'none');
		
		$("#contact_message").slideUp("slow");
		$("#step_2").css('border', 'none');
		
		$("#contact_method").slideUp("slow");
		$("#step_4").css('border', 'none');
		
		var $y = $('#personal_info');
			if ($y.is(':visible')) {
       			 $y.slideUp();
				 item.css('border', 'none');
       			 // Other stuff to do on slideUp
    		} else {
      	 		 $y.slideDown();
		 		 $($y).slideDown("slow");
				 $(item).css('border-bottom', '1px dashed #A0A0A0');
    		}
		
		}else if(step_1 == 1){
			$("#contact_reason").slideUp("slow");
			$("#step_1").css('border', 'none');
			
		    $("#personal_info").slideUp("slow");
			$("#step_3").css('border', 'none');
			
			$("#contact_message").slideDown("slow");
			$("#step_2").css('border-bottom', '1px dashed #A0A0A0');
			
			if(scenario_1 == 1 && scenario_2 == 0){
				$(".yourmsg_1").css("border", "1px solid rgba(228, 15, 15, 0.88)");
				$("#product_ID").css("border", "1px solid rgba(228, 15, 15, 0.88)");
				$("#code_montag").css("border", "1px solid rgba(228, 15, 15, 0.88)");
			}else{
				$(".yourmsg_2").css("border", "1px solid rgba(228, 15, 15, 0.88)");
				$("#product_ID").css("border", "1px solid rgba(228, 15, 15, 0.88)");
				$("#code_montag").css("border", "1px solid rgba(228, 15, 15, 0.88)");
			}
			setTimeout(function(){
				 $("#contact_message").fadeIn(3000,function(){
					 if(scenario_1 == 1 && scenario_2 == 0){
						$(".yourmsg_1").css("border", "1px solid #ccc");
						$("#product_ID").css("border", "1px solid #ccc");
						$("#code_montag").css("border", "1px solid #ccc");
					}else{
						$(".yourmsg_2").css("border", "1px solid #ccc");
						$("#product_ID").css("border", "1px solid #ccc");
						$("#code_montag").css("border", "1px solid #ccc");
					}
				 });
		}, 100);
		}else{
			$("#contact_message").slideUp("slow");
			$("#step_2").css('border', 'none');
			
		    $("#personal_info").slideUp("slow");
			$("#step_3").css('border', 'none');
			
			$("#contact_reason").slideDown("slow");
			$("#step_1").css('border-bottom', '1px dashed #A0A0A0');
			
			$("#contact_reason").css("background", "rgba(191, 49, 49, 0.2)");
			setTimeout(function(){
				 $("#contact_reason").fadeIn(3000,function(){
		  			$("#contact_reason").css("background", "#FFF");
				 });
		}, 100);
		}

	});
	
	function isValidEmailAddress(emailAddress) {
   	 var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    	return pattern.test(emailAddress);
	};
	
	$("#info_next").live("click", function(){
		
		
		var status_3 = true;
		var validate_email = true;
		
		if( $("#fname").val() != ""){
			if($.isNumeric( $("#fname").val() ) == false){
				$("#fname").css('border', '1px solid #ccc');
				$(".firstname_error").fadeOut("slow");
				status_3 = true;
			}else{
				status_3 = false;
				$("#fname").css('border', '1px solid #FF3C3C');
				$(".firstname_error").fadeIn("slow");
			}
		}else{
			$("#fname").css('border', '1px solid #ccc');
			$(".firstname_error").fadeOut("slow");
		}
		
		if( $("#lname").val() != ""){
			if($.isNumeric( $("#lname").val() ) == false){
				$("#lname").css('border', '1px solid #ccc');
				$(".lastname_error").fadeOut("slow");
				status_3 = true;
			}else{
				status_3 = false;
				$("#lname").css('border', '1px solid #FF3C3C');
				$(".lastname_error").fadeIn("slow");
			}
		}else{
			$("#lname").css('border', '1px solid #ccc');
			$(".lastname_error").fadeOut("slow");
		}
		
		if( $("#Email").val() != ""){
			if(!isValidEmailAddress( $("#Email").val() )){
				$("#Email").css('border', '1px solid #FF3C3C');
				$(".email_error").fadeIn("slow");
				status_3 = false;
			}else{
				$("#Email").css('border', '1px solid #ccc');
				$(".email_error").fadeOut("slow");
			}
		}else{
			$("#Email").css('border', '1px solid #ccc');
			$(".email_error").fadeOut("slow");
		}
		
		if( $("#telephone").val() != ""){
			if($.isNumeric( $("#telephone").val() ) == false && $("#telephone").length < 6){
				$("#telephone").css('border', '1px solid #FF3C3C');
				$(".telephone_error").fadeIn("slow");
				status_3 = false;
			}else{
				status_3 = true;
				$("#telephone").css('border', '1px solid #ccc');
				$(".telephone_error").fadeOut("slow");
			}
		}else{
			$("#telephone").css('border', '1px solid #ccc');
			$(".telephone_error").fadeOut("slow");
		}
		
		if( $("#mobile").val() != ""){
			if($.isNumeric( $("#mobile").val() ) == false && $("#mobile").length < 6){
				$("#mobile").css('border', '1px solid #FF3C3C');
				$(".mobile_error").fadeIn("slow");
				status_3 = false;
			}else{
				status_3 = true;
				$("#mobile").css('border', '1px solid #ccc');
				$(".mobile_error").fadeOut("slow");
			}
		}
		
		if(status_3 == true){
			step_3 = 1;
			$("#personal_info").slideUp("slow");
			$("#step_3").css('border', 'none');
	
			$("#contact_method").slideDown("slow");
			$("#step_4").css('border-bottom', '1px dashed #A0A0A0');
		}
		
		return false;
	});
	
	$("#step_4").live("click", function(){
		var item = $(this);
		if(step_1 == 1 && step_2 == 0 && step_3 == 0 && step_4 == 0){
			$("#contact_reason").slideUp("slow");
			$("#step_1").css('border', 'none');
			
		    $("#personal_info").slideUp("slow");
			$("#step_3").css('border', 'none');
			
			$("#contact_message").slideDown("slow");
			$("#step_2").css('border-bottom', '1px dashed #A0A0A0');
			
			if(scenario_1 == 1 && scenario_2 == 0){
				$(".yourmsg_1").css("border", "1px solid rgba(228, 15, 15, 0.88)");
				$("#product_ID").css("border", "1px solid rgba(228, 15, 15, 0.88)");
				$("#code_montag").css("border", "1px solid rgba(228, 15, 15, 0.88)");
			}else{
				$(".yourmsg_2").css("border", "1px solid rgba(228, 15, 15, 0.88)");
				$("#product_ID").css("border", "1px solid rgba(228, 15, 15, 0.88)");
				$("#code_montag").css("border", "1px solid rgba(228, 15, 15, 0.88)");
			}
			setTimeout(function(){
				 $("#contact_message").fadeIn(3000,function(){
					 if(scenario_1 == 1 && scenario_2 == 0){
						$(".yourmsg_1").css("border", "1px solid #ccc");
					}else{
						$(".yourmsg_2").css("border", "1px solid #ccc");
						$("#product_ID").css("border", "1px solid #ccc");
						$("#code_montag").css("border", "1px solid #ccc");
					}
				 });
		}, 100);
		
		}else if(step_1 == 1 && step_2 == 1 && step_3 == 0 && step_4 == 0){
			$("#contact_reason").slideUp("slow");
			$("#step_1").css('border', 'none');
			
		    $("#contact_message").slideUp("slow");
			$("#step_2").css('border', 'none');
			
			$("#personal_info").slideDown("slow");
			$("#step_3").css('border-bottom', '1px dashed #A0A0A0');
			
			$("#personal_info").css("background", "rgba(191, 49, 49, 0.2)");
			setTimeout(function(){
				 $("#personal_info").fadeIn(3000,function(){
		  			$("#personal_info").css("background", "#FFF");
				 });
		}, 100);
			
		}else if(step_1 == 1 && step_2 == 1 && step_3 == 1 && step_4 == 0){
		  $("#contact_reason").slideUp("slow");
		  $("#step_1").css('border', 'none');
  
		  $("#contact_message").slideUp("slow");
		  $("#step_2").css('border', 'none');
			  
		  $("#personal_info").slideUp("slow");
		  $("#step_3").css('border', 'none');
		  
		  var $z = $('#contact_method');
			  if ($z.is(':visible')) {
				   $z.slideUp();
				   item.css('border', 'none');
				   // Other stuff to do on slideUp
			  } else {
				   $z.slideDown();
				   $($z).slideDown("slow");
				   $(item).css('border-bottom', '1px dashed #A0A0A0');
			  }
			
		}else{
			$("#contact_message").slideUp("slow");
			$("#step_2").css('border', 'none');
			
		    $("#personal_info").slideUp("slow");
			$("#step_3").css('border', 'none');
			
			$("#contact_method").slideUp("slow");
			$("#step_4").css('border', 'none');
			
			$("#contact_reason").slideDown("slow");
			$("#step_1").css('border-bottom', '1px dashed #A0A0A0');
			
			$("#contact_reason").css("background", "rgba(191, 49, 49, 0.2)");
			setTimeout(function(){
				 $("#contact_reason").fadeIn(3000,function(){
		  			$("#contact_reason").css("background", "#FFF");
				 });
		}, 100);
		}
		
	});
	
	$(".disabled").prop('disabled', true);
	
	/*$("#fname").keyup(function(){
		 if($(this).val() != ""){
		 	$("#lname").prop('disabled', false);
		 }else{
			 if($("#lname").val() == ""){
			 	$("#lname").prop('disabled', true);
		 	 }else{
				 $("#lname").prop('disabled', false);
			 }
		 }
		 $("#fname").css('border', '1px solid #ccc');
		 $(".firstname_error").fadeOut("slow");
	});
	
	$("#lname").keyup(function(){
		 if($(this).val() != ""){
		 	$("#Email").prop('disabled', false);
		 }else{
			 if($("#Email").val() == ""){
			 	$("#Email").prop('disabled', true);
		 	 }else{
				 $("#Email").prop('disabled', false);
			 }
		 }
		 $("#lname").css('border', '1px solid #ccc');
		 $(".lastname_error").fadeOut("slow");
	});
	
	$("#Email").keyup(function(){
		 if($(this).val() != ""){
		 	$("#telephone").prop('disabled', false);
		 }else{
			 if($("#telephone").val() == ""){
			 	$("#telephone").prop('disabled', true);
		 	 }else{
				 $("#telephone").prop('disabled', false);
			 }
		 }
		 $("#Email").css('border', '1px solid #ccc');
		 $(".email_error").fadeOut("slow");
	});
	
	$("#telephone").keyup(function(){
		 if($(this).val() != ""){
		 	$("#mobile").prop('disabled', false);
		 }else{
			 if($("#mobile").val() == ""){
			 	$("#mobile").prop('disabled', true);
		 	 }else{
				 $("#mobile").prop('disabled', false);
			 }
		 }
		 $("#telephone").css('border', '1px solid #ccc');
		 $(".telephone_error").fadeOut("slow");
	});
	
	$("#mobile").keyup(function(){
		if($(this).val() != ""){
		 	$("#address").prop('disabled', false);
		 }else{
			 if($("#address").val() == ""){
			 	$("#address").prop('disabled', true);
		 	 }else{
				 $("#address").prop('disabled', false);
			 }
		 }
		 $("#mobile").css('border', '1px solid #ccc');
		 $(".mobile_error").fadeOut("slow");
	});
	
	$("#address").keyup(function(){
		if($(this).val() != ""){
		 	$("#city_ID").prop('disabled', false);
		 }else{
			 if($("#city_ID").val() == ""){
			 	$("#city_ID").prop('disabled', true);
		 	 }else{
				 $("#city_ID").prop('disabled', false);
			 }
		 }
	});*/
	
	$("#contact_us_form").submit(function(){
		if($("#checkapprove").is(':checked')){
			$("#checkapprove_error").fadeOut();
		}else{
			$("#checkapprove_error").fadeIn();
			return false;
		}		
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
