<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=699451000078016";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<style>
#fb-root {
  display: none;
}
 
/* To fill the container and nothing else */
.fb_iframe_widget, .fb_iframe_widget span, .fb_iframe_widget span iframe[style] {
  width: 100% !important;
}
</style>
<div class="products">

<?php
$current_facebook_link = $display[0]['products_brand_facebook_url'];

if($display_subproduct[0]['products_facebook_url'] != "")
{
	$current_facebook_link = $display_subproduct[0]['products_facebook_url'];
}
?>
    <div class="row">
        <div class="product-widget">
            <div class="facebook-page-block col-xs-12 col-sm-12 col-md-6 col-lg-6 product-widget-bg">
            	<?php if(!empty($current_facebook_link)){?>
                <div class="header">
                    <h2><?php echo lang('globals_facebook'); ?></h2>
                </div>
                
            <!--    <img src="http://placehold.it/600x700&text=FooBar1" class="img-responsive"/>-->
                            <div class="fb-like-box" data-href="<?php echo $current_facebook_link; ?>" data-width="600" data-height="700" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>

            </div>
            <?php } ?>
            <div class="contact-block col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="header">
                    <h2><?php echo lang('product_feedback'); ?></h2>
                </div>
                <div id="contact-form" class="product-widget-bg">
                    <form action="mobile/products/add_comment/"  method="post" id="form">
                        <input type="hidden" name="id" value="<?php echo $brand_id; ?>"  />
                        <?php 
		                   $data = array('rows' => 9, 'cols' => 66, 'name' => 'comment_text', 'id' => 'comment_text' ,'placeholder'=>lang('product_comments_placeholder'));
		                    echo form_textarea($data);
		                 ?>
                   <!--     <textarea rows="8" cols="50" name="contact-message"> </textarea>-->
                        <a style="float:right" rel="external" href="<?php echo site_url("mobile/products/reviews/{$brand_id}"); ?>"><?php echo lang('product_view_comments'); ?></a>
                        <a style="float:left" href="javascript:void(0);" class="vote_button" id="submit"><?php echo lang('product_send_comments'); ?></a>

                    </form>
                </div>
            </div>
        </div> 
    </div>
</div>

<script>
$(document).ready(function(e) {
    $("#submit").live("click", function() {
   var members_id = '<?php echo $this->members->members_id ?>';		
	if($("#comment_text").val() === ""){
	return false;
	}else{
	data = $( "#form" ).serialize();
	$.post( "<?php echo site_url('mobile/products/add_comment/'); ?>", data, function( message ){
		if(message === 0){
			$( "#contact-form" ).html( '<h2 class="thanks_message product_color"><?php echo lang('product_polls_not_login') ?></h2>');
		}else if(message === 1){
			if(members_id == 0){
				$( "#contact-form" ).html( '<h2 class="thanks_message product_color"><?php echo lang('globals_thanks_for_comment_not_login') ?></h2>');
				}else{
				$( "#contact-form" ).html( '<h2 class="thanks_message product_color"><?php echo lang('globals_thanks_for_comment') ?></h2>');
					}
		}else{
			$( "#contact-form" ).html( '<h2 class="thanks_message product_color"><?php echo lang('product_polls_error') ?></h2>');
		}
	});
	}
	return false;
});
});



</script>