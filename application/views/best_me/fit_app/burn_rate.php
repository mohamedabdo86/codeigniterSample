<?php
if(!$this->members->members_id)
{
	redirect(site_url('best_me/applications/9/homepage'), 'refresh');
}
?>
<link href="<?php echo base_url(); ?>css/mycorner.css" rel="stylesheet">
<style>



.app_wrapper
{
	background-color:#fcfae4;
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	width:100%;
	height:200px;
}
.values td 
{
	-webkit-box-shadow: inset 6px 6px 10px 0px rgba(122, 121, 124, 0.76);
	-moz-box-shadow:inset 6px 6px 10px 0px rgba(122, 121, 124, 0.76);
	box-shadow:inset 6px 6px 10px 0px rgba(122, 121, 124, 0.76);
	height: 35px;
	width: 50px;
	text-align: center;
}
.field_error
{
	color: white !important;
}
#new_weight{
  width: 100%;
  height: 40px;
  margin-top: 10px;
  border-radius: 10px;
  -webkit-border-radius: 10px; 
  -moz-border-radius: 10px; 
}
#burn_rate_result{
	margin: 10px 146px !important;
	
	}
</style>
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
<style>
.english .back{
right: 46px !important;
top: -55px !important;
}
.back-text
{
	font-size:15px;
}
.english .back-text{
right: 85px !important;
top: -35px !important;
}
</style>

<div>
	<div class="app_wrapper float_left burn_rate_container">
       
        <div id="burn_rate">
        <h3 class="title dir" style="margin:4px 53px 0px 30px;"><?php echo  lang("nestlefit_burn_rate"); ?>
         <a class="back" style="position: relative;right: 90px;" href="<?php echo site_url('best_me/applications/9'); ?>"><img src="<?php echo base_url().'images/nestle_fit/back.png'; ?>" /></a>
         <a href="<?php echo site_url('best_me/applications/9'); ?>">  <span class="back-text" style="position: relative;right: 50px;top: 15px;"><?php echo  lang("nestlefit_back_btn"); ?></span></a>

        </h3>
        

        <form name="burn_rate" class="dir" >
      
        <div id="choose_sport">    
        <select name="sport" id="sport">
            	<option value=""><?php  echo lang("bestme_fitapp_type_sport"); //echo lang("bestme_fitapp_choose_one"); ?></option>
				<?php
				$CI =& get_instance();
				$CI->load->library('nestlefit');

				$display = $CI->nestlefit->burn_rate();
				
                for($i=0 ; $i<sizeof($display);$i++)
			  	{
					echo '<option value="'.$display[$i]['nestle_fit_sport_burn'].'" >'.ucfirst($display[$i]['nestle_fit_sport_title'.$current_language_db_prefix]).'</option>';
			 	}
                ?>
			</select>
            <p id="sport_error" class="field_error"><?php echo lang("bestcook_field_required"); ?></p>
                     
            <!--<td><label for="minutes"><?php //echo lang("bestme_fitapp_day_count_mint"); ?></label></td>-->
            </div>
            <div id="choose_minutes"> 
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
          <?php if($member_weight == " " or $member_weight == 0){?>
            <div>
            <input type="text" name="new_weight" id="new_weight" placeholder="<?php echo lang("enter_your_weight_please"); ?>" onkeypress="return isNumberKey(event)"/>
             <p id="weight_error" class="field_error"><?php echo lang("bestcook_field_required"); ?></p> 
            </div>
            <?php }?>
          <div id="submit" style="text-align:center">
            	<input type="button" class="burn_rate_btn btn" id="submit" name="submit" value="<?php echo lang("bestme_fitapp_calc_burn_rate"); ?>" />
          		   
          </div>
          
        </form>
        <h3 id="burn_rate_result"></h3>
        </div>
        <div class="clear"></div>
        
    
    </div>
    <div class="clear"></div>


</div>