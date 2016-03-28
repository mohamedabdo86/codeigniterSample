<?php
require_once("../modules/database.php");

$id = $_POST['id'];
$this_table_name = $_POST['this_table_name'];
$column_required_to_toggle = $_POST['column_required_to_toggle'];

//update new row of $column_required_to_toggle if value = 0 make it 1 & vice versa
$db->query("update {$this_table_name} set {$column_required_to_toggle} = NOT {$column_required_to_toggle} where {$this_table_name}_ID = $id");

//get query after finishing
$display = $db->querySelectSingle("select * from {$this_table_name} where {$this_table_name}_ID = $id  ");
 

$array_of_results['returned_array'] = $display[$column_required_to_toggle];
$array_of_results['response'] = true;

echo json_encode($array_of_results);