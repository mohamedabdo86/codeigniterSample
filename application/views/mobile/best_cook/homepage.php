<?php
/************************************************************
***************************************************************
BEST Cook 
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
function closeWin() {
   document.getElementById('popupVedio_0').innerHTML ="";
} 
</script>
<style>


.swiper-wrapper
{
	height:auto !important
}

.swiper-container-single-item, .swiper-container-single-item .swiper-slide
{
	height:auto !important
}


.selectboxit-container .selectboxit{
	display:none;
  }

.best-cook-home-swiper-image
{
	height: 40% !important;
}
.fancybox-inner
{
	height: auto !important;
}
/* Smartphones (portrait and landscape) ----------- */
@media screen (max-width : 650px) {
/* Styles */
.width_IMG
    {
		width:100%;
		height:40%;
	}
	.JfraMe_video
	{
	    height:300px;
		width:100%;
	}
	
	.swiper-slide-visible
	{
		height: 900px
	}
	
	.best-cook-home-swiper-image
	{
		height: auto !important;
	}
}
@media only screen and (min-device-width : 800px) and (max-device-width : 1280px) {
/* Styles */
.width_IMG
    {
		width:100%;
		height:100%;
	}
	.JfraMe_video
	{
	    height:600px;
		width:600px;
	}
}
@media only screen and (min-device-width : 1281px) and (max-device-width : 1500px) {
/* Styles */
.width_IMG
    {
		width:100%;
		height:100%;
	}
	.JfraMe_video
	{
	    height:600px;
		width:600px;
	}
}
/* Smartphones (landscape) ----------- */
@media only screen and (min-width : 321px) {
/* Styles */
}

/* Smartphones (portrait) ----------- */
@media only screen and (max-width : 320px) {
/* Styles */
}

</style>
<div class="<?php echo $current_section; ?> row">
  <div class="col-xs-12">
    <?php
   		 echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png" , site_url_mobile(''.$this->router->class));
        ?>
  </div>
  <!-- container -->
  <div class="col-sm-12 col-xs-12">
    <div class="swiper-container-homepage">
      <div class="swiper-wrapper" style="float:left;">
        <?php
                    for ($i = 0; $i < sizeof($display_topics); $i+=2):
                        ?>
            <div class="swiper-slide " style="height:100% !important;">
              <div class="col-sm-12 col-xs-12 form-control-static">
            <?php
								//echo '<h1 > '. $display_topics[$i]['inseason_recipies_ID'].'</h1>';
								//Get Recipes
	$topic_url = site_url_mobile("best_cook/recipes_list/".$display_topics[$i]['inseason_recipies_ID']);
			list ( $display_recipes , $total_rows) = $this->recipesmodel->get_topics_list_of_recipes( $display_topics[$i]['inseason_recipies_ID'],1,0 );		
								$image = $this->config->item('recipes_img_link').$display_recipes[0]['images_src'];
								
                                echo $this->mwidgets->drawSubSectionBoxRecipesBestCook($display_topics[$i]['inseason_recipies_title'.$current_language_db_prefix], $image ,$topic_url);
                                ?>
          </div>
          <div class="col-sm-12 col-xs-12 form-control-static">
            <?php
								//Get Recipes
					$topic_url = site_url_mobile("best_cook/recipes_list/".$display_topics[$i+1]['inseason_recipies_ID']);
								list ( $display_recipes , $total_rows) = $this->recipesmodel->get_topics_list_of_recipes( $display_topics[($i+1)]['inseason_recipies_ID'],1,0 );		
								$image = $this->config->item('recipes_img_link').$display_recipes[0]['images_src'];
                                echo $this->mwidgets->drawSubSectionBoxRecipesBestCook($display_topics[($i+1)]['inseason_recipies_title'.$current_language_db_prefix], $image ,$topic_url);
                                ?>
          </div>
        </div>
        <?php
                    endfor;
                    ?>
        <div style="clear:both;"></div>
      </div>
      <!-- swiper-wrapper --> 
    </div>
    <!-- swiper-container --> 
  </div>
  <div class="col-xs-12">
    <div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div>
    <?php
    	$this->load->view('mobile/best_cook/advanced-search-block'); 
    ?>
  </div>
  <div class="col-xs-12">
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
      <?php
	  function youtube_v_extractor($url)
{
  parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
  return $my_array_of_vars['v'];
}
  
  
  ?>
  <?php 
  

		 	for($i=0;$i<sizeof($display_featured_video);$i++):
	
	$title = $display_featured_video[0]['videos_name'];
	$youtube_url = $display_featured_video[0]['videos_url'];
	$short_title = $this->common->limit_text($title,37);
	$v = parse_str( parse_url( $youtube_url, PHP_URL_QUERY ), $my_array_of_vars );
	$current_v = $my_array_of_vars['v'];

?>
		 
		  <div class="section-title-wrapper">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="text-color"><a href="https://img.youtube.com/vi/<?php echo $current_v; ?>" >
        <?php echo lang('bestcook_videos');  ?>
        </a></h2>
      </div>
      </div>
    </div>
<div class="swiper-slideg" style="width:100% !important">
  <div class="image"> <a href="#popupBasic" class="fancybox-media" title="<?php echo $title; ?>" ?> <img class="youtube" style="width:100%" src="http://img.youtube.com/vi/<?php echo $current_v;?>/mqdefault.jpg" /> </a> </div>
  <?php /*?>   <a title="<?php echo $title; ?>" href="https://www.youtube.com/embed/<?php echo $current_v; ?>">
    	<img style="border:none; width:12%" class="video_paly1" src="<?php echo base_url()."images/video_player.png" ?>" />
	</a><?php */?>
 
  <div  id="popupBasic" style="display: none;">
    <iframe id="myVideo" width="100%" height="100%" style="width:800px; height:500px;" class="img-responsive"  src="https://www.youtube.com/embed/<?php echo $current_v; ?>"  frameborder="0" allowfullscreen></iframe>
  </div>
  <div class="" style="-webkit-border-bottom-right-radius: 15px;-webkit-border-bottom-left-radius: 15px;-moz-border-radius-bottomright: 15px;-moz-border-radius-bottomleft: 15px;border-bottom-right-radius: 15px;border-bottom-left-radius: 15px;bottom: -3px;">
    <h5 class="float_left dir" style="margin-top: -20px;z-index: 1;position: relative;width: 100%;font-size: 2vw;color: white;"><b><a href="https://www.youtube.com/embed/<?php echo $current_v; ?>"><?php //echo $short_title; ?></a></b></h5>
  </div>
</div>
<?php  
endfor;

  
  ?>
  
  

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
<?php /*?>  
    <?php
	  function youtube_v_extractor($url)
{
  parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
  return $my_array_of_vars['v'];
}

	for($i=0;$i<sizeof($display_featured_video);$i++):
	
	$title = $display_featured_video[0]['videos_name'];
	$youtube_url = $display_featured_video[0]['videos_url'];
	$short_title = $this->common->limit_text($title,37);
	$v = parse_str( parse_url( $youtube_url, PHP_URL_QUERY ), $my_array_of_vars );
	$current_v = $my_array_of_vars['v'];

?>
    <div class="section-title-wrapper">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="text-color"><a href="https://img.youtube.com/vi/<?php echo youtube_v_extractor($youtube_url); ?>" >
        <?php echo lang('bestcook_videos');  ?>
        </a></h2>
      </div>
      </div>
    </div>
    <div class="section-image-wrapper"> 
    <a style="width:100%; height:80%; margin:10px 0;" href="#popupVedio_<?php echo $i; ?>" data-rel="popup" class="ui-btn ui-corner-all ui-shadow ui-btn-inline" data-transition="pop"> <img src="https://img.youtube.com/vi/<?php echo youtube_v_extractor($youtube_url); ?>/0.jpg" class="img-responsive border-color width_IMG" alt="<?php echo $title; ?>" title="<?php echo $title; ?>"/> </a>
      <div data-role="popup" style="width:100%;" id="popupVedio_<?php echo $i; ?>" data-overlay-theme="a" data-theme="a" data-corners="false" data-tolerance="15,15"> <a href="#" data-rel="back"-player class="ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right close-vedio">Close</a>
        <iframe src="https://www.youtube.com/embed/<?php echo youtube_v_extractor($youtube_url); ?>" class="JfraMe_video"></iframe>
      </div>
    </div>
    <?php endfor;?>
    <?php */?>
    
    
    
    
    
    
    
    
  </div>

  <div class="col-xs-12"> 
    <!--<div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div>-->
    <?php
        //echo $this->mwidgets->drawSubSectionHomepageVideoBestCook("وصفاتنا خطوة بخطوة", "http://placehold.it/800x400&text=Image", "طريقة عمل بيكاتا بالمشروم والخضروات");		
		?>
  </div>
  <!-- container -->
  
  <div class="col-xs-12">
    <div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div>
    <?php
		list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(19,$current_language_db_prefix);
		$featArticle = $this->articlesmodel->get_feautred_articles($subsectionID);
		$linkToSection = site_url_mobile(''.$this->router->class.'/section/'.$subsectionID);
		$linkToArticle = site_url_mobile(''.$this->router->class.'/inner_articles/'.$featArticle[0]['articles_ID']);		
        echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle, $this->config->item("articles_img_link").$featArticle[0]['images_src'], $featArticle[0]['articles_title'.$current_language_db_prefix],$linkToSection,$linkToArticle,6,6);
		
		list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(20,$current_language_db_prefix);
		$featArticle = $this->articlesmodel->get_feautred_articles($subsectionID);
		$linkToSection = site_url_mobile(''.$this->router->class.'/section/'.$subsectionID);
		$linkToArticle = site_url_mobile(''.$this->router->class.'/inner_articles/'.$featArticle[0]['articles_ID']);		
        echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle, $this->config->item("articles_img_link").$featArticle[0]['images_src'], $featArticle[0]['articles_title'.$current_language_db_prefix],$linkToSection,$linkToArticle,6,6);
		?>
  </div>
  <!-- container -->
  
  <div class="col-sm-12 col-xs-12 meme">
    <div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div>
    <div class="swiper-container-single-item" style="height:auto !important">
      <div class="swiper-wrapper" style="height:auto !important">
        <?php
						for ($i = 0; $i < sizeof($display_recent_articles); $i++): ?>
        <div class="swiper-slide" style="height:auto !important;">
          <div class="col-sm-12 col-xs-12 form-control-static">
            <?php
                                	echo $this->mwidgets->drawSingleItemImageAndText(
									$display_recent_articles[$i]['articles_title'.$current_language_db_prefix]
									,$display_recent_articles[$i]['articles_brief'.$current_language_db_prefix]
				                    , $this->config->item('articles_img_link').$display_recent_articles[$i]['images_src']
									,site_url_mobile(''.$this->router->class.'/inner_articles/'.$display_recent_articles[$i]['articles_ID'])
									);
                                ?>
          </div>
        </div>
        <?php
                        endfor;
						?>
        <div style="clear:both;"></div>
      </div>
      <!-- swiper-wrapper --> 
    </div>
    <!-- swiper-container --> 
  </div>
  <div class="col-sm-12 col-xs-12">
    <div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div>
    <?php echo $common_row; ?> </div>
  <div class="col-sm-12 col-xs-12">
    <div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div>
     <?php echo $this->mwidgets->generateproductwidget();?>
    <!-- swiper-container --> 
  </div>
</div>
