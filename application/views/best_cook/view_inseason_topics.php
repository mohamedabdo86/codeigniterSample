
<?php
if($flag == 1)
{
	$numrows_current_inseason = count($display_current_inseason_topics);
	
	if($numrows_current_inseason  >= 3):
		?>
		<script type="text/javascript">
			jQuery(function(){
				
				jQuery(".recent_items_list").jCarouselLite({
					btnNext: ".recentitem_prev",
					btnPrev: ".recentitem_next",
					visible:3,
				});
		
			});
		</script>        
        <?php
	endif;
}

?>


<div class="clear"></div>
<?php echo $this->load->view('template/submenu_writer');   ?>
<?php echo $this->load->view('template/tree_menu_writer');   ?>

<style>
.recent_items_list ul li
{
	width:290px !important;
	height:220px !important;
}
</style>

<div class="clear"></div>

<div class="inner_title_wrapper">

<div class="sections_wrapper_margin">
<h1 class="best_cook_color"><?php echo $subsection_title; ?></h1>
</div>


</div><!-- End of inner_title_wrapper -->
<div class="thick_line best_cook_background_color"></div>


<?php
if($flag == 1):


?>
    <div class="topics_list_wrapper global_background" >
    
        <div class="sections_wrapper_margin" style="padding-top: 10px;" >
        <?php if($numrows_current_inseason  >= 3):?>
        
            <a class="recentitem_prev float_right" style="cursor:pointer"><img src="<?php echo base_url()?>images/bestcook/right_arrow_medium.png" /></a>
            <a class="recentitem_next float_left" style="cursor:pointer"><img src="<?php echo base_url()?>images/bestcook/left_arrow_medium.png" /></a>
		
		<?php endif;?>
             <div class="recent_items_list">
            <ul>
            <?php
            
            for($i=0 ; $i < sizeof($display_current_inseason_topics) ; $i ++):
			
			$id = $display_current_inseason_topics[$i]['inseason_recipies_ID'];

			$title = $display_current_inseason_topics[$i]['inseason_recipies_title'.$current_language_db_prefix];
			
			$short_title = $this->common->limit_text($title , 50);

			//Get Random images from current inseason topics
			$get_random_recipes_image = $this->recipesmodel->get_random_recipes_images($id);
			if(isset($get_random_recipes_image))
			{
				$image = $this->config->item('recipes_img_link')."thumb_".$get_random_recipes_image;
			}
			else
			{
				$image  = base_url()."uploads/recipes/thumb_".$display_all_topics[$i]['images_src'];
			}
			
			$url = site_url($this->router->class."/".$this->router->method."/". $display_current_inseason_topics[$i]['inseason_recipies_ID']);
            
             
            
            ?>
                <li class="float_left" style="height:220px;">
                <div class="image global_sperator_margin_bottom"><a href="<?php echo $url ?>" title="<?php echo $title;?>"><img src="<?php echo $image;?>" alt="<?php echo $title?>"  ></a></div>
                <div class="title float_left dark_gray">
                    <div style="margin:0 5px;"><a href="<?php echo $url ?>"><?php echo $short_title;?></a></div>
                </div>
               
                <div class="clear"></div>
                </li>
            <?php
            endfor;
            ?>
     
            </ul>
    
        </div><!--- End of recent_items_list -->
    
    </div><!-- End of sections_wrapper_margin -->
    
    </div><!-- End of topics_list_wrapper -->
<div class="clear"></div>
<div class="various_title_videos <?php echo $current_section_background_color ?>" style="height:40px; background:#e82327; position:relative;width: 105%;margin-left: -25px;">
	<div class="sections_wrapper_margin">
		<div class="title float_left" style="color: white;font-size: 24px;"><?php echo lang('bestcook_all_seasons');?></div>
    </div>
    <img width="26" style="position:absolute; left:0; top:40px;" src="<?php echo base_url(); ?>images/left_shadow.png"/>
    <img width="26" style="position:absolute; right:0; top:40px;" src="<?php echo base_url(); ?>images/right_shadow.png"/>
</div>
<?php
endif;
?>

<div class="clear"></div>
<div class="container_pagination_wrapper_12_items global_background" style="margin-top:<?php echo ($flag == 1 ? "-5px" : "0") ?>" >
<div class="clear"></div>
<ul class="lists_of_image_grids li_third content">

<?php
for($i=0 ; $i < sizeof($display_all_topics) ; $i ++):

$id = $display_all_topics[$i]['inseason_recipies_ID'];
$title = $display_all_topics[$i]['inseason_recipies_title'.$current_language_db_prefix];
$short_title = $this->common->limit_text($title , 50);

$get_random_recipes_image = $this->recipesmodel->get_random_recipes_images($id);
if(isset($get_random_recipes_image))
{
	$image = $this->config->item('recipes_img_link')."thumb_".$get_random_recipes_image;
}
else
{
	$image  = base_url()."uploads/recipes/thumb_".$display_all_topics[$i]['images_src'];
}


$url = site_url($this->router->class."/".$this->router->method."/". $display_all_topics[$i]['inseason_recipies_ID']);



?>


<li class="float_left">

<div class="image" style="height:166px; "><a href="<?php echo $url;?>" title="<?php echo $title;?>"><img src="<?php echo $image; ?>" alt="<?php echo $title?>" /></a></div>
<div class="title float_left dark_gray" style="position: absolute;
top: 132px;">
    <div style="margin:0 5px;"><a href="<?php echo $url ?>"><?php echo $short_title;?></a></div>
</div>
</li>

<?php
endfor;
?>

<div class="clear"></div>

</ul>

<div class="clear"></div>

<div class="page_navigation"></div>


</div><!-- End of container_pagination_wrapper -->
<div class="clear"></div>

<div class="advertising" style="margin-top:12px;">
	<a href="<?php  echo site_url('best_cook/applications/1');?>">
	<img src="<?php echo base_url()."images/flyer".$current_language_db_prefix.".png";?>" />
    </a>
</div>

<div class="clear"></div>