<link href="<?php echo base_url(); ?>css/bestmom_homepage.css" rel="stylesheet">

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.9.0.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-tabs-rotate.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#featured").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	$("#featured_list").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	
});
</script>
<script type="text/javascript">
$(document).ready(function(e) {
    //$("#feature").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
});
</script>
<script>

		jQuery(function(){
			
			jQuery('#camera_wrap_1').camera({
				thumbnails: false,pagination:false,
				height: '225px',playPause : false
			});
			
			jQuery(".recent_items_list").jCarouselLite({
				btnNext: ".recentitem_prev",
				btnPrev: ".recentitem_next",
				visible:3
			});
			
			jQuery(".best_cook_inner_applications_list").jCarouselLite({
				btnNext: ".best_cook_inner_applications_list_prev",
				btnPrev: ".best_cook_inner_applications_list_next",
				visible:3
			});
			
			/*jQuery('#slides').slides({
				preload: true,
				generateNextPrev: false
			});*/
			 jQuery('#slides').slides();
			 
		
		});
</script>
<style>
.featured
{ 
	width: 400px;
	padding-right: 250px;
	position: relative;
	height: 280px;
	overflow: hidden;
}
.featured ul.ui-tabs-nav
{ 
	position: absolute;
	top: 0;
	left: 398px;
	list-style: none;
	padding: 0;
	margin: 0;
	width: 237px;
	height: 280px;
	overflow: auto;
	overflow-x: hidden;
	z-index:9999;
}
.featured ul.ui-tabs-nav li
{ 
	padding:1px 0; 
	padding-left:14px;  
	font-size:12px; 
	color:#666; 
}
.featured ul.ui-tabs-nav li img
{ 
	float:left; margin:2px 5px; 
	padding:2px; 

}
.featured ul.ui-tabs-nav li span
{ 
	font-size:11px;  
	line-height:18px; 
}
.featured li.ui-tabs-nav-item a{ 
	display:block; 
	height:60px; 
	text-decoration:none;
	color:#333;  
	line-height:20px; 
	outline:none;
	border-bottom: 1px dashed #fff;
}
.featured li.ui-tabs-nav-item a:hover
{ 
	/*background:#f2f2f2; */
}
.featured li.ui-tabs-selected, .featured li.ui-tabs-active
{ 
	background:url('<?php echo base_url(); ?>images/selected-item.png') top left no-repeat;

}
.featured .ui-tabs-panel .info{ 
	position:absolute; 
	bottom:0; left:0; 
	height:70px; 
	background: url('<?php echo base_url(); ?>images/transparent-bg.png');
	width:412px; 
}
.featured ul.ui-tabs-nav li.ui-tabs-selected a, .featured ul.ui-tabs-nav li.ui-tabs-active a
{ 
	/*background:#ccc; */
}
.featured .ui-tabs-panel{ 
	width:412px; height:280px; 
	background:#fff; position:relative;
}

.featured .ui-tabs-panel .info a.hideshow{
	position:absolute; font-size:11px; font-family:Verdana; color:#f0f0f0; right:10px; top:-20px; line-height:20px; margin:0; outline:none; background:#333;
}
.featured .info h2{ 
	font-size:1.2em; font-family:Georgia, serif; 
	color:#fff; padding:5px; margin:0; font-weight:normal;
	overflow:hidden; 
}
.featured .info p{ 
	margin:0 5px; 
	font-family:Verdana; font-size:11px; 
	line-height:15px; color:#f0f0f0;
}
.featured .info a{ 
	text-decoration:none; 
	color:#fff; 
}
.featured .info a:hover{ 
	text-decoration:underline; 
}
.featured .ui-tabs-hide{ 
	display:none; 
}
.section_title_left
{
	position: relative;
    width: 64%;
    height: 30px;
}
.section_title_right
{
	position: relative;
    width: 30%;
    height: 30px;
}
.section_title_right .skew_right
{
	width: 100%;
    height: 30px;
	-webkit-transform: skew(-35deg);
    -moz-transform: skew(-35deg);
	-o-transform: skew(-35deg);
	margin: 0 -11px;
}
.section_title_left .skew_left
{
	width: 100%;
	height: 30px;
	-webkit-transform: skew(-35deg);
	-moz-transform: skew(-35deg);
	-o-transform: skew(-35deg);
	margin: 0 11px;
}
.section_title_left .skew_left h3
{
	-webkit-transform: skew(35deg);
	-moz-transform: skew(35deg);
	-o-transform: skew(35deg);
	text-indent:10px;
}
.section_title_right .skew_right h3
{
	-webkit-transform: skew(35deg);
	-moz-transform: skew(35deg);
	-o-transform: skew(35deg);
}

/*************************/

#featured{ 
	width:400px; 
	padding-right:250px; 
	position:relative; 
	border:5px solid #ccc; 
	height:250px; overflow:hidden;
	background:#fff;
}
#featured ul.ui-tabs-nav{ 
	position:absolute; 
	top:0; left:400px; 
	list-style:none; 
	padding:0; margin:0; 
	width:250px; height:250px;
	overflow:auto;
	overflow-x:hidden;
}
#featured ul.ui-tabs-nav li{ 
	padding:1px 0; padding-left:13px;  
	font-size:12px; 
	color:#666; 
}
#featured ul.ui-tabs-nav li img{ 
	float:left; margin:2px 5px; 
	background:#fff; 
	padding:2px; 
	border:1px solid #eee;
}
#featured ul.ui-tabs-nav li span{ 
	font-size:11px; font-family:Verdana; 
	line-height:18px; 
}
#featured li.ui-tabs-nav-item a{ 
	display:block; 
	height:60px; text-decoration:none;
	color:#333;  background:#fff; 
	line-height:20px; outline:none;
}
#featured li.ui-tabs-nav-item a:hover{ 
	background:#f2f2f2; 
}
#featured li.ui-tabs-selected, #featured li.ui-tabs-active{ 
	background:url('images/selected-item.gif') top left no-repeat;  
}
#featured ul.ui-tabs-nav li.ui-tabs-selected a, #featured ul.ui-tabs-nav li.ui-tabs-active a{ 
	background:#ccc; 
}
#featured .ui-tabs-panel{ 
	width:400px; height:250px; 
	background:#999; position:relative;
}
#featured .ui-tabs-panel .info{ 
	position:absolute; 
	bottom:0; left:0; 
	height:70px; 
	background: url('images/transparent-bg.png'); 
}
#featured .ui-tabs-panel .info a.hideshow{
	position:absolute; font-size:11px; font-family:Verdana; color:#f0f0f0; right:10px; top:-20px; line-height:20px; margin:0; outline:none; background:#333;
}
#featured .info h2{ 
	font-size:1.2em; font-family:Georgia, serif; 
	color:#fff; padding:5px; margin:0; font-weight:normal;
	overflow:hidden; 
}
#featured .info p{ 
	margin:0 5px; 
	font-family:Verdana; font-size:11px; 
	line-height:15px; color:#f0f0f0;
}
#featured .info a{ 
	text-decoration:none; 
	color:#fff; 
}
#featured .info a:hover{ 
	text-decoration:underline; 
}
#featured .ui-tabs-hide{ 
	display:none; 
}


#featured_list{ 
	width:400px; 
	padding-right:250px; 
	position:relative; 
	border:5px solid #ccc; 
	height:250px; overflow:hidden;
	background:#fff;
}
#featured_list ul.ui-tabs-nav{ 
	position:absolute; 
	top:0; left:400px; 
	list-style:none; 
	padding:0; margin:0; 
	width:250px; height:250px;
	overflow:auto;
	overflow-x:hidden;
}
#featured_list ul.ui-tabs-nav li{ 
	padding:1px 0; padding-left:13px;  
	font-size:12px; 
	color:#666; 
}
#featured_list ul.ui-tabs-nav li img{ 
	float:left; margin:2px 5px; 
	background:#fff; 
	padding:2px; 
	border:1px solid #eee;
}
#featured_list ul.ui-tabs-nav li span{ 
	font-size:11px; font-family:Verdana; 
	line-height:18px; 
}
#featured_list li.ui-tabs-nav-item a{ 
	display:block; 
	height:60px; text-decoration:none;
	color:#333;  background:#fff; 
	line-height:20px; outline:none;
}
#featured_list li.ui-tabs-nav-item a:hover{ 
	background:#f2f2f2; 
}
#featured_list li.ui-tabs-selected, #featured_list li.ui-tabs-active{ 
	background:url('images/selected-item.gif') top left no-repeat;  
}
#featured_list ul.ui-tabs-nav li.ui-tabs-selected a, #featured_list ul.ui-tabs-nav li.ui-tabs-active a{ 
	background:#ccc; 
}
#featured_list .ui-tabs-panel{ 
	width:400px; height:250px; 
	background:#999; position:relative;
}
#featured_list .ui-tabs-panel .info{ 
	position:absolute; 
	bottom:0; left:0; 
	height:70px; 
	background: url('images/transparent-bg.png'); 
}
#featured_list .ui-tabs-panel .info a.hideshow{
	position:absolute; font-size:11px; font-family:Verdana; color:#f0f0f0; right:10px; top:-20px; line-height:20px; margin:0; outline:none; background:#333;
}
#featured_list .info h2{ 
	font-size:1.2em; font-family:Georgia, serif; 
	color:#fff; padding:5px; margin:0; font-weight:normal;
	overflow:hidden; 
}
#featured_list .info p{ 
	margin:0 5px; 
	font-family:Verdana; font-size:11px; 
	line-height:15px; color:#f0f0f0;
}
#featured_list .info a{ 
	text-decoration:none; 
	color:#fff; 
}
#featured_list .info a:hover{ 
	text-decoration:underline; 
}
#featured_list .ui-tabs-hide{ 
	display:none; 
}
</style>



<div class="clear"></div>
 
<?php $this->load->view('template/submenu_writer');   ?>

<?php $this->load->view('template/tree_menu_writer');   ?>


<?php /* Start */ ?>
<div id="featured" >
		  <ul class="ui-tabs-nav">
	        <li class="ui-tabs-nav-item" id="nav-fragment-1"><a href="#fragment-1"><img src="images/image1-small.jpg" alt="" /><span>15+ Excellent High Speed Photographs</span></a></li>
	        <li class="ui-tabs-nav-item" id="nav-fragment-2"><a href="#fragment-2"><img src="images/image2-small.jpg" alt="" /><span>20 Beautiful Long Exposure Photographs</span></a></li>
	        <li class="ui-tabs-nav-item" id="nav-fragment-3"><a href="#fragment-3"><img src="images/image3-small.jpg" alt="" /><span>35 Amazing Logo Designs</span></a></li>
	        <li class="ui-tabs-nav-item" id="nav-fragment-4"><a href="#fragment-4"><img src="images/image4-small.jpg" alt="" /><span>Create a Vintage Photograph in Photoshop</span></a></li>
			
	      </ul>

	    <!-- First Content -->
	    <div id="fragment-1" class="ui-tabs-panel" style="">
			<img src="images/image1.jpg" alt="" />
			 <div class="info" >
				<h2><a href="#" >15+ Excellent High Speed Photographs</a></h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tincidunt condimentum lacus. Pellentesque ut diam....<a href="#" >read more</a></p>
			 </div>
	    </div>

	    <!-- Second Content -->
	    <div id="fragment-2" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="images/image2.jpg" alt="" />
			 <div class="info" >
				<h2><a href="#" >20 Beautiful Long Exposure Photographs</a></h2>
				<p>Vestibulum leo quam, accumsan nec porttitor a, euismod ac tortor. Sed ipsum lorem, sagittis non egestas id, suscipit....<a href="#" >read more</a></p>
			 </div>
	    </div>

	    <!-- Third Content -->
	    <div id="fragment-3" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="images/image3.jpg" alt="" />
			 <div class="info" >
				<h2><a href="#" >35 Amazing Logo Designs</a></h2>
				<p>liquam erat volutpat. Proin id volutpat nisi. Nulla facilisi. Curabitur facilisis sollicitudin ornare....<a href="#" >read more</a></p>
	         </div>
	    </div>

	    <!-- Fourth Content -->
	    <div id="fragment-4" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="images/image4.jpg" alt="" />
			 <div class="info" >
				<h2><a href="#" >Create a Vintage Photograph in Photoshop</a></h2>
				<p>Quisque sed orci ut lacus viverra interdum ornare sed est. Donec porta, erat eu pretium luctus, leo augue sodales....<a href="#" >read more</a></p>
	         </div>
	    </div>
		
		

		</div>
        
        
        
<?php /* End */ ?>

<div id="innerhome_slideshow" class="<?php echo $current_section_background_color; ?> <?php echo $current_section_border_color; ?>">


<div class="slide_show_title_sign float_left">

<div class="inner_margin_wrapper">
<div style="margin:30px 0px;">
<div align="center"><img src="<?php echo base_url(); ?>images/bestmom/bestmom_inner_slideshow_logo.png"  /></div>
<div align="center"><h2 class="white_color"><?php echo  lang("globals_bestmom"); ?></h2></div>
</div>


</div><!-- End of inner_margin_wrapper -->


</div><!-- End of slide_show_title_sign -->

<div class="slide_show_wrapper float_right" style="overflow: visible; z-index: 1;">

<div class="camera_wrap camera_azure_skin" id="camera_wrap_1">

<?php 
for($i=0 ; $i < sizeof($display_section_slideshow) ; $i++):
$image = base_url()."uploads/slideshows/".$display_section_slideshow[$i]['images_src'];
?>


<div data-thumb="<?php echo $image; ?>" data-src="<?php echo $image; ?>"></div>                
<?php
endfor;
?>
    </div><!-- End of camera_wrap -->

</div><!-- End of slide_show_wrapper -->

<div class="clear"></div>
</div><!-- End of innerhome_slideshow -->

<div class="clear"></div>


<div class="global_sperator_height" style="width:100%"></div>

<div class="inner_title_wrapper">
    <div class="sections_wrapper_margin">
    <h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;">حملى</h1>
    </div>
</div>
<div class="thick_line <?php echo $current_section_background_color; ?>" ></div>



<div style="height:280px;">
<div class="float_left <?php echo $current_section_background_color; ?>" style="width:635px;height:280px;">



</div>


<div class="float_right" style="width:360px;">
<div class="inner_tips_wrapper " style="margin-bottom:3px;" >
<div  class="close_quote <?php echo $current_section_color; ?>" > &#8220;</div>
<div  class="open_quote <?php echo $current_section_color; ?>" >&#8221;</div>

        <div id="slides">
                <div class="slides_container">
                <?php
					for($i = 0 ; $i <sizeof($display_section_tips) ; $i++)
					{
						echo '<div>'.$display_section_tips[$i]['section_tips_name'.$current_language_db_prefix].'</div>';
					}
					?>
                <div class="clear"></div>
                </div>
                 <ul class="pagination">
                 <?php
				 for($i = 0 ; $i <sizeof($display_section_tips); $i++)
				 {
				 	echo '<li><a style="font-size: 30px;line-height: 34px;padding: 2px;">•</a></li>';
				 }
				 ?>
                 </ul>
                <div class="clear"></div>
        </div><!-- End of slides -->
        <div style="margin-top:35px;"><a><img src="<?php echo base_url()."images/bestmom/advice.png"  ?>"/></a></div>
        
	</div><!-- ENd of inner_tips_wrapper -->

</div><!-- End of width:360px -->


<div class="clear"></div>
</div><!--end of 7amly-->

<div class="global_sperator_height" style="width:100%"></div>

<?php /*?><div class="inner_title_wrapper">
    <div class="sections_wrapper_margin">
    <h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;">طفلى الرضيع</h1>
    </div>
</div><?php */?>
<div class="thick_line <?php echo $current_section_background_color; ?>" ></div>

<div class="white_background_color" style="height:225px;">
<div class="global_sperator_height" style="width:100%"></div>





        <div class="float_left" style="width:495px;">
            <?php /*?><div class="section_title_right float_left <?php echo $current_section_background_color; ?>"><div class="skew_right white_color <?php echo $current_section_background_color; ?>"><h3>تغذية طفلى</h3></div></div>
            <div class="section_title_left float_right <?php echo $current_section_background_color; ?>"><div class="skew_left white_color <?php echo $current_section_background_color; ?>"><h3>كل ما تحتاجين معرفتة عن تغذية طفلك وصحتة</h3></div></div><?php */?>
            <div class="clear"></div>
            
				 <?php
				 /* Test Before */
				 
				 ?>
                 
                 <div id="featured_list" >
		  <ul class="ui-tabs-nav">
	        <li class="ui-tabs-nav-item" id="nav-fragment-1"><a href="#fragment-1"><img src="images/image1-small.jpg" alt="" /><span>15+ Excellent High Speed Photographs</span></a></li>
	        <li class="ui-tabs-nav-item" id="nav-fragment-2"><a href="#fragment-2"><img src="images/image2-small.jpg" alt="" /><span>20 Beautiful Long Exposure Photographs</span></a></li>
	        <li class="ui-tabs-nav-item" id="nav-fragment-3"><a href="#fragment-3"><img src="images/image3-small.jpg" alt="" /><span>35 Amazing Logo Designs</span></a></li>
	        <li class="ui-tabs-nav-item" id="nav-fragment-4"><a href="#fragment-4"><img src="images/image4-small.jpg" alt="" /><span>Create a Vintage Photograph in Photoshop</span></a></li>
			
	      </ul>

	    <!-- First Content -->
	    <div id="fragment-1" class="ui-tabs-panel" style="">
			<img src="images/image1.jpg" alt="" />
			 <div class="info" >
				<h2><a href="#" >15+ Excellent High Speed Photographs</a></h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tincidunt condimentum lacus. Pellentesque ut diam....<a href="#" >read more</a></p>
			 </div>
	    </div>

	    <!-- Second Content -->
	    <div id="fragment-2" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="images/image2.jpg" alt="" />
			 <div class="info" >
				<h2><a href="#" >20 Beautiful Long Exposure Photographs</a></h2>
				<p>Vestibulum leo quam, accumsan nec porttitor a, euismod ac tortor. Sed ipsum lorem, sagittis non egestas id, suscipit....<a href="#" >read more</a></p>
			 </div>
	    </div>

	    <!-- Third Content -->
	    <div id="fragment-3" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="images/image3.jpg" alt="" />
			 <div class="info" >
				<h2><a href="#" >35 Amazing Logo Designs</a></h2>
				<p>liquam erat volutpat. Proin id volutpat nisi. Nulla facilisi. Curabitur facilisis sollicitudin ornare....<a href="#" >read more</a></p>
	         </div>
	    </div>

	    <!-- Fourth Content -->
	    <div id="fragment-4" class="ui-tabs-panel ui-tabs-hide" style="">
			<img src="images/image4.jpg" alt="" />
			 <div class="info" >
				<h2><a href="#" >Create a Vintage Photograph in Photoshop</a></h2>
				<p>Quisque sed orci ut lacus viverra interdum ornare sed est. Donec porta, erat eu pretium luctus, leo augue sodales....<a href="#" >read more</a></p>
	         </div>
	    </div>
		
		

		</div>
                 
                 <?php
				 /*Test After */
				 ?>

            
        </div><!-- End of width:495px; -->
        
        

    
    <div class="float_right" style="width:495px;">

        <div class="section_title_right float_left <?php echo $current_section_background_color; ?>"><div class="skew_right <?php echo $current_section_background_color; ?>"></div></div>
    	<div class="section_title_left float_right <?php echo $current_section_background_color; ?>"><div class="skew_left <?php echo $current_section_background_color; ?>"></div></div>
   		<div class="clear"></div>
    
    </div>
    
<div class="clear"></div>
</div><!--end of tefly el rade3-->





<div class="float_right" style="width:435px; height:450px;">

<!-- Start of recent Articles -->
<?php /*?><div class="header_graybackground_only <?php echo $current_section_borderbottom_color; ?> <?php echo $current_section_color; ?>" >
<div style="margin:0px 15px; line-height:38px" ><?php echo lang("bestcook_recent_articles"); ?></div>
</div><?php */?>

<div class="inner_title_wrapper">
    <div class="sections_wrapper_margin">
    <h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo lang("bestcook_recent_articles"); ?></h1>
    </div>
</div>


</div><!-- ENd of divs tips and recent articles -->

<div class="clear"></div>

<div class="global_sperator_height" style="width:100%"></div>


<div class="clear"></div>


<?php $this->load->view('best_mom/homepage/view_tanshi2it_teflik_row');   ?>

<div class="clear"></div>

<?php $this->load->view('best_mom/homepage/view_applications_ask_an_expert_row');   ?>