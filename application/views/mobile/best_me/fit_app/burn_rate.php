<?php
if(!$this->members->members_id)
{
	redirect(site_url('mobile/best_me/applications/9/homepage'), 'refresh');
}
?>
<?php
	$member_weight = $members_data[0]['nestle_fit_health_weight'];
?>
<script>
  function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
$(document).ready(function(e) {
    $('#submit').click(function(e) {
		
		var state = true;
		$(".field_error").hide();
		
		var sport = $('#sport').val();
		var minutes = $('#minutes').val();

		<?php if($member_weight !="" && $member_weight > 0){?>
		var weight = '<?php echo $member_weight; ?>';
		<?php }else{?>
		var weight =$('#new_weight').val();
		if(weight == "")
		{
			$("#weight_error").fadeIn("fast");
			state = false;
		}
		<?php }?>
		
		if(sport == "")
		{
			$("#sport_error").fadeIn("fast");
			state = false;
		}
		
		if(minutes == "")
		{
			$("#minutes_error").fadeIn("fast");
			state = false;
		}
		
		if(state == true)
		{
			var result = parseInt(sport * minutes * weight);		
			$('#burn_rate_result').html(result);
	
		}
		

        return false;
    });
});
</script>

<div class="row burn_rate_container">
   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
       <h3 class="nestlefit_inner_title"><?php echo  lang("nestlefit_burn_rate"); ?></h3>
   </div>
 <div class="row">
   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4 form-position">
   <form name="burn_rate" class="form-horizontal dir" role="form">
    <div class="form-group">
      <div class="col-sm-12">
            <select name="sport" id="sport">
            	<option value=""><?php  echo lang("bestme_fitapp_type_sport"); //echo lang("bestme_fitapp_choose_one"); ?></option>
				<?php
				$CI =& get_instance();
				$CI->load->library('nestlefit');

				$display = $CI->nestlefit->burn_rate();
				
                for($i=0 ; $i<sizeof($display);$i++)
			  	{
					echo '<option value="'.$display[$i]['nestle_fit_sport_burn'].'" >'.$display[$i]['nestle_fit_sport_title'.$current_language_db_prefix].'</option>';
			 	}
                ?>
			</select>
            <p id="sport_error" class="field_error"><?php echo lang("bestcook_field_required"); ?></p>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">          
         <select name="minutes" id="minutes">
            	<option value=""><?php echo lang("bestme_fitapp_day_count_mint"); //echo lang("bestme_fitapp_choose_one"); ?></option>
				<?php
                for($i=5 ; $i<=120;$i+=5)
			  	{
					$current_language_db_prefix;
					if($current_language_db_prefix == "_ar")
					{
						echo '<option value="'.$i.'" >'. $this->common->arabic_numbers($i) ." ". lang("bestme_fitapp_minutes"); '</option>';
					}
					else
					{
						echo '<option value="'.$i.'" >'.$i." ". lang("bestme_fitapp_minutes"); '</option>';
					}
			 	}
                ?>
			</select>
           <p id="minutes_error" class="field_error"><?php echo lang("bestcook_field_required"); ?></p>
      </div>
    </div>
   <?php if($member_weight == " " or $member_weight == 0){?>
       <div class="form-group">
      <div class="col-sm-12">          
         <input type="text" name="new_weight" id="new_weight" placeholder="<?php echo lang("enter_your_weight_please"); ?>" onkeypress="return isNumberKey(event)"/>
         <p id="weight_error" class="field_error"><?php echo lang("bestcook_field_required"); ?></p> 
      </div>
    </div>
   <?php } ?>
    <div class="form-group">        
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-6 col-xs-push-1 col-md-push-2">
         <input type="button" class="burn_rate_btn btn" id="submit" name="submit" value="<?php echo lang("bestme_fitapp_calc_burn_rate"); ?>" />
      </div>
    </div>
  </form>
  </div>
 </div>
 <div class="row"> 
 <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4 form-position">
  
 <div class="col-xs-8 col-sm-8 col-md-8 col-lg-6 col-xs-push-1 col-md-push-2"><h3 id="burn_rate_result"></h3></div>
 </div>
</div> 
 
</div>

<style>
.form-group{
  padding: 0; 
  margin: 0;

	}
.nestlefit_inner_title{
	  margin-top: 210px !important;
}	
@media only screen and (width: 640px) {
.form-position{
width: 310px;
  margin-left: 20%;
}
}
@media only screen and (width: 600px) {
.form-position{
width: 310px;
  margin-left: 20%;
}
}

@media only screen and (width: 800px) {
.form-position{
width: 310px;
  margin-left: 25%;
}
}
</style>

