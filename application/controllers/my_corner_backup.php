<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_corner extends CI_Controller {
	
   public function __construct()
   {
		parent::__construct();
		
		// Your own constructor code
		
		//Load Languages
		$this->load->helper('language');		
		$this->lang->load('globals');
		$this->lang->load('mycorner');
		
		//Set Section name
		$this->headers->set_second_title( lang("globals_mycorner") );
		
		//Initlize common data 
		$this->data = array();
		$this->data['current_section_id'] =  29;
		
		//Apply Sections Color
		$this->data['current_section_color'] = "terms_conditions_color ";
		$this->data['current_section_background_color'] = "terms_conditions_background_color";
		$this->data['current_section_border_color'] = "my_corner_border_color";
		$this->data['current_section_borderbottom_color'] = "my_corner_borderbottom_color";
		
		//Apply Languages
		$site_lang = $this->config->item('language');
		$this->data['current_language'] =  $site_lang;
		$this->data['current_language_db_prefix'] =   $site_lang == "arabic" ? "_ar" : "";
		
		//Apply Default Subsections ID
		$this->data['id_of_current_sub_section'] =  false;
		$this->data['parent_id_of_current_sub_section'] =  false;
		
		//Tree Menu handling (This will write first and second url)
		$this->treemenu->add_tree_page( lang("globals_home") , site_url() );		
		$this->treemenu->add_tree_page( lang("globals_mycorner") , '#' ); //site_url($this->router->class)
		
		
		//Auto Manage Current Section,Manage Tree Page and Headers
		
		//Send ID if applicable
		$dynamic_id = $this->uri->segment(4);
		
		
		//Get Current Section Data
		$current_section_data = $this->sectionsmodel->get_active_sub_section_data($this->router->fetch_method() , $this->data['current_section_id'],$dynamic_id);
		if( !empty($current_section_data) ):
			$title_of_current_section = $current_section_data[0]['sub_sections_name'.$this->data['current_language_db_prefix']];
			$id_of_current_sub_section  = $current_section_data[0]['sub_sections_ID'];
			$parent_id_of_current_sub_section  = $current_section_data[0]['sub_sections_parent'];
			
			//Add Current Page (	The Third Url)	

			if($this->data['current_section_id'] != $parent_id_of_current_sub_section)
			{
				$parent_section_data = $this->sectionsmodel->get_sections_details($parent_id_of_current_sub_section);
				$title_of_parent_section  = $parent_section_data[0]['sub_sections_name'.$this->data['current_language_db_prefix']];
				
				$this->treemenu->add_tree_page( $title_of_parent_section , '#');
			}

			$this->treemenu->add_tree_page( $title_of_current_section , site_url($this->router->class."/".$this->router->fetch_method()) ); // ."/".$id_of_current_sub_section
			
			//Set Headers
			$this->headers->set_third_title( $title_of_current_section  );
			 
			$this->data['id_of_current_sub_section'] = $id_of_current_sub_section;
			$this->data['parent_id_of_current_sub_section'] = $parent_id_of_current_sub_section;
		
		endif;
		
		
	}

	function index() 
	{ 
		parent::__construct();
		$this->load->model("membersmodel"); // load "membersmodel" 
	}

	public function validate() {   // form validation        
	
	$form_data = array(
					'members_email' => $this->input->post('email'),
					'members_password' =>  $this->input->post('password'),
					);
	
	if($this->membersmodel->checksignin($form_data) == TRUE) // checksignin
	{
		
		redirect('');
		
		// The Created Session 
		/*$members_ID = $this->session->userdata('userid');
		$members_name = $this->session->userdata('name');
		$members_email = $this->session->userdata('email');*/
		
	}
	else
	{
		redirect('');
		echo 'Username or password not match . Please try again later';
		// Or whatever error handling is necessary
	}
	
	if($this->session->userdata('logged_in') )
	 {
		 $this->load->view('template/login');
	 }
	 else
	 {
		 $this->load->view('template/logout');
	 }

	if( $query )  {     // if data found
		$data = array(  // value which is to be inserted into session
			"username" => $this->input->post("username"),
			"is_logged_in" => true
		);

		$this->session->set_userdata($data);  // insert value into session
		redirect("site/members_area");   // go to predefined page
	}
	else {
		// if data not found then go to login_form page
		$this->index();
	}  
	}
	
	public function logout() {
		
      $this->session->sess_destroy();
      redirect('');
    }
	/* Function Create Member  Registration*/
	public function create_my_corner()  
	{
		$this->lang->load('bestcook');
		
		$this->load->library("form_validation");  // load form_validation library
	
		$this->form_validation->set_rules("username", "Username", "trim|required");
		$this->form_validation->set_rules("members_password", "Enter Password", "trim|required|min_length[4]|max_length[32]");
		$this->form_validation->set_rules("repeat_password", "Confirm password", "trim|required|matches[password]");
	
		$this->form_validation->set_rules("members_email", "Email Address", "trim|required|valid_email");
	
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
			//$this->form_validation->set_rules("email", "Email Address", "trim|required|valid_email");

			$form_data = array(
				'members_nickname' => $this->input->post('nickname'),
				'members_first_name' => $this->input->post('first_name'),
				'members_last_name' => $this->input->post('last_name'),
				'members_email' => $this->input->post('members_email'),
				'members_password' =>md5($this->input->post('members_password')),
				'members_birthdate' => $this->input->post('members_birthdate'),
				'members_mobile' => $this->input->post('members_mobile'),
				'members_lang' => $this->input->post('members_lang'),
				'members_relationship_id' => $this->input->post('members_relationship_id'),
				'members_addeddate' => date("Y-m-d H:i:s"),
				'members_fb_id' => $this->input->post('members_fb_id'),
				'members_access_token' => $this->input->post('members_access_token'),
				'members_newsletter' => $this->input->post('newsletter'),
				);
				
				$currnet_member_id = $this->membersmodel->insert_register_form($form_data);
				
				if($currnet_member_id)
				{
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
						'newsletter_members_members_id' => $currnet_member_id,
						'newsletter_members_newsletter_types_id' => $ids,
						
						);
						
						$this->membersmodel->insert_newsletter_members($form_array);
						}
					}
		
					redirect('my_corner/signup_success/'.$currnet_member_id);
				}
					
			if ($this->membersmodel->insert_register_form($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('my_corner/signup_success');   // or whatever logic needs to occur
			}
			else
			{
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}
		}
		 

		 $this->data['relationship'] =  $this->membersmodel->get_relationship($this->data['current_language_db_prefix'] , true , lang("mycorner_relationship"));
		 $this->data['newsletter'] =  $this->membersmodel->get_newsletter($this->data['current_language_db_prefix'] , false , lang("mycorner_newsletter"));
		 $this->data['target_page'] =  "my_corner/registeration" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	     $this->load->view('template' , $this->data);
  
 	 }
	 
	public function signup_success($members_id)
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

			if ($this->membersmodel->second_step($form_data , $members_id) == TRUE) // the information has therefore been successfully saved in the db
			{
				$this->load->library("members");
				$this->members->set_members_data($members_id);
				
				redirect('my_corner/profile');   // or whatever logic needs to occur
			}
			else
			{
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}
		}
		 
		 $this->data['members_id'] = $members_id;
		 $this->data['target_page'] = "my_corner/second_step" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	     $this->load->view('template' , $this->data);
	}
	public function profile()
	{
		 $this->load->helper('form');
		 $this->load->model('membersmodel');
		 $members_id = $this->members->members_id;	
		 
		 if (empty($members_id)) 
		 {
			redirect('welcome');
		 }
		 
		 $this->data['members_id'] = $members_id;
		 $members_info = $this->data['members_info'] = $this->membersmodel->get_member_info($members_id);
		 
		 /*if(!$members_info[0]['members_images'] or $members_info[0]['members_images'] == 0)
		 {
			  $this->data['current_member_image'] = 'personal_img.png';
		 }
		 else
		 {
			 $image_src = $this->membersmodel->get_member_image($members_id);
			 $this->data['current_member_image']  = $image_src[0]['images_src'];
		 }*/
		 
		 $this->data['members_newsletter'] = $this->membersmodel->get_members_newsletter($members_id);
		 $this->data['members_children'] = $this->membersmodel->get_childern($members_id);
		 $this->data['target_page'] =  "my_corner/view_profile" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	     $this->load->view('template' , $this->data);
	}	
	public function edit_profile($type)
	{
		$this->lang->load('bestcook');
		
		$type = extractSeoid($type);
			  	
		 $this->load->helper('form');
		 $this->load->model('membersmodel');
		 $members_id = $this->members->members_id;	

		 $this->data['members_info'] = $this->membersmodel->get_member_info($members_id);
		 
		 if($this->input->post('update') == true)
		 {
			//$uploaded_image = $this->input->post('image_uploaded_name');
			
			if($this->input->post('edit_type') == 'info')
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
			
				$form_data = array(
						'members_first_name' => $this->input->post('members_first_name'),
						'members_last_name' => $this->input->post('members_last_name'),
						'members_relationship_id' => $this->input->post('members_relationship_id'),
						'members_birthdate' => $this->input->post('members_birthdate'),
						//'members_mobile' => $this->input->post('mobile'),
						//'members_children' => $this->input->post('children'),
						'members_images' => $new_image_id,
						);
				}
				else
				{
					$form_data = array(
						'members_first_name' => $this->input->post('members_first_name'),
						'members_last_name' => $this->input->post('members_last_name'),
						'members_relationship_id' => $this->input->post('members_relationship_id'),
						'members_birthdate' => $this->input->post('members_birthdate'),
						//'members_mobile' => $this->input->post('mobile'),
						//'members_children' => $this->input->post('children'),
						);
				}
				
				$this->membersmodel->delete_members_children($members_id);
				
				$array_of_names =  $this->input->post('children_name');
				$array_of_ages = $this->input->post('children_age');
				
				for($i = 0; $i<sizeof($array_of_names) ; $i++)
				 {
					
					$names	 = $array_of_names[$i];
					$ages = $array_of_ages[$i];
					if(!empty($names))
					{
						$form_array = array(
						'members_children_name' => $names,
						'members_children_age' => $ages,
						'members_children_members_id' => $members_id,
						);
						
						$this->membersmodel->insert_childern($form_array);
					}
				 }
				
		 	}
			else if($this->input->post('edit_type') == 'address')
			{
				$form_data = 
					array(
					'members_address' => $this->input->post('members_address'),
					'members_city_id' => $this->input->post('members_city_id'),
					'members_email' => $this->input->post('members_email'),
					'members_mobile' => $this->input->post('members_mobile'),
					);				
		 	}
			else if($this->input->post('edit_type') == 'childern')
			{
			
				$this->membersmodel->delete_members_children($members_id);
				
				$array_of_names =  $this->input->post('children_name');
				$array_of_ages = $this->input->post('children_age');
				
				for($i = 0; $i<sizeof($array_of_names) ; $i++)
				 {
					$names	 = $array_of_names[$i];
					$ages = $array_of_ages[$i];
					 
					$form_array = array(
					'members_children_name' => $names,
					'members_children_age' => $ages,
					'members_children_members_id' => $members_id,
					);
					
					$this->membersmodel->insert_childern($form_array);
				 }

			}
			else if($this->input->post('edit_type') == 'interested')
			{
				$this->membersmodel->delete_newsletter_members($members_id);
				
				$array_of_ids =  $this->input->post('newsletter_members_members_id');
				
				for($i = 0; $i<sizeof($array_of_ids) ; $i++)
				 {
					$ids = $array_of_ids[$i];
					 
					$form_array = array(
					'newsletter_members_members_id' => $members_id,
					'newsletter_members_newsletter_types_id' => $ids,
					
					);
					
					$this->membersmodel->insert_newsletter_members($form_array);
				 }
				 redirect('my_corner/profile');

			}
			 

		 	if ($this->membersmodel->edit_profile($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('my_corner/profile');   // or whatever logic needs to occur
			}
			else
			{
			
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}
		 
		}
		 $this->data['type'] = $type;
		 $this->data['city'] = $this->membersmodel->get_city($this->data['current_language_db_prefix'] , true , lang("mycorner_city"));
		 $this->data['relationship'] =  $this->membersmodel->get_relationship($this->data['current_language_db_prefix'] , true , lang("mycorner_relationship"));
		 $this->data['members_children'] = $this->membersmodel->get_childern($members_id);
		 $this->data['members_newsletter'] = $this->membersmodel->get_members_newsletter($members_id);
		 $this->data['newsletter'] =  $this->membersmodel->get_newsletter($this->data['current_language_db_prefix'] , false , lang("mycorner_newsletter"));
		 $this->data['target_page'] =  "my_corner/view_edit_profile" ;
		 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		 $this->load->view('template' , $this->data);
		
		
	}
	public function my_recipies_book()
	{
		//Pass the Data
		 $this->load->model('membersmodel');
		 $members_id = $this->members->members_id;	
		
		 $this->data['members_books'] =  $this->membersmodel->get_members_book($members_id , 'recipes') ;
		
		 $this->data['target_page'] =  "my_corner/my_recipies_book.php" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		 $this->load->view('template' , $this->data);
		
	}
	
	public function my_articles()
	{
		 //Pass the Data
		 $this->load->model('membersmodel');
		 $members_id = $this->members->members_id;	
		
		 $this->data['members_books'] =  $this->membersmodel->get_members_book($members_id , 'articles') ;
		 $this->data['target_page'] =  "my_corner/my_articles.php" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		 $this->load->view('template' , $this->data);
		
	}
	public function section_order()
	{
		$this->load->model('membersmodel');
		
		$member_id = $this->input->post('member_id');
		$form_array = $this->input->post('data');
		
		$this->membersmodel->delete_member_section_order($member_id);
		$this->membersmodel->insert_member_section_order($form_array , $member_id);
		
	}
	
	
}
 
?>
