<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privacy_policy extends CI_Controller {


	 public function __construct()
   {
		parent::__construct();
		
		// Your own constructor code		 
				
		//Load Languages
		$this->load->helper('language');		
		$this->lang->load('globals');
		
		//Load DB
		$this->load->model('staticmodel');
		
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
		$this->headers->set_second_title(lang("globals_secmenu_privacy"));
		
	}
	public function index()
	{
		 $this->data['privacy_policy_desc'] =  $this->staticmodel->get_privacy_policy_desc();
		 $this->data['privacy_policy'] =  $this->staticmodel->get_privacy_policy_question_answer();
		 $this->data['target_page'] =  "static_pages/view_privacy_policy" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	     $this->load->view('template' , $this->data);

	}
}
