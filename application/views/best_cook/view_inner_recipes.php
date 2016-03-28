<div class="clear"></div>
<?php echo $this->load->view('template/submenu_writer');   ?>
<?php echo $this->load->view('template/tree_menu_writer');   ?>

<div class="clear"></div>

<style>
<!--Recipes-->
.recipes_wrapper
{
	min-height:500px;
	background-color:#fff;
	padding-top:10px;
}
.recipes_wrapper .image
{
	width:325px;
}
.recipes_wrapper .image img.image_recipe
{
	height:auto;
	margin-bottom:10px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	border: 1px solid #a7a7a7;
}
.recipes_wrapper h2
{
	font-size:20px;
	white-space:normal;
	font-weight:700;
	padding: 0 10px;
}
.recipes_wrapper h4
{
	padding:10px 0;
}
.recipes_wrapper .desc
{
	padding:10px 0;
	white-space:normal;
}
ul li.shape
{
	width: 70px;
	height: 146px; 
	border: 2px solid #999;
	border-top-right-radius: 35px;
	border-top-left-radius: 35px;
	border-bottom-right-radius: 35px;
	border-bottom-left-radius: 35px;
	margin: 3px;
}
ul li.shape h3
{
	font-size:12px;
	text-align:center;
}
.two_line
{
	line-height:13px;
}
.one_line
{
	line-height:30px;
}
ul li.shape h3.type
{
	margin-top: 16px;
	height:32px;
}
ul li.shape h3.name
{
	font-size:11px;
	margin-top: -8px;
	border-top: 2px solid #999;
}
ul li.shape .icon
{
	height:60px;
}
.two_column_first
{
	width:325px;
	padding: 0 2px;
}
.two_column_second
{
	width: 400px;
}
h3.sub_title
{
	font-size:16px;
	white-space:normal;
	font-weight:700;
	padding: 0 10px;
	line-height:28px;
}
.pargraph_two_column
{
	white-space:normal;
	padding: 0 10px;
	column-count:2;
	-moz-column-count:2; /* Firefox */
	-webkit-column-count:2; /* Safari and Chrome */
}
.pargraph_one_column
{
	white-space:normal;
	padding: 0 10px;
}
.image_ma3lomat
{
	
}
.dislike_image
{
	width:30px;
	height:30px;
	cursor:pointer;
	background:url(<?php echo base_url();?>images/icons/dislike_icon.png) -3px -3px;
}
.like_image
{
	width:30px;
	height:30px;
	cursor:pointer;
	background:url(<?php echo base_url();?>images/icons/like_icon.png) -3px 32px;
}
#boxscroll 
{
	/*padding: 10px 0;*/
	height: 625px;
	width: 395px;
	overflow: auto;
	margin-bottom: 20px;
}
.calories_image
{
	border:none;
	position: absolute;
	right: 206px;
	top: -7px;
}
body.arabic .calories_image
{
	position: absolute;
	right: -39px;
	top: -7px;
}

#download_disable_msg {
	position: absolute;
	display: none;
	margin-top: -38px;
	padding: 5px;
	margin-left: 125px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	color: #FFF;
	background:#E82327;
	z-index:3333;
}

body.arabic .play_icon{
	position:absolute;
	right:0;
	left:auto;
	border:none;
}

.play_icon{
	position:absolute;
	left:0;
	right:auto;
	border:none;
	margin: 10px 20px;
}
.arabic .sub_title best_cook_color float_left {
	width:30%;
	}
</style>
<script type="text/javascript">
$(document).ready(function(e) {
	
	$('.comments_insert').hide();
	$('.toggle_input_comment').click(function(e) {
        $('.comments_insert').slideToggle('slow');
    });
	
    $('.like_image').click(function(e) {
         $(this).css('backgroundPosition', '-3px -3px');
		 //$(this).parent().find('.dislike_icon').css("background-color", "#06F");
		 
    });
	
	$('.dislike_image').click(function(e) {
         $(this).css('backgroundPosition', '-3px 32px');
    });
	
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
          },
      });
	
});
</script>

<script type="text/javascript">
$(document).ready(function(e) {
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
					    $('.comment_big_input').val("");
					    $('.comment_big_input').attr("placeholder", '<?php echo lang('globals_thanks_for_comment_not_login')?>');
				   }
				   else
				   {
				   		$('.comment_big_input').val("");
					    $('.comment_big_input').attr("placeholder", '<?php echo lang('globals_thanks_for_comment')?>');
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
		
    })
});
</script>
<script type="text/javascript">
$(document).ready(function(e) {
    //$("#boxscroll").niceScroll({cursorborder:"",cursorcolor:"#7e7979",boxzoom:false}); 
	
	$(function(){
   	 $('#boxscroll').slimScroll({
        height: '640px',
		<?php
		if($current_language_db_prefix == "_ar"){
		?>
			position: 'right'
		<?php
		}else{
		?>
			position: 'left'
		<?php
			}
		?>
   	 });
	});

	$('.disable_rate').hover(
		function() {$('#disable_msg').show('fast')},
		function() {$('#disable_msg').hide('fast')}
	);
	
	$('#download_id').hover(
		function() {$('#download_disable_msg').show('fast')},
		function() {$('#download_disable_msg').hide('fast')}
	);
});
</script>

<div id="insert_message"></div>
<div class="inner_title_wrapper">

<div class="sections_wrapper_margin">
<h1 class="best_cook_color" style="font-size:24px;"><?php echo $this->headers->get_third_title() ?></h1>
</div>

</div><!-- End of inner_title_wrapper -->

<div class="thick_line best_cook_background_color"></div>

<?php
//Fix for the lists in order to apply both members and admin members in one lists
$id_column = $members_list_flag ? "members_recipes_ID" : "recipes_ID";
$title_column = $members_list_flag ? "members_recipes_name" : 'recipes_title'.$current_language_db_prefix;
$view_column = $members_list_flag ? "members_recipes_views" : "recipes_views";
$image_url =  $members_list_flag ?  $this->config->item('users_recipes_img_link') : $this->config->item('recipes_img_link');
//$view_column = $members_list_flag ? "" : "";
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

$download_pdf_link = "";
//$download_pdf_link =  $members_list_flag  ?  "" : $display_data[0]['recipes_pdf'.$current_language_db_prefix] == "0" ? "" :  base_url()."uploads/recipes_pdf/".'recipes_pdf'.$current_language_db_prefix;//To be checkd again 

?>



<div class="container_wrapper_1_item">
	<div class="recipes_wrapper float_left" style="width: 750px;">
    	<?php
			$id =$display_data[0][$id_column];
			$title = $display_data[0][$title_column];
			$views = $display_data[0][$view_column];
			$ing = $display_data[0][$ing_column];
			$desc = $display_data[0][$desc_column];
			
        	$image = $display_data[0]['images_src'] == "logo.png" ? base_url()."uploads/recipes/image_not_available".$current_language_db_prefix.".png" :  $image_url.$display_data[0]['images_src'];
			$url = site_url($this->router->class."/".$this->router->method."/".generateSeotitle($id ,$title ));
			
			if(!empty($display_recipe_video))
			{
				$video_url = $display_recipe_video[0]['videos_url'];
			}
			
			$ma3lomat_se7ia = "";	
			if(@$display_data[0]['recipes_nutrition_facts_image'.$current_language_db_prefix] != 0 && @!$members_list_flag )
			$ma3lomat_se7ia = $this->config->item('recipes_img_link').$this->globalmodel->get_image_src($display_data[0]['recipes_nutrition_facts_image'.$current_language_db_prefix]);
			 
		?>
        <script type="text/javascript">
		$(document).ready(function(e) {
						
			$("a[rel^='prettyPhoto']").prettyPhoto(
			{
				social_tools : false,
				deeplinking:false,
				theme:"facebook",
				show_title:false,
				default_width: 700,
				default_height: 420,
			});
						

			$('.add_to_book').click(function(e) {
			var foreign_id = '<?php echo $id; ?>';
			var members_id = '<?php echo $this->members->members_id; ?>';
			var section_id = '<?php echo $current_section_id; ?>';
			var section_type = '<?php echo $table_name_for_rate; ?>';
			var type = 'recipes'; // articles
			
			//alert(section_id);
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
						$('#insert_message').html('<div style="text-align:center;margin-top:44px;"><h1><?php echo lang('globals_inserted_recipe');?></h1></div>');
						//alert('<?php //echo lang('globals_inserted'); ?>');
					}
					else if(success_array.state == false)
					{
						$('#insert_message').html('<div style="text-align:center;margin-top:60px;"><h1 style="margin:10px;"><?php echo lang('globals_already_inserted_recipe');?></h1></div>');
						//alert('<?php //echo lang('globals_already_inserted');?>');
					}

				  },
				  error: function(xhr, ajaxOptions, thrownError)
				  {
					
				  }
					  
				});
				
			});
		});
		</script>
        <div class="first_container global_background" style="padding:10px; margin-top:10px;">
        <div class="two_column_first float_left">
            <div class="image float_left">
            <?php if(!empty($display_recipe_video)){ ?>
            	<a href="<?php echo $video_url;?>" title="<?php echo $title.lang('globals_video'); ?>" rel="prettyPhoto"><img height="25" class="play_icon" src="<?php echo base_url()."images/cam.png"; ?>"  /></a>
            <?php } ?>
                <img class="image_recipe" src="<?php echo $image?>" width="323" alt="<?php echo $title?>"  />
                <div class="clear"></div>
               
                <div>
                	 <!--Start Rating And Views-->
                    <div class="rating_wrapper_container" style="margin-top: -10px;">

                       <div class="rating float_right" style="width: 90px; margin:5px 0">
                       
                        <?php
                            $params = array('table'=>$table_name_for_rate,'foreign_id'=>$id);
                            echo $this->rate->get_recipe_rate($params);
                        ?>
                        </div><!--End Of Rating-->
	                    <span class="readmore float_right" style="line-height: 28px; width:30%;"><?php echo lang('globals_rate_recipe')?></span>
                        <span style="line-height: 29px;font-size: 15px;" class="dark_gray float_left" >( <?php echo $views;?> ) <?php echo lang('globals_views');?></span>
                        <!--End Of Views-->
                        <div class="clear"></div>
                    </div>
                    
                    <!--Start social-->

					<div class="social_big_icon float_right">
                    <?php
	$shareurl = site_url($this->router->class."/".$this->router->method."/".$id);
                    $params = array('url' => $shareurl, 'title' => $title,'member_id'=>$this->members->members_id,'download_link'=>$download_pdf_link , 'members_list_flag' => $members_list_flag);
				  // $params = array('url' => $url, 'title' => $title,'member_id'=>$this->members->members_id);
                    echo $this->sharing->sharing_recipe($params); 
                    
					?> 
                    </div><!--End Of .Big social-->
                    
                    
                </div><!--End Of .social_wrapper_contanier-->
                <div class="clear"></div>
            </div>
            <?php 
			if($ma3lomat_se7ia != ""):
			?>
            <div class="image_ma3lomat float_left" style="margin:10px 0 0px;; position:relative;">
            <a class="fancybox" href="<?php echo $ma3lomat_se7ia ?>" ><img class="calories_image" src="<?php echo base_url()."images/bestcook/best_cookballon_nutration".$current_language_db_prefix.".png"; ?>" /></a>
            <a class="fancybox" href="<?php echo $ma3lomat_se7ia ?>" ><img style="width: 325px;border:none;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;border: 1px solid #a7a7a7;" src="<?php echo $ma3lomat_se7ia?>" /></a>
            
            </div>
            <?php
			endif;
				?>
            <div class="image_wasfa float_left" style="margin-bottom:10px; margin-top:10px;">
            <a href="<?php  echo site_url('best_cook/upload_recipe');?>">
            	<img style="width: 325px;border:none;" src="<?php echo base_url()."images/bestcook/eba3aty_wasftk".$current_language_db_prefix.".png"?>" />
            	<h3 style="font-size: 14px;line-height: 14px;text-align: center;color: #fff;"><?php echo lang('bestcook_send_and_share');?></h3>
            </a>
            </div>
            
        </div>
        
        
        
      <div class="two_column_second float_right">
        
        
        <h2 class="title dark_gray"><?php echo $title;?></h2>
        
        
        <ul>
        	<li class="shape float_left">
            	<h3 class="type dark_gray" ><?php echo lang('bestcook_the_processing_time');?></h3>
                <div class="icon" align="center"><img src="<?php echo base_url()?>images/icons/prepare_time.png"  /></div>
                <h3 class="name dark_gray one_line" ><?php echo $display_data[0][$process_time] == "" ? "-" : $display_data[0][$process_time]; ?><?php echo lang('bestcook_minutes'); ?></h3>
            </li>

            <li class="shape float_left">
            	<h3 class="type dark_gray" ><?php echo lang('bestcook_recipe_type'); ?></h3>
                <div class="icon" align="center"><img src="<?php echo base_url()?>images/icons/cook_type.png"  /></div>
                <h3 class="name dark_gray one_line" style="line-height: 19px;" ><?php
				if($display_data[0][$recipe_type] == "" ){
					echo "-";
					}else{
						 $dish_type=$this->recipesmodel->get_dish_type($display_data[0][$recipe_type]);
						 echo $dish_type [0]['dish_name'.$current_language_db_prefix];
						 
						}
				
			//	 echo $display_data[0][$recipe_type] == "" ? "-" : $this->recipesmodel->get_dish_type($display_data[0][$recipe_type])[0]['dish_name'.$current_language_db_prefix]; ?></h3>
            </li>
            <li class="shape float_left">
            	<h3 class="type dark_gray" ><?php echo lang('bestcook_Preparation_time');?></h3>
                <div class="icon" align="center"><img src="<?php echo base_url()?>images/icons/cooking_time.png"  /></div>
                <h3 class="name dark_gray one_line"><?php echo $prep_time == "" ? "-" : $display_data[0][$prep_time].lang("bestcook_minutes"); ?></h3>
            </li>
            <li class="shape float_left">
            	<h3 class="type dark_gray"><?php echo lang('bestcook_enough');?></h3>
                <div class="icon" align="center"><img src="<?php echo base_url()?>images/icons/people.png" /></div>
                <h3 class="name dark_gray one_line"><?php echo $servies == "" ? "-" : $display_data[0][$servies].lang("bestcook_persons"); ?></h3>
            </li>
            <li class="shape float_left">
            	<h3 class="type dark_gray"><?php echo lang('bestcook_cuisine');?></h3>
                <div class="icon" align="center"><img src="<?php echo base_url()?>images/icons/matba5.png"  /></div>
                <h3 class="name dark_gray one_line"><?php 
				if($display_data[0][$cuisine] == ""){
					echo "-";
					}else{
					$cuisine_type=$this->recipesmodel->get_single_cuisine($display_data[0][$cuisine]);
					echo $cuisine_type[0]['cuisines_name'.$current_language_db_prefix];	
					}
				//echo $display_data[0][$cuisine] == "" ? "-" : $this->recipesmodel->get_single_cuisine($display_data[0][$cuisine])[0]['cuisines_name'.$current_language_db_prefix] ; ?></h3>
            </li>
        </ul>
        <div class="clear"></div>
        
        
        <div id="boxscroll">
        <?php
        if($ing)
		{
			echo '<h3 class="sub_title best_cook_color">'.lang("bestcook_ingredients").' : </h3>';
			echo '<div class="pargraph_two_column dir">'.$ing.'</div>';
		}
		?>

        <h3 class="sub_title best_cook_color"> <?php echo lang('bestcook_prepration');?> : </h3>
        <div class="pargraph_one_column"><?php echo $desc; ?></div>
         <div class="readmore best_cook_color float_right" style="margin:10px;"><a onclick="javascript:history.go(-1)" href="javascript:void(0);"><?php echo lang('globals_back');?></a></div>
		
        <!-- <div class="clear"></div> -->
        </div><!--End Of Description-->
         
         
         </div><!--End of two_column_second-->
    	<div class="clear"></div>
        
        </div><!--Enf of .first_container-->
        
        <div class="second_container">
        <div class="rate_recipes">
        
        <div class="rate_wrapper_right float_left" style="width:477px; height:auto;">
        	<div style=" padding:5px 10px;">
            	<div>
                
        		<h3 class="sub_title best_cook_color float_left" style="line-height: 30px;"><?php echo lang('globals_opinion_important')?></h3>
                
                <div class="rating float_left" style="width: 90px; margin:5px">
				<?php
				if($this->members->members_id)
				{
                    $params = array('table'=>'members_rate','type'=>'recipes','foreign_id'=>$id,'member_id'=>$this->members->members_id);
					echo $this->rate->get_member_rate($params);
				}
				else
				{
					$params = array('current_section_background_color'=>$current_section_background_color);
					echo $this->rate->get_disable_rate($params);
				}
                ?>
                </div><!--End Of Rating-->
                 <div class="clear"></div>
                </div>
                <div class="clear"></div>
        	</div>
            <h4 style="padding: 5px 11px;font-weight: 600;color: #777;">
            <?php echo lang('globals_your_opinion')?>
            </h4>
          </div><!--End of rate_wrapper_right-->
          <div class="rate_wrapper_left float_right" style="width: 260px;height: auto;margin-top: 21px;">
          	<a class="toggle_input_comment best_cook_background_color"><?php echo lang('globals_add_comment_recipe')?></a>
          </div>
          <div class="clear"></div>
        </div><!--End of .rate_recipes-->
        <div class="comments_insert">
        	<?php

            	$params = array('member_email'=>$this->members->members_email,'table'=>$table_name_for_rate,'foreign_id'=>$id,'member_id'=>$this->members->members_id , 'section_id'=>2, 'current_section_background_color' => $current_section_background_color);
			    echo $this->comments->insert_comments($params); 
			?>
        </div>
        
        <div class="comments_result">
        	<?php
            	$params = array('table'=>$table_name_for_rate,'foreign_id'=>$id);
			    echo $this->comments->get_comments($params); 
			?>
        
        </div>
        </div><!--End of .second_container-->
        
        
     </div><!--End Of .recipes_wrapper-->
        
    <!--Start Of .sidebar-->   
    <div class="sidebar float_right">
    
    <div class="image_side_bar">
    	<a href="<?php echo site_url('best_cook/applications/1')?>"><img style="border:none;" width="240" src="<?php echo base_url().'images/bestcook/upload_recipe_banner'.$current_language_db_prefix.'.jpg'?>" /></a>
    </div>
    
        <div class="related_3_items_list_wrapper">
			<h2><?php echo lang('bestcook_related_recipes'); ?></h2>
            <ul class="bxslider">
            <?php
            for($i=0 ; $i < sizeof($display_related_recipes) ; $i++):
			
			$id = $display_related_recipes[$i][$target_table.'_ID'];
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
			
			$url = site_url($this->router->class."/".$this->router->method."/".generateSeotitle($id ,$title ));

            ?>
                <li>
                <div class="image"><a href="<?php echo $url ?>" title="<?php echo $title?>"><img src="<?php echo $image;?>" alt="<?php echo $title;?>"  ></a></div>
                <div class="title float_left dark_gray"><a href="<?php echo $url ?>"><?php echo $title;?></a></div>
                <div class="readmore <?php echo $current_section_color  ?> float_right" style="margin: 0 10px;"><a href="<?php echo $url ?>"><?php echo lang('globals_more');?></a></div>

                <div class="clear"></div>
                </li>
            <?php
            endfor;
            ?>
      
            </ul>

		</div><!--End Of .related_3_items_list_wrapper -->
	</div><!--End of SideBar-->


<div class="clear"></div>


</div><!-- End of container_wrapper_1_item -->


<div class="clear"></div>