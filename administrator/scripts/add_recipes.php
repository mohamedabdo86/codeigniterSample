<?php
include("../modules/database.php");
include("../modules/globals_settings.php");

//$id = $_GET['id'];


$url = '192.185.151.73/~devarea/nestle/administrator/scripts/add_recipes.php?id=10';

//$display = $db->querySelect("select * from recipes where recipes_cookingtime < 45 ");
//$display = $db->querySelect("select * from recipes where recipes_dish_id = 6 ");
/*$display = $db->querySelect("select * from recipes where recipes_calories < 299 ");
for($i=0;$i<sizeof($display);$i++)
{
	$tobesaved['inseason_recipies_w_recipies_inseason_recipies_ID'] = $id;
	$tobesaved['inseason_recipies_w_recipies_recipes_ID'] =$display[$i]['recipes_ID'];

	$state = $db->insert("inseason_recipies_w_recipies" , $tobesaved);
	
	//update table id
	unset($tobesaved);

}*/

//this array for Special Occasions recipes
/*$display = array(554,495,532,333,533,766,535,335,336,920,337,1016,987,429,923,944,431,433,434,924,338,926,340,903,797,930,343,965,1029,945,350,872,546,802,803,547,548,549,354,804,846,807,552,369,939,370,371,330,372,373,579,937,798,376,979,378,
934,936,799,932,748,555,874,1039,793,980,383,902,385,386,558,900,387,388,983,560,899,393,824,808,898,398,394,564,568,998,402,569,570,403,571,1017,757,865,576,492,985,410,411,875,885,959,417,886,887,413,999,414,888,960,897,995,420,421,1011,582,
583,422,584,367,1034,424,1025,437,1020,895,896,906,809,438,440,444,445,447,981,454,1040,889,950,452,455,721,890,600,329,456,971,476,457,1012,463,972,973,966,474,1013,1001,475,907,477,986,481,607,483,908,1021,822,1022,488,611,840,785,490,615,493,
491,441,842,580,730,500,975,910,1046,1026,618,811,954,742,892,624,1042,355,516,514,843,515,882,630,331,518,838,520,633,740,863,978,636,761,915,523,524,637,638,525,639,763,839,526,974,527,1031,528,751,942,);
*/


$id = 27;
//this array for Special Occasions recipes
$display = array(1040,615);


for($i=0;$i<sizeof($display);$i++)
{
	$tobesaved['inseason_recipies_w_recipies_inseason_recipies_ID'] = $id;
	$tobesaved['inseason_recipies_w_recipies_recipes_ID'] =$display[$i];

	$state = $db->insert("inseason_recipies_w_recipies" , $tobesaved);
	
	//update table id
	unset($tobesaved);
}



?>