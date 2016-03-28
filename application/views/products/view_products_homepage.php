<link href="<?php echo base_url(); ?>css/products.css" rel="stylesheet">
 
<?php $this->load->view('template/submenu_writer_products');   ?>
<?php $this->load->view('template/tree_menu_writer');   ?>
<?php $this->load->view('products/view_slideshow');   ?>

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
	overflow: hidden;
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


.bdslider li
{
	margin-right: 18px !important;
}

.mnslider li
{
	width:130px;
	float:left;
}

.bslider li
{
	width:300px !important;
	margin-right: 18px !important;
}
.bx-wrapper
{
	padding: 0 30px !important;
	margin: 0 auto 15px !important;
}
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
</style>

<div class="clear"></div>


<div class="related_3_items_list_wrapper <?php echo $current_section_color ?>">

            <div id="products_slider">
            <h1 title="<?php echo $display[0]['products_brand_name'.$current_language_db_prefix]; ?>" id="slider_tag" class="product_color product_borderbottom_color"><?php echo $display[0]['products_brand_name'.$current_language_db_prefix]; ?></h1>
            <div class="related_3_items_list_wrapper best_cook_color">
            <ul class="bslider">
                  <?php

				  for($i=0 ; $i < sizeof($display_subproduct); $i++):
				  $id = $display_subproduct[$i]['products_ID'];
				  $title = $display_subproduct[$i]['products_name'.$current_language_db_prefix];
				  $short_desc = strip_tags($display_subproduct[$i]['products_brief_text'.$current_language_db_prefix]);
				  $image_url = $this->config->item('products_img_link');
				  $image = $image_url.$display_subproduct[$i]['images_src'];
				  
				  $mixed_array = array("®", "+");
				  
				  $strip_title = str_replace($mixed_array,"",$title);
				  $last_strip_title = trim($strip_title);
				  
				  $strip_brand_title = str_replace($mixed_array,"",$brand_name);
				  $last_strip_brand_title = trim($strip_brand_title);
				   
				  		
				  $url = site_url("products/product_details/".generateSeotitle($brand_id,$last_strip_brand_title)."/".generateSeotitle($id,$last_strip_title));
				  ?>
                  <li>
                	<div class="panel">
                    	<a href="<?php echo $url; ?>" title="<?php echo $title; ?>">
                    	<h3 title="<?php echo $title; ?>" class="product_2nd_color"><?php echo $title; ?></h3>
                        <div title="<?php echo $title; ?>" class="image_wrapper product_background_color" style="border:none;background-image:url(<?php echo $image; ?>); background-size:100%; background-color: #fff !important;"><img style=" display:none;border:none" src="" id="panel_image" alt="<?php echo $title; ?>" /></div>
                        </a>
                    </div>         
                	<div class="clear"></div>
                </li>
                <?php
				endfor;
				?>
                 
                
                </ul>

		</div>
        </div>

<?php

	 if(!empty($display_flavours)){
		  $this->load->view('products/view_flavours'); 
	  }
	  if(!empty($display_promotions)){
		  $this->load->view('products/product_promotions'); 
	  }
	  if(!empty($display[0]['products_brand_facebook_url'])){
		  $this->load->view('products/view_facebook_widget');
	  }
		  $this->load->view('products/product_poll');
		  
	  if((!empty($display_videos)) && ((empty($display_recipes)) && (empty($display_articles)))){
		  if(empty($display[0]['products_brand_facebook_url'])){
			  $this->load->view('products/products_videos_list');
		  }else{
			  $this->load->view('products/product_video_normal_scenario');  
		  }  
	  }else{
		if(!empty($display[0]['products_brand_facebook_url'])){
			if(((empty($display_recipes)) && (empty($display_articles)))){
			$this->load->view('products/product_video_normal_scenario');  
			}else{
			$this->load->view('products/products_videos_list');
			$this->load->view('products/product_articles_recipes');
			}
		}else{
			if($current_language_db_prefix == "_ar"){
			?>
            <style>
            .articles_recipes{float:left !important;}
            </style>
            <?php
			}else{
			?>
            <style>
            .articles_recipes{float:right !important;}
            </style>
            <?php
			}
			$this->load->view('products/product_articles_recipes');
			$this->load->view('products/product_video_normal_scenario');  
		}
	  }
		//$this->load->view('products/product_promotions');   
		//$this->load->view('products/product_poll');
		//$this->load->view('products/view_facebook_widget');
		//$this->load->view('products/product_video_listonly_scenario');
	
	
	    //$this->load->view('products/view_flavours'); 
			
		//$this->load->view('products/products_footer_with_polls_videos');
	
		//$this->load->view('products/products_footer_with_polls_articlesandrecipes_videos');
	
?>

  </div>
</div>

<script type="text/javascript">
$(document).ready(function(e) {
	$('.bslider').bxSlider({
	 	mode: 'horizontal',
	   	slideWidth: 900,
		minSlides: 3,
		maxSlides: 3,
		moveSlides: 1,
		slideMargin: 10,
		nextText : '',
		prevText : '',
		pager: false,
		infiniteLoop:false ,
		controls: true,
		hideControlOnEnd: true,
		<?php if($current_language_db_prefix == "_ar"){ ?>
		<?php //echo 'startSlide: '.$jump.','; ?>
		<?php }?>
	});
	
	$(document).ready(function() {
    var $width = 545, //The width in pixels of your #tab-slider 
        $tabs = $('.tab'), //Your Navigation Class Name
        $delay = 600; // Pause time between animation in Milliseconds
   
    $('.tab-slider-wrapper').css({width: $tabs.length * $width});$('a.tab-link').click(function() {$tabs.removeClass('active');$(this).parent().addClass('active');var $contentNum = parseInt($(this).attr('rel'), 10);$('.tab-slider-wrapper').animate({marginLeft: '-' + ($width * $contentNum - $width)}, $delay);return false;});
	
	});
});
</script>