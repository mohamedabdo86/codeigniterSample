<?php
require_once("../modules/database.php");

$id = $_POST['id'];
$images_array = unserialize($_POST['images_array']);
$this_table_name = $_POST['this_table_name'];
$images_dir = $_POST['images_dir'];

$get_extra_query =  $_POST['extra_queries'];

//activate extra query
if($get_extra_query != "")
$db->query($get_extra_query);


//get selected row to delete
$get_data_before_delete = $db->querySelectSingle("select * from {$this_table_name} where {$this_table_name}_ID={$id} ");




for($i=0;$i<sizeof($images_array);$i++):
	//get file source
	if($get_data_before_delete[$images_array[$i]] != ""){
		$get_photo_src = $db->querySelectSingle("select * from images where images_ID=".$get_data_before_delete[$images_array[$i]]);
	
	
		$source_url = "../../".$images_dir."/".$get_photo_src['images_src'];
		$thumb_url = "../../".$images_dir."/thumb_".$get_photo_src['images_src'];
		
		if(file_exists($source_url)) {
			unlink($source_url);
		}
		if(file_exists($thumb_url)) {
			unlink($thumb_url);
		}
		$db->query("delete from images where images_ID=".$get_photo_src['images_ID']);	
		}
	
endfor;

//Delete the record

$db->query("delete from {$this_table_name} where {$this_table_name}_ID=".$id);

 


 
$array_of_results['response'] = true;

echo json_encode($array_of_results);