<style>
/******************calories calculator**********************/

.calories_calculator_page {
 background-image:url(<?php echo base_url()."images/nestle_fit/calories-calculator-background.jpg";
?>);
	height: 540px;
}
.search {
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
	font-size: 16px;
	font-weight: 600;
	text-indent: 7px;
	margin: 0 20px;
	height: 27px;
}
.ui-datepicker {
	z-index: 9999 !important;
}
/****************Homepage***********************/
.h_link {
	color: #0978f1;
}
.h_link:hover {
	text-decoration: underline;
}
#nestlefit_member_img_container {
	text-align: center;
	margin-bottom: 10px;
}
#nestlefit_member_img_container #user_image {
	border-radius: 50%;
	-moz-border-radius: 50%;
	-webkit-border-radius: 50%;
}
#landing_page_nestle_fit {
 background-image:url(<?php echo base_url()."images/nestle_fit/nestle_fit_landing_background.jpg";
?>);
	background-repeat: no-repeat;
	background-size: contain;
	background-position: center top;
	height: 520px;
	position: relative;
}
#landing_page_nestle_fit ul#sections {
	margin-top: 331px;
	height: 170px;
	width: 933px;
	margin-left: 10px;
	position: absolute;
}

#landing_page_nestle_fit ul#sections li .desc{
	height: 113px;
	}

#landing_page_nestle_fit ul#sections li {
	width: 311px;
	min-height: 170px;
}
body.english #landing_page_nestle_fit ul#sections li h3 {
	word-spacing: -4px;
	text-indent: 5px;
}
#landing_page_nestle_fit ul#sections li h3, h3.title {
	height: 56px;
	color: #fff;
	line-height: 55px;
	text-indent: 4px;
	font-weight: 600;
}
h3.title {
	font-size: 20px;
}
#landing_page_nestle_fit ul#sections li h3 {
	cursor: pointer;
	font-size: 18px;
}
body.arabic #landing_page_nestle_fit ul#sections li h3 {
	text-indent: 68px;
}
#landing_page_nestle_fit ul#sections li .desc p {
	white-space: normal;
	color: #fff;
	padding: 7px;
	height: 51px;
	margin: 0;
}
#landing_page_nestle_fit ul#sections li .desc h2 {
	white-space: normal;
	color: #fff;
	text-align: center;
	font-weight: 600;
}
#landing_page_nestle_fit ul#sections li:first-child h3 {
 background-image:url(<?php echo base_url()."images/nestle_fit/nestle_fit_image.jpg";
?>);
}
/*#landing_page_nestle_fit ul#sections li:first-child {
	background-color: rgba(31,135,183,0.6);
}*/

#landing_page_nestle_fit ul#sections li:first-child .desc{
		background-color: rgba(31,135,183,0.6);
	}

#landing_page_nestle_fit ul#sections li:first-child .desc #notification_messages{
		color: rgba(31,135,183,0.6);
		background:white;
		-webkit-border-radius: 15px;
        -moz-border-radius: 15px;
        border-radius: 15px;
        padding: 0 10px;
	}
	
	.nestle_fit_app_btn:active {
		  position:relative;
	top:1px;
		}
#landing_page_nestle_fit ul#sections li:nth-child(2) h3 {
 background-image:url(<?php echo base_url()."images/nestle_fit/calories_image.jpg";
?>);
}
/*#landing_page_nestle_fit ul#sections li:nth-child(2) {
	background-color: rgba(166,52,62,0.6);
}*/
#landing_page_nestle_fit ul#sections li:nth-child(2) .desc{
	background-color: rgba(166,52,62,0.6);
}

#landing_page_nestle_fit ul#sections li:nth-child(2) .desc #calories_calculator{
     color: rgba(166,52,62,0.6);
	 background:white;
	 -webkit-border-radius: 15px;
     -moz-border-radius: 15px;
     border-radius: 15px;
     padding: 0 10px;
	}
	
#landing_page_nestle_fit ul#sections li:nth-child(3) h3 {
 background-image:url(<?php echo base_url()."images/nestle_fit/activity_image.jpg";
?>);
}
/*#landing_page_nestle_fit ul#sections li:nth-child(3) {
	background-color: rgba(234,137,29,0.6);
}*/
#landing_page_nestle_fit ul#sections li:nth-child(3) .desc{
	background-color: rgba(234,137,29,0.6);
}
#landing_page_nestle_fit ul#sections li:nth-child(3) .desc #burn_rate{
     color: rgba(234,137,29,0.6);
	 background:white;
	 -webkit-border-radius: 15px;
     -moz-border-radius: 15px;
     border-radius: 15px;
     padding: 0 10px;
	}
/*burn rate design*/
.burn_rate_container {
 background-image:url(<?php echo base_url()."images/nestle_fit/activity-calculator-background.jpg";
?>);
	height: 540px !important;
}
.burn_rate_container #burn_rate {
	position: absolute;
	top: 428px;
	width: 400px;
	margin: 0 300px;
}
#sport, #minutes {
	width: 400px;
	height: 39px !important;
	border-radius: 7px;
	margin-top: 10px;
	font-size: 16px;
	font-weight: bold;
	color: #5f5f5f;
}
.btn {
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #d67711), color-stop(1, #e9820d) );
	background: -moz-linear-gradient( center top, #d67711 5%, #e9820d 100% );
 filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#d67711', endColorstr='#e9820d');
	background-color: #d67711;
	-webkit-border-radius: 32px;
	-moz-border-radius: 32px;
	border-radius: 32px;
	text-indent: 0;
	display: inline-block;
	color: #ffffff;
	font-size: 15px;
	font-weight: bold;
	line-height: 30px;
	padding: 5px 10px;
	border: none;
	margin-top: 10px;
	cursor: pointer;
}
.btn:hover {
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #e9820d), color-stop(1, #d67711) );
	background: -moz-linear-gradient( center top, #e9820d 5%, #d67711 100% );
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e9820d', endColorstr='#d67711');
	background-color: #e9820d;
}
.btn:active {
	position: relative;
	top: 1px;
}
#burn_rate_result {
	width: 110px;
	text-align: center;
	background-color: #fff;
	height: 50px;
	font-size: 35px;
	font-weight: bold;
	color: #ff8600;
	line-height: 50px;
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
	border: 3px solid #e9810d;
	margin-top: 9px;
	margin: 0 148px;
	
}
.button_style {
	-webkit-border-radius: 16px;
	-moz-border-radius: 16px;
	border-radius: 16px;
	display: inline-block;
	color: #ffffff;
	font-size: 15px;
	line-height: 20px;
	font-weight: bold;
	padding: 10px 22px;
	text-align: center;
	margin-top: 25px;
	cursor: pointer;
}
.button_style:active {
	position: relative;
	top: 1px;
}
.update_info:hover {
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #e86835), color-stop(1, #f6b33d) );
	background: -moz-linear-gradient( center top, #e86835 5%, #f6b33d 100% );
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e86835', endColorstr='#f6b33d');
	background-color: #e86835;
}
.confirm_update_info:hover {
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #e86835), color-stop(1, #f6b33d) );
	background: -moz-linear-gradient( center top, #e86835 5%, #f6b33d 100% );
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e86835', endColorstr='#f6b33d');
	background-color: #e86835;
}
.start_fit:hover {
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff) );
	background: -moz-linear-gradient( center top, #378de5 5%, #79bbff 100% );
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff');
	background-color: #378de5;
}
.update_info {
	-moz-box-shadow: inset 0px -1px 0px -3px #e97042;
	-webkit-box-shadow: inset 0px -1px 0px -3px #e97042;
	box-shadow: inset 0px -1px 0px -3px #e97042;
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #e97042), color-stop(1, #e97042) );
	background: -moz-linear-gradient( center top, #e97042 5%, #e97042 100% );
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e97042', endColorstr='#e97042');
	background-color: #e97042;
}
.confirm_update_info {
	-moz-box-shadow: inset 0px -1px 0px -3px #e97042;
	-webkit-box-shadow: inset 0px -1px 0px -3px #e97042;
	box-shadow: inset 0px -1px 0px -3px #e97042;
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #e97042), color-stop(1, #e97042) );
	background: -moz-linear-gradient( center top, #e97042 5%, #e97042 100% );
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e97042', endColorstr='#e97042');
	background-color: #e97042;
}
.start_fit {
	-moz-box-shadow: inset 0px -1px 0px -3px #bbdaf7;
	-webkit-box-shadow: inset 0px -1px 0px -3px #bbdaf7;
	box-shadow: inset 0px -1px 0px -3px #bbdaf7;
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5) );
	background: -moz-linear-gradient( center top, #79bbff 5%, #378de5 100% );
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5');
	background-color: #79bbff;
}
/*
*  Registeration Form CSS
*/

.app_register {
	height: auto;
	width: 556px;
	margin: 200px 69px 0px 0px;
}
.app_header {
	white-space: normal;
	text-align: center;
	color: #000;
	font-weight: bold;
	width: 100%;
	top: 200px;
	position: absolute;
	line-height: 0px;
}
.app_sub_header {
	position: absolute;
	width: 100%;
	top: 223px;
	color: #fff;
	text-align: center;
	font-size: 16px;
	padding-left: 12px;
}
.form_label {
	color: #CCC;
}
#create_form input, #create_form select {
	margin: 0px;
	font-size: 12px;
	padding: 4px 20px;
	color: #6f6f6f;
	font-weight: bold;
	border-radius: 22px;
	-webkit-border-radius: 22px;
	-moz-border-radius: 22px;
	border: none;
	line-height: 25px;
}
#create_form input[type="submit"] {
	background-color: #98ca00;
	color: #fff;
	font-weight: bold;
	border-radius: 22px;
	-webkit-border-radius: 22px;
	-moz-border-radius: 22px;
	border: none;
	line-height: 25px;
}
.form_input_larg {
	width: 300px;
}
.form_input_small {
	width: 100px;
	background-color: #98ca00;
	color: #fff;
	font-weight: bold;
}
#create_form {
	top: 250px;
	position: absolute;
	width: 100%;
	padding-left: 10px;
}
.nestle_fit_reg_form_field_wrapper {
	width: 100%;
	text-align: center;
	margin-bottom: 8px;
}
#nestle_fit_gender_wrapper_span {
	width: auto;
	border-radius: 20px;
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
	overflow: hidden;
	background-color: #fff;
	line-height: 30px;
	padding: 6px 4px;
}
body.arabic #nestle_fit_gender_wrapper_span {
	padding: 0 5px;
}
.check_box_label {
	padding: 0 3px;
	cursor: pointer;
	margin: 0px;
	line-height: 25px;
	background-color: #fff;
	color: #6f6f6f;
	border-radius: 20px;
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
}
.check_box_title_label {
	position: relative;
	margin: 0px;
	padding: 0 10px;
	background-color: #fff;
	color: #6f6f6f;
	border-radius: 20px;
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
}
.check_box_label span {
	margin: 0px;
	padding: 1px 28px;
	border-radius: 20px;
	-webkit-border-radius: 20px;
	-moz-border-radius: 20px;
}
.check_box_label input, .check_box_title_label input {
	display: none;
	margin: 0px;
	padding: 0px;
}
input + span {
	display: inline-block;
	padding: 0px;
}
:checked + span {
	background: #98ca00;
	color: #fff;
	display: inline-block;
}
input[disabled] + span {
	background: #fff;
	color: #6f6f6f;
}
p#member_image {
	position: absolute;
	left: 0px;
	top: 85px;
	width: 100%;
	margin: 0 !important;
	padding: 0px 0px 0px 80px;
	text-align: center;
}
#day {
	position: absolute;
	top: 459px;
	left: 480px;
	font-size: 25px;
	color: white;
}
.water_container {
 background-image: url(<?php echo base_url()."images/nestle_fit/water-background.jpg";
?>);
	height: 535px;
}
.water_cup, .water_not_selected {
 background-image:  url(<?php echo base_url()."images/nestle_fit/water-icon.png";
?>);
	background-repeat: no-repeat;
}
.water_selected {
 background-image:url(<?php echo base_url()."images/nestle_fit/water-selected.png";
?>);
}
.water-icon {
	width: 40% !important;
	margin: 30px auto;
}
.water_container #water_info {
	position: absolute;
	top: 490px;
	left: 325px;
}
.water_container #water_info h1 {
	color: #125e9f;
	font-weight: bold;
	margin-right: 30px;
	font-size: 25px;
}
.water_container #water_info #info1 {
	color: white;
	font-size: 15px;
}
.water_container #water_info h4 span {
	font-weight: bold;
	color: white;
}
.water_container #water_info h4 {
	color: white;
	line-height: 12pt;
}
#water_header_title {
	position: absolute;
	top: 390px;
	left: 430px;
	font-size: 29px;
	color: white;
	font-weight: bold;
}
.english #water_header_title {
	top: 395px;
	left: 475px;
}
.english #day {
	top: 452px;
}
#breakfast-space {
	margin-right: 60px;
	color: #c8c8c8;
	background-color: white;
	padding: 22px;
	border-radius: 15px;
	width: 70px;
	height: 22px;
	float: right;
	margin-top: 2px;
	overflow: hidden;
}
#breakfast-space h4 {
	text-align: center;
	margin-top: -13px;
	color: #4cc196;
}
.other-food {
	color: #c8c8c8;
	background-color: white;
	padding: 22px;
	border-radius: 15px;
	width: 70px;
	height: 22px;
	float: right;
	margin-right: 22px;
	margin-top: 2px;
	overflow: hidden;
}
.other-food h4 {
	text-align: center;
	margin-top: -13px;
	color: #4cc196;
}
.video_list_wrapper {
	margin-top: -41px !important;
	width: 100% !important;
	height: auto !important;
	position: relative !important;
	margin-left: -165px !important;
}
#lunch_plus {
	border-radius: 7px;
	position: relative;
	left: -66px;
	top: -29px;
}
.dinner_plus {
	border-radius: 7px;
	position: relative;
	left: -86px;
	top: 15px;
}
.english .dinner_plus {
	left: -115px;
}
#breakfast_plus {
	border-radius: 7px;
	position: relative;
	left: -26px;
	top: 15px;
}
#end_day_date {
	position: absolute;
	top: 110px;
	left: 260px;
	font-size: 20px;
	color: white;
}
#sub_calories {
	text-align: center;
/*	color: #519680;*/
color:#FFF;
	font-size: 15px;
	color:white
}
.english .video_list_wrapper {
	margin-top: -41px !important;
	width: 100% !important;
	height: auto !important;
	position: relative !important;
	margin-right: -165px !important;
}
.english #breakfast_plus {
	border-radius: 7px;
	position: relative;
	left: 64px;
	top: -19px;
	ms-transform: rotate(270deg);
	-webkit-transform: rotate(270deg);
	transform: rotate(270deg);
}
.english #lunch_plus {
	border-radius: 7px;
	position: relative;
	left: 64px;
	top: -19px;
	ms-transform: rotate(270deg);
	-webkit-transform: rotate(270deg);
	transform: rotate(270deg);
}
.english .dinner_plus {
	border-radius: 7px;
	position: relative;
	left: 64px;
	top: -19px;
	ms-transform: rotate(270deg);
	-webkit-transform: rotate(270deg);
	transform: rotate(270deg);
}
/*data design*/
.nestle_fit_data_input {
	border: none;
	background-color: white;
	border-radius: 9px;
	color: #e7612d;
	text-indent: 9px;
	height: 30px;
	width: 80%;
}
.english .update {
	margin-top: -25px;
}
#update_info, #confirm_update_info {
	background-color: #e86735;
	padding-top: 5px;
	border-radius: 9px;
	padding-right: 35px;
	padding-left: 35px;
	color: white;
	font-size: 18px;
	padding-bottom: 5px;
}
#start_fit {
	background-color: #36adea;
	padding-top: 5px;
	border-radius: 9px;
	padding-right: 20px;
	padding-left: 30px;
	color: white;
	font-size: 18px;

	padding-bottom: 5px;
}
#start 
{
	margin-top: 22px;
}
.ui-tabs .ui-tabs-nav li{
		opacity: 1 !important;
		}
	body.arabic .meal_list li{
height: 55px !important;
margin-top: -12px !important;
}

body.english .meal_list li{
height: 55px !important;
margin-top: -12px !important;
}
p
{
	white-space: normal;
}
.ui-tabs .ui-tabs-nav li.ui-tabs-active a, .ui-tabs .ui-tabs-nav li.ui-state-disabled a, .ui-tabs .ui-tabs-nav li.ui-tabs-loading a
{
	background-color: #6dd1f6 !important;
	padding: 8px 5px;
}
.ui-widget
{
	font-family: 'Droid Arabic Kufi', serif !important; 
}
.ui-tabs .ui-tabs-nav li a, .ui-tabs-collapsible .ui-tabs-nav li.ui-tabs-active a
{
	background-color: #aa1c28 !important;
	color:white !important;
}
.ui-tabs .ui-tabs-nav li a{
	padding: 8px 5px;
}

.meal_list li
{
	width: 720px;
	margin: 5px 0px;
}
body.arabic .meal_list li
{
	margin: 7px 78px;
	margin-left: -65px;
}
.meal-calories{
	color:white;
}
.arabic .meal-calories{
direction: rtl;
}
.english .meal_list li{
margin-left: -70px;
}
.meal_list li .meal_recipe
{
	width:300px;
	height:40px;
	line-height:40px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 10px;
	
}
.arabic .meal-calories{

  margin-right: 10px;
}

.english.meal-calories{

  margin-left: 10px;
}
.meal_list li .meal_amount
{
	/*margin:0 10px;*/
	width:45px;
	text-align:center;
	height:40px;
	line-height:40px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 10px;
	font-size: 13px;
}

.mealmeasure 
{
	  width:90px;
	  margin: 4px;
	  background-color: white;
	  border-radius: 10px;
	  height: 44px;
	  margin-top: 0px;
	  line-height: 2.5;
	  border: none;
	  text-align: center;
}
.meal_list li .recipe
{
	margin:0 10px;
	border:1px #CCC solid;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	background-color:#f8ec9e;
	width:43px;
	height:43px;
}
.meal_list li .recipe a img
{
	padding: 6px 5px;
}

.meal_list li .delete a img
{
	padding: 2px 7px;
	width:36px;
}

.meal_button:active {
	position:relative;
	top:1px;
}

/*meals design*/
.meals_container
{
	 background-image: url(<?php echo base_url()."images/nestle_fit/meals-background.jpg"; ?>);
	 height:704px;
}

.ui-tabs .ui-tabs-nav
{
    background:none !important;
    border: none !important;
}

.meal_button 
{
	-moz-box-shadow: inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow: inset 0px 1px 0px 0px #ffffff;
	box-shadow: inset 0px 1px 0px 0px #ffffff;
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #892b33), color-stop(1, #892b33) );
	background: -moz-linear-gradient( center top, #ebbd3d 5%, #f6be15 100% );
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ebbd3d', endColorstr='#f6be15');
	background-color: #892b33;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
	border:1px solid #892b33;
	display:  inline-block;
	color:  #ffffff;
	font-size:15px;
	line-height:27px;
	text-align:   center;
	padding: 3px 10px;
	cursor: pointer;
}
.english .link_add_meal,.english .input_add_meal
{
	margin-left: 35px;

}
.meal_button:hover {
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #892b33), color-stop(1, #892b33) );
	background: -moz-linear-gradient( center top, #892b33 5%, #ebbd3d 100% );
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6be15', endColorstr='#ebbd3d');
	background-color: #892b33;
}
.submit_meal{
	background:  -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #6dd1f6), color-stop(1, #6dd1f6) );
	background-color: #6dd1f6;
	border: 1px solid #6dd1f6;
	}
.submit_meal:hover {
		background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #6dd1f6), color-stop(1, #6dd1f6) );
		background:-moz-linear-gradient( center top, #6dd1f6 5%, #ebbd3d 100% );
		background-color: #6dd1f6;
	}

#meal_type_icon
{
	float: right;
	margin-top: -10px;
	padding:0 4px
}
.meal_type_icon2
{
	float: right;

	margin-top: -4px;
	padding:0 4px
}

.english #meal_type_icon
{
float: left;

}
.english .meal_type_icon2
{
	float: left;

}
#meals_wrapper
{
	width: 645px;
	height: 290px;
	margin: 0 133px;
	margin-top: 10px;
}
body.english #meals_wrapper
{
	  margin: 0 180px;
}

body.english .ui-tabs .ui-tabs-panel
{
	  margin-left: 25px;
}
body.english #calender
{
  position: relative;
  top: 11px;
  left: 169px;
  width: 50px;
  height: 41px;
}
body.arabic #calender
{
  position: relative;
  top: 52px;
  left: 280px;
  width: 50px;
}
#tabs
{
	width: 665px;
	background: none;
	border: none;
}
#day 
{
	position: absolute;
	top: 459px;
	left: 402px;
	font-size: 25px;
	color: white;
}
.english #water_header_title 
{
	top: 401px;
	left: 475px;
}
.back-title 
{
	position: relative;
	color: white;
}
.arabic .back-title 
{
	position: relative;
	top: -17px;
	color: white;
}
#meals_details
{
	width: 645px;
	height:85px;
	margin: 0px 174px;
}
#back_button
{
	float: left;
	margin-left: 58px;
	height: 47px;
	width: 55px;
}
</style>
