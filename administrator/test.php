<?php

include("header.php");

$query2 = "SELECT * FROM  recipes WHERE recipes_nutrition_facts_image_ar = 2246";


$comment_data = $db->querySelectSingle($query2);
print_r($comment_data);


?>