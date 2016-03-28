<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of best_cook
 *Author : Ahmed Bermawy
 * 
 */
class best_cook extends MY_Mcontroller
{

    //put  code here
    public function __construct()
    {
        parent::__construct();

        // Your own constructor code
        $this->load->model("articlesmodel");
		$this->load->model("recipesmodel");
		$this->load->model("membersmodel");
		
		//Load Languages
		$this->load->helper('language');
		$this->lang->load('globals');
		$this->lang->load('bestcook');
		$this->lang->load('mycorner');
		$this->lang->load('newsletter');
		$this->lang->load('upload');
		
		//Set Section name
		$this->headers->set_second_title( lang("globals_bestcook") );
		
		//Initlize common data
		$this->data = array();
		$this->data['current_section_id'] =  2;
		
		//Apply Languages
		$site_lang = $this->config->item('language');
		$this->data['current_language'] =  $site_lang;
		$this->data['current_language_db_prefix'] = $site_lang == "arabic" ? "_ar" : "";
		
        //Apply Sections Color
        $this->data['current_section'] = "best-cook";
		$this->data['imageFolder'] = "bestcook";
		$this->data['current_section_color'] = "best_cook_color";
		

        //Apply Default Subsections ID
        $this->data['id_of_current_sub_section'] = false;
        $this->data['parent_id_of_current_sub_section'] = false;
		
		//Send ID if applicable
		$dynamic_id = $this->uri->segment(5);
		
		//Get Current Section Data
		$current_section_data = $this->sectionsmodel->get_active_sub_section_data($this->router->fetch_method() , $this->data['current_section_id'],$dynamic_id);
		if( !empty($current_section_data) ):
			$title_of_current_section = $current_section_data[0]['sub_sections_name'.$this->data['current_language_db_prefix']];
			$id_of_current_sub_section  = $current_section_data[0]['sub_sections_ID'];
			$parent_id_of_current_sub_section  = $current_section_data[0]['sub_sections_parent'];
			$url = $current_section_data[0]['sub_sections_url'];
			
			//Set Headers
			$this->headers->set_third_title( $title_of_current_section  );
			$this->data['id_of_current_sub_section'] = $id_of_current_sub_section;
			$this->data['parent_id_of_current_sub_section'] = $parent_id_of_current_sub_section;
		endif;
		
		//Set Section Icon
		$this->data['section_icon'] = base_url().'images/bestcook/bestcook_inner_slideshow_logo.png';
        	$this->load->model("videosmodel");
		$this->data['ask_an_expert_top_banner'] = base_url()."images/bestcook/bestcook_ask_an_expert_bc.png";
    }
	
	 public function index()
    {

	
        
		$this->data['display_topics'] = $this->recipesmodel->get_topics_recipes(8);
		$this->data['display_featured_video'] = $this->videosmodel->get_featured_video(2,1);
		//$this->data['display_topics'] = $this->recipesmodel->get_topics_recipes();
		$this->data['display_recent_articles'] =  $this->articlesmodel->get_recent_articles(4 , array(19 , 20 ));
		$this->data['common_row'] = $this->get_common_row();
		$this->data['target_page'] = "best_cook/homepage";
        $this->load->view('mobile/template', $this->data);
    }


	/* Function Create Member  Registration*/
	public function create_my_corner($key = "")
	{
//		if($this->members->members_id)
//		{
//			redirect('');
//		}
		$this->lang->load('bestcook');
		$this->load->library("form_validation");  // load form_validation library
		/*if(  $this->form_validation->run() == FALSE )  
		{
			$this->load->view("my_corner/registeration");
		}
		else 
		{
			$this->load->model("membersmodel");
	
			if( $query =  $this->membersmodel->insert_register_form() )  
			{
			   // redirect("site/members_area");
				 $this->data['target_page'] =  "signup_success" ;
				 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
				 $this->load->view('template' , $this->data);
			
			}
			else 
			{
				$this->load->view("my_corner/registeration");
			}
		}*/
		if($this->input->post('register') == true)
		{
			//$this->form_validation->set_rules("password", "Enter Password", "trim|required|min_length[4]|max_length[32]");
			//$this->form_validation->set_rules("repeat_password", "Confirm password", "trim|required|matches[password]");
			//$this->form_validation->set_rules("email", "Email Address", "trim|required|valid_email")
			$this->form_validation->set_rules("username", lang('mycorner_name'), "trim|required|advanced_username|username_found|min_length[4]|max_length[20]");
			$this->form_validation->set_rules("first_name", lang('mycorner_firstname'), "trim|required|advanced_firstlastname|min_length[2]");
			$this->form_validation->set_rules("last_name", lang('mycorner_lastname'), "trim|required|advanced_firstlastname|min_length[2]");
			$this->form_validation->set_rules("members_password", lang('mycorner_password'), "trim|required|advanced_password");
			$this->form_validation->set_rules("repeat_password", lang('mycorner_confirmpasssword'), "trim|required|advanced_password|matches[members_password]");
			$this->form_validation->set_rules("members_email", lang('mycorner_email'), "trim|required|valid_email|email_found");
			$this->form_validation->set_rules("members_mobile", lang('mycorner_mobile'), "trim|required|numeric|max_length_number[11]");
			$this->form_validation->set_message('matches', lang('mycorner_caution_password_repeat'));
			$this->form_validation->set_message('valid_email', lang('mycorner_caution_email'));
			$this->form_validation->set_message('advanced_password', lang('mycorner_caution_password'));
			$this->form_validation->set_message('advanced_username', lang('mycorner_caution_username_min'));
			$this->form_validation->set_message('advanced_firstlastname', lang('mycorner_caution_name'));
			if($this->form_validation->run() == false)
			{
			}
			else
			{
				$form_data = array(
						'members_nickname' => $this->input->post('username'),
						'members_first_name' => $this->input->post('first_name'),
						'members_last_name' => $this->input->post('last_name'),
						'members_email' => $this->input->post('members_email'),
						'members_password' =>$this->input->post('members_password'),
						'members_birthdate' => $this->input->post('members_birthdate'),
						'members_mobile' => $this->input->post('members_mobile'),
						'members_lang' => $this->input->post('members_lang'),
						'members_relationship_id' => $this->input->post('members_relationship_id'),
						'members_addeddate' => date("Y-m-d H:i:s"),
						'members_fb_id' => $this->input->post('members_fb_id'),
						'members_access_token' => $this->input->post('members_access_token'),
						'members_newsletter' => $this->input->post('newsletter'),
				);
				
				//Pass Data to library to create encrypted password, salt and activation code
				
				//$currnet_member_id = $this->membersmodel->insert_register_form($form_data);
				$currnet_member_id = $this->members->sign_up($form_data);
				
				// Check if user registered throw invitation
				$key_value = $this->input->post('key');
				$get_user_id = $this->membersmodel->points_invitation($key_value);
				
				if($get_user_id)
				{
					$this->membersmodel->add_user_points($get_user_id, 'confirm_invitation');
				}
				
				if($currnet_member_id)
				{
					$baby_month = $this->input->post('baby_month');
					if($baby_month)
					{
						date_default_timezone_set("Egypt");
						$form_array = array(
								'pregnancy_month' => $baby_month,
								'pregnancy_members_email' => $this->input->post('members_email'),
								'pregnancy_date' => date("Y-m-d H:i:s"),
						);
				
						$this->membersmodel->insert_pregnancy($form_array);
					}
				
					$array_of_ids =  $this->input->post('newsletter_members_members_id');
					$array_of_names =  $this->input->post('children_name');
					$array_of_ages = $this->input->post('children_age');
						
					if($array_of_names)
					{
						for($i = 0; $i<sizeof($array_of_names) ; $i++)
						{
							$names	 = $array_of_names[$i];
							$ages = $array_of_ages[$i];
							
							$form_array = array(
								'members_children_name' => $names,
								'members_children_age' => $ages,
								'members_children_members_id' => $currnet_member_id,
								);
							
							$this->membersmodel->insert_childern($form_array);
						}
				
					}
							
					if($array_of_ids)
					{
						for($i = 0; $i<sizeof($array_of_ids) ; $i++)
						{
							$ids = $array_of_ids[$i];
							$form_array = array(
                                                                'newsletter_members_members_emails' => $this->input->post('members_email'),
                                                                'newsletter_members_newsletter_types_id' => $ids,
									    );
							$this->membersmodel->insert_newsletter_members($form_array);
						}
					}
					//redirect('signup_success/'.$currnet_member_id.'?display_box=true&message_type=account_confirmed&messagecode=3');
				}
			}
		}

		 $this->data['relationship'] =  $this->membersmodel->get_relationship($this->data['current_language_db_prefix'] , true , lang("mycorner_relationship"));
		 $this->data['newsletter'] =  $this->membersmodel->get_newsletter($this->data['current_language_db_prefix'] , false , lang("mycorner_newsletter"));
		 $this->data['key'] =  $key ;
		 $this->data['target_page'] =  "best_cook/user_registeration" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	     $this->load->view('mobile/template' , $this->data);
  
 	 }
	/*end function create_my_corner*/
		public function signup_success
		
		
		($members_id)
	{
		//Fix ID
		$members_id = extractSeoid($members_id);
		 
		if($this->input->post('update') == true)
		{
			$image_flage = $this->input->post('image_uploaded_flag');
				
			if($image_flage == 1)
			{
			$uploaded_image = $_POST['image_uploaded_name'];
			/* Move Image (AJax uploaded mode) */
			rename("./server/php/files/".$uploaded_image,"./uploads/members/".$uploaded_image );
			//echo "Hre2";
			
			$this->load->library("resizeclass");
			$this->resizeclass->loadimage('./uploads/members/'.$uploaded_image);
			$this->resizeclass->resizeImage(75,75,"crop");
			$this->resizeclass->saveImage('./uploads/members/thumb_'.$uploaded_image, 100);
			
			$new_image_id = $this->resizeclass->insertimagetodb($uploaded_image);

			$form_data = array('members_images' => $new_image_id);
			}
			else
			{
				$form_data = array('members_images' => 0);
			}

			if ($this->membersmodel->second_step($form_data , $members_id) == TRUE) // the information has therefore been successfully saved in the db
			{
				$this->load->library("members");
				$this->members->set_members_data($members_id);
				
				redirect('profile');   // or whatever logic needs to occur
			}
			else
			{
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}
		}
		 
		 $this->data['members_id'] = $members_id;
		 $this->data['target_page'] = "best_cook/second_step" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	     $this->load->view('mobile/template' , $this->data);
	}
	
	

   /* public function recipe()
    {
        $this->load->library('mwidgets');

        $this->data['target_page'] = "best_cook/recipe-inner";
        $this->load->view('mobile/template', $this->data);
    }*/
	
	public function search_results_recipes()
	{
		//Set Headers
	//	$this->headers->set_third_title( lang("bestcook_search_results")  );
		
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
		$this->data['target_page'] =  "best_cook/view-all-recipes" ;
		$this->data['advanced_search_flag_hide'] =  false;
		
		$this->data['display_data'] =  $display_data;
		$this->data['total_rows'] =  $total_rows;
		$this->data['pagination_links'] = getMPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "&page=",lang("globals_prev"),lang("globals_next"));
		//$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		 
		$this->load->view('mobile/template' , $this->data);
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
		
		 
		$this->load->view('mobile/template' , $this->data);
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
		
		 
		$this->load->view('mobile/template' , $this->data);
	}/* End of search results */
	
	
	
	
	
	protected function get_common_row()
	{
		
		return $this->load->view('mobile/best_cook/common_row',$this->data,true);
	}
	
	
			/* Method to display the list of the recipes of the recipes */
	public function recipes_list($id = "")
	{
		$display_topic = $this->recipesmodel->get_topic_description($id);
		
		$title = $display_topic[0]['inseason_recipies_title'.$this->data['current_language_db_prefix']];
		
		
		//Set Headers
		$this->headers->set_third_title( $title  );
			
		//Handle Pagination
		$config['base_url'] = site_url('mobile/' . $this->router->class."/".$this->router->method."/".$id);		
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
		$this->data['pagination_links'] = getMPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		 
		$this->load->view('mobile/template' , $this->data);
	}


	
		public function my_points(){
		$members_id = $this->members->members_id;

	//	 if (empty($members_id)) 
//		 {
//			redirect('welcome');
//		 }
		 
		$this->data['display_points'] =  $this->membersmodel->get_points();
		$this->data['display_awards'] =  $this->membersmodel->get_awards();
		$this->data['target_page'] =  "my_corner/view_my_points" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		$this->load->view('mobile/template' , $this->data);
	}
	
	
	public function profile($newsletter = 0)
	{
		 $this->load->helper('form');
		 $this->load->model('membersmodel');
		 $members_id = $this->members->members_id;
		  if (empty($members_id)) 
		 {
			redirect('mobile/welcome');
		 }
		 
		 $members_email = $this->members->members_email;
		 $members_points = $this->members->members_points;
		 $display_prizes = $this->membersmodel->get_member_awards($members_points);
		 $display_get_prize = $this->membersmodel->display_get_prize($members_id);
		
		 $this->data['display_prizes'] = $display_prizes;
		 $this->data['display_get_prize'] = $display_get_prize;
		
		
		 
		 $this->data['members_id'] = $members_id;
		 $members_info = $this->data['members_info'] = $this->membersmodel->get_member_info($members_id);
		 
		 if(!$members_info[0]['members_images'] or $members_info[0]['members_images'] == 0)
		 {
			  $this->data['current_member_image'] = 'personal_img.png';
		 }
		 else
		 {
			 $image_src = $this->membersmodel->get_member_image($members_id);
			 $this->data['current_member_image']  = $image_src[0]['images_src'];
		 }
		 
		 $this->data['display_trophies'] = $this->membersmodel->get_members_trophies($members_id);
		 $this->data['unsubscribe_newsletter'] = $newsletter;
		 $this->data['members_newsletter'] = $this->membersmodel->get_members_newsletter($members_email);
		 $this->data['newsletter'] =  $this->membersmodel->get_newsletter($this->data['current_language_db_prefix'] , false , lang("mycorner_newsletter"));
		 $this->data['members_nonselected_newsletter'] = $this->membersmodel->get_members_nonselected_newsletter($members_email);
		 $this->data['members_children'] = $this->membersmodel->get_childern($members_id);
		 $this->data['members_section_order'] = $this->membersmodel->get_members_section_order($members_id);
		 $this->data['target_page'] =  "my_corner/view_my_profile" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	     $this->load->view('mobile/template' , $this->data);
	}
	
	
		public function my_articles()
	{
		 //Pass the Data
		 $this->load->model('membersmodel');
		 $members_id = $this->members->members_id;	
		 // if (empty($members_id)) 
//		 {
//			redirect('welcome');
//		 }
		 
		
		 $this->data['members_books'] =  $this->membersmodel->get_members_book($members_id , 'articles') ;
		 $this->data['target_page'] =  "best_cook/my_articles" ;
		 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	  	$this->load->view('mobile/template' , $this->data);
		
	}
	public function my_recipies_book()
	{
		//Pass the Data
		 $this->load->model('membersmodel');
		 $members_id = $this->members->members_id;
		// if (empty($members_id)) 
//		 {
//			redirect('welcome');
//		 }
		
		 $this->data['members_books'] =  $this->membersmodel->get_members_book($members_id , 'recipes') ;
		
		 $this->data['target_page'] =  "best_cook/my_recipies_book" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		 $this->load->view('mobile/template' , $this->data);
		
	}

	
	public function delete_user_favourites($id){
		$user_id = $this->members->members_id;
		$this->membersmodel->delete_user_favourites($id, $user_id);
		
	}


		public function delicious_recipes($id = "")
	{
		if($id != "")
		{
			$this->view_recipe($id);
			return;
		}
		
		//Handle Pagination
		$config['base_url'] = site_url_mobile('mobile/' . $this->router->class."/".$this->router->method);		
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
		$this->data['target_page'] =  "best_cook/view_recipes_list" ;
		$this->data['display_data'] =  $display_data;
		$this->data['members_list_flag'] =  false;
		$this->data['advanced_search_flag_hide'] =  true;
		$this->data['pagination_links'] = getMPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		 
		$this->load->view('mobile/template' , $this->data);
	}
		public function your_recipes($id = "")
		{
		if($id != "")
		{
			$this->view_member_recipe($id);return;
		}
		
		//Handle Pagination
		$config['base_url'] = site_url_mobile($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1

		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		$display_data = $this->recipesmodel->get_detailed_recipe($id);
		//$display_related_recipes = $this->recipesmodel->get_related_recipes($id , "" , $current_language_db_prefix ,$display_data[0]['recipes_dish_id'], 10 );
		//Get Recipes Data
		list( $display_data , $total_rows) = $this->recipesmodel->get_all_members_recipes($config["per_page"],($current_page_num-1)*$config['per_page']);
		
		$config['total_rows'] = $total_rows;
				
		//Pass the Data

		$this->data['target_page'] =  "best_cook/view_recipes_list" ;
		$this->data['display_data'] =  $display_data;
		$this->data['members_list_flag'] =  true;
		//$this->data['display_related_recipes'] = $display_related_recipes ;
		$this->data['advanced_search_flag_hide'] =  true;
		$this->data['pagination_links'] = getMPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
				 
		$this->load->view('mobile/template' , $this->data);

	}
		public function view_recipe($id)
	{
		//Fix ID
		$id = extractSeoid($id);
		$current_language_db_prefix = $this->data['current_language_db_prefix'];
		
		$display_data = $this->recipesmodel->get_detailed_recipe($id);
		$display_related_recipes = $this->recipesmodel->get_related_recipes($id , "" , $current_language_db_prefix ,$display_data[0]['recipes_dish_id'], 10 );
		//$display_recipe_video = $this->recipesmodel->get_recipe_video($id,2); // (recipe_id,section_id)
	    $this->data['display_topics'] = $this->recipesmodel->get_topics_recipes();
		//Manage Views Counter
		$this->totalviews->add_view("recipes" , $id , "recipes" , "recipes_views" ,$this->members->members_id,$_SERVER['REMOTE_ADDR'] ,$this->input->ip_address() );
		
		//Set header in view page
		
		//Pass the Data
		
		$this->data['recipeID'] = $id ;
		$this->data['target_table'] = "recipes" ;
		$this->data['mypath']=  base_url().'uploads/recipes/';
		$this->data['display_data'] = $display_data ;
		$this->data['display_related_recipes'] = $display_related_recipes ;
		$this->data['members_list_flag'] =  false;
		$this->data['display_recipe_video'] =  $display_recipe_video;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$desc_column  = 'recipes_directions'.$current_language_db_prefix;
	
		
		$this->headers->set_default_image($image_url.$display_data[0]['images_src']);
		$this->headers->set_metatag_desc( $display_data[0][$desc_column] ) ;
		
		//When Displaying an inner page (article, recipe) , we write the fourth title
		$this->headers->set_fourth_title( $display_data[0]['recipes_title'.$this->data['current_language_db_prefix']]  );
		$this->data['target_page'] =  "best_cook/recipe_inner" ;	 
		$this->load->view('mobile/template' , $this->data);
		
	}
	
	public function view_member_recipe($id)
	{
		//Fix ID
		$id = extractSeoid($id);
		$current_language_db_prefix = $this->data['current_language_db_prefix'];
		
		$display_data = $this->recipesmodel->get_detailed_member_recipe($id);
		if(!$display_data){
		redirect('best_cook');
		}
		
		$display_related_recipes = $this->recipesmodel->get_members_related_recipes($id , "" , $current_language_db_prefix ,$display_data[0]['members_recipes_dish_id'] , 10 );
		$display_recipe_video = $this->recipesmodel->get_recipe_video($id,2); //(recipe_id,section_id)
		
		//Manage Views Counter
		$this->totalviews->add_view("members_recipes" , $id , "members_recipes" , "members_recipes_views" ,$this->members->members_id,$_SERVER['REMOTE_ADDR'] ,$this->input->ip_address() );

		//Pass the Data
		
		$this->data['display_topics'] = $this->recipesmodel->get_topics_recipes();
		$this->data['target_table'] = "members_recipes" ;
		$this->data['mypath']=  base_url().'uploads/users_recipes/';
		$this->data['display_data'] = $display_data ;
		$this->data['display_related_recipes'] = $display_related_recipes ;
		$this->data['members_list_flag'] =  true;
		$this->data['display_recipe_video'] =  $display_recipe_video;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$desc_column  =  "members_recipes_directions" ;
		
		
		$this->headers->set_default_image($image_url.$display_data[0]['images_src']);
		$this->headers->set_metatag_desc( $display_data[0][$desc_column] ) ;
		
		//When Displaying an inner page (article, recipe) , we write the fourth title
		$this->headers->set_fourth_title( $display_data[0]['members_recipes_name']  );
	 	$this->data['target_page'] =  "best_cook/recipe_inner" ;
		$this->load->view('mobile/template' , $this->data);
		
	}
	
	public function healthy_topics($id="")
	{
		if($id != "")
		{
			$this->recipes_list($id);return;
		}
		
		$this->data['display_all_topics'] = $this->recipesmodel->get_topics_recipes();
		$this->data['flag'] = 0;
		$id = extractSeoid($id);

		
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(185,$this->data['current_language_db_prefix']);
		
		$this->data['subsection_title'] = $subsection_title;

		//Pass the Data
		$this->data['target_page'] =  "best_cook/view_inseason_topics" ;
		
		$this->load->view('mobile/template' , $this->data);
	}
	
	public function inseason_recipes($id)
	{
		
		/*if($id != "")
		{
			$this->view_recipe($id);return;
		}
		*/
		//Handle Pagination
		$config['base_url'] = site_url('mobile/' . $this->router->class."/".$this->router->method);		
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
		$this->data['pagination_links'] = getMPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		 
		$this->load->view('mobile/template' , $this->data);

	}
	
	
	public function inseason_topics($id = "")
	{
		$id = extractSeoid($id);
		if($id != "")
		{
			$this->recipes_list($id);return;
		}

		   	$this->data['flag'] = 1;
		 
		 	list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(131,$this->data['current_language_db_prefix']);
		  
		  	$this->data['subsection_title'] = $subsection_title;
		
		
		  	//$this->data['display_current_inseason_topics'] = $this->recipesmodel->get_current_inseason_recipes();
		  	$this->data['display_all_topics'] = $this->recipesmodel->get_inseason_recipes();
		  	
			//Pass the Data
		  	$this->data['target_page'] =  "best_cook/view_inseason_topics" ;
		  
		  	$this->load->view('mobile/template' , $this->data);
		

	}
	
	
	public function videos_recipes()
	{
		$this->load->model("videosmodel");
		//Handle Pagination
		$config['base_url'] = site_url('mobile/'. $this->router->class."/".$this->router->method);		
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
		$this->data['pagination_links'] = getMPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['target_page'] =  "best_cook/view_videos_recipes" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('mobile/template' , $this->data);

	}
	
	public function upload_recipe($success= "")
	{
		if(!$this->members->members_id && $success=='success')
		{
			redirect('mobile/welcome');
		}
		
		//Prepare Form Fields
		$this->form_validation->set_rules('members_recipes_name', 'إسم الوصفة', 'required');			
		
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
		
		$this->data['target_page'] = "best_cook/view_upload_recipe";
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			
			$this->data['target_page'] = "best_cook/view_upload_recipe";
		}//End of validation->run()
		else // passed validation proceed to post success logic
		{
				$config['upload_path'] = 'uploads/users_recipes';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '50000';		
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('recipe_file_upload') == true)
				{
					
				
					$file_data = $this->upload->data();
					$this->load->library("resizeclass");				
					$this->resizeclass->loadimage('./uploads/users_recipes/'.$file_data['file_name']);
					 list($current_image_width, $current_image_height) = getimagesize('./uploads/users_recipes/'.$file_data['file_name']);
					
					if($current_image_width > 470)
			         {
				        $this->resizeclass->fit_to_width(470);
				        $this->resizeclass->saveImage('./uploads/users_recipes/'.$file_data['file_name'], 80);						
			         }
					$this->resizeclass->resizeImage(220, 170,"crop");
					$this->resizeclass->saveImage('./uploads/users_recipes/thumb_'. $file_data['file_name'], 100);
					$new_image_id = $this->resizeclass->insertimagetodb($file_data['file_name']);
					
				}
				else
			{
				
				//var_dump($_FILES);
				redirect('mobile/best_cook/upload_recipe/img_error'.'?img_error=1');
				//echo $this->upload->display_errors('<p>','ffffffffffffffffffffffff', '</p>');
				
				//$form_data = array('members_images' => 0);
			}
			
			  $error = array('error' => $this->upload->display_errors());
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
								
			    $success="success";
				$this->data['target_page'] =  "best_cook/view_upload_recipe/success" ;
			}
			else
			{
			
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}
		}
		
		//Get Latest Members Recipe
		list( $display_recent_data , $total_rows) = $this->recipesmodel->get_all_members_recipes(8,0);
		
		//Pass the Data
		$this->data['target_page'] =  "best_cook/view_upload_recipe" ;
		$this->data['display_recent_data'] =  $display_recent_data ;
		$this->data['members_list_flag'] =  true;
		$this->data['success'] =  $success;
		//$this->data['img_error'] = $img_error;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	 
		$this->load->view('mobile/template' , $this->data);
		
	}//End of upload recipe

}
