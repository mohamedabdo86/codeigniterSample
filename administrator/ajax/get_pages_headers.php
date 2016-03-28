<?php
require_once("../modules/database.php");
require_once("../modules/notifications_messages.php");

$id = (int) $_POST['id'];
$array_tobesaved = $_POST['prepare_array'];
$expected_action = $_POST['expected_action'];

if($expected_action == "Edit")
$db->query("delete from pages_header where pages_header_pages_ID={$id} ");


for($i=0;$i<sizeof($array_tobesaved);$i++):
$tobesaved['pages_header_pages_ID'] = $id;
$tobesaved['pages_header_pages_attr_value_ID'] = $array_tobesaved[$i][0];
$tobesaved['pages_header_order'] = $array_tobesaved[$i][1];
$db->insert("pages_header",$tobesaved);
endfor;


?>