<style>
.thick_line
{
	width: 100%;
  height: 4px;
 
}
.img_recipe_list{
	width:100%;
	/*height:200px;*/
	
	}
	.arabic .text_title_recipe{
		font-size: 11px;
		width: 221px;
		float: right;
		width: 100%;
		line-height:25px;
		}
	.english .text_title_recipe{	
		float: left;
font-size: 13px;
width: 100%;
margin-top: 7px;
line-height:25px;
}
.allviews{
	
	line-height: 29px;
	font-size: 12px;
	}		
		
		
@media (min-width: 320px) and (max-width: 420px){
	
.img_recipe_list{
	width:100%;
/*	height:110px;*/
	}
	
	.mob-list-recipe-item
	{
		width: 100%;
		clear:both;
	}
@media (min-width: 421px) and (max-width: 800px){
	
.img_recipe_list{
	width:100%;
	height:165px;
	}
	}
	@media (min-width: 801px) and (max-width: 990px){
	
.img_recipe_list{
	width:100%;
	height:165px;
	}
		.english .text_title_recipe{	
        font-size: 13px;
        margin-top: 7px;
     }
	 	.arabic .text_title_recipe{
		font-size: 11px;
		width: 221px;
		}
	}
	
	
@media (min-width: 991px) and (max-width: 1200px){
			
					.english .text_title_recipe{	
		float: left;
font-size: 13px;
width: 64%;
margin-top: 7px;
}
			
			}
@media (min-width: 768px) and (max-width: 854px){
				
.english .text_title_recipe{	
      font-size: 13px;
       width: 64%;
       margin-top: 7px;
}.arabic .text_title_recipe{
		font-size: 11px;
		width: 221px;
		width: 64%;
		}
				}
@media (max-width: 653px){
				
.english .text_title_recipe{	
		float: left;
      font-size: 13px;
       width: 100%;
       margin-top: 7px;
}.arabic .text_title_recipe{
		font-size: 11px;
		width: 221px;
		float: right;
		width: 100%;
		}
		.allviews{
	
	line-height: 29px;
	font-size: 11px;
	}	
	
}			
@media (min-width: 360px){
		.arabic .text_title_recipe{
		font-size: 9px;
		width: 221px;
		float: right;
		width: 48%;
		}
		.allviews{
	
	line-height: 29px;
	font-size: 9px;
	}
					}
</style>


<div class="row <?php echo $current_section; ?>">
	<div class="col-xs-12">
          <?php   echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png" , site_url_mobile(''.$this->router->class));?>
          
          <?php 
		          echo $this->mwidgets->drawCurrentSubSectionHomepageTitle($display_data[0]['sub_sections_name'.$current_language_db_prefix], lang("globals_back"), "#");
				  ?>
                  

                  
                  
<div id="related-recipe-header">
	<h1 class="<?php echo $current_section; ?>" ><?php echo $this->headers->get_third_title() ?></h1>
</div>
	<div class="thick_line"></div>
	</div>
    
  
<?php
	$id_column = $members_list_flag ? "members_recipes_ID" : "recipes_ID";
	$title_column = $members_list_flag ? "members_recipes_name" : 'recipes_title'.$current_language_db_prefix;
	$view_column = $members_list_flag ? "members_recipes_views" : "recipes_views";
	$image_url =  $members_list_flag ?  $this->config->item('users_recipes_img_link') : $this->config->item('recipes_img_link');
	$table_name_for_rate  = $members_list_flag ? "members_recipes" : "recipes";
	$inner_recipe_method = $members_list_flag ? "your_recipes" : "delicious_recipes";
	
	
	for($i=0 ; $i < sizeof($display_data) ; $i ++)
	{
		$id =$display_data[$i][$id_column];
		$title = $display_data[$i][$title_column];
		$short_title = $this->common->limit_text($title, 30);
		$image  = $display_data[$i]['images_src'] == "logo.png" ? base_url()."uploads/recipes/image_not_available".$current_language_db_prefix.".png" :   $image_url.$this->config->item('image_prefix').$display_data[$i]['images_src'];
		$views = $display_data[$i][$view_column];
		$url = site_url('mobile/' . $this->router->class."/".$inner_recipe_method."/".generateSeotitle($id ,$title ));
		
		$share_image = base_url()."images/share_image.png";
		$member_name = "";
		if($members_list_flag)
			$member_name = $this->members->get_member_name_by_id($display_data[$i]['members_recipes_members_id']);
?>
	
	<div class="col-xs-12 col-sm-4">
		<a href="<?php echo $url ?>" title="<?php  echo $title?>" rel="external">
			<img class="img-responsive img_recipe_list" alt="<?php  echo $title?>" src="<?php echo $image; ?>" />
		</a>
        
		            <a href="<?php echo $url ?>" rel="external"><h3 class="text_title_recipe"><?php echo $short_title; ?> <span class="allviews" style="line-height:29px;" ><?php echo lang('globals_views'). " ( ".$views." ) ";?></span></h3></a>
			


	</div>
<?php } ?>
 </div> 
 <div class="row">
    	<div class="col-xs-12" style="text-align:center" data-ajax="false">
        	<div style="position:relative">
        	<?php
			echo $pagination_links;
			?>
            </div>
        </div>
    </div>
