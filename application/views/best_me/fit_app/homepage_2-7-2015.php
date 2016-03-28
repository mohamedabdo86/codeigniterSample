<style>
#landing_page_nestle_fit
{
	background-image:url(<?php echo base_url()."images/nestle_fit/nestle_fit_landing_background.png"; ?>);
	background-repeat:no-repeat;
	background-size:contain;
	background-position:center top;
	height:520px;
	position: relative;
}
#landing_page_nestle_fit #sections
{
	position: absolute;
	top: 400px;
	height: 190px;
	width:952px;
	right: 0;
}
#calories_calculator:hover, #burn_rate:hover, #notification_messages:hover
{
	margin-right: 1px;
	margin-top: 1px;
}
#landing_page_nestle_fit #sections a:first-child
{
	margin: 0;
}

#best_life_nestle
{
	position: absolute;
	left:362px;
	top:39px;
}

#best_life_nestle:hover
{
	left:361px;
	top:40px;
}

#calories_calculator
{
	position: absolute;
	left: 355px;
	top: -8px;
	margin: 0px;
	padding: 0px;
	color: #fff;
	font-weight: bold;
	font-size: 18px;
}

#burn_rate
{
	position: absolute;
	left: 38px;
	top: -8px;
	margin: 0px 0px 0px 0px ;
	padding: 0px 0px 0px 0px;
	color: #fff;
	font-weight: bold;
	font-size: 18px;
}

#notification_messages
{
	position: absolute;
	left: 708px;
	top: -8px;
	margin: 0px 0px 0px 0px ;
	padding: 0px 0px 0px 0px;
	color: #fff;
	font-weight: bold;
	font-size: 18px;
}

</style>
<script>
$(document).ready(function(e) {
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
<?php

if($members_login == 'true')
{
	if($members_data == false)
	{
		redirect('best_me/applications/9/best_life_nestle');
		$best_life_nestle = '<a id="notification_messages" href="'. site_url("best_me/applications/9/best_life_nestle") .'" >'. lang("nestlefit_nestle_fit").'</a>';
		$notification_messages = '<a id="best_life_nestle" style="font-size:20px" href="'. site_url("best_me/applications/9/best_life_nestle") .'" ><img src="' . base_url() . 'images/nestle_fit/nestle_fit_landing_se77a.png"></a>';
		$calories_calculato_anchor='<a id="calories_calculator" href="'.site_url("best_me/applications/9/calories_calculator").'" >'. lang("nestlefit_calc_calories").'</a>';
		$burn_rate_anchor='<a id="burn_rate" href="'.site_url("best_me/applications/9/burn_rate").'" >'. lang("nestlefit_burn_rate").'</a>';
	}
	else
	{
		$best_life_nestle = '<a id="notification_messages" href="'. site_url("best_me/applications/9/best_life_nestle/".$members_data[0]['nestle_fit_health_ID']) .'">'. lang("nestlefit_nestle_fit") .'</a>';
		$notification_messages = '<a id="best_life_nestle" style="font-size:20px" href="'. site_url("best_me/applications/9/notification_messages/".$members_data[0]['nestle_fit_health_ID']) .'" >Notification Messages</a>';
	    $calories_calculato_anchor='<a id="calories_calculator" href="'.site_url("best_me/applications/9/calories_calculator").'" >'. lang("nestlefit_calc_calories") .'</a>';
	    $burn_rate_anchor='<a id="burn_rate" href="'.site_url("best_me/applications/9/burn_rate").'" >'. lang("nestlefit_burn_rate").'</a>';
	}
	
}
else 
{
	$best_life_nestle = '<a id="notification_messages" class="fancybox fancybox.ajax" href="'. site_url("ajax/login_panel") .'">'. lang("nestlefit_nestle_fit") .'</a>';
	$notification_messages = '<a id="single_1" style="font-size:20px" class="fancybox fancybox.ajax" href="'. site_url("ajax/login_panel") .'" >Notification Messages</a>';
	$calories_calculato_anchor='<a id="calories_calculator" class="fancybox fancybox.ajax" href="'. site_url("ajax/login_panel") .'" >'. lang("nestlefit_calc_calories") .'</a>';
	$burn_rate_anchor='<a id="burn_rate" class="fancybox fancybox.ajax" href="'.site_url("ajax/login_panel").'" >'. lang("nestlefit_burn_rate").'</a>';
}

if($members_data == false)
{
	$burn_rate_href = "";
	$calories_calculator = "";
	$notification_messages = "";
}
else
{
	if(empty($members_data))
	{
		$burn_rate_href = "";
		$calories_calculator = "";
		$notification_messages = "";
	}
	else
	{
		$burn_rate_href =  site_url("best_me/applications/9/burn_rate");
		$calories_calculator = site_url("best_me/applications/9/calories_calculator");
		$notification_messages = site_url("best_me/applications/9/notification_messages");
	}
	
}

?>
  <?php /*?><span style="word-wrap: break-word;overflow-wrap: break-word;width: 100%;text-indent: 19px;text-align: center;">demo text demo text demo text demo text demo text demo text demo text demo text demo text demo text demo text demo text
   demo text demo text demo text demo text demo text demo text demo text demo text demo text demo text demo text demo text demo text 
</span><?php */?>
<div id="landing_page_nestle_fit">

<!-- <img id="best_life_nestle" src="<?php echo base_url();?>images/nestle_fit/nestle_fit_landing_se77a.png">-->
	<?php //echo $best_life_nestle; ?>
    <div id="sections">
    	<?php // Commented for testing ?>
    	<?php //echo $notification_messages; ?>
     
	<?php /*?><a id="notification_messages" href="<?php echo $notification_messages ?>" >'.$lang['nestlefit_nestle_fit'].'</a><?php */?>
    <?php echo $best_life_nestle; ?>
       <!-- <a id="calories_calculator" href="<?php echo $calories_calculator; ?>" >'.$lang['nestlefit_calc_calories'].'</a>-->
        <?php echo $calories_calculato_anchor;?>
        <?php echo $burn_rate_anchor;?>
        <!--<a id="burn_rate" href="<?php echo $burn_rate_href ?>" >'.$lang['nestlefit_burn_rate'].'</a>-->
      
        <?php /*?><a id="best_life_nestle" href="<?php echo site_url("best_me/applications/9/best_life_nestle") ?>" ></a><?php */?>
    </div>
</div>
