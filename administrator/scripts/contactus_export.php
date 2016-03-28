<?php

include("../modules/database.php");
$date = new DateTime();
 
header("Content-Type: text/plain");

header("Content-Disposition: attachment; filename=choosewellness_contactus_".date('y_m_d_H_i_s').".xls");
header("Content-type: application/vnd.ms-excel");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact us List</title>

</head>
<?php
 $path = "https://stag.mynestle.com.eg/"."uploads/contact_us/";


$display  = $db -> querySelect("select * from contactus,reason,respond where reason_ID = contactus_reason and
contactus_how_to_contact_method=respond_ID
  order by contactus_ID desc  ");	

$total_points_counter = 0;
?>

<body>


<table width="1000" border="1" cellspacing="0" cellpadding="2">
  <tr>
    <th width="147" scope="col">Name</th>
    <th width="262" scope="col">Email</th>
     <th width="131" scope="col">Phone</th>
    
    
    <th width="144" scope="col">Mobile</th>
    <th width="116" scope="col">Contact Method</th>
    <th width="127" scope="col">Reason</th>
    <th width="127" scope="col">Message</th>
    <th width="131" scope="col">File</th>
  </tr>
  <?php
  for($i=0;$i<sizeof($display);$i++)
  {
	  
  ?>
  <tr align="center">
    <td><?php echo $display[$i]['contactus_fname']." ".$display[$i]['contactus_lname']; ?></td>
    <td><?php echo $display[$i]['contactus_email']; ?></td>
    <td><?php echo $display[$i]['contactus_phone']; ?></td>
    <td><?php echo $display[$i]['contactus_mobile']; ?></td>
    <td><?php echo $display[$i]['respond_title']; ?></td>
    <td><?php echo $display[$i]['reason_title']; ?></td>
    <td><?php echo $display[$i]['contactus_message']; ?></td>
    <td><?php if($display[$i]['contactus_file'] != "" ) echo $path.$display[$i]['contactus_file']; ?></td>

    
  </tr>
  <?php
  }
  ?>
    
</table>




</body>
</html>