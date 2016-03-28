<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends CI_Controller {


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
		$this->load->model('nestlefitmodel');
		
		
		
		//Load DB
		$this->load->library('newslettermodule');
		
		
		//Initlize common data 
		$this->data = array();

		//Apply Languages
		$site_lang = $this->config->item('language');
		$this->data['current_language'] =  $site_lang;
		$this->data['current_language_db_prefix'] =   $site_lang == "arabic" ? "_ar" : "";
		
	}
	
	public function add_nestle_fit_point()
	{
		$this->data['nestle_fit_meals']=$this->nestlefitmodel->get_nestle_fit_meals();
		$this->load->view("newsletter/nestle_fit_meals_points", $this->data);
	}
		
	public function add_to_newsletter($id)
	{
		$get_title =  $this->newslettermodule->get_newsletter_title($id,$this->data['current_language_db_prefix']);
		 $this->data['id'] =  $id;
		 $this->data['title'] =  $get_title;
	     if($id == 2){
		 $this->load->view("newsletter/newsletter_form", $this->data);
		 }elseif($id == 8){
			 $this->load->view("newsletter/child_newsletter_form", $this->data);
		 }

	}
	
	public function move_to_child_newsletter($id){
		$check_before_add = $this->newslettermodel->check_newsletter_avialable($id);
		if($check_before_add){
			print_r($check_before_add);
		}else{
			redirect('');
		}
	}
	
	public function add_data_action()
	{
		$email = $_POST['newsletter_email'];
		$type = $_POST['newsletter_type'];
		//$baby_month = $_POST['baby_month'];
		
		$check_added_before = $this->newslettermodel->check_for_alreadyadded($email , $type);
		
		if(!empty($check_added_before))
		{
			$array_of_status['status'] = 0;
		}
		else
		{	
			// current month
			$current_month = date("m");
		
			$current_year = 0;
		
			// constant month
			$months = 10;
		
			if($current_month <= 12){
				if($baby_month <= 10){
					$remain_month = $months - $baby_month;
					$remaining_pregnancy_month = $current_month + $remain_month;
					if($remaining_pregnancy_month > 12){
						$remaining_pregnancy_month = $remaining_pregnancy_month - 12;
						$current_year = 1;
					}
				}
			}	
			
			$time = strtotime("+{$current_month} month +{$current_year} year", time());
		
			///////////////////////////////////////////////////
			
			date_default_timezone_set("Egypt");
			$form_array = array(
			'pregnancy_month' => $baby_month,
			'pregnancy_members_email' => $email,
			'pregnancy_date' => date("Y-m-d H:i:s"),
			'pregnancy_end_date' => date("Y-m-d", $time),
			);
			
			$this->membersmodel->insert_pregnancy($form_array);
			
			$newsletter_array = array(
			'newsletter_members_members_emails' => $email,
			'newsletter_members_newsletter_types_id' => $type,
			'newsletter_members_month_baby' => $baby_month
			);
			
			$status = $this->membersmodel->insert_newsletter_members($newsletter_array);
			$array_of_status['status'] = $status;
		}
		echo json_encode($array_of_status);
	}
	
	public function add_child_data_action()
	{
		$email = $_POST['newsletter_email'];
		//$baby_month = $_POST['baby_month'];
		$mom_name = $_POST['newsletter_Name_Of_Mom'];
		$baby_name = $_POST['newsletter_Name_Of_Baby'];
		$mobile = $_POST['newsletter_Phone_Number'];
		$home_address = $_POST['newsletter_Home_Address'];
		$awarness_source = $_POST['newsletter_Awarness_Source'];
		$type = $_POST['newsletter_type'];
		
		$date_today = date("Y-m-d");
		$baby_birthdate = $_POST['newsletter_Exact_Dat_Of_Birt'];
		
		// To calculate baby's months
		$time1 = strtotime($baby_birthdate);
		$time2 = strtotime($date_today);
		
		$year1 = date('Y', $time1);
		$year2 = date('Y', $time2);
		
		$month1 = date('m', $time1);
		$month2 = date('m', $time2);

		$baby_month = (($year2 - $year1) * 12) + ($month2 - $month1);
		
		
		$check_added_before = $this->newslettermodel->check_for_alreadyadded($email , $type);
		
		if(!empty($check_added_before))
		{
			$array_of_status['status'] = 0;
		}
		else
		{
			date_default_timezone_set("Egypt");
			$form_array = array(
			'child_age' => $baby_month,
			'pregnancy_members_email' => $email,
			'pregnancy_date' => date("Y-m-d H:i:s"),
			);
			
			$this->membersmodel->insert_pregnancy($form_array);
			
			$newsletter_array = array(
			'newsletter_members_members_emails' => $email,
			'child_age' => $baby_month,
			'newsletter_members_mom_name' => $mom_name,
			'newsletter_members_baby_name' => $baby_name,
			'newsletter_members_baby_birthdate' => $baby_birthdate,
			'newsletter_members_mobile_number' => $mobile,
			'newsletter_members_home_address' => $home_address,
			'newsletter_members_awarness' => $awarness_source,
			'newsletter_members_newsletter_types_id' => $type,
			);
			
			$status = $this->membersmodel->insert_newsletter_members($newsletter_array);
			$array_of_status['status'] = $status;
		}
		echo json_encode($array_of_status);
	}
	
	 
	public function test(){
		$data = array(
		array('id'=>1,'cat'=>1,'title'=>'Checken'),
		array('id'=>2,'cat'=>2,'title'=>'Meat'),
		array('id'=>3,'cat'=>1,'title'=>'Pizza'),
		array('id'=>4,'cat'=>2,'title'=>'Pasta'),
		array('id'=>5,'cat'=>3,'title'=>'Rice'),
		);
		echo "<pre>";
		print_r($data);
		$key = 2;
		echo "</pre>";
		echo "Search key = {$key} <br/>";
		$id = "";
		for($i=0; $i< sizeof($data); $i++){
			if($data[$i]['cat'] == $key){
				$id .= $data[$i]['id'].",";
			}
		}
		$new_array = explode(",", $id);
		$final_array = array_filter($new_array);
		echo "<pre>";
		print_r($final_array);
		echo "</pre>";
		
	}
	
	
	
	
}

