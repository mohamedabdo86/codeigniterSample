<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Treemenu {
	
	private $array_of_links = array();
	
    public function add_tree_page($page_name , $url )
    {
		unset($temp_array);
		$temp_array =  array ("page_name" => $page_name , "page_url" => $url ); 
		$this->array_of_links[] = $temp_array;
		
		
    }
	
	public function get_tree_array()
	{
		return $this->array_of_links;
	}
}

/* End of file Treemenu.php */