<?php
if(!$this->members->members_id)
{
	redirect(site_url('best_me/applications/9/homepage'), 'refresh');
}
?>
<style>
#top_ten_container {
	height:525px;
 	background-image:url(<?php echo base_url()."images/nestle_fit/top10.jpg";?>);
	background-repeat:no-repeat;
	background-position:center top;
	background-size:contain;
	position:relative;
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
#top_ten_container .main_title
{
	width: 610px;
    margin: 0 165px;
}
#top_ten_container .back_container
{
	float: left;
    width: 17px;
    height: 60px;
	position: relative;
    top: -52px;
    left: 120px;
}
.top_ten_dev_container 
{
	width:40%;
	margin: auto;
	margin-top:8px;
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
.text_winner{
	height:26px;
	margin-bottom:1px;
	padding: 1px;
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

<div id="top_ten_container">
    <div class="row header_col">
    <?php
    //Nestle Fit member Image, var1 = members_image, var2 = width, var3 = height
    echo '<div id="nestlefit_member_img_container" style="padding-top: 16px;">'.nestlefit_member_image($members_image,115,115).'</div>';
    ?>
    </div>
    <div class="main_title">
		<h3 class="title dir" style="height: 60px;text-align: center;"><?php echo lang('nestlefit_top_ten'); ?></h3>
		<div class="back_container">
           	<a class="back"  title="<?php echo lang('globals_back'); ?>" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>"><img alt="<?php echo lang('globals_back'); ?>" title="<?php echo lang('globals_back'); ?>" src="<?php echo base_url().'images/nestle_fit/back.png'; ?>" /></a>
    		<a class="back-title" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>">  <span><?php echo  lang("nestlefit_back_btn"); ?></span></a>
        </div>
    </div>

  <div class="top_ten_dev_container">
     <ul>
		<?php 


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
            <table style="width: 100%" class="text_winner">
                <tr>
                    <td style="width: 70%; vertical-align: top; text-transform:capitalize;">' . $count . $winner['nestle_fit_health_name'] . '
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


