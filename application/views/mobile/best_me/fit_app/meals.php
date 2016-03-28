
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<?php $style = $this->nestlefit->nestle_fit_tips_style();?>

<script type="text/javascript">
$(function() {
	$( "#tabs" ).tabs();
});
</script>
<script>
$(document).ready(function(e) { 
	$('.submit_meal').click(function(e) {
		var current_tab_id = $(this).attr('data-id');

		//loop on li to show the calories for each li
		var number_of_li =  $('#InputsWrapper_'+current_tab_id+' li').length;
		if(number_of_li != 0) 
		{
			if(has_no_meals_inserted() == 0) 
			{
				$("#tips_container #"+current_tab_id+"").trigger("click");
				$( "#tabs" ).tabs( "enable" );
			}
		}
		
		<?php /*?>if(has_no_meals_inserted() == 0) 
		{
			for (i = 1; i <=200; i++) 
			{ 
				currentmount = $('#amount_'+i).val();
				currentcalories = $('#calory_'+i).val();
				caculatecalories = currentmount * currentcalories;
				textcalories =caculatecalories+" <?php echo lang('Calories_day');?>";
				$('#calory_num_'+i).attr('data-total',caculatecalories);
				$('#calory_num_'+i).html(textcalories);
				
			}
		}<?php */?>
		
		//loop on li to get the total calories for each tab
		var total_calories = 0;
		var meal_number = 0;
		var caculatecalories = 0;
		var textcalories = '';
		var currentmount = '';
		var currentcalories = '';
		
		$("#InputsWrapper_"+current_tab_id+" li").each(function() {
			
			meal_number =  $(this).find(".meal_recipe").attr('id');
			
			currentmount = $(this).find('#amount_'+meal_number).val();
			currentcalories = $(this).find('#calory_'+meal_number).val();
			caculatecalories = currentmount * currentcalories;
			textcalories = caculatecalories + " <?php echo lang('Calories_day');?>";
			$(this).find('#calory_num_'+meal_number).attr('data-total',caculatecalories);
			$(this).find('#calory_num_'+meal_number).html(textcalories);
		
		 total_calories += parseInt($(this).find(".meal-calories").attr('data-total'));
		});
		
		$('#total_calories_'+current_tab_id).html(total_calories);
		
		
		if(has_no_meals_inserted() == 1)
		{
			e.preventDefault();
		}
		else
		{
			var current_post = $(this).closest('form').serializeArray();
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
			
			var state = new Boolean();
			state = true;
			
			$("#InputsWrapper_"+current_tab_id+" li").each(function() {
			
			var data_recipe_name = $(this).find(".meal_recipe").val();
			var data_recipe_amount = $(this).find(".meal_amount").val();
			
			if(data_recipe_name == '' || data_recipe_amount == '')
			state = false;
			else
			state = true;
			  
			});
			
			if(state == true || number_of_li_inside_tab == 0)
			$( "#tabs" ).tabs("enable");
			else
			$( "#tabs" ).tabs("disable");
			
		}

		return false;
	});
	
});
</script>

<?php
if(!$this->members->members_id)
{
	redirect(site_url('mobile/best_me/applications/9/homepage'), 'refresh');
}
?>



<?php
	$CI =& get_instance();
	$CI->load->library('meals');
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
<div class="row nestle-fit-meals">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<?php
        $members_image = base_url() . "uploads/members/" . $this->members->members_image;
		echo '<div id="nestlefit_member_img_container" style="padding-top: 16px;">'.nestlefit_member_image($members_image,115,115).'</div>';
	?>
</div>
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
       <h3 class="nestlefit_inner_title col-xs-7" style="float:right; text-align:left"><?php echo lang('meals_title'); ?></h3>
       <div id="back_button" style="float:left; margin-top: 160px;" class="col-xs-4">
            <a rel="external" class="back" title="<?php echo lang('globals_back'); ?>" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>"><img alt="<?php echo lang('globals_back'); ?>" title="<?php echo lang('globals_back'); ?>" src="<?php echo base_url().'images/nestle_fit/back.png'; ?>" /></a>
            <a rel="external" class="back-title" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>">  <span style="color:#FFF"><?php echo  lang("nestlefit_back_btn"); ?></span></a>
        </div>
  </div>
   <?php $date_section =$current_language_db_prefix == '_ar' ? 'col-md-pull-5 col-lg-pull-4' : 'col-md-pull-3 col-lg-pull-5';?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-pull-4 col-sm-pull-4 <?php echo $date_section; ?>" style="margin-top:20px;"> 
 
    <?php
        $CI = & get_instance();
        $CI->load->library('widgets');
        $CI->widgets->nestle_fit_picker($start_date, $current_url);
         ?>
      <span class="date" style="color:white;"> <?php echo lang('dayInDate'); ?> <?php echo $current_day;?> </span>
   </div> 
   <div id="tabs" class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
          <ul>
            <li class="float_left"><a data-id="1" id="tabs_1" href="#tabs-1"><span class="meal-img" id="meal_type_icon"><img  src="<?php echo base_url()."images/nestle_fit/breakfast-icon.png"; ?>" class="img-responsive"/></span><p> <?php echo lang('Breakfast_meal'); ?></p></a></li>
            <li class="float_left"><a data-id="2" id="tabs_2" href="#tabs-2"><span class="meal_type_icon2 meal-img"><img  src="<?php echo base_url()."images/nestle_fit/snake-icon.png"; ?>" class="img-responsive"/></span><p> <?php echo lang('Snacks_meal'); ?></p></a></li>
            <li class="float_left"><a data-id="3" id="tabs_3" href="#tabs-3"><span class="meal_type_icon2 meal-img"><img  src="<?php echo base_url()."images/nestle_fit/lunch-icon.png"; ?>" class="img-responsive"/></span><p> <?php echo lang('Lunch_meal'); ?></p></a></li>
            <li class="float_left"><a ata-id="4" id="tabs_4" href="#tabs-4"><span class="meal_type_icon2 meal-img"><img  src="<?php echo base_url()."images/nestle_fit/snake-icon.png"; ?>" class="img-responsive"/></span><p> <?php echo lang('Snacks_meal'); ?></p></a></li>
            <li class="float_left"><a data-id="5" id="tabs_5" href="#tabs-5"><span class="meal_type_icon2 meal-img"><img  src="<?php echo base_url()."images/nestle_fit/dinner-icon.png"; ?>" class="img-responsive"/></span> <p><?php echo lang('Dinner_meal'); ?></p></a></li>
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
		echo $CI->meals->get_meals_mobile($params);
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
		echo $CI->meals->get_meals_mobile($params);
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
		echo $CI->meals->get_meals_mobile($params);
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
		echo $CI->meals->get_meals_mobile($params);
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
		echo $CI->meals->get_meals_mobile($params);
		?> 
        </div>
     
       
   </div>
      
   
</div>

<style>
.ui-tabs .ui-tabs-nav li.ui-tabs-active a, .ui-tabs .ui-tabs-nav li.ui-state-disabled a, .ui-tabs .ui-tabs-nav li.ui-tabs-loading a
{
	background-color: #6dd1f6 !important;
	padding: 8px 5px;
}

.mealmeasure 
{
	  width:59px;
	  margin: 4px;
	  background-color: white;
	  border-radius: 10px;
	  height: 44px;
	  margin-top: 0px;
	  line-height: 3.6;
	  border: none;
	  text-align: center;
	
}
.ui-tabs .ui-tabs-nav li a, .ui-tabs-collapsible .ui-tabs-nav li.ui-tabs-active a
{
	background-color: #aa1c28 !important;
	color:white !important;
}

.meal_button 
{
	-moz-box-shadow: inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow: inset 0px 1px 0px 0px #ffffff;
	box-shadow: inset 0px 1px 0px 0px #ffffff;
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #892b33), color-stop(1, #892b33) );
	background: -moz-linear-gradient( center top, #ebbd3d 5%, #f6be15 100% );
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ebbd3d', endColorstr='#f6be15');
	background-color: #892b33;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
	border:1px solid #892b33;
	display:  inline-block;
	color:  #ffffff;
	font-size:15px;
	line-height:27px;
	text-align:   center;
	padding: 3px 10px;
	cursor: pointer;
	color: white !important;
  height: 40px;
  margin-top: 5px;
}
.meal_button:hover {
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #892b33), color-stop(1, #892b33) );
	background: -moz-linear-gradient( center top, #892b33 5%, #ebbd3d 100% );
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6be15', endColorstr='#ebbd3d');
	background-color: #892b33;
}
.submit_meal{
	background:  -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #6dd1f6), color-stop(1, #6dd1f6) ) !important;
	background-color: #6dd1f6 !important;
	border: 1px solid #6dd1f6 !important;
	}
.submit_meal:hover {
		background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #6dd1f6), color-stop(1, #6dd1f6) ) !important;
		background:-moz-linear-gradient( center top, #6dd1f6 5%, #ebbd3d 100% ) !important;
		background-color: #6dd1f6 !important;
	}

.ui-tabs .ui-tabs-nav li.ui-tabs-active a, .ui-tabs .ui-tabs-nav li.ui-state-disabled a, .ui-tabs .ui-tabs-nav li.ui-tabs-loading a
{
	background-color: #6dd1f6 !important;
	padding: 8px 5px;
}


 


p
{
	white-space: normal;
	  font-size: 8px;
}
.ui-tabs .ui-tabs-nav li.ui-tabs-active a, .ui-tabs .ui-tabs-nav li.ui-state-disabled a, .ui-tabs .ui-tabs-nav li.ui-tabs-loading a
{
	background-color: #6dd1f6 !important;
	padding: 8px 5px;
}
.ui-widget
{
	font-family: 'Droid Arabic Kufi', serif !important; 
}

.ui-tabs .ui-tabs-nav li a{
	padding: 8px 5px;
}



.arabic .meal-calories{
direction: rtl;
}

.meal_list li .meal_recipe
{
	line-height:40px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 10px;
	
}
.meal_list li .meal_amount
{

	width:75px;
	text-align:center;
	line-height:40px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 10px;
}
.meal_list li .recipe
{
	margin:0 10px;
	border:1px #CCC solid;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	background-color:#f8ec9e;
	width:43px;
	height:43px;
}
.meal_list li .recipe a img
{
	padding: 6px 5px;
}

.meal_button:active {
	position:relative;
	top:1px;
}


/*meals design*/

.ui-tabs .ui-tabs-nav
{
    background:none !important;
    border: none !important;
}

.meal_button 
{
	-moz-box-shadow: inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow: inset 0px 1px 0px 0px #ffffff;
	box-shadow: inset 0px 1px 0px 0px #ffffff;
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #892b33), color-stop(1, #892b33) );
	background: -moz-linear-gradient( center top, #ebbd3d 5%, #f6be15 100% );
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ebbd3d', endColorstr='#f6be15');
	background-color: #892b33;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
	border:1px solid #892b33;
	display:  inline-block;
	color:  #ffffff;
	font-size:15px;
	line-height:27px;
	text-align:   center;
	padding: 3px 10px;
	cursor: pointer;
}
.english .link_add_meal,.english .input_add_meal
{
	margin-left: 35px;

}
.meal_button:hover {
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #892b33), color-stop(1, #892b33) );
	background: -moz-linear-gradient( center top, #892b33 5%, #ebbd3d 100% );
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6be15', endColorstr='#ebbd3d');
	background-color: #892b33;
}






#tabs
{
	
	background: none;
	border: none;
}
span img
{
	height: 25px !important;
}
	
.english  .date 
	{
	float: right;
	}
	.ui-input-text input, .ui-input-search input{
		  background:#FFF !important;
		}	
.ui-body-a, .ui-page-theme-a .ui-body-inherit, html .ui-bar-a .ui-body-inherit, html .ui-body-a .ui-body-inherit, html body .ui-group-theme-a .ui-body-inherit, html .ui-panel-page-container-a{
/*	background:none !important;*/
	border:none !important;
	}	
.nestlefit_inner_title{
	margin-top: 170px !important;
	}		
/*	.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
		border:none;
		background:none;
		}*/
	.ui-state-disabled, .ui-widget-content .ui-state-disabled, .ui-widget-header .ui-state-disabled{
	opacity: 1 !important;
	}
	

.back-title 
{
	position: relative;
	color: white;
}
.arabic .back-title 
{
	position: relative;
    top: 21px;
    color: white;
    font-size: 17px;
    left: 32px;
	top: 30px;
}
 /* Smart Phone */
@media (min-width: 320px) and (max-width: 640px) {
	.english .back-title {
		font-size: 17px;
		position: relative;
		top: 32px;
		left: -35px;
	}
	.arabic .back {
		margin-right: 30px;	
	}
}

/*This Media Query For Tablet Vertical */
@media (min-device-width: 800px) and (max-device-width: 1280px){
	
}
</style>