<?php
		

$msg = "<table width='800' height='600'>
  <tr>
    <td width='800' align='right'><img src='http://192.185.151.73/~devarea/nestle/images/emails/email_header_en.png' usemap='#logo' /></td>
    <map name='logo'>
  		<area shape='rect' coords='24,28,237,118' alt='nestle' target='_blank' href='http://192.185.151.73/~devarea/nestle/index.php/".$language."/welcome'>
	</map>
  </tr>
  <tr>
  	<td width='670' height='324'>
    <table width='670' height='324'>
    <tr>
    	<td width='670' height='50' align='left'><h2 style='color:#1324A3;font-size:26px !important;'> ".$name." </h2></td>
    </tr>
    <tr>
    	<td width='670' height='50' align='left'><h3 style='color:#a3a3a3;font-size:20px !important;'> Your inquiry has been answered by our Nestle Expert Team </h3></td>
    </tr>
	<tr align='left'>
    	<td width='670'><p style='color:#333;font-weight:bold;font-size:20px;'> ".$title." </p></td>
    </tr>
    <tr>
    	<td width='670'>
        <table width='670'>
          <tr>
            <td width='500'>
			<table width='500'>
			<tr align='left'>		
				<td><p style='color:#666;font-size:20px !important;'> To see the answer  <a style='color:#900;font-weight:bold;' href='".$url."'> click here </a></p></td>
				<td><p style='font-size:20px !important;color:#666;'>Other questions <a style='color:#900;font-weight:bold;' href='192.185.151.73/~devarea/nestle/index.php/".$language."/{$sections_title}/ask_an_expert'> click here </a> </p></td>
			</tr>
			</table>
            	
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </td>
		<td align='left'><img src='http://192.185.151.73/~devarea/nestle/images/emails/question_mark.png'  width='120' height='170'/></td>
    </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td width='800' align='right'><img src='http://192.185.151.73/~devarea/nestle/images/emails/email_footer_en.png' usemap='#footer' /></td>
    <map name='footer'>
  		<area shape='rect' coords='723,35,759,71' alt='Facebook' href='https://www.facebook.com/NestleEgypt' target='_blank'>
        <area shape='rect' coords='687,37,725,70' alt='Twitter' href='https://www.youtube.com/user/NestleEgypt' target='_blank'>
        <area shape='rect' coords='26,44,183,61' alt='' href='http://192.185.151.73/~devarea/nestle/index.php/".$language."/welcome' target='_blank'>
        <area shape='rect' coords='30,72,75,84' alt='' href='http://192.185.151.73/~devarea/nestle/index.php/".$language."/my_corner/profile' target='_blank'>
        <area shape='rect' coords='31,95,77,102' alt='' href='http://192.185.151.73/~devarea/nestle/index.php/".$language."/my_corner/unsubscribe_newsletter/".$member_salt."' target='_blank'>
		<area shape='rect' coords='30,112,76,122' alt='' href='http://192.185.151.73/~devarea/nestle/index.php/".$language."/contact_us' target='_blank'>
	</map>
  </tr>
  
</table> 
<style>
  	@import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css); 
	h2, h3, p, a{
		font-family:Tahoma, Geneva, sans-serif;
	}
	h2{
		font-size:26px;
	}
	h3{
		font-size:20px;
	}
</style>";

?>