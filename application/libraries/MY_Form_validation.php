<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

//include_once("../../system/libraries/Form_validation.php");

class MY_Form_validation extends CI_Form_validation
{
	
		public function __construct($rules = array())
	    {
			parent::__construct($rules);
	    }
	
	
		 /*
		 * advanced_username
		 *
		 * @access	public
		 * @param	string
		 * @return	bool
		 */
		public function advanced_username($str)
		{
			$str = trim($str);
			$error = 0;
			
			//"~^[a-z0-9\-_\s\p{Arabic}]{1,60}$~iu"
			if(!preg_match("/^[a-z\-_\s\p{Arabic}][a-z0-9\-_\s\p{Arabic}]{1,60}$/iu", $str) )
			{
				$error = 1;
			}

			if($error == 0)
			{
				return true;
			}
			else
			{
				//$this->lang->load('mycorner');
				//$this->form_validation->set_message('custom_server_side_username_form_validator', lang('mycorner_caution_username_min'));
				return false;
			}
		}
		
		
		/*
		 * advanced_firstlastname
		 *
		 * @access	public
		 * @param	string
		 * @return	bool
		 */
		function advanced_firstlastname($str)
		{
			$str = trim($str);
			$error = 0;
		
			if(!preg_match("~^[a-z\s\p{Arabic}]{1,60}$~iu", $str) )
			{
				$error = 1;
			}
		
			if($error == 0)
			{
				
				return true;
			}
			else
			{
				//$this->lang->load('mycorner');
				//$this->form_validation->set_message('custom_server_side_firstlastname_form_validator', lang('mycorner_caution_name'));
				return false;
			}
		}
		
		
		/*
		* Custom str form validator
		*/
		function advanced_password($str)
		{
			$str = trim($str);
			$has_error = 0;
			
			if( strlen($str) < 8 )
			{
				$has_error = 1;
			}
 
			if( !preg_match("#[0-9]+#", $str) )
			{
				$has_error = 1;
			}
 
			if( !preg_match("#[a-z]+#", $str) )
			{
				$has_error = 1;
			}
 
			if( !preg_match("#[A-Z]+#", $str) )
			{
				$has_error = 1;
			}
			
			if(substr_count($str, '!') == 0 && substr_count($str, '@') == 0 && substr_count($str, '#') == 0 && substr_count($str, '$') == 0 && substr_count($str, '%') == 0 && substr_count($str, '&') == 0 && substr_count($str, '*') == 0 && substr_count($str, '_') == 0 && substr_count($str, '-') == 0 && substr_count($str, '~') == 0)
			{
				$has_error = 1;
			}
			
			if($has_error == 1)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		
		
		/*
		* Check if the username is available
		*/
		function username_found($str)
		{
			$CI = $this->CI =& get_instance();
			
			$CI->load->model('membersmodel');
			$found = $CI->membersmodel->check_valid_username($str);
			
			if(!$found)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		
		
		/*
		* Check if the email is available
		*/
		function email_found($str)
		{
			$CI = $this->CI =& get_instance();
			
			$CI->load->model('membersmodel');
			$found = $CI->membersmodel->check_email_found($str);
			if(!$found)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	
}

/* End of file Metatags.php */