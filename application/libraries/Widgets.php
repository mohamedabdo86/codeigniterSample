<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Widgets
{
	public function generate_tab_lists($id_tag_string,$subsection_id,$current_language_db_prefix,$current_section_border_color,$current_section_borderbottom_color)
    {
		
		$CI =& get_instance();
		$CI->load->model('sectionsmodel'); 
		$CI->load->model('articlesmodel'); 
		
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
                <h2 class="float_left black_color" style="text-align:left" ><?php echo $list[$i]['sub_sections_name'.$current_language_db_prefix]; ?></h2>
            </a>
        </li>

        <?php
        endfor;
        ?>
      
      </ul>

		<?php 
        
        $articles_list = $CI->sectionsmodel->get_children_sections($subsection_id , 'articles');
        for($i=0; $i < sizeof($list) ; $i++):
        
        $featured_articles = $CI->articlesmodel->get_most_read_articles(1 , $articles_list[$i]['sub_sections_ID']);

		$current_subsection_id = $articles_list[$i]['sub_sections_ID'];
        ?>
        <div id="fragment-<?php echo ($i+1);?>" class="ui-tabs-panel" style="">

            <?php
            $image_url = $CI->config->item('articles_img_link');
			if( empty($featured_articles) )
			echo '<p style="padding:15px; text-align:center"> '.lang('globals_No_articles_in_this_section').'</p>';
            for($j=0; $j < sizeof($featured_articles) ; $j++):
                $id = $featured_articles[$j]['articles_ID'];
                $title = $featured_articles[$j]['articles_title'.$current_language_db_prefix];
                $desc = $featured_articles[$j]['articles_brief'.$current_language_db_prefix];
                $brief = mb_substr(strip_tags($desc), 0, 150, 'UTF-8'). (strlen(strip_tags($desc)) > 150?'...':'');

				$short_title = mb_substr(strip_tags($title), 0,35, 'UTF-8'). (strlen(strip_tags($title)) >35?'...':'');

                $image  = $image_url.$featured_articles[$j]['images_src'];
                $url = site_url($CI->router->class."/inner_articles/".generateSeotitle($id ,$title ));
				$section_url = site_url($CI->router->class."/section/".$current_subsection_id);

            ?>
                <div class="panel_wrapper" >
                    <div class="image float_left">
                    <a href="<?php echo $url;?>" title="<?php echo $title; ?>"><img alt="<?php echo $title;?>" style="border:none;" src="<?php echo $image; ?>" width="323" height="183" />
                        <div class="title_wrapper global_background" >
                        	<div style="margin:5px;min-height: 30px;">
                            	<h3><?php echo $short_title ?></h3>
                                <div class="float_right">
                                    <div class="triangle <?php echo $current_section_borderbottom_color ?>"></div>
                                    <div class="plus_sign white_color"><a href="<?php echo $section_url ?>">+</a></div>
                                
                                    <div class="clear"></div>
                              </a>  </div>
                            </div>
                        </div>
                    	</div>
                </div>
                
            <?
            endfor;
            ?>
             
        </div>
        <?php
        endfor;
        ?>

	</div>
        <?php

    }
	
	//ashraf add nestle_fit date_picker
	
	public function nestle_fit_picker($start_date,$current_url)
	{
		?>
        <link rel="stylesheet" href="<?php echo base_url()."css/jquery-ui.css"?>">
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        
	   <script type="text/javascript">
       $(document).ready(function(e) {
           var start_date = $('#start_date').val();
              $("#datepicker").datepicker({
                showOn: "button",
                buttonImage: "<?php echo base_url()."images/nestle_fit/calendar.png"; ?>",
                buttonImageOnly: true,
                buttonText: "<?php echo lang('fit_select_date'); ?>",
                minDate: new Date(start_date),
                maxDate: "0d",
                changeMonth: false,
                changeYear: false,
                dateFormat:'yy-mm-dd',
                
              });

        });
		 function getselecteddate(currnturl)
			   {
	            var date=$('#datepicker').val();
				//alert(date);
	            var redirect_url= currnturl + "/" + date;
	    	    window.location = redirect_url;
	           }

        </script>
        <input class="form_input_larg datepicker nestle_fit_picker" id="datepicker" name="date1" value="" type="hidden" onchange="getselecteddate('<?php echo $current_url;?>')" />
        <input type="hidden" id="start_date" style="direction:ltr" name="start_date" value="<?php echo $start_date;?>"  />
		<?php 
		
	}
	
	/*Over Ride*/
	public function generate_tab_lists_with_except($id_tag_string,$subsection_id,$current_language_db_prefix,$current_section_border_color,$current_section_borderbottom_color,$except)
    {
		
		$CI =& get_instance();
		$CI->load->model('sectionsmodel'); 
		$CI->load->model('articlesmodel'); 
		
		?>
        <div class="feat_lists_with_tab" id="<?php echo $id_tag_string ?>">
		<div class="border_fix_for_tab <?php echo $current_section_border_color ?> " >
        </div>
        
      <ul class="ui-tabs-nav">
       <?php
  		unset($list);
        $list = $CI->sectionsmodel->get_children_sections_with_except($subsection_id , 'articles' ,$except);

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
        
        $articles_list = $CI->sectionsmodel->get_children_sections_with_except($subsection_id , 'articles',$except);
        for($i=0; $i < sizeof($list) ; $i++):
        
        $featured_articles = $CI->articlesmodel->get_most_read_articles(1 , $articles_list[$i]['sub_sections_ID']);

        ?>
        <div id="fragment-<?php echo ($i+1);?>" class="ui-tabs-panel" style="">

            <?php
            $image_url = $this->config->item('articles_img_link');
			if( empty($featured_articles) )
			echo '<p style="padding:15px; text-align:center"> '.lang('globals_No_articles_in_this_section').'</p>';
            for($j=0; $j < sizeof($featured_articles) ; $j++):
                $id = $featured_articles[$j]['articles_ID'];
                $title = $featured_articles[$j]['articles_title'.$current_language_db_prefix];
                $desc = $featured_articles[$j]['articles_brief'.$current_language_db_prefix];
                $brief = mb_substr(strip_tags($desc), 0, 150, 'utf-8'). (strlen(strip_tags($desc)) > 150?'...':'');
                $image  = $image_url.$featured_articles[$j]['images_src'];
                $url = site_url($CI->router->class."/inner_articles/".generateSeotitle($id,$title));

            ?>
                <div class="panel_wrapper" >
                    <div class="image float_left">
                    	<a href="<?php echo $url ?>" title="<?php echo $title?>"><img  alt="<?php echo $title?>" style="border:none;" src="<?php echo $image; ?>" width="323" height="183" />
                        <div class="title_wrapper global_background" >
                        	<div style="margin:5px;padding: 7px 0;">
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
        <?php

    }
	
	public function generate_tab_list_articles($id_tag_string,$subsection_id,$current_language_db_prefix,$current_section_border_color,$current_section_borderbottom_color)
    {
		
		
		$CI =& get_instance();
		$CI->load->model('articlesmodel'); 
		
		 unset($list);
    
		$list = $CI->articlesmodel->get_most_read_articles(4 , $subsection_id);
		?>
        <div class="feat_lists_with_tab" id="<?php echo $id_tag_string ?>">
        <?php 
		if($list)
		{
			echo '<div class="border_fix_for_tab '.$current_section_border_color.' " ></div>';
		}
		
		?>
		
        
      <ul class="ui-tabs-nav">
       <?php


        for($i=0; $i < sizeof($list) ; $i++):
		

        ?>

        <li class="ui-tabs-nav-item" id="nav-fragment-<?php echo ($i+1);?>">
            <a href="#fragment-<?php echo ($i+1);?>" class="<?php echo $current_section_borderbottom_color;?>">
                <h2 class="float_left black_color" ><?php echo $list[$i]['articles_title'.$current_language_db_prefix] ?></h2>
            </a>
        </li>

        <?php
        endfor;
        ?>
      
      </ul>

		<?php 
        if( empty($list) )
		echo '<p style="padding:15px; text-align:center;width: 466px;"> '.lang('globals_No_articles_in_this_section').'</p>';
        for($i=0; $i < sizeof($list) ; $i++):
        
        $featured_articles = $CI->articlesmodel->get_detailed_articles($list[$i]['articles_ID']);

        ?>
        <div id="fragment-<?php echo ($i+1);?>" class="ui-tabs-panel" style="">

            <?php
            $image_url = $CI->config->item('articles_img_link');
			
            for($j=0; $j < sizeof($featured_articles) ; $j++):
                $id = $featured_articles[$j]['articles_ID'];
                $title = $featured_articles[$j]['articles_title'.$current_language_db_prefix];
                $desc = $featured_articles[$j]['articles_brief'.$current_language_db_prefix];
                $brief = mb_substr(strip_tags($desc), 0, 150, 'UTF-8'). (strlen(strip_tags($desc)) > 150?'...':'');
				$short_title = mb_substr(strip_tags($title), 0, 40, 'UTF-8'). (strlen(strip_tags($title)) > 40?'...':'');
                $image  = $image_url.$featured_articles[$j]['images_src'];
                $url = site_url($CI->router->class."/inner_articles/".generateSeotitle($id,$title));
				
				if($current_language_db_prefix == '_ar')
				{
					$short_title = mb_substr(strip_tags($title), 0, 70, 'UTF-8'). (strlen(strip_tags($title)) > 70?'...':'');
				}
				else
				{
					$short_title = mb_substr(strip_tags($title), 0, 40, 'UTF-8'). (strlen(strip_tags($title)) > 40?'...':'');
				}

            ?>
                <div class="panel_wrapper" >
                    <div class="image float_left">
                    	<a href="<?php echo $url ?>"><img style="border:none" src="<?php echo $image; ?>" width="323" height="183" />
                        <div class="title_wrapper global_background" >
                        	<div style="margin: 0 8px;height: 47px;">
                            	<h3><?php echo $short_title ?></h3>
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
        <?php


    }

	
	public function generate_ask_an_expert($ask_an_expert_id,$current_section_color,$current_section_border_color,$current_section_background_color,$display_data,$display_expert,$current_language_db_prefix)
	{
		$CI =& get_instance();
		
		$ask_an_expert_url = site_url($CI->router->class."/ask_an_expert");
		
		?>
        <div class="float_left home_widget inner_applications_bestcook_width" >
		<div class="sections_wrapper_margin ">
            <div class="title <?php echo $current_section_border_color; ?> regular_widget_border_width">
                <div class="float_left" style="margin:0">
                <?php
						
					//Ask an expert id : 147
					list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata($ask_an_expert_id,$current_language_db_prefix);
						?>
                    <div class="<?php echo $current_section_color; ?> " style="margin: 10px 5px;font-size: 18px;line-height: 20px;"><?php echo $subsection_title; ?></div>
                    <?php if($ask_an_expert_id != 179)
					{
						echo '<div style="font-size:10px; margin:3px 10px">'. $display_expert[0]['static_name'.$current_language_db_prefix].'</div>';
					}
					?>
                </div>
                <div class="float_right" style="width:75px; height:63px;" >
                <?php if($ask_an_expert_id != 179)
				{
					echo '<img style="border:none;top: -6px;position: relative; height:69px;" src="'. base_url().'uploads/slideshows/'.$display_expert[0]['images_src'].' "/>';
				}
				?>
                </div>
                <div class="clear"></div>
                <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
            </div>
        </div>
        
        <div style="width:320px;background:#fff3cb;width: 320px;height: 228px;background: #fff3cb;margin-top: 67px;-webkit-border-bottom-right-radius: 20px;-webkit-border-bottom-left-radius: 20px;-moz-border-radius-bottomright: 20px;-moz-border-radius-bottomleft: 20px;border-bottom-right-radius: 20px;border-bottom-left-radius: 20px;">
            <div style="margin: 7px 10px;position: relative;white-space: normal;">
            
                    <?php /*?><a style="position: absolute;bottom: -30px;right: 50%;" class="ask_an_expert_recentitem_prev"><img src="<?php echo base_url()."images/arrow_to_left_white_small.png" ?>" /></a>
                    <a style="position: absolute;bottom: -30px;left: 50%;" class="ask_an_expert_recentitem_next "><img src="<?php echo base_url()."images/arrow_to_right_white_small.png" ?>" /></a><?php */?>
                    <div class="ask_an_expert_lists">
                    <ul>
                    <?php
					if(!empty($display_data)){
                    for($i=0; $i < sizeof($display_data);$i++):
                        $question = strip_tags( $display_data[$i]['ask_expert_question'.$current_language_db_prefix] );
                        $answer = $display_data[$i]['ask_expert_answer'.$current_language_db_prefix];
                        $brief_answer = mb_substr(strip_tags($answer, '<div>,<ol>,<li>,<ul>'), 0, 230, 'utf-8'). (strlen(strip_tags($answer)) > 230?'...':'');
                    ?>
                    <li style="height:160px;">
                        <h3 class="white_color" style="padding-bottom:5px; margin-bottom:5px; color:#2f2f2f"><?php echo $question ?></h3>
                        <div class="dir" style="color:#2f2f2f; background:#fffaeb; padding:5px;font-size: 13px;line-height: 20px;"><?php echo $brief_answer ?></div>
                    </li>
                    <?php
                    endfor;
					}else{
						?>
                        <li style="height:160px;">
                        	<h3 class="white_color" style="padding-bottom:5px; margin-bottom:5px; color:#2f2f2f"></h3>
                        	<p style="color: #2f2f2f;background: #fffaeb;padding: 40px 10px; text-align: center;margin-top: 50px;"><?php echo lang('globals_ask_expert_no_questions'); ?></p>
                        </li>
                        <?php
					}
                    ?>
                    </ul>
                </div>
               <?php /*?> <small><a class="float_right <?php echo $current_section_color ?>" href="<?php echo $ask_an_expert_url ?>"><?php echo lang("globals_more"); ?></a></small><?php */?>
            
            
            </div>
        </div>
        
        <div class="ask_an_expert_bottom_button left <?php echo $current_section_background_color ?>"  ><a style="line-height: 22px;" href="<?php echo $ask_an_expert_url ?>"><?php echo lang("globals_questions_and_answers"); ?></a></div>
        
        <div class="ask_an_expert_bottom_button right <?php echo $current_section_background_color ?>" ><a style="line-height: 22px;" href="<?php echo $ask_an_expert_url ?>"><?php echo lang("globals_ask_her"); ?></a></div>	
        
        </div><!-- End of ask the expert  widget-->
        <?php 
		
	}
	
	public function generate_featured_article($subsection_title,$display_data,$current_section_color,$current_section_background_color,$current_section_borderbottom_color,$current_language_db_prefix)
	{
		
		$CI =& get_instance();

		?>
        <div class="widgets_featured_article">
        <!--Title Left-->
        <div class="inner_title_wrapper">
            <div class="sections_wrapper_margin">
                <h1 class="<?php echo $current_section_color; ?>"><?php echo $subsection_title;?></h1>
            </div>
        </div>
        <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
        
        <?php
        for($i=0 ;$i<sizeof($display_data); $i++):
    
            $image_url = $CI->config->item('articles_img_link');
            if(empty($display_data))
            echo '<p style="padding:15px; text-align:center"> '.lang('globals_No_articles_in_this_section').'</p>';
    
            $id = $display_data[$i]['articles_ID'];
            $section_id = $display_data[$i]['articles_sections_ID'];
            $title = $display_data[$i]['articles_title'.$current_language_db_prefix];
            $image  = $image_url.$display_data[$i]['images_src'];
            $url = site_url($CI->router->class."/inner_articles/".generateSeotitle($id,$title));
            $section_url = site_url($CI->router->class."/section/".$section_id);
        ?>
       <a href="<?php echo $url; ?>" title="<?php echo $title?>"><img style="border:none;" width="495" height="360" src="<?php echo $image; ?>" alt="<?php echo $title?>"/></a>
    
        
        <div class="desc_wrapper global_background" >
            <div style="margin: 0 8px;height: 40px;">
                <a href="<?php echo $url; ?>"><h3 class="float_left"><?php echo $title; ?></h3></a>
                <div class="float_right">
                    <div class="triangle <?php echo $current_section_borderbottom_color ?>"></div>
                    <div class="plus_sign white_color"><a href="<?php echo $section_url; ?>">+</a></div>
                    <div class="clear"></div>
                </div>
            </div>
        </div><!-- .desc_wrapper -->
    
    <?php
	endfor;
	?>
	</div>
		<?
		
	}
	
	public function generate_tow_featured_article($subsection_id,$subsection_title,$id_tag_string,$current_section_color,$current_section_background_color,$current_section_borderbottom_color,$current_section_background_color_featured_title,$current_language_db_prefix)
	{
		
		$CI =& get_instance();
		$CI->load->model('sectionsmodel'); 
		$CI->load->model('articlesmodel'); 
		

		?>
        <script type="text/javascript">
		$(document).ready(function(e) {
			// "ul li:nth-child(2)
            $('.widgets_inner_featured_article ul.ui-tabs-nav li.ui-tabs-nav-item:nth-child(1)').children(".skew").addClass('skew_left');
            $('.widgets_inner_featured_article ul.ui-tabs-nav li.ui-tabs-nav-item:nth-child(2)').children(".skew").addClass('skew_right');
            $('.widgets_inner_featured_article ul.ui-tabs-nav li.ui-tabs-nav-item:nth-child(2)').addClass('float_right');

        });
        </script>
        <div class="widgets_featured_article <?php echo $id_tag_string; ?>">
        <!--Title Left-->
        <div class="inner_title_wrapper">
            <div class="sections_wrapper_margin">
                <h1 class="<?php echo $current_section_color; ?>"><?php echo $subsection_title;?></h1>
            </div>
        </div>
        <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
        
        <div class="widgets_inner_featured_article" id="<?php echo $id_tag_string;?>">
        <ul class="ui-tabs-nav direction">
       <?php
  		unset($list);
        $list = $CI->sectionsmodel->get_children_sections($subsection_id , 'articles');

        for($i=0; $i < sizeof($list) ; $i++):

        ?>
        

        <li class="ui-tabs-nav-item float_left white_background_color_soft" id="nav-fragment-<?php echo ($i+1);?>">
            <div class="skew white_color white_background_color_soft"> <!--echo $current_section_background_color_featured_title;-->
                <a href="#fragment-<?php echo ($i+1);?>" class="<?php echo $current_section_borderbottom_color;?>">
                    <h3 class="float_left <?php echo $current_section_color; ?>"><?php echo $list[$i]['sub_sections_name'.$current_language_db_prefix] ?></h3>
                </a>
            </div>
        </li>

        <?php
        endfor;
        ?>
      
      </ul>
      
      <?php
      
	    $articles_list = $CI->sectionsmodel->get_children_sections($subsection_id , 'articles');
        for($i=0; $i < sizeof($list) ; $i++):
        
        $featured_articles = $CI->articlesmodel->get_random_articles(3 , $articles_list[$i]['sub_sections_ID']);
		?>
		<div id="fragment-<?php echo ($i+1);?>" class="ui-tabs-panel global_background" style="height: 330px;">

            <?php
            $image_url = $CI->config->item('articles_img_link');
			if( empty($featured_articles) )
			echo '<p style="padding:15px; text-align:center"> '.lang('globals_No_articles_in_this_section').'</p>';
            for($j=0; $j < sizeof($featured_articles) ; $j++):
                $id = $featured_articles[$j]['articles_ID'];
                $title = $featured_articles[$j]['articles_title'.$current_language_db_prefix];
                $desc = $featured_articles[$j]['articles_brief'.$current_language_db_prefix];
				$views = $featured_articles[$j]['articles_views'];
				
				$short_title = $CI->common->limit_text($title,40);
				$brief = $CI->common->limit_text($desc,100);

                $image  = $image_url.$CI->config->item('image_prefix').$featured_articles[$j]['images_src'];
                $url = site_url($CI->router->class."/inner_articles/".generateSeotitle($id,$title));

            ?>
            
            <div style="width: 98%;padding: 5px;height: 100px;" class="panel_wrapper">
                <div class="image float_left"><a href="<?php echo $url ?>" title="<?php echo $title;?>"><img style="width: 105px;height: 91px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;border: 1px solid #E0E0E0;" src="<?php echo $image; ?>" alt="<?php echo $title;?>"></a></div>
                <div style="width:5px; height:85px;" class="float_left"></div>
                <div class="title float_left" style="width: 370px;">
                    <h3 ><a href="<?php echo $url ?>"><?php echo $short_title ?></a></h3>
                    <p style="line-height: 17px;font-size: 12px;font-weight: normal; white-space:normal;margin: 5px 0;"><?php echo $brief;?></p>
                    <span style="line-height: 21px;font-size: 12px;" class="dark_gray float_left" ><?php echo lang('globals_views')." ( ".$views." ) ";?></span>

                    <div class="clear"></div>
                </div>
                
                <div class="clear"></div>
            </div>
            <?
            endfor;
            ?>
        </div>
		<?
		endfor;
	  	?>
      </div>
 	</div>
		<?
		
	}
	
	public function generate_featured_inseasontopic($subsection_id,$subsection_title,$subsection_extra_title,$display_data,$display_extra_data,$current_section_color,$current_section_background_color,$current_section_borderbottom_color,$current_language_db_prefix)
	{
		
		
		$CI =& get_instance();
		$CI->load->model('recipesmodel'); 
         $inseason_topics=site_url($CI->router->class."/inseason_topics/");
		?>
        <div class="widgets_featured_article home_widget ">
        <!--Title Left-->
        <div class="inner_title_wrapper">
            <div class="sections_wrapper_margin">
                <a href="<?php echo $inseason_topics;?>"><h1 class="float_left <?php echo $current_section_color; ?>" style="font-size:16px;"><?php echo $subsection_title;?></h1></a>
                <div class="float_right second_title gray_color">
                        <span style="position:relative;bottom:-18px;font-size:18px; font-weight:bold;"  >&#8220;</span>
                        <small style="font-size:12px; font-weight:bold;"><?php echo $subsection_extra_title;?></small>
                        <span style="position:relative; top:-5px;font-size:18px; font-weight:bold;">&#8221;</span>
               </div>
               <div class="clear"></div>
            </div>
        </div>
        <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
        
        <?php
      //  for($i=0 ;$i<sizeof($display_data); $i++):
    
            $image_url = $CI->config->item('recipes_img_link');
			
            if(empty($display_data))
          echo '<p style="padding:15px; text-align:center"> '.lang('globals_No_articles_in_this_section').'</p>';
    
            $id = $display_data[0]['inseason_recipies_ID'];
           // $section_id = $display_data[$i]['articles_sections_ID'];
            $title = $display_data[0]['inseason_recipies_title'.$current_language_db_prefix];
			
			$get_random_recipes_image = $CI->recipesmodel->get_random_recipes_images($id);
			if(isset($get_random_recipes_image))
			{
				$image = $image_url.$get_random_recipes_image;
			}
			else
			{
				$image  = $image_url.$display_all_topics[$i]['images_src'];
			}	
            $url = site_url($CI->router->class."/delicious_recipes/".generateSeotitle($id,$title));
			$section_url = site_url($CI->router->class."/inseason_topics/".$id);
			$url = $section_url;
            
        ?>
       <div class="main_class_wrapper" style="height:425px;" data-id="<?php echo $subsection_id; ?>"> 
       <a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><img style="border:none" width="495" height="420" src="<?php echo $image; ?>" alt="<?php echo $title; ?>"/></a>
       <div class="extended_list_wrapper <?php echo $current_section_background_color;  ?> " status="hidden" >
       	<ul>
        <?php
		for($j=0 ; $j < sizeof($display_extra_data); $j++):
		$extra_title = $display_extra_data[$j]['recipes_title'.$current_language_db_prefix];
		$extra_id = $display_extra_data[$j]['recipes_ID'];
		$extra_link = site_url($CI->router->class."/delicious_recipes/".$extra_id);
		?>
                <li><h3><small><a style="font-size:11px;" class="shorten_text" href="<?php echo $extra_link; ?>"><?php echo $extra_title; ?></a></small></h3></li>
        <?php
		endfor;
		?>
	    </ul>
        
        <div class="toggle_button"><?php echo lang('bestcook_recipes_season');?></div>
        <div class="toggle_arrow <?php echo "white_color"//$current_section_color; ?>">&#x25BC;</div>
       </div><!-- End of extended_list_wrapper -->
    
        
        <div class="desc_wrapper global_background" >
            <div style="margin: 0 8px;height: 40px;">
                <a href="<?php echo $url; ?>"><h3 class="float_left" style="font-size:16px;color: #5d5d5d;"><?php echo $title; ?></h3></a>
                <div class="float_right">
                    <div class="triangle <?php echo $current_section_borderbottom_color ?>"></div>
                    <div class="plus_sign white_color"><a href="<?php echo $section_url; ?>">+</a></div>
                    <div class="clear"></div>
                </div>
            </div>
        </div><!-- .desc_wrapper -->
        </div>
    
    <?php
	//endfor;
	?>
	</div>
		<?
		
	}
	
	public function generate_homepage_recipes($subsection_title,$recipes_type,$display_data,$current_section_color,$current_section_background_color,$current_section_borderbottom_color,$image_width,$image_height,$current_language_db_prefix)
	{
		
		$CI =& get_instance();
		$CI->load->model('recipesmodel'); 

		?>
        <div class="widgets_featured_article" style="overflow:hidden;">
        <!--Title Left-->
        <div class="inner_title_wrapper">
            <div class="sections_wrapper_margin_homepage">
                <h1 class="<?php echo $current_section_color; ?>"><?php echo $subsection_title;?></h1>
            </div>
        </div>
        <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
        
        <?php
		//Fix for the lists in order to apply both members and admin members in one lists
		if($recipes_type == 'recipes')
		{
			$id_column = "recipes_ID";
			$title_column = 'recipes_title'.$current_language_db_prefix;
			$image_url =  $CI->config->item('recipes_img_link');
			$method = "delicious_recipes";
		}
		elseif($recipes_type == 'members_recipes')
		{
			$id_column = "members_recipes_ID";
			$title_column = 'members_recipes_name';
			$image_url =   $CI->config->item('users_recipes_img_link');
			$method = "your_recipes";
		}
		elseif($recipes_type == 'inseason_recipies')
		{
			$id_column = "inseason_recipies_ID";
			$title_column = 'inseason_recipies_title'.$current_language_db_prefix;
			$image_url = $CI->config->item('recipes_img_link');
			$method = "recipes_list";
		}
		
        for($i=0 ;$i<sizeof($display_data); $i++):
    
            if(empty($display_data))
        echo '<p style="padding:15px; text-align:center"> '.lang('globals_No_articles_in_this_section').'</p>';
    
            $id = $display_data[0][$id_column];
           
            
            
			if($recipes_type == 'inseason_recipies')
			{
				$title = $display_data[0][$title_column];
				$title = mb_substr(strip_tags($title), 0, 30 , 'utf-8' ). (strlen(strip_tags($title)) > 30?'...':'');
				$section_url = site_url("best_cook/".$method."/".$id);
				
				$get_random_recipes_image = $CI->recipesmodel->get_random_recipes_images($id);
				if(isset($get_random_recipes_image))
				{
					$image = $image_url."thumb_".$get_random_recipes_image;
				}
				else
				{
					$image  = $image_url."/thumb_".$display_all_topics[$i]['images_src'];
				}		
					
			}
			else
			{
				$image  = $image_url.$display_data[0]['images_src'];
				$title = $display_data[0][$title_column];
            	$section_url = site_url("best_cook/".$method);
			}
			$url = site_url("best_cook/".$method."/".generateSeotitle($id,$title));
			
			echo '<a href="'.$url.'" title="'.$title.'"><img style="border:none" width="'.$image_width.'" height="'.$image_height.'" src="'.$image.'" alt="'.$title.'"   /></a>';
        ?>

        <div class="desc_wrapper global_background" >
            <div style="margin: 0 8px;height: 40px;">
                <a href="<?php echo $url; ?>"><h3 class="float_left"><?php echo $title; ?></h3></a>
                <div class="float_right">
                    <div class="triangle <?php echo $current_section_borderbottom_color ?>"></div>
                    <div class="plus_sign white_color"><a href="<?php echo $section_url; ?>">+</a></div>
                    <div class="clear"></div>
                </div>
            </div>
        </div><!-- .desc_wrapper -->
        <div class="clear"></div>
    
    <?php
	endfor;
	?>
	</div>
    <div class="clear"></div>
		<?php
		
	}
	public function generate_homepage_most_read_recipes($subsection_title,$display_data,$current_section_color,$current_section_background_color,$current_section_borderbottom_color,$div_width,$div_height,$current_language_db_prefix)
	{
		
		$CI =& get_instance();

		?>
        <div class="widgets_featured_article">
        <!--Title Left-->
        <div class="inner_title_wrapper">
            <div class="sections_wrapper_margin_homepage">
                <h1 class="<?php echo $current_section_color; ?>"><?php echo $subsection_title;?></h1>
            </div>
        </div>
        <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
        <div class="<?php echo $current_section_background_color;?>" style="margin-top: -5px;width:<?php echo $div_width; ?>px; height:<?php echo $div_height; ?>px">
            <ul>
        <?php            
            for($i=0 ;$i<sizeof($display_data); $i++):
        
                if(empty($display_data))
               echo '<p style="padding:15px; text-align:center"> '.lang('globals_No_articles_in_this_section').'</p>';
                
                $id = $display_data[$i]['id'];
                $title = $display_data[$i]['title'];
                $title_ar = $display_data[$i]['title_ar'];
                $method = $display_data[$i]['method'];
                
                if($method == 'your_recipes' && $current_language_db_prefix == '_ar')
                {
                    $title = $title;
                }
                
                if($method == 'delicious_recipes' && $current_language_db_prefix == '_ar')
                {
                    $title = $title_ar;
                }
               
                $url = site_url("best_cook/".$method."/".generateSeotitle($id,$title));
				$section_url = site_url("best_cook/delicious_recipes");
                
                echo '<li style=" border-bottom:1px solid #fff;margin: 5px;font-size: 13px; padding:4px;"><a class="white_color" href="'.$url.'">'.$title.'</a></li>';
    
            ?>
               
             <?php
            endfor;
            ?>
            </ul>
            <div class="float_right">
                <div class="triangle my_corner_borderbottom_color"></div>
                <div class="plus_sign <?php echo $current_section_color?>"><a href="<?php echo $section_url; ?>">+</a></div>
                <div class="clear"></div>
            </div>
        </div><!--End OF div.container-->

	</div>
		<?
	}
	
	public function generate_homepage_featured_article($subsection_title,$current_section,$display_data,$current_section_color,$current_section_background_color,$current_section_borderbottom_color,$image_width,$image_height,$current_language_db_prefix)
	{
		
		$CI =& get_instance();

		?>
        <div class="widgets_featured_article">
        <!--Title Left-->
        <div class="inner_title_wrapper">
            <div class="sections_wrapper_margin_homepage">
                <h1 class="<?php echo $current_section_color; ?>"><?php echo $subsection_title;?></h1>
            </div>
        </div>
        <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
        
        <?php
        for($i=0 ;$i<sizeof($display_data); $i++):
   
			$image_url = $CI->config->item('articles_img_link');
			
            if(empty($display_data))
           echo '<p style="padding:15px; text-align:center"> '.lang('globals_No_articles_in_this_section').'</p>';
            $id = $display_data[0]['articles_ID'];
            $section_id = $display_data[0]['articles_sections_ID'];
            $title = $display_data[0]['articles_title'.$current_language_db_prefix];
			if($current_language_db_prefix == '_ar')
			{
				$short_title = mb_substr(strip_tags($title), 0, 38, 'utf-8'). (strlen(strip_tags($title)) > 50?'...':'');
			}
			else
			{
				$short_title = mb_substr(strip_tags($title), 0, 35, 'utf-8'). (strlen(strip_tags($title)) > 38?'...':'');
			}
            $image  = $image_url.$display_data[0]['images_src'];
            $url = site_url($current_section."/inner_articles/".generateSeotitle($id,$title));
            $section_url = site_url($current_section."/section/".$section_id);
        ?>
       <a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><img style="border:none;" width="<?php echo $image_width;?>" height="<?php echo $image_height?>" src="<?php echo $image; ?>" alt="<?php echo $title; ?>" /></a>
    
        
        <div class="desc_wrapper global_background" >
            <div style="margin: 0 8px;height: 40px;">
                <a href="<?php echo $url; ?>"><h3 class="float_left"><?php echo $short_title; ?></h3></a>
                <div class="float_right">
                    <div class="triangle <?php echo $current_section_borderbottom_color ?>"></div>
                    <div class="plus_sign white_color"><a href="<?php echo $section_url; ?>">+</a></div>
                    <div class="clear"></div>
                </div>
            </div>
        </div><!-- .desc_wrapper -->
    
    <?php
	endfor;
	?>
	</div>
		<?
		
	}

	public function generate_homepage_ask_expert($subsection_title,$current_class,$display_data,$current_section_color,$current_section_background_color,$current_section_borderbottom_color,$div_width,$div_height,$current_language_db_prefix)
	{
		
		$CI =& get_instance();

		?>
        <div class="widgets_featured_article">
        <!--Title Left-->
        <div class="inner_title_wrapper">
            <div class="sections_wrapper_margin_homepage">
                <h1 class="<?php echo $current_section_color; ?>"><?php echo $subsection_title;?></h1>
            </div>
        </div>
        <div class="thick_line <?php echo $current_section_background_color; ?>" ></div>
        <div class="<?php echo $current_section_background_color;?>" style="margin-top: -5px;width:<?php echo $div_width; ?>px; height:<?php echo $div_height; ?>px">
            <ul>
            <?php            
            for($i=0 ;$i<sizeof($display_data); $i++):
        
                if(empty($display_data))
               echo '<p style="padding:15px; text-align:center"> '.lang('globals_No_articles_in_this_section').'</p>';
                
                $id = $display_data[$i]['ask_expert_ID'];
                $title = $display_data[$i]['ask_expert_question'.$current_language_db_prefix];
                //$title_ar = $display_data[$i]['title_ar'];
				if($current_language_db_prefix == "_ar")
				{
					$short_title = mb_substr(strip_tags($title), 0,38, 'utf-8'). (strlen(strip_tags($title)) >70?'...':'');
				}
				else
				{
					$short_title = mb_substr(strip_tags($title), 0,35, 'utf-8'). (strlen(strip_tags($title)) >35?'...':'');
				}

                $url = site_url($current_class."/ask_an_expert/".$id);
				$section_url = site_url($current_class."/ask_an_expert");
                
                echo '<li class="dir" style=" border-bottom:1px solid #fff;margin: 5px;font-size: 13px;padding:4px;line-height: 25px;"><a class="white_color" href="'.$url.'">'.$short_title.'</a></li>';
    
            ?>
               
             <?php
            endfor;
            ?>
            </ul>
            <div class="float_right">
                <div class="triangle my_corner_borderbottom_color"></div>
                <div class="plus_sign <?php echo $current_section_color?>"><a href="<?php echo $section_url; ?>">+</a></div>
                <div class="clear"></div>
            </div>
        </div><!--End OF div.container-->

	</div>
		<?
	}


}

/* End of file Widgets.php */


