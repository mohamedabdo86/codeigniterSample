<script type="text/javascript">
$(document).ready(function() {
	
		var MaxInputs       = 5; //maximum input boxes allowed
		var current_tab_id  = <?php echo $id ?>;
		var InputsWrapper   = $("#InputsWrapper_"+current_tab_id); //Input boxes wrapper ID
		var AddButton       = $("#AddMoreFileBox_"+current_tab_id); //Add button ID
		
		var x = InputsWrapper.attr("data-list"); // number of li came from the data-list
		
		var FieldCount=1; //to keep track of text box added

		$(AddButton).click(function (e)  //on add input button click
		{
			var x = parseInt(InputsWrapper.attr("data-list"));
			var increment_li = x+1;
								
			InputsWrapper.attr('data-list',increment_li);
			
			if(x > MaxInputs)
			{
				AddButton.css("cursor", "default");
			}
			else
			{
				AddButton.css("cursor", "pointer");
			}

				if(x <= MaxInputs) //max input box allowed
				{
					FieldCount++; //text box added increment
					//add input box
					$(InputsWrapper).append('<li><input type="text" name="the_meal[]" placeholder="<?php  echo lang('type_name');?>" id="'+ FieldCount +'" value="" class="add_meal_field meal_recipe search float_left " /><input type="text" name="meal_amount[]" placeholder="<?php echo lang('quantity_name'); ?>" id="amount_'+ FieldCount +'" value="" class="add_amount_field meal_amount float_left" /><input type="text" disabled name="meals_measure" value="" id="measure_'+ FieldCount+'" class="mealmeasure float_left"/><input type="hidden" name="meal_value[]" value="" class="meal_value" id="field_'+ FieldCount+'" /><input type="hidden" name="calory_value" value="" id="calory_'+ FieldCount+'" /><div class="float_left meal-calories" data-total="" id="calory_num_'+ FieldCount+'" style="color: white; width: 150px;"></div><!--<div class="recipe float_left"><a href="#"><img src="<?php echo base_url(); ?>images/recipe_icon.png" /></a></div>--><div class="delete float_left"><div data-id="<?php echo $id; ?>" class="removeclass"><img src="<?php echo base_url(); ?>images/nestle_fit/meals-delete.png" /><div></div><div class="clear"></div> <input type="hidden" name="count_value" id="count_value" value="'+ FieldCount +'" /></li>');						

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
				
				//alert(ui.item.measure);
				//$('#current_calories').val(ui.item.calories);
		   }
		});
				
		return false;
	});
	
	
	//loop on li to get the total calories for each tab
	var total_calories = 0;
	$("#InputsWrapper_"+current_tab_id+" li").each(function() {
	
	 total_calories += parseInt($(this).find(".meal-calories").attr('data-total'));
		
	});
	$('#total_calories_'+current_tab_id).html(total_calories);

});
</script>
<?php
//this condition for view only meals (No Add or edit or Delete)
	if($val_4 && $val_4 != date('Y-m-d'))
	{
	$display_string = '';
	$display_string .= '<ul class="meal_list" >';

		if($array_lenght != 0)
		{
			for($i=0;$i<$array_lenght;$i++)
			{
				$meals = $array[$i]['nestle_fit_food_title'];
				$amount = $array[$i]['nestle_fit_meals_amount'];
				$type= $array[$i]['nestle_fit_measurments_title'];
				
				$display_string .= '<li>';
				$display_string .= '<input type="text" name="the_meal[]" placeholder="'. lang('globals_meal').'" id="'.($i+1).'" value="'.$meals.'" class="meal_recipe search float_left" />';
				$display_string .= '<input type="text" name="meal_amount[]" placeholder="'. lang('globals_amount').'" id="amount_'.($i+1).'" value="'.$amount.'" class="meal_amount float_left" />';
				$display_string .= '<input type="hidden" name="meal_value[]" class="meal_value" value="'.$value.'" id="field_'.($i+1).'" />';
				$display_string .= '<input type="hidden" name="calory_value" value="'.$array[$i]['nestle_fit_food_calories'].'" id="calory_'.($i+1).'" />';
				$display_string .= '<input type="hidden" name="calories" value="'.$array[$i]['nestle_fit_food_calories'].'"/>';
				$display_string .= '<input type="hidden" name="measurments" value="'.$type.'"/>';
				$display_string .= '<div class="float_left meal-calories" data-total="'.$array[$i]['nestle_fit_food_calories']*$amount.'" style="width: 150px;">'.$array[$i]['nestle_fit_food_calories']*$amount." ".lang('Calories_day').'</div>';
				//$display_string .= '<div class="delete float_left"><a href="" class="removeclass"><img src="'.base_url().'images/trash.png" /></a></div>';
				$display_string .= '<div class="clear"></div>';
				$display_string .= '</li>';
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
	<form method="post" class="send_meals" data-id="<?php echo $id; ?>" name="send_meals" enctype="multipart/form-data" />
	<input type="hidden" value="<?php echo $id; ?>" name="meal_type" id="meal_id"/>
	<input type="hidden" value="<?php echo date('Y-m-d')?>" name="meal_date" />
	<input type="hidden" value="<?php echo $val_2 ?>" name="member_id" />
    <input type="hidden" value="<?php echo $this->members->members_id; ?>" name="user_id" />

   
   <ul class="meal_list" id="InputsWrapper_<?php echo $id; ?>" data-list="<?php echo $array_lenght ?>">
	  <?php
		//this condition for insert Meals(Add or edit or Delete)
	  	if($array_lenght != 0)
		{
			$display_string = '';
			for($i = 0; $i<$array_lenght;$i++)
			{
				$meals = $array[$i]['nestle_fit_food_title'.$current_language_db_prefix];
				$amount = $array[$i]['nestle_fit_meals_amount'];
				$value = $array[$i]['nestle_fit_meals_meal'];
				$type= $array[$i]['nestle_fit_measurments_title'.$current_language_db_prefix];
				$display_string .= '<li>';
				$display_string .= '<input type="text" name="the_meal[]" placeholder="'. lang('globals_meal').'" id="'.($i+1).'" value="'.$meals.'" class="meal_recipe search float_left" />';
				$display_string .= '<input type="text" name="meal_amount[]" placeholder="'. lang('globals_amount').'" id="amount_'.($i+1).'" value="'.$amount.'" class="meal_amount float_left" />';
				$display_string .= '<div class="float_left mealmeasure" id="measure'.($i+1).'" >'.$array[$i]['nestle_fit_measurments_title'.$current_language_db_prefix].'</div>';
				$display_string .= '<input type="hidden" name="meal_value[]" class="meal_value" value="'.$value.'" id="field_'.($i+1).'" />';
				$display_string .='<input type="hidden" name="calory_value" value="'.$array[$i]['nestle_fit_food_calories'].'" id="calory_'.($i+1).'" />';
				
				$display_string .= '<input type="hidden" name="calories" value="'.$array[$i]['nestle_fit_food_calories'].'"/>';
				$display_string .= '<div class="float_left meal-calories" data-total="'.$array[$i]['nestle_fit_food_calories']*$amount.'" style="color: white; width: 150px;">'.$array[$i]['nestle_fit_food_calories']*$amount." ".lang('Calories_day').'</div>';
				
				$display_string .= '<input type="hidden" name="measurments" value="'.$type.'"/>';
				//$display_string .= '<div class="recipe float_left"><a href="#"><img src="'.base_url().'images/recipe_icon.png" /></a></div>';
				$display_string .= '<div class="delete float_left"><div data-id="'.$id.'" class="removeclass"><img src="'.base_url().'images/nestle_fit/meals-delete.png" /></div></div>';
				$display_string .= '<div class="clear"></div>';
				$display_string .= '</li>';
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
				<td width="50%">
					<a href="javascript:void(0);" id="AddMoreFileBox_<?php echo $id; ?>" class="meal_button link_add_meal"><?php echo lang('globals_add_meals');?></a>
				</td>
				<td width="19%">
					<input  type="submit" class="meal_button submit_meal input_add_meal" data-id="<?php echo $id; ?>" value="<?php echo lang('globals_meals_save'); ?>" />
				</td>
                <td width="50%">
               		<p class="dir" style="width: 193px;color: white;font-size: 17px;"><?php echo lang('globals_total');?> <span id="total_calories_<?php echo $id; ?>"></span> <?php echo lang('Calories_day');?> </p>
                </td>
			</tr>
		</table>
	</form>
   <?php }?>