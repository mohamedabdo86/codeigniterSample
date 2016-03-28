<link href="<?php echo base_url(); ?>css/mycorner.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/contact_us.css" rel="stylesheet">

<!-- Upload Function -->
<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">-->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.fileupload.css">
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url(); ?>js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url(); ?>js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url(); ?>js/jquery.fileupload.js"></script>
<script>
/*jslint unparam: true */
/*global window, $ */
//ollakalla
$(function () {
	
	//Hide Progress Bar
	
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : '<?php echo base_url(); ?>server/php/';
				
	
    $('#fileupload').fileupload({
			url: url,
			dataType: 'json',
			done: function (e, data) {
				$.each(data.result.files, function (index, file) {
					/*$('<p/>').text(file.name).appendTo('#files');*/
					//$('#image_preview').attr("src","<?php echo base_url(); ?>uploads/contact_us/"+file.name);
					//$('#progress').hide();
					$('#image_uploaded_name').val(file.name);
					
					$('#progress').html('<p class="contactus_upload_message"><?php echo lang("bestcook_uploadrecipe_loading_complete"); ?> </p>');
					
					//$('.checkbox_wrapper').fadeIn("fast");
					//$('#image_uploaded_flag').val(1);
					//$('#image_uploaded_name').val(file.name);
					
					
				});
				$('#status_text').html("");
			},
			add: function (e, data) {
			var goUpload = true;
			var uploadFile = data.files[0];
			if (!(/\.(gif|jpg|jpeg|png|zip|rar|docx|doc|txt|pdf)$/i).test(uploadFile.name)) {
				//common.notifyError('You must select an image file only');
				$('#status_text').fadeIn("fast").html("<?php echo lang("bestcook_uploadrecipe_invalid_format_image"); ?>");
				goUpload = false;
			}
			if (uploadFile.size > 2000000) { // 2mb
				//common.notifyError('Please upload a smaller image, max size is 2 MB');
				$('#status_text').fadeIn("fast").html("<?php echo lang("bestcook_uploadrecipe_invalid_size_image"); ?>");
				goUpload = false;
			}
			if (goUpload == true) {
				data.submit();
			}
  	  	},
        progressall: function (e, data) {
			$('#progress').fadeIn("fast");
			$('#status_text').fadeIn("fast");
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
			
			//$("#status_text").html("<?php echo lang("bestcook_uploadrecipe_loading_message"); ?> "+progress+'%');
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
		
		$("input[id=fileupload]").change(function() {
   	 		 var names = [];
   			 for (var i = 0; i < $(this).get(0).files.length; ++i) {
      		  names.push($(this).get(0).files[i].name);
    		}
		
		//$("#image_uploaded_name").val(names);
	});
});
</script>
<?php 
$reason_id = $this->session->flashdata('reason_id');
$message_1 =  $this->session->flashdata('contact_message_textarea_1');
$message_2 =  $this->session->flashdata('contact_message_textarea_2');
$product_ID = $this->session->flashdata('product_ID');
$code_montag = $this->session->flashdata('code_montag');
$image_uploaded_name = $this->session->flashdata('image_uploaded_name');
?>
<script>
	jQuery(function(){
		jQuery('#progress').hide();
		jQuery('#status_text').hide();

	});
	$(document).ready(function(e) {
        <?php 
		if($reason_id){
		?>
		  $("#contact_reason").hide();
		  $("#personal_info").show();
		  $("#step_3").css('border-bottom', '1px dashed #A0A0A0');
		  $("input[name=reason_ID][value=" + <?php echo $reason_id; ?> + "]").attr('checked', 'checked');
		  $("#contact_message_textarea_1").val('<?php echo $message_1 ?>');
		  $("#contact_message_textarea_2").val('<?php echo $message_2 ?>');
		  $("#product_ID").val('<?php echo $product_ID; ?>');
		  $("#product_ID").val('<?php echo $product_ID; ?>');
		  $("#code_montag").val('<?php echo $code_montag; ?>');
		  $("#image_uploaded_name").val("<?php echo $image_uploaded_name; ?>");
		  
		<?php
		}
		?>
    });
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.qtip-1.0.0-rc3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/contact	_us.js"></script>


<script type="text/javascript">
$(document).ready(function(e) {
	$('#hover_code').qtip({
			   content: '<img width="220" height="100" src="<?php echo base_url()."images/contactus/batch code 2.jpg"; ?>" alt="Owl" />',
			   show: 'mouseover',
			   hide: 'mouseout',
			   position : {
    				adjust : {
        				screen : true
   					 }
				}
	});
	
	$(".fb_reg_button").click(function(){
		var reason_id = $('input:radio[name=reason_ID]:checked').val();
		var contact_message_textarea_1 = $("#contact_message_textarea_1").val();
		var contact_message_textarea_2 = $("#contact_message_textarea_2").val();
		var product_ID = $("#product_ID").val();
		var code_montag = $("#code_montag").val();
		var image_uploaded_name = $("#image_uploaded_name").val();
		
		$.ajax({
            url : "<?php echo site_url($this->router->class.'/set_data_session'); ?>",
            data : {reason_id : reason_id, contact_message_textarea_1 : contact_message_textarea_1, contact_message_textarea_2 : contact_message_textarea_2,  product_ID : product_ID, code_montag : code_montag, image_uploaded_name : image_uploaded_name},
            type: "POST",
			async: false,
			cache: false,
			timeout: 30000,
			dataType: "json",
          	success : function(message)
			{	
				if (parseFloat(message)){
					return false;
				} else {
					return true;
				}
			}
		});
	});
	
});
</script>

<style>
.contactus_banner
{
	background:url(<?php echo base_url(); ?>images/contactus/contact_us_banner<?php echo $current_language_db_prefix; ?>.jpg) <?php if($current_language_db_prefix == "_ar"){echo "right";}else{echo "left";} ?>;
	width: 100%;
	height: 270px;
	border-top:5px solid #13758E;
	margin-top: 7px;
}
#email_radio
{
	height:80px;
}
body.arabic #telephone_respond
{
	text-indent:5px;
}
#telephone_respond
{
	text-indent:48px;
}
</style>
<?php
if($success == 1){
	?>
    <script>
    $(document).ready(function() {
        $.fancybox("<p align='center'><?php echo lang('contactus_submit_success'); ?></p>",{
            minWidth: '150',
            minHeight: '50'
        }); // fancybox
		
		$("#contact_us_form").submit(function(){
			if($("#checkapprove").is(':checked')){
				<?php
					$this->session->unset_userdata('reason_id');
					$this->session->unset_userdata('contact_message_textarea_1');
					$this->session->unset_userdata('contact_message_textarea_2');
					$this->session->unset_userdata('code_montag');
					$this->session->unset_userdata('image_uploaded_name');
					$this->session->unset_userdata('product_ID');
				?>
				$("#checkapprove_error").fadeOut();
			}else{
				$("#checkapprove_error").fadeIn();
			return false;
		}		
	});
		
    }); // ready
</script>
    <?php
	}
		?>

<div class="contactus_banner float_left">
    <div class="contactus_banner_container float_left">
    <?php if($current_language_db_prefix == "_ar")
	{ ?>
    <h1 style="font-size:40px;"><strong><?php echo lang('contactus_banner_intro'); ?></strong></h1>
    <?php }else{ ?>
    <h1 style="font-size:30px;"><strong><?php echo lang('contactus_banner_intro'); ?></strong></h1>
    <?php } ?>
    <h3 style="font-size:18px; width:457px;"><strong><?php echo lang('contactus_banner_paragraph'); ?></strong></h3>
    </div>
</div>

<div class="clear"></div>

<div class="white_background_color top_radius_5 height_40">
    <div class="sections_wrapper_margin global_sperator_margin_top ">
    	<h1 class="terms_conditions_color innertitle"> <?php echo lang('contactus');?></h1>
    </div>
</div>

<div class="thick_line terms_conditions_background_color"></div>

<div class="white_background_color" style="height:auto;border:1px solid #FFF;">	

    <div class="inner_body">
        <div class="contacus_container"> 
        	<div style="width:100%;height:<?php /* if($current_language_db_prefix == "_ar"){echo "80px"; }else{echo "105px";} */ ?>;">
            <p class="innerwords" style="line-height:25px;">
                <?php echo lang('contactus_introduction'); ?>
            </p>
            <h4 class="float_left" style="margin-top:10px;width:100%;"> <?php echo lang('contacus_required_info'); ?></h4>
            <p style="line-height:25px; color:red; clear: both">
            	<?php
            	global $CI; 
            	echo $CI->input->get('err');
            	?>
            </p>
            </div>
			<?php
			$num_1 = 1;
			$num_2 = 2;
			$num_3 = 3;
			$num_4 = 4;
			if($current_language_db_prefix == "_ar"){
				$num_1 = $this->common->arabic_numbers($num_1);
				$num_2 = $this->common->arabic_numbers($num_2);
				$num_3 = $this->common->arabic_numbers($num_3);
				$num_4 = $this->common->arabic_numbers($num_4);
			}
			?>
             <?php
  				 $attributes = array('class' => '', 'id' => 'contact_us_form');

				echo form_open_multipart($this->router->class.'/success', $attributes); 
			?>

            <div id="contact_us_form_container">
            	<div class="contact_us_link" id="step_1">
                <h2 class="dir"><span><?php echo $num_1; ?></span><label class="mandat"> *</label> <?php echo lang('contactus_reason'); ?> </h2></div>
                <div id="contact_reason">
                <?php 
					/*echo "<div id='radio_reason' class='float_left'>";
					echo $display_reason[1];
					echo form_radio('reason_ID', 1, 'checked', 'id=radio_reason_button');
					echo "</div>";*/

				 for($i=1; $i<=sizeof($display_reason); $i++):
				 	echo "<div id='radio_reason' class='float_left radio_dir'><label>";
				 	echo $display_reason[$i];
					$label = $display_reason_en[$i];
					$js = 'id="radio_reason_button"  onclick="_gaq.push([\'_nesglobalhqtag._trackEvent\',\'Contact Us Form\',\'Step 1\',\''.$label.'\']); _gaq.push([\'_trackEvent\',\'Contact Us Form\',\'Step 1\',\''.$label.'\']);"';
				 	echo form_radio('reason_ID', $i, 'checked', $js);
					echo "</label></div>";
				 endfor;
				?>
                <a href="#" onclick="_gaq.push(['_nesglobalhqtag._trackEvent','Contact Us Form','Step 1','Inquiry Type']); _gaq.push(['_trackEvent','Contact Us Form','Step 1','Inquiry Type']);" class="float_right reason_next" id="reason_next"><?php echo lang('globals_next');?></a>
                </div>
                <hr/>
                <div class="contact_us_link" id="step_2"><h2 class="dir"><span><?php echo $num_2; ?></span><label class="mandat"> *</label> <?php echo lang('contactus_your_msg');?></h2></div>
                <div id="contact_message">
                	<div id="scenario_1">
                    <div style="width:600px; height:160px;">
                		<textarea rows="<?php if($current_language_db_prefix == "_ar"){echo "4"; }else{echo "5";} ?>" cols="<?php if($current_language_db_prefix == "_ar"){echo "57"; }else{echo "66";} ?>" id="contact_message_textarea_1" name="yourmsg_1" class="yourmsg_1"></textarea>
                        <p class="float_left contact_message_textarea_1_error_message"  style="margin: 0px 15px; color: #F00;font-weight:bold;"><?php echo lang('bestcook_field_required'); ?></p>
                    </div>
                    </div>
                    <div id="scenario_2">
                    
                    <div class="float_right" style="width:400px; height:160px;">
                    <textarea rows="<?php if($current_language_db_prefix == "_ar"){echo "4"; }else{echo "6";} ?>" cols="<?php if($current_language_db_prefix == "_ar"){echo "33"; }else{echo "48";} ?>" id="contact_message_textarea_2" name="yourmsg_2" class="yourmsg_2 float_right"></textarea>
                    <p class="float_left contact_message_textarea_2_error_message" style="margin: 3px -110px; color: #F00;font-weight:bold;"><?php echo lang('bestcook_field_required'); ?></p>
                   </div>
                   
                   <div class="float_left" style="width:360px; height:160px;">
                   <?php
					$data=array('type'=>'hidden' ,'name' => 'image_uploaded_name' ,'value' => '' , 'id' => 'image_uploaded_name'); 		 
					echo form_input($data);	 
			
					?>
                   
                    <h3 class="float_left" style="line-height: 30px;"><?php echo lang('contactus_inquire_product');?></h3>
					<?php
						
					//array_unshift($display_product, "  .....  "); //lang('contactus_inquire_product')
					$newoptions = array('0' => '.....') + $display_product;
					echo form_dropdown('product_ID', $newoptions, set_value('product_ID') ,'class="drop_down_style float_left optiontxt dir" id="product_ID"');
					
					 ?>
                    
                    <h3 class="float_left" style="line-height: 30px;"><?php if($current_language_db_prefix == "_ar"){ ?>
                     <?php echo lang('contactus_product_code');?> <a id="hover_code" href="#" > <img width="22" height="22" style="margin-bottom: -6px;" src="<?php echo base_url(); ?>images/contactus/help_black<?php echo $current_language_db_prefix; ?>.png" /> </a>
                     <?php }else{ ?>
                     <a id="hover_code" href="#" style="float:right;"> <img width="27" height="25" style="margin-bottom: -6px;" src="<?php echo base_url(); ?>images/contactus/help_black<?php echo $current_language_db_prefix; ?>.png" /> </a> <?php echo lang('contactus_product_code');?>
                     <?php } ?></h3>
                    <input title="<?php echo lang('contacus_product_code_example'); ?>" placeholder="<?php echo lang('contacus_product_code_example'); ?>" type="text" class="drop_down_style font_size_17 float_left" style="font-size:11px;" id="code_montag" name="code_montag" dir="ltr"/> 
                    <?php //if($current_language_db_prefix != "_ar"){echo "<br/>";} ?>
                    </div>
                    
                    <div class="clear"></div>
                    </div>
                    
                    <div class="float_right" style="width:auto; height:70px;">
                    <a href="#" onclick="_gaq.push(['_nesglobalhqtag._trackEvent','Contact Us Form','Step 2','Message']); _gaq.push(['_trackEvent','Contact Us Form','Step 2','Message']);" class="float_right reason_next" id="message_next"><?php echo lang('globals_next');?></a>
                    
                    <div id="upload_image" class="float_right">
                    
                    <div class="upload_button_wrapper" style="margin:0;">
                        <div align="" >
                            <div class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span style="position:relative; top:2px;"><img style="position:relative; top:5px;" src="<?php echo base_url(); ?>images/contactus/PaperClip4_Black.png" height="20" width="20" /><?php echo lang('contactus_addfile'); ?></span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input id="fileupload" type="file" name="files[]" />
                            </div>
                        </div>
                        <div id="status_image_wrapper" align="left" style="width: 100%;float: left;margin-top: -25px;">
                                <p id="status_text" style="line-height: 0px; text-align:center;color: #FFF;position:relative;top:21px;height: 14px;"></p> 
                                <div style="position:relative;top:<?php if($current_language_db_prefix == "_ar"){echo "-15px"; }else{echo "0px";} ?>;" id="progress" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" ></div></div><!-- ENd of progress -->
                                <div style=" width:100%" id="image_error" class="bubble"></div>
                        </div><!-- ENd of status_image_wrapper -->
             	   </div> 
                    
                    </div>
                    </div>
                    
                    <div class="float_left" style="width:360px; height:40px;">
                    	<div id="option_link" style="margin:0px 20px;">
                        <p class="dros_tab5_option"><?php echo lang('contactus_dros_tab5_link'); ?></p>
                        <p class="diet_app_option"><?php echo lang('contactus_diet_app_link'); ?></p>
                        </div>
                    </div>
                    
                </div>
                <hr/>
                <div class="contact_us_link" id="step_3"><h2 class="dir"><span><?php echo $num_3; ?></span> <label class="mandat"> *</label><?php echo lang('contactus_personal_info');?></h2></div>
                <div id="personal_info">
                
                		
		<?php
        require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '1424984977747397',
  'secret' => 'cb0b67c5019dc5d4886b815cc086449d',
));

// Get User ID
$user = $facebook->getUser();


if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
    
    if ($user)
	{
      try {

        $user_profile = $facebook->api('/me','GET');

      } catch(FacebookApiException $e) {

        $login_url = $facebook->getLoginUrl(); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } 
	else 
	{
      // No user, print a link for the user to login
	  $params = array(
	  'scope' => 'public_profile,read_stream,email ,user_birthday ',
	);
	
	$loginUrl = $facebook->getLoginUrl($params);
	  
	  echo '<a class="fb_reg_button" href="'.$loginUrl.'"><img style="margin:10px 0px;" height="30" width="100" src="'.base_url().'images/mycorner/fb_reg_button'.$current_language_db_prefix.'.png" /></a>';

    }
	
	if($user)
			{
				$facebook->setExtendedAccessToken();
				$access_token =  $facebook->getAccessToken();
				
				$member_fb_id = $user_profile['id'];
				
				$data=array('type'=>'hidden' ,'name' => 'members_fb_id' ,'value' => $member_fb_id , 'id' => ''); 		 
				echo form_input($data);	 
				
				$data=array('type'=>'hidden' ,'name' => 'members_access_token' ,'value' => $access_token , 'id' => ''); 		 
				echo form_input($data);
								
				if(isset($user_profile['first_name']))
				{
					$member_fb_first_name = $user_profile['first_name'];
				}
				else
				{
					$member_fb_first_name = '';
				}
				if(isset($user_profile['last_name']))
				{
					$member_fb_last_name = $user_profile['last_name'];
				}
				else
				{
					$member_fb_last_name = '';
				}
				if(isset($user_profile['email']))
				{
					$member_fb_email = $user_profile['email'];
				}
				else
				{
					$member_fb_email = '';
				}
				if(isset($user_profile['birthday']))
				{
					$member_fb_birthday = date('Y-m-d',strtotime($user_profile['birthday']));
				}
				else
				{
					$member_fb_birthday = '';
				}
				
				if(isset($user_profile['hometown']['name']))
				{
					$member_fb_address = $user_profile['hometown']['name'];
				}
				else
				{
					$member_fb_address = '';
				}
			}
			else
			{
				$member_fb_first_name = '';
				$member_fb_last_name = '';
				$member_fb_email = '';
				$member_fb_birthday = '';
				$member_fb_address = '';
			}
			
		?>
                
                <div style="height:90px; width:100%;">
                 <div class="float_left personal_info_input">
                  <h3 class=""><label class="mandat"> *</label><?php echo lang('contactus_firstname');?></h3>
                  <input type="text" onkeypress ="return onlyAlphabets(event,this)" name="firstname" value="<?php if(!empty($this->members->members_firstname)){echo $this->members->members_firstname;}elseif(!empty($member_fb_first_name)){echo $member_fb_first_name;} ?>" class="textstyle font_size_17" id="fname"/>
                  <p class="firstname_error field_error"  style="font-weight:bold;"><?php echo lang('contactus_firstname_error'); ?></p>
                 </div>
                
                 <div class="float_left personal_info_input">
                  <h3 class=""><label class="mandat"> *</label><?php echo lang('contactus_lastname');?></h3>
                  <input type="text" onkeypress ="return onlyAlphabets(event,this)" name="lastname" value="<?php if(!empty($this->members->members_lastname)){echo $this->members->members_lastname;}elseif(!empty($member_fb_last_name)){echo $member_fb_last_name;} ?>" class="textstyle font_size_17"  id="lname"/> 
                   <p class="lastname_error field_error"  style="font-weight:bold;"><?php echo lang('contactus_lastname_error'); ?></p>
                </div>
                </div>
                
                
                <div style="height:90px; width:100%;">
                <div class="float_left" style="width: 320px; margin: auto;">
                 <h3 class=""><label class="mandat"> *</label><?php echo lang('contactus_email');?></h3>
                 <input type="text" name="email" value="<?php if(!empty($this->members->members_email)){echo $this->members->members_email;}elseif(!empty($member_fb_email)){echo $member_fb_email;}  ?>" class="textstyle font_size_17" id="Email" />
                 <p class="email_error" style="font-weight:bold;"><?php echo lang('contactus_email_error'); ?></p>
                 <p class="email_error_format" style="font-weight:bold; display:none;"><?php echo lang('contactus_email_format_error'); ?></p>
                </div>
                
                <div class="float_left" style="width: 280px; margin: auto;">
                 <h3 class=""><?php echo lang('contactus_phone');?></h3>
                 <input type="text" class="font_size_17" id="egyptnumber" value="+20" readonly="readonly" />
                 <input type="text" onkeypress="return isNumberKey(event)" maxlength="9" name="telephone" id="telephone" class="medium_text font_size_17" />
                 <?php /*?><p class="telephone_error" style="font-weight:bold;"><?php echo lang('contactus_phone_error'); ?></p><?php */?>
                </div>
                
                <div class="float_left">
                 <h3 class=""><?php echo lang('contactus_mobile');?></h3>
                 <input type="text" class="font_size_17" id="egyptnumber" value="+20" readonly="readonly" />
                 <input type="text" onkeypress="return isNumberKey(event)" maxlength="10" name="mobileno" value="<?php if(!empty($this->members->members_mobile)){echo $this->members->members_mobile;} ?>" id="mobile" class="medium_text font_size_17"  />
                 <?php /*?><p class="mobile_error" style="font-weight:bold;"><?php echo lang('contactus_mobile_error'); ?></p><?php */?>
                </div>
                </div>
                
                <div style="height:90px; width:100%;">
                	<div class="float_left" style="width: 400px; margin: auto;">
                 		<h3 class=""><?php echo lang('contactus_address');?></h3>
                        <input type="text" id="address" value="<?php if(!empty($member_fb_address)){echo $member_fb_address;} ?>" class="textstyle font_size_17"  name="address" placeholder="" />
                	</div>
                    
                    <div class="float_left" style="width: 280px; margin: auto;">
                 		<h3 class=""><?php echo lang('contactus_city');?></h3>
                		 <?php
						    //array_unshift($display_city, lang('mycorner_city'));
			  				echo form_dropdown('city_ID', $display_city, set_value('city_ID') ,'class="drop_down_style dir" id="city_ID"')
						 ?>
               	    </div>
                    
                </div>
                
                <a href="#" onclick="_gaq.push(['_nesglobalhqtag._trackEvent','Contact Us Form','Step 3','Information']); _gaq.push(['_trackEvent','Contact Us Form','Step 3','Information']);" class="float_right reason_next" id="info_next"><?php echo lang('globals_next');?></a>
                
                </div>
                <hr/>
                <div class="contact_us_link" id="step_4"><h2 class="dir"><span><?php echo $num_4; ?></span><label class="mandat"> *</label> <?php echo lang('contactus_contact_way'); ?></h2></div>
                
                <div id="contact_method">
                 <?php 
				    echo "<div id='radio_reason' class='float_left radio_dir'><label>";
					echo $display_respond[4];
					echo "<input type='checkbox' class='respond_4' name='respond_ID' value='4' id='respond_ID'  checked='checked'/>";
					echo "</label></div>";
					
					echo "<div id='radio_reason' class='float_left radio_dir'><label>";
					echo $display_respond[2];
					echo "<input type='checkbox' class='respond_2' name='respond_ID[]' value='2' id='respond_ID' />";
					echo "</label></div>";
					echo "<div id='telephone_radio' class='float_left input_radio radio_dir'>";
					?>
					<h3 class=""><?php echo lang('contactus_phone');?></h3>
                    <input type="text" style="left: 60px;margin-top: 6px;" class="font_size_17" id="egyptnumber" value="+20" readonly="readonly" />
                 	<input type="text" onkeypress="return isNumberKey(event)" maxlength="10" name="telephone_respond"  id="telephone_respond" class="radio_input_text dir font_size_17 telephone_radio" />
                 	<p class="telephone_error_2" style="font-weight:bold;"><?php echo lang('contactus_phone_error'); ?></p>
					<?php
					echo "</div>";
                    echo "<div id='radio_reason' class='float_left radio_dir'><label>";
					echo $display_respond[3];
					echo "<input type='checkbox' class='respond_3' name='respond_ID[]' value='3' id='respond_ID' />";
					echo "</label></div>";
					echo "<div id='email_radio' class='float_left input_radio radio_dir'>";
					?>
                    <h3 class=""><?php echo lang('contactus_email');?></h3>
                	<input type="text" name="email_respond" class="radio_input_text font_size_17 email_radio" id="email_respond" />
                 	<p class="email_error_2" style="font-weight:bold;"><?php echo lang('contactus_email_error'); ?></p>
                    <p class="email_error_format_2" style="font-weight:bold; display:none;"><?php echo lang('contactus_email_format_error'); ?></p>
					<?php echo "</div>";?>

                <div id='radio_reason' class='float_left radio_dir'>
                 <?php 
					$data = array(
						'ID' => 'checkapprove',
						'name' => 'checkapprove',
						'class' => 'checkbox_approve float_left',
					); 
					echo form_checkbox($data);
				?> 
                  <span class="optiontxt float_left ">  <?php echo lang('contactus_privacy_agree');?> </span> <br/>
                  <p id="checkapprove_error" style="display:none; color:#F00;font-weight:bold;"><?php echo lang('contactus_priviacy_link'); ?></p>
                  	</div>

				<input type="submit" name="submit" onclick="_gaq.push(['_nesglobalhqtag._trackEvent','Contact Us Form','Successful Submission','EGYPT']); _gaq.push(['_trackEvent','Contact Us Form','Successful Submission','EGYPT']);" id="contact_us_submit" value="<?php echo lang('contact_us_send'); ?>" class="float_right submit_button reason_next">
                </div>
                <?php
		  			echo form_close();
		   		?>
            </div>
            
            <div class="clear"></div>
            <?php
			$this->load->view('static_pages/another_way_contact_us', $static_desc);
			?>
                    
        </div> <!-- end of container-->    
    </div> <!--end of inner container-->

</div>


