<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=699451000078016";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php
$current_facebook_link = $display[0]['products_brand_facebook_url'];

if($display_subproduct[0]['products_facebook_url'] != "")
{
	$current_facebook_link = $display_subproduct[0]['products_facebook_url'];
}
?>

<div id="facebook" class="float_right"><h1 id="slider_tag" class="product_color dir"><?php echo lang('globals_facebook'); ?><img class="float_right" style="max-width: 30; margin-top: 0px" src="<?php echo base_url('images/products/products_fb.png');?>" /></h1>
<div align="center">
<div class="fb-like-box" data-href="<?php echo $current_facebook_link; ?>" data-width="475" data-height="210" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
</div>
</div>