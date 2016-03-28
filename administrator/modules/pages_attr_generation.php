<?php
class dynamic_attr
{
	
	private $action_form;
	private $action_type;
	private $page_name ;
	private $single_term ;
	private $plural_term ;
	private $page_id;
	
	public function __construct($action_type="Add",$action_form,$page_name,$single_term,$plural_term,$page_id)
	{
		$this->page_name = $page_name;
		$this->single_term = $single_term;
		$this->plural_term = $plural_term;
		$this->action_form = $action_form;
		$this->action_type = $action_type;
		$this->page_id = $page_id;
		
	}

	public function generate_pages_attr()
	{
		global $db;
		$title_of_page = $db->querySelectSingle("select pages_title from pages where pages_ID=".$this->page_id);
		$string = '
		 <article class="module width_full">
				<header><h3>'.$this->action_type.' Attributes of " '.$title_of_page['pages_title'].' " </h3></header>
				
				<div id="main_draggable_wrapper">
		';
		$string .= $this->generate_droppable_area();
		$string .= $this->generate_buttons();
		
		$string .= '<div class="clear"></div>
        
        </div><!-- End of main_draggable_wrapper -->
			
		</article><!-- end of stats article -->';
		
		return $string;
		
	}
	public function generate_pages_headers()
	{
		global $db;
		$title_of_page = $db->querySelectSingle("select pages_title from pages where pages_ID=".$this->page_id);
		$string = '
	 	<article class="module width_full">
		<header><h3>'.$this->action_type.' Headers of " '.$title_of_page['pages_title'].' " </h3></header>
				
		<div id="main_draggable_wrapper">
		';
		$string .= $this->generate_droppable_area_forheaders();
		$string .= $this->generate_buttons_headers();
		
		$string .= '<div class="clear"></div>
        
        </div><!-- End of main_draggable_wrapper -->
			
		</article><!-- end of stats article -->';
		
		return $string;
		
	}
	public function generate_droppable_area()
	{
		global $db;
		$string = '
		<div id="dropin_container" class="out ui-droppable style_dropin_container">
		<div class="dropin_items_wrapper">
		';
		
		//check if page already has attr..
		if($this->action_type == "Edit" && $this->page_id != "" )
		{
			$display = $db->querySelect("select * from pages_attr where pages_attr_pages_ID=".$this->page_id." order by pages_attr_order");
			
			$next_global_number_of_attr  = ( sizeof($display)  );
			
			echo '<script>
			next_global_number_of_attr = '.$next_global_number_of_attr.';
			</script>';
			
			for($i=0;$i<sizeof($display);$i++)
			{
				$req_check = '';
				if($display[$i]['pages_attr_req']) $req_check = 'checked';
				
				
				
				//Check type name 
				$type_field_name = dynamic_posts_pages::get_full_type_name($display[$i]['pages_attr_type']);
				
					
				
				$string .='<div table_id="'.$display[$i]['pages_attr_ID'].'" id="'.$i.'" class="input_handler"><h2>'.$type_field_name.'</h2>
				<a table_id="'.$display[$i]['pages_attr_ID'].'"  id="'.$i.'" class="delete_button" >X</a>
				<input class="pages_attr_hidden_type" type="hidden" name="pages_attr_hidden_type_'.$i.'" value="'.$display[$i]['pages_attr_type'].'" /><fieldset><label>Title: <input class="pages_attr_title" name="pages_attr_title_'.$i.'" type="text" value="'.$display[$i]['pages_attr_title'].'" /> </label></fieldset><fieldset><label>Attr. ID: <input class="pages_attr_valueid" name="pages_attr_valueid_'.$i.'" type="text" value="'.$display[$i]['pages_attr_value_ID'].'" /> </label></fieldset><fieldset><label>Requiried : <input class="pages_attr_req" '.$req_check.' type="checkbox" value="1" name="pages_attr_req_'.$i.'" /></label></fieldset>';
				
				if($display[$i]['pages_attr_type']== "text")
				{
					$num_check = '';
					$email_check = '';
					$char_check = '';
					if($display[$i]['pages_attr_limitations'] == "") $none_check = 'checked';
					if($display[$i]['pages_attr_limitations'] == "num_only") $num_check = 'checked';
					if($display[$i]['pages_attr_limitations']  == "email_val") $email_check = 'checked';
					if($display[$i]['pages_attr_limitations'] == "chars_only") $char_check = 'checked';
				$string .= 'Extra Options :<fieldset><label><input class="pages_attr_extra" type="radio" name="pages_attr_extra_'.$i.'" value="" '.$none_check.' />None</label> <label><input class="pages_attr_extra" type="radio" name="pages_attr_extra_'.$i.'" value="num_only" '.$num_check.' />Numbers only</label><label><input class="pages_attr_extra" type="radio" name="pages_attr_extra_'.$i.'" value="chars_only" '.$char_check.' />Characters only</label><label><input type="radio" class="pages_attr_extra" name="pages_attr_extra_'.$i.'" value="email_val" '.$email_check.' />Email Validation</label></fieldset>';
				}
				
				$string .= '</div>';
			}
		}
		
		$submit_display_handle = empty($display) ? "disable" : "";
		$string .='
		</div><!-- End of #dropin_items_wrapper -->
		<div class="drop_text">Drop Me Here</div>
		
		
		<div ><input id="'.$this->page_id.'" action_expected="'.$this->action_type.'" class="button_save_attr '.$submit_display_handle.' " type="button" value="Submit" /></div>	
		<div class="clear"></div>
				  
		</div><!--  End of dropin_container -->';
				 
		return $string;
		
		
	}
	public function generate_droppable_area_forheaders()
	{
		global $db;
		$string = '
		<div id="dropin_container_headers" class="out ui-droppable style_dropin_container">
		<div class="dropin_items_wrapper">
		';
		
		//check if page already has attr..
		if($this->action_type == "Edit" && $this->page_id != "" )
		{
			$display = $db->querySelect("select *
			from pages_header
			
			where pages_header_pages_ID=".$this->page_id." order by pages_header_order");
			
			$next_global_number_of_headers  = ( sizeof($display)  );
			
			echo '<script>
			next_global_number_of_headers = '.$next_global_number_of_headers.';
			</script>';
			
			for($i=0;$i<sizeof($display);$i++)
			{
				$detail_header = $db->querySelectSingle("select * from pages_attr where pages_attr_value_ID='".$display[$i]['pages_header_pages_attr_value_ID']."'");
				
				
				//Check type name 
				$type_field_name = dynamic_posts_pages::get_full_type_name($detail_header['pages_attr_type']);
				
				$string .='<div id="'.$display[$i]['pages_header_pages_attr_value_ID'].'" class="input_handler small"><h2> '.$detail_header['pages_attr_title'].'  <small>( '.$type_field_name.' ) </small></h2>
				<input type="hidden" class="pages_header_values" value="'.$display[$i]['pages_header_pages_attr_value_ID'].'"  />
				<a table_id="'.$display[$i]['pages_attr_ID'].'"  id="'.$display[$i]['pages_header_pages_attr_value_ID'].'" class="delete_button_headers" >X</a>';
				$string .= '</div>';
			}//End of for loop
		}
		
		$submit_display_handle = empty($display) ? "disable" : "";
		$string .='
		</div><!-- End of #dropin_items_wrapper -->
		<div class="drop_text">Drop Me Here</div>
		
		
		<div ><input id="'.$this->page_id.'" action_expected="'.$this->action_type.'" class="button_save_header '.$submit_display_handle.' " type="button" value="Submit" /></div>	
		<div class="clear"></div>
				  
		</div><!--  End of dropin_container -->';
				 
		return $string;
		
		
	}
	public function generate_buttons()
	{
		$string = '<div id="buttons_container">
			<h2>Buttons</h2>
			<div id="items">
					<div id="text"  class="item ui-draggable" style="position: relative;"><span>Text Field</span></div>
					<div id="textarea" class="item ui-draggable" style="position: relative;"><span>Text Area</span></div>
					<div id="date" class="item ui-draggable" style="position: relative;"><span>Date</span></div>
					<div id="select" class="item ui-draggable" style="position: relative;"><span>Select</span></div>
			</div>
			</div><!-- End of buttons_container -->
			';
			
		return $string;
	}
	public function generate_buttons_headers()
	{
		global $db;
		
		$attr_display = $db->querySelect("select * from pages_attr 
		where pages_attr_pages_ID=".$this->page_id."
		
		order by pages_attr_order");
		
		$string = '<div id="buttons_container">
			<h2>Attributes</h2>
			<div id="items">';
			
			for($i=0;$i<sizeof($attr_display);$i++)
			{
				$display_none = "";
				
				$no_of_attr = $db->numRows("select * from pages_header 
				where pages_header_pages_attr_value_ID='".$attr_display[$i]['pages_attr_value_ID']."' 
				and pages_header_pages_ID=".$this->page_id);
				$display_none = $no_of_attr == 0 ? "" : "display:none;";
			$string .= '<div id="'.$attr_display[$i]['pages_attr_value_ID'].'"  class="item_headers ui-draggable" style="position: relative;'.$display_none.'"><span>'.$attr_display[$i]['pages_attr_title'].' <small> ( '.$attr_display[$i]['pages_attr_type'].' )</small></span></div>';
			}
			
			$string .= '</div>
			</div>
			</div><!-- End of buttons_container -->
			';
			
		return $string;
	}
	
	
}
?>