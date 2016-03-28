<link rel="alternate" href="<?php echo base_url()."css/deros_tab5_styles.css"?>"  />
<script>
$(document).ready(function(e) {
	
	$('#members_email').change(function(e) {
		var email = $("#members_email").val();
		
		 var emailReg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		 if(emailReg.test(email) ) 
		 {

		$("#availability_email").show();
		$.ajax({
			 url:  "<?php echo site_url("ajax/check_valid_cooking_class_email"); ?>",
			type:"POST",
			data: {email : email },
			cach:"false",
			dataType: "json",
			success: function(success_array)
			  {
				//alert('Done');
				$("#availability_email").fadeOut("slow");
				if(success_array.state == true)
				{
					$('#email_flag').val(1);
					$('#members_email_validation').fadeIn("fast");
					$('#members_email_validation').html('<?php echo lang('globals_lform_email_available')?>') ;
					$('#members_email_validation').removeClass('red_color');
					$('#members_email_validation').addClass('green_color');
					$('#members_email_error').hide();
					$('#members_email_format_error').hide();
					
				}
				else
				{
					$('#email_flag').val(0);
					$('#members_email_validation').fadeIn("fast");
					$('#members_email_validation').html('<?php echo lang('globals_lform_email_not_available')?>') ;
					$('#members_email_error').hide();
					$('#members_email_validation').removeClass('green_color');
					$('#members_email_validation').addClass('red_color');
					$('#members_email_format_error').hide();
					return false;
				}
	
			  },
			error: function(xhr, ajaxOptions, thrownError)
			{
				return false;
			}
				
			
			});
			
		 }
    });	
		
	$("#create_member_class_form").submit(function(e) {
    	 
		var state = true;
		$(".field_error").hide();

		if( $("#member_name").val() == "" )
		{
			$("#member_name_error").fadeIn("fast");
			state = false;
		}
		
		if( $("#email_flag").val() == 0 )
		{
			$('#members_email_validation').fadeIn("fast");
			state = false;
		}
		
		if( $("#members_email").val() == "" )
		{
			$("#members_email_validation").hide();
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
						$('#hiddenlink').html('<div style="text-align: center;width: 350px;padding: 50px;height: 45px;"><h1><?php echo lang('globals_member_inserted');?></h1></div>');
					}
					else if(success_array.state == false)
					{
						$('#hiddenlink').html('<div style="text-align: center;width: 350px;padding: 50px;height: 45px;"><h1 style="margin:10px;"><?php echo lang('globals_already_inserted');?></h1></div>');
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

<?php

$other_month = $this->uri->segment(6);
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

<div id="hiddenlink"></div>

<div class="float_left" style="width:500px; height:auto;">
	<div class="first_row">
    	<img class="float_left rounded_border" width="225" src="<?php echo $current_image; ?>" alt="<?php echo $current_title;?>" />
        <h3 class="float_left best_cook_color" style="font-size: 20px;margin: 45px 5px 0 5px;"><?php echo $current_title;?></h3>
        <div class="clear"></div>
        <p style="white-space:normal;"><?php echo $current_desc; ?></p>
    </div>
    <?php
    if(!$other_month)
	{
	?>
    <div class="second_row" style="margin-top:20px;">
    <h2 class="best_cook_background_color white_color class_recipes"><?php echo lang('globals_month_lesson'); ?></h2>
    	<table class="dir float_left">
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
    
    <?php
	}
	else
	{?>
    <div class="second_row">
    </div>
    <?php
	}
	?>

</div>

<div class="float_right" style="width:425px; height:auto;">
<h2 class="best_cook_background_color white_color class_recipes"><?php echo lang('globals_lesson_and_recipes'); ?></h2>

	<ul class="class_recipes_list">
    <?php
	
	$display_recipes = $this->cookingclassmodel->current_month_recipes($current_id);

    for($i=0;$i<sizeof($display_recipes);$i++)
	{
		$id = $display_recipes[$i]['recipes_ID'];
		$title = $display_recipes[$i]['recipes_title'.$current_language_db_prefix];
		$short_title = $this->common->limit_text($title,60);
		$image = $display_recipes[$i]['images_src'];
		$image_src ='https://www.mynestle.com.eg/images/Recipes/'.$image;
		
		$url = site_url('best_cook/delicious_recipes/'.$id);
		
		
		echo '<li>';
		echo '<a href="'.$url.'" title="'.$title.'"><img style="border:none;" class="float_left rounded_border" width="95" height="75" src="'.$image_src.'" alt="'.$title.'"/></a>';
		echo '<a href="'.$url.'"><h3 class="best_cook_color">'.$short_title.'</h3></a>';
		echo '</li>';
	}
	
	?>
    </ul>
	
</div>
<?php if($other_month){ ?>
<div class="float_left" style="width:500px; height:auto; margin-top:20px;">
<a href="<?php echo site_url('best_cook/applications/2/class/#lesson_register'); ?>">
<img src="<?php echo base_url()."images/bestcook/DROSTAB5.png"; ?>" width="500" height="255"  style="border-radius:10px; border:none;"/>
</a>
</div>
<?php } ?>

<div class="clear"></div>

<?php
if(!$other_month):
?>
<div class="only_current_month" style="margin-top:10px;" id="lesson_register">

<div class="title_big best_cook_background_color">
    <div class="shadow_left"></div>
    <div class="title_text white_color"><?php echo lang('globals_want_to_subscribe_to_lesson'); ?></div>
    <div class="shadow_right"></div>
</div>
<div class="address">
	<h1 class="float_left"><?php echo lang('globals_nestle_residence'); ?><span> / </span><?php echo lang('globals_nestle_street'); ?></h1>
    <h1 class="float_right"><?php echo lang('globals_hot_line'); ?><span> / </span><?php echo lang('globals_nestle_number'); ?></h1>
    <div class="clear"></div>
    
</div>
<div class="class_form">
<?php

$attributes = array('class' => '', 'id' => 'create_member_class_form');

echo form_open_multipart('',$attributes);
?>
<div style="width:850px;" class="float_left">
    <!--Member name-->
    <div class="float_left" >
    <label for="member_name" class="fontweight"><?php echo lang('globals_form_name');?> </label> <br/>
    <?php
    $data=array( 'name' => 'member_name' ,'id' => 'member_name','class'=>'medium_text' );                  
    echo form_input($data);	
    echo form_error('member_name'); 
    echo '<p id="member_name_error" class="field_error">'. lang("bestcook_field_required").'</p>';
    ?>
    </div>
    <!--Member Age-->
    <div class="float_left" style="margin: 0 32px;">
       <label for="day" class="fontweight"><?php echo lang('globals_form_birthdate');?>  </label> <br/>
	   <?php 
      	$data=array( 'name' => 'members_birthdate' , 'id' => 'datepicker', 'class' => 'medium_text datepicker' ); 		 
     	echo form_input($data); 
      ?>
    </div>
   
    <!--Member Mobile number-->
    <div class="float_right" >
    <label for="member_mobile" class="fontweight"><?php echo lang('globals_form_mobile');?> </label> <br/>
    <?php
    $data=array( 'name' => 'member_mobile' ,'id' => 'member_mobile','class'=>'medium_text' );                  
    echo form_input($data);	
    echo form_error('member_mobile'); 
    echo '<p id="member_mobile_error" class="field_error">'. lang("bestcook_field_required").'</p>';
    ?>
    </div>
    <div class="clear"></div>
    <div class="global_sperator_height" style="width:100%"></div>
</div>

<div style="width:555px;" class="float_left">
   <!--Member Email--> 
   <?php $dates = serialize($display_dates) ?>
<input type="hidden" name="current_language_db_prefix" value="<?php echo $current_language_db_prefix ;?>" />
<input type="hidden" name="current_title" value="<?php echo $current_title; ?>" />
<input type="hidden" name="current_image" value="<?php echo $current_image; ?>"  />
<input type="hidden" name="current_id" value="<?php echo $current_id; ?>"  />
<input type="hidden" name="current_days" value="<?php echo $current_days; ?>"  />
     <div class="float_left">
                    
        <label for="members_email" class="fontweight"><?php echo lang('cooking_class_email'); ?>  </label> <br/>
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
            echo '<p id="members_email_validation" class="field_error"></p>'; 
            echo '<p id="members_email_format_error" class="field_error">'.lang('globals_lform_not_vaild_format').'</p>'; 
            ?>
         

    </div>
    
    
    
     <!--Member Mobile--> 
    <div class="float_right">
        <label for="members_phone" class="fontweight"> <?php echo lang('globals_form_phone');?></label> <br/>
        <input type="text" name="members_phone" class="medium_text" />
    </div>
    <div class="clear"></div>
    <div class="global_sperator_height" style="width:100%"></div>
</div>


<div style="width: 950px;" class="float_left">

<label for="members_email" class="fontweight"><?php echo lang('globals_subscribe_to_lesson');?>  </label> <br/>
<div class="float_left medium_text">
    <div class="float_left" style="width:5%; height:47px;"></div>
    <div class="float_left" style="width:15%;" >
    </div>
    <select name="lesson_day" class='best_cook_search_styled_select_box float_left' style='width:80%'>
     <?php
	$display_dates = $this->cookingclassmodel->current_month_days($current_id , false);
	for($i=0; $i<sizeof($display_dates); $i++):
		echo "<option value='".$display_dates[$i]['cooking_classes_dates_date']."'>".$display_dates[$i]['cooking_classes_dates_date']."</option>";
		//$display_dates[$i]['cooking_classes_dates_date']."<br />";
	endfor;
	//echo form_dropdown('lesson_day', $display_dates , 'large', "class='best_cook_search_styled_select_box float_left' style='width:80%' ");
	?>

    </select>
   
    </div>
    
    <div style="margin: 0 20px;" class="float_left">
        <div class="dir float_left" style="margin: 0 10px;">
        <?php
        $data = array('name' => 'approve_privacy','id'=> 'approve_privacy','value'=> 'accept',);
        echo form_checkbox($data);?> <?php echo lang('globals_accept_terms'); ?>
        
        <?php
            echo form_error('approve_privacy');
            echo '<p id="approve_privacy_error" class="field_error">'. lang("globals_must_approve").'</p>';
        ?> 
        </div>
        <div class="float_right">
        <?php
            $data = array('type' => 'submit','name' => 'submit','class' => 'mycorner_button', 'value' => lang('globals_subscribe'));
            echo  form_submit($data);
         ?>
         </div>
     </div>
            
    </div>
    

</div>
<div class="clear"></div>
</div><!--# end #only_cuurent_month-->
<?php
endif;
}
?>
<div class="global_sperator_height" style="width:100%"></div>
