<!--<div class="container">-->
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <?php
        
        list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(187,$current_language_db_prefix);
		$featArticle = $this->articlesmodel->get_feautred_articles($subsectionID);
		$linkToSection = site_url_mobile(''.$this->router->class.'/section/'.$subsectionID);
		$linkToArticle = site_url_mobile(''.$this->router->class.'/inner_articles/'.$featArticle[0]['articles_ID']);
       
	    echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle, $this->config->item("articles_img_link").$featArticle[0]['images_src'], $featArticle[0]['articles_title'.$current_language_db_prefix],$linkToSection,$linkToArticle);
        ?>
        </div>
      
<?php /*?>   <div class="col-xs-6">
            <?php
			print_r($display_besttime_quiz);
		    foreach($display_besttime_quiz as $quiz_details){
			$quiz_id = $quiz_details['quizes_ID'];
			$image_url = base_url()."uploads/quizes/";
			$quiz_img = $image_url. $quiz_details['images_src'];
			$quiz_title = $quiz_details['quizes_title'.$current_language_db_prefix];
			}
$linkToArticle = site_url_mobile(''.$this->router->class.'/quiz/'.$quiz_id);
		//$linkToSection = site_url_mobile(''.$this->router->class.'/section/'.$subsectionID);
		
        echo $this->mwidgets->drawSubSectionBox($subsectionTitle, $quiz_img ,$quiz_title,$linkToArticle);
			
            ?>
        </div><?php */?>
        
        
        
        
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <?php 
		
		for($i=0;$i<sizeof($display_besttime_quiz);$i++):
		
		
		//echo '<p style="padding:15px; text-align:center">لا يوجد مقالات في هذا القسم</p>';
		
		$id = $display_besttime_quiz[0]['quizes_ID'];
		$title = $display_besttime_quiz[$i]['quizes_title'.$current_language_db_prefix];
		$image_url = base_url()."uploads/quizes/";
		$image  = $image_url.$display_besttime_quiz[0]['images_src'];
		$url = site_url("best_time/quiz/".$id);
		$section_url = site_url("best_time/quiz");
	
		list($subsectionID,$subsectionTitle,$subsectionExtra) = getSectiondata(186,$current_language_db_prefix);//Easy Tips
		$allQuizes = $this->quizesmodel->get_quizes('quiz',1,0 ,$current_language_db_prefix);
		$linkToSection = site_url_mobile(''.$this->router->class.'/quiz/');
		$linkToArticle = site_url_mobile(''.$this->router->class.'/quiz/'.$id);
        echo $this->mwidgets->drawSubSectionHomepageArticle($subsectionTitle,$image, $title,$linkToSection,$linkToArticle);
			endfor;
		?>
        
        </div>
        
        
        
        
        
  
    </div><!-- row -->
<!--</div>--><!-- container -->