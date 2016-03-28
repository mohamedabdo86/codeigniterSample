<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MembersLoader {
    function initialize() {
        $CI =& get_instance();
		
		 //Load Session
		$CI->load->library('session');
		
		$CI->load->model('membersmodel');
		
		//Load Members Stuff
		$CI->load->library("members");
		
		/*if( $CI->session->userdata('userid'))
		{
			$member_id = $CI->session->userdata('userid');

			$CI->members->set_members_data($member_id);
			
		}*/
		
		if( $CI->session->userdata('userid')) {
			$member_id = $CI->session->userdata('userid');

			$CI->members->set_members_data($member_id);
					
			$member_data = $CI->membersmodel->find_members_log($CI->session->userdata('userid'));
			
			$member_browser = $member_data[0]['members_log_browser'];
			$member_version = $member_data[0]['members_log_browser_version'];
			$member_is_browser = $member_data[0]['members_log_is_browser'];
			$member_ipaddress = $member_data[0]['members_log_ipaddress'];
			
			
			$session_browser = $CI->session->userdata('members_browser');
			$session_version = $CI->session->userdata('members_browser_version');
			$session_is_browser = $CI->session->userdata('members_is_browser');
			$session_ipaddress = $CI->session->userdata('ip_address');
			
			if($member_browser != $session_browser || $member_version != $session_version || $member_is_browser != $session_is_browser || $member_ipaddress !=$session_ipaddress) {
				 $CI->session->sess_destroy();
				 redirect('');
			}
			
		}
		
		
		//Set A new Member Anyway
		//$CI->members->set_members_data(5);	
    }
}