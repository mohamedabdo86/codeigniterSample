<div class="clear"></div>
</div><!-- End of mainbody_wrapper -->

<div class="clear"></div>

<style>
.footer_a { font-size:13px; color:#a5a5a5; margin-bottom:10px; padding-left:0.7em; /*padding-right:0.7em;*/ }
.footer_item { color:#d1d1d1; }
#footer_wrapper { height:40px; line-height:40px; font-size:12px; background:#555555; }
body.arabic .footer_a { direction:rtl; }
.footer_item_menu {
color: #d1d1d1;
width: 80px;
}
</style>

<!-- Footer Nido Products -->
<div id="nido_products_footer" class="global_sperator_margin_top" style="padding-bottom:11px;">
<div id="title_wrapper"><div id="title_container"><?php echo lang('globals_nestleproducts'); ?></div></div>
    <div class="inner" style="margin-top: -35px;height: 196px;">
    <img class="float_left" style="position: relative;z-index: -9;" src="<?php echo base_url()."images/all_nestle_products_images.png"; ?>" width="710"/>
    <div  class="float_left footer_seperator" style="height: 196px;"></div>
    <img class="float_left" style="position: relative;z-index: -9; height:207px" src="<?php echo base_url()."images/logo_footer.png"; ?>" width="260"/>

    <div class="clear"></div>
    
    
        
    </div>

</div><!-- ENd footer nido products -->

<div class="clear"></div>

<div id="prefooter_wrapper" >


    <div class="inner ">
    
    
    <?php
	//Get Main sections Data
	$bestcook_display_sections = $this->sectionsmodel->get_children_sections(2);
	$bestmom_display_sections = $this->sectionsmodel->get_children_sections(27);
	$bestme_display_sections = $this->sectionsmodel->get_children_sections(10);
	$besttime_display_sections = $this->sectionsmodel->get_children_sections(28);
	?>


	<div class="float_right" style="width: 960px;">
    <a href="<?php echo site_url('best_mom');?>" class="footer_a float_left text_bold footer_item_menu"><?php echo lang('globals_bestmom'); ?></a><div class="footer_a float_left text_bold">/</div>
    <?php
	
	for($i = 0 ; $i < sizeof($bestmom_display_sections) ; $i++)
	
	echo '<a href="'.site_url('best_mom/'.$bestmom_display_sections[$i]['sub_sections_footer_url']).'" class="footer_a float_left">'.$bestmom_display_sections[$i]['sub_sections_name'.$current_language_db_prefix].'</a>';
	?>
    <div class="clear"></div>
    <a href="<?php echo site_url('best_cook');?>" class="footer_a float_left text_bold footer_item_menu"><?php echo lang('globals_bestcook'); ?></a><div class="footer_a float_left text_bold">/</div>
    <?php
	for($i = 0 ; $i < sizeof($bestcook_display_sections) ; $i++)
	echo '<a href="'.site_url('best_cook/'.$bestcook_display_sections[$i]['sub_sections_footer_url']).'" class="footer_a float_left">'.$bestcook_display_sections[$i]['sub_sections_name'.$current_language_db_prefix].'</a>';
	?>
    

    <div class="clear"></div>
    <a href="<?php echo site_url('best_me');?>" class="footer_a float_left text_bold footer_item_menu"><?php echo lang('globals_bestme'); ?></a><div class="footer_a float_left text_bold">/</div>
    <?php
	for($i = 0 ; $i < sizeof($bestme_display_sections) ; $i++)
	echo '<a href="'.site_url('best_me/'.$bestme_display_sections[$i]['sub_sections_footer_url']).'" class="footer_a float_left">'.$bestme_display_sections[$i]['sub_sections_name'.$current_language_db_prefix].'</a>';
	?>
    <div class="clear"></div>
    <a href="<?php echo site_url('best_time');?>" class="footer_a float_left text_bold footer_item_menu"><?php echo lang('globals_besttime'); ?></a><div class="footer_a float_left text_bold">/</div>
     <?php
	for($i = 0 ; $i < sizeof($besttime_display_sections) ; $i++)
	echo '<a href="'.site_url('best_time/'.$besttime_display_sections[$i]['sub_sections_footer_url']).'" class="footer_a float_left">'.$besttime_display_sections[$i]['sub_sections_name'.$current_language_db_prefix].'</a>';
	?>
    </div>
    
    <div class="clear"></div>
    
    </div><!-- End of inner -->


</div><!-- ENd of prefooter_wrapper -->
<?php

date_default_timezone_set("Egypt");
$current_year = date("Y");

?>
<div id="footer_wrapper"  >
	<div class="inner">
        <div class="footer_item float_right margin_right_15">Copyright <?php echo $current_year; ?> Nestle Egypt / Be at your best</div>
        <a href="<?php echo site_url('welcome')?>" class="footer_item float_left margin_left_15 margin_right_15"><?php echo lang('globals_home'); ?></a>
        <!--<a href="" class="footer_item float_left margin_right_15">عن نستله</a>-->
        <a href="<?php echo site_url('contact_us')?>" class="footer_item float_left margin_left_15"><?php echo lang('globals_secmenu_contactus');?></a>
     </div><!-- End of inner -->
</div><!-- End of footer_wrapper -->


</body>
</html>
