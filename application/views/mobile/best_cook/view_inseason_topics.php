<style>
.thick_line {
	width: 100%;
	height: 4px;
}
.img_recipe_list {
	width: 100%;
	/*height: 200px;*/
}
.arabic .text_title_recipe {
	font-size: 11px;
	width: 221px;
	float: right;
	width: 100%;
	line-height: 25px;
}
.english .text_title_recipe {
	float: left;
	font-size: 13px;
	width: 100%;
	margin-top: 7px;
	line-height: 25px;
}
.allviews {
	line-height: 29px;
	font-size: 12px;
}
 @media (min-width: 320px) and (max-width: 420px) {
.img_recipe_list {
	width: 100%;/*height:110px;*/
}
.mob-list-recipe-item {
	width: 100%;
	clear: both;
}
@media (min-width: 421px) and (max-width: 800px) {
 .img_recipe_list {
 width:100%;
 height:165px;
}
}
 @media (min-width: 801px) and (max-width: 990px) {
.img_recipe_list {
	width: 100%;
	height: 165px;
}
/*.english .text_title_recipe {
	font-size: 13px;
	margin-top: 7px;
}
.arabic .text_title_recipe {
	font-size: 11px;
	width: 221px;
}*/
}
 @media (min-width: 991px) and (max-width: 1200px) {
/*.english .text_title_recipe {
	float: left;
	font-size: 13px;
	width: 64%;
	margin-top: 7px;
}*/
}
@media (min-width: 768px) and (max-width: 854px) {
/*.english .text_title_recipe {
	font-size: 13px;
	width: 64%;
	margin-top: 7px;
}
.arabic .text_title_recipe {
	font-size: 11px;
	width: 221px;
	width: 64%;
}*/
}
@media (max-width: 653px) {
/*.english .text_title_recipe {
	float: left;
	font-size: 13px;
	width: 55%;
	margin-top: 7px;
}
.arabic .text_title_recipe {
	font-size: 11px;
	width: 221px;
	float: right;
	width: 55%;
}*/
.allviews {
	line-height: 29px;
	font-size: 11px;
}
}
@media (min-width: 360px) {
/*.arabic .text_title_recipe {
	font-size: 9px;
	width: 221px;
	float: right;
	width: 48%;
}*/
.allviews {
	line-height: 29px;
	font-size: 9px;
}
}
</style>

<div class="row <?php echo $current_section; ?>">
  <div class="col-xs-12">
    <?php   echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png" , site_url_mobile(''.$this->router->class));?>
    <?php 
		          echo $this->mwidgets->drawCurrentSubSectionHomepageTitle($display_data[0]['sub_sections_name'.$current_language_db_prefix], lang("globals_back"), "#");
				  ?>
    <div id="related-recipe-header">
      <h1 class="<?php echo $current_section; ?>" ><?php echo $this->headers->get_third_title() ?></h1>
    </div>
    <div class="thick_line"></div>
  </div>
  <?php





/*
--------------------------------------------------------------------
-----------------------  Dispaly All Topics ------------------------
--------------------------------------------------------------------
*/


	for($i=0 ; $i < sizeof($display_current_inseason_topics) ; $i ++)
	{
		$title = $display_current_inseason_topics[$i]['inseason_recipies_title'.$current_language_db_prefix];
			
			$short_title = substr(strip_tags($title), 0, 50). (strlen(strip_tags($title)) > 50?'...':'');
			
			$image  = base_url()."uploads/recipes/thumb_".$display_current_inseason_topics[$i]['images_src'];
			
			$url = site_url_mobile($this->router->class."/".$this->router->method."/". $display_current_inseason_topics[$i]['inseason_recipies_ID']);
		
		$share_image = base_url()."images/share_image.png";
		$member_name = "";
		if($members_list_flag)
			$member_name = $this->members->get_member_name_by_id($display_data[$i]['members_recipes_members_id']);
?>
  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"> <a href="<?php echo $url ?>" title="<?php  echo $title?>" rel="external"> <img class="img-responsive img_recipe_list" alt="<?php  echo $title?>" src="<?php echo $image; ?>" /> </a> <a href="<?php echo $url ?>" rel="external">
    <h3 class="text_title_recipe"><?php echo $short_title; ?></h3>
    </a> </div>
  <?php }



/*
--------------------------------------------------------------------
-----------------------  Dispaly All Topics ------------------------
--------------------------------------------------------------------
*/


	for($i=0 ; $i < sizeof($display_all_topics) ; $i ++)
	{
		$id =$display_data[$i][$id_column];
		$title = $display_all_topics[$i]['inseason_recipies_title'.$current_language_db_prefix];

$short_title = substr(strip_tags($title), 0, 50). (strlen(strip_tags($title)) > 50?'...':'');

$image  = base_url()."uploads/recipes/thumb_".$display_all_topics[$i]['images_src'];

$url = site_url_mobile($this->router->class."/".$this->router->method."/". $display_all_topics[$i]['inseason_recipies_ID']);

		
		$share_image = base_url()."images/share_image.png";
		$member_name = "";
		if($members_list_flag)
			$member_name = $this->members->get_member_name_by_id($display_data[$i]['members_recipes_members_id']);
?>
  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"> <a href="<?php echo $url ?>" title="<?php  echo $title?>" rel="external"> <img class="img-responsive img_recipe_list" alt="<?php  echo $title?>" src="<?php echo $image; ?>" /> </a> <a href="<?php echo $url ?>" rel="external">
    <h3 class="text_title_recipe"><?php echo $short_title; ?></h3>
    </a> </div>
  <?php } ?>
</div>
