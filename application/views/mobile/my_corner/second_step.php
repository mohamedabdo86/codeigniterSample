<link rel="stylesheet"  type="text/css" href="<?php echo base_url_mobile('css/view_my_profile.css'); ?>"/>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">-->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url(); ?>js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url(); ?>js/jquery.iframe-transport.js"></script>
<?php
if($unsubscribe_newsletter != ""){
	if($unsubscribe_newsletter == 1){
	?>
    <script>
    $(document).ready(function() {
        $.fancybox("<?php echo lang('unsubscribe_newsletter'); ?>",{
            minWidth: '200',
            minHeight: '50'
        }); // fancybox
    }); // ready
</script>
    <?php
	}elseif($unsubscribe_newsletter == 0){
		?>
	<script>
    $(document).ready(function() {
        $.fancybox("<?php echo lang('already_unsubscribe_newsletter'); ?>",{
            minWidth: '200',
            minHeight: '50'
        }); // fancybox
		
		
		
    }); // ready
</script>
<?php
	}
}
?>
<script src="<?php echo base_url(); ?>js/jquery-Tags-Input/jquery.tagsinput.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/jquery-Tags-Input/jquery.tagsinput.css" />

<!--Date picker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


        <div class="row margin_row">
        	<div class="col-xs-12">
            	<?php 
			 	$attributes = array('class' => '', 'id' => 'login_form', 'data-ajax' => 'false' );
				echo form_open_multipart('mobile/my_corner/signup_success/' . $members_id,$attributes);
	  			?>
            <div class="row margin_row">
			<div class="col-xs-12">
				<div class="user_info_data border">
					
                    
                <div id="edit_profile_info" style="padding:10px; position:relative" data-overlay-theme="b" data-ajax="false">
                
                
                <div id="upload_image_location" class="" style="background-color:#FFF;border:3px dashed #b7b7b7;width:160px;height:173px;border-radius:10px;">
                        <div class="image_wrapper" style="text-align:center">
                            <img style="width: 160px;height: 173px;" id="image_preview" class="member_image img-responsive" src= "<?php echo base_url() ?>images/mycorner/personal_img.png " />
                        </div>
        
                    </div>
                
                	
                	<table>
        <tr>
        <td>
                <div class="btn btn-success fileinput-button" style="padding: 3px 0;height: 25px;margin-top: 13px;">
                <i class="glyphicon glyphicon-plus"></i>
                <span style="font-weight: bold;font-size: 13px;"><?php echo lang('mycorner_choose_image'); ?></span>
                <!-- The file input field used as target for the file upload widget -->
                <input id="fileupload" type="file" name="user_profile_image" />
                </div>
        </td>
        <td>
        </td>
        </tr>
		</table>
                </div>
                    
				</div>
			</div>                
            </div>
           
           		<?php echo form_submit('update',lang('mycorner_update') ,'class="mycorner_button btn-blue" data-ajax="false" style="padding: 15px 10px"') ?>
                
                    <?php
					echo form_close();
	  				?>
           
          </div>
         </div>