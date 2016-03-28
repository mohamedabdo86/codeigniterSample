<script>
	jQuery(function(){
		
		jQuery('#camera_wrap_1').camera({
			thumbnails: false,pagination:false,
			height: '355px',playPause : false
		});

	
	});
</script>
    
<div class="global_sperator_height" style="width:100%;"></div>

    <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
        <div data-thumb="<?php echo base_url(); ?>images/slides/thumbs/bridge.jpg" data-src="<?php echo base_url(); ?>images/slides/bridge.jpg"></div>
        <div data-thumb="<?php echo base_url(); ?>images/slides/thumbs/leaf.jpg" data-src="<?php echo base_url(); ?>images/slides/leaf.jpg"></div>
        <div data-thumb="<?php echo base_url(); ?>images/slides/thumbs/road.jpg" data-src="<?php echo base_url(); ?>images/slides/road.jpg"></div>
        <div data-thumb="<?php echo base_url(); ?>images/slides/thumbs/sea.jpg" data-src="<?php echo base_url(); ?>images/slides/sea.jpg"></div>
        <div data-thumb="<?php echo base_url(); ?>images/slides/thumbs/shelter.jpg" data-src="<?php echo base_url(); ?>images/slides/shelter.jpg"></div>
        <div data-thumb="<?php echo base_url(); ?>images/slides/thumbs/tree.jpg" data-src="<?php echo base_url(); ?>images/slides/tree.jpg"></div>
    </div><!-- End of camera_wrap -->
    <div class="clear"></div>
    
	<div id="best_cook_line_seperator_homepage" class="thick_line best_cook_background_color"></div>
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <!-- Start of Best Cook Section -->
    <div class="sections_wrapper_margin" >
    
    <?php /*?><div  class="float_left exlarge_width home_widget">
    	<div class="image"><img  src="http://cdn.pimg.co/p/420x430/858652/fff/img.png"/></div>
        <div class="title best_cook_border_color">
        	<div class="best_cook_color">اخر الوصفات</div>
        </div>
        <div class="description ">
        <h4><b><a href="#">طريقة عمل بيكاتا بالمشروم</a></b></h4>
        <p>وصفة شهية لتحقيق حياة افضل للإسرة المصرية من خلال تقديم غذاء افضل و نصائح لتباع اسلوب الحياة</p>
        </div>
        <div class="triangle best_cook_borderbottom_color"></div>
        <div class="plus_sign white_color"><a href="#">+</a></div>
    </div><?php */?><!-- End of col1 -->
     <div class="float_left" style="width:420px;height:430px;">
             <?php
               // list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(14,$current_language_db_prefix);
                $this->widgets->generate_homepage_recipes('اخر الوصفات',false,$display_bestcook_last_recipes,'best_cook_color','best_cook_background_color','best_cook_borderbottom_color',420,375,$current_language_db_prefix);
				// generate_homepage_recipes('title_name,member_flag_select,array_of_data,current_section_color,current_section_background_color,current_section_borderbottom_color,current_image_width,current_image_height,current_language_db_prefix');
				?>
        </div><!--End OF float_left-->
    
   <div style="height:430px" class="float_left homesperator_width" ></div>

    
    <div style="width:235px; height:430px;" class="float_left" >
        <div class="medium_box_width home_widget" >
            <div class="image"><img  src="http://cdn.pimg.co/p/235x210/858652/fff/img.png"/></div>
            <div class="title best_cook_border_color">
                <div class="best_cook_color">وصفات الموسم</div>
            </div>
            <div class="description ">
            <h4><b><a href="#">طريقة عمل بيكاتا بالمشروم</a></b></h4>
            </div>
            <div class="triangle best_cook_borderbottom_color"></div>
        	<div class="plus_sign white_color"><a href="#">+</a></div>
        
        
        </div>
    
        
    <div style="width:235px; height:10px" ></div>
    <div class="medium_box_width best_cook_background_color home_widget">
    		<div class="title best_cook_border_color">
                <div class="best_cook_color">أكثر وصفات قراءة</div>
            </div>
            <ul class="list_small_titleonly">
            	<li><a href="#">طريقة عمل بيكاتا بالمشروم و الخضروات</a></li>
                <li><a>طريقة عمل بيكاتا بالمشروم و الخضروات</a></li>
                <li><a>طريقة عمل بيكاتا بالمشروم و الخضروات</a></li>
            </ul>
            <div class="triangle white_borderbottom_color"></div>
        	<div class="plus_sign best_cook_color"><a href="#">+</a></div>
    </div>
    </div><!-- End of col # 2 -->
    
	<div style="height:430px" class=" homesperator_width float_left" ></div>
    
    <div style="width:265px; height:430px;" class="float_left">
    
   <div class="large_box_width home_widget" >
            <div class="image"><img  src="http://cdn.pimg.co/p/265x265/858652/fff/img.png"/></div>
            <div class="title best_cook_border_color">
                <div class="best_cook_color">مقالات اخري</div>
            </div>
            <div class="description ">
            <h4><b><a href="#">طريقة عمل بيكاتا بالمشروم</a></b></h4>
            <p>وصفة شهية لتحقيق حياة افضل للإسر</p>
            </div>
            <div class="triangle best_cook_borderbottom_color"></div>
        	<div class="plus_sign white_color"><a href="#">+</a></div>
        
        
    </div>
    
    <div style="width:265px; height:10px" ></div>
    
    <div style="width:265px; height:155px; " class="home_widget best_cook_background_color">
     		<div class="title best_cook_background_color best_cook_border_color">
                <div class="best_cook_color">تطبيقات</div>
            </div>
            

            <a class="applicationlist_prev"><img src="http://cdn.pimg.co/p/15x15/858652/fff/img.png" /></a>
            <a class="applicationlist_next"><img src="http://cdn.pimg.co/p/15x15/858652/fff/img.png" /></a>
            <div class="application_list">
            <ul>
          		<li><a href=""><img src="http://cdn.pimg.co/p/44x40/858652/fff/img.png" alt=""  ><small>سؤال من مطبخ نستلة</small></a></li>
                <li><a href=""><img src="http://cdn.pimg.co/p/44x40/858652/fff/img.png" alt=""  ><small>سؤال من مطبخ نستلة</small></a></li>
                <li><a href=""><img src="http://cdn.pimg.co/p/44x40/858652/fff/img.png" alt=""  ><small>سؤال من مطبخ نستلة</small></a></li>
                <li><a href=""><img src="http://cdn.pimg.co/p/44x40/858652/fff/img.png" alt=""  ><small>سؤال من مطبخ نستلة</small></a></li>
	        </ul>
        </div>
            
    
      
        	
    </div>
    </div><!-- End of col # 3 -->

   
    
    
    
    
    
    
    <div class="clear"></div>
    </div>
    <!-- End of Best Cook Section -->
    <div class="global_sperator_height" style="width:100%"></div>
    
    <div id="best_mom_line_seperator_homepage" class="thick_line best_mom_background_color"></div>
    
    <div class="global_sperator_height" style="width:100%"></div>
	
    <div class="clear"></div>
        
	<!-- Start of Best Mom Section -->
    <div class="sections_wrapper_margin">
    
        <div style="width:270px; height:275px; " class="float_left home_widget best_mom_background_color">
                <div class="title best_mom_background_color best_mom_border_color">
                    <div class="best_mom_color">تطبيقات</div>
                </div>
                
    
                <a class="applicationlist_prev"><img src="http://cdn.pimg.co/p/15x15/858652/fff/img.png" /></a>
                <a class="applicationlist_next"><img src="http://cdn.pimg.co/p/15x15/858652/fff/img.png" /></a>
                <div class="application_list">
                <ul>
                    <li><a href=""><img src="http://cdn.pimg.co/p/44x40/858652/fff/img.png" alt=""  ><small>سؤال من مطبخ نستلة</small></a></li>
                    <li><a href=""><img src="http://cdn.pimg.co/p/44x40/858652/fff/img.png" alt=""  ><small>سؤال من مطبخ نستلة</small></a></li>
                    <li><a href=""><img src="http://cdn.pimg.co/p/44x40/858652/fff/img.png" alt=""  ><small>سؤال من مطبخ نستلة</small></a></li>
                    <li><a href=""><img src="http://cdn.pimg.co/p/44x40/858652/fff/img.png" alt=""  ><small>سؤال من مطبخ نستلة</small></a></li>
                </ul>
            </div>
        </div>  
        
        <div style="height:275px" class="float_left homesperator_width" ></div>
        
        <div class="large_box_width_2 home_widget float_left" >
            <div class="image"><img  src="http://cdn.pimg.co/p/325x275/858652/fff/img.png"/></div>
            <div class="title best_mom_border_color">
                <div class="best_mom_color">حملي</div>
            </div>
            <div class="description ">
            <h4><b><a href="#">طريقة عمل بيكاتا بالمشروم</a></b></h4>
           
            </div>
            <div class="triangle best_mom_borderbottom_color"></div>
        	<div class="plus_sign white_color"><a href="#">+</a></div>
        
        
     	</div> 
      
      <div style="height:275px" class="float_left homesperator_width" ></div>
      
      <div class="large_box_width_2 home_widget float_left" >
            <div class="image"><img  src="http://cdn.pimg.co/p/325x275/858652/fff/img.png"/></div>
            <div class="title best_mom_border_color">
                <div class="best_mom_color">طفلي الرضيع</div>
            </div>
            <div class="description ">
            <h4><b><a href="#">طريقة عمل بيكاتا بالمشروم</a></b></h4>
           
            </div>
            <div class="triangle best_mom_borderbottom_color"></div>
        	<div class="plus_sign white_color"><a href="#">+</a></div>
        
        
      </div>
    
    <div class="clear"></div>
    
    <div style="width:100%; height:5px;"></div>
    
    <div class="long_box_width home_widget float_left best_mom_background_color" >
            <div class="title best_mom_border_color">
                <div class="best_mom_color">اسئلي الخبير</div>
            </div>
            <div style="width:285px; margin:15px 10px;" class="float_left">
                <ul class="list_small_titleonly">
                    <li><a href="#">طريقة عمل بيكاتا بالمشروم و الخضروات</a></li>
                    <li><a>طريقة عمل بيكاتا بالمشروم و الخضروات</a></li>
                    <li><a>طريقة عمل بيكاتا بالمشروم و الخضروات</a></li>
                    <li><a>طريقة عمل بيكاتا بالمشروم و الخضروات</a></li>
                    <li><a>طريقة عمل بيكاتا بالمشروم و الخضروات</a></li>
                </ul>
            </div>
            
            <div class="float_left" style="width: 5px;position: relative;top: 82px;height: 180px;background: #FFF;background-color: rgba(255,255,255,0.60);"></div>
            
            <div style="width:270px; height:150px; margin:88px 10px 0px;" class="float_left">
            	<h4 class="white_color">اسالي</h4>
                <textarea class="textarea_class"></textarea>
                <input type="button" class="button_class best_mom_color" value="ارسال"  />
      		</div>
            <div class="triangle white_borderbottom_color"></div>
        	<div class="plus_sign best_mom_color"><a href="#">+</a></div>
        
        
    </div><!-- ENd of esa2l el 5abir  -->
    
    <div style="height:275px" class="float_left homesperator_width" ></div>
    
    <div class="large_box_width_2 home_widget float_left" >
            <div class="image"><img  src="http://cdn.pimg.co/p/325x275/858652/fff/img.png"/></div>
            <div class="title best_mom_border_color">
                <div class="best_mom_color">نمو و تنشئة طفلي</div>
            </div>
            <div class="description ">
            <h4><b><a href="#">طريقة عمل بيكاتا بالمشروم</a></b></h4>
            
            </div>
            <div class="triangle best_mom_borderbottom_color"></div>
        	<div class="plus_sign white_color"><a href="#">+</a></div>
        
        
      </div>
    
    
    
    <div class="clear"></div>
    </div>
    <!-- End of Best Mom Section -->
    <div class="global_sperator_height" style="width:100%"></div>
    
    <div class="thick_line nido_products_background_color"></div>
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <!-- Start of Nido Ads Section -->
    <div class="sections_wrapper_margin" >
    
    <div class="nido_ads float_left" >
    	<div class="float_left text_wrapper">اخر اخبار نستلة</div>
        <a class="float_left"><img src="http://cdn.pimg.co/p/570x110/858652/fff/img.png" /></a>
    </div>
    
    <div class="homesperator_width float_left" style="height:110px;"> </div>
    
    <div class="search_homepage float_left">
    	<div style="margin:20px 15px;">
    		<h2 class="float_left white_color" style="font-size:24px;"> ابحث</h2>
            <input type="text" class="float_left text_class margin_10" />
            <input type="button" value="بحث" class="float_right button_class" style="margin:0px 24px;" />
    	</div>
    </div>
    
    <div class="clear"></div>
    </div>
    <!-- End of Nido Ads Section -->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <div id="best_me_line_seperator_homepage" class="thick_line best_me_background_color"></div>
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <!-- Start of Best meSection -->
    <div class="sections_wrapper_margin" >
    
    	<div class="large_box_width_2 home_widget float_left" >
            <div class="image"><img  src="http://cdn.pimg.co/p/325x275/858652/fff/img.png"/></div>
            <div class="title best_me_border_color">
                <div class="best_me_color">وقت العائلة</div>
            </div>
            <div class="description ">
            <h4><b><a href="#">طريقة عمل بيكاتا بالمشروم</a></b></h4>
           
            </div>
            <div class="triangle best_me_borderbottom_color"></div>
        	<div class="plus_sign white_color"><a href="#">+</a></div>
        
        
     	</div>
        
        <div style="height:275px" class="float_left homesperator_width" ></div>
        
        <div class="large_box_width_2 home_widget float_left" >
            <div class="image"><img  src="http://cdn.pimg.co/p/325x275/858652/fff/img.png"/></div>
            <div class="title best_me_border_color">
                <div class="best_me_color">لياقتك</div>
            </div>
            <div class="description ">
            <h4><b><a href="#">طريقة عمل بيكاتا بالمشروم</a></b></h4>
           
            </div>
            <div class="triangle best_me_borderbottom_color"></div>
        	<div class="plus_sign white_color"><a href="#">+</a></div>
        
        
     	</div>
        
        <div style="height:275px" class="float_left homesperator_width" ></div>
        
        <div style="width:270px; height:275px; " class="float_left home_widget best_me_background_color">
                <div class="title best_me_background_color best_me_border_color">
                    <div class="best_me_color">تطبيقات</div>
                </div>
                
    
                <a class="applicationlist_prev"><img src="http://cdn.pimg.co/p/15x15/858652/fff/img.png" /></a>
                <a class="applicationlist_next"><img src="http://cdn.pimg.co/p/15x15/858652/fff/img.png" /></a>
                <div class="application_list">
                <ul>
                    <li><a href=""><img src="http://cdn.pimg.co/p/44x40/858652/fff/img.png" alt=""  ><small>سؤال من مطبخ نستلة</small></a></li>
                    <li><a href=""><img src="http://cdn.pimg.co/p/44x40/858652/fff/img.png" alt=""  ><small>سؤال من مطبخ نستلة</small></a></li>
                    <li><a href=""><img src="http://cdn.pimg.co/p/44x40/858652/fff/img.png" alt=""  ><small>سؤال من مطبخ نستلة</small></a></li>
                    <li><a href=""><img src="http://cdn.pimg.co/p/44x40/858652/fff/img.png" alt=""  ><small>سؤال من مطبخ نستلة</small></a></li>
                </ul>
            </div>
        </div><!-- End of applications -->
        
        
        <div class="clear"></div>
    
    <div style="width:100%; height:5px;"></div>
    
  	 <div class="large_box_width_2 home_widget float_left" >
            <div class="image"><img  src="http://cdn.pimg.co/p/325x275/858652/fff/img.png"/></div>
            <div class="title best_me_border_color">
                <div class="best_me_color">عذائك</div>
            </div>
            <div class="description ">
            <h4><b><a href="#">طريقة عمل بيكاتا بالمشروم</a></b></h4>
           
            </div>
            <div class="triangle best_me_borderbottom_color"></div>
        	<div class="plus_sign white_color"><a href="#">+</a></div>
        
        
     	</div><!-- End of ghaza2ik -->
        
        <div style="height:275px" class="float_left homesperator_width" ></div>
        
        <div class="large_box_width_2 home_widget float_left" >
            <div class="image"><img  src="http://cdn.pimg.co/p/325x275/858652/fff/img.png"/></div>
            <div class="title best_me_border_color">
                <div class="best_me_color">جمالك</div>
            </div>
            <div class="description ">
            <h4><b><a href="#">طريقة عمل بيكاتا بالمشروم</a></b></h4>
           
            </div>
            <div class="triangle best_me_borderbottom_color"></div>
        	<div class="plus_sign white_color"><a href="#">+</a></div>
        
		</div><!-- End of gamalik -->
    
    <div style="height:275px" class="float_left homesperator_width" ></div>
    
    <div style="width:270px; height:275px; " class="float_left home_widget best_me_background_color">
                <div class="title best_me_background_color best_me_border_color">
                    <div class="best_me_color">اسئالي الخبير</div>
                </div>
                
                <ul class="list_small_titleonly">
                    <li><a href="#">طريقة عمل بيكاتا بالمشروم و الخضروات</a></li>
                    <li><a>طريقة عمل بيكاتا بالمشروم و الخضروات</a></li>
                    <li><a>طريقة عمل بيكاتا بالمشروم و الخضروات</a></li>
                    <li><a>طريقة عمل بيكاتا بالمشروم و الخضروات</a></li>
                    <li><a>طريقة عمل بيكاتا بالمشروم و الخضروات</a></li>
                    
                </ul>
                <ul class="list_small_titleonly">
                    <li style="list-style:none"><div align="center"><input type="button" class="button_class" value="اسالي" /></div></li>
              
                </ul>
                
               <div class="triangle white_borderbottom_color"></div>
        	<div class="plus_sign best_me_color"><a href="#">+</a></div>
                

                
                
                

        </div><!-- End of es2aly el 5abir -->
        
        
        
    
    <div class="clear"></div>
    </div>
    <!-- End of Best me Section -->
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <div id="best_time_line_seperator_homepage" class="thick_line best_time_background_color"></div>
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <!-- Start of Best time Section -->
     <div class="sections_wrapper_margin" >
     
         	<div class="small_box_width home_widget float_left" >
                <div class="image"><img  src="http://cdn.pimg.co/p/220x195/858652/fff/img.png"/></div>
                <div class="title best_time_border_color">
                    <div class="best_time_color">افلام و مسرحيات</div>
                </div>
                <div class="description ">
                <h4><b><a href="#">طريقة عمل بيكاتا بالمشروم</a></b></h4>
                
                </div>
                <div class="triangle best_time_borderbottom_color"></div>
                <div class="plus_sign white_color"><a href="#">+</a></div>
            
            </div><!-- End of masr7iat wa aflam -->
            
            <div style="height:195px" class="float_left homesperator_width" ></div>
            
            <div class="small_box_width home_widget float_left" >
                <div class="image"><img  src="http://cdn.pimg.co/p/220x195/858652/fff/img.png"/></div>
                <div class="title best_time_border_color">
                    <div class="best_time_color">افلام و مسرحيات</div>
                </div>
                <div class="description ">
                <h4><b><a href="#">طريقة عمل بيكاتا بالمشروم</a></b></h4>
                
                </div>
                <div class="triangle best_time_borderbottom_color"></div>
                <div class="plus_sign white_color"><a href="#">+</a></div>
            
            </div><!-- End of masr7iat wa aflam -->
            
            <div style="height:195px" class="float_left homesperator_width" ></div>
            
            <div class="small_box_width home_widget float_left" >
                <div class="image"><img  src="http://cdn.pimg.co/p/220x195/858652/fff/img.png" /></div>
                <div class="title best_time_border_color">
                    <div class="best_time_color">افلام و مسرحيات</div>
                </div>
                <div class="description ">
                <h4><b><a href="#">طريقة عمل بيكاتا بالمشروم</a></b></h4>
                
                </div>
                <div class="triangle best_time_borderbottom_color"></div>
                <div class="plus_sign white_color"><a href="#">+</a></div>
            
            </div><!-- End of masr7iat wa aflam -->
            
            <div class="medium_long_width home_widget gray_background_color  float_right">
            
            	<div class="title best_time_border_color best_time_background_color"  >
                    <div class="white_color">اخر المقالات</div>
                </div>
                
                    
                <ul class="list_section_title_image_article">
                    <li class="best_time_color ">
                    <a  href="#">صحصحي للدنيا</a>
                    <br />
                    <a href="">
                    <img class="float_left" src="http://cdn.pimg.co/p/75x60/858652/fff/img.png" />
                    <div style="width:5px; height:60px;" class="float_left" >&nbsp;</div>
                    <div class="articletitle float_left ">هل انتي شخصية منظمة ام لا؟</div>
                    
                    </a>
                   
                    <div class="float_right readmore"><a href="">شاهد المزيد</a></div>
                    
                    <div class="float_left margin_5 "><a href=""><img class="float_left" src="http://cdn.pimg.co/p/20x20/858652/fff/img.png" /></a></div>
                    <div class="float_left margin_5 "><a href=""><img class="float_left" src="http://cdn.pimg.co/p/20x20/858652/fff/img.png" /></a></div>
                    
                    
                    <div class="clear"></div>
                    </li>
                    
                    <li class="best_time_color">
                    <a  href="#">صحصحي للدنيا</a>
                    <br />
                    <a href="">
                    <img class="float_left" src="http://cdn.pimg.co/p/75x60/858652/fff/img.png" />
                    <div style="width:5px; height:60px;" class="float_left" >&nbsp;</div>
                    <div class="articletitle float_left ">هل انتي شخصية منظمة ام لا؟</div>
                    
                    </a>
                   
                    <div class="float_right readmore"><a href="">شاهد المزيد</a></div>
                    
                    <div class="float_left margin_5 "><a href=""><img class="float_left" src="http://cdn.pimg.co/p/20x20/858652/fff/img.png" /></a></div>
                    <div class="float_left margin_5 "><a href=""><img class="float_left" src="http://cdn.pimg.co/p/20x20/858652/fff/img.png" /></a></div>
                    
                    <div class="clear"></div>
                    
                    </li>
                    
                    <li class="best_time_color">
                    <a  href="#">صحصحي للدنيا</a>
                    <br />
                    <a href="">
                    <img class="float_left" src="http://cdn.pimg.co/p/75x60/858652/fff/img.png" />
                    <div style="width:5px; height:60px;" class="float_left" >&nbsp;</div>
                    <div class="articletitle float_left ">هل انتي شخصية منظمة ام لا؟</div>
                    
                    </a>
                   
                    <div class="float_right readmore"><a href="">شاهد المزيد</a></div>
                    
                    <div class="float_left margin_5 "><a href=""><img class="float_left" src="http://cdn.pimg.co/p/20x20/858652/fff/img.png" /></a></div>
                    <div class="float_left margin_5 "><a href=""><img class="float_left" src="http://cdn.pimg.co/p/20x20/858652/fff/img.png" /></a></div>
                    
                    <div class="clear"></div>
                    
                    </li>
                    
                   
                    
                </ul>
                
                
                
            
            </div><!-- End of a5r el maqalat -->
            
            <div style="width:670px; height:5px; float:right">&nbsp; </div>
            
            <div class="medium_short_width home_widget float_left gray_background_color" >
            <div class="title best_time_background_color best_time_color " >
                <div class="white_color">إعرفي شخصيتك</div>
            </div>
            
            <div style="margin:70px 10px;" class="best_time_color"> 
            <h4>ما الوضع المناسب لكي عند النوم?</h4>
            <label>اليمين<input name="poll" type="radio" value="" /></label> <br />
            <label>الشمال<input name="poll" type="radio" value="" /></label> <br />
            <label>علي الجانب الايسر<input name="poll" type="radio" value="" /></label> <br />
            <label>علي الجانب اليمين<input name="poll" type="radio" value="" /></label> <br />
            
            <input type="button" value="ارسال" class="button_class" />
            </div>
            
			</div><!-- End of a3rafy sha5syitik -->
            
            <div style="height:250px" class="float_left homesperator_width" ></div>
        
            <div class="medium_short_width home_widget float_left gray_background_color" >
            <div class="image"><img  src="http://cdn.pimg.co/p/337x250/858652/fff/img.png"/></div>
            <div class="title best_time_background_color best_time_color">
                <div class="white_color">إعلانات نستلة</div>
            </div>
            <div class="description ">
                <h4><b><a href="#">طريقة عمل بيكاتا بالمشروم</a></b></h4>
                
                </div>
                <div class="triangle best_time_borderbottom_color"></div>
                <div class="plus_sign white_color"><a href="#">+</a></div>
                
			</div><!-- End of a3rafy sha5syitik -->
            
           
     
     <div class="clear"></div>
     </div>
    <!-- End of Best time Section -->
    
    <div class="global_sperator_height" style="width:100%"></div>

	<div class="thick_line best_time_background_color"></div>
    
    <div class="global_sperator_height" style="width:100%"></div>
    
    <!-- Start of Videos, twitter and facebook sections -->
    <?php $this->load->view('template/homepage_last_row') ?>
    <!-- End of videos , twitter and facebook sections -->
   
