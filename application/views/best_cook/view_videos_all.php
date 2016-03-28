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
		social_tools : false,
		deeplinking:false,
		theme:"facebook",
		show_title:false,
		default_width: 700,
		default_height: 420,
	});
});
</script>

<div class="clear"></div>

<?php echo $this->load->view('template/submenu_writer');   ?>

<?php echo $this->load->view('template/tree_menu_writer');   ?>

<div class="clear"></div>

<div class="inner_title_wrapper">
	<div class="sections_wrapper_margin">
    <h1 class="<?php echo $current_section_color; ?> float_left" style="font-size:25px;"><?php echo lang('bestcook_videos_recipes');?></h1>
     <?php
	//if($parent_id_of_current_sub_section != $current_section_id){
	?>
    	<ul class="articles_filter float_right <?php echo $current_section_border_color ;?>" style="display:none">

            <li><a class="<?php echo $current_section_color; ?>"  href="<?php //echo $url ?>"><?php echo lang('bestcook_head_of_dishes');?></a></li>
            <li><a href="<?php //echo $url ?>"><?php echo lang('bestcook_side_dishes'); ?></a></li>
            <li><a href="<?php //echo $url ?>"><?php echo lang('bestcook_Confetti');?></a></li>
        <?php
		//endfor;
		?>
        </ul>
    <?php
	//}
	?>
    <div class="clear"></div>
    </div>
</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>"></div>

<div class="container_pagination_wrapper_6_items global_background" style="padding-bottom: 10px;" >

<ul class="lists_of_videos">

<?php

$table_name_for_rate = "videos";

for($i=0 ; $i < sizeof($display_data) ; $i ++):

$id = $display_data[$i]['videos_ID'];
$title = $display_data[$i]['videos_name'];
$url =  $display_data[$i]['videos_url'];
$image = $this->common->youtube($url);
$short_title = $this->common->limit_text($title,40);
   

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
		if($this->members->members_id)
		{
			$params = array('table'=>'videos','type'=>'videos','foreign_id'=>$id,'member_id'=>$this->members->members_id);
			echo $this->rate->get_video_rate($params);
		}
	?>
    </div><!--End Of Rating-->

    <div class="clear"></div>
</div><!--End Of .social_wrapper_contanier-->


<div class="clear"></div>
<a href="<?php echo $url;?>">
<div class="desc"><div style="padding:5px 10px; white-space:normal;"><h3 title="<?php echo $title;?>" class="dark_gray"><?php echo $short_title; ?></h3></div></div>
</a>
</li>

<?php
endfor;
?>

</ul>

<div class="clear"></div>

<div class="page_navigation" align="center">
<?php echo  $pagination_links; ?>
</div>

</div><!-- End of container_pagination_wrapper -->

<div class="clear"></div>