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
<script type="text/jscript">
jQuery(function(){
	
	jQuery("#video_list").jCarouselLite({
			btnNext: ".recentitem_prev",
			btnPrev: ".recentitem_next",
			visible:2,
			circular: false,
			 
		});

});
</script>
<style>
.video_list_wrapper
{
	
	width:100%;
	height:auto;
	position:relative;
}
.video_list_wrapper .recentitem_prev{ right: 7px;top: 84px;position: relative; cursor:pointer}
.video_list_wrapper .recentitem_next{ left:7px; }
.video_list_wrapper #video_list
{
	width: 444px !important;
	margin: 17px 27px 0 27px;
	height: 222px;
}
.video_list_wrapper #video_list li
{
	width: 216px !important;
	height: 210px !important;
	margin: 10px 5px;
	list-style:none;
}
.recentitem_next.disabled , .recentitem_prev.disabled
{
	visibility:hidden;
}
.recentitem_prev
{
	float:right;
}
#video_list ul li a h3
{
	line-height:22px;
}
</style>
<script type="text/javascript">
$(document).ready(function(e) {
   $('.recentitem_next').addClass('disabled');
   var count_array = <?php echo $number_of_array = count($display_videos); ?>
   
   if(count_array <= 2)
   {
	    $('.recentitem_prev').addClass('disabled');
   }
});
</script>

<?php 

function youtube_v_extractor($url){

//$vid = explode("v=", $url);
//$rtv = explode(" ", $vid[1]);
parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
return $my_array_of_vars['v'];
}
?>


<div class="other_videos_list float_right">
    <h1 class="video_header product_color"><?php echo lang('product_recent_advirts_videos'); ?></h1>
    
    <?php
	if($display_videos)
	{
		if(sizeof($display_videos) == 1){
	$title = $display_videos[0]['videos_name'];
	$youtube_url = $display_videos[0]['videos_url'];
	?>
    <ul>
   	<li style="margin: 20px 80px; text-align:center;">
        <a title="<?php echo $title; ?>" href="https://www.youtube.com/embed/<?php echo youtube_v_extractor($display_videos[0]['videos_url']); ?>" class="various fancybox.iframe">
        <img style="border:none;" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" width="350" height="180" src="https://img.youtube.com/vi/<?php echo youtube_v_extractor($display_videos[0]['videos_url']); ?>/0.jpg" />
        <h3 title="<?php echo $title; ?>" style="text-align:center; font-size:13px !important;"><?php echo $title; ?></h3></a>

    </li>
    </ul>
    <?php
	}else{
	echo '<div class="video_list_wrapper">
	        <a class="recentitem_prev"><img class="" width="20" src="'.base_url().'images/products/right_arrow.png" /></a>
        	<a class="recentitem_next float_right"><img class="" width="20" src="'.base_url().'images/products/left_arrow.png" /></a>

	<div id="video_list">';
	echo '<ul>';

	for($i =0; $i<sizeof($display_videos);$i++):
	$title = $display_videos[$i]['videos_name'];
	$youtube_url = $display_videos[$i]['videos_url'];
	$thumbail_image = "";

	?>
	<li>
        <a title="<?php echo $title; ?>" href="https://www.youtube.com/embed/<?php echo youtube_v_extractor($display_videos[$i]['videos_url']); ?>" class="various fancybox.iframe">
        <img style="border:none;" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" width="216" height="150" src="https://img.youtube.com/vi/<?php echo youtube_v_extractor($display_videos[$i]['videos_url']); ?>/0.jpg" />
        <h3 title="<?php echo $title; ?>" style="text-align:center;"><?php echo $title; ?></h3></a>

    </li>
    <?php

	endfor;
	echo '</ul></div>';
	echo '</div>';
	}}
	else
	{
		?>
        <script>
        	$(".other_videos_list").html('<h1 class="video_header product_color"><?php echo lang('product_recent_advirts_videos'); ?></h1><h2 class="not_available product_color"><?php echo lang('product_not_available_videos'); ?></h2>');
        </script>
        <?php
		}
	?>
  
    </div>