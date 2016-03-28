<?php
include("../modules/database.php");
include("../modules/globals_settings.php");


//First , we select all the recipes 
$display = $db->querySelect("select * from articles ");

//Second , we delete the images 
for($i=0; $i < sizeof($display) ; $i++):



if($display[$i]['articles_image'] != NULL ) 
$db->query("delete from images where images_ID=".$display[$i]['articles_image']);

 

$db->query("delete from articles where articles_ID=".$display[$i]['articles_ID']);

endfor;



?>