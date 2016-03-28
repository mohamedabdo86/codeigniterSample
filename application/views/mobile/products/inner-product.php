 <style>
 .product-end-section{	
border:4px solid <?php echo $display[0]['products_brand_BGColor'];?> !important;
	}
	.all-products .all-product-header{
	background-color:<?php echo $display[0]['products_brand_BGColor'];?> !important;
		}
	.product-widget .header h2{
		color:<?php echo $display[0]['products_brand_BGColor'];?> !important;
		}	
	.product_color{
		color:<?php echo $display[0]['products_brand_BGColor'];?> !important;
		}	
	.product-widget .contact-block #contact-form a{
		background-color: <?php echo $display[0]['products_brand_BGColor'];?> !important;
		}	
.product-title-container{
	color:<?php echo $display[0]['products_brand_BGColor'];?> !important;
	}	
.product-text-container	{
	background-color:white;
	padding:10px;
	}	
 </style>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('mobile/css/recipe-style.css') ; ?>" />
   <?php include("small-product-slider.php");?>
<?php include("product-header.php");?>
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
<div class="row">
 <div class="col-xs-12 col-sm-12 col-md-12">
   <h1 class="main_product_header_title"><?php echo $display[0]['products_brand_name'.$current_language_db_prefix]; ?></h1>
 </div>
  <div class="product-end-section"></div>
  
  <div class="col-xs-12 col-sm-12 col-md-12">
  <img src="<?php echo $product_image;?>" class="img-responsive" style="width:100%;" title="<?php echo $display[0]['products_brand_name'.$current_language_db_prefix]; ?>"/>
  </div>
 <?php if(!empty($prepare_text)){?>
   <div class="col-xs-12 col-sm-12 col-md-12">
    <h2 class="product-title-container"> <?php echo lang('product_preparation'); ?></h2>
    <div class="product-text-container"><?php echo $prepare_text; ?></div>
  </div>
  <?php } ?>
  <?php if(!empty($brief_text)){?>
   <div class="col-xs-12 col-sm-12 col-md-12">
     <h2 class="product-title-container"> <?php echo lang('product_about_product'); ?></h2>
     <div class="product-text-container"><?php echo $brief_text; ?></div>
   </div>
   <?php }?>
<?php if(!empty($nutration_image)){?>
    <div class="col-xs-12 col-sm-12 col-md-12">
     <h2 class="product-title-container"> <?php echo lang('product_nutrition_guide'); ?></h2>
    <img alt="<?php echo $title;?>" title="<?php echo $title;?>" src="<?php echo $nutration_image;?>" style="width:100%;"  class="img-responsive"/>
   </div>
 <?php }?>  
</div>
<?php include("facebook-widget.php");?>