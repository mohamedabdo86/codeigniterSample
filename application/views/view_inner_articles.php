<style>
.dislike_image
{
	width:30px;
	height:30px;
	cursor:pointer;
	background:url(<?php echo base_url();?>images/icons/dislike_icon.png) -3px -3px;
}
.like_image
{
	width:30px;
	height:30px;
	cursor:pointer;
	background:url(<?php echo base_url();?>images/icons/like_icon.png) -3px 32px;
}
.bx-viewport
{
	height:770px !important;
}
.atm-f , #at_pspromo
{
	visibility: hidden !important;
	display:none !important;
}
.atm-i 
{
	border:none !important;
}
.desc p
{
	font-size:13px;
	line-height:21px !important;
}
#disable_msg
{
	position: absolute;
	display: none; 
	margin-top: -38px;
	padding: 5px;
	margin-left: -40px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	color:#FFF;
}
.arabic .sub_title
{
	width:25%;
}
.desc a
{
	text-decoration:underline;
	color: cornflowerblue;
}
</style>
<script type="text/javascript">
$(document).ready(function(e) {
	
	$('.comments_insert').hide();
	$('.toggle_input_comment').click(function(e) {
        $('.comments_insert').slideToggle('slow');
    });
	
    $('.like_image').click(function(e) {
         $(this).css('backgroundPosition', '-3px -3px');
		 //$(this).parent().find('.dislike_icon').css("background-color", "#06F");
		 
    });
	
	$('.dislike_image').click(function(e) {
         $(this).css('backgroundPosition', '-3px 32px');
    });

    $("#single_1").fancybox({
		  width: 420,
          height: 180,
		  scrolling   : 'no',
		  autoSize : false,
          fitToView : false,
          helpers: {
              title : {
                  type : 'float'
              }
          }
      });
	  
	$('.disable_rate').hover(
		function() {$('#disable_msg').show('fast')},
		function() {$('#disable_msg').hide('fast')}
	);
	
		
	$('#download_id').hover(
		function() {$('#download_disable_msg').show('fast')},
		function() {$('#download_disable_msg').hide('fast')}
	);
	
});
</script>
<script type="text/javascript">
$(document).ready(function(e) {
	 var baseurl = $('#baseurl').val();
	 var members_id = '<?php echo $this->members->members_id ?>';
    $('.submit_comment').submit(function(){
		var message = $.trim($('#message').val());
		 
		 if(message)
		 {

			$.ajax({
				url : baseurl+'/en/ajax/insert_comments',
				data : $('form').serialize(),
				type: "POST",
			   success : function(){
				   if(members_id == 0)
				   {
					    $('.comment_big_input').val("");
					    $('.comment_big_input').attr("placeholder", '<?php echo lang('globals_thanks_for_comment_not_login')?>');
						
				   }
				   else
				   {
				   		$('.comment_big_input').val("");
					    $('.comment_big_input').attr("placeholder", '<?php echo lang('globals_thanks_for_comment')?>');
						 
				   }
					//$(comment).hide().insertBefore('#insertbeforMe').slideDown('slow');
				}
			})
			return false;
		 }
		 else
		 {
			return false;
		 }
		
    })
});
</script>


<div id="insert_message"></div>

<div class="clear"></div>

<?php echo $this->load->view('template/submenu_writer');   ?>

<?php echo $this->load->view('template/tree_menu_writer'); ?>

<div class="clear"></div>

<div class="inner_title_wrapper">

<div class="sections_wrapper_margin">
<h1 class="<?php echo $current_section_color  ?>" style="font-size:24px;"><?php echo $parent_section_display[0]['sub_sections_name'.$current_language_db_prefix] ?></h1>
</div>

</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>"></div>

<div class="container_wrapper_1_item">
	<div class="article_container float_left">
     <div class="first_container global_background" style="margin-top:10px;">
    	<?php

			$image_url = $this->config->item('articles_img_link');
			
			$table_name_for_rate = "articles";
			$id = $display_article[0]['articles_ID'];
        	$image = $image_url.$display_article[0]['images_src'];
			
			$url = site_url($this->router->class."/".$this->router->method."/".$id);
			$title = $display_article[0]['articles_title'.$current_language_db_prefix];

			$views = $display_article[0]['articles_views'];
			$desc = strip_tags($display_article[0]['articles_body'.$current_language_db_prefix], '<div>,<ol>,<li>,<ul>,<strong>,<br/>,<p>,<table>,<tr>,<td>,<a>');
		?>
        <script type="text/javascript">
		$(document).ready(function(e) {
						
			$('.add_to_book').click(function(e) {
			var foreign_id = '<?php echo $id; ?>';
			var members_id = '<?php echo $this->members->members_id; ?>';
			var section_id = '<?php echo $current_section_id; ?>';
			var section_type = '<?php echo $table_name_for_rate; ?>';
			var type = 'articles'; // recipes
			
			$.ajax({
				  url:  "<?php echo site_url("ajax/insert_book"); ?>",
				  type: "POST",
				  data: {foreign_id : foreign_id , members_id : members_id , section_id : section_id , section_type : section_type ,type : type},
				  cache: false,
				  dataType: "json",
				  success: function(success_array)
				  {
					//alert('Inserted to your book');
					if(success_array.state == true)
					{
						$('#insert_message').html('<div style="text-align:center;margin-top:60px;"><h1><?php echo lang('globals_inserted');?></h1></div>');
					}
					else if(success_array.state == false)
					{
						$('#insert_message').html('<div style="text-align:center;margin-top:60px;"><h1 style="margin:10px;"><?php echo lang('globals_already_inserted');?></h1></div>');
					}

				  },
				  error: function(xhr, ajaxOptions, thrownError)
				  {
					
				  }
					  
				});
				
			});
		});
		</script>
        <div class="image float_left" >
        	<img class="image_recipe" src="<?php echo $image?>" width="323" alt="<?php echo $title;?>" />
            <div class="clear"></div>
           		<div>
                	 <!--Start Rating And Views-->
                    <div class="rating_wrapper_container" style="margin-top: -10px;">

                       <div class="rating float_right" style="width: 90px; margin:5px 0;">
                       
                        <?php
                            $params = array('table'=>$table_name_for_rate,'foreign_id'=>$id);
                            echo $this->rate->get_recipe_rate($params); 
                        ?>
                        </div><!--End Of Rating-->
	                    <span class="readmore float_right" style="line-height: 28px; width:30%"><?php echo lang('globals_rate_article')?></span>
                        <span style="line-height: 29px;font-size: 12px;" class="dark_gray float_left" ><?php echo lang('globals_views') ." ( ".$views." ) ";?></span>
                        <!--End Of Views-->
                        <div class="clear"></div>
                    </div>
                    
                     <!--Start Big social-->
					<div class="social_big_icon float_left">
                    <?php
                    $params = array('url' => $url, 'title' => $title,'member_id'=>$this->members->members_id);
                    echo $this->sharing->sharing_article($params, $this->members->members_id); 
                    
                    ?>
                    </div><!--End Of .Big social-->
                    
                    
                </div><!--End Of .social_wrapper_contanier-->
                
            
            
            <div class="clear"></div>
        </div>
        <h2 class="title dark_gray dir"><?php echo $title;?></h2>

        <div class="desc dir">
        	 <?php echo $desc;?> 
        </div>
      
		
        <div class="readmore <?php echo $current_section_color  ?> float_right" style="margin:10px;"><a onclick="javascript:history.go(-1)" href="javascript:void(0);"><?php echo lang('globals_back');?></a></div>

        
        <div class="clear"></div>
        </div><!--End Of first_container-->
        <div class="second_container">
        <div class="rate_recipes">
        
        <div class="rate_wrapper_right float_left" style="width:468px; height:auto;">
        	<div style=" padding:5px 10px;">
            	<div>
                
        		<h3 class="sub_title <?php echo $current_section_color  ?> float_left" style="line-height: 30px;"><?php echo lang('globals_opinion_important')?></h3>
                
                <div class="rating float_left" style="width: 90px; margin:5px">
				<?php
				if($this->members->members_id)
				{
					$params = array('table'=>'members_rate','type'=>$table_name_for_rate,'foreign_id'=>$id,'member_id'=>$this->members->members_id);
                    echo $this->rate->get_member_rate($params);
				}
				else
				{
					$params = array('current_section_background_color'=>$current_section_background_color);
					echo $this->rate->get_disable_rate($params);
				}
                ?>
                </div><!--End Of Rating-->
                 <div class="clear"></div>
                </div>
                <div class="clear"></div>
        	</div>
            <h4 style="padding: 5px 11px;font-weight: 600;color: #777;">
            <?php echo lang('globals_your_opinion')?>
            </h4>
          </div><!--End of rate_wrapper_right-->
          <div class="rate_wrapper_left float_right" style="height: auto;margin: 22px 13px;">
          	<a class="toggle_input_comment <?php echo $current_section_background_color ?>"><?php echo lang('globals_add_comment_article')?></a>
          </div>
          <div class="clear"></div>
        </div><!--End of .rate_recipes-->
        <div class="comments_insert">
        	<?php

				$params = array('member_email'=>$this->members->members_email,'table'=>$table_name_for_rate,'foreign_id'=>$id,'member_id'=>$this->members->members_id, 'section_id'=>$current_section_id, 'current_section_background_color' => $current_section_background_color);
			    echo $this->comments->insert_comments($params); 
			?>
        </div>
        
        <div class="comments_result">
        	<?php
            	$params = array('table'=>$table_name_for_rate,'foreign_id'=>$id );
			    echo $this->comments->get_comments($params); 
			?>
        </div><!--End of .comments_result-->
        </div><!--End of .second_container-->

    </div><!--End Of .article_container-->
    <div class="sidebar float_right">
    	
        
    <div class="image_side_bar">
    
    	<?php if($this->data['current_section_id'] ==  2){ ?>
        
    	<a href="<?php echo site_url('best_cook/applications/1'); ?>"><img width="240" src="<?php echo base_url()."images/bestcook/upload_recipe_banner".$current_language_db_prefix.".jpg" ?>" /></a> 
		<?  } 
		
		  elseif($this->data['current_section_id'] ==  27){ ?>
           <a href="<?php echo site_url('best_mom/applications/3');?>"><img width="240" src="<?php echo base_url()."images/bestmom/mom-article-inner banner".$current_language_db_prefix.".png" ?>" /></a> 
            <?  }
			
			elseif($this->data['current_section_id'] ==  10){ ?>
           <a href="<?php echo site_url('best_me/applications/7');?>"><img width="240" src="<?php echo base_url()?>images/bestme/best_me_banner<?php echo $current_language_db_prefix; ?>.jpg" /></a>
            <?  }
			
				elseif($this->data['current_section_id'] ==  28){ ?>
                 <a href="<?php echo site_url('best_time/games/1');?>"><img width="240" src="<?php echo base_url()?>images/besttime/articleinnerbesttime<?php echo $current_language_db_prefix;  ?>.png" /></a> 
            <? } ?>
	
    </div>
        
        <div class="related_3_items_list_wrapper <?php echo $current_section_color ?>">
			<h2><?php echo lang('globals_related_articles'); ?></h2>
            <ul class="bxslider">
            <?php
            for($i=0 ; $i < sizeof($display_related_articles) ; $i++):
            $id = $display_related_articles[$i]['articles_ID'];
            $title =    $display_related_articles[$i]['articles_title'.$current_language_db_prefix];
            $image =  $display_related_articles[$i]['images_src'] == "0" ?  base_url()."images/image_not_available".$current_language_db_prefix.".png"  : $image_url.$this->config->item('image_prefix').$display_related_articles[$i]['images_src'];
            $url = site_url($this->router->class."/".$this->router->method."/".generateSeotitle($display_related_articles[$i]['articles_ID'] , $display_related_articles[$i]['articles_title'.$current_language_db_prefix]));
            $short_title = $this->common->limit_text($title,35);
            ?>
                <li>
                <div class="image"><a href="<?php echo $url ?>" title="<?php echo $title?>"><img src="<?php echo $image;?>" alt="<?php echo $title?>"  ></a></div>
                <div class="title dir float_left dark_gray"><a href="<?php echo $url ?>"><?php echo $short_title;?></a></div>
                <div class="readmore <?php echo $current_section_color  ?> float_right" style="margin: 0 10px;"><a href="<?php echo $url ?>"><?php echo lang('globals_more');?></a></div>
                
                
                <div class="clear"></div>
                </li>
            <?php
            endfor;
            ?>
      
            </ul>

		</div><!--End Of .related_3_items_list_wrapper -->
	</div><!--End of SideBar-->


<div class="clear"></div>


</div><!-- End of container_wrapper_1_item -->


<div class="clear"></div>
<script type="text/javascript">
// Alert a message when the user shares somewhere
function eventHandler(evt) { 

    if (evt.type == 'addthis.menu.share') { 
        //alert(typeof(evt.data)); // evt.data is an object hash containing all event data
        //alert(evt.data.service); // evt.data.service is specific to the "addthis.menu.share" event
    }
}

addthis.addEventListener('addthis.menu.share', eventHandler);
</script>
