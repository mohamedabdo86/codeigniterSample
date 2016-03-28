<?php

$msg ="<table width='800' height='600'>
  <tr>
    <td width='800' align='right'><img src='http://192.185.151.73/~devarea/nestle/images/emails/email_header.png' usemap='#logo' /></td>
    <map name='logo'>
  		<area shape='rect' coords='511,29,722,114' alt='nestle' target='_blank' href='http://192.185.151.73/~devarea/nestle/index.php/".$language."/welcome'>
	</map>
  </tr>
  <tr>
  	<td width='800' height='324'>
    <table width='800' height='324'>
    <tr>
    	<td width='800' height='50' align='right'><h2 style='color:#1324A3; font-size:26px !important;'>".$name."</h2></td>
    </tr>
    <tr>
    	<td style='direction: rtl;' width='800' height='50' align='right'><h3 style='color:#a3a3a3;'>تم إضافة <span style='color:#F00'> 25 </span> نقطة الى حسابك وذلك لإضافة تعليق على المقال  </h3></td>
    </tr>
    <tr>
    	<td width='800'>
        <table width='800'>
          <tr>
            <td align='left'><img src='http://192.185.151.73/~devarea/nestle/images/emails/coins.png'  width='160' height='200'/></td>
            <td style='direction: rtl;'  align='right' width='600'>
			<table width='400'>
            <tr>
            <td width='250'><p style='white-space: normal;color:#333;font-weight:bold;font-size:18px;'> ".$comment_data_title." </p></td>
            <td></td>
			</tr>
			<br/>
             <tr><tr>
            <td style='direction: rtl;' width='100' align='right'><p style='color:#666;font-size:16px;'> مشاهدة المقال...  </p></td>
			<td style='direction: rtl;' align='right'><p style='color:#666;'><a style='color:#900;font-weight:bold;' href='192.185.151.73/~devarea/nestle/index.php/".$language."/".$url.$foreign_id."'>اضغط هنا </a></p></td>
            </tr>
            <tr>
            </table>
            </td>
            <td align='right' width='200'><img src='".$image_url."' width='200' height='150' align='right' /></td>
          </tr>
          <tr>
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
    <td width='800' align='right'><img src='http://192.185.151.73/~devarea/nestle/images/emails/email_footer.png' usemap='#footer' /></td>
    <map name='footer'>
  		<area shape='rect' coords='59,35,91,67' alt='Facebook' href='https://www.facebook.com/NestleEgypt' target='_blank'>
        <area shape='rect' coords='21,36,55,65' alt='Twitter' href='https://www.youtube.com/user/NestleEgypt' target='_blank'>
        <area shape='rect' coords='570,43,726,59' alt='' href='http://192.185.151.73/~devarea/nestle/index.php/".$language."/welcome' target='_blank'>
        <area shape='rect' coords='566,73,622,87' alt='' href='http://192.185.151.73/~devarea/nestle/index.php/".$language."/my_corner/profile' target='_blank'>
        <area shape='rect' coords='481,93,534,107' alt='' href='http://192.185.151.73/~devarea/nestle/index.php/".$language."/my_corner/unsubscribe_newsletter/".$member_salt."' target='_blank'>
		<area shape='rect' coords='606,110,658,122' alt='' href='http://192.185.151.73/~devarea/nestle/index.php/".$language."/contact_us' target='_blank'>
	</map>
  </tr>
  
</table>   
<style>
  	@import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css); 
	h2, h3, p{
		font-family: Tahoma, Geneva, sans-serif;
	}
	h2{
		font-size:26px;
	}
	h3{
		font-size:22px;
	}
  </style>";

?>