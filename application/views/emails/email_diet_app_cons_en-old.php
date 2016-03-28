<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link />
<style>
table, th, td {
    border: 1px solid black;
	text-align:center;
}
table
</style>
</head>

<body style="margin:0; padding:0; font-family:Tahoma, Geneva, sans-serif; font-size:14px;" >
<div><img src="<?php echo base_url();?>images/emails/activiation_header.jpg" /></div>
<h2>Dear Admin,</h2>
<h4 style="margin-left: 50px;">This is <?php echo $name;?> Data For Diet Application.</h4>
<table cellspacing="0" cellpadding="7" style="margin:0px auto; margin-top: 15px; margin-bottom: 15px;">
    	<tr>
        	<th>Name</th>
            <td><?php echo $name;?></td>
        </tr>
        <tr>
        	<th>Birthday</th>
            <td><?php echo $members_birthdate;?></td>
        </tr>
        <tr>
        	<th>Type</th>
            <td><?php echo $members_gender;?></td>
        </tr>
        <tr>
        	<th>Height</th>
            <td><?php echo $members_height;?></td>
        </tr>
        <tr>
        	<th>Weight</th>
            <td><?php echo $members_weight;?></td>
        </tr>
        <tr>
        	<th>Members Sport</th>
            <td><?php echo $members_sport;?></td>
        </tr>
        <tr>
        	<th>Members Healthy</th>
            <td><?php echo $members_healthy;?></td>
        </tr>
        <tr>
        	<th>Members Mobile</th>
            <td><?php echo $members_mobile;?></td>
        </tr>
        <tr>
        	<th>Members Phone</th>
            <td><?php echo $members_phone;?></td>
        </tr>
        <tr>
        	<th>Email</th>
            <td><?php echo $members_email;?></td>
        </tr>
        <tr>
        	<th>Members Call Time</th>
            <td><?php echo $members_call_time;?></td>
        </tr>
</table>
<div>
	<img usemap="#footer" src="<?php echo base_url();?>images/emails/email_footer_en_cons_2.png" />
    <map  name="footer" id="imgmap2014612132035" name="imgmap2014612132035">
        <area shape="rect" alt="" coords="727,1,759,34" href="https://www.facebook.com/NestleEgypt" target="" />
		<area shape="rect" alt="" coords="31,8,192,22" href="<?php echo site_url('welcome');?>" target="" />
        <area shape="rect" alt="twitter" title="" coords="687,0,722,31" href="https://www.youtube.com/user/NestleEgypt" target="_blank" />
        </map>
 </div>
</body>
</html>
