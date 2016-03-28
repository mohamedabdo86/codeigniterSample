<div class="clear"></div>
<?php $this->load->view('template/submenu_writer');   ?>
<?php echo $this->load->view('template/tree_menu_writer');   ?>
<style>
.center{margin-left:20px;}
.rightword{color:#E82327;font-size:15pt;}
.leftword{color:#828282;font-size:10pt;}
.imgs{list-style:none;margin-right:20px;}
.imgs li{float:right;margin:34px; height:381px;position:relative; border-width:1px; border-style:solid;}
.circle 
{
	position: absolute;
	right: 144px;
	bottom: 0px;
	width: 29%;
	height: 19%;
	border-radius: 295% / 572%;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
	border: #FFF 3px dashed;
	border-bottom: none;
}
.cook_tool 
{
	margin: 16px 35px;
	width: 55px;
	height: 55px;
}
			
.par_words
{ 
	color:#FFF;font-family:[GESSTwoLight];
	font-size:10pt;
	text-align:center;
	margin:0px;
	white-space:normal;
}

</style>

<div class="clear"></div>

<div class="inner_title_wrapper">

<div class="sections_wrapper_padding white_background_color" >
    <h1 class="<?php echo $current_section_color ?>">
    	<?php echo $this->headers->get_third_title(); ?>
        <span class="rightword"></span> 
    </h1>
</div>

</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>" style="margin-top:0px; margin-bottom:0px;"></div>

<div class="global_background">
	<div class="center">
		<ul class="imgs">	
    	<?php
			for($i=0;$i<sizeof($display_data);$i++){ 
			$id = $display_data[$i]['applications_ID'];
			$title = $display_data[$i]['applications_title'.$current_language_db_prefix];
			$image = base_url()."uploads/applications/".$display_data[$i]['images_src'];
			
			$logo =  base_url()."uploads/applications/".$this->globalmodel->get_image_src($display_data[$i]['applications_logo']);
			$url =site_url($this->router->class."/".$this->router->method."/".generateSeotitle($id,$title));

		 ?>
			<li class="<?php echo $current_section_border_color ?>">
            	<a href="<?php echo $url ?>" title="<?php  echo $title;?>">
     			<img src="<?php echo $image; ?>" border="0" alt="<?php  echo $title;?>" />
           		<div class="circle <?php echo $current_section_background_color ?>"> 
          			<div class="cook_tool" style="background:url('<?php echo $logo; ?>') 0 0;"></div>
           
          	 	</div><!-- End of circle -->
                </a>             
    		</li>
    <?php } ?>
   		
		</ul>
        <div class="clear"></div>
	</div><!-- End of center -->

</div><!-- End of global_background -->

