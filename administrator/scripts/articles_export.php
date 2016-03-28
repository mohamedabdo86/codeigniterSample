<?php

include("../modules/database.php");
$date = new DateTime();
 
header("Content-Type: text/plain");

header("Content-Disposition: attachment; filename=articles_".date('y_m_d_H_i_s').".xls");
header("Content-type: application/vnd.ms-excel");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recipes List</title>

</head>
<?php
$members_filter_string = "";
//$members_selected = $_GET['members'];
//if($members_selected != "")
//$members_filter_string = " where members_ID IN ({$members_selected})";


$display  = $db -> querySelect("select * from articles,sub_sections where sub_sections_ID =articles_sections_ID   order by articles_title  ");	

?>

<body>


<table width="1000" border="1" cellspacing="0" cellpadding="2">
  <tr>
    <th width="147" scope="col">ID</th>
    <th width="262" scope="col">Title</th>
     <th width="262" scope="col">Title Arabic</th>
	<th width="144" scope="col">Link</th>
 
  </tr>
  <?php
  for($i=0;$i<sizeof($display);$i++)
  {
	  $controller_name = "";
	  if($display[$i]['sub_sections_sections_ID'] == 2 ) $controller_name = "best_cook";
	  if($display[$i]['sub_sections_sections_ID'] == 10 ) $controller_name = "best_me";
	  if($display[$i]['sub_sections_sections_ID'] == 27 ) $controller_name = "best_mom";
	  if($display[$i]['sub_sections_sections_ID'] == 28 ) $controller_name = "best_time";
	  $url = "http://192.185.151.73/~devarea/nestle/index.php/ar/".$controller_name."/inner_articles/".$display[$i]['articles_ID'];
  ?>
  <tr align="center">
    <td><?php echo $display[$i]['articles_ID']; ?></td>
    <td><?php echo $display[$i]['articles_title']; ?></td>
    <td><?php echo $display[$i]['articles_title_ar']; ?></td>
    <td><a href="<?php echo $url ?>"><?php echo $url; ?></a></td>
 
    
  </tr>
  <?php
  }
  ?>
</table>




</body>
</html>