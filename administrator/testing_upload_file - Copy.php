<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
require_once("modules/files_handler.php");
/*if ($_FILES["file"]["error"] > 0) {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
} else {
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];*/
  
/*   move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
	  echo "<br>";*/
/*	if (move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"])) 
	{
    	echo "Uploaded";
	} 
	else
	{
	   echo "File was not uploaded";
	}
	  
}
print_r($_FILES);

*/

?>
<?php /*?><img src="<?php echo $_FILES["file"]["tmp_name"]."/".$_FILES["file"]["name"]; ?>" />

<form action="" method="post" enctype="multipart/form-data" name="upload_image">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>
<?php */?>

<form action="" method="post" enctype="multipart/form-data">
  Please choose a file: <input type="file" name="uploadFile"><br>
  <input type="submit" name="issubmit" value="Upload File">
</form>

<?php
$target_dir = "../uploading";
//$target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
$uploadOk=1;


echo '<script type=\'text/javascript\'>';  
echo 'alert("'.$_FILES["uploadFile"]["tmp_name"].'");';  
echo '</script>'; 


if($_POST['issubmit'] == "Upload File")
{
	list($file,$error) = UploadImage("uploadFile", $target_dir, 'jpeg,gif,png,jpg,bmp',1000000000000000000);
	echo "File : ".$file;
	echo "Error : ".$error;
}

/*
if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_dir)) {
    echo "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}
*/
?>








</body>
</html>
