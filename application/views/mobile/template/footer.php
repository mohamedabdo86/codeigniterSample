<style>

.mobile-copyright-footer
{
	border-bottom:#CCC solid 10px;
	color: #fff;
	text-shadow:none;
}
.mobile_sections_footer_cols
{
	padding-left: 0px;
	padding-right: 0px;
	height:100%;
}

.mobile-section-icons-footer-wrapper
{
	border-left:2px #999 ridge;
	border-right:2px #999 ridge;
	border-top:2px #999 ridge;
	border-bottom:0px;
	border-style: solid;
	text-align: center;
	padding: 0px;
	height:100%;
	-webkit-border-top-left-radius: 30px;
	-webkit-border-top-right-radius: 30px;
	-moz-border-radius-topleft: 30px;
	-moz-border-radius-topright: 30px;
	border-top-left-radius: 30px;
	border-top-right-radius: 30px;
}



.mobile-section-icons-footer-image
{
	display:inline-block !important;
	max-height: 39px;
	margin: 10px 0px;
}
</style>

</div><!-- End of content column wrapper -->
</div><!-- End of website-main-body-wrapper -->
<div id="footer-products-container" data-role="footer row">
   
				<div class="col-xs-12">
				<?php
				if( isset($isMainHomePage) && $isMainHomePage):
				?>
					<div class="row nestle-products">
                    	<div class="col-xs-1">
                        	
                        </div>
		                <div class="col-xs-10">
				            <div class="thick-line background-color">
                            	&nbsp;
                            </div>
        				    <div id="footer-title-container">
                				<h2><?php echo lang('globals_nestleproducts'); ?></h2>
                                
				            </div>
        				    <div class="v-seperator" style="height:80pt;">
                            <div class="col-sm-12 col-xs-12">
     							<?php echo $this->mwidgets->generateproductwidget();?>
    <!-- swiper-container --> 
  </div>
                            </div>
                		</div>
                        <div class="col-xs-1">
                        </div>
					</div>
				<?php
				endif;
				?>
                	
                    
                    <div class="row"> <!-- START Of Section links row -->
                    	<div class="col-xs-3 col-sm-5 mobile_sections_footer_cols" style="text-align:left;">
                        	<?php if(!isset($current_section))
							{
							?>
                        	<img style="display: inline-block; max-width: 60px; margin-left: 10px;" src="<?php echo base_url('mobile/images/mobile-best-time-scroll-up-image.png') ; ?>" class="img-responsive" onclick="$.mobile.silentScroll(0)" style="cursor:pointer; max-width: 18%" />
                            <?php
							}
							else
							{
							?>
                            <img style="display: inline-block; max-width: 60px; margin-left: 10px;" src="<?php echo base_url('mobile/images/mobile-' . $current_section) . '-scroll-up-image.png' ; ?>" class="img-responsive" onclick="$.mobile.silentScroll(0)" style="cursor:pointer" />
                            <?php
							}
							?>
                    	</div>
                        <div class="col-xs-4 col-sm-3">
                    	</div>
                        <div class="col-xs-5 col-sm-4 mobile_sections_footer_cols">
                        	<img style="max-width: 90%; float:right; margin-right: 15px; margin-top: 10px;" src="<?php echo base_url('images/nestle_corp_logo.png') ; ?>" class="img-responsive" />
                        </div>
                	</div>  <!-- END Of Section links row -->  
                    
                    
                	<div class="row mobile-copyright-footer"> <!-- START Of Section links row -->
                    	<div class="col-xs-2 col-sm-4 col-md-4 mobile_sections_footer_cols" style="text-align:left;">
                        	
                    	</div>
                        <div class="col-xs-8 col-sm-4 col-md-3 mobile-section-icons-footer-wrapper" style="padding-left: 0px; padding-right: 0px; max-height: 60px" >
                        <?php
						if($current_section != 'best-time')
						{
						?>
                        <a rel="external" data-ajax="false" href="<?php echo site_url('mobile/best_time'); ?>"><img src="<?php echo site_url('mobile/images/best_time_footer_icon.png'); ?>" alt=""  class="img-responsive mobile-section-icons-footer-image" /></a>
                        <?php
						}
						if($current_section != 'best-me')
						{
						?>
                        <a rel="external" data-ajax="false" href="<?php echo site_url('mobile/best_me'); ?>"><img src="<?php echo site_url('mobile/images/best_me_footer_icon.png'); ?>" alt="" class="img-responsive mobile-section-icons-footer-image"  /></a>
                        <?php
						}
						if($current_section != 'best-mom')
						{
						?>
                        <a rel="external" data-ajax="false" href="<?php echo site_url('mobile/best_mom'); ?>"><img src="<?php echo site_url('mobile/images/best_mom_footer_icon.png'); ?>" alt=""  class="img-responsive mobile-section-icons-footer-image" /></a>
                        <?php
						}
						if($current_section != 'best-cook')
						{
						?>
                        <a rel="external" data-ajax="false" href="<?php echo site_url('mobile/best_cook'); ?>"><img src="<?php echo site_url('mobile/images/best_cook_footer_icon.png'); ?>" alt=""  class="img-responsive mobile-section-icons-footer-image" /></a>
                        <?php
						}
						?>
                    	</div>
                        <div class="col-xs-2 col-sm-4 col-md-5 mobile_sections_footer_cols">
                        	
                        </div>
                	</div>  <!-- END Of Section links row -->            
            
            
                <div class="row" style="background-color:#9B9C9E; color:#fff; padding: 4px; 5px;">
                    <div class="col-md-12 col-sm-12">
                        <a rel="external" href="<?php echo site_url_mobile("welcome"); ?>"><?php echo lang('globals_home'); ?></a> - 
                        <a rel="external" href="<?php echo site_url_mobile('contact_us')?>"><?php echo lang('globals_secmenu_contactus');?></a> -
                        <a rel="external" href="<?php echo site_url_mobile('terms_conditions')?>"><?php echo lang('globals_secmenu_terms');?></a> -
                        <a rel="external" href="<?php echo site_url_mobile('privacy_policy')?>"><?php echo lang('globals_secmenu_privacy');?></a> -                          
                        <a rel="external" href="<?php echo site_url_mobile('faq')?>"><?php echo lang('globals_secmenu_faq');?></a>
                        
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <p><small><?php echo lang('globals_footer_copyright')." ".date('Y')." ".lang('globals_footer_copyright_nestle'); ?></small></p>
                    </div>
                        
                </div> <!-- copyright-footer -->
            
            </div><!-- footer row wrapper col -->
            </div><!-- footer row -->
    </div>
    <?php $this->load->view('mobile/template/js'); ?>
   <?php $this->load->view('mobile/template/login_fancybox_handler'); ?>
    </body>
</html>