
<style>
@media (min-width: 700px) {
.section-image-wrapper {
 <?php  if($current_language_db_prefix == '_ar') {
 ?>  /*float:right;*/
 margin-left: 10px;
 <?php
}
else {
 ?>  /*float:left;*/
	margin-right: 10px;
 <?php
}
 ?>
}
}
</style>
<script>
$(document).ready(function(e) {
  var curretwidth = screen.availWidth; 
  if(curretwidth>599){
	  $('#articl-image').addClass('float article-img');
	  }
  
});

</script>
<style>
.article-img img{
width:350px;
}
.article-img .section-image-wrapper .title-wrapper h3{
font-size: 15px !important;
}
@media (max-width: 800px) and (min-width: 736px)
.inner-article-arrow {
  top: -114px !important;
}
.fancybox-wrap{width: 300px !important;}
.fancybox-inner{width: 270px !important;}
</style>
<?php 

$article_img_push_pull = $windowidth > 800 ? 'float' : '';
$article_text_push_pull= $current_language_db_prefix == '_ar' ? 'col-md-pull-5' : '';

?>
<section class="<?php echo $current_section; ?>">
  <div id="insert_message"></div>
  <!--<div class="thick-line background-color">&nbsp;</div>-->
  <?php
		$id = $display_article[0]['articles_ID'];
		$table_name_for_rate = "articles";
		$title = $display_article[0]['articles_title'.$current_language_db_prefix];
		$views = $display_article[0]['articles_views'];
		$url = site_url_mobile($this->router->class."/".$this->router->method."/".$id);
		
        echo $this->mwidgets->drawMainSectionHomepageTitle($this->headers->get_second_title(), base_url()."/images/".$imageFolder."/{$imageFolder}_inner_slideshow_logo.png" , site_url_mobile(''.$this->router->class));
        echo $this->mwidgets->drawCurrentSubSectionHomepageTitle($parent_section_display[0]['sub_sections_name'.$current_language_db_prefix], lang("globals_back"), "#");
        echo"<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>"; 
        echo "<div id='articl-image'>";
        echo $this->mwidgets->drawFeatArticleImageAndText($title, $this->config->item('articles_img_link').$display_article[0]['images_src']);
		echo"</div>";
        ?>
 <div class="section-seperator-margin"></div>
  <!--<span ><?php //echo lang('globals_views') ." ( ".$views." ) ";?></span>-->
  <div class="section-seperator-margin"></div>
  <div class=""> 
   <span ><?php echo lang('globals_views') ." ( ".$views." ) ";?></span>
  <?php echo strip_tags($display_article[0]['articles_body'.$current_language_db_prefix], '<div>,<ol>,<li>,<ul>,<strong>,<br/>,<p>,<table>,<tr>,<td>,<a>'); ?> </div>
  </div>
  
  <div class="section-seperator-margin"></div>
  <div class="row" style="margin:5px;">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="center-block center share-buttons-wrapper">
        <?php
                    $params = array('url' => $url, 'title' => $title,'member_id'=>$this->members->members_id);
                    echo $this->sharing->sharing_article_mobile($params, $this->members->members_id); 
                ?>
        <div class="clear"></div>
      </div>
    </div>
  </div>
  <div class="thick-line background-color">&nbsp;</div>
  <div class="comment-header border-top-color">
    <h2><?php echo lang('globals_comments'); ?></h2>
  </div>
  <div class="comments_insert row" >
    <?php
        
            $params = array('member_email'=>$this->members->members_email,'table'=>$table_name_for_rate,'foreign_id'=>$id,'member_id'=>$this->members->members_id, 'section_id'=>$current_section_id, 'current_section_background_color' => "");
            echo $this->comments->insert_comments($params); 
        ?>
  </div>
  <div class="comments_result row">
    <?php
            $params = array('table'=>$table_name_for_rate,'foreign_id'=>$id );
            echo $this->comments->get_comments($params); 
        ?>
  </div>
  <!--End of .comments_result-->
  
  <?php 
	if($display_other_sections):
	?>
  <div class="row">
    <div class="col-xs-12">
      <h2><?php echo lang('know_more'); ?></h2>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12" style="padding:0 !important;">
      <div class="swiper-container-images">
        <div class="swiper-wrapper">
          <?php
                        for ($i = 0; $i < sizeof($display_other_sections); $i++):
                            ?>
          <div class="swiper-slide ">
            <?php
								//Generate Link
								$linkToGenerate = site_url_mobile(''.$this->router->class.'/section/'.$display_other_sections[$i]['sub_sections_ID']   );
								//If Current Section have children, Get the section the first child and get its first article image
								$haveChildrenDisplay = NULL;
								$imageLink = "";
								$haveChildrenDisplay = $this->sectionsmodel->get_last_level_children($display_other_sections[$i]['sub_sections_ID'],"articles");
								if($haveChildrenDisplay)
								{								
									list( $displayImage, $total_rows_feat)   = $this->articlesmodel->get_all_articles(1,0,$haveChildrenDisplay[0]['sub_sections_ID'],true);
									$imageLink = $this->config->item('articles_img_link').$displayImage[0]['images_src'];
								}
								else
								{
									list( $displayImage, $total_rows_feat)   = $this->articlesmodel->get_all_articles(1,0,$display_other_sections[$i]['sub_sections_ID'],true);
									$imageLink = $this->config->item('articles_img_link').$displayImage[0]['images_src'];
								}
								//If not, get the first article image 
								echo $this->mwidgets->drawImageThenTitle($display_other_sections[$i]['sub_sections_name'.$current_language_db_prefix] , $imageLink ,$linkToGenerate);
							?>
          </div>
          <?php
                        endfor;
                        ?>
        </div>
        <!-- swiper-wrapper --> 
        <a class="inner-article-left inner-article-arrow" style="float:left;  position: relative;  top: -85px;"> <img src="<?php echo base_url()?>images/bestcook/left_arrow_medium.png"  class="img-responsive" style="width:12px;"/> </a> <a class="inner-article-right inner-article-arrow" style="float:right;position: relative;  top: -85px;"> <img src="<?php echo base_url()?>images/bestcook/right_arrow_medium.png"  class="img-responsive" style="width:12px;"/> </a> </div>
      <!-- swiper-container --> 
    </div>
  </div>
  <div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div>
  <?php 
	endif;
	?>
  <h3 class="text-color"><?php echo lang('favorite_topic'); ?></h3>
  <?php
 // echo $useragent=$_SERVER['HTTP_USER_AGENT'];
        for ($i = 0; $i < sizeof($display_related_articles); $i++):
		 $id = $display_related_articles[$i]['articles_ID'];
            $title =    $display_related_articles[$i]['articles_title'.$current_language_db_prefix];
            $image =  $this->config->item('articles_img_link').$display_related_articles[$i]['images_src'];
            $url = site_url_mobile($this->router->class."/".$this->router->method."/".$display_related_articles[$i]['articles_ID']);
			$desc =    $display_related_articles[$i]['articles_body'.$current_language_db_prefix];
			$desc_to_show;
			?>
            
            
            <script>
               $(document).ready(function(e) {
				   $( window ).resize(function() {
                var curretwidth = screen.availWidth; 
					  if(curretwidth <=414){
						 
		                <?php $desc_to_show=$this->common->limit_text($desc,20);?>				
		              }else if (curretwidth >=415 && curretwidth <=800) {
						  //alert("f2");
			            <?php $desc_to_show=$this->common->limit_text($desc,380);?>
		               }else{
						   //alert("f3");
		              <?php $desc_to_show=$this->common->limit_text($desc,400);?>
					  
	                 }
                 });
				 
              });

           </script>
            
            <?
			//$this->common->limit_text($desc,100);
			//$this->common->limit_text($desc,300);
			//echo $desc_to_show;
            echo $this->mwidgets->drawSingleItemImageAndText($title,$desc_to_show,$image,$url);
        endfor;
        ?>
  <div class="extra-thick-line background-color section-seperator-margin">&nbsp;</div>
  <?php echo $this->mwidgets->generateproductwidget();?> </section>
<script type="text/javascript">
$(document).ready(function(e) {
	
	//Comments
	$('.comments_insert').hide();
	$('.toggle_input_comment').click(function(e) {
        $('.comments_insert').slideToggle('slow');
    });
	
	//load fancybox
	$("#single_1").fancybox({
		  width: 300,
          height: 180,
		  scrolling  :'no',
		  autoSize : false,
          fitToView : false,
          helpers: {title : {type : 'float'}}
      });

	//Add Comments
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
			   success : function(){
				   if(members_id == 0)
				   {
					    $('.comment_big_input').val('<?php echo lang('globals_thanks_for_comment_not_login')?>');
				   }
				   else
				   {
				   		$('.comment_big_input').val('<?php echo lang('globals_thanks_for_comment')?>');
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
		
    });
	
	//Add To Book			
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