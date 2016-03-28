<?php

//Save Last Urll in to session
$last_visited_url = $this->session->set_userdata('last_visited_url', current_url() );
?>
<!DOCTYPE HTML>
<html><head>
<meta content="text/html; charset=utf-8" />
<title><?php echo $this->headers->get_website_title() ?></title>
<?php
//Write Normal Metatags
echo $this->headers->write_metatags_lines();
echo $this->headers->write_fb_metatags_lines();
?>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo base_url(); ?>css/main_styles.css" rel="stylesheet" type="text/css">


<!-- Load quote fonts -->
<link href="<?php echo base_url(); ?>fonts/gess_two_light/stylesheet.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-migrate-1.2.1.min.js"></script>

<!-- Animations -->
<script src="<?php echo base_url(); ?>js/manage_animations.js"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.mousewheel-3.0.6.pack.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/fancybox/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />

<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<!-- Add Thumbnail helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancybox/helpers/jquery.fancybox-media.js?v=1.0.5"></script>

<!-- Carousel -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.carousellite.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.cycle.all.js"></script> 

<!-- Camera -->
<link rel='stylesheet' id='camera-css'  href='<?php echo base_url(); ?>css/camera.css' type='text/css' media='all'> 
<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery.mobile.customized.min.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery.easing.1.3.js'></script> 
<script type='text/javascript' src='<?php echo base_url(); ?>js/camera.min.js'></script> 

<!-- Prettyphoto -->
<link rel='stylesheet' id='camera-css'  href='<?php echo base_url(); ?>css/prettyPhoto.css' type='text/css' media='all'> 
<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery.prettyPhoto.js'></script> 

<!-- Pagination -->
<link rel='stylesheet'  href='<?php echo base_url(); ?>css/pajinate_styles.css' type='text/css' media='all'> 
<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery.pajinate.js'></script>

<!-- ENd of carousel -->
<link href="<?php echo base_url(); ?>js/owl-carousel/owl.carousel.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>js/owl-carousel/owl.carousel<?php  echo $current_language_db_prefix?>.js"></script>

<!-- Carousel for question of the week -->
<script type='text/javascript' src='<?php echo base_url(); ?>js/jquery.sudoSlider.min.js'></script>

<!-- Tips -->
<script src="<?php echo base_url(); ?>js/slides.jquery.js"></script>

<!-- jquery-ui -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.9.0.custom.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-tabs-rotate.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>js/jquery.ui.scrollbar/css/jquery.ui.scrollbar.css" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ui.scrollbar/js/jquery.ui.scrollbar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ui.scrollbar/js/jquery.ui.scrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ui.scrollbar/js/jquery.mousewheel.js"></script>

<script src="<?php echo base_url(); ?>js/jquery.slimscroll.min.js"></script>

<?php /*?><script src="<?php echo base_url(); ?>js/jquery.fs.scroller.js"></script>
<link href="<?php echo base_url(); ?>js/jquery.fs.scroller.css" rel="stylesheet"><?php */?>

<!--Add gallary-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ad-gallery.js"></script>
<link href=" <?php echo base_url();?>css/jquery.ad-gallery.css" rel="stylesheet">

<!--BXSlider-->
<link href="<?php echo base_url(); ?>css/jquery.bxslider.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>js/jquery.bxslider.min.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	$('.bxslider').bxSlider({
	 	mode: 'vertical',
	   	slideWidth: 205,
		minSlides: 3,
		maxSlides: 3,
		moveSlides: 1,
		slideMargin: 10,
		nextText : '',
		prevText : '',
		pager: false,
		infiniteLoop:true ,
	});
});
</script>
<!-- ashraf add this script-->

<!-- end-->


    
  
  


<!-- Comments-->
<?php /*?><script type="text/javascript" src="<?php echo base_url(); ?>js/comment.js"></script><?php */?>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.maxlength.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.shorten.min.js"></script>
<!--[if IE]>
<script src="<?php echo base_url(); ?>js/html5.js"></script>
<![endif]-->

<!--Slideshow text with image-->
<link href="<?php echo base_url(); ?>css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.ennui.contentslider.js"></script>


   
   
   
      

<?php /*?><script type="text/javascript">
$(document).ready(function(e) {
    $('#one').ContentSlider({
		width : '980px',
		height : '360px',
		speed : 800,
		easing : 'easeInOutBack'
	});
	
});
</script><?php */?>

<!-- Prettyphoto -->
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto(
	{
		social_tools : false,deeplinking:false, theme:"facebook",show_title:false
	});
	
	
});
</script>

<!--Rate Plugin-->
<link href="<?php echo base_url(); ?>css/jRating.jquery.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jRating.jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
      // you can rate from this code
      $(".basic").jRating({
         step:true,
		 type : "big",
		 canRateAgain : true,
		 nbRates : 100,
         length : 5, // nb of stars
         onSuccess : function(){
      }
   });
    // you can only see the rate of member from this code
    $(".basic_disable").jRating({
         step:true,
		 //type : "small",
		 type : "big",
		 isDisabled : true,
         length : 5, // nb of stars
         onSuccess : function(){
      }
   });
   
});
</script>


<!--SelectBoxIt-->
<link href="<?php echo base_url(); ?>css/jquery.selectBoxIt.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.selectBoxIt.js"></script>

<script>
$(function(){
	$(".best_cook_search_styled_select_box").selectBoxIt({
	});
	$(".selectboxit-arrow-container").addClass("float_right");
});
</script>

<!--Scroll Bar-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.nicescroll.min.js"></script>



</head>

<body class="<?php echo $this->config->item('language'); ?>">

<?php  $this->load->view('template/fancybox_handler'); ?>

<?php
if ( isset($apply_outer_drawings) && $apply_outer_drawings == true)
{
?>
	<div class="left_drawings" style="background:url(<?php echo $header_left_outer_drawings_src; ?>)"></div>
	<div class="right_drawings" style="background:url(<?php echo $header_right_outer_drawings_src; ?>)"></div>
<?php
}
?>

<script>
$(document).ready(function(){
  $("#contact_us_phone").hover(function(){
    $("#contact_phone").toggle("slide", { direction: "left" }, 1000);

  });
 });
</script>
<style>
#contact_phone{
margin-left: 39px;
width: 112px;
border-radius: 9px;
background: rgb(235, 115, 17) !important;
height: 45px;
position: relative;
top: -8px;
}

#contact_phone span{

padding-right: 18px;
font-size: 30px;
display: block;
padding-top: -56px;
margin-top: -12px;
}
#contact_phone p{

padding-top: 13px;
color: white;
font-size: 9px;
padding-right: 28px;
line-height: 0px;

}


.english #contact_phone p {
padding-top: 11px;
color: white;
font-size: 11px;
padding-right: -30px;
line-height: 0px;
height: 11px;
width: 100px;
padding-left: 32px;
}

.english #contact_phone span {
padding-left: 10px;
font-size: 30px;
display: block;
padding-top: -56px;
margin-top: -12px;
}
.english #contact_phone{
margin-top: -2px;
top: 1px;
}
.ui-effects-wrapper{
margin-top: 0px !important;


height: 48px !important;

	}
	
</style>
<div id="contact_us_wrapper">
<!--<a href="<?php echo site_url('contact_us')?>"><img style="border:none;" src="<?php echo base_url()."images/contactus_image".$current_language_db_prefix.".png" ?>" /></a>-->
<!-- ashraf add this -->
<a href="<?php echo site_url('contact_us')?>"><img style="border:none;" src="<?php echo base_url()."images/contactus_image1".$current_language_db_prefix.".png" ?>" /></a>
<a href="#" onclick="return false;" id="contact_us_phone"><img style="border:none; position: absolute; top: 92px; left: 0px; z-index:111;" src="<?php echo base_url()."images/contactus_image2".$current_language_db_prefix.".png" ?>" /></a> 

<div style="display:none;" id="contact_phone">

<p><?php echo lang('globals_hot_line'); ?></p>
<span>16180</span>
</div>


</div><!-- ENd of contact_us_wrapper -->

<div id="preheader_wrapper">
    <div class="inner">
    	<div id="preheader_inner_wrapper" class="float_right">
            <ul class="float_right">
                <li class="float_right" ><a href="<?php echo site_url('terms_conditions')?>"><?php echo lang("globals_secmenu_terms"); ?></a></li>
                <li class="float_right" ><a href="<?php echo site_url('privacy_policy')?>"><?php echo lang("globals_secmenu_privacy"); ?></a></li>
                <li class="float_right">
					<?php
                    if($current_language=="english")
                    echo anchor($this->lang->switch_uri('ar'),'عربي',array('class' => 'arabic_font '.($current_language=="arabic" ? "active" : "") )); 
                     
                    if($current_language=="arabic")
                    echo anchor($this->lang->switch_uri('en'),'English',array('class' => 'english_font '.($current_language=="english" ? "active" : "") ));
                    ?>
                </li>
                <li class="float_right"><a href="<?php echo site_url() ?>"><img src="<?php echo base_url() ?>images/header_homepage_icon.png" height="20" style="border:none;" /></a></li>
				<?php /*?><li ><?php echo lang("globals_secmenu_contactus"); ?></li><?php */?>

                <div class="clear"></div>
            </ul>
            
            <div class="clear"></div>
        </div><!-- End of preheader_inner_wrapper -->
        <div class="clear"></div>
    </div><!-- End of inner -->



</div><!-- End of preheader_wrapper -->
<script>
$(document).ready(function(e) {
	
    
	//Initilize Shorten
	$('.shorten_text').shorten({ tooltip: false});
	
	//Initilize Max Length
	$('.max_length').maxlength({max: 4,showFeedback: false});
	
	//Initilize Fancybox
	$('.fancybox').fancybox();
	 
	
	var lang = '<?php echo $this->session->userdata('site_lang'); ?>';
	//alert(lang);
	//if(lang == 'english')
	////{
		//page_navigation text
		var next = '<?php echo lang("globals_next");?>';
		var prev = '<?php echo lang("globals_prev");?>';
	//}
	//else
//	{
	//	var next = 'التالى';
		//var prev = 'السابق';
	//}
	
	$('.container_pagination_wrapper_9_items').pajinate({
		items_per_page : 9,
		nav_label_next : next+' >',
		nav_label_prev : '< '+prev,
		nav_label_first : '',
		nav_label_last : '',
		num_page_links_to_display : 6,wrap_around: true, abort_on_small_lists: true
	
		
	});
				
	$('.container_pagination_wrapper_6_items').pajinate({
		items_per_page : 6,
		nav_label_next : next+' >',
		nav_label_prev : '< '+prev,
		nav_label_first : '',
		nav_label_last : '',
		num_page_links_to_display : 6,wrap_around: true, abort_on_small_lists: true
		
	});
	
	$('.container_pagination_wrapper_4_items').pajinate({
		items_per_page : 4,
		nav_label_next : next+' >',
		nav_label_prev : '< '+prev,
		nav_label_first : '',
		nav_label_last : '',
		num_page_links_to_display : 6,wrap_around: true, abort_on_small_lists: true
		
	});

	
	$('.container_pagination_wrapper_12_items').pajinate({
		items_per_page : 12,
		nav_label_next : next+' >',
		nav_label_prev : '< '+prev,
		nav_label_first : '',
		nav_label_last : '',
		num_page_links_to_display : 6,wrap_around: true, abort_on_small_lists: true
		
	});
		

});
$(function() {
    $(".application_list").jCarouselLite({
        btnNext: ".applicationlist_next",
        btnPrev: ".applicationlist_prev"
    });
})
</script>


<div id="mainheader_wrapper">
	<div class="inner">
	    <div id="logo" class="float_left"><a href="<?php echo site_url("welcome"); ?>"><img width="308" src="<?php echo base_url() ?>images/be_at_your_best_logo<?php echo $current_language_db_prefix ?>.png" border="0"  alt="nestle logo"/></a></div>
        <div class="float_right main_member_area_wrapper">
        <?php
        // if($this->session->userdata('logged_in') )
		if($this->members->members_id)
		 {
			 $this->load->view('template/profile_wrapper');
		 }
		 else
		 {
			 $this->load->view('template/login_form');
		 }
		 
		
		?>
        </div>
        
        
        
        <div class="clear"></div>
        
    </div>

</div><!-- End of mainheader_wrapper -->



<div id="mainbody_wrapper"  class="inner">

<?php
/*if ( isset($apply_outer_drawings) && $apply_outer_drawings == true)
{
?>
	<div class="left_drawings" style="background:url(<?php echo $header_left_outer_drawings_src; ?>)"></div>
	<div class="right_drawings" style="background:url(<?php echo $header_right_outer_drawings_src; ?>)"></div>
<?php
}*/
?>
	

	<div id="socialmedia_icons_wrapper">	
        <div id="socialmedia_icons">
        <ul>
        <li style="line-height:30px;"><?php echo lang('globals_follow_us'); ?></li>
        <li><a href="https://www.facebook.com/NestleEgypt" target="_blank"><img style="border:none" src="<?php echo base_url()."images/socialmedia/fb.png"; ?>" alt="facebook" /></a></li>
        <!-- <li><a><img src="<?php echo base_url()."images/socialmedia/twitter.png"; ?>" /></a></li> -->
        <li><a href="https://www.youtube.com/user/NestleEgypt" target="_blank"><img style="border:none" src="<?php echo base_url()."images/socialmedia/youtube.png"; ?>" alt="youtube" /></a></li>
        <?php /*?><li><a><img src="http://cdn.pimg.co/p/30x30/858652/fff/img.png" /></a></li><?php */?>
        </ul>
        
        </div><!-- End of socialmedia_icons -->
     </div><!-- End of socialmedia_icons_wrapper -->
    
    
	
    
    <?php
	if(@$is_mainhomepage):
	?>
    <div id="shortcuts_sections_wrapper">
    <div id="shortcuts_sections">
    <div id="shortcuts_explainer_wrapper" style="">
    <img src="<?php echo base_url()."images/homepage_arrow_image.png" ?>" width="50"   />
    <p><img src="<?php echo base_url()."images/homepage_arrow_icons_text".$current_language_db_prefix.".png" ?>"  /></p>
    </div><!-- End of shortcuts_explainer_wrapper -->
    <ul>
    <?php
	if(!$display_custom_sections_member_order):
	//Display default view case member doesn't save a custom one
	?>
    <li><a class="shortcut_button" data-scrollto="best_me" ><div class="small_circle best_me_background_color" ></div></a></li>
    <li><a class="shortcut_button" data-scrollto="best_cook" ><div class="small_circle best_cook_background_color" ></div></a></li>
    <li><a class="shortcut_button" data-scrollto="best_mom" ><div class="small_circle best_mom_background_color" ></div></a></li>
    <li><a class="shortcut_button" data-scrollto="best_time" ><div class="small_circle best_time_background_color" ></div></a></li>
   	<?php
	endif;
	?>
    <?php
	if($display_custom_sections_member_order):
		for($i=0;$i<sizeof($display_custom_sections_member_order);$i++):
		
			$id_of_section = $display_custom_sections_member_order[$i]['members_section_order_section_id'];
			switch($id_of_section)
			{
				case 2:
				echo '<li><a class="shortcut_button" data-scrollto="best_cook" ><div class="small_circle best_cook_background_color" ></div></a></li>';break;
				case 10:
				echo '<li><a class="shortcut_button" data-scrollto="best_me" ><div class="small_circle best_me_background_color" ></div></a></li>';break;
				case 27:
				echo '<li><a class="shortcut_button" data-scrollto="best_mom" ><div class="small_circle best_mom_background_color" ></div></a></li>';break;
				case 28:
				echo '<li><a class="shortcut_button" data-scrollto="best_time" ><div class="small_circle best_time_background_color" ></div></a></li>';break;
			}
		endfor;
	endif;
	?>
    </ul>
    </div><!-- End of shortcuts_sections -->
    </div><!-- End of shortcuts_sections_wrapper -->
    
   <?php /*?> <script>
		jQuery(function(){
			
			jQuery('#camera_wrap_1').camera({
				thumbnails: false,pagination:false,
				height: '355px',playPause : false
			});

		
		});
	</script>

    <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
                <div data-thumb="<?php echo base_url(); ?>images/slides/thumbs/bridge.jpg" data-src="<?php echo base_url(); ?>images/slides/bridge.jpg">
                   
                </div>
                <div data-thumb="<?php echo base_url(); ?>images/slides/thumbs/leaf.jpg" data-src="<?php echo base_url(); ?>images/slides/leaf.jpg">
                   
                </div>
                <div data-thumb="<?php echo base_url(); ?>images/slides/thumbs/road.jpg" data-src="<?php echo base_url(); ?>images/slides/road.jpg">
                   
                </div>
                <div data-thumb="<?php echo base_url(); ?>images/slides/thumbs/sea.jpg" data-src="<?php echo base_url(); ?>images/slides/sea.jpg">
                   
                </div>
                <div data-thumb="<?php echo base_url(); ?>images/slides/thumbs/shelter.jpg" data-src="<?php echo base_url(); ?>images/slides/shelter.jpg">
                    
                </div>
                <div data-thumb="<?php echo base_url(); ?>images/slides/thumbs/tree.jpg" data-src="<?php echo base_url(); ?>images/slides/tree.jpg">
                   
                </div>
    </div><!-- End of camera_wrap --><?php */?>
    
    <?php
	endif;
	?>
    
    <div class="clear"></div>
	
   	<?php
    if(!isset($is_mainhomepage)):
	?>
    <div id="mainmenu_wrapper" >
        <ul id="menu" class="float_right">
        <li class="float_left best_cook_background_color"><a href="<?php echo site_url('best_cook') ?>"><?php echo lang("globals_bestcook"); ?></a></li>
        <li class="float_left best_mom_background_color"><a href="<?php echo site_url('best_mom') ?>"><?php echo lang("globals_bestmom"); ?></a></li>
        <li class="float_left best_me_background_color"><a href="<?php echo site_url('best_me') ?>"><?php echo lang("globals_bestme"); ?></a></li>
        <li class="float_left best_time_background_color"><a href="<?php echo site_url('best_time') ?>"><?php echo lang("globals_besttime"); ?></a></li>
		<li class="float_left nestle_products" ><a href="<?php echo site_url('products');?>"><img src="<?php echo base_url()."images/header_menu_nestle_products".$current_language_db_prefix.".png"; ?>" /></a><div class="ballon_hover"><img src="<?php echo base_url()."images/header_image_products_ballon_hover{$current_language_db_prefix}.png"; ?>" /><a class="close_button close_ballon_hover" title="close">X</a></div></li>
        </ul>
        
        <div class="float_left" style="height:21px; margin-top:8px">
            <form action="<?php echo site_url('search_results/index');?>" method="get">
                <input id="main_header_text_area" name="q" type="text" placeholder="<?php echo lang("globals_hmenu_search_title");  ?>" class="text_class  " style="float:left; " />
                <input type="submit" class=" margin_10" value="" style="background:none; border:none; background-image:url(<?php echo base_url()."images/header_search_icon_magnifer.png" ?>);float:left;margin:0px 0px; cursor:pointer;width: 38px;height: 33px;"/>
            </form>
        </div>
        
        <div class="clear"></div>
    </div><!-- End of mainmenu_wrapper -->
    <?php endif; ?>
    
    
    
