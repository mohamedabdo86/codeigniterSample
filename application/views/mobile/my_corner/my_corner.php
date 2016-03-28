<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_corner extends CI_Controller {
	
   public function __construct()
   {
		parent::__construct();
		
		// Your own constructor code
		
		//Load Languages
		$this->load->helper('language');
		$this->load->helper("file");		
		$this->lang->load('globals');
		$this->lang->load('bestcook');
		$this->lang->load('mycorner');
		$this->lang->load('newsletter');
		
		$this->load->library('members');	
		
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
	public function validate()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		$status = $this->members->sign_in($email , $password);
		
		if($status == 0)
		redirect('?display_box=true&message_type=login_status&messagecode='.$status); 
		
		if($status == 2)
		redirect('?display_box=true&message_type=login_status&messagecode='.$status); 
		
		if($status == 1)
		{
			$user_language = $this->session->userdata('members_lang');
			if($user_language == "english"){
				redirect(base_url().'index.php/en/welcome');
			}else{
				redirect(base_url().'index.php/ar/welcome');
			}
		}
	}
	public function validate_old() {   // form validation        
	
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
	public function create_my_corner($key = "")  
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
				if($get_user_id){
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
						'newsletter_members_members_emails' => $this->input->post('baby_birthday'),
						);
						
						$this->membersmodel->insert_newsletter_members($form_array);
						}
						
					}
					
					//Send Activation Email
					$this->load->library('email');
					$this->email->from('info@mynestle.com.eg', 'Be at your best');
					$this->email->to('amakki@mediaandmore-eg.com'); 
					$this->email->subject('Email Test');
					$this->email->message('Testing the email class.');	
					$this->email->send();
					
					redirect('my_corner/signup_success/'.$currnet_member_id);
					
				}
				
					
		/*	if ($this->membersmodel->insert_register_form($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('my_corner/signup_success');   // or whatever logic needs to occur
			}
			else
			{
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}*/
		}
		 

		 $this->data['relationship'] =  $this->membersmodel->get_relationship($this->data['current_language_db_prefix'] , true , lang("mycorner_relationship"));
		 $this->data['newsletter'] =  $this->membersmodel->get_newsletter($this->data['current_language_db_prefix'] , false , lang("mycorner_newsletter"));
		 $this->data['key'] =  $key ;
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
			else
			{
				$form_data = array('members_images' => 0);
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
		 $members_email = $this->members->members_email;
		 
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
		 
		 $this->data['members_newsletter'] = $this->membersmodel->get_members_newsletter($members_email);
		 $this->data['members_children'] = $this->membersmodel->get_childern($members_id);
		 $this->data['members_section_order'] = $this->membersmodel->get_members_section_order($members_id);
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
		 $members_email = $this->members->members_email;	

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

			
				
				$members_lang =  $this->input->post('members_lang');
				if($members_lang)
				{
					$form_data = array('members_lang' => $members_lang);
					
					$this->membersmodel->edit_profile($form_data);
				}
				
				$this->membersmodel->delete_newsletter_members($members_email);
				$baby_month =  $this->input->post('baby_month');
				$array_of_ids =  $this->input->post('newsletter_members_members_id');
				
				for($i = 0; $i<sizeof($array_of_ids) ; $i++)
				 {
					$ids = $array_of_ids[$i];
					 
					$form_array = array(
					'newsletter_members_members_emails' => $members_email,
					'newsletter_members_newsletter_types_id' => $ids,
					
					);
					
					$this->membersmodel->insert_newsletter_members($form_array);
				 }
				 
				 $this->membersmodel->delete_pregnancy($members_email);
				 if($baby_month)
				 {
					
					date_default_timezone_set("Egypt");
					$form_array = array(
					'pregnancy_month' => $baby_month,
					'pregnancy_members_email' => $members_email,
					'pregnancy_date' => date("Y-m-d H:i:s"),
					);
					
					$this->membersmodel->insert_pregnancy($form_array);
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
		 $this->data['members_newsletter'] = $this->membersmodel->get_members_newsletter($members_email);
		 $this->data['members_section_order'] = $this->membersmodel->get_members_section_order($members_id);
		 $this->data['get_pregnancy'] = $this->membersmodel->get_pregnancy($members_email);
		 $this->data['newsletter'] =  $this->membersmodel->get_newsletter($this->data['current_language_db_prefix'] , false , lang("mycorner_newsletter"));
		 $this->data['target_page'] =  "my_corner/view_edit_profile" ;
		 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		 $this->load->view('template' , $this->data);
		
		
	}
	
	public function check_email_invitations(){
		$email = $this->input->post('email');
		$members_id = $this->members->members_id;
		$check = $this->membersmodel->check_email_invitation($members_id , $email) ;
		
		if($check){
			$message = 1;
		}else{
			$message = 0;
		}
		
		$theHTMLResponse  = $this->load->view('my_corner/view_edit_profile', null, true);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($message));
		
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
	
	public function forgot_your_password()
	{
		$this->load->view("my_corner/view_forgot_your_password", $this->data);
	}
	public function forgot_your_password_action()
	{
		$email = $this->input->post('forgot_your_password_email');
		$code_generateed =  md5(uniqid(rand(), true));
		
		//Check for email
		$display = $this->membersmodel->check_email_found($email);
		//print_r($display);
		$array_of_status = NULL;
		
		if(empty($display))
		{
		 $array_of_status['status'] = 0;
		}else{
			$key = md5(uniqid(rand(), true));
			$user_name = $display[0]['members_first_name']. ' '. $display[0]['members_last_name'];
			$tobesaved['members_reset_password_requested'] = $key;
			$tobesaved['members_reset_password_active'] = 1;
			$id = $display[0]['members_ID'];
			$this->membersmodel->edit_member($id,$tobesaved);
			
			
			$this->load->library('email', array('mailtype' => 'html'));
			$this->email->from("info@mediaandmore-eg.com", "Be at your best with Nestle");
			$this->email->to($email);
			$this->email->subject("Reset Your Password");
			
			$message = "<h1>Reset your password</h1>";
			$message .= "<p>Dear {$user_name},<br/>To reset your password click <a href='".site_url('my_corner/reset_password')."/{$id}/{$key}' target='_blank' >here</a></p>";
			
			$this->email->message($message);
			$send = $this->email->send();
			
			if($send){
				$array_of_status['status'] = 1;
			}else{
				$array_of_status['status'] = 0;			
			}
		}
		echo json_encode($array_of_status);
	}
	
	public function reset_password($member_id="", $key=""){
		if($this->input->post('member_id')){
		$this->load->library('encryption');

		$id = $this->input->post('member_id');
		$password = $this->input->post('members_password');
		$current_key = $this->input->post('key');
		if(($id == $member_id) && ($key == $current_key)){
			$update_password = $this->members->reset_user_password($member_id, $password);
			//redirect('');
			if($update_password == TRUE){
				$message = 1;
			}else{
				$message = 0;
			}
			$theHTMLResponse  = $this->load->view('my_corner/view_reset_password', null, true);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($message));
			//echo json_encode($message);
		}
		}else{
			if($this->membersmodel->check_reset_password_request($member_id,$key) == TRUE){
			$this->data['member_id'] = $member_id;
			$this->data['key'] = $key;
			$this->data['target_page'] =  "my_corner/view_reset_password";
			$this->load->view('template' , $this->data);
			}else{
				redirect('');
			}
		}
	}
	
	public function validate_account($id,$code)
	{
		//Check if account is already validated
		$status = $this->members->confirm_account($id,$code);
		
		redirect('?display_box=true&message_type=account_confirmed&messagecode='.$status); 
		
	}
	
	public function fix_members_password()
	{
		$this->members->fix_members_password_2();
	}
	
	public function my_recipes(){
		$id = $this->members->members_id;
		$recipes = $this->membersmodel->view_user_recipe($id);
		
		$this->data['target_page'] =  "my_corner/view_my_recipes.php" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		$this->data['display_my_recipes'] =  $recipes ;
		$this->load->view('template' , $this->data);
	}
	
	public function edit_recipe($recipe_id = "", $image_id = "", $success = ""){
		$this->load->model('recipesmodel');
		$id = $this->members->members_id;
		if($this->input->post('submit'))
		{
			//Validate recipe name
			$this->form_validation->set_rules('members_recipes_name', 'إسم الوصفة', 'required');
			$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
		
		$this->data['target_page'] = "my_corner/my_recipes";
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$this->data['target_page'] = "my_corner/my_recipes";
		}//End of validation->run()
		else // passed validation proceed to post success logic
		{
			$uploaded_image = $_POST['image_uploaded_name'];
			/* Move Image (AJax uploaded mode) */
			if($uploaded_image){
				
				// Deleting old image
				if($this->membersmodel->delete_recipe_image($image_id) == TRUE){
				rename("./server/php/files/".$uploaded_image,"./uploads/test/".$uploaded_image );
				$this->load->library("resizeclass");
				$this->resizeclass->loadimage('./uploads/test/'.$uploaded_image);
				$this->resizeclass->resizeImage(75,75,"crop");
				$this->resizeclass->saveImage('./uploads/test/thumb_'.$uploaded_image, 100);
			
			
			
				// Adding new image
				$new_image_id = $this->resizeclass->insertimagetodb($uploaded_image);
				$image_id = $new_image_id;
				
				}
		}
			
			
			$form_data = array(
							'members_recipes_members_id' => $this->members->members_id ,
					       	'members_recipes_name' => $this->input->post('members_recipes_name'),
							'members_recipes_ing' => $this->input->post('members_recipes_ing'),
							'members_recipes_directions' => $this->input->post('members_recipes_directions'),
							'members_recipes_cuisine_id' => $this->input->post('members_recipes_cuisine_id'),
							'members_recipes_dish_id' => $this->input->post('members_recipes_dish_id'),
							'members_recipes_cookingtime' => $this->input->post('members_recipes_cookingtime'),
							'members_recipes_product_id' => $this->input->post('members_recipes_product_id'),
							'members_recipes_calories' => $this->input->post('members_recipes_calories'),
							'members_recipes_image' => $image_id,
							'members_recipes_selection_id' => $this->input->post('members_recipes_selection_id'),
							'members_recipes_approved' => 0,
							'members_recipes_edit' => 1
						);
						
			$video_url = $this->input->post('members_recipes_url');
			
			// run insert model to write data to db	
			if (($this->membersmodel->edit_member_recipe($form_data, $recipe_id, $this->members->members_id) == TRUE) && ($this->membersmodel->update_video_url($video_url, $recipe_id, $this->members->members_id) == TRUE))// the information has therefore been successfully saved in the db
			{
				redirect('my_corner/my_recipes');   // or whatever logic needs to occur
			}
			else
			{
				echo 'An error occurred saving your information. Please try again later';
			}
		}
		list( $display_recent_data , $total_rows) = $this->recipesmodel->get_all_members_recipes(8,0);
		echo 'problem is here 1';
		redirect('my_corner/my_recipes');   // or whatever logic needs to occur
		}else{	
		if($recipe_id != ""){
			list( $display_recent_data , $total_rows) = $this->recipesmodel->get_all_members_recipes(8,0);
			$get_recipe = $this->membersmodel->edit_user_recipe($recipe_id, $id);
			$get_recipe_video = $this->membersmodel->get_recipe_video($recipe_id);
			
			$this->data['target_page'] =  "my_corner/view_edit_recipe" ;
			$this->data['display_recent_data'] =  $display_recent_data ;
			$this->data['display_recipe_data'] =  $get_recipe ;
			$this->data['get_recipe_video'] =  $get_recipe_video ;
			$this->data['members_list_flag'] =  true;
			$this->data['success'] =  $success;
			$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		}else{
		 redirect('my_corner/my_recipes');   // or whatever logic needs to occur
		}
	}
		$this->load->view('template' , $this->data);
		
	}
	
	public function delete_recipe($recipe_id, $image_id){
		$this->membersmodel->delete_user_recipe($recipe_id, $image_id);
		$this->membersmodel->delete_user_points($this->members->members_id, $recipe_id, "upload_recipe");
	}
	
	public function delete_user_favourites($id){
		$user_id = $this->members->members_id;
		$this->membersmodel->delete_user_favourites($id, $user_id);
		
	}
	
	public function my_points(){
		$this->data['display_points'] =  $this->membersmodel->get_points();
		$this->data['display_awards'] =  $this->membersmodel->get_awards();
		$this->data['target_page'] =  "my_corner/view_mypoints_homepage" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		$this->load->view('template' , $this->data);
	}
	
	public function send_invitations()
	{
		$this->load->model('membersmodel');
		
		$member_id = $this->members->members_id;
		$member_name = $this->membersmodel->get_member_name($member_id);
		
		$email = $this->input->post('email');
		if($email){
		$key = md5(uniqid());
		$invitation = $this->membersmodel->insert_invitation($member_id, $email, $key);
		$point = $this->membersmodel->add_user_points($member_id, 'invite_friend');
		if($invitation == TRUE){
			$this->load->library('email', array('mailtype' => 'html'));
			$this->email->from("info@mediaandmore-eg.com", "Be at your best with Nestle");
			$this->email->to($email);
			$this->email->subject("Confirm Your Account");
			
			$message = "<h1>{$member_name} has invited you to join Nestle community</h1>";
			$message .= "<p>To Register on Nestle website, please click <a href='".site_url('my_corner/create_my_corner')."/{$key}' target='_blank' >here</a></p>";
			
			$this->email->message($message);
			$this->email->send();
		}
		}
	}
	
	public function points_invitation($key)
	{
		if($this->membersmodel->check_user_points($key) == TRUE){
		$member_id = $this->membersmodel->points_invitation($key);
		if($member_id){
			$this->membersmodel->add_user_points($member_id, 'confirm_invitation', $key);
		}
		}
		redirect('welcome');
	}
	
	
}
 
?>