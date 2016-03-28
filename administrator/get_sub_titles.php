<?php
include("modules/database.php");
$id= (int) $_GET['id'];
$display = $db->querySelect("select * from sub_sections where sub_sections_sections_ID = {$id} and sub_sections_hide=0");


?>

<table>
<tr>
<td>ID</td>
<td>Title (english)</td>
<td>Title (arabic)</td>
<td>Extra (english)</td>
<td>Extra (arabic)</td>
</tr>

<?php 

for($i=0;$i<sizeof($display);$i++):
?>
<tr>
<td><?php echo $display[$i]['sub_sections_ID']; ?></td>
<td><?php echo $display[$i]['sub_sections_name']; ?></td>
<td><?php echo $display[$i]['sub_sections_name_ar']; ?></td>
<td><?php echo $display[$i]['sub_sections_extra_title']; ?></td>
<td><?php echo $display[$i]['sub_sections_extra_title_ar']; ?></td>
</tr>
<?php
endfor;
?>