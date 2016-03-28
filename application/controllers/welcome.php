<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

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
	 
   public function __construct()
   {
		parent::__construct();
		
		//Load Language
		$this->load->helper('language');
		$this->lang->load('bestcook');
		$this->lang->load('globals');
		
		//load Form
		$this->load->helper('form');
		
		
		//load Models
		
		//Pass the Data
		$this->data = array();
		
		$site_lang = $this->config->item('language');
		$this->data['current_language'] =  $site_lang;
		$this->data['current_language_db_prefix'] =   $site_lang == "arabic" ? "_ar" : "";
		
		//Apply Drawings
		$this->data['apply_outer_drawings'] = false;
		$this->data['header_left_outer_drawings_src'] = base_url()."images/homepage/homepage_left_drawings".$this->data['current_language_db_prefix'].".png";
		$this->data['header_right_outer_drawings_src'] = base_url()."images/homepage/homepage_right_drawings".$this->data['current_language_db_prefix'].".png";
 
		 
		
   }
	public function index()
	{
		$this->load->library('widgets');
		$this->lang->load('globals');
		$this->lang->load('bestcook');
		$this->lang->load('bestmom');
		$this->load->model("articlesmodel");
		$this->load->model("recipesmodel");
		$this->load->model("globalmodel");
		$this->load->model("quizesmodel");
		$this->load->model("videosmodel");
		
		
		$this->data['display_homepage_slideshow'] =  $this->globalmodel->get_homepage_slideshow($this->data['current_language_db_prefix']);

	    $this->data['display_bestcook_last_recipes'] =  $this->recipesmodel->get_last_recipes();
		$this->data['display_bestcook_members_last_recipes'] =  $this->recipesmodel->get_last_members_recipes();
		$this->data['display_bestcook_members_inseason_recipes'] =  $this->recipesmodel->get_current_inseason_recipes();
		$this->data['display_bestcook_most_read_recipes'] =  $this->recipesmodel->get_most_read_recipes(4);
		$this->data['display_featured_video'] = $this->videosmodel->get_featured_video(2,1);
		
		//63 is the parent sub section, but we will pass the children
		$this->data['display_bestmom_7amly'] =  $this->articlesmodel->get_feautred_homepage_articles(array(66,67,68,69,70));
		//63 is the parent sub section, but we will pass the children
		$this->data['display_bestmom_baby'] =  $this->articlesmodel->get_feautred_homepage_articles(array(76,78,73,80,79,75,81));
		//64 is the parent sub section, but we will pass the children
		$this->data['display_bestmom_growup'] =  $this->articlesmodel->get_feautred_homepage_articles(array(87,85,86,88));

		$this->data['display_bestme_family_life'] = $this->articlesmodel->get_feautred_articles(13);
		$this->data['display_bestme_fitness'] = $this->articlesmodel->get_feautred_articles(14);
		//15 is the parent sub section, but we will pass the children
		$this->data['display_bestme_food'] = $this->articlesmodel->get_feautred_homepage_articles(array(32,33));
		//16 is the parent sub section, but we will pass the children
		$this->data['display_bestme_beauty'] = $this->articlesmodel->get_feautred_homepage_articles(array(44,45));
		
		$this->data['display_besttime_wakeup_for_life'] = $this->articlesmodel->get_feautred_articles(47);
		$this->data['display_besttime_your_time'] = $this->articlesmodel->get_feautred_articles(49);
		//$this->data['display_besttime_easy_ideas'] = $this->articlesmodel->get_feautred_articles(183);
		//$this->data['display_besttime_fashion'] = $this->articlesmodel->get_feautred_articles(184);
		
		list( $display_fdata , $total_rows) =$this->quizesmodel->get_all_fashion(1,0);
		list( $display_edata , $total_rows) =$this->quizesmodel->get_all_easy_tips(1,0);
		$this->data['display_fdata'] = $display_fdata;
		$this->data['display_edata'] = $display_edata;
		
		$this->data['display_bestcook_applications'] =  $this->globalmodel->get_applications($this->data['current_language_db_prefix'],2,132);
		$this->data['display_bestmom_applications'] =  $this->globalmodel->get_applications($this->data['current_language_db_prefix'],27,180);
		$this->data['display_bestme_applications'] =  $this->globalmodel->get_applications($this->data['current_language_db_prefix'],10,130);

		$this->data['display_bestme_expert'] = $this->globalmodel->get_ask_expert_homepage(10,4,$this->data['current_language_db_prefix']);
		$this->data['display_bestmom_expert'] = $this->globalmodel->get_ask_expert_homepage(27,5,$this->data['current_language_db_prefix']);
		$this->data['get_random_product_videos'] =  $this->globalmodel->get_latest_videos_homepage();
		
		$this->data['display_besttime_games'] =  $this->globalmodel->get_games($this->data['current_language_db_prefix'],50);
		$this->data['display_besttime_quiz'] =  $this->quizesmodel->get_featured_quize('quiz',$this->data['current_language_db_prefix']);
		$this->data['display_besttime_life_coach'] = $this->articlesmodel->get_feautred_articles(187);
		
		
		$this->data['display_promotions'] = $this->globalmodel->get_products_promotions();
		
		//Check if Member is set
		$this->data['display_custom_sections_member_order'] = false;
		if($this->members->members_id)
		{
			//Check if Current member has a custom order
			$display_members_custom_order = $this->membersmodel->get_members_sections_order($this->members->members_id);
			if(!empty($display_members_custom_order))
			{
				$this->data['display_custom_sections_member_order'] = $display_members_custom_order;
			}
			
		}
		 
		$this->data['target_page'] =  "view_homepage" ;
		$this->data['is_mainhomepage'] =  true;
		
		 
		
		$this->load->view('template' , $this->data);

	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */