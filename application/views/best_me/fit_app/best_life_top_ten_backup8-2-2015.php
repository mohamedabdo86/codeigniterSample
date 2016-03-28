
<style>
.app_wrapper {
	height:622px;
 background-image:url(<?php echo base_url()."images/nestle_fit/top10.png";
?>);
	background-repeat:no-repeat;
	background-position:center top;
	background-size:contain;
	position:relative;
}
.app_register {
	height: auto;
	width: 556px;
	margin: 200px 69px 0px 0px;
}
.app_header {
	white-space:normal;
	text-align: center;
	color: #000;
	font-weight: bold;
	width:100%;
	top:181px;
	position:absolute;
}
.header_col {
	width:100%;
	height:138px;
}
.normal_weight {
	position:absolute;
	width:100%;
	top:220px;
	color: #fff;
	text-align:center;
	font-size: 44px;
}
h1 {
	text-align: center;
	/* line-height: 3; */
font-size: 31px;
	color: white;
	margin-bottom: 30px;
	margin-top:5px;
}
.top_ten_dev_container {
	width:35%;
	margin: auto;
}
.arabic .top_ten_dev_container {
	width:35%;
	margin: auto;
}
.arabic .top_ten_dev_container ul {
	margin-top:-30px;
}
.top_ten_dev_container ul {
	margin-top:-10px;
}
.arabic .top_ten_dev_container ul li {
	padding-right:8px;
}
.top_ten_dev_container ul li {
	height:26px;
	background:#F93;
	margin-bottom:1px;
	font-size:14px;
	padding: 1px;
	font-family:Tahoma, Geneva, sans-serif;
	line-height:26px;
	color:#FFFFFF;
	font-weight:bold;
	padding-left:8px;
}
.top_ten_dev_1 {
	width: 10%;
	background: black;
	height: 103px;
}
</style>

<div class="app_wrapper">
  <div class="row header_col"> </div>
  <h1>TOP 10</h1>
  <div class="top_ten_dev_container">
    <ul>
      <?php 
 $this->load->model('nestlefitmodel');
 $winners = $this->nestlefitmodel->get_user_winners();
 $ten_colors_array = array(
	'#f68d27',
	'#de8229',
	'#c56e19',
	'#a62a50',
	'#992347',
	'#7f1535',
	'#620b65',
	'#510c54',
	'#39043b',
	'#2e0b2f'
);
 
 $site_lang = $this->config->item('language');
 $dir = $site_lang == "arabic" ? "rtl" : "ltr";
 
 $loop_num = 0;
 
foreach($winners as $winner)
{
	$count = $site_lang == "arabic" ? $this->common->arabic_numbers($loop_num + 1) . '- ' : $loop_num + 1 . '- ';
	$points = $site_lang == "arabic" ? $this->common->arabic_numbers($winner['points_count']) : $winner['points_count'];
	
	echo '<li class="dir" style="background-color:' . $ten_colors_array[$loop_num] . '">
		<table style="width: 100%">
			<tr>
				<td style="width: 70%; vertical-align: top;">' . $count . $winner['nestle_fit_health_name'] . '
				</td>
				<td style="vertical-align: top;">' . $points . ' ' . lang('globals_hmenu_point') . '
				</td>
			</tr>
		</table>
		</li>';
	$loop_num++;
}
 ?>
    </ul>
</div>
</div>
<p>
  <?php

$ten = $this->nestlefit->get_top_ten();

echo 'yo';
echo '<table>';
foreach($ten as $key => $user)
{
	echo '<tr>';
	foreach($user as $col => $row)
	{
		echo '<td>';
		echo $col . '-' . $row ;
		echo '</td>';
	}
	echo '</tr>';
}
echo '</table>';

?>
</p>
</div>
</div>


