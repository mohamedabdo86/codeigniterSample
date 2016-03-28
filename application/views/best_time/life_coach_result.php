
<div class="clear"></div>
<?php echo $this->load->view('template/submenu_writer');   ?>
<?php echo $this->load->view('template/tree_menu_writer');   ?>

<style>
.recent_items_list ul li
{
	width:290px !important;
	height:220px !important;
}
.quiz_question 
{
	font-size: 20px;

	padding: 16px;
}
</style>

<div class="clear"></div>

<div class="inner_title_wrapper">

<div class="sections_wrapper_margin">
<h1 class="<?php echo $current_section_color; ?>"><?php echo $subsection_title; ?></h1>
</div>


</div><!-- End of inner_title_wrapper -->
<div class="thick_line <?php echo $current_section_background_color; ?>"></div>

<div class="quiz_container global_background" style="width: 1000px; min-height:50px;line-height: 27px;">
    <p class="<?php echo $current_section_color;?> quiz_question">
    <?php echo lang('besttime_thanks');?> <br  />
   <?php echo lang('besttime_answer');?>
    </p>
</div>

<div class="clear"></div>