<?php echo $this->load->view('template/tree_menu_writer');   ?>

<style>
.no_recipe_message{padding:20px;}
.whitespace{white-space:normal;}
.triangler{
	width: 0px;
	height: 0px;
	border-style: solid;
	border-width: 11px 7px 0 7px;
border-color: #c8c8c8 transparent transparent transparent;
margin-left:80px;
}
</style>

<div class="clear"></div>

<div class="inner_title_wrapper">
	<div class="sections_wrapper_margin">
    <h1 class="<?php echo $current_section_color; ?> float_left" style="font-size:25px;"><?php echo lang('mycorner_myrecipes'); ?></h1>
    
    <div class="clear"></div>
    </div>
</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>"></div>
	  <div class="clear"></div>
<div class="global_background" style="height:auto;">
		
        <ul>
        <?php if($display_my_recipes){
		for($i=0;$i<sizeof($display_my_recipes);$i++):
		$url = $display_my_recipes[$i]['members_recipes_ID'];
		$image = base_url().'uploads/test/'.$display_my_recipes[$i]['images_src'];
		$title = $display_my_recipes[$i]['members_recipes_name'];
		$desc = $display_my_recipes[$i]['members_recipes_directions'];
		?>
            <li style="border-bottom: 5px solid #c8c8c8;">
        	<div class="float_left" style="width:800px;">
            
            	<div class="float_left" style="margin: 10px 10px 0px 0px;">
                    <a href="<?php echo $url;?>"><img class="image_recipe" src="<?php echo $image?>" width="208"  /></a>
                </div>
                <div class="float_right" style="width: 570px;margin-top:30px;">
                	 <a href="<?php echo  $url;?>"><h2 style="font-size:20px;"><?php echo $title?></h2></a>
                     <p class="whitespace" style="font:inherit;"><?php echo $desc; ?> </p>
                     
                     
                </div>
            		<div class="clear"></div>
            </div> <!--end of float left-->
            
            <div class="float_right" style="width:180px;">
        	<div class="float_left" style="border: 2px solid #c8c8c8;height:142px;margin-top:66px;"></div>
            <div style="width:180px;margin-top:60px;"> <h2 style="text-align:center;color:red;"><a href="<?php echo $url;?>"><?php echo lang('globals_edit'); ?></a></h2> </div>
            <div style="border: 2px solid #c8c8c8;width:166px;margin-left:5px;" ></div>
            
            <div style="width:180px;"> <h2 style="text-align:center;"><a href="<?php echo $url;?>"><?php echo lang('globals_delete'); ?></a></h2></div>
            
        
        </div>
        
         <div class="clear"></div>
        
        
        </li>
            <?php
		endfor;
		}?>
        </ul>

    </div>
    <div class="page_navigation" align="center">
	<?php //echo  $pagination_links; ?>
    </div>

	


</div>