  <style>
.thick_line
{
	width: 100%;
  height: 4px;
    background: #13758e;
}

  </style>
  	<section class="<?php echo $current_section; ?>">
  
          <?php   echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png" , site_url_mobile(''.$this->router->class));?>

	<div class="row">
    	<div class="col-md-12 col-sm-12 col-xs-12">
		<h1 class="float_left" style="font-size:25px; color:#13758e;"><?php echo $subsection_title; ?></h1>
    </div>
    </div>
    <div class="row">
    	<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="thick_line row"></div>
 </div>
    </div>


      <div class="row">
    	<div class="col-md-12 col-sm-12 col-xs-12 float_left">
       <P class="best_time_color" style="white-space:normal;font-size:20px; margin-top:10px;">
       <?php echo $display[0]['fashion_title'.$current_language_db_prefix]; ?>
       </P> 
       </div></div>   

<?php /*?>	 <div class="swiper-container">
      <div class="swiper-wrapper" style="width:24300px !important">
        <?php
	
			
         for($i=0; $i<sizeof($displayImages); $i++): 
				$image_src = base_url()."uploads/fashion/".$displayImages[$i]['images_src'];
				$image_thumb  = base_url()."uploads/fashion/thumb_".$displayImages[$i]['images_src'];
				
			?>
          
        <div class="swiper-slide">
        
       
     <img width="100%" class="rounded_border img-responsive col-md-4 col-sm-6 col-xs-12" src="<?php echo $image_thumb; ?>" >

        </div>
        <?php endfor; ?>
       
      </div>
      <!-- swiper-wrapper --> 
    </div><?php */?>
           <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="swiper-container-images">
                    <div class="swiper-wrapper">
                        <?php
                        for ($i = 0; $i < sizeof($displayImages); $i++):
							$image_src = base_url()."uploads/fashion/".$displayImages[$i]['images_src'];
							$image_thumb  = base_url()."uploads/fashion/thumb_".$displayImages[$i]['images_src'];
                            ?>
                            <div class="swiper-slide ">
								<img width="100%" class="rounded_border img-responsive" src="<?php echo $image_thumb; ?>" >
                            </div>
                            <?php
                        endfor;
                        ?>
                    </div><!-- swiper-wrapper -->                     
                </div><!-- swiper-container --> 
            </div>
        </div> 
   
 
   
       
   		  <div class="row">
    	<div class="col-md-12 col-sm-12 col-xs-12 float_left" style="padding:5px;">
        <?php echo $display[0]['fashion_desc'.$current_language_db_prefix]; ?>
        
        </div>
    
    
    </div>
