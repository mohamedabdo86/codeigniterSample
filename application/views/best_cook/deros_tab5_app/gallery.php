
<style>
#deros_classes_galleries_list
{
	padding:0;
	margin: 10px 16px;
	list-style:none;
}
#deros_classes_galleries_list li
{
	width:220px;
	height:168px;
	margin:5px;
	position:relative;
}
#deros_classes_galleries_list li .image
{
	z-index:9;
}
#deros_classes_galleries_list li .image,#deros_classes_galleries_list li .image img
{
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
}
#deros_classes_galleries_list li .text_wrapper
{
	width:100%;
	position:absolute;
	bottom:0px;
	z-index:99;
}
.title_wrapper_padding
{
	  padding: 0px 15px;
}
</style>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){	
	$("a[rel^='prettyPhoto']").prettyPhoto(
	{
		social_tools : false,
		deeplinking:false,
		show_title:false
	});
	
});
</script>
<ul id="deros_classes_galleries_list" class="gallery_list_of_deros">
<?php
if(!$inner_gallery_flag)
$show_gallries = $this->cookingclassmodel->get_lessons_galleries();
if($inner_gallery_flag)
$show_gallries = $this->cookingclassmodel->get_gallery_images($val_2);
for($i=0;$i<sizeof($show_gallries);$i++):

	$id = $inner_gallery_flag ? $show_gallries[$i]['cooking_classes_gallery_images_ID'] : $show_gallries[$i]['cooking_classes_gallery_ID'];
	$title = $inner_gallery_flag ? "" :  $show_gallries[$i]['cooking_classes_gallery_title'.$current_language_db_prefix];
	$get_gallery_image_url = base_url().'uploads/cooking_classes/';
	$image = $get_gallery_image_url.$show_gallries[$i]['images_src'];
	$rel_hook = $inner_gallery_flag ? 'rel="prettyPhoto[gallery3]"' : '';
	$url = $inner_gallery_flag ? $image : site_url("best_cook/applications/2/inner_gallery/".$id);
	
?>
	<li class="float_left">
    <a href="<?php echo $url; ?>" <?php echo $rel_hook; ?>  >
    <div class="image">
    <img style="border:none;" src="<?php echo $image ?>" width="220" height="168" />
    </div><!-- End of image -->
    <?php
	if(!$inner_gallery_flag):
	?>
    <div class="text_wrapper global_background">
    	<div class="title_wrapper_padding"><h3><?php echo $title; ?></h3></div>
    </div><!-- End of text_wrapper -->
    <?php
	endif;
	?>
    </a>
    </li>
<?php

endfor;
?>
</ul>

<div class="clear"></div>