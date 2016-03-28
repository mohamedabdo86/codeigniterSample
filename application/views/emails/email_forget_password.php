<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link />
</head>

<body style="margin:0; padding:0; font-family:Tahoma, Geneva, sans-serif; font-size:14px;" >




<table width="800"  border="0" cellspacing="0" cellpadding="0" style="margin:0px auto;">
	<tr>
    	<td><img src="<?php echo base_url();?>images/emails/activiation_header_ar.jpg" /></td>
    </tr>
    
     	
    	<tr bgcolor="#FFFFFF" align="right">
        	<td style="color:#202b62;font-size:30px;font-family:Tahoma, Geneva, sans-serif;padding:10px 40px;"> 
            <?php if(mb_detect_encoding($name) != "ASCII"){ ?>
        	مرحبا <?php echo ucwords($name); ?>    
			<?php
            }else{ ?>
            <?php echo ucwords($name); ?> مرحبا
            <?php }?>
            </td>
        </tr>
        <tr bgcolor="#FFFFFF" align="center">
        <td align="center" style="color:#a3a3a3;font-size:20px;font-family:Tahoma, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;padding-right:40px;">
        لقد قمت بإستلام هذا الإيميل لطلبك لإسترجاع كلمة المرور الخاصة بك <br/>
         لتغير كلمة المرور الخاصة بك <a href="<?php echo $url; ?>"> اضغط هنا </a> <br/>
        من فضلك قم بحذف هذا الإيميل اذا لم تطلب استرجاع كلمة المرور الخاصة بك<br/>
        </td>
        </tr>
    
    <tr>
    	<td> <img usemap="#footer" src="<?php echo base_url();?>images/emails/activation_footer.png" /> </td>
        <map  name="footer" id="imgmap2014612132035" name="imgmap2014612132035">
        <area shape="rect" alt="" coords="60,1,90,30" href="https://www.facebook.com/NestleEgypt" target="" />
		<area shape="rect" alt="" coords="608,8,762,25" href="<?php echo site_url('welcome');?>" target="" />
        <area shape="rect" alt="twitter" title="" coords="26,1,55,32" href="https://www.youtube.com/user/NestleEgypt" target="_blank" />
        <area shape="rect" alt="editprofile" title="" coords="567,43,622,50" href="<?php echo site_url('my_corner/profile');?>" target="" />
        <area shape="rect" alt="nomessage" title="" coords="483,53,535,67" href="<?php echo site_url('my_corner/unsubscribe_newsletter/'.$this->members->members_salt.''); ?>" target="" />
        <area shape="rect" alt="nomessage" title="" coords="600,70,661,84" href="<?php echo site_url('contact_us'); ?>" target="" />
                
        </map>
    </tr>
    
</table>




</body>
</html>
