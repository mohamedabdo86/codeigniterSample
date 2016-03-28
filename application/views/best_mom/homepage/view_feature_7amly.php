<style>
.featured
{ 
	width: 420px;
	padding-right: 250px;
	position: relative;
	height: 200px;
	overflow: hidden;
}
.featured ul.ui-tabs-nav
{ 
	position: absolute;
	top: -3px;
	left: 393px;
	list-style: none;
	padding: 0;
	margin: 0;
	width: 237px;
	height: 200px;
	z-index: 999;
}
body.english .featured ul.ui-tabs-nav li
{ 

	font-size: 12px;
	color: #666;
	padding: 0px 3px 0px 18px;
}

body.arabic .featured ul.ui-tabs-nav li
{ 

	font-size: 12px;
	color: #666;
	padding: 0px 3px 0px 18px;
}

/*
.featured ul.ui-tabs-nav li h2{font-size:12px !important;}*/
.featured ul.ui-tabs-nav li img
{ 
	/*padding:2px; */
	height:40px;

}
.featured ul.ui-tabs-nav li span
{ 
	font-size:11px;  
	line-height:18px; 
}
.featured li.ui-tabs-nav-item a
{ 
	display:block; 
	height:60px; 
	height:40px; 
	text-decoration:none;
	color:#333;  
	line-height:20px; 
	outline:none;
	border-bottom: 1px dashed #fff;
}

body.arabic li.ui-tabs-nav-item a
{
	line-height: 32px;
}

.featured li.ui-tabs-nav-item:last-child a
{
	border-bottom: none;
}
.featured li.ui-tabs-nav-item a:hover
{ 
	/*background:#f2f2f2; */
}
.featured li.ui-tabs-selected, .featured li.ui-tabs-active
{ 
	background:url('<?php echo base_url(); ?>images/bestmom/selected-item.png') top left no-repeat;
}
.featured .ui-tabs-panel .info{ 
	position:absolute; 
	bottom:0; left:0; 
	height:70px; 
	height:40px; 
	background: url('<?php echo base_url(); ?>images/transparent-bg.png');
	width:412px; 
}
.featured ul.ui-tabs-nav li.ui-tabs-selected a, .featured ul.ui-tabs-nav li.ui-tabs-active a
{ 
	/*background:#ccc; */
}
.featured .ui-tabs-panel
{ 
	width:413px;
	height:200px; 
	position:relative;
	margin-top:-3px;
}

.featured .ui-tabs-panel .info a.hideshow{
	position:absolute; font-size:11px; font-family:Verdana; color:#f0f0f0; right:10px; top:-20px; line-height:20px; margin:0; outline:none; background:#333;
}
.featured .info h2{ 
	font-size:1.2em; font-family:Georgia, serif; 
	color:#fff; padding:5px; margin:0; font-weight:normal;
	overflow:hidden; 
}
.featured .info p{ 
	margin:0 5px; 
	font-family:Verdana; font-size:11px; 
	line-height:15px; color:#f0f0f0;
}
.featured .info a{ 
	text-decoration:none; 
	color:#fff; 
}
.featured .info a:hover{ 
	text-decoration:underline; 
}
.featured .ui-tabs-hide{ 
	display:none; 
}
.image img
{
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	border: 1px solid #E0E0E0;
}
body.arabic .best_mom_section_title
{
	font-size: 11px;
	padding: 0px 0px 0px 5px;
	font-weight: bold;
	padding: 0px 5px 0px 10px;
}
body.english .best_mom_section_title
{
	font-size: 11px;
	padding: 0px 0px 0px 5px;
	font-weight: bold;
	padding: 10px 0px 0px 5px;
}
</style>

<div class="featured">
      <ul class="ui-tabs-nav <?php //echo $current_section_background_color; ?>">
       	<div style="background-color: #ffc81b;width: 221px;height: 295px;position: absolute;z-index: -9;right: 0;" ></div>

	   <?php
  
        $list = $this->sectionsmodel->get_children_sections(62 , 'articles');

        for($i=0; $i < sizeof($list) ; $i++):

        //Get Image 
        $image_src = $this->sectionsmodel->get_section_image($list[$i]['sub_sections_ID']) ;

        $image_src = base_url()."uploads/sections/".$image_src;
        
        
        ?>

        <li class="ui-tabs-nav-item" id="nav-fragment-<?php echo ($i+1);?>">
            <a href="#fragment-<?php echo ($i+1);?>">
                <h2 class="float_left white_color best_mom_section_title" ><?php echo $list[$i]['sub_sections_name'.$current_language_db_prefix] ?></h2>
                <img style="border:none" class="float_right" src="<?php echo $image_src; ?>" height="30" />
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
        <div id="fragment-<?php echo ($i+1);?>" class="ui-tabs-panel white_background_color" style="">
            <ul style="margin-top: 3px;" >
            <?php
            $image_url = $this->config->item('articles_img_link');
			if(empty($featured_articles))
			echo '<p style="padding:15px; text-align:center"> '.lang('globals_No_articles_in_this_section').'</p>';
            for($j=0; $j < sizeof($featured_articles) ; $j++):
                $id = $featured_articles[$j]['articles_ID'];
                $title = $featured_articles[$j]['articles_title'.$current_language_db_prefix];
                $desc = $featured_articles[$j]['articles_brief'.$current_language_db_prefix];
                $brief = $this->common->limit_text($desc,85);
				$image =  $featured_articles[$j]['sub_sections_image'] == "0" ?  base_url()."images/image_not_available".$current_language_db_prefix.".png"  : $image_url.$this->config->item('image_prefix').$featured_articles[$j]['images_src'];

                $url = site_url($this->router->class."/inner_articles/".generateSeotitle($id ,$title));
				
				$short_title = $this->common->limit_text($title,35);

            ?>
                <li style="width: 410px;height:100px;">
                    <div class="image float_left" style="padding:5px; height:88px;"><a href="<?php echo $url ?>"m title="<?php  echo $title;?>"><img src="<?php echo $image; ?>" width="107" height="85" alt="<?php  echo $title;?>" /></a></div>
                    <div class="float_right" style="width: 290px;">
                        <a href="<?php echo $url ?>" title="<?php  echo $title;?>">
                        <h3 class="dark_gray" style="white-space:normal;"><?php echo $short_title; ?></h3>
                        </a>
                        <p style="white-space:normal;"><?php echo $brief;?></p>
                        <a href="<?php echo $url;?>" class="readmore float_right <?php echo $current_section_color  ?>" style="padding:0 5px;"><?php echo lang('globals_more');?></a>
					</div>
                    <div class="clear"></div>
                </li>
                
            <?
            endfor;
            ?>
            </ul>
             
        </div>
        <?php
        endfor;
        ?>

	</div>
