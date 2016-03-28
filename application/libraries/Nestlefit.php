<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Nestlefit 
{
	public $id;
	public $memberid;
	public $name;
	public $birthday;
	public $gender;
	public $current_weight;
	public $height;
	public $array_of_weights;
	

	public function __construct()
    {
		$CI =& get_instance();
		$this->CI =& get_instance();
		$this->CI->load->model('nestlefitmodel');
	    $this->CI->lang->load('bestcook');
		
        // Do something with $params	
	}
	/*Function init() to init the parameters and to setup the params */
	/* Warning : Function should be only called if member is logged in */
	public function init($id)
	{
		$display = $this->member_data($id);

		//Init Data
		$this->id = $display[0]['nestle_fit_health_ID'];
		$this->memberid = $display[0]['nestle_fit_health_weights_health_member_id'];
		$this->name = $display[0]['nestle_fit_health_name'];
		$this->birthday = $display[0]['nestle_fit_health_birthday'];
		$this->gender = $display[0]['nestle_fit_health_sex'];
		$this->current_weight = $display[0]['nestle_fit_health_weight'];
		$this->height = $display[0]['nestle_fit_health_height'];
	//Prepare array of History Weights
	}
	
	// This function to get recommended recipes
	public function get_recommended_recipes() {
		return $this->CI->nestlefitmodel->get_recommended_recipes();
	}
	
	
	public function calories_calculator()
	{
	 	return $this->CI->nestlefitmodel->get_food();
	}
	
	public function burn_rate()
	{
	 	return $this->CI->nestlefitmodel->get_sport();
	}
	
	public function member_data($id)
 	{
   		return $this->CI->nestlefitmodel->get_data_by_member_nestlefit_id($id);
 	}
	
	//this function is Updated by Bermawy 08-04-2015
	//the file that use this function is "best_life_second_step" & "best_life_data"
	public function get_weight($id)
	{
		$data = $this->CI->nestlefitmodel->get_best_life_data($id); 
		return $data[0]['nestle_fit_health_weight'];
	}
	//this function is Added by Bermawy 08-04-2015
	//the file that use this function is "best_life_second_step"
	public function get_ideal_weight($id)
	{
		$data = $this->CI->nestlefitmodel->get_best_life_data($id); 
		$weight = $data[0]['nestle_fit_health_weight'];
		$height = $data[0]['nestle_fit_health_height'];
		$gender = $data[0]['nestle_fit_health_sex'];
		if($gender == 'male')
		{
			$sex = 50;
		}
		else
		{
			$sex = 45.5;
		}
		$equation = ($height - 152.4) * 0.3937;
		$ibw = $equation * 2.3 + $sex; // Ibw stand for Estimated ideal body weight in (kg)
		return $ibw;
	}
	
	public function check_user_register($member_id)
	{
		$check = $this->CI->nestlefitmodel->check_best_life_register($member_id);
		if($check)
		{
			return $check;
		}else
		{
			return false;
		}
	}
	
	public function check_user_for_second_step($member_id)
	{
		$check = $this->CI->nestlefitmodel->check_user_second_step($member_id);
		if($check)
		{
			return $check;
		}else
		{
			return false;
		}
	}
	
	
/*	
	public function check_user_second_step($member_id)
	{
		$check = $this->CI->nestlefitmodel->check_best_life_second_step($member_id);
		if($check)
		{
			return $check;
		}
		else
		{
			return false;
		}
	}*/
	
	public function check_user_new_reg($member_id)
	{
		$check = $this->CI->nestlefitmodel->check_best_life_new_reg($member_id);
		if($check)
		{
			return $check;
		}
		else
		{
			return false;
		}
	}
	
	public function get_age_from_date_of_birth($date_of_birth)
	{
		//explode the date to get month, day and year
		$date_of_birth = explode("-", $date_of_birth);
	  	//get age from date or birthdate
	  	$age = (date("md", date("U", mktime(0, 0, 0, $date_of_birth[2], $date_of_birth[1], $date_of_birth[0]))) > date("md")
			? ((date("Y") - $date_of_birth[0]) - 1)
			: (date("Y") - $date_of_birth[0]));
	  	return $age;
		
	}
	
	public function calculate_calories($height, $weight, $age, $type, $mode,$nestle_fit_progress)
	{
		$calories = "";
		if($type == "male")
		{
			$calories = (10 * $weight)+(6.25 * $height)-(5 * $age)+5;
			$calories = round($calories * $mode, 0);
		}
		elseif($type == "female")
		{
			$calories = (10 * $weight)+(6.25 * $height)-(5 * $age)-161;
			$calories = round($calories * $mode, 0);
		}
		
		if($nestle_fit_progress==1)// lose weight
		{
			$last_calories=$calories;
		}
		elseif($nestle_fit_progress==2)// maintain weight
		{
			$last_calories=$calories+482;
		}
		else// gain weight
		{
		   $last_calories=$calories+967;	
		}
		return $last_calories;
	}
	/**
	@return array of user registeration data
	*/
	public function get_user_data($id)
	{
		return $this->CI->nestlefitmodel->get_user_data($id);
	}
	/**
	@return array of user next step calculation data
	*/
	public function get_user_calculations_data($id)
	{
		return $this->CI->nestlefitmodel->get_user_calculations_data($id);
	}
	/**
	@return array of user weights
	*/
	public function get_user_current_weight($id,$date)
	{
		return $this->CI->nestlefitmodel->get_user_current_weight($id,$date);
	}
	
	public function add_new_weight($id)
	{
		$date = date("Y-m-d");
		$check = $this->CI->nestlefitmodel->check_weight($id, $date);
		if($check == false){
			$this->CI->nestlefitmodel->add_weight_today($id);
		}else{
		}
	}
	
	public function get_meals($member_id,$date,$type)
	{
	 	return $this->CI->nestlefitmodel->get_meals_by_date($member_id,$date,$type);
	}
	
	public function get_user_current_calories($id,$selected_date)
	{
	 	return $this->CI->nestlefitmodel->get_user_current_calories($id,$selected_date);
	}
	
	public function get_total_calories_for_user_today($id)
	{
		$array = $this->CI->nestlefitmodel->get_user_current_calories($id);
		$total_calories = "";
		for($i=0; $i<sizeof($array); $i++):
		$total_calories += $array[$i]['nestle_fit_food_calories']; // * $array[$i]['nestle_fit_meals_amount'] if we will multiply the amount
		endfor;
			
	 	return $total_calories;
	}
	
	public function get_user_current_meals($id)
	{
	 	return $this->CI->nestlefitmodel->get_user_current_meals($id);
	}
	
	public function get_water($nestlefit_member_id,$date)
	{
	 	return $this->CI->nestlefitmodel->get_water_by_date($nestlefit_member_id,$date);
	}
	
	public function nestle_fit_tips_style()
	{
		$CI =& get_instance();
		$CI->load->view('best_me/fit_app/fancybox_style');
	}
	public function nestle_fit_tips($id,$current_language_db_prefix)
	{
	 	return $this->CI->nestlefitmodel->get_tips($id,$current_language_db_prefix);
	}
	
	/*Just for meals tips*/
	public function meals_tips_types()
	{
		return $this->CI->nestlefitmodel->get_meals_tips_types();
	}
	

	/*
	@Send a daily or weekly mail --Logic(to be decided)--
	*/
	public function send_mail()
	{
		
	}

	/*
	@Get user's current weight & weight history
	*/
	public function get_user_weight_history($id)
	{		
	 	return $this->CI->nestlefitmodel->get_user_weight_history($id);
	}
	
	public function top_ten()
	{
		return $this->CI->nestlefitmodel->get_user_winners();
	}
	
	public function nestlefit_options()
	{
		return $this->CI->nestlefitmodel->nestlefit_options();
	}
	
	public function get_nestle_fit_progress(){
			$CI =& get_instance();
			return $CI->nestlefitmodel->get_second_step_progress();
		}

	public function get_user_image($id)
	{
		$CI =& get_instance();
		$CI->load->model('membersmodel');
		$image = $CI->membersmodel->get_member_image($id);
		return $image;
	}
	
	


}

/* End of file Nestlefit.php */
