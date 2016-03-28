<?php
include("../modules/database.php");
include("../modules/globals_settings.php");
// Use this link 
// 3alkanaba.com/administrator/scripts/fix_images_problem.php?table_name=&table_id=&table_picture=
//example
//3alkanaba.com/administrator/scripts/fix_images_problem.php?table_name=big_advertise&table_id=big_advertise_ID&table_picture=big_advertise_images


//$query = 
//$display = $db->querySelect($query);
$display = $db->querySelect("select * from t_menu inner join products_brand on products_brand_ID = ID");
for($i=0;$i<sizeof($display);$i++)
{

	$tobesaved['products_brand_name'] = $display[$i]['MenuItemNameEN'];
	$tobesaved['products_brand_name_ar'] =$display[$i]['MenuItemNameAR'];

	$state = $db->update("products_brand" , $tobesaved, 'products_brand_ID = '.$display[$i]['products_brand_ID']);
	
	//update table id
	unset($tobesaved);

}



?>