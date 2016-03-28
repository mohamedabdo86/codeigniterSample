<div class="row">
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
	//$rel_hook = $inner_gallery_flag ? 'rel="prettyPhoto[gallery3]"' : '';
	$url = $inner_gallery_flag ? $image : site_url("mobile/best_cook/applications/2/inner_gallery/".$id);
	
?>

<?php if(!$inner_gallery_flag):?>

<div class="swiper-slide">
           <div class="inner-slider-container">
            <div class="single-product col-xs-12  col-sm-12 col-md-6">
                <div id="single-product-header">
                     <a href="<?php echo $url ?>" rel="external"><h5><?php echo $title;?></h5></a>
                </div>
                <div id="single-product-img"> 
                 <a href="<?php echo $url;?>" title="<?php echo $title; ?>"  rel="external"><img src="<?php echo $image; ?>" title="<?php echo $title;?>" alt="<?php echo $title;?>" class="img-responsive" width="100%;"/></a>
                </div>
            </div>
          </div>
</div>
<?php
	endif;
?>


<?php if($inner_gallery_flag):?>

            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4" style="margin-bottom: 15px;">
                 <div>
                 <a href="<?php echo $image;?>" data-fancybox-group="gallery" class="fancybox" title="<?php echo $title; ?>"  rel="external"><img src="<?php echo $image; ?>" title="<?php echo $title;?>" alt="<?php echo $title;?>" class="img-responsive" width="100%;"/></a>
                 </div>
            </div>
<?php
	endif;
?>


<?php

endfor;
?>
</div>