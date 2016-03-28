<?php
include("../modules/database.php");
include("../modules/globals_settings.php");
// Use this link 
// 3alkanaba.com/administrator/scripts/fix_images_problem.php?table_name=&table_id=&table_picture=
//example
//3alkanaba.com/administrator/scripts/fix_images_problem.php?table_name=big_advertise&table_id=big_advertise_ID&table_picture=big_advertise_images


//$query = 
//$display = $db->querySelect($query);
$display = $db->querySelect("select * from t_users inner join yaf_user on yaf_user.UserID = t_users.ID ");
for($i=0;$i<sizeof($display);$i++)
{
	

	$tobesaved['members_ID'] = $display[$i]['ID'];
	$tobesaved['members_first_name'] =$display[$i]['FirstName'];
	$tobesaved['members_last_name'] =$display[$i]['LastName'];
	$tobesaved['members_birthdate'] =$display[$i]['BirthDate'];
	$tobesaved['members_email'] =$display[$i]['Email'];
	$tobesaved['members_old_password'] =$display[$i]['ProviderUserKey'];
	$tobesaved['members_mobile'] =$display[$i]['MobileNumber'];
	$tobesaved['members_addeddate'] =$display[$i]['Joined'];
	$tobesaved['members_children'] =$display[$i]['Children'];
	$tobesaved['members_images'] =$display[$i]['AvatarID'];
	$tobesaved['members_newsletter'] =$display[$i]['Newsletter'];
	$tobesaved['members_interested'] =$display[$i]['Interested'];
	$tobesaved['members_points'] =$display[$i]['Points'];
	$tobesaved['members_nickname'] = $display[$i]['DisplayName'];

	$state = $db->insert("members_new_test" , $tobesaved);
	
	//update table id
	unset($tobesaved);

}



?>