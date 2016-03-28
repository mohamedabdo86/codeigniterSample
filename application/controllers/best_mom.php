<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Best_mom extends MY_Controller {
	


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
   //private $data ;	 
   public function __construct()
   {
		parent::__construct();
		
		// Your own constructor code		 
		$this->load->model("articlesmodel");
		
		//Load Languages
		$this->load->helper('language');		
		$this->lang->load('globals');
		$this->lang->load('bestmom');

		
		//Set Section name
		$this->headers->set_second_title( lang("globals_bestmom") );
		
		
		//Initlize common data 
		$this->data = array();
		$this->data['current_section_id'] =  27;
		
		//Apply Languages
		$site_lang = $this->config->item('language');
		$this->data['current_language'] =  $site_lang;
		$this->data['current_language_db_prefix'] =   $site_lang == "arabic" ? "_ar" : "";
		
		//Apply Drawings
		$this->data['apply_outer_drawings'] = true;
		$this->data['header_left_outer_drawings_src'] = base_url()."images/bestmom/bestmom_left_drawings".$this->data['current_language_db_prefix'].".png";
		$this->data['header_right_outer_drawings_src'] = base_url()."images/bestmom/bestmom_right_drawings".$this->data['current_language_db_prefix'].".png";
		
		//Apply Sections Color
		$this->data['current_section_color'] = "best_mom_color";
		$this->data['current_section_background_color'] = "best_mom_background_color";
		$this->data['current_section_border_color'] = "best_mom_border_color";
		$this->data['current_section_borderbottom_color'] = "best_mom_borderbottom_color";
		

		
		//Apply Default Subsections ID
		$this->data['id_of_current_sub_section'] =  false;
		$this->data['parent_id_of_current_sub_section'] =  false;
		
		//Tree Menu handling (This will write first and second url)
		$this->treemenu->add_tree_page( lang("globals_home") , site_url('welcome') );		
		$this->treemenu->add_tree_page( lang("globals_bestmom") , site_url($this->router->class) );
		
		
		//Auto Manage Current Section,Manage Tree Page and Headers
		
		//Send ID if applicable
		$dynamic_id = $this->uri->segment(4);
		
		
		//Get Current Section Data
		$current_section_data = $this->sectionsmodel->get_active_sub_section_data($this->router->fetch_method() , $this->data['current_section_id'],$dynamic_id);
		if( !empty($current_section_data) ):
			$title_of_current_section = $current_section_data[0]['sub_sections_name'.$this->data['current_language_db_prefix']];
			$id_of_current_sub_section  = $current_section_data[0]['sub_sections_ID'];
			$parent_id_of_current_sub_section  = $current_section_data[0]['sub_sections_parent'];
			$url = $current_section_data[0]['sub_sections_url']; 
			//Add Current Page (	The Third Url)	

			if($this->data['current_section_id'] != $parent_id_of_current_sub_section)
			{
				$parent_section_data = $this->sectionsmodel->get_sections_details($parent_id_of_current_sub_section);
				$title_of_parent_section  = $parent_section_data[0]['sub_sections_name'.$this->data['current_language_db_prefix']];
				
				$this->treemenu->add_tree_page( $title_of_parent_section , '#');
			}

			if (strpos($url,'id'))
			{
    			$this->treemenu->add_tree_page( $title_of_current_section , site_url($this->router->class."/".$this->router->fetch_method()."/".$id_of_current_sub_section) );
			}else{
				$this->treemenu->add_tree_page( $title_of_current_section , site_url($this->router->class."/".$this->router->fetch_method()."/") );
			}
			//Set Headers
			$this->headers->set_third_title( $title_of_current_section  );
			 
			$this->data['id_of_current_sub_section'] = $id_of_current_sub_section;
			$this->data['parent_id_of_current_sub_section'] = $parent_id_of_current_sub_section;
		
		endif;
	 		
		//Prepare Ask an expert Background form
	 	$this->data['ask_an_expert_form_background'] = base_url()."images/bestmom/ask_an_expert_background".$this->data['current_language_db_prefix'].".png";
		
		
   }
 
	public function index()
	{			
		$this->load->library('widgets');
		$this->load->library('newslettermodule');
		$this->load->model("newslettermodel");
		
		//get ask an expert data
		list($display_ask_an_expert , $total_rows) = $this->globalmodel->get_ask_expert_questions(1,0,$this->data['current_section_id'], $this->data['current_language_db_prefix'],1);
		$display_expert = $this->globalmodel->get_expert($this->data['current_section_id']);
		
		//Pass the Data
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array();
		$this->data['display_applications'] =  $this->globalmodel->get_applications($this->data['current_language_db_prefix'],$this->data['current_section_id'],180);
		$this->data['target_page'] =  "best_mom/view_bestmom_homepage" ;
		$this->data['display_section_slideshow'] =  $this->globalmodel->get_sections_slideshow($this->data['current_section_id'],$this->data['current_language_db_prefix']);
		$this->data['display_section_tips'] =  $this->globalmodel->get_sections_tips($this->data['current_section_id']);
		$this->data['display_ask_an_expert'] = $display_ask_an_expert;
		$this->data['display_newsletter'] = $this->newslettermodel->get_newslettertypes_section($this->data['current_section_id']);
		$this->data['display_expert'] = $display_expert;
		
		//$this->data['display_recent_recipes'] = $this->recipesmodel->get_recent_recipes();
		$this->data['display_recent_articles'] =  $this->articlesmodel->get_recent_articles(2 , array(19 , 20 ));
		
		
		$this->load->view('template' , $this->data); 

	}
	
	public function featured_abwan()
	{
		$section_id = $this->input->post('current_id');
		$this->data['current_section_id'] = $section_id;
		$this->data['featured_articles'] = $this->articlesmodel->get_featured_abwan($section_id , 4);
		//print_r($this->data['featured_articles']);
		$this->load->view('best_mom/homepage/view_featured_abwan', $this->data);
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */