<!-- This page is not check availability_email  last modify 1/9/2015 By Ayman -->

<link rel="stylesheet" href="<?php echo base_url()."css/mycorner.css" ?>" />
<script>
$(document).ready(function(e) {		
	$("#create_diet_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();


		if( $("#members_name").val() == "" ) {
			$("#members_name_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#members_height").val() == "" ) {
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
		
		if( $("#members_email").val() == "" )
		{
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
	height:auto;
	background-color:#FFFFFF;
}
#login_register_container
{
	width: 388px;
}
body.english #members_mobile, body.english #members_phone{text-indent: 50px;}
body.arabic input[type="text"]#egyptnumber {margin-left: 9px !important;}
</style>

<?php
//$dynamic_id = $this->uri->segment(5);

if(!$this->members->members_id):

echo '<div style="height:365px; width:952px;"><img style="margin: 0 137px;" src="'.base_url().'images/bestme/diet_app_bg'.$current_language_db_prefix.'.jpg" /></div>';
echo '<div style="position: relative;top: -90px" >';
$this->load->view('template/view_login_form_toggle');
echo '</div>';
return;
endif;




?>
<div id="container_wrapper" >
<?php  
$attributes = array('class' => '', 'id' => 'create_diet_form');
echo form_open_multipart('best_me/submit_app',$attributes);
?>

<div style="width: 720px; margin-bottom:10px;" class="float_left">
    <!--Member name-->
    <div class="float_left" >
        <label for="name" class="fontweight"><span style="color:red">*</span> <?php echo lang('diet_app_name');?></label> <br/>
        <?php
        $data=array( 'name' => 'members_name' ,'id' => 'members_name','class'=>'large_text' , 'value' => '', 'onkeypress' => "return onlyAlphabetsAndSpace(event)");                  
        echo form_input($data);	
        echo form_error('members_name'); 
        echo '<p id="members_name_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>
    
     <!--Member Birthday--> 
    <div class="float_right">
        <label for="members_birthdate" class="fontweight"><?php echo lang('mycorner_birthdate');?>  </label> <br/>
         <?php 
        $data=array( 'name' => 'members_birthdate' , 'id' => 'datepicker', 'class' => 'large_text datepicker' , 'value' => ''); 		 
       echo form_input($data); 
	   echo form_error('members_birthdate'); 
        ?>
    </div>
    <div class="clear"></div>
    <div class="global_sperator_height" style="width:100%"></div>
</div> 

<div class="float_left" style="margin-bottom:10px;">

<div class="float_left" >
    <!--Member Gender--> 
    <label for="members_gender" class="fontweight"> <?php echo lang('diet_app_type');?> </label> <br/>
    
    <div style="width: 178px;margin-top: 10px;" class="float_left"> 
        <div class="float_left" style="width: 95px;">
            <label style="margin-top: -4px;line-height: 32px;" for="members_gender" class="fontweight float_right"><?php echo lang('diet_app_female');?></label> 
            <?php $data = array( 'name' => 'members_gender' ,'class' => 'radio float_left' , 'value' => 'female' , 'checked'=> TRUE);
                echo form_radio($data);
            ?>
            <div class="clear"></div>
        </div>
        <div class="float_right">
            <label for="members_gender"  style="margin-top: -4px;line-height: 32px;" class="fontweight float_right"> <?php echo lang('diet_app_male');?> </label> 
            <?php $data = array( 'name' => 'members_gender' ,'class' => 'radio float_left' , 'value' => 'male');
            echo form_radio($data);
            ?>
        </div>
    <div class="clear"></div>
    </div>
    
    </div>
 	<!--Member Height--> 
    <div class="float_left" style="margin: 0 26px;">
        <label for="members_height" class="fontweight"><span style="color:red">*</span> <?php echo lang('diet_app_height');?></label> <br/>
        <input type="text" maxlength="3"  onkeypress="return isNumberKey(event)"  name="members_height" id="members_height" class="small_text" />

        <?php
          echo '<p id="members_height_error" class="field_error">'. lang("bestcook_field_required").'</p>';
		  echo form_error('members_height');
        ?>
    </div>
    
    <!--Member Weight--> 
    <div class="float_left" style="margin: 0 26px;">
        <label for="members_weight" class="fontweight"><span style="color:red">*</span> <?php echo lang('diet_app_weight');?></label> <br/>
        <input type="text" maxlength="3"  onkeypress="return isNumberKey(event)"  name="members_weight" id="members_weight" class="small_text" />
		<?php
          echo '<p id="members_weight_error" class="field_error">'. lang("bestcook_field_required").'</p>';
		  echo form_error('members_weight');
        ?>
    </div>
	<div class="clear"></div>
    <div class="global_sperator_height" style="width:100%"></div>
</div>

<div class="float_left">

    <!--Member Sport--> 
    <div class="float_left" style="margin-bottom:10px;">
        <label for="members_sport" class="fontweight"><span style="color:red">*</span> <?php echo lang('diet_app_sport');?></label> <br/>
        <?php
          $healthy_data=array( 'name' => 'members_sport' ,'class'=>'large_text', 'id' => 'members_sport');                  
          echo form_input($healthy_data);	
          echo form_error('members_sport'); 
          echo '<p id="members_sport_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>
    
	<!--Member heathly--> 
    <div class="float_left" style="margin-bottom:10px; margin-right:25px;">
        <label for="members_healthy" class="fontweight"><span style="color:red">*</span> <?php echo lang('diet_app_healthy');?></label> <br/>
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

<div style="width: 720px; margin-bottom:10px;" class="float_left" >
     <!--Member Mobile--> 
    <div class="float_left">
        <label for="members_mobile" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_mobile');?></label> <br/>
        <input type="text" class="font_size_17" id="egyptnumber" value="+20" readonly="readonly" />
        <?php
          $mobil_data=array( 'maxlength' => '10' ,'name' => 'members_mobile' ,'class'=>'large_text', 'id' => 'members_mobile','onkeypress'=>'return isNumberKeyOnly(event)');                  
          echo form_input($mobil_data);	
          echo form_error('members_mobile'); 
          echo '<p id="members_mobile_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>
    
     <!--Member Mobile--> 
    <div class="float_right">
        <label for="members_phone" class="fontweight"> <span style="color:red">*</span><?php echo lang('diet_app_telephone');?></label> <br/>
        <input type="text" class="font_size_17" id="egyptnumber" value="+20" readonly="readonly" />
        <?php
          $phone_data=array( 'maxlength' => '9' ,'name' => 'members_phone' ,'class'=>'large_text', 'id' => 'members_phone','onkeypress'=>'return isNumberKeyOnly(event)');                  
          echo form_input($phone_data);	
		  echo form_error('members_phone'); 
          echo '<p id="members_phone_error" class="field_error">'. lang("bestcook_field_required").'</p>';
        ?>
    </div>
    <div class="clear"></div>
    <div class="global_sperator_height" style="width:100%"></div>
</div>



<!--Member Email--> 
<div class="float_left" style="margin-bottom:10px;">

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
        echo '<p id="members_email_format_error" class="field_error">'.lang('globals_lform_not_vaild_format').'</p>'; 
        ?>
        
        
</div>
<div class="clear"></div>
<div class="global_sperator_height" style="width:100%"></div>

<div  class="float_left">


    <label for="members_call_time" class="fontweight"> <?php echo lang('diet_app_calltime');?></label> <br/>
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