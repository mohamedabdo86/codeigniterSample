<style >
.third_row_widgets {width:346px; height:295px;}
</style>

<?php
//Get Data for Sa7sa7y lel donia
//Sa7sa7y lel donia id : 47
list($games_id,$games_title,$games_extra) = getSectiondata(50,$current_language_db_prefix);
?>
<div class="float_left home_widget  " style="width:320px; height:295px" >
	<!--Title Left-->
    <div class="inner_title_wrapper">
        <div class="sections_wrapper_margin">
        	<h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo $games_title; ?></h1>
        </div>
    </div>
    <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
    
    <?php
    for($i=0 ;$i<sizeof($display_feautre_games); $i++):

		//$image_url = "https://www.mynestle.com.eg/Images/Games/Memory/";
		$image_url = base_url()."images/besttime/hompage_games_background.jpg";
		if(empty($display_feautre_games))
		echo '<p style="padding:15px; text-align:center">لا يوجد مقالات في هذا القسم</p>';

		$id = $display_feautre_games[$i]['games_ID'];
		$section_id = $display_feautre_games[$i]['games_subsection_ID'];
		$title = $display_feautre_games[$i]['games_name'.$current_language_db_prefix];
		$image  = $image_url;//.$display_feautre_games[$i]['images_src'];
		$url = site_url($this->router->class."/games/".$id);
		$section_url = site_url($this->router->class."/games/");
	?>
   <a href="<?php echo $url; ?>" title="<?php  echo $title; ?>"><img alt="<?php echo $title;?>" height="250" src="<?php echo $image; ?>" style="width:100%; border:none;" /></a>
    <div class="desc_wrapper global_background" >
        <a href="<?php echo $url; ?>"><h3 style="margin: 0 8px;" class="float_left"><?php echo $title; ?></h3></a>
        
        <div class="float_right">
        	<div class="triangle <?php echo $current_section_borderbottom_color; ?>"></div>
        	<div class="plus_sign white_color"><a href="<?php echo $section_url; ?>">+</a></div>
        </div>
        <div class="clear"></div>
    
    </div><!-- Desc -->
    
    <?php
	endfor;
	?>

      
</div><!-- ENd of inner_applications_bestcook_width -->


<div class="float_left global_sperator_width" style="height:295px;"></div>



<div class="float_left  " style="width:320px;">
<?php
//Get Data for Sa7sa7y lel donia
//Sa7sa7y lel donia id : 47
list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(187,$current_language_db_prefix);
?>

<div class="float_left third_row_widgets" style="width: 100%;height: 226px;">
	<!--Title Left-->
    <div class="inner_title_wrapper">
        <div class="sections_wrapper_margin">
        	<h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo $subsection_title; ?></h1>
        </div>
    </div>
    <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
    
<!-- START of Life Coach Featured -->
    <?php
    for($i=0 ;$i<sizeof($display_edata); $i++):

		$image_url = base_url()."uploads/articles/";
		if(empty($display_feautre_coach))
		echo '<p style="padding:15px; text-align:center">لا يوجد مقالات في هذا القسم</p>';

		$id = $display_feautre_coach[$i]['articles_ID'];
		$title = $display_feautre_coach[$i]['articles_title'.$current_language_db_prefix];
		$short_title = $this->common->limit_text($title,40);
		$image  = $image_url.$display_feautre_coach[$i]['images_src'];
		$url = site_url('best_time/inner_articles/' . $id);
		$section_url = site_url('best_time/section/' . $display_feautre_coach[$i]['articles_sections_ID']);
	?>
   <a href="<?php echo $url; ?>" title="<?php echo $title;?>"><img alt="<?php echo $title;?>" height="250" src="<?php echo $image; ?>" style="width:100%; border:none;" /></a>
    <div class="desc_wrapper global_background">
        <a href="<?php echo $url; ?>"><h3 style="margin: 0 8px;" class="float_left"><?php echo $short_title; ?></h3></a>
        
        <div class="float_right">
        	<div class="triangle <?php echo $current_section_borderbottom_color; ?>"></div>
        	<div class="plus_sign white_color"><a href="<?php echo $section_url; ?>">+</a></div>
        </div>
        <div class="clear"></div>
    
    </div><!-- Desc -->
    
    <?php
	endfor;
	?>

</div>

<!-- END of Life Coach Featured -->
    
    
   <?php /*<a href="<?php echo site_url("best_time/section/187"); ?>"><img style="border:none;" src="<?php echo base_url()."images/besttime/lifecoach_banner".$current_language_db_prefix.".png"; ?>" /></a>
*/ ?>
</div><!--End OF float_left-->

</div>

<div class=" float_left global_sperator_width" style="height:295px;"></div>

<div class="float_left third_row_widgets " >

<?php
//Get Data for Sa7sa7y lel donia
//Sa7sa7y lel donia id : 47
list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(183,$current_language_db_prefix);
?>

<div class="float_left third_row_widgets" style="width: 100%;height: 295px;">
	<!--Title Left-->
    <div class="inner_title_wrapper">
        <div class="sections_wrapper_margin">
        	<h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo $subsection_title; ?></h1>
        </div>
    </div>
    <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
    
    <?php
    for($i=0 ;$i<sizeof($display_edata); $i++):

		//$image_url = "https://www.mynestle.com.eg/images/Articles/";
		$image_url = base_url()."uploads/easy/";
		if(empty($display_edata))
		echo '<p style="padding:15px; text-align:center">لا يوجد مقالات في هذا القسم</p>';

		$id = $display_edata[$i]['easy_ideas_ID'];
		$title = $display_edata[$i]['easy_ideas_title'.$current_language_db_prefix];
		$short_title = $this->common->limit_text($title,40);
		$image  = $image_url.$display_edata[$i]['images_src'];
		$url = site_url($this->router->class."/easy_tips/".$id);
		$section_url = site_url($this->router->class."/easy_tips");
	?>
   <a href="<?php echo $url; ?>" title="<?php echo $title;?>"><img alt="<?php echo $title;?>" height="250" src="<?php echo $image; ?>" style="width:100%; border:none;" /></a>
    <div class="desc_wrapper global_background">
        <a href="<?php echo $url; ?>"><h3 style="margin: 0 8px;" class="float_left"><?php echo $short_title; ?></h3></a>
        
        <div class="float_right">
        	<div class="triangle <?php echo $current_section_borderbottom_color; ?>"></div>
        	<div class="plus_sign white_color"><a href="<?php echo $section_url; ?>">+</a></div>
        </div>
        <div class="clear"></div>
    
    </div><!-- Desc -->
    
    <?php
	endfor;
	?>

</div><!--End OF float_left-->



</div>