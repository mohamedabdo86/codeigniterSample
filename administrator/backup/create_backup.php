<?php


	define("dbhost", "mysql",true);
	define("uname", "egsql01",true);
	define("password","4hCWMPGUhpDsG7zr",true);
	define("dbname","mynestle_com_eg",true);
	
 //ENTER THE RELEVANT INFO BELOW
        $mysqlDatabaseName ='mynestle_com_eg';
        $mysqlUserName ='egsql01';
        $mysqlPassword ='4hCWMPGUhpDsG7zr';
        $mysqlHostName ='mysql';
        $mysqlExportPath ='mabdo.sql';

        //DO NOT EDIT BELOW THIS LINE
        //Export the database and output the status to the page
        $command='mysqldump --opt -h' .$mysqlHostName .' -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' > ~/' .$mysqlExportPath;
        exec($command);
?>