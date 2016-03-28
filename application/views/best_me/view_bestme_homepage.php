<link href="<?php echo base_url(); ?>css/bestme_homepage.css" rel="stylesheet">

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.9.0.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-tabs-rotate.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	 $("#feautre_list_regem").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	 $("#feautre_list_healthy_food").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	 $("#feautre_list_hair").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	 $("#feautre_list_body").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 0, false);
	 
	 $("#feautre_list_food").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 0, false);
	 
	
});
</script>

<script type="text/javascript">
$(document).ready(function(e) {

	$('.feautre_list_food ul.ui-tabs-nav li.ui-tabs-nav-item.ui-state-active').removeClass('white_background_color_soft'); // black_color
	$('.feautre_list_food ul.ui-tabs-nav li.ui-tabs-nav-item.ui-state-active').find(".skew").removeClass('white_background_color_soft');
	$('.feautre_list_food ul.ui-tabs-nav li.ui-tabs-nav-item.ui-state-active').addClass('<?php echo $current_section_background_color_featured_title; ?>'); //  white_color
	$('.feautre_list_food ul.ui-tabs-nav li.ui-tabs-nav-item.ui-state-active').find(".skew").addClass('<?php echo $current_section_background_color_featured_title; ?>');

	$('.feautre_list_food ul.ui-tabs-nav li.ui-tabs-nav-item').click(function(e) {
		
		$('.feautre_list_food ul.ui-tabs-nav li.ui-tabs-nav-item').addClass('white_background_color_soft'); // black_color
	    $('.feautre_list_food ul.ui-tabs-nav li.ui-tabs-nav-item').find(".skew").addClass('white_background_color_soft');

		$(this).removeClass('white_background_color_soft'); // black_color
		$(this).find(".skew").removeClass('white_background_color_soft');
		$(this).addClass('<?php echo $current_section_background_color_featured_title; ?>'); // white_color
		$(this).find(".skew").addClass('<?php echo $current_section_background_color_featured_title; ?>');
	});
	
	
	$('.feautre_list_body ul.ui-tabs-nav li.ui-tabs-nav-item.ui-state-active').removeClass('white_background_color_soft'); // black_color
	$('.feautre_list_body ul.ui-tabs-nav li.ui-tabs-nav-item.ui-state-active').find(".skew").removeClass('white_background_color_soft');
	$('.feautre_list_body ul.ui-tabs-nav li.ui-tabs-nav-item.ui-state-active').addClass('<?php echo $current_section_background_color_featured_title; ?>'); //  white_color
	$('.feautre_list_body ul.ui-tabs-nav li.ui-tabs-nav-item.ui-state-active').find(".skew").addClass('<?php echo $current_section_background_color_featured_title; ?>');

	$('.feautre_list_body ul.ui-tabs-nav li.ui-tabs-nav-item').click(function(e) {
		
		$('.feautre_list_body ul.ui-tabs-nav li.ui-tabs-nav-item').addClass('white_background_color_soft'); // black_color
	    $('.feautre_list_body ul.ui-tabs-nav li.ui-tabs-nav-item').find(".skew").addClass('white_background_color_soft');

		$(this).removeClass('white_background_color_soft'); // black_color
		$(this).find(".skew").removeClass('white_background_color_soft');
		$(this).addClass('<?php echo $current_section_background_color_featured_title; ?>'); // white_color
		$(this).find(".skew").addClass('<?php echo $current_section_background_color_featured_title; ?>');
	});

});
</script>

<script>

		jQuery(function(){
			jQuery(".recent_items_list").jCarouselLite({
				btnNext: ".recentitem_prev",
				btnPrev: ".recentitem_next",
				visible:3
			});
			
			jQuery(".best_cook_inner_applications_list").jCarouselLite({
				btnNext: ".best_me_inner_applications_list_prev",
				btnPrev: ".best_me_inner_applications_list_next",
				visible:3
			});
			
		});
</script>
<style>
.section_title_left
{
	position: relative;
    width: 64%;
    height: 30px;
}
.section_title_right
{
	position: relative;
    width: 30%;
    height: 30px;
}
.skew_right
{
	width: 100%;
    height: 30px;
	-webkit-transform: skew(-35deg);
    -moz-transform: skew(-35deg);
	-o-transform: skew(-35deg);
	margin: 0 -11px;
}
.skew_left
{
	width: 100%;
	height: 30px;
	-webkit-transform: skew(-35deg);
	-moz-transform: skew(-35deg);
	-o-transform: skew(-35deg);
	margin: 0 11px;
}
.skew_left h3
{
	-webkit-transform: skew(35deg);
	-moz-transform: skew(35deg);
	-o-transform: skew(35deg);
	text-indent:10px;
}
.skew_right h3
{
	-webkit-transform: skew(35deg);
	-moz-transform: skew(35deg);
	-o-transform: skew(35deg);
}

/*************************/
.feat_lists_with_tab li.ui-tabs-selected, .feat_lists_with_tab li.ui-tabs-active 
{
	background: url('../../images/bestme/selected-item-right.png') top right no-repeat;
}

</style>



<div class="clear"></div>
 
<?php $this->load->view('template/submenu_writer');   ?>

<?php $this->load->view('template/tree_menu_writer');   ?>


<div id="innerhome_slideshow" class="<?php echo $current_section_background_color; ?> <?php echo $current_section_border_color; ?>">


<div class="slide_show_title_sign float_left">

<div class="inner_margin_wrapper">
<div style="margin:30px 0px;">
<div align="center"><img src="<?php echo base_url(); ?>images/bestme/bestme_inner_slideshow_logo.png"  /></div>
<div align="center"><h2 class="white_color"><?php echo  lang("globals_bestme"); ?></h2></div>
</div>


</div><!-- End of inner_margin_wrapper -->


</div><!-- End of slide_show_title_sign -->

<!-- Display Section Slideshow -->
<?php $this->load->view('template/view_section_slideshow');   ?>

<div class="clear"></div>
</div><!-- End of innerhome_slideshow -->

<div class="clear"></div>


<div class="global_sperator_height" style="width:100%"></div>


    <div id="first_row" style="height:405px;">
        <div class="float_left" style="width:49.5%;height:405px;">
             <?php
                //Get Data Family Life
                list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(15,$current_language_db_prefix);
                $this->widgets->generate_tow_featured_article($subsection_id,$subsection_title,'feautre_list_food',$current_section_color,$current_section_background_color,$current_section_borderbottom_color,$current_section_background_color_featured_title,$current_language_db_prefix);
             ?>
        </div><!--End OF float_left-->
    
        <div class="float_right" style="width:49.5%;height:405px;">
             <?php
                //Get Data  fit
                list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(14,$current_language_db_prefix);
                $this->widgets->generate_featured_article($subsection_title,$display_feautre_fitness,$current_section_color,$current_section_background_color,$current_section_borderbottom_color,$current_language_db_prefix);
                ?>
        </div><!--End OF float_right-->
        
        <div class="clear"></div>
        
    </div><!--end of first_row-->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <div id="second_row" style="height:405px;">
        <div class="float_left" style="width:49.5%;height:405px;">
             <?php
                //Get Data Family Life
                list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(13,$current_language_db_prefix);
                $this->widgets->generate_featured_article($subsection_title,$display_feautre_family_life,$current_section_color,$current_section_background_color,$current_section_borderbottom_color,$current_language_db_prefix);
                ?>
        </div><!--End OF float_left-->
    
        <div class="float_right" style="width:49.5%;height:405px;">
             <?php
                //Get Data Family Life
                list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(16,$current_language_db_prefix);
                $this->widgets->generate_tow_featured_article($subsection_id,$subsection_title,'feautre_list_body',$current_section_color,$current_section_background_color,$current_section_borderbottom_color,$current_section_background_color_featured_title,$current_language_db_prefix);
             ?>
        </div><!--End OF float_right-->
        
        <div class="clear"></div>
        
    </div><!--end of Second_row-->
    
<div class="global_sperator_height" style="width:100%"></div>
	
<?php $this->load->view('best_me/homepage/view_applications_ask_an_expert_row');   ?>