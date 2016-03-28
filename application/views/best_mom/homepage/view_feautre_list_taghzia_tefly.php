<div id="feat_list_taghzia_tefly" class="feat_lists_with_tab">
		<div style="border-top: 2px solid #ffc81b;border-bottom: 2px solid #ffc81b;border-left: 2px solid #ffc81b;position: absolute;width: 170px;height: 179px;top: 5px;">
        </div>
        
      <ul class="ui-tabs-nav">
       <?php
  
        $list = $this->sectionsmodel->get_children_sections(71 , 'articles');

        for($i=0; $i < sizeof($list) ; $i++):

        ?>

        <li class="ui-tabs-nav-item" id="nav-fragment-<?php echo ($i+1);?>">
            <a href="#fragment-<?php echo ($i+1);?>">
                <h2 class="float_left black_color" style="font-size: 13px;padding: 12px 10px;"><?php echo $list[$i]['sub_sections_name'.$current_language_db_prefix] ?></h2>
            </a>
        </li>

        <?php
        endfor;
        ?>
      
      </ul>

		<?php 
        
        $articles_list = $this->sectionsmodel->get_children_sections(71 , 'articles');
        for($i=0; $i < sizeof($list) ; $i++):
        
        $featured_articles = $this->articlesmodel->get_most_read_articles(2 , $articles_list[$i]['sub_sections_ID']);

        ?>
        <div id="fragment-<?php echo ($i+1);?>" class="ui-tabs-panel" style="">

            <?php
            $image_url = $this->config->item('articles_img_link');
			if( empty($featured_articles) )
			echo '<p style="padding:15px; text-align:center">لا يوجد مقالات في هذا القسم</p>';
            for($j=0; $j < sizeof($featured_articles) ; $j++):
                $id = $featured_articles[$j]['articles_ID'];
                $title = $featured_articles[$j]['articles_title'.$current_language_db_prefix];
                $desc = $featured_articles[$j]['articles_brief'.$current_language_db_prefix];
                $brief = substr(strip_tags($desc), 0, 150). (strlen(strip_tags($desc)) > 150?'...':'');
                $image  = $image_url.$featured_articles[$j]['images_src'];
				$url = site_url($this->router->class."/inner_articles/".generateSeotitle($id ,$title ));

            ?>
                <div class="panel_wrapper"   >
                    <div class="image float_left">
                    	<a href="<?php echo $url ?>"><img src="<?php echo $image; ?>"  />
                        <div class="title_wrapper global_background" >
                        	<div style="margin:12px;">
                            	<h3><?php echo $title ?></h3>
                                <div class="float_right">
                                    <div class="triangle <?php echo $current_section_borderbottom_color ?>"></div>
                                    <div class="plus_sign white_color"><a href="<?php //echo site_url("best_cook/recipes_list/".$display_inseason_topic[0]['inseason_recipies_ID']); ?>">+</a></div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    	</a></div>
                </div>
                
                
                
            <?
            endfor;
            ?>
             
        </div>
        <?php
        endfor;
        ?>

	</div>