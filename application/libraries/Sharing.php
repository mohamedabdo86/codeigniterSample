<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Sharing 
{
	
	
    public function sharing_function($params)
    {
		$content = '';
		$content .= '<div class="social_wrapper" style="width: 111px;">
			 <!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_16x16_style" addthis:url="'.$params['url'].'" addthis:title="'.$params['title'].'" >
				<a class="addthis_button_email"><img src="'.base_url().'images/buttons/button_mail.png" width="32" height="21" border="0" alt="Email" /></a>
				<a class="addthis_button_twitter"><img src="'.base_url().'images/buttons/button_twitter.png" width="21" height="21" border="0" alt="Tweet" /></a>
				<a class="addthis_button_facebook"><img src="'.base_url().'images/buttons/button_fb.png" width="21" height="21" border="0" alt="Facebook" /></a>
				<a class="addthis_button_compact"><img src="'.base_url().'images/buttons/button_compact.png" width="21" height="21" border="0" alt="Share" /></a>
			</div>
			<script type="text/javascript">
			var addthis_config = {"data_track_addressbar":false};
			</script>
			<script type="text/javascript">
			var addthis_config =
			{
				services_expanded: "facebook,twitter,google_plusone_share,pinterest_share,yahoomail,blogger,delicious"
			}
			</script>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5582c47824ad9c1c"></script>
			 
							 
			</div>';
		
		return $content;

    }
	
	public function sharing_big_icon($params)
    {
		$content = '';
		$content .= '<div class="social_wrapper" style="width: 322px;margin-top: 3px;">
			 <!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_16x16_style" addthis:url="'.$params['url'].'" addthis:title="'.$params['title'].'" >
				<a class="addthis_button_print" style="margin-left:4px;float:left;"><img src="'.base_url().'images/buttons/print_recipe.png" width="70" height="45" border="0" alt="Print" /><h5 style=" margin-top:-10px;text-align: center;">إطبع الوصفة</h5></a>
				<div class="separator" style="float:left;"></div>
				<a style="float:left;"><img src="'.base_url().'images/buttons/add_to_book.png" width="70" height="45" border="0" alt="Add To Book" /><h5 style=" margin-top:-10px;text-align: center;">أضف لكتابك</h5></a>
				<div class="separator" style="float:left;"></div>
				<a style="float:left;"><img src="'.base_url().'images/buttons/download_recipe.png" width="70" height="45" border="0" alt="Download" /><h5 style=" margin-top:-10px;text-align: center;">حمل الوصفة</h5></a>
				<div class="separator" style="float:left;"></div>
				<a class="addthis_button_compact" style="float:left;"><img src="'.base_url().'images/buttons/share_recipe.png" width="70" height="45" border="0" alt="Share" /><h5 style=" margin-top:-10px;text-align: center;">شاركي</h5></a>
			</div>
			<script type="text/javascript">
			var addthis_config = {"data_track_addressbar":false};
			</script>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5582c47824ad9c1c"></script>
			 
							 
			</div>';
		
		return $content;

    }
	
	public function sharing_recipe($params)
    {
		if($params['member_id'])
		{
			$href = '#insert_message';
			$class = "";
		}
		else
		{
			$href = site_url("ajax/login_panel");
			$class = "fancybox fancybox.ajax";
		}
		if($params['download_link'] != "")
		{
			$download_pdf_href = 'href="'.$params['download_link'].'"';
			$title_pdf_download = "";
		}
		else
		{
			$download_pdf_href = "";
			$title_pdf_download = lang('bestcook_not_available');
		}
		$content = '';
		$content .= '<div class="social_wrapper" style="width: 322px;margin-top: 3px;">
			 <!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_16x16_style" addthis:url="'.$params['url'].'" addthis:title="'.$params['title'].'" >
				<a class="addthis_button_print" style="margin-left:4px;float:left;"><img src="'.base_url().'images/buttons/print_recipe.png" width="70" height="45" border="0" alt="Print" /><h5 style=" margin-top:-10px;text-align: center;">'.lang('globals_print_recipe').'</h5></a>
				<div class="separator" style="float:left;"></div>
				<a id="single_1" href="'.$href.'" class="add_to_book '.$class.'" style="float:left; cursor:pointer"><img src="'.base_url().'images/buttons/add_to_book.png" width="70" height="45" border="0" alt="Add To Book" /><h5 style=" margin-top:-10px;text-align: center;">'.lang('globals_add_book').'</h5></a>
				<div class="separator" style="float:left;"></div>';
				$content .= '<p id="download_disable_msg" class="download_disable_msg">'.lang("globals_disable_download").'</p>';
				$content .= '<a '.$download_pdf_href.' style="float:left;cursor:pointer" title="'.$title_pdf_download.'" id="download_id"><img src="'.base_url().'images/buttons/download_recipe.png" width="70" height="45" border="0" alt="Download" /><h5 style=" margin-top:-10px;text-align: center;">'.lang('globals_download_recipe').'</h5></a>
				<div class="separator" style="float:left;"></div>
				<a class="addthis_button_compact" style="float:left;"><img src="'.base_url().'images/buttons/share_recipe.png" width="70" height="45" border="0" alt="Share" /><h5 style=" margin-top:-10px;text-align: center;">'.lang('globals_sharing').'</h5></a>
			</div>
			<script type="text/javascript">
			var addthis_config = {"data_track_addressbar":false};
			</script>
			<script type="text/javascript">
			var addthis_config =
			{
				services_expanded: "facebook,twitter,google_plusone_share,pinterest_share,yahoomail,blogger,delicious"
			}
			</script>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5582c47824ad9c1c"></script>
			 
							 
			</div>';
		return $content;

    }
	
	public function sharing_new_recipe($params)
    {
		if($params['member_id'])
		{
			$href = '#insert_message';
			$class = "";
		}
		else
		{
			$href = site_url("ajax/login_panel");
			$class = "fancybox fancybox.ajax";
		}
		$content = '';
		$content .= '
		<div class="social_wrapper" style="width: 322px;margin-top: 3px;">
			 <!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_16x16_style" addthis:url="'.$params['url'].'" addthis:title="'.$params['title'].'" >
				<a class="addthis_button_print" style="margin-left:4px;float:left;width: 98px;"><img style="padding:0 15px" src="'.base_url().'images/buttons/print_recipe.png" width="70" height="45" border="0" alt="Print" /><h5 style=" margin-top:-10px;text-align: center;">'.lang('globals_print_article').'</h5></a>
				<div class="separator" style="float:left;"></div>
				<a href="'.$href.'" id="single_1" class="add_to_book '.$class.'" style="float:left; cursor:pointer;width: 98px;"><img style="padding:0 15px" src="'.base_url().'images/buttons/add_to_book.png" width="70" height="45" border="0" alt="Add To Book" /><h5 style=" margin-top:-10px;text-align: center;">'.lang('globals_add_book').'</h5></a>
				<div class="separator" style="float:left;"></div>
				
				<a class="addthis_button_compact" style="float:left;width: 98px;"><img style="padding:0 15px" src="'.base_url().'images/buttons/share_recipe.png" width="70" height="45" border="0" alt="Share" /><h5 style=" margin-top:-10px;text-align: center;">'.lang('globals_sharing').'</h5></a>
			</div>
			<script type="text/javascript">
			var addthis_config = {"data_track_addressbar":false};
			</script>
			<script type="text/javascript">
			var addthis_config =
			{
				services_expanded: "facebook,twitter,google_plusone_share,pinterest_share,yahoomail,blogger,delicious"
			}
			</script>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5582c47824ad9c1c"></script>
			 
			
							 
			</div>';
		return $content;

    }
	
	public function sharing_recipe_mobile($params)
    {
		if($params['member_id'])
		{
			$href = '#insert_message';
			$class = "";
		}
		else
		{
			$href = site_url("ajax/login_panel");
			$class = "fancybox fancybox.ajax";
		}

		$content = '';
		$content .= '<div class="social_wrapper" >
			 <!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_16x16_style" addthis:url="'.$params['url'].'" addthis:title="'.$params['title'].'" >
								
				<div class="float_left small-circle background-color circle toggle_input_comment"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></div>
				<a href="'.$href.'" id="single_1" class="float_left small-circle background-color circle add_to_book '.$class.'" ><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></a>
				<a class="float_left small-circle background-color circle addthis_button_compact" style="padding:0 14px;" ><span class="glyphicon glyphicon-share" aria-hidden="true"></span></a>

			</div>
			<script type="text/javascript">
			var addthis_config = {"data_track_addressbar":false};
			</script>
			<script type="text/javascript">
			var addthis_config =
			{
				services_expanded: "facebook,twitter,google_plusone_share,pinterest_share,yahoomail,blogger,delicious"
			}
			</script>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5582c47824ad9c1c"></script>
			 
			</div>';
		return $content;

    }

	
	public function sharing_article($params)
    {
		if($params['member_id'])
		{
			$href = '#insert_message';
			$class = "";
		}
		else
		{
			$href = site_url("ajax/login_panel");
			$class = "fancybox fancybox.ajax";
		}
		$content = '';
		$content .= '
		<div class="social_wrapper" style="width: 322px;margin-top: 3px;">
			 <!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_16x16_style" addthis:url="'.$params['url'].'" addthis:title="'.$params['title'].'" >
				<a class="addthis_button_print" style="margin-left:4px;float:left;width: 98px;"><img style="padding:0 15px" src="'.base_url().'images/buttons/print_recipe.png" width="70" height="45" border="0" alt="Print" /><h5 style=" margin-top:-10px;text-align: center;">'.lang('globals_print_article').'</h5></a>
				<div class="separator" style="float:left;"></div>
				<a href="'.$href.'" id="single_1" class="add_to_book '.$class.'" style="float:left; cursor:pointer;width: 98px;"><img style="padding:0 15px" src="'.base_url().'images/buttons/add_to_book.png" width="70" height="45" border="0" alt="Add To Book" /><h5 style=" margin-top:-10px;text-align: center;">'.lang('globals_add_book').'</h5></a>
				<div class="separator" style="float:left;"></div>
				
				<a class="addthis_button_compact" style="float:left;width: 98px;"><img style="padding:0 15px" src="'.base_url().'images/buttons/share_recipe.png" width="70" height="45" border="0" alt="Share" /><h5 style=" margin-top:-10px;text-align: center;">'.lang('globals_sharing').'</h5></a>
			</div>
			<script type="text/javascript">
			var addthis_config = {"data_track_addressbar":false};
			</script>
			<script type="text/javascript">
			var addthis_config =
			{
				services_expanded: "facebook,twitter,google_plusone_share,pinterest_share,yahoomail,blogger,delicious"
			}
			</script>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5582c47824ad9c1c"></script>
			 
			
							 
			</div>';
		return $content;

    }
	
	public function sharing_article_mobile($params)
    {
		if($params['member_id'])
		{
			$href = '#insert_message';
			$class = "";
		}
		else
		{
			$href = site_url("ajax/login_panel");
			$class = "fancybox fancybox.ajax";
		}
		$content = '';
		$content .= '

			 <!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_16x16_style" addthis:url="'.$params['url'].'" addthis:title="'.$params['title'].'" >
				<div class="float_left small-circle background-color circle toggle_input_comment"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></div>
				<a href="'.$href.'" id="single_1" class="float_left small-circle background-color circle add_to_book '.$class.'" ><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></a>
				<a class="float_left small-circle background-color circle addthis_button_compact" style="padding:0 14px;" ><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></a>
			</div>
			<script type="text/javascript">
			var addthis_config = {"data_track_addressbar":false};
			</script>
			<script type="text/javascript">
			var addthis_config =
			{
				services_expanded: "facebook,twitter,google_plusone_share,pinterest_share,yahoomail,blogger,delicious"
			}
			</script>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51b73a845b0a772d"></script>';
		return $content;
    }

	
	public function sharing_one_icon($params)
    {
		$content = '';
		$content .= '<div class="social_wrapper" style="width: 322px;margin-top: 3px;">
			 <!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_16x16_style" addthis:url="'.$params['url'].'" addthis:title="'.$params['title'].'" >
				<a class="addthis_button_compact" style="float:left;"><img src="'.base_url().'images/buttons/share_recipe.png" width="70" height="45" border="0" alt="Share" /><h5 style=" margin-top:-10px;text-align: center;">شاركي</h5></a>
			</div>
			<script type="text/javascript">
			var addthis_config = {"data_track_addressbar":false};
			</script>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51b73a845b0a772d"></script>
			 
							 
			</div>';
		
		return $content;

    }
	
	public function sharing_small_icon($params)
    {
		$content = '';
		$content .= '<div class="social_wrapper" style="width: 111px;">
			 <!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_16x16_style" addthis:url="'.$params['url'].'" addthis:title="'.$params['title'].'" >
				<a class="addthis_button_email"><img src="'.base_url().'images/buttons/button_mail.png" width="32" height="21" border="0" alt="Email" /></a>
				<a class="addthis_button_twitter"><img src="'.base_url().'images/buttons/button_twitter.png" width="21" height="21" border="0" alt="Tweet" /></a>
				<a class="addthis_button_facebook"><img src="'.base_url().'images/buttons/button_fb.png" width="21" height="21" border="0" alt="Facebook" /></a>
			</div>
			<script type="text/javascript">
			var addthis_config = {"data_track_addressbar":false};
			</script>
			<script type="text/javascript">
			var addthis_config =
			{
				services_expanded: "facebook,twitter,google_plusone_share,pinterest_share,yahoomail,blogger,delicious"
			}
			</script>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51b73a845b0a772d"></script>
			 
							 
			</div>';
		
		return $content;

    }
}

/* End of file Sharing.php */
//			var addthis_share_config = {"url" : "'.$params['url'].'","title": "'.$params['title'].'","description" : "'.$params['desc'].'","screenshot": "'.$params['image'].'"}

