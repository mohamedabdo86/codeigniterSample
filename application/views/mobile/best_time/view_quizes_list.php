<style>
.thick_line
{
	width: 100%;
  height: 4px;
    background: #13758e;
}
.seperator{
	height:20px;
	}
</style>
<section class="<?php echo $current_section; ?>">
  <div class="thick-line background-color ">&nbsp;</div>
          <?php   echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png" , site_url_mobile(''.$this->router->class));?>
          
          <?php 
		          echo $this->mwidgets->drawCurrentSubSectionHomepageTitle($display_data[0]['sub_sections_name'.$current_language_db_prefix], lang("globals_back"), "#");
				  ?>
<div class="clear"></div>
<div id="related-recipe-header">
	
   <h1> <?php echo $subsection_title; ?></h1>
</div>
 <div class="thick_line <?php echo $current_section; ?>"></div>
<div class="seperator"> </div>
          <div class="all-recipe">
             <?php  for($i=0 ; $i < sizeof($display_data) ; $i ++):?>
             <?php 
             $title = $display_data[$i][$col_name.$current_language_db_prefix];
			  if($current_language_db_prefix == '_ar')
			  {
				  $short_title = $this->common->limit_text($title,28);
			  }
			  else
			  {
				  $short_title = $this->common->limit_text($title,28);
			  }
			  
			  $image  = base_url().$myroot.$display_data[$i]['images_src'];
			  
			  //$url = site_url($this->router->class."/".$this->router->method."/". $display_all_quizes[$i]['quizes_ID']);
			   $url = site_url_mobile($this->router->class."/".$this->router->method."/". ($display_data[$i][$myid]));
			  	//$url = site_url_mobile($this->router->class."/".$this->router->method."/". $display_data[$i]['fashion_ID']);
			  ?>
             
             
<?php //$topic_url_ran = site_url_mobile("best_cook/view_recipe/".$display_related_recipes[$i]['recipes_ID']);?>
<?php //$topic_title_ran = $display_related_recipes[$i]['recipes_title'];?>

                    <div class="col-xs-6 col-sm-6 col-md-4 float_left">

         <a rel="external" href="<?php echo $url; ?>"> <img src="<?php echo $image  ?>" width="100%"  class="img-responsive related-recipe-img img_ran_Size" /></a>
                        <?php echo $short_title;  ?>
                    </div>
                 <?php endfor; ?>
            </div>
            <div class="clear"></div>
