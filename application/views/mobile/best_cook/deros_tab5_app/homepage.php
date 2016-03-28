<style>
.swiper-wrapper
{
	height: auto !important;
	width: auto !important;
}
.swiper-slide
{
	height: auto !important;
	width: 50% !important;
}
body.arabic .dir
{
	direction: rtl;
}
body.english .dir
{
	direction: ltr;
}
</style>
<?php
$get_last_lessons = $this->cookingclassmodel->get_last_lessons();
$image_url = base_url().'uploads/cooking_classes/';
$main_lesson_image = $this->cookingclassmodel->get_lesson_feature_image();

$month = $main_lesson_image[0]['cooking_classes_month'];

$current_lesson_image = $this->cookingclassmodel->get_current_month_image($month);
$current_month_lesson_image = $image_url.$current_lesson_image[0]['images_src'];



$get_gallery_image = $this->cookingclassmodel->get_random_gallery_images();
$get_gallery_image_url = base_url().'uploads/cooking_classes/';
$gallery_image = $get_gallery_image_url.$get_gallery_image;
?>

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
    <?php
if($current_language_db_prefix == "_ar")
{
	echo '<img style="width:100%;" src="'.$image_url.'taba5a-mobile.jpg" alt="lesson image" class="img-responsive"/>';
}
else
{
	echo '<img style="width:100%;" src="'.$image_url.'taba5a-mobile-en.jpg" alt="lesson image" class="img-responsive"/>';
}

?>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12" style="height:5px; background-color:red; margin-top:10px;"></div>
  <div class="single-product col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div id="single-product-header"><a rel="external" href="<?php echo site_url('mobile/best_cook/applications/2/current_class'); ?>">
      <h4><?php echo lang('dros_el_tab5_month_lesson'); ?></h4>
      </a></div>
    <div id="single-product-img"><a href="<?php echo site_url('mobile/best_cook/applications/2/current_class'); ?>"  rel="external" title="<?php echo lang('dros_el_tab5_month_lesson'); ?>" ><img class="img-responsive img-height"  style="border:none; width:100%;" src="<?php echo $current_month_lesson_image; ?>" alt="<?php echo lang('dros_el_tab5_month_lesson'); ?>" /></a></div>
  </div>
  <div class="single-product col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div id="single-product-header"><a href="<?php echo site_url('mobile/best_cook/applications/2/gallery'); ?>" >
      <h4><?php echo lang('dros_el_tab5_lesson_gallery'); ?></h4>
      </a></div>
    <div id="single-product-img"><a href="<?php echo site_url('mobile/best_cook/applications/2/gallery'); ?>" rel="external" title="<?php echo lang('dros_el_tab5_lesson_gallery'); ?>"><img style="border:none;width:100%;" class="img-responsive img-height" src="<?php echo $gallery_image; ?>" alt="<?php echo lang('dros_el_tab5_lesson_gallery'); ?>" /></a></div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <h2><?php echo lang('dros_el_tab5_latest_recipes_lessons'); ?></h2>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-12" style="height:5px; background-color:red; margin-top:10px;"></div>
  
  
  <?php if($get_last_lessons){?>
    <div class="swiper-container">
                <div class="swiper-wrapper">
  <?php for($i=0; $i<sizeof($get_last_lessons); $i++): 
					$recipe_image = $image_url.$get_last_lessons[$i]['images_src'];
					$url = site_url('mobile/best_cook/applications/2/cooking_class/'.$get_last_lessons[$i]['cooking_classes_month'].'');
					$title = $get_last_lessons[$i]['cooking_classes_title'.$current_language_db_prefix];
					$short_text = $this->common->limit_text($title , 15);
			?>
  <div class="swiper-slide col-xs-6 col-sm-6 col-md-6">
    <div class="inner-slider-container">
      <div class="single-product">
        <div id="single-product-header"> 
           <a href="<?php echo $url ?>" rel="external">
             <h5 class="dir"><?php echo $this->common->limit_text($short_text,30) ; ?></h5>
           </a>  
         </div>
        <div id="single-product-img"> <a href="<?php echo $url;?>" title="<?php echo $title; ?>"  rel="external"><img src="<?php echo $recipe_image; ?>" title="<?php echo $title;?>" alt="<?php echo $title;?>" class="img-responsive img-height" width="100%;"/></a> </div>
      </div>
    </div>
  </div>
  <?php endfor; ?>
  </div>
  </div>
  <?php }?>
</div>
