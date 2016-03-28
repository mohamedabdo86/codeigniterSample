<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Recipe</title>
</head>
<body>
  <table width="800" height="600">
  <tr>
    <td width="800" align="right"><img src="<?php echo base_url();?>images/emails/activiation_header.jpg" usemap="#logo" /></td>
    <map name="logo">
  		<area shape="rect" coords="24,28,237,118" alt="nestle" target="_blank" href="<?php echo site_url('welcome'); ?>">
	</map>
  </tr>
  <tr>
  	<td width="800" height="324">
    <table width="800" height="324">
    <tr>
    	<td width="800" height="50" align="left"><h2 style="color:#1324A3;font-size:24px !important;">
        <?php if(mb_detect_encoding($name) != "ASCII"){ ?>
        	<?php echo ucwords($name); ?> Hi    
        <?php
		}else{ ?>
            Hi <?php echo ucwords($name); ?>
        <?php }?>
        </h2></td>
    </tr>
    <tr>																	
    	<td width="800" height="50" align="left"><h3 style="color:#a3a3a3;">
        		Thank you for uploading a new recipe, our admin will respond to you <span style="color:#900;"> shortly </span>
            </h3></td>
    </tr>
    <tr>
    	<td width="800">
        <table width="800">
          <tr>
          <td align="left" width="200"><img src="<?php echo $recipe_image; ?>" width="200" height="150" align="right" style="padding:0px 7px 0px 7px;"/></td>
            <td align="left" width="600">
            <table width="400">
            <tr align="left">
            <td><p align="left" style="color:#333;font-weight:bold;font-size:19px;"> <?php echo $recipe_title; ?> </p></td>
            <td></td>
            </tr>
            <br/>
            <tr align="left">
            <td ><p style="color:#666;font-size:16px;"> To see the recipe:  </p></td>
            <td ><a style="color:#900;font-weight:bold;" href="<?php echo site_url('best_cook/your_recipes/'.$recipe_id.''); ?>"> Click here </a> </td>
            </tr>
            <tr align="left">
            <td ><p style="color:#666;font-size:16px;"> To edit the recipe:  </p></td>
            <td ><a style="color:#900;font-weight:bold;" href="<?php echo site_url('my_corner/edit_recipe/'.$recipe_id.''); ?>"> Click here </a></td>
            </tr>
            </table>
            </td>
            <td align="right"><img src="<?php echo base_url();?>images/emails/cheif.png"  width="170" height="200"/></td>
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
    <td width="800" align="right"><img src="<?php echo base_url();?>images/emails/email_footer_en.png" usemap="#footer" /></td>
    <map name="footer">
  		<area shape="rect" coords="723,35,759,71" alt="Facebook" href="https://www.facebook.com/NestleEgypt" target="_blank">
        <area shape="rect" coords="687,37,725,70" alt="Twitter" href="https://www.youtube.com/user/NestleEgypt" target="_blank">
        <area shape="rect" coords="26,45,183,61" alt="" href="<?php echo site_url('welcome'); ?>" target="_blank">
        <area shape="rect" coords="30,72,78,83" alt="" href="<?php echo site_url('my_corner/profile'); ?>" target="_blank">
        <area shape="rect" coords="30,93,74,104" alt="" href="<?php echo site_url('my_corner/unsubscribe_newsletter/'.$this->members->members_salt.''); ?>" target="_blank">
		<area shape="rect" coords="31,114,77,125" alt="" href="<?php echo site_url('contact_us'); ?>" target="_blank">
    </map>
  </tr>
  
</table>   
<style>
*{
   margin:0 auto;
   padding:0 auto;
}
  	body{font-family: Tahoma, Geneva, sans-serif;}
	h2, h3, p, a{
		font-family: Tahoma, Geneva, sans-serif;
	}
	h2{
		font-size:24px;
	}
	h3{
		font-size:20px;
	}
  </style>
</body>
</html>