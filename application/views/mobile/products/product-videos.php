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
<style>
.fancybox-inner
{
	height: auto !important;
}
</style>
<?php 

function youtube_v_extractor($url){

//$vid = explode("v=", $url);
//$rtv = explode(" ", $vid[1]);
parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
return $my_array_of_vars['v'];
}
?>
<?php 
if(sizeof($display_videos)==1){
	if($current_language_db_prefix == '_ar'){
		$logo_container_push_pull = 'col-md-pull-3';
		}else{
			$logo_container_push_pull = 'col-md-push-3';
			}
	
	}
?>

  <div class="row">
  
    <div class="advertisement">
      <h3 style="margin: 12px;"> <?php echo lang('product_recent_advirts_videos'); ?></h3>
      <div class="col-sm-12 col-xs-12 <?php echo $logo_container_push_pull;?>">
        <div class="swiper-container-images">
      <div class="swiper-wrapper float">
          <?php
                    for($i =0; $i<sizeof($display_videos);$i++):
	                    $title = $display_videos[$i]['videos_name'];
	                    $youtube_url = $display_videos[$i]['videos_url'];
	                    $thumbail_image = "";
                        ?>
          <div class="swiper-slide">
          
          <div class="inner-slider-container"> 
          
          
      <div class="image"> <a href="#popupVedio_<?php echo $i; ?>" class="fancybox-media" title="<?php echo $title; ?>"> <img class="youtube" style="width:100%" src="https://img.youtube.com/vi/<?php echo youtube_v_extractor($display_videos[$i]['videos_url']); ?>/0.jpg" /> </a> </div>

 
  <div id="popupVedio_<?php echo $i; ?>" style="display: none;">
    <iframe width="100%" height="100%" style="width:800px; height:500px;" class="img-responsive"  src="https://www.youtube.com/embed/<?php echo youtube_v_extractor($display_videos[$i]['videos_url']); ?>"  frameborder="0" allowfullscreen></iframe>
  </div>
     <h4 class="text-color"><?php echo $title; ?></h4>  
 
            </div>
          </div>
          <?php
                    endfor;
                    ?>
        </div>
         </div>
        <!-- swiper-wrapper --> 
      </div>
    </div>
  </div>



