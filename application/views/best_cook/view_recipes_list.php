<div class="clear"></div>
<?php echo $this->load->view('template/submenu_writer');   ?>
<?php echo $this->load->view('template/tree_menu_writer');   ?>

<div class="clear"></div>

<div class="inner_title_wrapper">
    <div class="sections_wrapper_margin">
    	<h1 class="best_cook_color"><?php echo $this->headers->get_third_title() ?></h1>
    </div>
</div><!-- End of inner_title_wrapper -->

<div class="thick_line best_cook_background_color"></div>
<div class="container_pagination_wrapper_12_items global_background" >

<ul class="lists_of_image_desc content">

<?php

//Fix for the lists in order to apply both members and admin members in one lists
$id_column = $members_list_flag ? "members_recipes_ID" : "recipes_ID";
$title_column = $members_list_flag ? "members_recipes_name" : 'recipes_title'.$current_language_db_prefix;
$view_column = $members_list_flag ? "members_recipes_views" : "recipes_views";
$image_url =  $members_list_flag ?  $this->config->item('users_recipes_img_link') : $this->config->item('recipes_img_link');
$table_name_for_rate  = $members_list_flag ? "members_recipes" : "recipes";
$inner_recipe_method = $members_list_flag ? "your_recipes" : "delicious_recipes";


for($i=0 ; $i < sizeof($display_data) ; $i++):

$id =$display_data[$i][$id_column];
$title = $display_data[$i][$title_column];
$short_title = $this->common->limit_text($title, 40);

$image  = $display_data[$i]['images_src'] == "logo.png" ? base_url()."uploads/recipes/image_not_available".$current_language_db_prefix.".png" :   $image_url.$this->config->item('image_prefix').$display_data[$i]['images_src'];

$views = $display_data[$i][$view_column];
//Related is for inseason recipes and healthy recipes
//it change the related recipes on the left sidebar
if($related) {
	$url = site_url($this->router->class."/".$inner_recipe_method."/".generateSeotitle($id ,$title )."".$related);
} else {
	$url = site_url($this->router->class."/".$inner_recipe_method."".generateSeotitle($id ,$title ));
}

$share_image = base_url()."images/share_image.png";
$member_name = "";
if($members_list_flag)
$member_name = $this->members->get_member_name_by_id($display_data[$i]['members_recipes_members_id']);
?>


<li class="float_left">
	<a href="<?php echo $url ?>" title="<?php  echo $title?>">
		<img class="image" width="216" height="168" alt="<?php  echo $title?>" src="<?php echo $image; ?>" />
	</a>
    <div class="rating_wrapper_container">
       <div class="rating float_right" style="width: 90px; margin:5px 0">
        <?php
            $params = array('table'=>$table_name_for_rate,'foreign_id'=>$id);
            echo $this->rate->get_recipe_rate($params); 
        ?>
        </div><!--End Of Rating-->
    
        <span style="line-height: 29px;font-size: 12px;" class="dark_gray float_left" ><?php echo lang('globals_views'). " ( ".$views." ) ";?></span>
        <div class="clear"></div>
    </div><!--End Of .social_wrapper_contanier-->


	<div class="clear"></div>
    <a href="<?php echo $url ?>">
    	<div class="desc"><div style="padding:0px;"><h3 class="dark_gray" style="white-space:normal;"><?php echo $short_title; ?></h3><h4 class="best_cook_color global_sperator_margin_top"><?php echo $member_name ?></h4></div></div>
    </a>
</li>

<?php
endfor;
?>

</ul>

<div class="clear"></div>

</div><!-- End of container_pagination_wrapper -->

<div class="page_navigation" align="center">
<?php echo  $pagination_links; ?>
</div>


<div class="clear"></div>

<div class="search_block">
<?php 
if(!$advanced_search_flag_hide)
$this->load->view('best_cook/advanced_search_block'); ?>
</div>

<div class="clear"></div>


<div class="advertising" style="margin-top:12px;">
	<a href="<?php echo site_url($this->router->class."/upload_recipe"); ?>"><img style="border:none;" src="<?php echo base_url()."images/eb3ty_image".$current_language_db_prefix.".png";?>" /></a>
</div>

<div class="clear"></div>