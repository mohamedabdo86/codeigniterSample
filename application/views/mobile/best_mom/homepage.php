<?php
/************************************************************
***************************************************************
BEST MOM!!!
****************************************************************
******************************************************************
*****************************************************************/
?>
<script>
function scale( width, height, padding, border ) {
    var scrWidth = $( window ).width() - 30,
        scrHeight = $( window ).height() - 30,
        ifrPadding = 2 * padding,
        ifrBorder = 2 * border,
        ifrWidth = width + ifrPadding + ifrBorder,
        ifrHeight = height + ifrPadding + ifrBorder,
        h, w;

    if ( ifrWidth < scrWidth && ifrHeight < scrHeight ) {
        w = ifrWidth;
        h = ifrHeight;
    } else if ( ( ifrWidth / scrWidth ) > ( ifrHeight / scrHeight ) ) {
        w = scrWidth;
        h = ( scrWidth / ifrWidth ) * ifrHeight;
    } else {
        h = scrHeight;
        w = ( scrHeight / ifrHeight ) * ifrWidth;
    }

    return {
        'width': w - ( ifrPadding + ifrBorder ),
        'height': h - ( ifrPadding + ifrBorder )
    };
};	
	
$( document ).on( "pagecreate", function() {
    // The window width and height are decreased by 30 to take the tolerance of 15 pixels at each side into account
    function scale( width, height, padding, border ) {
        var scrWidth = $( window ).width() - 30,
            scrHeight = $( window ).height() - 30,
            ifrPadding = 2 * padding,
            ifrBorder = 2 * border,
            ifrWidth = width + ifrPadding + ifrBorder,
            ifrHeight = height + ifrPadding + ifrBorder,
            h, w;
        if ( ifrWidth < scrWidth && ifrHeight < scrHeight ) {
            w = ifrWidth;
            h = ifrHeight;
        } else if ( ( ifrWidth / scrWidth ) > ( ifrHeight / scrHeight ) ) {
            w = scrWidth;
            h = ( scrWidth / ifrWidth ) * ifrHeight;
        } else {
            h = scrHeight;
            w = ( scrHeight / ifrHeight ) * ifrWidth;
        }
        return {
            'width': w - ( ifrPadding + ifrBorder ),
            'height': h - ( ifrPadding + ifrBorder )
        };
    };
	

});
</script>
<section class="<?php echo $current_section; ?>">
    <div class="thick-line background-color">&nbsp;</div>
    <!--<div class="container">-->
        <?php
        echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png" , site_url_mobile(''.$this->router->class));

        //Draw the Articles Section
        //Draw the Articles Section
		list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(62,$current_language_db_prefix);
		$featArticle = $this->articlesmodel->get_feautred_articles(66);
		$linkToSection = site_url_mobile(''.$this->router->class.'/section/'.$subsectionID);
		$linkToArticle = site_url_mobile(''.$this->router->class.'/inner_articles/'.$featArticle[0]['articles_ID']);
        echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle, $this->config->item("articles_img_link").$featArticle[0]['images_src'], $featArticle[0]['articles_title'.$current_language_db_prefix],$linkToSection,$linkToArticle,4,4);
		
        list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(63,$current_language_db_prefix);
		$featArticle = $this->articlesmodel->get_feautred_articles(76);
		$linkToSection = site_url_mobile(''.$this->router->class.'/section/'.$subsectionID);
		$linkToArticle = site_url_mobile(''.$this->router->class.'/inner_articles/'.$featArticle[0]['articles_ID']);
        echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle, $this->config->item("articles_img_link").$featArticle[0]['images_src'], $featArticle[0]['articles_title'.$current_language_db_prefix],$linkToSection,$linkToArticle,4,4);
		
        list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(64,$current_language_db_prefix);
		$featArticle = $this->articlesmodel->get_feautred_articles(87);
		$linkToSection = site_url_mobile(''.$this->router->class.'/section/'.$subsectionID);
		$linkToArticle = site_url_mobile(''.$this->router->class.'/inner_articles/'.$featArticle[0]['articles_ID']);
        echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle, $this->config->item("articles_img_link").$featArticle[0]['images_src'], $featArticle[0]['articles_title'.$current_language_db_prefix],$linkToSection,$linkToArticle,4,4);
		
        ?>
   <!-- </div>--><!-- container -->

    <div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div>
    <?php echo $common_row; ?>
	<div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div>
     <div class="col-sm-12 col-xs-12">
    
     <?php echo $this->mwidgets->generateproductwidget();?>
    <!-- swiper-container --> 
  </div>
    



</section>