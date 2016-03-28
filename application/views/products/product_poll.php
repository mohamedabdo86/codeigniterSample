<div id="votes" class="float_left">
<h1 id="slider_tag" class="product_color"><?php echo lang('product_feedback'); ?></h1>

 <div id="vote_content">
    <form action="products/answerQuestion/" id="form" method="post" class="float_left product_color">
		<input type="hidden" name="id" value="<?php echo $brand_id; ?>"  />
        <?php 
		$data = array('rows' => 9, 'cols' => 66, 'name' => 'comment_text', 'id' => 'comment_text' ,'placeholder'=> lang('product_comments_placeholder'), 'style' => 'padding: 8px; width: 96%;');
		echo form_textarea($data);
		?>
        <div class="submits">
         <ul>
            <li><a href="<?php echo site_url("products/reviews/{$brand_id}"); ?>" class="vote_button" ><?php echo lang('product_view_comments'); ?></a></li>
            <li><a class="vote_button" id="submit" ><?php echo lang('product_send_comments'); ?></a></li>
         </ul>
       </div>
	</form>
</div>
 
 <style>
 
 #comment_text{border-radius:10px; border:1px solid #CCC;width:98%; direction:rtl;}
 .english #comment_text{direction:ltr;}
 
 .thanks_message{text-align:center; margin-top:80px;}
 
.vote_button{padding:5px;border: thick; border-width: thin; width: 100px; height: 30px; background: <?php echo $display[0]['products_brand_BGColor']; ?>; border-radius:3px; color:#FFF; cursor:pointer;}

.vote_button:hover{border: thick; border-width: thin; width: 100px; height: 30px; background: #fcfcfc; border-radius:2px; color:<?php echo $display[0]['products_brand_BGColor']; ?>; cursor:pointer; border:1px solid <?php echo $display[0]['products_brand_BGColor']; ?>;}
 </style> 	
    
  </div>
  
<script>

$("#submit").live("click", function() {
	 var members_id = '<?php echo $this->members->members_id ?>';
	if($("#comment_text").val() === ""){
	return false;
	}else{
	data = $( "#form" ).serialize();
	$.post( "<?php echo site_url('products/add_comment/'); ?>", data, function( message ){
		if(message === 0){
			$( "#vote_content" ).html( '<h2 class="thanks_message product_color"><?php echo lang('product_polls_not_login') ?></h2>');
		}else if(message === 1){
			if(members_id == 0){
				$( "#vote_content" ).html( '<h2 class="thanks_message product_color"><?php echo lang('globals_thanks_for_comment_not_login') ?></h2>');
				}else{
				$( "#vote_content" ).html( '<h2 class="thanks_message product_color"><?php echo lang('globals_thanks_for_comment') ?></h2>');
					}
	
		}else{
			$( "#vote_content" ).html( '<h2 class="thanks_message product_color"><?php echo lang('product_polls_error') ?></h2>');
		}
	});
	}
	return false;
});


</script>