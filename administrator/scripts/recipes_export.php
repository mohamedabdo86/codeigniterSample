<?php

include("../modules/database.php");
$date = new DateTime();
 
header("Content-Type: text/plain");

header("Content-Disposition: attachment; filename=recipes_".date('Y-m-d_H-i-s').".xls");
header("Content-type: application/vnd.ms-excel");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recpies List</title>

</head>
<?php
/*$members_filter_string = "";
$members_selected = $_GET['members'];
if($members_selected != "")
$members_filter_string = " where members_ID IN ({$members_selected})";
*/

$display  = $db -> querySelect("select * from recipes join images on images_ID = recipes_image where Active = -1 order by recipes_ID  ");	

?>

<body>


<table width="1000" border="1" cellspacing="0" cellpadding="2">
  <tr>
    <th width="50" scope="col">ID</th>
    <th width="262" scope="col">Title (English)</th>
    <th width="250" scope="col">Title (Arabic)</th>
    <th width="400" scope="col">Image Path</th>
    <th width="400" scope="col">Recipe URL</th>

  </tr>
  <?php
  for($i=0;$i<sizeof($display);$i++)
  {
	  $image_path = 'https://mynestle.com.eg/uploads/recipes/'.$display[$i]['images_src'];
	  $recpies_url = 'https://mynestle.com.eg/ar/best_cook/delicious_recipes/'.$display[$i]['recipes_ID'];
  ?>
  <tr align="center">
    <td><?php echo $display[$i]['recipes_ID']; ?></td>
    <td><?php echo $display[$i]['recipes_title']; ?></td>
    <td><?php echo $display[$i]['recipes_title_ar']; ?></td>
    <td><?php echo '<a href="'.$image_path.'">'.$image_path.'</a>';?></td>
    <td><?php echo '<a href="'.$recpies_url.'">'.$recpies_url.'</a>';?></td>

  </tr>
  <?php
  }
  ?>
</table>




</body>
</html>