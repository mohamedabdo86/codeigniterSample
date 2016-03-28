<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

require_once("modules/database.php");
require_once("modules/administrator.php");
require_once("modules/globals_settings.php");	


$password = "Nestl@321more";

echo $password;
echo "<br>";

echo crypt(sha1(md5($db->escape($password))), 'st');

echo "<br>";


?>
</body>
</html>
