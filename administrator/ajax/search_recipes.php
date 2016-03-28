<?php
include("../modules/database.php");
include("../modules/globals_settings.php");

$input = $_GET["term"];

// query your DataBase here looking for a match to $input
$query = $db->querySelect("SELECT * from recipes where recipes_title_ar LIKE '%".$input."%' and Active=-1 ");
$display = $db->numRows("SELECT * from recipes where recipes_title_ar LIKE '%".$input."%' and Active=-1 ");

//empty array to save the result in
$json = array();

foreach($query as $row) 
{
	$json['value'] = $row['recipes_ID'];
	$json['name'] = $row['recipes_title_ar'];
	$data[] = $json;

}
	$result = array ("totalResultsCount" =>$display ,"geonames" => $data);
	
//print_r($result)
echo json_encode($result);


	
?>
