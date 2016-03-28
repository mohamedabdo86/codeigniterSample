<?php

include("../modules/database.php");
$date = new DateTime();
 
header("Content-Type: text/plain");

header("Content-Disposition: attachment; filename=nestle_members_".date('y_m_d_H_i_s').".xls");
header("Content-type: application/vnd.ms-excel");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Members List</title>

</head>
<?php
$display  = $db -> querySelect("select * from members ");	

?>

<body>


<table width="1000" border="1" cellspacing="0" cellpadding="2">
  <tr>
    <th width="147" scope="col">members_ID</th>
    <th width="262" scope="col">members_first_name</th>
    <th width="262" scope="col">members_last_name</th>    
    <th width="144" scope="col">members_email</th>
    <th width="116" scope="col">members_password</th>
    <th width="127" scope="col">members_old_password</th>
    <th width="127" scope="col">members_salt</th>
    <th width="127" scope="col">members_birthdate</th>
    <th width="127" scope="col">members_mobile</th>
    <th width="127" scope="col">members_address</th>
    <th width="127" scope="col">members_city_id</th>
    <th width="127" scope="col">members_relationship_id</th>
    <th width="127" scope="col">members_addeddate</th>
    <th width="127" scope="col">members_children</th>
    <th width="127" scope="col">members_images</th>
    <th width="127" scope="col">members_newsletter</th>
    <th width="127" scope="col">members_avatar_ID</th>
    <th width="127" scope="col">members_interested</th>
    <th width="127" scope="col">members_points</th>
    <th width="127" scope="col">members_nickname</th>
    <th width="127" scope="col">members_lang</th>
    <th width="127" scope="col">members_fb_id</th>
    <th width="127" scope="col">members_login_attempts</th>
    <th width="127" scope="col">members_login_lock_time</th>
    <th width="127" scope="col">members_access_token</th>
    <th width="127" scope="col">members_activated</th>
    <th width="127" scope="col">members_reset_password_requested</th>
    <th width="127" scope="col">members_reset_password_active</th>
  </tr>
  <?php
  for($i=0;$i<sizeof($display);$i++)
  {
  ?>
  <tr align="center">
    <td><?php echo $display[$i]['members_ID']; ?></td>
    <td><?php echo $display[$i]['members_first_name']; ?></td>
    <td><?php echo $display[$i]['members_last_name']; ?></td>
    <td><?php echo $display[$i]['members_email']; ?></td>
    <td><?php echo $display[$i]['members_password']; ?></td>
    <td><?php echo $display[$i]['members_old_password']; ?></td>
    <td><?php echo $display[$i]['members_salt']; ?></td>
    <td><?php echo $display[$i]['members_birthdate']; ?></td>
    <td><?php echo $display[$i]['members_mobile']; ?></td>
    <td><?php echo $display[$i]['members_address']; ?></td>
    <td><?php echo $display[$i]['members_city_id']; ?></td>
    <td><?php echo $display[$i]['members_relationship_id']; ?></td>
    <td><?php echo $display[$i]['members_addeddate']; ?></td>
    <td><?php echo $display[$i]['members_children']; ?></td>
    <td><?php echo $display[$i]['members_images']; ?></td>
    <td><?php echo $display[$i]['members_newsletter']; ?></td>
    <td><?php echo $display[$i]['members_avatar_ID']; ?></td>
    <td><?php echo $display[$i]['members_interested']; ?></td>
    <td><?php echo $display[$i]['members_points']; ?></td>
    <td><?php echo $display[$i]['members_nickname']; ?></td>
    <td><?php echo $display[$i]['members_lang']; ?></td>
    <td><?php echo $display[$i]['members_fb_id']; ?></td>
    <td><?php echo $display[$i]['members_login_attempts']; ?></td>
    <td><?php echo $display[$i]['members_login_lock_time']; ?></td>
    <td><?php echo $display[$i]['members_access_token']; ?></td>
    <td><?php echo $display[$i]['members_activated']; ?></td>
    <td><?php echo $display[$i]['members_reset_password_requested']; ?></td>
    <td><?php echo $display[$i]['members_reset_password_active']; ?></td>
    
  </tr>
  <?php
  }
  ?>
</table>




</body>
</html>