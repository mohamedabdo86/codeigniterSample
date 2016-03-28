<script>
jQuery(function(){
	jQuery(".recent_items_list").jCarouselLite({
		btnNext: ".recentitem_prev",
		btnPrev: ".recentitem_next",
		visible:4
	});
});
</script>

<div class="recent_items_list_wrapper" style="height:270px; background-color:#fff;">

    <div class="sections_wrapper_margin" style="padding-top: 10px;" >
    
        <a class="recentitem_prev float_right" style="cursor:pointer"><img src="<?php echo base_url()?>images/icons/right_arrow.png" /></a>
        <a class="recentitem_next float_left" style="cursor:pointer"><img src="<?php echo base_url()?>images/icons/left_arrow.png" /></a>
        <div class="recent_items_list">
        <ul>
        <?php
		//Fix for the lists in order to apply both members and admin members in one lists
		$id_column = $members_list_flag ? "members_recipes_ID" : "recipes_ID";
		$title_column = $members_list_flag ? "members_recipes_name" : 'recipes_title'.$current_language_db_prefix;
		$view_column = $members_list_flag ? "members_recipes_views" : "recipes_views";
		$image_url =  $members_list_flag ?  "https://www.mynestle.com.eg/images/Users_Recipes/" : "https://www.mynestle.com.eg/images/Recipes/";
		//$view_column = $members_list_flag ? "" : "";
		$table_name_for_rate  = $members_list_flag ? "members_recipes" : "recipes";
		$inner_recipe_method = $members_list_flag ? "your_recipes" : "delicious_recipes";
		for($i=0 ; $i < sizeof($display_recent_data); $i++):
		$id =$display_recent_data[$i][$id_column];
		$title = $display_recent_data[$i][$title_column];
		//$image = base_url()."images/recipes_165.png";
		//$image  = $image_url.$display_recent_data[$i]['images_src'];
		$image  = $display_recent_data[$i]['images_src'] == "logo.png" ? base_url()."uploads/recipes/image_not_available".$current_language_db_prefix.".png" :  $image_url.$display_recent_data[$i]['images_src'];

		$views = $display_recent_data[$i][$view_column];
		$url = site_url($this->router->class."/".$inner_recipe_method."/".generateSeotitle($id ,$title ));
		$share_image = base_url()."images/share_image.png";
		$member_name = "";
		if($members_list_flag)
		$member_name = $this->members->get_member_name_by_id($display_recent_data[$i]['members_recipes_members_id']);

		
		?>
        <li style="height:270px;">
            <div class="image global_sperator_margin_bottom"><a href="<?php echo $url ?>"><img src="<?php echo $image;?>" alt=""  ></a></div>
            <div class="title float_left dark_gray" style="height:auto;"><div style="margin:0px 5px;"><a href="<?php echo $url ?>"><?php echo $title;?><h4 class="best_cook_color global_sperator_margin_top"><?php echo $member_name ?></h4></a></div></div>
            <div class="clear"></div>
        </li>
        <?php
		endfor;
		?>
        </ul>
    
    </div><!--- End of recent_items_list -->

</div><!-- End of sections_wrapper_margin -->

</div><!-- End of recent_items_list_wrapper -->