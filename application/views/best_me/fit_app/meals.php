<link rel="stylesheet" href="<?php echo base_url()."css/jquery-ui.css"?>">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<?php $style = $this->nestlefit->nestle_fit_tips_style();?>

<script type="text/javascript">
$(function() {
	$( "#tabs" ).tabs();
});
</script>
<script>
$(document).ready(function(e) { 
	$('.submit_meal').click(function(e) {
		var current_tab_id = $(this).attr('data-id');

		//loop on li to show the calories for each li
		var number_of_li =  $('#InputsWrapper_'+current_tab_id+' li').length;
		if(number_of_li != 0) 
		{
			if(has_no_meals_inserted() == 0) 
			{
				$("#tips_container #"+current_tab_id+"").trigger("click");
				$( "#tabs" ).tabs( "enable" );
			}
		}
		
		<?php /*?>if(has_no_meals_inserted() == 0) 
		{
			for (i = 1; i <=200; i++) 
			{ 
				currentmount = $('#amount_'+i).val();
				currentcalories = $('#calory_'+i).val();
				caculatecalories = currentmount * currentcalories;
				textcalories =caculatecalories+" <?php echo lang('Calories_day');?>";
				$('#calory_num_'+i).attr('data-total',caculatecalories);
				$('#calory_num_'+i).html(textcalories);
				
			}
		}<?php */?>
		
		//loop on li to get the total calories for each tab
		var total_calories = 0;
		var meal_number = 0;
		var caculatecalories = 0;
		var textcalories = '';
		var currentmount = '';
		var currentcalories = '';
		
		$("#InputsWrapper_"+current_tab_id+" li").each(function() {
			
			meal_number =  $(this).find(".meal_recipe").attr('id');
			
			currentmount = $(this).find('#amount_'+meal_number).val();
			currentcalories = $(this).find('#calory_'+meal_number).val();
			
			// table's name of meal
			//tname = $(this).find('#tname_'+meal_number).val();
			
			caculatecalories = currentmount * currentcalories;
			textcalories = caculatecalories + " <?php echo lang('Calories_day');?>";
			$(this).find('#calory_num_'+meal_number).attr('data-total',caculatecalories);
			$(this).find('#calory_num_'+meal_number).html(textcalories);
		
		 total_calories += parseInt($(this).find(".meal-calories").attr('data-total'));
		});
		
		$('#total_calories_'+current_tab_id).html(total_calories);
		
		
		if(has_no_meals_inserted() == 1)
		{
			e.preventDefault();
		}
		else
		{
			var current_post = $(this).closest('form').serializeArray();
			//var data = JSON.stringify(current_post);
//			alert(data);
//			alert(current_post.join("\n"));
			$.ajax({
					  url:  "<?php echo site_url("ajax/add_meals"); ?>",
					  type: "POST",
					  data: current_post,
					  cache: false,
					  dataType: "json",
					  success: function(success_array)
					  {
							//alert(JSON.stringify(success_array));
//							alert(success_array.join("\n"));
					  },
					  error: function(xhr, ajaxOptions, thrownError)
					  {
						  //alert(xhr.responseText);
						  //alert(thrownError);
						  //alert("wrong"+thrownError);
					  }
					  
				});
			
			return false;
		}
    });
			
	function has_no_meals_inserted()
	{
	var no_meals = 0 ;
	
	$('.add_meal_field').each(function(index, element) {
			if($(this).val().trim() == '')
			{
				$(this).css("border", "2px solid red");
				no_meals = 1;
			}
		});
		
	$('.add_amount_field').each(function(index, element) {
			if($(this).val().trim() == '')
			{
				$(this).css("border", "2px solid red");
				no_meals = 1;
			}
		});
		
		return no_meals;
	}
    
});
</script>
<script>
$(document).ready(function(e) {
	//$("body").on("click",".removeclass", function(e){ //user click on remove text
	$( ".removeclass" ).live( "click", function(e) {
	//$("#div2").live("click", function() {

		
		var current_tab_id = $(this).attr('data-id'); // to get the id of curret tab you are in 
		
		var number_of_li_inside_tab = $( "#InputsWrapper_"+current_tab_id+" li" ).size(); // to get the size of li inside tab
		
		
		if( number_of_li_inside_tab >= 1 ) 
		{
			$(this).parent().parent('li').remove(); //remove text box
			number_of_li_inside_tab--; //decrement textbox
			
			$('#InputsWrapper_'+current_tab_id).attr('data-list', number_of_li_inside_tab);// to add number of li in InputsWrapper
			
			var state = new Boolean();
			state = true;
			
			$("#InputsWrapper_"+current_tab_id+" li").each(function() {
			
			var data_recipe_name = $(this).find(".meal_recipe").val();
			var data_recipe_amount = $(this).find(".meal_amount").val();
			
			if(data_recipe_name == '' || data_recipe_amount == '')
			state = false;
			else
			state = true;
			  
			});
			
			if(state == true || number_of_li_inside_tab == 0)
			$( "#tabs" ).tabs("enable");
			else
			$( "#tabs" ).tabs("disable");
			
		}

		return false;
	});
	
});
</script>

<?php
if(!$this->members->members_id)
{
	redirect(site_url('best_me/applications/9/homepage'), 'refresh');
}

//Load Meals library
$CI =& get_instance();
$CI->load->library('meals');
?>

<div class="meals_container">


<!--Fancybox For Tips-->
<?php
echo '<div id="tips_container">';
for($i=0;$i<sizeof($meals_tips_types); $i++)
{
	$meals_type_id = $meals_tips_types[$i]['nestle_fit_tips_types_ID'];
	
	$tips = $this->nestlefit->nestle_fit_tips($meals_type_id,$current_language_db_prefix);
	if(sizeof($tips)!=0){
	$image_tip = $tips[0]['images_src'];
	echo '<img id="'.$meals_type_id.'" class="fancybox meals_tips" src="'. base_url().'uploads/tips/'.$image_tip.' "/>';
	}
}
echo '</div>';


$members_image=base_url()."uploads/members/".$this->members->members_image;
echo '<div id="nestlefit_member_img_container" style="padding-top:13px;">'.nestlefit_member_image($members_image,130,130).'</div>';
?>
    <?php 
	$day= date('Y-m-d');
	if($val_4==0)
	{
		$current_day = $day;
		$current_url = current_url();
	}
	else
	{
		$current_day=$val_4;
        $delete = "/" . $val_4;
        $current_url = str_replace($delete, "", current_url());	
	}
	
	?>
    <div id="meals_details">
        <h3 id="water_header_title"><?php echo lang('meals_title'); ?></h3>
        <div id="back_button">
            <a class="back" title="<?php echo lang('globals_back'); ?>" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>"><img alt="<?php echo lang('globals_back'); ?>" title="<?php echo lang('globals_back'); ?>" src="<?php echo base_url().'images/nestle_fit/back.png'; ?>" /></a>
            <a class="back-title" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>">  <span><?php echo  lang("nestlefit_back_btn"); ?></span></a>
        </div>
        <div id="calender">
        <?php
            $CI = & get_instance();
            $CI->load->library('widgets');
            $CI->widgets->nestle_fit_picker($start_date, $current_url);
        ?>
        </div>
         <p id="day"><?php echo lang('dayInDate'); ?> <?php echo $current_day;?></p>       
	</div>
    
    
    <!--
        ***	 This div for recommendation
        ***	 to user some healthy recipes
    --!>
    <?php
	echo '<div class="recommend fancybox" style="color: white; text-align: center; display: none">';
		$user_data = $this->nestlefit->get_user_data($val_2);
		$get_calories = $this->nestlefit->get_user_current_calories($val_2, $current_day);
		$get_weight = $this->nestlefit->get_user_current_weight($val_2, $current_day);
		$recommended_recipes = $this->nestlefit->get_recommended_recipes();
		shuffle($recommended_recipes);
		
		//echo "<pre>";
//		print_r($get_calories);
//		echo "<pre/>";
		
		$user_calories = 0;
		$breakfast = 0;
		$dinner = 0;
		$lunch = 0;
		$snake1 = 0;
		$snake2 = 0;
		$result = 0;
		for ($i = 0; $i < sizeof($get_calories); $i++):
		
			//$meal_table = $get_calories[$i]['tname'];
//			if($meal_table == 'nestle_fit_food') {
//				
//				$meal_calory = $get_calories[$i]['nestle_fit_food_calories'];
//				
//			} elseif($meal_table == 'recipes') {
				
				$meal_calory = $get_calories[$i]['recipes_calories'];
				
			//}
			
			
			$user_calories += $meal_calory * $get_calories[$i]['nestle_fit_meals_amount'];
			if ($get_calories[$i]['nestle_fit_meals_type'] == 1)
			{
				$breakfast += $meal_calory * $get_calories[$i]['nestle_fit_meals_amount'];
			}
			elseif ($get_calories[$i]['nestle_fit_meals_type'] == 3)
			{
				$lunch += $meal_calory * $get_calories[$i]['nestle_fit_meals_amount'];
			}
			elseif ($get_calories[$i]['nestle_fit_meals_type'] == 5)
			{
				$dinner += $meal_calory * $get_calories[$i]['nestle_fit_meals_amount'];
			}
			elseif ($get_calories[$i]['nestle_fit_meals_type'] == 2)
			{
				$snake1 += $meal_calory  * $get_calories[$i]['nestle_fit_meals_amount'];
			}
			elseif ($get_calories[$i]['nestle_fit_meals_type'] == 4)
			{
				$snake2 += $meal_calory  * $get_calories[$i]['nestle_fit_meals_amount'];
			}
		endfor;
		
		$current_height = $user_data[0]['nestle_fit_health_height'];
		$current_date_of_birth = $user_data[0]['nestle_fit_health_birthday'];
		$activity_mode = $user_data[0]['nestle_fit_health_activity_mode_value'];
		$type = $user_data[0]['nestle_fit_health_sex'];
		$age = $this->nestlefit->get_age_from_date_of_birth($current_date_of_birth);
		
		for ($i = 0; $i < sizeof($get_weight); $i++):
							$current_date = $get_weight[$i]['nestle_fit_health_weights_date'];
							$dt = new DateTime($current_date);
							$date = $dt->format('d-m-Y');
							$get_date = $dt->format('d-m-Y');
							$today = date('d-m-Y');
							$current_weight = $get_weight[$i]['nestle_fit_health_weights_weight'];
							$nestle_fit_progress=$get_weight[$i]['nestle_fit_progress_ID'];
							$calories = $this->nestlefit->calculate_calories($current_height, $current_weight, $age, $type, $activity_mode,$nestle_fit_progress);
		endfor;
		$differCal = $calories - $user_calories;
		
		echo lang('consume') . " {$user_calories} " . lang('Calories_day')."<br/> ". lang('rest') ." {$differCal} ";
		echo "<br />";
		
		foreach($recommended_recipes as $recommended_recipe) {
			if($current_language_db_prefix == "_ar") {
				$title = "recipes_title".$current_language_db_prefix;
			} else {
				$title = "recipes_title";	
			}
			$id = $recommended_recipe["recipes_ID"];
			$result += $recommended_recipe['recipes_calories'];
			
			echo '<b><a class="fancybox recommended_recipe" href="best_cook/delicious_recipes/'.$id.'" style="font-size: 22px; color: #40FF00" target="_blank" >'.$recommended_recipe[$title].'</a></b>';
				echo "<br />";
			
			if($differCal <= round($result)) break;
			
		}
		
	echo '</div>';	
	
	if($val_4 == 0 || $val_4 == date('Y-m-d')) {
		echo '
		<script type="text/javascript">
			$(document).ready(function(e) {
				$("#tabs_3, #tabs_5").click(function(e) {
					
					$(".recommend").fancybox({live: false});
					$(".recommend").click();
					$(".recommend").off("click.fb-start");
				});
			});	
		
		</script>';
	}
    ?>
    
    <div id="meals_wrapper" class="float_left">

    <div id="tabs" class="float_left">
        <ul>
            <li class="float_left"><a style="padding:8px;" data-id="1" id="tabs_1" href="#tabs-1"><span id="meal_type_icon"><img  src="<?php echo base_url()."images/nestle_fit/breakfast-icon.png"; ?>"/></span> <?php echo lang('Breakfast_meal'); ?></a></li>
            <li class="float_left"><a style="padding:8px;" data-id="2" id="tabs_2" href="#tabs-2"><span class="meal_type_icon2"><img  src="<?php echo base_url()."images/nestle_fit/snake-icon.png"; ?>"/></span> <?php echo lang('Snacks_meal'); ?></a></li>
            <li class="float_left"><a style="padding:8px;" data-id="3" id="tabs_3" href="#tabs-3"><span class="meal_type_icon2"><img  src="<?php echo base_url()."images/nestle_fit/lunch-icon.png"; ?>"/></span> <?php echo lang('Lunch_meal'); ?></a></li>
            <li class="float_left"><a style="padding:8px;" data-id="4" id="tabs_4" href="#tabs-4"><span class="meal_type_icon2"><img  src="<?php echo base_url()."images/nestle_fit/snake-icon.png"; ?>"/></span> <?php echo lang('Snacks_meal'); ?></a></li>
            <li class="float_left"><a style="padding:8px;" data-id="5" id="tabs_5" href="#tabs-5"><span class="meal_type_icon2"><img  src="<?php echo base_url()."images/nestle_fit/dinner-icon.png"; ?>"/></span> <?php echo lang('Dinner_meal'); ?></a></li>
        </ul>
        
        <div id="tabs-1">
		<?php
		
		//for ($i = 0; $i < sizeof($get_calories); $i++):
//			$tname = $get_calories[$i]['tname'];
//		endfor;
		
		$foreign_id = 1;
		if($val_4)
		{
			$current_day = $val_4;
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id); // $val_2 = $member_id ;; $val_4 = day
			$read_only = 'readonly="readonly"';
		}
		else
		{
			$current_day = date('Y-m-d');
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id);
			$read_only = false;
		}
		
		$params = array('data'=>$data,'val_4'=>$val_4,'val_2'=>$val_2,'read_only'=>$read_only,'foreign_id'=>$foreign_id);
		
		echo $CI->meals->get_meals($params);
		
		?>           
        </div>
        <div id="tabs-2">
        <?php
		$foreign_id = 2;
		if($val_4)
		{	
			$current_day = $val_4;
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id); // $val_2 = $member_id ;; $val_4 = day
			$read_only = 'readonly="readonly"';
		}
		else
		{
			$current_day = date('Y-m-d');
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id);
			$read_only = false;
		}
		$params = array('data'=>$data,'val_4'=>$val_4,'val_2'=>$val_2,'read_only'=>$read_only,'foreign_id'=>$foreign_id);
		echo $CI->meals->get_meals($params);
		?> 
        </div>
        <div id="tabs-3">
        <?php
		$foreign_id = 3;
		if($val_4)
		{
			$current_day = $val_4;
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id); // $val_2 = $member_id ;; $val_4 = day
			$read_only = 'readonly="readonly"';
		}
		else
		{
			$current_day = date('Y-m-d');
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id);
			$read_only = false;
		}
		$params = array('data'=>$data,'val_4'=>$val_4,'val_2'=>$val_2,'read_only'=>$read_only,'foreign_id'=>$foreign_id);
		echo $CI->meals->get_meals($params);
		?> 
        </div>
        <div id="tabs-4">
        <?php
		$foreign_id = 4;
		if($val_4)
		{
			$current_day = $val_4;
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id); // $val_2 = $member_id ;; $val_4 = day
			$read_only = 'readonly="readonly"';
		}
		else
		{
			$current_day = date('Y-m-d');
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id);
			$read_only = false;
		}
		$params = array('data'=>$data,'val_4'=>$val_4,'val_2'=>$val_2,'read_only'=>$read_only,'foreign_id'=>$foreign_id);
		echo $CI->meals->get_meals($params);
		?>  
        	
        </div>
        <div id="tabs-5">
        <?php
		$foreign_id = 5;
		if($val_4)
		{
			$current_day = $val_4;
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id); // $val_2 = $member_id ;; $val_4 = day
			$read_only = 'readonly="readonly"';
		}
		else
		{
			$current_day = date('Y-m-d');
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id);
			$read_only = false;
		}
		$params = array('data'=>$data,'val_4'=>$val_4,'val_2'=>$val_2,'read_only'=>$read_only,'foreign_id'=>$foreign_id);
		echo $CI->meals->get_meals($params);
		?> 
        </div>
<!--        <a class="back" style="position: relative;top: 40px;" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>">Back</a>-->
    </div>
    
    <div class="clear"></div>
    </div>
</div>

