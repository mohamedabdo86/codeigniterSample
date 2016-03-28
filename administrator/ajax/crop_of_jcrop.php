<?php
require_once("../modules/database.php");
$id= $_POST['id'];
$targ_w =  $_POST['target_w'];$targ_h =$_POST['target_y'];
$jpeg_quality = 100;

$src = $_POST['dir'].$_POST['file'];
$img_r = imagecreatefromjpeg($src);
$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
$targ_w,$targ_h,$_POST['w'],$_POST['h']);


imagejpeg($dst_r, $_POST['dir']."thumb_".$_POST['file'],$jpeg_quality);

imagedestroy();

$tobesaved['images_cord'] = $_POST['x'].",".$_POST['y'].",".$_POST['w'].",".$_POST['h'];
$db->update("images",$tobesaved," images_ID=".$id);
	
?>