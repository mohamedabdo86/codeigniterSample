<?php
require_once("../modules/database.php");

$aid = $_POST['aid'];
$type = $_POST['type'];

if($type == "sub_section" )
{
	//Get sub_section Lists
	$display_section = $db->querySelect("select * from sub_sections where sub_sections_parent = {$aid} order by sub_sections_name");
	

	
	$sections_list = '<option value="">Choose Sub Section</option>';
	for($i=0;$i<sizeof($display_section);$i++)
	{
		$sections_list.='<option value="'.$display_section[$i]['sub_sections_ID'].'">'.$display_section[$i]['sub_sections_name'].'</option>';

		$display_parent = $db->querySelect("Select * from sub_sections where sub_sections_parent = ".$display_section[$i]['sub_sections_ID']);
		foreach($display_parent as $parent)
		{
			$sections_list.='<option value="'.$parent['sub_sections_ID'].'"> '.$display_section[$i]['sub_sections_name'].' => '.$parent['sub_sections_name'].'</option>';
		}
	}
	$array_of_results['sections_list'] =$sections_list;
}


echo json_encode($array_of_results);

?>