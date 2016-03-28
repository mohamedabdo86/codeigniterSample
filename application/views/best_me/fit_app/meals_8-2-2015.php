<link rel="stylesheet" href="<?php echo base_url()."css/jquery-ui.css"?>">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<?php $style = $this->nestlefit->nestle_fit_tips_style();?>
<script type="text/javascript">
$(function() {
	$( "#tabs" ).tabs();
});
</script>
<script>
$(document).ready(function(e) { 
	$("div.fancybox[id=test]").trigger("click");
	$('.send_meals').submit(function(e) {
		var current_tab_id = $(this).attr('data-id');
		if(has_no_meals_inserted() == 1)
		{
			e.preventDefault();
		}
		else
		{
			var current_post = $(this).serialize();
			$.ajax({
					  url:  "<?php echo site_url("ajax/add_meals"); ?>",
					  type: "POST",
					  data: current_post,
					  cache: false,
					  dataType: "json",
					  success: function(success_array)
					  {

					  },
					  error: function(xhr, ajaxOptions, thrownError)
					  {
						  //alert(thrownError);
						//alert("wrong"+thrownError);
					  }
					  
				});
			
			return false;
		}
    });
	

	$( ".submit_meal" ).live( "click", function(e) {
        var current_tab_id = parseInt($(this).attr("data-id"));

		var number_of_li =  $('#InputsWrapper_'+current_tab_id+' li').length;
		if(number_of_li != 0) 
		{
			//var meals = $('##InputsWrapper_'+current_tab_id+' li .meal_recipe').val();
			if(has_no_meals_inserted() == 0) 
			{
				$("#tips_container #"+current_tab_id+"").trigger("click");
				$( "#tabs" ).tabs( "enable" );
			}
		}
		
		if(has_no_meals_inserted() == 0) 
		{
			for (i = 2; i <=200; i++) 
			{ 
				currentmount = $('#amount_'+i).val();
				currentcalories = $('#calory_'+i).val();
				caculatecalories = currentmount * currentcalories;
				textcalories =caculatecalories+" <?php echo lang('Calories_day');?>";
				$('#calory_num_'+i).attr('data-total',caculatecalories);
				$('#calory_num_'+i).html(textcalories);
				
			}
		}
		
		//loop on li to get the total calories for each tab
		var total_calories = 0;
		$("#InputsWrapper_"+current_tab_id+" li").each(function() {
		
		 total_calories += parseInt($(this).find(".meal-calories").attr('data-total'));
		});
		
		$('#total_calories_'+current_tab_id).html(total_calories);
		

    });
	
	
	function has_no_meals_inserted()
	{
		var no_meals = 0 ;
		
		$('.add_meal_field').each(function(index, element) {
                if($(this).val().trim() == '')
				{
					$(this).css("border", "2px solid red");
					no_meals = 1;
				}
            });
			
		$('.add_amount_field').each(function(index, element) {
                if($(this).val().trim() == '')
				{
					$(this).css("border", "2px solid red");
					no_meals = 1;
				}
            });
			
			return no_meals;
	}
    
});
</script>
<script>
$(document).ready(function(e) {
	//$("body").on("click",".removeclass", function(e){ //user click on remove text
	$( ".removeclass" ).live( "click", function(e) {
	//$("#div2").live("click", function() {

		
		var current_tab_id = $(this).attr('data-id'); // to get the is of curret tab you are in 
		
		var number_of_li_inside_tab = $( "#InputsWrapper_"+current_tab_id+" li" ).size(); // to get the size of li inside tab 
		
		if( number_of_li_inside_tab >= 1 ) 
		{
			$(this).parent().parent('li').remove(); //remove text box
			number_of_li_inside_tab--; //decrement textbox
			
			$('#InputsWrapper_'+current_tab_id).attr('data-list', number_of_li_inside_tab);// to add number of li in InputsWrapper
		
			$("#InputsWrapper_"+current_tab_id+" li").each(function() {
			
			var data_recipe_name = $(this).find(".meal_recipe").val();
			var data_recipe_amount = $(this).find(".meal_amount").val();
			
			if(data_recipe_name == '' || data_recipe_amount == '')
			{
				$( "#tabs" ).tabs("disable");
			}
			else
			{
				$( "#tabs" ).tabs("enable");
			}
			  
			});
				
			
			if(number_of_li_inside_tab == 0)
			{
				$( "#tabs" ).tabs("enable");
			}
			
		}

		return false;
	});
	
});
</script>

<?php
if(!$this->members->members_id)
{
	redirect(site_url('best_me/applications/9/homepage'), 'refresh');
}

//Load Meals library
$CI =& get_instance();
$CI->load->library('meals');
?>

<div class="meals_container">


<!--Fancybox For Tips-->
<?php
echo '<div id="tips_container">';
for($i=0;$i<sizeof($meals_tips_types); $i++)
{
	$meals_type_id = $meals_tips_types[$i]['nestle_fit_tips_types_ID'];
	
	$tips = $this->nestlefit->nestle_fit_tips($meals_type_id,$current_language_db_prefix);
	if(sizeof($tips)!=0){
	$image_tip = $tips[0]['images_src'];
	echo '<img id="'.$meals_type_id.'" class="fancybox meals_tips" src="'. base_url().'uploads/tips/'.$image_tip.' "/>';
	}
}
echo '</div>';


$members_image=base_url()."uploads/members/".$this->members->members_image;
echo '<div id="nestlefit_member_img_container" style="padding-top:13px;">'.nestlefit_member_image($members_image,130,130).'</div>';
?>
    <?php 
	$day= date('Y-m-d');
	if($val_4==0)
	{
		$current_day = $day;
		$current_url = current_url();
	}
	else
	{
		$current_day=$val_4;
        $delete = "/" . $val_4;
        $current_url = str_replace($delete, "", current_url());	
	}
	
	?>
    <div id="meals_details">
        <h3 id="water_header_title"><?php echo lang('meals_title'); ?></h3>
        <div id="back_button">
            <a class="back" title="<?php echo lang('globals_back'); ?>" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>"><img alt="<?php echo lang('globals_back'); ?>" title="<?php echo lang('globals_back'); ?>" src="<?php echo base_url().'images/nestle_fit/back.png'; ?>" /></a>
            <a class="back-title" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>">  <span><?php echo  lang("nestlefit_back_btn"); ?></span></a>
        </div>
        <div id="calender">
        <?php
            $CI = & get_instance();
            $CI->load->library('widgets');
            $CI->widgets->nestle_fit_picker($start_date, $current_url);
        ?>
        </div>
         <p id="day"><?php echo lang('dayInDate'); ?> <?php echo $current_day;?></p>       
	</div>
    
    <div id="meals_wrapper" class="float_left">

    <div id="tabs" class="float_left">
        <ul>
            <li class="float_left"><a style="padding:8px;" data-id="1" id="tabs_1" href="#tabs-1"><span id="meal_type_icon"><img  src="<?php echo base_url()."images/nestle_fit/breakfast-icon.png"; ?>"/></span> <?php echo lang('Breakfast_meal'); ?></a></li>
            <li class="float_left"><a style="padding:8px;" data-id="2" id="tabs_2" href="#tabs-2"><span class="meal_type_icon2"><img  src="<?php echo base_url()."images/nestle_fit/snake-icon.png"; ?>"/></span> <?php echo lang('Snacks_meal'); ?></a></li>
            <li class="float_left"><a style="padding:8px;" data-id="3" id="tabs_3" href="#tabs-3"><span class="meal_type_icon2"><img  src="<?php echo base_url()."images/nestle_fit/lunch-icon.png"; ?>"/></span> <?php echo lang('Lunch_meal'); ?></a></li>
            <li class="float_left"><a style="padding:8px;" data-id="4" id="tabs_4" href="#tabs-4"><span class="meal_type_icon2"><img  src="<?php echo base_url()."images/nestle_fit/snake-icon.png"; ?>"/></span> <?php echo lang('Snacks_meal'); ?></a></li>
            <li class="float_left"><a style="padding:8px;" data-id="5" id="tabs_5" href="#tabs-5"><span class="meal_type_icon2"><img  src="<?php echo base_url()."images/nestle_fit/dinner-icon.png"; ?>"/></span> <?php echo lang('Dinner_meal'); ?></a></li>
        </ul>
        
        <div id="tabs-1">
		<?php
		$foreign_id = 1;
		if($val_4)
		{
			$current_day = $val_4;
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id); // $val_2 = $member_id ;; $val_4 = day
			$read_only = 'readonly="readonly"';
		}
		else
		{
			$current_day = date('Y-m-d');
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id);
			$read_only = false;
		}
		$params = array('data'=>$data,'val_4'=>$val_4,'val_2'=>$val_2,'read_only'=>$read_only,'foreign_id'=>$foreign_id);
		echo $CI->meals->get_meals($params);
		?>           
        </div>
        <div id="tabs-2">
        <?php
		$foreign_id = 2;
		if($val_4)
		{
			$current_day = $val_4;
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id); // $val_2 = $member_id ;; $val_4 = day
			$read_only = 'readonly="readonly"';
		}
		else
		{
			$current_day = date('Y-m-d');
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id);
			$read_only = false;
		}
		$params = array('data'=>$data,'val_4'=>$val_4,'val_2'=>$val_2,'read_only'=>$read_only,'foreign_id'=>$foreign_id);
		echo $CI->meals->get_meals($params);
		?> 
        </div>
        <div id="tabs-3">
        <?php
		$foreign_id = 3;
		if($val_4)
		{
			$current_day = $val_4;
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id); // $val_2 = $member_id ;; $val_4 = day
			$read_only = 'readonly="readonly"';
		}
		else
		{
			$current_day = date('Y-m-d');
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id);
			$read_only = false;
		}
		$params = array('data'=>$data,'val_4'=>$val_4,'val_2'=>$val_2,'read_only'=>$read_only,'foreign_id'=>$foreign_id);
		echo $CI->meals->get_meals($params);
		?> 
        </div>
        <div id="tabs-4">
        <?php
		$foreign_id = 4;
		if($val_4)
		{
			$current_day = $val_4;
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id); // $val_2 = $member_id ;; $val_4 = day
			$read_only = 'readonly="readonly"';
		}
		else
		{
			$current_day = date('Y-m-d');
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id);
			$read_only = false;
		}
		$params = array('data'=>$data,'val_4'=>$val_4,'val_2'=>$val_2,'read_only'=>$read_only,'foreign_id'=>$foreign_id);
		echo $CI->meals->get_meals($params);
		?>  
        	
        </div>
        <div id="tabs-5">
        <?php
		$foreign_id = 5;
		if($val_4)
		{
			$current_day = $val_4;
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id); // $val_2 = $member_id ;; $val_4 = day
			$read_only = 'readonly="readonly"';
		}
		else
		{
			$current_day = date('Y-m-d');
			$data = $this->nestlefit->get_meals($val_2,$current_day,$foreign_id);
			$read_only = false;
		}
		$params = array('data'=>$data,'val_4'=>$val_4,'val_2'=>$val_2,'read_only'=>$read_only,'foreign_id'=>$foreign_id);
		echo $CI->meals->get_meals($params);
		?> 
        </div>
<!--        <a class="back" style="position: relative;top: 40px;" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>">Back</a>-->
    </div>
    
    <div class="clear"></div>
    </div>
</div>

