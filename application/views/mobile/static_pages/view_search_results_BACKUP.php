<?php
function get_image_link($CI , $type)
{
	 
	$image_link = "";
	switch($type)
	{
		case "recipes":$image_link = $CI->config->item('recipes_img_link');break;
		case "articles":$image_link =$CI->config->item('articles_img_link');break;
		case "mrecipes":$image_link = $CI->config->item('users_recipes_img_link');break;
		case "products_details":$image_link = $CI->config->item('products_img_link');break;
		
	}
	return $image_link;
	
}
?>
<?php
function get_type_title($type)
{
	$type_string = "";
	switch($type)
	{
		case "recipes":$type_string = "globals_typesofdata_recipes";break;
		case "articles":$type_string = "globals_typesofdata_articles";break;
		case "mrecipes":$type_string = "globals_typesofdata_recipes";break;
		case "products_details":$type_string = "globals_nestleproducts";break;
		
	}
	return $type_string;
	
}
function get_section_title($id)
{
	
	$section_title = "";
	
	
		switch($id)
		{
			case 2:$section_title = "globals_bestcook";break;
			case 10:$section_title = "globals_bestme";break;
			case 27:$section_title = "globals_bestmom";break;
			case 28:$section_title = "globals_besttime";break;
			case 30:$section_title = "globals_nestleproducts";break;
			
		}
		
	
	 
	return $section_title;
	
}
function get_url($id,$type,$pid)
{
	$url_string = "";
	//get Controller from id
	$controller = "";
	switch($id)
		{
			case 2:$controller = "best_cook";break;
			case 10:$controller = "best_me";break;
			case 27:$controller = "best_mom";break;
			case 28:$controller = "best_time";break;
			case 30:$controller = "products";break;
			
		}
	$method = "";
	switch($type)
	{
		case "recipes":$method = "delicious_recipes";break;
		case "articles":$method = "inner_articles";break;
		case "mrecipes":$method = "your_recipes";break;
		case "products_details":$method = "product_details";break;		
	}
	
	//Get Method from type
	
	//Concate them
	
	if($id == 30)
	{
		$CI =& get_instance();
		$CI->load->model('productsmodel');
		
		$get_id = $CI->productsmodel->get_products_details($pid);
		$prand_id =$get_id['products_products_brand_id'];

		$url_string = $controller . "/".$method."/".$prand_id."/".$pid;
	}
	else
	{
		$url_string = $controller . "/".$method."/".$pid;
	}
	
	return $url_string;
}
?>
<?php echo $this->load->view('mobile/template/tree_menu_writer');   ?>
<div class="clear"></div>
<style>
#main_search_results_list
{
	/*margin:10px 25px;*/
	height:auto;
	list-style:none;
	padding:10px 0;
	margin:0;
	/*background:#ccc;*/	
}
#main_search_results_list li
{
	width:100%;
	height:100px;
	/*background:#F00;*/
	/*margin:10px 0px;*/
	border-bottom:solid 1px #ccc;
	padding:10px 0px;
}
#main_search_results_list li:last-child { border-bottom:none;}
#main_search_results_list li div
{
	margin:0 3px;
	white-space:normal;
}
#main_search_results_list li .image { width:150px; height:100px;}
#main_search_results_list li .title_wrapper { width:625px; height:100px; /*background:#F0f*/}
#main_search_results_list li .sep { width:1px; height:100px; background:#ccc;}
#main_search_results_list li .section_type {height: 100px;width: 155px; text-align:center; }
#main_search_results_list li .section_type table { width:100%; height:100%;}
#main_search_results_list li .section_type table p { font-size:14px;}
</style>
<div class="inner_title_wrapper">

<div class="sections_wrapper_margin">
<h1 class="<?php echo $current_section_color; ?>"><?php echo lang("globals_search_results"); ?></h1>
</div>

</div><!-- End of inner_title_wrapper -->
<div class="thick_line <?php echo $current_section_background_color; ?> "></div>


<div class="container_pagination_wrapper_12_items global_background"   >

<?php if(sizeof($display)<=0){
echo "<p style='padding: 10px;color: red;font-size: 24px;font-weight: bold;'>".lang("globals_search_no_result")."</p>";	
}?>
<div class="sections_wrapper_margin">
<ul id="main_search_results_list">
<?php
for($i=0 ; $i < sizeof($display) ; $i++):
$id = $display[$i]['id'];
$title = $display[$i]['title'.$current_language_db_prefix];
$image_link = get_image_link($this , $display[$i]['type']);
$image = $this->globalmodel->get_image_src($display[$i]['image']) == 'logo.png' ? base_url()."uploads/recipes/image_not_available".$current_language_db_prefix.".png"  :$image_link.$this->config->item('image_prefix').$this->globalmodel->get_image_src($display[$i]['image']);
//$desc = mb_substr(strip_tags( $display[$i]['desc'.$current_language_db_prefix]),0,140,"utf-8")."...";
$desc = $display[$i]['desc'.$current_language_db_prefix];
$short_desc = $this->common->limit_text($desc, 170);

$type = get_type_title($display[$i]['type']);

//Alter ID in case of articles
$subsection_id = $display[$i]['section_id'];
if($display[$i]['type'] == "articles")
	{
		 
		$new_display = $this->sectionsmodel->get_sections_details($subsection_id);
		$subsection_id = $new_display[0]['sub_sections_sections_ID'];
		
	}

$section = get_section_title($subsection_id);

$url = site_url_url(get_url($subsection_id,$display[$i]['type'],$id))
?>
<li>
<div class="image float_left"><a href="<?php echo $url; ?>"><img src="<?php echo $image; ?>" width="150" height="100" /></a></div>
<div class="title_wrapper float_left">
<h2><a href="<?php echo $url; ?>"><?php echo $title; ?></a></h2>
<p style="width:620px;"><?php echo $short_desc; ?></p>
</div>
<div class="sep float_left"></div>
<div class="section_type float_left">
<table><tr><td valign="middle">
<p><strong><?php echo lang('globals_type'); ?> : </strong> <?php echo lang($type); ?> </p>
<p><strong><?php echo lang('globals_section'); ?> : </strong> <?php echo lang($section); ?> </p>
</td></tr></table>
</div>
</li>
<?php
endfor;
?>
</ul>
</div>
<div class="page_navigation" align="center">
<?php echo  $pagination_links; ?>
</div>
<?php

// Start of code
//$time = microtime(true); // Gets microseconds

// Rest of code

// End of code
//echo "Time Elapsed: ".(microtime(true) - $time)."s";

?>
</div>