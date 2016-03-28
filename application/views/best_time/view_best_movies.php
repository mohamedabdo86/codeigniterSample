<script>
	jQuery(function(){
		
		jQuery(".recent_items_list_bk").jCarouselLite({
			btnNext: ".recentitem_prev",
			btnPrev: ".recentitem_next",
			visible:4
		});

	});
</script>

<div class="clear"></div>

<?php echo $this->load->view('template/submenu_writer');   ?>

<?php echo $this->load->view('template/tree_menu_writer');   ?>

 
<div class="clear"></div>
<style>
.container_slideshow_1_items
{
	/*height:380px;*/
	width:auto;
	
}
.contentimgs{
			  			  
			  width:1000px;
			  padding:0px;
			  margin:0px;
			  height:0px;
			  
			}
#best_time_lists_film{list-style:none;
		margin-right:20px;
		padding:0px;
		list-style:none;
		}
#best_time_lists_film li{margin:5px;
			float:right;
			}

#best_time_lists_film li .imgscontrol{ 
			border-bottom-right-radius: 10px;
 			border-bottom-left-radius: 10px;
			border:#2fa8c7 1px solid;
			margin-top:10px;
			}
#best_time_lists_film li .imgwrapper{width:230px;
			height:87px;
			background-color:#32a9c8;
		 margin-top:-5px;
		 border-bottom-right-radius: 10px;
         border-bottom-left-radius: 10px;
		position:relative;}
#best_time_lists_film li .imgcontainer{
	    border-bottom-right-radius: 10px;
        border-bottom-left-radius: 10px;
		border-style:dotted;
		border-color:#FFFFFF;
		margin:4px;
       	width:212px;
	     height:70px;
		 position:absolute;
		}
#best_time_lists_film li .moviedetails{
		color:#FFFFFF;
		font-size:11px;
		white-space:normal;
		width:200px;
		margin-top:8px;
	
	}
#best_time_lists_film_slide{list-style:none;
		margin-right:20px;
		padding:0px;
		list-style:none;}
#best_time_lists_film_slide li{margin:5px;
			float:right;
			}	
#best_time_lists_film_slide li .imgscontrol{ 
			border-bottom-right-radius: 10px;
 			border-bottom-left-radius: 10px;
			margin-top:10px;
			}	
#best_time_lists_film_slide li .imgwrapper{
			width:230px;
			height:87px;
			background-color:#FFFFFF;
		 margin-top:-5px;
		 border-bottom-right-radius: 10px;
         border-bottom-left-radius: 10px;
		position:relative;}
#best_time_lists_film_slide li .moviedetails{
		color:#000;
		white-space:normal;
		width:200px;
		margin-top:8px;
	
	}
</style>


<div class="inner_title_wrapper" style=" margin-top:10px;">

<div class="sections_wrapper_margin">
<h1 class="<?php echo $current_section_color  ?>" style="font-size:24px;">أخر الأفلام</h1>
</div>

</div><!-- End of inner_title_wrapper -->
<div class="thick_line <?php echo $current_section_background_color; ?>" style="margin:0;"></div>

<div class="container_slideshow_1_items">



<div id="one" class="contentslider">
    <div class="cs_wrapper">
        <div class="cs_slider">
			
			<?php
			$image_url = "https://www.mynestle.com.eg/images/Articles/";
			
            for($i=0;$i<4;$i++):
			$id = 1;
			$image  = "";
			$url = "";
			//$share_image = base_url()."images/share_image.png";
			
			
			$title = "كلمنى شكراً";
			$desc = "تبدأ أحداث الفيلم العالمية بل ذات, دول ان مشاركة الواقعة. قد سقط جنوب اللا وإقامة, الى عن بفرض بحشد. أي للسيطرة المنتصر حشد. المارق لبولندا، مدن ثم, هجوم خسائر لم قصف. بالسيطرة التغييرات ان بحق. 
مايو تاريخ تزامناً كلّ أن, وعزّزت وبعدما الهزائم بـ انه. العدّ العالمي في شبح. 
برلين تحرّك بالولايات إذ ذات. تم حول المشتّتون  بل بعض, التي تجهيز الضحايا بل دول. إذ الضروري وهولندا، العمليات قهر. ما عام الحاملات المتّبعة. المارق ااء 

أما عل جديدة لفرنسا, وتتحمّل المذابح ان فقد, لغزو نورمبرغ حين و. يعبأ نهاية الحيلولة تم مما. انه أن خلاف والفلبين. أمام وحزبه المنتصرة.
أخر تم ببعض مهانة, القوات الشرق، به، في. بـ بعد سياسة أسابيع إيطاليا, الصعداء استرجاع حدى في, انه تعديل كارثة حاملات في. أن وسمّيت.
حاول جنود ومن أي, يرتبط استعملت التنازلي عل حول. ميناء الأرض محاولات تم عام, سقط وفرنسا مناوشات والنرويج أن, ببعض المقيتة التكاليف بـ هذا. لمّ عل تنفّس خصوصا, جُل إذ لهذه تحرّك. لكل تكتيكاً وتتحمّل 30, مع هامش حالية فصل ";
			
			//$url = site_url($this->router->class."/inner_articles/".$id);
		//	$views = $display_feat[$i]['articles_views'];
			//$table_name_for_rate = "articles";
			?>

            <div class="cs_article">
            <center>
				<div class="inner_featured_contanier" style="width:866px; height:330px;">
                <div class="float_left" style="width: 390px;height: 320px;">
                <a href="<?php echo $url; ?>">
                    <img src="<?php echo $image?>" alt="<?php echo $title; ?>" />
                </a>
                
              
                
				<div class="clear"></div>
                </div>
                <div class="float_right text_align_left" style="width: 455px;height: 292px;">
                
                <h2> <a href="<?php  echo $url;?>"><?php echo $title;?></a> </h2>
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


</div><!--End of .container_slideshow_1_items-->




<div class="inner_title_wrapper" style=" margin-top:10px;">

<div class="sections_wrapper_margin">
<h1 class="<?php echo $current_section_color  ?>" style="font-size:24px;">شاهد أيضاً</h1>
</div>

</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color  ?>"></div>

<div id="one" class="contentimgs">
 	<ul id="best_time_lists_film">
    <?php for($x=0;$x<12;$x++){ ?>
    	<li>
        	<img src="http://cdn.pimg.co/p/230x208/858652/fff/img.png" class="imgscontrol" /> 
            <div class="imgwrapper">
            	<div class="imgcontainer"> 
                	<div class="moviedetails">
                        <h5>فيلم :رمضان مبروك أبو العالمين</h5> 
                        <h5>بطولة:محمد هنيدى - سرين عبد النور</h5>
                         <h5>إخراج:أحمد البدرى</h5>
                  </div>
				</div>
            	
             </div>
        </li> 
        <? } ?>
    </ul>
    
</div>

<?php
//Start of Sub sections here
//if($current_section_have_children_flag == true):
?>
<div class="white_background_color"  >

	
<div class="clear"></div>
</div><!-- End of sub sections margin -->
<div class="clear"></div>


<div style="width:100%;" class="global_sperator_height"></div>
<div class="various_title_videos <?php echo $current_section_background_color ?>" style="height:40px; position:relative;width: 105%;margin-left: -25px;">
	<div class="sections_wrapper_margin">
		<div class="title float_left" style="color: white;font-size: 24px;">الأعلى إيرادات</div>
    </div>
    <img width="26" style="position:absolute; left:0; top:40px;" src="<?php echo base_url(); ?>images/<?php echo $this->router->class; ?>_left_shadow.png"/>
    <img width="26" style="position:absolute; right:0; top:40px;" src="<?php echo base_url(); ?>images/<?php echo $this->router->class; ?>_right_shadow.png"/>
    
   </div>
   
<div class="white_background_color ">
	<div class="recent_items_list_wrapper global_background" style="height:270px;">

    <div class="sections_wrapper_margin" style="padding-top: 10px;" >
    
	
    
        <a class="recentitem_prev float_right" style="cursor:pointer;"><img src="<?php echo base_url()?>images/icons/right_arrow_color.png" /></a>
        <a class="recentitem_next float_left" style="cursor:pointer;"><img src="<?php echo base_url()?>images/icons/left_arrow_color.png" /></a>
     
      <ul id="best_time_lists_film_slide">
    <?php for($x=0;$x<4;$x++){ ?>
    	<li>
        	<img src="http://cdn.pimg.co/p/202x170/858652/fff/img.png" class="imgscontrol" /> 
            <div class="imgwrapper">
            	<div class="imgcontainer"> 
                	<div class="moviedetails">
                        <h5>فيلم :رمضان مبروك أبو العالمين</h5> 
                        <h5>بطولة:محمد هنيدى - سرين عبد النور</h5>
                         <h5>إخراج:أحمد البدرى</h5>
                  </div>
				</div>
            	
             </div>
        </li> 
        <? } ?>
    </ul> 
            
        </ul>

    
    </div><!--- End of recent_items_list -->

</div>

<?php
//End of sub sections here
//endif;
?>

















<div class="clear"></div>