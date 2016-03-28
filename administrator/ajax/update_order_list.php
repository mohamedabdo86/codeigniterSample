<?php
include("../modules/database.php");

$order_column = $_POST['order_column'];
$table_name = $_POST['table_name'];
$id_column = $_POST['id_column'];

 
$tobesaved[$order_column]  = $_POST['index'];
$db->update($table_name , $tobesaved , " {$id_column}=".$_POST['id']);
?>

