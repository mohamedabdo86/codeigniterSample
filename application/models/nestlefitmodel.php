<?php
class Nestlefitmodel extends CI_Model
{
	
	function __construct()
    {
        parent::__construct();
    }
	
 	public function get_data_by_member_nestlefit_id($id)
	{
		$this->db->select('*');
		$this->db->from('nestle_fit_health');
		$this->db->where('nestle_fit_health_ID',$id);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_data_by_member_id($id)
	{
		$this->db->select('*');
		$this->db->from('nestle_fit_health');
		$this->db->where('nestle_fit_health_member_ID',$id);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function nestlefit_emails_notifications($notifications)
	{
		$this->db->select('*');
		$this->db->from('nestle_fit_health');
		$this->db->where('nestle_fit_health_'.$notifications.'_notifications',"1");
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_food($id ="")
	{
		
		$this->db->select('*');
		$this->db->from('nestle_fit_food');
		if($id != "")
		{
			$this->db->where('nestle_fit_food_ID', $id);
		}
		else
		{
			$this->db->order_by('nestle_fit_food_ID','Asc');
		}

		$query = $this->db->get();
		return $query->result_array();

	}
	function get_sport()
	{
		$this->db->select('*');
		$this->db->from('nestle_fit_sport');
		$this->db->order_by('nestle_fit_sport_ID','Asc');
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function update_notifications()
	{
		$nestle_fit_health_ID = $this->input->post('nestle_fit_health_member_id');
		$member_mail = $this->input->post('nestle_fit_health_mail');
		$member_daily = $this->input->post('daily_notification');
		$member_weekly = $this->input->post('weekly_notification');
		
		$data = array(
		'nestle_fit_health_mail' => $member_mail,
		'nestle_fit_health_weekly_notifications' => $member_weekly,
		'nestle_fit_health_daily_notifications' => $member_daily,
		);
		$this->db->where('nestle_fit_health_ID',$nestle_fit_health_ID);
		$this->db->update('nestle_fit_health', $data);
		
		
	}
	
	public function best_life_register(){
   	 $weight = $this->input->post('best_life_weight');
   	 $member_id = $this->input->post('nestle_fit_health_member_id');
   	 $activity_mode = $this->input->post('best_life_activity');
   	 $date = $this->input->post('best_life_age');
   	 $data = array(
   	     'nestle_fit_health_member_ID' => $member_id,
   	     'nestle_fit_health_name' => $this->input->post('best_life_name'),
   		 'nestle_fit_health_birthday' => $date,
   		 'nestle_fit_health_sex' => $this->input->post('best_life_sex'),
   		 'nestle_fit_health_weight' => $weight,
   		 'nestle_fit_health_height' => $this->input->post('best_life_height'),
   		 'nestle_fit_health_activity' => $activity_mode,
		 'nestle_fit_health_date' => date("Y-m-d"),
		 'nestle_fit_health_mail'=>$this->input->post('nestle_fit_health_member_mail')
   	  );    
   	 $this->db->insert('nestle_fit_health', $data);
   	 $insert_id = $this->db->insert_id();
   	 
   	 $weight_data = array(
   		 'nestle_fit_health_weights_nestle_fit_health_ID' => $insert_id,
   		 'nestle_fit_health_weights_weight' => $weight,
   		 'nestle_fit_health_weights_date' => date("Y-m-d"),
   	 );
   	 $this->db->insert('nestle_fit_health_weights', $weight_data);
   	 
   	 if($insert_id){
   		 return $insert_id;
   	 }else{
   		 return false;
   	 }
    }
	
	public function update_health_calories($id,$calory){
		$data = array('nestle_fit_health_calories' => $calory);
		
		$this->db->where('nestle_fit_health_ID', $id);
		$this->db->update('nestle_fit_health', $data);

		
		return TRUE;
		
		}
	public function get_best_life_next_step($data){
		$insert = $this->db->insert('nestle_fit_calculations', $data);
   	 if($insert){
   		 return $data['nestle_fit_calculations_fit_health_ID'];
   	 }else{
   		 return false;
   	 }
	}
	
	public function check_best_life_register($member_id)
	{
		$this->db->select('*');
		$this->db->from('nestle_fit_health');
		$this->db->where('nestle_fit_health_member_ID',$member_id);
		$this->db->where('nestle_fit_health_new_reg',0);
		$this->db->where('nestle_fit_health_second_step',1);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			$row = $query->row(); 
			return $row->nestle_fit_health_ID;
		}else
		{
			return false;
		}
	}
	
	
	public function check_user_second_step($member_id)
	{
		$this->db->select('*');
		$this->db->from('nestle_fit_health');
		$this->db->where('nestle_fit_health_member_ID',$member_id);
		$this->db->where('nestle_fit_health_new_reg',0);
		$this->db->where('nestle_fit_health_second_step',0);
		$this->db->order_by('nestle_fit_health_ID','Desc');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			$row = $query->row(); 
			return $row->nestle_fit_health_ID;
		}else
		{
			return false;
		}
	}
	
	public function check_best_life_second_step($member_id){
		$this->db->select('*');
		$this->db->from('nestle_fit_health');
		$this->db->where('nestle_fit_health_ID = ' . $member_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			$row = $query->result_array(); 
			return $row[0]['nestle_fit_health_second_step'];
		}
		else
		{
			return false;
		}
	}
	
	/*
	* Check if the account is old and replaced by a new_reg
	*/
	public function best_life_set_second_step_flag($member_id, $new_flag)
	{
		$this->db->where('nestle_fit_health_ID = ' . $member_id);
		$this->db->update('nestle_fit_health', array('nestle_fit_health_second_step' => $new_flag));
	}
	
	/*
	* Check if the account is old and replaced by a new_reg
	*/
	public function check_best_life_new_reg($member_id){
		$this->db->select('*');
		$this->db->from('nestle_fit_health');
		$this->db->where('nestle_fit_health_ID = ' . $member_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			$row = $query->result_array(); 
			return $row[0]['nestle_fit_health_new_reg'];
		}
		else
		{
			return false;
		}
	}
	
	/*
	* set the new_reg column to 1. The account will be closed
	*/
	public function best_life_set_reg_flag($member_id, $new_flag){
		$this->db->where('nestle_fit_health_ID = ' . $member_id);
		$this->db->update('nestle_fit_health', array('nestle_fit_health_new_reg' => $new_flag));
	}
	
	/*
	* Do a new register
	*/
	public function best_life_new_register($member_id, $data)
	{
		$user_data = $this->get_user_data($member_id);
		
		var_dump($user_data);
		
		$data['nestle_fit_health_member_ID'] = $user_data[0]['nestle_fit_health_member_ID'];
		$data['nestle_fit_health_name'] = $user_data[0]['nestle_fit_health_name'];
		$data['nestle_fit_health_birthday'] = $user_data[0]['nestle_fit_health_birthday'];
		$data['nestle_fit_health_sex'] = $user_data[0]['nestle_fit_health_sex'];
		$data['nestle_fit_health_date'] = date('Y-m-d');   
		  
   		 $this->db->insert('nestle_fit_health', $data);
	   	 $insert_id = $this->db->insert_id();
	   	 
	   	 $weight_data = array(
	   		 'nestle_fit_health_weights_nestle_fit_health_ID' => $insert_id,
	   		 'nestle_fit_health_weights_weight' => $data['nestle_fit_health_weight'],
	   		 'nestle_fit_health_weights_date' => $user_data[0]['nestle_fit_health_date']
	   	 );
	   	 $this->db->insert('nestle_fit_health_weights', $weight_data);
	   	 
	   	 if($insert_id)
		 {
	   		 return $insert_id;
	   	 }
		 else
		 {
	   		 return false;
	   	 }
	}
	
	public function get_best_life_data($id){
		$this->db->select('*');
		$this->db->from('nestle_fit_health');
		$this->db->where('nestle_fit_health_ID',$id);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_activities_mode(){
		$this->db->select('*');
		$this->db->from('nestle_fit_health_activity_mode');
		
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_weight_histroy_array($id){
		$this->db->select('*');
		$this->db->from('nestle_fit_health_weights');
		$this->db->where('nestle_fit_health_weights_nestle_fit_health_ID',$id);
		$this->db->order_by('nestle_fit_health_weights_date','Desc');
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_user_data($id){
		$this->db->select('*');
		$this->db->from('nestle_fit_health');
		$this->db->where('nestle_fit_health_ID',$id);
		$this->db->join('nestle_fit_health_activity_mode', 'nestle_fit_health_activity_mode = nestle_fit_health_activity');
		$this->db->order_by('nestle_fit_health_ID', 'DESC');
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_user_calculations_data($id){
		$this->db->select('*');
		$this->db->from('nestle_fit_calculations');
		$this->db->where('nestle_fit_calculations_fit_health_ID',$id);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_user_current_weight($id,$date = null){
		$this->db->select('*');
		$this->db->from('nestle_fit_health_weights');
		$this->db->join('nestle_fit_health', 'nestle_fit_health_ID = nestle_fit_health_weights_nestle_fit_health_ID');
        $this->db->join('nestle_fit_calculations', 'nestle_fit_calculations_fit_health_ID = nestle_fit_health_weights_nestle_fit_health_ID');
		$this->db->where('nestle_fit_health_weights_nestle_fit_health_ID',$id);
		if(!is_null($date))
		{
			$this->db->like('nestle_fit_health_weights_date',$date);
		}
		$this->db->order_by('nestle_fit_health_weights_ID' ,'DESC');
		//$this->db->order_by('nestle_fit_health_weights_ID' ,'ASC');	
		$this->db->limit(1);	
		$query = $this->db->get();
		return $query->result_array();
	}
	
//////////////daily email function///////////////////////////////	
	
	public function get_nestle_fit_daily_mail()
	{
		$this->db->select('*');
		$this->db->from('nestle_fit_health');
		//$this->db->join('nestle_fit_water', 'nestle_fit_water_members_id = nestle_fit_health_ID');
		//$this->db->join('nestle_fit_meals', 'nestle_fit_meals_members_id = nestle_fit_health_ID');
		//$this->db->join('nestle_fit_food', 'nestle_fit_meals_members_id = nestle_fit_health_ID');
		$this->db->where('nestle_fit_health_daily_notifications',1);
		//$this->db->where('nestle_fit_health_daily_notifications',1);
	//	$this->db->group_by('nestle_fit_health_member_ID');
		$query = $this->db->get();
		return $query->result_array();
		
		}
		
		public function get_nestle_fit_daily_water($member_health_id){
			
				$this->db->select('*');
				$this->db->from('nestle_fit_water');
				$this->db->where('nestle_fit_water_members_id',$member_health_id);
				$this->db->where('nestle_fit_water_date',date('Y-m-d'));
				$this->db->order_by('nestle_fit_water_ID','DESC');
				$query = $this->db->get();
		        return $query->result_array();
					
			
			}
			
			
		public function get_nestle_fit_daily_meals($member_health_id){
			
			  $this->db->select('*');
			  $this->db->from('nestle_fit_meals');
			  $this->db->join('nestle_fit_food', 'nestle_fit_food_ID = nestle_fit_meals_meal');
			  $this->db->where('nestle_fit_meals_members_id',$member_health_id);
			  $this->db->where('nestle_fit_meals_date',date('Y-m-d'));
			  $this->db->order_by('nestle_fit_meals_ID','DESC');
			  $query = $this->db->get();
		      return $query->result_array();
					
			
			}	
/////////////////////////////end daily email functions///////////////////////////////

/////////////////////////////////get tips function/////////////////////////////////
  public function get_meals_tips_types()

   {
       $this->db->select('*');
       $this->db->from('nestle_fit_tips_types');
    	$this->db->order_by('nestle_fit_tips_types_ID', 'ASC');
       $this->db->limit(5);
    	$query = $this->db->get();
    	return $query->result_array();
 }
	
	 public function get_tips($id,$current_language_db_prefix)
	 {
	      $this->db->select('*');
	      $this->db->from('nestle_fit_tips');
		  $this->db->join('images', 'images_ID = nestle_fit_tips_image'.$current_language_db_prefix.'');
	      $this->db->where('nestle_fit_tips_type',$id);
		  $this->db->order_by('nestle_fit_tips_ID', 'RANDOM');
	      $this->db->limit(1);
		  $query = $this->db->get();
		  return $query->result_array();	
	
	}
			
	
	public function get_user_weight($id){
		$this->db->select('*');
		$this->db->from('nestle_fit_health_weights');
		$this->db->where('nestle_fit_health_weights_nestle_fit_health_ID',$id);
		$this->db->order_by('nestle_fit_health_weights_ID' ,'ASC');	
		$this->db->limit(1);
		
		$query = $this->db->get();
		$row = $query->row(); 
		return $row->nestle_fit_health_weights_weight;
	}
	
	
	public function add_new_weight($data,$data3,$nestle_fit_health_member_id){
		$insert = $this->db->insert('nestle_fit_health_weights', $data);
		if($insert){
			$this->db->where('nestle_fit_health_ID', $nestle_fit_health_member_id);
			$this->db->update('nestle_fit_health', $data3); 
			return true;
		}else{
			return false;
			
			}
		
		}
	public function edit_nestle_fit_weight($data){
		$insert = $this->db->insert('nestle_fit_health_weights', $data);
		if($insert){
			$update_data = array(
				'nestle_fit_health_weight' => $data['nestle_fit_health_weights_weight']
				);
			$this->db->where('nestle_fit_health_ID', $data['nestle_fit_health_weights_nestle_fit_health_ID']);
			$this->db->update('nestle_fit_health', $update_data); 
		}else{
		}
	}
	
	public function add_meals($form_data)
	{
		$this->db->insert('nestle_fit_meals', $form_data);
		
			return TRUE;
	}
	
	public function get_nestle_fit_meals(){
		$this->db->select('*');
		$this->db->from('nestle_fit_meals');
		$this->db->join('nestle_fit_health', 'nestle_fit_health_ID = nestle_fit_meals_members_id');
		$this->db->where('nestle_fit_meals_date',date('Y-m-d'));
	//	$this->db->group_by("nestle_fit_meals_type");
		$this->db->order_by('nestle_fit_meals_ID','DESC');
		//$this->db->where('nestle_fit_meals_date',"{$date}");
		//$this->db->where('nestle_fit_meals_type',$type);
        
		$query = $this->db->get();
		return $query->result_array();
		
		
	}
	
	public function get_recommended_recipes() {
		$this->db->select('*');
		$this->db->from('recipes');
		$this->db->where('flag', 0);
				 
		$query = $this->db->get();
		return $query->result_array();		 
	}
	
	public function get_meals_by_date($member_id,$date,$type)
    {
		$this->db->select('*');
		$this->db->from('nestle_fit_meals');
		//$this->db->join('nestle_fit_food', 'nestle_fit_food_ID = nestle_fit_meals_meal');
		$this->db->join('recipes' , 'recipes_ID = nestle_fit_meals_meal');
		$this->db->join('nestle_fit_measurments', 'recipes_measure_id = nestle_fit_measurments_ID');
		$this->db->where('nestle_fit_meals_members_id',$member_id);
		$this->db->where('nestle_fit_meals_date', $date);
		$this->db->where('nestle_fit_meals_type', $type);
		
		
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	public function get_meals($member_id,$date,$type)
    {
		$this->db->select('*');
		$this->db->from('nestle_fit_meals');
		$this->db->where('nestle_fit_meals_members_id',$member_id);
		$this->db->where('nestle_fit_meals_date',"{$date}");
		$this->db->where('nestle_fit_meals_type',$type);
		//$this->db->where('tname', $tname);
		
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	public function delete_meals($member_id,$date,$type)
	{
		
	 	$this->db->where('nestle_fit_meals_members_id',$member_id);
		$this->db->where('nestle_fit_meals_date',"{$date}");
		$this->db->where('nestle_fit_meals_type',$type);
		$this->db->delete('nestle_fit_meals');
	}
	
	public function check_weight($id, $date){
		$this->db->select('nestle_fit_health_weights_date');
		$this->db->from('nestle_fit_health_weights');
		$this->db->where('nestle_fit_health_weights_nestle_fit_health_ID',$id);
		$this->db->order_by('nestle_fit_health_weights_ID' ,'DESC');	
		$this->db->limit(1);
		$query = $this->db->get();
		$row = $query->row(); 
		$current_date = $row->nestle_fit_health_weights_date;
		$dt = new DateTime($current_date);
		$get_date = $dt->format('Y-m-d');
		
		if($get_date == $date){
			return true;
		}else{
			return false;
		}
	}
	
	public function add_weight_today($id){
		$date = date("Y-m-d");
		$weight = $this->get_user_current_weight($id);
		$current_weight = $weight[0]['nestle_fit_health_weights_weight'];
		$this->db->select('nestle_fit_health_weights_date');
		$this->db->from('nestle_fit_health_weights');
		$this->db->where('nestle_fit_health_weights_nestle_fit_health_ID',$id);
		$this->db->order_by('nestle_fit_health_weights_ID' ,'DESC');	
		$this->db->limit(1);
		$query = $this->db->get();
		$row = $query->row(); 
		$current_date = $row->nestle_fit_health_weights_date;
		$dt = new DateTime($current_date);
		$get_date = $dt->format('Y-m-d');
		
		$daylen = 60*60*24;
   		$days = (strtotime($date)-strtotime($get_date))/$daylen;
		for($i=$days -1; $i>=0; $i--):
		$mod_date = strtotime($date."- {$i} days");
		$data = array(
		'nestle_fit_health_weights_nestle_fit_health_ID' => $id,
		'nestle_fit_health_weights_weight' => $current_weight,
		'nestle_fit_health_weights_date' => date("Y-m-d h:i:s A",$mod_date)
		);
		$this->db->insert('nestle_fit_health_weights', $data);
		endfor;
	}
	
	/*function search_food($keyword)
	{
		
		$this->db->select('*');
		$this->db->from('nestle_fit_food');
		$this->db->like('nestle_fit_food_title', $keyword); 
		$this->db->like('nestle_fit_food_title_ar', $keyword); 
		$this->db->order_by('nestle_fit_food_ID','Asc');
		
		

		$query = $this->db->get();
		//$total_numbers_of_rows = $query->num_rows();
		//$get_last_generated_query = $this->db->last_query();
		
		foreach($query->result_array() as $row) 
		{
			$json = array();
			$json['value'] = $row['nestle_fit_food_ID'];
			$json['name'] = $row['nestle_fit_food_title'];
			$json['calories'] = $row['nestle_fit_food_calories'];
			
			$data[] = $json;
			//$result = array ("geonames" => $data); //"totalResultsCount" =>$display ,
		}
			
		return $data;

	}*/
	
	function search_food($keyword)
	{
		/*$this->db->query('SELECT 
						   nestle_fit_food.nestle_fit_food_ID as id, 
						   nestle_fit_food.nestle_fit_food_title as title, 
						   nestle_fit_food.nestle_fit_food_calories as calories,
						   nestle_fit_measurments.nestle_fit_measurments_title AS measure,
						   "nestle_fit_food" as tname
						   FROM nestle_fit_food 
						   join nestle_fit_measurments on nestle_fit_food.nestle_fit_food_measure_id=nestle_fit_measurments.nestle_fit_measurments_ID
						   WHERE nestle_fit_food_title LIKE "%'.$keyword.'%"
						   UNION ALL SELECT 
						   nestle_fit_food.nestle_fit_food_ID as id, 
						   nestle_fit_food.nestle_fit_food_title_ar as title, 
						   nestle_fit_food.nestle_fit_food_calories as calories,
						   nestle_fit_measurments.nestle_fit_measurments_title_ar AS measure,
						   "nestle_fit_food" as tname
						   FROM nestle_fit_food 
						   join nestle_fit_measurments on nestle_fit_food.nestle_fit_food_measure_id=nestle_fit_measurments.nestle_fit_measurments_ID
						   WHERE nestle_fit_food_title_ar LIKE "%'.$keyword.'%"');*/
		
		$query = $this->db->query('SELECT
						   recipes.recipes_ID as id,
						   recipes.recipes_title as title,
						   recipes.recipes_calories as calories,
						   nestle_fit_measurments.nestle_fit_measurments_title AS measure
						   FROM recipes
						   join nestle_fit_measurments on recipes.recipes_measure_id=nestle_fit_measurments.nestle_fit_measurments_ID
						   WHERE recipes_title LIKE "%'.$keyword.'%"
						   UNION ALL SELECT
						   recipes.recipes_ID as id,
						   recipes.recipes_title_ar as title,
						   recipes.recipes_calories as calories,
						   nestle_fit_measurments.nestle_fit_measurments_title_ar AS measure
						   FROM recipes
						   join nestle_fit_measurments on recipes.recipes_measure_id=nestle_fit_measurments.nestle_fit_measurments_ID
						   WHERE recipes_title_ar LIKE "%'.$keyword.'%"')->result_array();
								   
		//$result = array_merge($query1, $query2);
		//$query = $this->db->get();		   
		
		foreach($query as $row) 
		{
			$json = array();
			$json['value'] = $row['id'];
			$json['name'] = $row['title'];
			$json['calories'] = $row['calories'];
			$json['measure'] = $row['measure'];
			
			$data[] = $json;
		}
			
		return $data;

	}
	
	public function get_user_current_calories($id,$date = null){
		//$date = date("Y-m-d");
		$this->db->select('*');
		$this->db->from('nestle_fit_meals');
		$this->db->join('nestle_fit_meals_types', 'nestle_fit_meals_types_id = nestle_fit_meals_type');
		//$this->db->join('nestle_fit_food', 'nestle_fit_food_ID = nestle_fit_meals_meal');
		$this->db->join('recipes' , 'recipes_ID = nestle_fit_meals_meal');
		if(!is_null($date))
		{
			$this->db->where('nestle_fit_meals_date',$date);
		}
		$this->db->where('nestle_fit_meals_members_id',$id);
		//$this->db->where('nestle_fit_meals_date',"{$date}");
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_user_current_meals($id){
		$date = date("Y-m-d");
		$this->db->select('*');
		$this->db->from('nestle_fit_meals');
		$this->db->join('nestle_fit_meals_types', 'nestle_fit_meals_types_id = nestle_fit_meals_type');
		$this->db->join('nestle_fit_food', 'nestle_fit_food_ID = nestle_fit_meals_meal');
		$this->db->where('nestle_fit_meals_members_id',$id);
		$this->db->where('nestle_fit_meals_date',"{$date}");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_weight_data($member_id ,$weight_id){
		$this->db->select('*');
		$this->db->from('nestle_fit_health_weights');
		$this->db->where('nestle_fit_health_weights_nestle_fit_health_ID',$member_id);	
		$this->db->where('nestle_fit_health_weights_ID <',$weight_id);	
		$this->db->order_by('nestle_fit_health_weights_ID' ,'DESC');	
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	public function find_member_water($member_id,$date)
	{
		$this->db->select('*');
		$this->db->from('nestle_fit_water');
		$this->db->where('nestle_fit_water_members_id',$member_id);	
		$this->db->where('nestle_fit_water_date',$date);	
	
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function add_members_water($data)
	{
		$this->db->insert('nestle_fit_water', $data);
	}
	
	public function update_members_water($member_id,$date,$action)
	{
		$this->db->where('nestle_fit_water_members_id', $member_id);
		$this->db->where('nestle_fit_water_date', $date);
		$this->db->set('nestle_fit_water_count', 'nestle_fit_water_count'.$action.'1', FALSE);
		$this->db->update('nestle_fit_water');
	}
	
	public function get_water_by_date($member_id,$date)
    {
		$this->db->select('*');
		$this->db->from('nestle_fit_water');
		$this->db->where('nestle_fit_water_members_id',$member_id);
		$this->db->where('nestle_fit_water_date', $date);
		
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	public function get_second_step_progress(){
		
		$this->db->select('*');
		$this->db->from('nestle_fit_progress');
	
		$query = $this->db->get();

		return $query->result_array();
		}
		
	
		public function get_user_winners()
		{
			$this->db->select('SUM(points.points_number) AS points_count, nestle_fit_health.nestle_fit_health_name');
			$this->db->from('nestle_fit_health');
			//$this->db->where('nestle_fit_health.nestle_fit_health_ID = points.points_user_id');
			$this->db->where("points.points_type LIKE 'nestle_fit%'");
			$this->db->group_by("points.points_user_id"); 
			$this->db->order_by("points_count", "DESC"); 
			$this->db->join('points','nestle_fit_health.nestle_fit_health_member_ID = points.points_user_id', 'left');
			//$this->db->join('nestle_fit_health_activity_mode', 'nestle_fit_health_activity_mode = nestle_fit_health_activity');
			$this->db->limit(10);
			$query = $this->db->get();
			return $query->result_array();
	}
	
	
	
	public function nestlefit_options()
		{
			$this->db->select('*');
			$this->db->from('nestle_fit_option');
			$this->db->order_by("nestle_fit_option_ID", "DESC"); 
			$query = $this->db->get();
			return $query->result_array();
	}
}

?>