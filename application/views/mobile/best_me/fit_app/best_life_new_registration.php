<?php
if(!$this->members->members_id)
{
	redirect(site_url('mobile/best_me/applications/9/homepage'), 'refresh');
}
$mode_array = $this->nestlefitmodel->get_activities_mode(); 
?>
<script>
$(document).ready(function(e) {
	
	$("#create_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();
		
		if( $("#best_life_height").val() == "" )
		{
			$("#best_life_weight_error").fadeIn("fast");
			$("#best_life_height").css("border","2px solid red");
			state = false;
		}else{
			$("#best_life_height").css("border","none");
			}
			
			
		
		if( $("#best_life_weight").val() == "" )
		{
			$("#best_life_weight_error").fadeIn("fast");
			$("#best_life_weight").css("border","2px solid red");					 
			state = false;
		}else{
			$("#best_life_weight").css("border","none");	
			
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
      echo form_open('ajax/best_life_new_register_mobile', $attributes);?>
      <input type="hidden" name="nestle_fit_health_member_mail" value="<?php echo $this->members->members_email; ?>"  />
      <input type="hidden" name="nestle_fit_health_id" value="<?php echo $members_data[0]['nestle_fit_health_ID']; ?>"  />
      <div class="form-group">
      <div class="col-sm-12">
        <?php
        $input_array = array(
	'name' => 'best_life_height',
	'id' => 'best_life_height',
	'class' => '',
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
	'class' => '',
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

echo form_dropdown('best_life_activity', $dropdown_array, '', 'class="form_input_larg" id="best_life_activity" ');
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

</script><script>

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