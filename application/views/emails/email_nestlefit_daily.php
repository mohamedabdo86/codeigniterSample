<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link />
</head>

<body style="margin:0; padding:0; font-family:Tahoma, Geneva, sans-serif; font-size:18px;" >

<table width="800"  border="0" cellspacing="5" cellpadding="0" style="margin:0px auto;">
	<tr>
    	<td  colspan="6"><img src="<?php echo base_url();?>images/nestle_fit/fit_mail_header.jpg" />		</td>
    </tr>
     	
    	<tr bgcolor="#FFFFFF" align="right">
        	<td  colspan="6" style="color:#202b62;font-size:30px;font-family:Tahoma, Geneva, sans-serif;padding: 10px 10px">
             <?php if(mb_detect_encoding($name) != "ASCII"){ ?>
        	مرحبا <?php echo ucwords($name); ?>    
				<?php
                }else{ ?>
                <?php echo ucwords($name); ?> مرحبا
                <?php }?>  
             </td>
        </tr>
       	<tr>
        	<td colspan="6" align="center">
            <h1 style="color:#09F">اليوم : <?php echo date("Y/m/d"); ?></h1>
            <h2 style="color:#09F">باقي <?php echo $remaining_calories; ?> سعرة حرارية اليوم</h2>
            <h3 style="color:#000066"><?php echo ucwords($total_water_today); ?> سعرة حرارية</h3>
            <h4 style="color:#000066">باقي <?php echo ucwords($total_water_today); ?> سعرة حرارية اليوم</h4>
            
            <?php
			
			//var_dump($name);
			
			?>
            
            	<?php /*?><td><img usemap="#body" src="<?php echo base_url();?>images/emails/activation_body.png" /></td>
                <map name="body" id="imgmap201461213363" name="imgmap201461213363">
                <area shape="rect" alt="activateemailarabic" title="" coords="211,218,304,236" href="<?php echo $url;?>" target="" />
               	<area shape="rect" alt="activateemaileng" title="" coords="569,260,647,275" href="" target="" />
                </map><?php */?>
                </td>
		</tr>
            
        <tr align="center" bgcolor="#0033FF" bordercolor="#FFFFFF" style="color: #fff; padding:0px; margin:0px">
        	<td bgcolor="#FFFFFF" width="10">
			</td>
			<td style="padding:0px">
                	<strong>فطار</strong></br>
                    <?php echo $breakfast; ?> سعرة حرارية
			</td>
            <td>
                	<strong>غداء</strong></br>
                    <?php echo $lunch; ?> سعرة حرارية
			</td>
            <td>
                	<strong>عشاء</strong></br>
                    <?php echo $dinner; ?> سعرة حرارية
			</td>
            <td>
                	<strong>سناكس</strong></br>
                    <?php echo $snacks; ?> سعرة حرارية
			</td>
            <td bgcolor="#FFFFFF" width="10">
			</td>
        </tr>
        
        <tr>
        	<td bgcolor="#FFFFFF" width="10">
			</td>
			<td colspan="4" bgcolor="#000066" align="center" style="color:#FFF">
                	<h2>شربتي النهاردة <?php echo $drank_water; ?> كوبايات مية ، فاضلك <?php echo $rest_water; ?> كوبايات لصحة أفضل</h2>
			</td>
            <td bgcolor="#FFFFFF" width="10">
			</td>
        </tr>
        
        <tr>
			<td  colspan="6"><img src="<?php echo base_url();?>images/nestle_fit/fit_mail_footer.jpg" />
        </tr>
        
    
    
    <!--
    <tr>
    	<td colspan="4">
        
        	<img usemap="#footer" src="<?php echo base_url();?>images/emails/activation_footer.png" /> 
        	        <map  name="footer" id="imgmap2014612132035" name="imgmap2014612132035">
        <area shape="rect" alt="" coords="60,1,90,30" href="https://www.facebook.com/NestleEgypt" target="" />
		<area shape="rect" alt="" coords="608,8,762,25" href="http://www.mynestle.com.eg" target="" />
        <area shape="rect" alt="twitter" title="" coords="26,1,55,32" href="https://www.youtube.com/user/NestleEgypt" target="_blank" />
        <area shape="rect" alt="editprofile" title="" coords="567,43,622,50" href="<?php echo site_url('my_corner/profile');?>" target="" />
        <area shape="rect" alt="nomessage" title="" coords="600,70,661,84" href="<?php echo site_url('contact_us'); ?>" target="" />
        
        </td>
       
        
        
        </map>
    </tr>  -->
    
</table>




</body>
</html>
