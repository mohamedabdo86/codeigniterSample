<style>

.arabic .ui-checkbox input[type='checkbox'], .ui-radio input[type='radio']
{
	right:.466em;
}

.arabic #radio_reason1 label
{
	float: left;
}
.arabic .ui-checkbox input[type='checkbox'], .ui-radio input[type='radio']
{
	right:.466em !important;
}

.arabic #radio_reason1 label
{
	float: left;
}

</style>
<?php $num_1 = 1;
if($current_language_db_prefix == "_ar")
{
$num_1 = $this->common->arabic_numbers($num_1);
}
?>

<div class="contact_us_link" id="step_1">
   <h5><span><?php echo $num_1; ?></span><label class="mandat"> *</label><?php echo lang('contactus_reason'); ?></h5>
</div>
<div id="contact_reason" class="contact_us_section">
    <?php
		for ($i = 1; $i < sizeof($display_reason); $i++):
        echo "<div id='radio_reason1' class='float_left radio_dir col-xs-12 col-sm-6 col-md-6'>";
		echo "<label style='font-size:18px;' class='label_reason'>";
		echo $display_reason[$i];
		echo"</label>";
        echo form_radio('reason_ID', $i, 'checked', 'id=radio_reason_button', 'class=radio-inline');
        echo "</div>";
        endfor;
	?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<a href="#" class="float_right reason_next" id="reason_next"><?php echo lang('globals_next');?></a>
	</div>
</div>
</div>
<hr>