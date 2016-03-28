<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.fileupload.css">
<script>
$(document).ready(function(e) {
	
	$('.loading_image').hide();
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

for($i=0;$i<sizeof($display_recipe_data);$i++): 
        $id = $display_recipe_data[$i]['members_recipes_ID'];
		$url = $display_recipe_data[$i]['members_recipes_ID'];
		$image = base_url().'uploads/test/'.$display_recipe_data[$i]['images_src'];
		$title = $display_recipe_data[$i]['members_recipes_name'];
		$dish_type = $display_recipe_data[$i]['members_recipes_dish_id'];
		$main_ingredient = $display_recipe_data[$i]['members_recipes_cuisine_id'];
		$cooking_time = $display_recipe_data[$i]['members_recipes_cookingtime'];
		$nestle_product = $display_recipe_data[$i]['members_recipes_product_id'];
		$calories_id = $display_recipe_data[$i]['members_recipes_calories'];
		//$video_url = $display_recipe_data[$i]['members_recipes_url'];
		$Ingredients = $display_recipe_data[$i]['members_recipes_ing'];
		$preparation = $display_recipe_data[$i]['members_recipes_directions'];
		$desc = $display_recipe_data[$i]['members_recipes_directions'];
		$image_id = $display_recipe_data[$i]['members_recipes_image'];
		$selection_id = $display_recipe_data[$i]['members_recipes_selection_id'];
//Prepare Form Fields
$attributes = array('class' => '', 'id' => 'upload_recipe_form');

echo form_open_multipart('my_corner/edit_recipe/'.$id.'/'.$image_id, $attributes); 
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
    <td><input id="members_recipes_name" type="text" name="members_recipes_name"  value="<?php echo $title; ?>"  />
    <?php echo form_error('members_recipes_name'); ?>
    <p id="members_recipes_name_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="members_recipes_dish_id"><?php echo lang('bestcook_advancedsearch_dish'); ?> <span class="required">*</span></label></th>
    <td><?php echo form_dropdown('members_recipes_dish_id', $dish_options, set_value('members_recipes_dish_id', $dish_type))?>
    <?php echo form_error('members_recipes_dish_id'); ?>
    <p id="members_recipes_dish_id_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="members_recipes_cuisine_id"><?php echo lang('bestcook_advancedsearch_cuisines'); ?> <span class="required">*</span></label></th>
    <td><?php echo form_dropdown('members_recipes_cuisine_id', $cuisine_options, set_value('members_recipes_cuisine_id', $main_ingredient))?>
    <?php echo form_error('members_recipes_cuisine_id'); ?>
     <p id="members_recipes_cuisine_id_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="members_recipes_selection_id"><?php echo lang('bestcook_advancedsearch_selection'); ?> <span class="required">*</span></label></th>
    <td><?php echo form_dropdown('members_recipes_selection_id', $selection_options, set_value('members_recipes_selection_id', $selection_id))?>
    <?php echo form_error('members_recipes_selection_id'); ?>
     <p id="members_recipes_selection_id_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="members_recipes_cookingtime"><?php echo lang('bestcook_preparation_time'); ?> <span class="required">*</span></label></th>
    <td><?php echo form_dropdown('members_recipes_cookingtime', $duration_options, set_value('members_recipes_cookingtime', $cooking_time))?>
    <?php echo form_error('members_recipes_cookingtime'); ?>
     <p id="members_recipes_cookingtime_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="members_recipes_product_id"><?php echo lang('bestcook_nestle_product');?><span class="required"> * </span></label></th>
    <td><?php echo form_dropdown('members_recipes_product_id', $nestle_products_options, set_value('members_recipes_product_id', $nestle_product))?>
    <?php echo form_error('members_recipes_product_id'); ?>
     <p id="members_recipes_product_id_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="members_recipes_calories"><?php echo lang('bestcook_calories'); ?></label></th>
    <td><?php echo form_dropdown('members_recipes_calories', $calories_options, set_value('members_recipes_calories', $calories_id))?>
    <?php echo form_error('members_recipes_calories'); ?>
    <p id="members_recipes_calories_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <!-- Video URL -->
  <tr>
    <th scope="row"><label for="members_recipes_name"><?php echo lang('bestcook_url'); ?> </label></th>
    <td><input id="members_recipes_url" type="text" name="members_recipes_url"  value="<?php echo set_value('members_recipes_url', $get_recipe_video); ?>"  />
    <?php echo form_error('members_recipes_url'); ?>
    </td>
  </tr>
  <!-- -->
  <tr>
    <th scope="row"><label for="members_recipes_ing"><?php echo lang('bestcook_recipe_ingredients'); ?> <span class="required">*</span></label></th>
    <td><?php echo form_textarea( array( 'name' => 'members_recipes_ing', 'value' => set_value('members_recipes_ing', $Ingredients) ) )?>
    <?php echo form_error('members_recipes_ing'); ?>
    <p id="members_recipes_ing_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
  <tr>
    <th scope="row"><label for="members_recipes_directions"><?php echo lang('bestcook_recipe_method'); ?> <span class="required">*</span></label></th>
    <td><?php echo form_textarea( array( 'name' => 'members_recipes_directions', 'value' => set_value('members_recipes_directions', $preparation) ) )?>
    <?php echo form_error('members_recipes_directions'); ?>
    <p id="members_recipes_directions_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p>
    </td>
  </tr>
</table>
<div style="width:100%;" class="global_sperator_height"></div>

    <div style="width:23px; height:68px" class="float_right"></div>
    
   <div class="clear"></div>
    
    <div style="width:100%;" class="global_sperator_height"></div>
 <!-- End Makki test -->


</div><!-- ENd of float left -->

<div class="float_right" style="width:225px; ">

<div>
	<a href="<?php  echo site_url('best_cook/applications/1');?>">
		<img width="225" src="<?php echo base_url()."images/bestcook/upload_recipe_banner".$current_language_db_prefix.".jpg" ?>" />
	</a>
</div>
<?php /*?><input type="file" name="members_recipes_image" size="20" /> <?php echo $image; ?>  <?php */?>
<div style="width:100%;"></div>
<div class="upload_recipe_image_preview_wrapper" style="position:relative;" >
	<img class="loading_image" src="<?php echo base_url()."images/loader.gif" ?>" />
    <img width="225" height="180" id="image_preview" src="<?php echo $image; ?>" />
   
    <div style="width:100%;" class="global_sperator_height"></div>

    <p id="status_text" style="line-height: 20px;color: #0154a0;"></p>
    <p id="status_error_size" style="line-height: 20px;color: #0154a0;"></p>
   
    <div class="checkbox_wrapper">
    <label>
    <input id="members_recipes_image_confirmation" class="float_left" type="checkbox" name="members_recipes_image_confirmation" value="1" />
    <p class="float_left" style="width:205px; white-space:normal; color:#FFF "><?php echo lang("bestcook_uploadrecipe_validation_checkbox"); ?></p>
    <div class="clear"></div>
    <p id="members_recipes_image_confirmation_error" class="field_error"><?php echo lang('bestcook_image_validation');?></p>
    </label></div><!-- End of checkbox_wrapper -->
</div>

<input type="hidden" name="image_uploaded_flag" id="image_uploaded_flag" value="0" />
<input type="hidden" name="image_uploaded_name" id="image_uploaded_name" value="" />
<input type="hidden" name="image_uploaded_id" id="image_uploaded_id" value="" />

</div><!-- ENd of float right -->

<div class="clear"></div>

<div class="submit_button_wrapper"><div align="center"><?php 

echo form_submit( 'submit', lang('globals_send'));
 ?></div></div>

<?php echo form_close(); ?>


<?php endfor; ?>

<form method="post" style="position: relative;top: -130px;padding: 0px 304px;" name="upload_image" enctype="multipart/form-data"  action="<?php echo site_url($this->router->class."/upload_member_recipe"); ?>">
    <span class="btn btn-success fileinput-button float_right">
    	<div class="browse_button_design_wrapper">
        <div class="background"><img src="<?php echo base_url()."images/bestcook/upload_recipe_browse_button_global".$current_language_db_prefix.".png" ?>" /></div>
        <div class="icon"><img src="<?php echo base_url()."images/bestcook/upload_recipe_browse_image_icon.png" ?>" /></div>
        <div class="button_title"><?php echo lang('bestcook_uploadrecipe_browseimage_title'); ?></div>
        <div class="button_desc"><?php echo lang('bestcook_uploadrecipe_browseimage_desc'); ?></div>
        </div><!-- End of browse_button_design_wrapper -->
        <!-- The file input field used as target for the file upload widget -->
        <input type="file" name="images" id="images" multiple />
    </span>
    <button type="submit" style="display:none" id="btn"></button>
</form>

</div><!-- End of upload_background_wrapper -->

<div style="width:100%;" class="global_sperator_height"></div>


<div class="various_title_videos <?php echo $current_section_background_color ?>" style="height:40px; background:#e82327; position:relative;width: 105%;margin-left: -25px;">
	<div class="sections_wrapper_margin">
		<div class="title float_left" style="color: white;font-size: 24px;"><?php echo lang('globals_most_read'); ?></div>
    </div>
    <img width="26" style="position:absolute; left:0; top:40px;" src="<?php echo base_url(); ?>images/left_shadow.png"/>
    <img width="26" style="position:absolute; right:0; top:40px;" src="<?php echo base_url(); ?>images/right_shadow.png"/>
</div>

<?php
// Load recent recipes 
$this->load->view('my_corner/view_recent_recipes');
?>
<script>
(function () {
	var input = document.getElementById("images"), 
		formdata = false;

	function showUploadedItem (source) {
  		var preview = document.getElementById("upload_recipe_image_preview_wrapper"),
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
				url:  "<?php echo site_url($this->router->class."/upload_member_recipe"); ?>",
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
					$('.checkbox_wrapper').fadeIn("fast");
					$('#image_uploaded_flag').val(1);
					$('#image_uploaded_name').val(success_array.name);
					$('#image_uploaded_id').val(success_array.id);
				}
			});
		}
	}, false);
}());
</script>