<?php
include("../modules/database.php");
include("../modules/globals_settings.php");
include("../modules/administrator.php");

if($_POST['submit']=="Submit")
{

//	$validate_admin($_POST['loginName'],$_POST['passWord']);
	if(Administrator::session_login($_POST['email'],$_POST['password']))
	{
		die("<script>location.href='../index.php'</script>");
	}
	else
	{
		die("<script>location.href='../login.php?status=error'</script>");
	}
	
}
die("<script>location.href='../login.php?status=error'</script>");
?>