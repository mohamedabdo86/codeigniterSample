<?php
		$members_ID = $this->session->userdata('userid');
		$members_name = $this->session->userdata('name');
		$members_email = $this->session->userdata('email');

?>

<div id="profile_wrapper" class="">
    <div class="image float_left margin_10"><img  width="75" height="75" src="<?php echo base_url()."uploads/members/".$this->members->members_image ?>"  /></div>
    <div class="profile_info float_left">
    
    <?php
	
	 if($current_language=="english"){
	$full_name = $this->common->limit_text($this->members->members_fullname,15);
	 }
	   elseif($current_language=="arabic"){
	$full_name = $this->common->limit_text($this->members->members_fullname,30);
	   	}
	
	?>
	<h2 class="dir"><? echo ucwords($full_name);?></h2>
    <div class="clear"></div>
    <ul class="float_left">
    <li class="float_left"><a><span style="line-height:26px;"><?php echo $this->members->members_points ?></span> <br /><?php echo lang("globals_hmenu_point"); ?></a></li>
    <li class="float_left seperator"></li>
    <li class="float_left"><a title="(<?php echo $this->members->members_no_of_overall_posts ?>)<?php echo lang('mycorner_recipe_invisible'); ?> | (<?php echo $this->members->members_no_of_overrall_posts_unapproved ?>)<?php echo lang('mycorner_recipe_visible'); ?>" ><span style="line-height:26px;"><?php echo $this->members->members_no_of_overall_posts ?>(<?php echo $this->members->members_no_of_overrall_posts_unapproved ?>)</span> <br /><?php echo lang("globals_hmenu_post"); ?></a></li>
    <li class="seperator float_left"></li>
    <li class="float_left"><a style="display:block ; text-align:center; line-height:3px;"><img  src="<?php echo base_url(); ?>images/header_icon_trophy.png" /></a><a style="line-height:10px;" ><?php echo lang("globals_hmenu_trophies"); ?></a></li>
    </ul>
    </div><!-- End of profile_info -->
    <div class="float_left long_seperator" style="margin:15px 1px"></div>
    <div class="profile_menu float_left" style="margin:46px 0px 15px">
        <ul>
        <li class="float_left"><a href="<?php echo site_url('my_corner/profile')?>"><?php echo lang("globals_hmenu_myprofile"); ?></a></li>
        <li class="float_left"><a href="#"><?php echo lang("globals_hmenu_myfavlist"); ?></a>
        <ul class="submenu"><li><a href="<?php echo site_url('my_corner/my_recipies_book')?>"><?php echo lang('globals_hmenu_fav_recipes'); ?></a></li><li><a href="<?php echo site_url('my_corner/my_articles')?>"><?php echo lang('globals_hmenu_fav_articles');?></a></li></ul>
        </li>
        <li class="float_left"><a href="<?php echo site_url('best_cook/upload_recipe');?>"><?php echo lang("globals_hmenu_post"); ?></a>
                <ul style="visibility:hidden" class="submenu"><li><a href="">وصفات</a></li><li><a href="">مقالات</a></li><li><a href="">فيديو</a></li></ul>
        </li>
        <li class="float_left"><a href="<?php echo site_url('my_corner/my_points') ?>"><?php  echo lang("globals_hmenu_nestleoffers"); ?></a></li>
        </ul>
    </div><!-- End of profile_info -->
    
    <div class="float_right " style="margin-top:35px;"><a href="<?php echo site_url("my_corner/logout/".$this->members->members_language) ?>"><img  src="<?php echo base_url(); ?>images/header_icon_logout.png" /></a></div>
    	
   <!--  <div class="float_right long_seperator" style="margin:15px 3px; height:35px; margin-top:35px; "></div>
   <div class="float_right " style="margin-top:35px;"><img  src="<?php  //echo base_url(); ?>images/header_icon_settings.png" /></div>-->
</div><!-- End of profile_wrapper -->