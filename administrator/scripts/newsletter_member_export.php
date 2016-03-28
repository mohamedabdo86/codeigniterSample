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
 $path = "https://stag.mynestle.com.eg/"."uploads/newsletter_member/";
$child_age = (int)addslashes($_GET['child_age']);
if($child_age)
$section_string = " and child_age = ".$child_age;
$display  = $db -> querySelect("select * from newsletter_members JOIN newsletter_types ON newsletter_types_ID = newsletter_members_newsletter_types_id where 1 {$section_string} order by newsletter_members_ID desc  ");	

$total_points_counter = 0;
?>

<body>


<table width="1000" border="1" cellspacing="0" cellpadding="2">
  <tr>
    <th width="262" scope="col">E-mail</th>
    <th width="262" scope="col">Baby's Month</th>
    <th width="262" scope="col">Mother's Name</th>
    <th width="262" scope="col">Baby's Name</th>
    <th width="262" scope="col">Baby's Birthdate</th>
    <th width="262" scope="col">Mobile Number</th>
    <th width="262" scope="col">Home Address</th>
    <th width="262" scope="col">Awarness Source</th>
    <th width="262" scope="col">Newsletter Type</th>
  </tr>
  <?php
  for($i=0;$i<sizeof($display);$i++)
  {
	  
  ?>
  <tr align="center">
    <td><?php echo $display[$i]['newsletter_members_members_emails']?></td>
    <td><?php echo $display[$i]['child_age']; ?></td>
    <td><?php echo $display[$i]['newsletter_members_mom_name']; ?></td>
    <td><?php echo $display[$i]['newsletter_members_baby_name']; ?></td>
    <td><?php echo $display[$i]['newsletter_members_baby_birthdate']; ?></td>
    <td><?php echo $display[$i]['newsletter_members_mobile_number']; ?></td>
    <td><?php echo $display[$i]['newsletter_members_home_address']; ?></td>
    <td><?php echo $display[$i]['newsletter_members_awarness']; ?></td>
    <td><?php echo $display[$i]['newsletter_types_title']; ?></td>
  </tr>
  <?php
  }
  ?>
    
</table>




</body>
</html>