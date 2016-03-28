
<style>
.thick_line
{
	width: 100%;
  height: 4px;
    background: #13758e;
}


</style>


	<section class="<?php echo $current_section; ?>">
  
          <?php   echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png" , site_url_mobile(''.$this->router->class));?>


	<div class="row">
    	<div class="col-md-12 col-sm-12 col-xs-12">
		<h1 style="font-size:25px; color:#13758e;" class="float_left"><?php echo $subsection_title; ?></h1>
        </div>
	</div>
    
    <div class="row">
    	<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="thick_line row"></div>
        </div>
	</div>
  

<?php
$title = $display[0]['easy_ideas_title'.$current_language_db_prefix];
$step_title = $display_steps[0]['easy_ideas_steps_title'.$current_language_db_prefix];
$step_image = base_url()."uploads/easy/".$display_steps[0]['images_src'];
$step_desc  = $display_steps[0]['easy_ideas_steps_desc'.$current_language_db_prefix];
?>



<?php /*?>    <div class="dashed_background_wrapper">
    	<div class="image float_left"><img src="<?php echo $step_image; ?>" /><div class="desc"><h3><?php echo $title; ?></h3></div></div>
    	<div class="title_wrapper float_right">
        	<div class="title_white_background">
            <div class="circle_wrapper float_left"><p id="manage_index_ajax" class="<?php echo $current_section_color; ?>">1</p></div>
            <div class="clear"></div>
            
            <div id="manage_desc_ajax">
            <?php echo $step_desc; ?>
            </div>
            </div>
        
        </div><!-- End of title_wrapper -->
    	<div class="clear"></div>
    </div><!-- ENd of dashed_background_wrapper --><?php */?>

        
     	<?php
		for($i=0 ; $i < sizeof($display_steps) ; $i++):
		$id = $display_steps[$i]['easy_ideas_steps_ID'];
		$image = base_url()."uploads/easy/thumb_".$display_steps[$i]['images_src'];
		$step_title = $display_steps[$i]['easy_ideas_steps_title'.$current_language_db_prefix];
		$step_desc  = $display_steps[$i]['easy_ideas_steps_desc'.$current_language_db_prefix];
		?>
        	
            <div class="row">
    	<div class="col-md-12 col-sm-12 col-xs-12">
    <h2><?php echo $step_title; ?></h2>
       </div>
	</div>
           <div class="row">
           <div class="col-md-4 col-sm-6 col-xs-12 float_left">
            <img src="<?php echo $image; ?>" class="img-responsive" width="100%"/>
                </div>
                <div class="col-md-8 col-sm-6 col-xs-12 float_left">
         <h2 style="margin-top:10px;"> <?php echo $step_desc; ?></h2>
                </div>
	</div>
            
        <?php
		
		endfor;
		?>
      
  
    

<?php /*?><div class="<?php echo $current_section_background_color ?>" style="height:40px; background:#e82327; position:relative;width: 105%;margin-left: -25px;margin-top: 15px; display:none">
	<div class="sections_wrapper_margin">
		<div class="float_left" style="font-size:24px;color:white;">أفكار سهلة اخري</div>
    </div>
    <img width="26" style="position:absolute; left:0; top:40px;" src="<?php echo base_url(); ?>images/left_shadow_besttime.png"/>
    <img width="26" style="position:absolute; right:0; top:40px;" src="<?php echo base_url(); ?>images/right_shadow_best_time.png"/>
</div>

<div class="recent_items_list_wrapper " style="height:270px; display:none">

    <div class="sections_wrapper_margin" style="padding-top: 10px;" >
    
        <a class="recentitem_prev float_right" style="cursor:pointer"><img src="<?php echo base_url()?>images/icons/right_arrow_besttime.png" /></a>
        <a class="recentitem_next float_left" style="cursor:pointer"><img src="<?php echo base_url()?>images/icons/left_arrow_besttime.png" /></a>
        <div class="recent_items_list">
        <ul>
			<?php for($i=0;$i<6;$i++):
				$title=" ضعى كحل عند بداية الرموش عشان تخلى شكلها كثيف اكتر";
			?>
        	<li style="height:270px;">
            
           
            
            <div class="image global_sperator_margin_bottom"><img src="http://cdn.pimg.co/p/218x168/858652/fff/img.png" alt=""  ></div>
            <div class="title float_left dark_gray" style="height:auto;"><div style="margin:0px 5px;"><a href="<?php // echo $url ?>"><?php echo $title;?><h4 class="best_cook_color global_sperator_margin_top"><?php //echo $member_name ?></h4></a></div></div>
			<div class="clear"></div>
			</li>
        <?php
		endfor;
		?>
            
            
        </ul>

    
    </div><!--- End of recent_items_list -->


</div><!-- End of sections_wrapper_margin -->


</div>

<div style="width:100%; height:25px"></div><?php */?>



