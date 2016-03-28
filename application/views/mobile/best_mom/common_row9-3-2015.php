<div class="container">
  <div class="row">
    <div class="col-xs-6">
      <?php
               // echo $this->mwidgets->drawSubSectionBox(lang('bestmom_ask_an_expert'), "http://placehold.it/800x400&text=Image");
                ?>
      <!-- <div class="section-title-wrapper">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="text-color">خدمة البريد الالكتروني</h2>
                        </div>
                    </div> 
                </div> -->
      <?php $this->mwidgets->ask_an_expert(179,$current_section_color,$current_language_db_prefix,$ask_an_expert_top_banner);?>
    </div>
    <!--<div class="col-xs-6">
      <?php ?>
<!--      <div class="section-title-wrapper">
        <div class="row">
          <div class="col-xs-12">
            <h2 style="border-bottom: 5px solid;
padding: 5px 0px;margin-bottom:10px;" class="text-color">خدمة البريد الالكتروني</h2>
          </div>
          <!--                        <div style="background: #ffc81b;width:100% height:4px;" class="thick_line best_mom_background_color"></div>
                       <h3 style="font-size:2vw;"><?php //echo lang("bestmom_news_letter_signup_desc"); ?></h3>--> 
          
      <!--  </div>
      </div>-->
      <?php 
               //echo $this->mwidgets->drawSubSectionBox(lang('bestmom_news_letter_signup'));
			  //echo $this->mwidgets->drawSubSectionBox(lang('bestmom_news_letter_signup'), "style='background:red;'");  
?>
   <!-- </div>-->
    <div class="col-xs-6">
          <div class="section-title-wrapper">
            <h2  class="text-color">خدمة البريد الالكتروني</h2>
        </div>
        <div class="cont_ainer">
         <h3 style="font-size:15px;"><?php echo lang("bestmom_news_letter_signup_desc"); ?></h3>
         
          <?php

			for($i = 0 ; $i < sizeof($display_newsletter) ; $i++):
			$id = $display_newsletter[$i]['newsletter_types_ID'];
			$title = $display_newsletter[$i]['newsletter_types_title'.$current_language_db_prefix];
			//$image =  base_url()."images/icons/".$display_newsletter[$i]['images_src'];
			$image =  base_url()."uploads/icons/".$this->globalmodel->get_image_src($display_newsletter[$i]['newsletter_types_image']);
			
			?>   
         <div style="width:60%; margin:0 auto; height:100px; background:#339153;">        
         <ul>
      
      
      
      
      
       	<li class="float_left newsletter_button" >
                	<a class="newsletter_choices_button" href="<?php echo site_url("newsletter/add_to_newsletter/".$id); ?>" data-id="<?php echo $i; ?>" data-selected = "0" >
                	<div class="logo"><img width="60" height="60" style="border:none" src="<?php echo $image; ?>" /></div>
                    <div class="text"><?php echo $title;?></div>
                    </a>
                </li>

            <?php
			endfor;
			?>
      
      
      
      
      
<!--         <li class="float_left newsletter_button" style="margin:0 auto;" >hassan</li>
         <li class="float_left newsletter_button" style="margin:0 auto;">hassan</li>-->
         </ul>
         </div> 
       </div>
        </div>
      <!-- End of newsletter_signin --> 
    </div>
  <!-- row --> 
</div>
<!-- container -->