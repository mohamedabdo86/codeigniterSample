<?php
//print_r($nestle_fit_meals); 
for($i=0;$i<sizeof($nestle_fit_meals);$i++)
{
	
	//echo $nestle_fit_meals[$i]['nestle_fit_health_member_ID']."<br/>";
	if($nestle_fit_meals[$i]['nestle_fit_meals_type']==1){
		$this->membersmodel->add_user_points( $nestle_fit_meals[$i]['nestle_fit_health_member_ID'],'nestle_fit_meal');
		
		
		}
		
		if($nestle_fit_meals[$i]['nestle_fit_meals_type']==2){
		$this->membersmodel->add_user_points( $nestle_fit_meals[$i]['nestle_fit_health_member_ID'],'nestle_fit_meal');
		
		
		}
		
		if($nestle_fit_meals[$i]['nestle_fit_meals_type']==3){
		$this->membersmodel->add_user_points( $nestle_fit_meals[$i]['nestle_fit_health_member_ID'],'nestle_fit_meal');
		
		
		}
		
		if($nestle_fit_meals[$i]['nestle_fit_meals_type']==4){
		$this->membersmodel->add_user_points( $nestle_fit_meals[$i]['nestle_fit_health_member_ID'],'nestle_fit_meal');
		
		
		}
		
		if($nestle_fit_meals[$i]['nestle_fit_meals_type']==5){
		$this->membersmodel->add_user_points( $nestle_fit_meals[$i]['nestle_fit_health_member_ID'],'nestle_fit_meal');
		
		
		}
	
	}


?> 