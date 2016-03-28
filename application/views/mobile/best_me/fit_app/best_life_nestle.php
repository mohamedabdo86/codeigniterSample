<?php
if(!$this->members->members_id)
{
   redirect(site_url('mobile/best_me/applications/9/homepage'), 'refresh');
}


$id =  $this->uri->segment(7, 0);
//$calculations = $this->nestlefit->get_calculations($id);
//$current_weight = $calculations['current_weight'];
$current_weight = $this->nestlefit->get_weight($id);
//$start_weight = $current_weight - 10;
//$end_weight = $current_weight + 10;

$name = $this->members->members_fullname;
$mem_mail=$this->members->members_email;
$mem_id = $this->members->members_id;
$date_of_birth = $this->members->date_of_birth;
$mode_array = $this->nestlefitmodel->get_activities_mode();
?>
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

<div class="row nestle_fit_register">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 190px;">
    <h2 class="app_header" style="color:black; text-align:center;"><?php echo lang('fit_reg_add_your_info'); ?></h2>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <p class="app_sub_header" style="color:white; text-align:center;"><?php echo lang('fit_reg_so_we_can_help'); ?></p>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4 form-position">
    <?php  $attributes = array('class' => 'form-horizontal dir', 'id' => 'create_form' , 'role'=>'form', 'data-ajax'=>'false');
      echo form_open('ajax/best_life_register_mobile', $attributes);?>
    <input type="hidden" name="nestle_fit_health_member_id" value="<?php echo $mem_id; ?>"  />
    <input type="hidden" name="nestle_fit_health_member_mail" value="<?php echo $mem_mail; ?>"  />
    <div class="form-group">
      <div class="col-sm-12">
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
    </div>
     <div class="form-group" style="margin-bottom:0; padding-bottom:0;">
   
      <div class="col-xs-12 col-sm-12" style="margin-bottom:0; padding-bottom:0;">
      <label style="color:white;"><?php echo lang('fit_reg_gender');?></label>
      </div>
      </div>
    <div class="form-group">
   
      <div class="col-xs-12 col-sm-12 gender"> 
     
          <div class="col-xs-6 col-sm-6">
          <?php
		  $data = array(
            'name'        => 'best_life_sex',
            'id'          => 'best_life_sex_male',
            'value'       => 'male',
            'checked'     => FALSE,
            );

            $male_radio =  form_radio($data); 
			echo form_label($male_radio . '<span>' . lang('fit_reg_male') . '</span>', 'best_life_sex_male', array('class' =>'check_box_label'));
		  ?> 
          </div>
           <div class="col-xs-6 col-sm-6">
            <?php
		      $data = array(
              'name'        => 'best_life_sex',
              'id'          => 'best_life_sex_female',
	          'value'       => 'female',
              'checked'     => TRUE,
             );

            $female_radio =  form_radio($data);
			echo form_label($female_radio . '<span>' . lang('fit_reg_female') . '</span>', 'best_life_sex_female', array('class' =>'check_box_label'));
		  ?>  
           </div> 
      </div>
    </div>
    
        <div class="form-group">
      <div class="col-sm-12">
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
    </div>
    
    
    <div class="form-group">
      <div class="col-sm-12">
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
      </div>
    </div>
    
     <div class="form-group">
      <div class="col-sm-12">
        <?php
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
    </div>
    
    <div class="form-group">
      <div class="col-sm-12">
        <?php
$dropdown_array = array(' ' => lang('fit_reg_activity'));
for($i=0; $i<sizeof($mode_array); $i++): 	
	$key = $mode_array[$i]['nestle_fit_health_activity_mode'];
	$dropdown_array[$key] = $mode_array[$i]['nestle_fit_health_activity_mode_title'.$current_language_db_prefix];
endfor;

echo form_dropdown('best_life_activity', $dropdown_array, '', 'class="form_input_larg dir" id="best_life_activity" style="margin:0;"');
		  ?>
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-sm-12">
        <?php
   	$data = array('name' => 'submit','id' => 'next_button');
   	echo  form_submit($data, lang('fit_reg_proceed'));

		  ?>
      </div>
    </div>
    <div style="text-align:center;"><span id="best_life_weight_error" class="field_error" style="margin-top:5px;background-color: rgba(255, 255, 255, 0.75);
padding: 0 5px;"> <?php echo lang("bestcook_field_required");?></span></div>
<?php  echo form_close(); ?> 
  </div>
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

