<?php
/************************************************************
***************************************************************
BEST ME 
****************************************************************
******************************************************************
*****************************************************************/
?>
<section class="<?php echo $current_section; ?>">
    <!--<div class="thick-line background-color">&nbsp;</div>-->
    <div class="row">
    <!--<div class="container">-->
        <?php
        echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png" , site_url_mobile(''.$this->router->class));

        //Draw the Articles Section
		list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(15,$current_language_db_prefix);
		$featArticle = $this->articlesmodel->get_feautred_articles(33);
		$linkToSection = site_url_mobile(''.$this->router->class.'/section/'.$subsectionID);
		$linkToArticle = site_url_mobile(''.$this->router->class.'/inner_articles/'.$featArticle[0]['articles_ID']);
        echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle, $this->config->item("articles_img_link").$featArticle[0]['images_src'], $featArticle[0]['articles_title'.$current_language_db_prefix],$linkToSection,$linkToArticle,6,6);
		
		list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(14,$current_language_db_prefix);		
		$featArticle = $this->articlesmodel->get_feautred_articles($subsectionID);
		$linkToSection = site_url_mobile(''.$this->router->class.'/section/'.$subsectionID);
		$linkToArticle = site_url_mobile(''.$this->router->class.'/inner_articles/'.$featArticle[0]['articles_ID']);
        echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle, $this->config->item("articles_img_link").$featArticle[0]['images_src'], $featArticle[0]['articles_title'.$current_language_db_prefix],$linkToSection,$linkToArticle,6,6);
		
		list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(13,$current_language_db_prefix);		
		$featArticle = $this->articlesmodel->get_feautred_articles($subsectionID);
		$linkToSection = site_url_mobile(''.$this->router->class.'/section/'.$subsectionID);
		$linkToArticle = site_url_mobile(''.$this->router->class.'/inner_articles/'.$featArticle[0]['articles_ID']);
        echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle, $this->config->item("articles_img_link").$featArticle[0]['images_src'], $featArticle[0]['articles_title'.$current_language_db_prefix],$linkToSection,$linkToArticle,6,6);
		
		list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(16,$current_language_db_prefix);		
		$featArticle = $this->articlesmodel->get_feautred_articles(44);
		$linkToSection = site_url_mobile(''.$this->router->class.'/section/'.$subsectionID);
		$linkToArticle = site_url_mobile(''.$this->router->class.'/inner_articles/'.$featArticle[0]['articles_ID']);
        echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle, $this->config->item("articles_img_link").$featArticle[0]['images_src'], $featArticle[0]['articles_title'.$current_language_db_prefix],$linkToSection,$linkToArticle,6,6);
        ?>
    <!--</div><!-- container -->
    </div>

    <div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div>
     <?php echo $common_row; ?>
    <div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div>
  <div class="col-sm-12 col-xs-12">
    
     <?php echo $this->mwidgets->generateproductwidget();?>
    <!-- swiper-container --> 
  </div>
</section>