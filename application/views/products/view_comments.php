<link href="<?php echo base_url(); ?>css/products.css" rel="stylesheet">
<?php $this->load->view('template/submenu_writer_products');   ?>
<?php $this->load->view('template/tree_menu_writer');   ?>
<?php $this->load->view('products/view_slideshow');   ?>

<script>
$(document).ready(function() {
$('.comments_insert').hide();
	$('.toggle_input_comment').click(function(e) {
        $('.comments_insert').slideToggle('slow');
    });
});
</script>

<h1 title="<?php echo $display[0]['products_brand_name'.$current_language_db_prefix]; ?>" id="slider_tag" class="product_color product_borderbottom_color"><?php echo $display[0]['products_brand_name'.$current_language_db_prefix]; ?></h1>


<?php
//print_r($display_comments);
if($display_comments){
?>
<div class="view_comments" style="width:100%; height:auto;">
<?php
       $params = array('table'=>'products','foreign_id'=>$brand_id);
	   $comments = $this->comments->get_comments($params);
	   echo $comments;
?>
</div>

<?php
}else{
?>
<h1 style="background: #FFF; padding: 15px;color: rgb(105, 105, 105);"><?php echo lang('product_cooments_unavailable'); ?></h1>
<?php
}
?>
<div class="add_comment">
<div class="rate_wrapper_left float_right" style="height: auto;margin: 22px 0px;">
          	<a class="toggle_input_comment <?php echo $current_section_background_color ?>"><?php echo lang('globals_add_comment_article')?></a>
          </div>
          <div class="clear"></div>
        </div>
<div class="comments_insert" >

        	<?php

				$params = array('member_email'=>$this->members->members_email,'table'=>'products','foreign_id'=>$brand_id,'member_id'=>$this->members->members_id, 'section_id'=>$current_section_id, 'current_section_background_color' => $current_section_background_color);
			    echo $this->comments->insert_comments($params); 
			?>
        </div>
<!--<form action="products/answerQuestion/" id="form" method="post" class="float_left product_color">
		<input type="hidden" name="id" value="<?php echo $brand_id; ?>"  />
        <?php 
		/*$data = array('rows' => 10, 'cols' => 58, 'name' => 'comment_text', 'id' => 'comment_text');
		echo form_textarea($data);*/
		 ?>
        <div class="submits" style="height:50px;">
         <ul>
            <li><a class="vote_button" id="submit" ><?php echo lang('product_send_comments'); ?></a></li>
         </ul>
       </div>
</form>-->
</div> 

<?php
if(!empty($display_promotions)){
		  $this->load->view('products/product_promotions'); 
}
?>
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
<script>

$("#submit").live("click", function() {
	if($("#comment_text").val() === ""){
	return false;
	}else{
	data = $( "#form" ).serialize();
	$.post( "<?php echo site_url('products/add_comment/'); ?>", data, function( message ){
		if(message === 0){
			$( ".add_comment" ).html( '<h2 class="thanks_message product_color"><?php echo lang('product_polls_not_login') ?></h2>');
		}else if(message === 1){
			$( ".add_comment" ).html( '<h2 class="thanks_message product_color"><?php echo lang('product_polls_thanks_message') ?></h2>');
		}else{
			$( ".add_comment" ).html( '<h2 class="thanks_message product_color"><?php echo lang('product_polls_error') ?></h2>');
		}
	});
	}
	return false;
});


</script>   
<style>
<?php 
if($current_language_db_prefix != "_ar"){
?>
.search_big_button{width: 85px !important;}
.add_comment{height: 204px !important;}
<?php
}
?>
.add_comment{/*height: 285px;*/ width: 100%; border-top:1px solid #CCC; padding-top:20px;}
#slider_tag{margin-bottom: 0px !important; border-top-left-radius: 10px; border-top-right-radius: 10px; margin-top: 10px;}
.view_comment{width:100%; min-height:90px; background:rgba(204, 204, 204, 0.13);}
.comments_wrapper ul{width:100% !important; }
.member_comment_wrapper{width:100% !important;}

 
.thanks_message{text-align:center; margin-top:80px;}
 
.vote_button{padding:10px; border: thick; border-width: thin; width: 100px; height: 30px; background: <?php echo $display[0]['products_brand_BGColor']; ?>; border-radius:3px; color:#FFF; cursor:pointer;}

.vote_button:hover{border: thick; border-width: thin; width: 100px; height: 30px; background: #fcfcfc; border-radius:2px; color:<?php echo $display[0]['products_brand_BGColor']; ?>; cursor:pointer; border:1px solid <?php echo $display[0]['products_brand_BGColor']; ?>;}

.submits { margin: 10px 5px 0px 5px !important; }
.comments_wrapper{padding: 0px 0 !important;}
</style>
