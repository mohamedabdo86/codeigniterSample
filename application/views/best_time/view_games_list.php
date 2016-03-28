


<div class="clear"></div>
<?php echo $this->load->view('template/submenu_writer');   ?>
<?php echo $this->load->view('template/tree_menu_writer');   ?>

<style>
#games_list
{
	margin: <?php
	if(sizeof($display_data) == 2){
		echo "0px 190px;";
	}else{
		echo "0px 35px 15px;";
	}
	?>
	list-style:none;
	padding:0;
	padding-bottom:10px;
}
#games_list li
{
	width:300px;
	height:460px;
	margin:10px 5px;
}
#games_list li .image
{
	width:100%;
	height:460px;
	-webkit-border-top-left-radius: 15px;
	-webkit-border-top-right-radius: 15px;
	-moz-border-radius-topleft: 15px;
	-moz-border-radius-topright: 15px;
	border-top-left-radius: 15px;
	border-top-right-radius: 15px;
	
}
#games_list li .image img
{
	width:100%;
	height:460px;
	-webkit-border-top-left-radius: 15px;
	-webkit-border-top-right-radius: 15px;
	-moz-border-radius-topleft: 15px;
	-moz-border-radius-topright: 15px;
	border-top-left-radius: 15px;
	border-top-right-radius: 15px;
	
}
#games_list li .title_wrapper
{
	margin-top:5px;
	width:100%;
	height:55px;
	-webkit-border-bottom-right-radius: 15px;
	-webkit-border-bottom-left-radius: 15px;
	-moz-border-radius-bottomright: 15px;
	-moz-border-radius-bottomleft: 15px;
	border-bottom-right-radius: 15px;
	border-bottom-left-radius: 15px;
	
}
#games_list li .title_wrapper h2
{
	margin:7px; 
	text-align:center;
	line-height:55px;
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

<div class="global_background" style="width:100%; height:540px;">

<ul id="games_list">

<?php
for($i= 0 ; $i < sizeof($display_data); $i++):
$id = $display_data[$i]['games_ID'];
$title = $display_data[$i]['games_name'.$current_language_db_prefix];
$image = base_url()."uploads/games/".$display_data[$i]['images_src'];
//$url = site_url($this->router->class."/games/".$id);
$url =site_url($this->router->class."/games/".generateSeotitle($id,$title));

?>
<li class="float_left">
<a href="<?php echo $url ?>" title="<?php echo $title; ?>" >
<div class="image"><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" /></div>
<div class="title_wrapper <?php echo $current_section_background_color; ?>">
<h2 class="white_color"><?php echo $title; ?></h2>
</div>
</a>
</li>
<?php
endfor;
?>


<div class="clear"></div>
</ul>

<div class="clear"></div>

</div><!-- End of global_background -->

<div class="clear"></div>