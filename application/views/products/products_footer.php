  <?php
   	
	/**
	* This file concerns with product footer of Products section
	*/
	
	// Adding Promotions
	$this->load->view('products/product_promotions'); 
   
   	// Adding Poll
	$this->load->view('products/product_poll'); 
   
  	// Adding Facebook
	//if($display[0]['products_brand_facebook_url'] != "")
	$this->load->view('products/view_facebook_widget'); 
  
   /* choose your suitable scenario
    *
    * product_video_listonly_scenario  half width videos / articles&recipes
    * product_video_normal_scenario	   full width videos
   */
   //if(!empty($display_videos))
    //$this->load->view('products/product_articles_recipes'); 
	$this->load->view('products/product_video_listonly_scenario'); 
   
   ?>
  
  
   
   </div>
   
                