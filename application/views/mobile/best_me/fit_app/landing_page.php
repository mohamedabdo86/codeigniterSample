<?php
$this->load->library('nestlefit');
$this->load->view("mobile/best_me/fit_app/nestle-fit-css");
if($this->members->members_id)
{
	$data['members_login'] = 'true';
	

	$check = $this->nestlefit->check_user_register($this->members->members_id);
	
	if($check)
	{
		$data['members_data'] = $this->nestlefit->member_data($check);
		$data['start_date'] = $data['members_data'][0]['nestle_fit_health_date'];
	}
	else
	{
		$check_second_step = $this->nestlefit->check_user_for_second_step($this->members->members_id);
		if($check_second_step)
		{
			$data['members_data'] = $this->nestlefit->member_data($check_second_step);
			$data['start_date'] = $data['members_data'][0]['nestle_fit_health_date'];
		}
	}
	
	$data['members_image'] = base_url()."uploads/members/".$this->members->members_image;
	
	//nestlefit_member_image function recall the image with height and width you enter 
	function nestlefit_member_image($image,$width, $height)
	{
		return '<img id="user_image" src="'.$image.'" style="width:'.$width.'px; height:'.$height.'px; ">';
	}
	
}
else
{
	$data['members_login'] = 'false';	
	$data['members_data'] = 'false';
}


//Landing Page For All Applications
if($val_1 == "homepage" || $val_1 == "")
$this->load->view("mobile/best_me/fit_app/homepage" , $data);

//Home Page Calculate Calories App
if($val_1 == "calories_calculator")
{
	$data['inner_gallery_flag'] = false;
	$this->load->view("mobile/best_me/fit_app/calories_calculator" , $data);
}

//Home Page Burn Rate App
if($val_1 == "burn_rate")
{
	$data['inner_gallery_flag'] = true;
	$this->load->view("mobile/best_me/fit_app/burn_rate" , $data);
}

$check = $this->nestlefit->check_user_register($this->members->members_id);
if($val_1 == "best_life_nestle" && !$val_2)
{
	if($check)
	{
		//redirect member to second step
		redirect('mobile/best_me/applications/9/best_life_nestle/'.$check.'');
	}else
	{
		//first time member register
		$this->load->view("mobile/best_me/fit_app/best_life_nestle");
	}
}

if($val_1 == "best_life_nestle" && $val_2 && !$val_3)
{
	$check_second_step = $this->nestlefit->check_user_for_second_step($check);
	if($check_second_step)
	{
		redirect('mobile/best_me/applications/9/best_life_welcome/'.$val_2.'');
	}else{
		$this->load->view("mobile/best_me/fit_app/best_life_second_step", $data);
	}
}

// New Register Page
if($val_1 == "new_register" )
{
	$this->load->view("mobile/best_me/fit_app/best_life_new_registration", $data);
}


//Home Page Nestle Fit App
if($val_1 == "best_life_welcome" && $val_2 && !$val_3)
{
	//is_login(); // if member not login will redirct to best_me/applications/9
	$this->load->view("mobile/best_me/fit_app/best_life_welcome", $data);
}

// Meals Page
if($val_1 == "best_life_welcome" && $val_2 && $val_3 == 'meals')
{
	//is_login(); // if member not login will redirct to best_me/applications/9
	
	$data['meals_tips_types'] = $this->nestlefit->meals_tips_types();
	$this->load->view("mobile/best_me/fit_app/meals", $data);
}

// Water Page
if($val_1 == "best_life_welcome" && $val_2 && $val_3 == 'water')
{
	$data['tips'] = $this->nestlefit->nestle_fit_tips(6,$current_language_db_prefix);
	$this->load->view("mobile/best_me/fit_app/best_life_water", $data);
}

// Result Page
if($val_1 == "best_life_end_day" && $val_2)
{
	$this->load->view("mobile/best_me/fit_app/best_life_end_day", $data);
}

// Edit Page
if($val_1 == "best_life_data" && $val_2)
{
	$this->load->view("mobile/best_me/fit_app/best_life_data", $val_2);
}

// Notification Page
if($val_1 == "notification_messages" && $val_2 )
{
	$data['inner_gallery_flag'] = true;
	$this->load->view("mobile/best_me/fit_app/notification_messages" , $data);
}

// Top 10 Page
if($val_1 == "top_ten" )
{
	$data['winners'] = $this->nestlefit->top_ten();
	$this->load->view("mobile/best_me/fit_app/best_life_top_ten", $data);
}

?>