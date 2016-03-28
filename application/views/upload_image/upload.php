<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Imagemagick Upload</title>
<style>
.upload-wrapper{width: 300px;margin-left: auto;margin-right: auto;background: #FFE4EF;height: 50px;border: 2px dashed #FF69A5;border-radius: 10px;overflow:hidden;margin-top: 10px;}
.upload-wrapper .upload-click{text-align: center;margin-top: 15px;font: bold 1em Arial, Helvetica, sans-serif;color: #F04141;cursor: pointer;}
.upload-wrapper #input-file-upload{display:none;}
.upload-wrapper .upload-image{text-align: center;padding: 5px;margin-top: 15px;display:none;}
h1{text-align: center;color: #CECECE;font: 1.5em "Trebuchet MS", Arial, Helvetica, sans-serif;}
#server-response{text-align: center;margin-top: 10px;font-family: Arial;font-size: 13px;}
.error{color: #F00;}
.success{color: #07B300;}
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jss/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).ready( function() {
	$(".upload-click").click(function(e){ 
		$('#input-file-upload').trigger('click');
	});
	
	$("#input-file-upload").change(function(){
		var loaded = false;
		if(window.File && window.FileReader && window.FileList && window.Blob){
			if($(this).val()){ //check empty input filed
				oFReader = new FileReader(), rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;
				if($(this)[0].files.length === 0){return}
				
				var oFile = $(this)[0].files[0];
				var fsize = $(this)[0].files[0].size; //get file size
				var ftype = $(this)[0].files[0].type; // get file type
				
				if(!rFilter.test(oFile.type)) 
				{
					alert('Unsupported file type!');
					return false;
				}
					
				var allowed_file_size = 2194304;	
							
				if(fsize>allowed_file_size)
				{
					alert('File too big! Allowed size 2 MB');
					return false;
				}
				
				$(".upload-image").show();
				$(".upload-click").hide();
				
				var mdata = new FormData();
				mdata.append('image_data', $(this)[0].files[0]);
				
				jQuery.ajax({
					type: "POST", // HTTP method POST or GET
					processData: false,
					contentType: false,
					url: "uploader/do_upload", //Where to make Ajax calls
					data: mdata, //Form variables
					dataType: 'json',
					success:function(response){
						$(".upload-image").hide();
						$(".upload-click").show();
						
						if(response.type == 'success'){
							$("#server-response").html('<div class="success">' + response.msg + '</div>');
						}else{
							$("#server-response").html('<div class="error">' + response.msg + '</div>');
						}
					}
				});
				
			}
			
		}else{
			alert("Can't upload! Your browser does not support File API! Try again with modern browsers like Chrome or Firefox.</div>");
			return false;
		}
		
	});
});
</script>
</head>

<body>
<h1>Ajax Image Upload with PHP ImageMagick</h1>
<div class="upload-wrapper">
<div class="upload-click">Click here to Upload File</div>
<div class="upload-image"><img src="<?php echo base_url(); ?>images/ajax-loader.gif" width="16" height="16"></div>
<input type="file" id="input-file-upload" />
</div>
<div id="server-response"></div>

</body>
</html>
