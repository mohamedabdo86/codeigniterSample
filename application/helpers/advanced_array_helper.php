<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('multipleExplode'))
{
    function multipleExplode($string)
    {
		$delimiters = array(";",","," ");
		
		$mainDelim=$delimiters[count($delimiters)-1]; // dernier
		
		array_pop($delimiters);

		foreach($delimiters as $delimiter){
	
			$string= str_replace($delimiter, $mainDelim, $string);
			
		}
	
		$result= explode($mainDelim, $string);
		
		//Makki edition
		//Remove spaces from array
		
		foreach ($result as $key => $value) { 
		  if ($value == "" ) { 
			unset($result[$key]); 
		  } 
		} 
		
		return $result;
 
    }  //End of function definition
}//End of if exists 

if ( ! function_exists('generateSeotitle'))
{
    function generateSeotitle($id,$title)
    {
		$new_title = str_replace(" ", "-",$title);

		$new_title = str_replace(array('%', '<', '>', '&', '{', '}', '*', '$' , '@' , '!' , '#' , '^' , '(' , ')' , ':' , '.' , ';' , ',' , '?' , '؟' , '\''), '', $new_title);
		
		return $id."-".$new_title;

    }  //End of function definition
}//End of if exists 

if ( ! function_exists('extractSeoid'))
{
    function extractSeoid($string)
    {
		$array_of_strings = explode("-" , $string);
		
		return $array_of_strings[0];

    }  //End of function definition
}//End of if exists 


if ( ! function_exists('getPaginationString'))
{
    function getPaginationString($page = 1, $totalitems, $limit = 15, $adjacents = 1, $targetpage = "/", $pagestring = "?page=",$prevtext="Prev",$nexttext="Next")
	{		
		//defaults
		if(!$adjacents) $adjacents = 1;
		if(!$limit) $limit = 15;
		if(!$page) $page = 1;
		if(!$targetpage) $targetpage = "/";
		
		//other vars
		$prev = $page - 1;									//previous page is page - 1
		$next = $page + 1;									//next page is page + 1
		$lastpage = ceil($totalitems / $limit);				//lastpage is = total items / items per page, rounded up.
		$lpm1 = $lastpage - 1;								//last page minus 1
		
		/* 
			Now we apply our rules and draw the pagination object. 
			We're actually saving the code to a variable in case we want to draw it more than once.
		*/
		$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<div class=\"pagination\"";
			/*if($margin || $padding)
			{
				$pagination .= " style=\"";
				if($margin)
					$pagination .= "margin: $margin;";
				if($padding)
					$pagination .= "padding: $padding;";
				$pagination .= "\"";
			}*/
			$pagination .= ">";
	
			//previous button
			if ($page > 1) 
				$pagination .= "<a href=\"$targetpage$pagestring$prev\">« {$prevtext}</a>";
			else
				$pagination .= "<span class=\"disabled\">« {$prevtext}</span>";	
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination .= "<span class=\"current\">$counter</span>";
					else
						$pagination .= "<a href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a>";					
				}
			}
			elseif($lastpage >= 7 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 3))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">$counter</span>";
						else
							$pagination .= "<a href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a>";					
					}
					$pagination .= "<span class=\"elipses\">...</span>";
					$pagination .= "<a href=\"" . $targetpage . $pagestring . $lpm1 . "\">$lpm1</a>";
					$pagination .= "<a href=\"" . $targetpage . $pagestring . $lastpage . "\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination .= "<a href=\"" . $targetpage . $pagestring . "1\">1</a>";
					$pagination .= "<a href=\"" . $targetpage . $pagestring . "2\">2</a>";
					$pagination .= "<span class=\"elipses\">...</span>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">$counter</span>";
						else
							$pagination .= "<a href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a>";					
					}
					$pagination .= "...";
					$pagination .= "<a href=\"" . $targetpage . $pagestring . $lpm1 . "\">$lpm1</a>";
					$pagination .= "<a href=\"" . $targetpage . $pagestring . $lastpage . "\">$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination .= "<a href=\"" . $targetpage . $pagestring . "1\">1</a>";
					$pagination .= "<a href=\"" . $targetpage . $pagestring . "2\">2</a>";
					$pagination .= "<span class=\"elipses\">...</span>";
					for ($counter = $lastpage - (1 + ($adjacents * 3)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span class=\"current\">$counter</span>";
						else
							$pagination .= "<a href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination .= "<a href=\"" . $targetpage . $pagestring . $next . "\">{$nexttext} »</a>";
			else
				$pagination .= "<span class=\"disabled\">{$nexttext} »</span>";
			$pagination .= "</div>\n";
		}
		
		return $pagination;
	
	}//End of pagination string
}//End of if exists 




if ( ! function_exists('getMPaginationString'))
{
    function getMPaginationString($page = 1, $totalitems, $limit = 15, $adjacents = 1, $targetpage = "/", $pagestring = "?page=",$prevtext="Prev",$nexttext="Next")
	{		
		//defaults
		if(!$adjacents) $adjacents = 1;
		if(!$limit) $limit = 15;
		if(!$page) $page = 1;
		if(!$targetpage) $targetpage = "/";
		
		//other vars
		$prev = $page - 1;									//previous page is page - 1
		$next = $page + 1;									//next page is page + 1
		$lastpage = ceil($totalitems / $limit);				//lastpage is = total items / items per page, rounded up.
		$lpm1 = $lastpage - 1;								//last page minus 1
		
		/* 
			Now we apply our rules and draw the pagination object. 
			We're actually saving the code to a variable in case we want to draw it more than once.
		*/
		$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<div class=\"pagination\" style=\"position: relative\"";
			/*if($margin || $padding)
			{
				$pagination .= " style=\"";
				if($margin)
					$pagination .= "margin: $margin;";
				if($padding)
					$pagination .= "padding: $padding;";
				$pagination .= "\"";
			}*/
			$pagination .= ">";
	
			//previous button
			if ($page > 1) 
				$pagination .= "<a style=\"margin:0px 3px;\" rel=\"external\" href=\"$targetpage$pagestring$prev\">« {$prevtext}</a>";
			else
				$pagination .= "<span style=\"margin:0px 3px;\" class=\"disabled\">« {$prevtext}</span>";	
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination .= "<span style=\"margin:0px 3px;\" class=\"current\">$counter</span>";
					else
						$pagination .= "<a style=\"margin:0px 3px;\" rel=\"external\" href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a>";					
				}
			}
			elseif($lastpage >= 7 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 3))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span style=\"margin:0px 3px;\" class=\"current\">$counter</span>";
						else
							$pagination .= "<a style=\"margin:0px 3px;\" rel=\"external\" href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a>";					
					}
					$pagination .= "<span style=\"margin:0px 3px;\" class=\"elipses\">...</span>";
					$pagination .= "<a style=\"margin:0px 3px;\" rel=\"external\" href=\"" . $targetpage . $pagestring . $lpm1 . "\">$lpm1</a>";
					$pagination .= "<a style=\"margin:0px 3px;\" rel=\"external\" href=\"" . $targetpage . $pagestring . $lastpage . "\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination .= "<a style=\"margin:0px 3px;\" rel=\"external\" href=\"" . $targetpage . $pagestring . "1\">1</a>";
					$pagination .= "<a style=\"margin:0px 3px;\" rel=\"external\" href=\"" . $targetpage . $pagestring . "2\">2</a>";
					$pagination .= "<span style=\"margin:0px 3px;\" class=\"elipses\">...</span>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span style=\"margin:0px 3px;\" class=\"current\">$counter</span>";
						else
							$pagination .= "<a style=\"margin:0px 3px;\" rel=\"external\" href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a>";					
					}
					$pagination .= "...";
					$pagination .= "<a style=\"margin:0px 3px;\" rel=\"external\" href=\"" . $targetpage . $pagestring . $lpm1 . "\">$lpm1</a>";
					$pagination .= "<a style=\"margin:0px 3px;\" rel=\"external\" href=\"" . $targetpage . $pagestring . $lastpage . "\">$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination .= "<a style=\"margin:0px 3px;\" rel=\"external\" href=\"" . $targetpage . $pagestring . "1\">1</a>";
					$pagination .= "<a style=\"margin:0px 3px;\" rel=\"external\" href=\"" . $targetpage . $pagestring . "2\">2</a>";
					$pagination .= "<span style=\"margin:0px 3px;\" class=\"elipses\">...</span>";
					for ($counter = $lastpage - (1 + ($adjacents * 3)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination .= "<span style=\"margin:0px 3px;\" class=\"current\">$counter</span>";
						else
							$pagination .= "<a style=\"margin:0px 3px;\" rel=\"external\" href=\"" . $targetpage . $pagestring . $counter . "\">$counter</a>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination .= "<a style=\"margin:0px 3px;\" rel=\"external\" href=\"" . $targetpage . $pagestring . $next . "\">{$nexttext} »</a>";
			else
				$pagination .= "<span style=\"margin:0px 3px;\" class=\"disabled\">{$nexttext} »</span>";
			$pagination .= "</div>\n";
		}
		
		return $pagination;
	
	}//End of pagination string
}//End of if exists 



if ( ! function_exists('getSectiondata'))
{
	function getSectiondata($id,$current_language_db_prefix="")
    {
		$CI =& get_instance();
		
		//Load global model 
		$CI->load->model('globalmodel'); 
		
		//Retrieve Data
		$display_results = $CI->globalmodel->get_section_data($id);
		
		 
		
		$id  = $display_results[0]['sub_sections_ID'];
		$title = $display_results[0]['sub_sections_name'.$current_language_db_prefix];
		$title_extra = $display_results[0]['sub_sections_extra_title'.$current_language_db_prefix];
		
		return array($id,$title,$title_extra);
		
	}
}

if ( ! function_exists('mobileHyperlink'))
{
	function mobileHyperlink($url,$title,$short_title,$class="",$id="")
    {
		$hyperlink = '<a rel="external" class="'.$class.'" id="'.$id.'" title="'.$title.'" href="'.$url.'">'.$short_title.'</a>';
		return $hyperlink;
	}
}


if ( ! function_exists('uniord'))
{
	function uniord($u)
    {
		 // i just copied this function fron the php.net comments, but it should work fine!
		$k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
		$k1 = ord(substr($k, 0, 1));
		$k2 = ord(substr($k, 1, 1));
		return $k2 * 256 + $k1;
		
	}
}

if ( ! function_exists('is_arabic'))
{
	function is_arabic($str)
    {
		$font_class = "";
		 if(mb_detect_encoding($str) !== 'UTF-8')
		 {
       	 	$str = mb_convert_encoding($str,mb_detect_encoding($str),'UTF-8');
    	 }
		 
		preg_match_all('/.|\n/u', $str, $matches);
		$chars = $matches[0];
		$arabic_count = 0;
		$latin_count = 0;
		$total_count = 0;
    	foreach($chars as $char) {
        //$pos = ord($char); we cant use that, its not binary safe 
				$pos = uniord($char);
				//echo $char ." --> ".$pos.PHP_EOL;
		
				if($pos >= 1536 && $pos <= 1791) 
				{
					$arabic_count++;
				} else if($pos > 123 && $pos < 123) 
				{
					$latin_count++;
				}
				$total_count++;
			}
			if(($arabic_count/$total_count) > 0.6) 
			{
				// 60% arabic chars, its probably arabic
				return " arabic_font ";
			}
			return " english_font  ";
		
	}
}

if ( ! function_exists('altecho'))
{
	function altecho($str)
    {
		//Check If String contains Nestle.
		$oldStrings = array ("nestle" , "Nestle") ;
		$newStrings = array ("Nestlé®");
		$newString = str_replace($oldStrings , $newStrings , $str);
		
		echo $newString;
		

	}
}

if ( ! function_exists('drawBootstrapGrid'))
{
	function drawBootstrapGrid($textToDraw , $numberOfColumns , $columnIndex , $classesToWrite )//untested on columns more than 2
	{
		$result = "";
		if($columnIndex % $numberOfColumns == 0)
		{
			//Open New  Row div
			$result.='<div class="row">
			';
		}
		$result.='<div class="'.$classesToWrite.'">
		';
		$result.=$textToDraw;
		$result.='</div><!-- col -->
		';
		if($columnIndex % $numberOfColumns == 1)
		{
			//Close Row div
			$result.='</div><!-- row -->
			';
		}
		return $result;
		
	}
}

if ( ! function_exists('mobile_menu_get_subsections'))
{
	function mobile_menu_get_subsections($parent_id, &$push_array)
    {
		$CI = get_instance();
		$CI->load->model('sectionsmodel');
		$menus_result = $CI->sectionsmodel->get_children_sections_mobile($parent_id);
		
		if(!empty($menus_result))
		{
			foreach($menus_result as $menu)
			{
				$id = $menu['sub_sections_ID'];
				$title_en = $menu['sub_sections_name'];
				$title_ar = $menu['sub_sections_name_ar'];
				$url = $menu['sub_sections_url'];
				$parent_id = $menu['sub_sections_parent'];
					
				//Check If URL COntain special Code such as %id%
				$url = str_replace("%id%",$id,$url);
				
				$push_array[$id]['id'] = $id;
				$push_array[$id]['title_en'] = $title_en;
				$push_array[$id]['title_ar'] = $title_ar;
				$push_array[$id]['url'] = $url;
				$push_array[$id]['parent_id'] = $parent_id;
				
				mobile_menu_get_subsections($menu['sub_sections_ID'], $push_array);
			}
		}
	}
}

if ( ! function_exists('mobile_menu_fetch_subsections'))
{
	function mobile_menu_fetch_subsections($sections_array, $parent_id, $top_cat_id, $section_name, $language='english', $level = 1)
    {
		if(!empty($sections_array))
		{
		?>
			<ul mob_nav_parent="<?php echo $parent_id; ?>" mob_nav_top_section="<?php echo $section_name; ?>" class="mob-nav-menu-child" style="display:none">
            <?php
			foreach($sections_array as $section)
			{
				if($parent_id == $section['parent_id'])
				{
			?>
            	<li mob_nav_id="<?php echo $section['id']; ?>">

                    
                	<a class="mob-nav-menu-child" href="<?php echo site_url_mobile($section_name . '/' . $section['url']) ?>" mob_nav_id="<?php echo $section['id']; ?>" rel="external"><?php echo $language =='english' ? $section['title_en'] : $section['title_ar'] ; ?></a>
                    <?php mobile_menu_fetch_subsections($sections_array, $section['id'],  $top_cat_id, $section_name, $language) ?>
                </li>
			<?php
				}
			}
			?>
            <!-- Add This Nestlé Fit Application manully By Ayman -->
            <?php if($parent_id == '10'){ ?>
            <li class="mob-nav-menu-child">
                <a rel="external" href="<?php echo site_url_mobile("best_me/applications/9") ?>">
                <?php echo $language =='english' ? 'Nestlé Fit' : 'الصحة اختيارى' ; ?></a>
            </li>
			<?php } ?>
            </ul>
            
    	<?php
		}
	}
}