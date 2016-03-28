<?php
if(!$this->members->members_id)
{
	redirect(site_url('best_me/applications/9/homepage'), 'refresh');
}
?>
<?php $style = $this->nestlefit->nestle_fit_tips_style();?>
<style>
.water_cup
{
	width:28px;
	padding:5px;
	margin:5px;
	height:58px;
	cursor:pointer;
}
.water_cup_disabled
{
	width:28px;
	padding:5px;
	margin:5px;
	height:58px;
	background-repeat: no-repeat;
}
.main_div_water_content{
	width: 51%;
    margin: 0px 250px;
	padding-top: 0px;
    }
.main_div_water_content h1{
width: 100%;
text-align:center;
color: white;
font-weight: bold;

}
.main_div_water_content .water_day{
	font-size:20px;
padding-top:28px;
padding-left: 15px;
}
.english .main_div_water_content .water_day{
	font-size:20px;
padding-top:30px;
padding-bottom: 15px;

}
.english .main_div_water_content .water_day .text_in_center{
padding-top:0px;
}
.english .main_div_water_content .water_day h1{
padding-top:19px;

}
.main_div_water_content .info_water_day{
	text-align: center;
    color: white;
    font-weight: bolder;
}
.arabic .main_div_water_content h1{
width: 100%;

float:right;
text-align:center;

}
.arabic .heading_water_daily{font-size: 26px;margin-top: -10px;} 
.english .heading_water_daily{font-size: 26px;margin-top: 0px; margin-bottom:-15px;} 

body.english .back {
	top: -12px !important;
}
.app_date_new
{
	position: absolute;
	margin-left: 335px;
	margin-top: 24px;
}
.english .app_date_new{
	position: absolute;
	margin-left: 125px;
	margin-top: 30px;
}
.back-title{
   position: absolute;
 /* top: 422px;*/
  color: white;
  left: -30px;
  float: left;
}
.arabic .back-title {
    position: relative;
    top: -23px;
    color: white;
}
.water_container a .back-title {
	position: relative;
    top: 6px;	
}
.water_container .back {
	position: relative !important;
    top: -6px !important;	
}

.back img{
  margin-left: -29px;
  }
.english .back-title  
{
  top: 427px;
  left: 240px;
}
.save-water{
  color: white;
      margin: 40px;
    position: relative;
    top: 15px;
}
.main_div_water_content .back-title span {
		
}
.english .save-water {
  color: white;
  position: relative;
  left: 37px;
  top: 5px;
  bottom: 350px;
    margin: 0;
}
</style>
<script>
$(document).ready(function(e) {
	var members_id = $('#members_id').val();
	var date = $('#date').val();
		
	$('.water_cup').click(function(e) {

		var cup_full_of_water = $(this).attr("data-water-flag");
		var id = $(this).attr("data-water-id");
		if(cup_full_of_water == 0)
		{
			//$(this).css("background-color","#CCC");
			$(this).css("background-image","url(<?php echo base_url()."images/nestle_fit/water-selected.png"; ?>)");
			$(this).addClass('full');
			$(this).attr("data-water-flag","1");
			
			$.ajax({
				  url:  "<?php echo site_url("ajax/increment_water"); ?>",
				  type: "POST",
				  data: {members_id: members_id, date: date  },
				  cache: false,
				  dataType: "json",
				  success: function(success_array)
				  {
					 // $("#loading").hide();
						//alert('you drink cup of water');
				  },
				  error: function(xhr, ajaxOptions, thrownError)
				  {
					//alert("wrong"+thrownError);
				  }
			});
			
		}
		else
		{  
			//$(this).css("background-color","#fff");
			$(this).css("background-image","url(<?php echo base_url()."images/nestle_fit/water-icon.png"; ?>)");
			$(this).removeClass('full');
			$(this).attr("data-water-flag","0");
			
			$.ajax({
				  url:  "<?php echo site_url("ajax/decrement_water"); ?>",
				  type: "POST",
				  data: {members_id: members_id, date: date  },
				  cache: false,
				  dataType: "json",
				  success: function(success_array)
				  {
					 // $("#loading").hide();
					//alert('you remove driking cup of water');
				  },
				  error: function(xhr, ajaxOptions, thrownError)
				  {
					//alert("wrong"+thrownError);
				  }
			});
		}
    });

});
</script>
<script>
$(document).ready(function(e) { 
$('.save-selected').click(function(e) {
	//location.reload();

<?php 
	$today = date('d-m-Y');
	if(!$val_4){
		$date_tips = $today;
	} else {
		$date_tips = $val_4;
	}
	if($date_tips == $today ){
		?>
		$(".new-tips").trigger("click");
		
		<?php }?>
});
});
</script>
<!--Fancybox For Tips-->
<?php 

$tips = $this->nestlefit->nestle_fit_tips(6,$current_language_db_prefix);
if(sizeof($tips)!=0){
$image_tip = $tips[0]['images_src'];
echo '<img class="fancybox new-tips" src="'. base_url().'uploads/tips/'.$image_tip.' "/>';
}

?> 


<div class="water_container">
    <?php 
	$day= date('Y-m-d');
	if($val_4==0)
	{
		$current_day = $day;
		$current_url = current_url();
	}
	else
	{
		$current_day = $val_4;
        $delete = "/" . $val_4;
        $current_url = str_replace($delete, "", current_url());	
	}
	
	?>
    
<?php
echo '<div id="nestlefit_member_img_container" style="padding-top:13px;">'.nestlefit_member_image($members_image,130,130).'</div>';
?>

    <div class="main_div_water_content">

     <h1 class="heading_water_daily"><?php echo lang('nestlefit_today_water'); ?></h1>
     	<a class="back" title="<?php echo lang('globals_back'); ?>" style="position: relative;top: -13px;" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>">
        	<img alt="<?php echo lang('globals_back'); ?>" title="<?php echo lang('globals_back'); ?>" src="<?php echo base_url().'images/nestle_fit/back.png'; ?>" />
        </a>
        <a class="back-title" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>">       		<span><?php echo  lang("nestlefit_back_btn"); ?></span>
        </a>
        <a href="javascript:void(0);" class="save-water save-selected"><?php echo lang('globals_meals_save'); ?>        </a>
        <a href="javascript:void(0);" class="save-water-icon save-selected" style="display: block; margin-left: 45px;margin-top: -38px;">
        	<img style="width:25px; height:25px;" alt="<?php echo lang('globals_meals_save'); ?>" title="<?php echo lang('globals_meals_save'); ?>" src="<?php echo base_url().'images/nestle_fit/water_save.png'; ?>" />
        </a>
     
    
    <div class="info_water_day" style="position:relative">
       <div class="app_date app_date_new">
                        <?php
                        $CI = & get_instance();
                        $CI->load->library('widgets');
                        $CI->widgets->nestle_fit_picker($start_date, $current_url);
                        ?>
                      
                       <?php //echo  lang('dayInDate') . $data_3; ?>
                    </div>      
    <p class="water_day"><?php echo lang('dayInDate'); ?> <?php echo $current_day;?> </p>
    <h1 style="color:#125e9f;"><?php echo lang('consumption_of_water_daily'); ?></h1>
    
    
 
    <p style="white-space: normal;">
    <?php echo lang('number_of_cups'); ?>
    </p>
    </div>
    
	<ul class="water-icon">
<?php

$today = date('Y-m-d');


if($val_4 and $val_4 != $today) { // Check if user show water of other day else today 
	$array = $this->nestlefit->get_water($val_2,$val_4);
	?>
    <script type="text/javascript">
    	$(document).ready(function(e) {
            $('.save-water-icon').hide();
			$('.save-water').hide();
        });
    </script>
    <?php

	if($array) { // Check if user has enter the water for other day or not
		$counter_of_water =	$array[0]['nestle_fit_water_count'];
		

		for($i=1 ; $i<9 ;$i++)
		{
			if($counter_of_water != 0 ) {
				echo '<li class="water_cup_disabled float_left water_selected" data-water-id="'.$i.'" data-water-flag="1"></li>';
				$counter_of_water --;
			} else {
				echo '<li class="water_cup_disabled float_left water_not_selected" data-water-id="'.$i.'" data-water-flag="0"></li>';
			}
	
		}
	} else {
		for($i=1 ; $i<9 ;$i++) {
			echo '<li class="water_cup_disabled float_left water_not_selected" data-water-id="'.$i.'" data-water-flag="0"></li>';
		}
	}
	
} else { // Show only water for the current day
	$array = $this->nestlefit->get_water($val_2,$today);
	if($array) {// Check if user has enter the water for today or not yet
		$counter_of_water =	$array[0]['nestle_fit_water_count'];
		
		echo '<input type="hidden" id="members_id" value="'.$val_2.'"  />';
		echo '<input type="hidden" id="date" value="'.$today.'"  />';
	
		for($i=1 ; $i<9 ;$i++) {
			
			if($counter_of_water != 0 ) {
				echo '<li class="water_cup float_left water_selected" data-water-id="'.$i.'"  data-water-flag="1"></li>';
				$counter_of_water --;
			} else {
				echo '<li class="water_cup float_left" data-water-id="'.$i.'" data-water-flag="0"></li>';
			}
	
		}
	} else {
		echo '<input type="hidden" id="members_id" value="'.$val_2.'"  />';
		echo '<input type="hidden" id="date" value="'.$today.'"  />';
		for($i=1 ; $i<9 ;$i++)
		{
			echo '<li class="water_cup float_left" data-water-id="'.$i.'" data-water-flag="0"></li>';
		}

	}
}

?>
</ul>

<div class="clear"></div>
</div>
</div>