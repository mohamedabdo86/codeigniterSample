<style>
#quiz_form
{
	width: 700px;
	margin: 0 11px;
}
.quiz_container li.question_container
{
	padding:10px 0;
	border-bottom-width:1px;
	border-bottom-style:solid;
}
.quiz_container li.question_container:last-child
{
	border-bottom-width:0;
}
.quiz_question
{
	font-size:20px;
}
.submit_button 
{
	-moz-box-shadow: inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow: inset 0px 1px 0px 0px #ffffff;
	box-shadow: inset 0px 1px 0px 0px #ffffff;
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #76cbde), color-stop(1, #2fa9c7) );
	background: -moz-linear-gradient( center top, #76cbde 5%, #2fa9c7 100% );
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#76cbde', endColorstr='#2fa9c7');
	background-color: #76cbde;
	-webkit-border-top-left-radius: 6px;
	-moz-border-radius-topleft: 6px;
	border-top-left-radius: 6px;
	-webkit-border-top-right-radius: 6px;
	-moz-border-radius-topright: 6px;
	border-top-right-radius: 6px;
	-webkit-border-bottom-right-radius: 6px;
	-moz-border-radius-bottomright: 6px;
	border-bottom-right-radius: 6px;
	-webkit-border-bottom-left-radius: 6px;
	-moz-border-radius-bottomleft: 6px;
	border-bottom-left-radius: 6px;
	border: 1px solid #dcdcdc;
	display: inline-block;
	color: #ffffff;
	padding: 5px 10px;
	font-size: 15px;
	font-weight: bold;
	line-height: 29px;
	cursor: pointer;
}
.submit_button:hover 
{
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #2fa9c7), color-stop(1, #76cbde) );
	background:-moz-linear-gradient( center top, #2fa9c7 5%, #76cbde 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#2fa9c7', endColorstr='#76cbde');
	background-color:#2fa9c7;
}
.submit_button:active 
{
	position:relative;
	top:1px;
}
.quiz_image
{
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
	margin:20px;
}
.input_form_text
{
	padding: 5px;
	border: none;
	background: rgba(226, 226, 226, 0.74);
}
body.arabic .form_container
{
	position: relative;
	width: 1050px;
	right: -315px;
}
.form_container
{
	position: relative;
	width: 1050px;
	left: -315px;
}
#ask_expert_question
{
	width: 948px;
	height: 120px;
	font-family:inherit;
}
#ask_expert_name
{
	width:455px;
}
#ask_expert_email
{
	width:466px;
}
#ask_expert_mobile
{
	width:255px;
}
.title_wrapper 
{
	width: 1050px;
	height: 45px;
	position: relative;
}
.title_wrapper .title_text
{
	line-height: 42px;
	text-indent: 42px;
}
.title_wrapper .shadow_left 
{
	position: absolute;
	bottom: -25px;
	left: 0px;
	width: 0px;
	height: 0px;
	border-style: solid;
	border-width: 25px 0 0 25px;
	border-color: #146478transparent transparent transparent;
}
.title_wrapper .shadow_right 
{
	position: absolute;
	bottom: -25px;
	right: 0px;
	width: 0px;
	height: 0px;
	border-style: solid;
	border-width: 25px 25px 0 0;
	border-color: #146478transparent transparent transparent;
}
</style>
<div class="clear"></div>

<?php echo $this->load->view('template/submenu_writer');   ?>

<?php echo $this->load->view('template/tree_menu_writer');   ?>

<div class="clear"></div>
<script>
$(document).ready(function(e) {
	
	$("#quiz_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();
		
		var question = $.trim($('#ask_expert_question').val());
		var name = $('#ask_expert_name').val();
		var email = $('#ask_expert_email').val();
		
		if( question == "" )
		{
			//$("#member_name_error").fadeIn("fast");
			$(".field_error").fadeIn("fast");
			state = false;
		}
		
		if( name == "" )
		{
			$(".field_error").fadeIn("fast");
			state = false;
		}
		if( email == "" )
		{
			$(".field_error").fadeIn("fast");
			state = false;
		}
		
		return state;

	});    
	
});

</script>

<div class="inner_title_wrapper" style=" margin-top:10px;">

<div class="sections_wrapper_margin">
<h1 class="<?php echo $current_section_color  ?>" style="font-size:24px;"><?php echo $display_data[0]['quizes_title'.$current_language_db_prefix];?></h1>
</div>

</div><!-- End of inner_title_wrapper -->
<div class="thick_line <?php echo $current_section_background_color; ?>" style="margin:0;"></div>

<div class="quiz_container global_background" style="width: 1000px;">


<div class="float_left">
	<img width="235" class="quiz_image" src="<?php echo base_url()."uploads/quizes/".$display_data[0]['images_src']?>"/>
</div>
<?php

$attributes = array('class' => 'direction float_right', 'id' => 'quiz_form');

echo form_open_multipart('best_time/life_coach_inner', $attributes);
 

echo form_hidden('current_id', $current_id);
echo form_hidden('display_data_image', $display_data[0]['images_src']);
?>
	<ul class="quiz_container <?php echo $current_section_borderbottom_color." ".$current_section_color  ?>">
    	<?php
		$display_array = '';
		
        for($i = 0; $i<sizeof($display_questions) ; $i++)
		{
			$display_array .= '<li class="question_container"><label for="quiz_question" class="quiz_question">'.($i+1)." - ".$display_questions[$i]['quizes_questions_title'.$current_language_db_prefix].'</label>';
			$display_array .= form_hidden('answer_hidden_question['.$i.']', $display_questions[$i]['quizes_questions_ID']);
			$display_array .= '<ul>';
			for($j = 0; $j<sizeof($display_answers) ; $j++)
			{
			     $display_array .=  '<label><input type="radio" class="radio_answer" name="answer_question['.$i.']" value="'.($j+1).'">'.$display_answers[$j]['quizes_answers_title'.$current_language_db_prefix].'</label><br>';
					//$display_answers[$j]['quizes_answers_ID']
			}
			
			$display_array .= '</ul>';
			$display_array .= '</li>';
		}
			echo $display_array;
		?>
	</ul>
    

    <div class="form_container">
        <div class="title_wrapper <?php echo $current_section_background_color; ?>">
            <div class="shadow_left"></div>
            <div class="title_text white_color"><?php echo lang('globals_titles_ask_an_expert');?></div>
            <div class="shadow_right"></div>
        </div>
    
    	<table style="margin: 0 38px;">
        	<tr>
            	<td width="50%"></td><td width="50%"></td>
            </tr>
            <tr>
                <td colspan="2"><textarea class="input_form_text textarea_class"  id="ask_expert_question" name="ask_expert_question" placeholder="<?php echo lang('globals_write_down_your_question_here'); ?>" ></textarea></td>
            </tr>
            <tr>
                <td><input class="input_form_text" id="ask_expert_name" placeholder="<?php echo lang('globals_form_name'); ?>"  type="text" name="ask_expert_name"  value="<?php echo set_value('ask_expert_name'); ?>"  /> </td>
                <td><input class="input_form_text" id="ask_expert_email" placeholder="<?php echo lang('globals_lform_email'); ?>"  type="text" name="ask_expert_email"  value="<?php echo set_value('ask_expert_email'); ?>"  /> </td>                
        	</tr>
            <tr>
            	<td colspan="2"><p class="field_error"><?php echo lang('besttime_field_required'); ?></p></td>
            </tr>
        </table>
        <div style="margin: 6px 48px;">
        	<div class="float_left">
                <p>
               <?php echo lang('besttime_will_be_answered');?>
                </p>
            </div>
            <div class="float_right">
            <?php 
				echo form_submit( 'submit', lang('globals_send') ,'class="submit_button" id="submit_form_button"' );
			?>
            
            </div>
            <div class="clear"></div>
        
        </div>
        
		
		<?php echo form_close(); ?>    
    

        </div>
        <div class="clear"></div>
 </div>

 
 <div class="clear"></div>
 <div class="global_sperator_height" style="width:100%"></div>
 
 
</div>