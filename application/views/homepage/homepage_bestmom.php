<script type="text/javascript">
var index_positions = 0;
$(function() {
	
    $(".best_mom_homepage_applications_list").jCarouselLite({
        btnNext: ".best_mom_homepage_applications_list_next",
        btnPrev: ".best_mom_homepage_applications_list_prev",
		visible: 2,
		//circular: false,
    });
		
});
</script>
<script type="text/javascript">
$(document).ready(function(e) {
    $("#ask_expert_submit").click(function(e) {
    	 var question = $.trim($('#ask_expert_question').val());
		 var email = $('#ask_expert_email').val();
		 var section_id = '10';
		var state = true;
		$(".field_error").hide();
		
		if( email == "" )
		{
			//$("#ask_expert_email_error").fadeIn("fast");
			$(".field_error").fadeIn("fast");
			state = false;
		}
		else
		{
			 var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			 if( !emailReg.test($("#ask_expert_email").val() ) ) 
			 {
				  $("#members_email_format_error").fadeIn("fast");
				  state = false;
			 } 
		}
		
		if(question == "" )
		{
			//$("#ask_expert_question_error").fadeIn("fast");
			$(".field_error").fadeIn("fast");
			state = false;
		}
		
		//return state;
		
		if(state == true)
		{
			$.ajax({
				  url:  "<?php echo site_url($this->router->class."/insert_ask_expert"); ?>",
				  type: "POST",
				  data: {email : email , question : question , section_id : section_id},
				  cache: false,
				  //dataType: "json",
				  success: function(success_array)
				  {
					  $('#ask_expert_result').html('سوف نرد على سؤالك فى أقرب وقت ممكن') ;
					//alert('Done')
					$.trim($('#ask_expert_question').val(""));
		 			$('#ask_expert_email').val("");
				  },
				  error: function(xhr, ajaxOptions, thrownError)
				  {
					
				  }
					  
				});
		}

	
	
	});    
});
</script>
<style>
ul li:last-child
{
	border-bottom:none !important;
}
.item_group
{
	height: 95px;
	width: 90px;
	background-color:#fff;
	border: 1px solid #ffc81b;
	display: block;
	margin: 9px;
	padding: 1px;
	font-weight: bold;
	text-decoration: none;
	text-align: center;
	box-shadow: -2px 2px 4px #807B7B;
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	cursor: pointer;
}
.item_group:active
{
	box-shadow:none;
	position:relative;
	top:1px;
}
</style>

<div id="best_mom_line_seperator_homepage" class="thick_line best_mom_background_color"></div>
    
    <div class="global_sperator_height" style="width:100%"></div>
	
    <div class="clear"></div>
       <div class="sections_wrapper_margin" style="position:relative;">

		<div style="position: absolute;left: -180px;top: 320px; z-index:-9;" class="left_drawings_bestcook" ><img src="<?php echo base_url()."images/homepage/homepage_left_drawings_bestmom".$current_language_db_prefix.".png"; ?>" /></div>
		<div style="position: absolute;right: -166px;top: -35px; z-index:-9;" class="left_drawings_bestcook" ><img src="<?php echo base_url()."images/homepage/homepage_right_drawings_bestmom".$current_language_db_prefix.".png"; ?>" /></div>

      <div class="large_box_width_2 home_widget float_left" >
         <?php
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(63,$current_language_db_prefix);
            $this->widgets->generate_homepage_featured_article($subsection_title,'best_mom',$display_bestmom_baby,'best_mom_color','best_mom_background_color','best_mom_borderbottom_color',335,230,$current_language_db_prefix)
			// generate_homepage_recipes('title_name,array_of_data,current_section_color,current_section_background_color,current_section_borderbottom_color,current_image_width,current_image_height,current_language_db_prefix');
            ?>
     	</div>
      
      <div style="height:275px" class="float_left homesperator_width" ></div>
      
      
        <div class="large_box_width_2 home_widget float_left" >
             <?php
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(62,$current_language_db_prefix);
            $this->widgets->generate_homepage_featured_article($subsection_title,'best_mom',$display_bestmom_7amly,'best_mom_color','best_mom_background_color','best_mom_borderbottom_color',335,230,$current_language_db_prefix)
			// generate_homepage_recipes('title_name,array_of_data,current_section_color,current_section_background_color,current_section_borderbottom_color,current_image_width,current_image_height,current_language_db_prefix');
            ?>
      </div>
        
        <div style="height:275px" class="float_left homesperator_width"></div>
        
        <div style="width:270px; height:273px; " class="float_left home_widget">
    
    	<?php
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(179,$current_language_db_prefix);
		$this->widgets->generate_homepage_ask_expert($subsection_title,'best_mom',$display_bestmom_expert,'best_mom_color','best_mom_background_color','best_mom_borderbottom_color',270,229,$current_language_db_prefix);
		?>
    </div>
        
    
    <div class="clear"></div>
    
    <div style="width:100%; height:5px;"></div>
    
    <!-- Replace here -->
    
    <div class="large_box_width_2 home_widget float_left" >
       <?php
            list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(64,$current_language_db_prefix);
            $this->widgets->generate_homepage_featured_article($subsection_title,'best_mom',$display_bestmom_growup,'best_mom_color','best_mom_background_color','best_mom_borderbottom_color',335,230,$current_language_db_prefix)
			// generate_homepage_recipes('title_name,array_of_data,current_section_color,current_section_background_color,current_section_borderbottom_color,current_image_width,current_image_height,current_language_db_prefix');
            ?>
        
      </div>
    
    
    <!-- Done -->
    
    <!-- ENd of esa2l el 5abir  -->
    
    <div style="height:275px" class="float_left homesperator_width" ></div>
    
    <!-- -->
    <div style="width:270px; height:275px; " class="float_left home_widget global_background">
        	<div class="widgets_featured_application">
                 <!--Title Left-->
                <div class="inner_title_wrapper">
                    <div class="sections_wrapper_margin">
                    <?php
					list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(180,$current_language_db_prefix);
					?>
                        <h1 class="best_mom_color" style="font-size:20px;"><?php echo $subsection_title; ?></h1>
                    </div>
                </div>
                <div class="thick_line best_mom_background_color" ></div>
                        
            	<div style="position:relative;" class="application_sildeshow_container best_mom_background_color">
                    <a style="position: absolute;right: 0px;top: 100px;margin: 0 5px;" class="best_mom_homepage_applications_list_next"><img src="<?php echo base_url()."images/white_right_arrow.png" ?>" /></a>
                    <a style="position: absolute;left: 0px;top: 100px;margin: 0 5px;" class="best_mom_homepage_applications_list_prev"><img src="<?php echo base_url()."images/white_left_arrow.png" ?>" /></a>
                
                    <div class="best_mom_homepage_applications_list" style="height:231px;margin: 0 45px;padding-top: 0;">
                    <ul>
                       <?php
                        for($i=0 ; $i < sizeof($display_bestmom_applications) ; $i=$i+2):
                        
                        $id = $display_bestmom_applications[$i]['applications_ID'];
                        $title = $display_bestmom_applications[$i]['applications_title'.$current_language_db_prefix];
                        $logo =  base_url()."uploads/applications/".$this->globalmodel->get_image_src($display_bestmom_applications[$i]['applications_homepage']);
                        
						$id_2 = $display_bestmom_applications[$i+1]['applications_ID'];
						$title_2 = $display_bestmom_applications[$i+1]['applications_title'.$current_language_db_prefix];
                        $logo_2 =  base_url()."uploads/applications/".$this->globalmodel->get_image_src($display_bestmom_applications[$i+1]['applications_homepage']);

						?>
                            <li style="overflow: hidden;float: left;width: 110px;height:227px;">
                            <a>
                            <div class="team_li" style="position:absolute">
                                
                                <a class="item_group" href="<?php echo site_url('best_mom/applications/'.$id)?>" title="">
                                <div class="image_application" align="center"><div style="width:55px; height:55px; background:url(<?php echo $logo; ?>);background-repeat:no-repeat;"></div></div>
                                <div class="homepage_application_title gray_color"><?php echo $title; ?></div>
                                </a>
                                
                                <a class="item_group" href="<?php echo site_url('best_mom/applications/'.$id_2)?>">
                                <div class="image_application" align="center"><div style=" margin-top:13px;width:55px; height:55px; background:url(<?php echo $logo_2; ?>);background-repeat:no-repeat;"></div></div>
                                <div class="homepage_application_title gray_color"><?php echo $title_2; ?></div>
                                </a>
                                
                            </div>
                            <div class="clear"></div>
                            </a>
                            </li>
                        <?php
                        endfor;
                        ?>
                    </ul>
                    </div>
                </div><!--End OF application_sildeshow_container-->
            </div>

        </div>
        
    <div style="height:275px" class="float_left homesperator_width" ></div>
    
    <div class="child_guide_box float_left">
    
		<!-- Add image banner here -->
        <img style="width: 335px;height: 276px;"  src="<?php echo base_url()."images/bestmom/who_square_home_banner".$current_language_db_prefix.".png"?>"  alt="<?php echo lang('bestmom_world_health_organization');?>"/>
        
	</div>
    
    <div class="clear"></div>
    </div>
<div class="global_sperator_height" style="width:100%"></div>

