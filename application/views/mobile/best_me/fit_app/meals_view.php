<script type="text/javascript">
	$(document).ready(function() {
	
		var MaxInputs       = 5; //maximum input boxes allowed
		var current_tab_id  = <?php echo $id ?>;
		var InputsWrapper   = $("#InputsWrapper_"+current_tab_id); //Input boxes wrapper ID
		var AddButton       = $("#AddMoreFileBox_"+current_tab_id); //Add button ID
		
		//var x = <?php //echo $array_lenght ?>; //Add button ID
		var x = InputsWrapper.attr("data-list"); // number of li came from the data-list
		
		
		var FieldCount=1; //to keep track of text box added
		<?php /*?>var Childname = "<?php echo lang('mycorner_child_name');?>";
		var Childage = "<?php echo lang('mycorner_child_age');?>";<?php */?>
		
		$(AddButton).click(function (e) { //on add input button click
		
			var x = parseInt(InputsWrapper.attr("data-list"));
				var increment_li = x+1;
				FieldCount = x;				
				InputsWrapper.attr('data-list',increment_li);
				
				if(x > MaxInputs) {
					AddButton.css("cursor", "default");
				} else {
					AddButton.css("cursor", "pointer");
				}
		

				if(x <= MaxInputs) { //max input box allowed
					FieldCount++; //text box added increment
					//add input box
					//$(InputsWrapper).append('<tr><td><h5> '+ Childname +'</h5></td><td><input type="text" name="children_name[]" id="field_'+ FieldCount +'" value=""/></td><td><h5> '+ Childage +'</h5></td><td><input type="text" name="children_age[]" id="field_'+ FieldCount +'" value=""><a href="#" class="removeclass float_right" style=" font-family: Verdana, Geneva, sans-serif;"> X </a></td></tr>');
					$(InputsWrapper).append('<li><input type="text" name="the_meal[]" placeholder="<?php  echo lang('type_name');?>" id="'+ FieldCount +'" value="" class="add_meal_field meal_recipe search float_left " /><input type="text" name="meal_amount[]" placeholder="<?php echo lang('quantity_name'); ?>" id="amount_'+ FieldCount +'" value="" class="add_amount_field meal_amount float_left add-mount" /><input type="text" disabled name="meals_measure" value="" id="measure_'+ FieldCount+'" class="mealmeasure float_left"/><input type="hidden" name="meal_value[]" value="" class="meal_value" id="field_'+ FieldCount+'" /><input type="hidden" name="calory_value" value="" id="calory_'+ FieldCount+'" /><div class="float_left meal-calories" data-total="" id="calory_num_'+ FieldCount+'" style="color: white; width: 150px;"></div><!--<div class="recipe float_left"><a href="#"><img src="<?php echo base_url(); ?>images/recipe_icon.png" /></a></div>--><div class="delete float_left"><div data-id="<?php echo $id; ?>" class="removeclass"><img src="<?php echo base_url(); ?>images/nestle_fit/meals-delete.png" /></div></div><div class="clear"></div> <input type="hidden" name="count_value" id="count_value" value="'+ FieldCount +'" /></li>');						

					x++; //text box increment
					
					$( "#tabs" ).tabs( "disable" );
				}		
		$( ".search" ).autocomplete({
			
		  minLength: 2,
		  source: function( request, response ) {
	
			$.getJSON("<?php echo site_url("ajax/food_search"); ?>", request, function( data, status, xhr ) {
			 //cache[ term ] = data; // mofified 29-7-2013 - by bermawy
	
			   response( $.map( data.geonames, function( item ) {
				  return {
				   id : item.value,
				   label: item.name ,
				   value: item.name,
				   calories:item.calories,
				   measure:item.measure
				  }
				}));
			});
			 
		  },
		   select: function( event, ui ) 
		   {
			   var current_id = $(this).attr('id');
				$('#InputsWrapper_<?php echo $id; ?> li #field_'+current_id+'').val(ui.item.id);
				$('#InputsWrapper_<?php echo $id; ?> li #calory_'+current_id+'').val(ui.item.calories);
				$('#InputsWrapper_<?php echo $id; ?> li #measure_'+current_id+'').val(ui.item.measure);
				//$('#current_calories').val(ui.item.calories);
		   }
		});
				
		return false;
		});
		
		var total_calories = 0;
		$("#InputsWrapper_"+current_tab_id+" li").each(function() {
			total_calories += parseInt($(this).find(".meal-calories").attr('data-total'));
		});
		$('#total_calories_'+current_tab_id).html(total_calories);
	});
</script>
<?php

		?>
<?php
	if($val_4 && $val_4 != date('Y-m-d'))
	{
	$display_string = '';
	$display_string .= '<ul class="meal_list">';

		if($array_lenght != 0)
		{
			for($i=0;$i<$array_lenght;$i++)
			{
				$meals = $array[$i]['nestle_fit_food_title'];
				$amount = $array[$i]['nestle_fit_meals_amount'];
				$type= $array[$i]['nestle_fit_measurments_title'];
				$display_string .=  '<div class="row">';
				$display_string .= '<li>';
				$display_string .= '<input type="text" name="the_meal[]" placeholder="'. lang('globals_meal').'" id="'.($i+1).'" value="'.$meals.'" class="meal_recipe search float_left col-sm-6" />';
				$display_string .= '<input type="text" name="meal_amount[]" placeholder="'. lang('globals_amount').'" id="amount_'.($i+1).'" value="'.$amount.'" class="meal_amount float_left col-sm-2" />';
				
				$display_string .= '<input type="hidden" name="meal_value[]" class="meal_value" value="'.$value.'" id="field_'.($i+1).'" />';
				$display_string .='<input type="hidden" name="calory_value" value="'.$array[$i]['nestle_fit_food_calories'].'" id="calory_'.($i+1).'" />';
				$display_string .= '<input type="hidden" name="calories" value="'.$array[$i]['nestle_fit_food_calories'].'"/>';
				$display_string .= '<input type="hidden" name="measurments" value="'.$type.'"/>';
				$display_string .= '<div class="float_left meal-calories col-sm-4" style="width: 150px;">'.$array[$i]['nestle_fit_food_calories']*$amount." ".lang('Calories_day').'</div>';
				//$display_string .= '<div class="delete float_left"><a href="#" class="removeclass"><img src="'.base_url().'images/trash.png" /></a></div>';
				$display_string .= '<div class="clear"></div>';
				$display_string .= '</li>';
				$display_string .='</div>';
			}
		}
		else
		{
			$display_string .= '<li style="text-align: center;color: #fff; ">'. lang('globals_no_meals').'</li>';
		}
		
	$display_string .= '</ul>';
	echo $display_string;
	}
	else
	{
	?>
    <div class="row">
	<form method="post" class="send_meals form-inline" data-id="<?php echo $id; ?>" name="send_meals" enctype="multipart/form-data"  role="form"/>
	<input type="hidden" value="<?php echo $id; ?>" name="meal_type" id="meal_id"/>
	<input type="hidden" value="<?php echo date('Y-m-d')?>" name="meal_date" />
	<input type="hidden" value="<?php echo $val_2 ?>" name="member_id" />
    <input type="hidden" value="<?php echo $this->members->members_id; ?>" name="user_id" />

   
   <ul class="meal_list"  id="InputsWrapper_<?php echo $id; ?>" data-list="<?php echo $array_lenght ?>">
	  <?php
            $meal_input = $current_language_db_prefix == '_ar' ? 'col-sm-push-6 col-md-push-8 col-lg-push-8' : 'col-sm-push-0 col-md-push-0 col-lg-push-0';
			$delete_meal = $current_language_db_prefix == '_ar' ? 'col-sm-pull-7 col-md-pull-5 col-lg-pull-5' : 'col-sm-pull-0 col-md-pull-0 col-lg-pull-0';
			$meal_mount = $current_language_db_prefix == '_ar' ? 'col-md-offset-3 col-lg-offset-3' : 'col-sm-pull-1 col-md-pull-0 col-lg-pull-0';
			$meal_calories = $current_language_db_prefix == '_ar' ? 'col-sm-pull-7 col-md-pull-5 col-lg-pull-5' : 'col-sm-pull-0 col-md-pull-0 col-lg-pull-0';
	  	if($array_lenght != 0)
		{
			$display_string = '';
			for($i = 0; $i<$array_lenght;$i++)
			{
				$meals = $array[$i]['nestle_fit_food_title'];
				$amount = $array[$i]['nestle_fit_meals_amount'];
				$value = $array[$i]['nestle_fit_meals_meal'];
				$display_string .=  '<div class="row meals-add">';
				$display_string .= '<li>';
				$display_string .=  '<div >';
				$display_string .= '<input type="text" name="the_meal[]" placeholder="'. lang('globals_meal').'" id="'.($i+1).'" value="'.$meals.'" class="meal_recipe search float_left " />';
				$display_string .=  '</div>';
				$display_string .=  '<div >';
				$display_string .= '<input type="text" name="meal_amount[]" placeholder="'. lang('globals_amount').'" id="amount_'.($i+1).'" value="'.$amount.'" class="meal_amount float_left" />';
				$display_string .=  '</div>';
				$display_string .= '<div class="mealmeasure" id="measure'.($i+1).'" >'.$array[$i]['nestle_fit_measurments_title'].'</div>';
				$display_string .= '<input type="hidden" name="meal_value[]" class="meal_value" value="'.$value.'" id="field_'.($i+1).'" />';
				$display_string .='<input type="hidden" name="calory_value" value="'.$array[$i]['nestle_fit_food_calories'].'" id="calory_'.($i+1).'" />';
				$display_string .= '<input type="hidden" name="calories" value="'.$array[$i]['nestle_fit_food_calories'].'"/>';
				$display_string .= '<div class="float_left meal-calories" style="color: white; width: 40%;padding: 8px;">'.$array[$i]['nestle_fit_food_calories']*$amount." ".lang('Calories_day').'</div>';
				//$display_string .= '<div class="recipe float_left"><a href="#"><img src="'.base_url().'images/recipe_icon.png" /></a></div>';
				$display_string .= '<div class="delete float_left"><a href="#" class="removeclass"><img src="'.base_url().'images/nestle_fit/meals-delete.png" /></a></div>';
				$display_string .= '<div class="clear"></div>';
				$display_string .= '</li>';
				$display_string .='</div>';
			}
			echo $display_string;
		}
		?>
		<?php /*?><li>
			<input type="text" name="the_meal[]" placeholder="'. lang('globals_meal').'" id="0" class="meal_recipe search float_left" />
			<input type="text" name="meal_amount[]" placeholder="'. lang('globals_amount').'" id="amount_0" class="meal_amount float_left" />
			<input type="hidden" name="meal_value[]" class="meal_value" id="field_0" value="" />
			<div class="recipe float_left"><a href="#"><img src="<?php echo base_url()?>images/recipe_icon.png" /></a></div>
			<div class="delete float_left"><a href="#" class="removeclass"><img src="<?php echo base_url(); ?>images/trash.png" /></a></div>
			<div class="clear"></div>
		</li><?php */?>              
		</ul>
		<table width="100%" border="0" class="float_left direction">
			<tr>
				<td width="55%">
					<a href="#" id="AddMoreFileBox_<?php echo $id; ?>" class="meal_button link_add_meal"><?php echo lang('globals_add_meals');?></a>
				</td>
				<td width="40%">
					<input  type="submit" class="meal_button submit_meal input_add_meal" data-id="<?php echo $id; ?>" value="<?php echo lang('globals_send'); ?>" />
                    
				</td>
                <td>
               
                </td>
			</tr>
		</table>
	</form>
    </div>
   <?php }?>