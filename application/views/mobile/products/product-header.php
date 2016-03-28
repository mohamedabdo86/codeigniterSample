

    <div class="row"> 
        <div class="product-img">
       <?php  $image = base_url()."uploads/products_brand/".$display[0]['images_src'];?>
            <img src="<?php echo $image; ?>" class="img-responsive" style="width:100%;"/>
            <div id="product-title">
                <h2><?php echo $display[0]['products_brand_name'.$current_language_db_prefix]; ?></h2>
            </div>   
        </div>
    </div>
