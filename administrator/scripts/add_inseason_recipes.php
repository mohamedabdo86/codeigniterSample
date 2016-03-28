<?php

include("../modules/database.php");


$type_of_recipe_id = 1;
$ramadan_string = "533,535,335,336,920,429,923,431,343,945,872,546,548,354,846,807,552,373,376,748,874,1039,902,385,386,558,900,388,393,898,398,998,402,569,570,571,1017,492,411,875,885,413,999,414,995,582,583,422,584,424,1025,437,1020,896,895,906,445,454,950,452,600,1001,475,907,477,483,908,1021,611,615,580,730,500,910,1046,1026,514,331,838,524,637,839,526,527,1031,528,751,942";
$array_of_ramadan = explode("," , $ramadan_string);

for($i=0 ; $i < sizeof($array_of_ramadan) ; $i++):
unset($tobesaved);
$tobesaved['inseason_recipies_w_recipies_recipes_ID'] = $array_of_ramadan[$i];
$tobesaved['inseason_recipies_w_recipies_inseason_recipies_ID'] = $type_of_recipe_id;
$db->insert("inseason_recipies_w_recipies" , $tobesaved);
endfor;

?>
