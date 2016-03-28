<?php
include '../administrator/modules/database.php';
include 'send_contactmail_form.php';

$tobesaved['messages_name'] = $_POST['name'];
$tobesaved['messages_email'] = $_POST['email'];
$tobesaved['messages_telephone'] = $_POST['telephone'];
$tobesaved['messages_text'] = $_POST['message'];
$tobesaved['messages_date'] =date('Y-m-d');

$db->insert("messages",$tobesaved);




if($status_email) echo 'Email is sent, thank you for your time.';
else echo 'An error occurred, please try again later';
?>

