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
.comments_wrapper{
	padding: 0px 0 !important;
}
.member_comment_wrapper{
	background:#FFF !important;
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
		 
    });
	
	$('.dislike_image').click(function(e) {
         $(this).css('backgroundPosition', '-3px 32px');
    });

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
				url : baseurl+'en/ajax/insert_comments',
				data : $('form').serialize(),
				type: "POST",
				beforeSend: function() {
					$(".search_big_button").attr('disabled', true);
				},
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
				   $(".search_big_button").attr('disabled', false);
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

<div class="clear"></div>

<?php //$this->load->view('template/submenu_writer_products');   ?>
<?php //$this->load->view('template/tree_menu_writer');   ?>

<div class="clear"></div>

<div class="inner_title_wrapper">

<div class="sections_wrapper_margin">
<h1 class="<?php echo $current_section_color  ?>" style="font-size:24px;"><?php //echo $parent_section_display[0]['sub_sections_name'.$current_language_db_prefix] ?></h1>
</div>

</div><!-- End of inner_title_wrapper -->

<div class="thick_line <?php echo $current_section_background_color; ?>"></div>

<div class="container_wrapper_1_item">
	<div class="article_container float_left">

   
       <a onclick="javascript:history.go(-1)" href="javascript:void(0);"><?php echo lang('globals_back');?></a>
        
        <div class="clear"></div>
        </div><!--End Of first_container-->
        <div class="second_container">
        <div class="rate_recipes">

          <div class="rate_wrapper_left float_right" style="height: auto;margin: 22px 13px;">
          	<a class="toggle_input_comment <?php echo $current_section_background_color ?>"><?php echo lang('globals_add_comment_article')?></a>
          </div>
          <div class="clear"></div>
        </div><!--End of .rate_recipes-->
        <div class="comments_insert">

				<?php
				$table_name = "products";

				$params = array('table'=>$table_name,'foreign_id'=>$product_id,'member_id'=>$this->members->members_id, 'section_id'=>$current_section_id, 'current_section_background_color' => $current_section_background_color);
			    echo $this->comments->insert_comments($params); 
			?>
        </div>
        
        <div class="comments_result">
        	<?php
            	$params = array('table'=>$table_name,'foreign_id'=>$product_id );
			    echo $this->comments->get_comments($params); 
			?>
        </div><!--End of .comments_result-->
        </div><!--End of .second_container-->

    </div><!--End Of .article_container-->


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
