<?php echo $this->load->view('template/submenu_writer');   ?>
<?php echo $this->load->view('template/tree_menu_writer');   ?>
<script>
$("#single_1").fancybox({
		  width: 420,
          height: 150,
		  scrolling   : 'no',
		  autoSize : false,
          fitToView : false,
          helpers: {
              title : {
                  type : 'float'
              }
          }
      });
	 
$("#close").live("click", function(){
 parent.$.fancybox.close();
});
	  



	
	function message(id, recipe_id, image_id){
			$("#single_1").live("click", function(){
			$("#insert_message").html('<div style="text-align:center;margin-top:20px;"><h1 style="margin-bottom:25px;"><?php echo lang('mycorner_recipe_delete');?></h1><a class="ok_button" href="#"><?php echo lang('mycorner_recipe_yes'); ?></a>  <a href="#" id="close"><?php echo lang('mycorner_recipe_no'); ?></a></div>');
            });
			
			$(".ok_button").live("click", function() {
       		 item = $(this);
       		 //var id = $(this).attr('rel');
			var base = "<?php echo site_url('my_corner/delete_recipe/'); ?>"
       		 $.post(base+'/'+recipe_id+'/'+image_id);
       		 item.parent().fadeOut(300, function() {
				$("#"+id+"").remove();
				parent.$.fancybox.close();
				<?php $views = $this->members->members_no_of_overrall_posts_unapproved - 1; ?>
				<?php if($views == 0){ ?>
				$(".recipes_content").html('<h1 style="text-align:center; padding:30px;"><?php echo lang('mycorner_no_recipes_found'); ?></h1>');
				<?php }?>
            //item.parent().remove();
       		 });
       		 return false;
    		});
			}
</script>
<style>
#close{
	background:#E7E7E7;padding:5px 30px 5px 30px;border-radius: 10px;
}
#close:hover{background:#CCC}
.ok_button{background:#E7E7E7;padding:5px 30px 5px 30px;border-radius: 10px;}
.ok_button:hover{background:#CCC}
.no_recipe_message{padding:20px;}
.whitespace{white-space:normal;}
.triangler{
	width: 0px;
	height: 0px;
	border-style: solid;
	border-width: 11px 7px 0 7px;
border-color: #c8c8c8 transparent transparent transparent;
margin-left:80px;
}
</style>

<div class="clear"></div>
<div id="insert_message"></div>
<div class="inner_title_wrapper">
	<div class="sections_wrapper_margin">
    <h1 class="<?php echo $current_section_color; ?> float_left" style="font-size:25px;"><?php echo lang('mycorner_myrecipe'); ?></h1>
    <div class="clear"></div>
    </div>
</div><!-- End of inner_title_wrapper -->
<div class="thick_line <?php echo $current_section_background_color; ?>"></div>
	  <div class="clear"></div>
<div class="global_background" style="height:auto;">
        <ul class="recipes_content" style="padding:10px;">
        <?php if($display_my_recipes){
		for($i=0;$i<sizeof($display_my_recipes);$i++):
		$id = $display_my_recipes[$i]['members_recipes_ID'];
		$url = $display_my_recipes[$i]['members_recipes_ID'];
		$image = base_url().'uploads/test/'.$display_my_recipes[$i]['images_src'];
		$image_id = $display_my_recipes[$i]['members_recipes_image'];
		$title = $display_my_recipes[$i]['members_recipes_name'];
		$desc = $display_my_recipes[$i]['members_recipes_directions'];
		$status = $display_my_recipes[$i]['members_recipes_approved'];
		$short_desc =  $this->common->limit_text($desc,350);
		$visible = '<img title="'.lang('mycorner_recipe_visible').'" class="float_right" height="20" width="20" src="'.base_url().'/images/mycorner/visible.png" style="margin-right: 80px;margin-left: 80px;" >';
		$invisible = '<img title="'.lang('mycorner_recipe_invisible').'" class="float_right" height="20" width="20" src="'.base_url().'/images/mycorner/invisible.png" style="margin-right: 80px;margin-left: 80px;" >';
		?>
            <li id="<?php echo $i; ?>" style="border-bottom: 5px solid #c8c8c8;" class="ok_button_active">
        	<div class="float_left" style="width:800px;">
            
            	<div class="float_left" style="margin: 10px 10px 0px 10px;">
                    <a href="<?php echo site_url('best_cook/your_recipes/'.$url.'');?>"><img class="image_recipe" src="<?php echo $image?>" width="208"  /></a>
                </div>
                <div class="float_right" style="width: 570px;margin-top:30px;">
                	 <a href="<?php echo site_url('best_cook/your_recipes/'.$url.'');?>"><h2 style="font-size:20px;"><?php echo $title?></h2></a>
                     <p class="whitespace" style="font:inherit;"><?php echo $short_desc; ?> </p>
                     <?php //if($status == 1){echo $visible;}else{echo $invisible;} ?>
                     
                </div>
            		<div class="clear"></div>
            </div> <!--end of float left-->
            
            <div class="float_right" style="width:180px;">
            <div style="width:180px;margin-top:42px;height:25px;"><?php if($status == 1){echo $visible;}else{echo $invisible;} ?></div>
        	<div style="border: 2px solid #c8c8c8;width:166px;margin-left:5px;" ></div>
            <div class="float_left" style="border: 2px solid #c8c8c8;height:90px;margin-top:-25px;"></div>
            <div style="width:180px; height:20px; margin-bottom:10px;margin-top:7px;"> <h3 style="text-align:center;"><a href="<?php echo site_url('my_corner/edit_recipe/'.$id.'');?>"><?php echo lang('globals_edit'); ?></a></h3> </div>
            <div style="border: 2px solid #c8c8c8;width:166px;margin-left:5px;" ></div>
            <div style="width:180px;color:red;"> <h3 style="text-align:center;"><a  onclick="message(<?php echo $i.','.$id.','.''.$image_id.''; ?>)" id="single_1" href="#insert_message"><?php echo lang('globals_delete'); ?></a></h3></div>
          
        <?php //echo site_url('my_corner/delete_recipe/'.$id.'');?>
        </div>
        
         <div class="clear"></div>
        
        
        </li>
            <?php
		endfor;
		}else{
		?>
         <h1 style="padding:6px; color:#13758e!important;"><?php echo lang('mycorner_no_recipes_found'); ?></h1>
        <?php	
		}?>
        </ul>

    </div>
    <div class="page_navigation" align="center">
	<?php //echo  $pagination_links; ?>
    </div>

	


</div>