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
					$('#image_preview').attr("src","<?php echo base_url(); ?>server/php/files/"+file.name);
					$('#progress').hide();
					//$('.checkbox_wrapper').fadeIn("fast");
					$('#image_uploaded_flag').val(1);
					$('#image_uploaded_name').val(file.name);
					
					
				});
				$('#status_text').html("<?php echo lang("bestcook_uploadrecipe_loading_complete"); ?>");
			},
			add: function (e, data) {
			var goUpload = true;
			var uploadFile = data.files[0];
			if (!(/\.(gif|jpg|jpeg|png)$/i).test(uploadFile.name)) {
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
<script type="text/javascript">
$(document).ready(function(e) {
	$("#insert_message").hide();
	$("#update_order").fancybox({
		  width: 420,
          height: 150,
		  scrolling   : 'no',
		  autoSize : false,
          fitToView : false,
          helpers: {
              title : {
                  type : 'float'
              }
          },
		  afterLoad: function(){
   			setTimeout( function() {$.fancybox.close(); },2000); // 3000 = 3 secs
  		}
      });
   
	$( "#sortable" ).disableSelection();
	$( "#sortable" ).sortable();
	
	$('#update_order').click(function(e) {
		
        var member_id = '<?php echo $members_id; ?>'; 
		var listArray = new Array();
		$(".ui-state").each(function(index, element) {
				listArray.push($(this).attr("id"));
			});
			
		$.ajax({
			  url:  "<?php echo site_url($this->router->class."/section_order"); ?>",
			  type: "POST",
			  data: {data : listArray , member_id : member_id },
			  cache: false,
			  //dataType: "json",
			  success: function(success_array)
			  {
				$("#insert_message").show();
			  },
			  error: function(xhr, ajaxOptions, thrownError)
			  {
				
			  }
				  
			});
		
    });

});
</script>
<style>
#create_member_form
{
	width:97%;
}
#save_order_btn
{
	text-align:center;
	margin-left: -27px;
}
.arabic #save_order_btn
{
	text-align:center;
	margin-left: 55px;
}
#save_image_btn
{
	margin: 0px;
	padding: 0px 45px;
}
.arabic #save_image_btn
{
	margin: 0px; 
	padding:0px 73px;
}

</style>
<div id="insert_message"><div style="text-align:center;margin-top:60px;"><h1 style="margin-bottom:25px;"><?php echo lang('mycorner_homepage_section_order_done');?></h1></div></div>

<div class="white_background_color top_radius_5 height_40">
    <div class="sections_wrapper_margin global_sperator_margin_top ">
       <h1 class="terms_conditions_color innertitle"><?php echo lang('mycorner_registration'); ?> </h1>
    </div> 
</div>
<div class="thick_line terms_conditions_background_color"></div>

<div class="background" style="height:auto;border:1px solid #FFF;">	


<div class="inner_body" >
    <div class="container" style="position:relative;">
    
    	<h2 style="color:#7c7c7c;font:inherit;font-size: 35px;font-weight: bold;"><?php echo lang('mycorner_welcome'); ?></h2>
            
      <div class="welcome_circle">
            	<div class="first_border"></div>
                <div class="secondstepcircleheader num_of_circle" ><?php echo ($current_language_db_prefix == "_ar")?  '١' :  ' 1 '; ?></div>
                <div class="secondstep_border"></div>
                <div class="seconde_step_circle num_of_circle" ><?php echo ($current_language_db_prefix == "_ar")?  '٢' :  ' 2 '; ?></div><!--style="color:#CCC;"-->
                <div class="last_border"></div>
            </div>
                    
                    
                <div class="show_the_num">
                  <p class="num_of_page"><?php echo ($current_language_db_prefix == "_ar")?  '٢' :  ' 2 '; ?></p>
                </div>
                    

    	
   			<div id="form" style="margin-top:43px;margin-left:26px;">
            	
                        
           <?php 
           $attributes = array('class' => '', 'id' => 'create_member_form');
			echo form_open_multipart('',$attributes); 
		   
			$data=array('type'=>'hidden' ,'name' => 'image_uploaded_flag' ,'value' => 0 , 'id' => 'image_uploaded_flag'); 		 
			echo form_input($data);	 
			
			$data=array('type'=>'hidden' ,'name' => 'image_uploaded_name' ,'value' => '' , 'id' => 'image_uploaded_name'); 		 
			echo form_input($data);	 

           ?>      
           
            	<div class="float_left" style="width:200px;">
                    
                    <div id="upload_image_location" class="" style="background-color:#FFF;border:3px dashed #b7b7b7;width:160px;height:173px;border-radius:10px;">
                        <div class="image_wrapper">
                            <img style="width: 160px;height: 173px;" id="image_preview" class="member_image" src= "<?php echo base_url() ?>images/mycorner/personal_img.png " />
                        </div>
        
                    </div>
                   
                    <div class="upload_button_wrapper" style="margin: 0px 3px;">
                        <div align="" style="margin:5px;">
                            <div class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span><?php echo lang('mycorner_chose_your_image');?></span>
                            <!-- The file input field used as target for the file upload widget -->
			<h3 style="padding: 0px 50px;">
                            <input id="fileupload" type="file" name="files[]" multiple />
			</h3>
                            </div>
                        </div>
                        <div id="status_image_wrapper" align="left" style="width: 100%;float: left;margin-top: -25px;">
                                <p id="status_text" style="line-height: 0px;color: #0154a0;position:relative;left: 25px; top:30px; height: 14px;"></p> 
                                <div style="position:relative;top:23px;" id="progress" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" ></div></div><!-- ENd of progress -->
                                <div style=" width:100%" id="image_error" class="bubble"></div>
                        </div><!-- ENd of status_image_wrapper -->
             	   </div><!-- End of upload_button_wrapper -->
              
                </div>  <!--end of float left -->
                
                	<div class="float_right" style="width:280px;">
                    
                    	<h3 style="text-align:center;font-weight:bold;font-size:11px;"> <?php echo lang('mycorner_arrang_priorities');?></h3>
                        
                        <div class="float_right">
                        <div class="circle"><h3 class="numbers"> 1</h3></div>
                        <div class="circle"><h3 class="numbers"> 2</h3></div>
                        <div class="circle"><h3 class="numbers"> 3</h3></div>
                        <div class="circle"><h3 class="numbers"> 4</h3></div>
                        </div>
                        <div class="float_left">
                        	<ul id="sortable">
                                <li id="10" class="ui-state"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class=" section_order best_me_background_color"><h3><?php echo lang('globals_bestme');?></h3></div></li>
                            	<li id="2" class="ui-state"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class=" section_order best_cook_background_color"><h3><?php echo lang('globals_bestcook');?></h3></div></li>
                                <li id="27" class="ui-state"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class=" section_order best_mom_background_color"><h3><?php echo lang('globals_bestmom');?></h3></div></li>
                                <li id="28" class="ui-state"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class=" section_order best_time_background_color"><h3><?php echo lang('globals_besttime');?></h3></div></li>

                            </ul>
                        </div>
                        <div class="clear"></div>
                        <h3 id="save_order_btn">
                        	<a href="#insert_message" class="mycorner_button" id="update_order"><?php echo lang('mycorner_update_order');?></a>
                        </h3>
                        
                  </div>	<!--end of float right -->
                  <table width="100%" border="0" class="float_left direction">
                        <tr class="float_left">
                            <td colspan="2"><h3 id="save_image_btn" ><?php echo form_submit('update',lang('mycorner_update'),'class="mycorner_button"') ?> </h3></div></td>
                        </tr>
                    </table>
                  <div class="clear"></div>
                  
                  
				<?php  echo form_close(); ?>
           
        	 </div> <!-- form -->
   
    </div><!-- End OF container -->
    


</div><!-- End OF inner body -->
</div>
