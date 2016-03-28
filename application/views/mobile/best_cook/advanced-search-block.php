<!--Please let SelectBoxIt the last one -->
<!--SelectBoxIt-->
<?php /*?><link href="<?php echo base_url_mobile("../css/jquery.selectBoxIt.css"); ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url_mobile("../js/jquery.selectBoxIt.js"); ?>" type="text/javascript" ></script><?php */?>

<script>
<?php /*?>$(function(){
	$(".best_cook_search_styled_select_box").selectBoxIt();
	$(".selectboxit-arrow-container").addClass("float_right");
});<?php */?>
</script>
<style>
.best_cook_search_styled_select_box {
	padding-top:7px;
}
.ui-input-text {
	margin-right:-3px;
	margin-top: -2px;
	}
	.arabic .input_font{
		/*padding:26px;*/
		text-align: right;
        padding-right: 10px;
		font-size:20px;
		color:#666;
		height:54px;
		
		}
		.english .input_font{
		/*padding:26px;*/
		text-align: ledt;
        padding-left: 10px;
		font-size:20px;
		color:#666;
		height:54px;
		
		}
	.arabic .advanced_search_text{
		padding:30px;
		text-align:right;
		}
		.english .advanced_search_text{
		padding:30px;
		text-align:left;
		}
		.search_big_button {
height: 51px;
line-height: 35px;
font-size: 13px;
cursor: pointer;
padding: 0;
}
@media screen and (min-width: 200px) and (max-width: 640px) {
	.img_icon{
		width:20%;
		}
	.separate_right{
			width:0%;
	}
			
    }
 
@media screen and (min-width: 641px) and (max-width: 990px) {
	.img_icon{
		width:15%;
		}
		.separate_right{
			width:5%;
			}
	}
@media screen and (min-width: 991px) and (max-width: 1500px) {
	.img_icon{
		width:15%;
		}
		.separate_right{
			width:5%;
			}
	}

</style>
<div class="form_container" >
<?php

//Get Dropmenu lists
$dish_options= $this->recipesmodel->get_dishes($current_language_db_prefix , true , lang("bestcook_advancedsearch_dish") );
$cuisine_options= $this->recipesmodel->get_cuisines($current_language_db_prefix , true , lang("bestcook_advancedsearch_cuisines") );
$selection_options= $this->recipesmodel->get_selections($current_language_db_prefix , true , lang("bestcook_advancedsearch_selection"));
$nestle_products_options= $this->recipesmodel->get_recipe_products($current_language_db_prefix , true , lang("bestcook_advancedsearch_nestle_products"));
$duration_options =$this->recipesmodel->get_duration_options(lang("bestcook_advancedsearch_duration"));
$calories_options =$this->recipesmodel->get_calories_options(lang("bestcook_advancedsearch_calories"));

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
		if( isset($members_list_flag)  
		{
			if($members_list_flag)
			{
				$default_method = "search_members_results";
			}
			
		}*/
		
$attribute['method'] = 'get';
$attribute['style'] = 'height: 130px;padding: 10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;margin: 10px;';
$attribute['data-ajax'] = 'false';



echo form_open('mobile/'.$this->router->class."/".$default_method, $attribute);
?>

<div class="search_big_input_wrapper">
<div class=" col-sm-6 col-xs-12 col-md-8 float_left" style="padding:0">
<input type="text" name="advanced_search_text" value="<?php echo  $selected_value_of_text ?>" class="search_big_input input_font" placeholder="<?php echo lang("bestcook_search_recipe_placeholder"); ?>" /> 
 </div>

<input type="button" class="search_big_button float_right background-color white-text-color col-sm-3 col-xs-12 col-md-2" value="<?php echo lang('bestcook_all_recipes'); ?>" onclick="location.href='<?php echo site_url_mobile($this->router->class."/delicious_recipes"	) ?>'" />
<input type="submit" class="search_big_button float_right background-color white-text-color col-sm-3 col-xs-12 col-md-2" value="<?php echo lang("bestcook_search_recipe_search_button"); ?>" /> 
<div class="clear"></div>
</div><!-- End of search_big_input -->


<!-- Advanced Search Start -->
    <div class="float_left advanced_search_dropmenu_wrapper col-sm-6 col-xs-12 col-md-4" style="height:65px;">
    <div class="float_left" style="width:5%; height:47px;"></div>
    <div class="float_left" style="width:15%;" >
    <img height="30" style="margin-top:17px; class="float_left" src="<?php echo base_url()."images/bestcook/best_cook_search_the_type.png" ?>" />
    </div>

   <!-- <select class="best_cook_search_styled_select_box float_left" style="width:80%;">
    <option>الطبق</option>
    </select>-->
    
    <?php
	echo form_dropdown('advanced_search_dishes', $dish_options , $selected_value_of_dish , "class='best_cook_search_styled_select_box float_left'");
	?>

    </div>
    
    <div class="float_left advanced_search_dropmenu_wrapper col-sm-6 col-xs-12 col-md-4" style="height:65px;">
    <div class="float_left" style="width:5%; height:47px;"></div>
    <div class="float_left" style="width:15%;" >
    <img height="30" style="margin-top:17px; class="float_left" src="<?php echo base_url()."images/bestcook/best_cook_search_the_kitchen.png" ?>" />
    </div>

<!--    <select class="best_cook_search_styled_select_box float_left" style="width:80%;">
    <option>المطبخ</option>
    </select>-->
    
     <?php
	echo form_dropdown('advanced_search_cuisines', $cuisine_options , $selected_value_of_cuisines , "class='best_cook_search_styled_select_box float_left'");
	?>

    </div>
    
    <div class="float_left advanced_search_dropmenu_wrapper col-sm-6 col-xs-12 col-md-4" style="height:65px;">
    <div class="float_left" style="width:5%; height:47px;"></div>
    <div class="float_left" style="width:15%;" >
    <img height="30" style="margin-top:17px; class="float_left" src="<?php echo base_url()."images/bestcook/best_cook_search_nestle_products.png" ?>" />
    </div>

    <!--<select class="best_cook_search_styled_select_box float_left" style="width:80%;" >
    <option>منتجات نستلة</option>
    </select>-->
    
     <?php
	echo form_dropdown('advanced_search_nestle_products', $nestle_products_options , $selected_value_of_nestle_products , "class='best_cook_search_styled_select_box float_left'");
	?>

    </div>
    
    <div class="float_left advanced_search_dropmenu_wrapper col-sm-6 col-xs-12  col-md-4" style="height:65px;">
    <div class="float_left" style="width:5%; height:47px;"></div>
    <div class="float_left" style="width:15%;" >
    <img height="30" style="margin-top:17px; class="float_left" src="<?php echo base_url()."images/bestcook/best_cook_search_duration.png" ?>" />
    </div>

 <!--   <select class="best_cook_search_styled_select_box float_left" style="width:80%;">
    <option>وقت الطهي</option>
    </select>-->
    
    <?php
	echo form_dropdown('advanced_search_duration', $duration_options , $selected_value_of_duration, "class='best_cook_search_styled_select_box float_left'");
	?>

    </div>
    
    <div class="float_left advanced_search_dropmenu_wrapper col-sm-6 col-xs-12 col-md-4" style="height:65px;">
    <div class="float_left separate_right" style=" height:47px;"></div>
    <div class="float_left img_icon" >
    <img height="30" style="margin-top:17px; class="float_left" src="<?php echo base_url()."images/bestcook/best_cook_search_mokwnat.png" ?>" />
    </div>

   <!-- <select class="best_cook_search_styled_select_box float_left" style="width:75%;">
    <option>المكونات الأساسية</option>
    </select>-->
    
    <?php
	echo form_dropdown('advanced_search_selections', $selection_options , $selected_value_of_selections , "class='best_cook_search_styled_select_box float_left'");
	?>

    </div>
        
    <div class="float_left advanced_search_dropmenu_wrapper col-sm-6 col-xs-12 col-md-4" style="height:65px;">
   <div class="float_left separate_right" style="height:47px;"></div>
    <div class="float_left img_icon">
    <img height="30" style="margin-top:17px; class="float_left" src="<?php echo base_url()."images/bestcook/best_cook_search_calories.png" ?>" />
    </div>

 <!--   <select class="best_cook_search_styled_select_box float_left" style="width:80%;">
    <option>السعرات</option>
    </select>-->
    
     <?php
	echo form_dropdown('advanced_search_calories', $calories_options , $selected_value_of_calories , "class='best_cook_search_styled_select_box float_left'");
	?>
    
    </div>
    <?php
	echo form_close();
	?>
<!-- Advanced Search End   -->

</div>
<div class="clear"></div>
