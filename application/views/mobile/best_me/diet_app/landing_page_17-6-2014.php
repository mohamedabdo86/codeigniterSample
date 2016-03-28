<link rel="stylesheet" href="<?php echo base_url()."css/mycorner.css" ?>" />
<script>
$(document).ready(function(e) {
	
	$('#members_email').change(function(e) {
		var email = $("#members_email").val();
		
		 var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		 if(emailReg.test(email) ) 
		 {

		$("#availability_email").show();
		$.ajax({
			 url:  "<?php echo site_url("ajax/check_valid_email"); ?>",
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
	
			  },
			error: function(xhr, ajaxOptions, thrownError)
			{
				alert('Error');
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
<!--Date picker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript">
$( document ).on( "focus", "input.datepicker", function() {

    $( this ).datepicker({
       changeMonth: true,
      	changeYear: true,
	  	yearRange: '1950:2014',
	  	dateFormat: 'yy-mm-dd',
    });
});

 function isNumberKey(evt)
  {
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;

	 return true;
  }
</script>
<style>
.green_color
{
	color: #197C21 !important;
}
.red_color
{
	color: #e82327 !important;
}
body.arabic #availability_email
{
	position: relative;
	right: -35px;
	top: 8px;
	display:none;
	width: 24px;
}
#availability_email
{
	position: relative;
	right: 35px;
	top: 8px;
	width: 24px;
	display: none;
}
#container_wrapper
{
	width:950px;
	height:700px;
	background-color:#FFFFFF;
}
#login_register_container
{
	width: 388px;
}
</style>

<?php
//$dynamic_id = $this->uri->segment(5);

if(!$this->members->members_id):

echo '<div><img style="margin: 0 137px;" src="'.base_url().'/images/bestme/diet_app_bg'.$current_language_db_prefix.'.jpg" /></div>';
echo '<div >';//style="position: relative;top: -45px;margin-top: -122px;"
$this->load->view('template/view_login_form');
echo '</div>';
return;
endif;




?>
<div id="container_wrapper" >
<?php  
$attributes = array('class' => '', 'id' => 'create_diet_form');
echo form_open_multipart('best_me/submit_app',$attributes);
?>

<div style="width: 720px" class="float_left">
    <!--Member name-->
    <div class="float_left" >
        <label for="name" class="fontweight"><span style="color:red">*</span> <?php echo 'الأسم';?></label> <br/>
        <?php
        $data=array( 'name' => 'members_name' ,'id' => 'members_name','class'=>'large_text' , 'value' => '');                  
        echo form_input($data);	
        echo form_error('members_name'); 
        echo '<p id="members_name_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>
    
     <!--Member Birthday--> 
    <div class="float_right">
        <label for="day" class="fontweight"><?php echo lang('mycorner_birthdate');?>  </label> <br/>
         <?php 
        $data=array( 'name' => 'members_birthdate' , 'id' => 'datepicker', 'class' => 'large_text datepicker' , 'value' => ''); 		 
       echo form_input($data); 
        ?>
    </div>
    <div class="clear"></div>
    <div class="global_sperator_height" style="width:100%"></div>
</div> 

<div class="float_left">

<div class="float_left" >
    <!--Member Gender--> 
    <label for="day" class="fontweight"> <?php echo 'النوع';?> </label> <br/>
    
    <div style="width: 178px;margin-top: 10px;" class="float_left"> 
        <div class="float_left" style="width: 86px;">
            <label style="margin-top: -4px;line-height: 32px;" for="members_gender" class="fontweight float_right"><?php echo 'أنثى'?></label> 
            <?php $data = array( 'name' => 'members_gender' ,'class' => 'radio float_left' , 'value' => 'female' , 'checked'=> TRUE);
                echo form_radio($data);
            ?>
            <div class="clear"></div>
        </div>
        <div class="float_right">
            <label for="members_gender"  style="margin-top: -4px;line-height: 32px;" class="fontweight float_right"> <?php echo 'ذكر'?> </label> 
            <?php $data = array( 'name' => 'members_gender' ,'class' => 'radio float_left' , 'value' => 'male');
            echo form_radio($data);
            ?>
        </div>
    <div class="clear"></div>
    </div>
    
    </div>
 	<!--Member Height--> 
    <div class="float_left" style="margin: 0 26px;">
        <label for="members_height" class="fontweight"><span style="color:red">*</span> <?php echo 'الطول';?></label> <br/>
        <input type="text" maxlength="3"  onkeypress="return isNumberKey(event)"  name="members_height" id="members_height" class="small_text" />

        <?php
          echo '<p id="members_height_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>
    
    <!--Member Weight--> 
    <div class="float_left" style="margin: 0 26px;">
        <label for="members_weight" class="fontweight"><span style="color:red">*</span> <?php echo 'الوزن';?></label> <br/>
        <input type="text" maxlength="3"  onkeypress="return isNumberKey(event)"  name="members_weight" id="members_weight" class="small_text" />
		<?php
          echo '<p id="members_weight_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>
	<div class="clear"></div>
    <div class="global_sperator_height" style="width:100%"></div>
</div>

<div class="float_left">

    <!--Member heathly--> 
    <div class="float_left">
        <label for="members_sport" class="fontweight"><span style="color:red">*</span> <?php echo 'معلومات عن ممارسة الرياضة من عدمها';?></label> <br/>
        <?php
          $healthy_data=array( 'name' => 'members_sport' ,'class'=>'large_text', 'id' => 'members_sport');                  
          echo form_input($healthy_data);	
          echo form_error('members_sport'); 
          echo '<p id="members_sport_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>
    
	<!--Member heathly--> 
    <div class="float_right" style="margin: 0 26px;">
        <label for="members_healthy" class="fontweight"><span style="color:red">*</span> <?php echo 'الحالة الصحية ( سكر , ضغط , قلب ) عمليات و الأدوية الحالية';?></label> <br/>
        <?php
          $healthy_data=array( 'name' => 'members_healthy' ,'class'=>'large_text', 'id' => 'members_healthy');                  
          echo form_input($healthy_data);	
          echo form_error('members_healthy'); 
          echo '<p id="members_healthy_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>
	<div class="clear"></div>
<div class="global_sperator_height" style="width:100%"></div>
</div>

<div style="width: 720px" class="float_left">
     <!--Member Mobile--> 
    <div class="float_left">
        <label for="members_mobile" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_mobile');?></label> <br/>
        <?php
          $mobil_data=array( 'name' => 'members_mobile' ,'class'=>'large_text', 'id' => 'members_mobile');                  
          echo form_input($mobil_data);	
          echo form_error('last_name'); 
          echo '<p id="members_mobile_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>
    
     <!--Member Mobile--> 
    <div class="float_right">
        <label for="members_mobile" class="fontweight"> <span style="color:red">*</span><?php echo 'هاتف المنزل';?></label> <br/>
        <?php
          $phone_data=array( 'name' => 'members_phone' ,'class'=>'large_text', 'id' => 'members_phone');                  
          echo form_input($phone_data);	
		  echo form_error('members_phone'); 
          echo '<p id="members_phone_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>
    <div class="clear"></div>
    <div class="global_sperator_height" style="width:100%"></div>
</div>



<!--Member Email--> 
<div class="float_left">

    <label for="members_email" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_email');?></label> <br/>
     <?php 
         if($current_language_db_prefix == "_ar")
         {
             echo '<img id="availability_email" src="'.base_url().'images/camera-loader.gif" />';
         }
     
        $data=array( 'name' => 'members_email' ,  'id' => 'members_email' ,'class'=>'large_text' , 'value' =>'' ); 			 
        echo form_input($data);
        if(!$current_language_db_prefix == "_ar")
        {
            echo '<img id="availability_email" src="'.base_url().'images/camera-loader.gif" />';
        }
        
        echo form_error('members_email');
        echo '<p id="members_email_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        echo '<p id="members_email_validation" class="field_error"></p>'; 
        echo '<p id="members_email_format_error" class="field_error">'.lang('globals_lform_not_vaild_format').'</p>'; 
        ?>
        
        
</div>
<div class="clear"></div>
<div class="global_sperator_height" style="width:100%"></div>

<div  class="float_left">


    <label for="members_call_time" class="fontweight"> <?php echo 'الميعاد المناسب لاتصال طبيب نستله بك لجمع المعلومات المطلوبة';?></label> <br/>
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

</div>
<div class="clear"></div>
<div class="global_sperator_height" style="width:100%"></div>

<div  class="float_left">
    
    <div> 
        <?php
            $data = array('name' => 'register','class' => 'bestme_button');
            echo  form_submit($data,lang('mycorner_register'));
         ?>
          
    </div>
   </div>
  <div class="clear"></div>


<?php
 echo form_close();
?>
</div>