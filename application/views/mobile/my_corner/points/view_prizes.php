<style>
#awards_list
{
	list-style:none;
	padding:0;
	margin:0 65px;
}
#prize-box
{
	width:400px;
	height:165px;
	margin:10px;
	position:relative;
	
}
.bootstrap-col .background_container
{
	width:100%;
	height:165px;
	position:absolute;
	top:0px;
	left:0px;
	z-index:9;

}
.bootstrap-col .text
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
.bootstrap-col .text .price_number
{
	color:#b72936;
}

@media screen and (max-width: 768px)
{
	
	.mobile_offer_point_right
	{
		display: inline-block;
		float: none;
		margin: 15px 0px;
	}
	
	.mobile_offer_point_left
	{
		display: inline-block;
		float: none;
		margin: 15px 0px;
	}
}

</style>
<?php  /*
<div class="clear"></div>
<div class="various_title_videos <?php echo $current_section_background_color; ?>" style="height:40px; position:relative;width: 1023px;left: -11px;">
	<div class="sections_wrapper_margin">
		<div class="title float_left" style="color: white;font-size: 24px;"><?php echo lang('mycorner_mypoints_win'); ?></div>
    </div>
    <img width="26" style="position:absolute; left:0; top:40px;" src="<?php echo base_url(); ?>images/mycorner/my_corner_left_shadow.png"/>
    <img width="26" style="position:absolute; right:0; top:40px;" src="<?php echo base_url(); ?>images/mycorner/my_corner_right_shadow.png"/>
</div>
*/ ?>
<script>
$(document).ready(function(e) {
    
	$('.pics').cycle();
});
</script>

<hr style="border: 6px solid #2fa8c7;">

<h2><?php echo lang('mycorner_mypoints_win'); ?></h2>

<div class="points_offers" style="height: 555px;padding-top: 10px;margin-top: -7px;padding-bottom:10px;">
<div class="container" style="background-color: #fff; background-image: none;">

    <?php
    
    for($i=0; $i < sizeof($display_awards); $i++):
	
    $get_packages = $this->membersmodel->get_awards_packages($display_awards[$i]['awards_ID']);
    $image = base_url()."uploads/awards/".$display_awards[$i]['images_src'];
	
    if($i%2 == 0) echo '<div class="row">';
    
    echo '<div class="col-xs-12 col-sm-6 bootstrap-col">
			<div class="prize-box">
            	<div class="background_container"><img src="'.$image.'" /></div>
					<div class="text">';
						echo '<div id="zoom" class="pics">';
			
			for($j=0;$j<sizeof($get_packages);$j++)
			{
				$text =  $get_packages[$j]['awards_package_title'.$current_language_db_prefix];
				$text = $get_packages[$j]['awards_package_amount'] == 0 ? $text : $text."<br /><span class='price_number'>" .$get_packages[0]['awards_package_amount']."</span>";
				echo "<div>{$text}</div>";
			}
			
						echo '</div>
					</div>
				</div>
			</div>';
	   
	   if($i%2 != 0) echo '</div>';
	   
    endfor;
    ?>
</div>
</div>
