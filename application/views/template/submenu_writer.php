<script>
    $(document).ready(function() {
	
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
		
      $("#owl-demo").owlCarousel({
        navigation : false,
		pagination:false,
		mouseDrag:false,
		afterInit:function(){
			//var checksss = $(".owl-wrapper .owl-item:nth-child(2)").html();
			//var checksss = $(".owl-wrapper").children(".owl-item").length;
			var items_count = this.owl.owlItems.length;
			
			if(items_count <= 6)
			{
				$(".inner_submenu_list_prev").hide();
				$(".inner_submenu_list_next").hide();
			}
			else
			{
				if(this.currentItem == 0)
				{
					$(".inner_submenu_list_prev").hide();
				}
				else
				{
					$(".inner_submenu_list_prev").show();
				}
			
				if(this.currentItem == this.maximumItem)
				{
					$(".inner_submenu_list_next").hide();
				}
				else
				{
					$(".inner_submenu_list_next").show();
				}
			}
			//alert(checksss);
		},
		afterMove : function(){
			if(this.currentItem == 0)
			{
				$(".inner_submenu_list_prev").hide();
			}
			else
			{
				$(".inner_submenu_list_prev").show();
			}
			
			if(this.currentItem == this.maximumItem)
			{
				$(".inner_submenu_list_next").hide();
			}
			else
			{
				$(".inner_submenu_list_next").show();
			}
		}
      });
	  
	    $("#owl-demo_lvl2").owlCarousel({
        navigation : false,
		pagination:false,
		mouseDrag:false,
		afterInit:function(){
			alert('yo');
			//var checksss = $(".owl-wrapper .owl-item:nth-child(2)").html();
			//var checksss = $(".owl-wrapper").children(".owl-item").length;
			var items_count = this.owl.owlItems.length;
			
			if(items_count <= 6)
			{
				$(".inner_submenu_list_prev").hide();
				$(".inner_submenu_list_next").hide();
			}
			else
			{
				if(this.currentItem == 0)
				{
					$(".inner_submenu_list_prev").hide();
				}
				else
				{
					$(".inner_submenu_list_prev").show();
				}
			
				if(this.currentItem == this.maximumItem)
				{
					$(".inner_submenu_list_next").hide();
				}
				else
				{
					$(".inner_submenu_list_next").show();
				}
			}
			//alert(checksss);
		},
		afterMove : function(){
			if(this.currentItem == 0)
			{
				$(".inner_submenu_list_prev").hide();
			}
			else
			{
				$(".inner_submenu_list_prev").show();
			}
			
			if(this.currentItem == this.maximumItem)
			{
				$(".inner_submenu_list_next").hide();
			}
			else
			{
				$(".inner_submenu_list_next").show();
			}
		}
      });
	  
	  var owl = $(".owl-carousel").data('owlCarousel');
	//  var owl_2 = $(".owl-carousel_2").data('owlCarousel');
	
	 
	  
	  $(".inner_submenu_list_next").click(function(e) {
        owl.next();
   	  });
	   $(".inner_submenu_list_prev").click(function(e) {
        owl.prev();
   	  });
	  
	  
	   /* $(".inner_submenu_list_lvl2_next").click(function(e) {
        owl_2.next();
   	  });
	   $(".inner_submenu_list_lvl2_prev").click(function(e) {
        owl_2.prev();
   	  });
	  */
	  
    });

    </script>

<?php
		//First , Get Sections of The Current Section
	   $first_level_list = $this->sectionsmodel->get_children_sections($current_section_id);

		$get_whyjoin_slideshows = $this->globalmodel->get_whyjoin_slideshow($current_language_db_prefix);
		?>
        <?php
		for($i = 1 ;$i < sizeof($get_whyjoin_slideshows) ; $i++):
		$image = base_url()."uploads/slideshows/".$get_whyjoin_slideshows[$i]['images_src'];
			?>
            <a class="fancybox" rel="gallery1" href="<?php echo $image; ?>" ></a>
            <?php
		endfor;
?>

<script>
$(document).ready(function(e) {
	//First , Detect First level submenu click
	$(".firstlevel_click").click(function(e) {
		
		var havechild = $(this).data("havechild");
/*		var item = $(this);
		var get_link = item.attr('data-id');
		if(get_link === 191){
		alert(get_link);
		}*/
		if(!havechild)
		{
			//Find source and redirect to the page
		}
		else
		{
			$(".active_submenu").remove();
			$(".owl-item").css('background', 'rgba(145, 145, 145, 0)');
			$(".item").css('background', 'rgba(145, 145, 145, 0)');
			//$(this).parent().parent().addClass("active_submenu");
			$(this).parent().parent().append("<div class='active_submenu'></div>");
			$(this).parent().css('background', 'rgba(102, 102, 102, 0.15)');
			/*$(this).parent().parent().hover(function(){
			  $(this).css('background', 'rgba(102, 102, 102, 0.15)');
			});*/
			//Find id and search for level 2 children submenu 
			var current_menu_id = $(this).data("id");
			$(".submenu_lvl2_container").hide();
			
			//Display buttons 
			//$(".inner_submenu_list_lvl2_prev").fadeIn("fast");
			//$(".inner_submenu_list_lvl2_next").fadeIn("fast");
			$(".inner_submenu_list_lvl2_close").fadeIn("fast");
			
			
			$(".submenu_lvl2_container[data-sectionid="+current_menu_id+"]").slideDown("fast");
		}
        
		
    });
	
	
	
	
	
	
	// remove right border
	$('.owl-item:last-child').find('.item').css("border-<?php echo lang('globals_right');?>", "none");
	$('.submenu_lvl2_container').find('.item:last-child').css('border-<?php echo lang('globals_right');?>','none');
	//.find('.submenu_title').css('border-right','none');
	
	
	$(".secondlevel_click").click(function(e) {
		
		var havechild = $(this).data("havechild");
		
		if(!havechild)
		{
			//Find source and redirect to the page
		}
		else
		{
			//Find id and search for level 2 children submenu 
			var current_menu_id = $(this).data("id");
			
			
			$(".lvl3_submenu").hide();
			$(".lvl3_submenu[data-id="+current_menu_id+"]").fadeIn("fast");
			
			
			
			
		}
        
		
    });
	
	//Detect click outside the menu
	$(document).mouseup(function (e)
	{
		var container = $(".lvl3_submenu");
	
		if (!container.is(e.target) // if the target of the click isn't the container...
			&& container.has(e.target).length === 0) // ... nor a descendant of the container
		{
			container.hide();
		}
	});
	
	//CLose the button
	$(".inner_submenu_list_lvl2_close").click(function(e) {
		
		$(".active_submenu").remove();
		$(".submenu_lvl2_container").slideUp("fast");
		//$(".inner_submenu_list_lvl2_prev").fadeOut("fast");
		//$(".inner_submenu_list_lvl2_next").fadeOut("fast");
		$(".inner_submenu_list_lvl2_close").fadeOut("fast");
		
	});
	
	$('.submenu_container_wrapper .submenu_container .owl-carousel .owl-item:last-child').children(".item").css("box-shadow","none");
	
	
});
</script>
<script>
$(document).ready(function(e) {
    
	//Auto detect if a submenu is open
	var all_submenu_closed_flag = true;
	$( ".submenu_lvl2_container" ).each(function( index ) {
  		
		if ($(this).css("display") == "block" )
		{
			all_submenu_closed_flag  = false;
			//Display buttons 
			//$(".inner_submenu_list_lvl2_prev").fadeIn("fast");
			//$(".inner_submenu_list_lvl2_next").fadeIn("fast");
			$(".inner_submenu_list_lvl2_close").fadeIn("fast");
			
			var sectionid = $(this).data("sectionid");
			
			$(".firstlevel_click[data-id="+sectionid+"]").parent().parent().append("<div class='active_submenu'></div>");
			$(".firstlevel_click[data-id="+sectionid+"]").parent().parent().css('background', 'rgba(102, 102, 102, 0.15)');
		}
	});
	$('.secondlevel_click').live('click', function(){
		item = $(this);
		item.css('color', '#FFF');
	});
});
</script>
<style>

.inner_submenu_list_prev,.inner_submenu_list_next{
	display:<?php if(sizeof($first_level_list) < 6){echo "none";} ?> ;
}

.secondlevel_click:hover{}
.item:hover{background:rgba(102, 102, 102, 0.14902);}
.owl-item{width:160px auto !important;}
/*.owl-wrapper .owl-item{width:185px !important;}*/

/*.submenu_lvl2_container .owl-item{width:200px !important;letter-spacing: -0.7px;}*/
.owl-carousel .owl-item
{
	/*height:90px !important;*/
	float:<?php echo lang('globals_left');?>;
}
.submenu_lvl2_container .owl-item
{
	width:auto !important;
	min-width: 100px;
}
.submenu_lvl2_container .item
{
	padding: 0 5px;
	margin: 20px 0px 5px !important;
}
/*
.owl-wrapper-outer .owl-item{width:166px !important; } */
.submenu_container .owl-carousel .owl-item
{
	/*width:180px !important;*/
}
/*body.english .submenu_lvl2_container .owl-carousel .owl-item
{
	width:190px !important;
	font-size:11px;
}
body.arabic .submenu_lvl2_container .owl-carousel .owl-item
{
	width:166px !important;
	font-size:11px;
}*/
.submenu_container_wrapper .submenu_container
{
	box-shadow:<?php echo lang('box_shadow_submenu');?>;
}
.submenu_container_wrapper .submenu_lvl2_container
{
	box-shadow:<?php echo lang('box_shadow_submenu_level_2');?>;
}
.submenu_container_wrapper .submenu_container .item
{
	box-shadow: <?php echo lang('box_shadow_submenu_items');?>;
	padding-top:0px;
	height:90px;
}
.owl-wrapper
{
	float:<?php echo lang('globals_left');?>;
}
.owl-carousel
{
   /* direction: rtl;*/
}
.active_submenu
{
	width: 0px;
	height: 0px;
	border-style: solid;
	border-width: 0 8.5px 14px 8.5px;
	border-color: transparent transparent #adadad transparent;
	margin: 0 70px;
	margin-top: -14px;
}
.inner_submenu_list_lvl2_close{ font-family:Verdana; cursor: default;}


</style>
<div class="submenu_container_wrapper global_sperator_margin_top">

<a class="inner_submenu_list_prev"><img src="<?php echo base_url()."images/arrow_to_left_white_small.png" ?>" /></a>
<a class="inner_submenu_list_next "><img src="<?php echo base_url()."images/arrow_to_right_white_small.png" ?>" /></a>

<a class="inner_submenu_list_lvl2_prev" style="display: none;"><img src="<?php echo base_url()."images/arrow_to_left_white_small.png" ?>" /></a>
<a class="inner_submenu_list_lvl2_next" style="display: none;"><img src="<?php echo base_url()."images/arrow_to_right_white_small.png" ?>" /></a>
<a class="inner_submenu_list_lvl2_close white_color ">x</a>


	<div class="submenu_container">
 
        
        <div id="owl-demo" class="owl-carousel float_left" style="margin:0px auto;">
        
       <?php
	   
	   //Prepare lvl 2 array 
	   $second_level_list_array = array();
	   
	   
			for($i=0; $i < sizeof($first_level_list) ; $i++):
			$second_level_list_array[$first_level_list[$i]['sub_sections_ID']] = $this->sectionsmodel->have_children($first_level_list[$i]['sub_sections_ID']);
			$have_children_flag = $second_level_list_array[$first_level_list[$i]['sub_sections_ID']] == false ? false : true;
			
			$item_url = $first_level_list[$i]['sub_sections_url'] != "" ? 'href="'.site_url(''.$this->router->class.'/'.$first_level_list[$i]['sub_sections_url']).'"'  : "";
			
			//Check If URL COntain special Code such as %id%
			$item_url = str_replace("%id%",$first_level_list[$i]['sub_sections_ID'],$item_url);
			
			$current_link =  $this->uri->segment(3);
			$current_subsection_link =  $this->uri->segment(4);
			
			//Get Image 
			$image_src = $this->sectionsmodel->get_section_image($first_level_list[$i]['sub_sections_ID']) ;
			if($first_level_list[$i]['sub_sections_image'] == "0" )
			{
				$image_src = "http://cdn.pimg.co/p/70x60/858652/fff/img.png";
			}
			else
			{
				$image_src = base_url()."uploads/sections/".$image_src;
			}
			
			if($current_link == $first_level_list[$i]['sub_sections_url']){
				if($current_link != ""){
					if($first_level_list[$i]['sub_sections_ID'] == 191){
			?>
             <div class="item" style="background:rgba(102, 102, 102, 0.14902);">
             			<a <?php echo $item_url ?> class="firstlevel_click" data-id="<?php echo $first_level_list[$i]['sub_sections_ID'] ?>" data-havechild="<?php echo $have_children_flag ?>">
                         <div class="submenu_icon"><img style="border:none; margin-top:5px;" src="<?php echo $image_src; ?>" /></div>
            			<div class="submenu_title <?php echo $current_section_color; ?>"><?php echo $first_level_list[$i]['sub_sections_name'.$current_language_db_prefix] ?></div>
                        </a>
 			 </div><!-- End of item -->
            <?php
					}else{
						?>
                        <div class="item" style="background:rgba(102, 102, 102, 0.14902);">
             			<a <?php echo $item_url ?> class="firstlevel_click" data-id="<?php echo $first_level_list[$i]['sub_sections_ID'] ?>" data-havechild="<?php echo $have_children_flag ?>">
                         <div class="submenu_icon"><img style="border:none ;margin-top:5px;" src="<?php echo $image_src; ?>" /></div>
            			<div class="submenu_title <?php echo $current_section_color; ?>"><?php echo $first_level_list[$i]['sub_sections_name'.$current_language_db_prefix] ?></div>
                        </a>
 			 </div>
                        <?php
					}
				}else{
						if($first_level_list[$i]['sub_sections_ID'] == 191){
					?>
                    <div class="item">
             			<a <?php echo $item_url ?> class="firstlevel_click" data-id="<?php echo $first_level_list[$i]['sub_sections_ID'] ?>" data-havechild="<?php echo $have_children_flag ?>">
                         <div class="submenu_icon"><img style="border:none ;margin-top:5px;" src="<?php echo $image_src; ?>" /></div>
            			<div class="submenu_title <?php echo $current_section_color; ?>"><?php echo $first_level_list[$i]['sub_sections_name'.$current_language_db_prefix] ?></div>
                        </a>
 			 </div>
                    <?php
				}else{
					?>
                    <div class="item">
             			<a <?php echo $item_url ?> class="firstlevel_click" data-id="<?php echo $first_level_list[$i]['sub_sections_ID'] ?>" data-havechild="<?php echo $have_children_flag ?>">
                         <div class="submenu_icon"><img style="border:none;margin-top:5px;" src="<?php echo $image_src; ?>" /></div>
            			<div class="submenu_title <?php echo $current_section_color; ?>"><?php echo $first_level_list[$i]['sub_sections_name'.$current_language_db_prefix] ?></div>
                        </a>
 			 </div>
                    <?php
				}
				
				}
			}else{
				if($first_level_list[$i]['sub_sections_ID'] == 191){
				?>
                <div class="item">
             			<a rel="gallery1" href="<?php echo base_url()."uploads/slideshows/".$get_whyjoin_slideshows[0]['images_src'] ?>" <?php echo $item_url ?> class="firstlevel_click fancybox" data-id="<?php echo $first_level_list[$i]['sub_sections_ID'] ?>" data-havechild="<?php echo $have_children_flag ?>">
                         <div class="submenu_icon"><img style="border:none" src="<?php echo $image_src; ?>" /></div>
            			<div class="submenu_title <?php echo $current_section_color; ?>"><?php echo $first_level_list[$i]['sub_sections_name'.$current_language_db_prefix] ?></div>
                        </a>
 			 </div>
				<?php
			}else{
				?>
                <div class="item">
             			<a <?php echo $item_url ?> class="firstlevel_click" data-id="<?php echo $first_level_list[$i]['sub_sections_ID'] ?>" data-havechild="<?php echo $have_children_flag ?>">
                         <div class="submenu_icon"><img style="border:none;margin-top:5px;" src="<?php echo $image_src; ?>" /></div>
            			<div class="submenu_title <?php echo $current_section_color; ?>"><?php echo $first_level_list[$i]['sub_sections_name'.$current_language_db_prefix] ?></div>
                        </a>
 			 </div>
                <?php
			}
			}
			endfor;
			?>
          
         
 
        </div>
    </div><!-- End of submenu_container -->
    
    <?php
	//Second, Check if every lvl 1 section have sub level llvl2
	for($i=0 ; $i < sizeof($first_level_list) ; $i++):
	$lvl2_sections_display = $second_level_list_array[$first_level_list[$i]['sub_sections_ID']];
	//print_r($lvl2_sections_display);
		if  ( $lvl2_sections_display   ) 
		{
			$style_string_display_status = 'style="display:none;"';
			if ($parent_id_of_current_sub_section){
				if($parent_id_of_current_sub_section == $first_level_list[$i]['sub_sections_ID'] )
				{
					$style_string_display_status	 = '';
				}
			}
			?>
            <div class="submenu_lvl2_container" data-sectionid="<?php echo $first_level_list[$i]['sub_sections_ID']; ?>" <?php echo $style_string_display_status ?> >
    		<script >
			 $(document).ready(function() {
				 
				    $("#owl-demo_lvl2_<?php echo $first_level_list[$i]['sub_sections_ID']; ?>").owlCarousel({
       				 navigation : false,pagination:false,mouseDrag:false
      			});
				 
				  var owl_<?php echo $first_level_list[$i]['sub_sections_ID']; ?> = $(".owl-carousel_<?php echo $first_level_list[$i]['sub_sections_ID']; ?>").data('owlCarousel');
				     $(".inner_submenu_list_lvl2_next").click(function(e) {
        				owl_<?php echo $first_level_list[$i]['sub_sections_ID']; ?>.next();
   	  				});
	   				$(".inner_submenu_list_lvl2_prev").click(function(e) {
        				owl_<?php echo $first_level_list[$i]['sub_sections_ID']; ?>.prev();
   	  				});
					 
				  
			 });
            </script>
    
                <div id="owl-demo_lvl2_<?php echo $first_level_list[$i]['sub_sections_ID']; ?>" class="owl-carousel_<?php echo $first_level_list[$i]['sub_sections_ID']; ?>" style="width:965PX; margin:0px auto;font-size:13px;">
              
                	<?php
                    for($j=0; $j < sizeof($lvl2_sections_display) ; $j++):
					
					$lvl3_sections_display = $this->sectionsmodel->have_children($lvl2_sections_display[$j]['sub_sections_ID']);
					$have_children_flag = $lvl3_sections_display == false ? false : true;
					
					$item_url = $lvl2_sections_display[$j]['sub_sections_url'] != "" ? site_url(''.$this->router->class.'/'.$lvl2_sections_display[$j]['sub_sections_url'])  : "#";
					
					$level_two_link = $lvl2_sections_display[$j]['sub_sections_url'];
					
					//Check If URL COntain special Code such as %id%
					$item_url = str_replace("%id%",$lvl2_sections_display[$j]['sub_sections_ID'],$item_url);
					
					
					if(($lvl2_sections_display[$j]['sub_sections_url'] == $current_link) || ($current_subsection_link == $lvl2_sections_display[$j]['sub_sections_ID'])){
						if($level_two_link){
						?>
                            <div class="item" style="margin: 5px;margin-top: 19px;border-<?php echo lang('globals_right');?>: 2px #fff solid;">
                     <div class="submenu_title  <?php echo $current_section_color; ?>" style="padding: 3px;line-height: 25px;">
                     	<a href="<?php echo $item_url ?>" rel="<?php echo $lvl2_sections_display[$j]['sub_sections_url']; ?>" class="secondlevel_click <?php echo $current_section_color; ?>" data-id="<?php echo $lvl2_sections_display[$j]['sub_sections_ID'] ?>" data-havechild="<?php echo $have_children_flag ?>" ><?php echo $lvl2_sections_display[$j]['sub_sections_name'.$current_language_db_prefix] ?></a>
                        </div>
                            <?php
						}else{
							?>
                            <div class="item" style="margin: 5px;margin-top: 19px;border-<?php echo lang('globals_right');?>: 2px #fff solid;">
                     <div class="submenu_title" style="padding: 3px;line-height: 25px; color:#FFF;">
                     	<a href="<?php echo $item_url ?>" rel="<?php echo $lvl2_sections_display[$j]['sub_sections_url']; ?>" class="secondlevel_click" data-id="<?php echo $lvl2_sections_display[$j]['sub_sections_ID'] ?>" data-havechild="<?php echo $have_children_flag ?>" ><?php echo $lvl2_sections_display[$j]['sub_sections_name'.$current_language_db_prefix] ?></a>
                        </div>
                            <?php
							}							
					 //Check if lvl 3 found
					 
					 if  ( $lvl3_sections_display   ) 
					 {
						 ?>
                         <ul class="dropdown-menu lvl3_submenu" data-id="<?php echo $lvl2_sections_display[$j]['sub_sections_ID']; ?>" role="menu" style="">
                         <?php
						 		for($k=0; $k < sizeof($lvl3_sections_display) ; $k++):
								
								$item_url_level_3 = $lvl3_sections_display[$k]['sub_sections_url'] != "" ? site_url(''.$this->router->class.'/'.$lvl3_sections_display[$k]['sub_sections_url'])  : "#";
								//Check If URL COntain special Code such as %id%
								$item_url_level_3 = str_replace("%id%",$lvl3_sections_display[$k]['sub_sections_ID'],$item_url_level_3);
								?>
                                <li><a href="<?php echo $item_url_level_3;  ?>"><?php echo $lvl3_sections_display [$k]['sub_sections_name'.$current_language_db_prefix]; ?></a></li>
                                <?php
								endfor;
						 ?>
                         </ul>
                         <?php
					 }
					 ?>
                     </div>
                     <?php
					}else{
						?>
						<div class="item" style="margin: 5px;margin-top: 19px;border-<?php echo lang('globals_right');?>: 2px #fff solid;">
                     <div class="submenu_title white_color" style="padding: 3px;line-height: 25px;">
                     	<a href="<?php echo $item_url ?>" rel="<?php echo $lvl2_sections_display[$j]['sub_sections_url']; ?>" class="secondlevel_click" data-id="<?php echo $lvl2_sections_display[$j]['sub_sections_ID'] ?>" data-havechild="<?php echo $have_children_flag ?>" ><?php echo $lvl2_sections_display[$j]['sub_sections_name'.$current_language_db_prefix] ?></a>
                        </div>
                     <?php
					 //Check if lvl 3 found
					 
					 if  ( $lvl3_sections_display   ) 
					 {
						 ?>
                         <ul class="dropdown-menu lvl3_submenu" data-id="<?php echo $lvl2_sections_display[$j]['sub_sections_ID']; ?>" role="menu" style="">
                         <?php
						 		for($k=0; $k < sizeof($lvl3_sections_display) ; $k++):
								
								$item_url_level_3 = $lvl3_sections_display[$k]['sub_sections_url'] != "" ? site_url(''.$this->router->class.'/'.$lvl3_sections_display[$k]['sub_sections_url'])  : "#";
								//Check If URL COntain special Code such as %id%
								$item_url_level_3 = str_replace("%id%",$lvl3_sections_display[$k]['sub_sections_ID'],$item_url_level_3);
								?>
                                <li><a href="<?php echo $item_url_level_3;  ?>" data-id="<?php echo $lvl3_sections_display[$k]['sub_sections_ID']; ?>"><?php echo $lvl3_sections_display [$k]['sub_sections_name'.$current_language_db_prefix]; ?></a></li>
                                <?php
								endfor;
						 ?>
                         </ul>
                         <?php
					 }
					 ?>
                     </div>
                     <?php
					}
                    ?>
                     
					<?php
                    endfor;
					
                    ?>
                     
                    </div>
                
                
    
    		</div><!-- ENd of submenu_lvl2_container -->
            <?php
			
		}
	
	?>
    <?php
	endfor;
	?>
    
    <?php /*?><div class="submenu_lvl2_container" style="display:none">
    
    
            <div id="owl-demo_lvl2" class="owl-carousel_2" style="width:940px; margin:0px auto;">
            <!--<div class="item" style="padding:30px 0px; position:relative;"><div class="submenu_title white_color">كتاب الوصفات</div>
    <ul class="dropdown-menu" role="menu" style="
 ">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
    </div>-->
			<?php
                for($i=0; $i < 8 ; $i++):
                ?>
                 <div class="item" style="padding:30px 0px;"><div class="submenu_title white_color">كتاب الوصفات</div></div>
			<?php
            endfor;
            ?>
                  
                 <!--<div class="item" style="padding:30px 0px; position:relative;"><div class="submenu_title white_color">كتاب الوصفات</div>
    <ul class="dropdown-menu" role="menu" style="
 ">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
    </div>-->
         
                </div>
                
                
    
    </div><?php */?><!-- ENd of submenu_lvl2_container -->
    
	 

</div><!-- End of submenu_container_wrapper -->
<div class="banner float_right" style="display:none;">
    	<?php /*?><img src="<?php echo base_url(); ?>images/login_banner.png"/><?php */?>
        <?php
		$get_whyjoin_slideshows = $this->globalmodel->get_whyjoin_slideshow($current_language_db_prefix);
		?>
        <ul class="gallery clearfix">
        <?php
		for($i = 0 ;$i < sizeof($get_whyjoin_slideshows) ; $i++):
		$image = base_url()."uploads/slideshows/".$get_whyjoin_slideshows[$i]['images_src'];
			?>
            <li><a href="<?php echo $image; ?>" rel="prettyPhoto[gallery2]"  ><img src="<?php echo base_url(); ?>images/login_banner<?php echo $current_language_db_prefix; ?>.png"/></a></li>
            <?php
		endfor;
		?>
			</ul>
    </div>
    <script>
    $(document).ready(function() {
		
	<?php if(!empty($current_subsection_link) && $current_subsection_link != "success"){
		?>
		var current_section = <?php echo extractSeoid($current_subsection_link); ?>;
		<?php
	}else{
	?>
		var current_section = null;
	<?php	
	}
	?>
	
	<?php if(!empty($current_link)){
		?>
		var current_link = '<?php echo $current_link; ?>';
		<?php
	}else{
	?>
		var current_link = null;
	<?php	
	}
	?>
	
	if(current_section == 2){
		$(".firstlevel_click").parent().css('background', 'rgba(145, 145, 145, 0)');
		$(".firstlevel_click[data-id=11]").parent().css('background', 'rgba(102, 102, 102, 0.14902)');
	}else if(current_section == 14){
		$(".firstlevel_click").parent().css('background', 'rgba(145, 145, 145, 0)');
		$(".firstlevel_click[data-id=14]").parent().css('background', 'rgba(102, 102, 102, 0.14902)');

	}else if(current_section == 13){
		$(".firstlevel_click").parent().css('background', 'rgba(145, 145, 145, 0)');
		$(".firstlevel_click[data-id=13]").parent().css('background', 'rgba(102, 102, 102, 0.14902)');

	}else if(current_section == 47){
		$(".firstlevel_click").parent().css('background', 'rgba(145, 145, 145, 0)');
		$(".firstlevel_click[data-id=47]").parent().css('background', 'rgba(102, 102, 102, 0.14902)');

	}else if(current_section == 49){
		$(".firstlevel_click").parent().css('background', 'rgba(145, 145, 145, 0)');
		$(".firstlevel_click[data-id=49]").parent().css('background', 'rgba(102, 102, 102, 0.14902)');

	}else if(current_section == 187){
		$(".firstlevel_click").parent().css('background', 'rgba(145, 145, 145, 0)');
		$(".firstlevel_click[data-id=187]").parent().css('background', 'rgba(102, 102, 102, 0.14902)');

	}else if(current_section == 76 || current_section == 73 || current_section == 78){
		$(".firstlevel_click").parent().css('background', 'rgba(145, 145, 145, 0)');
		$(".firstlevel_click[data-id=63]").parent().css('background', 'rgba(102, 102, 102, 0.14902)');
		$(".submenu_lvl2_container[data-sectionid=63]").show();
		$(".submenu_lvl2_container[data-sectionid=63] .secondlevel_click[data-id=71]").addClass('<?php echo $current_section_color; ?>');
		$(".lvl3_submenu[data-id=71] a[data-id="+ current_section +"]").addClass('<?php echo $current_section_color; ?>');
		
	}else if(current_section == 79 || current_section == 75 || current_section == 80 || current_section == 81){
		$(".firstlevel_click").parent().css('background', 'rgba(145, 145, 145, 0)');
		$(".firstlevel_click[data-id=63]").parent().css('background', 'rgba(102, 102, 102, 0.14902)');
		$(".submenu_lvl2_container[data-sectionid=63]").show();
		$(".submenu_lvl2_container[data-sectionid=63] .secondlevel_click[data-id=72]").addClass('<?php echo $current_section_color; ?>');
		$(".lvl3_submenu[data-id=72] a[data-id="+ current_section +"]").addClass('<?php echo $current_section_color; ?>');

	}else if(current_section == 85 || current_section == 86 || current_section == 87 || current_section == 88){
		$(".firstlevel_click").parent().css('background', 'rgba(145, 145, 145, 0)');
		$(".firstlevel_click[data-id=64]").parent().css('background', 'rgba(102, 102, 102, 0.14902)');
		$(".submenu_lvl2_container[data-sectionid=64]").show();
		$(".submenu_lvl2_container[data-sectionid=64] .secondlevel_click[data-id=84]").addClass('<?php echo $current_section_color; ?>');
		$(".lvl3_submenu[data-id=84] a[data-id="+ current_section +"]").addClass('<?php echo $current_section_color; ?>');
	}
	
	if(current_link == 'quiz'){
		$(".firstlevel_click").parent().css('background', 'rgba(145, 145, 145, 0)');
		$(".firstlevel_click[data-id=186]").parent().css('background', 'rgba(102, 102, 102, 0.14902)');

	}
	
	});
	</script>