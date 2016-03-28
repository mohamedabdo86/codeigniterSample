<?php
//echo $PHP_SELF;

if(isset($_REQUEST['logout']))
{
	Administrator::logout();
}

if( !isset($_SESSION['current_backend_user_id']) )
{
	die("<script>location.href='login.php'</script>"); 
}

if( !isset($_SESSION['IP_address']) )
{
	die("<script>location.href='login.php'</script>"); 
}

/*if($_SESSION['IP_address'] != $_SERVER['REMOTE_ADDR'])
{
	Administrator::logout();
}

if(isset($_SESSION['current_backend_user_id']) )
{
	if (($_SESSION['timeout'] + (60 * 120)) < time()) // Session is 1 hour
	{
		Administrator::logout();
	}
	
	$_SESSION['timeout'] = time();
}*/

?>