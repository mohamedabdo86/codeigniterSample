<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notfound extends CI_Mcontroller {


	 public function __construct()
   {
		parent::__construct();
		
		// Your own constructor code		 
				
		//Load Languages
		$this->load->helper('language');		
		$this->lang->load('globals');		
		
		//Initlize common data 
		$this->data = array();

		//Apply Sections Color
		$this->data['current_section_color'] = "terms_conditions_color";
		$this->data['current_section_background_color'] = "terms_conditions_background_color";
		$this->data['current_section_border_color'] = "terms_conditions_border_color";
		$this->data['current_section_borderbottom_color'] = "terms_conditions_borderbottom_color";
		
		//Apply Languages
		$site_lang = $this->config->item('language');
		$this->data['current_language'] =  $site_lang;
		$this->data['current_language_db_prefix'] =   $site_lang == "arabic" ? "_ar" : "";
		
	}
	public function index()
	{
		if ($this->uri->segment(2) != "notfound")
		{
			redirect("notfound");
		}
		
		$this->output->set_status_header('404');
		
		 $this->data['target_page'] =  "view_404" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	     $this->load->view('mobile/template' , $this->data);

	}
}

