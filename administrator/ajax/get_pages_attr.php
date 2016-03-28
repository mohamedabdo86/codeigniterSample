<?php
require_once("../modules/database.php");
require_once("../modules/notifications_messages.php");

$id = (int) $_POST['id'];
$array_tobesaved = $_POST['prepare_array'];
$expected_action = $_POST['expected_action'];

if($expected_action == "Edit")
$db->query("delete from pages_attr where pages_attr_pages_ID={$id} ");


for($i=0;$i<sizeof($array_tobesaved);$i++):
$tobesaved['pages_attr_pages_ID'] = $id;
$tobesaved['pages_attr_title'] = $array_tobesaved[$i][0];
$tobesaved['pages_attr_req'] = $array_tobesaved[$i][1]=="true" ? 1 : 0;
$tobesaved['pages_attr_limitations'] = $array_tobesaved[$i][2];
$tobesaved['pages_attr_type'] = $array_tobesaved[$i][3];
$tobesaved['pages_attr_value_ID'] = $array_tobesaved[$i][4];
$tobesaved['pages_attr_order'] = $array_tobesaved[$i][5];
$db->insert("pages_attr",$tobesaved);
endfor;


?>