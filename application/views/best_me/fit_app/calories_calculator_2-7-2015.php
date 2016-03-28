<style>
.app_wrapper
{
	/*background-color:#fcfae4;*/
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	width:100%;
	/*height:200px;*/
	position: absolute;
    top: 500px;
    right: 315px;
}
.values td 
{
	/*-webkit-box-shadow: inset 3px 3px 10px 0px rgba(122, 121, 124, 0.76);
	-moz-box-shadow:inset 3px 3px 10px 0px rgba(122, 121, 124, 0.76);
	box-shadow:inset 3px 3px 10px 0px rgba(122, 121, 124, 0.76);*/
	height: 35px;
	width: 50px;
	text-align: center;
}
#loading 
{
	display: none;
	position: relative;
	padding: 0 10px;
	width: 22px;
	margin-top: -5px;
	top: 5px;
}
.result
{
	width:50%;
}
#food , #calc_calories_btn
{
	height:27px;
}
.col
{
	margin:0 4px;
}
</style>
<script type="text/javascript">
$(document).ready(function(e) {
	$("#calories_calculator").submit(function(e) {
		
		var food_value = $('#food').val();
		
		if(food_value == "")	
		{
			$('td#calories').html('');
			$('td#fibers').html('');
			$('td#fat').html('');

			return false;
		}
		else
		{
			$("#loading").show();
			$.ajax({
				  url:  "<?php echo site_url("ajax/food_calories"); ?>",
				  type: "POST",
				  data: $('#calories_calculator').serialize(),
				  cache: false,
				  dataType: "json",
				  success: function(success_array)
				  {
					  $("#loading").hide();
						$('td#calories').html(success_array.calories);
						$('td#fibers').html(success_array.fibers);
						$('td#fat').html(success_array.fat);
					
				  },
				  error: function(xhr, ajaxOptions, thrownError)
				  {
					//alert("wrong"+thrownError);
				  }
				  
			});
		
			return false;
		}
	});
});
</script>

<div class="calories_calculator_page">
<h3 class="col calories_calculator_title">الصحة اختياري</h3>
	<div class="app_wrapper">
    	<div style="width:500px;" class="float_left">
    	
        
        <form name="calories_calculator" id="calories_calculator" style=" height:33px;" >
        <div class="col float_left">
        	<select name="food" id="food" class="dir">
            	<option value=""><?php echo lang('bestme_fitapp_food_type'); ?></option>
				<?php
				$CI =& get_instance();
				$CI->load->library('nestlefit');

				$display = $CI->nestlefit->calories_calculator();
				
                for($i=0 ; $i<sizeof($display);$i++)
			  	{
					if($display[$i]['nestle_fit_food_title'.$current_language_db_prefix] == "")
					{
						$food = $display[$i]['nestle_fit_food_title'];
					}
					else
					{
						$food = $display[$i]['nestle_fit_food_title'.$current_language_db_prefix];
					}
					echo '<option value="'.$display[$i]['nestle_fit_food_ID'].'" >'.$food.'</option>';
			 	}
                ?>
			</select>
            </div>
            <div class="col float_left">
            <input id="calc_calories_btn" type="submit" name="submit" value="<?php echo lang('bestme_fitapp_calc_calories'); ?>" />
       		</div>
            <div class="col float_left">
            <img id="loading" src="<?php echo  base_url();?>images/camera-loader.gif">
            </div>
        </form>
        <div class="clear"></div>
        
        <div class="result float_left">
        <table width="100%" cellspacing="30px" cellpadding="5px" style="margin-left: -100px;margin-left: -120px;
margin-top: -20px;">
        	<tr>
            	<td width="33%" class="fitapp_calories_data"><?php echo lang('bestme_fitapp_calories'); ?></td>
                <td  width="33%" class="fitapp_calories_data"><?php echo lang('bestme_fitapp_fibers'); ?></td>
                <td width="33%" class="fitapp_calories_data"><?php echo lang('bestme_fitapp_fats'); ?></td>
            </tr>
          
            <tr class="values">
            	<td id="calories"></td>
                <td id="fibers"></td>
                <td id="fat"></td>
            </tr>
          </table>
        
        </div>
    <div class="clear"></div>
    </div>
    </div>
    <div class="clear"></div>


</div>