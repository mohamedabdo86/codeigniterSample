<?php
if(!$this->members->members_id)
{
	redirect(site_url('best_me/applications/9/homepage'), 'refresh');
}
$weight_data = '';

$get_calories = $this->nestlefit->get_user_current_calories($member_id);
$user_calories = "";
for($i=0; $i<sizeof($get_calories); $i++):
$user_calories += $get_calories[$i]['nestle_fit_food_calories'];
endfor;

	for($i=0; $i<sizeof($data); $i++):
	$current_date = $data[$i]['nestle_fit_health_weights_date'];
	$dt = new DateTime($current_date);
	$date = $dt->format('d/m/Y');
	$get_date = $dt->format('Y-m-d');
	$today = date('d/m/Y');
	$weight_id = $data[$i]['nestle_fit_health_weights_ID'];
	$current_weight = $data[$i]['nestle_fit_health_weights_weight'];
	$calories = $this->nestlefit->calculate_calories($current_height, $current_weight, $age, $type, $activity_mode);
	$sub_calories = $calories - $user_calories;

$weight_data .= '<div class="video_list_wrapper">';
$weight_data .= '<a class="recentitem_prev"><img class="" width="20" src="'.base_url().'images/bestme/nestle_fit_right.png" /></a>';
$weight_data .= '<a data-id="'.$weight_id.'" id="next" class="recentitem_next float_right"><img class="" width="20" src="'.base_url().'images/bestme/nestle_fit_left.png" /></a>';
$weight_data .= '<div id="video_list">';	 
$weight_data .= '<ul><li><div style="width:570px;height:400px;">';    
$weight_data .= '<p class="app_date">اليوم '.$date.'</p>';
$weight_data .= '<h1 class="app_header">'.$user_name.' مرحبا</h1>
            <h2 class="app_header">انت محتاج النهاردة '.$calories.' سعر حرارى</h2>
            <p class="app_calories">فاضلك '.$sub_calories.' سعر حرارى خلال اليوم علشان توصلى للوزن المثالى"</p>
            <a class="app_link" href="'.site_url('best_me/applications/9/best_life_end_day/'.$member_id.'').'"></a>
            <a class="app_link" href="'.site_url('best_me/applications/9/best_life_end_day/'.$member_id.'').'"></a>';
            if($date == $today){ 
            $weight_data .= '<a class="app_link" href="'.site_url('best_me/applications/9/best_life_welcome/'.$member_id.'/meals/').'"></a>';
        	}else{ 
            $weight_data .= '<a class="app_link" href="'.site_url('best_me/applications/9/best_life_welcome/'.$member_id.'/meals/'.$get_date).'"></a>';
            }            
            
           $weight_data .= '</div></li></ul></div></div>';
    endfor; 
	
$weight_data .= '</div>';
$weight_data .= '<a class="edit_mydata" href="'.site_url('best_me/applications/9/best_life_data/'.$member_id.'').'"></a>';

$array_of_result['display_data'] = $weight_data;

echo json_encode($array_of_result);

?>