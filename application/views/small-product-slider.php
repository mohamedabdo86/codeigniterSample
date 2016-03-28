
  <div class="row">
    <div class="all-products">
      <div class="all-product-header">
        <div id="title" class="float">
          <h4><?php echo lang('globals_nestleproducts'); ?></h4>
        </div>
      </div>
      <div class="product-small-images">
        <?php 
			$get_products_brand = $this->sectionsmodel->get_products_brand();
			$current_link =  $this->uri->segment(5, 0);
			
			if(!$current_link){
				$current_link = 34;
			}
			
			for($i=0;$i<sizeof($get_products_brand);$i++){
			if($current_link == $get_products_brand[$i]['products_brand_ID']){
			$image_src = base_url()."uploads/products_brand/".$get_products_brand[$i]['images_src'];
			$title = $get_products_brand[$i]['products_brand_name'.$current_language_db_prefix];
			$url = site_url("mobile/products/index/".$get_products_brand[$i]['products_brand_ID']);
					?>
        <div><a href="<?php echo $url ?>" class="product-menu" title="<?php echo $title; ?>" rel="external"><img style="width:90px;height:90px;" src="<?php echo $image_src; ?>" class="img-responsive border-color <?php if($current_link== $get_products_brand[$i]['products_brand_ID']){?>active<?php }?>" /></a></div>
        <?php	
			
			}//end if 
			}//end for llop
			?>
        <?php 
			for($i=0;$i<sizeof($get_products_brand);$i++){
			if($current_link != $get_products_brand[$i]['products_brand_ID']){
			$image_src = base_url()."uploads/products_brand/".$get_products_brand[$i]['images_src'];
			$title = $get_products_brand[$i]['products_brand_name'.$current_language_db_prefix];
			$url = site_url("mobile/products/index/".$get_products_brand[$i]['products_brand_ID']);
					?>
        <div><a href="<?php echo $url ?>" class="product-menu" title="<?php echo $title; ?>" rel="external"><img style="width:90px;height:90px;" src="<?php echo $image_src; ?>" class="img-responsive border-color" /></a></div>
        <?php
				
			}//end if 
			}//end for llop
			?>
      </div>
    </div>
    <div class="product-end-section"></div>
  </div>

