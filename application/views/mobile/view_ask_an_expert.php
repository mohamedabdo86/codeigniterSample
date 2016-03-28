<script>
$(document).ready(function(e) {
	//$("#<?php // echo $answer_id; ?>").fadeIn();
			
		/////////ashraf add it //////
  $("#ask_form").submit(function() {
	
	 $(".ballon_error").hide();
		var state = new Boolean();
		state = true;
	   <?php if($this->members->members_id==0){?>
		if (document.ask_form.ask_expert_email.value == "")
		{
			document.ask_form.ask_expert_email.focus();
			state = false;
			$("#ask_expert_email_error").fadeIn("fast");
		}
		
		 if (document.ask_form.ask_expert_email.value != "")
		{
			var mail=document.ask_form.ask_expert_email.value;
		  var atpos = mail.indexOf("@");
		  var dotpos = mail.lastIndexOf(".");
		   if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			state = false;
			$("#ask_expert_email_error2").fadeIn("fast");
		   }
		}
		
		<?php }?>
		
		if (document.ask_form.ask_expert_question.value == "")
		{
			document.ask_form.ask_expert_question.focus();
			state = false;
			$("#ask_expert_question_error").fadeIn("fast");			
		}
		
		if(state==false)
		{
			return false;
		}
			
	});
	///end//////			
});
</script>

<section class="<?php echo $current_section; ?>">

        <?php
        	echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png");
        ?>

    	<div class="row">
        	<div class="col-sm-12 col-xs-12">
        			<img class="img-responsive" style="width: 100%; margin-bottom: 20px;" alt="" src="<?php echo $ask_an_expert_top_banner; ?>">
        	</div>
        </div>
	    <div class="row">
        	<div class="col-sm-12 col-xs-12">
        		
        		<?php 
                        //Prepare Form Fields
                        $attributes = array('class' => '', 'id' => 'ask_form','name'=>'ask_form','data-ajax'=>'false');
                        
                        $mobile_prefix = $this->uri->segment(2) == 'mobile' ? 'mobile/' : '/' ;
                        
                        echo form_open_multipart($mobile_prefix . $this->router->class.'/ask_an_expert', $attributes); 
                 ?>
        		
                <div class="form-wrapper background-color border-radius-all">
                    <div class="form-container border-radius-all " style="height: auto !important;">
                 
                        <label for="ask_expert_email"><?php echo lang('globals_Write_down_your_email_address'); ?> <span class="required">*</span></label>
                  
                        	<input class="text_bold" id="ask_expert_email" type="text" name="ask_expert_email"  value="<?php echo set_value('ask_expert_email'); ?>"  />
                     		<span id="ask_expert_email_error" class="ballon_error"><?php echo lang('globals_mail_validate');?></span>
                     		<span id="ask_expert_email_error2" class="ballon_error"><?php echo lang('globals_valid_mail');?></span>
                        	<?php echo form_error('ask_expert_email'); ?>
                     
                              <label for="ask_expert_question"><?php echo lang('globals_write_down_your_question_here'); ?><span class="required">*</span></label>
                        
                        	<textarea id="ask_expert_question"  style="height:100px !important;" name="ask_expert_question"  value="<?php echo set_value('ask_expert_question'); ?>" placeholder=""></textarea>
                        	<?php echo form_error('ask_expert_question'); ?>
                          <span id="ask_expert_question_error" class="ballon_error"><?php echo lang('globals_question_validate');?></span>
                         
                    </div>
                </div>
                <p style="text-align: center;"><input class="background-color ask_an_expert_submit_button" type="submit" class="ask_an_expert_submit_button" value="<?php echo lang("globals_send"); ?>" /></p>
                <?php echo form_close(); ?>
                <?php
				if ($this->uri->segment(5) === "success")
				{
					$lang = $this->data['current_language_db_prefix'];
					if($lang == '_ar')
					{
						echo "<b style='font-size:16px; text-align:center; display:block;'>تم إرسال سؤالك بنجاح</b>";
					}
					else 
					{
						echo "<b style='font-size:16px; text-align:center; display:block;'>Your question has been send</b>";				
					}
				
				}
				?>                       
            </div>
        </div>


    

    	<div class="row">
        	<div class="col-sm-12 col-xs-12">
            	<h3 class="text-color"><?php echo lang('globals_last_questions'); ?></h3>
                <ul class="ask_the_expert_all_questions">
				<?php
                if(sizeof($display_all_questions) > 3){
                for($i=3; $i < sizeof($display_all_questions) ; $i++):
                $id = $display_all_questions[$i]['ask_expert_ID'];
                
                $question =  strip_tags($display_all_questions[$i]['ask_expert_question'.$current_language_db_prefix]);
                if($question == "")
                {
                    //Inverse Current language
                    if($current_language_db_prefix == "")
                    {
                        $question =  strip_tags($display_all_questions[$i]['ask_expert_question'.'_ar']);
                    }
                    if($current_language_db_prefix == "_ar")
                    {
                        $question =  strip_tags($display_all_questions[$i]['ask_expert_question'.'']);
                    }
                }
                
                
                $answer = strip_tags($display_all_questions[$i]['ask_expert_answer'.$current_language_db_prefix]);
                if($answer == "")
                {
                    //Inverse Current language
                    if($current_language_db_prefix == "")
                    {
                        $answer =  strip_tags($display_all_questions[$i]['ask_expert_answer'.'_ar']);
                    }
                    if($current_language_db_prefix == "_ar")
                    {
                        $answer =  strip_tags($display_all_questions[$i]['ask_expert_answer'.'']);
                    }
                }
                
                ?>
                <li data-id="<?php echo $id ?>"  class="" >
                <div class="question">        
                    <?php
                        $question_to_display = "";
                        $question_to_display = $question; 
                     ?>
                     <h5 class="float_left <?php echo is_arabic($question_to_display); ?>" style=" line-height: 20px;width: 100%">
                        <div class="small-triangle text-color float_left" style="margin: 0 5px;"></div>
                        <?php echo $question_to_display; ?>
                     </h5>
                    <div class="clear"></div>
                </div><!-- ENd of question -->
                
                <?php
                    $answer_to_display ="";	
                    $answer_to_display = $answer; 
                 ?>
                <div class="answer <?php echo is_arabic($answer_to_display); ?>" id="<?php echo $id ?>">
                	<p>
						<span class="text-color"><strong>&bull;</strong></span>
						<?php echo $answer_to_display ?>
                    </p>
                </div>
                </li>
                <?php
                endfor;
                }
				else
				{
                ?>
                <div style="text-align:center;" class="post_ask_the_experts_lists_wrapper">
                <h2 style="position:relative;top:31px;text-align:center;"><?php echo lang('globals_ask_expert_no_questions'); ?></h2>
                </div>
                <?php
                }
                ?>
            </ul>
                
            </div>
        </div>

</section>
<style>
label{
	color:white;
	margin: 5px;
  text-indent: 2px;
	}
.ask_an_expert_submit_button{
  border: medium none;
  padding: 3px 15px 10px;
  border-bottom-left-radius: 100%;
  border-bottom-right-radius: 100%;
  color: rgb(255, 255, 255);
  font-weight: bold;
  font-size: 1.4em;
}
@media (max-width:320px) {	
	 .main-section-homepage-title-wrapper h1{
	  margin-top: -25px;
	}
}
</style>