
<style>

.container_background
{
		background-color: #fff;
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
}
.innertitle
{
	font-size:20pt;
	font-weight:bold;
}

.terms_conditions_color
{
	  color: #13758e !important;
}
.thick_line
{
	height:4px;
	width:100%;
	background: #13758e;
}
.inner_body
{
	box-shadow:1px 1px 6px #807976;
	border-radius:5px;
	margin-top:20px;
}
.cont
{
	padding:10px;
}

p
{
	white-space:normal;
	font-size: 15px;
}

.pricavy_desc
{
	white-space:normal;
	padding:10px;
	background-color:#f8f8f8;
	margin-bottom: 10px;
}
.oblong_with_triangle a
{
	font-size:20px;
	font-weight:bold;
	
}
h3
{
	color:#0d587a;
	font-weight:bold;
	line-height:30px;
}

.question
{
	line-height: 30px;
}

</style>
<div class="container_background">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="white_background_color top_radius_5 height_40">
				<div class="sections_wrapper_margin global_sperator_margin_top ">
					<h1 class="terms_conditions_color innertitle">
					<?php
						foreach($privacy_policy_desc as $policy)
						{
							echo $policy['static_name'.$current_language_db_prefix];
						}
					?>
					</h1>
				</div> 
			</div>
		</div>
	</div>
	<div class="thick_line terms_conditions_background_color"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="white_background_color" style="height:auto;border:1px solid #FFF;">	
				<div class="inner_body" >
					<div class="cont" id="boxscroll"> 
						<div class="pricavy_desc">
						<?php
							foreach($privacy_policy_desc as $policy)
							{
								echo $policy['static_text'.$current_language_db_prefix];
							}
						?>
						</div>
					
                    <div classs="col-md-12 col-xs-12 col-sm-12">
                    <div class="oblong_with_triangle">
						<div class="oblong_background" style="padding:5px;"><a class="oblong" ><?php echo lang('globals_privacy_policy_question'); ?> <div class="triangle_shape"></div></a></div>        
					</div></div>
					<div class="pricavy_question question">
					<?php
					for($i=0; $i<sizeof($privacy_policy); $i++ ):
						echo '<h3><a class="privacy_top_question" href="#'.($i+1).'" style="font-size:14px;">';
						echo $i+1 ." - ".$privacy_policy[$i]['privacy_policy_question'.$current_language_db_prefix] ;
						echo '</a></h3>';
					endfor;
					?>
					</div>
					<div class="pricavy_question_answer">
					<?php
					for($i=0; $i<sizeof($privacy_policy); $i++ ):
						echo '<h3 name="'.($i+1).'" id="'.($i+1).'" >';
						echo $i+1 ." - ".$privacy_policy[$i]['privacy_policy_question'.$current_language_db_prefix] ;
						echo '</h3>';
						echo '<p>'.$privacy_policy[$i]['privacy_policy_answer'.$current_language_db_prefix].'</p>' ;	
					endfor;
					?> 
					</div>
					</div><!-- End OF .boxscroll-->
				</div><!--End OF .inner_body-->
			</div>
		</div>
	</div>
</div>
