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
			
			jQuery('#camera_wrap_1').camera({
				thumbnails: false,pagination:false,
				height: '225px',playPause : false
			});
			
			jQuery(".recent_items_list").jCarouselLite({
				btnNext: ".recentitem_prev",
				btnPrev: ".recentitem_next",
				visible:3
			});
			
			jQuery(".best_cook_inner_applications_list").jCarouselLite({
				btnNext: ".best_cook_inner_applications_list_prev",
				btnPrev: ".best_cook_inner_applications_list_next",
				visible:3
			});
			
			/*jQuery('#slides').slides({
				preload: true,
				generateNextPrev: false
			});*/
			// jQuery('#slides').slides();
			 
		
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
.float_right{ float:right}

/*************************/
.feat_lists_with_tab li.ui-tabs-selected, .feat_lists_with_tab li.ui-tabs-active 
{
	background: url('../../images/bestmom/selected-item-right.png') top right no-repeat;
}

</style>


<div class="clear"></div>
 
<?php $this->load->view('template/submenu_writer');   ?>

<?php $this->load->view('template/tree_menu_writer');   ?>


<div id="innerhome_slideshow" class="<?php echo $current_section_background_color; ?> <?php echo $current_section_border_color; ?>">


<div class="slide_show_title_sign float_left">

<div class="inner_margin_wrapper">
<div style="margin:30px 0px;">
<div align="center"><img src="<?php echo base_url(); ?>images/bestmom/bestmom_inner_slideshow_logo.png"  /></div>
<div align="center"><h2 class="white_color" style="position:relative; top:-10px" ><?php echo  lang("globals_bestmom"); ?></h2></div>
</div>


</div><!-- End of inner_margin_wrapper -->


</div><!-- End of slide_show_title_sign -->

<div class="slide_show_wrapper float_right" style="overflow: visible; z-index: 1;">

<div class="camera_wrap camera_azure_skin" id="camera_wrap_1">

<?php 
for($i=0 ; $i < sizeof($display_section_slideshow) ; $i++):
$image = base_url()."uploads/slideshows/".$display_section_slideshow[$i]['images_src'];
?>


<div data-thumb="<?php echo $image; ?>" data-src="<?php echo $image; ?>"></div>                
<?php
endfor;
?>
    </div><!-- End of camera_wrap -->

</div><!-- End of slide_show_wrapper -->

<div class="clear"></div>
</div><!-- End of innerhome_slideshow -->

<div class="clear"></div>


<div class="global_sperator_height" style="width:100%"></div>

<!--Start First Row-->
<div style="height:295px; ">
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


<div class="float_right">
<?php /*?><div class="inner_tips_wrapper " style="margin-bottom:3px;width: 360px; height:167px;" >
<h1 class="best_mom_color" style="font-size:20px;line-height: 25px;text-align:center;">  <?php echo lang('globals_every_day_advice');?></h1>

<div  class="close_quote <?php echo $current_section_color; ?>" > &#8220;</div>
<div  class="open_quote <?php echo $current_section_color; ?>" >&#8221;</div>


        <div id="slides">
                <div class="slides_container">
               <?php
				for($i = 0 ; $i <sizeof($display_section_tips) ; $i++)
				{
					$tip = $display_section_tips[$i]['section_tips_name'.$current_language_db_prefix];
					if($current_language_db_prefix == '_ar')
					{
						$short_tip = mb_substr(strip_tags($tip), 0, 200 , 'utf-8'). (strlen(strip_tags($tip)) > 200?'...':'');
					}
					else
					{
						$short_tip = mb_substr(strip_tags($tip), 0, 150, 'utf-8'). (strlen(strip_tags($tip)) > 150?'...':'');
					}
					echo '<div class="today_tips">'.$short_tip.'</div>';
				}
				?>
                <div class="clear"></div>
                </div>
                 
                <div class="clear"></div>
        </div><!-- End of slides -->
        
        
	</div><!-- ENd of inner_tips_wrapper -->
<div class="clear"></div>
<div style=" width:360px; height:125px;">
<img src="<?php echo base_url()."images/bestmom/banner_tatwer_7amly{$current_language_db_prefix}.png" ?>" />
</div>
<?php */?>

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
<div  class="float_left" style="height:149px" ><img  width="1000" src="<?php echo base_url()."images/bestmom/advice_bigger{$current_language_db_prefix}.png"  ?>"/></div>

<div class="clear"></div>
<div class="global_sperator_height" style="width:100%"></div>

        <div class="float_left" style="width:495px;">
        	<?php
					//Get Data Growing Up
				list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(71,$current_language_db_prefix);?>
            <div class="section_title_right float_left <?php echo $current_section_background_color; ?>"><div class="skew_right white_color <?php echo $current_section_background_color; ?>"><h3><?php echo $subsection_title; ?></h3></div></div>
            <div class="section_title_left float_right" style="background-color:#FFE6B0;"><div class="skew_left " style="background-color:#FFE6B0;"><h3><?php echo lang('bestmom_all_you_need_to_know_about_feeding_your_baby_and_health'); ?></h3></div></div>
            <div class="clear"></div>
            
           <?php //$this->load->view('best_mom/homepage/view_feautre_list_taghzia_tefly');   ?>
           <?php $this->widgets->generate_tab_lists('feat_list_taghzia_tefly',71,$current_language_db_prefix,$current_section_border_color,$current_section_borderbottom_color);   ?>

            
        </div><!-- End of width:495px; -->
        
        

    
    <div class="float_right" style="width:495px;">
    		<?php
		//Get Data carring for my baby 
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(72,$current_language_db_prefix);?>
																														

        <div class="section_title_right float_left <?php echo $current_section_background_color; ?>"><div class="skew_right white_color <?php echo $current_section_background_color; ?>"><h3><?php echo $subsection_title;?></h3></div></div>
    	<div class="section_title_left float_right" style="background-color:#FFE6B0;"><div class="skew_left" style="background-color:#FFE6B0;"><h3><?php echo lang('bestmom_all_you_need_to_know_about_feeding_your_baby_and_health'); ?></h3></div></div>
   		<div class="clear"></div>
        
        <?php //$this->load->view('best_mom/homepage/view_feautre_list_3enaya_tefly');   ?>
        <?php $this->widgets->generate_tab_lists('feat_list_3enaya_betefly',80,$current_language_db_prefix,$current_section_border_color,$current_section_borderbottom_color);   ?>

    
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