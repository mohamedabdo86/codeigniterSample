<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emails extends CI_Controller {


   public function __construct()
   {
		parent::__construct();
		
		// Your own constructor code		 
				
		//Load Languages
		$this->load->helper('language');		
		$this->lang->load('globals');
		
		//Apply Languages
		$site_lang = $this->config->item('language');
		$this->data['current_language'] =  $site_lang;
		$this->data['current_language_db_prefix'] =   $site_lang == "arabic" ? "_ar" : "";
		
	}
	
	public function index()
	{
		$this->load->view("emails/email_welcome.php");
	}
	
	public function email()
	{
		$this->load->view("emails/email_welcome_en.php");
	}
	
	public function activated()
	{
			$this->load->view("emails/email_activated.php");
	}
	
	public function best_cook_email()
	{
			$this->load->view("emails/email_bestcook.php");
	}
	
	
	public function activation(){
		
		$this->load->view("emails/email_activation.php");
	}
	
	public function activation_en()
	{
		$this->load->view("emails/email_activation_en.php");
	}
		
		public function show_comment()
	{
		$this->load->view("emails/email_bestcook_show_comment.php");
	}
		
	/*	
	public function send_email($email="")
	{
		$data['name'] = "تجربة1";
		$data['url']  = "http://google.com";
		
		//$this->emailmanager->send_email("amakki@mediaandmore-eg.com","Test Modle",$data,'email_activation');
		
		//$data = $this->load->view("emails/email_activation.php" , '', true);

		//Send Activation Email
				/*	$this->load->library('email');
					$this->email->from('info@mynestle.com.eg', 'Be at your best');
					$this->email->to($email."@mediaandmore-eg.com"); 
					 $this->email->set_mailtype("html");
					$this->email->subject('Email Test');
					$this->email->message($data);	
					$this->email->send();
		//echo "ok";
	} */
	
	public function nestlefit_daily_email()
	{		
		$this->load->library('emailmanager');
		$this->load->library('nestlefit');
		$this->load->model('nestlefitmodel');
		$this->load->model('membersmodel');
		
		$notifications_type = "daily";
		$today = date('Y-m-d');
		
		$array = $this->nestlefitmodel->nestlefit_emails_notifications($notifications_type);
		
		foreach($array as $record)
		{
			$nestlefit_member_id = $record['nestle_fit_health_ID'];
			$data['name'] = $record['nestle_fit_health_name'];
			$data['total_calories_today'] = $this->nestlefit->get_total_calories_for_user_today($nestlefit_member_id);
			$total_water = $this->nestlefit->get_water($nestlefit_member_id,$today);
			$data['total_water_today'] = $total_water[0]['nestle_fit_water_count'];
			$email = $record['nestle_fit_health_mail'];
			
			if($email == '')
			{
				$member_info = $this->membersmodel->get_member_info($record['nestle_fit_health_member_ID']);
				$mail = $member_info[0]['members_email'];
			}
			else
			{
				$mail = $email;
			}
			
			$this->load->view('emails/email_nestlefit_daily', $data);
			
			//print_r($data);
			//$this->emailmanager->send_email($mail,"Daily Notifications",$data,'email_nestlefit_daily');		
		}
	}
	
	public function nestlefit_weekly_email()
	{
		
	}
	
	
} 

