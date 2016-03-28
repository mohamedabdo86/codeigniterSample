<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Recipe</title>
</head>
<body>
  <table width="800" height="600">
  <tr>
    <td width="800" align="right"><img src="<?php echo base_url();?>images/emails/email_header.png" usemap="#logo" /></td>
    <map name="logo">
  		<area shape="rect" coords="511,29,722,114" alt="nestle" target="_blank" href="<?php echo site_url('welcome'); ?>">
	</map>
  </tr>
  <tr>
  	<td width="800" height="324">
    <table width="800" height="324">
    <tr>
    	<td width="800" height="50" align="right"><h2 style="color:#1324A3;font-size:26px !important;">
        <?php if(mb_detect_encoding($name) != "ASCII"){ ?>
        	مرحبا <?php echo ucwords($name); ?>    
        <?php
		}else{ ?>
        <?php echo ucwords($name); ?> مرحبا
        <?php }?>
        </h2></td>
    </tr>
    <tr>
    	<td width="800" height="50" align="right"><h3 style="color:#a3a3a3;">لقد إشتركت فى دروس الطبخ بنجاح </h3></td>
    </tr>
    <tr>
    	<td width="800">
        <table width="800">
          <tr>
            <td align="left"><img src="<?php echo base_url();?>images/emails/cheif.png"  width="170" height="200"/></td>
            <td align="right" width="600">
            <table width="400">
            <tr>
            <td></td>
            <td width="250"><p style="color:#666;font-weight:bold;font-size:18px;text-align:right;"> <?php echo $title; ?> </p></td>
            </tr>
            <tr>
            <td></td>
            <td><p align="right" style="color:#999;font-style:italic;font-size:12px !important;"> <?php echo $lesson_day; ?> :تاريخ الدرس </p></td>
            </tr>
            <tr>
            <td></td>
            <td></td>
            <?php /*?><td style="direction:rtl;"><p align="right" style="color:#999;font-style:italic;font-size:12px !important;"> مواعيد الدرس: <?php
			 if($current_language_db_prefix == '_ar')
				{
					$array = array('Sunday'=> 'الأحد' ,'Monday'=>'الأثنين' ,'Tuesday'=> 'الثلاثاء' , 'Wednesday' =>'الأربعاء' , 'Thursday' => 'الخميس' , 'Friday' => 'الجمعة' , 'Saturday' => 'السبت');
				}
				else
				{
					$array = array('Sunday'=> 'Sunday' ,'Monday'=>'Monday' ,'Tuesday'=> 'Tuesday' , 'Wednesday' =>'Wednesday' , 'Thursday' => 'Thursday' , 'Friday' => 'Friday' , 'Saturday' => 'Saturday');
				}
			 $pieces = explode(";", $current_days);
			 foreach ($pieces as $key => $value) 
				{
		     	echo $array[$value].", ";
				}
			 ?> </p></td><?php */?>
            </tr>
           
            <!--<tr>
                <td align="right"><p style="color:#900;font-weight:bold;"> <?php //echo $lesson_day; ?> </p></td>
            	<td width="150" align="right"><p style="color:#999;font-size:16px;"> تاريخ الدرس  </p></td>
            </tr>-->
            <tr>
            <td align="right"><a style="color:#900;font-weight:bold;" href="<?php echo site_url('best_cook/applications/2/class'); ?>"> اضغط هنا </a></td>
            <td width="150" align="right"><p style="color:#999;font-size:16px;"> لمتابعة الدرس  </p></td>
            </tr>
            <tr>
                <td align="right"><a style="color:#900;font-weight:bold;" href="<?php echo site_url('best_cook/applications/2'); ?>"> اضغط هنا </a></td>
            	<td width="150" align="right"><p style="color:#999;font-size:16px;"> الدروس السابقة  </p></td>
            </tr>
            </table>
            	<div style="width:270px; float:right; padding-right:10px;text-align:right;">
                	
            		
    				
                </div>
            </td>
            <td align="right" width="200"><img src="<?php echo $image; ?>" width="200" height="150" align="right" style="padding:0px 7px 0px 7px;"/></td>
          </tr>
          <tr>
          <td></td>
          <td></td>
          <td align="right"></td>
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
  	@import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css); 
	h2, h3, p, a{
		font-family: Tahoma, Geneva, sans-serif;
	}
	h2{
		font-size:26px;
	}
	h3{
		font-size:20px;
	}
	.class_recipes {
		text-align:right;
		color:#FFF;
		padding: 0 10px;
		-webkit-border-top-left-radius: 8px;
		-webkit-border-top-right-radius: 8px;
		-moz-border-radius-topleft: 8px;
		-moz-border-radius-topright: 8px;
		border-top-left-radius: 8px;
		border-top-right-radius: 8px;
	}
  </style>
</body>
</html>