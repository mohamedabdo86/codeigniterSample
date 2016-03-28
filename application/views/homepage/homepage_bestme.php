<script type="text/javascript">
var index_positions = 0;
$(function() {
	
    $(".best_me_homepage_applications_list").jCarouselLite({
        btnNext: ".best_me_homepage_applications_list_next",
        btnPrev: ".best_me_homepage_applications_list_prev",
		visible: 2,
		//circular: false,
    });
		
});
</script>
<style>
#bestme_homepgae_appliaction li
{
	overflow: hidden;
	float: left;
	width: 109px;
	height: 130px;
}
#bestme_homepgae_appliaction li a
{
	display: block;
	width: 100%;
	margin: 3px;
	padding: 3px;
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	cursor: pointer;
	background-color:#fff;
	border: 1px solid #658e15;
	font-weight: bold;
	text-decoration: none;
	text-align: center;
	box-shadow: -2px 2px 4px #2B2A2A;
	width: 90px;
	height: 115px;
}
#bestme_homepgae_appliaction li a:active
{
	box-shadow:none;
	position:relative;
	top:1px;
}
</style>
   <div id="best_me_line_seperator_homepage" class="thick_line best_me_background_color"></div>
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    
    <div class="sections_wrapper_margin" style="position:relative;">

		<div style="position: absolute;left: -180px;top: 247px; z-index:-9;" class="left_drawings_bestcook" ><img src="<?php echo base_url()."images/homepage/homepage_left_drawings_bestme".$current_language_db_prefix.".png"; ?>" /></div>
		<div style="position: absolute;right: -176px;top: -30px; z-index:-9;" class="left_drawings_bestcook" ><img src="<?php echo base_url()."images/homepage/homepage_right_drawings_bestme".$current_language_db_prefix.".png"; ?>" /></div>

    	<div class="large_box_width_1 home_widget float_left" >
            <?php
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(15,$current_language_db_prefix);
            $this->widgets->generate_homepage_featured_article($subsection_title,'best_me',$display_bestme_food,'best_me_color','best_me_background_color','best_me_borderbottom_color',335,190,$current_language_db_prefix)
			// generate_homepage_recipes('title_name,array_of_data,current_section_color,current_section_background_color,current_section_borderbottom_color,current_image_width,current_image_height,current_language_db_prefix');
            ?>
     	</div>
        
        <div style="height:238px" class="float_left homesperator_width" ></div>
        
        <div class="large_box_width_1 home_widget float_left" >
            <?php
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(14,$current_language_db_prefix);
            $this->widgets->generate_homepage_featured_article($subsection_title,'best_me',$display_bestme_fitness,'best_me_color','best_me_background_color','best_me_borderbottom_color',335,190,$current_language_db_prefix)
			// generate_homepage_recipes('title_name,array_of_data,current_section_color,current_section_background_color,current_section_borderbottom_color,current_image_width,current_image_height,current_language_db_prefix');
            ?>
     	</div>
        
        <div style="height:238px" class="float_left homesperator_width" ></div>
        
         <div style="width:270px; height:230px; " class="float_left home_widget global_background">
                <!--Title Left-->
        <div class="widgets_featured_application">
                 <!--Title Left-->
                <div class="inner_title_wrapper">
                    <div class="sections_wrapper_margin">
                    <?php
					list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(130,$current_language_db_prefix);
					?>
                        <h1 class="best_me_color" style="font-size:20px;"><?php echo $subsection_title;?></h1>
                    </div>
                </div>
                <div class="thick_line best_me_background_color" ></div>
                        
            	<div style="position:relative;" class="application_sildeshow_container best_me_background_color">
                    <a style="position: absolute;right: 0px;top: 80px;margin: 0 5px;" class="best_me_homepage_applications_list_next"><img src="<?php echo base_url()."images/white_right_arrow.png" ?>" /></a>
                    <a style="position: absolute;left: 0px;top: 80px;margin: 0 5px;" class="best_me_homepage_applications_list_prev"><img src="<?php echo base_url()."images/white_left_arrow.png" ?>" /></a>
                
                    <div class="best_me_homepage_applications_list" style="height: 165px;margin: 0px 30px;padding-top: 25px;">
                    <ul id="bestme_homepgae_appliaction">
                       <?php
                        for($i=0 ; $i < sizeof($display_bestme_applications) ; $i++):
                        
                        $id = $display_bestme_applications[$i]['applications_ID'];
                        $title = $display_bestme_applications[$i]['applications_title'.$current_language_db_prefix];
                        $logo =  base_url()."uploads/applications/".$this->globalmodel->get_image_src($display_bestme_applications[$i]['applications_homepage']);
    						?>
                            <li>
                            <a href="<?php echo site_url('best_me/applications/'.$id)?>" title="<?php echo $title;?>">
                                <div class="image_application" align="center"><div style="width: 75px;height: 85px; background:url(<?php echo $logo; ?>);background-repeat:no-repeat;"></div></div>
                                <div class="homepage_application_title gray_color"><?php echo $title; ?></div>
                            <div class="clear"></div>
                            </a>
                            </li>
                        <?php
                        endfor;
                        ?>
                    </ul>
                    </div>
                </div><!--End OF application_sildeshow_container-->
            </div>
        </div><!-- End of applications -->
        
        
        <div class="clear"></div>
    
    <div style="width:100%; height:5px;"></div>
    
  	 <div class="large_box_width_1 home_widget float_left" >
     		 <?php
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(13,$current_language_db_prefix);
            $this->widgets->generate_homepage_featured_article($subsection_title,'best_me',$display_bestme_family_life,'best_me_color','best_me_background_color','best_me_borderbottom_color',335,190,$current_language_db_prefix)
			// generate_homepage_recipes('title_name,array_of_data,current_section_color,current_section_background_color,current_section_borderbottom_color,current_image_width,current_image_height,current_language_db_prefix');
            ?>
     	</div><!-- End of ghaza2ik -->
        
        <div style="height:238px" class="float_left homesperator_width" ></div>
        
        <div class="large_box_width_1 home_widget float_left" >
          <?php
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(16,$current_language_db_prefix);
            $this->widgets->generate_homepage_featured_article($subsection_title,'best_me',$display_bestme_beauty,'best_me_color','best_me_background_color','best_me_borderbottom_color',335,190,$current_language_db_prefix)
			// generate_homepage_recipes('title_name,array_of_data,current_section_color,current_section_background_color,current_section_borderbottom_color,current_image_width,current_image_height,current_language_db_prefix');
            ?>
		</div><!-- End of gamalik -->
    
    <div style="height:238px" class="float_left homesperator_width" ></div>
    
    <div style="width:270px; height:234px; " class="float_left home_widget">
    
    	<?php
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(181,$current_language_db_prefix);
		$this->widgets->generate_homepage_ask_expert($subsection_title,'best_me',$display_bestme_expert,'best_me_color','best_me_background_color','best_me_borderbottom_color',270,190,$current_language_db_prefix);
		?>
       </div><!-- End of es2aly el 5abir -->
     
    <div class="clear"></div>
    </div>
    
<div class="global_sperator_height" style="width:100%"></div>
