<style>
#namo_wa_tanshi2a_feature
{ 
	width: 400px;
	padding-right: 210px;
	position: relative;
	height: 203px;
	overflow: hidden;
}
#namo_wa_tanshi2a_feature ul.ui-tabs-nav
{ 
	position: absolute;
	top: 0;
	right: 0;
	list-style: none;
	padding: 0;
	margin: 0;
	width: 262px;
	height: 203px;
	z-index:9999;
}
#namo_wa_tanshi2a_feature ul.ui-tabs-nav li
{ 
	padding:1px 0; 
	padding-left:14px;  
	font-size:12px; 
	color:#666;
	background-color:#FFF;
	margin:2px 3px;
}


#namo_wa_tanshi2a_feature ul.ui-tabs-nav li img
{ 
	float:left; margin:2px 5px; 
	padding:2px; 

}
#namo_wa_tanshi2a_feature ul.ui-tabs-nav li span
{ 
	font-size:11px;  
	line-height:18px; 
}
#namo_wa_tanshi2a_feature li.ui-tabs-nav-item a
{ 
	display: block;
	height: 46px;
	text-decoration: none;
	color: #000;
	line-height: 9px;
	outline: none;

}
#namo_wa_tanshi2a_feature li.ui-tabs-nav-item a:hover
{ 
	/*background:#f2f2f2; */
}

#namo_wa_tanshi2a_feature ul.ui-tabs-nav li.ui-tabs-selected , #namo_wa_tanshi2a_feature ul.ui-tabs-nav li.ui-tabs-active 
{
	background: url('<?php echo base_url(); ?>images/selected-item.png') top left no-repeat;
	position: relative;
	left: -19PX;
}


#namo_wa_tanshi2a_feature .ui-tabs-panel .info{ 
	position:absolute; 
	bottom:0; left:0; 
	height:70px; 
	background: url('<?php echo base_url(); ?>images/transparent-bg.png');
	width:337px; 
}
#namo_wa_tanshi2a_feature ul.ui-tabs-nav li.ui-tabs-selected a, #namo_wa_tanshi2a_feature ul.ui-tabs-nav li.ui-tabs-active a
{ 
	/*background:#ccc; */
}
#namo_wa_tanshi2a_feature .ui-tabs-panel
{ 
	width: 362px;
	height: 203px;
	background: #ebebeb;
	position: relative;
}

#namo_wa_tanshi2a_feature .ui-tabs-panel .info a.hideshow{
	position:absolute; font-size:11px; font-family:Verdana; color:#f0f0f0; right:10px; top:-20px; line-height:20px; margin:0; outline:none; background:#333;
}
#namo_wa_tanshi2a_feature .info h2{ 
	font-size:12px; font-family:Georgia, serif; 
	color:#fff; padding:5px; margin:0; font-weight:normal;
	overflow:hidden; 
}
#namo_wa_tanshi2a_feature .info p{ 
	margin:0 5px; 
	font-family:Verdana; font-size:11px; 
	line-height:15px; color:#f0f0f0;
}
#namo_wa_tanshi2a_feature .info a{ 
	text-decoration:none; 
	color:#fff; 
}
#namo_wa_tanshi2a_feature .info a:hover{ 
	text-decoration:underline; 
}
#namo_wa_tanshi2a_feature .ui-tabs-hide{ 
	display:none; 
}

/*************************/
#feat_list_el_abwan
{
	width: 159px;
	padding-right: 226px;
	height: 173px;
}
#feat_list_el_abwan ul.ui-tabs-nav
{ 
	width: 172px;
	height: 164px;
}
#feat_list_el_abwan .ui-tabs-panel
{
	height: 170px;
	position: relative;
	left: 157px;
	width: 227px;
}
#feat_list_el_abwan .border_fix_for_tab 
{
	border-width: 2px;
	border-style: solid;
	border-right: none;
	position: absolute;
	width: 152px;
	height: 164px;
	top: 5px;
}
#feat_list_el_abwan .ui-tabs-panel .title_wrapper 
{
	position: absolute;
	width: 98%;
	bottom: 7px;
}
#feat_list_el_abwan li.ui-tabs-nav-item a 
{
	display: block;
	height: 40px;
	text-decoration: none;
	color: #333;
	line-height: 26px;
	outline: none;
	width: 164px;
	border-bottom-style: dashed;
	border-bottom-width: 2px;
}
#feat_list_el_abwan .panel_wrapper{ width:235px;}
#feat_list_el_abwan .image{ width:235px; height:170px;}
#feat_list_el_abwan .image img{ width:235px; height:170px;}
/*************************/

.section_title_right_small
{
	position: relative;
    width: 22%;
    height: 30px;
}
.section_title_left_small
{
	position: relative;
    width: 71%;
    height: 30px;
}
</style>
<script>
$(document).ready(function(e) {
    $("#namo_wa_tanshi2a_feature").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
});
</script>
<div class="inner_title_wrapper">
    <div class="sections_wrapper_margin">
    <h1 class="<?php echo $current_section_color; ?>" style="font-size:20px;">نمو و تنشئة طفلي</h1>
    </div>
</div>

<div class="thick_line <?php echo $current_section_background_color; ?>" ></div>

<div class="white_background_color" style="height:210px;">
<div class="global_sperator_height" style="width:100%"></div>


 <div class="float_left" style="width:610px; height:203px;">

<div id="namo_wa_tanshi2a_feature">
      <ul class="ui-tabs-nav <?php echo $current_section_background_color; ?>">
       <?php
  		unset($list);
        $list = $this->sectionsmodel->get_children_sections(64 , 'articles');

        for($i=0; $i < sizeof($list) ; $i++):

        //Get Image 
        $image_src = $this->sectionsmodel->get_section_image($list[$i]['sub_sections_ID']) ;
        if($list[$i]['sub_sections_image'] == "0" )
        {
            $image_src = "http://cdn.pimg.co/p/70x60/858652/fff/img.png";
        }
        else
        {
            $image_src = base_url()."uploads/sections/".$image_src;
        }
        
        ?>

        <li class="ui-tabs-nav-item" id="nav-fragment-<?php  echo ($i+1);?>">
        	<?php /*?><div class="arrow"><img src="<?php echo base_url(); ?>images/selected-item.png" /></div><?php */?>
            <a href="#fragment-<?php echo ($i+1);?>">
                <h2 class="float_left" style="font-size: 13px;padding: 20px 5px;"><?php echo $list[$i]['sub_sections_name'.$current_language_db_prefix] ?></h2>
                 
            </a>
        </li>
        <?php
        endfor;
        ?>
      
      </ul> 

		<?php 
        
        $articles_list = $this->sectionsmodel->get_children_sections(62 , 'articles');
        for($i=0; $i < sizeof($list) ; $i++):
        
       $featured_articles = $this->articlesmodel->get_most_read_articles(2 , $articles_list[$i]['sub_sections_ID']);

        ?>
        <div id="fragment-<?php echo ($i+1);?>" class="ui-tabs-panel" style="">
            <ul>
           <?php
            $image_url = "https://www.mynestle.com.eg/images/Articles/";
			if(empty($featured_articles))
		echo '<p style="padding:15px; text-align:center">لا يوجد مقالات في هذا القسم</p>';
         for($j=0; $j < sizeof($featured_articles) ; $j++):
               $id = $featured_articles[$j]['articles_ID'];
               $title = $featured_articles[$j]['articles_title'.$current_language_db_prefix];
               $desc = $featured_articles[$j]['articles_brief'.$current_language_db_prefix];
               $brief = substr(strip_tags($desc), 0, 150). (strlen(strip_tags($desc)) > 150?'...':'');
               $image  = $image_url.$featured_articles[$j]['images_src'];
               $url = site_url($this->router->class."/inner_articles/".$id);

            ?>
                <li style=" width:337px; height:90px;">
                    <div class="image float_left" style="padding:5px"><a href="<?php echo $url ?>"><img src="<?php echo $image; ?>" width="83" height="70" /></a></div>
                    <a href="<?php echo $url ?>" >
                    <h3 class="dark_gray" style="white-space:normal;"><?php echo mb_substr($title,0,30,"utf-8"); ?></h3>
                    </a>
                    <p style="white-space:normal;"><?php  echo mb_substr($brief,0,40,"utf-8");?></p>
                    <a href="<?php echo $url;?>" class="readmore <?php  echo $current_section_color  ?> float_right" style="padding:5px"><?php echo lang('globals_more');?></a>

                </li> 
                <div class="clear"></div>
                
            <?
            endfor;
            ?>
          </ul>
             
        </div>
        <?php
        endfor;
        ?>

	</div>

</div>
        
        
<div  class="float_right" style="width:385px; height:210px;">

<div class="section_title_right_small float_left <?php echo $current_section_background_color; ?>"><div class="skew_right white_color <?php echo $current_section_background_color; ?>"><h3>الابوان</h3></div></div>
<div class="section_title_left_small float_right <?php echo $current_section_background_color; ?>"><div class="skew_left white_color <?php echo $current_section_background_color; ?>"><h3><small>كل ما تحتاجين معرفته عن العناية بطفلك</small></h3></div></div>


<?php
$this->widgets->generate_tab_lists("feat_list_el_abwan",84,$current_language_db_prefix,$current_section_border_color,$current_section_borderbottom_color);
?>


</div><!-- End of float_right -->

    
    
    
<div class="clear"></div>
</div><!--end of namo wa tanshi2a -->


<div class="clear"></div>

<div class="global_sperator_height" style="width:100%"></div>

