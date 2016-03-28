<script>
jQuery(document).ready(function(e) {
    
	jQuery(".newsletter_choices_button").click(function(e) {
        
		var id = $(this).data("id");
		
		$(this).toggleClass("active");
    });
	
});
</script>
<script>
$(document).ready(function(e) {
	$('.application_slider').bxSlider({
  		pause: 10000,
		speed: 300,
		auto: true,
  		autoControls: false,
		nextText : '',
		prevText : '',
		pager: false,
	});
});
</script>
<style>
#application_slider_container .bx-controls .bx-controls-direction{
	display:block !important;
}
#application_slider_container{
	width: 320px;
	height: 250px;
	position: absolute;
	overflow:hidden;
	-webkit-border-bottom-right-radius: 20px;
	-webkit-border-bottom-left-radius: 20px;
	-moz-border-radius-bottomright: 20px;
	-moz-border-radius-bottomleft: 20px;
	border-bottom-right-radius: 20px;
	border-bottom-left-radius: 20px;
}
.center{margin-left:20px;}
.rightword{color:#E82327;font-size:15pt;}
.leftword{color:#828282;font-size:10pt;}
.imgs{list-style:none;margin-right:20px;}
.imgs li{float:right;margin:34px; height:380px;position:relative; border-width:1px; border-style:solid;}
.circle
{ 
	position: absolute;
	right: 100px;
	bottom: 47px;
	width: 38%;
	height: 25%;
	border-radius: 328% / 572%;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
	border: #FFF 3px dashed;
	border-bottom: none;
} 
/*.cook_tool
{
	margin: -1px 35px;
	width: 44px;
	height: 47px;
}*/
.cook_tool
{
margin: 12px 34px;
width: 55px;
height: 55px;
}
			
.par_words{ color:#FFF;font-family:[GESSTwoLight];
				font-size:12px;
				text-align:center;
				margin:0px;
			 	white-space:normal;
				}


.bx-wrapper .bx-prev {left: 0px; background: url(../../images/homepage/left_arrow.png) no-repeat;}

.bx-wrapper .bx-next{right: -1px;background: url(../../images/homepage/right_arrow.png) no-repeat;}



.inner_applications_bestcook_width .image img.app
{
	-webkit-border-bottom-right-radius: 15px;
	-webkit-border-bottom-left-radius: 15px;
	-moz-border-radius-bottomright: 15px;
	-moz-border-radius-bottomleft: 15px;
	border-bottom-right-radius: 15px;
	border-bottom-left-radius: 15px;
	
	-webkit-border-top-right-radius: 0px;
	-webkit-border-top-left-radius: 0px;
	-moz-border-radius-topright: 0px;
	-moz-border-radius-topleft: 0px;
	border-top-right-radius: 0px;
	border-top-left-radius: 0px;
}
.best_cook_inner_applications_list_next 
{
	position: absolute;
	left: 288px;
}
#bestmom_newsletter_list
{
	width:320px; margin:0 auto
}
#bestmom_newsletter_list li
{
/*	margin: 5px;
	padding: 5px;
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	cursor: pointer;
	text-indent: 0;
	border: 1px solid #dcdcdc;
	font-weight: bold;
	text-decoration: none;
	text-align: center;
	box-shadow: -2px 2px 4px #dcdcdc;*/
}
#bestmom_newsletter_list li:active
{
	box-shadow:none;
}
#bestmom_newsletter_list li a
{
	display:block;
	width:100%;
		margin: 4px;
	padding: 5px;
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	cursor: pointer;
	text-indent: 0;
	border: 1px solid #dcdcdc;
	font-weight: bold;
	text-decoration: none;
	text-align: center;
	box-shadow: -2px 2px 4px #dcdcdc;
	width: 86px;
height: 98px;
}
#bestmom_newsletter_list li a:active
{
	box-shadow:none;
}
#bestmom_newsletter_list li a.active
{
	border: 1px solid #ffc81b;
}
#bestmom_newsletter_list li .logo
{
	width: 58px;
height: 68px;
margin: 0 auto;
}
#bestmom_newsletter_list li .text
{
	font-size:12px;
	white-space:normal;
	text-align: center;
	margin: 0px;
}

.newsletter_button:active {
	position:relative;
	top:1px;
}
.subscribe_now
{
	position: absolute;
	left: 19%;
	top: 13px;
	font-weight: bold;
}
body.arabic .subscribe_now 
{
	position: absolute;
	left: 26%;
	top: 9px;
	font-weight: bold;
}
.margin_left
{
	margin-left:64px !important;
}
body.arabic .margin_left
{
	margin-left:-48px !important;
}
</style>
<div class="clear"></div>

<div  class="float_left home_widget inner_applications_bestcook_width " >
    <div class="inner_title_wrapper">
        <div class="sections_wrapper_margin">
            <?php
                //Get Data form grow up 
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(180,$current_language_db_prefix);
             ?>
        <h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo $subsection_title;?></h1>
        </div>
    </div>
    <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
	<div id="application_slider_container">
        <ul class="application_slider">
        <?php
        for($i=0 ; $i < sizeof($display_applications) ; $i++):
		
		$id = $display_applications[$i]['applications_ID'];
		$title = $display_applications[$i]['applications_title'.$current_language_db_prefix];
		$image =  base_url()."uploads/applications/".$display_applications[$i]['images_src'];
		$logo =  base_url()."uploads/applications/".$this->globalmodel->get_image_src($display_applications[$i]['applications_logo']);
        ?>
        
            <li>
            <a href="<?php echo site_url($this->router->fetch_class().'/applications/'.$id)?>">
            <img src="<?php echo $image ?>" />
            <div class="circle <?php echo $current_section_background_color ?>"> 
          			<div class="cook_tool" style="background:url('<?php echo $logo; ?>') 0 0;"></div>

          	 	</div>
            <div class="clear"></div>
            </a>
            </li>
            
		 <?php
        endfor;
        ?>              
                      
        </ul>
  
</div>
      
</div><!-- ENd of inner_applications_bestcook_width -->


<div class="float_left" style="width:7px; height:300px;"></div>

<?php $this->widgets->generate_ask_an_expert(179,$current_section_color,$current_section_border_color,$current_section_background_color,$display_ask_an_expert,$display_expert,$current_language_db_prefix);   ?>

<div class="float_left "  style="width:7px; height:300px;" ></div>

<div class="float_left home_widget" style="width:345px; height:295px;">

<div class="inner_title_wrapper">
        <div class="sections_wrapper_margin">
        <h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;"><?php echo lang("bestmom_news_letter_signup") ?></h1>
        </div>
    </div>
    <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>

        <div style="width: 345px;height: 252px;margin-top: -10px;background: rgba(255, 255, 255, 0.7);-webkit-border-bottom-right-radius: 20px;-webkit-border-bottom-left-radius: 20px;-moz-border-radius-bottomright: 20px;-moz-border-radius-bottomleft: 20px;border-bottom-right-radius: 20px;border-bottom-left-radius: 20px;">
        <div style="margin:10px 5px; position:relative; white-space:normal;top: 5px;" class="gray_color">
        	<h3><?php echo lang("bestmom_news_letter_signup_desc"); ?></h3>
            <?php
            $number_of_li = count($display_newsletter);
			
			if($number_of_li == 1)
			{
				$width = '106px;';
			}
			else if($number_of_li == 2)
			{
				$width = '212px;';
			}
			else
			{
				$width = '320px;';
			}
			?>
            
            <ul id="bestmom_newsletter_list" style=" width:<?php echo $width;?>">
            <?php

			for($i = 0 ; $i < sizeof($display_newsletter) ; $i++):
			$id = $display_newsletter[$i]['newsletter_types_ID'];
			$title = $display_newsletter[$i]['newsletter_types_title'.$current_language_db_prefix];
			//$image =  base_url()."images/icons/".$display_newsletter[$i]['images_src'];
			$image =  base_url()."uploads/icons/".$this->globalmodel->get_image_src($display_newsletter[$i]['newsletter_types_image']);
			
			?>            
            	<li class="float_left newsletter_button" >
                	<a class="newsletter_choices_button fancybox fancybox.ajax" href="<?php echo site_url("newsletter/add_to_newsletter/".$id); ?>" data-id="<?php echo $i; ?>" data-selected = "0" >
                	<div class="logo"><img width="60" height="60" style="border:none" src="<?php echo $image; ?>" /></div>
                    <div class="text"><?php echo $title;?></div>
                    </a>
                </li>

            <?php
			endfor;
			?>
            <div class="clear"></div>
            </ul>
        
        </div>
        </div>

<div style="position: absolute;bottom: 0;left: 78px;height: 42px;">
	<h3 class="white_color subscribe_now"><?php echo lang('bestmom_subscribe_now');?></h3>
    <img src="<?php echo base_url()."images/bestmom/eshtirky_el_an.png"; ?>" />
</div>

</div><!-- End of newsletter_signin -->
