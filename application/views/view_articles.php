<script>
	jQuery(function(){
		
		jQuery(".recent_items_list_bk").jCarouselLite({
			btnNext: ".recentitem_next",
			btnPrev: ".recentitem_prev",
			visible:4
		});

	});
</script>

<script type="text/javascript">
$(document).ready(function(e) {
	var section = "<?php echo $this->router->class; ?>";

	
	if(section == "best_cook")
	{
		var left_button = '../../../../images/bestcook/left_arrow_medium.png';
		var right_button = '../../../../images/bestcook/right_arrow_medium.png';
	}
	else if(section == "best_mom")
	{
		var left_button = '../../../../images/bestmom/left_arrow_medium.png';
		var right_button = '../../../../images/bestmom/right_arrow_medium.png';
	}
	else if(section == "best_me")
	{
		var left_button = '../../../../images/bestme/left_arrow_medium.png';
		var right_button = '../../../../images/bestme/right_arrow_medium.png';
	}
	else if(section == "best_time")
	{
		var left_button = '../../../../images/besttime/left_arrow_medium.png';
		var right_button = '../../../../images/besttime/right_arrow_medium.png';
	}
	
	
    $('#one').ContentSlider({
		width : '980px',
		height : '360px',
		speed : 800,
		easing : 'easeInOutBack',
		leftBtn : left_button,
        rightBtn : right_button,
	});
	
});
</script>
<style>
.container_slideshow_1_items
{
	/*height:380px;*/
	width:auto;
	
}
.cs_leftBtn:nth-of-type(1)
{
	z-index: 9999999;
}
body.english .read_more_articles
{
	position: absolute;
	bottom: 5px;
	right: 5px;
}
body.arabic .read_more_articles
{
	position: absolute;
	bottom: 0;
	left: 5px;
}
</style>

<div class="clear"></div>

<?php echo $this->load->view('template/submenu_writer');   ?>

<?php echo $this->load->view('template/tree_menu_writer');   ?>
 
<div class="clear"></div>


<div class="inner_title_wrapper">

<div class="sections_wrapper_margin">
	<h1 class="<?php echo $current_section_color; ?> float_left" style="font-size:24px;"><?php echo $this->headers->get_third_title() ?></h1>
    <div class="clear"></div>
</div>

</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>" style="margin:0;"></div>

<div class="container_slideshow_1_items global_background">
<?php
if(empty($display_feat))
{
	echo '<div class="white_background_color"><p align="center">'.lang('mycorner_no_article_found').'</p></div>';
}
else
{
?>
<style>
.jRatingColor 
{
	position: absolute;
}
.jRatingAverage
{
	position: absolute;
}
.jStar
{
	position: absolute;
	top:0 !important;
}
</style>
<div id="one" class="contentslider">
    <div class="cs_wrapper">
        <div class="cs_slider">
			
			<?php
			
			$image_url = base_url()."uploads/articles/";
			
            for($i=0;$i<sizeof($display_feat);$i++):
			$id = $display_feat[$i]['articles_ID'];
			$image  = $image_url.$display_feat[$i]['images_src'];
			
			$share_image = base_url()."images/share_image.png";
			
			$title = $display_feat[$i]['articles_title'.$current_language_db_prefix];
			$url = site_url($this->router->class."/inner_articles/".generateSeotitle($id,$title));
			$desc = $display_feat[$i]['articles_brief'.$current_language_db_prefix];
			
			$views = $display_feat[$i]['articles_views'];
			$table_name_for_rate = "articles";
			?>

            <div class="cs_article">
            <center>
				<div class="inner_featured_contanier" style="width:866px; height:300px;">
                <div class="float_left" style="width: 390px;height: 300px;">
                <a href="<?php echo $url; ?>" title="<?php  echo $title?>">
                    <img src="<?php echo $image?>" alt="<?php echo $title; ?>" />
                </a>
                
                <div class="rating_wrapper_container" style="margin-top: -7px;">

                       <div class="rating float_right" style="width: 90px; margin:5px 0;">
                       
                        <?php
                            $params = array('table'=>$table_name_for_rate,'foreign_id'=>$id);
                            echo $this->rate->get_recipe_rate($params); 
                        ?>
                        </div><!--End Of Rating-->
                        <span style="line-height: 29px;font-size: 12px;" class="dark_gray float_left" ><?php echo lang('globals_views') ." ( ".$views." ) ";?></span>
                        <!--End Of Views-->
                        <div class="clear"></div>
                    </div>
				<div class="clear"></div>
                </div>
                <div class="float_right text_align_left" style="width: 455px;height: 292px;">
                <h2 class="dir"> <a href="<?php  echo $url;?>"><?php echo $title;?></a> </h2>
                <p><?php echo $desc?></p>
                <a href="<?php echo $url;?>" class="readmore <?php echo $current_section_color ?> float_right"><?php echo lang('globals_more');?></a>
	        
         </div>
                <div class="clear"></div>

                </div><!-- End .inner_featured_contanier -->
                </center>
            </div><!-- End cs_article -->

          <?php endfor; ?>

        </div><!-- End cs_slider -->
    </div><!-- End cs_wrapper -->
</div><!-- End contentslider -->
<?php
}//End of if empty
?>

</div><!--End of .container_slideshow_1_items-->


<div class="inner_title_wrapper" style="">

</div><!-- End of inner_title_wrapper -->
<div class="thick_line <?php echo $current_section_background_color  ?>"></div>

<?php
//Start of Articles here */
if($current_section_have_children_flag == false):
?>

<div class="container_pagination_wrapper_4_items">

<ul class="lists_of_image_desc_article content">

<?php
if(empty($display_data))
echo '<p class="white_background_color" align="center" style="padding: 15px;">'.lang('globals_No_articles_in_this_section').'</p>';

for($i=1 ; $i < sizeof($display_data) ; $i ++):
$id = $display_data[$i]['articles_ID'];
$title = $display_data[$i]['articles_title'.$current_language_db_prefix];
			
$image  = $image_url.$this->config->item('image_prefix').$display_data[$i]['images_src'];

$url = site_url($this->router->class."/inner_articles/".generateSeotitle($id,$title));

$desc = $display_data[$i]['articles_brief'.$current_language_db_prefix];
	
$brief = $this->common->limit_text($desc,280);		

?>

<li  class="float_left global_background " style="position: relative;" >
    <a href="<?php echo $url ?>" title="<?php echo $title?>">
    <div class="image float_left"><img alt="<?php echo $title; ?>" src="<?php echo $image; ?>" width="175" height="150" style="width:175px" /></div>
    </a>
    <div class="social_wrapper_container float_right">
        <a href="<?php echo $url ?>">
        	<h3 class="dark_gray" style="white-space:normal;padding: 3px 0;"><?php echo $title; ?></h3>
        </a>
        <p style="white-space:normal;"><?php echo $brief;?></p>
        <a href="<?php echo $url;?>" class="readmore read_more_articles <?php echo $current_section_color  ?> float_right"><?php echo lang('globals_more');?></a>
      
        <div class="clear"></div>
    </div><!--End Of .social_wrapper_contanier-->
    
    
    <div class="clear"></div>

</li>

<?php
endfor;
?>

</ul>

<div class="clear"></div>

<div class="page_navigation">
<?php
echo $pagination_links;
?>
</div>

</div><!-- End of container_pagination_wrapper -->

<?php 
//End of View Articles
endif;
?>
<div style="width:100%;" class="global_sperator_height"></div>

<div class="various_title_videos <?php echo $current_section_background_color ?>" style="height:40px; position:relative;width: 105%;margin-left: -25px;">
	<div class="sections_wrapper_margin">
		<div class="title float_left" style="color: white;font-size: 24px;"><?php echo lang('globals_most_read'); ?></div>
    </div>
    <img width="26" style="position:absolute; left:0; top:40px;" src="<?php echo base_url(); ?>images/<?php echo $this->router->class; ?>_left_shadow.png"/>
    <img width="26" style="position:absolute; right:0; top:40px;" src="<?php echo base_url(); ?>images/<?php echo $this->router->class; ?>_right_shadow.png"/>
</div>

<?php
    if( empty ($display_most_read_data) )
    {
		?>
        <div class="recent_items_list_wrapper global_background dir" style="height:50px;">
        	<div class="sections_wrapper_margin" style="padding-top: 10px;" >
            <p align="center"><?php echo lang('globals_No_articles_in_this_section'); ?></p>
            </div>
        </div>
        <?php
	}
    else
    {
    ?>

<div class="recent_items_list_wrapper global_background" style="height:270px;">

    <div class="sections_wrapper_margin" style="padding-top: 10px;" >
    
        <a class="recentitem_prev float_right" style="cursor:pointer; visibility:hidden"><img src="<?php echo base_url()?>images/icons/right_arrow.png" /></a>
        <a class="recentitem_next float_left" style="cursor:pointer;visibility:hidden"><img src="<?php echo base_url()?>images/icons/left_arrow.png" /></a>
        <div class="recent_items_list">
        <ul>
			<?php
            for($i=0 ; $i < sizeof( $display_most_read_data); $i++):
            
            $id = $display_most_read_data[$i]['articles_ID'];
            $title = $display_most_read_data[$i]['articles_title'.$current_language_db_prefix];
                        
            $image =  $display_most_read_data[$i]['images_src'] == "0" ?  base_url()."images/image_not_available".$current_language_db_prefix.".png"  : $this->config->item('articles_img_link').$this->config->item('image_prefix').$display_most_read_data[$i]['images_src'];
            
			$url = site_url($this->router->class."/inner_articles/".generateSeotitle($id,$title));
            
            ?>
        	<li style="height:270px;" class="float_left">
            <div class="image global_sperator_margin_bottom"><a href="<?php echo $url ?>" title="<?php echo $title ?>"><img src="<?php echo $image;?>" alt="<?php  echo $title ?>"  ></a></div>
            <div class="title float_left dark_gray" style="height:auto;"><div style="margin:0px 5px;" class="dir"><a href="<?php echo $url ?>"><?php echo $title;?></a></div></div>
            
            <div class="clear"></div>
			</li>
        <?php
		endfor;
		?>
        </ul>

    
    </div><!--- End of recent_items_list -->
<?php
	}//End of if empty
?>

</div><!-- End of sections_wrapper_margin -->

</div><!-- End of recent_items_list_wrapper -->

<div class="clear"></div>