<?php
require_once("../modules/database.php");

$current_value  = $_POST['current_value'];
$this_table_name  = $_POST['this_table_name'];
$table_column_id  = $_POST['table_column_id'];
$table_column_title  = $_POST['table_column_title'];
$this_table_forignkey  = $_POST['this_table_forignkey'];

$display_new_options = "select {$table_column_id} as id,{$table_column_title} as value from {$this_table_name}  where {$this_table_forignkey} ={$current_value} order by {$table_column_title} ";
if($current_value != "")
$display = $db->querySelect("select {$table_column_id} as id,{$table_column_title} as value from {$this_table_name}  where {$this_table_forignkey} ={$current_value} order by {$table_column_title} ");

$display_new_options ='<option value="">Select ...</option>';

foreach($display as $inner_key => $options_array)
{
	$display_new_options .='<option value="'.$options_array['id'].'">'.$options_array['value'].'</option>';
}

$array_of_results = array();
 
$array_of_results['response'] = true;
$array_of_results['data'] = $display_new_options;



echo json_encode($array_of_results);