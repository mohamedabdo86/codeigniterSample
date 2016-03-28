<link href="<?php echo base_url(); ?>css/besttime_homepage.css" rel="stylesheet">

<script>
jQuery(function(){
	
	jQuery(".recent_items_list").jCarouselLite({
		btnNext: ".recentitem_prev",
		btnPrev: ".recentitem_next",
		visible:3
	});
	
	jQuery(".best_time_inner_games_list").jCarouselLite({
		btnNext: ".best_time_inner_games_list_prev",
		btnPrev: ".best_time_inner_games_list_next",
		visible:2
	});

});
</script>
<div class="clear"></div>
 
<?php $this->load->view('template/submenu_writer');   ?>

<?php $this->load->view('template/tree_menu_writer');   ?>

<div id="innerhome_slideshow" class="<?php echo $current_section_background_color; ?> <?php echo $current_section_border_color; ?>">


<div class="slide_show_title_sign float_left">

<div class="inner_margin_wrapper">
<div style="margin:30px 0px;">
<div align="center"><img src="<?php echo base_url(); ?>images/besttime/besttime_inner_slideshow_logo.png"  /></div>
<div align="center"><h2 class="white_color"><?php echo  lang("globals_besttime"); ?></h2></div>
</div>


</div><!-- End of inner_margin_wrapper -->


</div><!-- End of slide_show_title_sign -->

<!-- Display Section Slideshow -->
<?php $this->load->view('template/view_section_slideshow');   ?>


<div class="clear"></div>
</div><!-- End of innerhome_slideshow -->

<div class="clear"></div>

<div class="global_sperator_height" style="width:100%"></div>

<div id="first_row" style="height:405px;">
<?php
//Get Data for Sa7sa7y lel donia
//Sa7sa7y lel donia id : 47
list($sa7sa7y_lel_donia_id,$sa7sa7y_lel_donia_title,$sa7sa7y_lel_donia_extra) = getSectiondata(47,$current_language_db_prefix);
?>
<div class="float_left" style="width:49.5%;height:400px;">
	<!--Title Left-->
    <div class="inner_title_wrapper">
        <div class="sections_wrapper_margin">
        	<h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo $sa7sa7y_lel_donia_title; ?></h1>
        </div>
    </div>
    <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
    
    <?php
    for($i=0 ;$i<sizeof($display_feautre_wake_up_for_life); $i++):

		$image_url = $this->config->item('articles_img_link');
		if(empty($display_feautre_wake_up_for_life))
		echo '<p style="padding:15px; text-align:center">لا يوجد مقالات في هذا القسم</p>';

		$id = $display_feautre_wake_up_for_life[$i]['articles_ID'];
		$section_id = $display_feautre_wake_up_for_life[$i]['articles_sections_ID'];
		$title = $display_feautre_wake_up_for_life[$i]['articles_title'.$current_language_db_prefix];
		$image  = $image_url.$display_feautre_wake_up_for_life[$i]['images_src'];
		$url = site_url($this->router->class."/inner_articles/".generateSeotitle($id,$title));
		$section_url = site_url($this->router->class."/section/".$section_id);
	?>
   <a href="<?php echo $url; ?>" title="<?php  echo $title?>"><img height="360" alt="<?php echo $title?>" src="<?php echo $image; ?>" style="width:100%; border:none" /></a>
    <div class="desc_wrapper global_background">
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

</div><!--End OF float_left-->
<?php
list($personal_quiz_id,$personal_quiz_title,$personal_quiz_extra) = getSectiondata(186,$current_language_db_prefix);
?>
<div class="float_right" style="width:49.5%;height:400px;">

	 <div class="inner_title_wrapper">
        <div class="sections_wrapper_margin">
        	<h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo $personal_quiz_title; ?></h1>
        </div>
    </div>
    <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
    
    <?php
        for($i=0;$i<sizeof($display_besttime_quiz);$i++):
		
		 if(empty($display_besttime_quiz))
		echo '<p style="padding:15px; text-align:center">لا يوجد مقالات في هذا القسم</p>';
		
		$id = $display_besttime_quiz[$i]['quizes_ID'];
		$title = $display_besttime_quiz[$i]['quizes_title'.$current_language_db_prefix];
		$image_url = base_url()."uploads/quizes/";
		$image  = $image_url.$display_besttime_quiz[0]['images_src'];
		$url = site_url("best_time/quiz/".$id);
		$section_url = site_url("best_time/quiz");
		
		?>
        <div style="position:relative; height:360px;" >
            <a href="<?php echo $url; ?>" title="<?php echo $title?>"><img  alt="<?php echo $title?>" style="border:none" width="495" height="360" src="<?php echo $image?>" /></a>
            <div class="desc_wrapper global_background">
                <a href="<?php echo $url; ?>"><h3 style="margin: 0 8px;" class="float_left"><?php echo $title; ?></h3></a>
                
                <div class="float_right">
                    <div class="triangle <?php echo $current_section_borderbottom_color; ?>"></div>
                    <div class="plus_sign white_color"><a href="<?php echo $section_url; ?>">+</a></div>
                </div>
                <div class="clear"></div>
            
            </div><!-- Desc -->
        </div>
        <?php endfor; ?>
    
    <div class="global_sperator_height" style="width:100%"></div>

</div><!--End OF float_right-->


<div class="clear"></div>
</div><!--end of first_row-->

<div class="clear"></div>

<div class="global_sperator_height" style="width:100%"></div>

 <div id="second_row" style="height:405px;">
        <div class="float_left" style="width:49.5%;height:405px;">
                                  
            <?php
                //Get Data Your Time
                list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(49,$current_language_db_prefix);
                $this->widgets->generate_featured_article($subsection_title,$display_feautre_your_time,$current_section_color,$current_section_background_color,$current_section_borderbottom_color,$current_language_db_prefix);
             ?>
  
        </div><!--End OF float_left-->
    
        <div class="float_right" style="width:49.5%;height:405px;">
                     <?php
                //Get Data Fashion and beauty
                list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(184,$current_language_db_prefix);
                //$this->widgets->generate_featured_article($subsection_title,$display_feautre_fitness,$current_section_color,$current_section_background_color,$current_section_borderbottom_color,$current_language_db_prefix);
                ?>
                <div class="inner_title_wrapper">
                    <div class="sections_wrapper_margin">
                        <h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo $subsection_title; ?></h1>
                    </div>
                </div>
                <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
                
                <?php
                for($i=0 ;$i<sizeof($display_fdata); $i++):
            
                    //$image_url = "https://www.mynestle.com.eg/images/Articles/";
                    $image_url = base_url()."uploads/fashion/";
                    if(empty($display_fdata))
                    echo '<p style="padding:15px; text-align:center">لا يوجد مقالات في هذا القسم</p>';
            
                    $id = $display_fdata[$i]['fashion_ID'];
                    $title = $display_fdata[$i]['fashion_title'.$current_language_db_prefix];

					$short_title = $this->common->limit_text($title,65);
                    
                    $image  = $image_url.$display_fdata[$i]['images_src'];
                    $url = site_url($this->router->class."/fashion/".$id);
                    $section_url = site_url($this->router->class."/fashion");
                ?>
               <a href="<?php echo $url; ?>" title="<?php  echo $title; ?>"><img alt="<?php  echo $title; ?>" height="360" src="<?php echo $image; ?>" style="width:100%;border:none;" /></a>
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

        </div><!--End OF float_right-->
        
        <div class="clear"></div>
        
    </div><!--end of Second_row-->

<div class="global_sperator_height" style="width:100%"></div>

<?php $this->load->view('best_time/homepage/view_third_row');   ?>