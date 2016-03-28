<link href="<?php echo base_url(); ?>css/mycorner.css" rel="stylesheet" type="text/css">
<?php echo $this->load->view('template/submenu_writer');   ?>
<?php echo $this->load->view('template/tree_menu_writer'); ?>

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
</style>

<div class="clear"></div>

<div class="inner_title_wrapper">
	<div class="sections_wrapper_margin">
    <h1 class="<?php echo $current_section_color; ?> float_left" style="font-size:25px;"><?php echo lang('mycorner_mypoints'); ?></h1>
    
    <div class="clear"></div>
    </div>
</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>"></div>
	  <div class="clear"></div>
<div class="global_background" style="height:auto;">
        
        <div class="mypoints_container">
    
             <div class="points_offers">
             <h1 class="<?php echo $current_section_color; ?> float_left" style="padding:20px;"><?php echo lang('mycorner_mypoints_profit'); ?></h1>
             <div class="points_layout" style="clear:both">
             

  <table width="700">
  <?php
  if($display_points){
	   $counter_index = 0;
	   $class= "offer_point_left";
	   $point = "point_number_left";
	   $point_number = "point_number";
	   $point_text = "point_text";
	  for($i=0;$i<sizeof($display_points);$i++):
	  $interaction_title = $display_points[$i]['interaction_title'.$current_language_db_prefix];
	  $interaction_points = $display_points[$i]['interaction_points'];
	  $gradient_color_background = $display_points[$i]['interaction_gradient_class'];
	  $point_color_background = $display_points[$i]['interaction_bg_class'];
	 
	  if($counter_index == 0){
		echo '<tr>';	
	   }
	   if($counter_index == 1){
	   $class = "offer_point_right";
	   $point = "point_number_right";
	   $point_number = "point_number_to_right";
	   $point_text = "point_text_right";
	   }
	  ?>
    <td>
    <div class="<?php echo $class ?> <?php echo $gradient_color_background ?>">
        <p align="center" class="offer_text"><?php echo $interaction_title; ?></p>
    	<div align="bottom" class="<?php echo $point; ?> <?php echo $point_color_background; ?>"><p class="<?php echo $point_number; ?>"><?php echo $interaction_points; ?></p><p class="<?php echo $point_text; ?>"><?php echo lang('mycorner_mypoints_point'); ?></p></div>
    </div>
    </td>
      <?php
	  $counter_index ++;
	  if($counter_index == 2){
		  echo '</tr>';
	  $counter_index = 0;
	  $class = "offer_point_left";
	  $point = "point_number_left";
	  $point_number = "point_number";
	  $point_text = "point_text";
	  }
	  endfor;
  }
   ?>
</table>

 </div><!-- eND OF points_layout -->
 </div><!-- eND OF points_offers -->
<?php $this->load->view('my_corner/points/view_prizes'); ?>            
            
           
		</div>
        
    </div>
</div>