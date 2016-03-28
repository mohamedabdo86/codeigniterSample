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
<script type="text/javascript">
$(document).ready(function(e) {
	$('.edit_button').click(function(e) {
        var type = $(this).attr('id');
		//alert(type);
		//$(this).children('.load_async').show();
    });
    
});
</script>

<?php
// if not logged in -> redirect to hompage


$name = $members_info[0]['members_first_name'] ." ".$members_info[0]['members_last_name'];
$birthdate = date("d / m / Y" , strtotime($members_info[0]['members_birthdate']));

date_default_timezone_set("Egypt");
$current_year = date("Y");
$birthdate_year = date("Y", strtotime($members_info[0]['members_birthdate']));
$age = $current_year - $birthdate_year;

$image = $current_member_image;

$address = $members_info[0]['members_address'];
$current_city = $members_info[0]['members_city_id'];

$email = $members_info[0]['members_email'];
$mobile = $members_info[0]['members_mobile'];
$childern = $members_info[0]['members_children'];

$current_relationship = $members_info[0]['members_relationship_id'];

if($current_relationship != 0)
{
	$relationship = $this->membersmodel->get_relationship($current_language_db_prefix , false , '' , $current_relationship);
	$relationship_value = $relationship[0]['relationship_title'.$current_language_db_prefix];
}
else
{
	$relationship_value = '';
}

if($current_city != 0)
{
	$city = $this->membersmodel->get_city($current_language_db_prefix , false , '' , $current_city);
	$city_value = $city[0]['city_title'.$current_language_db_prefix];
}
else
{
	$city_value = '';
}

?>
 
<?php //$this->load->view('template/submenu_writer');   ?>

<?php $this->load->view('template/tree_menu_writer');   ?>

<div class="clear"></div>

<div class="inner_title_wrapper" style="margin-top: 8px;">

<div class="sections_wrapper_padding white_background_color" >
<h1 class="<?php echo $current_section_color ?>"><?php echo lang('mycorner_my_corner');?></h1>
</div>

</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>" style="margin-top:0px; margin-bottom:0px;"></div>

<div class="profile_container" style="background-image:url('<?php echo base_url()."images/mycorner/profile_bg.jpg"; ?>')">
    <div id="first_row">
        <div class="float_left left_div background_animation ">
        	<div class="float_right dashed m_10_5" style="width:390px; height:264px;">
            	<div class="member_info" style="margin: 40px 20px;">
                	<h3><?php echo lang('mycorner_name');?> : <?php echo $name ?></h3>
                    <h3><?php echo lang('mycorner_marital_status');?> : <?php echo $relationship_value; ?></h3>
                    <h3><?php echo lang('mycorner_age');?> : <?php echo $age?> <?php echo lang('mycorner_year');?></h3>
                    <h3><?php echo lang('mycorner_birthdate');?> : <?php echo $birthdate;?></h3>
                </div>
            	
            </div>
            <div class="float_left m_10_5">
                <img style="width: 230px; height:265px;" id="image_preview" class="member_image" src="<?php echo base_url()."uploads/members/".$image; ?>" />
            </div>
            <div class="edit_animation float_right">
                <div style="margin: 10px 36px;">
                    <a class="edit_button" id="info" href="<?php echo site_url($this->router->class."/edit_profile/info") ?>" >
                        <h4 class="float_left white_color"><?php echo lang('mycorner_edit_details');?></h4>
                        <img class="float_left" style="margin: 0 8px;" src="<?php echo base_url()."images/mycorner/edit_icon.png"?>"  />
                        <img class="load_async" src="<?php echo base_url()."images/mycorner/edit_loader.gif"?>">

                        <div class="clear"></div>
                    </a>
                </div>
            </div>
            <div class="clear"></div>
            
        
        </div><!--End of float_left-->
        
        <div class="float_right right_div background_animation">
        	<div class="dashed m_10_5">
                <ul class="points">
                    <li>
                        <div class="float_left"> <?php echo lang('mycorner_total_points'); ?></div>
                        <div class="float_right white_color" style="background-image:url('<?php echo base_url()."images/mycorner/hexagon_blue.png"; ?>');">3000</div>
                    </li>
                    <li>
                        <div class="float_left"><?php echo lang('mycorner_number_of_share');?></div>
                        <div class="float_right white_color" style="background-image:url('<?php echo base_url()."images/mycorner/hexagon_brown.png"; ?>');">55</div>
                    </li>
                    <li>
                        <div class="float_left"><?php echo lang('mycorner_trophies');?></div>
                        <div class="float_right white_color" style="background-image:url('<?php echo base_url()."images/mycorner/hexagon_red.png"; ?>');">10</div>
                    </li>
                </ul>
            </div><!--End of .dashed-->
        
        </div><!--End of .float_right-->
        
        <div class="clear"></div>

    </div><!--End of #first_row-->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <div id="second_row">

        <div class="float_left left_div background_animation">
            <div class="dashed m_10_5" style="height: 163px;">
                <div class="member_info" style="margin: 10px 20px;">
                    <h3><?php echo lang('mycorner_address');?> : <?php echo $address;?></h3>
                    <h3><?php echo lang('mycorner_governorate');?> : <?php echo $city_value; ?></h3>
                    <h3><?php echo lang('mycorner_email');?> : <?php echo $email;?></h3>
                    <h3><?php  echo lang('mycorner_mobile');?>: <?php echo $mobile; ?></h3>
                </div>
                
            </div><!--End of .dashed-->
            <div class="edit_animation float_right">
                <div style="margin: 10px 36px;">
                    <a class="edit_button" id="address" href="<?php echo site_url($this->router->class."/edit_profile/address") ?>" >
                        <h4 class="float_left white_color"> <?php echo lang('mycorner_edit_details');?></h4>
                        <img class="float_left" style="margin: 0 8px;" src="<?php echo base_url()."images/mycorner/edit_icon.png"?>"  />
                        <img class="load_async" src="<?php echo base_url()."images/mycorner/edit_loader.gif"?>">
                        <div class="clear"></div>
                    </a>
                </div>
            </div>
        </div><!--End of .float_left-->
        
        <div class="float_right right_div background_animation">
        	<div class="dashed m_10_5" style="height: 163px;">
                <div class="member_info" style="margin:20px;">
                    <h3><?php echo lang('mycorner_number_of_children');?>: <?php echo $childern; ?></h3>
                    <h3><?php echo lang('mycorner_their_age');?> :  
                    <?php 
					$length = count($members_children);
					for($i = 0; $i<sizeof($members_children); $i++)
					{
						echo $members_children[$i]['members_children_age'];
						if($i != $length - 1)
						{
							echo " - ";
						}
					}
					?>
                    </h3>
                    <h3><?php echo lang('mycorner_names');?> : 
                    <?php 
					for($i = 0; $i<sizeof($members_children); $i++)
					{
						echo $members_children[$i]['members_children_name'];
						if($i != $length - 1)
						{
							echo " - ";
						}
					}
					?>
                    </h3>
                </div>
                
	        </div><!--End of .dashed-->
            <div class="edit_animation float_right">
                <div style="margin: 10px 36px;">
                    <a class="edit_button" id="childern" href="<?php echo site_url($this->router->class."/edit_profile/childern") ?>" >
                        <h4 class="float_left white_color"><?php echo lang('mycorner_edit_details');?></h4>
                        <img class="float_left" style="margin: 0 8px;" src="<?php echo base_url()."images/mycorner/edit_icon.png"?>"  />
                        <img class="load_async" src="<?php echo base_url()."images/mycorner/edit_loader.gif"?>">
                        <div class="clear"></div>
                    </a>
                </div>
            </div>
        </div><!--End of .float_right-->
        
        <div class="clear"></div>

    </div><!--End of #second_row-->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <div id="third_row">

        <div class="background_animation inner_div">
            <div class="dashed m_10_5" style="height: 129px;">
            <h3 style="margin: 5px 10px;"><?php echo lang('mycorner_interested_in');?></h3>
            <ul class="interested direction">
            <?php
            for($i = 0; $i<sizeof($members_newsletter); $i++)
			{
				echo '<li class="float_left"><span>&#149;</span>'.$members_newsletter[$i]['newsletter_types_title'.$current_language_db_prefix].'</li>';
			}			
			?>
            </ul>

                
            </div><!--End of .dashed-->
            <div class="edit_animation float_right">
                <div style="margin: 10px 36px;">
                    <a class="edit_button" id="interested" href="<?php echo site_url($this->router->class."/edit_profile/interested") ?>" >
                        <h4 class="float_left white_color"><?php echo lang('mycorner_edit_details'); ?></h4>
                        <img class="float_left" style="margin: 0 8px;" src="<?php echo base_url()."images/mycorner/edit_icon.png"?>"  />
                        <img class="load_async" src="<?php echo base_url()."images/mycorner/edit_loader.gif"?>">
                        <div class="clear"></div>
                    </a>
                </div>
            </div>
        </div><!--End of .float_left-->

    </div><!--End of .third_row-->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <div id="fourth_row">
    	<div class="title_animation float_left">
            <div style="margin: 10px 35px;">
               <h4 class="float_left white_color"><?php echo lang('mycorner_trophies');?></h4>
            </div>
        </div>

        <div class="background_clear inner_div">
            <div class="dashed m_10_5" style="height: 160px;">
                <ul class="awards float_right">
                    <li class="float_left"><img src="<?php echo base_url()."images/mycorner/golden_cup.png"?>" /></li>
                    <li class="float_left"><img src="<?php echo base_url()."images/mycorner/bronze_cup.png"?>" /></li>
                    <li class="float_left"><img src="<?php echo base_url()."images/mycorner/bronze_cup.png"?>" /></li>
                    <li class="float_left"><img src="<?php echo base_url()."images/mycorner/golden_cup.png"?>" /></li>
                    
    
                </ul>
            </div><!--End of .dashed-->
            
        </div><!--End of .background_clear-->

    </div><!--End of .fourth_row-->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <div id="fifth_row">
    	<div class="title_animation float_left">
            <div style="margin: 10px 35px;">
               <h4 class="float_left white_color"><?php echo lang('mycorner_can_i_win');?></h4>
            </div>
        </div>

        <div class="background_clear inner_div">
            <div class="dashed m_10_5" style="height: 170px;">
                <ul class="prize float_right">
                    <li class="float_left">
                    	<img src="<?php echo base_url()."images/mycorner/prize_icon_gold.png"?>" />
                        <div class="amount">1000</div>
                    </li>
                    <li class="float_left">
                    	<img src="<?php echo base_url()."images/mycorner/prize_icon_gold.png"?>" />
                        <div class="amount">1000</div>
                    </li>
                    <li class="float_left">
                    	<img src="<?php echo base_url()."images/mycorner/prize_icon_gold.png"?>" />
                        <div class="amount">1000</div>
                    </li>
                    <li class="float_left">
                    	<img src="<?php echo base_url()."images/mycorner/prize_icon_gold.png"?>" />
                        <div class="amount">1000</div>
                    </li>
                   
                </ul>
                <div class="float_left" style="margin: 20px;">
                    	<img src="<?php echo base_url()."images/mycorner/prize_text.png"?>" />
                    </div>
                <div class="clear"></div>
            </div><!--End of .dashed-->
        </div><!--End of .background_clear-->
    </div><!--End of .fifth_row-->
    
</div><!--End of .profile_container-->







