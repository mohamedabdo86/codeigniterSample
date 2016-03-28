<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Best_me extends MY_Controller {
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
		$this->lang->load('bestme');
		$this->lang->load('bestcook');
		$this->lang->load('mycorner');
		
		
				
		//Set Section name
		$this->headers->set_second_title( lang("globals_bestme") );
		
		
		//Initlize common data 
		$this->data = array();
		$this->data['current_section_id'] =  10;
		
		//Apply Languages
		$site_lang = $this->config->item('language');
		$this->data['current_language'] =  $site_lang;
		$this->data['current_language_db_prefix'] =   $site_lang == "arabic" ? "_ar" : "";
		
		//Apply Drawings
		$this->data['apply_outer_drawings'] = true;
		$this->data['header_left_outer_drawings_src'] = base_url()."images/bestme/bestme_left_drawings".$this->data['current_language_db_prefix'].".png";
		$this->data['header_right_outer_drawings_src'] = base_url()."images/bestme/bestme_right_drawings".$this->data['current_language_db_prefix'].".png";
		
		//Apply Sections Color
		$this->data['current_section_color'] = "best_me_color";
		$this->data['current_section_background_color'] = "best_me_background_color";
		$this->data['current_section_background_color_featured_title'] = "best_me_background_color_featured_title";
		$this->data['current_section_border_color'] = "best_me_border_color";
		$this->data['current_section_borderbottom_color'] = "best_me_borderbottom_color";
		
		//Apply Default Subsections ID
		$this->data['id_of_current_sub_section'] =  false;
		$this->data['parent_id_of_current_sub_section'] =  false;
		
		//Tree Menu handling (This will write first and second url)
		$this->treemenu->add_tree_page( lang("globals_home") , site_url('welcome') );		
		$this->treemenu->add_tree_page( lang("globals_bestme") , site_url($this->router->class) );
		
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
	 	$this->data['ask_an_expert_form_background'] = base_url()."images/bestme/ask_an_expert_background".$this->data['current_language_db_prefix'].".png";
		
		
   }
 
	public function index()
	{

		$this->load->library('widgets');
		$this->load->model("videosmodel");
		
		list($display_ask_an_expert , $total_rows) = $this->globalmodel->get_ask_expert_questions(1,0,$this->data['current_section_id'], $this->data['current_language_db_prefix'],1);
		$display_expert = $this->globalmodel->get_expert($this->data['current_section_id']);
		
		//Pass the Data
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array();
		$this->data['display_applications'] =  $this->globalmodel->get_applications($this->data['current_language_db_prefix'],$this->data['current_section_id'],130);
		$this->data['display_section_slideshow'] =  $this->globalmodel->get_sections_slideshow($this->data['current_section_id'],$this->data['current_language_db_prefix']);
		$this->data['display_section_tips'] =  $this->globalmodel->get_sections_tips($this->data['current_section_id']);
		$this->data['display_featured_video'] = $this->videosmodel->get_featured_video(10,1);

		$this->data['target_page'] =  "best_me/view_bestme_homepage" ;
		//$this->data['display_recent_recipes'] = $this->recipesmodel->get_recent_recipes();
		$this->data['display_recent_articles'] =  $this->articlesmodel->get_recent_articles(2 , array(13 , 14 , 15 , 16 ));
		$this->data['display_feautre_family_life'] =  $this->articlesmodel->get_feautred_articles(13);
		$this->data['display_feautre_fitness'] =  $this->articlesmodel->get_feautred_articles(14);
		//$this->data['display_best_advice'] =  $this->globalmodel->get_best_advice(1);
		$this->data['display_ask_an_expert'] = $display_ask_an_expert;
		$this->data['display_expert'] = $display_expert;
		
		
		$this->load->view('template' , $this->data); 

	}

	public function submit_app()
	{
		$this->load->model("membersmodel");
		$this->load->library("members");
		$this->load->library("emailmanager");
		if($this->input->post('register') == true)
		{
			$this->form_validation->set_rules("members_name", lang('bestme_dietapp_name'), "trim|required|advanced_firstlastname|min_length[2]");
			$this->form_validation->set_rules("members_email", lang('mycorner_email'), "trim|required|valid_email");
			$this->form_validation->set_rules("members_height", lang('bestme_dietapp_Length '), "trim|required|numeric|max_length_number[3]");
			$this->form_validation->set_rules("members_weight", lang('bestme_dietapp_wight '), "trim|required|numeric|max_length_number[3]");
			$this->form_validation->set_rules("members_mobile", lang('mycorner_mobile'), "trim|required|numeric|max_length_number[11]");
			$this->form_validation->set_rules("members_phone", lang('mycorner_mobile'), "trim|required|numeric|max_length_number[11]");
			$this->form_validation->set_rules("members_sport", lang('bestme_fitapp_type_sport'), "trim|required");
			$this->form_validation->set_rules("members_healthy", lang('bestme_dietapp_health'), "trim|required");
			$this->form_validation->set_rules("members_call_time", lang('bestme_dietapp_call_time'), "required");
			
			if($this->form_validation->run() == true)
			{
				$name = $this->input->post('members_name');
				$email = $this->input->post('members_email');
				$members_gender = $this->input->post('members_gender');
				$members_birthdate = $this->input->post('members_birthdate');
				$members_height = $this->input->post('members_height');
				$members_weight = $this->input->post('members_weight');
				$members_sport = $this->input->post('members_sport');
				$members_healthy = $this->input->post('members_healthy');
				
				$members_mobile = $this->input->post('members_mobile');
				$members_phone = $this->input->post('members_phone');
				$members_call_time = $this->input->post('members_call_time');
				$member_id = $this->members->members_id;
				
				$form_data = array(
			
					'members_app_name' => $name,
					'members_app_mail' => $email,
					'members_app_gender' => $members_gender,
					'members_app_birthdate' => $members_birthdate,
					'members_app_height' => $members_height,
					'members_app_weight' =>$members_weight,
					'members_app_sport' => $members_sport,
					'members_app_healthy' => $members_healthy,
					'members_app_mobile' => "0".$members_mobile,
					'members_app_phone' => "0".$members_phone,
					'members_app_call_time' => $members_call_time,
					'members_app_member_id' => $member_id
					);
								
					$currnet_member_id = $this->membersmodel->add_member_app($form_data);
					
					 // Send e-mail to member
					$data['name'] =  $name;
					$data['members_email'] =  $email;	
					$data['members_gender'] =  $members_gender;	
					$data['members_birthdate'] =  $members_birthdate;	
					$data['members_height'] =  $members_height;	
					$data['members_weight'] =  $members_weight;	
					$data['members_sport'] =  $members_sport;	
					$data['members_healthy'] =  $members_healthy;	
					$data['members_mobile'] =  $members_mobile;	
					$data['members_phone'] =  $members_phone;	
					$data['members_call_time'] =  $members_call_time;			
					if($this->members->members_language == "arabic")
					{
						$send = $this->emailmanager->send_email($email ,"رجيمك الخاص",$data,'email_diet_app');
					}
					else
					{
						$send = $this->emailmanager->send_email($email ,"Your Diet App",$data,'email_diet_app_en');
					}
					$this->emailmanager->send_admin_email('consumer.services@eg.nestle.com' ,"New Member Diet Data",$data,'email_diet_app_cons_en');
					//application.egEngage-email_test@eg.nestle.com
					//consumer.services@eg.nestle.com
					if($send)
					{
						redirect('best_me/applications/8/success?display_box=true&message_type=success&messagecode=0');
					}
					
			}
			else
			{
				$this->data['target_page'] =  "best_me/diet_app/landing_page";
				$this->load->view('template' , $this->data);
			}
			
		}
		else
		{
			redirect('best_me/applications/8');
		}
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
		
		 list($display_data, $total_rows) = $this->videosmodel->get_all_section_videos(10,$config["per_page"],($current_page_num-1)*$config['per_page']);
		 $config['total_rows'] = $total_rows;
		//Pass the Data
		$this->data['display_data'] =  $display_data;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['target_page'] =  "best_me/view_videos_all" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);

	}

   public function add_new_weight() 
   {
		$this->load->model("nestlefitmodel");
		$user_name = $this->input->post('user_name');
		$birthday = $this->input->post('birthday');
		$url=$this->input->post('url');
		$current_weight = $this->input->post('your_current_weight');
		$nestle_fit_health_member_id = $this->input->post('nestle_fit_health_member_id');
		$data = array(
			'nestle_fit_health_weights_weight' => $current_weight,
			'nestle_fit_health_weights_nestle_fit_health_ID' => $nestle_fit_health_member_id,
			'nestle_fit_health_weights_date' => date('Y-m-d'),
		);
		
		
		$data3=array(
		'nestle_fit_health_name'=> $user_name,
		'nestle_fit_health_birthday'=>$birthday,
		);
		
		$status = $this->nestlefitmodel->add_new_weight($data,$data3,$nestle_fit_health_member_id);
		if($status)
		{
			redirect($url);
		}	  
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */