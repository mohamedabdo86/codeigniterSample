<?php
if(!$this->members->members_id)
{
   redirect(site_url('mobile/best_me/applications/9/homepage'), 'refresh');
}
?>
<?php
if ($val_3 == 0)
{
    $new_date2 = date("Y-m-d");
}
else
{
    $date = date_create($val_3);
    $new_date2 = date_format($date, "Y-m-d");
}
$this->nestlefit->add_new_weight($val_2);

$user_data = $this->nestlefit->get_user_data($val_2);
$user_calculations_data = $this->nestlefit->get_user_calculations_data($val_2);
$get_weight = $this->nestlefit->get_user_current_weight($val_2);
$get_calories = $this->nestlefit->get_user_current_calories($val_2, $new_date2);
$user_calories = 0;
$breakfast = 0;
$dinner = 0;
$lunch = 0;

for ($i = 0; $i < sizeof($get_calories); $i++):
    $user_calories += $get_calories[$i]['nestle_fit_food_calories']*$get_calories[$i]['nestle_fit_meals_amount'];
    if ($get_calories[$i]['nestle_fit_meals_type'] == 1)
    {
        $breakfast += $get_calories[$i]['nestle_fit_food_calories'] * $get_calories[$i]['nestle_fit_meals_amount'];
    }
    elseif ($get_calories[$i]['nestle_fit_meals_type'] == 3)
    {
        $lunch += $get_calories[$i]['nestle_fit_food_calories'] * $get_calories[$i]['nestle_fit_meals_amount'];
    }
    elseif ($get_calories[$i]['nestle_fit_meals_type'] == 5)
    {
        $dinner += $get_calories[$i]['nestle_fit_food_calories'] * $get_calories[$i]['nestle_fit_meals_amount'];
    }
    elseif ($get_calories[$i]['nestle_fit_meals_type'] == 2)
    {
        $snake1 += $get_calories[$i]['nestle_fit_food_calories']  * $get_calories[$i]['nestle_fit_meals_amount'];
    }
    elseif ($get_calories[$i]['nestle_fit_meals_type'] == 4)
    {
        $snake2 += $get_calories[$i]['nestle_fit_food_calories']  * $get_calories[$i]['nestle_fit_meals_amount'];
    }
endfor;

$current_weight = $get_weight[0]['nestle_fit_health_weights_weight'];

$user_name = $user_data[0]['nestle_fit_health_name'];
$current_height = $user_data[0]['nestle_fit_health_height'];
$current_date_of_birth = $user_data[0]['nestle_fit_health_birthday'];
$activity_mode = $user_data[0]['nestle_fit_health_activity_mode_value'];
$type = $user_data[0]['nestle_fit_health_sex'];
$age = $this->nestlefit->get_age_from_date_of_birth($current_date_of_birth);


$rate_of_weight_loss = round($user_calculations_data[0]['nestle_fit_calculations_weight_loss_rate'] / 7, 1);
$daily_weight = round($current_weight - $rate_of_weight_loss, 1);
?>

<?php
for ($i = 0; $i < sizeof($get_weight); $i++)
{
    $current_date1 = $get_weight[$i]['nestle_fit_health_weights_date'];
    $dt1 = new DateTime($current_date1);
    $today_date = $dt1->format('d-m-Y');
    //$url_date= $this->uri->segment(7,0);
    $new_date;
    $current_url;
    if ($val_3 == 0)
    {
        $new_date = $today_date;
        $current_url = current_url();
    }
    else
    {
        $new_date = $val_3;
        $delete = "/" . $val_3;
        $current_url = str_replace($delete, "", current_url());
    }
    $meals_url = str_replace("best_life_end_day", "best_life_welcome", current_url());
    $end_url = str_replace($delete, "", $meals_url);

    //echo $current_url.">>".$this->uri->uri_string().">>".$url_date;
    $prev_date = date('d-m-Y', strtotime($new_date . ' -1 days'));
    $next_date = date('d-m-Y', strtotime($new_date . ' +1 day'));
}
?>
<div class="row nestle-fit-end-day">

                   
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<?php
        $members_image = base_url() . "uploads/members/" . $this->members->members_image;
		echo '<div id="nestlefit_member_img_container" style="padding-top: 16px;">'.nestlefit_member_image($members_image,115,115).'</div>';
	?>
</div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  	<div class="col-xs-8 col-sm-7 result-class">
       <h3 class="nestlefit_inner_title"><?php echo lang('my_result'); ?></h3>
    </div>
    <div class="class=col-xs-4 col-sm-4 back_container">
    	<a rel="external" class="back"  title="<?php echo lang('globals_back'); ?>" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>"><img alt="<?php echo lang('globals_back'); ?>" title="<?php echo lang('globals_back'); ?>" src="<?php echo base_url().'images/nestle_fit/back.png'; ?>" /></a>
    	<a rel="external" class="back-title" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>">  <span style="color:#FFF"><?php echo  lang("nestlefit_back_btn"); ?></span></a>
    </div>
   </div>
     <?php
				
                    for ($i = 0; $i < sizeof($get_weight); $i++):
                        $current_date = $get_weight[$i]['nestle_fit_health_weights_date'];
                        $dt = new DateTime($current_date);
                        $date = $dt->format('d-m-Y');
                        $get_date = $dt->format('d-m-Y');
                        $today = date('d-m-Y');
						  $start_date = $get_weight[$i]['nestle_fit_calculations_date'];
                        $current_weight = $get_weight[$i]['nestle_fit_health_weights_weight'];
						$nestle_fit_progress=$get_weight[$i]['nestle_fit_progress_ID'];
                        $calories = $this->nestlefit->calculate_calories($current_height, $current_weight, $age, $type, $activity_mode,$nestle_fit_progress);
						if($calories>=$user_calories){
                        $sub_calories = $calories - $user_calories;
						}else{
							$sub_calories =$user_calories - $calories;
							}
                        $loss_weight = $current_weight - $daily_weight;
                        $update_new_data = date_create($new_date);
                        $data_3 = date_format($update_new_data, "d-m-Y");
                       


                        ///this for water and meals url
                        if ($val_3 == $today_date)
                        {
                            $water_meals_url = "";
                        }
                        else
                        {
                            $water_meals_url = $val_3;
                        }
						?>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-pull-4 col-sm-pull-4 col-md-pull-5 col-lg-pull-5" style="margin-top:40px;"> 
 
<?php
      $CI = & get_instance();
      $CI->load->library('widgets');
     $CI->widgets->nestle_fit_picker($start_date, $current_url);
         ?>
      <span style="color:white;"> <?php echo lang('dayInDate'); ?> <?php echo $new_date;?> </span>
   </div> 
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 id="recommended_calories" class="text-color"><?php echo lang('fit_recommended_calorie') ." ". $calories; ?> <?php echo lang('Calories_day'); ?></h3>
     </div>
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <h3 id="user_calories" class="text-color"><?php echo $user_calories." ".lang('fit_calories_consumed'); ?></h3>
     </div>
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 6px;">
       <h3 id="sub_calories" class="text-color"> <?php if($user_calories<=$sub_calories){echo lang('fit_remainder_calories');}else{echo lang('fit_remainder_calories2');} ?> : <?php echo $sub_calories; ?> <?php echo lang('Calories_day'); ?></h3>
     </div>
     
   <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 food">
       <h4> <?php echo lang('Breakfast_meal'); ?></h4>
        <p align="center"><?php echo $breakfast; ?><br /><?php echo lang('Kcal'); ?></p>
     </div>
     
     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 food">
     <h4> <?php echo lang('Lunch_meal'); ?></h4>
     <p align="center"><?php echo $lunch; ?><br /> <?php echo lang('Kcal'); ?></p>
     </div>
   </div>
     
   <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">  
     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 food">
          <h4>  <?php echo lang('Dinner_meal'); ?></h4> 
          <p align="center"><?php echo $dinner; ?> <br /><?php echo lang('Kcal'); ?></p>
     </div>
     
     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 food">
       <h4> <?php echo lang('Snacks_meal'); ?></h4> 
       <p align="center"><?php echo $snake1 + $snake2; ?><br /> <?php echo lang('Kcal'); ?></p>
     </div>
   </div>  
   
   <div>
   </div>
   <?php
            $today = date('Y-m-d');
            $counter_of_water =0;
            if ($val_4 and $val_4 != $today) // Check if user show water of other day else today 
            {
                $array = $this->nestlefit->get_water($val_2, $val_4);
                if ($array) // Check if user has enter the water for other day or not
                {
					
                    $counter_of_water = $array[0]['nestle_fit_water_count'];
                }
            }
            else // Show only water for the current day
            {
                $array = $this->nestlefit->get_water($val_2, $today);
                if ($array) // Check if user has enter the water for today or not yet
                {
                    $counter_of_water = $array[0]['nestle_fit_water_count'];
                }
            }
			  
	 	$display = $user_calories;
					//echo $sub_calories."fffff";
                    $day_advice = "";
                    if ($display >= $sub_calories)
                    {
                        //echo " <div class=\"arrow-up_yellow arrow\">&nbsp;</div>";
                        $day_advice = lang('fit_weight_range_overweight');
                    }
                    elseif ($display <= $sub_calories)
                    {
                        //echo " <div class=\"arrow-up_yellow3 arrow\">&nbsp;</div>";
                        $day_advice = lang('fit_weight_range_underweight');
                    }
                    else
                    {
                       // echo " <div class=\"arrow-up_yellow2 arrow\">&nbsp;</div>";
                        $day_advice = lang('fit_weight_range_normal');
                    }
	 
		
            ?>
     <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 process_div_bar">
     <div style="margin-top:3px;">
     
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="background-color:#229a6f; height: 25px;">
         <div <?php if ($display >= $sub_calories){?> style="visibility:visible !important;"<?php }?> class="arrow-up_yellow arrow">&nbsp;</div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="background-color:#36dda1; height: 25px;">
          <div <?php if (!($display >= $sub_calories) && !($display <= $sub_calories)){?> style="visibility:visible !important;"<?php }?> class="arrow-up_yellow2 arrow">&nbsp;</div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="background-color:#fdfdfd; height: 25px;">
          <div <?php if ($display <= $sub_calories){?> style="visibility:visible !important;"<?php }?>class="arrow-up_yellow3 arrow">&nbsp;</div>
        </div>
     
     </div>
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:white; height: 2px; margin-top:25px;"></div>
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 advice">
       <p><img src="<?php echo base_url()."images/nestle_fit/water_logo.jpg";?>" class="" /><?php echo lang('fourcups', $counter_of_water); ?> </p>
     </div>
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 advice">
        <p><img src="<?php echo base_url()."images/nestle_fit/left_wat_logo.jpg";?>" class="" /><?php echo $day_advice; ?></p>
     </div>
    </div>
     <?php endfor; ?>
</div>



<style>
#user_image {
	margin-top: 30px;	
}
.nestlefit_inner_title {
  margin-top: 95px;
}
.advice img{
	float:right;
	}
.english .advice img{
	float:left;
	}
.advice p{
	color:white;
	}		
	
	.english  span 
	{
	float: right;
	}
	.arrow{
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 7.5px 13px 7.5px;
        border-color: transparent transparent #ffffff transparent;
		padding-top: 30px;
		visibility: hidden;

    }
 /* Smart Phone */
@media (min-width: 320px) and (max-width: 640px) {
	.result-class {
		float: right;
		text-align: left;
	}
	.result .nestlefit_inner_title {
		text-align: end;
    	margin-left: 38px;	
	}
	.back_container {
		display: table-caption;
	    margin-left: 33px;
    	margin-top: 83px;	
	}
	.english .back_container .back img {
		margin-left: -29px;	
	}
	.back_container .back-title {
		font-size: 17px;
	}
	.english .nestlefit_inner_title {
		text-align: left;
		margin-left: 38px;
	}
}

/*This Media Query For Tablet Vertical */
@media (min-device-width: 800px) and (max-device-width: 1280px){
	.result-class {
		float: right !important;
	}
	.nestlefit_inner_title {
		text-align: left;
    	margin-left: 90px;	
	}
	.arabic .back_container {
	    margin-top: 70px;
    	text-align: center;
		margin-left: 60px;
	}
	.english .back_container {
		text-align: center;
	 	margin-top: 127px;
		margin-left: -60px;
	}
	.arabic .back_container .back-title {
		font-size: 17px;
		position: relative;
		top: 50px;
		right: 60px;
	}
	.english .back_container .back-title {
		font-size: 17px;
		position: relative;
		top: 4px;
		left: 20px;
	}
	.arabic .back_container .back {
	    position: relative;
		top: 25px;
		right: 94px;
	}
	/*.english .back_container .back {
	    position: relative;
    	top: 30px;
    	left: -75px;
	}*/
	.english .back_container .back img {
		position: relative;
		top: -30px;
		left: 30px;
	}
	.english .back_container {
		text-align: right;	
	}
	/*.english .back_container .back-title {
		font-size: 17px;
		position: relative;
		top: 56px;
		right: 128px;
	}*/
	
}
</style>