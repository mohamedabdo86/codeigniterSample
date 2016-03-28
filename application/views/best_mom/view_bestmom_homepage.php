<link href="<?php echo base_url(); ?>css/bestmom_homepage.css" rel="stylesheet">
<script type="text/javascript">
$(document).ready(function(e) {
     $(".featured").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 0, false);
	 $("#feat_list_taghzia_tefly").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	 $("#feat_list_3enaya_betefly").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	 $("#feat_list_el_abwan").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	 $("#feat_list_se7et_tefly").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	 $("#feat_list_tansh2t_tefly").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	 
	 $('#feat_list_tansh2t_tefly').mouseover(function(){$(this).tabs('rotate', 0, false); });
	 $('#feat_list_tansh2t_tefly').mouseout(function(){$(this).tabs({ fx: { opacity: 'toggle' } }).tabs('rotate', 5000);});
	
});
</script>
<script>

		jQuery(function(){
			
			jQuery(".recent_items_list").jCarouselLite({
				btnNext: ".recentitem_prev",
				btnPrev: ".recentitem_next",
				visible:1
			});
			
			jQuery(".best_cook_inner_applications_list").jCarouselLite({
				btnNext: ".best_cook_inner_applications_list_prev",
				btnPrev: ".best_cook_inner_applications_list_next",
				visible:1
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
	    width: 31%;
    height: 30px;
}
.float_right{ float:right}

/*************************/
.feat_lists_with_tab li.ui-tabs-selected, .feat_lists_with_tab li.ui-tabs-active 
{
	background: url('../../images/bestmom/selected-item-right.png') top right no-repeat;
}
.english .plus_sign 
{
	margin: 0px 4px;
}
</style>


<div class="clear"></div>
 
<?php $this->load->view('template/submenu_writer');   ?>

<?php $this->load->view('template/tree_menu_writer');   ?>


<div id="innerhome_slideshow" class="<?php echo $current_section_background_color; ?> <?php echo $current_section_border_color; ?>">


<div class="slide_show_title_sign float_left">

<div class="inner_margin_wrapper">
<div style="margin:30px 0px;">
<div align="center"><img src="<?php echo base_url(); ?>images/bestmom/bestmom_inner_slideshow_logo.png" alt="best mom"  /></div>
<div align="center"><h2 class="white_color" style="position:relative; top:0px" ><?php echo lang("globals_bestmom"); ?></h2></div>
</div>


</div><!-- End of inner_margin_wrapper -->


</div><!-- End of slide_show_title_sign -->

<!-- Display Section Slideshow -->
<?php $this->load->view('template/view_section_slideshow');   ?>

<div class="clear"></div>
</div><!-- End of innerhome_slideshow -->

<div class="clear"></div>


<div class="global_sperator_height" style="width:100%"></div>

<!--Start First Row-->
<div>
    <div class="float_left ">
        <div class="inner_title_wrapper">
            <div class="sections_wrapper_margin">
            	<?php
					 //Get Data 7amly 
					list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(62,$current_language_db_prefix);
				?>
            <h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo $subsection_title; ?></h1>
            </div>
        </div>
        <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
        
        <div class="float_left" style="width:630px;height:200px;">
        
            <?php $this->load->view('best_mom/homepage/view_feature_7amly'); ?>
        
        </div>
	</div>


<div class="float_right" style=" height:244px">

<a href="<?php echo site_url('best_mom/applications/3');?>"> <img src="<?php echo base_url()."images/bestmom/banner-tatwer-el7ml{$current_language_db_prefix}.png" ?>" alt="<?php echo lang('bestmom_the_pregenancy_journy_film'); ?>"/> </a>

</div>



<div class="clear"></div>
</div><!--end of 7amly-->
<div class="clear"></div>
<div class="global_sperator_height" style="width:100%"></div>
<div class="clear"></div>
<div class="inner_title_wrapper">
    <div class="sections_wrapper_margin">
    <?php
		//Get Data  baby
			list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(63,$current_language_db_prefix); 
	 ?>
    <h1 class="<?php echo $current_section_color; ?> float_left" style="font-size:20px;"><?php echo $subsection_title; ?></h1>
    <div class="clear"></div>
    </div>
</div>
<div class="thick_line <?php echo $current_section_background_color; ?>" ></div>


<div class="white_background_color" style="height:400px;">
<div style="width:100%" class="global_sperator_height"></div>
<div  class="float_left" style="height:149px" ><img  width="1000" src="<?php echo base_url()."images/bestmom/advice_bigger{$current_language_db_prefix}.png"  ?>" alt="<?php echo lang('bestmom_world_health_organization')?>"/></div>

<div class="clear"></div>
<div class="global_sperator_height" style="width:100%"></div>

        <div class="float_left" style="width:495px;">
        	<?php
					//Get Data Growing Up
				list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(71,$current_language_db_prefix);?>
            <div class="section_title_right float_left <?php echo $current_section_background_color; ?>"><div class="skew_right white_color <?php echo $current_section_background_color; ?>"><h3><?php echo $subsection_title; ?></h3></div></div>
            <div class="section_title_left float_right" style="background-color:#FFE6B0;"><div class="skew_left " style="background-color:#FFE6B0;"><h3><?php echo $subsection_extra; ?></h3></div></div>
            <div class="clear"></div>
            
           <?php //$this->load->view('best_mom/homepage/view_feautre_list_taghzia_tefly');   ?>
           <?php $this->widgets->generate_tab_lists('feat_list_taghzia_tefly',71,$current_language_db_prefix,$current_section_border_color,$current_section_borderbottom_color);   ?>

            
        </div><!-- End of width:495px; -->
        
        

    
    <div class="float_right" style="width:495px;">
    		<?php
		//Get Data carring for my baby 
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(72,$current_language_db_prefix);?>
																														

        <div class="section_title_right float_left <?php echo $current_section_background_color; ?>"><div class="skew_right white_color <?php echo $current_section_background_color; ?>"><h3><?php echo $subsection_title;?></h3></div></div>
    	<div class="section_title_left float_right" style="background-color:#FFE6B0;"><div class="skew_left" style="background-color:#FFE6B0;"><h3><?php echo $subsection_extra; ?></h3></div></div>
   		<div class="clear"></div>
        
        <?php //$this->load->view('best_mom/homepage/view_feautre_list_3enaya_tefly');   ?>
        <?php $this->widgets->generate_tab_lists('feat_list_3enaya_betefly',72,$current_language_db_prefix,$current_section_border_color,$current_section_borderbottom_color);   ?>

    
    </div>
    
<div class="clear"></div>



</div><!--end of tefly el rade3-->


<div class="clear"></div>

<div class="global_sperator_height" style="width:100%"></div>

<div class="clear"></div>


<div class="inner_title_wrapper">
    <div class="sections_wrapper_margin">
    	<?php
			//Get Data form grow up 
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(64,$current_language_db_prefix);
		 ?>
    <h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo $subsection_title;?></h1>
    </div>
</div>
<div class="thick_line <?php echo $current_section_background_color; ?>" ></div>

<div class="white_background_color" style="height:300px;">



<?php $this->load->view('best_mom/homepage/view_feature_tansh2t_tefly');   ?>

    
<div class="clear"></div>
</div><!--end of tefly el rade3-->

<div class="global_sperator_height" style="width:100%"></div>

<?php //$this->load->view('best_mom/homepage/view_tanshi2it_teflik_row');   ?>

<div class="clear"></div>

<?php $this->load->view('best_mom/homepage/view_applications_ask_an_expert_row');   ?>
