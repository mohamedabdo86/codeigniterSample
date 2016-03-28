<script>
	jQuery(function(){
		
		jQuery(".recent_items_list").jCarouselLite({
			btnNext: ".recentitem_prev",
			btnPrev: ".recentitem_next",
			visible:4
		});

	});
</script>
 <script type="text/javascript">
  $(function() {
    var galleries = $('.ad-gallery').adGallery({
		loader_image: '<?php echo base_url() . 'images/mycorner/edit_loader.gif'; ?>',
	});
	
  });
  </script>
  <style>
  .inner_body{
		 		box-shadow:1px 1px 6px #807976;
				border-radius:5px;
				margin:10px;
				width:390px;
				padding:10px;
				background-color:#FFFFFF;
				}
.inner_float_left{	background-image:url(<?php echo base_url(); ?>images/besttime/stripe_3beb92b264890423f37c98c6a6f416c1.png);
					position:relative;
					left:43px;
					margin-top:10px;
					}
  </style>
<?php echo $this->load->view('template/submenu_writer');   ?>

<?php echo $this->load->view('template/tree_menu_writer');   ?>

<div class="clear"></div>

<div class="inner_title_wrapper">
	<div class="sections_wrapper_margin">
    <h1 class="best_time_color float_left" style="font-size:25px;"><?php echo $subsection_title; ?></h1>
    
    <div class="clear"></div>
    </div>
</div><!-- End of inner_title_wrapper -->

<div class="thick_line best_time_background_color"></div>

<div class="global_background" style="height: auto;">
	<div style="float:right;margin-top: 10px;">

<div id="container">
    <div id="gallery" class="ad-gallery">
      <div class="ad-image-wrapper"></div>
      
      <div class="ad-nav">
        <div class="ad-thumbs">
          <ul class="ad-thumb-list">
          
          <?php for($i=0;$i<sizeof($displayImages);$i++) :
		  	$image = base_url()."uploads/fashion/".$displayImages[$i]['images_src'];
 			$image_thumb  = base_url()."uploads/fashion/thumb_".$displayImages[$i]['images_src'];
		   ?>
         
          	 <li>
              	<a href="<?php echo $image; ?>">
                	<img src="<?php echo $image_thumb; ?>" width="100" height="75" />
              	</a>
            </li>
            
               <?php endfor;?>
      
          </ul>
        </div>
      </div>
    </div>


  </div>
	</div> <!--end of float right -->
 
    <div style="float:left; white-space:normal;" class="inner_float_left">
    	<div class="inner_body">
       <P class="best_time_color" style="white-space:normal;font:inherit;">
       <?php echo $display[0]['fashion_title'.$current_language_db_prefix]; ?>
       </P> <br/>
       
   
        <?php echo $display[0]['fashion_desc'.$current_language_db_prefix]; ?>
        
        </div>
    
    
    </div><!--end of float left -->
   
       <div class="clear"></div>
    
    
<div class="clear"></div>

<div class="<?php echo $current_section_background_color ?>" style="height:40px; background:#e82327; position:relative;width: 105%;margin-left: -25px;margin-top: 15px; <?php if (sizeof($display_data)<=1){?> display:none;<?php }?>">
	<div class="sections_wrapper_margin">
		<div class="float_left" style="font-size:24px;color:white;"><?php echo lang('besttime_other_ideas');?></div>
    </div>
    <img width="26" style="position:absolute; left:0; top:40px;" src="<?php echo base_url(); ?>images/left_shadow_besttime.png"/>
    <img width="26" style="position:absolute; right:0; top:40px;" src="<?php echo base_url(); ?>images/right_shadow_best_time.png"/>
</div>


<div class="recent_items_list_wrapper global_background " style="height:270px;<?php if (sizeof($display_data)<=1){?> display:none;<?php }?>">

    <div class="sections_wrapper_margin" style="padding-top: 10px;" >
    
        <a class="recentitem_prev float_right" style="cursor:pointer;<?php if (sizeof($display_data)<=3){?> display:none;<?php }?>"><img src="<?php echo base_url()?>images/icons/right_arrow_besttime.png" /></a>
        <a class="recentitem_next float_left" style="cursor:pointer;<?php if (sizeof($display_data)<=3){?> display:none;<?php }?>"><img src="<?php echo base_url()?>images/icons/left_arrow_besttime.png" /></a>
        <div class="recent_items_list">
        <ul>
			<?php for($i=0;$i<sizeof($display_data);$i++):
				$title = $display_data[$i]['fashion_title'.$current_language_db_prefix];
				$short_title = $this->common->limit_text($title,50);
				
				$image  = base_url()."uploads/fashion/thumb_".$display_data[$i]['images_src'];
				
				$url = site_url($this->router->class."/".$this->router->method."/". $display_data[$i]['fashion_ID']);
			?>
        	<li style="height:270px;">
            
           <!-- <a href="<?php //echo $url ?>"><?php //echo $image;?></a>-->
            
            <div class="image global_sperator_margin_bottom"><a href="<?php  echo $url ?>" title="<?php echo $title;?>"><img src="<?php echo $image ?>" alt="<?php echo $title;?>" width="218" height="168" alt=""  ></a></div>
            <div class="title float_left dark_gray" style="height:auto;"><div style="margin:0px 5px;"><a href="<?php  echo $url ?>" class="dir"><?php echo $short_title;?><h4 class="best_cook_color global_sperator_margin_top"><?php //echo $member_name ?></h4></a></div></div>
           
               <?php /*?><div class="social float_left" style="line-height: 13px;">
                <?php
                $params = array('url' => $url, 'title' => $title);
                echo $this->sharing->sharing_function($params); 
                
                ?>
                
                </div><!--End Of .social--><?php */?>
            
            <div class="clear"></div>
			</li>
        <?php
		endfor;
		?>
     </ul>
    
    </div><!--- End of recent_items_list -->

</div><!-- End of sections_wrapper_margin -->

</div>
 
</div><!-- End of global background -->