<style>
.swiper-container-images, .swiper-container-images .swiper-slide {
    height: auto !important;
}
</style>

<section class="<?php echo $current_section; ?>">
    
        <?php
        echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png",site_url_mobile(''.$this->router->class));

        echo $this->mwidgets->drawCurrentSubSectionHomepageTitle($this->headers->get_third_title(),lang("globals_back"), "#");
		
		/*If The current section has children , Display Children*/
		if($current_section_have_children_flag):
			echo '<div class="section-seperator-margin">&nbsp;</div>';
			//echo '<div class="row">';
			$counterIndex = 0;
			//print_r($display_current_sections_children);
			for($i=0 ; $i<sizeof($display_current_sections_children); $i++){
			  if($display_current_sections_children[$i]['sub_sections_ID']==84 || $display_current_sections_children[$i]['sub_sections_ID']==71 || $display_current_sections_children[$i]['sub_sections_ID']==72){
				  $display_sections_children = $this->sectionsmodel->have_children($display_current_sections_children[$i]['sub_sections_ID'],"articles");
				  				  
				 for($j=0 ; $j<sizeof($display_sections_children); $j++)
				 {
					 list( $displayImage2, $total_rows_feat2)   = $this->articlesmodel->get_all_articles(1,0,$display_sections_children[$j]['sub_sections_ID'],true);
				     $linkToGenerate2 = site_url_mobile(''.$this->router->class.'/'. str_replace("%id%",$display_sections_children[$j]['sub_sections_ID'],$display_sections_children[$j]['sub_sections_url']) );
					 					 
					 echo '<div class="col-xs-6">';
					 echo $this->mwidgets->drawImageThenTitle($display_sections_children[$j]['sub_sections_name'.$current_language_db_prefix] , $this->config->item('articles_img_link').$displayImage2[0]['images_src'] ,$linkToGenerate2);
					 echo '</div>';	
					 
				 } 
				 
			  }
			  else
			  {
			  
				list( $displayImage, $total_rows_feat)   = $this->articlesmodel->get_all_articles(1,0,$display_current_sections_children[$i]['sub_sections_ID'],true);
				$linkToGenerate = site_url_mobile(''.$this->router->class.'/'. str_replace("%id%",$display_current_sections_children[$i]['sub_sections_ID'],$display_current_sections_children[$i]['sub_sections_url']) );
				
				echo '<div class="col-xs-6">';
				echo $this->mwidgets->drawImageThenTitle($display_current_sections_children[$i]['sub_sections_name'.$current_language_db_prefix] , $this->config->item('articles_img_link').$displayImage[0]['images_src'] ,$linkToGenerate);
				echo '</div>';
				
			}
			$counterIndex++;
			}
			//echo"</div>";
		endif;
		
		/*If The current section doesn't have children , Display Items*/
		if(!$current_section_have_children_flag):
		
			echo $this->mwidgets->drawFeatArticleImageAndText($display_data2[0]['articles_title'.$current_language_db_prefix], $this->config->item('articles_img_link').$display_data2[0]['images_src'] ,site_url_mobile(''.$this->router->class.'/inner_articles/'.$display_data2[0]['articles_ID']));				
			?>
            <div class="section-seperator-margin"></div>
            <?php
				//print_r($display_data);
			for ($i = 1; $i < sizeof($display_data2); $i++):
		   // print_r($display_data);
            echo $this->mwidgets->drawSingleItemImageAndText($display_data2[$i]['articles_title'.$current_language_db_prefix]
					,$display_data2[$i]['articles_brief'.$current_language_db_prefix]
                    , $this->config->item('articles_img_link').$display_data2[$i]['images_src']
					,site_url_mobile(''.$this->router->class.'/inner_articles/'.$display_data2[$i]['articles_ID']));
        	endfor;
		endif;

        
        ?>
        <div style="float:left; position:relative; margin: 10px 0px;" class="extra-thick-line background-color ">&nbsp;</div>
    

    <?php 
	if($display_other_sections):
	?>

        <div class="row">
            <div class="col-xs-12">
                <h2 class="text-color float_left" style="margin: 10px 0px;"><?php echo lang('know_more'); ?></h2>
            </div>            
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="swiper-container-images">
                    <div class="swiper-wrapper">
                        <?php
                        for ($i = 0; $i < sizeof($display_other_sections); $i++):
                            ?>
                            <div class="swiper-slide ">
                            <?php
								//Generate Link
								$linkToGenerate = site_url_mobile(''.$this->router->class.'/section/'.$display_other_sections[$i]['sub_sections_ID']   );
								//If Current Section have children, Get the section the first child and get its first article image
								$haveChildrenDisplay = NULL;
								$imageLink = "";
								$haveChildrenDisplay = $this->sectionsmodel->get_last_level_children($display_other_sections[$i]['sub_sections_ID'],"articles");
								if($haveChildrenDisplay)
								{
									{
										list( $displayImage, $total_rows_feat)   = $this->articlesmodel->get_all_articles(1,0,$haveChildrenDisplay[0]['sub_sections_ID'],true);
										$imageLink = $this->config->item('articles_img_link').$displayImage[0]['images_src'];
									}
								}
								else
								{
									list( $displayImage, $total_rows_feat)   = $this->articlesmodel->get_all_articles(1,0,$display_other_sections[$i]['sub_sections_ID'],true);
									$imageLink = $this->config->item('articles_img_link').$displayImage[0]['images_src'];
								}
								//If not, get the first article image 
								echo $this->mwidgets->drawImageThenTitle($display_other_sections[$i]['sub_sections_name'.$current_language_db_prefix] , $imageLink ,$linkToGenerate);
							?>
                            </div>
                            <?php
                        endfor;
                        ?>



                    </div><!-- swiper-wrapper -->                    
                </div><!-- swiper-container --> 
            </div>
        </div>            
 	<?php 
	endif;
	?>
    <?php
	//echo $common_row;
	?>


</section>