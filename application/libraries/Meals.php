<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Meals 
{
	//$params
	public function get_meals($params)
	{
		$CI =& get_instance();
		
		$id = $params['foreign_id'];
		$data = $params['data'];
		$read_only = $params['read_only'];
		$val_4 = $params['val_4'];
		$val_2 = $params['val_2'];
		
		$array_lenght = count($data);

		
		$data['id'] = $id;
		$data['array'] = $data;
		$data['array_lenght'] = $array_lenght;
		$data['read_only'] = $read_only;
		$data['val_4'] = $val_4;
		$data['val_2'] = $val_2;
		
		return $CI->load->view('best_me/fit_app/meals_view', $data, true); 
 
	}
	
	public function get_meals_mobile($params)
	{
		$CI =& get_instance();
		
		$id = $params['foreign_id'];
		$data = $params['data'];
		$read_only = $params['read_only'];
		$val_4 = $params['val_4'];
		$val_2 = $params['val_2'];
		
		$array_lenght = count($data);

		
		$data['id'] = $id;
		$data['array'] = $data;
		$data['array_lenght'] = $array_lenght;
		$data['read_only'] = $read_only;
		$data['val_4'] = $val_4;
		$data['val_2'] = $val_2;
		
		return $CI->load->view('mobile/best_me/fit_app/meals_view', $data, true); 
 
	}
	
	
    public function get_comment($params)
    {
		$foreign_id = $params['foreign_id'];
		$table = $params['table'];
		
		$CI =& get_instance();
		$CI->load->model('ratemodel'); 
		$CI->load->model('commentmodel'); 
		$CI->load->model('membersmodel');  
		$display_comments = $CI->commentmodel->get_comments_from_db($table,$foreign_id);
		
		$display_array = '';
		$display_array .= '<div class="comments_wrapper">';
		$display_array .= '<ul>';
		
		    foreach($display_comments as $comments) :
			$comment = $comments['comments_message'];
			$date = date("Y-m-d",strtotime($comments['comments_date']));
			$comment_member_id = $comments['comments_members_id'];
			$member_info = $CI->membersmodel->get_member_info($comment_member_id);
			if(!$member_info)
			{
				 $member_thumb  = 'personal_img.png';
			}
			else
			{
				if(!$member_info[0]['members_images'] or $member_info[0]['members_images'] == 0)
				 {
					  $member_thumb  = 'personal_img.png';
				 }
				 else
				 {
					 $image_src = $CI->membersmodel->get_member_image($member_info[0]['members_ID']);
					 $member_thumb  = $image_src[0]['images_src'];
					 
				 }
			}
			
		$display_array .= '<li class="member_comment_wrapper">';
		$display_array .= '<div class="member_image_column float_left"><img width="40" height="40" src="'. base_url().'uploads/members/'.$member_thumb.'" /></div>';
		$display_array .= '<div class="member_comment_column float_left">';

		
		$display_array .= '<div class="comment_message dark_gray"><h5>'.$comment.'</h5></div>';
		$display_array .= '<div class="comment_date dark_gray"><h5>'.$date.'</h5></div>';
		$display_array .= '<div class="clear"></div>';
		$display_array .= '</div>';
		$display_array .= '<div class="member_like_column float_right">';
		$display_array .= '<ul style=" display:none">
								<li class="dislike_icon float_right"><a class="dislike_comment"><div class="dislike_image" ></div></a></li>
								<li class="break float_right"></li>
								<li class="like_icon float_right"><a class="like_comment"><div class="like_image"></div></a></li>
						   </ul>';
						   
						$display_array .= '<div class="rating float_left" style="width: 110px; margin:5px;margin-top: 14px;">';
							 
						$display_rate = $CI->ratemodel->get_member_rate_from_db($table,$foreign_id,$comment_member_id); // $member_id
						if($display_rate){
						$display_array .= '<div class="exemple">';
						$display_array .= '<div class="basic_disable" data-average="'.$display_rate['members_rate_stars'].'" data-member="'.$comment_member_id.'" data-type="'.$table.'"  data-id="'.$foreign_id.'"></div>';
						$display_array .= '</div>';
              
              			 $display_array .=  '</div>';//<!--End Of Rating-->
						}
		$display_array .= '</div>';
		$display_array .= '</li>'; // end of li
			
			endforeach;
			
		$display_array .= '</ul>';
 		$display_array .= '</div>';
		
		return $display_array;
	}
	
	public function insert_comments($params)
	{
		/*
		missing parameter
		user_id
		article_id
		*/
		$member_id = $params['member_id'];
		$member_email = $params['member_email'];
		$foreign_id = $params['foreign_id'];
		$section_id = $params['section_id'];
		$table = $params['table'];
		$current_section_background_color = $params['current_section_background_color'];
		
		$display_array = '';
		$display_array .= '<div id="insertbeforMe" class="comment_big_input_wrapper">';
		$display_array .= '<form action="" method="post" name="submit_comment" class="submit_comment">';
		$display_array .= '<input type="hidden" name="member_id" value="'.$member_id.'" />';
		$display_array .= '<input type="hidden" name="member_email" value="'.$member_email.'" />';
		$display_array .= '<input type="hidden" name="foreign_id" value="'.$foreign_id.'" />';
    	$display_array .= '<input type="hidden" name="section_id" value="'.$section_id.'" />';
		$display_array .= '<input type="hidden" name="table" value="'.$table.'" />';
    	$display_array .= '<input type="hidden" value="'.base_url().'" id="baseurl">';
    	$display_array .= '<textarea name="message" id="message" class="comment_big_input float_left" placeholder="'.lang("globals_write_comment").'" ></textarea>';
    	$display_array .= '<input type="submit" class="search_big_button float_right '.$current_section_background_color.' white_color" value="'.lang("globals_send").'" /> ';
		$display_array .= '</form>';
  		$display_array .= '<div class="clear"></div>';
        $display_array .= '</div>'; // End of comment_big_input_wrapper
		
		return $display_array;
	}
}

/* End of file Meals.php */









