
<div class="clear"></div>
<?php echo $this->load->view('template/submenu_writer');   ?>

<?php echo $this->load->view('template/tree_menu_writer');  

if($current_language_db_prefix == "_ar")
{
	$total_rows = $this->common->arabic_numbers($total_rows);
}

 ?>

<div class="clear"></div>

<div class="inner_title_wrapper">


<div class="sections_wrapper_margin">
<h1 class="best_cook_color float_left"><?php echo lang('bestcook_search_results'); ?></h1>
<h1 class="float_right best_cook_color"><?php echo lang('bestcook_total_results')." <span style='letter-spacing: 1px;'>".$total_rows; ?></span></h1>
<div class="clear"></div>
</div>

</div><!-- End of inner_title_wrapper -->

<div class="thick_line best_cook_background_color"></div>

<div class="container_pagination_wrapper_12_items global_background" >




<ul class="lists_of_image_desc content">

<?php

//Fix for the lists in order to apply both members and admin members in one lists
/*$id_column = $members_list_flag ? "members_recipes_ID" : "recipes_ID";
$title_column = $members_list_flag ? "members_recipes_name" : 'recipes_title'.$current_language_db_prefix;
$view_column = $members_list_flag ? "members_recipes_views" : "recipes_views";
$image_url =  $members_list_flag ?  "https://www.mynestle.com.eg/images/Users_Recipes/" : "https://www.mynestle.com.eg/images/Recipes/";
//$view_column = $members_list_flag ? "" : "";
$table_name_for_rate  = $members_list_flag ? "members_recipes" : "recipes";
$inner_recipe_method = $members_list_flag ? "your_recipes" : "delicious_recipes";
*/


$id_column = "id";
$title_column = "title" ;
$title_column_ar = "title_ar" ;

$view_column = "views";
$name_column = "name";
//$view_column = $members_list_flag ? "members_recipes_views" : "recipes_views";
//$image_url =  $members_list_flag ?  "https://www.mynestle.com.eg/images/Users_Recipes/" : "https://www.mynestle.com.eg/images/Recipes/";
//$view_column = $members_list_flag ? "" : "";
//$table_name_for_rate  = $members_list_flag ? "members_recipes" : "recipes";
//$inner_recipe_method = $members_list_flag ? "your_recipes" : "delicious_recipes";



for($i=0 ; $i < sizeof($display_data) ; $i ++):

//$image = base_url()."images/recipes_165.png";
$views = $display_data[$i][$view_column];

//$share_image = base_url()."images/share_image.png";
//$member_name = "";

$id = $display_data[$i][$id_column];

if($display_data[$i]['type_of_recipe'] == "member")
{
	$all_title = $display_data[$i][$title_column];
	$title = $this->common->limit_text($all_title,25);
	$table_name_for_rate = "members_recipes";
	$image_url = "https://www.mynestle.com.eg/images/Users_Recipes/";
	$inner_recipe_method = "your_recipes";
	$member_name = $display_data[$i][$name_column];
}
else
{
	$all_title = $display_data[$i][$title_column];
	$all_title_ar = $display_data[$i][$title_column_ar];
	if($current_language_db_prefix == "_ar")
	{
		$title = $this->common->limit_text($all_title_ar,30);
	}
	else
	{
		$title = $this->common->limit_text($all_title,30);
	}
	
	
	$table_name_for_rate = "recipes";
	$image_url = "https://www.mynestle.com.eg/images/Recipes/";
	//$image_url = base_url()."/uploads/recipes_notworking/";
	$inner_recipe_method = "delicious_recipes";
	$member_name = '';
}

$image  = $display_data[$i]['image'] == "logo.png" ? base_url()."uploads/recipes/image_not_available".$current_language_db_prefix.".png" :  $image_url.$display_data[$i]['image'];
$url = site_url($this->router->class."/".$inner_recipe_method."/".generateSeotitle($id ,$title ));


/*if($members_list_flag)
$member_name = $this->members->get_member_name_by_id($display_data[$i]['members_recipes_members_id']);
*/
?>


<li class="float_left">
<a href="<?php echo $url ?>">
<div class="image" style="background:url(<?php echo $image ?>) #FFF"><?php /*?><img src="<?php echo $image; ?>" /><?php */?></div>
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

</div><!-- End of container_pagination_wrapper -->

<div class="page_navigation" align="center">
<?php echo  $pagination_links; ?>
</div>


<div class="clear"></div>

<div class="search_block">
<?php $this->load->view('best_cook/advanced_search_block'); ?>
</div>

<div class="clear"></div>


<div class="advertising" style="margin-top:12px;">
	<a href="<?php echo site_url($this->router->fetch_class().'/upload_recipe')?>"><img src="<?php echo base_url()."images/eb3ty_image".$current_language_db_prefix.".png";?>" /></a>
</div>



<div class="clear"></div>