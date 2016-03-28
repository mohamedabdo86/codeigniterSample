<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Recipe</title>
</head>
<body>
  <table width="800" height="600">
  <tr>
    <td width="800" align="right"><img src="<?php echo base_url();?>images/emails/activiation_header_ar.jpg" usemap="#logo" /></td>
    <map name="logo">
  		<area shape="rect" coords="511,29,722,114" alt="nestle" target="_blank" href="<?php echo site_url('welcome'); ?>">
	</map>
  </tr>
  <tr>
  	<td width="800" height="324">
    <table width="800" height="324">
    <tr>
    	<td width="800" height="50" align="right"><h2 style="color:#1324A3;font-size:18px !important;">
        <?php if(mb_detect_encoding($name) != "ASCII"){ ?>
        	مرحبا <?php echo ucwords($name); ?>    
        <?php
		}else{ ?>
        <?php echo ucwords($name); ?> مرحبا
        <?php }?>
        </h2></td>
    </tr>
    <tr>
    	<td width="800" height="50" align="right"><h3 style="color:#a3a3a3;">شكرا لك لتحميل وصفة جديدة على موقعنا, سوف يقوم احد مشرفينا بمراجعة الوصفة الخاصة بك فى <span style="color:#900;"> اسرع وقت </span> </h3></td>
    </tr>
    <tr>
    	<td width="800">
        <table width="800">
          <tr>
            <td align="left"><img src="<?php echo base_url();?>images/emails/cheif.png"  width="170" height="200"/></td>
            <td align="right" width="600">
            <table width="400">
            <tr align="right">
            <td></td>
            <td><p style="color:#333;font-weight:bold;font-size:19px;"> <?php echo $recipe_title; ?> </p></td>
            </tr>
            <br/>
            <tr align="right">
            <td ><a style="color:#900;font-weight:bold;" href="<?php echo site_url('best_cook/your_recipes/'.$recipe_id.''); ?>">اضغط هنا </a> </td>
            <td ><p style="color:#666;font-size:16px;"> لمشاهدة الوصفة  </p></td>
            </tr>
            <tr align="right">
            <td ><a style="color:#900;font-weight:bold;" href="<?php echo site_url('my_corner/edit_recipe/'.$recipe_id.''); ?>">اضغط هنا </a></td>
            <td ><p style="color:#666;font-size:16px;"> لتعديل الوصفة  </p></td>
            </tr>
            </table>
            </td>
            <td align="right" width="200"><img src="<?php echo $recipe_image; ?>" width="200" height="150" align="right" style="padding:0px 7px 0px 7px;"/></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </td>
    </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td width="800" align="right"><img src="<?php echo base_url();?>images/emails/email_footer.png" usemap="#footer" /></td>
    <map name="footer">
  		<area shape="rect" coords="59,35,91,67" alt="Facebook" href="https://www.facebook.com/NestleEgypt" target="_blank">
        <area shape="rect" coords="21,36,55,65" alt="Twitter" href="https://www.youtube.com/user/NestleEgypt" target="_blank">
        <area shape="rect" coords="570,43,726,59" alt="" href="<?php echo site_url('welcome'); ?>" target="_blank">
        <area shape="rect" coords="566,73,622,87" alt="" href="<?php echo site_url('my_corner/profile'); ?>" target="_blank">
        <area shape="rect" coords="481,93,534,107" alt="" href="<?php echo site_url('my_corner/unsubscribe_newsletter/'.$this->members->members_salt.''); ?>" target="_blank">
        <area shape="rect" coords="606,110,658,122" alt="" href="<?php echo site_url('contact_us'); ?>" target="_blank">
	</map>
  </tr>
  
</table>   
<style>
  	body{font-family: Tahoma, Geneva, sans-serif;}
	h2, h3, p, a{
		font-family: Tahoma, Geneva, sans-serif;
	}
	h2{
		font-size:26px;
	}
	h3{
		font-size:20px;
	}
  </style>
</body>
</html>