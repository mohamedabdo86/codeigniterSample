<?php
if(!$this->members->members_id)
{
   redirect(site_url('mobile/best_me/applications/9/homepage'), 'refresh');
}
$id = $this->uri->segment(7, 0);
$current_weight = round($this->nestlefit->get_weight($id)); // Get Current weight
$ideal_weight = round($this->nestlefit->get_ideal_weight($id)); // Get Ideal Weight

$nestle_fit_progress_data = $this->nestlefit->get_nestle_fit_progress();
?>
<script>
$(document).ready(function(e) {
	
	$("#second_step_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();
		
		if( $("#best_life_week_change").val() == "" )
		{
			$("#best_life_weight_error").fadeIn("fast");
			$("#best_life_week_change").css("border","2px solid red");
			state = false;
		} else {
			$("#best_life_week_change").css("border","none");
		}
			
		return state;	
	});    
	
});
</script>
<script>
function hideinputs(){
	 $("#your_goal").css("visibility", "hidden");
	 $("#weight_differ").css("visibility", "hidden");
	 $("#your_week_change").css("visibility", "hidden");
	 $("#best_life_week_change").val(0);
      //alert("fffff");	
	}
function showinputs(){
	 $("#your_goal").css("visibility", "visible");
	 $("#weight_differ").css("visibility", "visible");
	 $("#your_week_change").css("visibility", "visible");
	}	
</script>
<?php
	if($members_data[0]['nestle_fit_health_weight'] >= $ideal_weight) {
  		$differ_wight = $members_data[0]['nestle_fit_health_weight'] - $ideal_weight;
	} else {
		$differ_wight = $get_ideal_weight['ideal_weight']-$members_data[0]['nestle_fit_health_weight'];
	}
		$age = $this->nestlefit->get_age_from_date_of_birth($members_data[0]['nestle_fit_health_birthday']);

	  
	 $height_in_meter = $members_data[0]['nestle_fit_health_height']/100;
	 $double_height = $height_in_meter * $height_in_meter;
	 $BMI = $members_data[0]['nestle_fit_health_weight']/$double_height;
	$advice_text=""; 
	// echo $height_in_meter.">>>".$double_height."=====".$BMI;
	if($BMI > 24.9){
		 //echo " <div class=\"arrow-up_yellow\" style=\"display:flex;\">&nbsp;</div>";
		 $advice_text=lang('fit_overweight_range'); 
		}else if($BMI < 18.5){
		 // echo " <div class=\"arrow-up_yellow3\" style=\"display:flex;\">&nbsp;</div>";	 
		  $advice_text=lang('fit_underweight_range'); 
			}else{
				//echo " <div class=\"arrow-up_yellow2\" style=\"display:flex;\">&nbsp;</div>";
				$advice_text=lang('fit_normal_range'); 
				
				}
?>
<div class="row nestle_fit_register">
<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3" style="margin-top: 205px;">
 <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="background-color:#FF0C0C; height: 25px;">
         <div <?php if ($BMI > 24.9){?> style="visibility:visible !important;"<?php }?> class="arrow-up_yellow arrow">&nbsp;</div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="background-color:#36dda1; height: 25px;">
          <div <?php if (!($BMI > 24.9) && !($BMI < 18.5)){?> style="visibility:visible !important;"<?php }?> class="arrow-up_yellow2 arrow">&nbsp;</div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="background-color:#fdfdfd; height: 25px;">
          <div <?php if ($BMI < 18.5){?> style="visibility:visible !important;"<?php }?>class="arrow-up_yellow3 arrow">&nbsp;</div>
        </div>
     
</div>
<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
   <h2 class="fit_reg_perfect_weight" style="white-space: normal;color: white; line-height: 1.2;"><?php echo $advice_text ." "."<u>" .round($BMI, 2). "</u>"; ?></h2>
   </div>
  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4 form-position">
    <?php  $attributes = array('class' => 'form-horizontal dir', 'id' => 'second_step_form' , 'role'=>'form', 'data-ajax'=>'false');
      echo form_open('ajax/best_life_next_step_mobile', $attributes);?>
      
           <?php 
        if($BMI > 24.9)
		{
		  echo "<div class='col-xs-12 col-sm-12'>
		  <label class='col-xs-10 col-sm-10'>".$nestle_fit_progress_data[0]['nestle_fit_progress_text'.$current_language_db_prefix]."</label>"."<input class='col-xs-2 col-sm-2' type='radio' name='nestle_fit_progress' value='".$nestle_fit_progress_data[0]['nestle_fit_progress_ID']."' checked disabled='disabled'></div>";	   
		  $select_default=lang('fit_reg_how_much_weight');
		}
		else if($BMI < 18.5)
		{
		  echo "<div class='col-xs-12 col-sm-12'><label class='col-xs-10 col-sm-10'>".$nestle_fit_progress_data[2]['nestle_fit_progress_text'.$current_language_db_prefix]."</label>"."<input class='col-xs-2 col-sm-2' type='radio' name='nestle_fit_progress' value='".$nestle_fit_progress_data[2]['nestle_fit_progress_ID']."' checked onchange='showinputs();'></div>";
		  echo "<div class='col-xs-12 col-sm-12'><label class='col-xs-10 col-sm-10'>".$nestle_fit_progress_data[1]['nestle_fit_progress_text'.$current_language_db_prefix]."</label>"."<input class='col-xs-2 col-sm-2' type='radio' name='nestle_fit_progress' value='".$nestle_fit_progress_data[1]['nestle_fit_progress_ID']."' onchange='hideinputs();'></div>";
		  $select_default=lang('fit_reg_how_much_weight_gain'); 
		}
		else
		{
		  echo "<div class='col-xs-12 col-sm-12'><label class='col-xs-10 col-sm-10'>".$nestle_fit_progress_data[0]['nestle_fit_progress_text'.$current_language_db_prefix]."</label>"."<input class='col-xs-2 col-sm-2' type='radio' name='nestle_fit_progress' value='".$nestle_fit_progress_data[0]['nestle_fit_progress_ID']."' checked onchange='showinputs();'></div>";	
		  echo "<div class='col-xs-12 col-sm-12'><label class='col-xs-10 col-sm-10'>".$nestle_fit_progress_data[1]['nestle_fit_progress_text'.$current_language_db_prefix]."</label>"."<input class='col-xs-2 col-sm-2' type='radio' name='nestle_fit_progress' value='".$nestle_fit_progress_data[1]['nestle_fit_progress_ID']."' onchange='hideinputs();'></div>";
		  $select_default=lang('fit_reg_how_much_weight');		
		}
		?>
      
        <div class="form-group" id="your_goal"> 
          <label class="col-xs-12 col-sm-12" for="best_life_goal"><?php echo lang('fit_your_goal');?></label>
      <div class="col-xs-12 col-sm-12">
          <input class="form_input_larg"  value="<?php echo $ideal_weight;?>" onkeypress="return isNumberKey(event)" id="best_life_goal" name="best_life_goal" onchange="updateweightdiffer()" style="text-align:center; padding:3px; color:#6f6f6f">
      </div>
    </div>
    
     <div class="form-group" id="weight_differ">
          <label class="col-xs-12 col-sm-12" for="best_life_goal"><?php echo lang('fit_weight_difference');?></label>
      <div class="col-xs-12 col-sm-12">
            <input class="form_input_larg" value="<?php echo $differ_wight; ?>" id="best_life_differ_weight" name="weight_differ" style="text-align:center; padding:3px; color:#6f6f6f" readonly="readonly">
      </div>
    </div>
    <input type="hidden" name="nestle_fit_calculations_fit_health_id" value="<?php echo $id ?>"  />
     <div class="form-group" id="your_week_change">
          <label class="col-xs-12 col-sm-12" for="best_life_week_chang"><?php echo lang('fit_weekly_change');?></label>
      <div class="col-xs-12 col-sm-12">
           <select class="form_input_larg" id="best_life_week_change" name="best_life_week_change" style="text-align:center; ">
          <?php
                echo "<option value=''>".$select_default."</option>";
                echo "<option value='0.25'>1/4"." ".lang('fit_weight_unit')."</option>";
                echo "<option value='0.5'>1/2"." ".lang('fit_weight_unit')."</option>";	
				echo "<option value='1'>1"." ".lang('fit_weight_unit')."</option>";				
				echo "<option value='0' style='display:none;'></option>";

               
                ?>
        </select>
      </div>
    </div>
          <input type="hidden" id="estimated_days" name="estimated_days" />
     <input type="hidden" id="best_life_estimated_date" name="best_life_estimated_date"/>

     <input type="hidden" id="nestle_fit_health_sex" name="nestle_fit_health_sex"  value="<?php echo $members_data[0]['nestle_fit_health_sex'];?>"/>
     <input type="hidden" id="nestle_fit_health_weight" name="nestle_fit_health_weight"  value="<?php echo $members_data[0]['nestle_fit_health_weight'];?>"/>
     <input type="hidden" id="nestle_fit_health_height" name="nestle_fit_health_height"  value="<?php echo $members_data[0]['nestle_fit_health_height'];?>"/>
     <input type="hidden" id="nestle_fit_health_activity" name="nestle_fit_health_activity"  value="<?php echo $members_data[0]['nestle_fit_health_activity'];?>"/>
     <input type="hidden" id="nestle_fit_health_birthday" name="nestle_fit_health_birthday"  value="<?php echo $age ;?>"/>
     <div class="form-group">
      <div class="col-xs-12 col-sm-12">
      <?php
            $data = array('name' => 'submit', 'id' => 'next_button');
            echo form_submit($data, lang('fit_reg_start_now'));
            ?>
      </div>
      </div>
          <div style="text-align:center; margin-top: -25px;"><span id="best_life_weight_error" class="field_error" style="margin-top:5px;background-color: rgba(255, 255, 255, 0.75);
padding: 0 5px;"> <?php echo lang("bestcook_field_required");?></span></div>
    <?php echo form_close(); ?> </div>
      </div>

<script>



    var map = ["\u0660", "\u0661", "\u0662", "\u0663", "\u0664", "\u0665", "\u0666", "\u0667", "\u0668", "\u0669"];


    function replaceNumbers(node) {
        if (node.nodeType == 3) //Text nodes only
            node.nodeValue = node.nodeValue.replace(/[0-9]/g, getArabicNumber);
    }

    function getArabicNumber(n) {
        return map[parseInt(n, 10)];
    }

    function walk(node, func) {
        func(node);
        node = node.firstChild;
        while (node) {
            walk(node, func);
            node = node.nextSibling;
        }
    }
    ;

    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
	
	function updateweightdiffer() {
		var current_weight = <?php echo $current_weight; ?>;
		var weight_goal = $("#best_life_goal").val();
		var weight_loss = 0;
		if(current_weight >= weight_goal) {
			weight_loss = current_weight - weight_goal;
		} else {
		  	weight_loss = weight_goal - current_weight;	
		}
	   $("#best_life_differ_weight").val(weight_loss);
	}
</script>

<style>
.arrow{
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 7.5px 13px 7.5px;
        border-color: transparent transparent #ffffff transparent;
		padding-top: 30px;
		visibility: hidden;

    }
label{
	color:white;
	text-align:right !important;
	float:right !important;
}	
.english label{
	text-align:left !important;
	float:left !important;
	}
#second_step_form input[type="submit"] {
  background-color: #98ca00;
  color: #fff;
  font-weight: bold;
  border-radius: 22px;
  -webkit-border-radius: 22px;
  -moz-border-radius: 22px;
  border: none;
  line-height: 25px;
}
.form-group{
	margin-bottom:0px;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
	background:none;
}	
</style>