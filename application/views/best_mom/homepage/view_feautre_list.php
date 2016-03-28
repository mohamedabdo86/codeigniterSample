<style>
.feature
{ 
	width: 245px;
	padding-right: 250px;
	position: relative;
	height: 188px;
	overflow: hidden;
}
.feature ul.ui-tabs-nav
{ 
	position: absolute;
	top: 0;
	list-style: none;
	padding: 0;
	margin: 0;
	width: 192px;
	height: 188px;
	overflow: hidden;
	z-index: 9999;
	direction: rtl;

}
.feature ul.ui-tabs-nav li
{ 
	padding-right: 20px;
	font-size: 12px;
	color: #666;
}
.feature ul.ui-tabs-nav li img
{ 
	float:left; margin:2px 5px; 
	padding:2px; 

}
.feature ul.ui-tabs-nav li span
{ 
	font-size:11px;  
	line-height:18px; 
}
.feature li.ui-tabs-nav-item a
{ 
	display: block;
	height: 55px;
	text-decoration: none;
	color: #333;
	line-height: 20px;
	outline: none;
	width: 164px;
	border-bottom: 2px #ffc81b dashed;
}
.feature li.ui-tabs-nav-item:last-child a
{
	border-bottom: none;
}
.feature li.ui-tabs-nav-item a:hover
{ 
	/*background:#f2f2f2; */
}
.feature li.ui-tabs-selected, .feature li.ui-tabs-active
{ 
	background:url('<?php echo base_url(); ?>images/selected-item-right.png') top right no-repeat;

}
.feature .ui-tabs-panel .info{ 
	position:absolute; 
	bottom:0; left:0; 
	height:70px; 
	background: url('<?php echo base_url(); ?>images/transparent-bg.png');
	width:412px; 
}
.feature ul.ui-tabs-nav li.ui-tabs-selected a, .feature ul.ui-tabs-nav li.ui-tabs-active a
{ 
	/*background:#ccc; */
}
.feature .ui-tabs-panel
{ 
	width: 318px;
	height: 188px;
	background: #fff;
	position: relative;
	left: 176px;
}

.feature .ui-tabs-panel .info a.hideshow{
	position:absolute; font-size:11px; font-family:Verdana; color:#f0f0f0; right:10px; top:-20px; line-height:20px; margin:0; outline:none; background:#333;
}
.feature .info h2{ 
	font-size:1.2em; font-family:Georgia, serif; 
	color:#fff; padding:5px; margin:0; font-weight:normal;
	overflow:hidden; 
}
.feature .info p{ 
	margin:0 5px; 
	font-family:Verdana; font-size:11px; 
	line-height:15px; color:#f0f0f0;
}
.feature .info a{ 
	text-decoration:none; 
	color:#fff; 
}
.feature .info a:hover{ 
	text-decoration:underline; 
}
.feature .ui-tabs-hide{ 
	display:none; 
}



</style>

<div id="feat_list_taghzia_betefly" class="feature">
		<div style="border-top: 2px solid #ffc81b;border-bottom: 2px solid #ffc81b;border-left: 2px solid #ffc81b;position: absolute;width: 170px;height: 179px;top: 5px;">
        </div>
        
      <ul class="ui-tabs-nav">
       <?php
  
        $list = $this->sectionsmodel->get_children_sections(62 , 'articles');

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
        
        $articles_list = $this->sectionsmodel->get_children_sections(62 , 'articles');
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
                $url = site_url($this->router->class."/inner_articles/".$id);

            ?>
                <div style=" width: 324px;height: 188px;">
                    <div class="image float_left" style="padding:5px; position:relative;">
                    	<a href="<?php echo $url ?>"><img src="<?php echo $image; ?>" width="323" height="183" />
                        <div class="title_wrapper" style="position:absolute; width:98%; bottom:15px; background:rgba(255,255,255,0.8);">
                        	<div style="margin:10px;"><h2><?php echo $title ?></h2></div>
                        </div>
                    	</a></div>
                    
                    <div class="desc_wrapper global_background">
                	<div class="float_left" style="width:10px; height:10px;"></div>
                	<h3 class="float_left"><?php echo $url; ?></h3>
                    
                    <div class="float_right" style="position:relative">
                	<div class="triangle best_cook_borderbottom_color"></div>
					<div class="plus_sign white_color"><a href="<?php //echo site_url("best_cook/recipes_list/".$display_inseason_topic[0]['inseason_recipies_ID']); ?>">+</a></div>
                    
                    <div class="clear"></div>
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