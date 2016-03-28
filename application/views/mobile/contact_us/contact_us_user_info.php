
<?php $num_3 = 3;
if($current_language_db_prefix == "_ar")
{
$num_3 = $this->common->arabic_numbers($num_3);
}
?>
<div class="contact_us_link" id="step_3">
<h5><span><?php echo $num_3; ?></span><label class="mandat"> *</label><?php echo lang('contactus_personal_info'); ?></h5>
</div>
<div id="personal_info" class="contact_us_section">

    <?php
    require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
    $facebook = new Facebook(array(
        'appId' => '1424984977747397',
        'secret' => 'cb0b67c5019dc5d4886b815cc086449d',
    ));

// Get User ID
    $user = $facebook->getUser();


    if ($user) {
        try {
            // Proceed knowing you have a logged in user who's authenticated.
            $user_profile = $facebook->api('/me');
        } catch (FacebookApiException $e) {
            error_log($e);
            $user = null;
        }
    }

    if ($user) {
        try {

            $user_profile = $facebook->api('/me', 'GET');
        } catch (FacebookApiException $e) {

            $login_url = $facebook->getLoginUrl();
            echo 'Please <a href="' . $login_url . '">login.</a>';
            error_log($e->getType());
            error_log($e->getMessage());
        }
    } else {
        // No user, print a link for the user to login
        $params = array(
            'scope' => 'read_stream,email , friends_likes,user_birthday , user_location, user_work_history, user_hometown,',
        );

        $loginUrl = $facebook->getLoginUrl($params);

        echo '<a class="fb_reg_button" href="' . $loginUrl . '"><div class="col-md-12 col-sm-12 col-xs-12"><img style="margin:10px 0px;" height="30" width="100" src="' . base_url() . 'images/mycorner/fb_reg_button' . $current_language_db_prefix . '.png" class="img_responsive float_left"/></div></a>';
    }

    if ($user) {
        $facebook->setExtendedAccessToken();
        $access_token = $facebook->getAccessToken();

        $member_fb_id = $user_profile['id'];

        $data = array('type' => 'hidden', 'name' => 'members_fb_id', 'value' => $member_fb_id, 'id' => '');
        echo form_input($data);

        $data = array('type' => 'hidden', 'name' => 'members_access_token', 'value' => $access_token, 'id' => '');
        echo form_input($data);

        if (isset($user_profile['first_name'])) {
            $member_fb_first_name = $user_profile['first_name'];
        } else {
            $member_fb_first_name = '';
        }
        if (isset($user_profile['last_name'])) {
            $member_fb_last_name = $user_profile['last_name'];
        } else {
            $member_fb_last_name = '';
        }
        if (isset($user_profile['email'])) {
            $member_fb_email = $user_profile['email'];
        } else {
            $member_fb_email = '';
        }
        if (isset($user_profile['birthday'])) {
            $member_fb_birthday = date('Y-m-d', strtotime($user_profile['birthday']));
        } else {
            $member_fb_birthday = '';
        }

        if (isset($user_profile['hometown']['name'])) {
            $member_fb_address = $user_profile['hometown']['name'];
        } else {
            $member_fb_address = '';
        }
    } else {
        $member_fb_first_name = '';
        $member_fb_last_name = '';
        $member_fb_email = '';
        $member_fb_birthday = '';
        $member_fb_address = '';
    }
    ?>
	<div class="row">
    <div class="form-group float_left col-xs-12 col-sm-6 col-md-6">
        <label><label class="mandat" style="display: inline !important;"> *</label><?php echo lang('contactus_firstname'); ?></label>
        <input type="text" name="firstname"  value="<?php
        if (!empty($this->members->members_firstname)) {
            echo $this->members->members_firstname;
        } elseif (!empty($member_fb_first_name)) {
            echo $member_fb_first_name;
        }
        ?>" class="textstyle font_size_17 float_left" id="fname" style="text-indent: 15px;"  onkeypress ="return onlyAlphabets(event,this)"/>
     	<?php echo form_error('first_name'); ?>
                   
 <p class="firstname_error float_left" style="font-weight:bold;"><?php echo lang('bestcook_field_required'); ?></p>
 
 
    </div> 
    <div class="form-group float_left col-xs-12 col-sm-6 col-md-6">
        <label><label class="mandat" style="display: inline !important;"> *</label><?php echo lang('contactus_lastname'); ?></label>
        <input type="text" name="lastname"  value="<?php
        if (!empty($this->members->members_lastname)) {
            echo $this->members->members_lastname;
        } elseif (!empty($member_fb_last_name)) {
            echo $member_fb_last_name;
        }
        ?>" class="textstyle font_size_17"  id="lname" style="text-indent: 15px;" onkeypress ="return onlyAlphabets(event,this)"/>
     <p class="lastname_error float_left" style="font-weight:bold;"><?php echo lang('bestcook_field_required'); ?></p>
    
    </div>
    </div>
    <div class="row">
    <div class="form-group float_left col-xs-12 col-sm-6 col-md-6">
        <label><label class="mandat" style="display: inline !important;"> *</label><?php echo lang('contactus_email'); ?></label>
        <input type="text" name="email"  value="<?php
        if (!empty($this->members->members_email)) {
            echo $this->members->members_email;
        } elseif (!empty($member_fb_email)) {
            echo $member_fb_email;
        }
        ?>" class="textstyle font_size_17" id="Email" style="text-indent: 15px;"/>
       <p class="email_error float_left" style="font-weight:bold;"><?php echo lang('bestcook_field_required'); ?></p>
       <p class="email_error_format" style="font-weight:bold;"><?php echo lang('globals_lform_not_vaild_format'); ?></p>
    </div>
    <div class="form-group float_left col-xs-12 col-sm-6 col-md-6">
        <label><?php echo lang('contactus_phone'); ?></label>
        
        <h3 class="font_size_17" id="egyptnumber">+20</h3>
        <input type="text" name="telephone" onkeypress="return isNumberKeyOnly(event)" id="telephone" maxlength="9" class="medium_text font_size_17" style="text-indent: 27px;"/>
        <p class="telephone_error" style="font-weight:bold;"><?php echo lang('contactus_phone_error'); ?></p>
    </div>
	</div>
    <div class="row">
    <div class="form-group float_left col-xs-12 col-sm-6 col-md-6">
        <label><?php echo lang('contactus_mobile'); ?></label>
        <h3 class="font_size_17" id="egyptnumber">+20</h3>
        <input type="text" name="mobileno" value="<?php
        if (!empty($this->members->members_mobile)) {
            echo $this->members->members_mobile;
        }
        ?>" id="mobile" maxlength="10" onkeypress="return isNumberKeyOnly(event)" class="medium_text font_size_17" style="text-indent: 27px;"/>
         <p class="mobile_error" style="font-weight:bold;"><?php echo lang('contactus_mobile_error'); ?></p>
    </div>

    <div class="form-group float_left col-xs-12 col-sm-6 col-md-6">
        <label><?php echo lang('contactus_address'); ?></label>
        <input type="text" id="address"  value="<?php
        if (!empty($member_fb_address)) {
            echo $member_fb_address;
        }
        ?>" class="textstyle font_size_17"  name="address"  style="text-indent: 15px;"/>
    </div>
	</div>
    <div class="row">
   <div class="row"> <div class="form-group float_left col-xs-12 col-sm-6 col-md-6">
        <label><?php echo lang('contactus_city'); ?></label>
        <?php
       // array_unshift($display_city, lang('mycorner_city'));
        echo form_dropdown('city_ID', $display_city, set_value('city_ID'), 'class="drop_down_style dir" id="city_ID"')
        ?>
    </div></div></div>
    <a href="#" class="float_right reason_next" id="info_next"><?php echo lang('globals_next');?></a>
</div>
<hr>