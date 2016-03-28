
<?php $num_4 = 4;
if($current_language_db_prefix == "_ar")
{
$num_4 = $this->common->arabic_numbers($num_4);
}
?>
<h5 style"clear: both;" id="step_4"><span><?php echo $num_4; ?></span><label class="mandat"> *</label><?php echo lang('contactus_contact_way'); ?></h5>
<div id="contact_method" class="contact_us_section">
        <div class="row">
        <div id='radio_reason' class='float_left radio_dir col-xs-12 col-sm-6 col-md-6'>
		<label style='font-size:20px;' class='label_reason'>
		<?php echo $display_respond[4]; ?>
		</label>
        <input type='checkbox' class='respond_4 float_right' name='respond_ID' value='4' id='respond_ID respond_1'  checked='checked'/>
        </div>
        <div id='radio_reason' class='float_left radio_dir col-xs-12 col-md-6 col-sm-6'>
        
			<label style='font-size:20px;' class='label_reason'>
			<?php echo $display_respond[2]; ?>
            </label>
			<input type='checkbox' class='respond_2 float_right' name='respond_ID[]' value='2' id='respond_ID respond_2'/>
            	<div id='telephone_radio' class='input_radio radio_dir col-xs-12 col-md-6 col-sm-6' style="width:100%;margin-top:5px;">
			<div id="contactus_phone" class="contact_mail_tel" style="width:90%;">         
            <h3 class="font_size_17" id="egyptnumber">+20</h3>
			<input type="text" onkeypress="return isNumberKey(event)" maxlength="10" name="telephone_respond"  id="telephone_respond" class="radio_input_text font_size_17 telephone_radio" />
            <p class="telephone_error_2" style="font-weight:bold;"><?php echo lang('contactus_phone_error'); ?></p>
			</div>
		</div>
            
		</div>
        
        </div>
        <div class="row">
   
		<div id='radio_reason' class='radio_dir col-xs-12 col-md-6 col-sm-6 float_left'>
        
			<label style='font-size:20px;' class='label_reason'>
			<?php echo $display_respond[3]; ?>
            </label>
			<input type='checkbox' class='respond_3 float_right' name='respond_ID[]' value='3' id='respond_ID respond_3'/>
            	<div id='email_radio' class=' input_radio radio_dir col-xs-12 col-sm-6 col-md-6' style="width:100%;margin-top:5px;">
			<div id="contactus_email" class="contact_mail_tel" style="width:90%;">
            <h3 class="font_size_17" id="egyptnumber">+20</h3>
			<input type="text" name="email_respond" class="radio_input_text font_size_17 email_radio" id="email_respond" />
			<p class="email_error_2" style="font-weight:bold;"><?php echo lang('contactus_email_error'); ?></p>
            <p class="email_error_format_2" style="font-weight:bold; display:none;"><?php echo lang('contactus_email_format_error'); ?></p>
			</div>
        </div>
		</div>

    		<div id='radio_reason' class='float_left radio_dir col-xs-12 col-sm-6 col-md-6'>
        
		<label style='font-size:17px;' class='label_reason'>
	 		<?php	$data = array(
						'ID' => 'checkapprove',
						'name' => 'checkapprove',
						'class' => 'checkbox_approve float_left',
						); 
					echo form_checkbox($data);
					
    echo "<span class='optiontxt float_left '>" .lang('contactus_privacy_agree')."</span> <br/>
        <p id='checkapprove_error' style='display:none; color:#F00;font-weight:bold;'>" .lang('contactus_priviacy_link')."</p>";
    echo "<input type='checkbox' class='respond_3 col-sm-6 col-md-6 checkbox_approve float_left' name='checkapprove' value='' id='respond_ID respond_3 checkapprove'/>"; ?>
		</label>
		</div>
        </div>
  
   <input type="submit" name="submit" onclick="_gaq.push(['_nesglobalhqtag._trackEvent','Contact Us Form','Successful Submission','EGYPT']); _gaq.push(['_trackEvent','Contact Us Form','Successful Submission','EGYPT']);" id="contact_us_submit" value="<?php echo lang('contact_us_send'); ?>" class="float_right submit_button reason_next">
</div>