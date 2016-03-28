<link rel="stylesheet"  type="text/css" href="<?php echo base_url_mobile('css/view_my_profile.css'); ?>"/>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/jquery-Tags-Input/jquery.tagsinput.css" />
<!--Date picker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url(); ?>js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url(); ?>js/jquery.iframe-transport.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-Tags-Input/jquery.tagsinput.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url(); ?>js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url(); ?>js/jquery.iframe-transport.js"></script>

<style>
body.arabic .ui-radio input[type='radio']{left: 5em !important;}
body.english .ui-radio input[value='english']{left: -3em !important;}
</style>
<script type="text/javascript">
$(document).ready(function(e) {

	  
    $("#edit_member_form").submit(function(e){
		var state = true;
		$(".field_error").hide();
		
		if( $("#email_flag").val() == 0 )
		{
			$('#members_email_validation').fadeIn("fast");
			state = false;
		}
		
		if( $("#members_email").val() == "" )
		{
			$("#members_email_validation").hide();
			$("#members_email_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#username").val() == "" )
		{
			$("#username_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#members_email").val() != "" )
		{
			 var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			 if( !emailReg.test($("#members_email").val() ) ) 
			 {
				  $("#members_email_format_error").fadeIn("fast");
				  state = false;
			 } 
		}
		

		if( $("#members_mobile").val() == "" )
		{
			$(".members_mobile_error").fadeIn("fast");
			state = false;
		}
		return state;
		
	});
});

/*
Interested JS
*/
$(document).ready(function(e) {
    $("#insert_message").hide();
	$("#done_sending").hide();
	$( "#sortable" ).disableSelection();
	$( "#sortable" ).sortable();
	
		$('.newsletter').change(function(){
			var value = $(this).val();
			if(value == 2)
			{
				if(this.checked)
				{
					$("#month").show();  // checked
					$("#baby_month").attr("disabled",false);
				}
				else
				{
					$("#month").hide();
					$("#baby_month").attr("disabled",true);
				}
			}
		});
		
		if($( ".newsletter[value=2]" ).attr("checked"))
		{
			$("#month").show();  // checked
			$("#baby_month").attr("disabled",false);
		}
		else
		{
			$("#month").hide();
			$("#baby_month").attr("disabled",true);
		}
		
	$("#upload_member_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();
		
		if( $(".child_name").val() == "" )
		{
			//$("#borthday_box1").find("#members_child_error").fadeIn("fast");
			//$("#borthday_box2").find("#members_child_error").fadeIn("fast");
			$("#members_child_error").fadeIn("fast");
			state = false;
		}
		
		if( $(".child_age").val() == "" )
		{
			//$("#borthday_box1").find("#members_child_error").fadeIn("fast");
			//$("#borthday_box2").find("#members_child_error").fadeIn("fast");
			$("members_child_error").fadeIn("fast");
			state = false;
		}
		
		return state;
	});
	
	
	$('#update_order').click(function(e) {
		
        var member_id = '<?php echo $this->members->members_id; ?>'; 
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


<div class="clear"></div>

	<div class="container" style="<?php /* background-image:url('<?php echo base_url()."images/mycorner/profile_bg.jpg"; ?>') */ ?>">
		<div class="row margin_row">
			<div class="col-xs-12 col-md-7 col-sm-7 float_left">
            	<div style="background:white;border-radius:10px;border:2px solid #24bbbe; padding: 8px; margin-bottom: 10px;">
					<img src="<?php echo base_url()."uploads/members/".$image; ?>" class="img-responsive image_profile" style="margin: 0px;"/>
				<div class="profile_data float_left">
					<p class="data"><?php echo lang('mycorner_name');?>: <?php echo ucwords($name); ?></p>
					<p class="data"><?php echo lang('mycorner_age');?>: <?php echo $age?></p>
					<p class="data"><?php echo lang('mycorner_birthdate');?>: <?php echo $birthdate;?></p>
					<p class="data"><?php echo lang('mycorner_number_of_children');?>: <?php echo $childern; ?></p>
					<?php
						if($childern != 0)
						{
							echo '<p>'.lang('mycorner_their_age') . ' : '; 
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
							echo '</p>';
							echo '<p>'.lang('mycorner_names') . ' : '; 
							for($i = 0; $i<sizeof($members_children); $i++)
							{
								echo $members_children[$i]['members_children_name'];
								if($i != $length - 1)
								{
									echo " - ";
								}
							}
							echo '</p>';
						}
					?>          
				</div>
				<div class="clear"></div>
				<div class="edit_icon1">
					<div class="edit_animation float_right blue_background">
						<a class="edit_button" data-rel="popup" data-transition="pop" href="#edit_profile_info_popup" data-ajax="true" data-position-to=".info">
							<div style="margin: 8px 10px;">
								<img class="float_left" style="margin: 0 8px;" src="<?php echo base_url()."images/mycorner/edit_icon.png"?>"  />
							</div>
						</a>
					</div>
				</div>
			</div></div>
			<div class="col-xs-12 col-md-5 col-sm-5 float_right">
				<div class="div_colum border1">
					<ul class="user_points list-unstyled">
                        <li class="new"><p class="count_points float_left"><?php echo lang('mycorner_total_points'); ?></p><span class="count_points_numbers hexagon float_right" style="background-image:url('<?php echo base_url()."images/mycorner/hexagon_blue.png"; ?>'); color: #fff;"><?php echo $this->members->members_points ?></span></li>
                        <li class="new"><p class="count_points float_left"><?php echo lang('mycorner_number_of_share');?></p><span class="count_points_numbers hexagon float_right" style="background-image:url('<?php echo base_url()."images/mycorner/hexagon_brown.png"; ?>'); color: #fff;"><?php echo $this->members->members_no_of_overall_posts ?></span></li>
                        <li class="new"><p class="count_points float_left"><?php echo lang('mycorner_trophies');?></p><span class="count_points_numbers hexagon float_right"  style="background-image:url('<?php echo base_url()."images/mycorner/hexagon_red.png"; ?>');color: #fff;"><?php echo $this->members->members_trophies ?></span></li>
					</ul>
				</div>
			</div>
		</div>
        <div class="row margin_row">
			<div class="col-xs-12 col-md-12 col-sm-12">
				<div class="user_info_data border">
					<ul class="list-unstyled float_left member_data" style="padding:10px;">
						<li><img src="<?php echo base_url()."/images/mycorner/address_icon".$current_language_db_prefix.".png"?>" class="img-responsive float_left"/><p class="float_left member"><?php echo lang('mycorner_address')." : ".$address; ?></p></li>
						<li><img src="<?php echo base_url()."/images/mycorner/location_icon.png"?>" class="img-responsive float_left"/><p class="float_left member"><?php echo lang('mycorner_governorate')." : ". $city_value; ?></p></li>
						<li><img src="<?php echo base_url()."/images/mycorner/email_icon".$current_language_db_prefix.".png"?>" class="img-responsive float_left"/><p class="float_left member"><?php echo lang('mycorner_email')." : ". $email; ?> </p></li>
						<li><img src="<?php echo base_url()."/images/mycorner/mobile_icone".$current_language_db_prefix.".png"?>" class="img-responsive float_left"/><p class="float_left member"><?php echo lang('mycorner_mobile')." : ".$mobile;?></p></li>
             		</ul>
                    <div class="clear"></div>
					<div class="edit_icon">
						<div class="edit_animation float_right red_background">
							<a class="edit_button"  data-rel="popup" data-transition="pop" href="#edit_profile_address_popup" data-ajax="true" data-position-to=".address" >
								<div style="margin: 8px 10px;">
									<img class="float_left" style="margin: 0 8px;" src="<?php echo base_url()."images/mycorner/edit_icon.png"?>"  />
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row margin_row">
			<div class="col-xs-12 col-md-12 col-sm-12">
				<div class="interest">
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
                <div class="float_left">
					<h3 class="prefer"><?php echo lang('mycorner_fav_lang')." ". $lang;?></h3>
					<h3 class="prefer"><?php echo lang('mycorner_interested_in');?></h3>
                </div>
                <div class="clear"></div>
					<ul class="float_left list-unstyled prefer">
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
					<div class="clear"></div>
					<div class="edit_icon">
						<div class="edit_animation float_right ornage_background">
							<a class="edit_button"  data-rel="popup" data-transition="pop" href="#edit_profile_interest_popup" data-ajax="true" data-position-to=".interest" >
								<div style="margin: 8px 10px;">
									<img class="float_left" style="margin: 0 8px;" src="<?php echo base_url()."images/mycorner/edit_icon.png"?>"  />
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
        
        <?php /*
        <div class="best">
			<div class="row margin_row">
				<div class="col-md-6 col-xs-12 col-sm-6 float_left">
					<ul class="list-unstyled">
						<li class="margin_li">
							<div class="circle float_left"><h3 class="numbers">1</h3></div>
							<div class="section_order best_cook_color float_right"><h3 class="best_one"><?php echo lang('globals_bestcook');?></h3></div>
						</li>
						<li class="margin_li">
							<div class="circle float_left"><h3 class="numbers">2</h3></div>
							<div class="section_order best_status_color float_right"><h3 class="best_one"><?php echo lang('globals_bestme');?></h3></div>
						</li>
					</ul>
				</div>
                
				<div class="col-md-6 col-xs-12 col-sm-6 float_right">
					<ul class="list-unstyled">
						<li class="margin_li">
							<div class="circle float_left"><h3 class="numbers">3</h3></div>
							<div class="section_order best_mother_color float_right"><h3 class="best_one"><?php echo lang('globals_bestmom');?></h3></div>
						</li>
						<li class="margin_li">
							<div class="circle float_left"><h3 class="numbers">4</h3></div>
							<div class="section_order best_time_color float_right"><h3 class="best_one"><?php echo lang('globals_besttime');?></h3></div>
						</li>
					</ul>
				</div>
            </div>
		</div>
        <div class="row margin_row">
			<div class="col-xs-12 col-md-12 col-sm-12">
				<div class="title_wesam">
					<div class="how_points"><h3 class="subsection_title float_left" style="background-image:url('<?php echo base_url()."images/mycorner/wesam_ar.png"; ?>')"> <?php echo lang('mycorner_trophies');?></h3></div>
					<div><h2 class="awsamty"><?php echo lang('mycorner_trophies_message'); ?></h2></div>
				</div>
			</div>
		</div>
		*/ ?>
		<div class="row margin_row">
			<div class="col-xs-12 col-md-12 col-sm-12">
				<div class="title_points">
					<div class="how_points"><h3 class="subsection_title_points float_left" style="background-image:url('<?php echo base_url()."images/mycorner/win_ar.png"; ?>'); text-shadow:none !important; color: #fff"><?php echo lang('mycorner_can_i_win');?></h3></div>
					<div class="img_points float_left">
						<img src="<?php echo base_url()."images/mycorner/prize_text".$current_language_db_prefix.".png"?>" class="img-responsive"/>
							<a href="#" class="invite"><?php echo lang('mycorner_invite_friends'); ?></a>
					</div>
					<div class="points"><h3><?php echo lang('mycorner_prizes_message'); ?></h3></div>
				</div>
			</div>
		</div>
    </div>
    
    			<?php
				/*
					--------------------------------------------------------------
					--------------------  PopUp Edit info Form -----------------------
					--------------------------------------------------------------					
				*/
				?>
                
                <div id="edit_profile_info_popup" data-role="popup" class="ui-popup ui-overlay-shadow ui-corner-all ui-body-c" style="padding:10px; position:relative" data-overlay-theme="b" data-ajax="true">
                	<?php 
		 			$attributes = array('class' => '', 'id' => 'login_form', 'data-ajax' => 'false' ,'enctype' => "multipart/form-data");
					echo form_open_multipart('mobile/my_corner/edit_profile/info',$attributes);
	  				?>
                	<table>
		<tr>
        	<td width="25%"><h5 style="margin:0px"><?php echo lang('mycorner_firstname');?> <span style="color:red"> * </span></h5></td>
        	<td width="65%">
			<?php 
			$data=array( 'name' => 'members_first_name' , 'id' => 'members_first_name','class'=>'date_text', 'value' => $members_info[0]['members_first_name'], 'size' => 50, 'onkeypress'=>'return onlyAlphabets(event,this);');                  
            echo form_input($data);	
			echo form_error('members_first_name');
			echo "<p class='members_first_name_error field_error'>".lang("bestcook_field_required")."</p>" 
            ?>
            </td>
        </tr>   
        <tr>        
            <td><h5 style="margin:0px"><?php echo lang('mycorner_lastname');?> <span style="color:red"> * </span></h5></td>
       		<td>
         	<?php 
			$data=array( 'name' => 'members_last_name', 'id' => 'members_last_name' ,'class'=>'date_text' ,'value' => $members_info[0]['members_last_name'], 'size' => 50,'onkeypress'=>'return onlyAlphabets(event,this);'); 			 
			echo form_input($data);
			echo form_error('members_last_name');
			echo "<p class='members_last_name_error field_error'>".lang("bestcook_field_required")."</p>" 	 
			?>
            </td>
        </tr>
        
        <tr>
             <td><p style="margin:0px"><?php echo lang('mycorner_birthdate');?></p></td>
             <td>
                 <?php 
				 $data=array( 'name' => 'members_birthdate' , 'id' => 'members_birthdate' ,'class'=>'date-input-css', 'value' => $members_info[0]['members_birthdate'], 'data-role' => 'date'); 		 
				  echo form_input($data);
				  echo "<p class='members_birthdate_error field_error'>".lang("bestcook_field_required")."</p>" 	  
			     ?>
             </td>
        </tr>
        <tr><td colspan="2"><a class="fancybox fancybox.ajax" style="font-size: 14px;padding: 5px;color:#666;line-height: 33px;" href="<?php echo site_url("my_corner/change_your_password"); ?>"><?php echo lang('mycorner_change_your_password'); ?></a></td></tr>
        <tr>
        <td>
                <?php echo lang('mycorner_choose_image'); ?><input id="fileupload" type="file" name="user_profile_image" />
        </td>
        <td>

        </td>
        </tr>
        <tr>
        	<td>
            
            </td>
            <td>
            	<?php echo form_submit('update',lang('mycorner_update') ,'class="mycorner_button btn-blue" data-ajax="false"') ?>
            </td>
        </tr>
		</table>
                    <?php
					echo form_close();
	  				?>
                </div>
                
                
                
    			<?php
				/*
					--------------------------------------------------------------
					--------------------  PopUp Edit address Form ----------------
					--------------------------------------------------------------					
				*/
				?>
                
                <div id="edit_profile_address_popup" data-role="popup" class="ui-popup ui-overlay-shadow ui-corner-all ui-body-c" style="padding:10px; position:relative" data-overlay-theme="b" data-ajax="true">
                	<?php 
		 			$attributes = array('class' => '', 'id' => 'login_form', 'data-ajax' => 'false' );
					echo form_open_multipart('mobile/my_corner/edit_profile/address',$attributes);
                    
                    //email_flag
            $data=array('type'=>'hidden' ,'name' => 'email_flag' ,'value' => 1 , 'id' => 'email_flag'); 		 
			echo form_input($data);
			
			//current_email
            $data=array('type'=>'hidden' ,'name' => 'current_email' ,'value' => $email , 'id' => 'current_email'); 		 
			echo form_input($data);
		   ?>
      <table>
		<tr>
        	<td width="30%"><h5><?php echo lang('mycorner_address');?> </h5></td>
        	<td width="65%">
			<?php 
			$data=array( 'name' => 'members_address' , 'value' => $members_info[0]['members_address']);                  
            echo form_textarea($data);	 
            ?>
            </td>
        </tr>   
        <tr>        
            <td><p> <?php echo lang('mycorner_governorate');?></p></td>
       		<td>
         	<?php
			echo form_dropdown('members_city_id', $cities_list, $members_info[0]['members_city_id'], 'class="small_text" ');
			?>
            </td>
        </tr>
        <tr>
        	<td><p><?php echo lang('mycorner_username');?><span style="color:red"> * </span></p></td>
            <td>
            <?php
              	$data=array( 'name' => 'username' ,'id' => 'username','AUTOCOMPLETE'=>'off','class'=>'small_text', 'value' => $members_info[0]['members_nickname'] ,'onkeypress'=>'return onlyenglishandNumber(event);');                  
              	echo form_input($data);
				echo form_error('username');
			  ?>
            </td>
            
        </tr>
        <tr>
        	<td><h5><?php echo lang('mycorner_email');?><span style="color:red"> * </span></h5></td>
            <td>

			 <?php                  
                $data=array( 'name' => 'members_email' ,  'id' => 'members_email' ,'class'=>'small_text' , 'value' => $members_info[0]['members_email']); 			 
                echo form_input($data);
                if(!$current_language_db_prefix == "_ar")
                {
                    echo '<img style="display:none" class="availability_email" src="'.base_url().'images/camera-loader.gif" />';
                }
            ?>
            </td>
         </tr>  
         	<td><h5> <?php echo lang('mycorner_mobile');?><span style="color:red"> * </span></h5></td>
			<td>
             	<?php 
			 	$data=array( 'name' => 'members_mobile', 'id' => 'members_mobile' ,'maxlength' => '11' ,'class' => 'small_text','value' => $members_info[0]['members_mobile'] , 'size' => 50 ,'onkeypress'=>'return isNumberKey(event)'); 
			  	echo form_input($data);	 
				echo form_error('members_mobile');
				?>
            </td>
        </tr>
        
        <tr>
        	<td colspan="2"><?php echo form_submit('update',lang('mycorner_update'),'class="mycorner_button"') ?></td>
        </tr>
        
        <?php 
			$data=array('type'=>'hidden' ,'name' => 'edit_type' ,'value' => $type , 'id' => 'edit_type'); 		 
			echo form_input($data);
		?>
        </table>
                    
                    
                    <?php
					echo form_close();
	  				?>
                </div>
                
                
                
    			<?php
				/*
					--------------------------------------------------------------
					--------------------  PopUp Edit inerest Form ----------------
					--------------------------------------------------------------					
				*/
				?>
                
                <div id="edit_profile_interest_popup" data-role="popup" class="ui-popup ui-overlay-shadow ui-corner-all ui-body-c" style="padding:10px; position:relative" data-overlay-theme="b" data-ajax="true">
                					
    <div id="insert_message" style="display:none;"><div style="text-align:center;margin-top:60px;"><h1 style="margin-bottom:25px;"><?php echo lang('mycorner_homepage_section_order_done');?></h1></div></div>

    <div id="fourth_row">
        <div class="float_left m_10_5" style=" width:570px; ">
          <?php 
		   $attributes = array('class' => '', 'id' => 'upload_member_form', 'data-ajax' => 'false');
		   echo form_open_multipart('mobile/my_corner/edit_profile/interest',$attributes);

			$data=array('type'=>'hidden' ,'name' => 'edit_type' ,'value' => $type , 'id' => 'edit_type'); 		 
			echo form_input($data);

		   ?>
           <h5><?php echo lang('mycorner_interested_in');?></h5>
           
      <table border="0" class="table direction">
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
					$checked = TRUE;
				}
				else
				{
					$checked = FALSE;
				}
			  
			  echo '<tr><td style="max-width: 20%">';
			  $data = array('name'  => 'newsletter_members_members_id[]','class' => 'newsletter','value'  => $newsletter_id,'checked' => $checked ,'style' =>'position: initial;  margin-top: 1px;');
			  echo form_checkbox($data);
			  echo '</td><td>'.$newsletter_name;

			  echo '</td></tr>';
		  }
		  if($get_pregnancy)
		  {
			  $show_pregnancy = 'display:block;';
			  $month = $get_pregnancy[0]['pregnancy_month'];
			  $insert_date = $get_pregnancy[0]['pregnancy_date'];
			  
			  $current_inserted_month =  date("m", strtotime($insert_date));
			  $current_month = date('m');
			  $incremented = $current_month - $current_inserted_month;
			  $current_pregnancy_month = $month + $incremented; 

		  }
		  else
		  {
			   $show_pregnancy = 'display:none;';
			   $current_pregnancy_month = "";
		  }
		  echo '<tr id="month" style="'.$show_pregnancy.'">';
		  echo '<td style="max-width: 20%;">'.lang('mycorner_pregnancy_month').'</td>';
		  echo '<td><select name="baby_month" id="baby_month" style="width: 60px;">';
			  for($i=0 ; $i<=8;$i++)
			  {
				  if ($i+1==$current_pregnancy_month)
				  {
					  $select = "selected='selected'";
				  }
				  else
				  {
					  $select = "";
				  }
				  echo '<option value="'.($i+1).'" '.$select.' >'.($i+1).'</option>';
			  }
			  echo '</select>';	
		  echo '</td></tr>';
		  
			
		  ?>                       
        </table>
        
        <div class="imgcontainer float_left">
          <!--Member Language--> 
            <label for="day" class=""> <?php echo lang('mycorner_chose_lang');?> </label> <br/>
            
            <div style="width:200px;margin-top: 10px;" class="float_left"> 
                <div class="float_left" style="width: 86px;">
                <?php
                $lang = $members_info[0]['members_lang'];
				?>
                    <label style="margin-top: -4px;line-height: 32px;" for="members_lang" class=" float_right">العربية</label> 
                    <?php 
					($lang == 'arabic')? $checked = "TRUE" : $checked = "" ;
					$data = array( 'name' => 'members_lang' ,'class' => 'radio float_left' , 'value' => 'arabic' ,'checked'=>$checked );
                        echo form_radio($data);
                    ?>
                    <div class="clear"></div>
                </div>
                <div class="float_right">
                    <label for="members_lang"  style="margin-top: -4px;line-height: 32px;" class=" float_right"> English </label> 
                    <?php 
					($lang == 'english')? $checked = "TRUE" : $checked = "" ;
					$data = array( 'name' => 'members_lang' ,'class' => 'radio float_left' , 'value' => 'english' ,'checked'=> $checked);
                    echo form_radio($data);
                    ?>
                </div>
            <div class="clear"></div>
            </div>
            
          </div>

        <table width="100%" border="0" class="float_left direction">
            <tr>
                <td colspan="2"><?php echo form_submit('update',lang('mycorner_update') ,'class="mycorner_button"') ?></td>
            </tr>
        </table>
        </div>
            
    <div class="clear"></div>
    <?php  echo form_close(); ?>

    </div><!--End of .third_row-->
    
					
					
					
                </div>
                
<script>
$(document).ready(function(e) {
var checkbox_1 = $(".newsletter[value=6]").prop('checked');
var checkbox_2 = $(".newsletter[value=5]").prop('checked');
if(checkbox_2 == true){
if(checkbox_1 == true){
	$(".newsletter[value=6]").parent().append('<div id="baby_birthday1"><table id="InputsWrapper" width="100%" border="0" class="float_left direction"></table><table width="100%" border="0" class="float_left direction"><tr><td class="small"><div><a href="#" id="AddMoreFileBox" class="add_child_link" ><?php echo lang('mycorner_add_child');?></a></div></td></tr></table></div><div class="clear"></div>');
	<?php 
			for($i = 0; $i<sizeof($members_children);$i++)
			{
				$name = $members_children[$i]['members_children_name'];
				$age = $members_children[$i]['members_children_age'];
			?>
			$(".newsletter[value=6]").parent().append('<div id="borthday_box1"><tr><td><?php echo addslashes(lang('mycorner_child_age')) ?></td><td><input  type="text" class="datepicker child_age" name="children_age[]" id="field_'+ x +'" value="<?php echo $age; ?>"></td></tr> <tr><td><?php echo addslashes(lang('mycorner_child_name')); ?></td><td><input  type="text" class="child_name" name="children_name[]" onkeypress="return onlyAlphabets(event);" id="field_'+ x +'" value="<?php echo $name; ?>"/><a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');
			<?php } ?>
}
}
var num_of_childs= <?php $members_children ?>
$( ".newsletter[value=6]" ).live("change",function(){
	var item = $(this);
	var checked =  this.checked;
		if(checked)
		{
			item.parent().append('<div id="baby_birthday1" class="float_left"><table id="InputsWrapper" width="100%" border="0" class="float_left direction"></table><table width="100%" border="0" class="float_left direction"><tr><td class="small"><div><a href="#" id="AddMoreFileBox" class="add_child_link" ><?php echo lang('mycorner_add_child');?></a></div></td></tr></table></div><div class="clear"></div>');
			<?php 
			for($i = 0; $i<sizeof($members_children);$i++)
			{
				$name = $members_children[$i]['members_children_name'];
				$age = $members_children[$i]['members_children_age'];
			?>
			item.parent().append('<div id="borthday_box1"><tr><td><?php echo addslashes(lang('mycorner_child_age')) ?></td><td><input  type="text" class="datepicker child_age" name="children_age[]" id="field_'+ x +'" value="<?php echo $age; ?>"></td></tr> <tr><td><?php echo addslashes(lang('mycorner_child_name')); ?></td><td><input  type="text" class="child_name" name="children_name[]" onkeypress="return onlyAlphabets(event);" id="field_'+ x +'" value="<?php echo $name; ?>"/><a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');
			<?php } ?> 
			$("div#borthday_box2").remove();
			$("div#baby_birthday2").remove();
		}else{
			$("div#baby_birthday1").remove();
			$("div#borthday_box1").remove();
		}
});

$( ".newsletter[value=5]" ).live("change",function(){
	var item = $(this);
	var checked =  this.checked;
		if(checked)
		{
			item.parent().append('<div id="baby_birthday2" class="float_left"><table id="InputsWrapper" width="100%" border="0" class="float_left direction"></table><table width="100%" border="0" class="float_left direction"><tr><td class="small"><div><a href="#" id="AddMoreFileBox" class="add_child_link" ><?php echo lang('mycorner_add_child');?></a></div></td></tr></table></div><div class="clear"></div>');
			
			<?php 
			for($i = 0; $i<sizeof($members_children);$i++)
			{
				$name = $members_children[$i]['members_children_name'];
				$age = $members_children[$i]['members_children_age'];
			?>
			item.parent().append('<div id="borthday_box2"><tr><td><?php echo addslashes(lang('mycorner_child_age')) ?></td><td><input  type="text" class="datepicker child_age" name="children_age[]" id="field_'+ x +'" value="<?php echo $age; ?>"></td></tr> <tr><td><?php echo addslashes(lang('mycorner_child_name')); ?></td><td><input  type="text" class="child_name" name="children_name[]" onkeypress="return onlyAlphabets(event);" id="field_'+ x +'" value="<?php echo $name; ?>"/><a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');
			<?php } ?>
			
			$("div#baby_birthday1").remove();
			$("div#borthday_box1").remove();
		}else{
			$("div#baby_birthday2").remove();
			$("div#borthday_box2").remove();
		}
	
});
if(checkbox_1 == false){
if(checkbox_2 == true){
	$(".newsletter[value=5]").parent().append('<div id="baby_birthday1" class="float_left"><table id="InputsWrapper" width="100%" border="0" class="float_left direction"></table><table width="100%" border="0" class="float_left direction"><tr><td class="small"><div><a href="#" id="AddMoreFileBox" class="add_child_link" ><?php echo lang('mycorner_add_child');?></a></div></td></tr></table></div><div class="clear"></div>');
	<?php 
			for($i = 0; $i<sizeof($members_children);$i++)
			{
				$name = $members_children[$i]['members_children_name'];
				$age = $members_children[$i]['members_children_age'];
			?>
			$(".newsletter[value=5]").parent().append('<div id="borthday_box1"><tr><td><?php echo addslashes(lang('mycorner_child_age')) ?></td><td><input  type="text" class="datepicker child_age" name="children_age[]" id="field_'+ x +'" value="<?php echo $age; ?>"></td></tr> <tr><td><?php echo addslashes(lang('mycorner_child_name')); ?></td><td><input  type="text" class="child_name" name="children_name[]" onkeypress="return onlyAlphabets(event);" id="field_'+ x +'" value="<?php echo $name; ?>"/><a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');
			<?php } ?>
}
}
var x = $("#borthday_box").length + 1;
$("#AddMoreFileBox").live("click", function(){
	var item = $(this);
	if(x <= 7){
	   item.parent().parent().append('<div id="borthday_box"><tr><td><?php echo lang('mycorner_child_age'); ?></td><td><input  type="text" class="datepicker child_age" name="children_age[]" id="field_'+ x +'" value=""></td></tr> <tr><td><?php echo lang('mycorner_child_name'); ?></td><td><input  type="text" class="child_name" name="children_name[]" onkeypress="return onlyAlphabets(event);" id="field_'+ x +'" value=""/><a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');
	x++;
	$(this).parent().parent('tr').remove(); 
	}
	return false;
});

$('#close_field').live("click", function(){
	x--;
	var item = $(this);
	item.parent().remove();
	return false;
});

});
</script>