<html>
	<?php // ------------------------- START of <head> tag --------------------------- ?>
    <head>
        <title><?php echo $this->headers->get_website_title() ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <?php
		//Write Normal Metatags
		echo $this->headers->write_metatags_lines();
		echo $this->headers->write_fb_metatags_lines($display_image);
		?>   

        <?php $this->load->view('mobile/template/css'); ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo base_url_mobile("js/jquery.mobile/jquery.mobile-1.4.5.min.js"); ?>"></script>
        <script src="<?php echo base_url_mobile("js/less-1.4.1.min.js"); ?>"></script>
        <script src="<?php echo base_url_mobile("js/bootstrap.min.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/respond.min.js"></script>
        <!-- load common.js -->
		<script type="text/javascript" src="<?php echo base_url(); ?>js/common.js"></script>
        <!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<script type="text/javascript">
	$(document).ready(function() {
	$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});
});
</script>
<style>
.fancybox-title, .fancybox-title-float-wrap
{
	display: none;
}

</style>
     </head>
     <?php // ------------------------- START of </head> tag --------------------------- ?>
     
     <?php // ------------------------- START of <body> tag --------------------------- ?>
	<body class="<?php echo $current_language; ?>">
    <!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TN84PR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TN84PR');</script>
<!-- End Google Tag Manager -->

    	<div data-role="page" class="container">
        <div id="main-header-wrapper" class="row" data-role="header" data-ajax="false">
        	<div class="col-xs-12">
            <div class="row">
        	<?php
			// header blocks push/pull classes values for multi-language
			
			$logo_container_push_pull = $current_language_db_prefix == '_ar' ? 'col-xs-push-7' : '';
			$login_container_push_pull = $current_language_db_prefix == '_ar' ? 'col-xs-pull-2' : '';
			$nav_container_push_pull = $current_language_db_prefix == '_ar' ? 'col-xs-pull-8' : '';
			$search_container_push_pull = $current_language_db_prefix == '_ar' ? 'col-xs-push-7' : '';
			$why_container_push_pull = $current_language_db_prefix == '_ar' ? 'col-md-pull-5' : 'col-md-push-5';
			$social_icon_push_pull= $current_language_db_prefix == '_ar' ? 'col-md-push-4' : 'col-md-pull-4';
			$contact_container_push_pull = $current_language_db_prefix == '_ar' ? 'col-xs-pull-8' : '';
			
			?>
            <div id="logo-container" class="col-xs-5 <?php echo $logo_container_push_pull; ?>"><a href="<?php echo site_url_mobile() ?>" rel="external"><img class="img-responsive" src="<?php echo base_url("images/be_at_your_best_logo".$current_language_db_prefix.".png"); ?>" /></a></div>
            
            <?php
				/*
					--------------------------------------------------------------
					-----------------------  Login Form --------------------------
					--------------------------------------------------------------					
				*/	
			?>
             
            <div id="menu-buttons-container" class="col-xs-4 <?php echo $login_container_push_pull; ?>">
            	<?php
				if($this->members->members_id)
				{
					?>
                    <div class="float_left">
                    	<a href="<?php echo site_url_mobile("my_corner/logout/".$this->members->members_language) ?>" data-ajax="false"><img  src="<?php echo base_url(); ?>images/header_icon_logout.png" /></a>
	                </div>
                    <?php
				}
				else
				{
					?>
                    <div class="float_left">
                        <a class="btn btn-blue fancybox fancybox.ajax header_top_signin" href="<?php echo site_url("mobile/my_corner/login_form"); ?>"><?php echo lang("globals_lform_signin"); ?></a>
<!--                    	<a class="btn btn-blue" data-rel="popup" data-transition="pop" href="#mobile_login_popup_box" data-ajax="true"><?php echo lang("globals_lform_signin"); ?></a>-->                    
	                </div>
    	            
                             
        	        <div class="float_left">
            	        <a type="button" class="btn btn-blue" href="<?php echo site_url_mobile('my_corner/create_my_corner'); ?>" data-ajax="false"><?php echo lang("globals_lform_signup"); ?></a>                                      
                	</div>
                	<div class="clearfix"></div>
                    <?php
				}
		 
		?>
                
            </div><!-- menu-buttons-contaienr -->
            
            <?php
				/*
					--------------------------------------------------------------
					----------------------  Nav Buttons --------------------------
					--------------------------------------------------------------					
				*/	
			?>
            
            <div id="nav-buttons-container" class="col-xs-3 <?php echo $nav_container_push_pull; ?>">
                <div class="float_right" style="display:none;"><a href="<?php echo site_url_mobile(); ?>" id="header-top-menu-toggle-button"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></div>
                <div id="seperator" class="float_right"  style="height:2.1% !important"></div>
                <div class="float_right"><a id="main-nav-menu-toggle-button"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span></a></div>
                <div class="float_right">
                    <?php
						if($current_language=="english")
						echo anchor($this->lang->switch_uri('ar'),'عربي',array('class' => 'arabic_font '.($current_language=="arabic" ? "active" : ""), 'rel'=>'external' )); 
					
						if($current_language=="arabic")
						echo anchor($this->lang->switch_uri('en'),'English',array('class' => 'english_font '.($current_language=="english" ? "active" : "") , 'rel'=>'external' ));
					  ?>
                    <span class="" aria-hidden="true"></span>
                </div>
                <div class="clear"></div>
                <div class="clearfix"></div>
            </div><!-- nav-buttons-container-->
            <div class="clearfix"></div>
            <div class="v-seperator">&nbsp;</div>
            </div>
            <?php
				/*
					--------------------------------------------------------------
					----------------------  Search Form --------------------------
					--------------------------------------------------------------					
				*/	
			?>
<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          
            <div id="why-register" class="col-xs-6 col-sm-6 col-md-4 col-lg-4 float <?php echo $why_container_push_pull;?>">
             
                     <?php
					 if(!$this->members->members_id){
		$get_whyjoin_slideshows = $this->globalmodel->get_whyjoin_slideshow($current_language_db_prefix);
	//	print_r($get_whyjoin_slideshows);
		?>
        <?php
		for($i = 0 ;$i < sizeof($get_whyjoin_slideshows) ; $i++):
		$image = base_url()."uploads/slideshows/".$get_whyjoin_slideshows[$i]['images_src'];
			?>
            	<a class="fancybox" href="<?php echo $image; ?>" data-fancybox-group="gallery" <?php if($i>=1){?> style="display:none;" <?php } ?>><img src="<?php echo base_url(); ?>images/login_banner<?php echo $current_language_db_prefix; ?>.png" class="img-responsive"/></a>

            <?php
		endfor;
					 }
		?>
			
           
            			
            </div><!-- why-register-->
            <div id="social-media-icons" class="col-xs-6 col-sm-6 col-md-4 col-lg-4 float <?php echo $social_icon_push_pull;?>">
                <a href="https://www.facebook.com/NestleEgypt" rel="external" target="_blank" class="float_right"><img src="<?php echo base_url_mobile("images/socialmedia/mobile_socialmedia_icon_fb.png"); ?>" class="img-responsive" /></a>
                <a href="https://www.youtube.com/user/NestleEgypt" rel="external" target="_blank" class="float_right"><img src="<?php echo base_url_mobile("images/socialmedia/mobile_socialmedia_icon_youtube.png"); ?>" class="img-responsive" /></a>
                <a href="<?php echo site_url_mobile("contact_us") ?>" rel="external" class="float_right"><img src="<?php echo base_url_mobile("images/socialmedia/mobile_socialmedia_icon_contact.png"); ?>" class="img-responsive" /></a>
            </div>
            
              <div id="search-container" class="col-xs-12 col-sm-12 col-md-4 col-lg-4 float">
                <div class="search-bar float_right">
                <form action="<?php echo site_url_mobile('search_results/index'); ?>" method="get" rel="external" data-ajax="false">
                    <input id="main_header_text_area" name="q" type="search" class="form-control" data-type="search" style="height: 55px;"/>
                          <input type="submit" class=" margin_10" rel="external" value="" style="background:none; border:none; background-image:url(<?php echo base_url()."imagess/header_search_icon_magnifer.png" ?>);float:left;margin:0px 0px; cursor:pointer;width: 38px;"/>
                </form>
                </div><!-- search-button -->
                <div class="clearfix"></div>                
            </div><!-- End of search-container -->
            </div>      
                <?php
				/*
					--------------------------------------------------------------
					--------------------  PopUp Login Form -----------------------
					--------------------------------------------------------------					
				*/
				?>
                
              <!--  <div id="mobile_login_popup_box" data-role="popup" class="ui-popup ui-overlay-shadow ui-corner-all ui-body-c" style="padding:10px; position:relative" data-overlay-theme="b" data-ajax="true">
                	<?php 
		 			//$attributes = array('class' => '', 'id' => 'login_form', 'data-ajax' => 'false' );
					//echo form_open_multipart('my_corner/validate',$attributes);
	  				?>
                	<p><label for="email"><?php echo lang('globals_lform_email'); ?>:</label><input type="text" id="email" name="email" /></p>
                    <p><label for="password"><?php echo lang('globals_lform_password'); ?>:</label><input type="password" id="password" name="password" /></p>
                    <input type="hidden" name="redirect" value="<?php echo current_url(); ?>" />
                    <input rel="external" class="btn btn-blue" type="submit" style="padding:5px 15px;" value="<?php echo lang("globals_lform_signin"); ?>"/>
                     <a class="fancybox fancybox.ajax" style="font-size: 14px;padding: 5px;color:#666;line-height: 33px;" href="<?php echo site_url("mobile/my_corner/forgot_your_password"); ?>"><?php echo lang('globals_lform_forgot_your_password'); ?></a>
                    <?php 
					//echo form_close();
	  				?>
                </div>-->
            
      </div>
        </div>
        
        
        <?php // -------------------- START of Content Container --------------------- ?>
        <div id="website-main-body-wrapper" class="row" data-role="content"  data-ajax="false">
        <div class="col-xs-12">
        
        <?php
		//if( isset($isMainHomePage) && $isMainHomePage)
	
		$this->load->view('mobile/template/mainmenu', $this->data);
		?>

       
        