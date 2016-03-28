<style>

@media (max-width: 768px)
{
	.second_way{
      padding: 30px 50px !important;
     }
	.div_contact_us {
    height: auto;
	font-size: 12px;
	}
	
	.contact_us_mail_facebook
	{
		height:auto !important;
		font-size:12px
	}
	
	.content_title, .contact_us_links, .links_contact, .text contact_us_links
	{
		font-size:12px !important
	}
	
	.links_contact
	{
		margin-top: 8%;
		padding: 0px;
	}
	
	.floating-img
	{
		max-width: 18%;
	}
}
@media (max-width: 320px){
	.second_way{
      padding: 30px 40px !important;
     }
	
	}
.separator {
    width: 2px;
    height: 100%;
    background-color: #FFF;
    margin-top: 13px;
}

</style>

    <div class="row" style="margin-top:15px;">
			<div class="col-xs-12 col-sm-6 col-lg-6 col-md-6">
				<div style="background:#F10D93 !important;" class="div_contact_us">
					<div class="first_way" style="padding:25px;">
					<div class="icon" style="height:60px;">
                        <img src="<?php echo base_url(); ?>images/contactus/contact_us_experts.png" class="float_left img_responsive" />
                         <h3 class="content_title contact_us_links float_right" style="font-size:20px; margin-top:10px;"><?php echo lang('contactus_nestle_experts'); ?></h3>
                    </div>
                    <div class="text contact_us_links" style="text-align:center; width:90%; font-size:18px;"> 
                       
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
                            <a href="mailto:nestle.cooking-expert@eg.nestle.com"><?php echo $static_desc[1]['static_mail']; ?></a><br />
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
                            <a href="mailto:nestle.childdevelopment-expert@eg.nestle.com"><?php echo $static_desc[3]['static_mail']; ?></a><br />
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
                            <a href="mailto:nestle.nutrition-expert@eg.nestle.com"><?php echo $static_desc[2]['static_mail']; ?></a>
                        </p>
                    </div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-lg-6">
				<div style="background:#FEA610 !important;" class="div_contact_us">
					<div class="second_way" style="padding: 61px 50px;">
                    <div class="icon" style="height:60px;">
                        <img src="<?php echo base_url(); ?>images/contactus/contact_us_phone.png" class="float_left img_responsive"/>
                        
                     <h1 class="contact_us_links" style="font-size: 46px !important; margin-top:10px;">16180</h1>
                    </div>
                    <div class="text" style="text-align:center; width:100%; margin-top:34px;"> 
                        
                        <h4 style="font-weight:bold; font-size: 22px !important" class="content_subtitle contact_us_links">
                            <?php echo lang('contactus_hotline_details'); ?><br />              
                        </h4>
                    </div>
					</div>
				</div>
			</div>
	</div>
	<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="row contact_us_mail_facebook" style="padding:7px; height:110px;background:#4560a1 !important;border-radius: 40px; margin: 5px;">
				<div class="col-xs-12">
                
                	<a href="https://www.facebook.com/NestleEgypt"><img src="<?php echo base_url(); ?>images/contactus/contact_us_facebook.png" class="img-responsive float floating-img"/></a>
                	
                
                <h3 class="content_title contact_us_links links_contact"><a target="_blank" class="" href="https://www.facebook.com/NestleEgypt">www.facebook.com/NestleEgypt</a></h3></div>
				</div>
                </div>
			
				<div class="col-xs-12 col-sm-6 col-md-6 dir content contact_us_mail_facebook">
				<div class="col-xs-12" style="margin-top:22px; padding:5px 10px; background:#ACC72F !important;border-radius: 40px; margin: 5px;"><a href="mailto:Consumer.services@eg.nestle.com"><img src="<?php echo base_url(); ?>images/contactus/contact_us_mail.png" style="margin-top: 0px;" class="img-responsive float floating-img"/></a>
                
                <h3 class="content_title contact_us_links links_contact"><a target="_blank"  href="mailto:Consumer.services@eg.nestle.com">Consumer.services@eg.nestle.com</a></h3></div>
				</div>

				</div>
