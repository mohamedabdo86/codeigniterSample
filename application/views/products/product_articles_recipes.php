<link href="<?php echo base_url(); ?>css/products.css" rel="stylesheet">

<script>
$(document).ready(

  function(){ 
    $( "#tabs" ).tabs({ show: { effect: "blind", duration: 800 } });
  }
  );
  </script>

<script type="text/javascript">
$(document).ready(function(e) {
	
	$("#link-1").css('color', '<?php echo $display[0]['products_brand_BGColor']; ?>');
	
	$("#link-1").click(function(){
		$("#tab-1").show();
		$("#tab-2").hide();
		$("#link-1").css('color', '<?php echo $display[0]['products_brand_BGColor']; ?>');
		$("#link-2").css('color', '#999');
	});
	
	$("#link-2").click(function(){
		$("#tab-2").show();
		$("#tab-1").hide();
		$("#link-2").css('color', '<?php echo $display[0]['products_brand_BGColor']; ?>');
		$("#link-1").css('color', '#999');
	});
	
	$("#show_more").live("click", function(){
		var item = $(this);
		item.val('Loading... ');
		var last_id = $("div.display_recipes:last").attr('id');
		$.ajax({
            url : "<?php echo site_url($this->router->class.'/get_recipes'); ?>",
            data : {last_id : last_id, brand_id : <?php echo $brand_id; ?>},
            type: "POST",
			cache: false,
			dataType: "json",
          	success : function(success_array)
			{	
				for (var i = 0; i < success_array.length; i++)
                {
					var recipe_id = success_array[i].recipes_ID;
					var recipe_title = success_array[i].recipes_title<?php echo $current_language_db_prefix; ?>;
					var recipe_content = success_array[i].recipes_directions<?php echo $current_language_db_prefix; ?>.substring(0,130);
					var recipe_desc = recipe_content.replace(/(<([^>]+)>)/ig,"");
					var recipe_image_src = '<?php echo $this->config->item('products_img_link') ?>'+success_array[i].images_src;
					var recipe_url = '<?php echo site_url('best_cook/delicious_recipes/'); ?>/'+ recipe_id +'';
					 
					$("#recipes_data").append('<div class="product_article display_recipes" id="'+recipe_id+'"><a class="float_left" href="'+ recipe_url +'" title="'+ recipe_title +'"><img alt="'+recipe_title+'" title="'+ recipe_title +'" style="margin:7px; border:none;" width="120" height="85" src="'+ recipe_image_src +'" class="float_left" /><h3 title="'+ recipe_title +'" style="padding-top:2px; font-weight:bold; width:345px;" class="float_left">'+ recipe_title +'</h3><p class="float_left" style="white-space:normal; width:350px; color:#666;">'+ recipe_desc +' ... </p></a></div><div style="width:490px;"><hr /></div>');
				}
				item.val('Show More... ');
            }
        });
		return false;
	});
	
});
</script>


<script>
$(function(){
    $('#articles_content').slimScroll({
        height: '207px',
		<?php
		if($current_language_db_prefix == "_ar"){
		?>
			position: 'right'
		<?php
		}else{
		?>
			position: 'left'
		<?php
			}
		?>
    });
});
</script>
<script>
$(function(){
    $('#recipes_content').slimScroll({
        height: '207px',
		<?php
		if($current_language_db_prefix == "_ar")
		{
		?>
			position: 'right'
		<?php
		}else{
		?>
			position: 'left'
		<?php
			}
		?>
    });
});
</script>

<div class="articles_recipes float_left">
    	<h1 class="video_header product_color float_left" style="width:100%;">
        	<?php if(((!$display_articles) && (!$display_recipes)) || (($display_articles) && ($display_recipes))){
				echo lang('product_recent_articles_recipes');
			}elseif(!$display_recipes){
			echo lang('product_recent_articles');
			}elseif(!$display_articles){
			echo lang('product_recent_recipes');
			}else{
			echo lang('product_recent_articles_recipes');
			}
			?>
        </h1>
        <div id="tabs">
        <?php if(($display_recipes) && ($display_articles)) {?>
        <div class="category_tab float_left"> 
        	<ul id="list">
            		<li class="active"><a title="<?php echo lang('product_recent_recipes'); ?>" id="link-1"  href="#tab-1" ><?php echo lang('product_recent_recipes'); ?></a></li> | 
                    <li class=""><a title="<?php echo lang('product_recent_articles'); ?>" id="link-2"  href="#tab-2" ><?php echo lang('product_recent_articles'); ?></a></li>
                    
                </ul>
            </div>
            <div class="clear"></div>
        <?php }else{ ?>
        <div class="category_tab" style="height:75px;"></div>
        <?php }?>
            <div class="tab-main-content">
            <?php if(($display_articles) || ($display_recipes)){ ?>
                    <div class="mini-tab-content" id="tab-1">
                    <div id="recipes_content">
                    
                    <div id="recipes_data">
                    <?php
                      
                        if($display_recipes){
                          $last_id = 0;
						  for($i =0; $i<sizeof($display_recipes);$i++):
						  $id = $display_recipes[$i]['recipes_ID'];
                          $title = $display_recipes[$i]['recipes_title'.$current_language_db_prefix];
                          $desc = $this->common->limit_text($display_recipes[$i]['recipes_directions'.$current_language_db_prefix],130);	
						  $image_src = $this->config->item('recipes_img_link').$this->config->item('image_prefix').$display_recipes[$i]['images_src'];
                          $url = site_url('best_cook/delicious_recipes/'.generateSeotitle($id,$title).'') ;
						  $last_id = $id;
                          ?>
                          <div class="product_article display_recipes" id="<?php echo $id; ?>">
                          <a class="float_left" href="<?php echo $url; ?>" title="<?php echo $title ?>">
                        	<img alt="<?php echo $title ?>" title="<?php echo $title ?>" style="margin:7px; border:none;" width="120" height="85" src="<?php echo $image_src; ?>" class="float_left" />
                            <h3 title="<?php echo $title ?>" style="padding-top:2px; font-weight:bold; width:345px;" class="float_left"><?php echo $title ?></h3>
                            <p class="float_left" style="white-space:normal; width:350px; color:#666;"><?php echo $desc; ?> ... </p>
                          </a>
                        </div>
                        <div style="width:490px;"><hr /></div>
                          <?php
                          
                          endfor;
						}
                          ?>
                          </div>
                          
                          </div>
                          
                         </div>
                  <div class="mini-tab-content" id="tab-2">
                  <div id="articles_content">
                          <?php
                        if($display_articles){
                          for($i =0; $i<sizeof($display_articles);$i++):
						  $id = $display_articles[$i]['articles_ID'];
                          $title = $display_articles[$i]['articles_title'.$current_language_db_prefix];
						  $desc = $this->common->limit_text($display_articles[$i]['articles_brief'.$current_language_db_prefix],130);	
                          $image_src = $this->config->item('articles_img_link').$this->config->item('image_prefix').$display_articles[$i]['images_src'];
                          $url = site_url('best_me/inner_articles/'.generateSeotitle($id,$title).'') ;
                          ?>
                          <div class="product_article">
                          <a class="float_left" href="<?php echo $url; ?>">
                        	<img style="margin:7px;border:none;" width="120" height="85" src="<?php echo $image_src; ?>" class="float_left" />
                            <h3 style="padding-top:2px;font-weight:bold; width:345px;" class="float_left"><?php echo $title ?></h3>
                            <p class="float_left" style="white-space:normal; width:350px;color:#666;"><?php echo $desc; ?> ... </p>
                          </a>
                        </div>
                        <hr/>
                          <?php
                          endfor;
                        }
						
						?>  
                    </div>
                  </div>
                  <?php
                  }else{
          				?>
                        <div class="mini-tab-content">
                        	<h2 style="margin-right:35px;" class="thanks_message product_color"><?php echo lang('product_not_available_recipes_articles'); ?></h2>
                        </div>
         			 <?php
     					 }
     					 ?> 
                  
                </div>
            </div>
                    
        
        
    </div>
<?php if((!$display_recipes) && ($display_articles)): ?>
<script>
$("#tab-1").hide();
</script>
<?php endif; ?>