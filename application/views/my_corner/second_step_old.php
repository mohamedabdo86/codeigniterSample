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
<?php /*?><script>
$(document).ready(function(e) {
		
	
	$("#create_member_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();
		
		//if( $("#firstname").val() == "" )
		//{
			//$("#firstname_error").fadeIn("fast");
			//state = false;
		//}


		if( $("#image_uploaded_flag").val() == 1  )
		{
			$("#members_recipes_image_confirmation_error").fadeIn("fast");		 
			state = false;
			 
		}
		
		return state;
	
	
	});    
	
});

</script><?php */?>
<style>
#create_member_form
{
	width:97%;
}

#sortable 
{ 
	width: 100%;
	margin-top: 5px;
}
#sortable li 
{ 
	height: 34px;
	cursor: pointer;
	padding: 4px;
}
#sortable li span { position: absolute; margin-left: -1.3em; }
.update_order { cursor:pointer;}
.section_order
{
	width:220px;
	height:34px;
	margin-left:2px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
}
.section_order h3
{
	text-align:center;
	color:#FFF;
	line-height:34px;

}
</style>
<script type="text/javascript">
$(document).ready(function(e) {
   
	$( "#sortable" ).disableSelection();
	$( "#sortable" ).sortable();

	<?php /*?>$('#sortable').sortable({
    axis: 'y',
    update: function (event, ui) {
        var data = $(this).sortable('serialize');

        // POST to server using $.post or $.ajax
        $.ajax({
            data: {data : data , member_id : member_id },
			url : "<?php echo site_url($this->router->class."/section_order"); ?>",
			type: "POST",
        });
    	}
	});<?php */?>
	
	$('#update_order').click(function(e) {
		
        var member_id = '<?php echo $members_id; ?>'; 
		var listArray = new Array();
		$(".ui-state-default").each(function(index, element) {
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
					alert('Done')
				  },
				  error: function(xhr, ajaxOptions, thrownError)
				  {
					
				  }
					  
				});
			
    });
	<?php /*?>$("#update_order").click(function(e) {
			
			//var index_test = 0;
			var member_id = '<?php echo $members_id; ?>'; 
			var listArray = new Array();
			
			$(".ui-state-default").each(function(index, element) {
                
				array = $(this).attr("id");
				listArray.push($(this).attr("id"));
			});
				
				alert(listArray);
			
			
			$(".ui-state-default").each(function(index, element) {
                
				var data = $(this).attr("id");
				
				$.ajax({
				  url:  "<?php echo site_url($this->router->class."/section_order"); ?>",
				  type: "POST",
				  data: {data : data , index: (index+1) , member_id : member_id },
				  cache: false,
				  //dataType: "json",
				  success: function(success_array)
				  {
					alert('Done')
				  },
				  error: function(xhr, ajaxOptions, thrownError)
				  {
					
				  }
					  
				});
            });
      });<?php */?>
	
	
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
                <div class="secondstepcircleheader num_of_circle" > 1</div>
                <div class="secondstep_border"></div>
                <div class="seconde_step_circle num_of_circle" >2</div><!--style="color:#CCC;"-->
                <div class="last_border"></div>
            </div>
                    
                    
                <div class="show_the_num">
                  <p class="num_of_page"> 2 </p>
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
                   
                    <div class="upload_button_wrapper" style="margin: 0 34px;">
                        <div align="" style="margin:5px;">
                            <div class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span><?php echo lang('mycorner_chose_your_image');?></span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input id="fileupload" type="file" name="files[]" multiple />
                            </div>
                        </div>
                        <div id="status_image_wrapper" align="left" style="width: 100%;float: left;margin-top: -25px;">
                                <p id="status_text" style="line-height: 0px;color: #0154a0;position:relative;top:21px;"></p> 
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
                            	<li id="2" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class=" section_order best_cook_background_color"><h3><?php echo lang('globals_bestcook');?></h3></div></li>
                                <li id="10" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class=" section_order best_me_background_color"><h3><?php echo lang('globals_bestme');?></h3></div></li>
                                <li id="27" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class=" section_order best_mom_background_color"><h3><?php echo lang('globals_bestmom');?></h3></div></li>
                                <li id="28" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class=" section_order best_time_background_color"><h3><?php echo lang('globals_besttime');?></h3></div></li>

                            </ul>
                        </div>
                        <div class="clear"></div>
						<div style="background-color:red;border-radius:10px;width:150px;height: 40px;">
                        	<h3 style="text-align:center;"><a class="registerbtn" id="update_order"><?php echo lang('mycorner_update_order');?></a></h3>
                        </div>
                  </div>	<!--end of float right -->
                	
                	<div class="clear"></div>                    
                    
                    <div class="clear"></div>
                     <script type="text/javascript">
	$(document).ready(function() {
	
		var MaxInputs       = 8; //maximum input boxes allowed
		var InputsWrapper   = $("#InputsWrapper"); //Input boxes wrapper ID
		var AddButton       = $("#AddMoreFileBox"); //Add button ID
		
		var x = <?php echo count($members_children)?>; //Add button ID
		
		//var x = InputsWrapper.length; //initlal text box count
		//alert(x);
		var FieldCount=1; //to keep track of text box added
		var Childname = "<?php echo lang('mycorner_child_name');?>";
		
		var Childage = "<?php echo lang('mycorner_child_age');?>";
		
		$(AddButton).click(function (e)  //on add input button click
		{
				if(x <= MaxInputs) //max input box allowed
				{
					FieldCount++; //text box added increment
					//add input box
					//$(InputsWrapper).append('<div><input type="text" name="mytext[]" id="field_'+ FieldCount +'" value="Text '+ FieldCount +'"/><a href="#" class="removeclass"> &times; </a></div>');
					$(InputsWrapper).append('<tr><td><h5> '+ Childname +'</h5></td><td><input type="text" name="children_name[]" id="field_'+ FieldCount +'" value=""/></td><td><h5> '+ Childage +'</h5></td><td><input type="text" name="children_age[]" id="field_'+ FieldCount +'" value=""><a href="#" class="removeclass float_right" style=" font-family: Verdana, Geneva, sans-serif;"> X </a></td></tr>');

					x++; //text box increment
				}
		return false;
		});
		
		$("body").on("click",".removeclass", function(e){ //user click on remove text
		
		
				if( x > 1 ) 
				{
					$(this).parent().parent('tr').remove(); //remove text box
					x--; //decrement textbox
				}
		return false;
		}) 
		
	});
    </script>

    <div id="third_row">
        <div class="float_left m_10_5" style=" width:720px; ">
      <table width="100%" border="0" class="float_left direction">
      	  <tr>
        	<td><h5><?php echo lang('mycorner_number_of_children');?></h5></td>
            <td colspan="3">
            <?php 
			$data=array( 'name' => 'members_children' ,'value' => '', 'size' => 50	); 			 
			echo form_input($data);	
			?>
            </td>        
          </tr>

        </table>
        <table id="InputsWrapper" width="100%" border="0" class="float_left direction">
         <?php
		 	$display_sting = '';
			for($i = 0; $i<sizeof($members_children);$i++)
			{
				$name = $members_children[$i]['members_children_name'];
				$age = $members_children[$i]['members_children_age'];
				
				$display_sting .= '<tr>';
				$display_sting .= '<td><h5><?php echo lang(mycorner_child_name);?></h5></td>';
				$display_sting .= '<td><input type="text" name="children_name[]" id="field_'.($i+1).'" value="'.$name.'"></td>';
				$display_sting .= ' <td><h5><?php echo lang(mycorner_child_age); ?></h5></td>';
				$display_sting .= '<td><input type="text" name="children_age[]" id="field_'.($i+1).'" value="'.$age.'"><a href="#" class="removeclass float_right" style=" font-family: Verdana, Geneva, sans-serif;"> X </a></td>';
				$display_sting .= '</tr>';
			}
				echo $display_sting;
			
			?>
				</table>
				<table width="100%" border="0" class="float_left direction">
					<tr>
						<td class="small">
							<div  style="background-color:red;border-radius:10px;width:150px;height: 40px;"><a href="#" id="AddMoreFileBox" class="registerbtn" style="padding: 0 35px;"><?php echo lang('mycorner_add_child');?></a></div>
						</td>
					</tr>
					<tr class="float_right">
						<td colspan="2"><div  style="background-color:red;border-radius:10px;width:150px;height: 40px;"><h3 style="padding:0px 13px;"><?php echo form_submit('update',lang('mycorner_update'),'class="registerbtn"') ?> </h3></div></td>
					</tr>
				</table>
				</div>
						
				<div class="clear"></div>

		
			</div><!--End of .third_row-->
            
                <?php  echo form_close(); ?>
           
        	 </div> <!-- form -->
   
    </div><!-- End OF container -->
    


</div><!-- End OF inner body -->
