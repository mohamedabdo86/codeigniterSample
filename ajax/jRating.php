<?php
include("../administrator/modules/database.php");
include("../administrator/modules/globals_settings.php");
require_once("../administrator/nestle/pointssystem.php");

// Insert Rate into members_rate table
	
	$members_rate_foreign_id = $_POST['idBox'];
	$members_rate_type = $_POST['idType'];
	$members_rate_table = $_POST['idTable'];
	$members_rate_members_id = $_POST['idMember'];
	$members_rate_stars = $_POST['rate'];


	$check_member_rate_before = $db->querySelectSingle("select * from {$members_rate_table} where members_rate_foreign_id = {$members_rate_foreign_id} and members_rate_type = '{$members_rate_type}' and members_rate_members_id = {$members_rate_members_id}");

	if($check_member_rate_before)
	{
		/*Update rate of articles , videos , recipes */
		$old_rate = $check_member_rate_before['members_rate_stars'];
		
		$display_old_rate = $db->querySelectSingle("select * from {$members_rate_type} where {$members_rate_type}_ID={$members_rate_foreign_id}");
		
		$total = $display_old_rate['total_rate'] - $old_rate;
		
		$total_rate = $total + $members_rate_stars;
		
		$counter = $display_old_rate['counter_rate'];
		$sum_rate = $total_rate/$counter;
	
		$tobesaved1['total_rate'] = $total_rate;
		$tobesaved1['sum_rate'] = $sum_rate;
			
		$update = $db->update($members_rate_type,$tobesaved1,"{$members_rate_type}_ID={$members_rate_foreign_id}");
		
		/*Update rate of member*/
		$tobesaved['members_rate_stars'] = $members_rate_stars;
		
		$update_member = $db->update($members_rate_table,$tobesaved,'members_rate_ID = '.$check_member_rate_before['members_rate_ID']);
	
	}
	else
	{
		$tobesaved['members_rate_foreign_id'] = $members_rate_foreign_id;
		$tobesaved['members_rate_type'] = $members_rate_type;
		$tobesaved['members_rate_members_id'] = $members_rate_members_id;
		$tobesaved['members_rate_stars'] = $members_rate_stars;
	
		$insert = $db->insert($members_rate_table,$tobesaved);
		
		// Update rate for each table of articles , videos , recipes
		
		$points_handler = new Pointssystem();
		$points_handler->approve_action($members_rate_members_id , $points_handler->new_rate_points, "new_rate", $tobesaved['members_rate_foreign_id']);
	
		$display = $db->querySelectSingle("select * from {$members_rate_type} where {$members_rate_type}_ID={$members_rate_foreign_id}");
		$counter = $display['counter_rate'];
		$total = $display['total_rate'];
		
		$total_rate = $total + $members_rate_stars;
		$total_counter = $counter + 1 ;
		$sum_rate = $total_rate/$total_counter;
	
		$tobesaved1['counter_rate'] = $total_counter;
		$tobesaved1['total_rate'] = $total_rate;
		$tobesaved1['sum_rate'] = $sum_rate;
			
		$update = $db->update($members_rate_type,$tobesaved1,"{$members_rate_type}_ID={$members_rate_foreign_id}");


		
	}

?>
