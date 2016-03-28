<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lightbox extends CI_Controller {

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
		$this->lang->load('globals');
		$this->lang->load('lightbox_messages');
		
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
 
		 
		 //
		$status = $this->uri->segment(4);
		$url=site_url("my_corner/send_activation_mail");
		$link="<a class='fancybox fancybox.ajax' style='color:rgb(0, 35, 255);' href='".$url."'>".lang('activation_mail_click_here')."</a>";
	 	$this->data['title'] = lang($this->router->method."_".$status."_title" , $link);
		$this->data['desc'] = lang($this->router->method."_".$status."_desc" , $link);
		 
   }
	public function account_confirmed($status)
	{
		
		$this->load->view('static_pages/view_lightbox' , $this->data);
	}
	public function login_status($status)
	{
		
		$this->load->view('static_pages/view_lightbox' , $this->data);
	}
	function get_messages_title()
	{
		
	}
	function get_messages_desc()
	{
		
	}
	public function success($status)
	{
		$this->load->view('static_pages/view_lightbox' , $this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */