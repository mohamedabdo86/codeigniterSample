<?php
$title = $flavour_data[0]['products_flavour_title'.$current_language_db_prefix];
$image_url = $this->config->item('products_img_link');
$product_image = $image_url.$flavour_data[0]['images_src'];
$prepare_text = $flavour_data[0]['products_flavour_desc'.$current_language_db_prefix];
$brief_text = strip_tags($flavour_data[0]['products_flavour_text'.$current_language_db_prefix]);
$products_available_sizes = $flavour_data[0]['products_flavour_available_sizes'.$current_language_db_prefix];
$nutration_image = false;


if($flavour_data[0]['products_flavour_nutrition_img'.$current_language_db_prefix])
{
	$nutration_image = $image_url.$this->globalmodel->get_image_src($flavour_data[0]['products_flavour_nutrition_img'.$current_language_db_prefix]);
}


$flavour_data_array = '';
$flavour_data_array .= '<div id="products_slider">';
$flavour_data_array .= '<div id="main_product_header_title"><h1 title="'.$brand_name[0]['products_brand_name'.$current_language_db_prefix].'" id="slider_tag" class="product_color product_borderbottom_color">'.$brand_name[0]['products_brand_name'.$current_language_db_prefix].'</h1></div>';
$flavour_data_array .= '<div id="titles">';
				
					$flavour_data_array .= '<div class="main_product_title"><h3 title="'.$title.'" class="float_left product_2nd_color">'.$title.'</h3></div>';
					
					
                    $flavour_data_array .= '<ul id="list" class="tab-nav float_right">';
                    
					if(empty($prepare_text) && empty($brief_text))
					{
						$flavour_data_array .= '<li class="tab"><a title="'.lang('product_nutrition_guide').'" id="nutration_button_trigger" class="tab-link" href="#section1" rel="1">'.lang('product_nutrition_guide').'</a></li>';
					}
                    elseif(empty($brief_text))
					{
						$flavour_data_array .= '<li class="tab"><a title="'.lang('product_preparation').'" class="tab-link" href="#section1" rel="1">'.lang('product_preparation').'</a></li> | ';
						$flavour_data_array .= '<li class="tab active"><a title="'.lang('product_nutrition_guide').'" id="nutration_button_trigger" class="tab-link" href="#section2" rel="2">'.lang('product_nutrition_guide').'</a></li>';

					}
					else if(empty($prepare_text))
					{
						$flavour_data_array .= '<li class="tab"><a title="'.lang('product_nutrition_guide').'" id="nutration_button_trigger" class="tab-link" href="#section2" rel="2">'.lang('product_nutrition_guide').'</a></li> | ';
						$flavour_data_array .= '<li class="tab active"><a title="'.lang('product_about_product').'" class="tab-link" href="#section1" rel="1">'.lang('product_about_product').'</a></li>';
					}
					
					else
					{
                    $flavour_data_array .= '<li class="tab"><a title="'.lang('product_preparation').'" class="tab-link" href="#section1" rel="1">'.lang('product_preparation').'</a></li> | ';
					$flavour_data_array .= '<li class="tab active"><a title="'.lang('product_about_product').'" class="tab-link" href="#section2" rel="2">'.lang('product_about_product').'</a></li> | '; 
					$flavour_data_array .= '<li class="tab"><a title="'.lang('product_nutrition_guide').'" id="nutration_button_trigger" class="tab-link" href="#section3" rel="3">'.lang('product_nutrition_guide').'</a></li>';
                   }
                   $flavour_data_array .= '</ul>';
                   $flavour_data_array .= '</div>';

$flavour_data_array .= '<div class="related_3_items_list_wrapper <?php echo $current_section_color ?>">';
$flavour_data_array .= '<div class="related_3_items_list_wrapper best_cook_color">';

$flavour_data_array .= '<ul class="bdslider">';
$flavour_data_array .= '<li>';
$flavour_data_array .= '<div class="slide">';
$flavour_data_array .= '<div id="slide_summary" class="float_right">';
$flavour_data_array .= '<div id="tab-slider">';
$flavour_data_array .= '<div class="tab-main-content">';
$flavour_data_array .= '<div class="tab-slider-wrapper">';
                   
					if(empty($prepare_text) && empty($brief_text))
					{
						$flavour_data_array .= '<div class="tab-content gray_container_shadow" id="section2">
								<div align="center"><div class="nutration_product_image"><img title="'.$title.'" src="'.$nutration_image.'" width="520" height="405" id="slide_image" style="margin-top: 7px;" alt="" /></div></div>
							</div>';
					}
                    else if(empty($brief_text))
					{

						$flavour_data_array .= '<div class="tab-content gray_container_shadow" id="section2">
								  <div style="margin:10px;">
									  <div class="product_preparation_text">'.$prepare_text.'</div>
								  </div>
							  </div>';
						$flavour_data_array .= '<div class="tab-content gray_container_shadow" id="section1">
								  <div align="center"><div class="nutration_product_image"><img src="'.$nutration_image.'" width="520" height="405" id="slide_image" style="margin-top: 7px;" alt="" /></div></div>
							  </div>';
					}
					else if(empty($prepare_text))
					{
						$flavour_data_array .= '<div class="tab-content" id="section2">
								 <div class="mini_summary">
									<div class="main_about_products"><p class="mini_summary_about">'.$brief_text.'</p></div>
								 </div>
							</div>';
						$flavour_data_array .= '<div class="tab-content gray_container_shadow" id="section1">
								  <div align="center"><div class="nutration_product_image"><img title="'.$title.'" src="'.$nutration_image.'" width="520" height="405" id="slide_image" style="margin-top: 7px;" alt="" /></div></div>
							  </div>';
							  
					}
					
					else
					{
					
                   
                    $flavour_data_array .= '<div class="tab-content" id="section1">';
                    $flavour_data_array .= '<div class="mini_summary">';
                    $flavour_data_array .= '<div class="main_about_products"><p class="mini_summary_about">'.$brief_text.'</p></div>';
                    $flavour_data_array .= '</div>';
                    $flavour_data_array .= '</div>';
					 $flavour_data_array .= '<div class="tab-content gray_container_shadow" id="section2">';
                    $flavour_data_array .= '<div style="margin:10px;">';
                    $flavour_data_array .= '<div class="product_preparation_text">'.$prepare_text.'</div>';
                    $flavour_data_array .= '</div>';
                    $flavour_data_array .= '</div>';
                    $flavour_data_array .= '<div class="tab-content gray_container_shadow" id="section3">';
                    $flavour_data_array .= '<div align="center"><div class="nutration_product_image"><img title="'.$title.'" src="'.$nutration_image.'" width="520" height="405" id="slide_image" style="margin-top: 7px;" alt="" /></div></div>';
                    $flavour_data_array .= '</div>';
                    } 
                $flavour_data_array .= '</div>';
            	$flavour_data_array .= '</div>';
            	$flavour_data_array .= '</div>';
            	$flavour_data_array .= '</div>';
            
            	$flavour_data_array .= '<div class="float_left" style="width:340px;height:430px; position:relative; background-position-x:center; background-position-y:center; background-repeat:no-repeat;">';
            	$flavour_data_array .= '<div class="product_background_color" style="width:340px; height:430px; position:absolute; left:0px;top:0px; z-index:99;"></div>';
            	$flavour_data_array .= '<div class="main_product_image"><div title="'.$title.'" style="width:340px; height:430px; position:absolute; left:0px;top:0px;background-position-x:center; background-position-y:center; background-position:center; background-repeat:no-repeat; background-image:url('.$product_image.'); z-index:999; background-color: #fff; background-size: 80%;"></div></div>';
            
            	$flavour_data_array .= '<a class="float_left nutriatoin_sp_button" style="cursor:pointer;position:relative; z-index:9991; margin:10px;"><img src="'.base_url()."images/bestcook/best_cookballon_nutration".$current_language_db_prefix.".png".'" height="110" /></a>';
					 if($products_available_sizes != ""):
					 
            	$flavour_data_array .= '<div class="sizes_wrapper global_background">';
            	$flavour_data_array .= '<div style="margin:10px;">';
              		
 				
                    $flavour_data_array .= '<div class="mini_summary">';
                    $flavour_data_array .= '<p class="mini_summary_hint">'.$products_available_sizes.'</p></div>';
                    
            $flavour_data_array .= '</div>';
            $flavour_data_array .= '</div>';
          
					 endif;
			
            $flavour_data_array .= '</div>';
            $flavour_data_array .= '</div>';
			$flavour_data_array .= '</li>';
            $flavour_data_array .= '</ul>';
			$flavour_data_array .= '</div>';
			$flavour_data_array .= '</div>';

		if(!$only_one_product_flag):
		
        $flavour_data_array .= '<a href="<?php echo site_url("products/index/".$brand_id); ?>" class="float_right" id="back">&#8592; '.lang('product_back_link').'</a>';
        
		endif;
$flavour_data_array .= '</div>';
	
	
$array_of_result['falvour_data'] = $flavour_data_array;

echo json_encode($array_of_result);

?>
