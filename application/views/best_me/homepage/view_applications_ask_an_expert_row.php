<script>
jQuery(document).ready(function(e) {
	
	jQuery(".best_cook_inner_applications_list").jCarouselLite({
			btnNext: ".best_cook_inner_applications_list_prev",
			btnPrev: ".best_cook_inner_applications_list_next",
			visible:3
		});
});
</script>
<script>
$(document).ready(function(e) {
	$('.application_slider').bxSlider({
  		pause: 10000,
		speed: 300,
		auto: true,
  		autoControls: false,
		nextText : '',
		prevText : '',
		pager: false,
	});
});
</script>
<style>
#application_slider_container .bx-controls .bx-controls-direction{
	display:block !important;
}
#application_slider_container{
	width: 320px;
	height: 250px;
	position: absolute;
	overflow:hidden;
	-webkit-border-bottom-right-radius: 20px;
	-webkit-border-bottom-left-radius: 20px;
	-moz-border-radius-bottomright: 20px;
	-moz-border-radius-bottomleft: 20px;
	border-bottom-right-radius: 20px;
	border-bottom-left-radius: 20px;
}
.center{margin-left:20px;}
.rightword{color:#E82327;font-size:15pt;}
.leftword{color:#828282;font-size:10pt;}
.imgs{list-style:none;margin-right:20px;}
.imgs li{float:right;margin:34px; height:380px;position:relative; border-width:1px; border-style:solid;}
.circle
{ 
	position: absolute;
	right: 106px;
	bottom: 47px;
	width: 34%;
	height: 24%;
	border-radius: 328% / 572%;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
	border: #FFF 3px dashed;
	border-bottom: none;
} 
/*.cook_tool
{
	margin: 1px 28px;
	width: 44px;
	height: 47px;
}*/
.cook_tool
{
margin: 12px 28px;
width: 55px;
height: 55px;
}
			
.par_words{ color:#FFF;font-family:[GESSTwoLight];
				font-size:10pt;
				text-align:center;
				margin:0px;
			 	white-space:normal;
				}


.bx-wrapper .bx-prev {left: 0px; background: url(../../images/homepage/left_arrow.png) no-repeat;}

.bx-wrapper .bx-next{right: -1px;background: url(../../images/homepage/right_arrow.png) no-repeat;}

.inner_applications_bestcook_width .image img.app {
-webkit-border-bottom-right-radius: 15px;
-webkit-border-bottom-left-radius: 15px;
-moz-border-radius-bottomright: 15px;
-moz-border-radius-bottomleft: 15px;
border-bottom-right-radius: 15px;
border-bottom-left-radius: 15px;
-webkit-border-top-right-radius: 0px;
-webkit-border-top-left-radius: 0px;
-moz-border-radius-topright: 0px;
-moz-border-radius-topleft: 0px;
border-top-right-radius: 0px;
border-top-left-radius: 0px;
}
.best_cook_inner_applications_list_next 
{
	position: absolute;
	left: 288px;
}
</style>
<script type="text/javascript">
$(document).ready(function(e) {

	$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});
</script>
<div class="clear"></div>

<div  class="float_left home_widget inner_applications_bestcook_width " >
    <div class="inner_title_wrapper">
        <div class="sections_wrapper_margin">
            <?php
                //Get Data form grow up 
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(130,$current_language_db_prefix);
             ?>
        <h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo $subsection_title;?></h1>
        </div>
    </div>
	<div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
       
        <div id="application_slider_container">
        <ul class="application_slider">
        <?php
        for($i=0 ; $i < sizeof($display_applications) ; $i++):
		
		$id = $display_applications[$i]['applications_ID'];
		$title = $display_applications[$i]['applications_title'.$current_language_db_prefix];
		$image =  base_url()."uploads/applications/".$display_applications[$i]['images_src'];
		$logo =  base_url()."uploads/applications/".$this->globalmodel->get_image_src($display_applications[$i]['applications_logo']);
        ?>
        
            <li>
            <a href="<?php echo site_url($this->router->fetch_class().'/applications/'.$id)?>">
            <img src="<?php echo $image ?>" />
            <div class="circle <?php echo $current_section_background_color ?>"> 
          			<div class="cook_tool" style="background:url('<?php echo $logo; ?>') 0 0;"></div>
           
           			<?php /*?><div class="cook_words">
           				<p class="par_words"><?php echo $title; ?></p>
          			</div><?php */?>
          	 	</div>
            <div class="clear"></div>
            </a>
            </li>
            
		 <?php
        endfor;
        ?>              
                      
        </ul>
    
  
            
</div>
      
</div><!-- ENd of inner_applications_bestcook_width -->


<div class="float_left" style="width:20px; height:300px;"></div>


<?php $this->widgets->generate_ask_an_expert(181,$current_section_color,$current_section_border_color,$current_section_background_color,$display_ask_an_expert,$display_expert,$current_language_db_prefix);   ?>

<div class="float_left "  style="width:20px; height:300px;" ></div>

<div class="float_left home_widget inner_applications_bestcook_width" >
	<div class="inner_title_wrapper">
        <div class="sections_wrapper_margin">
        	<h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo lang('globals_nestle_videos');?></h1>
        </div>
    </div>
	<div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
    

<?php

function youtube_v_extractor($url)
{
  parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
  return $my_array_of_vars['v'];
}

	for($i=0;$i<sizeof($display_featured_video);$i++):
	
	$title = $display_featured_video[0]['videos_name'];
	$youtube_url = $display_featured_video[0]['videos_url'];
	$short_title = mb_substr(strip_tags($title), 0, 35 , "utf-8"). (strlen(strip_tags($title)) >35?'...':'');

?>
    <div class="image">
    	<a title="<?php echo $title; ?>" href="https://www.youtube.com/embed/<?php echo youtube_v_extractor($youtube_url); ?>" class="various fancybox.iframe">
        	<img class="app" style="border:none; height: 254px; margin-top: 44px;" src="http://img.youtube.com/vi/<?php echo youtube_v_extractor($youtube_url); ?>/mqdefault.jpg" />
   		</a>
    </div>
    <a title="<?php echo $title; ?>" href="https://www.youtube.com/embed/<?php echo youtube_v_extractor($youtube_url); ?>" class="various fancybox.iframe">
    	<img style="border:none" class="video_paly" src="<?php echo base_url()."images/video_player.png" ?>" />
	</a>
    
    <div class="description " style="-webkit-border-bottom-right-radius: 15px;-webkit-border-bottom-left-radius: 15px;-moz-border-radius-bottomright: 15px;-moz-border-radius-bottomleft: 15px;border-bottom-right-radius: 15px;border-bottom-left-radius: 15px;bottom: -3px;">
            <h4 class="float_left dir" style="line-height: 35px;"><b><a href="http://www.youtube.com/embed/<?php echo youtube_v_extractor($youtube_url); ?>" class="various fancybox.iframe dark_gray" ><?php echo $short_title; ?></a></b></h4>
            <div class="clear"></div>
	</div>
<?php endfor;?>

</div><!-- End of  videos -->
