 



<div class="clear"></div>
<?php echo $this->load->view('template/submenu_writer');   ?>
<?php echo $this->load->view('template/tree_menu_writer');   ?>

<?php
$title = $display_data[0]['games_name'.$current_language_db_prefix];
$url = base_url()."uploads/applications_src/".$display_data[0]['games_url'];
$width = $display_data[0]['games_width'];
$height= $display_data[0]['games_height'];
?>

<div class="clear"></div>

<div class="inner_title_wrapper">


<div class="sections_wrapper_margin">
<h1 class="<?php echo $current_section_color; ?>"><?php echo $title; ?></h1>
</div>


</div><!-- End of inner_title_wrapper -->
<div class="thick_line <?php echo $current_section_background_color; ?>"></div>


 
<div class="clear"></div>

<div class="global_background" style="width:100%; height:auto;">

<div align="center" style="padding-top:7px;">

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=11,0,29,0" width="<?php echo $width ?>px" height="<?php echo $height ?>px" >
    <param name="movie" value="<?php echo $url; ?>">
    <param name="quality" value="high">  <param name="wmode" value="transparent">
    <param name="scale" value="exactfit">  <param name="allowScriptAccess" value="SameDomain">
    <param name="allowFullScreen" value="True">
  
    <embed src="<?php echo $url; ?>" quality="high" width="<?php echo $width ?>px" height="<?php echo $height ?>px"  pluginspage="https://www.macromedia.com/go/getflashplayer" wmode="transparent" scale="exactfit" flashvars="" allowScriptAccess="SameDomain" allowFullScreen="True" type="application/x-shockwave-flash"></embed></object>


</div>

<div class="clear"></div>

</div><!-- End of global_background -->



<div class="clear"></div>

