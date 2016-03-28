<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
 
    function switchLanguage($language = "" ) {
        $language = ($language != "") ? $language : "english";
		
		
		
	
		
		//language verify
		if($language != "arabic" && $language != "english")
		redirect(  $this->session->userdata('last_visited_url'));
		 
		
		
        $this->session->set_userdata('site_lang', $language);
        redirect( $this->session->userdata('last_visited_url') );
	   
    }
}
