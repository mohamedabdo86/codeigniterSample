<style>
.product_color { color:<?php echo $display[0]['products_brand_BGColor']; ?> !important;}
.product_background_color { background-color:<?php echo $display[0]['products_brand_BGColor']; ?> !important;}
.product_border_color { border-color:<?php echo $display[0]['products_brand_BGColor']; ?>}
.product_borderbottom_color { border-bottom-color:<?php echo $display[0]['products_brand_BGColor']; ?>}
.product_2nd_color{color:<?php echo $display[0]['products_brand_title_font_color']; ?> !important;}
#innerhome_slideshow { height:255px;}
#innerhome_slideshow .slide_show_title_sign { height:255px;}
#innerhome_slideshow .slide_show_wrapper { height: 255px; }
#main_brand_message
{
	border:solid 3px #FFF;
	border-top:none;
	margin:0 20px; background:#ebebeb;
	padding:5px 15px;
	color:rgb(105, 105, 105);	
	white-space: normal;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
}
</style>


<div id="innerhome_slideshow" class="<?php echo $current_section_background_color; ?> <?php echo $current_section_border_color; ?>">


<div class="slide_show_title_sign float_left">

<div class="inner_margin_wrapper" style="background:inherit;">
<div style="margin:40px 0px;">
<div align="center"><img style="max-width:150px;" src="<?php echo $main_logo_link; ?>"  /></div>
<!--<div align="center"><h2 class="white_color"><?php //echo  $display[0]['products_brand_name'.$current_language_db_prefix]; ?></h2></div>-->
</div>

</div><!-- End of inner_margin_wrapper -->


</div><!-- End of slide_show_title_sign -->

<div class="slide_show_wrapper float_right" style="overflow: visible; z-index: 1;">

 
<div class="camera_wrap camera_azure_skin" id="camera_wrap_1" style="display:block">
<?php 
//for($i=0 ; $i < sizeof($display_section_slideshow) ; $i++):
$image = base_url()."uploads/products_brand/".$display[0]['images_src'];
?>

<img style="width: 715px ; height: 255px;" src="<?php echo $image; ?>" />
<?php /*?><div data-thumb="<?php echo $image; ?>" data-src="<?php echo $image; ?>"></div>                <?php */?>
<?php
//endfor;
?>
 </div><!-- End of camera_wrap -->   

</div><!-- End of slide_show_wrapper -->
<div class="clear"></div>

</div><!-- End of innerhome_slideshow -->

<div id="main_brand_message" class="text_align_center" ><strong><?php echo $display[0]['products_brand_desc'.$current_language_db_prefix]; ?></strong></div>