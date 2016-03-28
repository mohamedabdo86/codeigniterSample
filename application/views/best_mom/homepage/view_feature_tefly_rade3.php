


<?php
$id_tag_string = 'feat_list_tansh2t_tefly';

?>


<div class="feat_lists_with_tab" id="<?php echo $id_tag_string ?>">
		<div class="border_fix_for_tab <?php echo $current_section_border_color ?> " >
        </div>
        
      <ul class="ui-tabs-nav">
       <?php
  		unset($list);
        $list = $CI->sectionsmodel->get_children_sections($subsection_id , 'articles');

        for($i=0; $i < sizeof($list) ; $i++):

        ?>

        <li class="ui-tabs-nav-item" id="nav-fragment-<?php echo ($i+1);?>">
            <a href="#fragment-<?php echo ($i+1);?>" class="<?php echo $current_section_borderbottom_color;?>">
                <h2 class="float_left black_color" ><?php echo $list[$i]['sub_sections_name'.$current_language_db_prefix] ?></h2>
            </a>
        </li>

        <?php
        endfor;
        ?>
      
      </ul>

		<?php 
        
        $articles_list = $CI->sectionsmodel->get_children_sections($subsection_id , 'articles');
        for($i=0; $i < sizeof($list) ; $i++):
        
        $featured_articles = $CI->articlesmodel->get_most_read_articles(2 , $articles_list[$i]['sub_sections_ID']);

        ?>
        <div id="fragment-<?php echo ($i+1);?>" class="ui-tabs-panel" style="">

            <?php
            $image_url = "https://www.mynestle.com.eg/images/Articles/";
			if( empty($featured_articles) )
			echo '<p style="padding:15px; text-align:center">لا يوجد مقالات في هذا القسم</p>';
            for($j=0; $j < sizeof($featured_articles) ; $j++):
                $id = $featured_articles[$j]['articles_ID'];
                $title = $featured_articles[$j]['articles_title'.$current_language_db_prefix];
                $desc = $featured_articles[$j]['articles_brief'.$current_language_db_prefix];
                $brief = substr(strip_tags($desc), 0, 150). (strlen(strip_tags($desc)) > 150?'...':'');
                $image  = $image_url.$featured_articles[$j]['images_src'];
                $url = site_url($CI->router->class."/inner_articles/".$id);

            ?>
                <div class="panel_wrapper" >
                    <div class="image float_left" style="padding:5px; position:relative;">
                    	<a href="<?php echo $url ?>"><img src="<?php echo $image; ?>" width="323" height="183" />
                        <div class="title_wrapper global_background" >
                        	<div style="margin:5px;">
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





<?php /*?>
        <div class="float_left" style="width:495px;">
            <div class="section_title_right float_left <?php echo $current_section_background_color; ?>"><div class="skew_right white_color <?php echo $current_section_background_color; ?>"><h3>صحة طفلى</h3></div></div>
            <div class="section_title_left float_right <?php echo $current_section_background_color; ?>"><div class="skew_left white_color <?php echo $current_section_background_color; ?>"><h3>كل ما تحتاجين معرفتة عن صحة طفلك</h3></div></div>
            <div class="clear"></div>
            
           <?php //$this->load->view('best_mom/homepage/view_feautre_list_taghzia_tefly');   ?>
           <?php $this->widgets->generate_tab_lists_with_except('feat_list_se7et_tefly',64,$current_language_db_prefix,$current_section_border_color,$current_section_borderbottom_color,84);   ?>

            
        </div><!-- End of width:495px; -->
        
        

    
    <div class="float_right" style="width:495px;">

        <div class="section_title_right float_left <?php echo $current_section_background_color; ?>"><div class="skew_right white_color <?php echo $current_section_background_color; ?>"><h3>الابوان</h3></div></div>
    	<div class="section_title_left float_right <?php echo $current_section_background_color; ?>"><div class="skew_left white_color <?php echo $current_section_background_color; ?>"><h3>كل ما تحتاجين معرفته عن العناية بطفلك</h3></div></div>
   		<div class="clear"></div>
        
        <?php //$this->load->view('best_mom/homepage/view_feautre_list_3enaya_tefly');   ?>
        <?php $this->widgets->generate_tab_lists('feat_list_el_abwan',84,$current_language_db_prefix,$current_section_border_color,$current_section_borderbottom_color);   ?>

    
    </div><?php */?>