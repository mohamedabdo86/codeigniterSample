<style>
.thick_line
{
	width: 100%;
  height: 4px;
    background: #13758e;
}
.close_button{
	background:#E7E7E7;padding:5px 30px 5px 30px;border-radius: 10px;
}
.close_button:hover{background:#CCC}
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
	font-size:15px;color:#CCC;
}
.remove_from_favourites:hover{
color:#999;
}
</style>
<div id="insert_message"></div>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
    	<div id="insert_message"></div>
    	<h1 class="" style="font-size:25px; color:#13758e;"> <?php echo lang('mycorner_myrecipes'); ?> </h1>
    </div>
	<div class="col-md-12 col-sm-12 col-xs-12">
    	<div class="thick_line"></div>   
		
 	</div>
    	<div class="row" style="background:white;">
		<ul class="col-md-12 col-xs-12 col-sm-12"> 
        <?php
		$CI = &get_instance();
		$CI->load->model("recipesmodel");
		$CI->lang->load('bestcook');
		
		if($members_books)
		{
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
		$image_url =  ($table ==  'members_recipes')?  base_url()."uploads/users_recipes/" : base_url()."uploads/recipes/";
		
		$subsection_name =  ($table ==  'members_recipes')? lang('bestcook_member_recipes'):lang('bestcook_all_recipes');	
		
		$id =$display_data[0][$id_column];
		$recipe_id = $members_books[$i]['members_favorites_ID'];
		$title = $display_data[0][$title_column];
		$desc = $display_data[0][$desc_column];
		$short_desc = $this->common->limit_text($desc,160);	
		$image = $display_data[0]['images_src'] == "logo.png" ? base_url()."uploads/recipes/image_not_available.png" :  $image_url.$display_data[0]['images_src'];
		
		//$url = site_url_mobile("best_cook/delicious_recipes/".$id);
		$url = site_url_mobile("best_cook/".$method."/".generateSeotitle($foreign_id,$title));
		

		?>
          <div class="col-md-12 col-xs-12 col-sm-12">
				<li id="fav_recipe_block_<?php echo $recipe_id; ?>" style="list-style:none;">
					
						<div class="float_left col-md-3 col-xs-12 col-sm-5" style="margin-top:10px;">
							<a href="<?php echo $url;?>" rel="external"><img width="100%" class="image_recipe img-responsive" src="<?php echo $image?>"   /></a>
						</div>
						<div class="col-md-9 col-sm-7 col-xs-12" style="margin-top:30px;">
							<a  href="<?php echo  $url;?>" rel="external"><h2 style="font-size:20px;"><?php echo $title?></h2></a>
<?php /*?>							<a href="#insert_message_<?php echo $i; ?>" id="single_1" data-rel="popup" onclick="message(<?php echo $i.','.$recipe_id; ?>)"  data-ajax="true"><p class="remove_from_favourites"><?php echo lang('mycorner_remove_favourites'); ?></p></a><?php */?>							<a href="#insert_message" class="single_1" recipe-value="<?php echo $recipe_id; ?>"><p class="remove_from_favourites"><?php echo lang('mycorner_remove_favourites'); ?></p></a>
												
							<p class="whitespace" style="font:inherit;"><?php echo $short_desc; ?> </p>
							<a  href="<?php echo $url;?>" rel="external" class = "float_right" style="color:#9c271c;font:inherit;"><?php echo lang('globals_more'); ?></a>
						</div>
					
				</li>
	</div>
       
	
       
        <? } 
		}else{
		?>
     <div class="col-md-12 col-xs-12 col-sm-12">
					<h2 class="no_article_message terms_conditions_color" style="font-size:20px; color:#13758e;"><?php echo lang('mycorner_no_recipes_found'); ?></h2>
                    </div>
        <?php }?>
        
        </ul>
    
    </div>
    
    
<script>

$(document).ready(function(e) {

$("#insert_message").hide();
$(".single_1").fancybox({
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


$(document).on('click', '.close_button', function(e){ 
     e.preventDefault();
	 parent.$.fancybox.close();
	 });

			var recipe_to_delete_id;
			$(".single_1").click(function(){
				recipe_to_delete_id = $(this).attr("recipe-value");
				$("#insert_message").html('<div style="text-align:center;margin-top:20px;"><h1 style="margin-bottom:25px;"><?php echo lang('mycorner_favourite_recipe_delete');?></h1><a class="ok_button" recipe-value="'+ recipe_to_delete_id +'" href="#"><?php echo lang('mycorner_recipe_yes'); ?></a> <a href="#" class="close_button"><?php echo lang('mycorner_recipe_no'); ?></a></div>');
            });
			
			$(document).on('click', '.ok_button', function(e){ 
			 e.preventDefault();
       		 item = $(this);
       		 //var id = $(this).attr('rel');
			 var clicked_item_id = item.attr("recipe-value");
			var base = "<?php echo site_url('my_corner/delete_user_favourites/'); ?>/"+ clicked_item_id;
			//alert(base);
			
			$.ajax({
					method: "POST",
					url: base,
					success: function(msg){
						
						item.parent().fadeOut(300, function() {
						$("#fav_recipe_block_"+clicked_item_id).remove();
						parent.$.fancybox.close();
				
						<?php $length = $length - 1; 
						if($length == 0){
						?>
							$('.global_background').html('<h2 class="no_article_message terms_conditions_color" style="padding:20px;"><?php echo lang('mycorner_no_article_found'); ?></h2>');
						<?php
						}
						?>	
						});
					},
					fail: function(){
						alert("Error occured, Please try again later!");
					}
					});
				
       		 });			
});
</script>




