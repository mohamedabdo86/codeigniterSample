<?php
if($members_login == 'true')
{
	if($members_data == false)
	{
		$best_life_nestle = '<a id="notification_messages" class="nestle_fit_app_btn" href="'. site_url("best_me/applications/9/best_life_nestle") .'" >'. lang("fit_start").'</a>';
		$calories_calculato_anchor='<a id="calories_calculator" class="nestle_fit_app_btn" href="'.site_url("best_me/applications/9/calories_calculator").'" >'. lang("fit_Calculate").'</a>';
		$burn_rate_anchor='<a id="burn_rate" class="nestle_fit_app_btn" href="'.site_url("best_me/applications/9/burn_rate").'" >'. lang("fit_know").'</a>';
	}
	else
	{
		$best_life_nestle = '<a id="notification_messages" class="nestle_fit_app_btn" href="'. site_url("best_me/applications/9/best_life_welcome/".$members_data[0]['nestle_fit_health_ID']) .'">'. lang("fit_start") .'</a>';
	    $calories_calculato_anchor='<a id="calories_calculator" class="nestle_fit_app_btn" href="'.site_url("best_me/applications/9/calories_calculator").'" >'. lang("fit_Calculate") .'</a>';
	    $burn_rate_anchor='<a id="burn_rate" class="nestle_fit_app_btn" href="'.site_url("best_me/applications/9/burn_rate").'" >'. lang("fit_know").'</a>';
	}
	
}
else 
{
	$best_life_nestle = '<a id="notification_messages" class="fancybox fancybox.ajax nestle_fit_app_btn" href="'. site_url("ajax/login_panel") .'">'. lang("fit_start") .'</a>';
	$calories_calculato_anchor='<a id="calories_calculator" class="fancybox fancybox.ajax nestle_fit_app_btn" href="'. site_url("ajax/login_panel") .'" >'. lang("fit_Calculate") .'</a>';
	$burn_rate_anchor='<a id="burn_rate" class="fancybox fancybox.ajax nestle_fit_app_btn" href="'.site_url("ajax/login_panel").'" >'. lang("fit_know").'</a>';
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
		$burn_rate_href =  site_url("best_me/applications/9/burn_rate");
		$calories_calculator = site_url("best_me/applications/9/calories_calculator");
	}
	
}

?>

<script>
$(document).ready(function(e) {
	
	//$('.desc').hide();
	$('#sections li h3.title').click(function(){
	//	$(this).next('.desc').slideToggle('slow');
	});
	
     $("#single_1").fancybox({
		  width: 420,
          height: 150,
		  scrolling   : 'no',
		  autoSize : false,
          fitToView : false,
          helpers: {
              title : {
                  type : 'float'
              }
          }
      });
});
</script>
<div style="padding:0 10px">
<h3 style="font-weight:bold;"><?php echo lang('fit_app_title');?></h3>
<p style="white-space:normal; font-size: 14px"><?php echo lang('fit_app_desc');?></p>
</div>

<div id="landing_page_nestle_fit">


    <ul id="sections">
    	<li class="float_left">
            <h3 class="title dir"><?php echo  lang("nestlefit_nestle_fit"); ?></h3>
            <div class="desc">
                <p><?php echo  lang("nestlefit_nestle_fit_desc"); ?></p>
                <h2><?php echo $best_life_nestle; ?></h2>
            </div>
        </li>
        <li class="float_left">
            <h3 class="title dir"><?php echo  lang("nestlefit_calc_calories"); ?></h3>
            <div class="desc">
                <p><?php echo  lang("nestlefit_calc_calories_desc"); ?></p>
                <h2><?php echo $calories_calculato_anchor; ?></h2>
            </div>
        </li>
         <li class="float_left">
            <h3 class="title dir"><?php echo  lang("nestlefit_burn_rate"); ?></h3>
            <div class="desc">
                <p><?php echo  lang("nestlefit_burn_rate_desc"); ?></p>
                <h2><?php echo $burn_rate_anchor; ?></h2>
            </div>
        </li>
        
        
    </ul>

</div>


