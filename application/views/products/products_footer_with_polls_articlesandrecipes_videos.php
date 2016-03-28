  <?php
   	
	/**
	* This file concerns with product footer of Products section
	*/
	
	// Adding Promotions
	$this->load->view('products/product_promotions'); 
   
   	// Adding Poll
	$this->load->view('products/product_poll'); 
   
   // Adding articles/recipes
   ?>
   <div class="float_right"><?php $this->load->view('products/product_articles_recipes'); ?></div> 
   
   
   
   <?php
   // Adding Full Width Video
   $this->load->view('products/product_video_normal_scenario'); 
   
   ?>
  
  
   
   </div>
   
                