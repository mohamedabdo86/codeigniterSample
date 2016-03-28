<?php
require_once("../modules/database.php");

$id = $_POST['id'];
$this_table_name = $_POST['this_table_name'];
$images_dir = $_POST['images_dir'];
$column_required_to_toggle = $_POST['column_required_to_toggle'];

 
$section_id_active = $db->querySelectSingle("select * from {$this_table_name} where {$this_table_name}_ID = $id");
$result = $section_id_active['videos_section_id'];

$id_active = $db->querySelectSingle("select {$this_table_name}_ID from {$this_table_name} where {$this_table_name}_featured = '1' and {$this_table_name}_section_id = $result");
//set best cook multi feature video but else one video is feature
//$result == 2 this is Best Cook
if($result == 2)
{
   $db->query("update {$this_table_name} set {$column_required_to_toggle} = NOT  {$column_required_to_toggle} where {$this_table_name}_ID = $id");
}else
{
	//videos_featured == 0
	$db->query("update {$this_table_name} set {$this_table_name}_featured = '0' where {$this_table_name}_section_id = $result");
	
	$db->query("update {$this_table_name} set {$column_required_to_toggle} = NOT  {$column_required_to_toggle} where {$this_table_name}_ID = $id");	
}

$display = $db->querySelectSingle("select * from {$this_table_name} where {$this_table_name}_ID = $id  ");
 
$array_of_results['last_id'] = $id_active[$this_table_name."_ID"];

$array_of_results['returned_array'] = $display[$column_required_to_toggle];
$array_of_results['response'] = true;


echo json_encode($array_of_results);