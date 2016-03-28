<?php
	$articles_array = '';
	$image_url = $this->config->item('articles_img_link');
	if( empty($featured_articles) )
	{
		$articles_array .= '<p style="padding:15px; text-align:center;top:50px;position: absolute;right: 30%;">'.lang('globals_No_articles_in_this_section').'</p>';
	}
	else
	{
		for($j=0; $j<sizeof($featured_articles) ; $j++)
		{
			$id = $featured_articles[$j]['articles_ID'];
			$title = $featured_articles[$j]['articles_title'.$current_language_db_prefix];
			$desc = $featured_articles[$j]['articles_brief'.$current_language_db_prefix];
			$brief = $this->common->limit_text($desc, 150);
            $image  = $image_url.$this->config->item('image_prefix').$featured_articles[$j]['images_src'];
			$url = site_url($this->router->class."/inner_articles/".$id);
			$section_url = site_url($this->router->class."/section/".$current_section_id);
	
		$articles_array .= '<div class="panel_wrapper" style="float:right" >';
		$articles_array .= '<div class="image" style="position:relative;float:right">';
		$articles_array .= '<a href="'.$url .'"><img alt="'.$title.'" src="'.$image.'" width="200" height="120" /></a>';
		$articles_array .= '</div> ';
		$articles_array .= '<div class="title_wrapper" style="float:left" >';
		$articles_array .= '<a href="'.$url.'"><h3 style="padding: 5px;">'.$title.'</h3></a>';
		$articles_array .= '</div>';
		$articles_array .= '<div class="clear"></div>';
		$articles_array .= '</div>';
		}
		$articles_array .= '<div class="" style="float:left" >';
		$articles_array .= '<div class="triangle '.$current_section_borderbottom_color.'" style="width: 0;height: 0;text-indent: -9999px;border-bottom-width: 40px;border-bottom-style: solid;z-index: 999;position: absolute;bottom: 0px;left: 0px;right: inherit;border-left: none;border-right: 50px solid transparent;margin-bottom: 5px;"></div>';
		$articles_array .= '<div class=" white_color abwan_plus_ajax" style="right: inherit;left: 0px;height: 33px;position: absolute;bottom: 0px;width: 20px;font-size: 22px;z-index: 999; margin-bottom:3px"><a href="'.$section_url.'">+</a></div>';
		$articles_array .= '<div class="clear"></div>';
		$articles_array .= '</div>';
	}

$array_of_result['articles'] = $articles_array;

echo json_encode($array_of_result);

?>
