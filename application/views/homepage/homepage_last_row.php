<script type="text/javascript" src="https://malsup.github.io/jquery.cycle.all.js"></script>
<script type="text/javascript">

$('#slideshow').cycle({  
    delay: -3000 
 });

$(document).ready(function() {
	$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});

</script>

<style>
.videos {margin-top:65px;}
.videos li {margin: 10px;height: 57px;}
</style>

<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=699451000078016";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<div class="thick_line best_time_background_color"></div>

<div class="global_sperator_height" style="width:100%"></div>
    
<div class="sections_wrapper_margin" >
   <div class="video_wrapper_width home_widget float_left "  >
            
            <div class="lastrow white_color" style="background:#DC2725;">
            <div class="white_color margin_10">
                <div class="float_left"><?php echo lang('globals_videos'); ?></div>
                <div class="float_right"><a href="https://www.youtube.com/user/NestleEgypt" target="_blank"><img src="<?php echo base_url()?>images/socialmedia/youtube_homepage.png" /></a></div>
                	<div class="clear"></div>
                </div>

            </div>
            
            <ul class="videos">

            	<?php
				    for($i =0; $i<sizeof($get_random_product_videos);$i++): 
						$title = $get_random_product_videos[$i]['videos_name'];
						$youtube_url = $get_random_product_videos[$i]['videos_url'];
						$short_title = $this->common->limit_text($title,37);
					 ?>
                    
                    <li>
                    <a title="<?php echo $title; ?>" href="https://www.youtube.com/embed/<?php echo $this->common->youtube($youtube_url); ?>" class="various fancybox.iframe">
                    	<img style="border:none" width="120" height="70" class="float_left" src="https://img.youtube.com/vi/<?php echo $this->common->youtube($youtube_url); ?>/mqdefault.jpg" />
                    	<div class="float_right gray_color dir" style="width:177px;margin-top:12px; color:#666;white-space:normal;"><?php echo $short_title; ?> </div>
                    </a>
                    </li>
                    		<div class="clear"></div>
                  	
                    <?php endfor; ?>
                    	
                </ul>

            </div>
                
			</div><!-- End of videos -->
            
            <div style="height:310px" class="float_left homesperator_width" ></div>
            
            <div class="social_wrapper_width home_widget float_left "  style="border:solid 3px #536c9f;border-radius:18px; width:300px" >
            
            <div class="lastrow white_color" style="background:#536c9f"  >
                <div class="white_color margin_10">
                <div class="float_left"><?php echo lang('globals_facebook'); ?></div>
                <div class="float_right"><a href="https://www.facebook.com/NestleEgypt" target="_blank"><img src="<?php echo base_url()?>images/homepage/lastrow_fb.png" /></a></div>
                	<div class="clear"></div>
                </div>
            		<div class="fb-like-box" data-href="https://www.facebook.com/NestleEgypt" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
            </div>
 
			</div><!-- End of facebook -->
            
            <div style="height:310px" class="float_left homesperator_width" ></div>
            
            <div class="social_wrapper_width home_widget float_left "  style="border:solid 3px #A6A6A6;border-radius:18px;" >
            
            <div class="lastrow  white_color " style="background:#A6A6A6"  >
            
            <div class="white_color" style="margin: 10px 10px 0 10px;">
                <div class="float_left"><?php echo lang('globals_offers'); ?></div>
                <div class="float_right"><img src="<?php echo base_url()?>images/socialmedia/nestlelogo.png" /> </div>
                	<div class="clear"></div>
                </div>
                

                <div id="slideshow" class="pics">
                <?php 
				if($display_promotions){
				for($i =0; $i<sizeof($display_promotions);$i++):
				
				$id = $display_promotions[$i]['products_promotions_product_id']; 
				$image_url = base_url()."uploads/promotions/";
				$image = $image_url.$display_promotions[$i]['images_src'];
				$flag = $display_promotions[$i]['products_promotions_flag'];
				if($flag == 1) {
					$url = site_url('products/index/'.$id);	
				} else if($flag == 2) {
					$url = $display_promotions[$i]['products_promotions_url'];	
				}
				
				?>
                <a href="<?php echo $url; ?>"><img src="<?php echo $image; ?>" alt="Slideshow Image 1" width="295" class="active offerimage"></a>
                <?php
				endfor;
				}
				?>
  				</div>
            </div>
            
            <div class="clear">  </div>
            
			</div><!-- End of facebok -->
    
    <div class="clear"></div>
    </div>
   