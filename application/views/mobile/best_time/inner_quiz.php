<style>
.thick_line
{
	width: 100%;
  height: 4px;
    background: #13758e;
}
.ballon_error_quiz 
{
	display:none;
	color:red;
	font-size:18px;
}

.quiz_question
{
	font-size:20px;
}
.submit_button {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #76cbde), color-stop(1, #2fa9c7) );
	background:-moz-linear-gradient( center top, #76cbde 5%, #2fa9c7 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#76cbde', endColorstr='#2fa9c7');
	background-color:#76cbde;
	-webkit-border-top-left-radius:6px;
	-moz-border-radius-topleft:6px;
	border-top-left-radius:6px;
	-webkit-border-top-right-radius:6px;
	-moz-border-radius-topright:6px;
	border-top-right-radius:6px;
	-webkit-border-bottom-right-radius:6px;
	-moz-border-radius-bottomright:6px;
	border-bottom-right-radius:6px;
	-webkit-border-bottom-left-radius:6px;
	-moz-border-radius-bottomleft:6px;
	border-bottom-left-radius:6px;
	text-indent:0;
	border:1px solid #dcdcdc;
	display:inline-block;
	color:#ffffff;
	padding:5px 10px;
	font-size:15px;
	font-weight:bold;
	font-style:normal;
	line-height:32px;
	text-decoration:none;
	text-align:center;
	cursor:pointer;
}
.submit_button:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #2fa9c7), color-stop(1, #76cbde) );
	background:-moz-linear-gradient( center top, #2fa9c7 5%, #76cbde 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#2fa9c7', endColorstr='#76cbde');
	background-color:#2fa9c7;
}
</style>

<script>
$(document).ready(function(e) {
	$('#other_quizes').hide();
	
	var id = '<?php echo $current_id; ?>';

    $('form#quiz_form').submit(function(e) {

 		//$(".ballon_error").hide();
		var state = new Boolean();
		state = true;
		
		for(i=0; i< <?php echo sizeof($display_questions); ?>;i++)
		 {
			 if (!$("input[name='answer_question["+i+"]']:checked").val())
			 {
				 $(".ballon_error_quiz").show();
				 return false;
			 }
			 
	     }
		  
		if(state == true) 
		{
			 $(".ballon_error_quiz").hide();
			 var form = $(this);
			 $.ajax({
				url : "<?php echo site_url_mobile($this->router->class."/quiz_result/".$current_id); ?>",
				data : form.serialize(),
				type: "POST",
				cache: false,
				dataType: "json",
				success : function(success_array){
				   $('.result').html(success_array.result) ;
				   $('#submit_form_button').hide();
				   $('#other_quizes').fadeIn('fast');
					//$(comment).hide().insertBefore('#insertbeforMe').slideDown('slow');
				}
			})
			return false;
		 }
    });
});
</script>
 	<section class="<?php echo $current_section; ?>">
  
          <?php   echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png" , site_url_mobile(''.$this->router->class));?>

	<div class="row">
    	<div class="col-md-12 col-sm-12 col-xs-12">
		<h1 class="float_left" style="font-size:25px; color:#13758e;"><?php echo $display_data[0]['quizes_title'.$current_language_db_prefix];?></h1>
    </div>
    </div>
    <div class="row">
    	<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="thick_line row"></div>
 </div>
    </div>


 <div class="row">
    	<div class="col-md-4 col-sm-4 col-xs-12 float_left">
<img class="img-responsive" width="100%" style="margin-top:10px;" src="<?php echo base_url()."uploads/quizes/".$display_data[0]['images_src']?>"/>

</div>
<div class="col-md-8 col-sm-8 col-xs-12 float_left">

<?php
	$attributes = array('class' => 'direction', 'id' => 'quiz_form');
	echo form_open_multipart('', $attributes);
	echo form_hidden('current_id', $current_id);
	echo form_hidden('display_data_image', $display_data[0]['images_src']);
?>
<input type="hidden" name="answer_id" value="0" id="current_answer_id" />
	
	<div class="quiz_container <?php echo $current_section_borderbottom_color." ".$current_section_color  ?>">
    	<?php
			$display_array = '';		
				for($i = 0; $i<sizeof($display_questions) ; $i++)
				{
					$display_array .= '<div class="question_container" style="border-bottom-width:2px;border-bottom-style:solid;padding:10px 0;"><label for="quiz_question" class="quiz_question">'.($i+1)." - ".$display_questions[$i]['quizes_questions_title'.$current_language_db_prefix].'</label>';
					$display_array .= form_hidden('answer_hidden_question['.$i.']', $display_questions[$i]['quizes_questions_ID']);
					$display_array .= '<div>';
					$display_answers = $this->quizesmodel->get_answers($display_questions[$i]['quizes_questions_ID']);
					for($j = 0; $j<sizeof($display_answers) ; $j++)
					{
						$display_array .=  '<label><input type="radio"  id="question_'.$i.'" class="radio_answer" name="answer_question['.$i.']" value="'.$display_answers[$j]['quizes_answers_quizes_unique_value_ID'].'">'.$display_answers[$j]['quizes_answers_title'.$current_language_db_prefix].'</label><br>';
					}
					$display_array .= '</div>';
					$display_array .= '</div>';
				}
				echo $display_array;
		?>
	</div>
        
    </div>
    </div> 
	<div align="center">
	<?php 
		echo form_submit( 'submit', lang('globals_results') ,'class="submit_button" id="submit_form_button"' );
	?>
	<p class="ballon_error_quiz"> <?php echo lang('quize_error');?></p>
	</div>
	<?php echo form_close(); ?>	 
<div class="result"></div>
<?php /*?><div id="other_quizes">
	<?php if (sizeof($display_all_quizes)>1){?>
		<div class="sections_wrapper_margin" style="line-height: 40px;">
		<h1 class="<?php echo $current_section_color; ?>"><?php echo lang('besttime_other_quizes') ?></h1>
		</div>
	<?php } ?>
	<div class="thick_line <?php echo $current_section_background_color; ?>"></div>
		<ul class="lists_of_image_grids li_third content">
			<?php
				for($i=0 ; $i < sizeof($display_all_quizes) ; $i ++):
				$title = $display_all_quizes[$i]['quizes_title'.$current_language_db_prefix];   
				$short_title = mb_substr(strip_tags($title), 0, 50, 'UTF-8'). (strlen(strip_tags($title)) > 50?'...':'');  
				$image  = base_url()."uploads/quizes/thumb_".$display_all_quizes[$i]['images_src'];   
				$url = site_url_mobile($this->router->class."/".$this->router->method."/". $display_all_quizes[$i]['quizes_ID']);
			?>
			<li class="float_left">
				<div class="image" style="height:166px; "><a href="<?php echo $url;?>"><img src="<?php echo $image; ?>" /></a></div>
				<div class="title float_left dark_gray" style="position: absolute;top: 132px;">
				<div style="margin:0 5px;"><a href="<?php echo $url ?>"><?php echo $short_title;?></a></div>
				</div>
			</li>
			<?php
				endfor;
			?>  
		</ul>
</div><?php */?>

 
 
