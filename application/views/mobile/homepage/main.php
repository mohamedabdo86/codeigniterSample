<?php /*?><script type="text/javascript">
$(document).ready(function(e){
	    $(".pop_up_image").fancybox({
        afterShow: function () {
            $(".fancybox-image").wrap($("<a />", {
                // set anchor attributes
                href: 'best_me/applications/9', //or your target link
                target: "_blank" // optional
            }));
        }
    }).trigger("click");
});
</script>
<style>
.mobile-home-page-all-section-widget
{
	margin-bottom: 14px !important;
}
</style>

<a class="fancybox pop_up_image" href="<?php echo base_url()."images/homepage/new_pop_up.jpg"; ?>"></a><?php */?>


<section>

    <?php
    //echo $this->mwidgets->generateMainHomepageSection("best-me", lang("globals_bestme"), site_url_mobile("best_me"), "http://cdn.pimg.co/p/690x290/ccc/fff/img.png", "الريجيم وطرقه المختل�?ة");
   // echo $this->mwidgets->generateMainHomepageSection("best-cook", lang("globals_bestcook"), site_url_mobile("best_cook"), "http://cdn.pimg.co/p/690x290/ccc/fff/img.png", "الريجيم وطرقه المختل�?ة");
    //echo $this->mwidgets->generateMainHomepageSection("best-mom", lang("globals_bestmom"), site_url_mobile("best_mom"), "http://cdn.pimg.co/p/690x290/ccc/fff/img.png", "الريجيم وطرقه المختل�?ة");
   // echo $this->mwidgets->generateMainHomepageSection("best-time", lang("globals_besttime"), site_url_mobile("best_time"), "http://cdn.pimg.co/p/690x290/ccc/fff/img.png", "الريجيم وطرقه المختل�?ة");
	    //$sectionName = $this->sectionsmodel->getSectionNameByID(10);
		

		
		
		/***FirstSectionBestMe***/
	$myIcon_left_best_me = base_url().'images/icons/best_me_icon_left.png';
	$myIcon_right_best_me = base_url().'images/icons/best_me_icon_right.png';
	$featArticle = $this->articlesmodel->articles_featured_homepage_mobile(10);
	$sectionhomepage_me = site_url_mobile(''.'best_me');
	
	$linkToArticle_best_me = site_url_mobile(''.'best_me'.'/inner_articles/'.$featArticle[0]['articles_ID']).'-'.$featArticle[0]['articles_title'.$current_language_db_prefix];
    echo $this->mwidgets->generateMainHomepageSectionArticles(10 ,"best-me",lang("globals_bestme"),$linkToArticle_best_me,$imageSrc,$dataArticles_best_me ,$articleTitle,$current_language_db_prefix , $myIcon_left_best_me ,$myIcon_right_best_me ,$sectionhomepage_me);
	/***SecondSectionBestCook***/
	$myIcon_left_best_cook = base_url().'images/icons/best_cook_icon_left.png';
	$myIcon_right_best_cook = base_url().'images/icons/best_cook_icon_right.png';
	$featArticle = $this->recipesmodel->recipe_featured_homepage_mobile(2);
	$sectionhomepage_cook = site_url_mobile(''.'best_cook');
	$linkToArticle_best_cook = site_url_mobile(''.'best_cook'.'/view_recipe/'.$featArticle[0]['recipes_ID']).'-'.$featArticle[0]['recipes_title'.$current_language_db_prefix];
		
	echo $this->mwidgets->generateMainHomepageSectionRecipes(2 ,"best-cook",lang("globals_bestcook"),$linkToArticle_best_cook,$imageSrc,$dataArticles_best_cook ,$articleTitle ,$current_language_db_prefix,$myIcon_left_best_cook,$myIcon_right_best_cook,$sectionhomepage_cook);
		/***ThirdSectionBestMom***/
		$myIcon_left_best_mom = base_url().'images/icons/best_mom_icon_left.png';
		$myIcon_right_best_mom = base_url().'images/icons/best_mom_icon_right.png';
	$featArticle = $this->articlesmodel->articles_featured_homepage_mobile(27);
	$sectionhomepage_mom = site_url_mobile(''.'best_mom');
	$linkToArticle_best_mom = site_url_mobile(''.'best_mom'.'/inner_articles/'.$featArticle[0]['articles_ID']).'-'.$featArticle[0]['articles_title'.$current_language_db_prefix];
	echo $this->mwidgets->generateMainHomepageSectionArticles(27 ,"best-mom",lang("globals_bestmom"),$linkToArticle_best_mom ,$imageSrc,$dataArticles_best_mom ,$articleTitle ,$current_language_db_prefix , $myIcon_left_best_mom,$myIcon_right_best_mom,$sectionhomepage_mom );
	/***FourthSectionBestMom***/
	$myIcon_left_best_time = base_url().'images/icons/best_time_icon_left.png';
	$myIcon_right_best_time = base_url().'images/icons/best_time_icon_right.png';
	$featArticle = $this->articlesmodel->articles_featured_homepage_mobile(28);
	$sectionhomepage_time = site_url_mobile(''.'best_time');
	$linkToArticle_best_time = site_url_mobile(''.'best_time'.'/inner_articles/'.$featArticle[0]['articles_ID']).'-'.$featArticle[0]['articles_title'.$current_language_db_prefix];
	echo $this->mwidgets->generateMainHomepageSectionArticles(28 ,"best-time",lang("globals_besttime"),$linkToArticle_best_time,$imageSrc,$dataArticles_best_time ,$articleTitle ,$current_language_db_prefix ,$myIcon_left_best_time ,$myIcon_right_best_time,$sectionhomepage_time);
	


		
?>


   
</section>

