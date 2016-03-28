<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Rate 
{
	//$params
    public function get_rate($params)
    {
		$table = $params['table'];
		$foreign_id = $params['foreign_id'];
		$member_id = $params['member_id'];
		
		$CI =& get_instance();
		$CI->load->model('ratemodel');
		$CI->load->model('membermodelnew');
		$display_rate = $CI->ratemodel->get_rate_from_db($table,$foreign_id);
		$display_check = $CI->ratemodel->check_rate($table,$foreign_id,$member_id);
		/*if($display_check == 0)
		{
			$disable = '';
		}
		else
		{
			$disable = 'jDisabled';
		}*/
		$disable = '';
				
		$display_array = '';
		$display_array .= '<div class="exemple" >';
		$display_array .= '<div class="basic '.$disable.'" data-average="'.$display_rate['sum_rate'].'" data-member="'.$member_id.'" data-type="'.$table.'"  data-id="'.$foreign_id.'"></div>';
		$display_array .= '</div>';
		
		return $display_array;
	}
	
	 public function get_video_rate($params)
    {
		$table = $params['table'];
		$foreign_id = $params['foreign_id'];
		$member_id = $params['member_id'];
		$type = $params['type'];
		
		$CI =& get_instance();
		$CI->load->model('ratemodel');  
		$display_rate = $CI->ratemodel->get_rate_from_db($table,$foreign_id);
				
		$display_array = '';
		$display_array .= '<div class="exemple" >';
		$display_array .= '<div class="basic" data-table="members_rate" data-average="'.$display_rate['sum_rate'].'" data-member="'.$member_id.'" data-type="'.$type.'"  data-id="'.$foreign_id.'"></div>';
		$display_array .= '</div>';
		
		return $display_array;
	}
	
	public function get_member_rate($params)
	{
		$CI =& get_instance();
		$CI->load->model('ratemodel'); 
		
		  
		$display_rate = $CI->ratemodel->get_member_rate_from_db($params['type'],$params['foreign_id'],$params['member_id']);
		
		if($display_rate)
		{
			$rate = $display_rate['members_rate_stars'];
			
		}
		else
		{
			$rate = '0';
		}
		
		$display_array = '';
		$display_array .= '<div class="exemple">';
		$display_array .= '<div class="basic" data-table="'.$params['table'].'" data-average="'.$rate.'" data-member="'.$params['member_id'].'" data-type="'.$params['type'].'"  data-id="'.$params['foreign_id'].'"></div>';
		$display_array .= '</div>';
		//data-average="'.$display_rate['members_rate_stars'].'"
		
		return $display_array;
	}
	
	public function get_disable_rate($params)
	{
		$display_array = '';
		$display_array .= '<div class="exemple">';
		$display_array .= '<p id="disable_msg" class="'.$params['current_section_background_color'].' ">'.lang("globals_disable_rate").'</p>';
		$display_array .= '<div class="basic_disable disable_rate" data-table="" data-average="" data-member="" data-type="recipes"  data-id=""></div>';
		$display_array .= '</div>';		
		return $display_array;
	}
	
	public function get_recipe_rate($params)
	{
		$table = $params['table'];
		$foreign_id = $params['foreign_id'];
		
		$CI =& get_instance();
		$CI->load->model('ratemodel');
		
		
		$display_rate = $CI->ratemodel->get_rate_from_db($table,$foreign_id);
		
		
		$display_array = '';
		$display_array .= '<div class="exemple">';
		$display_array .= '<div class="basic_disable" data-average="'.$display_rate['sum_rate'].'" data-type="'.$table.'"  data-id="'.$foreign_id.'"></div>';
		$display_array .= '</div>';
		
		
		return $display_array;
	}
}


/* End of file Comments.php */

