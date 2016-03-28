<script type="text/javascript">
$(document).ready(function(e) {
    var $width = 545, //The width in pixels of your #tab-slider 
        $tabs = $('.tab'), //Your Navigation Class Name
        $delay = 600; // Pause time between animation in Milliseconds
   
    $('.tab-slider-wrapper').css({width: $tabs.length * $width});$('a.tab-link').click(function() {$tabs.removeClass('active');$(this).parent().addClass('active');var $contentNum = parseInt($(this).attr('rel'), 10);$('.tab-slider-wrapper').animate({marginLeft: '-' + ($width * $contentNum - $width)}, $delay);return false;});
	
	});
	
</script>
<script>
$(document).ready(function(e) {
	$(".nutriatoin_sp_button").click(function(e) {
        
		$("#nutration_button_trigger").trigger("click");
		
    });
	
});
</script>

<style>
#titles #list li a:hover{color:<?php echo $display[0]['products_brand_BGColor']; ?>;}
.category_tab #list li a:hover{color:<?php echo $display[0]['products_brand_BGColor']; ?>;}
#tab-slider {
    width:545px;
    height:420px;
    margin: 0 auto;
    position:relative;
    overflow:hidden;
}
.tab-content 
{
	height: 420px;
	width: 544px;
	overflow: hidden;
	float: left;
	margin-right: 1px;
}
ul.tab-nav li.active {
    background-color: #FCFAFA;
    border-bottom:none;
}
ul.tab-nav li.active a {
    color:<?php echo $display[0]['products_brand_BGColor']; ?>;
}
.bdslider li
{
	margin-right: 18px !important;
}

.mnslider li
{
	width:130px;
	float:left;
}

.bx-wrapper
{
	padding: 0 30px !important;
}
#flavours_wrapper
{
	margin-bottom:7px;
	width:100%;
	height:205px;
}
.flavours_wrapper_slider{
	width:160px; height:160px; margin-top: 0px; margin-left: 40px;
}
#back:hover{color:<?php echo $display[0]['products_brand_BGColor']; ?>;}

.view_flavour{border:none;}
</style>
<div id="flavours_wrapper">
  <div id="mini_slider_wapper">
  	<ul class="mnslider_wapper" style="width: 515%; position: relative; -webkit-transition: 0s; transition: 0s; -webkit-transform: translate3d(-918px, 0px, 0px);">
    <?php
	$current_count = sizeof($display_flavours);
	$jump_flavour = 0;
	//if($current_count > 5){
	//$jump_flavour = ceil(($current_count/5) + 1);
	//}
	
	//print_r($display_flavours);
	for($i=0 ; $i<sizeof($display_flavours);$i++):
	$flavour_id = $display_flavours[$i]['products_flavour_ID'];
	$flavour_brand_id = $display_flavours[$i]['products_flavour_products_ID'];
	$title = $display_flavours[$i]['products_flavour_title'.$current_language_db_prefix];
	$image_url = $this->config->item('products_img_link');
	$image = $image_url.$display_flavours[$i]['images_src']; 
    ?>
    	<li><a title="<?php echo $title; ?>" class="view_flavour" rel="<?php echo $flavour_id; ?>" href="#"><div class="flavours_wrapper_slider"><img alt="<?php echo $title; ?>" title="<?php echo $title; ?>" width="105" style="border:none;" height="117" src="<?php echo $image; ?>" /><p class="gram"><?php echo $title; ?></p></div></a></li>
        <?php
		endfor;
		?>
   </ul>
    </div>
    <div class="clear"></div>
  </div><!-- ENd of flavours_wrapper -->
  <script>
$(document).ready(function(e) {
$('.mnslider_wapper').bxSlider({
	 	mode: 'horizontal',
	   	slideWidth: 250,
		minSlides: 5,
		maxSlides: 5,
		moveSlides: 1,
		slideMargin: 0,
		nextText : '',
		prevText : '',
		pager: false,
		infiniteLoop:false ,
		controls: true,
		hideControlOnEnd: true,
		<?php if($current_language_db_prefix == "_ar"){ ?>
		<?php echo 'startSlide: '.$jump_flavour.','; ?>
		<?php }?>
	});
});
</script>