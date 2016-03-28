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
.no_article_message{padding:20px;}
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
<div class="row" style="background:white;">
	<div class="col-md-12 col-sm-12 col-xs-12">
    	<h1 class="" style="font-size:25px; color:#13758e;"> <?php echo lang('mycorner_myarticles');?>  </h1>
    </div>
	<div class="col-md-12 col-sm-12 col-xs-12">
    	<div class="thick_line"></div>   
		<div style="background:#c8c8c8;width:100%;height:40px;position:relative;">
 			<div class="float_left" style="color:#FFFFFF;font-family:inherit;margin:5px 15px;"><?php echo lang('mycorner_article_title'); ?></div>	
    	</div>
 	</div>


			<ul class="col-md-12 col-xs-12 col-sm-12"> 
				<?php
				$CI = &get_instance();
				$CI->load->model("articlesmodel");
				$CI->load->model("sectionsmodel");				
				if($members_books){
				$length = sizeof($members_books);
				for($i=0;$i<sizeof($members_books);$i++) 
				{ 
				$foreign_id = $members_books[$i]['members_favorites_foreign_id'];
				$section_id = $members_books[$i]['members_favorites_section_id'];
				//$table = $members_books[$i]['members_favorites_section_type'];
				$section_name = $members_books[$i]['sections_name'.$current_language_db_prefix];
				$section_color = $members_books[$i]['sections_title']."_color";
				$section_class = $members_books[$i]['sections_title'];				
				$display_data = $CI->articlesmodel->get_detailed_articles($foreign_id);	
				$id_column = "articles_ID";
				$title_column = 'articles_title'.$current_language_db_prefix;
				$method = "inner_articles";
				$desc_column  = 'articles_brief'.$current_language_db_prefix;
				$image_url = base_url()."uploads/articles/";					
				$id =$display_data[0][$id_column];
				$article_id = $members_books[$i]['members_favorites_ID'];
				$title = $display_data[0][$title_column];
				$desc = $display_data[0][$desc_column];
				$short_desc = $this->common->limit_text($desc,300);
				$image = $display_data[0]['images_src'] == "logo.png" ? base_url()."uploads/recipes/image_not_available.png" :  $image_url.$display_data[0]['images_src'];
				$url = site_url_mobile("best_cook/inner_articles/".$id );
				$sub_sections_ID = $display_data[0]['articles_sections_ID'];
				$display_subsection = $CI->sectionsmodel->get_sections_details($sub_sections_ID);
				$subsection_name = 	$display_subsection[0]['sub_sections_name'.$current_language_db_prefix]
				?>
                <div class="col-md-12 col-xs-12 col-sm-12">
				<li id="<?php echo $i; ?>" style="list-style:none;">
					
						<div class="float_left col-md-3 col-xs-12 col-sm-5" style="margin-top:10px;">
							<a href="<?php echo $url;?>" rel="external"><img width="100%" class="image_recipe img-responsive" src="<?php echo $image?>"   /></a>
						</div>
						<div class="col-md-9 col-sm-7 col-xs-12" style="margin-top:30px;">
							<a href="<?php echo  $url;?>" rel="external"><h2 style="font-size:20px;"><?php echo $title?></h2></a>
                       <a href="#insert_message" class="single_1" article-value="<?php echo $article_id; ?>"><p class="remove_from_favourites"><?php echo lang('mycorner_remove_favourites'); ?></p></a>
                   	 <div data-role="popup" id="insert_message_<?php echo $i; ?>" style="width:95%; height:160px;">
						<div style="text-align:center;margin-top:20px; ">
                        	<h1 style="padding:10px;"><?php echo lang('mycorner_favourite_recipe_delete');?></h1>
                        </div>
                       	<div style="text-align:center;">
                        	<a class="ok_button" href="#" data-rel="back"  data-icon="delete"><?php echo lang('mycorner_recipe_yes'); ?></a> 
                                             
                        	<a  id="close" href="#" data-rel="back"  data-icon="delete"><?php echo lang('mycorner_recipe_no'); ?></a>
                        </div>
					 </div>
							
							<p class="whitespace" style="font:inherit;"><?php echo $short_desc; ?> </p>
							<a  href="<?php echo $url;?>" rel="external" class = "float_right" style="color:#9c271c;font:inherit;"><?php echo lang('globals_more'); ?></a>
						</div>
					
				</li></div>
				<? }
				}else{
				?>
					<div class="col-md-12 col-xs-12 col-sm-12">
					<h2 class="no_article_message terms_conditions_color" style="font-size:20px; color:#13758e;"><?php echo lang('mycorner_no_article_found'); ?></h2>
                    </div>
				
				<?php	
					}
				?>
			</ul>
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



