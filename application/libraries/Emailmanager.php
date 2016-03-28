<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Emailmanager {
	
	public $from_subject;
	public $from_email;
	
	public function __construct()
    {
		$this->from_email = "noreply@eg.nestle.com";
		$this->from_subject = "Nestle Choose Wellness";

	}
	
    public function send_email($toemail ,$email_subject , $data , $view)
	{
		$CI =& get_instance();
		$CI->load->library('email');		
		
		$message = $CI->load->view("emails/".$view , $data , true);		
		
		$CI->email->from($this->from_email, $this->from_subject);
		$CI->email->to($toemail); 
		$CI->email->set_mailtype("html");
		$CI->email->subject($email_subject);
		$CI->email->message($message);	
		$CI->email->send();
		
		return true;
	}
	
	public function send_contactus_admin_email($toemail ,$email_subject , $data , $view, $attched_file)
	{
		
		$CI =& get_instance();
		$CI->load->library('email');		
		
		$message = $CI->load->view("emails/".$view , $data , true);		
		$CI->email->from($this->from_email, $this->from_subject);
		$CI->email->to($toemail); 
		$CI->email->set_mailtype('text');
		$CI->email->subject($email_subject);
		$CI->email->message($message);	
		
		if($attched_file != '')
		{
			$CI->email->attach($attched_file);
		}
		
		$CI->email->send();
		
		return true;
	}
	
	public function send_admin_email($toemail ,$email_subject , $data , $view)
	{
		$CI =& get_instance();		
		
		$message = $CI->load->view("emails/".$view , $data , true);
		
		$CI->load->library('email');
		$CI->email->from($this->from_email, $this->from_subject);
		$CI->email->to($toemail); 
		$CI->email->set_mailtype("text");
		$CI->email->subject($email_subject);
		$CI->email->message($message);	
		$CI->email->send();
		
		return true;
	}
	
	
	public function send_email_group($email_list ,$email_subject , $data , $view)
	{
		$CI =& get_instance();		
		
		
		$CI->load->library('email');
		foreach ($data as $emai_id => $id)
		{
			foreach ($email_list as $name => $address)
			{
			  $CI->email->clear();
			  $email_id['id'] = $id;
			  $message = $CI->load->view("emails/".$view , $email_id , true);
			  
			  $CI->email->from($this->from_email, $this->from_subject);
			  $CI->email->to($address); 
			  $CI->email->set_mailtype("html");
			  $CI->email->subject($email_subject);
			  $CI->email->message($message);	
			  $CI->email->send();
			  }
		}
		
		return true;
	}
		

}
