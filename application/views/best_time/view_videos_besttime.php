<!-- Jquery List Slider -->
<link href="<?php echo base_url(); ?>css/list_slider.css" rel="stylesheet" type="text/css">

<style>
.lists_of_videos { margin:0 26px; }
.lists_of_videos li { height:255px; padding:15px; background:white; margin:0; }
.image { position: relative; }
.image .play { position: absolute; width: 90px; height: 90px; top: 50%; left: 50%; margin-top: -45px; margin-left: -45px; }


.social_wrapper { padding:0; }
</style>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jssor.core.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jssor.utils.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jssor.slider.js"></script>

<script>
	jQuery(document).ready(function ($) {
		var options = {
			$AutoPlay: false,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
			$AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
			$AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
			$PauseOnHover: 0,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 3

			$ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
			$SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
			$MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
			//$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
			//$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
			$SlideSpacing: 5, 					                //[Optional] Space between each slide in pixels, default value is 0
			$DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
			$ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
			$UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, direction navigator container, thumbnail navigator container etc).
			$PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, default value is 1
			$DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

			$ThumbnailNavigatorOptions: {
				$Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
				$ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

				$AutoCenter: 3,                                 //[Optional] Auto center thumbnail items in the thumbnail navigator container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 3
				$Lanes: 1,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
				$SpacingX: 4,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
				$SpacingY: 4,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
				$DisplayPieces: 3,                              //[Optional] Number of pieces to display, default value is 1
				$ParkingPosition: 0,                            //[Optional] The offset position to park thumbnail
				$Orientation: 2,                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
				$DisableDrag: false                             //[Optional] Disable drag or not, default value is false
			}
		};

		var jssor_slider1 = new $JssorSlider$("slider1_container", options);
	});
</script>
<!-- Prettyphoto -->
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	$("a[rel^='prettyPhoto']").prettyPhoto(
	{
		social_tools : false,deeplinking:false, theme:"facebook",show_title:false
	});
});
</script>

<div class="clear"></div>

<?php echo $this->load->view('template/submenu_writer');   ?>

<?php echo $this->load->view('template/tree_menu_writer');   ?>

<div class="clear"></div>

<div class="inner_title_wrapper">
	<div class="sections_wrapper_margin">
    <h1 class="best_time_color float_left" style="font-size:25px;">إعلانات نستله</h1>
       </div>
    <div class="clear"></div>
    </div>
    <div class="thick_line <?php echo $current_section_background_color; ?>" style="margin:0;"></div>
    <div id="slider1_container" class="global_background" style="position: relative; top: 0px; left: 0px; width: 1000px;
        height: 550px; "> <?php /*?>background:url(<?php echo base_url()?>images/vegetables_bg.png) repeat<?php */?>

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(<?php echo base_url()?>img/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>
			
        <!-- Slides Container -->
        <div u="slides" style="cursor: pointer; position: absolute; left: 447px; top: 0px; width: 540px; height: 550px;overflow: hidden;">
            
            <?php
			$table_name_for_rate = "recipes_videos";
			
			for($i=0 ; $i < 6 ; $i ++):
			
			$id = "1";
			$title = "طريقة عمل بيكاتا بالمشروم والخضروات";
			$image = base_url()."img/photography/002.jpg";
			$views = "234";
			$url = base_url().$this->router->class."/".$this->router->method."/".$id;
			
			$url = "http://www.youtube.com/watch?v=3cccPTpdpW0";

			parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
			$thumb_image = $my_array_of_vars['v'];   

				
			$desc = "فوائدها وطرق  إستخدام عيش الغراب كيفة تخزينها لوقت طويلفوائدها وطرق  إستخدام عيش الغراب.كيفة تخزينها لوقت طويل";
			$desc_long_text = substr(strip_tags($desc), 0, 300). (strlen(strip_tags($desc)) > 300?'...':'');
			$desc_short_text =  substr(strip_tags($desc), 0, 130). (strlen(strip_tags($desc)) > 130?'...':'');
			?>
            
            <div>
            
            	<h2 class="big_image_slider_title dark_gray"><?php  echo $title;?></h2>
  
                <a href="<?php echo $url;?>" rel="prettyPhoto" title="<?php echo $title;?>">         
                <div class="image">
                <img class="play" src="<?php  echo base_url(); ?>images/videos_play.png" />
                <img src="http://img.youtube.com/vi/<?php echo $thumb_image;?>/0.jpg" width="524" alt="<?php echo $title;?>" />
                </div>
                </a>
                
                <p style="white-space: normal;"><?php echo $desc_long_text;?></p>

                <div class="rating_wrapper_container" style="width:210px;">

                   <div class="rating float_right" style="width: 90px; margin:5px 0">
                        <?php
                            $params = array('table'=>$table_name_for_rate,'foreign_id'=>$id);
                            echo $this->rate->get_recipe_rate($params); 
                        ?>
                        </div><!--End Of Rating-->
                    
                        <span style="line-height: 29px;font-size: 15px;" class="dark_gray float_left" >( <?php  echo $views;?> ) <?php  echo  lang('globals_views');?></span>
                        <div class="clear"></div>
                    </div><!--End Of .rating_wrapper_container-->
                
                    
				                                        
                <div u="thumb">
                    <img class="i" style="float:right" src="http://img.youtube.com/vi/<?php  echo $thumb_image;?>/0.jpg" alt="<?php echo $title;?>" />
                    <img class="i" style="float:right; width: 80px; height: 80px; top: 50%; left: 78%; margin-top: -40px; margin-left: -40px; border: none;" src="<?php echo base_url(); ?>images/videos_play.png"/>
                    <div class="left_side" style="float:left; width: 230px;">
                    	<h2 class="small_image_slider_title dark_gray"><?php  echo $title;?></h2>
                                                
                	<div class="rating_wrapper_container" style="width:150px; float:right;">

                   <div class="rating float_right" style="width: 90px; margin:5px 0">
                        <?php
                            $params = array('table'=>$table_name_for_rate,'foreign_id'=>$id);
                            echo $this->rate->get_recipe_rate($params); 
                        ?>
                        </div><!--End Of Rating-->
                    
                        <span style="line-height: 29px;font-size: 15px;" class="dark_gray float_left" >( <?php echo $views;?> )</span>
                        <div class="clear"></div>
                    </div><!--End Of .rating_wrapper_container-->
                    <div class="clear"></div>                          
					<p style="white-space: normal;"><?php echo $desc_short_text;?></p>
                    </div>
                    <div class="clear"></div>
                    
                </div>
            </div>
            
            
            <?php
			endfor;
			?>

        </div>
        <a href="<?php  echo site_url($this->router->class."/video_all");?>" class="readmore best_time_color float_right" style="position: relative;top: 490px;margin: 15px;">المزيد</a>
        
        <!-- ThumbnailNavigator Skin Begin -->
        <div u="thumbnavigator" class="jssort11" style="cursor: pointer;position: absolute; width: 435px; height: 475px; left:0px; top: 17px;">
            <!-- Thumbnail Item Skin Begin -->
            
            <div u="slides">
                <div u="prototype" class="list p" style="position: absolute; width: 435px; height: 141px; top: 0; left: 0; margin:7px 0; ">
                    <thumbnailtemplate style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0; "></thumbnailtemplate>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!-- ThumbnailNavigator Skin End -->
        
        
 </div><!-- End of inner_title_wrapper -->





 </div>



<div class="clear"></div>