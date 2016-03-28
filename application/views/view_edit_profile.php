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
<?php /*?><script>
$(document).ready(function(e) {
	
	$("#upload_member_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();
		
		if( $("#members_recipes_name").val() == "" )
		{
			$("#members_recipes_name_error").fadeIn("fast");
			state = false;
		}
		if( $("select[name=members_recipes_dish_id]").val() == "" )
		{
			$("#members_recipes_dish_id_error").fadeIn("fast");					 
			state = false;
		}
		if( $("select[name=members_recipes_cuisine_id]").val() == "" )
		{
			$("#members_recipes_cuisine_id_error").fadeIn("fast");					 
			state = false;
		}
		if( $("select[name=members_recipes_selection_id]").val() == "" )
		{
			$("#members_recipes_selection_id_error").fadeIn("fast");					 
			state = false;
		}
		if( $("select[name=members_recipes_cookingtime]").val() == "" )
		{
			$("#members_recipes_cookingtime_error").fadeIn("fast");					 
			state = false;
		}
		if( $("select[name=members_recipes_product_id]").val() == "" )
		{	
			$("#members_recipes_product_id_error").fadeIn("fast");				 
			state = false;
		}
		if( $("select[name=members_recipes_calories]").val() == "" )
		{	
			$("#members_recipes_calories_error").fadeIn("fast");				 
			state = false;
		}
		if( $("textarea[name=members_recipes_ing]").val() == "" )
		{
			$("#members_recipes_ing_error").fadeIn("fast");					 
			state = false;
		}
		if( $("textarea[name=members_recipes_directions]").val() == "" )
		{
			$("#members_recipes_directions_error").fadeIn("fast");					 
			state = false;
		}
		if( $("#image_uploaded_flag").val() == 1  )
		{
			if( $("#members_recipes_image_confirmation").prop('checked') != true )
			{
				 $("#members_recipes_image_confirmation_error").fadeIn("fast");		 
				state = false;
			}
			 
		}
		
		return state;
	
	
	});    
	
});

</script><?php */?>

<!--Date picker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script>
  $(function() {
    //$("#datepicker").datepicker("dateFormat", "yy-mm-dd");
	$("#datepicker").datepicker({ 
		dateFormat: "yy-mm-dd" ,
		changeMonth: true,
      	changeYear: true ,
	  })
  });
  </script>



<div class="clear"></div>
<?php // echo $this->load->view('template/tree_menu_writer');   ?>

<div class="clear"></div>

<div class="inner_title_wrapper">

<div class="sections_wrapper_padding white_background_color" >
<h1 class="<?php echo $current_section_color ?>"><span class="rightword"> تطبيقات نستله</span> 
<span class="leftword"> لتغذية افضل لأسرتك</span></h1>
</div>

</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>" style="margin-top:0px; margin-bottom:0px;"></div>

<div class="global_background">
	<div class="center">
		
    <div style="padding:10px" class="direction">
       <?php 
	   $attributes = array('class' => '', 'id' => 'upload_member_form');
	   echo form_open_multipart('member/edit_profile', $attributes); ?>
 
 <?php  
  
    for($i=0;$i<sizeof($members_info);$i++){	   ?>
    
    <table width="60%" border="0" class="float_left">
		<tr>
        	<td width="25%"><h5>First name</h5></td>
        	<td width="65%">
			<?php 
			$data=array( 'name' => 'firstname' , 'value' => $members_info[0]['members_first_name'], 'size' => 50);                  
            echo form_input($data);	 
            ?>
            </td>
        </tr>   
        <tr>        
            <td><h5>Last name</h5></td>
       		<td>
         	<?php 
			$data=array( 'name' => 'lastname' ,'value' => $members_info[0]['members_last_name'], 'size' => 50); 			 
			echo form_input($data);	 
			?>
            </td>
        </tr>
        <tr>
        	<td><h5>email</h5></td>
            <td>
            <?php 
			$data=array( 'name' => 'email' ,'value' => $members_info[0]['members_email'], 'size' => 50	); 			 
			echo form_input($data);	
			?>
            </td>        

         </tr>  
         <?php /*?><tr>
         	  <td><h5> change password</h5></td>  
              <td>
              <?php 
		 	  $data=array( 'name' => 'changepassword' ,'value' => "" , 'size' => 50); 
			  echo form_password($data);
			  ?>
            </td>
         </tr><?php */?>
         <tr>
         	<td><h5>mobile</h5></td>
			<td>
             	<?php 
			 	$data=array( 'name' => 'mobile' ,'value' => $members_info[0]['members_mobile'] , 'size' => 50 ); 
			  	echo form_input($data);	 
			 	?>
            </td>
        </tr>
        <tr>
             <td><h5>Birthdate</h5></td>
             <td>
                 <?php 
				 $data=array( 'name' => 'birthdate' , 'id' => 'datepicker','value' => $members_info[0]['members_birthdate'] , 'size' => 50); 		 
				  echo form_input($data); 
			     ?>
             </td>
        </tr>
        <tr>
        	<td><h5>children</h5></td>
            <td>
            	<?php 
		 		$data=array( 'name' => 'children' ,'value' => $members_info[0]['members_children'] , 'size' => 50); 		 
				echo form_input($data);	 
				?> 
            </td>
 		</tr>
        <tr> 
        	<td><h5>news letters</h5></td>
            <td>
             <?php 
					if($members_info[0]['members_newsletter'] == '-1')
					{
						$data=array('name' =>'newsletter','value' =>'-1' ,'checked' => true);  
					}
					else
					{
						$data=array('name' =>'newsletter','value' =>'-1' ); 
					}
					 echo  form_checkbox($data);
			?> 
            </td>
		</tr>
        <?php /*?><tr>
        	<td><h5>change image </h5></td>
            <td><input id="fileupload" type="file" name="files[]" multiple /></td>
   		</tr><?php */?>
        <tr>
        <td colspan="2">
        <div class="upload_button_wrapper">
                <div align="right">
                	<div class="btn btn-success fileinput-button">
        			<i class="glyphicon glyphicon-plus"></i>
        			<span>اختار الصورة</span>
        			<!-- The file input field used as target for the file upload widget -->
        			<input id="fileupload" type="file" name="files[]" multiple />
    				</div>
                </div>
                <div id="status_image_wrapper" align="left" style="width: 60%;float: left;margin-top: -25px;">
                		<p id="status_text" style="line-height: 0px;color: #0154a0;"></p> 
						<div style="position:relative;top:5px;" id="progress" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" ></div></div><!-- ENd of progress -->
                        <div style=" width:100%" id="image_error" class="bubble"></div>
                </div><!-- ENd of status_image_wrapper -->
              </div><!-- End of upload_button_wrapper -->
        <td>
        </tr>
        <tr>
        	<td colspan="2"><?php echo form_submit('update','Update') ?></td>
        </tr>
        
        <?php 
			$data=array('type'=>'hidden' ,'name' => 'image_uploaded_flag' ,'value' => 0 , 'id' => 'image_uploaded_flag'); 		 
			echo form_input($data);	 
			
			$data=array('type'=>'hidden' ,'name' => 'image_uploaded_name' ,'value' => '' , 'id' => 'image_uploaded_name'); 		 
			echo form_input($data);	 
		?>
       
        <?php //echo form_close(); ?>
        </table>

        
        <div id="upload_image_location" class="float_right" style="width:390px">
            	<div class="image_wrapper">
                    <img style="max-width: 390px;" id="image_preview" class="member_image" src="<?php echo base_url()."uploads/members/".$members_info[0]['images_src']; ?>" />
                </div>

            </div>

        <div class="clear"></div>
        
     <?php } ?>
  
     	</div>
        

        <?php  echo form_close(); ?>
	   
        <div class="clear"></div>
	</div>
	


</div>














