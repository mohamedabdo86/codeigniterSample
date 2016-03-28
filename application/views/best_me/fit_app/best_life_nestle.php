<?php
if(!$this->members->members_id)
{
	redirect(site_url('best_me/applications/9/homepage'), 'refresh');
}


$id =  $this->uri->segment(6, 0);
$current_weight = $this->nestlefit->get_weight($id);
$name = $this->members->members_fullname;
$mem_mail=$this->members->members_email;
$mem_id = $this->members->members_id;
$date_of_birth = $this->members->date_of_birth;
$mode_array = $this->nestlefitmodel->get_activities_mode(); // Get activity mode
?>

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
</script>
<script>
$(document).ready(function(e) {
	
	$("#create_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();
		
		if( $("#best_life_name").val() == "" )
		{
			$("#best_life_weight_error").fadeIn("fast");
			$("#best_life_name").css("border","2px solid red");
			state = false;
		}else{
			$("#best_life_name").css("border","none");
			}
		
		if( $("#best_life_birthday").val() == "" )
		{
			$("#best_life_weight_error").fadeIn("fast");
			$("#best_life_birthday").css("border","2px solid red");					 
			state = false;
		}else{
			$("#best_life_birthday").css("border","none");	
			
			}
		
		if( $("#best_life_weight").val() == "" )
		{
			$("#best_life_weight").css("border","2px solid red");
			$("#best_life_weight_error").fadeIn("fast");					 
			state = false;
		}else{
			$("#best_life_weight").css("border","none");
			}
		
		
		if( $("#best_life_height").val() == "" )
		{
			$("#best_life_height").css("border","2px solid red");
			$("#best_life_weight_error").fadeIn("fast");					 
			state = false;
		}else{
			$("#best_life_height").css("border","none");
			}
		
		 
		if( $(" #best_life_activity").val() == " ")
		{
			$("#best_life_activity").css("border","2px solid red"); 
			$("#best_life_weight_error").fadeIn("fast");					 
			state = false;
		}else{
			$("#best_life_activity").css("border","none"); 
			}
		
		
		return state;
	
	
	});    
	
});
</script>

<style>
.app_wrapper
{
	height:525px;
	background-image:url(<?php echo base_url()."images/nestle_fit/nestle_fit_goal_background.jpg"; ?>);
	background-repeat:no-repeat;
	background-position:center top;
	background-size:contain;
	position:relative;
}
.app_header{
top: 188px;
}

.app_sub_header{
top: 205px;
line-height: 1.5;
}
.english #create_form{
top: 255px;
}
</style>

<div class="app_wrapper">
<h2 class="app_header"><?php echo lang('fit_reg_add_your_info'); ?></h2>
<p class="app_sub_header"><?php echo lang('fit_reg_so_we_can_help'); ?></p>
 


<?php
/*
<h2 class="app_header"><?php echo "انت {$calculations['result']} من المتوسط ولصحه افضل ننصح بالوصول  ل {$calculations['normal_weight']} كيلو"; ?></h2>
*/
?>

<?php

    $attributes = array('class' => '', 'id' => 'create_form');
	echo form_open_multipart('ajax/best_life_register',$attributes);
?>
<input type="hidden" name="nestle_fit_health_member_id" value="<?php echo $mem_id; ?>"  />
<input type="hidden" name="nestle_fit_health_member_mail" value="<?php echo $mem_mail; ?>"  />
<div class="nestle_fit_reg_form_field_wrapper">
<?php

$input_name = $name ? $name : '' ;
$input_array = array(
	'name' => 'best_life_name',
	'id' => 'best_life_name',
	'class' => 'form_input_larg',
	'value' => $input_name,
	'maxlength' => '',
	'size' => '',
	'style' => 'margin:0;'
);

echo form_input($input_array);

$member_id = $this->members->members_id;
?>
</div>
<div class="nestle_fit_reg_form_field_wrapper">
<span id="nestle_fit_gender_wrapper_span">
<?php

//echo '<span class="check_box_title_label">النوع</span>';

$data = array(
    'name'        => 'nothing',
    'id'          => 'nothing',
    'checked'     => false,
	'disabled' => 'disabled'
    );

$label_radio =  form_radio($data);

$site_lang = $this->config->item('language');
// For English language appriopriate placement
if($site_lang != "arabic")
{
	echo form_label($label_radio . '<span>' . lang('fit_reg_gender') . '</span>', 'nothing', array('class' =>'check_box_title_label', 'disabled' => 'disabled'));
}

$data = array(
    'name'        => 'best_life_sex',
    'id'          => 'best_life_sex_male',
    'value'       => 'male',
    'checked'     => FALSE,
    );

$male_radio =  form_radio($data);

echo form_label($male_radio . '<span>' . lang('fit_reg_male') . '</span>', 'best_life_sex_male', array('class' =>'check_box_label'));

$data = array(
    'name'        => 'best_life_sex',
    'id'          => 'best_life_sex_female',
	 'value'       => 'female',
    'checked'     => TRUE,
    );

$female_radio =  form_radio($data);

echo form_label($female_radio . '<span>' . lang('fit_reg_female') . '</span>', 'best_life_sex_female', array('class' =>'check_box_label'));

// For arabic language appriopriate placement
if($site_lang == "arabic")
{
	echo form_label($label_radio . '<span>' . lang('fit_reg_gender') . '</span>', 'nothing', array('class' =>'check_box_title_label', 'disabled' => 'disabled'));
}

?>
</span>
</div>
<div class="nestle_fit_reg_form_field_wrapper">
<?php

$date_value= ($date_of_birth && $date_of_birth != "0000-00-00")? $date_of_birth : "1980-01-01";
$input_array = array(
	'name' => 'best_life_age',
	'id' => 'datepicker best_life_birthday',
	'class' => 'form_input_larg datepicker',
	'value' => $date_value,
	'maxlength' => '',
	'size' => '',
	'style' => 'margin:0px 20px 0px 20px;',
	'readonly'=>true
);

echo form_input($input_array);

?>
</div>
<div class="nestle_fit_reg_form_field_wrapper">
<?php

$input_array = array(
	'name' => 'best_life_height',
	'id' => 'best_life_height',
	'class' => 'form_input_larg',
	'placeholder'=>lang('fit_reg_height'),
	'value' => '',
	'maxlength' => '3',
	'size' => '',
	'style' => 'margin:0px 12px 0px 0px; width:142px !important; text-align:center; padding:3px; color:#6f6f6f',
	'onkeypress'=>"return isNumberKey(event)"
);

echo form_input($input_array);

?>
<?php

//onkeypress="return isNumberKey(event)"

$input_array = array(
	'name' => 'best_life_weight',
	'id' => 'best_life_weight',
	'class' => 'form_input_larg',
	'placeholder'=>lang('fit_reg_weight'),
	'value' => '',
	'maxlength' => '3',
	'size' => '',
	'style' => 'margin:0px 0px 0px 0px; width:142px !important; text-align:center; padding:3px; color:#6f6f6f',
	'onkeypress'=>"return isNumberKey(event)"
);

echo form_input($input_array);

?>
</div>
<div class="nestle_fit_reg_form_field_wrapper">
<?php
/*
$dropdown_array = array(
	' ' => '-- مستوى النشاط --',
	'1' => 'مرتفع جداً',
	'2' => 'مرتفع',
	'3' => 'معتدل',
	'4' => 'خفيف',
	'5' => 'منخفض'
); */

$dropdown_array = array(' ' => lang('fit_reg_activity'));
for($i=0; $i<sizeof($mode_array); $i++): 	
	$key = $mode_array[$i]['nestle_fit_health_activity_mode'];
	$dropdown_array[$key] = $mode_array[$i]['nestle_fit_health_activity_mode_title'.$current_language_db_prefix];
endfor;

echo form_dropdown('best_life_activity', $dropdown_array, '', 'class="form_input_larg dir" id="best_life_activity" style="margin:0;"');
?>
</div>
<div class="nestle_fit_reg_form_field_wrapper">
<?php
   	$data = array('name' => 'submit','id' => 'next_button');
   	echo  form_submit($data, lang('fit_reg_proceed'));
?>
</div>
<div style="text-align:center;"><span id="best_life_weight_error" class="field_error" style="margin-top:5px;background-color: rgba(255, 255, 255, 0.75);
padding: 0 5px;"> <?php echo lang("bestcook_field_required");?></span></div>
<?php  echo form_close(); ?> 




</div>
<script>
  function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
$(document).ready(function(e) {
    
	var weight_field_clicked = 0;
	var height_field_clicked = 0;
	
	$("#best_life_weight").click(function (e){
		
		if(weight_field_clicked == 0)
		{
			$("#best_life_weight").val('');
			weight_field_clicked = 1;
		}
	});
	
	$("#best_life_height").click(function (e){
		
		if(height_field_clicked == 0)
		{
			$("#best_life_height").val('');
			height_field_clicked = 1;
		}
	});
	
});

</script>