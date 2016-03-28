<?php
$get_last_lessons = $this->cookingclassmodel->get_last_lessons();
?>

<script>
jQuery(function(){
<?php
	if($current_language_db_prefix == "_ar")
	{
	?>
	jQuery(".latest_recipes_wrapper_list").jCarouselLite({
		btnNext: "#latest_recipes_wrapper_list_next",
		btnPrev: "#latest_recipes_wrapper_list_prev",
		visible:3,
		circular: false,
		 
	});
	
	$('#latest_recipes_wrapper_list_prev').addClass('disabled');
	<?php
		if(sizeof($get_last_lessons) <= 3 )
		{
			?>
			$('#latest_recipes_wrapper_list_next').addClass('disabled');
			<?php
		}
	
	}
	else
	{
	?>
	jQuery(".latest_recipes_wrapper_list").jCarouselLite({
		btnNext: "#latest_recipes_wrapper_list_prev",
		btnPrev: "#latest_recipes_wrapper_list_next",
		visible:3,
		circular: false,
		 
	});
	
	$('#latest_recipes_wrapper_list_next').addClass('disabled');
	<?php
		if(sizeof($get_last_lessons) <= 3 )
		{
			?>
			$('#latest_recipes_wrapper_list_prev').addClass('disabled');
			<?php
		}
	}
	?>
	
	$('#main_slide_show').cycle({  
   	 delay: -3000 
 	});
 
});
</script>
<style>
.image_title_warrper
{
	width: 100%;
	height:43px !important;
	position: absolute;
	bottom: 0px;
	z-index: 99;
	line-height: 35px;
}
.image_title_warrper .sections_wrapper_padding
{
	padding:5px !important;
}
</style>

<div class="global_sperator_height" style="width:100%"></div>
<?php 
$image_url = base_url().'uploads/cooking_classes/';
$recipe_image_url = base_url().'uploads/recipes/';
$main_lesson_image = $this->cookingclassmodel->get_lesson_feature_image();

$month = $main_lesson_image[0]['cooking_classes_month'];

$current_lesson_image = $this->cookingclassmodel->get_current_month_image($month);
$current_month_lesson_image = $image_url.$current_lesson_image[0]['images_src'];



$get_gallery_image = $this->cookingclassmodel->get_random_gallery_images();
$get_gallery_image_url = base_url().'uploads/cooking_classes/';
$gallery_image = $get_gallery_image_url.$get_gallery_image;
?>
<?php /*?>
//Ahmed el bermawy 10/02/2014
<div id="main_slide_show" class="float_left pics">
<?php
for($i =0; $i<sizeof($main_lesson_image);$i++):
$lesson_image = $image_url.$main_lesson_image[$i]['images_src'];
?>
<img height="380" width="460" src="<?php echo $lesson_image; ?>" alt="lesson image" />
<?php
endfor;
?>

</div><!-- End of main_slide_show --><?php */?>

<div id="main_slide_show" class="float_left pics">
<?php
if($current_language_db_prefix == "_ar")
{
	echo '<img height="380" width="460" src="'.$image_url.'ashter_tba5a_ar.png" alt="lesson image" />';
}
else
{
	echo '<img height="380" width="460" src="'.$image_url.'ashter_tba5a.png" alt="lesson image" />';
}

?>

</div><!-- End of main_slide_show -->

<div id="buttons_wrapper" class="float_right">

	<div id="first_row">
    	<div class="button_image float_left"><a href="<?php echo site_url('best_cook/applications/2/current_class'); ?>" title="<?php echo lang('dros_el_tab5_month_lesson'); ?>" ><img style="border:none;" height="180" width="235" src="<?php echo $current_month_lesson_image; ?>" alt="<?php echo lang('dros_el_tab5_month_lesson'); ?>" /></a>
        	<div class="title_wrapper global_background">
	            <div class="sections_wrapper_padding">
    			<a href="<?php echo site_url('best_cook/applications/2/current_class'); ?>"><h4><?php echo lang('dros_el_tab5_month_lesson'); ?></h4></a>
         		</div>
	        </div>
        </div><!-- End of button_image  -->
        <div class="button_image float_right"><a href="<?php echo site_url('best_cook/applications/2/gallery'); ?>" title="<?php echo lang('dros_el_tab5_lesson_gallery'); ?>"><img style="border:none;" height="180" width="235" src="<?php echo $gallery_image; ?>" alt="<?php echo lang('dros_el_tab5_lesson_gallery'); ?>" /></a>
        	<div class="title_wrapper global_background">
	            <div class="sections_wrapper_padding">
    			<a href="<?php echo site_url('best_cook/applications/2/gallery'); ?>" ><h4><?php echo lang('dros_el_tab5_lesson_gallery'); ?></h4></a>
         		</div>
	        </div>
        </div><!-- End of button_image  -->
    </div><!-- End of buttons_wrapper -->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <div id="second_row">
    	<div class="sections_wrapper_padding">
    		<h3 style="line-height: 28px;" class="<?php echo $current_section_color; ?>"><?php echo lang('dros_el_tab5_latest_recipes_lessons'); ?></h3>
         </div>
        <div class="thick_line <?php echo $current_section_background_color; ?>" style="margin-top:0px; margin-bottom:0px;"></div>
        
        <div class="latest_recipes_wrapper">
        <a id="latest_recipes_wrapper_list_prev"   ><img src="<?php echo base_url(); ?>images/bestcook/right_arrow_medium.png" height="15" /></a>
        <a id="latest_recipes_wrapper_list_next"   ><img src="<?php echo base_url(); ?>images/bestcook/left_arrow_medium.png" height="15" /></a>
        <div class="latest_recipes_wrapper_list float_left">
        	
            <ul>
            <?php if($get_last_lessons){?>
            <?php for($i=0; $i<sizeof($get_last_lessons); $i++): 
			$get_lessons_imge = $this->cookingclassmodel->get_random_cooking_class_recipe_images($get_last_lessons[$i]['cooking_classes_ID']);
					$recipe_image = $recipe_image_url.$get_lessons_imge;
					$url = site_url('best_cook/applications/2/current_class/'.$get_last_lessons[$i]['cooking_classes_month'].'');
					$title = $get_last_lessons[$i]['cooking_classes_title'.$current_language_db_prefix];
					$short_text = $this->common->limit_text($title , 30);
			?>
                <li style="position:relative">
                	<a title="<?php echo $title; ?>" href="<?php echo $url; ?>"><img style="border:none;" height="135" width="135" class="rounded_border" src="<?php echo $recipe_image; ?>" title="<?php echo $title;?>" alt="<?php echo $title;?>"></a>
                    <div class="image_title_warrper global_background">
                        <div class="sections_wrapper_padding">
                        <a href="<?php echo $url ?>" ><h4 class="dir" style="white-space: normal;"><?php echo $short_text; ?></h4></a>
                        </div>
                    </div>
                </li>
            <?php endfor; ?>
			<?php }?>
            </ul>
        </div><!-- End of latest_recipes_wrapper_list-->
        </div><!-- End of latest_recipes_wrapper -->
    </div><!-- End of second_row -->

</div><!-- End of buttons_wrapper -->


<div class="clear"></div>