<?php echo $this->load->view('template/submenu_writer');   ?>

<?php echo $this->load->view('template/tree_menu_writer');   ?>

<style>
#close{
	background:#E7E7E7;padding:5px 30px 5px 30px;border-radius: 10px;
}
#close:hover{background:#CCC}
.ok_button{background:#E7E7E7;padding:5px 30px 5px 30px;border-radius: 10px;}
.ok_button:hover{background:#CCC}
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
.remove_from_favourites{
	font-size:10px;color:#CCC;
}
.remove_from_favourites:hover{
color:#999;
}
</style>

<div class="clear"></div>
<div id="insert_message"></div>
<div class="inner_title_wrapper">
	<div class="sections_wrapper_margin">
    <h1 class="<?php echo $current_section_color; ?> float_left" style="font-size:25px;"><?php echo lang('mycorner_myrecipes'); ?></h1>
    
    <div class="clear"></div>
    </div>
</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>"></div>
	  <div class="clear"></div>
<div class="global_background" style="height:auto;">
<div class="recipes_content">
		<ul> 
        <?php
		$CI = &get_instance();
		$CI->load->model("recipesmodel");
		$CI->lang->load('bestcook');
		
		if($members_books){
		$length = sizeof($members_books);
		for($i=0;$i<sizeof($members_books);$i++) 
		{ 
		$foreign_id = $members_books[$i]['members_favorites_foreign_id'];
		$section_id = $members_books[$i]['members_favorites_section_id'];
		$table = $members_books[$i]['members_favorites_section_type'];	
		
		if($table ==  'recipes')
		{
			$display_data = $CI->recipesmodel->get_detailed_recipe($foreign_id);
		}
		else if($table == 'members_recipes')
		{
			$display_data = $CI->recipesmodel->get_detailed_member_recipe($foreign_id);
		}
		
		$id_column = ($table ==  'members_recipes')? "members_recipes_ID" : "recipes_ID";
		$title_column = ($table ==  'members_recipes') ? "members_recipes_name" : 'recipes_title'.$current_language_db_prefix;
		$method = ($table ==  'members_recipes')? "your_recipes" : "delicious_recipes";
		$desc_column  = ($table ==  'members_recipes') ? "members_recipes_directions" : 'recipes_directions'.$current_language_db_prefix;
		$image_url =  ($table ==  'members_recipes')?  $this->config->item('users_recipes_img_link') : $this->config->item('recipes_img_link');
		
		$subsection_name =  ($table ==  'members_recipes')? lang('bestcook_member_recipes'):lang('bestcook_all_recipes');	
		
		$id =$display_data[0][$id_column];
		$recipe_id = $members_books[$i]['members_favorites_ID'];
		$title = $display_data[0][$title_column];
		$desc = $display_data[0][$desc_column];
		$short_desc = $this->common->limit_text($desc,160);	
		$image = $display_data[0]['images_src'] == "logo.png" ? base_url()."uploads/recipes/image_not_available.png" :  $image_url.$this->config->item('image_prefix').$display_data[0]['images_src'];
		$url = site_url("best_cook/".$method."/".generateSeotitle($foreign_id,$title));

		?>
        <li id="<?php echo $i; ?>" style="border-bottom: 5px solid #c8c8c8;">
        	<div class="float_left" style="width:800px;">
            
            	<div class="float_left" style="margin: 10px 10px 0px 10px;">
                    <a href="<?php echo $url;?>"><img class="image_recipe" src="<?php echo $image?>" width="208"  /></a>
                </div>
                <div class="float_right" style="width: 570px;margin-top:30px;">
                	 <a href="<?php echo  $url;?>"><h2 style="font-size:20px;"><?php echo $title?></h2></a>
                     <a data-id="<?php echo $i?>" data-recipe-id="<?php echo $recipe_id?>" class="message"><p class="remove_from_favourites"><?php echo lang('mycorner_remove_favourites'); ?></p></a>
                     <div class="pop_up_message">
                     	<div style="text-align:center;margin-top:20px;"><h1 style="margin-bottom:25px;"><?php echo lang('mycorner_favourite_recipe_delete');?></h1><a data-id="<?php echo $i?>" data-recipe-id="<?php echo $recipe_id?>" class="ok_button" ><?php echo lang('mycorner_recipe_yes'); ?></a> <a href="#" class="close"><?php echo lang('mycorner_recipe_no'); ?></a></div>
                     </div>
                     <p class="whitespace" style="font:inherit;"><?php echo $short_desc; ?> </p>
                     <a href="<?php echo $url;?>" class = "float_right" style="color:#9c271c;font:inherit;"><?php echo lang('globals_more'); ?></a>
                </div>
            		<div class="clear"></div>
            </div> <!--end of float left-->

            
        <div class="float_right" style="width:180px;">
        	<div class="float_left" style="border: 2px solid #c8c8c8;height:142px;margin-top:66px;"></div>
            <div style="width:180px;margin-top:60px;"> <h2 style="text-align:center;color:red;"><?php echo lang('mycorner_recipe_best_cook'); ?></h2> </div>
            <div style="border: 2px solid #c8c8c8;width:166px;margin-left:5px;" ></div>
            <div class="triangler"></div>
            <div style="width:180px;"> <h2 style="text-align:center;"> <?php echo $subsection_name ;?></h2></div>
            
        
        </div> <!--end of float right -->
        
         <div class="clear"></div>
        
        
        </li>
        <? } 
		}else{
		?>
        <script>
        	$('.global_background').html('<h2 class="no_recipe_message terms_conditions_color"><?php echo lang('mycorner_no_recipes_found'); ?></h2>');
        </script>
        <?php }?>
        
        </ul>
</div><!--End OF recipes_content-->
    </div>
    <div class="page_navigation" align="center">
	<?php //echo  $pagination_links; ?>
    </div>

</div>

<?php /*?><script>
$("#insert_message").hide();
$("#single_1").fancybox({
		  width: 420,
          height: 150,
		  scrolling   : 'no',
		  autoSize : false,
          fitToView : false,
          helpers: {
              title : {
                  type : 'float'
              }
          }
      });
	 
$("#close").live("click", function(){
 parent.$.fancybox.close();
});
	
	function message(id, recipe_id){
			$("#single_1").live("click", function(){
				$("#insert_message").html('<div style="text-align:center;margin-top:20px;"><h1 style="margin-bottom:25px;"><?php echo lang('mycorner_favourite_recipe_delete');?></h1><a class="ok_button" href="#"><?php echo lang('mycorner_recipe_yes'); ?></a> <a href="#" id="close"><?php echo lang('mycorner_recipe_no'); ?></a></div>');
            });

			
			$(".ok_button").live("click",function() {
       		 item = $(this).attr( 'data-id', 'data-recipe-id' );
			 //alert($(this));

       		 //var id = $(this).attr('rel');
			var base = "<?php echo site_url('my_corner/delete_user_favourites/'); ?>"
       		 $.post(base+'/'+recipe_id);
       		 item.parent().fadeOut(300, function() {
				$("#"+id+"").remove();
				parent.$.fancybox.close();
				
				<?php $length = $length - 1; 
				if($length == 0){
				?>
				$('.global_background').html('<h2 class="no_article_message terms_conditions_color" style="padding:20px;"><?php echo lang('mycorner_no_article_found'); ?></h2>');
				<?php
				}
				?>
				
       		 });
       		 return false;
    		});
			}

</script><?php */?>
<script type="text/javascript">
$(document).ready(function(e) {
	$(".pop_up_message").hide();
	
	$(".pop_up_message").fancybox({
			  width: 420,
			  height: 150,
			  scrolling   : 'no',
			  autoSize : false,
			  fitToView : false,
			  beforeLoad : function () 
			  {
				parentData.id       = $(this.element).data("id");
				parentData.recipe_id = $(this.element).data("recipe-id");
				}
			  helpers: {
				  title : {
					  type : 'float'
				  }
			  }
		  });
	
	$(".message").click(function(){
		var id = $(this).attr("data-id");
		var recipe_id = $(this).attr("data-recipe-id");
			
	

		$(".pop_up_message").trigger("click");
		$(".ok_button").click(function(){
		var id = parentData.id;
		var recipe_id = parentData.recipe_id;
		
		alert(id);
		alert(recipe_id);

		});
		
	});
	
	
		<?php /*?> $.post(base+'/'+recipe_id);
		 parent().fadeOut(300, function() {
			$("#"+id+"").remove();
			parent.$.fancybox.close();
			
			<?php $length = $length - 1; 
			if($length == 0){
			?>
			$('.global_background').html('<h2 class="no_article_message terms_conditions_color" style="padding:20px;"><?php echo lang('mycorner_no_article_found'); ?></h2>');
			<?php
			}
			?>
			
		 });
		 return false;
		});<?php */?>
			
});
</script>