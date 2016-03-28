
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <?php
				//list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(178,$current_language_db_prefix);
               // echo $this->mwidgets->drawSubSectionBox($subsectionTitle, "http://placehold.it/800x400&text=Image");
			   $this->mwidgets->ask_an_expert(178,$current_section_color,$current_language_db_prefix,$ask_an_expert_top_banner);
                ?>
              </div> 
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <?php
				$url = site_url("mobile/best_cook/applications/2");
				echo $this->mwidgets->drawSubSectionBox(lang('Cooking_Class'), base_url()."uploads/cooking_classes/ashter_tba5a_ar_new.png", $url);
                ?>
            </div>
        </div><!-- row -->        
