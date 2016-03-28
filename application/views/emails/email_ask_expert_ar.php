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
    	<td><img src="<?php echo base_url();?>images/emails/activiation_header.png" /></td>
    </tr>
    
     	
        <tr bgcolor="#FFFFFF" align="center">
        <td style="color:#a3a3a3;font-size:20px;font-family:Tahoma, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;padding-right:40px;">
        تم ارسال استفسارك بنجاح, سوف يقوم احد مشرفينا بالرد عليك فى أسرع وقت
        </td>
        </tr>
            
        
    
    
    
    <tr>
    	<td> <img usemap="#footer" src="<?php echo base_url();?>images/emails/activation_footer.png" /> </td>
        <map  name="footer" id="imgmap2014612132035" name="imgmap2014612132035">
        <area shape="rect" alt="" coords="60,2,90,30" href="https://www.facebook.com/NestleEgypt" target="" />
		<area shape="rect" alt="" coords="608,4,767,28" href="http://www.mynestle.com.eg" target="" />
        <area shape="rect" alt="twitter" title="" coords="21,2,55,27" href="https://twitter.com/NestleEgypt" target="_blank" />
        <area shape="rect" alt="editprofile" title="" coords="567,43,622,50" href="<?php echo site_url('my_corner/profile');?>" target="" />
        <area shape="rect" alt="nomessage" title="" coords="479,55,533,71" href="<?php echo site_url('my_corner/unsubscribe_newsletter/'.$this->members->members_id.''); ?>" target="" />
        <area shape="rect" alt="nomessage" title="" coords="605,72,657,98" href="<?php echo site_url('contact_us'.$this->members->members_id.''); ?>" target="" />
        
        
        
        </map>
    </tr>
    
</table>




</body>
</html>
