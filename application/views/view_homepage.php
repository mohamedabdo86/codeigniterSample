<?php /*?><?php if(empty($_GET['display_box'])) { ?>
<script type="text/javascript">
$(document).ready(function(e){
	    $(".pop_up_image").fancybox({
        afterShow: function () {
            $(".fancybox-image").wrap($("<a />", {
                // set anchor attributes
                href: "best_me/applications/9", //or your target link
                target: "_blank" // optional
            }));
        }
    }).trigger("click");
});
</script>
<?php } ?>

<a class="fancybox pop_up_image" href="<?php echo base_url()."images/homepage/new_pop_up.jpg"; ?>"></a><?php */?>


<script>
$(document).ready(function(e) {
	$('.homepage_slider').bxSlider({
  		auto: true,
  		autoControls: false,
		nextText : '',
		prevText : '',
		pager: false,
		onSliderLoad: function () {
			$('.bx-controls-direction').hide();
			$('.bx-wrapper').hover(
			function () { $('.bx-controls-direction').fadeIn(300); },
			function () { $('.bx-controls-direction').fadeOut(300); }
			);
			},
	});
});
</script>
    
<div class="global_sperator_height" style="width:100%;"></div>
<style>
#homepage_slider{
	width:100%;
	height:365px;
	overflow:hidden;
}
.bx-wrapper .bx-loading {
	min-height: 50px;
	background: url(../../images/camera-loader.gif) center center no-repeat !important;
	height: 100%;
	max-height:770px;
	width: 100%;
	position: absolute;
	top: 0;
	left: 0;
	z-index: 2000;
}
.bx-wrapper .bx-controls-direction a{position: absolute; top: 235px; margin-top: -80px; outline: 0; width: 41px; height: 116px; text-indent: -9999px; z-index: 9999; background-color:transparent;}

.bx-wrapper .bx-prev {left: 0px; background: url(../../images/homepage/left_arrow.png) no-repeat;}

.bx-wrapper .bx-next{right: -1px;background: url(../../images/homepage/right_arrow.png) no-repeat;}
</style>
<div id="homepage_slider">
<ul class="homepage_slider">
<?php 
		for($i=0 ; $i < sizeof($display_homepage_slideshow) ; $i++):
		$image = base_url()."uploads/slideshows/".$display_homepage_slideshow[$i]['images_src'];
		if($display_homepage_slideshow[$i]['slidesshow_url']) {
			$flag = $display_homepage_slideshow[$i]['slidesshow_flag'];
			if ($flag == 1){
				$url = site_url($display_homepage_slideshow[$i]['slidesshow_url']);	
			} else if ($flag == 2) {
				$url = $display_homepage_slideshow[$i]['slidesshow_url'];
			}
		}
		else
		{
			$url = "#";
		}
		if($flag == 2) {
			echo '<li><a href="'.$url.'" target="_blank"><img src="'.$image.'" /></a></li>';
		} else {
			echo '<li><a href="'.$url.'"><img src="'.$image.'" /></a></li>';
		} 
		
		endfor;
		?>
</ul>

</div>

    <div class="clear"></div>

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
    
  	<div class="global_sperator_height" style="width:100%;"></div>
      
    <?php
	if(!$display_custom_sections_member_order):
	//Display default view case member doesn't save a custom one
	?>
    
    <!-- Start of Best meSection -->
    <?php $this->load->view('homepage/homepage_bestme')?>
    <!-- End of Best me Section -->
    
	<!-- Start of Best Cook Section -->
    <?php $this->load->view('homepage/homepage_bestcook'); ?>
    <!-- End of Best Cook Section -->
    
    <!-- Start of Best Mom Section -->
    <?php $this->load->view('homepage/homepage_bestmom'); ?>
    <!-- End of Best Mom Section -->
        
    <!-- Start of Best time Section -->
    <?php $this->load->view('homepage/homepage_besttime'); ?>
	<!-- End of Best time Section -->
    <?php
	endif;
	if($display_custom_sections_member_order):
	
		for($i=0;$i<sizeof($display_custom_sections_member_order);$i++):
		
			$id_of_section = $display_custom_sections_member_order[$i]['members_section_order_section_id'];
			switch($id_of_section)
			{
				case 2:
				$this->load->view('homepage/homepage_bestcook');break;
				case 10:
				$this->load->view('homepage/homepage_bestme');break;
				case 27:
				$this->load->view('homepage/homepage_bestmom');break;
				case 28:
				$this->load->view('homepage/homepage_besttime');break;
			}
		endfor;
	
	endif;
	?>

    <!-- Start of Videos, twitter and facebook sections -->
    <?php $this->load->view('homepage/homepage_last_row'); ?>
    <!-- End of videos , twitter and facebook sections -->
   
