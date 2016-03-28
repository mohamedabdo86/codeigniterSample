<style>
    .arrow{
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 7.5px 13px 7.5px;
        border-color: transparent transparent #ffffff transparent;

    }
    .app_wrapper{
        height:535px;
        background-image:url(<?php echo base_url() . "images/nestle_fit/end-of-day-background.jpg"; ?>);
    }
    .app_register{
        height: auto;
        width: 585px;
        margin: 145px 27px 0px 0px;
    }
    .app_header{
        margin-top:40px;
        text-align: center;
        color: orange;
        font-weight: bold;
    }
    .form_label{
        color:#CCC;
    }
    .form_input_larg{
        width: 300px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
    }
    .form_input_small{
        width: 100px;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
    }
    .edit_mydata{
        position: absolute;
        bottom: 46px;
        left: 105px;
        padding:36px 159px 1px 4px;
    }
    .app_link{
        position:relative;
        bottom:-75px;
        padding:14px 90px;
    }
    .app_date{
        width:45%;
        margin-top:8px;
        text-align:center;
        font-size: 23px;
        color: #CCC;
    }
    .app_calories{
        text-align: center;
        margin-top: 70px;
        color: orange;
        font-size: 12px;
        font-weight: bold;
    }
    #day_data{
        width: 237px;
        height: 102px;
        color: #FFF;
        margin: 36px 16px 0px 15px;
    }
	.other-food{
		margin-right: 40px;
		}
    .english .other-food{
        float:left;
		margin-left: 40px !important;
		margin-right: 0px !important;
    }
	

    .end_day_wrapper
    {
        margin-top:-41px;
        width:100%;
        height:auto;
        position:relative;
		margin-left: -165px !important;
    }
    
    .end_day_wrapper #end_day
    {
        width: 643px  !important;
        min-height: 410px;
        margin-top:-191px;
    }
    .end_day_wrapper #end_day li
    {
        width: 644px !important;
        height: 410px !important;
        /* margin: 10px 16px; */
        list-style: none;;
    }
    .recentitem_next.disabled , .recentitem_prev.disabled
    {
        visibility:hidden;
    }
    .recentitem_prev
    {
        float:right;
    }
    .english .app_register
    {
        float:right !important;

    }
    /**********HSM Style************/
    #end_day_header_title{
        position: absolute;
        top: 45px;
        margin:0 auto;

        font-size: 29px;
        color: white;
        font-weight: bold;
    }

    #user_calories{
        margin-top: -7px;
        text-align: center;
       /* color: #519680;*/
	    color: white;
        font-size:15px;
		direction: rtl;
    }
    #recommended_calories{
        text-align: center;
       /* color: #519680;*/
		 color: white;
        font-size:15px;
        margin-top: 10px;
    }
    .english #user_calories{
        margin-top:0px;
        direction: ltr;
    }
    .english .process_div_bar{
        margin-left: 54px; 
    }
    .english #end_day_header_title{
        top:50px;
        right: 275px;
    }
    .arabic #end_day_header_title{
        right : 285px;
		top: 30px;
    }
    .process_div_bar{
        background: #38bc8d;
        width: 91%;
        margin: -110px auto;
        border-radius: 10px;
        min-height: 105px;
        padding-top: 5px;
    }
    .process_div_bar .process{

        width: 85%;
     /*   background:#229b70;*/
        margin: 0px auto;
        height:25px;
    }	
    .process_div_bar .process ul{

        margin:0;
    }
    .arrow-up_yellow {
         
        float:left;
        margin: 1px 68px;

    }
    .arrow-up_yellow2 {
        
        float:left;
        margin: 1px 68px;
        margin-left: 220px;

    }
    .arrow-up_yellow3{
      
        float:left;
        margin: 1px 68px;
        margin-left:373px;

    }
    #text_related_with_arrow
    {

        text-align:center;
        border-bottom: 2px solid #FFF;
        width:93%;
        margin:15px auto;
        color:#CCCCCC;
        font-size: 14px;

    }
    .background_ph_right{
        background:url(<?php echo base_url() . "images/nestle_fit/water_logo.jpg"; ?>) no-repeat;
		 margin-top: 35px;
    }
	.english .background_ph_right
	{
		margin-top: 15px;
		}
    .background_ph_left{
        background:url(<?php echo base_url() . "images/nestle_fit/left_wat_logo.jpg"; ?>) no-repeat;
        margin-top:17px;

    }
    .img_button{
        float:left;margin-top: -50px; margin-left:130px;
    }
    .arabic .img_button{
        margin-top:41px;
    }


    .span_it_self{
        padding-top:5px;
    }

    .english .nestle_fit_picker{
        margin-right:0;
    }
    .app_date_new{
        margin-top: 98px;
        padding-top: 13px;
        margin-left: 175px;
    }
    .arabic .app_date_new{
        margin-left: 155px;
		margin-top: 59px;
    }
    

    .english .bmi_diagram {
        float: right !important;
    }
    .english .arrow-up_yellow3 {
        margin-left: 45px;
    }
    .english .arrow-up_yellow {
        float: right;
        margin-right: 42px;
    }
	.english #result_infor ul {
		float:right;
		}
		.back-title{
  position: absolute;
  top: 55px;
  color: white;
  left: 130px;
}
.english .back-title  
{
   top: 70px;
  left: 128px;
}

.end_day_bar{
  width: 100%;

}

.arabic .end_day_bar{
-moz-transform: scaleX(-1);
        -o-transform: scaleX(-1);
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
        filter: FlipH;
        -ms-filter: "FlipH";
  width: 100%;
    position: relative;
  top: 6px;
  
}
.arabic .process_div_bar{
	  padding-top: 0;
}

.arabic .back-tit {
    position: relative;
    top: 61px;
    color: white;
    left: -484px;
}

.english .my-result {
	width:640px;
	height:170px;
	margin-top:-5px;	
}
</style>
<?php
if (!$this->members->members_id)
{
    redirect(site_url('best_me/applications/9/homepage'), 'refresh');
}

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
$get_weight = $this->nestlefit->get_user_current_weight($val_2, $new_date2);
$get_calories = $this->nestlefit->get_user_current_calories($val_2, $new_date2);
$user_calories = 0;
$breakfast = 0;
$dinner = 0;
$lunch = 0;
$snake1 = 0;
$snake2 = 0;
for ($i = 0; $i < sizeof($get_calories); $i++):

	//$meal_table = $get_calories[$i]['tname'];
//	if($meal_table == 'nestle_fit_food') {
//		
//		$meal_calory = $get_calories[$i]['nestle_fit_food_calories'];
//		
//	} elseif($meal_table == 'recipes') {
		
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

<script type="text/jscript">
    jQuery(function(){

    jQuery("#end_day").jCarouselLite({
    btnNext: ".recentitem_next",
    btnPrev: ".recentitem_prev",
    visible:1,
    circular: false,

    });

    });
</script>


<script type="text/javascript">
    $(document).ready(function(e) {
        $('.recentitem_prev').addClass('disabled');
    });
</script>
<?php
for ($i = 0; $i < sizeof($get_weight); $i++)
{
    $current_date1 = $get_weight[$i]['nestle_fit_health_weights_date'];
    $dt1 = new DateTime($current_date1);
    $today_date = $dt1->format('d-m-Y');
    //$url_date= $this->uri->segment(7,0);
    $new_date;
    $current_url;
	$delete = "";
    if ($val_3 == 0) {
        $new_date = $today_date;
        $current_url = current_url();
    } else {
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
<div class="app_wrapper">
    <?php
    echo '<div id="nestlefit_member_img_container" style="padding-top:13px;">' . nestlefit_member_image($members_image, 130, 130) . '</div>';
    ?>
    <div class="app_register float_left">
        <div class="end_day_wrapper">
            <!--            <a <?php
            if ($new_date != $today_date)
            {
                ?>style="visibility: visible !important;"<?php } ?> class="recentitem_prev" href="<?php echo $current_url . "/" . $next_date; ?>"><img class="" width="20" src="<?php// echo base_url() . "images/bestme/nestle_fit_right.png"; ?>" /></a>
                        <a style="visibility: visible !important;" class="recentitem_next float_right" href="<?php echo $current_url . "/" . $prev_date; ?>"><img class="" width="20" src="<?php echo base_url() . "images/bestme/nestle_fit_left.png"; ?>" /></a>-->
            <div id="end_day">

                <ul>

                    <?php
				
                    for ($i = 0; $i < sizeof($get_weight); $i++):
                        $current_date = $get_weight[$i]['nestle_fit_health_weights_date'];
                        $dt = new DateTime($current_date);
                        $date = $dt->format('d-m-Y');
                        $get_date = $dt->format('d-m-Y');
                        $today = date('d-m-Y');
                        $current_weight = $get_weight[$i]['nestle_fit_health_weights_weight'];
						$nestle_fit_progress=$get_weight[$i]['nestle_fit_progress_ID'];
                        $calories = $this->nestlefit->calculate_calories($current_height, $current_weight, $age, $type, $activity_mode,$nestle_fit_progress);
						if($calories>=$user_calories) {
                        	$sub_calories = $calories - $user_calories;
						} else {
							$sub_calories =$user_calories - $calories;
						}
                        
						$loss_weight = $current_weight - $daily_weight;
                        $update_new_data = date_create($new_date);
                        $data_3 = date_format($update_new_data, "d-m-Y");
                        $start_date=$get_weight[$i]['nestle_fit_calculations_date'];


                        ///this for water and meals url
                        if ($val_3 == $today_date) {
                            $water_meals_url = "";
                        } else {
                            $water_meals_url = $val_3;
                        }
                        ?>
                        <li>
                            <div class="my-result">
                                <h3 id="end_day_header_title"><?php echo lang('my_result'); ?> </h3> <a class="back" title="<?php echo lang('globals_back'); ?>" style="position: relative;" href="<?php echo site_url('best_me/applications/9/best_life_welcome/' . $val_2); ?>"><img class="img_button" alt="<?php echo lang('globals_back'); ?>" title="<?php echo lang('globals_back'); ?>" src="<?php echo base_url() . 'images/nestle_fit/back.png'; ?>" /></a>
                                <a class="back-title back-tit" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>">  <span><?php echo  lang("nestlefit_back_btn"); ?></span></a>
                              <!--  <p id="end_day_date">--><?php //echo lang('dayInDate');   ?>
                               

                                <p class="app_date app_date_new">
                                    <?php
                                    $CI = & get_instance();
                                    $CI->load->library('widgets');
                                    $CI->widgets->nestle_fit_picker($start_date, $current_url);
                                    ?>
                                    <span class="span_it_self"> <?php echo lang("dayInDate") . " " . $new_date ?></span>
                                    <?php //echo  lang('dayInDate') . $data_3;   ?>
                                </p>
                                <!--   </p>-->
                                 <!--<p class="app_date"></p>-->
                                <?php // print_r($get_calories);   ?>
                                <h1 id="recommended_calories"><?php echo lang('fit_recommended_calorie') ." ". $calories; ?> <?php echo lang('Calories_day'); ?></h1>
                                <h1 id="user_calories"><?php echo $user_calories." ".lang('fit_calories_consumed'); ?></h1>
                                <h1 id="sub_calories"> <?php if($user_calories<=$calories){echo lang('fit_remainder_calories');}else{echo lang('fit_remainder_calories2');} ?> : <?php echo $sub_calories; ?> <?php echo lang('Calories_day'); ?></h1>
                                <div class="other-food"> 
                                    <h4> <?php echo lang('Breakfast_meal'); ?></h4> 

                                    <p align="center"><?php echo $breakfast; ?><br /><?php echo lang('Kcal'); ?></p>
                                  <!--   <img id="breakfast_plus" src="<?php echo base_url() . "images/nestle_fit/triangle.png"; ?>"/>-->

                                </div>
                                <div class="other-food"> 
                                    <h4> <?php echo lang('Lunch_meal'); ?></h4> 
                                    <p align="center"><?php echo $lunch; ?><br /> <?php echo lang('Kcal'); ?></p>
                             <!--      <img id="lunch_plus" src="<?php echo base_url() . "images/nestle_fit/triangle.png"; ?>"/>-->
                                </div>
                                <div class="other-food"> 
                                    <h4>  <?php echo lang('Dinner_meal'); ?></h4> 
                                    <p align="center"><?php echo $dinner; ?> <br /><?php echo lang('Kcal'); ?></p>
                                     <!--<img class="dinner_plus" src="<?php echo base_url() . "images/nestle_fit/triangle.png"; ?>"/>-->
                                </div>
                                <div class="other-food"> 
                                    <h4> <?php echo lang('Snacks_meal'); ?></h4> 
                                    <p align="center"><?php echo $snake1 + $snake2; ?><br /> <?php echo lang('Kcal'); ?></p>
                                     <!--<img class="dinner_plus" src="<?php echo base_url() . "images/nestle_fit/triangle.png"; ?>"/>-->
                                </div>
                            </div>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>

            <?php
            $today = date('Y-m-d');
            $counter_of_water =0;
            if ($val_3 and $val_3 != $today) // Check if user show water of other day else today 
            {
                $array = $this->nestlefit->get_water($val_2, $val_3);
                if ($array) { // Check if user has enter the water for other day or not
                    $counter_of_water = $array[0]['nestle_fit_water_count'];
                }
            } else { // Show only water for the current day 
                $array = $this->nestlefit->get_water($val_2, $today);
                if ($array) { // Check if user has enter the water for today or not yet
                    $counter_of_water = $array[0]['nestle_fit_water_count'];
                }
            }
            ?>


            <div class="process_div_bar float_left">
                <div class="process">
                <!--    <ul >
                        <li class="bmi_diagram" style="background:#229a6f;width:33.333%; height:25px;float:left;  box-shadow: -1px -1px 1px #2E7245;">&nbsp;</li>
                        <li class="bmi_diagram" style="background:#36dda1;width:33.333%;height:25px;float:left;  box-shadow: -1px -1px 1px #2E7245;">&nbsp;</li>
                        <li class="bmi_diagram" style="background:#fdfdfd;width:33.333%; height:25px;float:left;  box-shadow: -1px -1px 1px #2E7245;">&nbsp;</li>
                    </ul>-->

<img src="<?php echo base_url() . "images/nestle_fit/Bar.png"; ?>" class="end_day_bar"/>
                    <?php
                    $display = $user_calories;
					
					//echo $sub_calories."fffff".$user_calories;
                    $day_advice = "";
					if($display > ($calories + 200) ){
						echo " <div class=\"arrow-up_yellow arrow\">&nbsp;</div>";
                        $day_advice = lang('fit_weight_range_overweight');
						}else if($display < ($calories - 200) ){
							echo " <div class=\"arrow-up_yellow3 arrow\">&nbsp;</div>";
                        $day_advice = lang('fit_weight_range_underweight');
							}else{
								
								 echo " <div class=\"arrow-up_yellow2 arrow\">&nbsp;</div>";
                        $day_advice = lang('fit_weight_range_normal');
								}
							
							
							
                  //  if ($display >= $sub_calories)
                    //{
                      //  echo " <div class=\"arrow-up_yellow arrow\">&nbsp;</div>";
                        //$day_advice = lang('fit_weight_range_overweight');
                    //}
                    //elseif ($display <= $sub_calories)
                    //{
                      //  echo " <div class=\"arrow-up_yellow3 arrow\">&nbsp;</div>";
                        //$day_advice = lang('fit_weight_range_underweight');
                    //}
                    //else
                    //{
                      //  echo " <div class=\"arrow-up_yellow2 arrow\">&nbsp;</div>";
                        //$day_advice = lang('fit_weight_range_normal');
                    //}
                    ?>

                    <!--           <div class="arrow-up_yellow">&nbsp;</div>
                               <div class="arrow-up_yellow2">&nbsp;</div>
                               <div class="arrow-up_yellow3">&nbsp;</div>-->
                </div>

                <div id="result_infor">
                    <ul style="margin: -8px auto; width:100%;">
                        <li class="float_left background_ph_right" style="width:5%; height: 40px;">&nbsp;</li>
                        <li class="float_left" style="width:41%;"><p id="water_info" style="white-space:normal;color: white;font-size: 11px; font-weight:bold;margin-top: 20px;padding-right: 6px;"> <?php echo lang('fourcups', $counter_of_water); ?> </p></li>
                        <li class="float_left background_ph_left" style="width:7%; height: 40px;">&nbsp;</li>
                        <li class="float_left" style="width:41%;padding: 0 5px;"><p id="Performance" style="white-space:normal;color: white; font-weight:bold; font-size: 11px;margin-top: 10px;padding-right: 6px;"> <?php echo $day_advice; ?> </p></li>
                    </ul>
                </div>
            </div>



        </div>
    </div>

    <a class="edit_mydata" href="<?php echo site_url('best_me/applications/9/best_life_data/' . $val_2 . ''); ?>"></a>
</div>