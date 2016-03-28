<script type="text/javascript">
$(document).ready(function(e) {
    	$(".fancybox").fancybox({padding: 0});
	<?php 
	$today = date('d-m-Y');
	if(!$val_4){
		$date_tips=$today;
		}else{
			$date_tips=$val_4;
			}
	if($date_tips==$today ){
		?>
		$(".tips").trigger("click");
		
		<?php }?>
});
</script>
<style>

.fancybox-wrap
{
	width: 500px !important;
}
.fancybox-inner 
{
	background: none !important;
	width:100% !important;
	height:500px !important;
	overflow:hidden;
}
.tips{width:100%; display:none;}
.new-tips{width:100%; display:none;}
.meals_tips{width:100%; display:none;}
.fancybox-outer { background: none !important;width:100% !important;}
.fancybox-skin {background: none !important;box-shadow:none !important; -webkit-box-shadow:none !important;-moz-box-shadow:none !important;}
.fancybox-close{top: 0px;right: 2px;}
</style>
