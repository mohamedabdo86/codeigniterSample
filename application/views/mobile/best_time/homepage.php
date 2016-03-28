<?php
/************************************************************
***************************************************************
BEST TIME!!!
****************************************************************
******************************************************************
*****************************************************************/
?>
<section class="<?php echo $current_section; ?>">
    <div class="thick-line background-color">&nbsp;</div>
    <!--<div class="container">-->
        <?php
        echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png" , site_url_mobile(''.$this->router->class));
        //Draw the Articles Section
		list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(47,$current_language_db_prefix);
		$featArticle = $this->articlesmodel->get_feautred_articles($subsectionID);
		$linkToSection = site_url_mobile(''.$this->router->class.'/section/'.$subsectionID);
		$linkToArticle = site_url_mobile(''.$this->router->class.'/inner_articles/'.$featArticle[0]['articles_ID']);
       
	    echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle, $this->config->item("articles_img_link").$featArticle[0]['images_src'], $featArticle[0]['articles_title'.$current_language_db_prefix],$linkToSection,$linkToArticle,3,6);
		echo '<div style="margin-bottom:10px;"></div>';
		list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(183,$current_language_db_prefix);//Easy Tips
		list ( $featArticle , $totalNumbers) = $this->quizesmodel->get_all_easy_tips(1,0);
		$linkToSection = site_url_mobile(''.$this->router->class.'/easy_tips');
		$linkToArticle = site_url_mobile(''.$this->router->class.'/easy_tips/'.$featArticle[0]['easy_ideas_ID']);
        echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle, $this->config->item("easy_img_link").$featArticle[0]['images_src'], $featArticle[0]['easy_ideas_title'.$current_language_db_prefix],$linkToSection,$linkToArticle,3,6);
		echo '<div style="margin-bottom:10px;"></div>';
		list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(49,$current_language_db_prefix);
		$featArticle = $this->articlesmodel->get_feautred_articles($subsectionID);
		$linkToSection = site_url_mobile(''.$this->router->class.'/section/'.$subsectionID);
		$linkToArticle = site_url_mobile(''.$this->router->class.'/inner_articles/'.$featArticle[0]['articles_ID']);
        echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle, $this->config->item("articles_img_link").$featArticle[0]['images_src'], $featArticle[0]['articles_title'.$current_language_db_prefix],$linkToSection,$linkToArticle,3,6);
		echo '<div style="margin-bottom:10px;"></div>';
        list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(184,$current_language_db_prefix);//Fashion
		list ( $featArticle , $totalNumbers) = $this->quizesmodel->get_all_fashion(1,0);
		$linkToSection = site_url_mobile(''.$this->router->class.'/fashion');
		$linkToArticle = site_url_mobile(''.$this->router->class.'/fashion/'.$featArticle[0]['fashion_ID']);
        echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle, $this->config->item("fashion_img_link").$featArticle[0]['images_src'], $featArticle[0]['fashion_title'.$current_language_db_prefix],$linkToSection,$linkToArticle,3,6);
        ?>
    <!--</div>--><!-- container -->
    <div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div>
    <?php echo $common_row; ?>
    <div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div>
   <div class="col-sm-12 col-xs-12">
    
     <?php echo $this->mwidgets->generateproductwidget();?>
    <!-- swiper-container --> 
  </div>
</section>