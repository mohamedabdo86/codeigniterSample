<!-- Upload Function -->
<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">-->
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
<style>
.field_error {
	color: #e82327;
	display: none;
}
#upload_recipe_table tr th, #upload_recipe_table tr td {
	vertical-align: middle;
}

.ui-select .ui-btn{
	width:100%;
	
	}
</style>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url(); ?>js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url(); ?>js/jquery.iframe-transport.js"></script>
<script>
$(document).ready(function(){
	currentwidth=screen.availWidth;
	 
	        if(currentwidth >800){
		         $("#recipe_upload").attr("colspan","1");
		   }else{
		         $("#recipe_upload").attr("colspan","2");
	       }
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

<div class="row <?php echo $current_section; ?>">
  <div class="col-xs-12">
    <?php   echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png" , site_url_mobile(''.$this->router->class));?>
    <?php 
		          echo $this->mwidgets->drawCurrentSubSectionHomepageTitle($display_data[0]['sub_sections_name'.$current_language_db_prefix], lang("globals_back"), "#");
				  ?>
    <div id="related-recipe-header">
      <h1 class="<?php echo $current_section; ?>" ><?php echo $this->headers->get_third_title() ?></h1>
    </div>
    <div class="thick_line"></div>
    <imgclass="img-responsive"  width="1000px;" src="<?php echo base_url()."images/bestcook/best_cook_upload_recipe_top_banner".$current_language_db_prefix.".jpg" ?>" /> </div>
    
 <?php
if(!$this->members->members_id):
//echo "عليك التسجيل اولا";

$this->load->view('mobile/my_corner/view_login_form');

return;
endif;
?>
  <div class="col-xs-12" style="background:#f8d19a" >
    <?php
//Get Dropmenu lists
$dish_options= $this->recipesmodel->get_dishes($current_language_db_prefix , true , lang("bestcook_advancedsearch_dish") );
$cuisine_options= $this->recipesmodel->get_cuisines($current_language_db_prefix , true , lang("bestcook_advancedsearch_cuisines") );
$selection_options= $this->recipesmodel->get_selections($current_language_db_prefix , true , lang("bestcook_advancedsearch_selection"));
$nestle_products_options= $this->recipesmodel->get_recipe_products($current_language_db_prefix , true , lang("bestcook_advancedsearch_nestle_products"));
$duration_options =$this->recipesmodel->get_duration_options(lang("bestcook_advancedsearch_duration"));
$calories_options =$this->recipesmodel->get_calories_options(lang("bestcook_advancedsearch_calories"));
				 

 
//Prepare Form Fields
$attributes = array('class' => '', 'id' => 'upload_recipe_form', 'data-ajax' => 'false');

echo form_open_multipart(site_url_mobile('best_cook/upload_recipe'), $attributes); 
?>
    <?php
if($success == "success"):
?>
    <p align="center" style="font-size:18px;"><?php echo lang('bestcok_added_approve');?></p>
    <?php
endif;
?>
   <?php
if($_GET['img_error'] ==1):
?>
    <p align="center" style="font-size:18px;"><?php echo lang('upload_file_exceeds_form_limit');?></p>
    <?php
endif;
?>


   
      <table class="table" border="0" cellspacing="0" cellpadding="0" id="upload_recipe_table">
        <tr>
          <td><label for="members_recipes_name"><?php echo lang('bestcook_recipe_name'); ?> <span class="required">*</span></label></td>
          <td><input id="members_recipes_name" type="text" name="members_recipes_name"  value="<?php echo set_value('members_recipes_name'); ?>"  />
            <?php echo form_error('members_recipes_name'); ?>
            <p id="members_recipes_name_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p></td>
        </tr>
        <tr>
          <td><label for="members_recipes_dish_id"><?php echo lang('bestcook_advancedsearch_dish'); ?> <span class="required">*</span></label></td>
          <td><?php echo form_dropdown('members_recipes_dish_id', $dish_options, set_value('members_recipes_dish_id'))?> <?php echo form_error('members_recipes_dish_id'); ?>
            <p id="members_recipes_dish_id_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p></td>
        </tr>
        <tr>
          <td><label for="members_recipes_cuisine_id"><?php echo lang('bestcook_advancedsearch_cuisines'); ?> <span class="required">*</span></label></td>
          <td><?php echo form_dropdown('members_recipes_cuisine_id', $cuisine_options, set_value('members_recipes_cuisine_id'))?> <?php echo form_error('members_recipes_cuisine_id'); ?>
            <p id="members_recipes_cuisine_id_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p></td>
        </tr>
        <tr>
          <td><label for="members_recipes_selection_id"><?php echo lang('bestcook_advancedsearch_selection'); ?> <span class="required">*</span></label></td>
          <td><?php echo form_dropdown('members_recipes_selection_id', $selection_options, set_value('members_recipes_selection_id'))?> <?php echo form_error('members_recipes_selection_id'); ?>
            <p id="members_recipes_selection_id_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p></td>
        </tr>
        <tr>
          <td><label for="members_recipes_cookingtime"><?php echo lang('bestcook_preparation_time'); ?> <span class="required">*</span></label></td>
          <td><?php echo form_dropdown('members_recipes_cookingtime', $duration_options, set_value('members_recipes_cookingtime'))?> <?php echo form_error('members_recipes_cookingtime'); ?>
            <p id="members_recipes_cookingtime_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p></td>
        </tr>
        <tr>
          <td><label for="members_recipes_product_id"><?php echo lang('bestcook_nestle_product');?><span class="required"> * </span></label></td>
          <td><?php echo form_dropdown('members_recipes_product_id', $nestle_products_options, set_value('members_recipes_product_id'))?> <?php echo form_error('members_recipes_product_id'); ?>
            <p id="members_recipes_product_id_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p></td>
        </tr>
        <tr>
          <td scope="row"><label for="members_recipes_calories"><?php echo lang('bestcook_calories'); ?></label></td>
          <td><?php echo form_dropdown('members_recipes_calories', $calories_options, set_value('members_recipes_calories'))?> <?php echo form_error('members_recipes_calories'); ?>
            <p id="members_recipes_calories_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p></td>
        </tr>
        <!-- Video URL -->
        <tr>
          <td><label for="members_recipes_name"><?php echo lang('bestcook_url'); ?> </label></td>
          <td><input id="members_recipes_url" type="text" name="members_recipes_url"  value="<?php echo set_value('members_recipes_url'); ?>"  />
            <?php echo form_error('members_recipes_url'); ?>
            <p id="members_recipes_url_error" class="field_error"><?php echo "رابط الفيديو غير صحيح" ?></p></td>
        </tr>
        <!-- -->
        <tr>
          <td><label for="members_recipes_ing"><?php echo lang('bestcook_recipe_ingredients'); ?> <span class="required">*</span></label></td>
          <td><?php echo form_textarea( array( 'name' => 'members_recipes_ing', 'value' => set_value('members_recipes_ing') , 'style' => 'margin-top: 5px;' ) )?> <?php echo form_error('members_recipes_ing'); ?>
            <p id="members_recipes_ing_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p></td>
        </tr>
        <tr>
          <td><label for="members_recipes_directions"><?php echo lang('bestcook_recipe_method'); ?> <span class="required">*</span></label></td>
          <td><?php echo form_textarea( array( 'name' => 'members_recipes_directions', 'value' => set_value('members_recipes_directions') , 'style' => 'margin-top: 5px;' ) )?> <?php echo form_error('members_recipes_directions'); ?>
            <p id="members_recipes_directions_error" class="field_error"><?php echo lang('bestcook_field_required'); ?></p></td>
        </tr>
        <tr>
          <td id="recipe_upload" colspan="">
          
          <input  style="" id="fileupload" type="file" name="recipe_file_upload">
            <input type="hidden" name="image_uploaded_flag" id="image_uploaded_flag" value="0" />
            <input type="hidden" name="image_uploaded_name" id="image_uploaded_name" value="" /></td>
        </tr>
        <tr>
          <td colspan="2"><div class="submit_button_wrapper">
            <div align="center"><?php echo form_submit( 'submit', lang('globals_send')); ?></div></td>
        </tr>
      </table>
    </div>
    
    <div style="width:100%;" class="global_sperator_height"></div>
    <!-- The global progress bar -->
    <div style="width:100%;" class="global_sperator_height"></div>
    <!-- End Makki test --> 
    
    <?php echo form_close(); ?> </div>
  <!-- col-xs-12 END -->
  <div class="col-xs-12">
    <div style="width:100%;" class="global_sperator_height"></div>
    <div class="various_title_videos <?php echo $current_section_background_color ?>" style="height:40px; background:#e82327; position:relative;">
      <div class="sections_wrapper_margin">
        <div class="title float_left" style="color: white;font-size: 24px; padding:2px 16px"><?php echo lang('globals_most_read'); ?></div>
      </div>
      <img width="26" style="position:absolute; left:0; top:40px;" src="<?php echo base_url(); ?>images/left_shadow.png"/> <img width="26" style="position:absolute; right:0; top:40px;" src="<?php echo base_url(); ?>images/right_shadow.png"/> </div>
  </div>
  
  <!-- ********************* Recent Items List ************************ -->
  <div class="col-xs-12 recent_items_list_wrapper">
    <div class="recent_items_list row">
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
		$url = site_url_mobile($this->router->class."/".$inner_recipe_method."/".generateSeotitle($id ,$title ));
		$share_image = base_url()."images/share_image.png";
		$member_name = "";
		if($members_list_flag)
		$member_name = $this->members->get_member_name_by_id($display_recent_data[$i]['members_recipes_members_id']);
		
		//$id = 1;
		//$title = "Test";
					
		//$image  = "http://cdn.pimg.co/p/215x165/858652/fff/img.png";
		 
		//$url = "";
		
		 
		
		?>
      <div class="col-xs-12 col-sm-4">
        <div class="image global_sperator_margin_bottom"><a rel="external" href="<?php echo $url ?>"><img class="img-responsive img_recipe_list" src="<?php echo $image;?>" alt="" style="width:100%;" ></a></div>
        <div class="title float_left dark_gray" style="height:auto;">
          <div style="margin:0px 5px;"><a rel="external" href="<?php echo $url ?>"><?php echo $title;?>
            <h4 class="best_cook_color global_sperator_margin_top"><?php echo $member_name ?></h4>
            </a></div>
        </div>
        <?php /*?><div class="social float_left" style="line-height: 13px;">
                <?php
                $params = array('url' => $url, 'title' => $title);
                echo $this->sharing->sharing_function($params); 
                
                ?>
                
                </div><!--End Of .social--><?php */?>
      </div>
      <?php
		endfor;
		?>
    </div>
    <!--- End of recent_items_list --> 
    
  </div>
  <!-- End of recent_items_list_wrapper col-xs-12 --> 
</div>