<?php

include("../modules/database.php");
$date = new DateTime();
 
header("Content-Type: text/plain");

header("Content-Disposition: attachment; filename=members_points_".date('y_m_d_H_i_s').".xls");
header("Content-type: application/vnd.ms-excel");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Members Points</title>

</head>
<?php

$display  = $db -> querySelect("select * from points");	

?>

<body>


<table width="1000" border="1" cellspacing="0" cellpadding="2">
  <tr>
    <th width="147" scope="col">Points ID</th>
    <th width="262" scope="col">Points User ID</th>
     <th width="262" scope="col">Points Type</th>
    <th width="144" scope="col">Points Numbers</th>
    <th width="116" scope="col">Points Key</th>
    <th width="127" scope="col">Points Timestamp</th>
    <th width="127" scope="col">Points Date</th>
  </tr>
  <?php
  for($i=0;$i<sizeof($display);$i++)
  {
  ?>
  <tr align="center">
    <td><?php echo $display[$i]['points_id']; ?></td>
    <td><?php echo $display[$i]['points_user_id']; ?></td>
    <td><?php echo $display[$i]['points_type']; ?></td>
    <td><?php echo $display[$i]['points_number']; ?></td>
    <td><?php echo $display[$i]['points_key']; ?></td>
    <td><?php echo $display[$i]['points_timestamp']; ?></td>
    <td><?php echo $display[$i]['points_date']; ?></td>
    
  </tr>
  <?php
  }
  ?>
</table>




</body>
</html>