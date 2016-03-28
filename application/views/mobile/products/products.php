<style>
.single-product #single-product-header
{
	background-color: #EAEAEA !important ;
	color: #263D88 !important;
}
</style>
    <div class="row">

        <div class="swiper-container-product">
                <div class="swiper-wrapper">
        <?php for($i=0 ; $i < sizeof($display_subproduct); $i++):
				  $id = $display_subproduct[$i]['products_ID'];
				  $title  = $display_subproduct[$i]['products_name'.$current_language_db_prefix];
				  $short_desc = strip_tags($display_subproduct[$i]['products_brief_text'.$current_language_db_prefix]);
				  $image_url = $this->config->item('products_img_link');
				  $image = $image_url.$display_subproduct[$i]['images_src'];
				  $url = site_url("mobile/products/product_details/".$brand_id."/".$id);?>
          <div class="swiper-slide">
                            <div class="inner-slider-container">
            <div class="single-product col-xs-12 col-sm-12">
                <div id="single-product-header">
                    <p style="font-weight:bold"><?php echo $this->common->limit_text($title,30); ?></p>
                </div>
                <div id="single-product-img">
                
                 <a href="<?php echo $url;?>" rel="external"><img src="<?php echo $image; ?>" class="img-responsive" width="100%;"/></a>
                </div>
               <!-- <div id="single-product-footer">
                    <p>
                        <?php //echo $short_desc; ?>
                    </p>
                </div>-->
            </div>
               </div>
            </div>
        <?php  
		endfor;
		?> 
   </div>
</div>
    </div>
