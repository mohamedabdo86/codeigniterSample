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
$user_ip_address : the ip address of the visitor
$user_agent : user agent are encrypted so we can check if he views the page or not
*/

class Totalviews {

	public function __construct()
    {
		$this->user_ip_address = $_SERVER['REMOTE_ADDR'];
    	$this->user_agent = md5($_SERVER['HTTP_USER_AGENT']);
    }
	
    public function add_view($item_type , $item_id , $item_table_name , $item_table_column , $member_id)
	{
		
		$CI =& get_instance();		
		$CI->load->model('globalmodel'); 
		
		//If item is not viewed before
		if ( !$CI->globalmodel->check_viewed_before($item_type , $item_id , $member_id , $this->user_ip_address , $this->user_agent) )
		{
			//Add item	
			$CI->globalmodel->add_view_to_view_table($item_type , $item_id , $member_id , $this->user_ip_address , $this->user_agent );
			$CI->globalmodel->add_view_to_main_table($item_id , $item_table_name , $item_table_column );

		}
		
	}
}

/* End of file Views .php */