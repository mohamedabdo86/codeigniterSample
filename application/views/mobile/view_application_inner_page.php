

<!--<div class="clear"></div>-->
<?php $this->load->view('mobile/template/mainmenu');   ?>




<!--<div class="clear"></div>-->

<div class="inner_title_wrapper">

<div class="sections_wrapper_padding white_background_color" >
<?php 
//print $display_data[0]['applications_ID'];
//print_r($display_data);
 if ($display_data[0]['applications_ID']==9){
 $link=site_url('mobile/'.$this->router->class.'/applications/9'); 
 }else{
	 $link="javascript:void(0);";
	 }

?>
<a href="<?php echo $link?>" rel="external"/>
<h1 class="<?php echo $current_section_color ?>">
<?php echo $this->headers->get_fourth_title(); ?>
	<span class="rightword"></span> 
	<!--<span class="leftword"> لتغذية افضل لأسرتك</span>-->
</h1>
</a>
</div>

</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>" style="margin-top:0px; margin-bottom:0px;"></div>
<div class="container-fluid">
<div class="global_background">

<?php
if($display_data[0]['applications_override_swf_flag'] == 0):
//Display SWF 
$app_link =  base_url()."uploads/applications_src/mobile".$display_data[0]['applications_src'.$current_language_db_prefix];
$app_width = $display_data[0]['applications_width'];
$app_height = $display_data[0]['applications_height'];
$desc = $display_data[0]['applications_desc'.$current_language_db_prefix];
$flash_vars = $display_data[0]['applications_flash_vars'.$current_language_db_prefix];
$flash_vars = str_replace("%BASE_URL%",base_url() , $flash_vars );
?>
	<div class="global_sperator_height" style="width:100%"></div>
    <?php
	if($desc != "")
	echo '<p class="sections_wrapper_padding" style="white-space:normal">'.$desc.'</p>';

	 ?>
	<div align="center">
    
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=11,0,29,0" width="<?php echo $app_width ?>px" height="<?php echo $app_height ?>px" >
    <param name="movie" value="<?php echo $app_link; ?>">
    <param name="quality" value="high">
    <param name="wmode" value="transparent">
    <param name="scale" value="exactfit">
    <param name="allowScriptAccess" value="SameDomain">
    <param name="allowFullScreen" value="True">
    <param name="flashvars" value="<?php echo $flash_vars; ?>">  
    <embed src="<?php echo $app_link; ?>" quality="high" width="<?php echo $app_width ?>px" height="<?php echo $app_height ?>px"  pluginspage="https://www.macromedia.com/go/getflashplayer" wmode="transparent" scale="exactfit" flashvars="<?php echo $flash_vars; ?>" allowScriptAccess="SameDomain" allowFullScreen="True" type="application/x-shockwave-flash"></embed></object>
    </div>
<?php
endif;
if($display_data[0]['applications_override_swf_flag'] == 1):
//IF not SWF , display view
?>
	
	<div class="sections_wrapper_padding">
	<!--<div class="global_sperator_height" style="width:100%"></div>-->
    <?php $this->load->view('mobile/'.$display_data[0]['applications_src']); ?>
   <!-- <div class="global_sperator_height" style="width:100%"></div>-->
    </div>
	
<?php
endif;

?>    

</div><!-- End of global_background -->
</div>













