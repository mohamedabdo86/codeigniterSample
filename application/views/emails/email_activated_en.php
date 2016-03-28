<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Email Activated</title>
<link />
</head>

<body style="margin:0; padding:0; font-family:Tahoma, Geneva, sans-serif; font-size:14px;" >




<table width="800"  border="0" cellspacing="0" cellpadding="0" style="margin:0px auto;">
	<tr>
    	<td><img src="<?php echo base_url();?>images/emails/activiation_header.jpg" /></td>
    </tr>
    
     	
    	<tr bgcolor="#FFFFFF" align="left">
        	<td style="color:#202b62;font-size:30px;font-family:Tahoma, Geneva, sans-serif;padding:10px 30px;"> 
           	<?php if(mb_detect_encoding($name) != "ASCII"){ ?>
        	 <?php echo ucwords($name); ?> Welcome    
				<?php
                }else{ ?>
                Welcome <?php echo ucwords($name); ?> 
                <?php }?>  
            </td>
        </tr>
        <tr bgcolor="#FFFFFF" align="left">
        <td style="color:#a3a3a3;font-size:20px;font-family:Tahoma, Geneva, sans-serif;padding-top:10px;padding-bottom:10px;padding-left:35px;">Your account has been activated</td>
        </tr>
            <tr>
            	<td><img usemap="#body" src="<?php echo base_url();?>images/emails/after_activation_en.png" /></td>
                <map name="body">
                <area shape="rect" alt="bestmom" title="" coords="625,101,666,111" href="<?php echo site_url('best_mom/index');?>" target="" />
               <area shape="rect" alt="besrcook" title="" coords="232,100,270,110" href="<?php echo site_url('best_cook/index');?>" target="" />
               <area shape="rect" alt="bestme" title="" coords="623,220,662,235" href="<?php echo site_url('best_me/index');?>" target="" />
               <area shape="rect" alt="besttime" title="" coords="228,217,269,235" href="<?php echo site_url('best_time/index');?>" target="" />
               
                </map>
            </tr>    
    
    <tr>
    	<td> <img usemap="#footer" src="<?php echo base_url();?>images/emails/email_footer_en_2.png" /> </td>
        <map  name="footer" id="imgmap2014612132035" name="imgmap2014612132035">
        <area shape="rect" alt="" coords="727,1,759,34" href="https://www.facebook.com/NestleEgypt" target="" />
		<area shape="rect" alt="" coords="31,8,192,22" href="<?php echo site_url('welcome');?>" target="" />
        <area shape="rect" alt="twitter" title="" coords="687,0,722,31" href="https://www.youtube.com/user/NestleEgypt" target="_blank" />
        <area shape="rect" alt="editprofile" title="" coords="33,34,79,48" href="<?php echo site_url('my_corner/profile');?>" target="" />
        <area shape="rect" alt="nomessage" title="" coords="32,51,80,61" href="<?php echo site_url('my_corner/unsubscribe_newsletter/'.$this->members->members_salt.''); ?>" target="" />
        <area shape="rect" alt="editprofile" title="" coords="33,67,80,80" href="<?php echo site_url('contact_us');?>" target="" />
        
        
        </map>
    </tr>
    
</table>




</body>
</html>
