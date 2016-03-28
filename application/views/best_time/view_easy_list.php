


<div class="clear"></div>
<?php echo $this->load->view('template/submenu_writer');   ?>
<?php echo $this->load->view('template/tree_menu_writer');   ?>

<style>
.recent_items_list ul li
{
	width:290px !important;
	height:220px !important;
}
</style>

<div class="clear"></div>

<div class="inner_title_wrapper">

<div class="sections_wrapper_margin">
<h1 class="<?php echo $current_section_color; ?>"><?php echo $subsection_title; ?></h1>
</div>


</div><!-- End of inner_title_wrapper -->
<div class="thick_line <?php echo $current_section_background_color; ?>"></div>



<div class="clear"></div>
<div class=" global_background"  >
<div class="clear"></div>
<ul class="lists_of_image_grids li_third content">

<?php
for($i=0 ; $i < sizeof($display_all_tips) ; $i ++):
$title = $display_all_tips[$i]['easy_ideas_title'.$current_language_db_prefix];

if($current_language_db_prefix == '_ar')
{
	$short_title = $this->common->limit_text($title,30);
}
else
{
	$short_title = $this->common->limit_text($title,25);
}

$image  = base_url()."uploads/easy/thumb_".$display_all_tips[$i]['images_src'];

$url = site_url($this->router->class."/".$this->router->method."/". $display_all_tips[$i]['easy_ideas_ID']);



?>


<li class="float_left" style="height:181px;">

<div class="image" style="height:181px; "><a href="<?php echo $url;?>" title="<?php echo $title;?>"><img src="<?php echo $image; ?>" alt="<?php echo $title;?>"/></a></div>
<div class="title float_left dark_gray" style="position: absolute;
top: inherit; bottom:0px;">
    <div style="margin:0 5px;"><a class="dir" title="<?php echo $title;?>" href="<?php echo $url ?>"><?php echo $short_title;?></a></div>
     
</div>
</li>

<?php
endfor;
?>

<div class="clear"></div>

</ul>

<div class="clear"></div>

<div class="page_navigation" align="center">
<?php echo  $pagination_links; ?>
</div>


</div><!-- End of container_pagination_wrapper -->
<div class="clear"></div>



<div class="clear"></div>