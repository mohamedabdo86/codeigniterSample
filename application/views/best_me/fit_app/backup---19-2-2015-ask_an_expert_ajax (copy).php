<style>
.fancybox-wrap
{
	width: 480px !important;
	height: 300px !important;
}
.fancybox-inner
{
	width: 450px !important;
	height: 270px !important;
	overflow:hidden !important;
}
#ask_exper_contanier
{
	width:450px;
	height:270px;
}
#ask_img_container
{
	text-align:center;
	margin-bottom:10px;
}
#ask_title
{
	width: 100%;
	background-color: #b6b8b8;
	height: 45px;
	text-align:center;
}
#ask_title h3 img
{
	padding: 5px;
}
#ask_title h3 span
{
	padding: 5px;
	position: relative;
	bottom: 13px;
}
#alert
{
	padding:10px;
	text-align:center;
}
.button_style
{
	-webkit-border-radius: 16px;
	-moz-border-radius: 16px;
	border-radius: 16px;
	display:inline-block;
	color:#ffffff;
	font-size:15px;
	line-height:20px;
	font-weight:bold;
	padding: 10px 22px;
	text-align:center;
	margin-top:25px;
}
.button_style:active
{
	position:relative;
	top:1px;
}
.back 
{
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #b8b8b8), color-stop(1, #c9c5c9) );
	background:-moz-linear-gradient( center top, #b8b8b8 5%, #c9c5c9 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#b8b8b8', endColorstr='#c9c5c9');
	border:1px solid #dcdcdc;
	background-color:#b8b8b8;
}
.back:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #c9c5c9), color-stop(1, #b8b8b8) );
	background:-moz-linear-gradient( center top, #c9c5c9 5%, #b8b8b8 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#c9c5c9', endColorstr='#b8b8b8');
	background-color:#c9c5c9;
}
.accept 
{
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #00aaff), color-stop(1, #0798e0) );
	background:-moz-linear-gradient( center top, #00aaff 5%, #0798e0 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#00aaff', endColorstr='#0798e0');
	background-color:#00aaff;
	border:1px solid #dcdcdc;
}
.accept:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #0798e0), color-stop(1, #00aaff) );
	background:-moz-linear-gradient( center top, #0798e0 5%, #00aaff 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0798e0', endColorstr='#00aaff');
	background-color:#0798e0;
}
</style>
<script>
    $(document).ready(function() {
        $('#cancel').on('click', function(event) {
            event.stopPropagation();
            $.fancybox.close();
        });
    });
</script>
<div id="ask_exper_contanier" class="dir">
	<div id="ask_img_container">
		<img src="<?php echo base_url() . "images/nestle_fit/attention-img.png"; ?>"/>
	</div>
    <div id="ask_title">
        <h3 class="white_color"><img id="ask-img" src="<?php echo base_url() . "images/nestle_fit/ask-an-expert-img.png"; ?>"/><span><?php echo lang('globals_ask_the_expert'); ?></span></h3>
    </div>
    <h4 id="alert"><?php echo lang('nestlefit_out_app'); ?></h4>
    <div id="buttons">
        <div class="button_style float_left accept"> <?php echo anchor('best_me/ask_an_expert', lang('globals_continue'), 'id="go_to_ask_an_expert"'); ?></div>
        <div class="button_style float_right back"> <a href="javascript:void(0);"  id="cancel"><?php echo lang('globals_back'); ?></a></div>
    	<div class="clear"></div>
    </div>
</div>