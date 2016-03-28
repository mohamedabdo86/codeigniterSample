<!-- This page check availability_email  last modify 1/9/2015 By Ayman -->
<?php 	$this->lang->load('bestcook');
        $this->lang->load('mycorner');
?>
<link rel="stylesheet" href="<?php echo base_url()."css/mycorner.css" ?>" />
<link rel="stylesheet" href="<?php echo base_url()."mobile/css/recipe-style.css" ?>" />
<script>
$(document).ready(function(e) {
	var email_state = true;
	$('#members_email').change(function(e) {
		var email = $("#members_email").val();
		
		 var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		 if(emailReg.test(email) ) 
		 {
		email_state = false;
		$("#availability_email").show();
		$.ajax({
			 url:  "<?php echo site_url("ajax/check_valid_diet_app_email"); ?>",
			type:"POST",
			data: {email : email },
			cach:"false",
			dataType: "json",
			success: function(success_array)
			  {
				//alert('Done');
				$("#availability_email").fadeOut("slow");
				if(success_array.state == true)
				{
					$('#email_flag').val(1);
					$('#members_email_validation').fadeIn("fast");
					$('#members_email_validation').html('<?php echo lang('globals_lform_email_available')?>') ;
					$('#members_email_validation').removeClass('red_color');
					$('#members_email_validation').addClass('green_color');
					$('#members_email_error').hide();
					$('#members_email_format_error').hide();
					email_state = true;
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
					email_state = false;
				}
	
			  },
			error: function(xhr, ajaxOptions, thrownError)
			{
				//alert('Error');
			}
				
			
			});
			
		 }
    });
	
		
	$("#create_diet_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();


		if( $("#members_name").val() == "" )
		{
			$("#members_name_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#members_height").val() == "" )
		{
			$("#members_height_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#members_weight").val() == "" )
		{
			$("#members_weight_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#members_sport").val() == "" )
		{
			$("#members_sport_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#members_healthy").val() == "" )
		{
			$("#members_healthy_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#members_mobile").val() == "" )
		{
			$("#members_mobile_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#members_phone").val() == "" )
		{
			$("#members_phone_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#email_flag").val() == 0 )
		{
			$('#members_email_validation').fadeIn("fast");
			state = false;
		}
		
		if(email_state == false){
			$('#email_flag').val(0);
			$('#members_email_validation').fadeIn("fast");
			$('#members_email_validation').html('<?php echo lang('globals_lform_email_not_available')?>') ;
			$('#members_email_error').hide();
			$('#members_email_validation').removeClass('green_color');
			$('#members_email_validation').addClass('red_color');
			$('#members_email_format_error').hide();
			state = false;
		}
		
		if( $("#members_email").val() == "" )
		{
			$("#members_email_validation").hide();
			$("#members_email_error").fadeIn("fast");
			state = false;
		}

		if( $("#members_email").val() != "" )
		{
			 var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			 if( !emailReg.test($("#members_email").val() ) ) 
			 {
				  $("#members_email_format_error").fadeIn("fast");
				  state = false;
			 } 
		}
		
		return state;
	});    
	
});
</script>
<?php
$this->load->view('my_corner/validation_form');
?>
<style>

.field_error{
	color:red;
	display:none;
}
#members_call_time-button{
width:100%;	
}
.bestme_button 
{
	-moz-box-shadow: inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow: inset 0px 1px 0px 0px #ffffff;
	box-shadow: inset 0px 1px 0px 0px #ffffff;
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #57E568), color-stop(1, #658e15) );
	background: -moz-linear-gradient( center top, #57E568 5%, #658e15 100% );
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#57E568', endColorstr='#658e15');
	background-color: #57E568;
	-webkit-border-top-left-radius: 7px;
	-moz-border-radius-topleft: 7px;
	border-top-left-radius: 7px;
	-webkit-border-top-right-radius: 7px;
	-moz-border-radius-topright: 7px;
	border-top-right-radius: 7px;
	-webkit-border-bottom-right-radius: 7px;
	-moz-border-radius-bottomright: 7px;
	border-bottom-right-radius: 7px;
	-webkit-border-bottom-left-radius: 7px;
	-moz-border-radius-bottomleft: 7px;
	border-bottom-left-radius: 7px;
	text-indent: 0;
	border: 1px solid #d9d9d9;
	display: inline-block;
	color: #ffffff;
	font-size: 15px;
	font-weight: bold;
	line-height: 35px;
	text-decoration: none;
	text-align: center;
	padding: 2px 13px;
	cursor:pointer;
	  width: 150px;
}
.bestme_button:hover 
{
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #658e15), color-stop(1, #57E568) );
	background:-moz-linear-gradient( center top, #658e15 5%, #57E568 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#658e15', endColorstr='#57E568');
	background-color:#658e15;
}.bestme_button:active 
{
	position:relative;
	top:1px;
}
.green_color
{
	color: #197C21 !important;
}
.red_color
{
	color: #e82327 !important;
}
#availability_email
{
	width: 24px;
	display: none;
}

#container_wrapper
{
	width:950px;
	height:auto;
	background-color:#FFFFFF;
}
#login_register_container
{
	width: 388px;
}
.english .ui-checkbox input[type='checkbox'],.english  .ui-radio input[type='radio']{
  	/*right: .466em !important;*/ 
 	left: 125px !important;
  	margin-top: -5px;
}

@media (min-width: 320px) and (max-width: 568px) {
	body.english  .ui-radio input[type='radio']{
		left: 95px !important;
	}
}
body.english #members_mobile, body.english #members_phone{text-indent: 30px;}
body.arabic input[type="text"]#egyptnumber {margin-left: 9px !important;}
body.arabic #create_diet_form input {text-align: right;}
</style>

<?php
//$dynamic_id = $this->uri->segment(5);

if(!$this->members->members_id):

echo '<div style="width:100%;"><img style="width: 100%" src="'.base_url().'images/bestme/diet_app_bg'.$current_language_db_prefix.'.jpg" /></div>';
echo '<div style="position: relative;" >';//style="position: relative;top: -45px;margin-top: -122px;"
$this->load->view('mobile/template/view_login_form_toggle');
echo '</div>';
return;
endif;




?>
<div class="row" >

<?php
if ($this->uri->segment(6) === "success")
{
	echo "<b style='font-size:16px; text-align:center; display:block;'>".lang('success_0_desc')."</b>";	
}

$attributes = array('class' => '', 'id' => 'create_diet_form' ,'data-ajax'=>'false');
echo form_open_multipart('mobile/best_me/submit_app',$attributes);
?>

    <!--Member name-->
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" >
        <span style="color:red">*</span> <?php echo lang('diet_app_name');?> 
        <?php
        $data=array( 'name' => 'members_name' ,'id' => 'members_name','class'=>'large_text' , 'value' => '', 'onkeypress' => "return onlyAlphabetsAndSpace(event)");                  
        echo form_input($data);	
        echo form_error('members_name'); 
        echo '<p id="members_name_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>
    
     <!--Member Birthday--> 
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <label for="day" class="fontweight"><?php echo lang('mycorner_birthdate');?>  </label> 
         <?php 
        $data=array( 'name' => 'members_birthdate' , 'id' => 'datepicker', 'class' => 'large_text datepicker' , 'value' => ''); 		 
       echo form_input($data); 
	   echo form_error('members_birthdate'); 
        ?>
    </div>

	<div class="col-xs-12" >
    <!--Member Gender--> 
    <label for="day" class="fontweight"> <?php echo lang('diet_app_type');?> </label> 
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >
    
            <label  for="members_gender" class="fontweight float"><?php echo lang('diet_app_female');?></label> 
            <?php $data = array( 'name' => 'members_gender' ,'class' => 'radio float_left' , 'value' => 'female' , 'checked'=> TRUE);
                echo form_radio($data);
            ?>
     </div>
     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" >       
            <label for="members_gender"  class="fontweight float"> <?php echo lang('diet_app_male');?> </label> 
            <?php $data = array( 'name' => 'members_gender' ,'class' => 'radio float_left' , 'value' => 'male');
            echo form_radio($data);
            ?>    
	</div>
 	<!--Member Height--> 
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <label for="members_height" class="fontweight"><span style="color:red">*</span> <?php echo lang('diet_app_height');?></label> 
        <input type="text" maxlength="3"  onkeypress="return isNumberKey(event)"  name="members_height" id="members_height" class="small_text" />

        <?php
          echo '<p id="members_height_error" class="field_error">'. lang("bestcook_field_required").'</p>';
		  echo form_error('members_height');
        ?>
    </div>
    
    <!--Member Weight--> 
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <label for="members_weight" class="fontweight"><span style="color:red">*</span> <?php echo lang('diet_app_weight');?></label> 
        <input type="text" maxlength="3"  onkeypress="return isNumberKey(event)"  name="members_weight" id="members_weight" class="small_text" />
		<?php
          echo '<p id="members_weight_error" class="field_error">'. lang("bestcook_field_required").'</p>';
		  echo form_error('members_weight');
        ?>
    </div>

    <!--Member heathly--> 
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <label for="members_sport" class="fontweight"><span style="color:red">*</span> <?php echo lang('diet_app_sport');?></label> 
        <?php
          $healthy_data=array( 'name' => 'members_sport' ,'class'=>'large_text', 'id' => 'members_sport');                  
          echo form_input($healthy_data);	
          echo form_error('members_sport'); 
          echo '<p id="members_sport_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>
    
	<!--Member heathly--> 
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <label for="members_healthy" class="fontweight"><span style="color:red">*</span> <?php echo lang('diet_app_healthy');?></label> 
        <?php
          $healthy_data=array( 'name' => 'members_healthy' ,'class'=>'large_text', 'id' => 'members_healthy');                  
          echo form_input($healthy_data);	
          echo form_error('members_healthy'); 
          echo '<p id="members_healthy_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>

     <!--Member Mobile--> 
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <label for="members_mobile" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_mobile');?></label> 
        <h3 class="font_size_17" id="egyptnumber">+20</h3>
        <?php
          $mobil_data=array( 'name' => 'members_mobile' ,'class'=>'large_text', 'id' => 'members_mobile','onkeypress'=>'return isNumberKeyOnly(event)' ,'maxlength' => '10');                  
          echo form_input($mobil_data);	
          echo form_error('members_mobile'); 
          echo '<p id="members_mobile_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>
    
     <!--Member Mobile--> 
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <label for="members_mobile" class="fontweight"> <span style="color:red">*</span><?php echo lang('diet_app_telephone');?></label>
        <h3 class="font_size_17" id="egyptnumber">+20</h3>
        <?php
          $phone_data=array( 'name' => 'members_phone' ,'class'=>'large_text', 'id' => 'members_phone','onkeypress'=>'return isNumberKeyOnly(event)' ,'maxlength' => '9');                  
          echo form_input($phone_data);	
		  echo form_error('members_phone'); 
          echo '<p id="members_phone_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>

<!--Member Email--> 
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

    <label for="members_email" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_email');?></label> 
     <?php 
     
        $data=array( 'name' => 'members_email' ,  'id' => 'members_email' ,'class'=>'large_text' , 'value' =>'' ); 			 
        echo form_input($data);
        echo '<img id="availability_email" class="float_right" src="'.base_url().'images/camera-loader.gif" />';

        echo form_error('members_email');
        echo '<p id="members_email_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        echo '<p id="members_email_validation" class="field_error"></p>'; 
        echo '<p id="members_email_format_error" class="field_error">'.lang('globals_lform_not_vaild_format').'</p>'; 
        ?>
        
        
</div>


<div  class="col-xs-12 col-sm-6 col-md-6 col-lg-6">


    <label for="members_call_time" class="fontweight"> <?php echo lang('diet_app_calltime');?></label> 
   <select name="members_call_time" id="members_call_time">
    <?php
$start = "07:00";
$end = "20:00";

$start_time = strtotime($start);
$end_time = strtotime($end);
$now_time = $start_time;

while($now_time <= $end_time)
{
	if($current_language_db_prefix == "_ar")
	{
		echo '<option value="'.date("H:i",$now_time).'">'.$this->common->arabic_numbers(date(" H : i ",$now_time)).'</option>';
	}
	else
	{
		echo '<option value="'.date("H:i",$now_time).'">'.date(" H : i ",$now_time).'</option>';
	}

  $now_time = strtotime('+30 minutes',$now_time);
}
?>
</select>
<?php
echo form_error('members_call_time');
?>

</div>

<div  class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    
        <?php
            $data = array('name' => 'register','class' => 'bestme_button');
            echo  form_submit($data,lang('mycorner_register'));
         ?>
          
</div>

<?php
 echo form_close();
?>
</div>