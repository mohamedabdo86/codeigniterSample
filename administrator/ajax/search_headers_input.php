<?php
require_once("../modules/database.php");

$value = $_POST['search_value'];
$this_table_name = $_POST['this_tablename'];
$search_headers_attr = $_POST['search_headers_attr'];
$search_select_attr = $_POST['search_select_attr'];



$query = "";
$search_headers_attr_array = explode(";",$search_headers_attr); 

$search_select_attr_array = explode(";",$search_select_attr); 


$query.= "select ".$search_select_attr_array[0]." as 'id' , ".$search_select_attr_array[1]." as 'value' from {$this_table_name}
where 1 ";

for($i=0;$i<sizeof($search_headers_attr_array);$i++):
$query.= "and ".$search_headers_attr_array[$i]." Like '%".$value."%' ";
endfor;

$display = $db->querySelect($query);
//$json_final = array();
//$json_final['query']  =  $display;
//echo $query;
echo json_encode($display);