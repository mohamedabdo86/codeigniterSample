<link href="<?php echo base_url(); ?>css/products.css" rel="stylesheet">
<?php $this->load->view('template/submenu_writer_products');   ?>
<?php $this->load->view('template/tree_menu_writer');   ?>
<script>

$(function(){
    $('.product_preparation_text').slimScroll({
        height: '400px',
		<?php
		if($current_language_db_prefix == "_ar"){
		?>
			position: 'left'
		<?php
		}else{
		?>
			position: 'right'
		<?php
			}
		?>
    });
});

$(document).ready(function()
{
  /*$(".product_preparation_text").scrollbar({orientation: 'vertical' ,autoReinitialise: true});*/
  //$("#articles_content").niceScroll({cursorborder:"",cursorcolor:"#7e7979",boxzoom:false});

  $(".ui-slider-handle").mouseout(function(){
	  $(this).css('background', '#666;');
  });
});
</script>

<style>

#titles #list li a:hover{color:<?php echo $display[0]['products_brand_BGColor']; ?>;}

.category_tab #list li a:hover{color:<?php echo $display[0]['products_brand_BGColor']; ?>;}

#tab-slider {
    width:545px;
    height:420px;
    margin: 0 auto;
    position:relative;
    overflow:hidden;
}
.tab-content 
{
	height: 420px;
	width: 544px;
	float: left;
	margin-right: 1px;
}
ul.tab-nav li.active {
    background-color: #FCFAFA;
    border-bottom:none;
}
ul.tab-nav li.active a {
    color:<?php echo $display[0]['products_brand_BGColor']; ?>;
}
.product_preparation_text
{
	padding:10px;
}
.product_preparation_text p
{
	font-size:14px;
}
.bdslider li
{
	margin-right: 18px !important;
}

.mnslider li
{
	width:130px;
	float:left;
}

.bx-wrapper
{
	padding: 0 30px !important;
}
#flavours_wrapper
{
	margin-bottom:7px;
	width:100%;
	height:205px;
}
.flavours_wrapper_slider{
	width:160px; height:160px; margin-top: 0px; margin-left: 40px;
}
#back:hover{color:<?php echo $display[0]['products_brand_BGColor']; ?>;}

.ui-slider-handle:hover{background:#666;}

.ui-slider-handle{background:#9E9E9E;min-height:20px !important;border-radius:10px;}

</style>

<script type="text/javascript">
$(document).ready(function(e) {
$(".view_flavour").click(function(){

	var item = $(this);
	var id = item.attr('rel');
	
	 $.ajax({
            url : "<?php echo site_url($this->router->class.'/get_flavour_data'); ?>",
            data : {id : id, brand_id : <?php echo $brand_id ?>},
            type: "POST",
			cache: false,
			dataType: "json",
          	success : function(success_array)
			{	
			   $("#products_slider_container").html(success_array.falvour_data);
			   
			   $(".nutriatoin_sp_button").click(function(e) {
			  	$("#nutration_button_trigger").trigger("click");
		  		});
				
			   $('.bdslider').bxSlider({
					mode: 'horizontal',
					slideWidth: 900,
					minSlides: 1,
					maxSlides: 1,
					moveSlides: 1,
					slideMargin: 10,
					nextText : '',
					prevText : '',
					pager: false,
					infiniteLoop: false ,
					controls: false,
					hideControlOnEnd: true,
				});
			 	 var $width = 545, //The width in pixels of your #tab-slider 
				$tabs = $('.tab'), //Your Navigation Class Name
				$delay = 600; // Pause time between animation in Milliseconds
				$('.tab-slider-wrapper').css({width: $tabs.length * $width});$('a.tab-link').click(function() {$tabs.removeClass('active');$(this).parent().addClass('active');var $contentNum = parseInt($(this).attr('rel'), 10);$('.tab-slider-wrapper').animate({marginLeft: '-' + ($width * $contentNum - $width)}, $delay);return false;});

            }
        })
		return false;
    });
});
</script>
<?php $this->load->view('products/view_slideshow');   ?>

<?php 
if($display_flavours)
{
	$title = $display_flavours[0]['products_flavour_title'.$current_language_db_prefix];
	$image_url = $this->config->item('products_img_link');
	$product_image = $image_url.$display_flavours[0]['images_src'];
	$prepare_text = $display_flavours[0]['products_flavour_desc'.$current_language_db_prefix];
	$brief_text = strip_tags($display_flavours[0]['products_flavour_text'.$current_language_db_prefix]);
	$products_available_sizes = $display_flavours[0]['products_flavour_available_sizes'.$current_language_db_prefix];
	$nutration_image = false;
	
	if($display_flavours[0]['products_flavour_nutrition_img'.$current_language_db_prefix])
	{
		$nutration_image = $image_url.$this->globalmodel->get_image_src($display_flavours[0]['products_flavour_nutrition_img'.$current_language_db_prefix]);
	}
}
else
{
	//Initlize values here
	$title = $display_subproduct[0]['products_name'.$current_language_db_prefix];
	$image_url = $this->config->item('products_img_link');
	$product_image = $image_url.$display_subproduct[0]['images_src'];
	$prepare_text = $display_subproduct[0]['products_text'.$current_language_db_prefix];
	$brief_text = strip_tags($display_subproduct[0]['products_brief_text'.$current_language_db_prefix]);
	$products_available_sizes = $display_subproduct[0]['products_available_sizes'.$current_language_db_prefix];
	$nutration_image = false;
	
	if($display_subproduct[0]['products_nutrition_image'.$current_language_db_prefix])
	{
		$nutration_image = $image_url.$this->globalmodel->get_image_src($display_subproduct[0]['products_nutrition_image'.$current_language_db_prefix]);
	}
}
?>
<div class="clear"></div>

<div id="products_slider_container">
<div id="products_slider">
               <div id="main_product_header_title">
               		<h1 title="<?php echo $display[0]['products_brand_name'.$current_language_db_prefix]; ?>" id="slider_tag" class="product_color product_borderbottom_color"><?php echo $display[0]['products_brand_name'.$current_language_db_prefix]; ?></h1>
            	</div>
                <div id="titles">
					<?php
					if(!$display_flavours){
						echo '<div class="main_product_title"></div>';
					}else{
						echo '<div class="main_product_title"><h3 title="'.$title.'" class="float_left product_2nd_color">'.$title.'</h3></div>';
					}
					?>
                    <ul id="list" class="tab-nav float_right">
                    <?php
					if(empty($prepare_text) && empty($brief_text))
					{
						echo '<li class="tab"><a id="nutration_button_trigger" tile="'.lang('product_nutrition_guide').'" class="tab-link" href="#section1" rel="1">'.lang('product_nutrition_guide').'</a></li>';
					}
                    elseif(empty($brief_text))
					{
						echo '<li class="tab active"><a title="'.lang('product_nutrition_guide').'" id="nutration_button_trigger" class="tab-link" href="#section2" rel="2">'.lang('product_nutrition_guide').'</a></li> | ';
						echo '<li class="tab"><a title="'.lang('product_preparation').'" class="tab-link" href="#section1" rel="1">'.lang('product_preparation').'</a></li>';

					}
					else if(empty($prepare_text))
					{
						echo '<li class="tab"><a title="'.lang('product_nutrition_guide').'" id="nutration_button_trigger" class="tab-link" href="#section2" rel="2">'.lang('product_nutrition_guide').'</a></li> | ';
						echo '<li class="tab active"><a title="'.lang('product_about_product').'" class="tab-link" href="#section1" rel="1">'.lang('product_about_product').'</a></li>';
					}
					
					else
					{
					?>
                        <li class="tab"><a title="<?php echo lang('product_preparation'); ?>" class="tab-link" href="#section2" rel="2"><?php echo lang('product_preparation'); ?></a></li> | 
                        <li class="tab active"><a title="<?php echo lang('product_about_product'); ?>" class="tab-link" href="#section1" rel="1"><?php echo lang('product_about_product'); ?></a></li> | 
                   		<li class="tab"><a title="<?php echo lang('product_nutrition_guide'); ?>" id="nutration_button_trigger" class="tab-link" href="#section3" rel="3"><?php echo lang('product_nutrition_guide'); ?></a></li>
				   <?php }?>
                   </ul>
                </div>
                
                <!------------>
                
<div class="related_3_items_list_wrapper <?php echo $current_section_color ?>">


<script type="text/javascript">
$(document).ready(function(e) {
	$('.bdslider').bxSlider({
	 	mode: 'horizontal',
	   	slideWidth: 900,
		minSlides: 1,
		maxSlides: 1,
		moveSlides: 1,
		slideMargin: 10,
		nextText : '',
		prevText : '',
		pager: false,
		infiniteLoop:true ,
	});
	
$('.mnslider').bxSlider({
	 	mode: 'horizontal',
	   	slideWidth: 900,
		minSlides: 3,
		maxSlides: 3,
		moveSlides: 1,
		slideMargin: 10,
		nextText : '',
		prevText : '',
		pager: false,
		infiniteLoop:true ,
	});
	
    var $width = 545, //The width in pixels of your #tab-slider 
        $tabs = $('.tab'), //Your Navigation Class Name
        $delay = 600; // Pause time between animation in Milliseconds
   
    $('.tab-slider-wrapper').css({width: $tabs.length * $width});
	$('a.tab-link').click(function() {$tabs.removeClass('active');
	$(this).parent().addClass('active');var $contentNum = parseInt($(this).attr('rel'), 10);
	$('.tab-slider-wrapper').animate({marginLeft: '-' + ($width * $contentNum - $width)}, $delay);return false;});

});
</script>
<script>
$(document).ready(function(e) {
    
	$(".nutriatoin_sp_button").click(function(e) {
        
		$("#nutration_button_trigger").trigger("click");
		
    });
	
});
</script>


            <div class="related_3_items_list_wrapper best_cook_color">
            <ul class="bdslider">
                 
                <li>
                	<div class="slide">
                    <div id="slide_summary" class="float_right">
                    <div id="tab-slider">
                    <div class="tab-main-content">
                <div class="tab-slider-wrapper">
                    <?php
					if(empty($prepare_text) && empty($brief_text))
					{
						echo '<div class="tab-content gray_container_shadow" id="section2">
								<div align="center"><div class="nutration_product_image"><img alt="'.$title.'" title="'.$title.'" src="'.$nutration_image.'" width="520" height="405" id="slide_image" style="margin-top: 7px;" alt="" /></div></div>
							</div>';
					}
                    else if(empty($brief_text))
					{

						echo '<div class="tab-content gray_container_shadow" id="section2">
								  <div style="margin:10px;">
									  <div class="product_preparation_text">'.$prepare_text.'</div>
								  </div>
							  </div>';
						echo '<div class="tab-content gray_container_shadow" id="section1">
								  <div align="center"><div class="nutration_product_image"><img alt="'.$title.'" title="'.$title.'" src="'.$nutration_image.'" width="520" height="405" id="slide_image" style="margin-top: 7px;" alt="" /></div></div>
							  </div>';
					}
					else if(empty($prepare_text))
					{
						echo '<div class="tab-content" id="section1">
								 <div class="mini_summary">
									<div class="main_about_products"><p class="mini_summary_about"></p></div>
								 </div>
							</div>';
						echo '<div class="tab-content gray_container_shadow" id="section1">
								  <div align="center"><div class="nutration_product_image"><img alt="'.$title.'" title="'.$title.'" src="'.$nutration_image.'" width="520" height="405" id="slide_image" style="margin-top: 7px;" alt="" /></div></div>
							  </div>';
							  
					}
					
					else
					{
					?>
                    <div class="tab-content test_scroll" id="section1">
                         <div class="mini_summary">
                         	<div class="main_about_products"><p class="mini_summary_about"><?php echo $brief_text; ?></p></div>
                         </div>
                    </div>
                    <div style="" class="tab-content test_scroll gray_container_shadow" id="section2">
                        <!--<div style="margin:10px; height:420px;" id="preparation_scroll">-->
                        	<div class="product_preparation_text" style="height:410px;"><?php echo $prepare_text;?></div>
                            <!--<img  src="http://data1.whicdn.com/images/53017226/thumb.png" />-->
                        <!--</div>-->
                    </div>
                    <div class="tab-content gray_container_shadow" id="section3">
                        <div align="center"><div class="nutration_product_image"><img alt="<?php echo $title ?>" title="<?php echo $title ?>" src="<?php echo $nutration_image; ?>" width="520" height="405" id="slide_image" style="margin-top: 7px;" /></div></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            </div>
            </div>
            
            <div class="float_left" style="width:340px;height:430px; position:relative; background-position-x:center; background-position-y:center; background-repeat:no-repeat;">
            <div class="product_background_color" style="width:340px; height:430px; position:absolute; left:0px;top:0px; z-index:99;"></div>
            <div title="<?php echo $title; ?>" class="main_product_image"><div style="width:340px; height:430px; position:absolute; left:0px;top:0px;background-position-x:center; background-position-y:center; background-position:center; background-repeat:no-repeat; background-image:url(<?php echo $product_image; ?>); z-index:999; background-size: 80%;"></div></div>
            
            <a class="float_left nutriatoin_sp_button" style="cursor:pointer;position:relative; z-index:9991; margin:10px;"><img title="<?php echo $title; ?>" alt="<?php echo $title; ?>" src="<?php echo base_url()."images/bestcook/best_cookballon_nutration".$current_language_db_prefix.".png"; ?>" height="110" /></a>
            <?php
					 if($products_available_sizes != ""):
					 ?>
            <div class="sizes_wrapper global_background">
            	<div style="margin:10px;">
              		
                    
<?php /*?>    				<strong><?php echo lang('product_available_sizes'); ?></strong>
<?php */?>					
                    <div class="mini_summary">
                     <p class="mini_summary_hint"><?php echo $products_available_sizes; ?></p></div>
                    
                  </div>
            </div><!-- End of sizes_wrapper  -->
             <?php
					 endif;
					 ?>
            </div>
            <?php /*?><img src="<?php echo base_url(); ?>/images/products/img-1.png" id="slide_image" class="float_left" alt="" /><?php */?>
                    
                    </div>
                             
                	
                </li>
                  
                
                </ul>

		</div>
        </div>
        <?php
		if(!$only_one_product_flag):
		?>
        <a title="<?php echo lang('product_back_link'); ?>" href="<?php echo site_url("products/index/".$brand_id); ?>" class="float_right" id="back">&#8592; <?php echo lang('product_back_link'); ?></a>
        <?php
		endif;
		?>
  </div><!-- End of slider div -->
  </div><!-- End of slider container -->
  
  
<?php

	if(!empty($display_flavours))
	{
		$this->load->view('products/view_flavours'); 
	}
	if(!empty($display_promotions))
	{
		$this->load->view('products/product_promotions'); 
	}
	if(!empty($display[0]['products_brand_facebook_url']))
	{
		$this->load->view('products/view_facebook_widget');
	}
	$this->load->view('products/product_poll');
	
	if((!empty($display_videos)) && ((empty($display_recipes)) && (empty($display_articles))))
	{
		if(empty($display[0]['products_brand_facebook_url']))
		{
	  		$this->load->view('products/products_videos_list');
		}
		else
		{
			$this->load->view('products/product_video_normal_scenario');  
		}	  
	}
	else
	{
		if(!empty($display[0]['products_brand_facebook_url']))
		{
			if($display_recipes && $display_articles && $display_videos)
			{
				$this->load->view('products/products_videos_list');
				$this->load->view('products/product_articles_recipes');
			}
		}
		else
		{
			if($current_language_db_prefix == "_ar")
			{
				?>
				<style>
				.articles_recipes{float:left !important;}
				</style>
				<?php
			}
			else
			{
				?>
				<style>
				.articles_recipes{float:right !important;}
				</style>
				<?php
			}
			$this->load->view('products/product_articles_recipes');
			
			if($display_videos)
			{
				$this->load->view('products/product_video_normal_scenario');
			}			
		}
	}

?>