<!-- This Page is not Check availability_email last modify 1-9-2015 By Ayman -->

<script>
$(document).ready(function(e) {
	$("#create_member_class_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();
     
		if( $("#member_name").val() == "" )
		{
			$("#member_name_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#members_email").val() == "" )
		{
			$("#members_email_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#members_email").val() != "" )
		{
			 var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			 if( !emailReg.test($("#members_email").val() ) ) 
			 {
				  $("#members_email_format_error").fadeIn("fast");
				  state = false;
			 } 
		}
		
		if($("#approve_privacy").is(':checked'))
		{
			
		}
		else
		{
			$("#approve_privacy_error").fadeIn("fast");
			state = false;
		}
		
		//alert(state);
		if(state == true)
		{

			$.ajax({
				url : '<?php echo site_url('ajax/insert_member_lesson');  ?>',
				data : $('form').serialize(),
				type: "POST",
				cache: false,
				dataType: "json",
			   success : function(success_array)
			   {
					if(success_array.state == true)
					{
						$('#hiddenlink').html('<div style="text-align: center;"><h1><?php echo lang('globals_member_inserted');?></h1></div>');
					}
					else if(success_array.state == false)
					{
						$('#hiddenlink').html('<div style="text-align: center;"><h1 style="margin:10px;"><?php echo lang('globals_already_inserted');?></h1></div>');
					}
					$("#create_member_class_form")[0].reset();
					$("#hiddenlink").fancybox().trigger('click');
				}
			})
			return false;
		}

		return state;
	});    
	
});
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript">
$( document ).on( "focus", "input.datepicker", function() {

    $( this ).datepicker({
       changeMonth: true,
      	changeYear: true,
	  	yearRange: '1950:2014',
	  	dateFormat: 'yy-mm-dd',
    });
});
</script>
<style>
.field_error{
display:none;	
color:red;
}
#availability_email{
display:none;
}
.table-title{
  background-color: red;
  color: white;
  border-top-right-radius: 15px;
  border-top-left-radius: 15px;
}
.mycorner_button {
  -moz-box-shadow: inset 0px 1px 0px 0px #ffffff;
  -webkit-box-shadow: inset 0px 1px 0px 0px #ffffff;
  box-shadow: inset 0px 1px 0px 0px #ffffff;
  background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f15555), color-stop(1, #d01e1e) );
  background: -moz-linear-gradient( center top, #f15555 5%, #d01e1e 100% );
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f15555', endColorstr='#d01e1e');
  background-color: #f15555;
  -webkit-border-top-left-radius: 7px;
  -moz-border-radius-topleft: 7px;
  border-top-left-radius: 7px;
  -webkit-border-top-right-radius: 7px;
  -moz-border-radius-topright: 7px;
  border-top-right-radius: 7px;
  -webkit-border-bottom-right-radius: 7px;
  -moz-border-radius-bottomright: 7px;
  border-bottom-right-radius: 7px;
  -webkit-border-bottom-left-radius: 7px;
  -moz-border-radius-bottomleft: 7px;
  border-bottom-left-radius: 7px;
  text-indent: 0;
  border: 1px solid #d9d9d9;
  display: inline-block;
  color: #ffffff;
  font-size: 15px;
  font-weight: bold;
  line-height: 35px;
  text-decoration: none;
  text-align: center;
  padding: 2px 13px;
  cursor: pointer;
}
@media (min-width: 768px){
.arabic .form-horizontal .control-label {
	  direction: rtl;
      float: right;
	
	}
}

@media (max-width: 320px){
#single-product-header h5 {
  font-size: 5px;
}
}
body.english #members_phone, body.english #member_mobile{text-indent: 30px !important;}
body.arabic #create_member_class_form input{text-align: right;}
.green_color {color: #197C21 !important;}
</style>
<div class="row">
<?php

$other_month = $this->uri->segment(7);
if($other_month)
{
	$display = $this->cookingclassmodel->current_month_lesson($other_month);
}
else
{
	$display = $this->cookingclassmodel->current_month_lesson();
	
	if($display)
	{
		$current_days = $display[0]['cooking_classes_days'];
		$pieces = explode(";", $current_days);
	}

}
if($display)
{
	$current_id = $display[0]['cooking_classes_ID'];
	$current_title = $display[0]['cooking_classes_title'.$current_language_db_prefix];
	$current_desc = $display[0]['cooking_classes_desc'.$current_language_db_prefix];
	$current_days = $display[0]['cooking_classes_days'];
	$current_image = base_url()."uploads/cooking_classes/".$display[0]['images_src'];
}

if(!$display)
{
	echo '<div style="text-align:center">' .lang("bestcook_no_class_for_this_month") .'</div>';
}
else
{

?>
<div class="col-xs-12 col-sm-12 col-md-12 title">
<h4><?php echo $current_title;?></h4>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cooking-img" style="margin-bottom:10px;">
  <img class="img-responsive" width="100%;" src="<?php echo $current_image; ?>" alt="<?php echo $current_title;?>" />
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cooking-des">
 <p style="white-space:normal;"><?php echo $current_desc; ?></p>
</div>

<div id="hiddenlink"></div>
<!--table-->
<?php
    if(!$other_month)
	{
	?>
  <div class="col-xs-12 col-sm-12 col-md-12 table-title">
    <h2><?php echo lang('globals_month_lesson'); ?></h2>
  </div> 
    <div class="table-responsive col-xs-12 col-sm-12 col-md-12">          
      <table class="table table-bordered">
      <?php
		if($current_language_db_prefix == '_ar')
		{
			$array = array('Sunday'=> 'الأحد' ,'Monday'=>'الأثنين' ,'Tuesday'=> 'الثلاثاء' , 'Wednesday' =>'الأربعاء' , 'Thursday' => 'الخميس' , 'Friday' => 'الجمعة' , 'Saturday' => 'السبت');
		}
		else
		{
			$array = array('Sunday'=> 'Sunday' ,'Monday'=>'Monday' ,'Tuesday'=> 'Tuesday' , 'Wednesday' =>'Wednesday' , 'Thursday' => 'Thursday' , 'Friday' => 'Friday' , 'Saturday' => 'Saturday');
		}
		
		$display_dates = $this->cookingclassmodel->current_month_days($current_id , false);
		$all_dayes = count($display_dates);
		for($i=0;$i<sizeof($display_dates);$i++)
		{
			$days_of_week = $display_dates[$i]['cooking_classes_dates_date'];
			$days =  date("l", strtotime($days_of_week)); 
		}

		foreach ($pieces as $key => $value) 
		{
        echo '<tr>';
		echo '<td>'.$array[$value].'</td>';
		$increment = 0;
		for($i=0;$i<sizeof($display_dates);$i++)
		{
			$days_of_week = $display_dates[$i]['cooking_classes_dates_date'];
			$days =  date("l", strtotime($days_of_week)); 
			if($days == $value)
			{
				$days_of_month =  date("m/d ", strtotime($days_of_week));
				echo '<td>'.$days_of_month.'</td>';
				$increment = $increment + 1;
			}
		}
		if($increment < 4)
		{
			for($j=$increment;$j<4;$j++)
			{
				$background = base_url()."/images/red_strip.png";
				echo '<td style="background-image:url('.$background.');"></td>';
			}
			$increment = 0;
		}
		
		echo '</tr>';
		}
		?>
      </table>
     </div>  
 <?php }?>
<!-- end -->



<div class="col-xs-12 col-sm-12 col-md-12" style="height:5px; background-color:red; margin-top:10px;"></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<h2><?php echo lang('globals_lesson_and_recipes'); ?></h2>
</div>
 <?php
	
	$display_recipes = $this->cookingclassmodel->current_month_recipes($current_id);

    for($i=0;$i<sizeof($display_recipes);$i++)
	{
		$id = $display_recipes[$i]['recipes_ID'];
		$title = $display_recipes[$i]['recipes_title'.$current_language_db_prefix];
		$short_title = $this->common->limit_text($title,60);
		$image = $display_recipes[$i]['images_src'];
		$image_src = base_url().'uploads/recipes/'.$image;
		$url = site_url_mobile("best_cook/delicious_recipes/".generateSeotitle($id ,$title ));?>
		
        <div class="single-product col-xs-6 col-sm-6 col-md-4 col-lg-4" style="margin-bottom: 15px;">
        
                <div id="single-product-header">
                     <a href="<?php echo $url ?>" rel="external"><h5><?php echo $this->common->limit_text($short_title,30);?></h5></a>
                </div>
                <div id="single-product-img"> 
                 <a href="<?php echo $url;?>" title="<?php echo $title; ?>"  rel="external"><img src="<?php echo $image_src; ?>" title="<?php echo $title;?>" alt="<?php echo $title;?>" class="img-responsive img-height" width="100%;"/></a>
                </div>
                
            </div>
        
<?php }?>

<div class="col-xs-12 col-sm-12 col-md-12" style="height:5px; background-color:red; margin-top:10px;"></div>
<?php if(!$other_month):?>
<!-- register form-->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
   <h2><?php echo lang('globals_want_to_subscribe_to_lesson'); ?></h2>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<?php

$attributes = array('class' => 'form-horizontal', 'id' => 'create_member_class_form' , 'role'=>'form');

echo form_open_multipart('',$attributes);
?>
<div class="form-group">
          <label class="control-label col-sm-2" for="member_name"><?php echo lang('globals_form_name');?></label>
          <div class="col-sm-10">
             <?php
                 $data=array( 'name' => 'member_name' ,'id' => 'member_name','class'=>'medium_text' ,'onkeypress' => "return onlyAlphabetsAndSpace(event)");                  
                 echo form_input($data);	
                 echo form_error('member_name'); 
                 echo '<p id="member_name_error" class="field_error">'. lang("bestcook_field_required").'</p>';
               ?>
          </div>
</div>

<div class="form-group">
          <label class="control-label col-sm-2" for="datepicker"><?php echo lang('globals_form_birthdate');?> </label>
          <div class="col-sm-10">
              <?php 
                	$data=array( 'name' => 'members_birthdate' , 'id' => 'datepicker', 'class' => 'medium_text datepicker' ); 		 
     	            echo form_input($data); 
              ?>
          </div>
</div>

<div class="form-group">
          <label class="control-label col-sm-2" for="member_mobile"><?php echo lang('globals_form_mobile');?> </label>
          <div class="col-sm-10">
          <h3 class="font_size_17" id="egyptnumber">+20</h3>
              <?php
                  $data=array( 'name' => 'member_mobile' ,'id' => 'member_mobile','class'=>'medium_text' ,'maxlength'=>10 ,'onkeypress' => "return isNumberKeyOnly(event)");                  
                  echo form_input($data);	
                  echo form_error('member_mobile'); 
                  echo '<p id="member_mobile_error" class="field_error">'. lang("bestcook_field_required").'</p>';
              ?>
          </div>
</div>
   <?php $dates = serialize($display_dates) ?>
<input type="hidden" name="current_language_db_prefix" value="<?php echo $current_language_db_prefix ;?>" />
<input type="hidden" name="current_title" value="<?php echo $current_title; ?>" />
<input type="hidden" name="current_image" value="<?php echo $current_image; ?>"  />
<input type="hidden" name="current_id" value="<?php echo $current_id; ?>"  />
<input type="hidden" name="current_days" value="<?php echo $current_days; ?>"  />

<div class="form-group">
          <label class="control-label col-sm-2" for="members_email"><?php echo lang('cooking_class_email'); ?> </label>
          <div class="col-sm-10">
              <?php 
                 if($current_language_db_prefix == "_ar")
                    {
                      echo '<img id="availability_email" src="'.base_url().'images/camera-loader.gif" />';
                    }
         
                      $data=array( 'name' => 'members_email' ,  'id' => 'members_email' ,'class'=>'medium_text' ); 			 
                      echo form_input($data);
                      if(!$current_language_db_prefix == "_ar")
                    {
                      echo '<img id="availability_email" src="'.base_url().'images/camera-loader.gif" />';
                    }
            
                      echo form_error('members_email');
                      echo '<p id="members_email_error" class="field_error">'. lang("bestcook_field_required").'</p>';
                      echo '<p id="members_email_format_error" class="field_error">'.lang('globals_lform_not_vaild_format').'</p>'; 
            ?>
          </div>
</div>

<div class="form-group">
          <label class="control-label col-sm-2" for="members_phone"> <?php echo lang('globals_form_phone');?> </label>
          <div class="col-sm-10">
          	<h3 class="font_size_17" id="egyptnumber">+20</h3>
            <input type="text" name="members_phone" id="members_phone" class="medium_text"  onkeypress="return isNumberKeyOnly(event)"/>
          </div>
</div>

<div class="form-group">
          <label class="control-label col-sm-2" for="members_lesson"> <?php echo lang('globals_subscribe_to_lesson');?>  </label>
          <div class="col-sm-10">
                 <select name="lesson_day" id="members_lesson" class='best_cook_search_styled_select_box float_left' style='width:80%'>
                       <?php
	                      $display_dates = $this->cookingclassmodel->current_month_days($current_id , false);
	                      for($i=0; $i<sizeof($display_dates); $i++):
		                   echo "<option value='".$display_dates[$i]['cooking_classes_dates_date']."'>".$display_dates[$i]['cooking_classes_dates_date']."</option>";
	                      endfor;
	
	                    ?>

                  </select>
          </div>
</div>

<div class="form-group">
  <div class="col-sm-10" style=" margin-bottom:15px">
     <a target="_blank" href="<?php echo site_url_mobile("terms_conditions");?>" style="text-decoration:underline"><?php echo lang('globals_accept_terms'); ?></a>
  </div>
 <div class="col-sm-2">

         
        <?php
		    $data = array('name' => 'approve_privacy','id'=> 'approve_privacy','value'=> 'accept');
           echo form_checkbox($data);
            echo form_error('approve_privacy');
            echo '<p id="approve_privacy_error" class="field_error">'. lang("globals_must_approve").'</p>';
        ?> 
 </div>
</div>


<?php
   $data = array('type' => 'submit','name' => 'submit','class' => 'mycorner_button', 'value' => lang('globals_subscribe'));
   echo  form_submit($data);
?>
</div>
<!--end register form-->
<?php
endif;
?>

<?php } ?>
</div>
