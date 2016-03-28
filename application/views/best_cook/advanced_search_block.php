<style>
body.arabic .selectboxit-option
{
	text-align:right;
}
</style>
<div class="form_container" style=" background-image:url(<?php echo base_url()."images/bestcook/advanced_serach_background.jpg"?>);width: 1000px;height: 175px; ">
	<div class="float_right" >

<?php

//Get Dropmenu lists
$dish_options= $this->recipesmodel->get_dishes($current_language_db_prefix , true , lang("bestcook_advancedsearch_dish") );
$cuisine_options= $this->recipesmodel->get_cuisines($current_language_db_prefix , true , lang("bestcook_advancedsearch_cuisines") );
$selection_options= $this->recipesmodel->get_selections($current_language_db_prefix , true , lang("bestcook_advancedsearch_selection"));
$nestle_products_options= $this->recipesmodel->get_recipe_products($current_language_db_prefix , true , lang("bestcook_advancedsearch_nestle_products"));
$duration_options =$this->recipesmodel->get_duration_options(lang("bestcook_advancedsearch_duration"));
$calories_options =$this->recipesmodel->get_calories_options(lang("bestcook_advancedsearch_calories"));

?>
<?php /*

<div class="full_width_graytitlebackground global_sperator_margin_top global_sperator_margin_bottom">

    <div class=" white_background_with_title  float_left ">
    	<div style="margin:9px 5px;line-height: 30px;" class="best_cook_color"><?php echo lang("bestcook_search_recipe_title"); ?></div>
    </div><!-- End of white_background_with_title -->


</div><!-- End of full_width_graytitlebackground -->
*/ ?>

<?php

//Set Values
		$selected_value_of_text = isset ( $_GET['advanced_search_text'] ) ? $_GET['advanced_search_text'] : "";
		$selected_value_of_dish = isset ($_GET['advanced_search_dishes'] ) ? (int)$_GET['advanced_search_dishes'] : "";
		$selected_value_of_cuisines = isset($_GET['advanced_search_cuisines']) ?  (int)$_GET['advanced_search_cuisines'] : "";
		$selected_value_of_nestle_products = isset($_GET['advanced_search_nestle_products']) ? (int)$_GET['advanced_search_nestle_products'] : "";
		$selected_value_of_duration = isset($_GET['advanced_search_duration']) ? (int)$_GET['advanced_search_duration'] : "";
		$selected_value_of_selections = isset($_GET['advanced_search_selections']) ? (int)$_GET['advanced_search_selections'] : "";
		$selected_value_of_calories = isset($_GET['advanced_search_calories'] ) ? (int)$_GET['advanced_search_calories'] : "";
		
		$default_method = "search_results_recipes";
		/*
		$default_method = "search_results";
		if( isset($members_list_flag)  )
		{
			if($members_list_flag)
			{
				$default_method = "search_members_results";
			}
			
		}*/


$attribute['method'] = 'get';
$attribute['style'] = 'height: 130px;padding: 10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;width: 700px;margin: 10px;';

echo form_open($this->router->class."/".$default_method, $attribute);
?>

<div class="search_big_input_wrapper">
<input type="text" name="advanced_search_text" value="<?php echo  $selected_value_of_text ?>" class="search_big_input float_left" placeholder="<?php echo lang("bestcook_search_recipe_placeholder"); ?>" /> 
<input style="width:140px" type="button" class="search_big_button float_right best_cook_background_color white_color" value="<?php echo lang('bestcook_all_recipes'); ?>" onclick="location.href='<?php echo site_url($this->router->class."/delicious_recipes"	) ?>'" />
<div class="float_right" style="width:5px; height:47px"></div>
<input type="submit" class="search_big_button float_right best_cook_background_color white_color" value="<?php echo lang("bestcook_search_recipe_search_button"); ?>" /> 
<div class="clear"></div>
</div><!-- End of search_big_input -->

<div class="global_sperator_height" style="width:100%;"></div>

<!-- Advanced Search Start -->
    <div class="float_left advanced_search_dropmenu_wrapper">
    <div class="float_left" style="width:5%; height:47px;"></div>
    <div class="float_left" style="width:15%;" >
    <img height="30" class="float_left" src="<?php echo base_url()."images/bestcook/best_cook_search_the_type.png" ?>" />
    </div>

   <!-- <select class="best_cook_search_styled_select_box float_left" style="width:80%;">
    <option>الطبق</option>
    </select>-->
    
    <?php
	echo form_dropdown('advanced_search_dishes', $dish_options , $selected_value_of_dish , "class='best_cook_search_styled_select_box float_left' style='width:80%' ");
	?>

    </div>
    
    <div class="float_left" style="width:9px; height:32px"></div>
    
    <div class="float_left advanced_search_dropmenu_wrapper">
    <div class="float_left" style="width:5%; height:47px;"></div>
    <div class="float_left" style="width:15%;" >
    <img height="30" class="float_left" src="<?php echo base_url()."images/bestcook/best_cook_search_the_kitchen.png" ?>" />
    </div>

<!--    <select class="best_cook_search_styled_select_box float_left" style="width:80%;">
    <option>المطبخ</option>
    </select>-->
    
     <?php
	echo form_dropdown('advanced_search_cuisines', $cuisine_options , $selected_value_of_cuisines , "class='best_cook_search_styled_select_box float_left' style='width:80%' ");
	?>

    </div>
    
    
    <div class="float_left" style="width:10px; height:32px"></div>
    
    <div class="float_left advanced_search_dropmenu_wrapper">
    <div class="float_left" style="width:5%; height:47px;"></div>
    <div class="float_left" style="width:15%;" >
    <img height="30" class="float_left" src="<?php echo base_url()."images/bestcook/best_cook_search_nestle_products.png" ?>" />
    </div>

    <!--<select class="best_cook_search_styled_select_box float_left" style="width:80%;">
    <option>منتجات نستلة</option>
    </select>-->
    
     <?php
	echo form_dropdown('advanced_search_nestle_products', $nestle_products_options , $selected_value_of_nestle_products , "class='best_cook_search_styled_select_box float_left' style='width:80%' ");
	?>

    </div>
    
    <div class="clear"></div>
    
    <div class="global_sperator_height" style="width:100%;"></div>
    
    <div class="float_left advanced_search_dropmenu_wrapper">
    <div class="float_left" style="width:5%; height:47px;"></div>
    <div class="float_left" style="width:15%;" >
    <img height="30" class="float_left" src="<?php echo base_url()."images/bestcook/best_cook_search_duration.png" ?>" />
    </div>

 <!--   <select class="best_cook_search_styled_select_box float_left" style="width:80%;">
    <option>وقت الطهي</option>
    </select>-->
    
    <?php
	echo form_dropdown('advanced_search_duration', $duration_options , $selected_value_of_duration, "class='best_cook_search_styled_select_box float_left' style='width:80%' ");
	?>

    </div>
    
    <div class="float_left" style="width:9px; height:32px"></div>
    
    <div class="float_left advanced_search_dropmenu_wrapper">
    <div class="float_left" style="width:5%; height:47px;"></div>
    <div class="float_left" style="width:20%;" >
    <img height="30" class="float_left" src="<?php echo base_url()."images/bestcook/best_cook_search_mokwnat.png" ?>" />
    </div>

   <!-- <select class="best_cook_search_styled_select_box float_left" style="width:75%;">
    <option>المكونات الأساسية</option>
    </select>-->
    
    <?php
	echo form_dropdown('advanced_search_selections', $selection_options , $selected_value_of_selections , "class='best_cook_search_styled_select_box float_left' style='width:75%' ");
	?>
    

    </div>
    
    
    <div class="float_left" style="width:10px; height:32px"></div>
    
    <div class="float_left advanced_search_dropmenu_wrapper">
    <div class="float_left" style="width:5%; height:47px;"></div>
    <div class="float_left" style="width:15%;" >
    <img height="30" class="float_left" src="<?php echo base_url()."images/bestcook/best_cook_search_calories.png" ?>" />
    </div>

 <!--   <select class="best_cook_search_styled_select_box float_left" style="width:80%;">
    <option>السعرات</option>
    </select>-->
    
     <?php
	echo form_dropdown('advanced_search_calories', $calories_options , $selected_value_of_calories , "class='best_cook_search_styled_select_box float_left' style='width:80%' ");
	?>


    </div>
    <?php
	echo form_close();
	?>
<!-- Advanced Search End   -->

<div class="clear"></div>
    </div>
    <div class="float_left" style="position:relative">
	    <img style="position: absolute;top: 17px;}" src="<?php echo base_url()."images/bestcook/hatkly_eh_enhrda{$current_language_db_prefix}.png"  ?>"/>
        <img src="<?php echo base_url()."images/bestcook/vegetables_bg.png"  ?>"/>
    </div>
</div>
