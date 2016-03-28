<style>
#bmi_main_wrapper
{
	width:100%;
	height:auto;
	border:solid #ccc 1px;
	-webkit-box-shadow: 1px 1px 11px 0px rgba(50, 50, 50, 0.75);
	-moz-box-shadow:    1px 1px 11px 0px rgba(50, 50, 50, 0.75);
	box-shadow:         1px 1px 11px 0px rgba(50, 50, 50, 0.75);
}
#bmi_main_wrapper .inner_margin
{
	margin:45px;
}
.bmi_border_radius
{
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
}
.bmi_button
{
	width:96%;
	height:50px;
	padding:2%;
	border:solid #ccc 1px;
}
.bmi_button input { margin-top:20px;}
.bmi_button .textbox {width: 35px;text-align: center;margin-top:15px;}
.bmi_button .title{ margin: 12px 15px 0px;}
.side_bar
{
	width:225px;
	height:auto;
}
.main_container
{
	width:620px;
	height:auto;
	border:solid #ccc 1px;
	min-height:331px;
	
}
#bmi_calculator_value
{
	height: 88px;
	width: 212px;
	border: none;
	text-align: center;
	line-height: 85px;
	font-size: 40px;
	color: #77a618;
	font-family: Myriad Pro;
	margin:0 auto;
	background-color:#ccc;
}
#calculate_bmi
{
	width:100%;
	height:50px;
	display:block;
	line-height:50px;
	cursor:pointer;
}
.results_status { display:none;}
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
<p style="white-space:normal"><?php echo $display_data[0]['applications_desc'.$current_language_db_prefix] ?></p>

<div style="width:100%; height:7px;"></div>

<div id="bmi_main_wrapper" class="bmi_border_radius">

    <div class="inner_margin">

	<div class="side_bar float_left" >
    
    <div class="bmi_button bmi_border_radius">
    <label>
    <input type="radio" name="gender" value="female" checked="checked" class="float_left" />
    <div class="title float_left"><?php echo lang("bestme_bmi_female"); ?></div>
    <img class="float_right" height="45" src="<?php echo base_url()."images/bestme/bmi_female.png" ?>" />
    <div class="clear"></div>
    </label>
    </div><!-- End of bmi_button  -->
    
    <div style="width:100%; height:7px;"></div>
    
    <div class="bmi_button bmi_border_radius">
    <label>
    <input type="radio" name="gender" value="male"  class="float_left" />
    <div class="title float_left"><?php echo lang("bestme_bmi_male"); ?></div>
    <img class="float_right" height="45" src="<?php echo base_url()."images/bestme/bmi_male.png" ?>" />
    <div class="clear"></div>
    </label>
    </div>
    
    <div style="width:100%; height:7px;"></div>
    <div class="bmi_button bmi_border_radius">
    <div class="title float_left"><?php echo lang("bestme_bmi_height"); ?></div>
    <input type="text" maxlength="3"  onkeypress="return isNumberKey(event)"  name="height" value="0" id="height" class="float_left textbox" />
    <div class="title float_left"><small><?php echo lang("bestme_bmi_cm"); ?></small></div>
    <img class="float_right" height="45" src="<?php echo base_url()."images/bestme/bmi_meter.png" ?>" />
    <div class="clear"></div>
    </div>
    <div style="width:100%; height:7px;"></div>
    <div class="bmi_button bmi_border_radius">
     <div class="title float_left"><?php echo lang("bestme_bmi_weight"); ?></div>
    <input type="text" maxlength="3"  onkeypress="return isNumberKey(event)"  name="weight" value="0" id="weight" class="float_left textbox"  />
    <div class="title float_left"><small><?php echo lang("bestme_bmi_kilo"); ?></small></div>
    <img class="float_right" height="45" src="<?php echo base_url()."images/bestme/bmi_weight.png" ?>" />
    <div class="clear"></div>
    </div>
    <div style="width:100%; height:7px;"></div>	
    <div class="bmi_button bmi_border_radius best_me_background_color" align="center">
    <a id="calculate_bmi" class="white_color">
    <?php echo lang("bestme_bmi_calculate"); ?>
    </a>
    </div>
    
    
    </div><!-- End of side_bar  -->
    
    <div class="main_container bmi_border_radius float_right">
     <div class="inner_margin">
    	<p><?php echo lang("bestme_bmi_yourbmiis"); ?></p>
        <div align="center">
        <input type="text"  id="bmi_calculator_value" class="bmi_border_radius" value="0" readonly="readonly" />
        </div>
        <p>
        <?php echo lang("bestme_bmi_title_0"); ?><br />
		<?php echo lang("bestme_bmi_title_1"); ?><br />
		<?php echo lang("bestme_bmi_title_2"); ?><br />
		<?php echo lang("bestme_bmi_title_3"); ?> 
        </p>
        <p class="best_me_color">
        <span class="results_status" id="0"><?php echo lang("bestme_bmi_desc_0"); ?></span>
        <span class="results_status" id="1"><?php echo lang("bestme_bmi_desc_1"); ?></span>
        <span class="results_status" id="2"><?php echo lang("bestme_bmi_desc_2"); ?></span>
        <span class="results_status" id="3"><?php echo lang("bestme_bmi_desc_3"); ?></span>
        </p>
        
       </div> <!-- End of inner_margin -->
    </div><!-- End of main_container -->
    
    <div class="clear"></div>    
    
    </div><!-- End of inner_margin-->

</div><!-- End of bmi_main_wrapper -->