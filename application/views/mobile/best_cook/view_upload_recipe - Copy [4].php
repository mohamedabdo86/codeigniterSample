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
					$('.checkbox_wrapper').fadeIn("fast");
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
		jQuery(".recent_items_list").jCarouselLite({
			btnNext: ".recentitem_prev",
			btnPrev: ".recentitem_next",
			visible:4
		});

	});
</script>
<script>

function parseVideoUrl (data) {
    data.match(/http:\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be))\/(video\/|embed\/|watch\?v=)?([A-Za-z0-9._%-]*)(\&\S+)?/);
 
    var match = {
        provider: null,
        url: RegExp.$2,
        id: RegExp.$5
    }
 
    if(match.url == 'youtube.com' || match.url == 'youtu.be'){
        var request = $.ajax({
            url: 'http://gdata.youtube.com/feeds/api/videos/'+match.id,
            timeout: 5000,
            success: function(){
                match.provider = 'YouTube';
            }
        });
    }
 
    if(match.url == 'vimeo.com'){
        var request = $.ajax({
            url: 'http://vimeo.com/api/v2/video/'+match.id+'.json',
            timeout: 5000,
            dataType: 'jsonp',
            success: function(){
                match.provider = 'Vimeo';
            }
        });
    }
 
    if(request){
        request.always(function(){
            if(match.provider)
                alert('Found valid video:\n\nProvider: '+match.provider+'\nVideo ID: '+match.id);
            else
                alert('Unable to locate a valid video ID');
 
            $('#video_string_button').text('Process').removeAttr('disabled');
        });
 
        return true;
    }
 
    return false;
 
}
	

$(document).ready(function(e) {
	
	function ytVidId(url) {
    var p = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
    return (url.match(p)) ? RegExp.$1 : false;
}

$('#members_recipes_url').bind("change", function() {

    var url = $(this).val();
    if (ytVidId(url) !== false) {
    	$("#members_recipes_url_error").fadeOut("fast");
		state = true;					 
	} else {
        $("#members_recipes_url_error").fadeIn("fast");					 
			state = false;
    }
});
	
	$("#upload_recipe_form").submit(function(e) {
    	 
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
		/*if( $("select[name=members_recipes_calories]").val() == "" )
		{	
			$("#members_recipes_calories_error").fadeIn("fast");				 
			state = false;
		}*/
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

</script>

<div class="clear"></div>
<?php echo $this->load->view('template/submenu_writer');   ?>
<?php echo $this->load->view('template/tree_menu_writer');   ?>



<div class="clear"></div>

<div class="inner_title_wrapper">

<div class="sections_wrapper_padding white_background_color" >
<h1 class="best_cook_color"><?php echo $this->headers->get_third_title(); ?></h1>
</div>

</div><!-- End of inner_title_wrapper -->

<div class="thick_line best_cook_background_color"  ></div>



<div class="clear"></div>

<div class="top_banner" style="width:100%; height:243px;"><img width="1000px;" src="<?php echo base_url()."images/bestcook/best_cook_upload_recipe_top_banner".$current_language_db_prefix.".jpg" ?>" />
</div>

<?php
if(!$this->members->members_id):
//echo "عليك التسجيل اولا";

$this->load->view('template/view_login_form');
return;
endif;
?>


<div class="sections_wrapper_padding" style="background:#f8d19a" >


<?php
//Get Dropmenu lists
$dish_options= $this->recipesmodel->get_dishes($current_language_db_prefix , true , lang("bestcook_advancedsearch_dish") );
$cuisine_options= $this->recipesmodel->get_cuisines($current_language_db_prefix , true , lang("bestcook_advancedsearch_cuisines") );
$selection_options= $this->recipesmodel->get_selections($current_language_db_prefix , true , lang("bestcook_advancedsearch_selection"));
$nestle_products_options= $this->recipesmodel->get_recipe_products($current_language_db_prefix , true , lang("bestcook_advancedsearch_nestle_products"));
$duration_options =$this->recipesmodel->get_duration_options(lang("bestcook_advancedsearch_duration"));
$calories_options =$this->recipesmodel->get_calories_options(lang("bestcook_advancedsearch_calories"));
				 

 
//Prepare Form Fields
$attributes = array('class' => '', 'id' => 'upload_recipe_form');

echo form_open_multipart('best_cook/upload_recipe', $attributes); 
?>

<div class="member_name_wrapper" style="height:65px;" >
<div class=" special_start float_left"></div>
<div class="member_name special_textwrapping float_left">"<?php echo lang('globals_welcome');?> <?php echo $this->members->members_fullname  ?>"</div>
<div class=" special_end float_left"></div>
</div>

<div class="clear"></div>
<?php
if($success == "success"):
?>
<p align="center" style="font-size:18px;"><?php echo lang('bestcok_added_approve');?></p>
<?php
endif;
?>

<div class="float_left" style="width:715px;">

<table   border="0" cellspacing="0" cellpadding="0" id="upload_recipe_table">
  <tr>
    <th scope="row"><label for="members_recipes_name"><?php echo lang('bestcook_recipe_name'); ?> <span class="required">*</span></label></th>
    <td><input id="members_recipes_name" type="text" name="members_recipes_name"  value="<?php echo set_value('members_recipes_name'); ?>"  />
    <?php echo form_error('members_recipes_name'); ?>
    <p id="members_recipes_name_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="members_recipes_dish_id"><?php echo lang('bestcook_advancedsearch_dish'); ?> <span class="required">*</span></label></th>
    <td><?php echo form_dropdown('members_recipes_dish_id', $dish_options, set_value('members_recipes_dish_id'))?>
    <?php echo form_error('members_recipes_dish_id'); ?>
    <p id="members_recipes_dish_id_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="members_recipes_cuisine_id"><?php echo lang('bestcook_advancedsearch_cuisines'); ?> <span class="required">*</span></label></th>
    <td><?php echo form_dropdown('members_recipes_cuisine_id', $cuisine_options, set_value('members_recipes_cuisine_id'))?>
    <?php echo form_error('members_recipes_cuisine_id'); ?>
     <p id="members_recipes_cuisine_id_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="members_recipes_selection_id"><?php echo lang('bestcook_advancedsearch_selection'); ?> <span class="required">*</span></label></th>
    <td><?php echo form_dropdown('members_recipes_selection_id', $selection_options, set_value('members_recipes_selection_id'))?>
    <?php echo form_error('members_recipes_selection_id'); ?>
     <p id="members_recipes_selection_id_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="members_recipes_cookingtime"><?php echo lang('bestcook_preparation_time'); ?> <span class="required">*</span></label></th>
    <td><?php echo form_dropdown('members_recipes_cookingtime', $duration_options, set_value('members_recipes_cookingtime'))?>
    <?php echo form_error('members_recipes_cookingtime'); ?>
     <p id="members_recipes_cookingtime_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="members_recipes_product_id"><?php echo lang('bestcook_nestle_product');?><span class="required"> * </span></label></th>
    <td><?php echo form_dropdown('members_recipes_product_id', $nestle_products_options, set_value('members_recipes_product_id'))?>
    <?php echo form_error('members_recipes_product_id'); ?>
     <p id="members_recipes_product_id_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="members_recipes_calories"><?php echo lang('bestcook_calories'); ?></label></th>
    <td><?php echo form_dropdown('members_recipes_calories', $calories_options, set_value('members_recipes_calories'))?>
    <?php echo form_error('members_recipes_calories'); ?>
    <p id="members_recipes_calories_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <!-- Video URL -->
  <tr>
    <th scope="row"><label for="members_recipes_name"><?php echo lang('bestcook_url'); ?> </label></th>
    <td><input id="members_recipes_url" type="text" name="members_recipes_url"  value="<?php echo set_value('members_recipes_url'); ?>"  />
    <?php echo form_error('members_recipes_url'); ?>
    <p id="members_recipes_url_error" class="field_error"><?php echo "رابط الفيديو غير صحيح" ?></p>
    </td>
  </tr>
  <!-- -->
  <tr>
    <th scope="row"><label for="members_recipes_ing"><?php echo lang('bestcook_recipe_ingredients'); ?> <span class="required">*</span></label></th>
    <td><?php echo form_textarea( array( 'name' => 'members_recipes_ing', 'value' => set_value('members_recipes_ing') , 'style' => 'width: 532px;margin-top: 5px;' ) )?>
    <?php echo form_error('members_recipes_ing'); ?>
    <p id="members_recipes_ing_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="members_recipes_directions"><?php echo lang('bestcook_recipe_method'); ?> <span class="required">*</span></label></th>
    <td><?php echo form_textarea( array( 'name' => 'members_recipes_directions', 'value' => set_value('members_recipes_directions') , 'style' => 'width: 532px;margin-top: 5px;' ) )?>
    <?php echo form_error('members_recipes_directions'); ?>
    <p id="members_recipes_directions_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
</table>
<div style="width:100%;" class="global_sperator_height"></div>
<!-- Start Makki test -->
<!-- The fileinput-button span is used to style the file input field as button -->
    <div class="float_left" style=" width:178px; height:50px;"></div>
    <span class="btn btn-success fileinput-button float_left">
    	<div class="browse_button_design_wrapper">
        <div class="background"><img src="<?php echo base_url()."images/bestcook/upload_recipe_browse_button_global".$current_language_db_prefix.".png" ?>" /></div>
        <div class="icon"><img src="<?php echo base_url()."images/bestcook/upload_recipe_browse_image_icon.png" ?>" /></div>
        <div class="button_title"><?php echo lang('bestcook_uploadrecipe_browseimage_title'); ?></div>
        <div class="button_desc"><?php echo lang('bestcook_uploadrecipe_browseimage_desc'); ?></div>
        </div><!-- End of browse_button_design_wrapper -->
        <!-- The file input field used as target for the file upload widget -->
        <input  style="width: 347px;height: 70px;" id="fileupload" type="file" name="files[]" multiple>
    </span>

    <div class="clear"></div>
    <div style="width:23px; height:25px" class="float_right"></div>
    
   <?php /*?> <img id="test_change" src="http://cdn.pimg.co/p/100x75/858652/fff/img.png" /><?php */?>
   <div class="clear"></div>
   <div style="width:100%;" class="global_sperator_height"></div>
    <!-- The global progress bar -->
    <p id="status_text"><?php echo lang("bestcook_uploadrecipe_loading_message"); ?> <span id="percentage">0%</span></p>
    <div id="progress" class="progress progress-striped active">
        <!--<div class="progress-bar progress-bar-success"></div>-->
        <div class="progress-bar progress-bar-danger"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" ></div>
    </div>
    <div style="width:100%;" class="global_sperator_height"></div>
 <!-- End Makki test -->


</div><!-- ENd of float left -->

<div class="float_right" style="width:225px; ">

<div>
	<a href="<?php  echo site_url('best_cook/applications/1');?>">
<img width="225" src="<?php echo base_url()."images/bestcook/upload_recipe_banner".$current_language_db_prefix.".jpg" ?>" />
	</a>
</div>
<?php /*?><input type="file" name="members_recipes_image" size="20" /><?php */?>
<div style="width:100%;"></div>
<div class="upload_recipe_image_preview_wrapper" >
<img width="225" height="180" id="image_preview" src="<?php echo base_url()."images/bestcook/upload_recipe_image_preview".$current_language_db_prefix.".png"; ?>" />
<div class="checkbox_wrapper"><label>
<input id="members_recipes_image_confirmation" class="float_left" type="checkbox" name="members_recipes_image_confirmation" value="1" />
<p class="float_left" style="width:205px; white-space:normal; color:#FFF; font-size:15px; "><?php echo lang("bestcook_uploadrecipe_validation_checkbox"); ?></p>
<div class="clear"></div>
<p id="members_recipes_image_confirmation_error" class="field_error"><?php echo lang('bestcook_image_validation');?></p>
</label></div><!-- End of checkbox_wrapper -->
</div>

<input type="hidden" name="image_uploaded_flag" id="image_uploaded_flag" value="0" />
<input type="hidden" name="image_uploaded_name" id="image_uploaded_name" value="" />



</div><!-- ENd of float right -->

<div class="clear"></div>

<div class="submit_button_wrapper"><div align="center"><?php 

echo form_submit( 'submit', lang('globals_send'));
 ?></div></div>

<?php echo form_close(); ?>

</div><!-- End of upload_background_wrapper -->

<div style="width:100%;" class="global_sperator_height"></div>


<div class="various_title_videos <?php echo $current_section_background_color ?>" style="height:40px; background:#e82327; position:relative;width: 105%;margin-left: -25px;">
	<div class="sections_wrapper_margin">
		<div class="title float_left" style="color: white;font-size: 24px;"><?php echo lang('globals_most_read'); ?></div>
    </div>
    <img width="26" style="position:absolute; left:0; top:40px;" src="<?php echo base_url(); ?>images/left_shadow.png"/>
    <img width="26" style="position:absolute; right:0; top:40px;" src="<?php echo base_url(); ?>images/right_shadow.png"/>
</div>



<div class="recent_items_list_wrapper" style="height:270px; background-color:#fff;">

    <div class="sections_wrapper_margin" style="padding-top: 10px;" >
    
        <a class="recentitem_prev float_right" style="cursor:pointer"><img src="<?php echo base_url()?>images/icons/right_arrow.png" /></a>
        <a class="recentitem_next float_left" style="cursor:pointer"><img src="<?php echo base_url()?>images/icons/left_arrow.png" /></a>
        <div class="recent_items_list">
        <ul>
        <?php
		//Fix for the lists in order to apply both members and admin members in one lists
		$id_column = $members_list_flag ? "members_recipes_ID" : "recipes_ID";
		$title_column = $members_list_flag ? "members_recipes_name" : 'recipes_title'.$current_language_db_prefix;
		$view_column = $members_list_flag ? "members_recipes_views" : "recipes_views";
		$image_url =  $members_list_flag ?  $this->config->item('users_recipes_img_link') : $this->config->item('recipes_img_link');
		//$view_column = $members_list_flag ? "" : "";
		$table_name_for_rate  = $members_list_flag ? "members_recipes" : "recipes";
		$inner_recipe_method = $members_list_flag ? "your_recipes" : "delicious_recipes";
		for($i=0 ; $i < sizeof($display_recent_data); $i++):
		$id =$display_recent_data[$i][$id_column];
		$title = $display_recent_data[$i][$title_column];
		//$image = base_url()."images/recipes_165.png";
		//$image  = $image_url.$display_recent_data[$i]['images_src'];
		$image  = $display_recent_data[$i]['images_src'] == "logo.png" ? base_url()."uploads/recipes/image_not_available".$current_language_db_prefix.".png" :  $image_url.$display_recent_data[$i]['images_src'];

		$views = $display_recent_data[$i][$view_column];
		$url = site_url($this->router->class."/".$inner_recipe_method."/".generateSeotitle($id ,$title ));
		$share_image = base_url()."images/share_image.png";
		$member_name = "";
		if($members_list_flag)
		$member_name = $this->members->get_member_name_by_id($display_recent_data[$i]['members_recipes_members_id']);
		
		//$id = 1;
		//$title = "Test";
					
		//$image  = "http://cdn.pimg.co/p/215x165/858652/fff/img.png";
		 
		//$url = "";
		
		 
		
		?>
        	<li style="height:270px;">
            <div class="image global_sperator_margin_bottom"><a href="<?php echo $url ?>"><img src="<?php echo $image;?>" alt=""  ></a></div>
            <div class="title float_left dark_gray" style="height:auto;"><div style="margin:0px 5px;"><a href="<?php echo $url ?>"><?php echo $title;?><h4 class="best_cook_color global_sperator_margin_top"><?php echo $member_name ?></h4></a></div></div>
           
               <?php /*?><div class="social float_left" style="line-height: 13px;">
                <?php
                $params = array('url' => $url, 'title' => $title);
                echo $this->sharing->sharing_function($params); 
                
                ?>
                
                </div><!--End Of .social--><?php */?>
            
            <div class="clear"></div>
			</li>
        <?php
		endfor;
		?>
            
            
        </ul>

    
    </div><!--- End of recent_items_list -->


</div><!-- End of sections_wrapper_margin -->


</div><!-- End of recent_items_list_wrapper -->