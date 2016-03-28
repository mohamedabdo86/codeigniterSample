<?php
$jump_to = 0;
$get_products_brand = $this->sectionsmodel->get_brand_order($brand_id);
$jump_to = $get_products_brand;
?>
<script>
    $(document).ready(function() {
      $("#owl-demo").owlCarousel({
		items: 6,
    	scrollPerPage: true,
    	itemsDesktop: [1199,5],
    	itemsDesktopSmall: [979,4],
    	itemsTablet: [768,4],
    	itemsTabletSmall: [479,3],
    	itemsMobile: [360,2],
        navigation : false,
		pagination:false,
		mouseDrag:false,
		rewindNav: false,
		slideSpeed:1500,
		// Show/Hide arrows
		afterMove : function(){
        if(this.currentItem === this.maximumItem)
		{
        	$(".inner_submenu_list_next").hide();
			$(".inner_submenu_list_prev").show();
        }
		else if(this.currentItem == 0)
		{
			$(".inner_submenu_list_prev").hide();
			$(".inner_submenu_list_next").show();
		}
		else
		{
			$(".inner_submenu_list_prev").show();
			$(".inner_submenu_list_next").show();
		}
		}
      	});
	  	
		// Init Owl_Carousel
	  	owl = $("#owl-demo").data('owlCarousel');
	  	owl.jumpTo(<?php echo $jump_to; ?>);
		
	  // bend arrows click event
	  $(".inner_submenu_list_next").click(function(e) {
        owl.next();
   	  });
	   $(".inner_submenu_list_prev").click(function(e) {
        owl.prev();
   	  });
	  
    });
	
</script>

<script>
$(document).ready(function(e) {
    
	//Auto detect if a submenu is open
	var all_submenu_closed_flag = true;
	$( ".submenu_lvl2_container" ).each(function( index ) {
  		
		if ($(this).css("display") == "block" )
		{
			all_submenu_closed_flag  = false;
			//Display buttons 
			$(".inner_submenu_list_lvl2_prev").fadeIn("fast");
			$(".inner_submenu_list_lvl2_next").fadeIn("fast");
			$(".inner_submenu_list_lvl2_close").fadeIn("fast");
			
			var sectionid = $(this).data("sectionid");
			
			$(".firstlevel_click[data-id="+sectionid+"]").append("<div class='active_submenu'></div>");
		}
	});
});
</script>
<style>

.owl-carousel .owl-item
{
	float:<?php echo lang('globals_left');?>;
}
.submenu_container_wrapper .submenu_container
{
	box-shadow:<?php echo lang('box_shadow_submenu');?>;
}
.submenu_container_wrapper .submenu_lvl2_container
{
	box-shadow:<?php echo lang('box_shadow_submenu_level_2');?>;
}
.submenu_container_wrapper .submenu_container .item
{
	box-shadow: <?php echo lang('box_shadow_submenu_items');?>;
	margin-top: 5px;
}
.owl-wrapper
{
	float:<?php echo lang('globals_left');?>;
}
.owl-carousel
{
    direction: rtl;
}
.active_submenu
{
	width: 0px;
	height: 0px;
	border-style: solid;
	border-width: 0 8.5px 14px 8.5px;
	border-color: transparent transparent #adadad transparent;
	margin: 0 70px;
	margin-top: -5px;
}

</style>
<div class="submenu_container_wrapper global_sperator_margin_top">

<a class="inner_submenu_list_prev"><img src="<?php echo base_url()."images/arrow_to_left_white_small.png" ?>" /></a>
<a class="inner_submenu_list_next "><img src="<?php echo base_url()."images/arrow_to_right_white_small.png" ?>" /></a>

<a class="inner_submenu_list_lvl2_prev"><img src="<?php echo base_url()."images/arrow_to_left_white_small.png" ?>" /></a>
<a class="inner_submenu_list_lvl2_next "><img src="<?php echo base_url()."images/arrow_to_right_white_small.png" ?>" /></a>
<a class="inner_submenu_list_lvl2_close white_color ">x</a>


	<div class="submenu_container">
        
        <div id="owl-demo" class="owl-carousel float_left" style="width:940px; margin:0px auto;">
        
       <?php
	   
	   $get_products_brand = $this->sectionsmodel->get_products_brand();
	   	for($i=0;$i<sizeof($get_products_brand);$i++){
			$current_link_before_filter =  $this->uri->segment(4, 0);
			$current_link = substr($current_link_before_filter, 0, strpos($current_link_before_filter, '-'));
			if(!$current_link){
				$current_link = 34;
			}
			$image_src = base_url()."uploads/products_brand/".$get_products_brand[$i]['images_src'];
			$id = $get_products_brand[$i]['products_brand_ID'];
			$title = $get_products_brand[$i]['products_brand_name'.$current_language_db_prefix];

			$strip_title = str_replace("®","",$title);
			$last_strip_title = trim($strip_title);
				
			$url = site_url("products/index/".generateSeotitle($id,$last_strip_title));
			
			if($current_link == $get_products_brand[$i]['products_brand_ID'])
			{
			?>
            
			<div class="item">
				<a href="<?php echo $url ?>" rel="<?php echo $get_products_brand[$i]['products_brand_ID']; ?>" class="firstlevel_click" title="<?php echo $title; ?>">
                	<div class="submenu_icon active_menu" ><img style="border:none;" title="<?php echo $title; ?>" width="90" height="90" src="<?php echo $image_src; ?>" /></div>
                </a>
			</div>
            
            
            <?php	
			}else{
				?>
                
            <div class="item">
				<a href="<?php echo $url ?>" rel="<?php echo $get_products_brand[$i]['products_brand_ID']; ?>" class="firstlevel_click" title="<?php // echo $product->products_brand_name_ar; ?>">
                	<div class="submenu_icon not_active_menu" ><img style="border:none;" width="90" height="90" src="<?php echo $image_src; ?>" /></div>
                </a>
			</div>
                <?php
				}
			}
		?>
		
    </div>
    
    </div>
    </div>
       
       