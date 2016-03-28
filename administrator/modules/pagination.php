<?php

//Finished 13/1/2012

// This is a helper class to make paginating 
// records easy.

//Examples
/*
ON Initilize
$projects_count  = mysql_fetch_array($db -> query(" SELECT COUNT(*) FROM datasheets where  datasheets_isexterior = 0 "));
$pag_page 		 = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$pag_per_page 	 = 10;
$pag_total_count = $projects_count[0] ;
$pagination 	 = new Pagination($pag_page, $pag_per_page, $pag_total_count);
$paging			 = "LIMIT ".$pag_per_page." OFFSET ".$pagination->offset();
//============
Has Prev ?
if($pagination->has_previous_page()){
echo '<span class="pagecontrol"><a href="'.selfURLp().'page='.$pagination->previous_page().'">&lt;&lt; Previous</a></span>'; 
} 
else{
echo '<span class="pagedisabled">&lt;&lt; Previous</span>'; 
	}
//Display Pages
for($i=1;$i<=$pagination->total_pages();$i++){
if($i == $pagination->current_page ){
echo '<span class="pagenumbercurrent">'.$i.'</span>';
	}
else{
echo '<span class="pagenumber"><a href="'.selfURLp().'page='.$i.'">'.$i.'</a></span>';
}
}
if($pagination->has_next_page()){
echo '<span class="pagecontrol"><a href="'.selfURLp().'page='.$pagination->next_page().'">Next &gt;&gt;</a></span>'; 
} 
else{
	echo '<span class="pagedisabled">Next &gt;&gt;</span>'; 
	}	
*/

class Pagination {
	
  private $current_page;
  private $per_page;
  private $total_count;
  private $this_page_name_with_varibles;
  public $prev_message;
  public $next_message;
  public $addition_classes;

  public function __construct($page=1, $per_page=20, $total_count=0,$this_page_name_with_varibles =""){
  	$this->current_page = (int)$page;
    $this->per_page = (int)$per_page;
    $this->total_count = (int)$total_count;
    $this->prev_message = "&lt;&lt; Previous";
	$this->next_message = "Next &gt;&gt;";
	$this->addition_classes = "";
	$this->this_page_name_with_varibles = $this_page_name_with_varibles;
  }

  public function offset() {
    // Assuming 20 items per page:
    // page 1 has an offset of 0    (1-1) * 20
    // page 2 has an offset of 20   (2-1) * 20
    //   in other words, page 2 starts with item 21
    return ($this->current_page - 1) * $this->per_page;
  }

  private function total_pages() {
    return ceil($this->total_count/$this->per_page);
	}
	
  private function previous_page() {
    return $this->current_page - 1;
  }
  
  private function next_page() {
    return $this->current_page + 1;
  }

	private function has_previous_page() {
		return $this->previous_page() >= 1 ? true : false;
	}

	private function has_next_page() {
		return $this->next_page() <= $this->total_pages() ? true : false;
	}
	
	private function selfURLp()
	{
		if(!isset($_SERVER['REQUEST_URI'])){
			$serverrequri = $_SERVER['PHP_SELF'];
		}else{
			$serverrequri =    $_SERVER['REQUEST_URI'];
		}
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
		$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
		if($_REQUEST['page'] != "" || $_REQUEST['filter'] != "" || $_REQUEST['type'] != "" || $_REQUEST['area'] != "" || $_REQUEST['env'] != "" || $_REQUEST['flook'] != "" || $_REQUEST['system'] != "" ){
		$full_link = $protocol."://".$_SERVER['SERVER_NAME'].$port.$serverrequri."&";
		$link = str_replace("page=", "str=", $full_link);
		return $link;
		}
		else{
		return "?";	
		}  
}
	private function curPageURL() {
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
	}
	private function write_new_url($new_index="")
	{
		$contain_page_flag = false;
		$url = $this->curPageURL();
		
		
		//Divide URL into pieces
		$get_all_querys = parse_url($url);
		
		//Divide Query into pieces
		parse_str( parse_url( $url, PHP_URL_QUERY ), $check_for_page );
		
		//Check if Current Query contains Page
		if( isset($check_for_page['page']))
		$contain_page_flag = true;
		
		
		
		//If Page Found , Replace it with space
		if($contain_page_flag)
		{
			$possible_query_flag = array( "&page=".$check_for_page['page'] , "page=".$check_for_page['page']."&" , "page=".$check_for_page['page'] );
			$new_query_string = str_replace($possible_query_flag , "" , $get_all_querys['query'] );
		}
		else
		$new_query_string = $get_all_querys['query'];
		
		if($new_query_string=="")
		$returned_string =   "";
		else
		$returned_string = $new_query_string;
		
		if($new_index == "")
		$new_url = $get_all_querys['scheme']."://".$get_all_querys['host'].$get_all_querys['path']."?".$returned_string;
		else
		$new_url = $get_all_querys['scheme']."://".$get_all_querys['host'].$get_all_querys['path']."?".$returned_string."&page={$new_index}";
		
		return $new_url;
		
	}//End check_old_page_in_url();
	
	public function display_pag()
	{
		echo '<ul class="pagination '.$this->addition_classes.'">';
		//Has Prev?
		 if($this->has_previous_page())
		 {
			echo '<li class="pagecontrol"><span ><a href="'.$this->write_new_url($this->previous_page()).'">'.$this->prev_message.'</a></span></li>'; 
		 } 
		 else{
			echo '<li  class="pagedisabled"><span>'.$this->prev_message.'</span></li>'; 
		}
		
		//Display Pagination Numbers
		//BY AMAKKI 22102012
		if($this->total_pages() > 20)
		{
			$group_paging_counter = 1;
			for($i=$group_paging_counter ;$i<=5;$i++)
			{
				if($i == $this->current_page )
				{
					echo '<li class="pagenumbercurrent"><span >'.$i.'</span></li>';
				}
				else
				{
					echo '<li class="pagenumber"><span ><a href="'.$this->write_new_url($i).'">'.$i.'</a></span></li>';
				}
			}//End of For loop
			echo '<li>...</li>';
			
			if($this->current_page >=5 )
			{
				$group_paging_counter = $this->current_page;
				
				for($i=($group_paging_counter-3) ;$i<=($group_paging_counter+5) && $i<=$this->total_pages() ;$i++)
				{
					if($i <= 5 )
					{
						continue;
					}
					if($i == $this->current_page )
					{
						echo '<li class="pagenumbercurrent"><span >'.$i.'</span></li>';
					}
					else
					{
						echo '<li class="pagenumber"><span ><a href="'.$this->write_new_url($i).'">'.$i.'</a></span></li>';
					}
				}//End of For loop
				
			}//End of $this->current_page >5 
			
			echo '<li>...</li>';
			
			//Write Last Page
			if($this->total_pages() != $this->current_page )
			{
				echo '<li class="pagenumber"><span ><a href="'.$this->write_new_url($this->total_pages()).'">'.$this->total_pages().'</a></span></li>';
			}
			
		}
		else
		{
			for($i=1;$i<=$this->total_pages();$i++)
			{
				if($i == $this->current_page )
				{
					echo '<li class="pagenumbercurrent"><span >'.$i.'</span></li>';
				}
				else
				{
					echo '<li class="pagenumber"><span ><a href="'.$this->write_new_url($i).'">'.$i.'</a></span></li>';
				}
			}//End of For loop
		}//End of If total_pages() > 20
		
		//Has Next
		 if($this->has_next_page())
		 {
			echo '<li class="pagecontrol"><span ><a href="'.$this->write_new_url($this->next_page()).'">'.$this->next_message.'</a></span></li>'; 
		 } 
		else
		{
			echo '<li  class="pagedisabled"><span>'.$this->next_message.'</span></li>'; 
		}
		
		echo '</ul>
		<div id="goto_form">
		Page: 
		<input style="width:50px;" width="30" type="text" id="gotopage_value" name="gotopage_value" value="'.$this->current_page.'" />
		&nbsp; / '.$this->total_pages().'
		<input data-href="'.$this->write_new_url().'" type="button" class="white_button_border_gray" id="gotopage_button" name="gotopage_button" value="Go To"  />
		</div>
		
		<div class="clear"></div>
		<script>
		$(document).ready(
		function()
		{
			$("#gotopage_button").click(
			function()
			{
				var href = $(this).data("href");
				var new_page = $("#gotopage_value").val();
				location.href = href + "&page="+new_page;
				
			}
			);
		}
		);
		</script>
		';
		
	}//End of display_pag()


}

?>