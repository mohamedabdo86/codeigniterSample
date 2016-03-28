<?php
include("../modules/database.php");
include("../modules/globals_settings.php");
include("../modules/administrator.php");


if($_POST['recovery_submit']=="Submit")
{
	
	$id = $_POST['id'];
	$hash = $_POST['hash'];
	
	$password = $_POST['password'];
	$repeat_password = $_POST['repeat_password'];
	
	$display = $db->querySelectSingle("select * from  users where users_request_forget_password ='".$hash."' and users_ID = ".$id." ");
	
	if(empty($display) )
	die("<script>location.href='../login.php?status=recovererror'</script>");
	
	if($password != $repeat_password)
	die("<script>location.href='../login.php?status=recovererror'</script>");
	
	$encrypted_password = crypt(sha1(md5($db->escape($password))), 'st');
	
	$tobesaved['users_password'] = $encrypted_password;
	$tobesaved['users_orignal_password'] = $password;
	
	$tobesaved['users_request_forget_password'] = '';
	$db->update("users",$tobesaved," users_ID=".$id);
	die("<script>location.href='../login.php?status=recoversuccess'</script>");
	
	
}
die("<script>location.href='../login.php?status=recovererror'</script>");
?>