
<?php
if($members_login == 'true')
{
	if($members_data == false)
	{
		$best_life_nestle = '<a id="notification_messages" rel="external" class="nestle_fit_app_btn" href="'. site_url("mobile/best_me/applications/9/best_life_nestle") .'" >'. lang("nestlefit_nestle_fit").'</a>';
		$calories_calculato_anchor='<a id="calories_calculator" rel="external" class="nestle_fit_app_btn" href="'.site_url("mobile/best_me/applications/9/calories_calculator").'" >'. lang("nestlefit_calc_calories").'</a>';
		$burn_rate_anchor='<a id="burn_rate" class="nestle_fit_app_btn" rel="external" href="'.site_url("mobile/best_me/applications/9/burn_rate").'" >'. lang("nestlefit_burn_rate").'</a>';
	}
	else
	{
		$best_life_nestle = '<a id="notification_messages" rel="external" class="nestle_fit_app_btn" href="'. site_url("mobile/best_me/applications/9/best_life_welcome/".$members_data[0]['nestle_fit_health_ID']) .'">'. lang("nestlefit_nestle_fit") .'</a>';
	    $calories_calculato_anchor='<a id="calories_calculator" rel="external" class="nestle_fit_app_btn" href="'.site_url("mobile/best_me/applications/9/calories_calculator").'" >'. lang("nestlefit_calc_calories") .'</a>';
	    $burn_rate_anchor='<a id="burn_rate" rel="external" class="nestle_fit_app_btn" href="'.site_url("mobile/best_me/applications/9/burn_rate").'" >'. lang("nestlefit_burn_rate").'</a>';
	}
	
}
else 
{
	$best_life_nestle = '<a id="notification_messages"  class="fancybox fancybox.ajax nestle_fit_app_btn" href="'. site_url("mobile/my_corner/login_form") .'">'. lang("nestlefit_nestle_fit") .'</a>';
	$calories_calculato_anchor='<a id="calories_calculator"  class="fancybox fancybox.ajax nestle_fit_app_btn" href="'. site_url("mobile/my_corner/login_form") .'" >'. lang("nestlefit_calc_calories") .'</a>';
	$burn_rate_anchor='<a id="burn_rate"  class="fancybox fancybox.ajax nestle_fit_app_btn" href="'.site_url("mobile/my_corner/login_form").'" >'. lang("nestlefit_burn_rate").'</a>';
}


if($members_data == false)
{
	$burn_rate_href = "";
	$calories_calculator = "";
}
else
{
	if(empty($members_data))
	{
		$burn_rate_href = "";
		$calories_calculator = "";
	}
	else
	{
		$burn_rate_href =  site_url("mobile/best_me/applications/9/burn_rate");
		$calories_calculator = site_url("mobile/best_me/applications/9/calories_calculator");
	}
	
}

?>
<div class="row">
    <h3 style="font-weight:bold;"><?php echo lang('fit_app_title');?></h3>
    <p style="white-space:normal; font-size: 14px"><?php echo lang('fit_app_desc');?></p>
</div> 
<div class="row" id="nestle-fit-landing-page">
  <ul id="sections">
    <li>

      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 nestle-fit-options">
        <h3 class="title dir"><?php echo $best_life_nestle; ?></h3>
      </div>
  
    </li>
    <li>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 nestle-fit-options">
        <h3 class="title dir"><?php echo $calories_calculato_anchor; ?></h3>
      </div>
    </li>
    <li>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 nestle-fit-options">
        <h3 class="title dir"><?php echo $burn_rate_anchor; ?></h3>
      </div>
    </li>
  </ul>
</div>
