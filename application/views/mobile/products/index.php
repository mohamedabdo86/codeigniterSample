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
		.single-product #single-product-header{
		color: <?php echo $display[0]['products_brand_font_color'];?> !important;
		}
		.advertisement h3{
			color: <?php echo $display[0]['products_brand_BGColor'];?> !important;
			}
			.arabic .swiper-container-images .swiper-wrapper{
				float:left;
				}
</style>
<div style="padding-left:12px; padding-right:12px;">
<div class="row">
<div class="col-xs-12"></div>

 <link rel="stylesheet" type="text/css" href="<?php echo base_url('mobile/css/recipe-style.css') ; ?>" />
    <?php include("small-product-slider.php");?>
    <?php include("product-header.php");?>
    <div class="product-end-section"></div>
    <?php include("products.php");?>
     <div class="product-end-section"></div>
    <?php include("facebook-widget.php");?>
     <div class="product-end-section"></div>
    <?php //include("product-promotions.php");?>
     <div class="product-end-section"></div>
    <?php include("product-videos.php");?>
      
 </div>
 </div>