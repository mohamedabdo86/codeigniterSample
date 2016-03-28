<link rel="stylesheet"  type="text/css" href="<?php echo base_url_mobile('css/view_my_points.css'); ?>"/>
	<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-12 col-sm-12 point">
				<h1 class="point_text float_left"><?php echo lang('prices_text'); ?></h1>
				</div>
			</div>
		<?php
			if($display_points)
			{
				$counter_index = 0;
				$class= "offer_point_left";
				$point = "point_number_left";
				$point_number = "point_number_to_left";
				$point_text = "point_text_left";
				for($i=0;$i<sizeof($display_points);$i++):
				$interaction_title = $display_points[$i]['interaction_title'.$current_language_db_prefix];
				$interaction_points = $display_points[$i]['interaction_points'];
				$gradient_color_background = $display_points[$i]['interaction_gradient_class'];
				$point_color_background = $display_points[$i]['interaction_bg_class'];
				if($counter_index == 0)
				{
					echo '<div class="row">';	
				}
				if($counter_index == 1)
				{
					$class = "offer_point_right";
					$point = "point_number_right";
					$point_number = "point_number_to_right";
					$point_text = "point_text_right";
				}
		?>
		<div class="col-md-5 col-sm-5 col-xs-12">
			<div class="<?php echo $class ?> <?php echo $gradient_color_background ?>">
				<p align="center" class="offer_text"><?php echo $interaction_title; ?></p>
					<div align="bottom" class="<?php echo $point; ?> <?php echo $display_points[$i]['interaction_bg_class']; ?>"><p class="<?php echo $point_number; ?>"><?php echo $interaction_points; ?></p><p class="<?php echo $point_text; ?>"><?php echo lang('mycorner_mypoints_point'); ?></p></div>
			</div>
		</div>
		<div class="col-md-2 col-sm-2"></div>
		<?php
			$counter_index ++;
			if($counter_index == 2)
			{
				echo '</div>';
				$counter_index = 0;
				$class = "offer_point_left";
				$point = "point_number_left";
				$point_number = "point_number_to_left";
				$point_text = "point_text_left";
			}
				endfor;
			}
		?>
			<div class="row">
				<div class="col-xs-12 col-md-12 col-sm-12 point">
				<h1 class="point_text1 float_left"><?php echo lang('account_points');?></h1>
				</div>
			</div>
                        <?php 
			for($i=0; $i < sizeof($display_awards); $i++)
			{	
				$get_packages = $this->membersmodel->get_awards_packages($display_awards[$i]['awards_ID']);
				$image = base_url()."uploads/awards/".$display_awards[$i]['images_src'];
				if($i%2==0)
				{
					echo '<div class="row"> <div class="col-sm-5 col-xs-12 col-md-5">';
					echo '<div class="img_points"><img src="'.$image.'" class="img-responsive" />' ; 
					echo '<div class="col-xs-7 col-xs-push-1.5 col-md-3 col-sm-3 col-sm-push-1"><div class="img_text">';
					for($j=0;$j<sizeof($get_packages);$j++)
					{
						$text =  $get_packages[$j]['awards_package_title'.$current_language_db_prefix];
						$text = $get_packages[$j]['awards_package_amount'] == 0 ? $text : $text."<br />
							<span class='price_number'>" .$get_packages[0]['awards_package_amount']."</span>";
					echo "<div>{$text}</div>";
					echo "</div></div></div></div>";
					echo'<div class="col-sm-2 col-md-2"></div>';
					}
				}
				if($i%2==1)
				{	
					echo '<div class="col-sm-5 col-xs-12 col-md-5">';
					echo '<div class="img_points"><img src="'.$image.'" class="img-responsive" />' ;
					echo '<div class="col-xs-7 col-xs-push-1.5 col-md-3 col-sm-3 col-sm-push-1"><div class="img_text">';
					for($j=0;$j<sizeof($get_packages);$j++)
					{
						$text =  $get_packages[$j]['awards_package_title'.$current_language_db_prefix];
						$text = $get_packages[$j]['awards_package_amount'] == 0 ? $text : $text."<br />
							<span class='price_number'>" .$get_packages[0]['awards_package_amount']."</span>";
					echo "<div>{$text}</div>";
					echo "</div></div></div></div>";
					echo "</div>";
					}
				}
            }        ?>
  
</div>