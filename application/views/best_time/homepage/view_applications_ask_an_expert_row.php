<script>
jQuery(document).ready(function(e) {
    jQuery(".ask_an_expert_lists").jCarouselLite({
				btnNext: ".ask_an_expert_recentitem_prev",
				btnPrev: ".ask_an_expert_recentitem_next",
				visible:1
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
		onSliderLoad: function () {
			$('.bx-controls-direction').hide();
			$('.bx-wrapper').hover(
			function () { $('.bx-controls-direction').fadeIn(300); },
			function () { $('.bx-controls-direction').fadeOut(300); }
			);
			},
	});
});
</script>
<div class="clear"></div>

<div  class="float_left home_widget inner_applications_bestcook_width " >
        <div class="image"><img style="height: 243px;margin-top: 50px;"  src="<?php echo base_url()."images/bestmom/homepage_application_background.jpg" ?>"/></div>
        
        <div class="title <?php echo $current_section_border_color; ?> regular_widget_border_width">
            <div class="<?php echo $current_section_color; ?>"><?php echo lang("bestmom_applications") ?></div>
        </div>
        
        <div class="" style="width:290px; height:75px;position:absolute; bottom:32px; z-index:99;left: 31%;margin-left: -83px;">
        
        <a class="best_cook_inner_applications_list_prev"><img src="<?php echo base_url()."images/arrow_to_left_white_small.png" ?>" /></a>
        <a class="best_cook_inner_applications_list_next "><img src="<?php echo base_url()."images/arrow_to_right_white_small.png" ?>" /></a>
        <div class="best_cook_inner_applications_list">
        <ul>
        <?php
        for($i=0 ; $i < sizeof($display_applications) ; $i++):
		
		$id = $display_applications[$i]['applications_ID'];
		$title = $display_applications[$i]['applications_title'.$current_language_db_prefix];
		$logo =  base_url()."uploads/applications/".$this->globalmodel->get_image_src($display_applications[$i]['applications_logo']);
        ?>
            <li>
            <a>
            <div class="image_application" align="center"><div style="width:55px; height:55px; background:url(<?php echo $logo; ?>); background-position:0 -55px"></div></div>
            <div class="title_wrapper <?php echo $current_section_color; ?>"><?php echo $title; ?></div>
            <div class="clear"></div>
            </a>
            </li>
        <?php
        endfor;
        ?>
              
        </ul>
    
    </div><!--- End of recent_items_list -->
            
</div>
      
</div><!-- ENd of inner_applications_bestcook_width -->


<div class="float_left" style="width:7px; height:300px;"></div>


<div class="float_left home_widget inner_applications_bestcook_width" style="background:#fff3cb" >

        <div class="title <?php echo $current_section_border_color; ?> regular_widget_border_width">
            <div class="float_left" style="margin:0">
                <div class="<?php echo $current_section_color; ?> " style="margin-bottom:0px">لحياة أفضل مع نستله</div>
               <?php /*?> <div style="font-size:10px; margin:3px 10px">دكتور : شيرين أحمد محمد</div>
                <div style="font-size:10px;margin:3px 10px">أخصائي التغذية بجامعة القاهرة</div><?php */?>
            </div>
            <?php /*?><div class="float_right" style="width:105px;" ><img src="http://cdn.pimg.co/p/105x95/858652/fff/img.png" /></div><?php */?>
            <div class="clear"></div>
        </div>
        
        <div style="margin: 10px 10px;top: 55px;position: relative;white-space: normal;">
        
                <a style="position: absolute;bottom: -30px;right: 50%;" class="ask_an_expert_recentitem_prev"><img src="<?php echo base_url()."images/arrow_to_left_white_small.png" ?>" /></a>
                <a style="position: absolute;bottom: -30px;left: 50%;" class="ask_an_expert_recentitem_next "><img src="<?php echo base_url()."images/arrow_to_right_white_small.png" ?>" /></a>
                <div class="ask_an_expert_lists">
                <ul>
                <?php
				/*for($i=0; $i < sizeof($display_data);$i++):
					$question = strip_tags( $display_data[$i]['ask_expert_question_ar'] );
					$answer = strip_tags( $display_data[$i]['ask_expert_answer_ar'] );
					$brief_answer = substr(strip_tags($answer), 0, 620). (strlen(strip_tags($answer)) > 620?'...':'');*/
				
				for($i=0; $i <1;$i++):
					$question = " ايه اهمية الفطام للطفل طب ماانا ممكن ارضعه سنتين او اكثر ومافيهاش ضرر يا ريت حد من العضاء يجوبنى؟";
					$answer = "مرحلة الفطام هي مرحلة زمنيه يمر بها الطفل الرضيع ليبدأ معها في تناول أغذية جديدة تحل محل الرضاعة سواء كانت طبيعية من ثدي الأم أو من خلال الببرونة، وتستمر لفترة زمنية قد تمتد لبلوغ الرضيع لعامة الثاني من العمر، وممكن أقل شوية، بس بنفضل إستمرار الرضاعة أطول فترة ممكنة كلما أمكن ذلك، وياريت تكون رضاعة طبيعية، علشان هى فعلاً مفيدة بشكل لايمكن وصفة لطفلك، ولتطورة النفسى، ولعلاقتك بية.";
					//$brief_answer = substr(strip_tags($answer), 0, 620). (strlen(strip_tags($answer)) > 620?'...':'');	
					

				?>
                <li style="height:190px;">
                    <h3 class="white_color" style="padding-bottom:5px; margin-bottom:5px; color:#2f2f2f"><?php echo $question ?></h3>
                    <p style="color:#2f2f2f; background:#fffaeb; padding:10px;"><?php echo $answer ?></p>
                </li>
                <?php
				endfor;
				?>
                </ul>
        
        
            </div>
            <small><a class="float_right <?php echo $current_section_color ?>" href="">المزيد</a></small>
        
        
        </div>
        </div><!-- End of ask the expert  widget-->
        



<div class="float_left "  style="width:7px; height:300px;" ></div>


<div class="float_left home_widget" style="width:345px; height:295px; background:#FFF">

		<div class="title <?php echo $current_section_border_color; ?> regular_widget_border_width">
            <div class="<?php echo $current_section_color; ?>"><?php echo lang("bestme_best_advice") ?></div>
        </div>
        
        <div id="best_advice" style="" class="gray_color">

        <?php
		for($i=0 ;$i<sizeof($display_best_advice); $i++)
		{
			//$image_url = "https://www.mynestle.com.eg/images/Articles/";

			$title = $display_best_advice[$i]['static_name'.$current_language_db_prefix];
			$image  = base_url()."uploads/static/".$display_best_advice[$i]['images_src'];
			?>
            
            <img src="<?php echo $image?>" />
            <div id="circle"><h3><?php echo $title;?></h3></div>


		<?php
		}
        ?>
            

        
        </div>
        <div class="clear"></div>

</div><!-- End of newsletter_signin -->
<style>
#best_advice
{
	position: relative;
	top: 62px;
	white-space: normal;
}

#best_advice img
{
	width:345px;
	height:235px;
	-webkit-border-bottom-right-radius: 20px;
	-webkit-border-bottom-left-radius: 20px;
	-moz-border-radius-bottomright: 20px;
	-moz-border-radius-bottomleft: 20px;
	border-bottom-right-radius: 20px;
	border-bottom-left-radius: 20px;
}

#best_advice #circle 
{
	position: absolute;
	width: 185px;
	height: 185px;
	background: rgba(255, 255, 255, 0.8);
	-moz-border-radius: 150px;
	-webkit-border-radius: 150px;
	border-radius: 150px;
	padding: 14px;
	top: 11px;
	margin: 0 67px;
}

#best_advice #circle h3
{
	width: 183px;
	text-align: center;
	color: #000;
	margin-top: 30px;
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
	right: 106px;
	bottom: 47px;
	width: 34%;
	height: 24%;
	border-radius: 328% / 572%;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
	border: #FFF 3px dashed;
	border-bottom: none;
} 
.cook_tool
{
	margin: 1px 28px;
	width: 44px;
	height: 47px;
}
			
.par_words{ color:#FFF;font-family:[GESSTwoLight];
				font-size:10pt;
				text-align:center;
				margin:0px;
			 	white-space:normal;
				}


.bx-wrapper .bx-prev {left: 0px; background: url(../../images/homepage/left_arrow.png) no-repeat;}

.bx-wrapper .bx-next{right: -1px;background: url(../../images/homepage/right_arrow.png) no-repeat;}

</style>