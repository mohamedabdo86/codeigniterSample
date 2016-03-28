<style>

.button_style
{
	margin-top: 10px !important;
}

.fancybox-inner
{
	width: 100% !important;
	overflow:hidden !important;
	 height: 270px !important;
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
<div id="ask_exper_contanier" class="row dir">
    <div id="ask_img_container" class="col-xs-2 col-xs-offset-5">
 		<img src="<?php echo base_url() . "images/nestle_fit/attention-img.png"; ?>" class="img-responsive"/>
	</div>
     
      <div id="ask_title" class="col-xs-12 col-sm-12 col-md-12">
       <div class="col-xs-11">
        <h3 style="margin: 13px 0px;"><?php echo lang('globals_ask_the_expert'); ?></h3>
        </div>
        <div class="col-xs-1">
           <img  id="ask-img" src="<?php echo base_url() . "images/nestle_fit/user-profile.png"; ?>" class="img-responsive" style="width:30px; padding-top: 5px;"/>
        </div>
        

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <h4 id="alert"><?php echo lang('nestlefit_out_app'); ?></h4>
    </div>
    <div id="buttons" class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-xs-6 col-sm-6 col-md-6 button_style float_left accept"> <?php echo anchor('mobile/best_me/ask_an_expert', lang('globals_continue'), 'id="go_to_ask_an_expert" rel="external"'); ?></div>
        <div class="col-xs-6 col-sm-6 col-md-6 button_style float_right back"> <a href="javascript:void(0);"  id="cancel"><?php echo lang('globals_back'); ?></a></div>

    </div>
</div>