<link href="<?php echo base_url(); ?>css/mycorner.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.fileupload.css">

<script>
	jQuery(function(){

		jQuery('#status_text').hide();
		/*jQuery('#progress .progress-bar').css({
    	'background-image': 'none',
    	'background-color': '#e82327'
}		);*/

	});
</script>

<style>
#create_member_form
{
	width:97%;
}
</style>
<div id="insert_message">
	<div style="text-align:center;margin-top:60px;">
    	<h1 style="margin-bottom:25px;"><?php echo lang('mycorner_homepage_section_order_done');?></h1>
    </div>
</div>
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
                        	
   			<div style="margin: 43px 28px 22px;">
            	           
            	<div class="float_left" style="width:170px; margin:0 20px;">

                    <div id="upload_image_location" class="float_right m_10_5"  style="background-color:#FFF;border:3px dashed #b7b7b7;width:160px;height:173px;border-radius:10px;">
                         <div class="image_wrapper" id="image_wrapper" style="position:relative;" >
                            <img class="loading_image" src="<?php echo base_url()."images/loader.gif" ?>" />
                            <img style="width: 160px;height: 173px;" id="image_preview" class="member_image" src= "<?php echo base_url() ?>images/mycorner/personal_img.png " />
                        </div>
                    </div>
                   
                    <div class="upload_button_wrapper" style="margin-top:200px;line-height:23px; width:167px;" >
                        <div class="float_right" style="">
                             <form method="post" name="upload_image" enctype="multipart/form-data"  action="<?php echo site_url($this->router->class."/upload_member_image"); ?>">
                                <div class="btn btn-success fileinput-button" style="padding: 3px 0;height: 25px;margin-top: 13px;">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span style="font-weight: bold;font-size: 13px;"><?php echo lang('mycorner_choose_image'); ?></span>
                                        <!-- The file input field used as target for the file upload widget -->
                                        <input style="width: 155px;height: 33px;" type="file" name="images" id="images" multiple />
                                        
                                </div>
                                <button type="submit" style="display:none" id="btn"></button>
                            </form>
                                    
                        </div>                		
             	   </div><!-- End of upload_button_wrapper -->
                     <div id="status_image_wrapper" class="float_left" align="left">
                            <p id="status_text" style="line-height: 20px;color: #0154a0;"></p>
                            <p id="status_error_size" style="line-height: 20px;color: #0154a0;"></p> 
                        </div><!-- ENd of status_image_wrapper -->
                   
                   <div class="clear"></div>
                   
				   <?php 
                   $attributes = array('class' => '', 'id' => 'create_member_form');
                    echo form_open_multipart('',$attributes); 
                   
                    $data=array('type'=>'hidden' ,'name' => 'image_uploaded_flag' ,'value' => 0 , 'id' => 'image_uploaded_flag'); 		 
                    echo form_input($data);	 
                    
                    $data=array('type'=>'hidden' ,'name' => 'image_uploaded_name' ,'value' => '' , 'id' => 'image_uploaded_name'); 		 
                    echo form_input($data);	 
							
					$data=array('type'=>'hidden' ,'name' => 'image_uploaded_id' ,'value' => '' , 'id' => 'image_uploaded_id'); 		 
					echo form_input($data);
       
                   ?>                         
                    <table width="100%" border="0" class="float_left direction">
                        <tr>
                            <td colspan="2"><div><h3 style="margin:0px 35px;"><?php echo form_submit('update',lang('mycorner_update'),'class="mycorner_button"') ?> </h3></div></td>
                        </tr>
                    </table>
                  <div class="clear"></div>
                  
                  
				<?php  echo form_close(); ?>
              
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
						<div>
                        	<h3 style="text-align:center;"><a href="#insert_message" class="mycorner_button" id="update_order"><?php echo lang('mycorner_update_order');?></a></h3>
                        </div>
                        
                  </div>	<!--end of float right -->
           		<div class="clear"></div>
        	 </div> <!-- form -->
   
    </div><!-- End OF container -->
    


</div><!-- End OF inner body -->
</div>
<script>
(function () {
		$('.loading_image').hide();
	var input = document.getElementById("images"), 
		formdata = false;

	function showUploadedItem (source) {
  		var preview = document.getElementById("image_wrapper"),
	  		img  = document.getElementById("image_preview");
  		img.src = source;
	} 
	
	if (window.FormData) {
  		formdata = new FormData();
  		document.getElementById("btn").style.display = "none";
	}
	
 	input.addEventListener("change", function (e) {
		
	$('#status_error_size').html("");
	$('#status_text').html("");
	$('#status_text').html("<?php echo lang("globals_uploading"); ?>");
	$('#image_preview').addClass('image_opacity');
	$('.loading_image').fadeIn('fast');
	
	
	var file_list = e.target.files;

    for (var i = 0, file; file = file_list[i]; i++) 
	{
		var goUpload = true;
        var sFileName = file.name;
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
        var iFileSize = file.size;
        var iConvert = (file.size / 102400).toFixed(2);

		if (!(/\.(gif|jpg|jpeg|png)$/i).test(sFileName)) 
		{
			//common.notifyError('You must select an image file only');
			$('#status_text').fadeIn("fast").html("<?php echo lang("bestcook_uploadrecipe_invalid_format_image"); ?>");

			goUpload = false;
		}
		if (iFileSize > 2000000) // 2mb
		{ 
			//common.notifyError('Please upload a smaller image, max size is 2 MB');
			$('#status_error_size').fadeIn("fast").html("<?php echo lang("bestcook_uploadrecipe_invalid_size_image"); ?>");
			goUpload = false;
		}
		
		if (goUpload == false) 
		{
			formdata = false;
		}
    }	

 		var i = 0, len = this.files.length, img, reader, file;
	
		for ( ; i < len; i++ ) {
			file = this.files[i];
	
			if (!!file.type.match(/image.*/)) {
				if ( window.FileReader ) {
					reader = new FileReader();
					reader.onloadend = function (e) 
					{ 
						showUploadedItem(e.target.result, file.fileName);
					};
					reader.readAsDataURL(file);
				}
				if (formdata) {
					formdata.append("images[]", file);
				}
			}	
		}
	
		if (formdata) {
			$.ajax({
				url:  "<?php echo site_url($this->router->class."/upload_member_image"); ?>",
				type: "POST",
				data: formdata,
				dataType: "json",
				processData: false,
				contentType: false,
				success: function(success_array) 
				{
					$('#status_text').html("<?php echo lang("bestcook_uploadrecipe_loading_complete"); ?>");
					$('#image_preview').removeClass('image_opacity');
					$('.loading_image').fadeOut('fast');
					$('#image_uploaded_flag').val(1);
					$('#image_uploaded_name').val(success_array.name);
					$('#image_uploaded_id').val(success_array.id);
				}
			});
		}
	}, false);
}());
</script>