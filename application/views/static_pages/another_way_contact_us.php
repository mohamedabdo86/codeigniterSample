<style>
#another_contact_list
{
	width: 880px;
	margin: 20px;
}
#another_contact_list li.content
{
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	border-radius: 20px;
	margin:10px;
	width:420px;
	height:168px;
}

#another_contact_list li.small_content
{
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	border-radius: 20px;
	margin:10px;
	width:420px;
	height:60px;
}

#another_contact_list li.content .icon
{
	width:95px;
	height:168px;
	line-height:168px
}
#another_contact_list li.content .icon img
{
	vertical-align:middle;
}
#another_contact_list li.content .separator
{
	width:2px;
	height:143px;
	background-color:#FFF;
	margin-top:13px;
	
}
#another_contact_list li.small_content .separator
{
	width: 2px;
	height: 45px;
	background-color: #FFF;
	margin-top: 8px;
	
}
#another_contact_list li.content .text_area
{
	width:323px;
	height:168px;
}
#another_contact_list li.content .text_area .content_title
{
	font-weight:bold;
	font-size:20px;
	color:#FFF;
	text-align:center;
	line-height:35px;
}
#another_contact_list li.content .text_area .content_subtitle
{
	font-size:18px;
	color:#FFF;
	text-align:center;
	line-height:45px;
}
#another_contact_list li.content .text_area .content_desc
{
	color:#FFF;
	padding: 0px 14px;
	white-space: normal;
}
.contact_us_link{font-size:16px;}
</style>
<div class="various_title_videos terms_conditions_background_color" style="height: 40px;position: relative;width: 110.2%;margin-left: -47px;margin-top: 15px;">
	<div class="sections_wrapper_margin">
		<div class="title float_left" style=" line-height:39px; color: white;font-size: 24px;"><?php echo lang('contactus_contact_others'); ?></div>
    </div>
    <img width="26" style="position:absolute; left:0; top:40px;" src="<?php echo base_url()?>images/best_time_left_shadow.png">
    <img width="26" style="position:absolute; right:0; top:40px;" src="<?php echo base_url()?>images/best_time_right_shadow.png">
</div>
<ul id="another_contact_list">
	<li class="float_left dir content" style="background:#F10D93 !important;">
    	<div class="float_left icon">
        	<img src="<?php echo base_url();?>images/contactus/contact_us_experts.png" />
        </div>
        <div class="float_left separator"></div>
        <div class="float_left text_area">
        	<h3 class="content_title"><?php echo lang('contactus_nestle_experts'); ?></h3>
            <p class="content_desc" style="
            <?php
			if($current_language_db_prefix == '_ar')
			{
				echo 'font-size: 14px;';
			}
			else
			{
				echo 'font-size: 12px;padding-right: 0;line-height: 19px;';
			}
			?>
            ">
				<?php
					if($current_language_db_prefix == '_ar')
					{
						echo $static_desc[1]['static_text_ar'];
					}
					else
					{
						echo $static_desc[1]['static_text'];
					}
				?><br />
                <a href="mailto:nestle.cooking-expert@eg.nestle.com"><?php echo $static_desc[1]['static_mail'];?></a><br />
            	<?php
				    if($current_language_db_prefix == '_ar')
					{
						echo $static_desc[3]['static_text_ar'];
					}
					else
					{
						echo $static_desc[3]['static_text'];
					}
				?><br />
                <a href="mailto:nestle.childdevelopment-expert@eg.nestle.com"><?php echo $static_desc[3]['static_mail'];?></a><br />
                <?php 
					if($current_language_db_prefix == '_ar')
					{
						echo $static_desc[2]['static_text_ar'];
					}
					else
					{
						echo $static_desc[2]['static_text'];
					}
				?><br />
                <a href="mailto:nestle.nutrition-expert@eg.nestle.com"><?php echo $static_desc[2]['static_mail'];?></a>
            </p>

        </div>
        <div class="clear"></div>
    </li>
    
    <li class="float_left dir content" style="background:#FEA610 !important;">
     	<div class="float_right icon">
                <img src="<?php echo base_url();?>images/contactus/contact_us_phone.png" />
        </div>
        <div class="float_right separator"></div>
        <div class="float_left text_area">
	        <h3 style=" line-height:40px; font-size: 60px !important; font-weight: bold; margin-top: 55px;" class="content_title english_font">
            <?php
        
				echo '16180';
		
			?>
            </h3>
             <h4 style="font-weight:bold;" class="content_subtitle">
            <?php echo lang('contactus_hotline_details'); ?><br />              
            </h4>
        </div>
        <div class="clear"></div>
    </li>
    
    <li class="float_left dir small_content" style="background:#4560a1 !important;">
        <div class="float_left icon">
                <a target="_blank" href="https://www.facebook.com/NestleEgypt"><img width="60" height="60" src="<?php echo base_url();?>images/contactus/contact_us_facebook.png" /></a>
        </div>
        <div class="float_left separator"></div>
        <div class="float_left text_area">
        	<h3 class="content_title" style="margin: 20px 40px; color: #FFF;"><a target="_blank" class="english_font contact_us_link" href="https://www.facebook.com/NestleEgypt">www.facebook.com/NestleEgypt</a></h3>
            <?php /*?><p class="content_desc" style="font-size: 27px;margin-top: 23px;text-align: left;line-height: 30px;direction: ltr;"><a target="_blank" class="english_font contact_us_link" href="https://www.facebook.com/NestleEgypt">www.facebook.com/<br />NestleEgypt</a></p><?php */?>
        </div>
        <div class="clear"></div>
    </li>
    
    <li class="float_left dir small_content" style="background:#ACC72F !important;">
     	<div class="float_right icon">
                <a style="border:none;" href="mailto:Consumer.services@eg.nestle.com"><img style="margin:-15px 0px;" src="<?php echo base_url();?>images/contactus/contact_us_mail.png" /></a>
        </div>
        <div class="float_right separator"></div>
        <div class="float_left text_area">
	        <h3 class="english_font content_title" style="margin:<?php if($current_language_db_prefix == '_ar'){echo "-55px";}else{echo "-55px";} ?>  28px; color: #FFF;"><a class="english_font contact_us_link" href="mailto:Consumer.services@eg.nestle.com">Consumer.services@eg.nestle.com</a></h3>
            <!--<p class="content_desc" style="font-size: 27px;margin-top: 23px;text-align: left;line-height: 30px;direction: ltr;"><a class="english_font contact_us_link" href="mailto:Consumer.services@eg.nestle.com">Consumer.services@eg.nestle.com</a></p>-->
        </div>
        <div class="clear"></div>
    </li>
    
</ul>
<div class="clear"></div>




