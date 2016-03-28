<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**************************************
IMPORTANT NOTE:
//This Class is cancelled by AMAKKI at 08012014 and no longer in use
*****************************************/
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
 	
		//This is an old language (through session)
        $site_lang = $ci->session->userdata('site_lang');
        if ($site_lang) {
            $ci->lang->load('globals',$ci->session->userdata('site_lang'));
			$ci->lang->load('bestcook',$ci->session->userdata('site_lang'));
        } else {
            $ci->lang->load('globals',$ci->config->item('language') );
			 $ci->lang->load('bestcook',$ci->config->item('language') );
			$ci->session->set_userdata('site_lang', $ci->config->item('language') );
        }
		
		$ci->session->set_userdata('current_language', $site_lang  );
		$ci->session->set_userdata('current_language_db_prefix',  $site_lang == "arabic" ? "_ar" : ""  );
    }
}