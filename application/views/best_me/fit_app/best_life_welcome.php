<?php
if(!$this->members->members_id)
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


$total_calories_for_user_today = $this->nestlefit->get_total_calories_for_user_today($val_2);

$user_image = $this->nestlefit->get_user_image($user_data[0]['nestle_fit_health_member_ID']);

$current_weight = $get_weight[0]['nestle_fit_health_weights_weight'];

$user_name = $user_data[0]['nestle_fit_health_name'];
$current_height = $user_data[0]['nestle_fit_health_height'];
$current_date_of_birth = $user_data[0]['nestle_fit_health_birthday'];
$activity_mode = $user_data[0]['nestle_fit_health_activity_mode_value'];
$type = $user_data[0]['nestle_fit_health_sex'];
$age = $this->nestlefit->get_age_from_date_of_birth($current_date_of_birth);


$rate_of_weight_loss = round($user_calculations_data[0]['nestle_fit_calculations_weight_loss_rate'] / 7, 1);
$daily_weight = round($current_weight - $rate_of_weight_loss, 1);

$this->load->view("best_me/fit_app/nestle_fit_css");
?>
<script>
$("#next").live("click", function(){
   var item = $(this);
   var weight_id = item.data("id");	
   $.ajax({
            url : "<?php echo site_url('ajax/get_weight_data'); ?>",
            data : {weight_id : weight_id, member_id : <?php echo $val_2; ?>, current_height : <?php echo $current_height; ?>, current_weight : <?php echo $current_weight; ?>, type : '<?php echo $type ?>', age : <?php echo $age; ?>, activity_mode : <?php echo $activity_mode; ?>, user_name : '<?php echo $user_name; ?>'},
            type: "POST",
			cache: false,
			dataType: "json",
          	success : function(success_array)
			{	
			   $(".app_register").html(success_array.display_data);
            },
		
    });
});
</script>

<style>
.app_wrapper{
	height:500px;
	background-image:url(<?php echo base_url()."images/nestle_fit/nestle-profile.jpg"; ?>);
	background-repeat:no-repeat;
	background-position:center top;
	background-size:contain;
	position:relative;
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
	bottom:-65px;
	padding:14px 90px;
}
.app_date{
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

#settings_username
{
	color: #1580b8;
	font-weight: bold;
	font-size: 18px;
	text-align: center;
	margin-top: -9px;
	direction:rtl !important;
}
.english ul#sections{
margin-top: 8px;	
}

#settings_username #user_name
{
	position: relative;
	top: -15px;
}

#day_water
{
	position: absolute;
	left: 120px;
	line-height: 35px;
	top: 380px;
	margin:0 !important;
	padding:0;
	color: #fff;
	font-weight: bold;
	font-size: 18px;
}

#meals
{
	position: absolute;
	left: 340px;
	line-height: 35px;
	top: 380px;
	margin:0 !important;
	padding:0;
	color: #fff;
	font-weight: bold;
	font-size: 18px;
}


#top_10
{
	position: absolute;
	left: 575px;
	line-height: 35px;
	top: 380px;
	margin: 0px;
	padding: 0px;
	color: #fff;
	font-weight: bold;
	font-size: 18px;
}

#end_of_the_day
{
	position: absolute;
	left: 810px;
	line-height: 35px;
	top: 380px;
	margin: 0px;
	padding: 0px;
	color: #fff;
	font-weight: bold;
	font-size: 18px;
}


ul#sections 
{
height: 119px;
position: absolute;
margin-top: -7px;
}
 ul#sections li {
	width: 228px;
	min-height: 170px;
}
ul#sections li .home-section-icon{
	float:right;
	margin-top: 5px;
    margin-right: 5px;
	}
.english ul#sections li .home-section-icon{
	float:left;
    margin-left: 5px;
	}	
.english ul#sections{
	margin-left: 20px;
	}
.english ul#sections li{
	width:228px;
	}
#landing_page_nestle_fit ul#sections li {
	width: 311px;
	min-height: 170px;
}
body.english ul#sections li h3 {
	word-spacing: -4px;
	text-indent: 5px;
    text-align: center;	
}
#landing_page_nestle_fit ul#sections li h3, h3.title {
	height: 56px;
	color: #fff;
	line-height: 55px;
	text-indent: 4px;
	font-weight: 600;
}
h3.title {
	font-size: 20px;
}
ul#sections{
	margin-left: 20px !important;
	}
ul#sections li h3 {
	cursor: pointer;
	font-size: 18px;
	height: 57px;
}
body.arabic ul#sections li h3 {
	text-indent: 68px;
	
}

ul#sections li:first-child h3 {
 background-image:url(<?php echo base_url()."images/nestle_fit/meals.png";
?>);
background-repeat: no-repeat;

}
ul#sections li:first-child .section-des{
	height: 70px;
	background-color:#a93b45;
	opacity: 0.7;
	text-indent: 5px;
	}
	

		
ul#sections li:nth-child(2) h3 {
 background-image:url(<?php echo base_url()."images/nestle_fit/water.png";
?>);
background-repeat: no-repeat;

}
ul#sections li:nth-child(2) .section-des{
	height: 70px;
	background-color:#ea891d;
	opacity: 0.7;
	}
ul#sections li:nth-child(3) h3 {
 background-image:url(<?php echo base_url()."images/nestle_fit/result.png";
?>);
background-repeat: no-repeat;

}
ul#sections li:nth-child(3) .section-des{
	height: 70px;
	background-color:#38bc8d;
	opacity: 0.7;
	}
ul#sections li:nth-child(4) h3 {
 background-image:url(<?php echo base_url()."images/nestle_fit/topten.png";
 
?>);
background-repeat: no-repeat;

}
ul#sections li:nth-child(4) .section-des{
	height: 70px;
	background-color:#388fbc;
	opacity: 0.7;
	}
</style>

<script type="text/javascript">
$(document).ready(function(e) {
   
   $(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
  
});
</script>
<div class="app_wrapper">


<div style="width: 170px; margin: 13px 28px 2px;" class="float_left dir">
  <div class="float_left" onmouseover="document.getElementById('ask-text').style.visibility = 'visible';" onmouseout="document.getElementById('ask-text').style.visibility = 'hidden';"><a class="various fancybox.ajax" href='<?php echo site_url("ajax/nestle_fit_ask_an_expert")?>' ><img src="<?php echo base_url()?>images/nestle_fit/user-profile.png" /></a></div>
    <div class="float_left" style="height: 1px;width: 5px"></div>
    <div class="float_left" id="ask-text" style=" line-height:45px; visibility: hidden;"><a class="various fancybox.ajax" href="<?php echo site_url("ajax/nestle_fit_ask_an_expert")?>"><?php echo lang('globals_ask_the_expert'); ?></a></div>
    <div class="clear"></div>
    <div class="float_left" onmouseover="document.getElementById('notify-text').style.visibility = 'visible';" onmouseout="document.getElementById('notify-text').style.visibility = 'hidden';"><a class="various fancybox.ajax" href='<?php echo site_url("ajax/nestle_fit_mail_notifcation")?>' id="ask_an_expert"><img src="<?php echo base_url()?>images/nestle_fit/ask-an-expert-icon.png" id="ask-an-expert-icon"/></a></div>
    <div class="float_left" style="height: 1px;width: 5px"></div>
    <div class="float_left" id="notify-text" style=" line-height:45px; visibility: hidden;"><a class="various fancybox.ajax" href="<?php echo site_url("ajax/nestle_fit_mail_notifcation")?>"><?php echo lang('nestlefit_remember_me'); ?></a></div>
    <div class="clear"></div>
</div>
<div class="clear"></div>

<?php /*
<a class="various fancybox.ajax" href='<?php echo site_url("ajax/nestle_fit_ask_an_expert")?>' ><img src="<?php echo base_url()?>images/nestle_fit/user-profile.png" id="progile"/></a>
<br/>
<a class="various fancybox.ajax" href='<?php echo site_url("ajax/nestle_fit_mail_notifcation")?>' id="ask_an_expert"><img src="<?php echo base_url()?>images/nestle_fit/ask-an-expert-icon.png" id="ask-an-expert-icon"/></a>
*/ ?>

    <?php
	//Nestle Fit member Image, var1 = members_image, var2 = width, var3 = height
	echo '<div id="nestlefit_member_img_container">'.nestlefit_member_image($members_image,200,200).' ';

	echo '<div>
		<p id="settings_username">
			<a id="user_name" href="'.site_url('best_me/applications/9/best_life_data/'.$val_2).'"> '.$user_name.' </a>
			<a href="'.site_url('best_me/applications/9/best_life_data/'.$val_2).'"><img src="'.base_url() . "images/nestle_fit/details-icon.png".'" /></a>
		</p>
	</div></div>';
	//echo"<p id='settings_username'>".$user_name.anchor('best_me/applications/9/best_life_data/'.$val_2, " <img src='" . base_url() . "images/nestle_fit/details-icon.png' />")." </p></div>";
		
		// Bottom Menu
	//	echo anchor('best_me/applications/9/best_life_welcome/'.$val_2.'/water', lang('nestlefit_today_water'), 'id="day_water"');
		//echo anchor('best_me/applications/9/best_life_welcome/'.$val_2.'/meals/', lang('nestlefit_today_meal'), 'id="meals"');
		//echo anchor('best_me/applications/9/top_ten', lang('nestlefit_top_ten'), 'id="top_10"');
		//echo anchor('best_me/applications/9/best_life_end_day/'.$val_2.'', lang('nestlefit_today_result'), 'id="end_of_the_day"');
		?>
       
        <?php 
	
		?>
          <ul id="sections">
    	<li class="float_left">
           <span class="home-section-icon" style="margin-right: 20px;"><img src="<?php echo base_url()."images/nestle_fit/meals-bg-icon.png";?>"/></span>
            <h3 class="title dir" style="text-indent: 40px;"><?php echo anchor('best_me/applications/9/best_life_welcome/'.$val_2.'/meals/',  $nestlefit_options[0]['nestle_fit_option_title'.$current_language_db_prefix]); ?></h3>
			
		<div class="section-des"><span><?php echo $nestlefit_options[0]['nestle_fit_option_desc'.$current_language_db_prefix];?></span></div>	
        </li>
        <li class="float_left">
        <span class="home-section-icon" style="margin-right: 20px;"><img src="<?php echo base_url()."images/nestle_fit/water-bg-icon.png";?>"/></span>
            <h3 class="title dir" style="text-indent: 40px;"><?php echo anchor('best_me/applications/9/best_life_welcome/'.$val_2.'/water', $nestlefit_options[1]['nestle_fit_option_title'.$current_language_db_prefix]);?></h3>
            <div class="section-des"><span><?php echo $nestlefit_options[1]['nestle_fit_option_desc'.$current_language_db_prefix];?></span></div>
        </li>
         <li class="float_left">
         <span class="home-section-icon"><img src="<?php echo base_url()."images/nestle_fit/result-bg-icon.png";?>"/></span>
            <h3 class="title dir" style="text-indent: 40px;"><?php echo anchor('best_me/applications/9/best_life_end_day/'.$val_2.'', $nestlefit_options[2]['nestle_fit_option_title'.$current_language_db_prefix]); ?></h3>
            <div class="section-des"><span><?php echo $nestlefit_options[2]['nestle_fit_option_desc'.$current_language_db_prefix];?></span></div>
        </li>
          <li class="float_left">
            <h3 class="title dir"><?php echo anchor('best_me/applications/9/top_ten/'.$val_2.'', $nestlefit_options[3]['nestle_fit_option_title'.$current_language_db_prefix]); ?></h3>
            <div class="section-des"><span><?php echo $nestlefit_options[3]['nestle_fit_option_desc'.$current_language_db_prefix];?></span></div>
         </li>
        
        
    </ul>


</div>
<style>
.section-des span{
	color:white;
	
	}
</style>

