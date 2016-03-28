<?php
include("../modules/database.php");
include("../modules/globals_settings.php");
// Use this link 
// 3alkanaba.com/administrator/scripts/fix_images_problem.php?table_name=&table_id=&table_picture=
//example
//3alkanaba.com/administrator/scripts/fix_images_problem.php?table_name=big_advertise&table_id=big_advertise_ID&table_picture=big_advertise_images

$table_name = $_GET['table_name'];
$table_id = $_GET['table_id'];
$table_picture = $_GET['table_picture'];

$query = "select * from {$table_name} where {$table_picture}<>''";
$display = $db->querySelect($query);
for($i=0;$i<sizeof($display);$i++)
{
	//get image src
	$image_src = $display[$i][$table_picture];
	
	//create new image at images table
	unset($tobesaved);
	$tobesaved['images_src'] =$image_src;
	$tobesaved['images_date'] =time();
	$state = $db->insert("images" , $tobesaved);
	
	//update table id
	unset($tobesaved);
	$tobesaved[$table_picture] = $state;
	$db->update($table_name , $tobesaved , " {$table_id} = ".$display[$i][$table_id] );
}



?>