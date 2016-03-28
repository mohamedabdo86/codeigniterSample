<script>
function scale( width, height, padding, border ) {
    var scrWidth = $( window ).width() - 70,
        scrHeight = $( window ).height() - 70,
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
<!-- Jquery List Slider -->
<link href="<?php echo base_url(); ?>css/list_slider.css" rel="stylesheet" type="text/css">

<style>
.lists_of_videos { margin:0 26px; }
.lists_of_videos li { height:255px; padding:15px; background:white; margin:0; }
.image { position: relative; }
.image .play { position: absolute; width: 90px; height: 90px; top: 50%; left: 50%; margin-top: -45px; margin-left: -45px; }


.social_wrapper { padding:0; }
.fancybox-inner
{
	height: auto !important;
}
</style>

<div class="row <?php echo $current_section; ?>">
	<div class="col-xs-12">
          <?php   echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png" , site_url_mobile(''.$this->router->class));?>
          
          <?php 
		          echo $this->mwidgets->drawCurrentSubSectionHomepageTitle($display_data[0]['sub_sections_name'.$current_language_db_prefix], lang("globals_back"), "#");
				  ?>
<div id="related-recipe-header">
	<h1 class="<?php echo $current_section; ?>" ><?php echo $this->headers->get_third_title() ?></h1>
</div>
	<div class="thick_line"></div>
	</div>


<!--  *************************** videos-player ************************* -->

<div class="row">
            <?php
			//$url = base_url().$this->router->class."/".$this->router->method."/".$id;
			$table_name_for_rate = "videos";

			for($i=0;$i<sizeof($display_data);$i++):
			
			$id = $display_data[$i]['videos_ID'];
			$title = $display_data[$i]['videos_name'];
			$url =  $display_data[$i]['videos_url'];
			$thumb_image = $this->common->youtube($url);
			$short_title = $this->common->limit_text($title,50);
			
			
			//$views = 50;
			if($current_language_db_prefix == '_ar')
			{
				$views = $this->common->youtube_views($url);
				$views = $this->common->arabic_numbers($views);
			}
			else
			{

				$views = $this->common->youtube_views($url);
			}

			?>
            
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
            
            	<h2 class="small_image_slider_title dark_gray dir" style="padding:0 10px;"><?php echo $title;?></h2>
  				
                <?php
				 /*
				 
				 <iframe width="524" height="393" src="//www.youtube.com/embed/<?php echo $thumb_image; ?>" frameborder="0" allowfullscreen></iframe>
				 
				 ?><a href="<?php echo $url;?>" rel="prettyPhoto" title="<?php echo $title;?>">         
                <div class="image">
                <img class="play" src="<?php echo base_url(); ?>images/videos_play.png" />
                <img src="http://img.youtube.com/vi/<?php echo $thumb_image;?>/0.jpg" width="524" alt="<?php echo $title;?>" />
                </div>
                </a><?php */?>
                
                <?php /*?><p style="white-space: normal;"><?php echo $desc_long_text;?></p><?php */?>
                	
                    <a id="#popup_video_item_<?php echo $i; ?>" href="#popupVideo_<?php echo $i; ?>" class="fancybox-media" title="<?php echo $title; ?>">
                    
                     	<img class="img-responsive" src="https://img.youtube.com/vi/<?php echo $thumb_image;?>/0.jpg" alt="<?php echo $title;?>"  style="width:100%;"/>
                    
                    </a>	
                    
                    
                    <div id="popupVideo_<?php echo $i; ?>" style="display: none;">
                        <iframe style="width:800px; height:500px;" class="img-responsive" src="//www.youtube.com/embed/<?php echo $thumb_image; ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                    	                                        
                    
                    <p style="line-height: 29px;font-size: 15px;" class="dark_gray float_left" >( <?php echo $views;?> ) <?php echo lang('globals_views');?></p>
            </div>
            
            
            
            <?php
			endfor;
			?>

    </div>
    <div class="row">
    	<div class="col-xs-12" style="text-align:center" data-ajax="false">
        	<div style="position:relative">
        	<?php
			echo $pagination_links;
			?>
            </div>
        </div>
    </div>
    
    