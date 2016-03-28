<div id="banner2">
<?php 
if($display_promotions)
{
	// Please add image url here
	$url = base_url().'uploads/promotions/';
	$image = $url.$display_promotions[0]['images_src'];
	$product_name = $display[0]['products_brand_name'.$current_language_db_prefix];
?>
    <img height="150" width="870" src="<?php echo $image; ?>" class="float_right image_banner" />
<?php } ?>
  	<h2 class="banner_header float_right white_color product_background_color">
    <table width="130" height="150">
    <tr height="150">
    <td valign="middle" style="white-space:normal;" title="<?php echo $product_name.lang('product_offer'); ?>">
	<?php if($current_language_db_prefix == ""){ ?>
	<?php echo $product_name;  ?><?php echo lang('product_offer'); ?> 
    <?php }else{ ?>
    <?php echo lang('product_offer'); ?> <?php echo  $product_name; ?>
    <?php }?>
    </td>
    </tr>
    </table>
    
    </h2>
  </div>
