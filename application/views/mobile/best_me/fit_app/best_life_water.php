<?php
if(!$this->members->members_id)
{
   redirect(site_url('mobile/best_me/applications/9/homepage'), 'refresh');
}
?>

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
$('.save-water').click(function(e) {
	//location.reload();

<?php 
	$today = date('d-m-Y');
	if(!$val_4){
		$date_tips=$today;
		}else{
			$date_tips=$val_4;
			}
	if($date_tips==$today ){
		?>
		$(".new-tips").trigger("click");
		
		<?php }?>
});
});
</script>
<?php $style = $this->nestlefit->nestle_fit_tips_style();?>
<!--Fancybox For Tips-->
<div class="row nestle-fit-water">
<?php 
$tips = $this->nestlefit->nestle_fit_tips(6,$current_language_db_prefix);
if(sizeof($tips)!=0){
$image_tip = $tips[0]['images_src'];
echo '<img class="fancybox new-tips" src="'. base_url().'uploads/tips/'.$image_tip.' "/>';
}
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
    
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<?php
        $members_image = base_url() . "uploads/members/" . $this->members->members_image;
		echo '<div id="nestlefit_member_img_container" style="padding-top: 16px; margin-top: 10px;">'.nestlefit_member_image($members_image,115,115).'</div>';
	?>
</div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  	<div class="col-xs-7 col-sm-7" style="float:right">
       <h3 class="nestlefit_inner_title"><?php echo lang('nestlefit_today_water'); ?></h3>
    </div>
    <div class="col-xs-5 col-sm-5" style="margin-top:35px">
        <div class="col-xs-2 col-sm-2 save-water-class" style="float:right">    
            <a href="javascript:void(0);" class="save-water-icon save-selected" style="display: block; margin-left: 45px;margin-top: -38px;">
                <img class="img-save" style="width:25px; height:25px;" alt="<?php echo lang('globals_meals_save'); ?>" title="<?php echo lang('globals_meals_save'); ?>" src="<?php echo base_url().'images/nestle_fit/water_save.png'; ?>" />
            </a>
             <a href="javascript:void(0);" class="save-water save-selected"><?php echo lang('globals_meals_save'); ?>        </a>
        </div>
        <div class="col-xs-2 col-sm-2 back-class" style="float:right; margin-right:20px">   
              <a rel="external" class="back" title="<?php echo lang('globals_back'); ?>" style="position: relative;top: -13px;" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>">
                <img alt="<?php echo lang('globals_back'); ?>" title="<?php echo lang('globals_back'); ?>" src="<?php echo base_url().'images/nestle_fit/back.png'; ?>" />
            </a>
            <a rel="external" class="back-title" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>">       		<span class="back-span" style="color:white !important"><?php echo  lang("nestlefit_back_btn"); ?></span>
            </a>
        </div>
    </div>   
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-pull-4 col-sm-pull-4 col-md-pull-5 col-lg-pull-5" style="margin-top:20px;"> 
 
    <?php
        $CI = & get_instance();
        $CI->load->library('widgets');
        $CI->widgets->nestle_fit_picker($start_date, $current_url);
         ?>
      <span style="color:white;"> <?php echo lang('dayInDate'); ?> <?php echo $current_day;?> </span>
   </div>  
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-position">
    <h1 style="color:#125e9f;"><?php echo lang('consumption_of_water_daily'); ?></h1>
    </div>
   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-position"> 
    <p style="white-space: normal; color:white;">
    <?php echo lang('number_of_cups'); ?>
    </p>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-position"> 
    	<ul class="water-icon">
<?php

$today = date('Y-m-d');


if($val_4 and $val_4 != $today) // Check if user show water of other day else today 
{
	$array = $this->nestlefit->get_water($val_2,$val_4);

	if($array) // Check if user has enter the water for other day or not
	{
		$counter_of_water =	$array[0]['nestle_fit_water_count'];
		

		for($i=1 ; $i<9 ;$i++)
		{
			if($counter_of_water != 0 )
			{
				echo '<li class="water_cup_disabled float_left water_selected" data-water-id="'.$i.'" data-water-flag="1"></li>';
				$counter_of_water --;
			}else
			{
				echo '<li class="water_cup_disabled float_left water_not_selected" data-water-id="'.$i.'" data-water-flag="0"></li>';
			}
	
		}
	}
	else
	{
		for($i=1 ; $i<9 ;$i++)
		{
			echo '<li class="water_cup_disabled float_left water_not_selected" data-water-id="'.$i.'" data-water-flag="0"></li>';
		}
	}
	
}
else // Show only water for the current day
{
	$array = $this->nestlefit->get_water($val_2,$today);
	if($array) // Check if user has enter the water for today or not yet
	{
		$counter_of_water =	$array[0]['nestle_fit_water_count'];
		
		echo '<input type="hidden" id="members_id" value="'.$val_2.'"  />';
		echo '<input type="hidden" id="date" value="'.$today.'"  />';
	
		for($i=1 ; $i<9 ;$i++)
		{
			
			if($counter_of_water != 0 )
			{
				echo '<li class="water_cup float_left water_selected" data-water-id="'.$i.'"  data-water-flag="1"></li>';
				$counter_of_water --;
			}else
			{
				echo '<li class="water_cup float_left" data-water-id="'.$i.'" data-water-flag="0"></li>';
			}
	
		}
	}
	else
	{
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
</div>
</div>


<style>
/*.arabic .back-title 
{
	position: relative;
    top: -11px;
    font-size: 1.6em;
    left: -605px;
}*/

.save-water{
  display: block;
  color: white;
  margin-top: -3px;
  text-align: left;
  font-size: 17px;
  margin-left: -2px;
  }
  .nestlefit_inner_title {
	margin-top: 35px;
    text-align: left;
    margin-left: 35px;
  }
.water_cup
{
  width: 50px;
  padding: 5px;
  margin: 5px;
  height: 65px;
  cursor: pointer;
}
.water_cup_disabled
{
	width:50px;
	padding:5px;
	margin:5px;
	height:65px;
	background-repeat: no-repeat;
}
.water_cup, .water_not_selected {
	
  background-image: url(<?php echo base_url()."images/nestle_fit/water-icon.png";?>);
  background-repeat: no-repeat;
}

.water_selected {
  background-image: url(<?php echo base_url()."images/nestle_fit/water-selected.png";?>);
}
.water-icon {
  width: 295px !important;
  margin: 0px auto;
}
.english  span 
	{
	float: right;
	}
.fancybox-skin{
	background:none;
	  box-shadow: none !important;
}	
.text-position {
	text-align:center; 
}

 /* Smart Phone */
@media (min-width: 320px) and (max-width: 640px) {
	.fancybox-wrap{
		width: 300px !important;
	}
	.arabic .back-title {
		position: relative;
		left: 28px;
	    top: -3px;
		font-size: 17px;
	}
	.english .back-span {
    	float: left;
		font-size: 17px;
	}
	.back-class {
		margin-right: 69px !important;	
	}
	.back-class .back img {
		position: relative;
    	top: 15px !important;
    	left: 24px;
	}
	.english .back-class .back img {
		position: relative;
		top: 15px !important;
		left: 6px; 
	}
	.save-water-class {
		margin-top: 55px;
    	margin-right: 10px;	
	}
	.english .save-water-class .img-save {
		display: block;
    	margin-left: -55px;
   		margin-top: -51px;
	}
	.english .save-water {
		margin-left: -20px;	
	}
	.save-water-class .back {
		position: relative;
		top: 3px;
		left: 25px;	
	}
	.nestlefit_inner_title {
	    margin-left: 15px;
	}
	.img-save {
		margin-top: -12px;
	    margin-right: 5px;	
	}
}

/*This Media Query For Tablet Vertical */
@media (min-device-width: 800px) and (max-device-width: 1280px){
	.english .nestlefit_inner_title {
		margin-top: 55px;
		text-align: left;
		margin-left: 35px;
	}
	.save-water {
		text-align: center;
  		margin-right: -10px;
    	margin-top: -4px;
	}
	.arabic .back-title {
		font-size: 15px;
    	position: relative;
    	top: -16px;
	}
	.english .back-span {
    	float: left;
		font-size: 17px;
	}
	.english .save-water {
		text-align: center;
		margin-right: 11px;
		margin-top: -4px;
	}
	.back-class {
		margin-top: 20px;	
	}
	
	.english .back-class .back {
		position: initial !important;
	}
	.save-water-class {
	    margin-top: 20px;	
	}
	.english .save-water-icon img.img-save {
		margin-top: 43px;
		margin-left: -40px;
	}
	
	.back img {
		margin-top : 15px;
		margin-right: 4px;
	}
	.english .back img {
		margin-top: 1px;
	}
	.save-water-icon img.img-save {
		margin-top: 43px;
	}
	#user_image {
		margin-top: -20px;
		position: relative;
    	top: 19px;	
	}

/*This Media Query For Tablet Horizontal */
@media (min-width: 801px){
	
}

</style>