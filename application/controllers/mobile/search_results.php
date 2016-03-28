<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_results extends MY_Mcontroller {


   public function __construct()
   {
		parent::__construct();
		
		// Your own constructor code
				 
		$this->load->library('common');
		
		//Load Languages
		$this->load->helper('language');		
		$this->lang->load('globals');
		
		//Load DB
		$this->load->model('searchmodel');
		

		//Initlize common data 
		$this->data = array();

		//Apply Sections Color
		$this->data['current_section_color'] = "terms_conditions_color";
		$this->data['current_section_background_color'] = "terms_conditions_background_color";
		$this->data['current_section_border_color'] = "terms_conditions_border_color";
		$this->data['current_section_borderbottom_color'] = "terms_conditions_borderbottom_color";
		
		//Tree Menu handling (This will write first and second url)
		$this->treemenu->add_tree_page( lang("globals_home") , site_url_mobile() );		
		$this->treemenu->add_tree_page( lang("globals_search_results") , site_url_mobile($this->router->class) );
		
		//Apply Languages
		$site_lang = $this->config->item('language');
		$this->data['current_language'] =  $site_lang;
		$this->data['current_language_db_prefix'] =   $site_lang == "arabic" ? "_ar" : "";
		
	}
	public function index()
	{
		
		//Handle Pagination
		$config['base_url'] = ($_SERVER['REQUEST_URI']);
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  )
		{
			$current_page_num = (int)$_GET['page'] ;
		}
		
		$query =  mysql_real_escape_string($this->input->get('q'));
		$q = $this->common->handle_search_query($query);
		//$q = urlencode($q);
		
		list($display , $total_rows) = $this->searchmodel->search_all_website($config["per_page"],($current_page_num-1)*$config['per_page'],$q);
		
		$config['total_rows'] = $total_rows;
		
		 $this->data['main_search_value_string'] =  $q ;
		 $this->data['target_page'] =  "view_search_results" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		 $this->data['display'] = $display;
		 $this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "&page=",lang("globals_prev"),lang("globals_next"));
		 $this->load->view('mobile/template' , $this->data);

	}
 
	
}

