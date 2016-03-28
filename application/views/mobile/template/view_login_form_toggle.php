<style type="text/css">
.button_login 
{
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #ffffff) );
	background: -moz-linear-gradient( center top, #ffffff 5%, #ffffff 100% );
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ffffff');
	background-color: #ffffff;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
	border: 1px solid #b0b0b0;
	display: inline-block;
	color: #60ba58;
	font-weight: bold;
	line-height: 30px;
	padding:  0px 4px;
}
.button_login:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #ffffff) );
	background:-moz-linear-gradient( center top, #ffffff 5%, #ffffff 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ffffff');
	background-color:#ffffff;
}.button_login:active {
	position:relative;
	top:1px;
}
.login_form_bottom
{
	width: 70% !important;
	height: 117px;
	margin: 0 26%;
}
body.arabic .login_form_bottom
{
	width: 60% !important;
	height: 100px;
	margin: 0 40%;
}
@media (min-width: 801px){
.button_login{
  line-height: 71px;
  width: 170px;
  text-align: center;
  font-size: 30px;
}
}

@media (width: 800px){
	.button_login{
  line-height: 71px;
  width: 120px;
  text-align: center;
  font-size: 30px;
}

.english .button_login {
  font-size: 23px;
  margin-top: 12px;
}
</style>

<script>
$(document).ready(function(e) {
	$( ".diet_app_button_login" ).click(function() {
  		$( ".header_top_signin" ).trigger( "click" );
		//$("html, body").animate({ scrollTop: 0 }, 500);
		return false;
	});
});
</script>

	<div class="login_form_bottom float_right" style="margin-top: -30%;">
        <ul style="list-style-type:none">
            <li class="float_right" ><a class="button_login" href="<?php echo site_url('mobile/my_corner/create_my_corner'); ?>" rel="external"><?php echo lang('globals_lform_signup'); ?></a></li>
            <li class="float_right" style="margin:0 4px;"><a class="button_login diet_app_button_login" href="#"><?php echo lang('globals_lform_signin'); ?></a></li>
        </ul>
    </div>
    <div class="clear"></div>
