<script>
	$(document).ready(function(e) {
			
			//$("#<?php // echo $answer_id; ?>").fadeIn();
			
			$(".ask_the_expert_all_questions li .question").click(function(e) {
                
				//Close ALl Answers 
				$(".ask_the_expert_all_questions li .answer").slideUp("fast");
				
				//Chek if current is already active
				if( $(this).parent("li").hasClass("expand")   )
				{
					$(".ask_the_expert_all_questions li").removeClass("expand");
					return false;
					
				}
				
				$(".ask_the_expert_all_questions li").removeClass("expand");
				
				
				
				//OPen Current
				var id = $(this).parent("li").data("id");
				
					$(".ask_the_expert_all_questions li[data-id="+id+"]").addClass("expand");
					$(".ask_the_expert_all_questions li[data-id="+id+"] .answer").slideDown("fast");
				
            });
			
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
			
			
			if(state==false){
				return false;
				}
			
	});
			///end//////
			
			
	});
</script>
<style>
.ballon_error {
	color: #FFF !important;
	display: none;
	font-size: 14px;
	line-height: 25px;
}
</style>

<div class="clear"></div>
<?php $this->load->view('template/submenu_writer');   ?>
<?php echo $this->load->view('template/tree_menu_writer');   ?>
<div class="clear"></div>
<div class="inner_title_wrapper">
  <div class="sections_wrapper_padding white_background_color" >
    <h1 class="<?php echo $current_section_color ?>"><?php echo $this->headers->get_third_title(); ?></h1>
  </div>
</div>
<!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>" style="margin-top:0px; margin-bottom:0px;"></div>
<img src="<?php echo $ask_an_expert_top_banner; ?>" />
<div class="clear"></div>
<div class="ask_an_expert_form_background"> <img src="<?php echo $ask_an_expert_form_background; ?>" />
  <div class="form_wrapper">
    <?php 
		//Prepare Form Fields
		$attributes = array('class' => '', 'id' => 'ask_form','name'=>'ask_form');
		echo form_open_multipart($this->router->class.'/ask_an_expert', $attributes); 
	?>
    <table   border="0" cellspacing="10" cellpadding="0" id="ask_an_expert_table_form">
      <tr>
        <th scope="row"><label for="ask_expert_email"><?php echo lang('globals_Write_down_your_email_address'); ?> <span class="required">*</span></label></th>
        <td><input class="text_bold" id="ask_expert_email" type="text" name="ask_expert_email"  value="<?php echo set_value('ask_expert_email'); ?>"  />
          <span id="ask_expert_email_error" class="ballon_error"><?php echo lang('globals_mail_validate');?></span> <span id="ask_expert_email_error2" class="ballon_error"><?php echo lang('globals_valid_mail');?></span> <?php echo form_error('ask_expert_email'); ?></td>
      </tr>
      <tr>
        <th scope="row"><label for="ask_expert_question"><?php echo lang('globals_write_down_your_question_here'); ?><span class="required">*</span></label></th>
        <td><textarea id="ask_expert_question"   name="ask_expert_question"  value="<?php echo set_value('ask_expert_question'); ?>" placeholder="<?php echo lang('globals_for_answer_and_question');?>"></textarea>
          <?php echo form_error('ask_expert_question'); ?> <span id="ask_expert_question_error" class="ballon_error"><?php echo lang('globals_question_validate');?></span></td>
      </tr>
    </table>
    <?php
    if ($this->uri->segment(4) === "success"){
		$lang    = $this->data['current_language_db_prefix'];
			if($lang == '_ar') {
				echo "<b style='color:white; font-size:16px; text-align:center; display:block;'>تم إرسال سؤالك بنجاح</b>";
			} else {
				echo "<b style='color:white; font-size:16px; text-align:center; display:block;'>Your question has been send</b>";				
			}
		
	}
	?>
    <input type="submit" class="ask_an_expert_submit_button" value="<?php echo lang("globals_send"); ?>" />
    <?php echo form_close(); ?> </div>
  <!-- End of form_wrapper --> 
  
  
  
  <!-- show message error to user when the ask send or not -->
  
  
  
  <?php

  	
  ?>
  
</div>
<!-- ENd of ask_an_expert_form_background -->

<div id="question_of_the_week_wrapper" >
  <h2 class="float_left <?php echo $current_section_color ?>"><?php echo lang('globals_last_questions'); ?></h2>
  <div class="clear"></div>
  <div class="ask_an_expert_bxslider_wrapper" >
    <div class="ask_an_expert_bxslider_inner_wrapper <?php echo $current_section_color ?>">
      <?php //if(!empty($display_all_questions)){ ?>
      <div style="width:100%; height:10px;"></div>
      <div id="slider">
        <ul>
          <?php
				$goto = "";
				$flag = 0;
				if($display_all_questions){
					
				
				for($i=0 ; $i < 3 ; $i++):
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
				
				if($id == $answer_id){
					$flag = 1;
					$goto = $i + 1;
				}
				?>
          <li>
            <div class="question_wrapper">
              <div class="question_wrapper_pre_image"></div>
              <?php
					$question_to_display = "";
					
						  $question_to_display = $question; 
					 
					 ?>
              <div class="question_text <?php echo is_arabic($question_to_display); ?>"><?php echo $question_to_display; ?></div>
              <div class="question_wrapper_post_image"></div>
            </div>
            <!-- End of question_wrapper -->
            
            <div class="answer_wrapper">
              <div class="pointing_arrow"></div>
              <?php
							$answer_to_display = "";
						
						 	$answer_to_display = $answer; 
						
							 ?>
              <div class="answer_inner_wrapper <?php echo is_arabic($answer_to_display); ?>"><?php echo $answer_to_display; ?> </div>
            </div>
            <!-- End of answer_wrapper -->
            <div class="clear"></div>
          </li>
          <?php
				endfor;
				}else{
					
				?>
          <div class="ask_an_expert_bxslider_inner_wrapper best_cook_color">
            <h2 style="position:relative;top:90px;text-align:center;"><?php echo lang('globals_ask_expert_no_questions'); ?></h2>
          </div>
          <?php
				}
				
				if(($flag == 0) && ($answer_id !="")){
					
					?>
          <li>
            <div class="question_wrapper">
              <div class="question_wrapper_pre_image"></div>
              <div class="question_text"><?php echo $answer_id_data[0]['ask_expert_question'.$current_language_db_prefix]; ?></div>
              <div class="question_wrapper_post_image"></div>
            </div>
            <!-- End of question_wrapper -->
            
            <div class="answer_wrapper">
              <div class="pointing_arrow"></div>
              <div class="answer_inner_wrapper">
                <?php
							if($answer_id_data[0]['ask_expert_answer'.$current_language_db_prefix] != ""){
							 echo $answer_id_data[0]['ask_expert_answer'.$current_language_db_prefix];
							}else{
								echo "<h2 style='margin-top:50px; text-align:center;font-size: 16px;'>".lang('globals_ask_expert_no_answer')."</h2>";
							}
							  ?>
              </div>
            </div>
            <!-- End of answer_wrapper -->
            <div class="clear"></div>
          </li>
          <?php
				}
				?>
        </ul>
        <script type="text/javascript" >
    		$(document).ready(function(){	
      	 	 var sudoSlider = $("#slider").sudoSlider({
            // Autoheight is on per default.
			
     	  });
		  <?php
		 	if(($answer_id == "") || ($flag == 0)){
			?>
			//Fix for the first item
			 sudoSlider.goToSlide("last");
			<?php		
			}else{
				?>
			//Fix for the first item
			 sudoSlider.goToSlide(<?php echo $goto; ?>);
	     <?php
			}
		  ?>
			
    		});
		</script> 
      </div>
      <!-- End of slider -->
      <div style="width:100%; height:10px;"></div>
      <?php /*?><?php }else{ ?>
                 <h1 style="text-align:center; padding-top:90px;"><?php echo lang('globals_ask_expert_no_questions'); ?></h1>
          <?php } ?>  <?php */?>
    </div>
    <!-- End of ask_an_expert_bxslider_inner_wrapper --> 
  </div>
  <!-- End of ask_an_expert_bxslider_wrapper --> 
  
</div>
<!-- ENd of question_of_the_week_wrapper  -->

<div class="global_sperator_height" style="width:100%;"></div>
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
      <div class="shapes_small_triangle_right <?php echo $current_section_color ?> float_left"></div>
      <div class="float_left global_sperator_width" style="height:10px;"></div>
      <?php
		$question_to_display = "";
		
	 		$question_to_display = $question; 
		
		 ?>
      <div class="float_left <?php echo is_arabic($question_to_display); ?>" style="width: 940px;"><?php echo $question_to_display; ?></div>
      <div class="clear"></div>
    </div>
    <!-- ENd of question -->
    
    <?php
	$answer_to_display ="";
	
	 $answer_to_display = $answer; 
	
	 ?>
    <div class="answer <?php echo is_arabic($answer_to_display); ?>" id="<?php echo $id ?>"> <span class="<?php echo $current_section_color ?>"><strong>&bull;</strong></span> <?php echo $answer_to_display ?> </div>
  </li>
  <?php
	endfor;
	}else{
	?>
  <div style="text-align:center;" class="post_ask_the_experts_lists_wrapper">
    <h2 style="position:relative;top:31px;text-align:center;"><?php echo lang('globals_ask_expert_no_questions'); ?></h2>
  </div>
  <?php
	}
	?>
</ul>
<div class="post_ask_the_experts_lists_wrapper"> </div>
<!-- ENd of post_ask_the_experts_lists_wrapper -->

<div class="page_navigation">
  <?php
echo $pagination_links;
?>
</div>
<div class="clear"></div>
<?php /*?><style>
<?php if(sizeof($display_all_questions) < 3){ ?>
.post_ask_the_experts_lists_wrapper{
	display:none;
}
<?php }elseif(empty($display_all_questions)){
?>
#slider{
	height: 150px !important;
	width:800px !important;
}
<?php
}?>
</style><?php */?>
