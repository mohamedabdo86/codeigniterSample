<?php
require_once('class.upload.php');
require_once('../modules/config.php');

global $imagecrop_path_to_search,$imagecrop_path_to_replace;

$folder = str_replace($imagecrop_path_to_search,$imagecrop_path_to_replace,$_REQUEST['folder']);


if (!empty($_FILES)) {
		//$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'];
		$targetPath = $folder;
		
		$pic_temp = rand().rand().rand();
		
		$handle = new Upload($_FILES['Filedata']);
			if ($handle->uploaded) {
				$handle->file_src_name_body      = $pic_temp; // hard name
				$handle->file_overwrite 		 = true;
				$handle->file_auto_rename 		 = true;
				$handle->image_resize            = true;
				$handle->image_ratio_y           = true;
				$handle->image_x                 = ($handle->image_src_x < 2000)?$handle->image_src_x:2000;
				$handle->file_max_size 			 = '8119200'; // max size
				$handle->Process($targetPath.'/');
				//$handle->clean(); 
				if ($handle->processed)
	           		$json = array("result" 		=> 1, 
	           					  "file" 		=> $_REQUEST['folder'].'/'.$handle->file_dst_name.'?'.time(),
								  "file_name_only"   =>  $handle->file_dst_name,
	           					  "imagewidth" 	=> $handle->image_dst_x,
	           					  "imageheight"	=> $handle->image_dst_y,
								  "log" => $handle->log
	           					 );
	       		else
	           		$json = array("result" => $handle->error);
	           	
	           	$encoded = json_encode($json);
				echo $encoded;
				unset($encoded);	
			} 
			else { 
				$json = array("result" => $handle->error);
	           	$encoded = json_encode($json);
				echo $encoded;
				unset($encoded);
			}
}
?>