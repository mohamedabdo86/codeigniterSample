<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once 'excel_reader2.php';
$data = new Spreadsheet_Excel_Reader("test.xls");
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
echo "<tr><th>".$data->sheets[0]['cells'][$j][1]."</th><th>Middle Name</th><th>Last Name</th><th>Email ID</th></tr>";

for ($j = 1; $j <= 749; $j++)
		 {
echo "<tr>";
		
		
echo "<td>";
		echo $data->sheets[0]['cells'][$j+1][1];
		
echo "</td>";	
echo "<td>";	
		echo $data->sheets[0]['cells'][$j+1][2];
echo "</td>";

echo "<td>";
	
		echo $data->sheets[0]['cells'][$j+1][3];
echo "</td>";

echo "<td>";

		echo $data->sheets[0]['cells'][$j+1][4];
echo "</td>";
		//echo "<br>";

echo "</tr>";
		
		}

echo "</table>";
	
?>

</body>
</html>
