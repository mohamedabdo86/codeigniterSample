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
#loading 
{
	display:none;
	position: relative;
	right: 17px;
	top: 10px;
	width: 24px;
}
.green_color
{
	color: #197C21 !important;
}
.red_color
{
	color: #e82327 !important;
}
#result
{
	width: 100px;
text-align: center;
background-color: #fff;
height: 50px;
line-height: 30px;
-webkit-border-radius: 7px;
-moz-border-radius: 7px;
border-radius: 7px;
border: 3px solid #e9810d;
margin-left: 160px;
margin-top: 9px;
}
#sport , #minutes
{
	height:27px;
}
.burn_rate_btn
{
	height:35px;
	
}
</style>
<?php
if(!$this->members->members_id):

redirect('best_me/applications/9', 'refresh');
return;
endif;

	$member_weight = $members_data[0]['nestle_fit_health_weight'];
?>
<script>
$(document).ready(function(e) {
    $('#submit').click(function(e) {
		
		var state = true;
		$(".field_error").hide();
		
		var sport = $('#sport').val();
		var minutes = $('#minutes').val();
		var weight = '<?php echo $member_weight; ?>';
		
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
			$('#result').html(result);
	
		}
		

        return false;
    });
});
</script>


<div>
	<div class="app_wrapper float_left burn_rate_container">
    <h3 class="col calories_calculator_title">الصحة اختياري</h3>
       <h3 id="burn_rate_header_title">النشاط و معدل الحرق</h3>
        <div>
        
        <form name="burn_rate" id="burn_rate" >
        <img id="loading" src="<?php echo  base_url();?>images/camera-loader.gif">
      
        	<!--<td width="35%"><label for="sport"><?php //echo lang("bestme_fitapp_type_sport"); ?></label></td>-->
        <div id="choose_sport">    
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
          
          <div id="submit">
            	<input type="button" class="burn_rate_btn" id="submit" name="submit" value="<?php echo lang("bestme_fitapp_calc_burn_rate"); ?>" />
                </div>
                <h3 id="result"></h3>
            
        </form>
        </div>
        <div class="clear"></div>
        
    
    </div>
    <div class="clear"></div>


</div>