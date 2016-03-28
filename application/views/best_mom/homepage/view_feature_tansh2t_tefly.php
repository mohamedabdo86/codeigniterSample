<?php

$id_tag_string = 'feat_list_tansh2t_tefly';
$subsection_id = '64';

?>

<style>
.feat_lists_tansh2t_teflak
{ 
	position: relative;
	height: 300px;
	overflow: hidden;
}
.feat_lists_tansh2t_teflak ul.ui-tabs-nav
{ 
	position: absolute;
	right: 6px;
	top: 7px;
	list-style: none;
	padding: 0;
	margin: 0;
	width: 212px;
	height: 291px;
	overflow: auto;
	overflow-x: hidden;
	z-index: 999;
}

.feat_lists_tansh2t_teflak ul.ui-tabs-nav li
{ 
	 
	padding-left:28px;  
	font-size:12px; 
	color:#666; 
}
.feat_lists_tansh2t_teflak ul.ui-tabs-nav li img
{ 
	float:left; 
	margin:2px 5px; 
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	border: 1px solid #E0E0E0;

}
.feat_lists_tansh2t_teflak ul.ui-tabs-nav li span
{ 
	font-size:11px;  
	line-height:18px; 
}
.feat_lists_tansh2t_teflak li.ui-tabs-nav-item a 
{
	display: block;
	height: 71px;
	text-decoration: none;
	color: #333;
	line-height: 56px;
	outline: none;
	width: 185px;
	border-bottom-style: dashed;
	border-bottom-width: 2px;
}
.feat_lists_tansh2t_teflak li.ui-tabs-nav-item a h2
{
	padding:6px 4px;
	font-size:13px;
}
.feat_lists_tansh2t_teflak li.ui-tabs-nav-item:last-child a
{
	border-bottom: none;
}
.feat_lists_tansh2t_teflak li.ui-tabs-nav-item a:hover
{ 
	/*background:#f2f2f2; */
}
.feat_lists_tansh2t_teflak li.ui-tabs-selected, .feat_lists_tansh2t_teflak li.ui-tabs-active
{ 
	background:url('<?php echo base_url(); ?>images/bestmom/selected-item.png') top left no-repeat;
}
.feat_lists_tansh2t_teflak .ui-tabs-panel .info{ 
	position:absolute; 
	bottom:0; left:0; 
	height:70px; 
	background: url('<?php echo base_url(); ?>images/transparent-bg.png');
	width:412px; 
}
.panel_wrapper .image img
{
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	border: 1px solid #E0E0E0;
}
.panel_wrapper .title_wrapper
{
	width:166px;
}
.feat_lists_tansh2t_teflak .ui-tabs-panel
{ 
	width: 782px;
	height: 300px;
	position: relative;
}

.feat_lists_tansh2t_teflak .ui-tabs-panel .info a.hideshow{
	position:absolute; font-size:11px; font-family:Verdana; color:#f0f0f0; right:10px; top:-20px; line-height:20px; margin:0; outline:none; background:#333;
}
.feat_lists_tansh2t_teflak .info h2{ 
	font-size:1.2em; font-family:Georgia, serif; 
	color:#fff; padding:5px; margin:0; font-weight:normal;
	overflow:hidden; 
}
.feat_lists_tansh2t_teflak .info p{ 
	margin:0 5px; 
	font-family:Verdana; font-size:11px; 
	line-height:15px; color:#f0f0f0;
}
.feat_lists_tansh2t_teflak .info a{ 
	text-decoration:none; 
	color:#fff; 
}
.feat_lists_tansh2t_teflak .info a:hover{ 
	text-decoration:underline; 
}
.feat_lists_tansh2t_teflak .ui-tabs-hide{ 
	display:none; 
}
.feat_lists_tansh2t_teflak .border_fix_for_tab 
{
	border-width: 2px;
	border-style: solid;
	position: absolute;
	width: 194px;
	height: 291px;
	top: 5px;
	right: 0;
}
.feat_lists_tansh2t_teflak li.ui-tabs-selected, .feat_lists_tansh2t_teflak li.ui-tabs-active
{ 
	background:url('<?php echo base_url(); ?>images/bestmom/selected-item2.png') top left no-repeat;
}
/*.abwan_subsection li a.active{color:#cf9f0b;}*/
.english .abwan_plus
{
	height: 26px !important;
	margin: 3px !important;
}
.english .abwan_plus_ajax
{
	height: 26px !important;
	margin: 6px !important;
}
</style>
<script>
$(document).ready(function(e) {
	
    $('.abwan_id').click(function(e) {
        var current_id =  $(this).data('sub-section-id');
		
		//alert(current_id);
		$('ul.abwan_subsection li').removeClass('best_mom_color');
		$(this).parent().addClass('best_mom_color');
	
		//$(this).parent().toggleClass("active");
		//$(this).toggleClass("active");
		
		 $.ajax({
            url : "<?php echo site_url($this->router->class."/featured_abwan"); ?>",
            data : {current_id : current_id},
            type: "POST",
			cache: false,
		  	dataType: "json",
          	success : function(success_array){
			   $('#fragment-1 .container_article').html(success_array.articles) ;
                //$(comment).hide().insertBefore('#insertbeforMe').slideDown('slow');
            }
        })
		return false;
    });
});
</script>

<div class="feat_lists_tansh2t_teflak" id="<?php echo $id_tag_string ?>">
		
		<div class="border_fix_for_tab <?php echo $current_section_border_color ?> " >
        </div>
        
      <ul class="ui-tabs-nav">
       <?php
  		unset($list);
        $list = $this->sectionsmodel->get_children_sections($subsection_id , 'articles');
	
	// get the alignment of the list based on the current language
	$language_based_align = $current_language == 'arabic' ? 'right' : 'left';

        for($i=0; $i < sizeof($list) ; $i++):

        ?>

        <li class="ui-tabs-nav-item" id="nav-fragment-<?php echo ($i+1);?>">
            <a href="#fragment-<?php echo ($i+1);?>" class="<?php echo $current_section_borderbottom_color;?>">
                <h2 class=" black_color" style="float:<?php echo $language_based_align; ?>;" ><?php echo $list[$i]['sub_sections_name'.$current_language_db_prefix] ?></h2>
            </a>
        </li>

        <?php
        endfor;
        ?>
      
      </ul>

		<?php 
		
        $articles_list = $this->sectionsmodel->get_children_sections($subsection_id , 'articles');
        for($i=0; $i < sizeof($list) ; $i++):

        ?>
        <div id="fragment-<?php echo ($i+1);?>" class="ui-tabs-panel" style="">

            <?php
			if($list[$i]['sub_sections_ID'] == '84')
			{
				$submenu = $this->sectionsmodel->get_children_sections($list[$i]['sub_sections_ID'] , 'articles');
				echo '<div class="sunbmenu" style="width: 777px;height: 30px;background-color: #FFE6B0;margin-bottom: 5px;margin-top:5px;">';
				echo '<ul class="abwan_subsection">';
				for($k=0; $k < sizeof($submenu) ; $k++):
	
				echo '<li style="float:right">
						<a class="abwan_id" data-sub-section-id="'.$submenu[$k]['sub_sections_ID'].'" data-selected="0"><h2 style="font-size: 13px;padding: 0px 10px;cursor: pointer;margin: 3px;border-radius: 5px;background-color: white;line-height: 24px;">'.$submenu[$k]['sub_sections_name'.$current_language_db_prefix].'</h2></a>
					  </li>';
				
				endfor;
				echo '</ul>';
				echo '</div>';
				
			}
			else
			{
				echo '<div class="sunbmenu" style="width: 777px;height: 30px;"></div>';
			}
			
			if($list[$i]['sub_sections_ID'] == '84')
			{
				$featured_articles = $this->articlesmodel->get_most_read_articles(4 , 87);
				$current_subsections_ID = $articles_list[$i]['sub_sections_ID'];
			}
			else
			{
         		$featured_articles = $this->articlesmodel->get_most_read_articles(4 , $articles_list[$i]['sub_sections_ID']);
				$current_subsections_ID = $articles_list[$i]['sub_sections_ID'];
			}
			echo '<div class="container_article" style="height: 268px; padding:0 0 0 10px;">';
            $image_url = $this->config->item('articles_img_link');
			if( empty($featured_articles) )
			echo '<p style="padding:15px; text-align:center;top:50px;position: absolute;right: 30%;">'.lang('globals_No_articles_in_this_section').'</p>';

            for($j=0; $j < sizeof($featured_articles) ; $j++):
                $id = $featured_articles[$j]['articles_ID'];
                $title = $featured_articles[$j]['articles_title'.$current_language_db_prefix];
                $desc = $featured_articles[$j]['articles_brief'.$current_language_db_prefix];
				$brief = $this->common->limit_text($desc, 150);
                $image  = $image_url.$this->config->item('image_prefix').$featured_articles[$j]['images_src'];
                $url = site_url($this->router->class."/inner_articles/".generateSeotitle($id,$title));
				$section_url = site_url($this->router->class."/section/".$current_subsections_ID);

            ?>

                <div class="panel_wrapper " style="margin:0 5px; float:right;" >
                    <div class="image float_left" style="position:relative; float:right;">
                    	<a href="<?php echo $url ?>" title="<?php echo $title ;?>"><img src="<?php echo $image; ?>"  alt="<?php echo $title ;?>" width="200" height="120" /></a>
                    </div>    
                    <div class="title_wrapper float_right" >
                         <a href="<?php echo $url ?>"><h3 style="padding: 5px;"><?php echo $title ?></h3></a>
                    </div>
                    <div class="clear"></div>
                </div>                
            <?
            endfor;
			if($list[$i]['sub_sections_ID'] != '84')
			{
			?>
            <div style="float:left;" style="width:50px;	height:50px">
                    <div class="<?php echo $current_section_borderbottom_color ?> " style="width: 0;height: 0;text-indent: -9999px;border-bottom-width: 40px;border-bottom-style: solid;z-index: 999;position: absolute;bottom: 0px;left: 0px;right: inherit;border-left: none;border-right: 50px solid transparent;"></div>
                    <div class=" white_color abwan_plus" style="right: inherit;left: 0px;height: 33px;position: absolute;bottom: 0px;width: 20px;font-size: 22px;z-index: 999;"><a href="<?php echo $section_url ?>">+</a></div>
                    <div class="clear"></div>
            </div>
            <?php
			}
			?>
            
                <?php /*?>
			Bermawy 27-11-2014
				<div style="float:left;" style="width:50px;	height:50px">
                    <div class="<?php echo $current_section_borderbottom_color ?>" style="width: 0;height: 0;text-indent: -9999px;border-bottom-width: 40px;border-bottom-style: solid;z-index: 999;position: absolute;bottom: 0px;left: 0px;right: inherit;border-left: none;border-right: 50px solid transparent; margin-bottom:<?php if($list[$i]['sub_sections_ID'] == '84') echo "5px" ;?>"></div>
                    <div class=" white_color" style="right: inherit;left: 0px;height: 33px;position: absolute;bottom: 0px;width: 20px;font-size: 22px;z-index: 999; margin-bottom:<?php if($list[$i]['sub_sections_ID'] == '84') echo "3px" ;?>"><a href="<?php echo $section_url ?>">+</a></div>
                    <div class="clear"></div>
                </div><?php */?>
            
            
            </div><!--End of container article--> 
        </div>
        <?php
        endfor;
        ?>

	</div>

