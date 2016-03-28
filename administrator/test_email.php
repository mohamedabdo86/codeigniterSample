<?php

$email = $_GET['email'];

 include("header.php");

$comment_data = $db->querySelectSingle("SELECT * FROM  members WHERE members_email LIKE '%{$email}%' ");
echo '<pre>';
print_r($comment_data);
echo '</pre>';
?>