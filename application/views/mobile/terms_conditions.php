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
.p_details
{
	white-space:normal;
	color:#000;
	font-size:15px;	
	margin-bottom:10px;
}
.inner_ribbon
{
	margin-bottom:10px;
}
.oblong_with_triangle
{
	height:60px;
}
.oblong_with_triangle a
{
	font-size:20px;
	font-weight:bold;
	padding:5px;
}

.ribbon
{
	width: 206px;
	border-top: 29px solid #CCC;
	border-bottom: 29px solid #CCC;
	border-left: 30px solid transparent;
	position:relative;
	top: 21px;
	left: 666px;
}		
.ribbon_second
{
	width: 323px;
	border-top: 29px solid #CCC;
	border-bottom: 29px solid #CCC;
	border-left: 30px solid transparent;
	position:relative;
	top: 21px;
	left: 550px;
}
.inner_word
{
	position:relative;
	top:-27px;
	font-size:17px;
}
.ribbon_third
{
	width: 85px;
	border-top: 29px solid #CCC;
	border-bottom: 29px solid #CCC;
	border-left: 30px solid transparent;
	position:relative;
	top: 21px;
	left: 790px;
}
.robbin1
{
	width: 9px;
	border-top: 29px solid #CCC;
	border-bottom: 31px solid #CCC;
	border-left: 30px solid transparent;
}	
.robbin_container
{
	width:auto;
	background-color:#CCCCCC;
}		
.inner_table
{
	font-size:13px;
	white-space:normal;
	
}
.table_dir , .table_dir td , .table_dir tr , .table_dir th
{
	 border-style: hidden;
}
</style>
<script type="text/javascript">
$(document).ready(function(e) {
   // $("#boxscroll").niceScroll({cursorborder:"",cursorcolor:"#7e7979",boxzoom:false}); 
});
</script>
<div class="container_background">
	<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="white_background_color top_radius_5 height_40">
			<div class="sections_wrapper_margin global_sperator_margin_top ">
				<h1 class="terms_conditions_color innertitle"> 
					<?php 
						foreach($terms_conditions_desc as $title)
						{ 
							echo $title['static_name'.$current_language_db_prefix];
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
			<div class="inner_body">
				<div class="cont" id="boxscroll"> 
					<?php
						foreach($terms_conditions_desc as $terms_text_ar)
						{
							echo $terms_text_ar['static_text'.$current_language_db_prefix];
						}
					?>  
   				</div> <!--End of container -->
			</div> <!--End of inner body -->
		</div>  <!--End of white background  -->
	</div>
	</div>
</div>
 





 





