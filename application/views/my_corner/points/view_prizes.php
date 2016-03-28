<style>
#awards_list
{
	list-style:none;
	padding:0;
	margin:0 65px;
}
#awards_list li
{
	width:400px;
	height:165px;
	margin:10px;
	position:relative;
	
}
#awards_list li .background_container
{
	width:100%;
	height:165px;
	position:absolute;
	top:0px;
	left:0px;
	z-index:9;

}
#awards_list li .text
{
	width: 210px;
	height: auto;
	position: absolute;
	top: 0px;
	left: 30px;
	z-index: 99;
	white-space: normal;
	margin: 49px 0px;
	text-align: center;
	
}
#awards_list li .text .price_number
{
	color:#b72936;
}
</style>
<div class="clear"></div>
<div class="various_title_videos <?php echo $current_section_background_color; ?>" style="height:40px; position:relative;width: 1023px;left: -11px;">
	<div class="sections_wrapper_margin">
		<div class="title float_left" style="color: white;font-size: 24px;"><?php echo lang('mycorner_mypoints_win'); ?></div>
    </div>
    <img width="26" style="position:absolute; left:0; top:40px;" src="<?php echo base_url(); ?>images/mycorner/my_corner_left_shadow.png"/>
    <img width="26" style="position:absolute; right:0; top:40px;" src="<?php echo base_url(); ?>images/mycorner/my_corner_right_shadow.png"/>
</div>
<script>
$(document).ready(function(e) {
    
	$('.pics').cycle();
});
</script>
<div class="clear"></div>
<div class="points_offers" style="height: 555px;padding-top: 10px;margin-top: -7px;padding-bottom:10px;">
    <ul id="awards_list">
    
    <?php 
    for($i=0; $i < sizeof($display_awards); $i++):
	$get_packages = $this->membersmodel->get_awards_packages($display_awards[$i]['awards_ID']);
    $image = base_url()."uploads/awards/".$display_awards[$i]['images_src'];
	
    echo '<li class="float_left">
            <div class="background_container"><img src="'.$image.'" /></div>
			<div class="text">';
			echo '<div id="zoom" class="pics">';
			for($j=0;$j<sizeof($get_packages);$j++):
			
			$text =  $get_packages[$j]['awards_package_title'.$current_language_db_prefix];
			$text = $get_packages[$j]['awards_package_amount'] == 0 ? $text : $text."<br /><span class='price_number'>" .$get_packages[0]['awards_package_amount']."</span>";
			echo "<div>{$text}</div>";
			endfor;
			echo '</div>';
	   echo'</div>
         </li>';
    endfor;
    ?>
    </ul>
</div>
<div class="clear"></div>