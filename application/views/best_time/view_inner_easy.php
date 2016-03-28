<div class="clear"></div>
<?php echo $this->load->view('template/submenu_writer');   ?>
<?php echo $this->load->view('template/tree_menu_writer');   ?>
<script>
	jQuery(function(){
		
		jQuery(".steps_wrapper_list").jCarouselLite({
			btnNext: ".steps_wrapper_list_prev",
			btnPrev: ".steps_wrapper_list_next",
			visible:4,
			circular:false
		});

	});
</script>
<script>
	jQuery(function(){
		
		jQuery(".recent_items_list").jCarouselLite({
			btnNext: ".recentitem_prev",
			btnPrev: ".recentitem_next",
			visible:4
		});

	});
</script>
<script>
$(document).ready(function(e) {
    
	$(".load_new_step").click(function(e) {
        
		var id = $(this).data("id");
		var index = $(this).data("index");
		
		$.ajax({
			  url: "<?php echo  site_url("ajax/retrieve_new_easy_tip_step") ?>",
			  type: "POST",
			  data: {id : id,index:index},
			  cache: false,
			  dataType: "json",
			  success: function(success_array)
			  {
				//alert("test suvv"+success_array);
				$("#manage_image_ajax").attr("src",success_array.image);
				$("#manage_title_ajax").html(success_array.title);
				$("#manage_desc_ajax").html(success_array.desc);
				$("#manage_index_ajax").html(success_array.index);
				 //$('#newsletter form["name=submit_form"] input').val(success_array.text);
				 //$('#newsletter_status').attr("src",global_js_abs_path+'images/'+success_array.image);
				
			  },
			  error: function(xhr, ajaxOptions, thrownError)
			  {
				//alert("test"+thrownError);
				 
				 
				
			  }
			  
		}); 
		 
    });
	
});
</script>
<style>
.dashed_background_wrapper
{
	margin:0px 30px;
	background:repeat url("<?php echo base_url(); ?>images/besttime/stripe_3beb92b264890423f37c98c6a6f416c1.png") ;
	height:auto;	
}
.dashed_background_wrapper .image
{
	width:525px;
	height:430px;
	position:relative;
}
.dashed_background_wrapper .image img
{
	width:525px;
	height:430px;
}
.dashed_background_wrapper .image .desc
{
	width:100%;
	height:auto;
	min-height:35px;
	position:absolute;
	bottom:0px;
	left:0px;
	background:rgba(255,255,255,0.88);
}
.dashed_background_wrapper .image .desc h3
{
	padding:10px 0px;
	margin:0px 10px;
}
.dashed_background_wrapper .title_wrapper
{
	width:415px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	
}
.dashed_background_wrapper .title_wrapper .title_white_background
{
	margin:40px 10px 7px;
	background:rgba(255,255,255,1);
	padding:20px;
	padding-top:0px;
	
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	position:relative;
}
.dashed_background_wrapper .title_wrapper .title_white_background .circle_wrapper
{
	width:60px;
	height:60px;
	background:#FFF;
	-moz-box-shadow: 0px 1px 8px #1c181c;
-webkit-box-shadow: 0px 1px 8px #1c181c;
box-shadow: 0px 1px 8px #1c181c;

-webkit-border-radius: 60px;
	-moz-border-radius: 60px;
	border-radius: 60px;
	
	position:relative;
	top:-22px;
}
.dashed_background_wrapper .title_wrapper .title_white_background .circle_wrapper p
{
	text-align:center;
	line-height:60px;
	font-family:Arial, Helvetica, sans-serif;	
	font-size:24px;
}
.dashed_background_wrapper .title_wrapper .title_white_background p,.dashed_background_wrapper .title_wrapper .title_white_background h2
{
	white-space:normal;
}

.steps_images_wrapper
{
	height:170px;
	margin:10px 30px;
}

.steps_wrapper_list ul
{
	padding:0;
	margin:0;
	list-style:none;

}
.steps_wrapper_list ul li
{
	width:208px;
	height:170px;
	margin: 0px 6px;
	position:relative;
}
.steps_wrapper_list ul li .step_number_wrapper
{
	position: absolute;
	width: 90%;
	height: 35px;
	top: 15px;
	left: 0px;
	padding: 0 5%;
	font-size:24px;
	color:#FFF;
	font-family:Arial, Helvetica, sans-serif;	
}
.steps_wrapper_list_prev,.steps_wrapper_list_next
{
	margin-top: 74px;
}

</style>


<div class="clear"></div>

<div class="inner_title_wrapper">

<div class="sections_wrapper_margin">
<h1 class="<?php echo $current_section_color; ?>"><?php echo $subsection_title; ?></h1>
</div>

<?php
$title = $display[0]['easy_ideas_title'.$current_language_db_prefix];

//Step 1
$step_title = $display_steps[0]['easy_ideas_steps_title'.$current_language_db_prefix];
$step_image = base_url()."uploads/easy/".$display_steps[0]['images_src'];
$step_desc  = $display_steps[0]['easy_ideas_steps_desc'.$current_language_db_prefix];
?>

</div><!-- End of inner_title_wrapper -->
<div class="thick_line <?php echo $current_section_background_color; ?>"></div>
<div class="global_background" style=" width:100%;">
<div style="width:100%; height:25px"></div>
    <div class="dashed_background_wrapper">
    	<div class="image float_left"><img id="manage_image_ajax" src="<?php echo $step_image; ?>" alt="<?php echo $title?>" /><div class="desc"><h3><?php echo $title; ?></h3></div></div>
    	<div class="title_wrapper float_right">
        	<div class="title_white_background">
            <div class="circle_wrapper float_left"><p id="manage_index_ajax" class="<?php echo $current_section_color; ?>">1</p></div>
            <div class="clear"></div>
            <h2 id="manage_title_ajax"><?php echo $step_title; ?></h2>
            <div id="manage_desc_ajax">
            <?php echo $step_desc; ?>
            </div>
            </div>
        
        </div><!-- End of title_wrapper -->
    	<div class="clear"></div>
    </div><!-- ENd of dashed_background_wrapper -->
    
    <div class="steps_images_wrapper">
    
        <a class="steps_wrapper_list_prev " style="cursor:pointer; float:right"><img src="<?php echo base_url()?>images/icons/right_arrow_besttime.png" <?php if (sizeof($display_steps)<=3){?> style="display:none;"<?php }?>/></a>
        <a class="steps_wrapper_list_next " style="cursor:pointer; float:left;"><img src="<?php echo base_url()?>images/icons/left_arrow_besttime.png" <?php if (sizeof($display_steps)<=3){?> style="display:none;"<?php }?>/></a>
        <div class="steps_wrapper_list">
        <ul>
     	<?php
		for($i=0 ; $i < sizeof($display_steps) ; $i++):
		$id = $display_steps[$i]['easy_ideas_steps_ID'];
		$image = base_url()."uploads/easy/thumb_".$display_steps[$i]['images_src'];
		?>
        	<li>
            <div class="step_number_wrapper"><?php echo ($i+1); ?></div>
            <a class="load_new_step" href="#<?php echo ($id); ?>" data-index="<?php echo ($i+1); ?>"  data-id="<?php echo $id; ?>"><img src="<?php echo $image; ?>" /></a>
            </li>
        <?php
		
		endfor;
		?>
        </ul>
        </div><!-- recent_items_list -->	
    
    </div><!-- ENd of steps_images_wrapper -->
    

<div class="<?php echo $current_section_background_color ?>" style="height:40px; background:#e82327; position:relative;width: 105%;margin-left: -25px;margin-top: 15px; display:none">
	<div class="sections_wrapper_margin">
		<div class="float_left" style="font-size:24px;color:white;">أفكار سهلة اخري</div>
    </div>
    <img width="26" style="position:absolute; left:0; top:40px;" src="<?php echo base_url(); ?>images/left_shadow_besttime.png"/>
    <img width="26" style="position:absolute; right:0; top:40px;" src="<?php echo base_url(); ?>images/right_shadow_best_time.png"/>
</div>

<div class="recent_items_list_wrapper " style="height:270px; display:none">

    <div class="sections_wrapper_margin" style="padding-top: 10px;" >
    
        <a class="recentitem_prev float_right" style="cursor:pointer"><img src="<?php echo base_url()?>images/icons/right_arrow_besttime.png" /></a>
        <a class="recentitem_next float_left" style="cursor:pointer"><img src="<?php echo base_url()?>images/icons/left_arrow_besttime.png" /></a>
        <div class="recent_items_list">
        <ul>
			<?php for($i=0;$i<6;$i++):
				$title=" ضعى كحل عند بداية الرموش عشان تخلى شكلها كثيف اكتر";
			?>
        	<li style="height:270px;">
            
           
            
            <div class="image global_sperator_margin_bottom"><img src="http://cdn.pimg.co/p/218x168/858652/fff/img.png" alt=""  ></div>
            <div class="title float_left dark_gray" style="height:auto;"><div style="margin:0px 5px;"><a href="<?php // echo $url ?>"><?php echo $title;?><h4 class="best_cook_color global_sperator_margin_top"><?php //echo $member_name ?></h4></a></div></div>
			<div class="clear"></div>
			</li>
        <?php
		endfor;
		?>
            
            
        </ul>

    
    </div><!--- End of recent_items_list -->


</div><!-- End of sections_wrapper_margin -->


</div>

<div style="width:100%; height:25px"></div>
</div><!-- ENd of global_background -->

<div class="clear"></div>

