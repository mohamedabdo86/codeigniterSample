<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ajax extends CI_Controller
{
	
	    public function __construct()
   {
		parent::__construct();
		
		// Your own constructor code		 
				
		//Load Languages
		$this->load->helper('language');		
		$this->lang->load('globals');
		$this->lang->load('newsletter');
		$this->load->model('newslettermodel');
		$this->load->model('membersmodel');
		
		//Load DB
		$this->load->library('newslettermodule');
		
		
		//Initlize common data 
		$this->data = array();

		//Apply Languages
		$site_lang = $this->config->item('language');
		$this->data['current_language'] =  $site_lang;
		$this->data['current_language_db_prefix'] =   $site_lang == "arabic" ? "_ar" : "";
		
	}
	
	
	public function index()
	{

	}
	
	public function insert_comments()
	{
		$this->load->model('commentmodel');
		$member_id = $this->input->post('member_id');
			$member_email = $this->input->post('member_email');
			$foreign_id = $this->input->post('foreign_id');
			$section_id = $this->input->post('section_id');
			$table = $this->input->post('table');
			$message = $this->input->post('message');
			date_default_timezone_set('Africa/Cairo');
			$date = date("Y-m-d H:i:s");
			
			$tobesaved = array(
			'comments_members_id'=>$member_id, 
			'comments_foreign_id'=>$foreign_id, 
			'comments_member_email' => $member_email,
			'comments_section_id'=>$section_id, 
			'comments_type'=>$table,
			'comments_message'=>$message, 
			'comments_date'=>$date
			);
		$check_member_recipe = $this->commentmodel->check_member_recipe($foreign_id);
		if($check_member_recipe){
			//Send Activation email
			/*$this->load->library('emailmanager');
			$data['name'] = $check_member_recipe[0]['members_first_name']." ".$check_member_recipe[0]['members_last_name'];
			$data['url']  = site_url('best_cook/your_recipes/'.$check_member_recipe[0]['members_recipes_ID'].'');
			$this->emailmanager->send_email($check_member_recipe[0]['members_email'],"Recipe Comment",$data,'email_bestcook_show_comment');*/
		}
		$this->commentmodel->insert_comments_to_db($tobesaved);
	}
	
	public function insert_book()
	{
		$this->load->model('commentmodel');
		
		$members_id = $this->input->post('members_id');
		if($members_id != 0 || !empty($members_id ))
		{
			$found = $this->commentmodel->check_book_found();
			if(!$found)
			{
				$this->commentmodel->insert_book_to_db();
				$array_of_result['state'] = TRUE;
			}
			else
			{
				$array_of_result['state'] = FALSE;
			}
		}
		else
		{
			$array_of_result['state'] = 'not_login';
		}
		echo json_encode($array_of_result);
	}

	public function retrieve_new_easy_tip_step()
	{
	  $id = (int)$_POST['id'];
	  $index = (int)$_POST['index'];
	  $site_lang = $this->config->item('language');
	  $this->data['current_language'] =  $site_lang;
	  $current_language_db_prefix =   $site_lang == "arabic" ? "_ar" : "";
	  
	  $this->load->model("quizesmodel");
	  $display = $this->quizesmodel->get_easy_tips_single_step($id);
	  
	  $results_array = array();
	  
	  $results_array['status'] = 1;
	  $results_array['index'] = $index;
	  $results_array['title']  = $display[0]['easy_ideas_steps_title'.$current_language_db_prefix];
	  $results_array['image']  = base_url()."uploads/easy/".$display[0]['images_src'];
	  $results_array['desc']  = $display[0]['easy_ideas_steps_desc'.$current_language_db_prefix];
	  
	  
	  echo json_encode($results_array);  
	  
	 }
	 
	 public function check_valid_email()
	{
		$this->load->model('membersmodel');
		$email = $this->input->post('email');
		$found = $this->membersmodel->check_email_found($email);
		if(!$found)
		{
			$array_of_result['state'] = TRUE;
		}
		else
		{
			$array_of_result['state'] = FALSE;
		}
		
		echo json_encode($array_of_result);
	}
	
	 public function check_valid_cooking_class_email()
	{
		$this->load->model('membersmodel');
		$email = $this->input->post('email');
		$found = $this->membersmodel->check_valid_cooking_class_email($email);
		if(!$found)
		{
			$array_of_result['state'] = TRUE;
		}
		else
		{
			$array_of_result['state'] = FALSE;
		}
		
		echo json_encode($array_of_result);
	}
	
	public function check_valid_diet_app_email()
	{
		$this->load->model('membersmodel');
		$email = $this->input->post('email');
		$found = $this->membersmodel->check_valid_diet_app_email($email);
		if(!$found)
		{
			$array_of_result['state'] = TRUE;
		}
		else
		{
			$array_of_result['state'] = FALSE;
		}
		
		echo json_encode($array_of_result);
	}
	
	public function check_valid_username(){
		$this->load->model('membersmodel');
		$username = $this->input->post('username');
		$found = $this->membersmodel->check_valid_username($username);
		
		if(!$found)
		{
			$array_of_result['state'] = TRUE;
		}
		else
		{
			$array_of_result['state'] = FALSE;
		}
		
		echo json_encode($array_of_result);
	}
	
	public function insert_member_lesson()
	{
		$this->load->model('cookingclassmodel');
		$current_language_db_prefix = $this->input->post('current_language_db_prefix');
		$current_id = $this->input->post('current_id');
		$current_image = $this->input->post('current_image');
		$current_title = $this->input->post('current_title');
		$current_days = $this->input->post('current_days');
		$display_dates = $this->cookingclassmodel->current_month_days($current_id , true);
		$member_name = $this->input->post('member_name');
		$members_phone = $this->input->post('members_phone');
		$member_mobile = $this->input->post('member_mobile');
		$members_email = $this->input->post('members_email');
		$members_birthdate = $this->input->post('members_birthdate');
		$lesson_day = $this->input->post('lesson_day');
		
		$form_array = array(
		'cooking_classes_members_name' => $member_name,
		'cooking_classes_members_phone' => "0".$members_phone,
		'cooking_classes_members_mobile' => "0".$member_mobile,
		'cooking_classes_members_email' => $members_email,
		'cooking_classes_members_birthdate' => $members_birthdate,
		'cooking_classes_members_lesson' => $lesson_day,
		);
		
		$state = $this->cookingclassmodel->insert_member_lesson($form_array);
		
		//Send Activation email
		$this->load->library('emailmanager');
		$data['name'] = $member_name;
		$data['image'] = $current_image;
		$data['title'] = $current_title;
		$data['current_language_db_prefix'] = $current_language_db_prefix;
		$data['current_id'] = $current_id;
		$data['current_days'] = $current_days;
		$data['email']  = $members_email;
		$data['lesson_day'] = $lesson_day;
		if($current_language_db_prefix == "_ar")
		{
			$send = $this->emailmanager->send_email($members_email,"دروس لأشطر طباخة",$data,'email_cooking_class');
		}
		else
		{
			$send = $this->emailmanager->send_email($members_email,"Cooking Class",$data,'email_cooking_class_en');
		}
		$data['members_phone'] = $members_phone;
		$data['member_mobile'] = $member_mobile;
		$data['members_birthdate'] = $members_birthdate;
		
		$this->emailmanager->send_admin_email('consumer.services@eg.nestle.com' ,"New Member Cooking Class",$data,'email_cooking_class_admin');
		//consumer.services@eg.nestle.com
		$array_of_result['state'] = $state;	


		echo json_encode($array_of_result);
	}
	
	public function food_calories()
	{
	  $id = (int)$_POST['current_val'];
	  
	  $this->load->model("nestlefitmodel");
	  $display = $this->nestlefitmodel->get_food($id);
	  
	  $results_array = array();
	  
	  $results_array['calories'] = $display[0]['nestle_fit_food_calories'];
	  $results_array['protien'] =  $display[0]['nestle_fit_food_protien'];
	  $results_array['fat']  = $display[0]['nestle_fit_food_fat'];
	  
	  echo json_encode($results_array);  
	  
	 }
	 
	 public function login_panel()
	 {
	 	 $this->load->view('template/view_login_form_ajax');
	 }
	 
	 public function nestle_fit_ask_an_expert()
	 {
		  $this->load->view('best_me/fit_app/ask_an_expert_ajax');
	 }
	 
	 
	  public function nestle_fit_ask_an_expert_mobile()
	 {
		  $this->load->view('mobile/best_me/fit_app/ask_an_expert_ajax');
	 }
		 
	 public function nestle_fit_mail_notifcation()	
	 {
		  $this->load->model('nestlefitmodel');
		  $this->load->model('membersmodel');
		  $this->load->helper('language');
		 
		  $member_id = $this->members->members_id;
          $member_mail = $this->members->members_email;
		  
		  $this->data['member_data']= $this->nestlefitmodel->get_data_by_member_id($member_id);
		  $this->load->view('best_me/fit_app/notification_messages',$this->data);
		 }
		 
		 
		 	 public function nestle_fit_mail_notifcation_mobile()	
	 {
		  $this->load->model('nestlefitmodel');
		  $this->load->model('membersmodel');
		  $this->load->helper('language');
		 
		  $member_id = $this->members->members_id;
          $member_mail = $this->members->members_email;
		  
		  $this->data['member_data']= $this->nestlefitmodel->get_data_by_member_id($member_id);
		  $this->load->view('mobile/best_me/fit_app/notification_messages',$this->data);
		 }
		 
		 
	public function best_life_update_notifications()
	 {
		$member_id = $this->input->post('nestle_fit_health_member_id');
		$this->load->model("nestlefitmodel");
		$this->nestlefitmodel->update_notifications();
		redirect('best_me/applications/9/best_life_welcome/'.$member_id);

	 }
	 
	 public function best_life_update_notifications_mobile()
	 {
		$member_id = $this->input->post('nestle_fit_health_member_id');
		$this->load->model("nestlefitmodel");
		$this->nestlefitmodel->update_notifications();
		redirect('mobile/best_me/applications/9/best_life_welcome/'.$member_id);

	 }
	 
	 public function best_life_register(){
		 $this->load->library("form_validation");
		 
		$this->form_validation->set_rules("best_life_name", '1', "trim|required|min_length[1]");
		$this->form_validation->set_rules("best_life_sex", '2', "trim|required");
		$this->form_validation->set_rules("best_life_age", '3', "trim|required");
	    $this->form_validation->set_rules("best_life_height",'4' , "trim|required|numeric|max_length[3]");
	    $this->form_validation->set_rules("best_life_weight", '5', "trim|required|numeric|max_length[3]");
	    $this->form_validation->set_rules("best_life_activity", '6', "trim|required");
		 
		 if($this->form_validation->run() == FALSE)
		 {
			 
			 redirect('best_me/applications/9/best_life_nestle/?notif=1');
			
			 
		 }
		 else
		 {
			$this->load->model("nestlefitmodel");
			 
			 // Get current account ID
			$member_id = $this->members->members_id;
			$fit_id = $this->nestlefitmodel->get_data_by_member_id($member_id);
			$fit_id = $fit_id[0]['nestle_fit_health_ID'];
			 
			$insert = $this->nestlefitmodel->best_life_register();
			 if($insert)
			 {
				 $this->nestlefitmodel->best_life_set_reg_flag($fit_id, 1); // disable old acc
				 redirect('best_me/applications/9/best_life_nestle/'.$insert.'');
			 }
			 else
			 {
				 redirect('best_me/applications/9/best_life_nestle/');
			 }
			
		 }
	 }
	 
	 //mobile
	 
	  public function best_life_register_mobile(){
		 $this->load->library("form_validation");
		 
		$this->form_validation->set_rules("best_life_name", '1', "trim|required|min_length[1]");
		$this->form_validation->set_rules("best_life_sex", '2', "trim|required");
		$this->form_validation->set_rules("best_life_age", '3', "trim|required");
	    $this->form_validation->set_rules("best_life_height",'4' , "trim|required|numeric|max_length[3]");
	    $this->form_validation->set_rules("best_life_weight", '5', "trim|required|numeric|max_length[3]");
	    $this->form_validation->set_rules("best_life_activity", '6', "trim|required");
		 
		 if($this->form_validation->run() == FALSE)
		 {
			 
			 redirect('mobile/best_me/applications/9/best_life_nestle/?notif=1');
			
			 
		 }
		 else
		 {
			$this->load->model("nestlefitmodel");
			 
			 // Get current account ID
			$member_id = $this->members->members_id;
			$fit_id = $this->nestlefitmodel->get_data_by_member_id($member_id);
			$fit_id = $fit_id[0]['nestle_fit_health_ID'];
			 
			$insert = $this->nestlefitmodel->best_life_register();
			 if($insert)
			 {
				 $this->nestlefitmodel->best_life_set_reg_flag($fit_id, 1); // disable old acc
				 redirect('mobile/best_me/applications/9/best_life_nestle/'.$insert.'');
			 }
			 else
			 {
				 redirect('mobile/best_me/applications/9/best_life_nestle/');
			 }
			
		 }
	 }
	 //end
	 
	 public function best_life_new_register()
	 {
		 $this->load->library("form_validation");
		 $this->load->model("nestlefitmodel");
		 
		 $this->form_validation->set_rules("best_life_height", lang('mycorner_name'), "trim|required|numeric|max_length[3]");
		 $this->form_validation->set_rules("best_life_weight", lang('mycorner_name'), "trim|required|numeric]|max_length[3]");
		 $this->form_validation->set_rules("best_life_activity", lang('mycorner_name'), "trim|required");
		 
		 if($this->form_validation->run() != false)
		 {
			 $member_id = $this->members->members_id;
			 
			 $data = array(
			 	'nestle_fit_health_weight' => $this->input->post('best_life_weight'),
   		 		'nestle_fit_health_height' => $this->input->post('best_life_height'),
   		 		'nestle_fit_health_activity' => $this->input->post('best_life_activity'),
				'nestle_fit_health_mail' => $this->input->post('nestle_fit_health_member_mail')
				
			 );
			 
			$fit_id = $this->input->post('nestle_fit_health_id');
			$update = $this->nestlefitmodel->best_life_new_register($fit_id, $data);
			 if($update !== false)
			 {
				 $this->nestlefitmodel->best_life_set_reg_flag($fit_id, 1); // Set to old
				 redirect('best_me/applications/9/best_life_nestle/'.$update);
			 }
			 else
			 {
				 redirect('best_me/applications/9/new_register/');
			 }
			 
		 }
		 else
		 {
			 redirect('best_me/applications/9/new_register/?notif=1');
		 }
	 }
	 
	 
	 //mobile
	  public function best_life_new_register_mobile()
	 {
		 $this->load->library("form_validation");
		 $this->load->model("nestlefitmodel");
		 
		 $this->form_validation->set_rules("best_life_height", lang('mycorner_name'), "trim|required|numeric|max_length[3]");
		 $this->form_validation->set_rules("best_life_weight", lang('mycorner_name'), "trim|required|numeric]|max_length[3]");
		 $this->form_validation->set_rules("best_life_activity", lang('mycorner_name'), "trim|required");
		 
		 if($this->form_validation->run() != false)
		 {
			 $member_id = $this->members->members_id;
			 
			 $data = array(
			 	'nestle_fit_health_weight' => $this->input->post('best_life_weight'),
   		 		'nestle_fit_health_height' => $this->input->post('best_life_height'),
   		 		'nestle_fit_health_activity' => $this->input->post('best_life_activity'),
				'nestle_fit_health_mail' => $this->input->post('nestle_fit_health_member_mail')
			 );
			 
			$fit_id = $this->input->post('nestle_fit_health_id');
			$update = $this->nestlefitmodel->best_life_new_register($fit_id, $data);
			 if($update !== false)
			 {
				 $this->nestlefitmodel->best_life_set_reg_flag($fit_id, 1); // Set to old
				 redirect('mobile/best_me/applications/9/best_life_nestle/'.$update);
			 }
			 else
			 {
				 redirect('mobile/best_me/applications/9/new_register/');
			 }
			 
		 }
		 else
		 {
			 redirect('mobile/best_me/applications/9/new_register/?notif=1');
		 }
	 }
	 public function best_life_next_step()
	 {
		/* $this->form_validation->set_rules("best_life_week_change", lang('mycorner_name'), "trim|required");
		 
		 if($this->form_validation->run() != false)
		 {*/
			 //ashraf add ths to save calories after second step
			 $this->load->model("nestlefitmodel");
			 $this->load->library('nestlefit');
			 
			 $progress = $this->input->post('nestle_fit_progress');
			 $current_weight = $this->input->post('nestle_fit_health_weight');
			 $height = $this->input->post('nestle_fit_health_height');
			 $sex = $this->input->post('nestle_fit_health_sex');
			 $member_nestle_fit_id = $this->input->post('nestle_fit_calculations_fit_health_id');
			 $age = $this->input->post('nestle_fit_health_birthday');
			 $user_data = $this->nestlefitmodel->get_user_data($member_nestle_fit_id);
			 $activity = $user_data[0]['nestle_fit_health_activity_mode_value'];
			 
			 if($progress)
			 {
				$weight_goal = $current_weight;
				$weight_difference = 0;
				$week_progress = 0;
				$estimated_days = 30;
				$start_day = date("Y-m-d");
				$end_day = date('Y-m-d', strtotime($start_day. ' +'. $estimated_days .'days'));
			 }
			 else
			 {
				 $weight_goal = $this->input->post('best_life_goal');
				 $weight_difference = $this->input->post('weight_differ');
				 $week_progress = $this->input->post('best_life_week_change');
							 
				 $estimated_weeks = $weight_difference / $week_progress;
				 $estimated_days = $estimated_weeks * 7;
				 $start_day = date("Y-m-d");
				 $end_day = date('Y-m-d', strtotime($start_day. ' +'. $estimated_days .'days'));
			 }
			 			 
			 $calories = $this->nestlefit->calculate_calories($height, $current_weight, $age, $sex, $activity,$progress);
			 $this->nestlefitmodel->update_health_calories($member_nestle_fit_id , $calories);
			 ///end
			 
		 	$data = array(
			 	'nestle_fit_calculations_fit_health_ID' => $member_nestle_fit_id,
				'nestle_fit_calculations_goal_weight' => $weight_goal,
				'nestle_fit_calculations_weight_difference' => $weight_difference,
				'nestle_fit_calculations_weight_loss_rate' => $week_progress,
				'nestle_fit_calculations_end_date' => $end_day,
				'nestle_fit_calculations_date' => $start_day,
				'nestle_fit_progress_ID'=>$progress,
				);
			 $insert = $this->nestlefitmodel->get_best_life_next_step($data);
			 
			 if($insert)
			 {
				 $this->nestlefitmodel->best_life_set_second_step_flag($insert, 1);
				 redirect('best_me/applications/9/best_life_welcome/'. $insert);
			 }
			 else
			 {
				 
				 redirect('best_me/applications/9/best_life_nestle/'. $data['nestle_fit_calculations_fit_health_ID']);
				 
			 }
		/* }
		 else
		 {
			 redirect($_SERVER['HTTP_REFERER']);
		 }*/
	 }
	//mobile
	public function best_life_next_step_mobile()
	 {
		/* $this->form_validation->set_rules("best_life_week_change", lang('mycorner_name'), "trim|required");
		 
		 if($this->form_validation->run() != false)
		 {*/
			 //ashraf add ths to save calories after second step
			 $this->load->model("nestlefitmodel");
			 $this->load->library('nestlefit');
			 
			 $progress = $this->input->post('nestle_fit_progress');
			 $current_weight = $this->input->post('nestle_fit_health_weight');
			 $height = $this->input->post('nestle_fit_health_height');
			 $sex = $this->input->post('nestle_fit_health_sex');
			 $member_nestle_fit_id = $this->input->post('nestle_fit_calculations_fit_health_id');
			 $age = $this->input->post('nestle_fit_health_birthday');
			 $user_data = $this->nestlefitmodel->get_user_data($member_nestle_fit_id);
			 $activity = $user_data[0]['nestle_fit_health_activity_mode_value'];
			 
			 if($progress)
			 {
				$weight_goal = $current_weight;
				$weight_difference = 0;
				$week_progress = 0;
				$estimated_days = 30;
				$start_day = date("Y-m-d");
				$end_day = date('Y-m-d', strtotime($start_day. ' +'. $estimated_days .'days'));
			 }
			 else
			 {
				 $weight_goal = $this->input->post('best_life_goal');
				 $weight_difference = $this->input->post('weight_differ');
				 $week_progress = $this->input->post('best_life_week_change');
							 
				 $estimated_weeks = $weight_difference / $week_progress;
				 $estimated_days = $estimated_weeks * 7;
				 $start_day = date("Y-m-d");
				 $end_day = date('Y-m-d', strtotime($start_day. ' +'. $estimated_days .'days'));
			 }
			 			 
			 $calories = $this->nestlefit->calculate_calories($height, $current_weight, $age, $sex, $activity,$progress);
			 $this->nestlefitmodel->update_health_calories($health_id , $calories);
			 ///end
			 
		 	$data = array(
			 	'nestle_fit_calculations_fit_health_ID' => $member_nestle_fit_id,
				'nestle_fit_calculations_goal_weight' => $weight_goal,
				'nestle_fit_calculations_weight_difference' => $weight_difference,
				'nestle_fit_calculations_weight_loss_rate' => $week_progress,
				'nestle_fit_calculations_end_date' => $end_day,
				'nestle_fit_calculations_date' => $start_day,
				'nestle_fit_progress_ID'=>$progress,
				);
			 $insert = $this->nestlefitmodel->get_best_life_next_step($data);
			 if($insert)
			 {
				 $this->nestlefitmodel->best_life_set_second_step_flag($insert, 1);
				 redirect('mobile/best_me/applications/9/best_life_welcome/'. $insert);
			 }
			 else
			 {
				 redirect('mobile/best_me/applications/9/best_life_nestle/'. $data['nestle_fit_calculations_fit_health_ID']);
			 }
		/* }
		 else
		 {
			 redirect($_SERVER['HTTP_REFERER']);
		 }*/
	 } 
	 
	 public function edit_weight($id)
	 {
		 $this->data['id'] =  $id;
		 $this->load->view("best_me/fit_app/best_life_edit_weight", $this->data);
		 

	 }
	 
	 public function edit_nestle_fit_weight(){
		 $id = $this->input->post('id');
		 $weight = $this->input->post('weight');
		 
		 $data = array(
		 	'nestle_fit_health_weights_nestle_fit_health_ID' => $id,
			'nestle_fit_health_weights_weight' => $weight,
			'nestle_fit_health_weights_date' => date("Y-m-d h:i:s A")
			);
		$this->load->model("nestlefitmodel");
		$insert = $this->nestlefitmodel->edit_nestle_fit_weight($data);
		date_default_timezone_set("UTC");
		if($insert){
			$array['weight'] = $weight;	
			$array['date_time'] = date("Y-m-d h:i:s A");	
		}else{
			$array['weight'] = $weight;
			$array['date_time'] = date("Y-m-d h:i:s A");
		}
		echo json_encode($array);
			
	 }
	 	 
	 public function add_meals()
	 {
		 //static $i=0;
		$this->load->model("nestlefitmodel");
		$this->load->model("membersmodel");
        
		
		$meal_date =  $this->input->post('meal_date');
		$meal_type =  $this->input->post('meal_type');
		
		//$member_id is the health_id
		$member_id =  $this->input->post('member_id');
		
		//$user_id is the user_id in site
		$user_id =  $this->input->post('user_id');
		
		$calories =  $this->input->post('calory_value');
		
		// table's name of meal
		//$t_name = array();
		//$t_name =  $this->input->post('tname');
		
		//if(is_array($t_name) && sizeof($t_name) > 1) {
//			for($i = 0; $i < sizeof($t_name); $i++) {
//				
//				$tname = $t_name[$i];
				
				$found = $this->nestlefitmodel->get_meals($member_id,$meal_date,$meal_type);
				if($found)
				{
					 $this->nestlefitmodel->delete_meals($member_id,$meal_date,$meal_type);
				}
			//}
//		} else {
//		
//			$found = $this->nestlefitmodel->get_meals($member_id,$meal_date,$meal_type, $t_name);
//					
//			if($found)
//			{
//				$this->nestlefitmodel->delete_meals($member_id,$meal_date,$meal_type);
//			}
//		}
		
		$the_meals =  $this->input->post('meal_value');
		$meal_amounts = $this->input->post('meal_amount');
			
		for($i = 0; $i < sizeof($the_meals) ; $i++)
		{
			$meals = $the_meals[$i];
			$amounts = $meal_amounts[$i];
			//$tname = $t_name[$i];
			
			$form_array = array(
			'nestle_fit_meals_meal' => $meals,
			'nestle_fit_meals_amount' => $amounts,
			'nestle_fit_meals_members_id' => $member_id,
			'nestle_fit_meals_date' => $meal_date,
			'nestle_fit_meals_type' => $meal_type
			//'tname' => $tname
			);
			
			$this->nestlefitmodel->add_meals($form_array);
			
				//$results_array['current_calories'] = $calories * $amounts ;
			
		
			//echo json_encode($results_array['tname']);
		    
			
		 }
		 
		// if(sizeof($found)<=1){
			 
			// $this->membersmodel->add_user_points($user_id,'nestle_fit_meal');
			 
			// }
		
		
	 }
	 public function food_search()
	 {
	  $input = $_GET["term"];
	  $data = array();
	  
	  $this->load->model("nestlefitmodel");	  
	  $results_array['geonames'] =  $this->nestlefitmodel->search_food($input);
	  
	  echo json_encode($results_array);
 
	  
	 }
	 public function send_prize_email(){
		 $awards_id =  $this->input->post('awards_id');
		 $member_id = $this->members->members_id;
		 $data = array(
		 'awards_email_member_id' => $member_id,
		 'awards_email_awards_id' => $awards_id,
		 'awards_email_date' => date("Y-m-d"),
		 );
		 $this->load->model('membersmodel');
		 if($this->membersmodel->send_prize_email($data) == true){
			 
			 $get_award_number = $this->membersmodel->get_award_number($awards_id);
			 $get_user_mail = $this->membersmodel->get_award_number($member_id);
			 
			 //Send Activation email
			$this->load->library('emailmanager');
			$data['name'] = $this->members->members_fullname;
			$data['award_number'] = $get_award_number;
			$send = $this->emailmanager->send_email($get_user_mail,"A user need a prize",$data,'email_prize_request');
			if($send){
				echo json_encode(true);	
			}
		 	}else{
			 	echo json_encode(false);
		 	}
	 }
	 
	 public function get_weight_data(){
		 $this->load->library('nestlefit');
		 $weight_id = $this->input->post('weight_id');
		 $member_id = $this->input->post('member_id');
		 $current_height = $this->input->post('current_height');
		 $current_weight = $this->input->post('current_weight');
		 $user_name = $this->input->post('user_name');
		 $type = $this->input->post('type');
		 $age = $this->input->post('age');
		 $activity_mode = $this->input->post('activity_mode');
		 $this->load->model('nestlefitmodel');
		 $data = $this->nestlefitmodel->get_weight_data($member_id ,$weight_id);
		 $this->data['current_height'] = $current_height;
		 $this->data['current_weight'] = $current_weight;
		 $this->data['member_id'] = $member_id;
		 $this->data['user_name'] = $user_name;
		 $this->data['type'] = $type;
		 $this->data['age'] = $age;
		 $this->data['activity_mode'] = $activity_mode;
		 $this->data['data'] = $data;
		 $this->load->view('best_me/fit_app/best_life_welcome_data', $this->data);
	 }
	 
	  public function increment_water()
	 {
		$this->load->model("nestlefitmodel");
		$date =  $this->input->post('date');
		$members_id =  $this->input->post('members_id');
		
		$found = $this->nestlefitmodel->find_member_water($members_id,$date);
		if($found)
		{
			$this->nestlefitmodel->update_members_water($members_id, $date , "+");
		}
		else
		{
			$form_array = array(
			'nestle_fit_water_date' => $date,
			'nestle_fit_water_members_id' => $members_id,
			'nestle_fit_water_count' => "1",
			);
			
			$this->nestlefitmodel->add_members_water($form_array);
		}
	 }
	 
	 /* Decrement times of user drink water per day
	 */
	 public function decrement_water()
	 {
		$this->load->model("nestlefitmodel");
		$date =  $this->input->post('date');
		$members_id =  $this->input->post('members_id');
		
		$this->nestlefitmodel->update_members_water($members_id, $date , "-");

	 }

	  
	 
}
?>