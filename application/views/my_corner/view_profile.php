<?php
if($unsubscribe_newsletter != ""){
	if($unsubscribe_newsletter == 1){
	?>
    <script>
    $(document).ready(function() {
        $.fancybox("<?php echo lang('unsubscribe_newsletter'); ?>",{
            minWidth: '200',
            minHeight: '50'
        }); // fancybox
    }); // ready
</script>
    <?php
	}elseif($unsubscribe_newsletter == 0){
		?>
	<script>
    $(document).ready(function() {
        $.fancybox("<?php echo lang('already_unsubscribe_newsletter'); ?>",{
            minWidth: '200',
            minHeight: '50'
        }); // fancybox
    }); // ready
</script>
<?php
	}
}
?>
		

<link href="<?php echo base_url(); ?>css/mycorner.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>js/jquery-Tags-Input/jquery.tagsinput.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/jquery-Tags-Input/jquery.tagsinput.css" />
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
$("#datepicker").datepicker({ 
	dateFormat: "yy-mm-dd" ,
	changeMonth: true,
	changeYear: true ,
  })
});
</script>
<script type="text/javascript">
$(document).ready(function(e) {
	$("#done_sending").hide();
	$('#view_invite_friends').hide();
	$('.edit_button').click(function(e) {
        var type = $(this).attr('id');
    });
	  
	  	$("#invite_friends").fancybox({
		  width: 420,
          height: 220,
		  scrolling   : 'no',
		  autoSize : false,
          fitToView : false,
          helpers: {
              title : {
                  type : 'float'
              }
          },
      });
    
});
</script>
<script>
	jQuery(function(){
		<?php
			if($current_language_db_prefix == "_ar")
			{
			?>
		jQuery("#trohpies_list").jCarouselLite({
				btnNext: ".trohpies_list_next",
				btnPrev: ".trohpies_list_prev",
				visible:5,
				circular: false,
				 
			});
			$('.trohpies_list_prev').addClass('disabled');
			<?php }else{ ?>
		jQuery("#trohpies_list").jCarouselLite({
				btnNext: ".trohpies_list_prev",
				btnPrev: ".trohpies_list_next",
				visible:5,
				circular: false,
				 
			});
			$('.trohpies_list_next').addClass('disabled');
			<?php } ?>
	
	});
</script>
<script>
		  jQuery(function(){
			  <?php
			if($current_language_db_prefix == "_ar")
			{
			?>
			  jQuery("#prizes_list").jCarouselLite({
					  btnNext: ".prizes_list_next",
					  btnPrev: ".prizes_list_prev",
					  visible:4,
					  circular: false,
					   
				  });
				  <?php }else{ ?>
			  jQuery("#prizes_list").jCarouselLite({
					  btnNext: ".prizes_list_prev",
					  btnPrev: ".prizes_list_next",
					  visible:4,
					  circular: false,
					   
				  });
				  <?php } ?>
		  
		  });
        </script>
        <script>
        	$(document).ready(function(e) {
				$("#get_prize").live("click", function(){
					var item = $(this);
					var awards_id = item.data("id");
					$.ajax({
						url:  "<?php echo site_url("ajax/send_prize_email"); ?>",
						type: "POST",
						data: {awards_id : awards_id},
						cache: false,
						//dataType: "json",
						success: function(message)
						{
						 if(message == 'true'){
							 $.fancybox("<?php echo lang('mycorner_prizes_request'); ?>",{
           						 minWidth: '200',
           						 minHeight: '50'
        						}); // fancybox
							item.css('color', 'rgb(180, 180, 180)');
							item.html('<?php echo lang('mycorner_prizes_request_buffering'); ?>');
							item.css('pointer-events', 'none');
							item.css('cursor', 'default');
							item.attr('data-id', '0');
						 }
						},
						error: function(xhr, ajaxOptions, thrownError)
						{
						  
						}
							
					  });
					
					  return false;
				});
			});
        </script>
<?php
// if not logged in -> redirect to hompage


$name = $members_info[0]['members_first_name'] ." ".$members_info[0]['members_last_name'];

$member_birthday = $members_info[0]['members_birthdate'];

$current_year = date("Y");

if($member_birthday == '0000-00-00')
{
	$birthdate = '-';
	$age = '-';
}
else
{
	$birthdate = date("d / m / Y" , strtotime($members_info[0]['members_birthdate']));

	$birthdate_year = date("Y", strtotime($members_info[0]['members_birthdate']));
	$age = $current_year - $birthdate_year .' '.lang('mycorner_year');
}

$image = $this->members->members_image;//$current_member_image;

$address = $members_info[0]['members_address'];
$current_city = $members_info[0]['members_city_id'];

$email = $members_info[0]['members_email'];
$mobile = $members_info[0]['members_mobile'];
$childern = count($members_children);//$members_info[0]['members_children'];
if($childern == 0)
{
	$childern = lang('globals_not_found') ;
}

$current_relationship = $members_info[0]['members_relationship_id'];

/*if($current_relationship != 0)
{
	$relationship = $this->membersmodel->get_relationship($current_language_db_prefix , false , '' , $current_relationship);
	$relationship_value = $relationship[0]['relationship_title'.$current_language_db_prefix];
}
else
{
	$relationship_value = '';
}
*/
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
 
<?php $this->load->view('template/submenu_writer');   ?>

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
        <div class="float_left left_div background_animation blue_border">
        	<div class="float_right m_10_5" style="width:390px; height:264px;">
            	<div class="member_info" style="margin:10px;">
                	<h3><?php echo lang('mycorner_name');?>: <?php echo ucwords($name); ?></h3>
                    <?php /*?><h3><?php echo lang('mycorner_marital_status');?> : <?php echo $relationship_value; ?></h3><?php */?>
                    <h3><?php echo lang('mycorner_age');?>: <?php echo $age?></h3>
                    <h3><?php echo lang('mycorner_birthdate');?>: <?php echo $birthdate;?></h3>
                    <h3><?php echo lang('mycorner_number_of_children');?>: <?php echo $childern; ?></h3>
                    
                    <?php
                    if($childern != 0)
					{
						echo '<h3>'.lang('mycorner_their_age') . ' : '; 
						$length = count($members_children);
						for($i = 0; $i<sizeof($members_children); $i++)
						{
							$children_birthdate_year = date("Y", strtotime($members_children[$i]['members_children_age']));
							$children_age = $current_year - $children_birthdate_year;
							echo $children_age;//$members_children[$i]['members_children_age'];
							if($i != $length - 1)
							{
								echo " - ";
							}
						}
						echo '</h3>';
						echo '<h3>'.lang('mycorner_names') . ' : '; 
						for($i = 0; $i<sizeof($members_children); $i++)
						{
							echo $members_children[$i]['members_children_name'];
							if($i != $length - 1)
							{
								echo " - ";
							}
						}
						echo '</h3>';

                    }
					
					?>
                </div>
            	
            </div>
            <div class="float_left m_10_5">
                <img style="width: 230px; height:265px;" id="image_preview" class="member_image" src="<?php echo base_url()."uploads/members/".$image; ?>" />
            </div>
            <div class="edit_animation float_right blue_background">
                <a class="edit_button" id="info" href="<?php echo site_url($this->router->class."/edit_profile/info") ?>" >
                    <div style="margin: 8px 10px;">
                    	<img class="float_left" style="margin: 0 8px;" src="<?php echo base_url()."images/mycorner/edit_icon.png"?>"  />
                    </div>
                 </a>
            </div>
            <div class="clear"></div>
            
        
        </div><!--End of float_left-->
        
        <div class="float_right right_div background_animation blue_border">
        	<div class="dashed m_10_5">
                <ul class="members_points">
                    <li>
                        <div class="float_left"> <?php echo lang('mycorner_total_points'); ?></div>
                        <div class="float_right white_color" style="background-image:url('<?php echo base_url()."images/mycorner/hexagon_blue.png"; ?>');"><?php echo $this->members->members_points ?></div>
                    </li>
                    <li>
                        <div class="float_left"><?php echo lang('mycorner_number_of_share');?></div>
                        <div class="float_right white_color" style="background-image:url('<?php echo base_url()."images/mycorner/hexagon_brown.png"; ?>');"><?php echo $this->members->members_no_of_overall_posts ?></div>
                    </li>
                    <li>
                        <div class="float_left"><?php echo lang('mycorner_trophies');?></div>
                        <div class="float_right white_color" style="background-image:url('<?php echo base_url()."images/mycorner/hexagon_red.png"; ?>');"><?php echo $this->members->members_trophies ?></div>
                    </li>
                </ul>
            </div><!--End of .dashed-->
        
        </div><!--End of .float_right-->
        
        <div class="clear"></div>

    </div><!--End of #first_row-->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <div id="second_row">

        <div class="float_left left_div background_animation red_border">
            <div class="m_10_5" style="height: 119px;">
                <div class="member_info" style="margin: 10px 20px;">
                    <div class="float_left" style="width:460px;margin-top: 20px;">
                        <div style=" height:50px;"><img class="float_left" src="<?php echo base_url()."/images/mycorner/address_icon".$current_language_db_prefix.".png"?>" /><h3 class="float_left" style="line-height: 40px; width:400px;"><?php echo lang('mycorner_address');?>: <?php echo $address;?></h3></div>
                        <div style=" height:50px;"><img class="float_left" src="<?php echo base_url()."/images/mycorner/location_icon.png"?>" /><h3 class="float_left" style="line-height: 40px;width:400px;"><?php echo lang('mycorner_governorate');?> : <?php echo $city_value; ?></h3></div>
                    </div>
                    <div class="float_right" style="width:460px;margin-top: 20px;">
                        <div style=" height:50px;"><img class="float_left" src="<?php echo base_url()."/images/mycorner/email_icon".$current_language_db_prefix.".png"?>" /><h3 class="float_left" style="line-height: 40px;width:400px;"><?php echo lang('mycorner_email');?>: <?php echo $email;?></h3></div>
                        <div style=" height:50px;"><img class="float_left" src="<?php echo base_url()."/images/mycorner/mobile_icone".$current_language_db_prefix.".png"?>" /><h3 class="float_left" style="line-height: 40px;width:400px;"><?php echo lang('mycorner_mobile');?>: <?php echo $mobile; ?></h3></div>
                    </div>
                    <div class="clear"></div>
                    
                </div>
                
            </div><!--End of .dashed-->
            <div class="edit_animation float_right red_background">
                <a class="edit_button" id="info" href="<?php echo site_url($this->router->class."/edit_profile/address") ?>" >
                    <div style="margin: 8px 10px;">
                    	<img class="float_left" style="margin: 0 8px;" src="<?php echo base_url()."images/mycorner/edit_icon.png"?>"  />
                    </div>
                 </a>
            </div>
            
        </div><!--End of .float_left-->
      
        <div class="clear"></div>

    </div><!--End of #second_row-->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <div id="third_row">

        <div class="background_animation inner_div ornage_border gray_background">
            <div class="m_5 solid" style="height: 285px;">
            	<div class="float_left" style="">
				<!--Current Language-->                
				<?php
                $lang = $members_info[0]['members_lang'];
				if($lang == 'english')
				{
					$lang = 'English';
				}
				else
				{
					$lang = 'عربى';	
				}
				
				?>
                <h3 style="margin:10px; font-size:17px;line-height: 19px;"><?php echo lang('mycorner_fav_lang')." ". $lang;?></h3>
                
                    <h3 style="margin:10px; font-size:17px;line-height: 19px;"><?php echo lang('mycorner_interested_in');?></h3>
                    <ul class="interested direction">
                    <?php
					$items = array();
					
					foreach($members_newsletter as $member_newsletter) 
					{
						$items[] = $member_newsletter['newsletter_members_newsletter_types_id'];
					}
					
					for($i = 0; $i<sizeof($newsletter); $i++)
					{
						$newsletter_id = $newsletter[$i]['newsletter_types_ID'];
						$newsletter_name = $newsletter[$i]['newsletter_types_title'.$current_language_db_prefix];
						
						if (in_array($newsletter_id, $items)) 
						{
							echo '<li style="display: block;font-weight: bold;"><span>&#149;</span>'.$newsletter_name.'</li>';
						}
						else
						{
							echo '<li style="display: block;line-height: 30px;"><span>&#149;</span>'.$newsletter_name.'</li>';
						}
					}
                   
                    ?>
                    </ul>
                </div>
                <div class="float_right" style="width: 280px;margin: 0 14px">
	                    <h3 style="margin:10px; font-size:17px;line-height: 19px;"><?php echo lang('mycorner_homepage_section_order');?></h3>
                        
                        <div class="float_right">
                        <div class="circle"><h3 class="numbers"> 1 </h3></div>
                        <div class="circle"><h3 class="numbers"> 2 </h3></div>
                        <div class="circle"><h3 class="numbers"> 3 </h3></div>
                        <div class="circle"><h3 class="numbers"> 4 </h3></div>
                        </div>
                        <div class="float_left">
                        	<ul id="sortable">
                             <?php
							 if($members_section_order)
							 {
								for($i=0;$i<sizeof($members_section_order);$i++)
								{
									$section_id = $members_section_order[$i]['members_section_order_section_id'];
									$section_name = $members_section_order[$i]['sections_name'.$current_language_db_prefix];
									$section_title = $members_section_order[$i]['sections_title'];
									
									echo '<li style="cursor: default;" id='.$section_id.'" ><div class=" section_order '.$section_title.'_background_color"><h3>'.$section_name.'</h3></div></li>';
								}
							 }
							 else
							 {?>
                                <li id="2"><div class=" section_order best_cook_background_color"><h3><?php echo lang('globals_bestcook');?></h3></div></li>
                                <li id="10"><div class=" section_order best_me_background_color"><h3><?php echo lang('globals_bestme');?></h3></div></li>
                                <li id="27"><div class=" section_order best_mom_background_color"><h3><?php echo lang('globals_bestmom');?></h3></div></li>
                                <li id="28"><div class=" section_order best_time_background_color"><h3><?php echo lang('globals_besttime');?></h3></div></li>


                             <?php
							 }
							?>
                            </ul>
                        </div>
                        <div class="clear"></div>
                  </div>
                <div class="clear"></div>

                
            </div><!--End of .dashed-->
            <div class="edit_animation float_right ornage_background">
                <a class="edit_button" id="info" href="<?php echo site_url($this->router->class."/edit_profile/interested") ?>" >
                    <div style="margin: 8px 10px;">
                    	<img class="float_left" style="margin: 0 8px;" src="<?php echo base_url()."images/mycorner/edit_icon.png"?>"  />
                    </div>
                 </a>
            </div>

        </div><!--End of .float_left-->

    </div><!--End of .third_row-->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <div id="fourth_row">
    	<div class="title_wesam float_left">
        	<h3 class="float_left white_color subsection_title"><?php echo lang('mycorner_trophies');?></h3>
        </div>

        <div class="background_animation inner_div gray_background pink_border">
            <div class="solid m_5" style="height: 160px;">
            <?php
			if($display_trophies){
			echo '<div class="trohpies_list_wrapper">';
			if(sizeof($display_trophies) > 5){
			echo '<a class="trohpies_list_prev"><img class="" width="20" src="'.base_url().'images/products/right_arrow.png" /></a>
        		  <a class="trohpies_list_next float_right"><img class="" width="20" src="'.base_url().'images/products/left_arrow.png" /></a>';
			}
			?>
            <div id="trohpies_list">
                <ul class="awards float_right" style="list-style:none;" id="horiz_container_outer">
          	 	 <?php 
				 
				 for($i=0; $i<sizeof($display_trophies); $i++): 
						$image_url = base_url()."/uploads/awards/";
						$image = $image_url.$display_trophies[$i]['images_src'];
				?>
                <li class="float_left"><img width="150" height="120" src="<?php echo $image; ?>" /></li>
                <?php endfor; ?>    
                </ul></div>
					</div>
                    
                    <?php
						}else{
					?>
					<li class="float_left" style="list-style:none;"><h2 style="margin: 40px 46px;"><?php echo lang('mycorner_trophies_message'); ?></h2></li>
                    <?php  }?>
    
               
			</div>
            </div><!--End of .dashed-->
            
        </div><!--End of .background_clear-->

    </div><!--End of .fourth_row-->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <div id="fifth_row">
    	<div class="title_win float_left">
               <h3 class="float_left white_color subsection_title"><?php echo lang('mycorner_can_i_win');?></h3>
        </div>
        
        <div class="background_animation inner_div blue_border">
            <div class=" m_10_5" style="height: 170px;">
            <?php
			if($display_prizes){
				echo '<div class="float_right prizes_list_wrapper">';
				if(sizeof($display_prizes) > 4){
			echo '<a class="prizes_list_prev"><img class="" width="20" src="'.base_url().'images/products/right_arrow.png" /></a>
        		  <a class="prizes_list_next"><img class="" width="20" src="'.base_url().'images/products/left_arrow.png" /></a>';
				}
			?>
            <div id="prizes_list" class="">
                <ul class="prize ">
                <?php
				$prizes = array();
					
					foreach($display_get_prize as $get_prize) 
					{
						$prizes[] = $get_prize['awards_ID'];
					}
					
				for($i=0; $i<sizeof($display_prizes); $i++): 
						$priz_number = $display_prizes[$i]['awards_ID'];
						$image_url = base_url()."/uploads/awards/";
						$image = $image_url.$display_prizes[$i]['images_src'];
						
					if (in_array($priz_number, $prizes)) 
						{
							?>
                     <li class="" style="height:175px !important;">
                    	<img width="140" height="100" src="<?php echo $image; ?>" />
                        <div style="font-size: 11px; margin-top: -8px;" class="amount"><a style="pointer-events:none; cursor:default; color:rgb(180, 180, 180);" id="get_prize" data-id="<?php echo $priz_number; ?>" href="#"><?php echo lang('mycorner_prizes_request_buffering'); ?></a></div>
                    </li>
                            <?php
						}else{
							?>
					<li class="" style="height:175px !important;">
                    	<img width="140" height="100" src="<?php echo $image; ?>" />
                        <div style="font-size: 11px; margin-top: -8px;" class="amount"><a id="get_prize" data-id="<?php echo $priz_number; ?>" href="#"><?php echo lang('mycorner_prizes_get_request'); ?></a></div>
                    </li>
						<?php
						}
				  		?>
                    
                    <?php
					endfor; ?>
                     </ul>
                     </div>
					</div>
                    
                    <?php
			}else{
				?>
                <h2 class="float_right" style="margin: 17px 18px 0px;   width: 670px; text-align: center; position: relative; top: 26px;"><?php echo lang('mycorner_prizes_message'); ?></h2>
                <?php
				}
					?>
                

                	<div class="float_left" style="width: 280px; height: 155px;">
                    	<img class="float_left" style="margin-bottom:10px;" src="<?php echo base_url()."images/mycorner/prize_text".$current_language_db_prefix.".png"?>" />
                        <a href="#view_invite_friends" class="float_left mycorner_button" style="line-height: 22px; white-space:normal" id="invite_friends" ><?php echo lang('mycorner_invite_friends'); ?></a>
                    </div>
                <div class="clear"></div>
            </div><!--End of .dashed-->
        </div><!--End of .background_clear-->
    </div><!--End of .fifth_row-->
    
</div><!--End of .profile_container-->

<div id="view_invite_friends">
<div class="float_right m_10_5" style=" width:360px;margin-left:41px; ">
        <script type="text/javascript">
		$(document).ready(function(e) {
			
			function validateEmail( email ) {
			  var emailReg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			  if( emailReg.test( email ) == false ) {
				return false;
			  } else {
				return true;
			  }
			}
			
			var member_id = '<?php echo $this->members->members_id; ?>';
			var friends_emails = $('#friends_emails').val();
			
			$('#send_invitation').click(function(e) {
				var tags = $('#friends_emails').val();
				var arr = tags.split(',');
				
				if(arr[0] == ""){
					return false;
				}
				
				for (var i = 0; i < arr.length; i++){
					var emailsName = $("#friends_emails").attr("name");
					if( !validateEmail(arr[i])) {
							$(".warning_message").html("<p><?php echo lang('mycorner_invite_friends_email_error'); ?></p>");
							return false;
						}else{
							email = ''+arr[i]+'';
							$.ajax({
								url: "<?php echo site_url($this->router->class."/check_email_invitations"); ?>",
								type: 'POST',
								async: false,
								data:{email : email},
								success: function(message){
									if(message === 0){
										$(".warning_message").html("<p><?php echo lang('mycorner_invite_friends_email_repeat'); ?></p>");
										return false;
									}else{
									$.ajax({
										url:  "<?php echo site_url($this->router->class."/send_invitations"); ?>",
										type: "POST",
										data: {email : email},
										cache: false,
										//dataType: "json",
										success: function(success_array)
										{
										  $(".warning_message").html('<p style="color:rgb(66, 131, 14);"><?php echo lang('mycorner_invitation_sending_done');?></p>');
										  setTimeout( function() {$(".warning_message").html('<p></p>');},1000);
										  setTimeout( function() {$.fancybox.close(); },1000);
										  $('#friends_emails').val('');
										  return false;
										},
										error: function(xhr, ajaxOptions, thrownError)
										{
										  
										}
											
									  });
									}
								}
							});
						}
				}
            
		   });
		   $('#friends_emails').tagsInput();
        });
        </script>
        
        <table class="dir">
        	<tr>
            	<td><h5><?php echo lang('mycorner_invite_friends_instructions'); ?></h5></td>
			</tr>
            <tr>
            	<td>
                	<input name="friends_emails" value="" id="friends_emails" class="large_text" size="50" placeholder="ex. friend1@compny.com ; friend2@compny.com" />
            	</td>
            </tr>
            <tr><td><div style="text-align:center;color: red;" class="warning_message"></div></td></tr>
            <tr>
            	<td colspan="2"><h3 style="text-align:center;"><a href="#done_sending" class="mycorner_button" id="send_invitation"><?php echo lang('mycorner_email_send');?></a></h3></td>
            </tr>
        	
        </table>	
        </div>

</div>


