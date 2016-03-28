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
    	<td><img src="<?php echo base_url();?>images/emails/bestcookcomment_header.png" /></td>
    </tr>
    
     	
    	<tr bgcolor="#FFFFFF" align="right">
        	<td style="color:#202b62;font-size:30px;font-family:Tahoma, Geneva, sans-serif;padding: 20px 40px">
              <?php if(mb_detect_encoding($name) != "ASCII"){ ?>
        	مرحبا <?php echo $name; ?>    
			<?php
            }else{ ?>
            <?php echo $name; ?> مرحبا
            <?php }?>  
             </td>
        </tr>
        	
            <tr>
            	<td><img usemap="#body" src="<?php echo base_url();?>images/emails/bestcookcomment_body.png" /></td>
               
                <map  name="body" id="imgmap2014616123747" name="imgmap2014616123747">
                	<area shape="rect" alt="showcomment"  coords="165,175,253,194" href="<?php echo $url; ?>" target="" />
                </map>
            </tr>
        
    
    
    
    <tr>
    	<td> <img usemap="#footer" src="<?php echo base_url();?>images/emails/bestcookcomment_footer.png" /> </td>
        
       <map  name="footer" id="imgmap2014616123747" name="imgmap2014616123747">
            <area shape="rect" alt="nestlewebsite"  coords="569,84,724,106" href="http://www.mynestle.com.eg" target="" />
            <area shape="rect" alt="nestlefb"  coords="56,80,94,110" href="https://www.facebook.com/NestleEgypt" target="" />
            <area shape="rect" alt="nestletwitter" title="" coords="25,80,55,110" href="https://twitter.com/NestleEgypt" target="" />
            <area shape="rect" alt="edit profile" title="" coords="567,118,623,137" href="<?php echo site_url('my_corner/profile');?>" target="" />
            <area shape="rect" alt="" title="" coords="484,140,532,151" href="<?php echo site_url('my_corner/unsubscribe_newsletter/'.$this->members->members_id.''); ?>" target="" />
      </map>
    </tr>
    
</table>




</body>
</html>
