<?php
require_once("../modules/database.php");
$id = (int) $_GET['id'];
$dir = $_GET['dir'];
$get_image = $db->querySelectSingle("select * from images where images_ID=".$id);
$ratio_1 = $_GET['ratio_1'];
$ratio_2 = $_GET['ratio_2'];
$target_w = $_GET['target_w'];
$target_h = $_GET['target_h'];

if($get_image['images_cord'] != "")
{
	$array_of_cord = explode(",",$get_image['images_cord']);
	$x_preset = $array_of_cord[0];
	$y_preset = $array_of_cord[1];
	$w_preset = $array_of_cord[2];
	$h_preset = $array_of_cord[3];
}
else
{
	$x_preset = 0;
	$y_preset = 0;
	$w_preset = 400;
	$h_preset = 400;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
 
<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
<script src="js/jquery.Jcrop.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />

<script type="text/javascript">

    jQuery(function($){

      // Create variables (in this scope) to hold the API and image size
      var jcrop_api, boundx, boundy;
      
      $('#target').Jcrop({
        onChange: updatePreview,
        onSelect: updatePreview,
        aspectRatio: <?php echo $ratio_1; echo $ratio_2 == "" ? "" : "/".$ratio_2; ?>,
		boxWidth: 500,
		allowSelect: false,
		setSelect: [ <?php echo $x_preset; ?>,<?php echo $y_preset; ?>,<?php echo ($w_preset+$target_w); ?>,<?php echo ($h_preset+$target_h); ?>],
		
		 
      },function(){
        // Use the API to get the real image size
        var bounds = this.getBounds();
        boundx = bounds[0];
        boundy = bounds[1];
        // Store the API in the jcrop_api variable
        jcrop_api = this;
      });

      function updatePreview(c)
      {
		  $("#x").val(c.x);
    	  $("#y").val(c.y);
		  $("#w").val(c.w);
		  $("#h").val(c.h);
        if (parseInt(c.w) > 0)
        {
          var rx = <?php echo $target_w; ?> / c.w;
          var ry = <?php echo $target_h; ?>/ c.h;

          $('#preview').css({
            width: Math.round(rx * boundx) + 'px',
            height: Math.round(ry * boundy) + 'px',
            marginLeft: '-' + Math.round(rx * c.x) + 'px',
            marginTop: '-' + Math.round(ry * c.y) + 'px'
          });
        }
      };
	  
	  
	  <?php /*?>jcrop_api.animateTo([<?php echo $x_preset; ?>,<?php echo $y_preset; ?>,<?php echo ($w_preset+$target_w); ?>,<?php echo ($h_preset+$target_h); ?>]);<?php */?>

    });
	$(document).ready(function(e) {
        
		$('#save_thumb_button').click(function(e) {
            
			$.ajax({
			  url: "ajax/crop_of_jcrop.php",
			  type: "POST",
			  data: {dir : "<?php echo "../".$dir; ?>",
			  		file : "<?php echo $get_image['images_src']; ?>",
					id: <?php echo $id; ?> ,
					x:  $("#x").val(), y:  $("#y").val(), w:  $("#w").val(), h:  $("#h").val(),
					target_w: <?php echo $target_w; ?> , target_y: <?php echo $target_h; ?>
					 
				 },
			  cache: false,
			  
			  success: function(success_array)
			  {
				  
				 window.parent.location.reload();
				
				
				
			  },
			  error: function(xhr, ajaxOptions, thrownError)
			  {
				
				 
				 
				
			  }
			  
	});
        });
    });

  </script>
<style type="text/css">
.thumb_body
{
	width:800px;
	padding:15px;
	font-family: "Century Gothic", Verdana, sans-serif;
	font-size:12px;
	
}
.thumb_body .left
{
	width:auto;
	max-width:500px;
	height:auto;
	float:left;

}
.thumb_body .right
{
	float:left;
	width:280px;
	margin-left:15px;
}
.title_container
{
	width:130px;
	padding:15px;
	margin-left:15px;
	background:#ccc;
	-webkit-border-bottom-right-radius: 15px;
	-webkit-border-bottom-left-radius: 15px;
	-moz-border-radius-bottomright: 15px;
	-moz-border-radius-bottomleft: 15px;
	border-bottom-right-radius: 15px;
	border-bottom-left-radius: 15px;
	font-family: "Century Gothic",  Verdana, sans-serif;
	font-size:14px;
	font-weight:bold;
	color:#FFF;
	
}
.title_sub
{
	font-family: "Century Gothic",  Verdana, sans-serif;
	color:#ccc;
	font-size:12px;
	
	
}
#fancybox-content
{
	border:0;
}
#preview_container_thumb
{
	width:<?php echo $target_w; ?>px;
	height:<?php echo $target_h; ?>px;
	overflow:hidden
}
</style>
</head>

<body  >
<div class="title_container">Change Thumbnail</div>
<div class="thumb_body" >
<div class="left">
<p>* Please crop the picture and choose the new thumbnail you want.</p>
<p class="title_sub">Main Image.</p>

<img  src="<?php echo "$dir".$get_image['images_src']; ?>" id="target" />
</div><!-- End of left -->

<div class="right">
<p>&nbsp;</p>
<p class="title_sub">Preview Image.</p>
 
<div id="preview_container_thumb"><img src="<?php echo "$dir".$get_image['images_src']; ?>" id="preview" alt="Preview" class="jcrop-preview" /></div>
  <input id="x" type="hidden" />
  <input id="y" type="hidden" />
  <input id="w" type="hidden" />
  <input id="h" type="hidden" />       
  
<input type="button" id="save_thumb_button" value="Save" />
</div><!-- End of right -->
          
<div class="clear"></div>
          
</div><!-- End of thumb_body -->
</body>
</html>
