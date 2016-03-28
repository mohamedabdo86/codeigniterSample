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
</style>	
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('mobile/css/recipe-style.css') ; ?>" />
   <?php include("small-product-slider.php");?>
   <?php include("product-header.php");?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
              <?php echo $this->mwidgets->drawCommentsSection($brand_id  , $comment_table);?>

        </div>
   </div>
