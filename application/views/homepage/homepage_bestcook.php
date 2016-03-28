<script type="text/javascript">
jQuery(function(){
	jQuery(".best_cook_homepage_applications_list").jCarouselLite({
		btnNext: ".best_cook_homepage_applications_list_next",
		btnPrev: ".best_cook_homepage_applications_list_prev",
		visible:2
	});
});
</script>
<style>
.best_cook_homepage_applications_list
{
	width:208px !important; 
	height:106px;
	margin:0 25px;
	padding:4px; 
}
#bestcook_homepgae_appliaction li
{
	overflow: hidden;
	float: left;
	width: 110px;
	height:110px;
}
#bestcook_homepgae_appliaction li a
{
	display: block;
	width: 100%;
	margin: 2px;
	padding: 2px;
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	cursor: pointer;
	border: 1px solid #B1B1B1;
	font-weight: bold;
	text-decoration: none;
	text-align: center;
	box-shadow: -2px 2px 4px #868686;
	width: 90px;
	height: 93px;
}
#bestcook_homepgae_appliaction li a:active
{
	box-shadow:none;
	position:relative;
	top:1px;
}
</style>

<div id="best_cook_line_seperator_homepage" class="thick_line best_cook_background_color"></div>
    
    <div class="global_sperator_height" style="width:100%"></div>

    <div class="sections_wrapper_margin" style="position:relative;">

		<div style="position: absolute;left: -166px;top: 50px; z-index:-9;" class="left_drawings_bestcook" ><img src="<?php echo base_url()."images/homepage/homepage_left_drawings_bestcook".$current_language_db_prefix.".png"; ?>" /></div>
		<div style="position: absolute;right: -166px;top: -45px; z-index:-9;" class="left_drawings_bestcook" ><img src="<?php echo base_url()."images/homepage/homepage_right_drawings_bestcook".$current_language_db_prefix.".png"; ?>" /></div>

        <div class="float_left" style="width:420px;height:430px;">
        <?php
        $this->widgets->generate_homepage_recipes(lang('bestcook_newest_recipes'),'recipes',$display_bestcook_last_recipes,'best_cook_color','best_cook_background_color','best_cook_borderbottom_color',420,385,$current_language_db_prefix);
        ?>
        </div><!--End OF float_left  End of col1 -->
    
   <div style="height:430px" class="float_left homesperator_width" ></div>
    
        <div style="width:255px; height:430px;" class="float_left" >
            <div class="medium_box_width home_widget" >
            
            <?php
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(131,$current_language_db_prefix);
            $this->widgets->generate_homepage_recipes($subsection_title,'inseason_recipies',$display_bestcook_members_inseason_recipes,'best_cook_color','best_cook_background_color','best_cook_borderbottom_color',255,165,$current_language_db_prefix);
            ?>
            </div>
            
        <div style="width:235px; height:10px" ></div>
        	
        <div class="medium_box_width home_widget">
            <?php
            $this->widgets->generate_homepage_most_read_recipes(lang('bestcook_most_read_recipes'),$display_bestcook_most_read_recipes,'best_cook_color','best_cook_background_color','best_cook_borderbottom_color',255,166,$current_language_db_prefix);
            ?>
        </div>
        </div><!-- End of col # 2 -->
    
	<div style="height:430px" class=" homesperator_width float_left" ></div>
    <div style="width:265px; height:430px;" class="float_left">
    
   <div style="width:265px; height:265px; position:relative;">

   <div class="inner_title_wrapper">
   
        <div class="sections_wrapper_margin">
        <?php
			list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(7,$current_language_db_prefix);
		?>
        	<h1 class="best_cook_color" style="font-size:20px;"><?php echo $subsection_title;?></h1>
        </div>
    </div>
	<div class="thick_line best_cook_background_color" ></div>
    <?php

        for($i=0;$i<sizeof($display_featured_video);$i++):
        
        $title = $display_featured_video[0]['videos_name'];
        $youtube_url = $display_featured_video[0]['videos_url'];
		if($current_language_db_prefix == "_ar")
		{
			$short_title = $this->common->limit_text($title,30);
		}
		else
		{
			$short_title = $this->common->limit_text($title,30);
		}
    
    ?>
        <div class="image">
            <a title="<?php echo $title; ?>" href="https://www.youtube.com/embed/<?php echo $this->common->youtube($youtube_url); ?>" class="various fancybox.iframe">
                <img class="app" style="width: 265px;height: 180px;margin-top: 0px; border:none;" src="https://img.youtube.com/vi/<?php echo $this->common->youtube($youtube_url); ?>/mqdefault.jpg" />
            </a>
        </div>
        <a title="<?php echo $title; ?>" href="https://www.youtube.com/embed/<?php echo $this->common->youtube($youtube_url); ?>" class="various fancybox.iframe">
            <img style="border:none;" class="video_paly" src="<?php echo base_url()."images/video_player.png" ?>" />
        </a>
        
        <div class="description " style="-webkit-border-bottom-right-radius: 15px;-webkit-border-bottom-left-radius: 15px;-moz-border-radius-bottomright: 15px;-moz-border-radius-bottomleft: 15px;border-bottom-right-radius: 15px;border-bottom-left-radius: 15px;bottom: -3px;
        width: 92.2%;background: #FFF;background: rgba(255,255,255,0.60);position: absolute;bottom: 0px;left: 0px;z-index: 999;padding: 3% 4%;color: #FFF;min-height: 35px;">
                <h4 class="float_left dir" style="line-height: 35px;"><b><a href="https://www.youtube.com/embed/<?php echo $this->common->youtube($youtube_url); ?>" class="various fancybox.iframe dark_gray" ><?php echo $short_title; ?></a></b></h4>
                <div class="clear"></div>
        </div>
    <?php endfor;?>
       

    </div>
    
    <div style="width:265px; height:10px" ></div>
    
    <div class="widgets_featured_application">
        <!--Title Left-->
        <div class="inner_title_wrapper">
            <div class="sections_wrapper_margin">
            <?php
			list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(132,$current_language_db_prefix);
			?>
                <h1 class="best_cook_color"><?php echo $subsection_title;?></h1>
            </div>
        </div>
        <div class="thick_line best_cook_background_color" ></div>
        <div style="position:relative;" class="application_sildeshow_container global_background">
            <a style="position: absolute;right: 0px;top: 40px;margin: 0 5px;" class="best_cook_homepage_applications_list_next"><img width="11" height="12" src="<?php echo base_url()."images/bestcook/right_arrow_medium.png" ?>" /></a>
            <a style="position: absolute;left: 0px;top: 40px;margin: 0 5px;" class="best_cook_homepage_applications_list_prev"><img width="11" height="12" src="<?php echo base_url()."images/bestcook/left_arrow_medium.png" ?>" /></a>

            <div class="best_cook_homepage_applications_list">
            <ul id="bestcook_homepgae_appliaction">
               <?php
				for($i=0 ; $i < sizeof($display_bestcook_applications) ; $i++):
				
				$id = $display_bestcook_applications[$i]['applications_ID'];
				$title = $display_bestcook_applications[$i]['applications_title'.$current_language_db_prefix];
				$logo =  base_url()."uploads/applications/".$this->globalmodel->get_image_src($display_bestcook_applications[$i]['applications_homepage']);
				?>
					<li >
					<a href="<?php echo site_url('best_cook/applications/'.$id)?>" title="<?php echo $title;?>">
					<div class="image_application" align="center"><div style="width:55px; height:55px; background:url(<?php echo $logo; ?>);background-repeat:no-repeat;"></div></div>
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

    </div><!-- End of col # 3 -->

    <div class="clear"></div>
    
    <div class="global_sperator_height" style="width:100%"></div>

</div><!--End oF best_cook_line_seperator_homepage-->