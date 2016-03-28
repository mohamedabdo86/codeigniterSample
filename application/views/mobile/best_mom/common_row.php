<!--hassan-->
<style type="text/css">
@media screen and (min-width: 200px) and (max-width: 640px) {
	.img_cls_icon
{
	padding:4px;
	list-style-type:none;
	margin-left: 20px;
	margin-right:-20px;
	margin-bottom:2px;
	background:#ffffff;
	-webkit-box-shadow: -4px 4px 2px -2px rgba(148,148,148,1);
	-moz-box-shadow: -4px 4px 2px -2px rgba(148,148,148,1);
	box-shadow: -4px 4px 2px -2px rgba(148,148,148,1);
	border-radius:5px;

}
.email_content{
	background:#ececec;min-height:180px;padding-top:1px;
	}
.cont_div{
	width:288px;background:#FFF;height:367px; padding:10px;
	
	}
	.popip_title{
	display: inline;float: left;margin:10px 0 0 49px;font-size: 16px;
	}
	}
	@media screen and (min-width: 641px) and (max-width: 990px) {
	.img_cls_icon
{
	padding:4px;
	list-style-type:none;
	margin-left: 20px;
	margin-right:-20px;
	margin-bottom:2px;
	background:#ffffff;
	-webkit-box-shadow: -4px 4px 2px -2px rgba(148,148,148,1);
	-moz-box-shadow: -4px 4px 2px -2px rgba(148,148,148,1);
	box-shadow: -4px 4px 2px -2px rgba(148,148,148,1);
	border-radius:5px;
	
}
.email_content{
	background:#ececec;min-height:180px;padding-top:1px;
	}
.cont_div{
	width:325px;background:#FFF;height:350px;padding:10px;
	
	}
	.newsletter_service{
	margin: -10px -10px -4px 116px;
	}
	.popip_title{
	display: inline;
	float: left;
	margin:10px 0px 0px 20%;
	font-size: 16px;
	}
	}

@media screen and (min-width: 991px) and (max-width: 1500px) {
.img_cls_icon {
  padding: 25px;
  list-style-type: none;
  background: #ffffff;
  margin: 22px -20px 0 20px;
  -webkit-box-shadow: -4px 4px 2px -2px rgba(148,148,148,1);
  -moz-box-shadow: -4px 4px 2px -2px rgba(148,148,148,1);
  box-shadow: -4px 4px 2px -2px rgba(148,148,148,1);
  border-radius: 5px;
  height: 136px;}
.cont_div{
	width:400px;background:#FFF;min-height:350px;
	padding:10px;
	}.email_content{
	background:#ececec;min-height:250px;padding-top:1px;
	}
	.popip_title{
	display: inline;float: left;margin:10px 0 0 133px;font-size: 16px;
	}
	}
.english .newsletter_service{
	margin: -10px 8px 10px -10px;
    }
.newsletter_service{
	margin: -10px -10px 10px 116px;
	background: #ccc;
	padding: 10px;
	-webkit-border-bottom-right-radius: 10px;
	-webkit-border-bottom-left-radius: 10px;
	-moz-border-radius-bottomright: 10px;
	-moz-border-radius-bottomleft: 10px;
	border-bottom-right-radius: 10px;
	border-bottom-left-radius: 10px;
	color: #fff;
	text-align: center;
<?php
	if($current_language_db_prefix != "_ar"){
	?>
	border-bottom-left-radius: 0px;
	border-bottom-right-radius: 12px;
	<?php
}
?>

}
#newsletter_loadable_message
{
	white-space:normal;
}
.english .ul_babyMonth{
	margin-right: 74px;
	}
.title_newsletter{
    float: right;
	margin:10px -40px 25px 0;
	font-size: 16px;
	list-style:none;
	}
.english .title_newsletter{
	float: left;
    margin: 10px -42px 25px -43px;
	font-size: 16px;	
	}
	.error {
    color:red;
}
#invaild_email{
color: red;
font-size: 13px;
margin-bottom: -4px;
	}
@media screen and (width: 1280px) {
	.email_content{
	min-height:305px;
	}
}
</style>
<?php $this->lang->load('newsletter'); ?>
  <script type="text/javascript">
            var invaild = 0;
            function validation() {
                invaild = 0;

                // email validation
                if((document.getElementById('newsletter_email').value.indexOf("@")) == -1){
                    document.getElementById("invaild_email").innerHTML = "<?php echo lang('newsletter_validate_email_format') ?>";
					document.getElementById("newsletter_email").style.borderColor = "red";
                    invaild += 1;
                }
				   if(document.getElementById('baby_month').value == ""){
                   document.getElementById("invaild_selection").innerHTML = "<?php echo lang('newsletter_validate_email_format') ?>";
					document.getElementById("baby_month").style.borderColor = "red";
                    invaild += 1;
                }
                if (invaild != 0) {
                    return false;
                } else {
                    return true;
                }

            }
   </script>

<!--<div class="container" >-->
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <?php $this->mwidgets->ask_an_expert(179,$current_section_color,$current_language_db_prefix,$ask_an_expert_top_banner);?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <div class="section-title-wrapper">
            <h2  class="text-color"><?php echo lang('bestmom_news_letter_signup'); ?></h2>
        </div>
        <div class="email_content">
          <h3 style="font-size: 1.3vw;padding: 0 10px;}"><?php echo lang("bestmom_news_letter_signup_desc"); ?></h3>
          
    <center>
    <ul class="ul_babyMonth">
    
              <?php

			for($i = 0 ; $i < sizeof($display_newsletter) ; $i++):?>
            <?php
			$id = $display_newsletter[$i]['newsletter_types_ID'];
			$title = $display_newsletter[$i]['newsletter_types_title'.$current_language_db_prefix];
			//$image =  base_url()."images/icons/".$display_newsletter[$i]['images_src'];
		$image =  base_url()."uploads/icons/".$this->globalmodel->get_image_src($display_newsletter[$i]['newsletter_types_image']);
		
		?>
            <div class="col-xs-6 col-sm-6 col-md-6">
          
   <?php if ($id <> 8 ){?><a href="#externalpage<?php echo $id; ?>" data-rel="popup"><?php } ?>
   <?php if ($id == 8) { ?><a href="<?php echo site_url_mobile("newsletter/add_to_newsletter/8"); ?>" data-rel="popup" target="_blank"><?php }?> 
   <li class="img_cls_icon">
     <img width="60" height="60" style="border:none" src="<?php echo $image; ?>" />
    <p style="font-size: 11px;font-weight: bold;color: #eac129;"><?php echo $title;?></p>
    </li>
    <?php if ($id <> 8) { ?></a><?php } ?>
    <?php if ($id == 8) { ?></a><?php }?>
    </div>
<div data-position-to="window" data-role="popup" id="externalpage<?php echo $id; ?>">
<div class="cont_div">
            <h2 class="newsletter_service float_left" ><?php echo lang('newsletter_service'); ?></h2>
            <div style="clear:both;"></div>
            <form name="newsletter_add_email" onSubmit="return validation()" id="newsletter_add_email"  method="post" action="<?php echo site_url_mobile("newsletter/add_data_action"); ?>">
            <ul>
            <li class="title_newsletter"><?php echo lang("newsletter_title"); ?></li>
            <li class="popip_title"><?php echo $title ?> </li>
            </ul>
            <div style="clear:both;"></div>
             <div data-role="fieldcontain">
            <label for="newsletter_email"><em style="color:red;">* </em> <?php echo lang("newsletter_enter_email"); ?> </label>
            <input type="text" name="newsletter_email" id="newsletter_email" />
            <p id="invaild_email"></p>
            </div>
           <div data-role="fieldcontain">
            <label for="newsletter_email"><em style="color:red;">* </em> <?php echo lang('newsletter_pregnancy_month'); ?> </label>
            <select name="baby_month" id="baby_month"  />
            <?php for($j=0 ; $j<=8; $j++):?>

            <?php echo '<option value="'.($j+1).'" >'.($j+1).'</option>';?>
            <?php endfor; ?>
            </select>
            
            </div>
          <input type="hidden" name="newsletter_type" value="<?php echo $id; ?>"/>
          <!--  <input type="submit"  value="<?php // echo lang('newsletter_send_button'); ?>" />-->
          <button name="submit" type="submit" ><?php echo lang('newsletter_send_button'); ?></button>
         
            </form>   
</div>
</div> 
        <?php
			endfor;
			?>   
    </ul>
    </center>
    </div>
        </div>
      <!-- End of newsletter_signin --> 
    </div>
  <!-- row --> 
<!--</div>-->
<!-- container -->