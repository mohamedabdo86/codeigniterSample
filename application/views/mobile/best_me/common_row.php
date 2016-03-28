
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <?php
				//list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(181,$current_language_db_prefix);
               // echo $this->mwidgets->drawSubSectionBox($subsectionTitle, "http://placehold.it/800x400&text=Image" , site_url_mobile(''.$this->router->class.'/ask_an_expert') );
			    $this->mwidgets->ask_an_expert(181,$current_section_color,$current_language_db_prefix,$ask_an_expert_top_banner);
                ?>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"> 
    <!-- Swiper -->
    <?php
    list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(31,$current_language_db_prefix);
     echo $this->mwidgets->drawSubSectionBox_title($subsectionTitle);
	 ?>
    <?php 
      //list($subsectionID,$subsectionImage,$subsectionExtra) = getSectiondata(31,$current_language_db_prefix);
      echo $this->mwidgets->drawSectionVideos();
      ?>
  </div>
</div>
<!-- row --> 
