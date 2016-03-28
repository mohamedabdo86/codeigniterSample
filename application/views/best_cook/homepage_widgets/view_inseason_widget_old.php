<style>
#inseason_recipe_widget
{
	height:304px;
}
#inseason_recipe_widget .main_image_wrapper
{
	width:370px; height:260px; background:#e82327;position: relative;top: 44px;
}
#inseason_recipe_widget .main_image_wrapper img
{
	width:100%;
	height:100%;
	z-index:99;
	
}
#inseason_recipe_widget .main_image_wrapper .desc_wrapper
{
	width:100%;
	position:absolute;
	bottom:0px;
	min-height:50px;
}
#inseason_recipe_widget .main_image_wrapper .desc_wrapper h3
{
	width:320px;
	color:#5d5d5d;
	margin:10px 0px;
}
#inseason_recipe_widget .main_image_wrapper .desc_wrapper .triangle,
#inseason_recipe_widget .main_image_wrapper .desc_wrapper .plus_sign
{
	bottom:-50px;
}

#inseason_recipe_widget .recipes_wrapper
{
	width:180px;
	 
	position: relative;
	top: 44px;
	background:#e82327;
	height: 260px;
}
#inseason_recipe_widget  .recipes_wrapper ul
{
	margin:5px;
	background:#FFF;
	height: 245px;
}
#inseason_recipe_widget  .recipes_wrapper ul li
{
	width:100%;
	border-bottom:1px dashed #e82327;
	padding:5px 0px;
	
}
#inseason_recipe_widget  .recipes_wrapper ul li:last-child { border-bottom: none; }
#inseason_recipe_widget  .recipes_wrapper ul h4
{
	margin:0;
	padding:0;
	padding:5px 5px;
	color:#363636;
	font-size: 12px;
	white-space: normal;
}
</style>
<?php
$display_inseason_topic = $this->recipesmodel->get_inseason_recipes();

list ( $display_inseason_inner_recipes  , $total_rows) = $this->recipesmodel->get_topics_list_of_recipes($display_inseason_topic[0]['inseason_recipies_ID'],5,0);
?>
<div id="inseason_recipe_widget"  class="float_left home_widget inner_recipe_bestcook_width "   >

			<div class="title best_cook_border_color regular_widget_border_width height_40">
            	<div class="sections_wrapper_margin ">
                    <div class="best_cook_color float_left"><?php echo lang('bestcook_Of_the_market_for_the_home'); ?></div>
                    <div class="float_right second_title gray_color">
                        <span style="position:relative;bottom:-18px">&#8220;</span>
                        <small><?php echo lang("bestcook_inseason_recipe") ?></small>
                        <span style="position:relative; top:-5px">&#8221;</span>
                     </div>
                 </div>
            </div>
            
            
            <div class="float_left main_image_wrapper"  >
            
            	<img width="370" height="260" src="<?php echo base_url()."uploads/recipes/".$display_inseason_topic[0]['images_src'] ?>" />
                
                <div class="desc_wrapper global_background">
                	<div class="float_left" style="width:10px; height:10px;"></div>
                	<h3 class="float_left"><?php echo $display_inseason_topic[0]['inseason_recipies_title'.$current_language_db_prefix]; ?></h3>
                    
                    <div class="float_right" style="position:relative">
                	<div class="triangle best_cook_borderbottom_color"></div>
					<div class="plus_sign white_color"><a href="<?php echo site_url("best_cook/recipes_list/".$display_inseason_topic[0]['inseason_recipies_ID']); ?>">+</a></div>
                    
                    <div class="clear"></div>
                </div>
                
                </div><!-- Desc -->

            </div><!-- End of float_left -->
            
            
            
            <div class="float_right recipes_wrapper">
            
            	<ul>
                	<li><h4 style="padding:5px;">شاهدي الوصفات</h4></li>
                   <?php
				   for($i=0; $i< sizeof($display_inseason_inner_recipes); $i++):
				   $title = "";
				   $url = site_url("best_cook/delicious_recipes/".$display_inseason_inner_recipes[$i]['recipes_ID']);
				   ?>
                    <li><h4><a href="<?php echo $url; ?>"><?php echo $display_inseason_inner_recipes[$i]['recipes_title'.$current_language_db_prefix]; ?></a></h4></li>
					<?php
                    endfor;
                    ?>

                </ul>
            
            </div><!-- End of float_right -->
            
            
             
            
</div><!-- ENd of wasafat el mowsim -->