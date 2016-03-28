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
        	<td style="color:#202b62;font-size:30px;font-family:Tahoma, Geneva, sans-serif;padding: 10px 145px">
             <?php if(mb_detect_encoding($name) != "ASCII"){ ?>
        	مرحبا <?php echo ucwords($name); ?>    
				<?php
                }else{ ?>
                <?php echo ucwords($name); ?> مرحبا
                <?php }?>  
             </td>
        </tr>
        	
        <tr>
            <td><img usemap="#body" src="<?php echo base_url();?>images/emails/activation_body.png" /></td>
            <map name="body" id="imgmap201461213363" name="imgmap201461213363">
            <area shape="rect" alt="activateemailarabic" title="" coords="211,218,304,236" href="<?php echo $url;?>" target="" />
            <area shape="rect" alt="activateemaileng" title="" coords="569,260,647,275" href="" target="" />
            </map>
        </tr>
        <tr>
        	<td><a title="اضغط هنا لتفعيل حسابك" href="<?php echo $url;?>">اضغط هنا لتفعيل حسابك</a></td>
        </tr>
        
    
    
    
    <tr>
    	<td> <img usemap="#footer" src="<?php echo base_url();?>images/emails/activation_footer.png" /> </td>
        <map  name="footer" id="imgmap2014612132035" name="imgmap2014612132035">
        <area shape="rect" alt="" coords="60,1,90,30" href="https://www.facebook.com/NestleEgypt" target="" />
		<area shape="rect" alt="" coords="608,8,762,25" href="<?php echo site_url();?>" target="" />
        <area shape="rect" alt="twitter" title="" coords="26,1,55,32" href="https://www.youtube.com/user/NestleEgypt" target="_blank" />
        <area shape="rect" alt="editprofile" title="" coords="567,43,622,50" href="<?php echo site_url('my_corner/profile');?>" target="" />
        <area shape="rect" alt="nomessage" title="" coords="483,53,535,67" href="<?php echo site_url('my_corner/unsubscribe_newsletter/'.$this->members->members_salt.''); ?>" target="" />
        <area shape="rect" alt="nomessage" title="" coords="600,70,661,84" href="<?php echo site_url('contact_us'); ?>" target="" />
        
        
        
        </map>
    </tr>
    
</table>




</body>
</html>
