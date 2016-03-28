<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


/* Views Library :

A Library to manage the views of any item of the website with different types
Just call the function add_view and give it these paramterrs
:
$item_type : choose one from "articles" , "recipes" , "videos"    :Hint : If you going to define a new type, write it down here
$item_id : the id of the item that we want to increase its views
$item_table_name : the table name that contains the item. "The ID column will be always [the table name]_ID . 
$item_table_column : the column of the views 
$member_id : the id of the item visitor , could be a member id or a "false" to indicate that the item was visited by a guest.
$ip : the ip address of the visitor
$inner_ip : the local ip address of the visitor ( Currently still in test version ) 



*/


class Newslettermodule {
	
	
	//public $array_of_newsletter
	
	
	public function __construct()
    {
        // Do something with $params
		
		//Define Static
		
		
		
    }
	
	
	public function get_newsletter_icons_homepage($id)
	{
		$CI =& get_instance();		
		$CI->load->model('newslettermodel'); 
		$list_of_news_letter = $CI->newslettermodel->get_newslettertypes_homepage_flag($id);
		
		return $list_of_news_letter;
	}
	
	public function get_newsletter_title($id,$current_language_db_prefix)
	{
		$CI =& get_instance();		
		$CI->load->model('newslettermodel'); 
		$display = $CI->newslettermodel->get_newslettertypes_details($id);
		
		$title= $display[0]['newsletter_types_title'.$current_language_db_prefix];
		
		return $title;
	}
	
	public function add_email($email , $type)
	{
		
		$CI =& get_instance();		
		$CI->load->model('newslettermodel'); 
		//Check if added before same email and same type 
		$check_added_before = $CI->newslettermodel->check_for_alreadyadded($email , $type);
		
		//If yes , return an added before 0
		if(!empty($check_added_before))
		return 0;
		
		//If no , add and return an 1
		$formdata['newsletter_email'] = $email;
		$formdata['newsletter_type_of_newsletter'] = $type;
		$formdata['newsletter_dateadded'] = date('Y-m-d');
		$CI->newslettermodel->add_new_record($formdata);
		return 1;
		
	}
	
   
}

/* End of file Views .php */