<?php
if(!$this->members->members_id)
{
	redirect(site_url('best_me/applications/9/homepage'), 'refresh');
}

$id = $this->uri->segment(6, 0);
$current_weight = round($this->nestlefit->get_weight($id)); // Get Current weight
$ideal_weight = round($this->nestlefit->get_ideal_weight($id)); // Get Ideal Weight

$nestle_fit_progress_data = $this->nestlefit->get_nestle_fit_progress();

//print_r($nestle_fit_progress_data);
?>
<script>
$(document).ready(function(e) {
	
	$("#second_step_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();
		
		var radio_val = $('input[name=nestle_fit_progress]:checked').val();
		
		if(radio_val != 2)
		{
			if( $("#best_life_week_change").val() == 0 )
			{
				$("#best_life_weight_error").fadeIn("fast");
				$("#best_life_week_change").css("border","2px solid red");
				state = false;
			}
			else
			{
				$("#best_life_week_change").css("border","none");
			}
		}
			
		return state;
	
	
	});    
	
});
</script>

<style>
.app_wrapper {
	height: 520px;
 	background-image:url(<?php echo base_url() . "images/nestle_fit/nestle_fit_goal_background.jpg";?>);
	background-repeat: no-repeat;
	background-position: center top;
	background-size: contain;
	position: relative;
}
.normal_weight {
	color: #fff;
	text-align: center;
	font-size: 44px;
}
.form_label {
	color: #CCC;
}
#second_step_form input, #create_form select 
{
	border: none;
}
#second_step_form label {
	color: white;
}
#second_step_form input {
	height: 30px;
}
#second_step_form .progress_data 
{
	line-height: 28px;
}

#second_step_form .progress_data input {
	height: 13px;
}

#second_step_form select {
	height: 30px;
}
.arabic #second_step_form .progress_data input {
height: 30px;
}
.arabic #second_step_form .progress_data label{
float: right;
}
#second_step_form input[type="submit"] {
	background-color: #98ca00;
	color: #fff;
	font-weight: bold;
	margin-top: 4px;
	border-radius: 22px;
	-webkit-border-radius: 22px;
	-moz-border-radius: 22px;
	border: none;
}
.form_input_larg {
	width: 300px;
}
.form_input_small {
	width: 100px;
	background-color: #98ca00;
	color: #fff;
	font-weight: bold;
}
.arrow-up_yellow {
	width: 0;
	height: 0;
	border-style: solid;
	border-width: 10px 10px 0 10px;
	border-color: #ffffff transparent transparent transparent; 
	margin: 1px 50px;
    margin-left: 53px;
}
.arrow-up_yellow2 {
	width: 0;
	height: 0;
	border-style: solid;
	border-width: 10px 10px 0 10px;
	border-color: #ffffff transparent transparent transparent;
	margin: 1px 50px;
	margin-left: 190px;
	margin-top: 5px;
}
.arrow-up_yellow3 {
	width: 0;
	height: 0;
	border-style: solid;
	border-width: 10px 10px 0 10px;
	border-color: #ffffff transparent transparent transparent;
	margin: 1px 50px;
    margin-left: 322px;
}
#your_goal
{
	line-height:25px;
}
.arabic select{
direction: rtl;
}
.english .bmi_diagram {
	float: right !important;
}
.english .arrow-up_yellow3 {
	margin-left: 45px;
}
.english .arrow-up_yellow {
	float: right;
	margin-right: 42px;
}
.english #best_life_weight_error
{
	 margin-left: 30px;
}
</style>

<div class="app_wrapper">
  <div style="width: 400px;margin: 0px 30%;padding-top: 145px;">
    <?php    
    if($current_weight >= $ideal_weight)
	{
		$differ_wight = $current_weight - $ideal_weight;
	}
	else
	{
		$differ_wight = $ideal_weight - $current_weight;
	}

     $age = $this->nestlefit->get_age_from_date_of_birth($members_data[0]['nestle_fit_health_birthday']);

	 $height_in_meter=$members_data[0]['nestle_fit_health_height']/100;
	 $double_height = $height_in_meter * $height_in_meter;
	 $BMI = round($current_weight/$double_height, 2);
	 $advice_text=""; 

	if($BMI > 24.9)
	{
		 echo " <div class=\"arrow-up_yellow\" style=\"display:flex;\">&nbsp;</div>";
		 $advice_text=lang('fit_overweight_range'); 
	}
	else if($BMI < 18.5)
	{
		  echo " <div class=\"arrow-up_yellow3\" style=\"display:flex;\">&nbsp;</div>";	 
		  $advice_text=lang('fit_underweight_range'); 
	}
	else
	{
		echo " <div class=\"arrow-up_yellow2\" style=\"display:flex;\">&nbsp;</div>";
		$advice_text=lang('fit_normal_range'); 
	}
				  		  

     ?>
    <div class="clear"></div>
      <ul style="margin-top:2px;">
        <li class="bmi_diagram" style="background:#FF0C0C;width:33.333%; height:25px;float:left;  box-shadow: -1px -1px 1px #2E7245;">&nbsp;</li>
        <li class="bmi_diagram"style="background:#a3c500;width:33.333%;height:25px;float:left;  box-shadow: -1px -1px 1px #2E7245;">&nbsp;</li>
        <li class="bmi_diagram"style="background:#fdfdfd;width:33.333%; height:25px;float:left;  box-shadow: -1px -1px 1px #2E7245;">&nbsp;</li>
      </ul>
    
   <div class="clear"></div>
   <h2 class="fit_reg_perfect_weight" style="white-space: normal;color: white; line-height: 1.2; font-size:20px;padding-top: 3px;"><?php echo $advice_text ." "."<u>" .$BMI. "</u>"; ?></h2>
    <?php
        $attributes = array('class' => '', 'id' => 'second_step_form');
        echo form_open_multipart('ajax/best_life_next_step', $attributes);
        ?>
        <div class="progress_data">
          <?php 
			//echo $current_language_db_prefix;
        if($BMI > 24.9)
		{
		  	echo "<div><label>".$nestle_fit_progress_data[0]['nestle_fit_progress_text'.$current_language_db_prefix]."</label>"."<input type='radio' name='nestle_fit_progress' value='".$nestle_fit_progress_data[0]['nestle_fit_progress_ID']."' checked disabled='disabled'></div>";	   
			echo '<div class="clear"></div>';
			$select_default=lang('fit_reg_how_much_weight');
		}
		else if($BMI < 18.5)
		{
		  	echo "<div class='float_left'><label>".$nestle_fit_progress_data[2]['nestle_fit_progress_text'.$current_language_db_prefix]."</label>"."<input type='radio' name='nestle_fit_progress' value='".$nestle_fit_progress_data[2]['nestle_fit_progress_ID']."' checked onchange='show_inputs();'></div>";
		  	echo "<div class='float_right'><label>".$nestle_fit_progress_data[1]['nestle_fit_progress_text'.$current_language_db_prefix]."</label>"."<input type='radio' name='nestle_fit_progress' value='".$nestle_fit_progress_data[1]['nestle_fit_progress_ID']."' onchange='disable_inputs();'></div>"; 
	    	echo '<div class="clear"></div>';
			
			$select_default=lang('fit_reg_how_much_weight_gain');
		}
		else
		{
			if($current_weight > $ideal_weight)
			{
				echo "<div class='float_left'><label>".$nestle_fit_progress_data[0]['nestle_fit_progress_text'.$current_language_db_prefix]."</label>"."<input type='radio' name='nestle_fit_progress' value='".$nestle_fit_progress_data[0]['nestle_fit_progress_ID']."' checked onchange='show_inputs();'></div>";	
		  		echo "<div class='float_right'><label>".$nestle_fit_progress_data[1]['nestle_fit_progress_text'.$current_language_db_prefix]."</label>"."<input type='radio' name='nestle_fit_progress' value='".$nestle_fit_progress_data[1]['nestle_fit_progress_ID']."' onchange='disable_inputs();'></div>";
				echo '<div class="clear"></div>';
				$select_default=lang('fit_reg_how_much_weight');	
			}
			else
			{
				echo "<div class='float_left'><label>".$nestle_fit_progress_data[2]['nestle_fit_progress_text'.$current_language_db_prefix]."</label>"."<input type='radio' name='nestle_fit_progress' value='".$nestle_fit_progress_data[2]['nestle_fit_progress_ID']."' checked onchange='show_inputs();'></div>";
				echo "<div class='float_right'><label>".$nestle_fit_progress_data[1]['nestle_fit_progress_text'.$current_language_db_prefix]."</label>"."<input type='radio' name='nestle_fit_progress' value='".$nestle_fit_progress_data[1]['nestle_fit_progress_ID']."' onchange='disable_inputs();'></div>"; 
				echo '<div class="clear"></div>';
				
				$select_default=lang('fit_reg_how_much_weight_gain');

			}
	
		}
		?>
       </div> 
       <div class="clear"></div>
    <div id="your_goal">
      <div class="first_row">
        <label for="best_life_goal"><?php echo lang('fit_your_goal');?></label>
      </div>
      <div class="second_row">
        <input class="form_input_larg"  value="<?php echo $ideal_weight;?>" onkeypress="return isNumberKey(event)" id="best_life_goal" maxlength="3" name="best_life_goal" onchange="updateweightdiffer()" style="text-align:center; padding:3px; color:#6f6f6f">
      </div>
    </div>
    <div id="weight_differ">
      <div class="first_row">
        <label for="best_life_goal"><?php echo lang('fit_weight_difference');?></label>
      </div>
      <div class="second_row">
        <input class="form_input_larg" value="<?php echo $differ_wight; ?>" id="best_life_differ_weight" name="weight_differ" style="text-align:center; padding:3px; color:#6f6f6f" readonly="readonly">
      </div>
    </div>
    <input type="hidden" name="nestle_fit_calculations_fit_health_id" value="<?php echo $id ?>"  />
    <div id="your_week_change">
      <div class="first_row">
        <label for="best_life_week_chang"><?php echo lang('fit_weekly_change');?></label>
      </div>
      <div class="second_row">
        <select class="form_input_larg" id="best_life_week_change" name="best_life_week_change" style="text-align:center; ">
          <?php
                echo "<option value='0'>".$select_default."</option>";
                echo "<option value='0.25'>1/4"." ".lang('fit_weight_unit')."</option>";
                echo "<option value='0.5'>1/2"." ".lang('fit_weight_unit')."</option>";	
				echo "<option value='1'>1"." ".lang('fit_weight_unit')."</option>";				               
                ?>
        </select>
      </div>
    </div>
    <input type="hidden" id="estimated_days" name="estimated_days" />
     <input type="hidden" id="best_life_estimated_date" name="best_life_estimated_date"/>

     <input type="hidden" id="nestle_fit_health_sex" name="nestle_fit_health_sex"  value="<?php echo $members_data[0]['nestle_fit_health_sex'];?>"/>
     <input type="hidden" id="nestle_fit_health_weight" name="nestle_fit_health_weight"  value="<?php echo $current_weight;?>"/>
     <input type="hidden" id="nestle_fit_health_height" name="nestle_fit_health_height"  value="<?php echo $members_data[0]['nestle_fit_health_height'];?>"/>
     <input type="hidden" id="nestle_fit_health_activity" name="nestle_fit_health_activity"  value="<?php echo $members_data[0]['nestle_fit_health_activity'];?>"/>
     <input type="hidden" id="nestle_fit_health_birthday" name="nestle_fit_health_birthday"  value="<?php echo $age ;?>"/>
    <div id="save_form">
      <?php
            $data = array('name' => 'submit', 'id' => 'next_button');
            echo form_submit($data, lang('fit_reg_start_now'));
            ?>
    </div>
    <div style="text-align:center; margin-top: -25px;"><span id="best_life_weight_error" class="field_error" style="margin-top:5px;background-color: rgba(255, 255, 255, 0.75);
padding: 0 5px;"> <?php echo lang("bestcook_field_required");?></span></div>
    <?php echo form_close(); ?> </div>
</div>
<script>
//this function is add and use , by bermawy 08-04-2015
function disable_inputs()
{
	$("#best_life_goal").prop('disabled', true);
	$("#best_life_goal").val(<?php echo $current_weight; ?>);
	$("#best_life_differ_weight").prop('disabled', true);
	$("#best_life_differ_weight").val(0);
	$("#best_life_week_change").prop('disabled', true);
	$("#best_life_week_change").val(0);
}
function show_inputs()
{
	$("#best_life_goal").prop('disabled', false);
	$("#best_life_goal").val(<?php echo $ideal_weight; ?>);
	$("#best_life_differ_weight").prop('disabled', false);
	$("#best_life_differ_weight").val(<?php echo $differ_wight; ?>);
	$("#best_life_week_change").prop('disabled', false);
	$("#best_life_week_change").val(0);
}	
//this functiom allow only to enter numbers in the inputs
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;

	return true;
}
//this function is update the weight diffrence when user change the weight goal
function updateweightdiffer()
{
 var current_weight = <?php echo $current_weight; ?>;
 var weight_goal = $("#best_life_goal").val();
 var weight_loss = 0;
	if(current_weight >= weight_goal)
	{
	 weight_loss = current_weight - weight_goal;
	}
	else
	{
	  weight_loss = weight_goal - current_weight;	
	}
   $("#best_life_differ_weight").val(weight_loss);

}

</script>

