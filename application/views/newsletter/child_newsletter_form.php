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
	width:520px;
	position:relative;
	
}
body.arabic #newsletter_form_main_wrapper
{
	direction:rtl;
}
#newsletter_form
{
	width:100%;
	clear:both
}
#newsletter_form th
{
	width:25%;
	font-size: 12px;
}
#newsletter_form td
{
	width:25%;
	font-size: 12px;
}
#newsletter_loadable_message
{
	white-space:normal;
}
.error {
	font-size: 10px !important;
	color: #F00	
}
</style>
<?php
$this->load->view('my_corner/view_datepicker_newsletter');
?>
<script>
$(document).ready(function(e) {
	
	$("#newsletter_add_email").submit(function(e) {
		//e.preventDefault();
        $('#newsletter_loadable_message_email').hide();
		$('#newsletter_loadable_message_Name_Of_Mom').hide();
		$('#newsletter_loadable_message_Name_Of_Baby').hide();
		$('#newsletter_loadable_message_Dat_Of_Birt').hide();
		$('#newsletter_loadable_message_Phone').hide();
		$('#newsletter_loadable_message_Awarness').hide();
		$('#newsletter_loadable_message_Address').hide();
		$('#newsletter_loadable_message_policy').hide();
		var state = new Boolean();
		state = true;
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test(document.newsletter_add_email.newsletter_email.value) == false)
		{
			$('#newsletter_loadable_message_email').html("<?php echo lang("newsletter_validate_email_format"); ?>");
			$('#newsletter_loadable_message_email').fadeIn("slow");
			document.newsletter_add_email.newsletter_email.focus();
			state = false;	
			
		}
		if(document.newsletter_add_email.newsletter_email.value == "")
		{
			$('#newsletter_loadable_message_email').html("<?php echo lang("newsletter_validate_email_empty"); ?>");
			$('#newsletter_loadable_message_email').fadeIn("slow");
			document.newsletter_add_email.newsletter_email.focus();
			state = false;			
		}
		//if(document.newsletter_add_email.baby_month.value == "")
//		{
//			$('#newsletter_loadable_message').html("<?php //echo lang("newsletter_validate_baby_month_empty"); ?>");
//			$('#newsletter_loadable_message').fadeIn("slow");
//			document.newsletter_add_email.baby_month.focus();
//			state = false;			
//		}
		if(document.newsletter_add_email.newsletter_Name_Of_Mom.value == "")
		{
			$('#newsletter_loadable_message_Name_Of_Mom').html("<?php echo lang("newsletter_validate_Name_Of_Mom_empty"); ?>");
			$('#newsletter_loadable_message_Name_Of_Mom').fadeIn("slow");
			document.newsletter_add_email.newsletter_Name_Of_Mom.focus();
			state = false;			
		}
		if(document.newsletter_add_email.newsletter_Name_Of_Baby.value == "")
		{
			$('#newsletter_loadable_message_Name_Of_Baby').html("<?php echo lang("newsletter_validate_Name_Of_Baby_empty"); ?>");
			$('#newsletter_loadable_message_Name_Of_Baby').fadeIn("slow");
			document.newsletter_add_email.newsletter_Name_Of_Baby.focus();
			state = false;			
		}
		if(document.newsletter_add_email.newsletter_Exact_Dat_Of_Birt.value == "")
		{
			$('#newsletter_loadable_message_Dat_Of_Birt').html("<?php echo lang("newsletter_validate_Exact_Dat_Of_Birt_empty"); ?>");
			$('#newsletter_loadable_message_Dat_Of_Birt').fadeIn("slow");
			document.newsletter_add_email.newsletter_Exact_Dat_Of_Birt.focus();
			state = false;			
		}
		if(document.newsletter_add_email.newsletter_Phone_Number.value == "")
		{
			$('#newsletter_loadable_message_Phone').html("<?php echo lang("newsletter_validate_Phone_Number_empty"); ?>");
			$('#newsletter_loadable_message_Phone').fadeIn("slow");
			document.newsletter_add_email.newsletter_Phone_Number.focus();
			state = false;			
		}
		
		//var mob = /^[1-9]{1}[0-9]{9}$/;
//		if (mob.test($.trim($('input[name="newsletter_Phone_Number"]').val())) == false) {
//			$('#newsletter_loadable_message_Phone').html("<?php// echo lang("newsletter_validate_Phone_Number_invalid"); ?>");
//			$('#newsletter_loadable_message_Phone').fadeIn("slow");
//			document.newsletter_add_email.newsletter_Phone_Number.focus();
//			state = false;
//		}

		//var phone = $('input[name="newsletter_Phone_Number"]').val();
//		if((phone.length < 6) || (!intRegex.test(phone)))
//		{
//			 $('#newsletter_loadable_message_Phone').html("<?php// echo lang("newsletter_validate_Phone_Number_invalid"); ?>");
//			 $('#newsletter_loadable_message_Phone').fadeIn("slow");
//			 return false;
//		}
		
		
		if(document.newsletter_add_email.newsletter_Awarness_Source.value == "")
		{
			$('#newsletter_loadable_message_Awarness').html("<?php echo lang("newsletter_validate_Awarness_Source_empty"); ?>");
			$('#newsletter_loadable_message_Awarness').fadeIn("slow");
			document.newsletter_add_email.newsletter_Awarness_Source.focus();
			state = false;			
		}
		if(document.newsletter_add_email.newsletter_Home_Address.value == "")
		{
			$('#newsletter_loadable_message_Address').html("<?php echo lang("newsletter_validate_Home_Address_empty"); ?>");
			$('#newsletter_loadable_message_Address').fadeIn("slow");
			document.newsletter_add_email.newsletter_Home_Address.focus();
			state = false;			
		}
		if(document.newsletter_add_email.policy.checked == false) {
			$('#newsletter_loadable_message_policy').html("<?php echo lang("newsletter_validate_policy"); ?>");
			$('#newsletter_loadable_message_policy').fadeIn("slow");
			document.newsletter_add_email.policy.focus();
			state = false;
		}
		
		if(state)
		{
			var data = $('#newsletter_add_email').serialize();
			//alert(JSON.stringify(data));
			//alert(data.join("\n"));
			$('#newsletter_loadable_message').fadeIn("slow").html("<?php echo lang("newsletter_please_wait"); ?>");
			$.ajax({
				  url:  "<?php echo  site_url("newsletter/add_child_data_action"); ?>",
				  type: "POST",
				  data: data,
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


<div id="newsletter_form_main_wrapper">
<h2 class="newsletter_service float_left"><?php echo $title ?></h2>
<form name="newsletter_add_email" id="newsletter_add_email" >
<table id="newsletter_form" style="margin: 0px 24px 0px 24px;">

<tr>
<th><?php echo lang("newsletter_enter_email"); ?></th>
<td>
	<input type="text" name="newsletter_email" />
    <div class="error" id="newsletter_loadable_message_email"></div>
</td>
</tr>

<?php /*?><tr>
<th><?php echo lang('newsletter_child_month'); ?></th>
<td><select name="baby_month" id="baby_month" style="width: 182px;">
<?php
 for($i=1 ; $i<=12;$i++)
  {
	  echo '<option value="'.($i).'" >'.($i).'</option>';
  }
  echo "<option value='older12'>".lang("newsletter_older_than_12")."</option>"

?>
</select>
<?php echo lang('newsletter_child_month_count'); ?>
</td>
</tr><?php */?>
<tr>
<th><?php echo lang("newsletter_enter_Name_Of_Mom"); ?></th>
<td>
	<input type="text" name="newsletter_Name_Of_Mom" />
    <div class="error" id="newsletter_loadable_message_Name_Of_Mom"></div>
</td>
</tr>
<tr>
<th><?php echo lang("newsletter_enter_Name_Of_Baby"); ?></th>
<td>
	<input type="text" name="newsletter_Name_Of_Baby" />
    <div class="error" id="newsletter_loadable_message_Name_Of_Baby"></div>
</td>
</tr>
<tr>
<th><?php echo lang("newsletter_enter_Exact_Dat_Of_Birth"); ?></th>
<td>
	<input type="text" name="newsletter_Exact_Dat_Of_Birt" id="datepicker" class="large_text datepicker" readonly="readonly"/>
    <div class="error" id="newsletter_loadable_message_Dat_Of_Birt"></div>
</td>
</tr>
<tr>
<th><?php echo lang("newsletter_enter_Phone_Number"); ?></th>
<td>
	<input type="number" name="newsletter_Phone_Number" />
    <div class="error" id="newsletter_loadable_message_Phone"></div>
</td>
</tr>
<tr>
<th><?php echo lang("newsletter_enter_Home_Address"); ?></th>
<td>
    <input type="text" name="newsletter_Home_Address" />
    <div class="error" id="newsletter_loadable_message_Address"></div>
</td>
</tr>
<tr>
<th><?php echo lang("newsletter_enter_Awarness_Source"); ?></th>
<td>
    <select name="newsletter_Awarness_Source" id="newsletter_Awarness_Source" style="width: 182px;">
    <option value="Onground" ><?php echo lang("newsletter_enter_Awarness_Source_onground"); ?></option>
    <option value="facebook " ><?php echo lang("newsletter_enter_Awarness_Source_facebook"); ?></option>
    <option value="a friend" ><?php echo lang("newsletter_enter_Awarness_Source_friend"); ?></option>
    <option value="mouled" ><?php echo lang("newsletter_enter_Awarness_Source_mouled"); ?></option>
    </select>
	<div class="error" id="newsletter_loadable_message_Awarness"></div>
</td>
</tr>
<tr>	
    <td colspan="2">
    	<input name="policy" id="policy" type="checkbox" value="1" /><?php
		$a = "<a style=\"color: blue;\" target=\"_blank\" href=\"" . site_url("terms_conditions") . "\">";
		$b = "<a style=\"color: blue;\" href= \"" . site_url("privacy_policy") . "\" target=\"_blank\">" ;
		$c = "<span style=\"color: red;\">";
		 printf(lang("newsletter_enter_policy"),$a,$b,$c) ; ?>
        <div class="error" id="newsletter_loadable_message_policy"></div>
        </td>
</tr>
<tr>
<th></th>
<input type="hidden" name="newsletter_type" value="<?php echo $id; ?>" />
<td><input type="submit" class="newsletter_submit" value="<?php echo lang('newsletter_send_button'); ?>" /></td>
</tr>

<tr>
	<td style="">
		<div id="newsletter_loadable_message"></div>
    </td>
</tr>

</table>

</form>
</div>