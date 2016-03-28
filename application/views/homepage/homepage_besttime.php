    <div id="best_time_line_seperator_homepage" class="thick_line best_time_background_color"></div>
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    
      <div class="sections_wrapper_margin" style="position:relative;">

			<div style="position: absolute;left: -180px;top: 178px; z-index:-9;" class="left_drawings_bestcook" ><img src="<?php echo base_url()."images/homepage/homepage_left_drawings_bestime".$current_language_db_prefix.".png"; ?>" /></div>
			<div style="position: absolute;right: -166px;top: -30px; z-index:-9;" class="left_drawings_bestcook" ><img src="<?php echo base_url()."images/homepage/homepage_right_drawings_bestime".$current_language_db_prefix.".png"; ?>" /></div>

     	<div class="large_box_width_1 home_widget float_left" >
            <?php
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(47,$current_language_db_prefix);
            $this->widgets->generate_homepage_featured_article($subsection_title,'best_time',$display_besttime_wakeup_for_life,'best_time_color','best_time_background_color','best_time_borderbottom_color',335,190,$current_language_db_prefix)
			// generate_homepage_recipes('title_name,array_of_data,current_section_color,current_section_background_color,current_section_borderbottom_color,current_image_width,current_image_height,current_language_db_prefix');
            ?>
     	</div>
        
        <div style="height:235px" class="float_left homesperator_width" ></div>
        
        <div class="large_box_width_1 home_widget float_left" >
            <?php
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(49,$current_language_db_prefix);
            $this->widgets->generate_homepage_featured_article($subsection_title,'best_time',$display_besttime_your_time,'best_time_color','best_time_background_color','best_time_borderbottom_color',335,190,$current_language_db_prefix)
			// generate_homepage_recipes('title_name,array_of_data,current_section_color,current_section_background_color,current_section_borderbottom_color,current_image_width,current_image_height,current_language_db_prefix');
            ?>
     	</div>
            
        <div style="width:270px; height:240px;" class="medium_long_width home_widget float_right">
        
        <?php
		list($personal_quiz_id,$personal_quiz_title,$personal_quiz_extra) = getSectiondata(186,$current_language_db_prefix);
		?>
        
        <div class="inner_title_wrapper">
        <div class="sections_wrapper_margin">
        	<h1 class="best_time_color"><?php echo $personal_quiz_title; ?></h1>
            </div>
        </div>
        <div class="thick_line best_time_background_color" ></div>
        
        <?php
        for($i=0;$i<sizeof($display_besttime_quiz);$i++):
		
		 if(empty($display_besttime_quiz))
		echo '<p style="padding:15px; text-align:center">'.lang('globals_No_articles_in_this_section').'</p>';
		
		$id = $display_besttime_quiz[$i]['quizes_ID'];
		$title = $display_besttime_quiz[$i]['quizes_title'.$current_language_db_prefix];
		$image_url = base_url()."uploads/quizes/";
		$image  = $image_url.$display_besttime_quiz[0]['images_src'];
	//	$url = site_url("best_time/quiz/".$id);
		$url = site_url("best_time/quiz/". generateSeotitle($id,$title));
		$section_url = site_url("best_time/quiz");
		$short_title = $this->common->limit_text($title,25);
		
		?>

        <a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><img style="border:none;" width="270" height="190" src="<?php echo $image; ?>" alt="<?php echo $title; ?>" /></a>

        <div class="desc_wrapper global_background" >
            <div style="margin: 0 8px;height: 40px;">
                <a href="<?php echo $url; ?>"><h3 class="float_left"><?php echo $short_title; ?></h3></a>
                <div class="float_right">
                    <div class="triangle best_time_borderbottom_color"></div>
                    <div class="plus_sign white_color"><a href="<?php echo $section_url; ?>">+</a></div>
                    <div class="clear"></div>
                </div>
            </div>
        </div><!-- .desc_wrapper -->
        
        <?php endfor; ?>
                            
            </div><!-- End of a5r el maqalat -->
            
            
            <div style="width:670px; height:5px; float:right">&nbsp; </div>
            <?php list($games_id,$games_title,$games_extra) = getSectiondata(50,$current_language_db_prefix); ?>
            
            <div class="float_left home_widget  " style="width:222px; height:186px">
                <!--Title Left-->
                <div class="inner_title_wrapper">
                    <div class="sections_wrapper_margin">
                        <h1 class="best_time_color"><?php echo $games_title; ?></h1>
                    </div>
                </div>
                <div class="thick_line best_time_background_color" ></div>
                
                <?php
                for($i=0 ;$i<sizeof($display_besttime_games); $i++):
            
                    //$image_url = "https://www.mynestle.com.eg/Images/Games/Memory/";
                    $image_url = base_url()."images/besttime/hompage_games_background.jpg";
                    if(empty($display_besttime_games))
                    echo '<p style="padding:15px; text-align:center">'.lang('globals_No_articles_in_this_section').'</p>';
            
                    $id = $display_besttime_games[$i]['games_ID'];
                    $section_id = $display_besttime_games[$i]['games_subsection_ID'];
                    $title = $display_besttime_games[$i]['games_name'.$current_language_db_prefix];
                    $image  = $image_url;//.$display_besttime_games[$i]['images_src'];
                    $url = site_url("best_time/games");
                    $section_url = site_url("best_time/games/");
                ?>
               <a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><img height="140" src="<?php echo $image; ?>" style="width:100%;border:none;" alt="<?php echo $title; ?>" /></a>
                <div class="desc_wrapper global_background" >
                    <a href="<?php echo $url; ?>"><h3 style="margin: 0 8px; height:40px;" class="float_left"><?php echo $title; ?></h3></a>
                    
                    <div class="float_right">
                        <div class="triangle best_time_borderbottom_color"></div>
                        <div class="plus_sign white_color"><a href="<?php echo $section_url; ?>">+</a></div>
                    </div>
                    <div class="clear"></div>
                
                </div><!-- Desc -->
                
                <?php
                endfor;
                ?>                  
            </div><!-- End of masr7iat wa aflam -->
            
            
            
            <div style="height:195px" class="float_left homesperator_width" ></div>
            <div class="small_box_width home_widget float_left" >
  			<?php
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(183,$current_language_db_prefix);
            //$this->widgets->generate_homepage_featured_article($subsection_title,'best_time',$display_besttime_easy_ideas,'best_time_color','best_time_background_color','best_time_borderbottom_color',220,140,$current_language_db_prefix)
            ?>
           <div class="inner_title_wrapper">
                <div class="sections_wrapper_margin">
                    <h1 class="best_time_color"><?php echo $subsection_title; ?></h1>
                </div>
            </div>
            <div class="thick_line best_time_background_color" ></div>    
            <?php
			for($i=0 ;$i<sizeof($display_edata); $i++):
		
				//$image_url = "https://www.mynestle.com.eg/images/Articles/";
				$image_url = base_url()."uploads/easy/";
				if(empty($display_edata))
				echo '<p style="padding:15px; text-align:center">لا يوجد مقالات في هذا القسم</p>';
		
				$id = $display_edata[$i]['easy_ideas_ID'];
				$title = $display_edata[$i]['easy_ideas_title'.$current_language_db_prefix];
				$short_title = $this->common->limit_text($title,20);
				$image  = $image_url.$display_edata[$i]['images_src'];
				$url = site_url("best_time/easy_tips/".$id);
				$section_url = site_url("best_time/easy_tips");
			?>
               <a href="<?php echo $url; ?>" title="<?php echo $title?>"><img height="140" src="<?php echo $image; ?>" style="width:100%; border:none;" alt="<?php echo $title; ?>" /></a>
                <div class="desc_wrapper global_background">
                    <a href="<?php echo $url; ?>"><h3 style="margin: 0 8px; height:40px" class="float_left"><?php echo $short_title; ?></h3></a>
                    
                    <div class="float_right">
                        <div class="triangle best_time_borderbottom_color"></div>
                        <div class="plus_sign white_color"><a href="<?php echo $section_url; ?>">+</a></div>
                    </div>
                    <div class="clear"></div>
                
                </div><!-- Desc -->
                
                <?php
                endfor;
                ?>
                    
            </div><!-- End of masr7iat wa aflam -->
            
            
            
            <div style="height:195px" class="float_left homesperator_width" ></div>
            
            <div class="small_box_width home_widget float_left" >
            <?php
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(184,$current_language_db_prefix);
            //$this->widgets->generate_homepage_featured_article($subsection_title,'best_time',$display_besttime_fashion,'best_time_color','best_time_background_color','best_time_borderbottom_color',220,140,$current_language_db_prefix)
            ?>
                       <div class="inner_title_wrapper">
                <div class="sections_wrapper_margin">
                    <h1 class="best_time_color"><?php echo $subsection_title; ?></h1>
                </div>
            </div>
            <div class="thick_line best_time_background_color" ></div>    
            <?php
                for($i=0 ;$i<sizeof($display_fdata); $i++):
            
                    //$image_url = "https://www.mynestle.com.eg/images/Articles/";
                    $image_url = base_url()."uploads/fashion/";
                    if(empty($display_fdata))
                    echo '<p style="padding:15px; text-align:center">لا يوجد مقالات في هذا القسم</p>';
            
                    $id = $display_fdata[$i]['fashion_ID'];
                    $title = $display_fdata[$i]['fashion_title'.$current_language_db_prefix];
					$short_title = $this->common->limit_text($title,20); 
                    $image  = $image_url.$display_fdata[$i]['images_src'];
                    $url = site_url("best_time/fashion/".$id);
                    $section_url = site_url("best_time/fashion");
                ?>
               <a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><img height="140" src="<?php echo $image; ?>" style="width:100%; border:none;" alt="<?php echo $title; ?>" /></a>
                <div class="desc_wrapper global_background">
                    <a href="<?php echo $url; ?>"><h3 style="margin: 0 8px; height:40px" class="float_left"><?php echo $short_title; ?></h3></a>
                    
                    <div class="float_right">
                        <div class="triangle best_time_borderbottom_color"></div>
                        <div class="plus_sign white_color"><a href="<?php echo $section_url; ?>">+</a></div>
                    </div>
                    <div class="clear"></div>
                
                </div><!-- Desc -->
                
                <?php
                endfor;
                ?>
            
            </div><!-- End of masr7iat wa aflam -->
            
            <div style="height: 184px;width: 8px;" class="float_left homesperator_width"></div>
            
            <div class="medium_box_width_2 home_widget float_left" >
                <?php
                list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(187,$current_language_db_prefix);
                $this->widgets->generate_homepage_featured_article($subsection_title,'best_time',$display_besttime_life_coach,'best_time_color','best_time_background_color','best_time_borderbottom_color',270,139,$current_language_db_prefix)
                // generate_homepage_recipes('title_name,array_of_data,current_section_color,current_section_background_color,current_section_borderbottom_color,current_image_width,current_image_height,current_language_db_prefix');
                ?>
            </div>
            
            <div class="global_sperator_height" style="width:100%"></div>

     <div class="clear"></div>
</div>
   
<div class="global_sperator_height" style="width:100%"></div>
