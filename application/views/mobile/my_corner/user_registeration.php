<?php
$this->load->view('mobile/my_corner/validation_form');
?>
<script>
    $(document).ready(function (e) {
        $("#members_password").keyup(function () {
            var passwd = $("#members_password").val();

            var intScore = 0
            var strVerdict = "";
<?php
$this->load->view('mobile/my_corner/validation_form');
?>
<script>
    $(document).ready(function (e) {
        $("#members_password").keyup(function () {
            var passwd = $("#members_password").val();

            var intScore = 0
            var strVerdict = "";

            if (passwd.length < 5)                         // length 4 or less
            {
                intScore = (intScore + 3)
            }
            else if (passwd.length > 4 && passwd.length < 8) // length between 5 and 7
            {
                intScore = (intScore + 6)
            }
            else if (passwd.length > 7)// length 8 or more
            {
                intScore = (intScore + 12)
            }
            /*else if (passwd.length>20)                    // length 16 or more
             {
             intScore = (intScore+18)
             }*/

            // LETTERS (Not exactly implemented as dictacted above because of my limited understanding of Regex)
            if (passwd.match(/[a-z]/))                              // [verified] at least one lower case letter
            {
                intScore = (intScore + 1)
            }

            if (passwd.match(/[A-Z]/))                              // [verified] at least one upper case letter
            {
                intScore = (intScore + 5)
            }

            // NUMBERS
            if (passwd.match(/\d+/))                                 // [verified] at least one number
            {
                intScore = (intScore + 5)
            }

            /*if (passwd.match(/(.*[0-9].*[0-9].*[0-9])/))             // [verified] at least three numbers
             {
             intScore = (intScore+5)
             }*/

            // SPECIAL CHAR
            if (passwd.match(/.[!,@,#,$,%,^,&,*,?,_,~]/))            // [verified] at least one special character
            {
                intScore = (intScore + 5)
            }

            if (passwd.match(/(.*[!,@,#,$,%,^,&,*,?,_,~].*[!,@,#,$,%,^,&,*,?,_,~])/)) // [verified] at least two special characters
            {
                intScore = (intScore + 5)
            }

            // COMBOS
            if (passwd.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))        // [verified] both upper and lower case
            {
                intScore = (intScore + 2)
            }

            if (passwd.match(/([a-zA-Z])/) && passwd.match(/([0-9])/)) // [verified] both letters and numbers
            {
                intScore = (intScore + 2)
            }

            // [verified] letters, numbers, and special characters
            if (passwd.match(/([a-zA-Z0-9].*[!,@,#,$,%,^,&,*,?,_,~])|([!,@,#,$,%,^,&,*,?,_,~].*[a-zA-Z0-9])/))
            {
                intScore = (intScore + 2)
            }

            if (intScore < 15)
            {
                strVerdict = "<?php echo lang('mycorner_very_week_password'); ?>";
            }
            else if (intScore >= 15 && intScore < 27)
            {
                strVerdict = "<?php echo lang('mycorner_week_password'); ?>";
            }
            else if (intScore >= 27 && intScore < 34)
            {
                strVerdict = "<?php echo lang('mycorner_medium_password'); ?>";
            }
            else if (intScore >= 34 && intScore < 45)
            {
                strVerdict = "<?php echo lang('mycorner_good_password'); ?>";
            }
            else
            {
                strVerdict = "<?php echo lang('mycorner_strong_password'); ?>";
            }

            $("#members_password_complexity_score").val(intScore);
            $("#members_password_complexity").val(strVerdict);

            if (intScore > 33)
            {
                $("#members_password_complexity").addClass('green_color', 'pass_comp');
            }
            else
            {
                $("#members_password_complexity").removeClass('green_color', 'pass_comp');
            }
        });


        $(".create_member_form").submit(function (e) {

            var state = true;
            $(".field_error").hide();

            var password = $("#members_password").val();
            var repeat_password = $("#repeat_password").val();
            var score = $("#members_password_complexity_score").val();

            if (password == "")
            {
                $("#members_password_error").fadeIn("fast");
                $("#members_password_validation").fadeOut("fast");

                state = false;
            }

            if (repeat_password == "")
            {
                $("#repeat_password_error").fadeIn("fast");
                $("#members_password_validation").fadeOut("fast");
                state = false;
            }

            if (password != repeat_password)
            {
                $("#error_message").fadeIn("fast");
                state = false;
            }
			if(score != "")
			{
            if (score < 33)
            {
                $("#members_password_complexity_check").fadeIn("fast");
                state = false;
            }
			}
            if ($(".child_name").val() == "")
            {
                $("#borthday_box1").find("#members_child_error").fadeIn("fast");
                $("#borthday_box2").find("#members_child_error").fadeIn("fast");
                //$("#members_child_error").fadeIn("fast");
                state = false;
            }

            if ($(".child_age").val() == "")
            {
                $("#borthday_box1").find("#members_child_error").fadeIn("fast");
                $("#borthday_box2").find("#members_child_error").fadeIn("fast");
                //$("members_child_error").fadeIn("fast");
                state = false;
            }

            if ($(".reg_mob_newsletter_field[value=2]").attr("checked"))
            {
                if ($("#baby_month ").val() == 0)
                {
                    //alert(1);
                    $("#pregnancy_month_error").fadeIn("fast");
                    state = false;
                }
            }

            if ($("#username").val() == "")
            {
                $("#username_error").fadeIn("fast");
                state = false;
            }



            if ($("#first_name").val() == "")
            {
                $("#first_name_error").fadeIn("fast");
                state = false;
            }


            if ($("#last_name").val() == "")
            {
                $("#last_name_error").fadeIn("fast");
                state = false;
            }



            if ($("#mobile_number").val() == "")
            {
                $("#mobile_number_error").fadeIn("fast");
                state = false;
            }

            if ($("#email_flag").val() == 0)
            {
                $('#members_email_validation').fadeIn("fast");
                state = false;
            }

            if ($("#username_flag").val() == 0)
            {
                $('#members_username_validation').fadeIn("fast");
                state = false;
            }

            if ($("#members_email").val() == "")
            {
                $("#members_email_validation").hide();
                $("#members_email_error").fadeIn("fast");
                state = false;
            }


            if ($("#members_email").val() != "")
            {
                var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                if (!emailReg.test($("#members_email").val()))
                {
                    $("#members_email_format_error").fadeIn("fast");
                    state = false;
                }
            }


            if ($("#approve_privacy").is(':checked'))
            {

            }
            else
            {
                $("#approve_privacy_error").fadeIn("fast");
                state = false;
            }

            return state;
        });

    });

</script>
<script type="text/javascript">
    $(document).ready(function () {

        var MaxInputs = 8; //maximum input boxes allowed
        var InputsWrapper = $("#InputsWrapper"); //Input boxes wrapper ID
        var AddButton = $("#AddMoreFileBox"); //Add button ID

        var x = InputsWrapper.length; //Add button ID

        //var x = InputsWrapper.length; //initlal text box count
        //alert(x);
        var FieldCount = 1; //to keep track of text box added
        var Childname = "<?php echo lang('mycorner_child_name'); ?>";
        var Childage = "<?php echo lang('mycorner_child_age'); ?>";

        $(AddButton).click(function (e)  //on add input button click
        {
            if (x <= MaxInputs) //max input box allowed
            {
                FieldCount++; //text box added increment

                $(InputsWrapper).append('<tr><td><h5>' + Childage + '</h5></td><td><input type="text" class="date-input-css date_text" name="children_age[]" id="field_' + FieldCount + '" value=""></td><td><h5>' + Childname + '</h5></td><td><input type="text" class="date_text" name="children_name[]" id="field_' + FieldCount + '" value=""/><a href="#" class="removeclass" style=" font-family: Verdana, Geneva, sans-serif;margin-top: 11px;"> X </a></td></tr>');
                //add input box
                x++; //text box increment
            }
            return false;
        });

        $("body").on("click", ".removeclass", function (e) { //user click on remove text


            if (x > 1)
            {
                $(this).parent().parent('tr').remove(); //remove text box
                x--; //decrement textbox
            }
            return false;
        })

    });
</script>
<script type="text/javascript">
    $(document).ready(function (e) {

        $('.reg_mob_newsletter_field').change(function () {
            //var c = this.checked ? '#f00' : '#09f';
            var checked = this.checked;

            if (checked)
            {
                $('#newsletter').attr('checked', true);
            }
        });

        $('.reg_mob_newsletter_field').change(function () {
            var value = $(this).val();
            if (value == 2)
            {
                if (this.checked)
                {
                    $("#month").show();  // checked
                    $("#baby_month").attr("disabled", false);
                }
                else
                {
                    $("#month").hide();
                    $("#baby_month").attr("disabled", true);
                }
            }
        });

    });
</script>
<style>
    .exactly_position {
        margin: -15px 9px 0 0;
    }

    /*.arabic .pass_comp {
            direction:rtl;
    }*/
    .field_error {
        display:none;
        color:#FF0000;
    }
    #close_field{margin: 13px; font-size: 20px;}
    .arabic .field_error {
        direction:rtl;
    }
    body.arabic .white_space {
        white-space:normal;
    }
    .registration_banner {
        width:100%;
        margin-top:10px;
    }
    .green_color {
        color: #197C21 !important;
    }
    .red_color {
        white-space:normal;
        color: #e82327 !important;
    }
    .registration_banner .horizontal_line {
        height:11px;
        width:100%;
    }
    .registration_banner .banner {
        position:relative;
        width:100%;
    }
    /*#members_password_complexity {
            border:none;
            background: transparent;
            color: #e82327;
    }*/
    body.arabic .availability_email {
        position: relative;
        right: -35px;
        top: 8px;
        display:none;
        width: 24px;
    }
    .availability_email {
        position: relative;
        right: 35px;
        top: 8px;
        width: 24px;
        display: none;
    }
    body.arabic .availability_username {
        position: relative;
        right: -35px;
        top: 8px;
        display:none;
        width: 24px;
    }
    .availability_username {
        position: relative;
        right: 35px;
        top: 8px;
        width: 24px;
        display: none;
    }
    .ui-radio{
        margin-top:20px;
    }
    .ui-checkbox{
        margin-top:15px;
    }
    .english .ui-checkbox{
        margin-top:-4px;
    }
    #borthday_box1 {
        font-size:13px;
        width: 100%;
        margin-right: -28px;

    }
    #borthday_box1 .child-age{
        font-size:13px;
        width: 100%;
        margin-right: -28px;

    }
    #borthday_box{
        font-size:13px;
        margin-right:-28px;
    }
    #borthday_box2 {
        font-size:13px;
        margin-right:-28px;

    }
    .add_child_link {
        font-size: 11px;
        color: #666;
        margin-right: 107px;
        margin-bottom: 5px;
    }

    .arabic .date-input-css{
        text-align:right;
    }
    .english .add_child_link {
        font-size: 11px;
        color: #666;
        margin-left: 93px;
        /* width: 102px; */
        margin-right: 0;

    }
    .add_child_link:hover {
        color:#999;
        text-decoration:underline;
    }

    .box_shadow_mob {
        box-shadow:1px 1px 6px #807976;
        border-radius:5px;
        margin:3px;
        background-color:white;
    }
    .english .arabic_lang_radio {
        width:66%;
    }
    .english .radio_english {
        margin-top:-25px;
    }
    .english .english_lang_radio{
        padding: 0 18px;
    }

    .arabic .para_text_table {
        direction: rtl;
        font-size:8.5px;
    }
    .lable_newsletters_line{
        margin: -3px 14px;
        line-height: 2;
    }
    .english .lable_newsletters_line{

        margin: 10px 18px 0px 15px;
        height:0;
        font-size:10px;
    }
    .english .para_text_table {
        font-size:11px;
    }
    .arabic .data_required_box {
        direction : rtl;
        padding: 0 14px;
    }
    .mycorner_button {
        -webkit-box-shadow: inset 0px 1px 0px 0px #ffffff;
        box-shadow: inset 0px 1px 0px 0px #ffffff;
        background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f15555), color-stop(1, #d01e1e) );
        background: -moz-linear-gradient( center top, #f15555 5%, #d01e1e 100% );
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f15555', endColorstr='#d01e1e');
        background-color: #f15555;
        -webkit-border-top-left-radius: 7px;
        -moz-border-radius-topleft: 7px;
        border-top-left-radius: 7px;
        -webkit-border-top-right-radius: 7px;
        -moz-border-radius-topright: 7px;
        border-top-right-radius: 7px;
        -webkit-border-bottom-right-radius: 7px;
        -moz-border-radius-bottomright: 7px;
        border-bottom-right-radius: 7px;
        -webkit-border-bottom-left-radius: 7px;
        -moz-border-radius-bottomleft: 7px;
        border-bottom-left-radius: 7px;
        text-indent: 0;
        border: 1px solid #d9d9d9;
        display: inline-block;
        color: #ffffff;
        font-size: 15px;
        font-weight: bold;
        line-height: 35px;
        text-decoration: none;
        text-align: center;
        padding: 2px 13px;
        cursor: pointer;
    }
    .arabic .ui-input-text
    {	
        width:95%;
        float:right;
        margin-right:6px;
    }
    .arabic .fontweight 
    {
        width:95%;
        float:right;
        margin-right:6px;
        display:inherit;
    }
    .english .ui-input-text
    {	
        width:95%;
        float:left;
        margin-left:6px;
    }
    .english .fontweight
    {
        width:95%;
        float:left;
        margin-left:6px;
    }
    .arabic .large_text
    {
        text-align:right;
		width:100%;
    } 
    .arabic .ui-radio
    {	   
        float: right;
        right: 15px;
    }
    .english .radio_english
    {
        position: absolute;
        top: 35px;
    }
    .radio_btn_ar
    {
        position: relative;
        right: 30px;
        top: 8px;
    }
    .radio_btn_eng
    {
        position: relative;
        right: 30px;
        top: 8px;
    }
    .english .radio_btn_eng
    {
        position: relative;
        right: -32px;
        top: 8px;
    }
    .english .radio_btn_ar
    {
        position: relative;
        right: -34px;
        top: 2px;
    }
    .btn_check_radio
    {
        margin: 0 15px 20px 0;
    }
    .english .btn_check_radio{

    }
    .arabic .ui-checkbox
    {
        float: right;
        margin-right: 31px;

    }
    .arabic .lable_newsletters_line
    {
        margin-top: 6px;
        margin-right: 33px;
        font-size: 10.333333px;
        width: 97%;
    }


    /*.child_name, .datepicker{
        width: 70%;
        margin-bottom: 5px;
    }*/
    .child_name{
        width:175px;
        border-radius: 8px;
        margin:0 1px 18px -7px;
    }
    .child_name:last-child{
        background:#F00;
        width:165px;
        border-radius: 8px;
        margin:0 1px 18px -7px;
    }
    .child_age, .datepicker{
        width:175px;
        border-radius: 8px;
        margin:0 5px 0 13px;
    }
    .child_age:last-child, .datepicker:last-child{
        width:158px;
        border-radius: 8px;
        margin:0 5px 0 13px;
    }
    .english .child_name{
        width: 150px;
        border-radius: 5px;  
        margin: 5px 0 10px 3px; 
        padding: 4px;
    }
    .english .child_age{
        width: 150px;
        border-radius: 5px;
        margin: 4px 3px 0 16px; 
        padding: 4px;
    }
</style>

        <div class="row">
        <div class="col-xs-12">
        	<?php 
        	$attributes = array('class' => 'create_member_form', 'id' => 'create_member_form', 'name' => 'create_member_form', 'data-ajax' => 'false');
        	
        	echo form_open_multipart(site_url_mobile('my_corner/create_my_corner_submit'), $attributes);
        	?>
        <div class="row">
            <div class="col-xs-12">

                        <?php

                        if ($key != "") {
                            ?>
                            <input type="hidden" name="key" value="<?php echo $key  ?>" />
                            <?php
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
                        } else {
                            $member_fb_first_name = '';
                            $member_fb_last_name = '';
                            $member_fb_email = '';
                            $member_fb_birthday = '';
                        }
                        ?>
                        <p><?php echo lang('mycorner_required_caution'); ?></p>
                        <?php
                        $data = array('type' => 'hidden', 'name' => 'email_flag', 'value' => 0, 'id' => 'email_flag');
                        echo form_input($data);

                        $data = array('type' => 'hidden', 'name' => 'username_flag', 'value' => 0, 'id' => 'username_flag');
                        echo form_input($data);
                        ?>
                        <!--Member user name-->
                        <?php $this->form_validation->set_error_delimiters('<p class="red_color">', '</p>'); ?>
              </div> <!-- col-xs-12 -->
                    <!--<div style="width:744px;padding: 5px 0;" class="float_left">--> 
                    <!--Member first name--> 
                    <!-- <div class="float_left" >-->
                    
                    
                    
                    	<div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 float_left direction">
                            <label for="username" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_username'); ?></label>
                            <br/>
                        <?php
                        if ($current_language_db_prefix == "_ar") {
                            echo '<img class="availability_username" src="' . base_url() . 'images/camera-loader.gif" />';
                        }
                        $data = array('name' => 'username', 'id' => 'username', 'AUTOCOMPLETE' => 'off', 'class' => 'large_text', 'value' => set_value('username'), 'onkeypress' => 'return onlyenglishandNumber(event);');
                        echo form_input($data);
                        $data = array('name' => 'username');

                        if (!$current_language_db_prefix == "_ar") {
                            echo '<img class="availability_username" src="' . base_url() . 'images/camera-loader.gif" />';
                        }
                        echo form_error('username');
                        echo '<p id="username_error" class="field_error red_color white_space float_left">' . lang("bestcook_field_required") . '</p>';
                        echo '<p id="username_error2" class="field_error red_color white_space float_left">' . lang("mycorner_caution_username_min") . '</p>';
                        echo '<p id="members_username_validation" class="field_error red_color float_left"></p>';
                        echo '<p id="members_username_format_error" class="field_error red_color white_space float_left">' . lang('mycorner_unavailable_username') . '</p>';
                        ?>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 float_left direction"> 
                            <!--<div style="width:744px;padding: 5px 0;" class="float_left">--> 
                            <!--Member first name--> 
                            <!--<div class="float_left" >-->
                            <label for="user_name" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_firstname'); ?></label>
                            <br/>
                            <?php
                            $data_input_val = empty($member_fb_first_name) ? set_value('first_name') : $member_fb_first_name;

                            $data = array('name' => 'first_name', 'id' => 'first_name', 'class' => 'large_text', 'value' => $data_input_val, 'onkeypress' => 'return onlyAlphabets(event,this);');
                            echo form_input($data);
                            // echo '<p class="field_error red_color">'. form_error('first_name') .'</p>';
                            echo form_error('first_name');

                            echo '<p id="first_name_error" class="field_error red_color float_left">' . lang("bestcook_field_required") . '</p>';
                            ?>
                        </div>
                        </div>
                        <!--End Col -xs-12 , first_name-->
                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 float_left direction" > 
                            <!--Member last name--> 
                            <!--<div class="float_right">-->
                            <label for="user_name" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_lastname'); ?></label>
                            <br/>
<?php
$data_input_val = empty($member_fb_last_name) ? set_value('last_name') : $member_fb_last_name;

$data = array('name' => 'last_name', 'id' => 'last_name', 'class' => 'large_text', 'value' => $data_input_val, 'onkeypress' => 'return onlyAlphabets(event,this);');
echo form_input($data);
//echo '<p class="field_error red_color">'. form_error('last_name') .'</p>';
echo form_error('last_name');

echo '<p id="last_name_error" class="field_error red_color float_left">' . lang("bestcook_field_required") . '</p>';
?>
                        </div>
                        <!--End Col -xs-12 ,last_name--> 

                    <!--<div style="width:744px;padding: 5px 0;" class="float_left">--> 
                    <!--Member Password--> 
                    <!-- <div class="float_left" style="width:370px">-->
                        <div class="col-xs-12 col-sm-12 col-md-6 float_left direction">
                            <label for="members_password" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_password'); ?></label>
                            <br/>
                            <?php
                            $data = array('name' => 'members_password', 'id' => 'members_password', 'AUTOCOMPLETE' => 'off', 'value' => "", 'class' => 'large_text');
                            echo form_password($data);
                            // echo '<p class="field_error red_color">'. form_error('members_password') .'</p>';
                            echo form_error('members_password');

                            echo '<p id="members_password_error" class="field_error red_color white_space float_left">' . lang("bestcook_field_required") . '</p>';
                            //echo '<p id="members_password_validation" class="field_error red_color white_space float_left"></p>';
                            echo '<p id="members_password_complexity_check" class="field_error red_color white_space float_left">' . lang("mycorner_caution_password") . '</p>';
                            //echo '<input type="text" class="float_left large_text" id="members_password_complexity" name="members_password_complexity" disabled>';
                            ?>
                            <input type="hidden" id="members_password_complexity_score" name="members_password_complexity_score" >
                        </div>
                        </div>
                        <!--Member Repeat Password--> 
                        <!--<div class="float_right">-->
                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 float_left direction">
                            <label for="repeat_password" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_confirmpasssword'); ?> </label>
                            <br/>
                            <?php
                            $data = array('name' => 'repeat_password', 'id' => 'repeat_password', 'AUTOCOMPLETE' => 'off', 'value' => "", 'class' => 'large_text');
                            echo form_password($data);
                            // echo '<p class="field_error red_color">'. form_error('repeat_password') .'</p>';
                            echo form_error('repeat_password');

                            echo '<p id="repeat_password_error" class="field_error red_color white_space float_left">' . lang("bestcook_field_required") . '</p>';
                            echo '<p id="repeat_password_identical_error" class="field_error red_color white_space float_left">Password Not Identical</p>';
                            ?>
                        </div>
                    <!--end of second div password--> 

                    <!--<div style="width:749px;padding: 5px 0;" class="float_left">--> 
                    <!--Member Email--> 
                    <!--	<div class="float_left">-->
                        <div class="col-xs-12 col-sm-12 col-md-6 float_left direction">
                            <label for="members_email" class="fontweight"><span style="color:red">*</span> <?php echo lang('mycorner_email'); ?></label>
                            <br/>
                            <?php
                            if ($current_language_db_prefix == "_ar") {
                                echo '<img class="availability_email" src="' . base_url() . 'images/camera-loader.gif" />';
                            }

                            $data_input_val = empty($member_fb_email) ? set_value('members_email') : $member_fb_email;

                            $data = array('name' => 'members_email', 'id' => 'members_email', 'class' => 'large_text', 'value' => $data_input_val);
                            echo form_input($data);
                            if (!$current_language_db_prefix == "_ar") {
                                echo '<img class="availability_email" src="' . base_url() . 'images/camera-loader.gif" />';
                            }

                            //echo '<p class="field_error red_color">'. form_error('members_email') .'</p>';
                            echo form_error('members_email');
                            echo '<p id="members_email_error" class="field_error red_color white_space float_left">' . lang("bestcook_field_required") . '</p>';
                            echo '<p id="members_email_validation" class="field_error red_color white_space float_left"></p>';
                            echo '<p id="members_email_format_error" class="field_error red_color white_space float_left">' . lang('globals_lform_not_vaild_format') . '</p>';
                            ?>
                        </div>
                        </div>
                        <!--Member Mobile-->
                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 float_left direction">
                            <label for="members_mobile" class="fontweight"><span style="color:red">*</span><?php echo lang('mycorner_mobile'); ?></label>
                            <br/>
                            <?php
                            $mobil_data = array('name' => 'members_mobile', 'maxlength' => '11', 'class' => 'large_text', 'id' => 'mobile_number', 'onkeypress' => 'return isNumberKey(event)');
                            echo form_input($mobil_data);
                            echo form_error('members_mobile');
                            echo '<p id="mobile_number_error" class="field_error red_color float_left">' . lang("bestcook_field_required") . '</p>';
                            ?>
                        </div>
                    <!--end of third div password-->

                        <!--Member Birthday-->
                            <div class="col-xs-12 col-sm-12 col-md-6 direction">
                            	<div class="img_birthday"> 
                                	<label for="day" class="fontweight"><?php echo lang('mycorner_birthdate'); ?> </label>
                                	<?php
                                	$data = array('name' => 'members_birthdate', 'id' => 'members_birthdate', 'data-role' => 'date', 'class' => 'date-input-css', 'value' => $member_fb_birthday, 'readonly' => 'readonly');
                                	echo form_input($data);
                                	?>
                            	</div>
                        	</div>
                            </div>
                        <!--  <div class="imgcontainer float_right">--> 

                            
                            <div class="col-xs-12 col-sm-12 col-md-6 float_left direction">
                            	<label for="day" style="padding:0px 7px;" class="fontweight"> <?php echo lang('mycorner_chose_lang'); ?> </label>
                            	<table class="table">
                            		<tr>
                            			<td>
                            				<label class="radio_btn_ar" for="ar_name">English</label>
                            			</td>
                            			<td>
                            				<?php
											$data = array('name' => 'members_lang', 'class' => 'radio float_left', 'value' => 'arabic');
											echo form_radio($data);
											?>
                            			</td>
                            		</tr>
                            		<tr>
                            			<td>
                            				<label class="radio_btn_ar" for="ar_name">العربية</label>
                            			</td>
                            			<td>
                            				<?php
											$data = array('name' => 'members_lang', 'class' => 'radio_english float_left', 'value' => 'english');
											echo form_radio($data);
											?>
                            			</td>
                            		</tr>
                            	</table>
                            </div>

                        <!--Member Language-->
<?php /* ?>          <div class="row">
  <label for="day" style="padding:0 7px;" class="fontweight"> <?php echo lang('mycorner_chose_lang');?> </label>
  <br/>
  <div class="col-xs-4 float_left">
  <label style="margin-top: -4px;line-height: 29px;" for="members_lang" class="fontweight float_right arabic_lang_radio">العربية</label>
  <?php $data = array( 'name' => 'members_lang' ,'class' => 'radio float_left' , 'value' => 'arabic');
  echo form_radio($data);
  ?>
  </div>
  <br />
  <br />
  <div class="col-xs-3 float_left">
  <label  style="margin-top: -4px;line-height: 29px;" for="members_lang" class="fontweight float_right english_lang_radio">English</label>
  <?php $data = array( 'name' => 'members_lang' ,'class' => 'radio_english float_left' , 'value' => 'english');
  echo form_radio($data);
  ?>
  </div>
  <br />
  </div><?php */ ?>


                        
                        <div class="col-xs-12 col-sm-12 col-md-6 float_left direction box_shadow_mob">
							
                            <div id="header_box_shadow">
                                <p style="font-size: 10px; text-align: center; padding: 8px;"><?php echo lang('mycorner_receive_information'); ?></p>
                            </div>
                                <table border="0" class="table">
                                	<tr class="info">
                                		<td style="vertical-align: middle !important;">
                                			<?php
                        					$data = array('name' => 'newsletter', 'id' => 'newsletter', 'class' => 'float_left', 'value' => 1);
                        					echo form_checkbox($data);
                        					?>
                                		</td>
                                		<td style="vertical-align: middle !important;">
                                			<a style="font-size: 12px"><?php echo lang('mycorner_updates'); ?></p>
                                		</td>
                                	</tr>
                        			
							
                                	
<?php
for ($i = 0; $i < sizeof($newsletter); $i++) {
    $newsletter_id = $newsletter[$i]['newsletter_types_ID'];
    $newsletter_name = $newsletter[$i]['newsletter_types_title' . $current_language_db_prefix];
    echo '<tr><td style="vertical-align: middle !important;">';


    $data = array('name' => 'newsletter_members_members_id[]', 'class' => 'reg_mob_newsletter_field', 'value' => $newsletter_id, 'checked' => FALSE, 'style' => '');
    echo form_checkbox($data);
    echo '</td>';
    echo '<td style="vertical-align: middle !important;">';
    echo '<p style="font-size: 10px">' . $newsletter_name . '</p>';
    echo '</td></tr>';
}
echo '<tr id="month" class="para_text_table" style="display:none">';
echo '<td style="vertical-align: middle !important;">' . lang('mycorner_pregnancy_month') . '';
echo '<select name="baby_month" id="baby_month" class="baby_month">';

for ($i = 0; $i <= 8; $i++) {
    if ($i == 0) {

        echo '<option value="' . ($i) . '" ></option>';
    } else {

        echo '<option value="' . ($i) . '" >' . ($i) . '</option>';
    }
}
echo '</select>';

echo '</td></tr>';
echo '<tr><td style="vertical-align: middle !important;"><p id="pregnancy_month_error" class="field_error">' . lang("bestcook_field_required") . '</p></td></tr>';
// echo '<tr class="data_required_box"><td style="padding: 0 14px;"><p id="pregnancy_month_error" class="field_error">'. lang("bestcook_field_required").'</p></td></tr>';
?>
                                </table>

                        </div><!--end col-->
                            <div class="col-xs-12 col-md-12 col-sm-12">
                                    
                                <h2 style="font-size: 10px;">
                                	<?php
                                    $data = array('name' => 'approve_privacy', 'id' => 'approve_privacy', 'class' => 'float_left checkboxsecond', 'style' => 'margin: auto; position: initial;');
                                    echo form_checkbox($data);
                                    ?>
                                	<?php echo lang('mycorner_approve'); ?>
                                </h2>
                                <p class="" style="white-space:normal;font-weight:bold; font-size:9px;"> <?php echo lang('mycorner_register_approve'); ?> <span class="red"><a target="_blank" href="<?php echo site_url("terms_conditions"); ?>"><?php echo lang('mycorner_terms_conditions'); ?></a> </span> <?php echo lang('mycorner_and'); ?> <span class="red"> <a  target="_blank" href="<?php echo site_url("privacy_policy"); ?>"> <?php echo lang('mycorner_privacypolicy'); ?></a></span> <?php echo lang('mycorner_required'); ?> <span class="red"><?php echo lang('mycorner_fill_all_info'); ?></span> </p>
                            </div>
                                    <?php
                                    echo form_error('approve_privacy');
                                    echo '<p id="approve_privacy_error" class="field_error float_left">' . lang("mycorner_must_approve") . '</p>';
                                    ?>
                        <div  class="col-xs-12">
                                    <?php
                                    $data = array('name' => 'register', 'class' => 'mycorner_button');
                                    echo form_submit($data, lang('mycorner_register'));
                                    ?>
                        </div>
            	</div>
            	<!-- row -->
            	<?php echo form_close(); ?>
                <div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div> 
            </div><!-- col-xs-12 -->
            </div><!-- row -->
<script>
    $(document).ready(function (e) {
        //$("#third_row").hide();
                                <?php /* ?>$( ".newsletter_type[value=6]" ).live("change",function(){
                                  var item = $(this);
                                  var checked =  this.checked;
                                  if(checked)
                                  {
                                  item.parent().append('<div id="baby_birthday1" class="float_left"><table id="InputsWrapper" border="0" class="float_left direction"></table><table width="100%" border="0" class="float_left direction"><tr><td class="small"><div><a href="#" id="AddMoreFileBox" class="add_child_link btn btn-default" style="margin-top:15px;" ><?php echo lang('mycorner_add_child');?></a></div></td></tr></table></div><div class="clear"></div>');
                                  item.parent().append('<div id="borthday_box1"><tr><td><?php echo lang('mycorner_child_age'); ?></td><td><input style="" type="text" class="date-input-css child_age" name="children_age[]" id="field_'+ x +'" value=""></td></tr> <tr><td><?php echo lang('mycorner_child_name'); ?></td><td><input style="" type="text" class="child_name" name="children_name[]" id="field_'+ x +'" value=""/>   <a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');

                                  $("#borthday_box2").remove();
                                  $("#baby_birthday2").remove();

                                  }else{
                                  $("#baby_birthday1").remove();
                                  $("#borthday_box1").remove();
                                  }
                                  });<?php */ ?>

<?php /* ?>$( ".newsletter_type[value=5]" ).live("change",function(){
  var item = $(this);
  var checked =  this.checked;

  if(checked)
  {
  item.parent().append('<div id="baby_birthday2" class="float_left"><table id="InputsWrapper" border="0" class="float_left direction"></table><table width="100%" border="0" class="float_left direction"><tr><td class="small"><div><a href="#" id="AddMoreFileBox" class="add_child_link btn btn-default"><?php echo lang('mycorner_add_child');?></a></div></td></tr></table></div><div class="clear"></div>');
  item.parent().append('<div id="borthday_box2"><tr><td><?php echo lang('mycorner_child_age'); ?></td><td><input type="text" class="date-input-css child_age" data-role="date" name="children_age[]" id="field_'+ x +'" value=""></td></tr><tr><td><?php echo lang('mycorner_child_name'); ?></td><td><input style="" type="text" class="child_name" name="children_name[]" id="field_'+ x +'" value=""/><a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');
  $("#baby_birthday1").remove();
  $("#borthday_box1").remove();
  }else{
  $("#baby_birthday2").remove();
  $("#borthday_box2").remove();
  }

  });<?php */ ?>
<?php /* ?>var x = $("#borthday_box").length + 1;
  $("#AddMoreFileBox").live("click", function(){
  var item = $(this);
  if(x <= 7){
  item.parent().parent().append('<div id="borthday_box"><tr><td><?php echo lang('mycorner_child_age'); ?></td><td><input type="text" class="date-input-css child_age" data-role="date" name="children_age[]" id="field_'+ x +'" value=""></td></tr> <tr><td><?php echo lang('mycorner_child_name'); ?></td><td><input style="" type="text" class="child_name" name="children_name[]" id="field_'+ x +'" value=""/><a id="close_field" href="#">x</a></td></tr><tr><td><p id="members_child_error" class="field_error"><?php echo lang("bestcook_field_required")?></p></td></tr></div>');
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
  <?php */ ?>
        $('#first_name').change(function (e) {
            var first_name = $(this).val();
            if (first_name === "") {
                $("#first_name_error").fadeIn("fast");
                state = false;
            } else {
                $("#first_name_error").fadeOut("fast");
            }
        });

        $('#last_name').change(function (e) {
            var last_name = $(this).val();
            if (last_name === "") {
                $("#last_name_error").fadeIn("fast");
                state = false;
            } else {
                $("#last_name_error").fadeOut("fast");
            }
        });
        $('#members_password').change(function (e) {
            var members_password = $(this).val();
            if (members_password === "") {
                $("#members_password_error").fadeIn("fast");
                $('#members_password_validation').fadeOut("fast");
                state = false;
            } else {
                $("#members_password_error").fadeOut("fast");
                $('#members_password_validation').fadeIn("fast");
            }
        });
        $('#repeat_password').change(function (e) {
            var repeat_password = $(this).val();
            if (repeat_password === "") {
                $("#repeat_password_error").fadeIn("fast");
                state = false;
            } else {
                $("#repeat_password_error").fadeOut("fast");
            }
        });
        /*
         $('#mobile_number').change(function(e) {
         var mobile_number = $(this).val();
         if(mobile_number === ""){
         $("#mobile_number_error").fadeIn("fast");
         state = false;
         }else{
         $("#mobile_number_error").fadeOut("fast");
         }
         });*/
         $('#baby_month').change(function (e) {
             var baby_month = $(this).val();
             if (baby_month === "") {
                 $("#pregnancy_month_error").fadeIn("fast");
                 state = false;
             } else {
                 $("#pregnancy_month_error").fadeOut("fast");
             }
         });
/*
         $("#mobile_number_error").fadeOut("fast");
         {
         });*/
        
    });
</script>
