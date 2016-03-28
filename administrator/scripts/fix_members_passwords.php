<?php
include("../modules/database.php");
include("../modules/globals_settings.php");
// Use this link 
// 3alkanaba.com/administrator/scripts/fix_images_problem.php?table_name=&table_id=&table_picture=
//example
//3alkanaba.com/administrator/scripts/fix_images_problem.php?table_name=big_advertise&table_id=big_advertise_ID&table_picture=big_advertise_images

error_reporting(E_ALL ^ E_NOTICE);
require_once 'excelsheet_reader/excel_reader2.php';
$data = new Spreadsheet_Excel_Reader("nestle_users.xls");
$sheets = $data->dump();
	$cells = $sheets[0]['cells'];

?>
<html>
<head>
<style>
table.excel {
	border-style:ridge;
	border-width:1;
	border-collapse:collapse;
	font-family:sans-serif;
	font-size:12px;
}
table.excel thead th, table.excel tbody th {
	background:#CCCCCC;
	border-style:ridge;
	border-width:1;
	text-align: center;
	vertical-align:bottom;
}
table.excel tbody th {
	text-align:center;
	width:20px;
}
table.excel tbody td {
	vertical-align:bottom;
}
table.excel tbody td {
    padding: 0 3px;
	border: 1px solid #EEEEEE;
}
</style>
</head>

<body>
<?php // echo $data->dump(true,true); 
echo "<table border='1'>";
echo "<tr><th>".$cells[$i][1]."</th><th>Middle Name</th><th>Last Name</th><th>Email ID</th></tr>";

for ($j = 1; $j <= 10; $j++)
		 {
echo "<tr>";
		
		
echo "<td>";
		echo $cells[$i][1];
		
echo "</td>";	
echo "<td>";	
		echo $cells[$i][2];
echo "</td>";

echo "<td>";
	
		echo $cells[$i][3];
echo "</td>";

echo "<td>";

		echo $cells[$i][4];
echo "</td>";
		//echo "<br>";

echo "</tr>";
		
		}

echo "</table>";
	
?>

</body>
</html>
