<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

// application/core/MY_Exceptions.php
class MY_Exceptions extends CI_Exceptions 
{
	public function __construct()
   {
		parent::__construct();
   }
   
  function show_error($heading, $message, $template = 'error_general', $status_code = 500)
	{	
		//Makki Security Test / 07-01
		//redirect('notfound');	
		include(APPPATH.'config/config.php');
		
		//echo "makki".$config['base_url'];
		
		die("<script>location.href = '".$config['base_url']."' </script>");
		
		 
	}
	
	

}