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
	padding: 5px 20px;
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
	width: 30% !important;
	height: 117px;
	margin: 0 36%;
}
body.arabic .login_form_bottom
{
	width: 30% !important;
	height: 117px;
	margin: 0 40%;
}

</style>

<script>
$(document).ready(function(e) {
	$( ".toggle" ).click(function() {
  		$( ".form_box" ).slideToggle( "slow" );
		$( ".arrow-up" ).slideToggle( "slow" );
		$("html, body").animate({ scrollTop: 0 }, 500);
		return false;
	});
});
</script>

	<div class="login_form_bottom float_right">
        <ul>
            <li class="float_right" ><a class="button_login" href="<?php echo site_url('my_corner/create_my_corner'); ?>"><?php echo lang('globals_lform_signup'); ?></a></li>
            <li class="float_right" style="margin:0 20px;"><a class="button_login toggle" href="#"><?php echo lang('globals_lform_signin'); ?></a></li>
        </ul>
    </div>
    <div class="clear"></div>
