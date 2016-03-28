<style>
.center{margin-left:20px;}
.rightword{color:#E82327;font-size:15pt;}
.leftword{color:#828282;font-size:10pt;}
.imgs{list-style:none;margin-right:20px;}
.imgs li{margin: 10px 0px;}
.margin_top{margin-top: 10px;}
</style>
<div class="clear"></div>
<section class="<?php echo $current_section; ?>">

<?php
	echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png");
?>

<div class="row" >
    <ul class="imgs col-xs-12 col-sm-12 col-md-12">	
    <?php
        for($i=0;$i<sizeof($display_data);$i++){ 
        $id = $display_data[$i]['applications_ID'];
        $title = $display_data[$i]['applications_title'.$current_language_db_prefix];
        $image = base_url()."uploads/applications/".$display_data[$i]['images_src'];
        
        $url = site_url_mobile($this->router->class."/".$this->router->method."/".$id);
     ?>
        <li>
            <a rel="external" href="<?php echo $url ?>" title="<?php  echo $title;?>">
            	<img class="float_left image-responsive col-xs-12 col-sm-6 col-md-4 margin_top" src="<?php echo $image; ?>" border="0" alt="<?php  echo $title;?>" />
            </a>             
        </li>
	<?php } ?>
    
    </ul>
    <div class="clear"></div>
</div><!-- End of global_background -->
</section>

