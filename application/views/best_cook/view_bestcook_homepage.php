<script type="text/javascript" src="http://malsup.github.io/jquery.cycle.all.js"></script>
<script>

		jQuery(function(){
			
			<?php
			if($current_language_db_prefix == "_ar")
			{
			?>
			jQuery(".recent_items_list").jCarouselLite({
				btnNext: ".recentitem_next",
				btnPrev: ".recentitem_prev",
				visible:3,
				circular: true,
				 
			});
			

			<?php
			}
			else
			{
			?>
			jQuery(".recent_items_list").jCarouselLite({
				btnNext: ".recentitem_prev",
				btnPrev: ".recentitem_next",
				visible:3,
				circular: true,
				 
			});
			

			<?php
			}
			?>
			
			jQuery(".best_cook_inner_applications_list").jCarouselLite({
				btnNext: ".best_cook_inner_applications_list_prev",
				btnPrev: ".best_cook_inner_applications_list_next",
				visible:2
			});
			

		});
		
	</script>
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
.cook_tool
{
margin: 12px 28px;
width: 55px;
height: 55px;
}
			
.par_words
{ 
color:#FFF;font-family:[GESSTwoLight];
font-size:10pt;
text-align:center;
margin:0px;
white-space:normal;
}


.bx-wrapper .bx-prev {left: 0px; background: url(../../images/homepage/left_arrow.png) no-repeat;}

.bx-wrapper .bx-next{right: -1px;background: url(../../images/homepage/right_arrow.png) no-repeat;}


.inner_applications_bestcook_width .image img.app
{
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

</style>

<div class="clear"></div>
 
<?php $this->load->view('template/submenu_writer');   ?>

<?php $this->load->view('template/tree_menu_writer');   ?>


<div id="innerhome_slideshow" class="best_cook_background_color best_cook_border_color">


<div class="slide_show_title_sign float_left">

<div class="inner_margin_wrapper">
<div style="margin:30px 0px;">
<div align="center"><img src="<?php echo base_url(); ?>images/bestcook/bestcook_inner_slideshow_logo.png" alt="best cook logo" /></div>
<div align="center"><h2 class="white_color"><?php echo  lang("globals_bestcook"); ?></h2></div>
</div>


</div><!-- End of inner_margin_wrapper -->


</div><!-- End of slide_show_title_sign -->

<!-- Display Section Slideshow -->
<?php $this->load->view('template/view_section_slideshow');   ?>

<div class="clear"></div>
</div><!-- End of innerhome_slideshow -->

<div class="clear"></div>


<!--row أخر الوصفات-->
<?php
$this->load->view('best_cook/homepage_widgets/view_topics_widget'); 
?>

<div class="global_sperator_height" style="width:100%"></div>

<!--row search-->
	<?php
    $this->load->view('best_cook/advanced_search_block'); 
    ?>


<div class="global_sperator_height" style="width:100%"></div>


<!-- Tips-->
<div class="float_left" style="width:495px;height:465px;">

<!--Row وصفات الموسم -->
 <?php
$this->load->view('best_cook/homepage_widgets/view_inseason_widget'); 
?>

</div>

<div class="float_right" style="width:495px; height:465px;">

<!-- Start of recent Articles -->

<div class="inner_title_wrapper height_40">
    <div class="sections_wrapper_margin">
    <h1 class="best_cook_color" style="font-size:20px;"><?php echo lang("bestcook_recent_articles"); ?></h1>
    </div>
</div>
<div class="thick_line best_cook_background_color"  style="margin-bottom:5px;"></div>

<div class="lists_wrapper" style="height:413px; position:relative;" >

	<div>

        <ul class="list_of_title_image_vertical" >
        <?php
        for($i = 0 ; $i < sizeof($display_recent_articles) ; $i++):
		$url  = site_url('best_cook/inner_articles/'.generateSeotitle($display_recent_articles[$i]['articles_ID'] , $display_recent_articles[$i]['articles_title'.$current_language_db_prefix])  );
		$title = $display_recent_articles[$i]['articles_title'.$current_language_db_prefix];
		$image = $this->config->item('articles_img_link').$this->config->item('image_prefix').$display_recent_articles[$i]['images_src'];
		$desc = $display_recent_articles[$i]['articles_brief'.$current_language_db_prefix];
		$views = $display_recent_articles[$i]['articles_views'];
		if($current_language_db_prefix == "_ar")
		{
			$short_title = $this->common->limit_text($title, 80);
			$brief = $this->common->limit_text($title, 120);
		}
		else
		{
			$short_title = $this->common->limit_text($title, 70);
			$brief = $this->common->limit_text($title, 85);
		}

		?>
        <li style="margin:0 0 4px 0;width: 98%;padding: 5px;" class="global_background">
            <div class="image float_left"><a href="<?php echo $url ?>" title="<?php echo $title?>"><img src="<?php echo $image; ?>" alt="$<?php echo $title?>"/></a></div>
            <div style="width:5px; height:85px;" class="float_left"></div>
            <div class="title float_left" style="width:375px">
                <h3><a href="<?php echo $url ?>"><?php echo $short_title; ?></a></h3>
                <p style="line-height: 17px;font-size: 12px;font-weight: normal; white-space:normal;margin: 5px 0;"><?php echo $brief;?></p>
                <span style="line-height: 21px;font-size: 12px;" class="dark_gray float_left" ><?php echo lang('globals_views')." ( ".$views." ) ";?></span>
                <div class="clear"></div>
            </div>
            
            <div class="float_right"><a class="best_cook_color" href="<?php echo $url ?>" ><?php echo lang("globals_more"); ?></a></div>
            <div class="clear"></div>
        </li>
        <?php
        endfor;
        ?>
        </ul>
      </div>
    
</div><!-- End of lists_wrapper-->

<!-- End of recent Articles -->

</div><!-- ENd of divs tips and recent articles -->

<div class="clear"></div>

<div class="global_sperator_height" style="width:100%"></div>

<div class="clear"></div>
<div class="home_widget friends_recipes " >
	<div class="title best_cook_border_color regular_widget_border_width height_40">
        <div class="sections_wrapper_margin ">
            <div class="float_left best_cook_color"><?php echo lang("bestcook_friends_recipes") ?></div>
            <div class="float_right second_title gray_color" style="width: 185px;">
                <span style="position:relative;bottom:-18px">“</span>
                <small><?php echo lang("bestcook_thanks") ?></small>
                <span style="position:relative;">”</span>
             </div>
        </div>    
	</div>
    <div class="container">
    
    
        <div class="feature_image float_left ">
        <?php
			$id_column = "members_recipes_ID";
			$title_column = 'members_recipes_name';
			$image_url =  $this->config->item('users_recipes_img_link');
			$method = "your_recipes";
        
			for($i=0 ;$i<sizeof($display_bestcook_members_last_recipes); $i++):
    
            if(empty($display_bestcook_members_last_recipes))
        	echo '<p style="padding:15px; text-align:center"> '.lang('globals_No_articles_in_this_section').'</p>';
    
            $id = $display_bestcook_members_last_recipes[0][$id_column];
           	$image  = $display_bestcook_members_last_recipes[0]['images_src'] == "logo.png" ? base_url()."uploads/recipes/image_not_available".$current_language_db_prefix.".png" : $this->config->item("users_recipes_img_link").$display_bestcook_members_last_recipes[0]['images_src'];
		 
		    $url = site_url("best_cook/".$method."/".$id);
			$title = $display_bestcook_members_last_recipes[0][$title_column];
            $section_url = site_url("best_cook/".$method);
			
			echo '<a href="'.$url.'" title="'.$title.'"><img style="border:none;" width="360" height="290" src="'.$image.'" alt="'.$title.'"/></a>';
        ?>

        <div class="desc_wrapper global_background" >
            <div style="margin: 0 8px;height: 40px;">
                <a href="<?php echo $url; ?>"><h3 class="float_left"><?php echo $title; ?></h3></a>
                <div class="float_right">
                    <div class="triangle <?php echo $current_section_borderbottom_color ?>"></div>
                    <div class="plus_sign white_color"><a href="<?php echo $section_url; ?>">+</a></div>
                    <div class="clear"></div>
                </div>
            </div>
        </div><!-- .desc_wrapper -->
        <div class="clear"></div>
    
    <?php
	endfor;
	?>

        </div>
        <div class="friends_recipes_list float_left">

                <ul class="list_of_title_image_vertical" >
					<?php
                    for($i = 0 ; $i < sizeof($display_recent_recipes_members) ; $i++):
					
                    $url  = site_url('best_cook/your_recipes/'.generateSeotitle($display_recent_recipes_members[$i]['members_recipes_ID'] , $display_recent_recipes_members[$i]['members_recipes_name'])  );
                    $title = $display_recent_recipes_members[$i]['members_recipes_name'];
					$short_title = $this->common->limit_text($title, 30);
					$image  = $display_recent_recipes_members[$i]['images_src'] == "logo.png" ? base_url()."uploads/recipes/image_not_available".$current_language_db_prefix.".png" : $this->config->item('users_recipes_img_link').$this->config->item('image_prefix').$display_recent_recipes_members[$i]['images_src'];
                    $views = $display_recent_recipes_members[$i]['members_recipes_views'];
                    $member_name = $display_recent_recipes_members[$i]['members_first_name'] ." ". $display_recent_recipes_members[$i]['members_last_name'] ;
					?>
                    <li class="global_background" style="margin:0 0 5px 0;width: 98%;padding: 5px; height:84px;">
                        <div class="float_left" style="width:105px;	height:85px;"><a href="<?php echo $url ?>" title="<?php echo $title;?>"><img src="<?php echo $image; ?>" alt="<?php echo $title;?>"  style="width:105px;height:85px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;border: 1px solid #E0E0E0;border:none" /></a></div>
                        <div style="width:5px; height:80px;" class="float_left"></div>
                        <div style="width: 250px;height: 60px;">
                            <h3><a class="<?php echo is_arabic($title); ?>" href="<?php echo $url ?>"><?php echo $short_title; ?></a></h3>
                            <h4 class="<?php echo is_arabic($member_name); ?>" style="line-height:17px;"><?php echo $member_name; ?></h4>
                            <span style="line-height: 29px;font-size: 12px;" class="dark_gray float_left" ><?php echo lang('globals_views')." ( ".$views." ) ";?></span>
                            
                            <div class="clear"></div>
                        </div>
           
                        <div class="float_right"><a class="best_cook_color" href="<?php echo $url ?>" ><?php echo lang("globals_more"); ?></a></div>
                        
                        <div class="clear"></div>
                    </li>
                    <?php
                    endfor;
                    ?>
                    </ul>
       		 </div>
        <div class="send_recipes float_left">
        <a href="<?php echo  site_url($this->router->class."/upload_recipe");?>" title="send recipe"><img style="border:none;" class="radius_5" src="<?php echo base_url()."images/bestcook/send_recipes".$current_language_db_prefix.".png" ?>" alt="send_recipes" /></a>
        </div>
    </div>
    <div class="clear"></div>
</div>

<div class="clear"></div>

<div class="thick_line best_cook_background_color"></div>

<div class="global_sperator_height" style="width:100%"></div>

<div  class="float_left home_widget inner_applications_bestcook_width " >
	<div class="inner_title_wrapper">
        <div class="sections_wrapper_margin">
            <?php
                //Get Data form grow up 
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(132,$current_language_db_prefix);
             ?>
        <h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo $subsection_title;?></h1>
        </div>
    </div>
	<div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
    
        <div id="application_slider_container" >
        <ul class="application_slider">
        <?php
        for($i=0 ; $i < sizeof($display_bestcook_applications) ; $i++):
		
		$id = $display_bestcook_applications[$i]['applications_ID'];
		$title = $display_bestcook_applications[$i]['applications_title'.$current_language_db_prefix];
		$image =  base_url()."uploads/applications/".$display_bestcook_applications[$i]['images_src'];
		$logo =  base_url()."uploads/applications/".$this->globalmodel->get_image_src($display_bestcook_applications[$i]['applications_logo']);
        ?>
        
            <li>
            <a href="<?php echo site_url($this->router->fetch_class().'/applications/'.$id)?>">
            <img src="<?php echo $image ?>" />
            <div class="circle <?php echo $current_section_background_color ?>"> 
          			<div class="cook_tool" style="background:url('<?php echo $logo; ?>') 0 0;"></div>

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

 
<?php $this->widgets->generate_ask_an_expert(178,$current_section_color,$current_section_border_color,$current_section_background_color,$display_ask_an_expert,$display_expert,$current_language_db_prefix);   ?>

<div class="float_left "  style="width:20px; height:300px;" ></div>

<div class="float_left home_widget inner_applications_bestcook_width" >
    <div class="inner_title_wrapper">
        <div class="sections_wrapper_margin" style="margin: 0 15px;">
        <h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo lang('bestcook_videos');?></h1>
        </div>
    </div>
	<div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
<?php

	for($i=0;$i<sizeof($display_featured_video);$i++):
	
	$title = $display_featured_video[0]['videos_name'];
	$youtube_url = $display_featured_video[0]['videos_url'];
	$short_title = $this->common->limit_text($title,37);

?>

 <div class="image">
    	<a title="<?php echo $title; ?>" href="http://www.youtube.com/embed/<?php echo $this->common->youtube($youtube_url); ?>" class="various fancybox.iframe">
        	<img class="app" style="height: 254px;margin-top: 44px;border:none;" src="http://img.youtube.com/vi/<?php echo $this->common->youtube($youtube_url); ?>/mqdefault.jpg" />
   		</a>
    </div>
    <a title="<?php echo $title; ?>" href="http://www.youtube.com/embed/<?php echo $this->common->youtube($youtube_url); ?>" class="various fancybox.iframe">
    	<img style="border:none;" class="video_paly" src="<?php echo base_url()."images/video_player.png" ?>" />
	</a>
    
    <div class="description " style="-webkit-border-bottom-right-radius: 15px;-webkit-border-bottom-left-radius: 15px;-moz-border-radius-bottomright: 15px;-moz-border-radius-bottomleft: 15px;border-bottom-right-radius: 15px;border-bottom-left-radius: 15px;bottom: -3px;">
            <h4 class="float_left dir" style="line-height: 35px;"><b><a href="http://www.youtube.com/embed/<?php echo $this->common->youtube($youtube_url); ?>" class="various fancybox.iframe dark_gray <?php echo is_arabic($short_title); ?>" ><?php echo $short_title; ?></a></b></h4>
            <div class="clear"></div>
	</div>
	<?php endfor;?>

</div><!-- End of  videos -->
