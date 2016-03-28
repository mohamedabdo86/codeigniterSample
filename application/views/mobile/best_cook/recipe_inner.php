<style>
.fancybox-wrap{width: 300px !important;}
.fancybox-inner{width: 270px !important;}
</style>

<div class="<?php echo $current_section; ?> col-xs-12">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('mobile/css/recipe-style.css') ; ?>" />
<div class="thick-line background-color">&nbsp;</div>
<?php   
//Fix for the lists in order to apply both members and admin members in one lists
$id_column = $members_list_flag ? "members_recipes_ID" : "recipes_ID";
$title_column = $members_list_flag ? "members_recipes_name" : 'recipes_title'.$current_language_db_prefix;
$view_column = $members_list_flag ? "members_recipes_views" : "recipes_views";
$image_url =  $members_list_flag ?  $this->config->item('users_recipes_img_link') : $this->config->item('recipes_img_link');
$table_name_for_rate  = $members_list_flag ? "members_recipes" : "recipes";
$inner_recipe_method = $members_list_flag ? "view_member_recipe" : "view_recipe";

$ing_column  = $members_list_flag ? "members_recipes_ing" : 'recipes_ingredients'.$current_language_db_prefix;
$desc_column  = $members_list_flag ? "members_recipes_directions" : 'recipes_directions'.$current_language_db_prefix;

//Recipe Properties 
$process_time = $members_list_flag ? "members_recipes_cookingtime" : "recipes_cookingtime";
$recipe_type = $members_list_flag ? "members_recipes_dish_id" : "recipes_dish_id";
$prep_time = $members_list_flag ? "" : "recipes_preptime";
$servies = $members_list_flag ? "" : "recipes_servings";
$cuisine = $members_list_flag ? "members_recipes_cuisine_id" : "recipes_cuisine_id";
$calories = $members_list_flag ? "members_recipes_calories" : "recipes_calories";

$id =$display_data[0][$id_column];
$title = $display_data[0][$title_column];
$views = $display_data[0][$view_column];
$ing = $display_data[0][$ing_column];
$desc = $display_data[0][$desc_column];	
$calory = $display_data[0][$calories];
$image = $display_data[0]['images_src'] == "logo.png" ? base_url()."uploads/recipes/image_not_available".$current_language_db_prefix.".png" :  $image_url.$display_data[0]['images_src'];

$url = site_url_mobile($this->router->class."/".$this->router->method."/".$id);
  
      echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png" , site_url_mobile(''.$this->router->class));
      echo $this->mwidgets->drawCurrentSubSectionHomepageTitle($display_data[0]['sub_sections_name'.$current_language_db_prefix], lang("globals_back"), "#");
   	  
	  $ma3lomat_se7ia = $this->config->item('recipes_img_link').$this->globalmodel->get_image_src($display_data[0]['recipes_nutrition_facts_image'.$current_language_db_prefix]);
	  
   	  echo $this->mwidgets->drawFeatRecipeImageAndText($title,$image ,$ing, $desc ,$calory, $ma3lomat_se7ia,$current_language_db_prefix);
	?>
	<div id="insert_message"></div>

    <div class="row" style="margin:5px;">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="center-block center share-buttons-wrapper">
            <?php
			$params = array('url' => $url, 'title' => $title,'member_id'=>$this->members->members_id);
			echo $this->sharing->sharing_recipe_mobile($params, $this->members->members_id); 
            ?>
             <div class="clear"></div>
            </div>
        </div>
    </div>
    
    <div class="thick-line background-color">&nbsp;</div>
    <div class="row comment-header border-top-color">
        <h2><?php echo lang('globals_comments'); ?></h2>
    </div>

	<div class="comment-section">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="comments_insert row" >
				<?php
                  $params = array('member_email'=>$this->members->members_email,'table'=>$table_name_for_rate,'foreign_id'=>$id,'member_id'=>$this->members->members_id, 'section_id'=>$current_section_id, 'current_section_background_color' => "");
            	echo $this->comments->insert_comments($params); 
                ?>
                </div>
                
                <div class="comments_result row">
                <?php
				$params = array('table'=>$table_name_for_rate,'foreign_id'=>$id );
				echo $this->comments->get_comments($params); 
                ?>
            </div><!--End of .comments_result-->
        </div>
    </div>
        
    <div class="thick-line background-color">&nbsp;</div>
    <div class="row">
        <div class="product">
           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 class="float_left"><?php echo lang('Products_help_in_cooking'); ?></h3>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php echo $this->mwidgets->generaterecipeproductwidget();?>
            </div>
        </div>   
    </div>
    <div class="thick-line background-color">&nbsp;</div>

        <div class="row">
            <div id="related-recipe-header">

                <h1><?php echo lang('elwasafatelmonasba'); ?></h1>
            </div>
            <div class="all-recipe">
               <?php for ($i = 0; $i < 4; $i++):?>
                <?php $id = $display_related_recipes[$i][$target_table.'_ID']; ?>
				<?php $topic_url_ran = site_url_mobile("best_cook/delicious_recipes/".$display_related_recipes[$i]['recipes_ID']);?>
                <?php $topic_title_ran = $display_related_recipes[$i]['recipes_title'];?>
						<?php 
						if($target_table == "recipes")
						{
						$title = $display_related_recipes[$i][$target_table.'_title'.$current_language_db_prefix];
										$image = $display_related_recipes[$i]['images_src'] == 'logo.png' ? base_url()."uploads/recipes/image_not_available".$current_language_db_prefix.'.png' : $this->config->item('recipes_img_link').$this->config->item('image_prefix').$display_related_recipes[$i]['images_src'];
						}
						else
						{
							$title = $display_related_recipes[$i][$target_table."_name"];
										$image = $display_related_recipes[$i]['images_src'] == 'logo.png' ? base_url()."uploads/recipes/image_not_available".$current_language_db_prefix.'.png' : $this->config->item('users_recipes_img_link').$this->config->item('image_prefix').$display_related_recipes[$i]['images_src'];

						}
						?>
					<?php $url = site_url_mobile($this->router->class."/".$this->router->method."/".generateSeotitle($id ,$title )); ?>
            <div class="col-xs-12 col-sm-6 col-md-6">

         	<a rel="external" href="<?php echo $url ?>"> <img src="<?php echo $image; ?>" width="100%" class="img-responsive related-recipe-img" /></a>
                       <h3 style="font-size: 10px; color:gray;"> <?php echo $this->common->limit_text($title,30) ; ?></h3>
                    
                    </div>
                 <?php endfor; ?>
            </div>
			</div>
            <div class="another-recipe">

               <div class="row"> <p class="ba2yElwasafat" style="font-weight:bold; padding:20px;"><?php echo lang('ba2yElwasafat'); ?></p></div>                   
                <div class="row">
<?php for ($i = 0; $i < sizeof($display_topics); $i++):?>
                    <div class="float_left col-md-3 col-sm-4 col-xs-6">
                    <div style="width:100%;background-color:red;padding:10px;color:white;margin:4px;text-align:center;">
                    <a rel="external" href="<?php echo site_url_mobile("best_cook/recipes_list/".$display_topics[$i]['inseason_recipies_ID']); ?>"> <?php echo $display_topics[$i]['inseason_recipies_title'.$current_language_db_prefix]; ?> </a>
                      </div>
                    </div>
    <?php endfor; ?>

                </div>


    </div>

</div>
<script type="text/javascript">
$(document).ready(function(e) {
	//Comments
	$('.comments_insert').hide();
	$('.toggle_input_comment').click(function(e) {
        $('.comments_insert').slideToggle('slow');
    });
	
	//load fancybox
	$("#single_1").fancybox({
		  width: 300,
          height: 180,
		  scrolling  :'no',
		  autoSize : false,
          fitToView : false,
          helpers: {title : {type : 'float'}}
      });

	//Add Comments
	 var baseurl = $('#baseurl').val();
	 var members_id = '<?php echo $this->members->members_id ?>';
    $('.submit_comment').submit(function(){
		var message = $.trim($('#message').val());
		 
		 if(message)
		 {

			$.ajax({
				url : baseurl+'en/ajax/insert_comments',
				data : $('form').serialize(),
				type: "POST",
			   success : function(){
				   if(members_id == 0)
				   {
					    $('.comment_big_input').val('<?php echo lang('globals_thanks_for_comment_not_login')?>');
				   }
				   else
				   {
				   		$('.comment_big_input').val('<?php echo lang('globals_thanks_for_comment')?>');
				   }
					//$(comment).hide().insertBefore('#insertbeforMe').slideDown('slow');
				}
			})
			return false;
		 }
		 else
		 {
			return false;
		 }
		
    });
	
	//Add To Book			
	$('.add_to_book').click(function(e) {
	var foreign_id = '<?php echo $id; ?>';
	var members_id = '<?php echo $this->members->members_id; ?>';
	var section_id = '<?php echo $current_section_id; ?>';
	var section_type = '<?php echo $table_name_for_rate; ?>';
	var type = 'recipes'; // articles
	
	$.ajax({
		  url:  "<?php echo site_url("ajax/insert_book"); ?>",
		  type: "POST",
		  data: {foreign_id : foreign_id , members_id : members_id , section_id : section_id , section_type : section_type ,type : type},
		  cache: false,
		  dataType: "json",
		  success: function(success_array)
		  {
			//alert('Inserted to your book');
			if(success_array.state == true)
			{
				$('#insert_message').html('<div style="text-align:center;margin-top:60px;"><h1><?php echo lang('globals_inserted_recipe');?></h1></div>');
			}
			else if(success_array.state == false)
			{
				$('#insert_message').html('<div style="text-align:center;margin-top:60px;"><h1 style="margin:10px;"><?php echo lang('globals_already_inserted_recipe');?></h1></div>');
			}

		  },
		  error: function(xhr, ajaxOptions, thrownError)
		  {
			
		  }
			  
		});
		
	});
});
</script>