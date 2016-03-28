<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Headers 
{
	 
	
	private $first_title; //will always be the website name
	private $second_title;//The section name
	private $third_title;//The Subsection name
	private $fourth_title;//May be the inner article name, or recipe name or application name
	
	private $meta_desc; //Metatag: Description 
	private $meta_keywords;//Metatag: Keywords
	
	private $default_image;
	private $default_url;
	
	public function __construct()
    {
        // Do something with $params
		$CI =& get_instance();
		$CI->lang->load('globals');
		
		$this->first_title = $CI->lang->line('globals_website_title');
		
		//Init section and article title by 
		$this->second_title = NULL;
		$this->third_title = NULL;
		$this->fourth_title = NULL;
		
		//Init Decription and meta tags
		$this->meta_desc = $CI->lang->line('globals_website_meta_description');
		$this->meta_keywords = $CI->lang->line('globals_website_meta_keywords');
		
		//Init website default image
		$this->default_image = $CI->config->item('base_url')."images/be_at_your_best_logo_ar.png";
		
		$this->default_url = current_url();
    }
	
	
	public function set_first_title($title = "")
	{
		if($title != "")
		$this->first_title = $title;
	}
	
	public function set_second_title($title = "")
	{
		if($title != "")
		$this->second_title = $title;
	}
	
	public function set_third_title($title = "")
	{
		if($title != "")
		$this->third_title = $title;
	}
	public function set_fourth_title($title = "")
	{
		if($title != "")
		$this->fourth_title = $title;
	}
	
	public function set_metatag_desc($desc = "")
	{
		$CI =& get_instance();
		$CI->load->library('common');
		
		if($desc != "")
		$desc = $CI->common->limit_text($desc,200);
		$this->meta_desc = $desc;
	}
	
	public function set_default_image($url = "")
	{
		if($url != "")
		$this->default_image = $url;
	}
	public function get_second_title()
	{
		return $this->second_title;		
	}
	public function get_third_title()
	{
		return $this->third_title;		
	}
	public function get_fourth_title()
	{
		return $this->fourth_title;		
	}
	
	public function get_website_title()
	{
		$result = "";
		
		
		$result.= $this->first_title;
		
		if( $this->second_title != NULL )
		{
			$result.=" | ";
			$result.= $this->second_title;
		}
		
		//If Fourth Title is set , display it and cancel displaying the third title
		if( $this->fourth_title !=NULL )
		{
			$result.=" | ";
			$result.= $this->fourth_title;
		}
		//If Third title is set, and the fourth title is not set. , display the third title
		if( $this->third_title != NULL  && $this->fourth_title == NULL)
		{
			$result.=" | ";
			$result.= $this->third_title;
		}
		
		return $result;
	}
	
	public function write_metatags_lines()
	{
		$result = "";
		
		$result.="<meta name='description' content='".$this->meta_desc."' />";
		$result.="<meta name='keywords' content='".$this->meta_keywords."' />";
		
		return $result;
	}
    public function write_fb_metatags_lines($image="")
    {
		$result = " ";
		if($image != "") {
			$result .= "
				<meta property='og:title' content='".$this->get_website_title()."' /> 
				<meta property='og:description' content='".$this->meta_desc."' />  
				<meta property='og:image' content='".$image."' />
				<meta property='og:url' content='".$this->default_url."' />
			";
		} else {
			$result .= "
				<meta property='og:title' content='".$this->get_website_title()."' /> 
				<meta property='og:description' content='".$this->meta_desc."' />  
				<meta property='og:image' content='".$this->default_image."' />
				<meta property='og:url' content='".$this->default_url."' />
			";
		}
		
		
		return $result;
    }
}

/* End of file Metatags.php */