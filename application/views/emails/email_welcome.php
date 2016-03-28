<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link />
</head>

<body style="margin:0; padding:0; font-family:Tahoma, Geneva, sans-serif; font-size:14px;" >


<table width="500" border="0" cellspacing="0" cellpadding="0" style="background:#fbf7c7;margin:0px auto;">
  <tr height="75">
    <td>
    <div style="width:100%; background-color:#fff200; border-top:5px solid #6d6d6d; border-bottom:#212c64 solid 5px">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="35%" height="75"><img src="<?php echo base_url();?>images/emails/nestle_logo.png " /></td>
        <td width="13%"><div style="width:1px; height:75px; background:#FFF"></div></td>
        <td width="48%" align="center">مرحبا <?php echo $name; ?> </td>
      </tr>
    </table>
    </div>
    </td>
  </tr>
  <tr height="35">
    <td height="35" align="center" valign="middle">لقد تم تفعيل حسابك , يمكنك الان استخدام حسابك و المشاركة في الموقع</td>
  </tr>
  <tr>
    <td><img src="<?php echo base_url();?>images/emails/welcome.png"  width="500" height="485" border="0" usemap="#Map" /></td>
  </tr>
  <tr>
    <td align="right"  >
    <div style="margin:0px 60px;">
    <p>  لتعديل بياناتك <span style="margin-right:100px;color:#253067"><a href="<?php echo site_url('my_corner/edit_profile/info'); ?>" style="text-decoration:none;">إضغط هنا</a></span></p>
   
    <p> إضافة وصفة جديدة  <span style="margin-right:70px;color:#253067"><a href="<?php  echo site_url('best_cook/upload_recipe');?>" style="text-decoration:none;">إضغط هنا</a> </span></a> </p>
    </div>
  
    </td>
  </tr>
  <tr>
    <td>
   
    </td>
  </tr>
   <tr>
    <td bgcolor="212c64" height="30px">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
     <td width="5%">&nbsp;</td>
     <td width="15%"><a href="https://www.facebook.com/NestleEgypt"><img src="<?php echo base_url();?>images/emails/facebook_icon.png" align="right" /></a></td>
     <td width="5%">&nbsp;</td>
     <td width="15%"><a href="https://www.youtube.com/user/NestleEgypt"><img src="<?php echo base_url();?>images/emails/youtube_icon.png" align="absbottom" /></a></td>
     <td width="55%" align="right"><a href="<?php echo site_url();?>" style="color:#FFFFFF;text-decoration:none;margin-right:10px;">www.mynestle.com.eg</a></td>
      <td width="5%">&nbsp;</td>  
      </tr>
	</table>
	
    </td>
  </tr>
   
</table>




<map name="Map" id="Map">
  <area shape="rect" coords="79,435,163,481" href="<?php echo site_url('best_time');?>" alt="link4" />
  <area shape="rect" coords="86,299,177,356" href="<?php echo site_url('best_me');?>" alt="link3" />
  <area shape="rect" coords="80,196,163,244" href="<?php echo site_url('best_cook');?>" alt="link2"/>
  <area shape="rect" coords="87,83,159,130" href="<?php echo site_url('best_mom');?>" alt="link1"/>
</map>
</body>
</html>
