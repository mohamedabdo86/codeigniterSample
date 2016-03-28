<style>

        .my_qution{
         
            width:1000px;;
            margin:0 auto;
            background-color:#FFF;
			margin-top: 12px;
        }
      .arabic .my_qution h1{
            float: right;
            color:#13758e;
        }
	
        #best_mom_q{
            width: 100%;
			min-height: 200px;
			overflow-y: auto;
			overflow-x: hidden;
        }
        #best_me_q{
            width: 100%;
			min-height: 200px;
			overflow-y: auto;
			overflow-x: hidden;
        }
        #best_cook_q{
            width: 100%;
             min-height: 200px;
			overflow-y: auto;
			overflow-x: hidden;      
			  }
        .section_title{
            float: right;
            color: #FFF;
            background: #ffc81b;
            width: 68%;
            text-align: right;
            margin-right: 30px;
            margin-top: 0px;
            padding: 3px;
        }

        .section_doctor{
            color: #FFF;
            background: #ffc81b;
            width: 22%;
            padding: 3px;
            text-align: center;
            float: left;
            margin-top: 0px;
            margin-left: 50px;
        }	
        .section_question p{	
            float: right;
            margin-right: 53px;
			white-space: normal;
        }
        .section_question span{
            margin: 50%;
            color: #ffc81b;
        }
        #question_result{
            text-align: right;
            border: 3px dashed #ffc81b !important;
            padding: 7px;
            margin: 25px;
        }
        hr{
            width: 93%;
            height: 2px;
            background-color:#CCC;
        }
    </style>

<div class="clear"></div>
<?php echo $this->load->view('template/submenu_writer');   ?>
<?php echo $this->load->view('template/tree_menu_writer');   ?>

        <div class="my_qution">
           
            <div class="sections_wrapper_margin">
	<h1 class="best_time_color float_left" style="font-size:24px; color:#13758e!important"><?php echo lang('globals_my_question'); ?></h1>
        <div class="clear"></div>
</div>
            <div class="thick_line best_time_background_color" style="margin-bottom: 7px; background-color:#13758e!important"></div>
<?php if(sizeof($all_question)<=0){
	
 echo "<h1 style='
padding: 17px; color:#13758e!important;' id='no_question'>".lang('globals_no_question')."</h1>"; 
}
	?>
            <div id="best_mom_q" <?php if(sizeof($Best_Mom_question)<=0){?> style="display:none;"<?php }?>>
                 <div id="section_header">
                    <p class="section_title"><?php echo lang('globals_bestmom'); ?></p>
                    <p class="section_doctor"><?php echo $Best_Mom_doctor[0]['static_name'.$current_language_db_prefix];?></p>
                 </div>
             
              <?php for($i=0 ; $i<sizeof($Best_Mom_question) ; $i++){?>
                  <div class="section_question">
                     <p><?php echo $Best_Mom_question[$i]['ask_expert_question'.$current_language_db_prefix]; ?></p>
                     <span><?php echo lang('globals_answer'); ?></span>
                     <p id="question_result" style="border: 3px dashed red;"> 
					 <?php 
					 if($Best_Mom_question[$i]['ask_expert_answer'.$current_language_db_prefix]!=Null ){
					 echo strip_tags($Best_Mom_question[$i]['ask_expert_answer'.$current_language_db_prefix]);
					 }else{
						
						 echo lang('globals_no_answer');
						
						 }
					 
					 ?></p>
                     <hr/>
                </div>
                     
              <?php } ?>
          


            </div>


            <div id="best_cook_q" <?php if(sizeof($best_cook_question)<=0){?> style="display:none;"<?php }?>>
                <div id="section_header">
                    <p class="section_title" style="background: #FF1B2C;" ><?php echo lang('globals_bestcook'); ?></p>
                    <p class="section_doctor" style="background: #FF1B2C;"><?php echo $best_cook_doctor[0]['static_name'.$current_language_db_prefix];?></p>
                </div>
       
                <?php for($i=0 ; $i<sizeof($best_cook_question) ; $i++){?>
                <div class="section_question">
                   <p><?php echo $best_cook_question[$i]['ask_expert_question'.$current_language_db_prefix]; ?></p>
                     <span style="color: #FF1B2C;"><?php echo lang('globals_answer'); ?></span>
                     <p id="question_result" style="border: 3px dashed red !important;"> 
					 <?php
					 if($best_cook_question[$i]['ask_expert_answer'.$current_language_db_prefix]!=Null ){
					  echo strip_tags($best_cook_question[$i]['ask_expert_answer'.$current_language_db_prefix]); 
					 }else{
						 echo lang('globals_no_answer');
						 
						 }
					  
					  
					  ?></p>
                         <hr/>
                </div>
                     
                <?php } ?>
            </div>



            <div id="best_me_q" <?php if(sizeof($Best_Me_question)<=0){?> style="display:none;"<?php }?>>
                <div id="section_header">
                    <p class="section_title" style="background:#658e15;" ><?php echo lang('globals_bestme'); ?></p>
                    <p class="section_doctor" style="background:#658e15;"><?php echo $Best_Me_doctor[0]['static_name'.$current_language_db_prefix];?></p>
                </div>
              <?php for($i=0 ; $i<sizeof($Best_Me_question) ; $i++){?>
                <div class="section_question">
                   <p><?php echo $best_cook_question[$i]['ask_expert_question'.$current_language_db_prefix]; ?></p>
                     <span style="color: #658e15;"><?php echo lang('globals_answer'); ?></span>
                   <p id='question_result' style='border: 3px dashed #658e15 !important;'><?php 
				   if($Best_Me_question[$i]['ask_expert_answer'.$current_language_db_prefix]!=Null){
				   echo strip_tags($Best_Me_question[$i]['ask_expert_answer'.$current_language_db_prefix]);
				   }else{
					   echo lang('globals_no_answer');
					   }
				   
				   ?></p>
					
                         <hr/>
                </div>
                     
                <?php } ?>

            </div>
        </div>
