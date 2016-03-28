<?php
if($_SERVER['HTTP_HOST'] == "localhost")
{
	/********************Data Base details for local ***************************************/
	define("dbhost", "localhost",true);
	define("uname", "root",true);
	define("password","",true);
	define("dbname","mynestle",true);
	$path = 'http://localhost/sherine/';
}
else
{
	/********************Data Base details for local ***************************************/
	/*define("dbhost", "localhost",true);
	define("uname", "devarea_amakki",true);
	define("password","mandm",true);
	define("dbname","devarea_concepts",true);
	$path = 'http://174.120.31.9/~devarea/concepts/';*/	
	define("dbhost", "localhost",true);
	define("uname", "root",true);
	define("password","",true);
	define("dbname","mynestle",true);
	$path = 'https://mediaandmore-eg.com/facebook_pages/nesquik_tabs/';
	
	
}
?>
