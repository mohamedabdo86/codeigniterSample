<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {
	
   public function __construct()
   {
		parent::__construct();
		
		// Your own constructor code
		
		//Load Languages
		$this->load->helper('language');		
		$this->lang->load('globals');
		
		//Set Section name
		$this->headers->set_second_title( lang("globals_mycorner") );
		
		//Initlize common data 
		$this->data = array();
		
		//Apply Sections Color
		$this->data['current_section_color'] = "my_corner_color";
		$this->data['current_section_background_color'] = "my_corner_background_color";
		$this->data['current_section_border_color'] = "my_corner_border_color";
		$this->data['current_section_borderbottom_color'] = "my_corner_borderbottom_color";
		
		//Apply Languages
		$site_lang = $this->config->item('language');
		$this->data['current_language'] =  $site_lang;
		$this->data['current_language_db_prefix'] =   $site_lang == "arabic" ? "_ar" : "";
		
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

// create account  
	/*public function sign_up() {
	$data['main_content'] = "sign_up";

	$this->load->view("includes/templet", $data);
	}*/

// insert data into database
	public function create_member()  
	{
		$this->load->library("form_validation");  // load form_validation library
	
		//$this->form_validation->set_rules("username", "Username", "trim|required");
	/*	$this->form_validation->set_rules("password", "Enter Password", "trim|required|min_length[4]|max_length[32]");
		$this->form_validation->set_rules("repeat_password", "Confirm password", "trim|required|matches[password]");
	
		$this->form_validation->set_rules("email", "Email Address", "trim|required|valid_email");*/
	
		/*if(  $this->form_validation->run() == FALSE )  
		{
			$this->load->view("view_signup");
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
				$this->load->view("view_signup");
			}
		}*/
			
		if($this->input->post('register') == true)
		{
/*			$this->form_validation->set_rules("password", "Enter Password", "trim|required|min_length[4]|max_length[32]");
			$this->form_validation->set_rules("repeat_password", "Confirm password", "trim|required|matches[password]");
			$this->form_validation->set_rules("email", "Email Address", "trim|required|valid_email");
			
*/			
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
					'members_first_name' => $this->input->post('firstname'),
					'members_last_name' => $this->input->post('lastname'),
					'members_email' => $this->input->post('members_email'),
					'members_password' =>md5($this->input->post('members_password')),
					'members_birthdate' => $this->input->post('birthdate'),
					'members_mobile' => $this->input->post('mobile'),
					'members_children' => $this->input->post('children'),
					'members_newsletter' => $this->input->post('newsletter'),
					'members_images' => $new_image_id,
					);
			}
			else
			{
				$form_data = array(
					'members_first_name' => $this->input->post('firstname'),
					'members_last_name' => $this->input->post('lastname'),
					'members_email' => $this->input->post('members_email'),
					'members_password' =>md5($this->input->post('members_password')),
					'members_birthdate' => $this->input->post('birthdate'),
					'members_mobile' => $this->input->post('mobile'),
					'members_children' => $this->input->post('children'),
					'members_newsletter' => $this->input->post('newsletter'),
					);
			}
			if ($this->membersmodel->insert_register_form($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				
				redirect('member/signup_success');   // or whatever logic needs to occur
			}
			else
			{
			
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}


		}
		
		
		 $this->data['target_page'] =  "view_signup" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	     $this->load->view('template' , $this->data);
  
 	 }
  
  	public function signup_success()
	{
		 $this->data['target_page'] =  "view_signup_success" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	     $this->load->view('template' , $this->data);
	}
  
 	public function edit_profile()
	{
			
	  	
		 $this->load->helper('form');
		 $this->load->model('membersmodel');
		 $members_id=$this->members->members_id;	
		 $x=$this->membersmodel->get_member_info($members_id);
		 $this->data['members_info'] = $x;  
		
		if($this->input->post('update') == true)
		{
			//$uploaded_image = $this->input->post('image_uploaded_name');
			
			
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
					'members_first_name' => $this->input->post('firstname'),
					'members_last_name' => $this->input->post('lastname'),
					'members_email' => $this->input->post('email'),
					//'members_password' =>md5($this->input->post('changepassword')),
					'members_birthdate' => $this->input->post('birthdate'),
					'members_mobile' => $this->input->post('mobile'),
					'members_children' => $this->input->post('children'),
					'members_newsletter' => $this->input->post('newsletter'),
					'members_images' => $new_image_id,
					);
			}
			else
			{
				$form_data = array(
					'members_first_name' => $this->input->post('firstname'),
					'members_last_name' => $this->input->post('lastname'),
					'members_email' => $this->input->post('email'),
					//'members_password' =>md5($this->input->post('changepassword')),
					'members_birthdate' => $this->input->post('birthdate'),
					'members_mobile' => $this->input->post('mobile'),
					'members_children' => $this->input->post('children'),
					'members_newsletter' => $this->input->post('newsletter'),
					);
			}
			 

		 	if ($this->membersmodel->edit_profile($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				
				redirect('member/edit_profile');   // or whatever logic needs to occur
			}
			else
			{
			
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}
			
		}	 
		
		 $this->data['target_page'] =  "view_edit_profile" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	     $this->load->view('template' , $this->data);
		 
	}
	public function my_recipies_book()
	{
		//Pass the Data
		 $this->data['target_page'] =  "my_corner/my_recipies_book.php" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		 $this->load->view('template' , $this->data);
		
	}
	
}
 
?>
