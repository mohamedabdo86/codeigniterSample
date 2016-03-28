<script>
jQuery(function(){
	jQuery(".product_brand_footer_slider").jCarouselLite({
		btnNext: "#product_brand_footer_slider_prev",
		btnPrev: "#product_brand_footer_slider_next",
		visible:8,
		circular: true,
		 
	});
	
	$('#product_brand_footer_slider_prev').addClass('disabled');

});
</script>
<style>
.product_brand_footer_slider{
	visibility: visible;
	overflow: hidden;
	position: relative;
	z-index: 2;
	margin:auto !important;
}
.image_title_warrper
{
	width: 100%;
	height: 35px;
	position: absolute;
	bottom: 0px;
	z-index: 99;
	line-height: 35px;
}
.image_title_warrper .sections_wrapper_padding
{
	padding:0 10px;
}
.section_footer{
font-size: 14px;
color: #A8A8A8;
width: 240px;
height: 200px;
border-left: 1px dashed #CCC;
}
.section_footer_without_border{
font-size: 14px;
color: #A8A8A8;
width: 240px;
height: 230px;
}
.footer_item
{
	font-size:10px;
	color:#d1d1d1;
}

#footer_wrapper { height:40px; line-height:40px; font-size:12px; background:#555555; }

.footer_item_menu {
color: #d1d1d1;
width: 80px;
}
</style>

<div class="clear"></div>
</div><!-- End of mainbody_wrapper -->

<div class="clear"></div>

<!-- Footer Nido Products -->
<div id="nido_products_footer" class="global_sperator_margin_top">
<div id="title_wrapper"><div id="title_container"><?php echo lang('globals_nestleproducts'); ?></div></div>

<div class="latest_recipes_wrapper">
        <a id="product_brand_footer_slider_prev" style="position: absolute; right: 239px;top: 78px; margin: 0 5px;"   ><img src="<?php echo base_url(); ?>images/products/right_arrow.png" height="15" /></a>
        <a id="product_brand_footer_slider_next" style="position: absolute; left: 239px;top: 78px; margin: 0 5px;"   ><img src="<?php echo base_url(); ?>images/products/left_arrow.png" height="15" /></a>
<div class="product_brand_footer_slider">
        	
            <ul>
            <?php
			$get_products_brand = $this->sectionsmodel->get_products_brand();
			 if($get_products_brand){?>
            <?php for($i=0; $i<sizeof($get_products_brand); $i++): 
				$id = $get_products_brand[$i]['products_brand_ID'];
				$image_src = base_url()."uploads/products_brand/".$get_products_brand[$i]['images_src'];
				$title = $get_products_brand[$i]['products_brand_name'.$current_language_db_prefix];
				
				$strip_title = str_replace("®","",$title);
				$last_strip_title = trim($strip_title);
				
				$url = site_url("products/index/".generateSeotitle($id,$last_strip_title));
			?>
                <li style="position:relative; width:100px; margin-top:5px;">
                	<a title="<?php echo $title; ?>" href="<?php echo $url; ?>"><img style="border:none;" height="90" width="90" class="rounded_border" src="<?php echo $image_src; ?>" title="<?php echo $title;?>" alt="<?php echo $title;?>"></a>
                </li>
            <?php endfor; ?>
			<?php }?>
            </ul>
        </div>
</div>

</div><!-- ENd footer nido products -->

<div class="clear"></div>

<div id="prefooter_wrapper" >

<div class="middle_white_wrapper"> <div class="image"></div> </div>

    <div class="inner " style="margin-top: 25px;">
    
    <?php
	//Get Main sections Data
	$bestcook_display_sections = $this->sectionsmodel->get_children_sections(2);
	$bestmom_display_sections = $this->sectionsmodel->get_children_sections(27);
	$bestme_display_sections = $this->sectionsmodel->get_children_sections(10);
	$besttime_display_sections = $this->sectionsmodel->get_children_sections(28);
	?>


	<div class="float_right" style="width: 100%; margin-bottom:13px;">
    
    <div class="<?php if($current_language_db_prefix == "_ar"){echo "section_footer";}else{echo "section_footer_without_border";} ?> float_left">
    <ul>
    	<li style="margin:0px 40px 8px 40px; font-weight:bold;"><a href="<?php echo site_url('best_mom');?>"><?php echo lang('globals_bestmom'); ?></a></li>
    	<?php
	 	for($i = 0 ; $i < sizeof($bestmom_display_sections) ; $i++){
		$url="";
		if($bestmom_display_sections[$i]['sub_sections_type']=='articles'){
			$url=site_url('best_mom/'.generateSeotitle($bestmom_display_sections[$i]['sub_sections_footer_url'] ,$bestmom_display_sections[$i]['sub_sections_name'.$current_language_db_prefix]));
			}else{
				$url=site_url('best_mom/'.$bestmom_display_sections[$i]['sub_sections_footer_url']);
				}
		echo '<li style="margin:0px 40px 0px 40px; font-size: 13px !important;line-height: 22px;"><a href="'.$url.'">'.$bestmom_display_sections[$i]['sub_sections_name'.$current_language_db_prefix].'</a></li>';
		}
		?>
    </ul>
    
    </div>
    
    <div class="section_footer float_left">
    <ul>
    	<li style="margin:0px 40px 8px 40px; font-weight:bold;"><a href="<?php echo site_url('best_cook');?>"><?php echo lang('globals_bestcook'); ?></a></li>
    	<?php
	 	for($i = 0 ; $i < sizeof($bestcook_display_sections) ; $i++){
			$url="";
		if($bestcook_display_sections[$i]['sub_sections_type']=='articles'){
			$url=site_url('best_cook/'.generateSeotitle($bestcook_display_sections[$i]['sub_sections_footer_url'] ,$bestcook_display_sections[$i]['sub_sections_name'.$current_language_db_prefix]));
			}else{
				$url=site_url('best_cook/'.$bestcook_display_sections[$i]['sub_sections_footer_url']);
				}
		echo '<li style="margin:0px 40px 0px 40px; font-size: 13px !important;line-height: 22px;"><a href="'.$url.'">'.$bestcook_display_sections[$i]['sub_sections_name'.$current_language_db_prefix].'</a></li>';
		}
		?>
    </ul>    
    </div>
    
    <div class="section_footer float_left">
    <ul>
    	<li style="margin:0px 40px 8px 40px; font-weight:bold;"><a href="<?php echo site_url('best_me');?>"><?php echo lang('globals_bestme'); ?></a></li>
    	<?php
	 	for($i = 0 ; $i < sizeof($bestme_display_sections) ; $i++){
				$url="";
		if($bestme_display_sections[$i]['sub_sections_type']=='articles'){
			$url=site_url('best_me/'.generateSeotitle($bestme_display_sections[$i]['sub_sections_footer_url'] ,$bestme_display_sections[$i]['sub_sections_name'.$current_language_db_prefix]));
			}else{
				$url=site_url('best_me/'.$bestme_display_sections[$i]['sub_sections_footer_url']);
				}
		echo '<li style="margin:0px 40px 0px 40px; font-size: 13px !important;line-height: 22px;"><a href="'.$url.'">'.$bestme_display_sections[$i]['sub_sections_name'.$current_language_db_prefix].'</a></li>';
		}
		?>
    </ul>
    
    </div>
    
    <div class="<?php if($current_language_db_prefix == "_ar"){echo "section_footer_without_border";}else{echo "section_footer";} ?> float_left">
    <ul>
    	<li style="margin:0px 40px 8px 40px; font-weight:bold;"><a href="<?php echo site_url('best_time');?>"><?php echo lang('globals_besttime'); ?></a></li>
    	<?php
	 	for($i = 0 ; $i < sizeof($besttime_display_sections) ; $i++){
				$url="";
		if($besttime_display_sections[$i]['sub_sections_type']=='articles'){
			$url=site_url('best_time/'.generateSeotitle($besttime_display_sections[$i]['sub_sections_footer_url'] ,$besttime_display_sections[$i]['sub_sections_name'.$current_language_db_prefix]));
			}else{
				$url=site_url('best_time/'.$besttime_display_sections[$i]['sub_sections_footer_url']);
				}
		echo '<li style="margin:0px 40px 0px 40px; font-size: 13px !important;line-height: 22px;"><a href="'.$url.'">'.$besttime_display_sections[$i]['sub_sections_name'.$current_language_db_prefix].'</a></li>';
		}
		?>
    </ul>
    
    </div>
    
    </div>
    
    <div class="clear"></div>
    
    
    <?php echo anchor_popup('http://nestle.com.eg', '<img src="'. base_url('images/nestle_corp_logo.png').'" alt="Nestle Corporate Logo" style="max-width: 150px; margin: -70px 50px 16px 50px;" />'); ?>
    
    </div><!-- End of inner -->


</div><!-- ENd of prefooter_wrapper -->
<?php
if($current_language_db_prefix == "_ar")
{
	$current_year = $this->common->arabic_numbers(date("Y"))." "."&copy;";
}
else
{
	$current_year = date("Y")." "."&copy;";
}


?>
<div id="footer_wrapper"  >
	<div class="inner">
        <div class="footer_item float_right dir"><?php echo $current_year." ".lang('globals_footer_copyright');?>  </div>
        <a href="<?php echo site_url('welcome')?>" class="footer_item float_left margin_left_10 dir"><?php echo lang('globals_home'); ?></a>
        <a href="<?php echo site_url('contact_us')?>" class="footer_item float_left margin_left_10 dir"><?php echo lang('globals_secmenu_contactus');?></a>
        <a href="<?php echo site_url('terms_conditions')?>" class="footer_item float_left margin_left_10 dir"><?php echo lang('globals_secmenu_terms');?></a>
        <a href="<?php echo site_url('privacy_policy')?>" class="footer_item float_left margin_left_10 dir"><?php echo lang('globals_secmenu_privacy');?></a>
        <a href="<?php echo site_url('faq')?>" class="footer_item float_left margin_left_10 dir"><?php echo lang('globals_secmenu_faq');?></a>
     </div><!-- End of inner -->
</div><!-- End of footer_wrapper -->


</body>
</html>
