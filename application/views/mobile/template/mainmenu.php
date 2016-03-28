<style>
#website-main-nav-menu ul{
margin: 0px !important;
}
#website-main-nav-menu
	{
		width:20%;
	}
@media only screen and (max-width : 1200px) {
#website-main-nav-menu
	{
		width:30%;
	}
}

@media only screen and (max-width : 480px) {
#website-main-nav-menu
	{
		width:55%;
	}
}

@media only screen and (max-width : 320px) {
#website-main-nav-menu
	{
		width:60%;
	}
}
</style>
<?php $nav_menu_style = $current_language == 'english' ? 'left: auto; right: 0px' : 'right: auto'; ?>
<div id="website-main-nav-menu" class="" style="padding: 10px; top: 0px;  overflow:scroll; min-height: 314px; <?php echo $nav_menu_style; ?>">
<a id="website-main-nav-menu-close-button" href="#" style="font-size:24px;">x</a>
<?php
if($this->members->members_id)
{ ?>
<div class="image-profile">
<a><img src="<?php echo base_url()."uploads/members/".$this->members->members_image; ?>" class="img-responsive img-circle" /></a>

<?php
	 // Generate username
	 $user_name = $this->members->members_fullname;
	 if($current_language=="english")
	 {
		$full_name = $this->common->limit_text($user_name,15);
	 }
	 elseif($current_language=="arabic")
	 {
		$full_name = $this->common->limit_text($user_name,30);
	 }
	
	// Echo username
?>
<h4 class="text-center" title="<?php echo $user_name; ?>"><?php echo $full_name; ?></h4>
</div><!-- image-profile -->

<div class="section-seperator-margin"></div>
<?php
//Display the Ids of My Corner
list($myProfileSubsectionID,$myProfileSubsectionTitle,$subsectionExtra) = getSectiondata(188,$current_language_db_prefix);
list($awardsSubsectionID,$awardsSubsectionTitle,$subsectionExtra) = getSectiondata(192,$current_language_db_prefix);
list($favRecipessubsectionID,$favRecipesSubsectionTitle,$favRecipesSubsectionTitle) = getSectiondata(193,$current_language_db_prefix);
list($favArticlessubsectionID,$favArticlesSubsectionTitle,$favArticlesSubsectionTitle) = getSectiondata(194,$current_language_db_prefix);
?>
<ul>
	<li class="mob-nav-menu-parent"><?php echo mobileHyperlink(site_url_mobile("my_corner/profile"),$myProfileSubsectionTitle,$myProfileSubsectionTitle); ?></li>
    <li class="mob-nav-menu-parent"><?php echo mobileHyperlink(site_url_mobile("my_corner/my_recipies_book"), $favRecipesSubsectionTitle , $favRecipesSubsectionTitle); ?></li>
    <li class="mob-nav-menu-parent"><?php echo mobileHyperlink(site_url_mobile("my_corner/my_articles"), $favArticlesSubsectionTitle, $favArticlesSubsectionTitle); ?></li>
    <li class="mob-nav-menu-parent"><?php echo mobileHyperlink(site_url_mobile("my_corner/my_points"), $awardsSubsectionTitle , $awardsSubsectionTitle); ?></li>
</ul>

<div class="section-seperator-margin thin-line dark-gray-sep"></div>

<?php
}
?>



<ul>
	<li mob_nav_top_section="best_me">
    	<a class="mob-nav-menu-parent" mob_nav_top_section="best_me" href="<?php echo site_url_mobile("best_me"); ?>"><?php echo lang("globals_bestme"); ?></a>
        
    	<?php
		$sub_array= array();
		mobile_menu_get_subsections(10, $sub_array);
		mobile_menu_fetch_subsections($sub_array, 10, 10, 'best_me', $current_language);
		?>
    </li>
    
    <li mob_nav_top_section="best_cook">
    	<a class="mob-nav-menu-parent" mob_nav_top_section="best_cook" href="<?php echo site_url_mobile("best_cook"); ?>"><?php echo lang("globals_bestcook"); ?></a>
        <?php
		$sub_array= array();
		mobile_menu_get_subsections(2, $sub_array);
		mobile_menu_fetch_subsections($sub_array, 2, 2, 'best_cook', $current_language);
		?>
    </li>
    <li mob_nav_top_section="best_mom">
    	<a class="mob-nav-menu-parent" mob_nav_top_section="best_mom" href="<?php echo site_url_mobile("best_mom"); ?>"><?php echo lang("globals_bestmom"); ?></a>
			<?php
		$sub_array= array();
		mobile_menu_get_subsections(27, $sub_array);
		mobile_menu_fetch_subsections($sub_array, 27, 27, 'best_mom', $current_language);
		?>
    </li>
    <li mob_nav_top_section="best_time">
    	<a class="mob-nav-menu-parent" mob_nav_top_section="best_time" href="<?php echo site_url_mobile("best_time"); ?>"><?php echo lang("globals_besttime"); ?></a>
        <?php
		$sub_array= array();
		mobile_menu_get_subsections(28, $sub_array);
		mobile_menu_fetch_subsections($sub_array, 28, 28, 'best_time', $current_language);
		?>
    </li>
    <li mob_nav_top_section="products">
    	<a class="mob-nav-menu-parent" mob_nav_top_section="products" href="<?php echo site_url_mobile("products"); ?>" rel="external"><?php echo lang("globals_nestleproducts"); ?></a>
    </li>
</ul>

<div class="section-seperator-margin thin-line dark-gray-sep"></div>

<ul>
	<li class="mob-nav-menu-parent"><a rel="external" href="<?php echo site_url_mobile("contact_us"); ?>"><?php echo lang("globals_secmenu_contactus"); ?></a></li>
	   <li class="mob-nav-menu-parent"><a rel="external" href="<?php echo site_url_mobile('terms_conditions')?>"><?php echo lang('globals_secmenu_terms');?></a></li>
       <li class="mob-nav-menu-parent"><a rel="external" href="<?php echo site_url_mobile('privacy_policy')?>"><?php echo lang('globals_secmenu_privacy');?></a></li>
       <li class="mob-nav-menu-parent"><a rel="external" href="<?php echo site_url_mobile('faq')?>"><?php echo lang('globals_secmenu_faq');?></a></li>
</ul>

</div>
