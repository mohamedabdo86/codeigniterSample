
          <div id="related-recipe-header">
                <h1>وصفات تناسب إختيارك</h1>
            </div>
            <div class="all-recipe">
                <?php for ($i = 0; $i < 6; $i++) { ?>

                    <div class="col-xs-6 col-sm-6 col-md-4">
                        <img src="../../../../mobile/images/recipe-demo.png" width="100%" class="img-responsive related-recipe-img" />
                        <h3> بيكاتا بالمشروم والخضروات</h3>
                    </div>
                <?php } ?>
            </div>
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
//$image_url = base_url()."/uploads/recipes_notworking/";
//$view_column = $members_list_flag ? "" : "";
$table_name_for_rate  = $members_list_flag ? "members_recipes" : "recipes";
$inner_recipe_method = $members_list_flag ? "your_recipes" : "delicious_recipes";



for($i=0 ; $i < sizeof($display_data) ; $i ++):
$id =$display_data[$i][$id_column];
$title = $display_data[$i][$title_column];
//$image = base_url()."images/recipes_165.png";
$image  = $display_data[$i]['images_src'] == "logo.png" ? base_url()."uploads/recipes/image_not_available".$current_language_db_prefix.".png" :   $image_url.$display_data[$i]['images_src'];
 

$views = $display_data[$i][$view_column];
$url = site_url($this->router->class."/".$inner_recipe_method."/".generateSeotitle($id ,$title ));
$share_image = base_url()."images/share_image.png";
$member_name = "";
if($members_list_flag)
$member_name = $this->members->get_member_name_by_id($display_data[$i]['members_recipes_members_id']);
?>


<li class="float_left">
<a href="<?php echo $url ?>" title="<?php  echo $title?>">
<div class="image" style="background:url(<?php echo str_replace(' ', '%20', $image); ?>) #FFF"><?php /*?><img src="<?php echo $image; ?>" /><?php */?></div>
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
<div class="desc"><div style="padding:0px;"><h3 class="dark_gray" style="white-space:normal;"><?php echo $title; ?></h3><h4 class="best_cook_color global_sperator_margin_top"><?php echo $member_name ?></h4></div></div>
</a>
</li>

<?php
endfor;
?>

</ul>

<div class="clear"></div>

<?php
/*Makki version*/
//$this->load->library('pagination');

/*
Bermawy Version
$config['base_url'] = site_url($this->router->class."/".$this->router->method);
$config['total_rows'] = "200";
$config['per_page'] = "20"; 

$this->ajax_pagination->initialize($config); 

echo $this->ajax_pagination->create_links();
*/

?>


</div><!-- End of container_pagination_wrapper -->

