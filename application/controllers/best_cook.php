<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Best_cook extends MY_Controller {

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
		$this->load->model("recipesmodel");
		$this->load->model("cookingclassmodel");
		
		//Load Languages
		$this->load->helper('language');		
		$this->lang->load('globals');
		$this->lang->load('bestcook');
				
		//Set Section name
		$this->headers->set_second_title( lang("globals_bestcook") );
		
		
		//Initlize common data 
		$this->data = array();
		$this->data['current_section_id'] =  2;
		
		//Apply Languages
		$site_lang = $this->config->item('language');
		$this->data['current_language'] =  $site_lang;
		$this->data['current_language_db_prefix'] =   $site_lang == "arabic" ? "_ar" : "";
		
		//Apply Drawings
		$this->data['apply_outer_drawings'] = true;
		$this->data['header_left_outer_drawings_src'] = base_url()."images/bestcook/bestcook_left_drawings".$this->data['current_language_db_prefix'].".png";
		$this->data['header_right_outer_drawings_src'] = base_url()."images/bestcook/bestcook_right_drawings".$this->data['current_language_db_prefix'].".png";
		
		//Apply Sections Color
		$this->data['current_section_color'] = "best_cook_color";
		$this->data['current_section_background_color'] = "best_cook_background_color";
		$this->data['current_section_border_color'] = "best_cook_border_color";
		$this->data['current_section_borderbottom_color'] = "best_cook_borderbottom_color";
		

		
		//Apply Default Subsections ID
		$this->data['id_of_current_sub_section'] =  false;
		$this->data['parent_id_of_current_sub_section'] =  false;
		
		//Tree Menu handling (This will write first and second url)
		$this->treemenu->add_tree_page( lang("globals_home") , site_url('welcome') );		
		$this->treemenu->add_tree_page( lang("globals_bestcook") , site_url($this->router->class) );
		
		
		//Auto Manage Current Section,Manage Tree Page and Headers
		
		//Send ID if applicable
		$dynamic_id = $this->uri->segment(4);
		//$dynamic_id = (explode("-",$dynamic_id));
		//echo $dynamic_id = (int)$dynamic_id;
		
		
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
	 	$this->data['ask_an_expert_form_background'] = base_url()."images/bestcook/ask_an_expert_background".$this->data['current_language_db_prefix'].".png";
		
   }
 
	public function index()
	{
		//Pass the Data
		$this->load->library('widgets');
		$this->load->model("videosmodel");
		
		list($display_ask_an_expert , $total_rows) = $this->globalmodel->get_ask_expert_questions(1,0,$this->data['current_section_id'], $this->data['current_language_db_prefix'],1);

		$display_expert = $this->globalmodel->get_expert($this->data['current_section_id']);
		
		$this->data['display_featured_video'] = $this->videosmodel->get_featured_video(2,1);//$this->videosmodel->get_featured_recipes_video(1);
		
		$this->data['display_bestcook_applications'] =  $this->recipesmodel->get_bestcook_applications($this->data['current_section_id'], $this->data['current_language_db_prefix']);
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array();
		$this->data['target_page'] =  "best_cook/view_bestcook_homepage" ;
		$this->data['display_recent_recipes'] = $this->recipesmodel->get_recent_recipes();
		$this->data['display_topics'] = $this->recipesmodel->get_topics_recipes(5);
		$this->data['display_section_slideshow'] =  $this->globalmodel->get_sections_slideshow($this->data['current_section_id'],$this->data['current_language_db_prefix']);
		$this->data['display_recent_articles'] =  $this->articlesmodel->get_recent_articles(4 , array(19 , 20 ));
		$this->data['display_recent_recipes_members'] =  $this->recipesmodel->get_members_recipes(3, $this->data['current_language_db_prefix']);
		$this->data['display_bestcook_members_last_recipes'] =  $this->recipesmodel->get_last_members_recipes($this->data['current_language_db_prefix']);
		$this->data['display_ask_an_expert'] = $display_ask_an_expert;
		$this->data['display_expert'] = $display_expert;
		$this->data['display_section_tips'] =  $this->globalmodel->get_sections_tips($this->data['current_section_id']);

		$this->load->view('template' , $this->data); 
	}
	
	public function inseason_topics($id = "") {
		$id = extractSeoid($id);
		if($id != "") {
			$this->data['related'] = $id;
			$this->recipes_list($id);
			return;
		}

		   	$this->data['flag'] = 1;
		 
		 	list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(131,$this->data['current_language_db_prefix']);
		  
		  	$this->data['subsection_title'] = $subsection_title;
		
		
		  	$this->data['display_current_inseason_topics'] = $this->recipesmodel->get_current_inseason_recipes();
		  	$this->data['display_all_topics'] = $this->recipesmodel->get_inseason_recipes();
		  	
			//Pass the Data
		  	$this->data['target_page'] =  "best_cook/view_inseason_topics" ;
		  	$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		  
		  	$this->load->view('template' , $this->data);
		

	}
	
	public function healthy_topics($id="")
	{
		$id = extractSeoid($id);
		if($id != "") {
			$this->data['related'] = $id;
			$this->recipes_list($id);return;
		}
		
		$this->data['display_all_topics'] = $this->recipesmodel->get_topics_recipes();
		
		$this->data['flag'] = 0;
		$id = extractSeoid($id);

		
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(185,$this->data['current_language_db_prefix']);
		
		$this->data['subsection_title'] = $subsection_title;

		//Pass the Data
		$this->data['target_page'] =  "best_cook/view_inseason_topics" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);
	}
	
	
	/* Method to display the list of the recipes of a specific season */
	public function inseason_recipes($id)
	{
		
		/*if($id != "")
		{
			$this->view_recipe($id);return;
		}
		*/
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  )
		{
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		//Get Recipes Data
		list( $display_data , $total_rows) = $this->recipesmodel->get_current_inseason_recipes_of_recipes($config["per_page"],($current_page_num-1)*$config['per_page'],$id);
		
		$config['total_rows'] = $total_rows;
			
		//Pass the Data
		$this->data['target_page'] =  "best_cook/view_recipes_list" ;
		$this->data['display_data'] =  $display_data;
		$this->data['members_list_flag'] =  false;
		$this->data['advanced_search_flag_hide'] =  true;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		 
		$this->load->view('template' , $this->data);

	}
	
	/* Method to display the list of the recipes of the recipes */
	public function delicious_recipes($id = "") 
	{
		if($id != "") 
		{
			$display_data = $this->recipesmodel->get_detailed_recipe($id);
			//echo $display_data[0]['Active']."fffff";
			if($display_data[0]['Active'] == 1) 
			{
				$this->view_recipe($id);
				return;
			} 
			else 
			{
				$preview = $this->uri->segment(5);
				if($preview == 'preview')
				{
					$this->view_recipe($id);
					return;
				}
				else
				{
					redirect($this->router->class.'/delicious_recipes');
				}
			}
		}
		
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  )
		{
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		//Get Recipes Data
		list( $display_data , $total_rows) =  $this->recipesmodel->get_delicious_recipes($config["per_page"],($current_page_num-1)*$config['per_page']);
		
		$config['total_rows'] = $total_rows;

			
		//Pass the Data
		$this->data['related'] = $id;
		$this->data['target_page'] =  "best_cook/view_recipes_list" ;
		$this->data['display_data'] =  $display_data;
		$this->data['members_list_flag'] =  false;
		$this->data['advanced_search_flag_hide'] =  true;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		 
		$this->load->view('template' , $this->data);
	}
	
	/* Method to display the list of the recipes of the members */
	public function your_recipes($id = "") {
		if($id != "") {
			$this->view_member_recipe($id);
			return;
		}
		
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		
		//Get Recipes Data
		list( $display_data , $total_rows) = $this->recipesmodel->get_all_members_recipes($config["per_page"],($current_page_num-1)*$config['per_page']);
		
		$config['total_rows'] = $total_rows;
				
		//Pass the Data
		$this->data['related'] = $id;
		$this->data['target_page'] =  "best_cook/view_recipes_list" ;
		$this->data['display_data'] =  $display_data;
		$this->data['members_list_flag'] =  true;
		$this->data['advanced_search_flag_hide'] =  true;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
				 
		$this->load->view('template' , $this->data);

	}
	
		/* Method to display the list of the recipes of the recipes */
	public function recipes_list($id = "")
	{
		$display_topic = $this->recipesmodel->get_topic_description($id);
        
		
		
		$title = $display_topic[0]['inseason_recipies_title'.$this->data['current_language_db_prefix']];
		
		
		//Set Headers
		$this->headers->set_third_title( $title  );
			
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method."/".$id);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  )
		{
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		//Get Recipes Data
		list( $display_data , $total_rows) = $this->recipesmodel->get_topics_list_of_recipes($id,$config["per_page"],($current_page_num-1)*$config['per_page']);
		
		$config['total_rows'] = $total_rows;
		
			
		//Pass the Data
		$this->data['target_page'] =  "best_cook/view_recipes_list" ;
		$this->data['display_data'] =  $display_data;
		$this->data['members_list_flag'] =  false;
		$this->data['advanced_search_flag_hide'] = true;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$display_img =  $display_topic[0]['images_src'];
		$this->data['display_image'] = base_url()."uploads/recipes/".$display_img;
		 
		$this->load->view('template' , $this->data);
	}
	
	public function search_results_recipes()
	{
		//Set Headers
		$this->headers->set_third_title( lang("bestcook_search_results")  );
		
		//Get Search Results
		$selected_value_of_text = isset ( $_GET['advanced_search_text'] ) ? $_GET['advanced_search_text'] : "";
		$selected_value_of_dish = isset ($_GET['advanced_search_dishes'] ) ? (int)$_GET['advanced_search_dishes'] : "";
		$selected_value_of_cuisines = isset($_GET['advanced_search_cuisines']) ?  (int)$_GET['advanced_search_cuisines'] : "";
		$selected_value_of_nestle_products = isset($_GET['advanced_search_nestle_products']) ? (int)$_GET['advanced_search_nestle_products'] : "";
		$selected_value_of_duration = isset($_GET['advanced_search_duration']) ? (int)$_GET['advanced_search_duration'] : "";
		$selected_value_of_selections = isset($_GET['advanced_search_selections']) ? (int)$_GET['advanced_search_selections'] : "";
		$selected_value_of_calories = isset($_GET['advanced_search_calories'] ) ? (int)$_GET['advanced_search_calories'] : "";

		
		
		//Handle Pagination
		//$config['base_url'] = site_url($this->router->class."/".$this->router->method);	
		$config['base_url'] = ($_SERVER['REQUEST_URI']);
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		//Get Recipes Data
		list( $display_data , $total_rows) = $display_data = $this->recipesmodel->get_all_recipes($config["per_page"],($current_page_num-1)*$config['per_page'],
		$selected_value_of_text,
		$selected_value_of_dish,
		$selected_value_of_cuisines,
		$selected_value_of_nestle_products,
		$selected_value_of_duration,
		$selected_value_of_selections,
		$selected_value_of_calories
		);
		
		$config['total_rows'] = $total_rows;
		
		
		//Pass the Data
		$this->data['target_page'] =  "best_cook/view_all_recipes" ;
		$this->data['advanced_search_flag_hide'] =  false;
		$this->data['display_data'] =  $display_data;
		$this->data['total_rows'] =  $total_rows;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "&page=",lang("globals_prev"),lang("globals_next"));
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		 
		$this->load->view('template' , $this->data);
	}/* End of search results */
	
	/* Method to display the search results of the recipes */
	public function search_results()
	{
		//Set Headers
		$this->headers->set_third_title( "نتائج البحث"  );
		
		//Get Search Results
		$selected_value_of_text = isset ( $_GET['advanced_search_text'] ) ? $_GET['advanced_search_text'] : "";
		$selected_value_of_dish = isset ($_GET['advanced_search_dishes'] ) ? (int)$_GET['advanced_search_dishes'] : "";
		$selected_value_of_cuisines = isset($_GET['advanced_search_cuisines']) ?  (int)$_GET['advanced_search_cuisines'] : "";
		$selected_value_of_nestle_products = isset($_GET['advanced_search_nestle_products']) ? (int)$_GET['advanced_search_nestle_products'] : "";
		$selected_value_of_duration = isset($_GET['advanced_search_duration']) ? (int)$_GET['advanced_search_duration'] : "";
		$selected_value_of_selections = isset($_GET['advanced_search_selections']) ? (int)$_GET['advanced_search_selections'] : "";
		$selected_value_of_calories = isset($_GET['advanced_search_calories'] ) ? (int)$_GET['advanced_search_calories'] : "";

		
		
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		//Get Recipes Data
		list( $display_data , $total_rows) = $display_data = $this->recipesmodel->get_delicious_recipes($config["per_page"],($current_page_num-1)*$config['per_page'],
		$selected_value_of_text,
		$selected_value_of_dish,
		$selected_value_of_cuisines,
		$selected_value_of_nestle_products,
		$selected_value_of_duration,
		$selected_value_of_selections,
		$selected_value_of_calories
		);
		
		$config['total_rows'] = $total_rows;
		
		//Pass the Data
		$this->data['target_page'] =  "best_cook/view_recipes_list" ;
		$this->data['display_data'] =  $display_data;
		$this->data['members_list_flag'] =  false;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		 
		$this->load->view('template' , $this->data);
	}/* End of search results */
	
	/* Method to display the search results of the members recipes */
	public function search_members_results()
	{
		//Set Headers
		$this->headers->set_third_title( "نتائج البحث"  );
		
		//Get Search Results
		$selected_value_of_text = isset ( $_GET['advanced_search_text'] ) ? $_GET['advanced_search_text'] : "";
		$selected_value_of_dish = isset ($_GET['advanced_search_dishes'] ) ? (int)$_GET['advanced_search_dishes'] : "";
		$selected_value_of_cuisines = isset($_GET['advanced_search_cuisines']) ?  (int)$_GET['advanced_search_cuisines'] : "";
		$selected_value_of_nestle_products = isset($_GET['advanced_search_nestle_products']) ? (int)$_GET['advanced_search_nestle_products'] : "";
		$selected_value_of_duration = isset($_GET['advanced_search_duration']) ? (int)$_GET['advanced_search_duration'] : "";
		$selected_value_of_selections = isset($_GET['advanced_search_selections']) ? (int)$_GET['advanced_search_selections'] : "";
		$selected_value_of_calories = isset($_GET['advanced_search_calories'] ) ? (int)$_GET['advanced_search_calories'] : "";

		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		list( $display_data , $total_rows)  = $this->recipesmodel->get_all_members_recipes($config["per_page"],($current_page_num-1)*$config['per_page'],
		$selected_value_of_text,
		$selected_value_of_dish,
		$selected_value_of_cuisines,
		$selected_value_of_nestle_products,
		$selected_value_of_duration,
		$selected_value_of_selections,
		$selected_value_of_calories
		);
		
		$config['total_rows'] = $total_rows;
		
		//Pass the Data
		$this->data['target_page'] =  "best_cook/view_recipes_list" ;
		$this->data['display_data'] =  $display_data;
		$this->data['members_list_flag'] =  true;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		 
		$this->load->view('template' , $this->data);
	}/* End of search results */
	
	public function videos_recipes()
	{
		$this->load->model("videosmodel");
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		//list( $display_data , $total_rows)  = $this->videosmodel->get_best_cook_videos($config["per_page"],($current_page_num-1)*$config['per_page']);
		 //$display_data = $this->videosmodel->get_best_cook_videos($config["per_page"],($current_page_num-1)*$config['per_page']);
		list($display_data, $total_rows) = $this->videosmodel->get_best_cook_videos($config["per_page"],($current_page_num-1)*$config['per_page']);
		//Pass the Data
		$this->data['display_data'] =  $display_data;
		//$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['target_page'] =  "best_cook/view_videos_recipes" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);

	}
	
	public function video_all()
	{
		$this->load->model("videosmodel");
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		 list($display_data, $total_rows) = $this->videosmodel->get_best_cook_videos($config["per_page"],($current_page_num-1)*$config['per_page']);
		 $config['total_rows'] = $total_rows;
		//Pass the Data
		$this->data['display_data'] =  $display_data;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['target_page'] =  "best_cook/view_videos_all" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);

	}
	
	public function all_videos()
	{
		$this->load->model("videosmodel");
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		 list($display_data, $total_rows) = $this->videosmodel->get_all_section_videos(2,$config["per_page"],($current_page_num-1)*$config['per_page']);
		 $config['total_rows'] = $total_rows;
		//Pass the Data
		$this->data['display_data'] =  $display_data;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['target_page'] =  "best_cook/view_videos_all" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);

	}
	
	/*public function videos_all()
	{
		$this->load->model("videosmodel");
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  )
		{
			$current_page_num = (int)$_GET['page'] ;
		}
				
		//Get Recipes Data
		list( $display_data , $total_rows) = $this->videosmodel->get_all_videos($config["per_page"],($current_page_num-1)*$config['per_page']);
		
		$config['total_rows'] = $total_rows;
			
		//Pass the Data
		$this->data['target_page'] =  "best_cook/view_videos_all" ;
		$this->data['display_data'] =  $display_data;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);

	}*/
	
	/*public function section()
	{
		
		//Get Filters of the current section
		$display_sections_links = $this->sectionsmodel->have_children($this->data['parent_id_of_current_sub_section']);
		
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method."/".$this->data['id_of_current_sub_section']);		
		$config['per_page'] = 4; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		list( $display_feat , $total_rows_feat)   = $this->articlesmodel->get_all_articles($config["per_page"],0,$this->data['id_of_current_sub_section'],true);
		list( $display_data , $total_rows)   = $this->articlesmodel->get_all_articles($config["per_page"],($current_page_num-1)*$config['per_page'],$this->data['id_of_current_sub_section']);
		$display_most_read_data =  $this->articlesmodel->get_most_read_articles(6,$this->data['id_of_current_sub_section']);
		$config['total_rows'] = $total_rows;
		 
		 
		
		//Pass the Data
		$this->data['target_page'] =  "view_articles" ;
		$this->data['display_sections'] = $display_sections_links;
		$this->data['display_feat'] = $display_feat;
		$this->data['display_data'] = $display_data;
		$this->data['display_most_read_data'] = $display_most_read_data;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
	 
		$this->load->view('template' , $this->data);
		
	}*/
	
	public function inner_articles($id)
	{
		if (strpos($id,'product-') !== false) {
    		$id_url = explode('-', $id);
			if(sizeof($id_url) == 2){
				redirect('products/index/'.$id_url[1].'/');
			}elseif(sizeof($id_url) == 3){
				redirect('products/product_details/'.$id_url[1].'/'.$id_url[2].'');
				}
		}elseif(strpos($id,'section-') !== false){
			
			$id_url = explode('-', $id);
			if(sizeof($id_url) == 2){
				redirect(''.$this->router->class.'/section/'.$id_url[1].'');
			}
		}elseif(strpos($id,'recipe-') !== false){
			
			$id_url = explode('-', $id);
			if(sizeof($id_url) == 2){
				redirect('best_cook/delicious_recipes/'.$id_url[1].'');
			}
		}
		
		//Fix ID
		$id = extractSeoid($id);
		$current_language_db_prefix = $this->data['current_language_db_prefix'];
		
		//Tree Menu handling
		//$this->treemenu->add_tree_page( lang("globals_home") , site_url() );		
		//$this->treemenu->add_tree_page( lang("globals_bestcook") , site_url("best_cook") );
		
		//Manage Views Counter
		$this->totalviews->add_view("articles" , $id , "articles" , "articles_views" ,$this->members->members_id );
		
		$display_article = $this->articlesmodel->get_detailed_articles($id);
		if(!$display_article){
			redirect('best_cook');
		}
		$display_related_articles = $this->articlesmodel->get_related_articles($id , "" , $current_language_db_prefix ,$display_article[0]['articles_sections_ID'] );
		
		$get_array_of_sections = $this->sectionsmodel->array_of_parent_ids($display_article[0]['articles_sections_ID']);
	
		
		for($i = ( sizeof($get_array_of_sections) -1  )  ; $i >= 0  ; $i-- ):

			$get_section_detail = $this->sectionsmodel->get_sections_details($get_array_of_sections[$i]);
			
			if($get_section_detail[0]['sub_sections_url'] != "" )
			{
				$url = str_replace("%id%",$get_section_detail[0]['sub_sections_ID'],$get_section_detail[0]['sub_sections_url']);
				$current_url = site_url($this->router->class."/".$url);
			}
			else
			{
				$current_url = "#";
			}
			
			$this->treemenu->add_tree_page( $get_section_detail[0]['sub_sections_name'.$current_language_db_prefix], $current_url);//sub_sections_url
		
		endfor;

		/*
		for($i = ( sizeof($get_array_of_sections) -1  )  ; $i >= 0  ; $i-- ):
			$get_section_detail = $this->sectionsmodel->get_sections_details($get_array_of_sections[$i]);

			$this->treemenu->add_tree_page( $get_section_detail[0]['sub_sections_name'.$current_language_db_prefix], site_url("best_cook") );
		endfor;*/
		
		//Set Page Headers
		$this->headers->set_third_title( $display_article[0]['articles_title'.$current_language_db_prefix] );
		$this->headers->set_default_image($this->config->item('articles_img_link').$display_article[0]['images_src']);
		$this->headers->set_metatag_desc( $display_article[0]['articles_brief'.$current_language_db_prefix] ) ;
				
		//Pass the Data
		$this->data['target_page'] =  "view_inner_articles" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		$this->data['display_article'] =  $display_article ;
		$this->data['display_related_articles']  = $display_related_articles;
		$this->data['parent_section_display'] = $this->sectionsmodel->get_sections_details($display_article[0]['articles_sections_ID']) ;
		
		 
		$this->load->view('template' , $this->data);
		
	}
	
	public function view_recipe($id)
	{
		//Fix ID
		$id = extractSeoid($id);
		$current_language_db_prefix = $this->data['current_language_db_prefix'];
		
		$display_data = $this->recipesmodel->get_detailed_recipe($id);

		$related_id = $this->uri->segment(5);
		
		if($related_id)
		{
			//show related recipes for inseason_topics
			$display_related_recipes = $this->recipesmodel->get_related_topics_recipes($related_id ,$id , 10 );
		}
		else
		{
			$display_related_recipes = $this->recipesmodel->get_related_recipes($id , "" , $current_language_db_prefix ,$display_data[0]['recipes_dish_id'], 10 );
		}
		
		$display_recipe_video = $this->recipesmodel->get_recipe_video($id,2); // (recipe_id,section_id)
	
		//Manage Views Counter
		$this->totalviews->add_view("recipes" , $id , "recipes" , "recipes_views" ,$this->members->members_id);
		
		//Set header in view page
		
		//Pass the Data
		$this->data['target_table'] = "recipes" ;
		$this->data['display_data'] = $display_data ;
		$this->data['display_related_recipes'] = $display_related_recipes ;
		$this->data['members_list_flag'] =  false;
		$this->data['display_recipe_video'] =  $display_recipe_video;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$desc_column  = "recipes_directions".$current_language_db_prefix;
	
		
		$this->headers->set_default_image($this->config->item('recipes_img_link').$display_data[0]['images_src']);
		$this->headers->set_metatag_desc( $display_data[0][$desc_column] ) ;
		
		//When Displaying an inner page (article, recipe) , we write the fourth title
		$this->headers->set_fourth_title( $display_data[0]['recipes_title'.$this->data['current_language_db_prefix']]  );
		$this->data['target_page'] =  "best_cook/view_inner_recipes" ;	 
		$this->load->view('template' , $this->data);
		
	}
	
	public function view_member_recipe($id) {
		//Fix ID
		$id = extractSeoid($id);
		$current_language_db_prefix = $this->data['current_language_db_prefix'];
		
		$display_data = $this->recipesmodel->get_detailed_member_recipe($id);
		if(!$display_data) {
			redirect('best_cook');
		}
		
		$display_related_recipes = $this->recipesmodel->get_members_related_recipes($id , "" , $current_language_db_prefix ,$display_data[0]['members_recipes_dish_id'] , 10 );
		$display_recipe_video = $this->recipesmodel->get_recipe_video($id, 2); //(recipe_id,section_id)
		
		//Manage Views Counter
		$this->totalviews->add_view("members_recipes" , $id , "members_recipes" , "members_recipes_views" ,$this->members->members_id );

		//Pass the Data
		
		$this->data['target_table'] = "members_recipes" ;
		$this->data['display_data'] = $display_data ;
		$this->data['display_related_recipes'] = $display_related_recipes ;
		$this->data['members_list_flag'] =  true;
		$this->data['display_recipe_video'] =  $display_recipe_video;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$desc_column  =  "members_recipes_directions" ;
		
		
		$this->headers->set_default_image($this->config->item('users_recipes_img_link').$display_data[0]['images_src']);
		$this->headers->set_metatag_desc( $display_data[0][$desc_column] ) ;
		
		//When Displaying an inner page (article, recipe) , we write the fourth title
		$this->headers->set_fourth_title( $display_data[0]['members_recipes_name']  );
	 	$this->data['target_page'] =  "best_cook/view_inner_recipes" ;
		$this->load->view('template' , $this->data);
		
	}
	
	public function upload_member_recipe()
	{
		$this->load->model('membersmodel');
		
		foreach ($_FILES["images"]["error"] as $key => $error) 
		{
			if ($error == UPLOAD_ERR_OK) 
			{
				$name = $_FILES["images"]["name"][$key];
				
				$path_parts = pathinfo($name);
				$image_path = $path_parts['filename'].'_'.time().'.'.$path_parts['extension'];
				
				move_uploaded_file( $_FILES["images"]["tmp_name"][$key], "uploads/test/" . $image_path); //  uploads/recipes
			}
		}
		$form_array = array('images_src' => $image_path,'images_date' => time());
	
		$state = $this->membersmodel->insert_member_image($form_array);
	
		$array_of_result['id'] = $state;
		$array_of_result['name'] = $image_path;
		
		echo json_encode($array_of_result);
		
	}

	public function upload_recipe($success= "")
	{
		if(!$this->members->members_id && $success=='success')
		{
			$this->data['target_page'] = "best_cook/view_upload_recipe";
		}
		else if($this->members->members_id && $success=='success')
		{
			$this->data['target_page'] = "best_cook/view_upload_recipe";
		}
		//Prepare Form Fields
		$this->form_validation->set_rules('members_recipes_name', 'إسم الوصفة', 'required');			
		//$this->form_validation->set_rules('members_recipes_dish_id', 'نوع الطبق', 'required');			
		//$this->form_validation->set_rules('members_recipes_cookingtime', 'مدة التحضير', 'required');			
		//$this->form_validation->set_rules('members_recipes_directions', 'المكونات', 'required');			
		/*$this->form_validation->set_rules('members_recipes_image', 'الصورة', 'required');*/
		
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
		
		$this->data['target_page'] = "best_cook/view_upload_recipe";
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			
			$this->data['target_page'] = "best_cook/view_upload_recipe";
		}//End of validation->run()
		else // passed validation proceed to post success logic
		{
			//echo "Hre";
			$uploaded_image = $_POST['image_uploaded_name'];
			
			/* Move Image (AJax uploaded mode) */
			rename("./server/php/files/".$uploaded_image,"./uploads/users_recipes/".$uploaded_image );
			//echo "Hre2";
			
			$this->load->library("resizeclass");
			$this->resizeclass->loadimage('./uploads/users_recipes/'.$uploaded_image);
			list($current_image_width, $current_image_height) = getimagesize('./uploads/users_recipes/'.$uploaded_image);
			if($current_image_width > 470)
			{
				$this->resizeclass->fit_to_width(470);
				$this->resizeclass->saveImage('./uploads/users_recipes/'.$uploaded_image, 80);						
			}
			$this->resizeclass->resizeImage(75,75,"crop");
			$this->resizeclass->saveImage('./uploads/users_recipes/thumb_'.$uploaded_image, 100);
			
			
			$new_image_id = $this->resizeclass->insertimagetodb($uploaded_image);
			
			$video_url = $this->input->post('members_recipes_url');
			
			$form_data = array(
					       	'members_recipes_name' => $this->input->post('members_recipes_name'),
					       	'members_recipes_dish_id' => $this->input->post('members_recipes_dish_id'),
							//'members_recipes_url' => $this->input->post('members_recipes_url'),
					       	'members_recipes_cookingtime' => $this->input->post('members_recipes_cookingtime'),
					       	'members_recipes_directions' => $this->input->post('members_recipes_directions'),
							'members_recipes_ing' => $this->input->post('members_recipes_ing'),
							'members_recipes_cuisine_id' => $this->input->post('members_recipes_cuisine_id'),
							'members_recipes_product_id' => $this->input->post('members_recipes_product_id'),
							'members_recipes_calories' => $this->input->post('members_recipes_calories'),
							'members_recipes_selection_id' => $this->input->post('members_recipes_selection_id'),
					       	'members_recipes_image' => $new_image_id,
							'members_recipes_members_id' => $this->members->members_id
						);
						
			// run insert model to write data to db
			
			
			
			if($member_recipe_id = $this->membersmodel->add_member_recipe($form_data)) // the information has therefore been successfully saved in the db
			{
				if($video_url)
				{
					$form_video = array(
					'videos_section_id' => 2,
					'videos_foreign_id' => $member_recipe_id,
					'videos_name' => $this->input->post('members_recipes_name'),
					'videos_url' => $video_url,
					'videos_member_flag' => 1,
					);
					// Sending emial
					$data['name'] = $this->members->members_fullname;
					$data['recipe_id'] = $member_recipe_id;
					$data['recipe_title'] = $form_data['members_recipes_name'];
					$data['recipe_image'] = base_url().'/uploads/users_recipes/'.$uploaded_image;
					$this->load->library('emailmanager');
					$this->emailmanager->send_email($this->members->members_email,"Upload Recipe",$data,'email_user_upload_recipe');
					
					$this->membersmodel->add_member_video($form_video);
					
				}
				
				
				
				//redirect('best_cook/upload_recipe/success');   // or whatever logic needs to occur
				//$this->data['success']="success";
				
			    $success="success";
				$this->data['target_page'] =  "best_cook/view_upload_recipe/success" ;
			}
			else
			{
			
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}
		}
		//echo "Hre3";
		//Get Latest Members Recipe
		list( $display_recent_data , $total_rows) = $this->recipesmodel->get_all_members_recipes(8,0);
		
		//Pass the Data
		$this->data['target_page'] =  "best_cook/view_upload_recipe" ;
		$this->data['display_recent_data'] =  $display_recent_data ;
		$this->data['members_list_flag'] =  true;
		$this->data['success'] =  $success;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	 
		$this->load->view('template' , $this->data);
		
	}//End of upload recipe
	public function cooking_class()
	{
		//Pass the Data
		$this->data['target_page'] =  "best_cook/deros_tab5_app/landing_page" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */