<script type="text/javascript">
$(document).ready(function(e) {
	$('.videoslider').bxSlider({
	 	mode: 'horizontal',
	   	slideWidth: 400,
		minSlides: 3,
		maxSlides: 1,
		moveSlides: 1,
		slideMargin: 10,
		nextText : '',
		prevText : '',
		pager: false,
		infiniteLoop:true ,
	});
});
</script>
<script type="text/javascript">
$(document).ready(function(e) {
   $('.recentitem_prev').addClass('disabled');
   var count_array = <?php echo $number_of_array = count($display_videos); ?>
   
   if(count_array <= 2)
   {
	    $('.recentitem_next').addClass('disabled');
   }
});
</script>
<script type="text/jscript">
jQuery(function(){
	
	jQuery("#video_list").jCarouselLite({
			btnNext: ".recentitem_next",
			btnPrev: ".recentitem_prev",
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
	width: 212px !important;
	height: 210px !important;
	margin: 10px 4px;
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
<?php 
function youtube_v_extractor($url){

//$vid = explode("v=", $url);
//$rtv = explode(" ", $vid[1]);
parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
return $my_array_of_vars['v'];
}
?>
<style>

body.arabic .video_list{width:400px; height:300px; margin-left: -47px;}

.video_list{width:400px; height:300px; margin-left:0px;}

.videoslider li
{
	width:430px !important;
}
.bx-wrapper
{
	padding: 0 30px !important;
}
</style>
<?php
if(sizeof($display_videos) > 0)
{
?>
<div id="advirts_videos" class="float_left" <?php if($brand_id==122){?> style="display:none;" <?php }?>>
  	<h1 class="video_header product_color"><?php echo lang('product_recent_advirts_videos'); ?></h1>
    
    <div class="video float_left">
    <?php if($display_videos[0]['videos_url']){ ?>
    	<div class="frame"><iframe width="500" height="250" src="https://www.youtube.com/embed/<?php echo youtube_v_extractor($display_videos[0]['videos_url']); ?>" frameborder="0" allowfullscreen></iframe></div>
    <?php }else{
	?>
    	<script>
        	$(".video").html('<h2 class="thanks_message product_color"><?php echo lang('product_not_content_available'); ?></h2>');
        </script>
	<?php
	} ?>
    </div>
    <div class="line product_background_color float_left">&nbsp;</div>
    
    <div class="other_videos_list float_right">
    
    

     
    <?php
	if($display_videos)
	{
		if(sizeof($display_videos) == 1){
	$title = $display_videos[0]['videos_name'];
	$youtube_url = $display_videos[0]['videos_url'];
	?>
    <ul>
   	<li style="margin: 25px 80px; text-align:center;">

    	<a title="<?php echo $title; ?>" rel="<?php echo $youtube_url; ?> class="video_active">
        <img style="border:none" title="<?php echo $title; ?>" width="350" height="180" src="https://img.youtube.com/vi/<?php echo youtube_v_extractor($display_videos[0]['videos_url']); ?>/0.jpg" />
        <p style="width:247px;"><?php echo $title; ?></p></a>
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
	$frame_url = youtube_v_extractor($display_videos[$i]['videos_url']);

	?>
	<li>
        <a title="<?php echo $title; ?>" rel="<?php echo $frame_url; ?>" href="https://www.youtube.com/embed/<?php echo youtube_v_extractor($display_videos[$i]['videos_url']); ?>" class="video_active">
        <img style="border:none" title="<?php echo $title; ?>" width="216" height="150" src="https://img.youtube.com/vi/<?php echo youtube_v_extractor($display_videos[$i]['videos_url']); ?>/0.jpg" />
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
        	$(".other_videos_list").html('<h2 class="not_available product_color"><?php echo lang('product_not_available_videos'); ?></h2>');
        </script>
        <?php
		}
	?>
    </div>
          </div>
   <?php
   if(sizeof($display_videos) != 1)
   {
   ?>
   <script>
   $(".video_active").live("click", function(){
   	var item = $(this);
	var video_url = item.attr('rel');
	$(".frame").html('<div class="frame"><iframe width="500" height="250" src="//www.youtube.com/embed/'+ video_url +'" frameborder="0" allowfullscreen></iframe></div>');
	return false;
   });
   </script>
<?php
   }
}
?>