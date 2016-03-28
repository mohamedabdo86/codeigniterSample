<style>
.lists_of_videos { margin:0 26px; }
.lists_of_videos li { height:255px; padding:15px; margin:0; }
.lists_of_videos li .image { position: relative; }
.lists_of_videos li .image .play { position: absolute; width: 90px; height: 90px; top: 50%; left: 50%; margin-top: -45px; margin-left: -45px; }

</style>
<!-- Prettyphoto -->
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
	$("a[rel^='prettyPhoto']").prettyPhoto(
	{
		social_tools : false,deeplinking:false, theme:"facebook",show_title:false
	});
});
</script>

<div class="clear"></div>

<?php echo $this->load->view('template/submenu_writer');   ?>

<?php echo $this->load->view('template/tree_menu_writer');   ?>

<div class="clear"></div>

<div class="inner_title_wrapper">
	<div class="sections_wrapper_margin">
    <h1 class="best_time_color float_left" style="font-size:25px;"> إعلانات نستله</h1>
    
    <div class="clear"></div>
    </div>
</div><!-- End of inner_title_wrapper -->

<div class="thick_line best_time_background_color"></div>

<div class="container_pagination_wrapper_6_items global_background" >

<ul class="lists_of_videos">

<?php

$table_name_for_rate = "recipes_videos";


for($i=0 ; $i < 12 ; $i ++):

$id = "1";
$title = "كرواسون بسيط بدون تعقيد";
$url = "http://www.youtube.com/watch?v=3cccPTpdpW0";

parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
$image = $my_array_of_vars['v'];   
   
/*
for($i=0 ; $i < sizeof($display_data) ; $i ++):
$id =$display_data[$i]['recipes_videos_ID'];
$title = $display_data[$i]['recipes_videos_url'];
//$image = base_url()."images/recipes_165.png";
//$image  = $image_url.$display_data[$i]['images_src'];

$url = site_url($this->router->class."/".$inner_recipe_method."/".generateSeotitle($id ,$title ));
*/

?>


<li class="float_left various_videos">
<a href="<?php echo $url;?>" rel="prettyPhoto" title="<?php echo $title;?>">         

<div class="image">
<img class="play" src="<?php echo base_url(); ?>images/videos_play.png" />
<img src="http://img.youtube.com/vi/<?php echo $image;?>/0.jpg" alt="" />
</div>
</a>

<div class="rating_wrapper_container">

   <div class="rating float_right" style="width: 90px; margin:5px 0">
	<?php
        $params = array('table'=>$table_name_for_rate,'foreign_id'=>$id);
        echo $this->rate->get_recipe_rate($params); 
    ?>
    </div><!--End Of Rating-->

    <div class="clear"></div>
</div><!--End Of .social_wrapper_contanier-->


<div class="clear"></div>
<a href="">
<div class="desc"><div style="padding:5px 10px; white-space:normal;"><h3 class="dark_gray"><?php echo $title; ?></h3></div></div>
</a>
</li>

<?php
endfor;
?>

</ul>

<div class="clear"></div>

<div class="page_navigation" align="center">
<?php /*echo  $pagination_links;*/ ?>
</div>

</div><!-- End of container_pagination_wrapper -->

<div class="clear"></div>