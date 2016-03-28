<?php
if(!$this->members->members_id)
{
   redirect(site_url('mobile/best_me/applications/9/homepage'), 'refresh');
}
?>

<div class="row nestle-fit-top-ten">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<?php
        $members_image = base_url() . "uploads/members/" . $this->members->members_image;
		echo '<div id="nestlefit_member_img_container" style="padding-top: 16px;">'.nestlefit_member_image($members_image,115,115).'</div>';
	?>
</div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  	<div class="col-xs-8 col-sm-7 top-ten-class">
    	<h3 class="nestlefit_inner_title"><?php echo lang('nestlefit_top_ten'); ?></h3>
    </div>
    <div class="class=col-xs-4 col-sm-5 back_container">
    	<a rel="external" class="back"  title="<?php echo lang('globals_back'); ?>" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>"><img alt="<?php echo lang('globals_back'); ?>" title="<?php echo lang('globals_back'); ?>" src="<?php echo base_url().'images/nestle_fit/back.png'; ?>" /></a>
    	<a rel="external" class="back-title" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>">  <span style="color:#FFF"><?php echo  lang("nestlefit_back_btn"); ?></span></a>
    </div>    
  </div>
   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 30px;">
   <?php $ten_colors_array = array(
        '#f68d27',
        '#de8229',
        '#c56e19',
        '#a62a50',
        '#992347',
        '#7f1535',
        '#620b65',
        '#510c54',
        '#39043b',
        '#2e0b2f'
        );
        
        $site_lang = $this->config->item('language');
        $dir = $site_lang == "arabic" ? "rtl" : "ltr";
        
        $loop_num = 0;
		     foreach($winners as $winner)
        {
        $count = $site_lang == "arabic" ? $this->common->arabic_numbers($loop_num + 1) . '- ' : $loop_num + 1 . '- ';
        $points = $site_lang == "arabic" ? $this->common->arabic_numbers($winner['points_count']) : $winner['points_count'];
           ?>
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4" style="background-color:<?php echo $ten_colors_array[$loop_num];?>;padding: 5px;  margin-bottom: 1px;">

             <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6 winer-name"><?php echo $count . $winner['nestle_fit_health_name'];?></div>
             <div class="col-xs-4 col-sm-6 col-md-6 col-lg-6 winer-points"><?php echo $points . ' ' . lang('globals_hmenu_point');?></div>
          </div>   
           <?php
		$loop_num++;
        }
		?>
  </div>
</div>


<style>
.arabic .winer-name{
	float:right;
}
.arabic .winer-points{
	float:left;
	
}

 /* Smart Phone */
@media (min-width: 320px) and (max-width: 640px) {
	.top-ten-class {
		float: right;
		text-align: left;
	}
	.top-ten-class .nestlefit_inner_title {
		text-align: end;
    	margin-left: 38px;	
	}
	.back_container {
		display: table-caption;
	    margin-left: 33px;
    	margin-top: 27px;	
	}
	.back_container .back-title {
		font-size: 17px;
	}
	.english .nestlefit_inner_title {
		text-align: left;
		margin-left: 38px;
	}
}

/*This Media Query For Tablet Vertical */
@media (min-device-width: 800px) and (max-device-width: 1280px){
	.top-ten-class {
		float: right;
	}
	.nestlefit_inner_title {
		text-align: left;
    	margin-left: 90px;	
	}
	.back_container .back-title {
		font-size: 17px;
		position: relative;
		top: 50px;
		right: 60px;
	}
	.back_container .back {
	    position: relative;
		top: 25px;
		right: 94px;
	}
	.english .back_container {
		text-align: right;	
	}
	.english .back_container .back-title {
		font-size: 17px;
		position: relative;
		top: 56px;
		right: 128px;
	}
	
}
</style>