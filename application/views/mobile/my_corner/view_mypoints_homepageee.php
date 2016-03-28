<link href="<?php echo base_url(); ?>css/mycorner.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../../../../mobile/css/recipe-style.css" />

<!--[if gte IE 9]>
  <style type="text/css">
    .offer_point_left {
       filter: none;
    }
  </style>
<![endif]-->

<!--[if gte IE 9]>
  <style type="text/css">
    .offer_point_right {
       filter: none;
    }
  </style>
<![endif]-->

<style>
.no_recipe_message{padding:20px;}
.whitespace{white-space:normal;}
.triangler{
	width: 0px;
	height: 0px;
	border-style: solid;
	border-width: 11px 7px 0 7px;
	border-color: #c8c8c8 transparent transparent transparent;
	margin-left:80px;
}

.mobile_offer_point_left
{
	width: 290px;
	height: 200px;
	border-top-right-radius: 70px;
	border-bottom-left-radius: 70px;
	margin-right: 40px;
	margin-bottom: 30px;
	border: 18px solid #CCC;
	float: right;
	box-shadow: -2px 5px 11px 2px rgba(0, 0, 0, 0.44);
}

.mobile_point_number_left
{
	width: 75px;
	height: 62px;
	border-top-left-radius: 70px;
	float: right;
}

.mobile_offer_point_right
{
	width: 290px;
	height: 200px;
	border-top-left-radius: 70px;
	border-bottom-right-radius: 70px;
	margin-bottom: 30px;
	border: 18px solid #CCC;
	box-shadow: 2px 2px 11px 2px rgba(0, 0, 0, 0.44);
}

.mobile_point_number_right
{
	width: 75px;
	height: 62px;
	border-top-right-radius: 70px;
	float: left;
}

.mobile_point_text_right
{
	margin-top: 7px;
	font-size: 18px;
	white-space: normal;
	text-align: center;
	color: #FFF;
	width: 95%;
	line-height: 6px;
	float: left;
	font-weight:bold;
}

body.arabic .mobile_point_number_to_right
{
	color: #FFF;
	font-size: 26px;
	margin-top: 27px;
	margin-right: 0px;
	text-align: center;
	line-height: 0px;
	width: 80%;
	float: left;
}

body.arabic .mobile_point_number
{
	color: #FFF;
	font-size: 26px;
	margin-top: 15px;
	margin-right: 0px;
	text-align: center;
	line-height: 22px;
	width: 74%;
}

body.arabic .mobile_point_text
{
	margin-top: 7px;
	font-size: 18px;
	white-space: normal;
	text-align: center;
	color: #FFF;
	width: 80%;
	line-height: 0px;
}
.mobile_point_text .mobile_point_number{
	margin-top: 27px;
    line-height: 0;
    text-align: center;
    color: white;
	}


.mobile_offer_point_left .offer_text, .mobile_offer_point_right .offer_text {
    font-weight: bold;
    text-align: center;
    font-size: 18px;
    white-space: normal;
    margin-top: 18px;
    padding: 20px 0px 0px 0px;
    width: 100%;
    height: 75px;
    color: #FFF;
    line-height: 25px;
}

@media screen and (max-width: 768px)
{
	.bootstrap-col
	{
		text-align: center;
	}
	
	.mobile_offer_point_right
	{
		display: inline-block;
		float: none;
		margin: 15px 0px;
	}
	
	.mobile_offer_point_left
	{
		display: inline-block;
		float: none;
		margin: 15px 0px;
	}
}
</style>
<div class="container" style="background-color: #fff; background-image: none;">
	<div class="row">
		<div class="all-products col-xs-12 col-sm-12 <?php echo $current_section_color; ?>">
			<div class="all-product-header" style="background-color:#13758e !important;">
				<div id="title">
					<p><?php echo lang('mycorner_mypoints'); ?></p>
				</div>
				<div id="back">  
					<p>رجوع </p>
				</div> 
			</div>  
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<h3 style="text-align: center;"><?php echo lang('mycorner_mypoints_profit'); ?></h3>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<img alt="" src="">
		</div>
		<div class="col-xs-12 col-sm-6">
			
		</div>
	</div>
             

  <?php
  if($display_points)
  {
	  $counter_index = 0;
	  $class= "mobile_offer_point_left";
	  $point = "mobile_point_number_left";
	  $point_number = "mobile_point_number";
	  $point_text = "mobile_point_text";
	   
	  for($i=0;$i<sizeof($display_points);$i++):
	  $interaction_title = $display_points[$i]['interaction_title'.$current_language_db_prefix];
	  $interaction_points = $display_points[$i]['interaction_points'];
	  $gradient_color_background = $display_points[$i]['interaction_gradient_class'];
	  $point_color_background = $display_points[$i]['interaction_bg_class'];
	 
	  if($counter_index == 0)
	  {
		echo '<div class="row">';	
	  }
	  
	  if($counter_index == 1)
	  {
	  	$class = "mobile_offer_point_right";
	   	$point = "mobile_point_number_right";
	   	$point_number = "mobile_point_number_to_right";
	   	$point_text = "mobile_point_text_right";
	  }
	  ?>
    <div class="col-xs-12 col-sm-6 bootstrap-col">
    	<div class="<?php echo $class ?> <?php echo $gradient_color_background ?>">
        	<p class="offer_text" style="width: 100% !important;"><?php echo $interaction_title; ?></p>
    		<div class="<?php echo $point; ?> <?php echo $point_color_background; ?>"><p class="<?php echo $point_number; ?>"><?php echo $interaction_points; ?></p><p class="<?php echo $point_text; ?>"><?php echo lang('mycorner_mypoints_point'); ?></p></div>
	    </div>
    </div>
      <?php
	  $counter_index ++;
	  if($counter_index == 2)
	  {
		echo '</div>';
	  	$counter_index = 0;
	  	$class = "mobile_offer_point_left";
	  	$point = "mobile_point_number_left";
	  	$point_number = "mobile_point_number";
	  	$point_text = "mobile_point_text";
	  }
	  endfor;
  }

  
 $this->load->view('mobile/my_corner/points/view_prizes'); ?>
   
 </div><!-- END Of Container -->