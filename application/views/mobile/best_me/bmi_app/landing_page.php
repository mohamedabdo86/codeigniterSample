<style>
.input_choice {
	border: solid #ccc 1px;
	height: 50px;
}
.ui-input-text.ui-body-inherit.ui-corner-all.ui-shadow-inset {
	background: none;
	border: none;
	box-shadow: none;
}
#bmi_calculator_value {
	height: 88px;
	width: 212px;
	border: none;
	text-align: center;
	line-height: 85px;
	font-size: 40px;
	color: #77a618;
	font-family: Myriad Pro;
	margin: 0 auto;
	background-color: #ccc !important;
}
.input_choice span {
	float: left;
}
.input_choice span img {
	height: 45px !important;
}
.input-float, .input-label, .input-unit {
	float: right;
}
.input-float {
	margin-right: 30px;
	margin-top: 15px;
}
.input-label {
	margin-top: 15px;
	margin-right: 10px;
	text-indent: 10px;
}
/*p{
	text-indent: 15px;
}*/
#height, #weight {
	background-color: rgb(207, 207, 207);
	width: 100px;
	margin-top: -10px;
	color: white;
}
.input-unit {
	padding: 15px;
}
.bmi_border_radius {
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
}
#calculate_bmi {
	width: 100%;
	height: 50px;
	display: block;
	line-height: 50px;
	cursor: pointer;
	color: white;
	text-align: center;
}
#bmi_main_wrapper {
	width: 100%;
	height: auto;
	border: solid #ccc 1px;
	-webkit-box-shadow: 1px 1px 11px 0px rgba(50, 50, 50, 0.75);
	-moz-box-shadow: 1px 1px 11px 0px rgba(50, 50, 50, 0.75);
	box-shadow: 1px 1px 11px 0px rgba(50, 50, 50, 0.75);
	overflow: hidden;
}
.bmi_button {
	width: 96%;
	height: 50px;
	padding: 2%;
	border: solid #ccc 1px;
	background: #658e15;
}
.results_status {
	display: none;
}
.english .input_choice span {
	float: right;
}
.english .input-float, .english .input-label, .english .input-unit {
	float: left;
}
</style>
<script>
$(document).ready(function(e) {
    
	$("#calculate_bmi").click(function(e) {
        
		$(".results_status").hide();
		
		var weight = $("#weight").val();
		var height = $("#height").val();
		
		if(weight == 0 || height ==0 )return;
		
		height = height / 100 ;
		var power_height = height * height;
		var result = weight / power_height;
		result = result.toFixed(2);
		result_index = -1;
		$("#bmi_calculator_value").val(result);
		if( result >= 30 )
		{
			result_index = 3;
		}
		if( result <= 29.9 && result >= 25  )
		{
			result_index = 2;
		}
		if( result <= 24.9 && result >= 18.5  )
		{
			result_index = 1;
		}
		if( result <= 18.5  )
		{
			result_index = 0;
		}
		
		//Show result text
		$(".results_status[id="+result_index+"]").fadeIn("slow");
		
    });
});
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    } else {
        return true;
    }      
}
</script>
<?php 
$first_push_pull = $current_language_db_prefix == '_ar' ? 'col-sm-push-6 col-md-push-6 col-lg-push-6' : '';
$second_push_pull = $current_language_db_prefix == '_ar' ? 'col-sm-pull-6 col-md-pull-6 col-lg-pull-6' : '';
?>
<div class="row">
  <div calss="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <p style="white-space:normal"><?php echo $display_data[0]['applications_desc'.$current_language_db_prefix] ?></p>
  </div>
 </div> 
  <div id="bmi_main_wrapper" class="bmi_border_radius">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 <?php echo $first_push_pull;?>">
        <div class="row">
          <div class="col-sm-12 input_choice">
            <div class="input-float">
              <input type="radio" name="gender" value="female" checked="checked" class="float_left" />
            </div>
            <div class="input-label">
              <p> <?php echo lang("bestme_bmi_female"); ?></p>
            </div>
            <span> <img class="img-responsive" src="<?php echo base_url()."images/bestme/bmi_female.png" ?>" /></span> </div>
          <div class="col-sm-12 input_choice">
            <div class="input-float">
              <input type="radio" name="gender" value="male"  class="float_left" />
            </div>
            <div class="input-label">
              <p> <?php echo lang("bestme_bmi_male"); ?></p>
            </div>
            <span> <img class="img-responsive" src="<?php echo base_url()."images/bestme/bmi_meter.png" ?>" /></span> </div>
          <div class="col-sm-12 input_choice">
            <div class="input-label"> <?php echo lang("bestme_bmi_height"); ?> </div>
            <div class="input-float">
              <input type="text" maxlength="3"  onkeypress="return isNumberKey(event)"  name="height" placeholder="0" id="height" class="float_left textbox" />
            </div>
            <div class="input-unit"> <?php echo lang("bestme_bmi_cm"); ?> </div>
            <span> <img class="img-responsive" src="<?php echo base_url()."images/bestme/bmi_meter.png" ?>" /></span> </div>
          <div class="col-sm-12 input_choice">
            <div class="input-label"> <?php echo lang("bestme_bmi_weight"); ?> </div>
            <div class="input-float">
              <input type="text" maxlength="3"  onkeypress="return isNumberKey(event)"  name="weight" placeholder="0" id="weight" class="float_left textbox"  />
            </div>
            <div class="input-unit"> <?php echo lang("bestme_bmi_kilo"); ?> </div>
            <span> <img class="img-responsive" src="<?php echo base_url()."images/bestme/bmi_weight.png" ?>" /></span> </div>
          <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xs-offset-4 col-sm-offset-5 col-md-offset-5 col-lg-offset-5" style="margin-top: 5px;"> <a id="calculate_bmi" class="bmi_button bmi_border_radius best_me_background_color white_color"> <?php echo lang("bestme_bmi_calculate"); ?> </a> </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 <?php echo $second_push_pull;?>">
        <div class="row">
          <div class="col-sm-12">
            <p><?php echo lang("bestme_bmi_yourbmiis"); ?></p>
          </div>
          <div class="col-sm-12" align="center">
            <input type="text"  id="bmi_calculator_value" class="bmi_border_radius" value="0" readonly="readonly" />
          </div>
          <div class="col-sm-12">
              <p><?php echo lang("bestme_bmi_title_0"); ?></p>
              <p><?php echo lang("bestme_bmi_title_1"); ?></p>
              <p><?php echo lang("bestme_bmi_title_2"); ?></p>
              <p><?php echo lang("bestme_bmi_title_3"); ?> </p>
          </div>
          <div class="col-sm-12">
            <p class="best_me_color"> <span class="results_status" id="0"><?php echo lang("bestme_bmi_desc_0"); ?></span> <span class="results_status" id="1"><?php echo lang("bestme_bmi_desc_1"); ?></span> <span class="results_status" id="2"><?php echo lang("bestme_bmi_desc_2"); ?></span> <span class="results_status" id="3"><?php echo lang("bestme_bmi_desc_3"); ?></span> </p>
          </div>
        </div>
      </div>
   </div>
  </div>

