<?php
if(!$this->members->members_id)
{
   redirect(site_url('mobile/best_me/applications/9/homepage'), 'refresh');
}

$this->nestlefit->add_new_weight($val_2);

$user_data = $this->nestlefit->get_user_data($val_2);
$user_calculations_data = $this->nestlefit->get_user_calculations_data($val_2);
$get_weight = $this->nestlefit->get_user_current_weight($val_2);


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
<div class="row nestle-fit-welcome-page">
<div style="margin-top:15px;">
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 2px;">
       <div class="float_left" onmouseover="document.getElementById('ask-text').style.visibility = 'visible';" onmouseout="document.getElementById('ask-text').style.visibility = 'hidden';"><a class="fancybox fancybox.ajax" href='<?php echo site_url("ajax/nestle_fit_ask_an_expert_mobile")?>' ><img src="<?php echo base_url()?>images/nestle_fit/user-profile.png" /></a></div>
     </div>
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
       <div class="float_left" onmouseover="document.getElementById('notify-text').style.visibility = 'visible';" onmouseout="document.getElementById('notify-text').style.visibility = 'hidden';"><a class="fancybox fancybox.ajax" href='<?php echo site_url("ajax/nestle_fit_mail_notifcation_mobile")?>' id="ask_an_expert"><img src="<?php echo base_url()?>images/nestle_fit/ask-an-expert-icon.png" id="ask-an-expert-icon"/></a></div>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<?php
    $members_image = base_url() . "uploads/members/" . $this->members->members_image;
	echo '<div id="nestlefit_member_img_container">'.nestlefit_member_image($members_image,150,150).' ';

	echo '<div>
		<p id="settings_username">
			<a id="user_name" href="'.site_url('mobile/best_me/applications/9/best_life_data/'.$val_2).'" rel="external"> '.$user_name.' </a>
			<a href="'.site_url('mobile/best_me/applications/9/best_life_data/'.$val_2).'" rel="external"><img src="'.base_url() . "images/nestle_fit/details-icon.png".'" /></a>
		</p>
	</div></div>';
?>
</div>

 <ul id="sections">
    <li>

      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 nestle-fit-options">
      	<div class="row">
        	<div class="col-xs-2 float">
            	<img style="margin: 10px 20px;" src="<?php echo base_url()."images/nestle_fit/meals-bg-icon.png";?>" class=""/>
            </div>
            <div class="col-xs-10 float">
            	<h3 class="title dir"><?php echo anchor('mobile/best_me/applications/9/best_life_welcome/'.$val_2.'/meals/', lang('nestlefit_today_meal'), 'rel="external"'); ?></h3>
            </div>
        </div>        
      </div>
    </li>
    <li>
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 nestle-fit-options">
      	<div class="row">
        	<div class="col-xs-2 float">
            	<img style="margin: 10px 40px;" src="<?php echo base_url()."images/nestle_fit/water-bg-icon.png";?>" class=""/>
            </div>
            <div class="col-xs-10 float">
            	<h3 class="title dir"><?php echo anchor('mobile/best_me/applications/9/best_life_welcome/'.$val_2.'/water', lang('nestlefit_today_water'), 'rel="external"');?></h3>
            </div>
        </div>
      </div>
    </li>
    <li>
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 nestle-fit-options">
      	<div class="row">
        	<div class="col-xs-2 float">
            	<img style="margin: 10px 20px;" src="<?php echo base_url()."images/nestle_fit/result-bg-icon.png";?>" class=""/>
            </div>
            <div class="col-xs-10 float">
            	<h3 class="title dir"><?php echo anchor('mobile/best_me/applications/9/best_life_end_day/'.$val_2.'', lang('nestlefit_today_result'), 'rel="external"'); ?></h3>
            </div>
        </div>
      </div>
    </li>
    
     <li>
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 nestle-fit-options">
      	<div class="row">
        	<div class="col-xs-2 float">
            
            </div>
            <div class="col-xs-10 float">
            <h3 class="title dir"> <?php echo anchor('mobile/best_me/applications/9/top_ten/'.$val_2.'', lang('nestlefit_top_ten'), 'rel="external"'); ?></h3>
            </div>
        </div>
      </div>
    </li>
  </ul>
</div>
<style>
.nestle-fit-options h3{
	margin:0;
	padding:0;
	text-align:center;
}
</style>