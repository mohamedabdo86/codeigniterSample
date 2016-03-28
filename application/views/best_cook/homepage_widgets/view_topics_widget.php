<style>
.recent_items_list_wrapper
{
	width:100%;
	height:auto;
	position:relative;
}
.recent_items_list_wrapper .recentitem_prev,.recentitem_next
{
	position:absolute;
	top:170px;
}
.recent_items_list_wrapper .recentitem_prev{ right:7px; }
.recent_items_list_wrapper .recentitem_next{ left:7px; }
.recent_items_list_wrapper .recent_items_list
{
	width:935px;
	margin:0px auto;
	padding:10px 0px;
}
.recent_items_list_wrapper .recent_items_list li
{
	width:305px;
	height:318px !important;
	margin:10px 3px;
}
.recent_items_list_wrapper .recent_items_list li .item_wrapper
{
	width:290px;
	height:330px;
}
.recent_items_list_wrapper .recent_items_list li .item_wrapper .title_wrapper
{
	width:305px;
	height:45px;
	background:#e82327;
	position:relative;
}
.recent_items_list_wrapper .recent_items_list li .item_wrapper .title_wrapper .title_text
{
	padding:10px;
	color:#FFF;
	line-height: 23px;
	font-weight: bold;
}
.recent_items_list_wrapper .recent_items_list li .item_wrapper .title_wrapper .shadow
{
	position:absolute;
	bottom:-9px;
	right:0px;
	width: 0px;
	height: 0px;
	border-style: solid;
	border-width: 9px 15px 0 0;
	border-color: #650c0e transparent transparent transparent;
	
}
.recent_items_list_wrapper .recent_items_list li .item_wrapper .image_wrapper
{
	width:100%;
	height:225px;
	position:relative;
	
}
.recent_items_list_wrapper .recent_items_list li .item_wrapper .image_wrapper img 
{ 	
	width:100%; 
	height:225px;
	/*-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	border: 1px solid #a7a7a7;*/
}
.recent_items_list_wrapper .recent_items_list li .item_wrapper .image_wrapper .topic_wrapper
{
	width:100%;
	height:auto;
	position:absolute;
	bottom:0px;	
	color:#5d5d5d;
	
	opacity:0;
	bottom:-99px;
	-webkit-transition: all 100ms ease-in-out;
	-moz-transition: all 100ms ease-in-out;
	-o-transition: all 100ms ease-in-out;
	transition: all 100ms ease-in-out;
}
.recent_items_list_wrapper .recent_items_list li:hover .item_wrapper .image_wrapper .topic_wrapper
{
	width:100%;
	height:auto;
	position:absolute;
	bottom:0px;	
	color:#5d5d5d;
	
	opacity:1;
	bottom:0px;
	-webkit-transition: all 100ms ease-in-out;
	-moz-transition: all 100ms ease-in-out;
	-o-transition: all 100ms ease-in-out;
	transition: all 100ms ease-in-out;
}
.recent_items_list_wrapper .recent_items_list li .item_wrapper .image_wrapper .topic_wrapper h3
{
	margin:5px 10px;
	font-weight:bold;		
}
.recent_items_list_wrapper .recent_items_list li .item_wrapper .image_wrapper .topic_wrapper p
{
	margin:5px 10px;
	white-space:normal;
}
.arabic .recent_items_list_wrapper .recent_items_list li .item_wrapper .image_wrapper .topic_wrapper p
{
	direction:rtl;
}
.recent_items_list_wrapper .recent_items_list li .item_wrapper .share_wrapper
{
	width:100%;
	height:40px;
	background:#FFF;
	margin-top:3px;
	color:#5d5d5d;
	line-height: 40px;
	-moz-box-shadow: 1px 1px 2px #8d8d88;
	-webkit-box-shadow: 1px 1px 2px #8d8d88;
	box-shadow: 1px 1px 2px #8d8d88;
	-webkit-border-bottom-right-radius: 10px;
	-moz-border-radius-bottomright: 10px;
	border-bottom-right-radius: 10px;
}
.arabic .recent_items_list_wrapper .recent_items_list li .item_wrapper .share_wrapper{direction:rtl;}
.recent_items_list_wrapper .recent_items_list li .item_wrapper .share_wrapper .triangle
{
	bottom:-40px;
}
.arabic .recent_items_list_wrapper .recent_items_list li .item_wrapper .share_wrapper .plus_sign
{
	bottom:-40px;
}

.english .recent_items_list_wrapper .recent_items_list li .item_wrapper .share_wrapper .plus_sign
{
bottom: -45px;
left: -23px;
}
.recentitem_next.disabled , .recentitem_prev.disabled
{
	visibility:hidden;
}
</style>
<div class="white_background_color top_radius_5 height_40">
    <div class="sections_wrapper_margin global_sperator_margin_top ">
    <h1 class="best_cook_color"><?php echo lang("bestcook_recent_recipes"); ?></h1>
    </div>
</div>
<div class="thick_line best_cook_background_color"></div>

<div class="recent_items_list_wrapper global_background bottom_radius_5">

    <div class="sections_wrapper_margin" >
    
        <a class="recentitem_prev float_left"><img class="" width="20" src="<?php echo base_url()."images/bestcook/right_arrow_medium.png" ?>" /></a>
        <a class="recentitem_next float_right"><img class="" width="20" src="<?php echo base_url()."images/bestcook/left_arrow_medium.png" ?>" /></a>
        <div class="recent_items_list">
        <ul>
        <?php
		for($i=0 ; $i < sizeof($display_topics) ; $i++):
		
		$topic_title =  $display_topics[$i]['inseason_recipies_title'.$current_language_db_prefix];
		$topic_url = site_url("best_cook/recipes_list/".$display_topics[$i]['inseason_recipies_ID']);
		
		//Get Recipes
		list ( $display_recipes , $total_rows) = $this->recipesmodel->get_topics_list_of_recipes( $display_topics[$i]['inseason_recipies_ID'],1,0 );
		
		if(empty($display_recipes)) continue;
		
		$title = $display_recipes [0]['recipes_title'.$current_language_db_prefix];
		$directions = $display_recipes[0]['recipes_directions'.$current_language_db_prefix];
		$image = $this->config->item('recipes_img_link').$display_recipes[0]['images_src'];
		$url  = site_url('best_cook/delicious_recipes/'.generateSeotitle($display_recipes[0]['recipes_ID'] , $title)  );
		
		?>
        	<li>
            	 <div class="item_wrapper">

    			<div class="title_wrapper">
    				<div class="title_text"> <a href="<?php echo $topic_url; ?>"><?php echo $topic_title; ?></a></div>
    		        <div class="shadow"></div>
    			</div>
    
    		<div class="image_wrapper">
    			<a href="<?php echo $url; ?>" title="<?php  echo $title;?>" ><img style="border:none" src="<?php echo $image ?>" alt="<?php echo $title;?>" /></a>
                
                <div class="topic_wrapper global_background">
                	<h3><a href="<?php echo $url; ?>"><?php echo $title; ?></a></h3>
                  <a href="<?php echo $url; ?>">  <p style="width:270px;font-size:11px;"><?php echo mb_substr(strip_tags($directions),0,100,'utf-8'); ?></p></a>
                </div><!-- ENd of topic_wrapper -->
    		</div><!-- End of image_wrapper -->
            
            <div class="share_wrapper">
            	<div class="float_left" style="width:10px; height:40px;"></div>
            	<div class="float_left"><a href="<?php echo $topic_url; ?>"><?php echo lang('bestcook_recipes_related'); ?> (<?php echo $total_rows ?>) </a></div>
                
                <div class="float_right" style="position:relative">
                	<div class="triangle best_cook_borderbottom_color" style="border-bottom-width: 40px;"></div>
					<div class="plus_sign white_color"><a href="<?php echo $topic_url; ?>">+</a></div>
                    
                    <div class="clear"></div>
                </div>
                
                <div class="clear"></div>
            
            </div><!-- End of share_wrapper -->

</div><!-- End of item_wrapper -->
            
            <div class="clear"></div>
			</li>
        <?php
		endfor;
		?>
            
        </ul>

    </div><!--- End of recent_items_list -->

</div><!-- End of sections_wrapper_margin -->

</div><!-- End of recent_items_list_wrapper -->