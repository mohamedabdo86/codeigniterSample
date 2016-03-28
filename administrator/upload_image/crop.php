<?php
require_once('class.upload.php');
require_once('../modules/config.php');


global $imagecrop_path_to_search,$imagecrop_path_to_replace;

  	
if((isset($_POST['step']))&&($_POST['step']=='process')){
			$pic = rand().rand().rand().rand().rand();
			
			///$handle = new Upload($path.$_POST['folder'].'/'.$_POST['tempfile']);
			$handle = new Upload($imagecrop_path_to_replace.'/'.$_POST['folder'].'/'.$_POST['tempfile']);
			
			
			if ($handle->uploaded) {
				$handle->file_src_name_body      = $pic; // hard name
				$handle->file_overwrite 		 = true;
				$handle->file_auto_rename 		 = true;
				$handle->image_resize            = true;
				$handle->image_x                 = $_POST['image_x']; //size of final picture
				$handle->image_y                 = $_POST['image_y']; //size of final picture
				
				$handle->jcrop                   = true;
				$handle->rect_w                  = $_POST['w']; 
				$handle->rect_h                  = $_POST['h']; 
				$handle->posX                    = $_POST['x']; 
				$handle->posY                    = $_POST['y'];
			
				$handle->jpeg_quality 		 	 = 100;
				//$handle->Process($path.$_POST['folder'].'/');
				$handle->Process($imagecrop_path_to_replace.'/'.$_POST['folder'].'/');
				
			/*	//thumb-50
				$handle->file_src_name_body      = $pic; // hard name
				$handle->file_overwrite 		 = true;
				$handle->file_auto_rename 		 = true;
				$handle->image_resize            = true;
				$handle->image_x                 = 50;
				$handle->image_y                 = 50; //size of picture
				
				$handle->jcrop                   = true;
				$handle->rect_w                  = $_POST['w']; 
				$handle->rect_h                  = $_POST['h']; 
				$handle->posX                    = $_POST['x']; 
				$handle->posY                    = $_POST['y'];
				$handle->jpeg_quality 		 	 = 100;
				$handle->Process($_SERVER['DOCUMENT_ROOT'].'/heba/webmaster/photos/50/');*/
				
				$handle->clean(); 
				
			} 
			else {
				//error
			}
	
	}
	//echo $_SERVER['DOCUMENT_ROOT'].'/heba/'.'uploads/news/'.$_POST['tempfile'];
	echo $handle->file_dst_name;
	//header("Location: .");
?>