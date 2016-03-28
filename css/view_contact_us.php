<link href="<?php echo base_url(); ?>css/mycorner.css" rel="stylesheet">
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
					//$('#image_preview').attr("src","<?php echo base_url(); ?>server/php/files/"+file.name);
					$('#progress').hide();
					//$('.checkbox_wrapper').fadeIn("fast");
					//$('#image_uploaded_flag').val(1);
					$('#image_uploaded_name').val(file.name);
					
					
				});
				$('#status_text').html("<?php echo lang("bestcook_uploadrecipe_loading_complete"); ?>");
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
			$("#status_text").html("<?php echo lang("bestcook_uploadrecipe_loading_message"); ?> "+progress+'%');
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
<script>
	jQuery(function(){
		jQuery('#progress').hide();
		jQuery('#status_text').hide();
		/*jQuery('#progress .progress-bar').css({
    	'background-image': 'none',
    	'background-color': '#e82327'
}		);*/

	});
</script>

<?php
/*session_start();
$cap = 'notEq';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['captcha'] == $_SESSION['cap_code']) {
        // Captcha verification is Correct. Do something here!
        $cap = 'Eq';
    } else {
        // Captcha verification is wrong. Take other action
        $cap = '';
    }
}*/
?>
<style>
.imgs_1
{
	color:#FFF !important;
	width:410px;
	height:200px;
	background-image:url(<?php echo base_url(); ?>images/contactus/contact_info4<?php echo $current_language_db_prefix; ?>.png); 
	background-repeat:no-repeat;
}
.imgs_2
{
	color:#FFF !important;
	width:410px;
	height:200px;
	background-image:url(<?php echo base_url(); ?>images/contactus/contact_info2<?php echo $current_language_db_prefix; ?>.png); 
	background-repeat:no-repeat;
}
.imgs_3
{
	color:#FFF !important;
	width:410px;
	height:200px;
	background-image:url(<?php echo base_url(); ?>images/contactus/contact_info3<?php echo $current_language_db_prefix; ?>.png); 
	background-repeat:no-repeat;
}
.imgs_4
{
	color:#FFF !important;
	width:410px;
	height:200px;
	background-image:url(<?php echo base_url(); ?>images/contactus/contact_info1<?php echo $current_language_db_prefix; ?>.png); 
	background-repeat:no-repeat;
}
.contactus_banner
{
	background:url(<?php echo base_url(); ?>images/contactus/contact_us_banner<?php echo $current_language_db_prefix; ?>.png) <?php if($current_language_db_prefix == "_ar"){echo "right";}else{echo "left";} ?>;
	width: 100%;
	height: 270px;
	border-top:5px solid #13758E;
	margin-top: 7px;
}
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.qtip-1.0.0-rc3.min.js"></script>
  <script type="text/javascript" src=""></script>
        <script type="text/javascript">
            $(document).ready(function(){
				
				$('#hover_code').qtip({
				   content: '<img width="300" height="100" src="<?php echo base_url()."images/contactus/batch code 2.jpg"; ?>" alt="Owl" />',
				   show: 'mouseover',
				   hide: 'mouseout',
				   position: {
				   corner: {
					 target: 'topLeft',
					 tooltip: 'bottomLeft'
				  }
			    }
				});
				
				function isValidEmailAddress(emailAddress) {
    				var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    				return pattern.test(emailAddress);
				};
				
				
               $("#contact_us_form").submit(function(e){
				   alert('test');
				    var state = true;
					
                    var name = $('#fname').val();
					var lname = $('#lname').val();
                    var email = $('#Email').val();
					var msg = $('#msg').val();
					var mobile = $('#mobile').val();
                    //var captcha = $('#captcha').val();
					var reasonid = $('#reason_ID').val();
					var reaspond = $('#respond_ID').val();
                    //var checkapprove = $('#checkapprove').val();
					
                    if( name == "" )
					{
                        $('#fname').addClass('error');
						state = false;
                    }
                    else{
                        $('#fname').removeClass('error');
                    }
					
					if($("#checkapprove").is(':checked')){
						$("#checkapprove_error").fadeOut();
					}else{
						$("#checkapprove_error").fadeIn();
					}
					
					if( lname == "" ){
                        $('#lname').addClass('error');
						state = false;
                    }
                    else{
                        $('#lname').removeClass('error');
                    }
					
					if( email == "" ){
                        $('#Email').addClass('error');
						state = false;
                    }
                    else{
                        $('#Email').removeClass('error');
                    }
					
					if( msg == "" ){
                        $('#msg').addClass('error');
						state = false;
                    }
                    else{
                        $('#msg').removeClass('error');
                    }
					
					if( mobile == "" ){
                        $('#mobile').addClass('error');
						state = false;
                    }
                    else{
                        $('#mobile').removeClass('error');
                    }
					
					/*if( reasonid == "" ){
                        $('#reason_ID').addClass('error');
						state = false;
                    }
                    else{
                        $('#reason_ID').removeClass('error');
                    }
					
					if( reaspond == "" ){
                        $('#respond_ID').addClass('error');
						state = false;
                    }
                    else{
                        $('#respond_ID').removeClass('error');
                    }
					
					if( checkapprove == "" ){
                        $('#checkapprove').addClass('error');
						state = false;
                    }
                    else{
                        $('#checkapprove').removeClass('error');
                    }*/
					
					return state;
					
                });
            
            });
			
        </script>
       <script>
	    $(document).ready(function(){
			$("#view_products").hide();
			$(".product_code").hide();
			$("#expiry_date").hide();

			
    $("#reason_ID").change(function()
    {
        var id=$(this).val();
        var dataString = 'id='+ id;
        
		if(id == 6){
		$("#view_products").fadeIn(); 
		$(".product_code").fadeOut();
		$("#expiry_date").fadeOut();
		}else if(id == 7){
		$("#view_products").fadeIn(); 
		$(".product_code").fadeIn();
		$("#expiry_date").fadeIn();
		}else{
		$("#view_products").fadeOut();
		$(".product_code").fadeOut();
		$("#expiry_date").fadeOut();
		}
		
		
		
		return false;

    });
			
		});
       </script>
<!--Date picker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript">
$( document ).on( "focus", "input.datepicker", function() {

    $( this ).datepicker({
       changeMonth: true,
      	changeYear: true,
	  	yearRange: '1950:2014',
	  	dateFormat: 'yy-mm-dd',
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(e) {
   // $("#boxscroll").niceScroll({cursorborder:"",cursorcolor:"#7e7979",boxzoom:false}); 
});
</script>

<div class="contactus_banner float_left">
<div class="contactus_banner_container float_left">
<?php if($current_language_db_prefix == "_ar"){ ?>
<h1 style="font-size:40px;"><strong><?php echo lang('contactus_banner_intro'); ?></strong></h1>
<?php }else{ ?>
<h1 style="font-size:30px;"><strong><?php echo lang('contactus_banner_intro'); ?></strong></h1>
<?php } ?>
<h3 style="font-size:18px; width:457px;"><strong><?php echo lang('contactus_banner_paragraph'); ?></strong></h3>
</div>
<!--<img width="428" class="float_right" src="<?php //echo base_url(); ?>images/contactus/contact_us_service<?php //echo $current_language_db_prefix; ?>.png"  />-->
</div>

<div class="clear"></div>

<div class="white_background_color top_radius_5 height_40">

    <div class="sections_wrapper_margin global_sperator_margin_top ">
    <h1 class="terms_conditions_color innertitle"> <?php echo lang('contactus');?> </h1>
    </div> 
    </div>
<div class="thick_line terms_conditions_background_color"></div>


<div class="white_background_color" style="height:auto;border:1px solid #FFF;">	

<div class="inner_body">
    <div class="contacus_container"> 
    <p class="innerwords" style="line-height:25px;">
   <?php echo lang('contactus_introduction'); ?>
    </p> <br />
    
    <div id="form_container" class="float left">
	    <?php
        $attributes = array('class' => '', 'id' => 'contact_us_form');
    
    	echo form_open_multipart('contact_us/process', $attributes); 
    	?>

		<?php if($message == 2){ ?>
        <span style="color:#F00;" class="innerwords"> <?php echo lang('contactus_submit_fail');?> </span><br/>
        <?php }elseif($message == 1){?>
        <span style="color:#090;" class="innerwords"> <?php echo lang('contactus_submit_success');?> </span><br/>
        <?php } ?>
        
    	<span class="innerwords"> <?php echo lang('contactus_firstname');?> </span> <label class="mandat float_left"> *</label><br/>
        <input type="text" name="firstname" class="textstyle font_size_17" id="fname"/> <br />
        <span class="innerwords"> <?php echo lang('contactus_lastname');?>   </span> <label class="mandat float_left"> *</label> <br/>
        <input type="text" name="lastname" class="textstyle font_size_17"  id="lname"/> <br />
        
         <span class="innerwords"> <?php echo lang('contactus_email');?>   </span> <label class="mandat float_left"> *</label><br/>
        <input type="text" name="email" class="textstyle font_size_17" id="Email" /> <br />
         <span class="innerwords"> <?php echo lang('contactus_phone');?>  </span> <br/>
         <input type="text" name="telephone" class="textstyle font_size_17" /> <br />
          <label class="mandat float_left"> *</label><span class="innerwords"><?php echo lang('contactus_mobile');?></span>  <br/>
    <input type="text" name="mobileno" id="mobile" class="textstyle font_size_17"  />  <br />  
          
          	   <span class="innerwords">  <?php echo lang('contactus_reason'); ?> </span>  <label class="mandat float_left"> *</label><br/>
          
		  <?php
	 echo form_dropdown('reason_ID', $display_reason, set_value('reason_ID') ,'class="textstyle optiontxt dir" id="reason_ID"')?>
            <br /> 
      
      <div style="">
            
            	<div class="float_left" id="view_products">
            <span class="innerwords">  <?php echo lang('contactus_inquire_product');?></span> <br />
             
           <?php
			echo form_dropdown('product_ID', $display_product, set_value('product_ID') ,'class="textstyle optiontxt dir" id="product_ID"')?>
            <br />
             	</div>
             
             <div  class="float_left product_code" style="width:100%;">
            		 <span class="innerwords" >
                     <?php if($current_language_db_prefix == "_ar"){ ?>
                     <a id="hover_code" href="#"> <img width="22" height="22" style="margin-bottom: -6px;" src="<?php echo base_url(); ?>images/contactus/help_black<?php echo $current_language_db_prefix; ?>.png" /> </a><?php echo lang('contactus_product_code');?>
                     <?php }else{ ?>
                     <?php echo lang('contactus_product_code');?> <a id="hover_code" href="#"> <img width="22" height="22" style="margin-bottom: -6px;" src="<?php echo base_url(); ?>images/contactus/help_black<?php echo $current_language_db_prefix; ?>.png" /> </a>
                     <?php } ?>
                     </span> <br />
                 <input title="<?php echo lang('contacus_product_code_example'); ?>" placeholder="<?php echo lang('contacus_product_code_example'); ?>" type="text" class="textstyle font_size_17" style="margin-right:5px;font-size:11px;" name="code_montag" dir="ltr"/> 
             	 </div>
                 <div class="clear"></div>
                 
                 <div class="float_left" style="width:100%;" id="expiry_date">
                    <span class="innerwords">  <?php echo lang('contactus_expiry_date');?></span> <br/>
                     <?php 
                    $data=array( 'name' => 'expiry_date' , 'id' => 'datepicker', 'class' => 'datepicker textstyle'); 		 
           		   echo form_input($data); 
             		?>
                 </div>
                 
            </div>
            
            <?php
			$data=array('type'=>'hidden' ,'name' => 'image_uploaded_name' ,'value' => '' , 'id' => 'image_uploaded_name'); 		 
			echo form_input($data);	 
			?>  
            
            <span class="innerwords"><?php echo lang('contactus_address'); ?></span><br/>
            <input type="text" class="textstyle optiontxt font_size_17"  name="address" placeholder="" />
            <div class="clear"></div>
            
            <span class="innerwords">  <?php echo lang('contactus_city');?> </span> <br/>
              
              <?php
			 
			  echo form_dropdown('city_ID', $display_city, set_value('city_ID') ,'class="textstyle optiontxt dir" id="city_ID"')?>
            <br /> 
         
            <span class="innerwords"> <?php echo lang('contactus_respond');?>  </span>  <label class="mandat float_left"> *</label> <br/>
     
             <?php
			 
  echo form_dropdown('respond_ID', $display_respond, set_value('respond_ID') ,'class="textstyle optiontxt dir" id="respond_ID"')?>
            <br /> <br /><br/>
                     
                
                <div style="height:310px; width:100%;border-width: medium; border-top-style:dashed; border-color:#CCC;margin-top:10px;">
                <!--<div style="border-bottom:#d9d9d9 dashed 3px;margin-top: 85px;"></div>-->
                
                <span class="innerwords">  <?php echo lang('contactus_your_msg');?> </span>
              
				<br/>
                <textarea style="border:1px solid #CCC;font-size:17px;"  name="yourmsg" class="yourmsg" id="msg"> </textarea> <br />
                
                <!--<input style="margin-top:10px;" id="uploadFile" placeholder="اختار ملف" disabled="disabled" />
                <div class="fileUpload float_left btn btn-primary">
                <span><?php //echo lang('contactus_addfile'); ?></span>
                <input id="uploadBtn" type="file" class="filebtn float_left upload">
                </div>-->
                </div>
                
                <div class="upload_button_wrapper float_left" style="margin: 0 -7px;">
                        <div align="" style="margin:5px;">
                            <div class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span><?php echo lang('contactus_addfile'); ?></span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input id="fileupload" type="file" name="files[]" multiple />
                            </div>
                        </div>
                        <div id="status_image_wrapper" align="left" style="width: 100%;float: left;margin-top: -25px;">
                                <p id="status_text" style="line-height: 0px; text-align:center;color: #FFF;position:relative;top:21px;height: 14px;"></p> 
                                <div style="position:relative;top:23px;" id="progress" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" ></div></div><!-- ENd of progress -->
                                <div style=" width:100%" id="image_error" class="bubble"></div>
                        </div><!-- ENd of status_image_wrapper -->
             	   </div>
                 
                <!--<div class="float_right" style= "margin-top:20px;">
                 <input type="text" name="captcha" id="captcha" maxlength="6" size="6"/>
         	   <img  style="margin-bottom:-10px;"src=" <?php //echo base_url();?>ajax/captcha/captcha.php"/>
               		</div>-->
               	<div class="clear"></div>
                
                <label class="mandat float_left" style="margin-top:10px;"> *</label>
                <div class="float_left" style="margin-top:10px;">
                
                 <?php 
			$data = array(
				'ID' => 'checkapprove',
				'name' => 'checkapprove',
				
				'class' => 'checkbox_approve float_left',
			); 
				echo form_checkbox($data);
				?> 
                  <span class="innerwords  optiontxt float_left ">  <?php echo lang('contactus_privacy_agree');?> </span> <br/>
                  <p id="checkapprove_error" style="display:none; color:#900;"><?php echo lang('contactus_priviacy_link'); ?></p>
                  	</div>
                        
                 <br/><br/>
            <h4 class="float_left" style="margin-bottom:10px;width:700px;"> <?php echo lang('contacus_required_info'); ?></h4>
           		<div class="float_right">
               		<?php echo form_submit('submit', lang('globals_send'),'class="submit_btn"'); 
					?>
            		</div>
				  <?php
                    echo form_close();
                   ?>
    			
                </div> <!--end of container-->
                
                <div class="cap_status"></div>
                
                
   				<div class="container_img">
                <ul class="imgs_container">
                
                <li style="margin-bottom: 5px; margin-left: 100px; margin-right: 118px;"><span class="innerwords"><?php echo lang('contactus_contact_others'); ?></span></li>
                <div class="clear"></div>
                
                <li class="imgs_3">
                   	<div class="contactusimgcontainer">
                 		<img  src=" <?php echo base_url(); ?>images/contactus/call.png" />
                        </div>
                        
                        
        
                     <div class="contactuscontainer">
                        <p class="contactuscontainer_p">
                        <?php echo lang('contactus_phone'); ?></p>
                            <div class="hotlinedesc">
                            
                            <span style="color:#000;"> <?php echo lang('contactus_hot_line');?>
                            </span> <span style="color:#000;">
							<?php
							if($current_language_db_prefix == "_ar")
							{
								echo $this->common->arabic_numbers(16180);
							}
							else
							{
								echo "16180";
							}
							?>
                            </span>
                            </div>
                        <p class="lastdescription"> <?php echo lang('contactus_hotline_details');?> </p>
                      
                        </div>
                       			<div class="clear"></div>
                		 </li>
                
                 <li class="imgs_2">
                   	<div class="emailimgcontainer" >
                 		<img  src=" <?php echo base_url(); ?>images/contactus/email.png" />
                        </div>
                        
                        
                         <div class="emailcontainer">
                         	<p style=""><?php echo lang('contactus_email');?></p> 
                            
                           <a href="mailto:Consumer.services@eg.nestle.com"> <p class="emailcontainer_p" style=""> Consumer.services@eg.nestle.com</p> </a>
                         </div>
                       	
                 </li>
                 		<div class="clear"></div> 
                        
            			
                <li class="imgs_1">
                
                    	<div class="fbimgcontainer">
                 	<img  src=" <?php echo base_url(); ?>images/contactus/fb.png" />
                        </div>
                         
                         <div  class="fbcontainer">
                         	<p style=""><?php echo lang('contactus_faceboock');?></p> 
                            
                           <a href="https://www.facebook.com/NestleEgypt" target="_blank"> <p class="fbcontainer_p"> www.facebook.com/NestleEgypt</p></a>
                         </div>
                       <div class="clear"></div>

                 </li>
                 
                 <li class="imgs_4">
                   	<div  class="askimgcontainer">
                 		<img  src=" <?php echo base_url(); ?>images/contactus/nestle_experts.png" />
                        </div>
                         <div class="askcontainer">
                         <p  class="askcontainer_p"><?php echo lang('contactus_nestle_experts'); ?></p>
                         <ul class="float_left askcontainer_list">
                         <li style="margin-bottom:0px !important;"><span style=""> <?php echo lang('contactus_questions_about_cooking'); ?></span></li>
                         <!--<li style="margin-bottom:0px !important;text-align:left;"><a href="mailto:nestle.cooking-expert@eg.nestle.com"> <p> nestle.cooking-expert@eg.nestle.com</p></a></li>-->
                         <li style="margin-bottom:0px !important;"><span style=""> <?php echo lang('contactus_questions-about_child_health_and_growth'); ?></span></li>
                         <!--<li style="margin-bottom:0px !important;text-align:left;"><a href="mailto:nestle.childdevelopment-expert@eg.nestle.com"> <p> nestle.childdevelopment-expert@eg.nestle.com</p></a></li>-->
                         <li style="margin-bottom:0px !important;"><span style=""><?php echo lang('contactus_questions_about_nutrition_and_weight_control');?></span></li>
                         <!--<li style="margin-bottom:0px !important;text-align:left;"><a href="mailto:nestle.childdevelopment-expert@eg.nestle.com"> <p>nestle.childdevelopment-expert@eg.nestle.com</p></a></li>-->
                         </ul>
  
                	</div>
                       			<div class="clear"></div>
                		 </li>
                
                </ul>
                </div>
  
  			<div class="clear"></div>
   				
   	</div> <!-- end of container-->

</div> <!--end of inner container-->


 </div>

<script>
$('#reason_ID').prepend(" <option value='' selected='selected'> <?php echo lang('contactus_reason');?> </option>");
$('#product_ID').prepend(" <option value='' selected='selected'> <?php echo lang('contactus_inquire_product');?> </option>");
$('#respond_ID').prepend(" <option value='' selected='selected'> <?php echo lang('contactus_respond');?> </option>");
$('#city_ID').prepend(" <option value='' selected='selected'> <?php echo lang('mycorner_city');?> </option>");
</script>


