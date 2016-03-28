<script>
$(document).ready(function(e) {
	$('.homepage_section_slider').bxSlider({
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
<style>
.bx-wrapper .bx-controls-direction a{position: absolute; top: 165px; margin-top: -80px; outline: 0; width: 41px; height: 116px; text-indent: -9999px; z-index: 9999; background-color:transparent;}

.bx-wrapper .bx-prev {left: 0px; background: url(../../images/homepage/left_arrow.png) no-repeat;}

.bx-wrapper .bx-next{right: -1px;background: url(../../images/homepage/right_arrow.png) no-repeat;}
.bx-wrapper .bx-loading {
	min-height: 50px;
	background: url(../images/bx_loader.gif) center center no-repeat !important;
	height: 100%;
	max-height:770px;
	width: 100%;
	position: absolute;
	top: 0;
	left: 0;
	z-index: 2000;
}
</style>
<div class="slide_show_wrapper float_right" style="overflow: visible; z-index: 1;">
<?php

if(sizeof($display_section_slideshow) != 1){

?>
<ul class="homepage_section_slider">

<?php

for($i=0 ; $i < sizeof($display_section_slideshow) ; $i++):
		
		$image = base_url()."uploads/slideshows/".$display_section_slideshow[$i]['images_src'];
		if($display_section_slideshow[$i]['section_slidesshow_url'])
		{
			$flag = $display_section_slideshow[$i]['section_slidesshow_flag'];
			if($flag == 1) {
				$url = site_url($display_section_slideshow[$i]['section_slidesshow_url']);
			} else if ($flag == 2) {
				$url = $display_section_slideshow[$i]['section_slidesshow_url'];
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
		//echo '<li><a href="'.$url.'"><img src="'.$image.'" /></a></li>';
		//echo '<div data-link="'.$url.'" data-thumb='.$image.'" data-src="'.$image.'"></div>';

		endfor;
 
/*for($i=0 ; $i < sizeof($display_section_slideshow) ; $i++):
$image = base_url()."uploads/slideshows/".$display_section_slideshow[$i]['images_src'];
echo '<li><img src="'.$image.'" /></li>';
endfor;*/
?>
</ul>
<?php
}else{
	$image = base_url()."uploads/slideshows/".$display_section_slideshow[0]['images_src'];
	echo '<img src="'.$image.'" />';
}
?>
</div><!-- End of slide_show_wrapper -->