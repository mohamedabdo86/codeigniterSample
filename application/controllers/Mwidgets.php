<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mwidgets
{
	function generateproductwidget(){
		?>
     
     
 <div class="swiper-container">

      <div class="swiper-wrapper product-slider-wrapper" style="width:24300px !important">

        <?php
		     $this->CI =& get_instance();
		     $this->CI->load->model('sectionsmodel');
			$get_products_brand = $this->CI->sectionsmodel->get_products_brand();
			 if($get_products_brand){?>
        <?php for($i=0; $i<sizeof($get_products_brand); $i++): 
				$image_src = base_url()."uploads/products_brand/".$get_products_brand[$i]['images_src'];
				$title = $get_products_brand[$i]['products_brand_name'.$current_language_db_prefix];
				$url = site_url("mobile/products/index/".$get_products_brand[$i]['products_brand_ID']);
			?>
        <div class="swiper-slide" style="height:100% !important;">
          <ul style="padding:0;">
            <li style="position:relative; width:100px; margin-top:5px;list-style-type:none;"> <a title="<?php echo $title; ?>" href="<?php echo $url; ?>" rel="external"><img style="border:none;margin-top:-11px;width:90%;" height="100" width="150" class="rounded_border img-responsive" src="<?php echo $image_src; ?>" title="<?php echo $title;?>" alt="<?php echo $title;?>"></a> </li>
          </ul>
        </div>
        <?php endfor; ?>
        <?php }?>
      </div>
  
   <a class="arrow-left product-arrow-mobile" style="float:left;  position: relative;  top: -80px;"> <img src="<?php echo base_url()?>images/bestcook/left_arrow_medium.png"  class="img-responsive" style="width:12px;"/> </a>


     <a class="arrow-right product-arrow-mobile" style="float:right;position: relative;  top: -80px;"> <img src="<?php echo base_url()?>images/bestcook/right_arrow_medium.png"  class="img-responsive" style="width:12px;"/> </a>
      <!-- swiper-wrapper --> 

</div>

   
    <?php
	}
	
	function generaterecipeproductwidget(){
		?>
      
 <div class="swiper-container">
      <div class="swiper-wrapper product-slider-wrapper" style="width:24300px !important">
        <?php
		     $this->CI =& get_instance();
		     $this->CI->load->model('sectionsmodel');
			$get_recipe_products_brand = $this->CI->sectionsmodel->get_recipe_products_brand();
			 if($get_recipe_products_brand){?>
        <?php for($i=0; $i<sizeof($get_recipe_products_brand); $i++): 
				$image_src = base_url()."uploads/products_brand/".$get_recipe_products_brand[$i]['images_src'];
				$title = $get_products_brand[$i]['products_brand_name'.$current_language_db_prefix];
				$url = site_url("mobile/products/index/".$get_recipe_products_brand[$i]['products_brand_ID']);
			?>
        <div class="swiper-slide" style="height:100% !important;">
          <ul style="padding:0;">
            <li style="position:relative; width:100px; margin-top:5px;list-style-type:none;"> <a title="<?php echo $title; ?>" href="<?php echo $url; ?>" rel="external"><img style="border:none;margin-top:-11px;width:90%;" height="100" width="150" class="rounded_border img-responsive" src="<?php echo $image_src; ?>" title="<?php echo $title;?>" alt="<?php echo $title;?>" ></a> </li>
          </ul>
        </div>
        <?php endfor; ?>
        <?php }?>
      </div>
      <!-- swiper-wrapper --> 
         <a class="arrow-left product-arrow-mobile" style="float:left;  position: relative;  top: -80px;"> <img src="<?php echo base_url()?>images/bestcook/left_arrow_medium.png"  class="img-responsive" style="width:12px;"/> </a>
     <a class="arrow-right product-arrow-mobile" style="float:right;position: relative;  top: -80px;"> <img src="<?php echo base_url()?>images/bestcook/right_arrow_medium.png"  class="img-responsive" style="width:12px;"/> </a>
    </div>
    <?php
	}
    //Homepage
    public function generateMainHomepageSection($cat,$sectionTitle,$sectionUrl,$imageSrc,$dataArticles ,$articleTitle)
    {
        $result = '';
        $result = '
                    <div class="row homepage-fullscreen-widget">
                        <div class="' . $cat . ' col-xs-12" >
							<div class="thick-line background-color">&nbsp;</div>
                            <div class="image-holder">
                                <a href="'.$sectionUrl.'"><img src="'.$imageSrc.'" class="img-responsive"  /></a>
                                <div class="title-container background-color">
                                    <h2 class="white-text-color"><a href="'.$sectionUrl.'"  rel="external" data-ajax="false">'.$sectionTitle.'</a></h2>
                                </div><!-- title-container -->
                                <div class="section-icon-wrapper"> 
                                </div><!-- section-icon-wrapper-->
                                <div class="article-title-container">
                                    <h3><a href="'.$sectionUrl.'">'.$articleTitle.'</a></h3>
                                </div><!-- article-title-container -->
                            </div><!-- image-holder -->                             
                        </div><!-- col -->                        
                    </div>
            ';
        return $result;
    }
    //Section Homepage widgets
	
	
	
	
	
	
	public function generateMainHomepageSectionArticles($section_id,$cat,$sectionTitle,$sectionUrl,$imageSrc,$dataArticles ,$articleTitle ,$current_language_db_prefix ,$myIcon_left ,$myIcon_right,$sectionhomepage){
		
		$CI =& get_instance();

		?>
<?php //foreach($dataArticles as $data):?>
<?php for($i=0 ;$i<sizeof($dataArticles); $i++):
       
		$articles_sec_id = $dataArticles[$i]['articles_sections_ID'];
		$articleTitle = $dataArticles[$i]['articles_title'.$current_language_db_prefix];
		$imageSrc = base_url().'uploads/articles/'.$dataArticles[$i]['images_src'];

		?>
<?php endfor; ?>

<div class="homepage-fullscreen-widget mobile-home-page-all-section-widget col-xs-12 col-sm-12 col-md-6 col-lg-6">
  <div class="<?php echo $cat ?>" >
    <div class="thick-line background-color">&nbsp;</div>
    <div class="image-holder"> <a rel="external" href="<?php echo $sectionUrl; ?>"><img src="<?php echo $imageSrc; ?>" class="img-responsive mob_home_img"/> </a>
      <div class="title-container background-color">
        <h2 class="white-text-color"><a rel="external" href="<?php echo $sectionhomepage; ?>"><?php echo $sectionTitle; ?></a></h2>
      </div>
      <!-- title-container --> 
    <a rel="external" href="<?php echo $sectionhomepage; ?>">  <i class="float_right icon_homepage_left"><img src="<?php echo $myIcon_left ?>" /></i> <i class="float_right icon_homepage_right"><img src="<?php echo $myIcon_right ?>" /></i></a>
      <div class="section-icon-wrapper"> </div>
      <!-- section-icon-wrapper-->
      
      <div class="article-title-container">
        <h3><a rel="external" href="<?php echo $sectionUrl; ?>"><?php echo $articleTitle; ?></a></h3>
      </div>
      <!-- article-title-container --> 
    </div>
    <!-- image-holder --> 
  </div>
  <!-- col --> 
</div>
<?php 
		
		
			}

      	public function generateMainHomepageSectionRecipes($section_id,$cat,$sectionTitle,$sectionUrl,$imageSrc,$dataArticles_best_cook,$articleTitle,$current_language_db_prefix ,$myIcon_left ,$myIcon_right,$sectionhomepage){
		
		$CI =& get_instance();

		?>
<?php //foreach($dataArticles as $data):?>
<?php for($i=0 ;$i<sizeof($dataArticles_best_cook); $i++):
        
		
		$recipes_id = $dataArticles_best_cook[$i]['recipes_ID'];
		$articleTitle = $dataArticles_best_cook[$i]['recipes_title'.$current_language_db_prefix];
		$imageSrc = base_url().'uploads/recipes/'.$dataArticles_best_cook[$i]['images_src'];
		
		?>
<?php endfor; ?>
<div class="homepage-fullscreen-widget mobile-home-page-all-section-widget col-xs-12 col-sm-12 col-md-6 col-lg-6">
  <div class="<?php echo $cat ?>" >
    <div class="thick-line background-color">&nbsp;</div>
    <div class="image-holder"> <a rel="external" href="<?php echo $sectionUrl; ?>"><img src="<?php echo $imageSrc; ?>" class="img-responsive mob_home_img"/> </a>
      <div class="title-container background-color">
        <h2 class="white-text-color"><a rel="external" href="<?php echo $sectionhomepage; ?>"><?php echo $sectionTitle; ?></a></h2>
      </div>
      <!-- title-container --> 
     <a rel="external" href="<?php echo $sectionhomepage; ?>"> <i class="float_right icon_homepage_left"><img src="<?php echo $myIcon_left ?>" /></i> <i class="float_right icon_homepage_right"><img src="<?php echo $myIcon_right ?>" /></i></a>
      <div class="section-icon-wrapper"> </div>
      <!-- section-icon-wrapper-->
      <div class="article-title-container">
        <h3><a rel="external" href="<?php echo $sectionUrl; ?>"><?php echo $articleTitle; ?></a></h3>
      </div>
      <!-- article-title-container --> 
    </div>
    <!-- image-holder --> 
  </div>
  <!-- col --> 
</div>
<?php 
		
		
			}

    //Generate the huge background of the section color with its icon 
    public function drawMainSectionHomepageTitle($title, $image , $url = "")
    {
		$hrefLink = $url == "" ? "" : 'href="'.$url.'"';
        $result = '';
        $result = '<div class="main-section-homepage-title-wrapper background-color">
                    <div class="icon-wrapper float_left"><a '.$hrefLink.' rel="external"><img class="img-responsive mobile-section-image" src="' . $image . '"  style="margin-top:-10px;"/></a></div>
                    <div class="float_left v-line"></div>
                    <h1 class="float_left"><a '.$hrefLink.' rel="external">' . $title . '</a></h1>
                    <div class=clear></div>
                   </div>';
        return $result;
    }

    public function drawSubSectionHomepageArticle($title, $image, $articleTitle,$surl = "",$aurl="" ,$num_to_show_md,$num_to_show_sm)
    {
		$shrefLink = $surl == "" ? "" : 'href="'.$surl.'"';
		$ahrefLink = $aurl == "" ? "" : 'href="'.$aurl.'"';
        $result = '';
        $result = '
            
            
                <div class="col-xs-12 col-sm-'.$num_to_show_sm.' col-md-'.$num_to_show_md.' col-lg-'.$num_to_show_md.'">
				<h2 class="text-color" style="padding-top: 15px;"><a rel="external" '.$shrefLink.'>' . $title . '</a></h2>
                    <div class="section-image-wrapper">
				
                        <a rel="external" '.$ahrefLink.'><img src="' . $image . '" alt="' . $articleTitle . '" class="img-responsive full-width img-height2" /></a>
                        <div class="title-wrapper">
                            <h3><a rel="external" '.$ahrefLink.' >' . $articleTitle . '</a></h3>
                        </div>
                    </div><!-- end of section-image-wrapper -->
                </div>                
           
            ';
        return $result;
    }
	
	    public function drawSubSectionHomepageVideoBestCook($title, $image, $articleTitle,$surl = "",$aurl="")
    {
		$shrefLink = $surl == "" ? "" : 'href="'.$surl.'"';
		$ahrefLink = $aurl == "" ? "" : 'href="'.$aurl.'"';
        $result = '';
        $result = '
            <div class="section-title-wrapper">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="text-color"><a '.$shrefLink.' >' . $title . '</a></h2>
                    </div>                
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-image-wrapper">
                        <a '.$ahrefLink.' ><img src="' . $image . '" alt="' . $articleTitle . '" class="img-responsive full-width" /></a>
                        <div class="title-wrapper">
                            <h3><a '.$ahrefLink.' >' . $articleTitle . '</a></h3>
                        </div>
                    </div><!-- end of section-image-wrapper -->
                </div>                
            </div><!-- row -->
            ';
        return $result;
    }
	
	public function drawSubSectionTitleDawn($title, $image)
    {
        $result = '';
        $result = '
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-image-wrapper">
                        <img src="' . $image . '" alt="' . $title . '" class="img-responsive" />
                        <div class="title-wrapper">
                            <h3>' . $title . '</h3>
                        </div>
                    </div><!-- end of section-image-wrapper -->
                </div>                
            </div><!-- row -->
            ';
        return $result;
    }

    public function drawSubSectionBox($title, $image , $url="")
    {
		$hrefLink = $url == "" ? "" : 'href="'.$url.'"';
        $result = '';
        $result = '
            <div class="section-title-wrapper">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="text-color"><a '.$hrefLink.' >' . $title . '</a></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-image-wrapper">
                        <a '.$hrefLink.' ><img src="' . $image . '" alt="' . $title . '" class="img-responsive" /></a>
                    </div><!-- end of section-image-wrapper -->
                </div>
            </div><!-- row -->
            ';
        return $result;
    }
	
	    public function drawSubSectionBoxRecipesBestCook($title, $image , $topic_url)
    {
		
        $result = '';
        $result = '
            <div class="section-title-wrapper">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="text-color"><a href="'.$topic_url.'" rel="external" >' . $title . '</a></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-image-wrapper">
                        <a href="'.$topic_url.'" rel="external"><img style="width:100%; height: auto" class"best-cook-home-swiper-image img-responsive" src="' . $image . '" alt="' . $title . '" /></a>
                    </div><!-- end of section-image-wrapper -->
                </div>
            </div><!-- row -->
            ';
        return $result;
    }
	
	
	public function drawImageBox($image)//Beta3it el products
    {
        $result = '';
        $result = '
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-image-wrapper">
                        <img src="' . $image . '" alt="" class="img-responsive" />                        
                    </div><!-- end of section-image-wrapper -->
                </div>                
            </div><!-- row -->
            ';
        return $result;
    }
	
	

    //Section page
    public function drawCurrentSubSectionHomepageTitle($title, $backText, $backLink)
    {
		$title = str_replace(" ","&nbsp;" , $title);//This Seems to fix the break link problem
        $result = '';
        $result = '<div class="section-title-wrapper">
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="text-color float_left" >' . $title . '</h2>
                                <a onclick="javascript:history.go(-1)" href="' . $backLink . '"  class="text-color back-link float_right" rel="external" style="color:red;">' . $backText . '</a>
                            </div>                
                        </div>
                    </div>
        ';
        return $result;
    }

    public function drawFeatArticleImageAndText($title, $image ,$url = "")
    {
		$aHref = $url == "" ? "" : ' href="'.$url.'" ';
        
        $result = '<div class="section-image-wrapper hidden-md hidden-lg">
                        <a '.$aHref.'  rel="external"><img src="'.$image.'" alt="'.$title.'" class="img-responsive full-width"></a>
                        <div class="title-wrapper">
                            <h3><a '.$aHref.' rel="external">'.$title.'</a></h3>
                        </div>
                    </div>
        ';
        return $result;
    }
     
	public function drawFeatRecipeImageAndText($title , $image , $recipes_ingredients , $recipes_directions ,$recipes_calories, $ma3lomat_se7ia,$current_language_db_prefix){
		    $recipe_image_push_pull = $current_language_db_prefix == '_ar' ? 'col-md-push-7' : '';
			$recipe_container_push_pull = $current_language_db_prefix == '_ar' ? 'col-md-pull-5' : '';
			
		      echo '<div class="row"> 
            <div class="recipe-img col-sm-12 col-md-5 '.$recipe_image_push_pull.'" style="margin:0; padding:0;">
             
                <img src="'.$image.'" id="recipe-pic" class="img-responsive"/>

                <div id="recipe-text-bg">
				   
                    <h2>"'.$title.'"</h2>
					
                    <div id="recipe-links">
                        <div class="recipe-Calories" id="mobile-recipe-calories-button">
                            <div class="icon1"> 
                  <img src="../../../../mobile/images/recipe-Calories-icon.png" class="img-responsive" id="recipe-Prescription" />
                            </div>
                            <div class="text1">


                                <h5>"'.lang('bestcook_calory').'"</h5>
                            </div> 

                        </div>

                        <div class="recipe-Prescription" id="mobile-recipe-prescription-button" style="">   
                            <div class="icon2"> 
                                <img src="../../../../mobile/images/recipe-Prescription-icon.png" class="img-responsive" id="recipe-Calories"/>
                            </div>

                            <div class="text2" style="padding: 15px 0px;">    
                                <h5>"'.lang('bestcook_recipes').'"</h5>
                            </div>      

                        </div>      
                    </div>  

                   <!-- <div id="recipe-rate">
                        <div class="float_left"><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span></div>
                        <div class="float_left"><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span></div>
                        <div class="float_left"><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span></div>
                        <div class="float_left"><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span></div>
                        <div class="float_left"><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span></div>
                    </div>-->
                </div>
            </div>
		
		

                <div class="col-sm-12 col-md-7 '.$recipe_container_push_pull.' float_left" id="mobile-recipe-content">  
                    <h2 class="Ingredientstitle" style="margin:0px !important">'.lang('Ingredients').'</h2>
                        <p class="ingredients">'.$recipes_ingredients.'</p>
					<div id="recipe-prepare" class="col-sm-12"><p>'.$recipes_directions.'</p></div>
					
                </div>
			
			<div class="col-sm-12 col-md-7 '.$recipe_container_push_pull.' float_left" style="display:none" id="mobile-recipe-calories">
                    <img style="width: 100%;border:none;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;border: 1px solid #a7a7a7;" src="'. $ma3lomat_se7ia.'" />
            </div> 
			
        </div>';
			?>
            
            <script>
			
			$(document).ready(function(e) {
                
				$("#mobile-recipe-prescription-button").click(function(e){
					e.preventDefault();
					$("#mobile-recipe-calories").slideUp();
					$("#mobile-recipe-content").slideDown();
				});
				
				$("#mobile-recipe-calories-button").click(function(e){
					e.preventDefault();
					$("#mobile-recipe-content").slideUp();
					$("#mobile-recipe-calories").slideDown();
				});
				
            });
			
			</script>
            
            <?php
		} 
	
    public function drawSingleItemImageAndText($text , $desc , $image ,$url = "")
    {
		$aHref = $url == "" ? "" : ' href="'.$url.'" ';
		
        $result= '';
        $result = '<div class="row single-list-item-with-image">
                        <div class="col-xs-12">
                            <div class="float_left col-md-3 col-sm-3 col-xs-12">
                                <a '.$aHref.' rel="external"><img src="'.$image.'" class="img-responsive" width="100%" class="image border-color" /></a>
                            </div><!-- image -->
                            <div class="border-color float_left col-md-9 col-sm-9 col-xs-12" style="margin-top:5px;">
                                <h3 class="text-color" style="margin-top: 0px"><a '.$aHref.' rel="external">'.$text.'</a></h3>
                                <p><a '.$aHref.' rel="external">'.$desc.'</a></p>
                                <a '.$aHref.' class="float_right text-color" rel="external">'.lang('globals_more').'</a>
                            </div><!-- image -->                
                        </div>
                    </div><!-- single-list-item-with-image -->
        ';
        return $result;
    }
	public function drawImageThenTitle($title,$image,$url)//Beta3it el Sections Images
	{
		
		$result = '';
		$result.= '<div class="inner-slider-container">
						<a href="'.$url.'" rel="external"><img src="'.$image.'" class="img-responsive img-height border-color know-more-img" style="margin-left: 12px; width:90%;"/></a>
						<h3 class="text-color" style="text-align:center; padding: 10px 0px;"><a href="'.$url.'" rel="external">'.$title.'</a></h3>
                    </div>';
		return $result;
	}
	
	//Section Homepage widgets
    //Generate the huge background of the section color with its icon 
    public function drawMainSectionHomepageMobileTitle($title, $image , $url = "")
    {
		
    }
	
	
	//ask an expert widget
	
	public function ask_an_expert($ask_an_expert_id,$current_section_color,$current_language_db_prefix,$ask_an_expert_top_banner){
		$CI =& get_instance();
		
		$ask_an_expert_url = site_url("mobile/".$CI->router->class."/ask_an_expert");
		?>
<div class="section-title-wrapper">
  <div class="row">
    <div class="col-xs-12">
      <?php list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata($ask_an_expert_id,$current_language_db_prefix);?>
      <h2 class="text-color"><a href="<?php echo $ask_an_expert_url?>" rel="external"><?php echo $subsection_title; ?></a></h2>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="section-image-wrapper"> <a href="<?php echo $ask_an_expert_url?>" rel="external"><img src="<?php echo $ask_an_expert_top_banner;?>" width="100%" alt="<?php echo $subsection_title; ?>" class="img-responsive"></a> </div>
    <!-- end of section-image-wrapper --> 
  </div>
</div>
<!-- row -->

<?php 
        //return $result;
		/***********hassan -> this function to return SEctionTitleOnly*************/
		
		}
		    public function drawSubSectionBox_title($title)
    {
		$hrefLink = $url == "" ? "" : 'href="'.$url.'"';
        $result = '';
        $result .= '
            <div class="section-title-wrapper">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="text-color"><a '.$hrefLink.' >' . $title . '</a></h2>
                    </div>
                </div>
            </div>';
        return $result;
    }


      /***************************End Function SectionTitle*****************************/
	  function youtube_v_extractor($url)
{
  parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
  return $my_array_of_vars['v'];
}
	  public function drawSectionVideos()
	  { //Function Retrive videos
	  		
		$this->CI =& get_instance();
		$this->CI->load->model('videosmodel');
		$display_featured_video = $this->CI->videosmodel->get_featured_video(10,1);
		$data = '';
		echo '<div class="swiper-container2">
		<div class="swiper-wrapper">
         ';
		 
		for($i=0;$i<sizeof($display_featured_video);$i++):?>
<?php
			$title = $display_featured_video[$i]['videos_name'];
			$youtube_url = $display_featured_video[$i]['videos_url'];
			$v = parse_str( parse_url( $youtube_url, PHP_URL_QUERY ), $my_array_of_vars );
			$current_v = $my_array_of_vars['v'];
	        $short_title = mb_substr(strip_tags($title), 0, 35 , "utf-8"). (strlen(strip_tags($title)) >35?'...':'');
			echo '';
          ?>
<div class="swiper-slideg" style="width:100% !important">
  <div class="image"> <a href="#popupBasic" data-rel="popup" title="<?php echo $title; ?>" ?> <img class="youtube" style="width:100%" src="http://img.youtube.com/vi/<?php echo $current_v;?>/mqdefault.jpg" /> </a> </div>
  <?php /*?>   <a title="<?php echo $title; ?>" href="https://www.youtube.com/embed/<?php echo $current_v; ?>">
    	<img style="border:none; width:12%" class="video_paly1" src="<?php echo base_url()."images/video_player.png" ?>" />
	</a><?php */?>
 
  <div data-position-to="window" data-role="popup" id="popupBasic">
  <a href="#" data-rel="back"-player class="ui-btn ui-btn-b ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right close-vedio">Close</a>
    <iframe width="100%" height="100%" style="width:800px; height:500px;" class="img-responsive"  src="https://www.youtube.com/embed/<?php echo $current_v; ?>"  frameborder="0" allowfullscreen></iframe>
  </div>
  <div class="" style="-webkit-border-bottom-right-radius: 15px;-webkit-border-bottom-left-radius: 15px;-moz-border-radius-bottomright: 15px;-moz-border-radius-bottomleft: 15px;border-bottom-right-radius: 15px;border-bottom-left-radius: 15px;bottom: -3px;">
    <h5 class="float_left dir" style="margin-top: -20px;z-index: 1;position: relative;width: 100%;font-size: 2vw;color: white;"><b><a href="https://www.youtube.com/embed/<?php echo $current_v; ?>"><?php //echo $short_title; ?></a></b></h5>
  </div>
</div>
<?php  
endfor;
echo '</div></div>';

	  }
	  
	  /*This Function is already coded there is no using for it
	  Bermawy 25-3-2015
	  */
	 /* public function drawCommentsSection($myId  , $tableName){
		  
		
		$CI =& get_instance();
		$CI->load->model('ratemodel'); 
		$CI->load->model('commentmodel'); 
		$CI->load->model('membersmodel');  
		$display_comments = $CI->commentmodel->get_comments_from_db($tableName,$myId );
		
	
 

		if($display_comments){
		    foreach($display_comments as $comments) :
			$comment = $comments['comments_message'];
			$date = date("Y-m-d",strtotime($comments['comments_date']));
			$comment_member_id = $comments['comments_members_id'];
			$member_info = $CI->membersmodel->get_member_info($comment_member_id);
			if(!$member_info)
			{
				 $member_thumb  = 'personal_img.png';
			}
			else
			{
				if(!$member_info[0]['members_images'] or $member_info[0]['members_images'] == 0)
				 {
					  $member_thumb  = 'personal_img.png';
				 }
				 else
				 {
					 $image_src = $CI->membersmodel->get_member_image($member_info[0]['members_ID']);
					 $member_thumb  = $image_src[0]['images_src'];
					 
				 }
			}
      ?>

   <div class="col-xs-12 col-sm-12 col-md-12" style="margin-bottom: 15px;">
       <div class="product-comment-user-img col-xs-2 col-sm-2 col-md-2"> 
       <img src="<?php echo base_url();?>uploads/members/<?php echo $member_thumb;?>" class="img-responsive border-color" /></div>
       <div class="product-comment col-xs-10 col-sm-10 col-md-10">
       <?php echo $comment; ?>
       </div>
       <div class="product-comment-date"><?php echo $date;?></div>
       
   </div>
  
   <?php endforeach;
   
		}else{
			
			
			echo '<div><p style="font-size:18px;color:{$current_section_color} ">'.lang('noComment').'</p></div>';
			
			}
		  
		  
		  
		  
		  
		  }*/
	  
	  
}
/* End of file MWidgets.php */



