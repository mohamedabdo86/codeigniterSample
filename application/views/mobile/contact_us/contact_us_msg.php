<style>
#status_image_wrapper{
visibility: hidden;	
	}
</style>
<?php
$num_2 = 2;
if ($current_language_db_prefix == "_ar") {
    $num_2 = $this->common->arabic_numbers($num_2);
}
?>
<div class="contact_us_link" id="step_2">
    <h5><span><?php echo $num_2; ?></span><label class="mandat"> *</label>  <?php echo lang('contactus_your_msg'); ?> </h5>
</div>
<div id="contact_message">
    <div class="form-group" id="scenario_1">
        <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
            <textarea id="contact_message_textarea_1" rows="6" cols="10" name="yourmsg_1" class="yourmsg_1"></textarea>
          
            <p class="float_left contact_message_textarea_1_error_message"  style="margin: 0px 15px; color: #F00;font-weight:bold;"><?php echo lang('bestcook_field_required'); ?></p>
        </div>
    </div>

    <div class="form-group" id="scenario_2">

        <div class="float_right col-xs-12 col-md-6 col-sm-6 col-lg-6">
            <textarea id="contact_message_textarea_2" rows="6" cols="10" name="yourmsg_2" class="yourmsg_2 float_right"></textarea>
            <p class="float_left contact_message_textarea_2_error_message" style="margin: 3px -110px; color: #F00;font-weight:bold;"><?php echo lang('bestcook_field_required'); ?></p>
        </div>

        <div class="float_left col-xs-12 col-md-6 col-sm-6 col-lg-6">
            <?php
           // $data = array('type' => 'hidden', 'name' => 'image_uploaded_name', 'value' => '', 'id' => 'image_uploaded_name','class'=>'form-group');
            //echo form_input($data);
            ?>
          <div id="product_name">
            <h3 class="float_left" style="line-height: 30px;"><?php echo lang('contactus_inquire_product'); ?></h3>
            <?php
            //array_unshift($display_product, "  .....  "); //lang('contactus_inquire_product')
			$newoptions = array('0' => '.....') + $display_product;
            echo form_dropdown('product_ID', $newoptions, set_value('product_ID'), 'class="drop_down_style float_left optiontxt dir form-group" id="product_ID"');
            ?>
          </div>
          <div id="product_num"> 
            <h3 class="float_left"><?php if ($current_language_db_prefix == "_ar") { ?>
                    <?php echo lang('contactus_product_code'); ?> <a id="hover_code" href="#" > <img width="22" height="22" style="margin-bottom: -6px;" src="<?php echo base_url(); ?>images/contactus/help_black<?php echo $current_language_db_prefix; ?>.png" /> </a>
                <?php } else { ?>
                    <a id="hover_code" href="#" style="float:right;"> <img width="27" height="25" style="margin-bottom: -6px;" src="<?php echo base_url(); ?>images/contactus/help_black<?php echo $current_language_db_prefix; ?>.png" /> </a> <?php echo lang('contactus_product_code'); ?>
                <?php } ?></h3>
            <input title="<?php echo lang('contacus_product_code_example'); ?>" placeholder="<?php echo lang('contacus_product_code_example'); ?>" type="text" class="drop_down_style font_size_17 float_left" style="font-size:11px;" id="code_montag" name="code_montag" dir="ltr"/> 
            <?php //if($current_language_db_prefix != "_ar"){echo "<br/>";}   ?>
          </div>  
        </div>

        <div class="clear"></div>
    </div>

    <div class="float_right">
        <a href="#" class="float_right reason_next" id="message_next"><?php echo lang('globals_next'); ?></a>

        <div id="upload_image" class="float_right">

            <div class="upload_button_wrapper" style="margin:0;">
                <div align="" >
                    <div class="btn btn-success fileinput-button">
                       <!-- <i class="glyphicon glyphicon-plus"></i> -->
                        <span style="position:relative; top:2px;"><!--<img style="position:relative; top:5px;" src="<?php //echo base_url(); ?>images/contactus/PaperClip4_Black.png" height="20" width="20" /> --><?php echo lang('contactus_addfile'); ?></span>
                        <!-- The file input field used as target for the file upload widget -->
                     <!--   <input id="fileupload" type="file" name="files[]" multiple />-->
                        
                    <input  style="" id="fileupload" type="file" name="contactus_file_upload">
                    <input type="hidden" name="image_uploaded_flag" id="image_uploaded_flag" value="0" />
                    <input type="hidden" name="image_uploaded_name" id="image_uploaded_name" value="" />
                    </div>
                </div>
                <div id="status_image_wrapper" align="left">
                    <p id="status_text" style="line-height: 0px; text-align:center;color: #FFF;position:relative;top:21px;height: 14px;"></p> 
                    <div style="position:relative;top:<?php
                    if ($current_language_db_prefix == "_ar") {
                        echo "-15px";
                    } else {
                        echo "0px";
                    }
                    ?>;" id="progress" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" ></div></div><!-- ENd of progress -->
                    <div style=" width:100%" id="image_error" class="bubble"></div>
                </div><!-- ENd of status_image_wrapper -->
            </div> 

        </div>
    </div>

    <div class="float_left">
        <div id="option_link" style="margin:0px 20px;">
            <p class="dros_tab5_option"><?php echo lang('contactus_dros_tab5_link'); ?></p>
            <p class="diet_app_option"><?php echo lang('contactus_diet_app_link'); ?></p>
        </div>
    </div>

</div>
<hr/>