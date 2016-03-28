<?php echo $this->load->view('template/submenu_writer');   ?>

<?php echo $this->load->view('template/tree_menu_writer');   ?>

<style>
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
    <h1 class="<?php echo $current_section_color; ?> float_left" style="font-size:25px;"> <?php echo lang('mycorner_myarticles');?>  </h1>
    
    <div class="clear"></div>
    </div>
</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>"></div>
	  <div class="clear"></div>
      
 <div style="background:#c8c8c8;width:100%;height:40px;position:relative;">
 	<div class="float_left" style="color:#FFFFFF;font-family:inherit;margin:5px 15px;"><?php echo lang('mycorner_article_title'); ?></div>
    <div class="articleborder"></div>
    <div class="float_right" style="color:#FFFFFF;font-family:inherit;margin:5px 15px;font-size:15px;width: 120px"><?php echo lang('mycorner_article_from'); ?></div>
    	<div class="clear"></div>
 </div>
      <div class="clear"></div>
<div class="global_background" style="height:auto;">
<div class="articles_content">
		<ul> 
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
		$url = site_url($section_class."/".$method."/".generateSeotitle($foreign_id,$title));
		
		$sub_sections_ID = $display_data[0]['articles_sections_ID'];
		
		$display_subsection = $CI->sectionsmodel->get_sections_details($sub_sections_ID);
		
		$subsection_name = 	$display_subsection[0]['sub_sections_name'.$current_language_db_prefix]

		?>
        <li id="fav_recipe_block_<?php echo $article_id; ?>"  style="list-style:none;border-bottom: 5px solid #c8c8c8;">
        	<div class="float_left" style="width:800px;">
            
            	<div class="float_left" style="margin:10px;">
                    <a href="<?php echo $url;?>"><img class="image_recipe" src="<?php echo $image?>" width="208"  /></a>
                </div>
                
                <div class="float_right" style="width: 570px;margin-top:30px;">
                      <a href="<?php echo  $url;?>"><h2 style="font-size:20px;"><?php echo $title?></h2></a>
                      <a href="#insert_message" class="single_1" recipe-value="<?php echo $article_id; ?>"><p class="remove_from_favourites"><?php echo lang('mycorner_remove_favourites'); ?></p></a>
                      <p class="whitespace" style="font:inherit;"><?php echo $short_desc; ?> </p>
                     <a  href="<?php echo $url;?>" class = "float_right" style="color:#9c271c;font:inherit;"><?php echo lang('globals_more'); ?></a>
                </div>
            		<div class="clear"></div>
            </div> <!--end of float left-->
            
             
           
            
        <div class="float_right" style="width:180px;">
        	<div class="float_left" style="border: 2px solid #c8c8c8;height:210px;"></div>
            <div style="width:180px;margin-top:60px;"><h2 style="text-align:center" class="<?php echo $section_color; ?>"> <?php echo $section_name;?>  </h2> </div>
            <div style="border: 2px solid #c8c8c8;width:166px;margin-left:5px;" ></div>
            <div class="triangler"></div>
            <div style="width:180px;"> <h2 style="text-align:center;font-size:15px;"> <?php echo $subsection_name; ?></h2></div>
            
        
        </div> <!--end of float right -->
        
         <div class="clear"></div>
        
        
        </li>
        <? }
		
		}else{
		?>
        <script>
        	$('.global_background').html('<h2 class="no_article_message terms_conditions_color"><?php echo lang('mycorner_no_article_found'); ?></h2>');
        </script>
        <?php	
		}
		?>
        
        </ul>
	</div>  
    </div>

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