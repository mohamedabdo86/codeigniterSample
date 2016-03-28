<link rel="stylesheet" href="<?php echo base_url()."css/jquery-ui.css"?>">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
$(function() {
$( "#tabs" ).tabs();
});
</script>
<style>
.meals_container
{
	background-image:url(<?php echo base_url()?>images/bestme/meals_bg.jpg);
	height:600px;
}
p
{
	white-space: normal;
}
#tabs
{
	width: 585px;
	margin-top: 154px;
}
.meal_list li
{
	padding: 5px 0;
}
.meal_list li .meal_recipe
{
	width:300px;
	height:40px;
	line-height:40px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	
}
.meal_list li .meal_amount
{
	margin:0 10px;
	width:75px;
	height:40px;
	line-height:40px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
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
.meal_list li .delete
{
	margin:0 10px;
	border:1px #CCC solid;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	background-color:#f6a1b1;
	width:43px;
	height:43px;
}
.meal_list li .delete a img
{
	padding: 2px 7px;
}

.meal_button {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ebbd3d), color-stop(1, #f6be15) );
	background:-moz-linear-gradient( center top, #ebbd3d 5%, #f6be15 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ebbd3d', endColorstr='#f6be15');
	background-color:#ebbd3d;
	-webkit-border-top-left-radius:6px;
	-moz-border-radius-topleft:6px;
	border-top-left-radius:6px;
	-webkit-border-top-right-radius:6px;
	-moz-border-radius-topright:6px;
	border-top-right-radius:6px;
	-webkit-border-bottom-right-radius:6px;
	-moz-border-radius-bottomright:6px;
	border-bottom-right-radius:6px;
	-webkit-border-bottom-left-radius:6px;
	-moz-border-radius-bottomleft:6px;
	border-bottom-left-radius:6px;
	text-indent:0px;
	border:1px solid #e0ab19;
	display:inline-block;
	color:#ffffff;
	font-size:15px;
	font-weight:bold;
	line-height:30px;
	text-decoration:none;
	text-align:center;
	padding:5px 10px;
	cursor:pointer;
}
.meal_button:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f6be15), color-stop(1, #ebbd3d) );
	background:-moz-linear-gradient( center top, #f6be15 5%, #ebbd3d 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6be15', endColorstr='#ebbd3d');
	background-color:#f6be15;
}.meal_button:active {
	position:relative;
	top:1px;
}
</style>
<?php
	if($val_4)
	{
		$current_day = $val_4;
		$read_only = 'readonly="readonly"';
	}
	else
	{
		$current_day = date('Y-m-d');
		$read_only = false;
	}
?>
<script>
$(document).ready(function(e) {
	
	$('.send_meals').submit(function(e) {
		
		var current_post = $(this).serialize();
		
		$.ajax({
				  url:  "<?php echo site_url("ajax/add_meals"); ?>",
				  type: "POST",
				  data: current_post,
				  cache: false,
				  dataType: "json",
				  success: function(success_array)
				  {
					 // $("#loading").hide();
						//alert('Done');
					
				  },
				  error: function(xhr, ajaxOptions, thrownError)
				  {
					//alert("wrong"+thrownError);
				  }
				  
			});
        
		return false;
    });
	
	$('.submit_meal').click(function(e) {
        var id = $(this).attr("data-id");
		$("#tabs_"+id).click();
    });
    
});
</script>
<script type="text/javascript">
	$(document).ready(function() {
	
		var MaxInputs       = 8; //maximum input boxes allowed
		var InputsWrapper   = $("#InputsWrapper"); //Input boxes wrapper ID
		var AddButton       = $("#AddMoreFileBox"); //Add button ID
		
		var x = <?php echo count($data)?>; //Add button ID
		
		//var x = InputsWrapper.length; //initlal text box count
		//alert(x);
		var FieldCount=1; //to keep track of text box added
		<?php /*?>var Childname = "<?php echo lang('mycorner_child_name');?>";
		var Childage = "<?php echo lang('mycorner_child_age');?>";<?php */?>
		
		$(AddButton).click(function (e)  //on add input button click
		{
				if(x <= MaxInputs) //max input box allowed
				{
					FieldCount++; //text box added increment
					//add input box
					//$(InputsWrapper).append('<tr><td><h5> '+ Childname +'</h5></td><td><input type="text" name="children_name[]" id="field_'+ FieldCount +'" value=""/></td><td><h5> '+ Childage +'</h5></td><td><input type="text" name="children_age[]" id="field_'+ FieldCount +'" value=""><a href="#" class="removeclass float_right" style=" font-family: Verdana, Geneva, sans-serif;"> X </a></td></tr>');
					$(InputsWrapper).append('<li><input type="text" name="the_meal[]" placeholder="الصنف" id="'+ FieldCount +'" value="" class="meal_recipe search float_left " /><input type="text" name="meal_amount[]" placeholder="الكمية" id="amount_'+ FieldCount +'" value="" class="meal_amount float_left" /><input type="hidden" name="meal_value[]" class="meal_value" id="field_'+ FieldCount+'" /><div class="recipe float_left"><a href="#"><img src="<?php echo base_url(); ?>images/recipe_icon.png" /></a></div><div class="delete float_left"><a href="#" class="removeclass"><img src="<?php echo base_url(); ?>images/trash.png" /></a></div><div class="clear"></div></li>');						

					x++; //text box increment
				}
				
			$( ".search" ).autocomplete({
			
		  minLength: 2,
		  source: function( request, response ) {
	
			$.getJSON("<?php echo site_url("ajax/food_search"); ?>", request, function( data, status, xhr ) {
			 //cache[ term ] = data; // mofified 29-7-2013 - by bermawy
	
			   response( $.map( data.geonames, function( item ) {
				  return {
				   id : item.value,
				   label: item.name ,
				   value: item.name
				  }
				}));
			});
			 
		  },
		   select: function( event, ui ) 
		   {
			   var current_id = $(this).attr('id');
				$('#field_'+current_id+'').val(ui.item.id);
		   }
		});
				
		return false;
		});

		$("body").on("click",".removeclass", function(e){ //user click on remove text
		
				if( x >= 0 ) 
				{
					$(this).parent().parent('li').remove(); //remove text box
					x--; //decrement textbox
				}
		return false;
		}) 
		
	});
</script>
<script>
$(document).ready(function(e) {
    $( ".search" ).autocomplete({
		
	  minLength: 2,
	  source: function( request, response ) {
		  
		  
		 /* var term = request.term;
		if ( term in cache ) {
		  response( cache[ term ] );
		  return;
		}*/ // mofified 29-7-2013 - by bermawy
 
		$.getJSON("<?php echo site_url("ajax/food_search"); ?>", request, function( data, status, xhr ) {
		 //cache[ term ] = data; // mofified 29-7-2013 - by bermawy

		   response( $.map( data.geonames, function( item ) {
			  return {
			   id : item.value,
			   label: item.name ,
			   value: item.name
			  }
			}));
		});
		 
	  },
	   select: function( event, ui ) 
	   {
		   var current_id = $(this).attr('id');
        	$('#field_'+current_id+'').val(ui.item.id);
	   }
	
	});
});
</script>

<div class="meals_container">
    <div id="tabs" class="float_left">
        <ul>
            <li class="float_left"><a id="tabs_1" href="#tabs-1">فطار</a></li>
            <li class="float_left"><a id="tabs_2" href="#tabs-2">سناكس</a></li>
            <li class="float_left"><a id="tabs_3" href="#tabs-3">غداء</a></li>
            <li class="float_left"><a id="tabs_4" href="#tabs-4">سناكس</a></li>
            <li class="float_left"><a id="tabs_5" href="#tabs-5">عشاء</a></li>
        </ul>
        
        <div id="tabs-1">
         	<?php
			
				if($val_4)
				{
				$data = $this->nestlefit->get_meals($val_2,$current_day,1); // $val_2 = $member_id ;; $val_4 = day ;; type 
				$display_sting = '';
				$display_sting .= '<ul class="meal_list">';
					for($i=0;$i<sizeof($data);$i++):
					
					$meals = $data[$i]['nestle_fit_food_title'];
					$amount = $data[$i]['nestle_fit_meals_amount'];
					
					$display_sting .= '<li>';
					$display_sting .= '<input type="text" name="the_meal[]" '.$read_only.' placeholder="الصنف" id="'.($i+1).'" value="'.$meals.'" class="meal_recipe search float_left" />';
					$display_sting .= '<input type="text" name="meal_amount[]" '.$read_only.' placeholder="الكمية" id="amount_'.($i+1).'" value="'.$amount.'" class="meal_amount float_left" />';
					//$display_sting .= '<input type="hidden" name="meal_value[]" class="meal_value" id="field_'.($i+1).'" />';
					//$display_sting .= '<div class="recipe float_left"><a href="#"><img src="'.base_url().'images/recipe_icon.png" /></a></div>';
					//$display_sting .= '<div class="delete float_left"><a href="#" class="removeclass"><img src="'.base_url().'images/trash.png" /></a></div>';
					$display_sting .= '<div class="clear"></div>';
					$display_sting .= '</li>';
					
					echo $display_sting;
					endfor; 
				$display_sting .= '</ul>';
				}
				else
				{
				?>
            	<form method="post" class="send_meals" name="send_meals" enctype="multipart/form-data" />
                <input type="hidden" value="1" name="meal_type" />
                <input type="hidden" value="<?php echo date('Y-m-d')?>" name="meal_date" />
                <input type="hidden" value="<?php echo $val_2 ?>" name="member_id" />
               
               <ul class="meal_list"  id="InputsWrapper">
                  <?php
					$display_sting = '';
					$data = $this->nestlefit->get_meals($val_2,$current_day,1);
					for($i = 0; $i<sizeof($data);$i++)
					{
						$meals = $data[$i]['nestle_fit_food_title'];
						$amount = $data[$i]['nestle_fit_meals_amount'];
						$display_sting .= '<li>';
						$display_sting .= '<input type="text" name="the_meal[]" placeholder="الصنف" id="'.($i+1).'" value="'.$meals.'" class="meal_recipe search float_left" />';
						$display_sting .= '<input type="text" name="meal_amount[]" placeholder="الكمية" id="amount_'.($i+1).'" value="'.$amount.'" class="meal_amount float_left" />';
						$display_sting .= '<input type="hidden" name="meal_value[]" class="meal_value" id="field_'.($i+1).'" />';
						$display_sting .= '<div class="recipe float_left"><a href="#"><img src="'.base_url().'images/recipe_icon.png" /></a></div>';
						$display_sting .= '<div class="delete float_left"><a href="#" class="removeclass"><img src="'.base_url().'images/trash.png" /></a></div>';
						$display_sting .= '<div class="clear"></div>';
						$display_sting .= '</li>';
					}
						echo $display_sting;
					?>
                    <li>
	                    <input type="text" name="the_meal[]" placeholder="الصنف" id="0" class="meal_recipe search float_left" />
                    	<input type="text" name="meal_amount[]" placeholder="الكمية" id="amount_0" class="meal_amount float_left" />
                        <input type="hidden" name="meal_value[]" class="meal_value" id="field_0" value="" />
                        <div class="recipe float_left"><a href="#"><img src="<?php echo base_url()?>images/recipe_icon.png" /></a></div>
                        <div class="delete float_left"><a href="#" class="removeclass"><img src="<?php echo base_url(); ?>images/trash.png" /></a></div>
                        <div class="clear"></div>
                    </li>              
              		</ul>
                    <table width="100%" border="0" class="float_left direction">
                        <tr>
                            <td>
                                <a href="#" id="AddMoreFileBox" class="meal_button"><?php echo 'اضافة وجبة';?></a>
                            </td>
                            <td>
                            	<input type="submit" class="meal_button submit_meal" data-id="2" value="Submit" />
                            </td>
                        </tr>
                    </table>
                </form>
               <?php }?>
           
        </div>
       <?php /*?> <div id="tabs-2">
         	<?php
				if($val_4)
				{
				$data = $this->nestlefit->get_meals($val_2,$current_day,2);
				$display_sting = '';
				$display_sting .= '<ul class="meal_list">';
					for($i=0;$i<sizeof($data);$i++):
					
					$meals = $data[$i]['nestle_fit_food_title'];
					$amount = $data[$i]['nestle_fit_meals_amount'];
					
					$display_sting .= '<li>';
					$display_sting .= '<input type="text" name="the_meal[]" '.$read_only.' placeholder="الصنف" id="'.($i+1).'" value="'.$meals.'" class="meal_recipe search float_left" />';
					$display_sting .= '<input type="text" name="meal_amount[]" '.$read_only.' placeholder="الكمية" id="amount_'.($i+1).'" value="'.$amount.'" class="meal_amount float_left" />';
					//$display_sting .= '<input type="hidden" name="meal_value[]" class="meal_value" id="field_'.($i+1).'" />';
					//$display_sting .= '<div class="recipe float_left"><a href="#"><img src="'.base_url().'images/recipe_icon.png" /></a></div>';
					//$display_sting .= '<div class="delete float_left"><a href="#" class="removeclass"><img src="'.base_url().'images/trash.png" /></a></div>';
					$display_sting .= '<div class="clear"></div>';
					$display_sting .= '</li>';
					
					echo $display_sting;
					endfor; 
				$display_sting .= '</ul>';
				}
				else
				{
				?>
            	<form method="post" class="send_meals" name="send_meals" enctype="multipart/form-data" />
                <input type="hidden" value="2" name="meal_type" />
                <input type="hidden" value="<?php echo date('Y-m-d')?>" name="meal_date" />
                <input type="hidden" value="<?php echo $val_2 ?>" name="member_id" />
               
               <ul class="meal_list"  id="InputsWrapper">
                  <?php
					$display_sting = '';
					$data = $this->nestlefit->get_meals($val_2,$current_day,2);
					for($i = 0; $i<sizeof($data);$i++)
					{
						$meals = $data[$i]['nestle_fit_food_title'];
						$amount = $data[$i]['nestle_fit_meals_amount'];
						$display_sting .= '<li>';
						$display_sting .= '<input type="text" name="the_meal[]" placeholder="الصنف" id="'.($i+1).'" value="'.$meals.'" class="meal_recipe search float_left" />';
						$display_sting .= '<input type="text" name="meal_amount[]" placeholder="الكمية" id="amount_'.($i+1).'" value="'.$amount.'" class="meal_amount float_left" />';
						$display_sting .= '<input type="hidden" name="meal_value[]" class="meal_value" id="field_'.($i+1).'" />';
						$display_sting .= '<div class="recipe float_left"><a href="#"><img src="'.base_url().'images/recipe_icon.png" /></a></div>';
						$display_sting .= '<div class="delete float_left"><a href="#" class="removeclass"><img src="'.base_url().'images/trash.png" /></a></div>';
						$display_sting .= '<div class="clear"></div>';
						$display_sting .= '</li>';
					}
						echo $display_sting;
					?>
                    <li>
	                    <input type="text" name="the_meal[]" placeholder="الصنف" id="0" class="meal_recipe search float_left" />
                    	<input type="text" name="meal_amount[]" placeholder="الكمية" id="amount_0" class="meal_amount float_left" />
                        <input type="hidden" name="meal_value[]" class="meal_value" id="field_0" value="" />
                        <div class="recipe float_left"><a href="#"><img src="<?php echo base_url()?>images/recipe_icon.png" /></a></div>
                        <div class="delete float_left"><a href="#" class="removeclass"><img src="<?php echo base_url(); ?>images/trash.png" /></a></div>
                        <div class="clear"></div>
                    </li>              
              		</ul>
                    <table width="100%" border="0" class="float_left direction">
                        <tr>
                            <td>
                                <a href="#" id="AddMoreFileBox" class="meal_button"><?php echo 'اضافة وجبة';?></a>
                            </td>
                            <td>
                            	<input type="submit" class="meal_button submit_meal" data-id="3" value="Submit" />
                            </td>
                        </tr>
                    </table>
                </form>
               <?php }?>

        </div>
        <div id="tabs-3">
         	<?php
				if($val_4)
				{
				$data = $this->nestlefit->get_meals($val_2,$current_day,3);
				$display_sting = '';
				$display_sting .= '<ul class="meal_list">';
					for($i=0;$i<sizeof($data);$i++):
					
					$meals = $data[$i]['nestle_fit_food_title'];
					$amount = $data[$i]['nestle_fit_meals_amount'];
					
					$display_sting .= '<li>';
					$display_sting .= '<input type="text" name="the_meal[]" '.$read_only.' placeholder="الصنف" id="'.($i+1).'" value="'.$meals.'" class="meal_recipe search float_left" />';
					$display_sting .= '<input type="text" name="meal_amount[]" '.$read_only.' placeholder="الكمية" id="amount_'.($i+1).'" value="'.$amount.'" class="meal_amount float_left" />';
					//$display_sting .= '<input type="hidden" name="meal_value[]" class="meal_value" id="field_'.($i+1).'" />';
					//$display_sting .= '<div class="recipe float_left"><a href="#"><img src="'.base_url().'images/recipe_icon.png" /></a></div>';
					//$display_sting .= '<div class="delete float_left"><a href="#" class="removeclass"><img src="'.base_url().'images/trash.png" /></a></div>';
					$display_sting .= '<div class="clear"></div>';
					$display_sting .= '</li>';
					
					echo $display_sting;
					endfor; 
				$display_sting .= '</ul>';
				}
				else
				{
				?>
            	<form method="post" class="send_meals" name="send_meals" enctype="multipart/form-data" />
                <input type="hidden" value="3" name="meal_type" />
                <input type="hidden" value="<?php echo date('Y-m-d')?>" name="meal_date" />
                <input type="hidden" value="<?php echo $val_2 ?>" name="member_id" />
               
               <ul class="meal_list"  id="InputsWrapper">
                  <?php
					$display_sting = '';
					$data = $this->nestlefit->get_meals($val_2,$current_day,3);
					for($i = 0; $i<sizeof($data);$i++)
					{
						$meals = $data[$i]['nestle_fit_food_title'];
						$amount = $data[$i]['nestle_fit_meals_amount'];
						$display_sting .= '<li>';
						$display_sting .= '<input type="text" name="the_meal[]" placeholder="الصنف" id="'.($i+1).'" value="'.$meals.'" class="meal_recipe search float_left" />';
						$display_sting .= '<input type="text" name="meal_amount[]" placeholder="الكمية" id="amount_'.($i+1).'" value="'.$amount.'" class="meal_amount float_left" />';
						$display_sting .= '<input type="hidden" name="meal_value[]" class="meal_value" id="field_'.($i+1).'" />';
						$display_sting .= '<div class="recipe float_left"><a href="#"><img src="'.base_url().'images/recipe_icon.png" /></a></div>';
						$display_sting .= '<div class="delete float_left"><a href="#" class="removeclass"><img src="'.base_url().'images/trash.png" /></a></div>';
						$display_sting .= '<div class="clear"></div>';
						$display_sting .= '</li>';
					}
						echo $display_sting;
					?>
                    <li>
	                    <input type="text" name="the_meal[]" placeholder="الصنف" id="0" class="meal_recipe search float_left" />
                    	<input type="text" name="meal_amount[]" placeholder="الكمية" id="amount_0" class="meal_amount float_left" />
                        <input type="hidden" name="meal_value[]" class="meal_value" id="field_0" value="" />
                        <div class="recipe float_left"><a href="#"><img src="<?php echo base_url()?>images/recipe_icon.png" /></a></div>
                        <div class="delete float_left"><a href="#" class="removeclass"><img src="<?php echo base_url(); ?>images/trash.png" /></a></div>
                        <div class="clear"></div>
                    </li>              
              		</ul>
                    <table width="100%" border="0" class="float_left direction">
                        <tr>
                            <td>
                                <a href="#" id="AddMoreFileBox" class="meal_button"><?php echo 'اضافة وجبة';?></a>
                            </td>
                            <td>
                            	<input type="submit" class="meal_button submit_meal" data-id="4" value="Submit" />
                            </td>
                        </tr>
                    </table>
                </form>
               <?php }?>

        </div>
        <div id="tabs-4">
         	<?php
				if($val_4)
				{
				$data = $this->nestlefit->get_meals($val_2,$current_day,4);
				$display_sting = '';
				$display_sting .= '<ul class="meal_list">';
					for($i=0;$i<sizeof($data);$i++):
					
					$meals = $data[$i]['nestle_fit_food_title'];
					$amount = $data[$i]['nestle_fit_meals_amount'];
					
					$display_sting .= '<li>';
					$display_sting .= '<input type="text" name="the_meal[]" '.$read_only.' placeholder="الصنف" id="'.($i+1).'" value="'.$meals.'" class="meal_recipe search float_left" />';
					$display_sting .= '<input type="text" name="meal_amount[]" '.$read_only.' placeholder="الكمية" id="amount_'.($i+1).'" value="'.$amount.'" class="meal_amount float_left" />';
					//$display_sting .= '<input type="hidden" name="meal_value[]" class="meal_value" id="field_'.($i+1).'" />';
					//$display_sting .= '<div class="recipe float_left"><a href="#"><img src="'.base_url().'images/recipe_icon.png" /></a></div>';
					//$display_sting .= '<div class="delete float_left"><a href="#" class="removeclass"><img src="'.base_url().'images/trash.png" /></a></div>';
					$display_sting .= '<div class="clear"></div>';
					$display_sting .= '</li>';
					
					echo $display_sting;
					endfor; 
				$display_sting .= '</ul>';
				}
				else
				{
				?>
            	<form method="post" class="send_meals" name="send_meals" enctype="multipart/form-data" />
                <input type="hidden" value="4" name="meal_type" />
                <input type="hidden" value="<?php echo date('Y-m-d')?>" name="meal_date" />
                <input type="hidden" value="<?php echo $val_2 ?>" name="member_id" />
               
               <ul class="meal_list"  id="InputsWrapper">
                  <?php
					$display_sting = '';
					$data = $this->nestlefit->get_meals($val_2,$current_day,4);
					for($i = 0; $i<sizeof($data);$i++)
					{
						$meals = $data[$i]['nestle_fit_food_title'];
						$amount = $data[$i]['nestle_fit_meals_amount'];
						$display_sting .= '<li>';
						$display_sting .= '<input type="text" name="the_meal[]" placeholder="الصنف" id="'.($i+1).'" value="'.$meals.'" class="meal_recipe search float_left" />';
						$display_sting .= '<input type="text" name="meal_amount[]" placeholder="الكمية" id="amount_'.($i+1).'" value="'.$amount.'" class="meal_amount float_left" />';
						$display_sting .= '<input type="hidden" name="meal_value[]" class="meal_value" id="field_'.($i+1).'" />';
						$display_sting .= '<div class="recipe float_left"><a href="#"><img src="'.base_url().'images/recipe_icon.png" /></a></div>';
						$display_sting .= '<div class="delete float_left"><a href="#" class="removeclass"><img src="'.base_url().'images/trash.png" /></a></div>';
						$display_sting .= '<div class="clear"></div>';
						$display_sting .= '</li>';
					}
						echo $display_sting;
					?>
                    <li>
	                    <input type="text" name="the_meal[]" placeholder="الصنف" id="0" class="meal_recipe search float_left" />
                    	<input type="text" name="meal_amount[]" placeholder="الكمية" id="amount_0" class="meal_amount float_left" />
                        <input type="hidden" name="meal_value[]" class="meal_value" id="field_0" value="" />
                        <div class="recipe float_left"><a href="#"><img src="<?php echo base_url()?>images/recipe_icon.png" /></a></div>
                        <div class="delete float_left"><a href="#" class="removeclass"><img src="<?php echo base_url(); ?>images/trash.png" /></a></div>
                        <div class="clear"></div>
                    </li>              
              		</ul>
                    <table width="100%" border="0" class="float_left direction">
                        <tr>
                            <td>
                                <a href="#" id="AddMoreFileBox" class="meal_button"><?php echo 'اضافة وجبة';?></a>
                            </td>
                            <td>
                            	<input type="submit" class="meal_button submit_meal" data-id="5" value="Submit" />
                            </td>
                        </tr>
                    </table>
                </form>
               <?php }?>
        	
        </div>
        <div id="tabs-5">
         	<?php
				if($val_4)
				{
				$data = $this->nestlefit->get_meals($val_2,$current_day,5);
				$display_sting = '';
				$display_sting .= '<ul class="meal_list">';
					for($i=0;$i<sizeof($data);$i++):
					
					$meals = $data[$i]['nestle_fit_food_title'];
					$amount = $data[$i]['nestle_fit_meals_amount'];
					
					$display_sting .= '<li>';
					$display_sting .= '<input type="text" name="the_meal[]" '.$read_only.' placeholder="الصنف" id="'.($i+1).'" value="'.$meals.'" class="meal_recipe search float_left" />';
					$display_sting .= '<input type="text" name="meal_amount[]" '.$read_only.' placeholder="الكمية" id="amount_'.($i+1).'" value="'.$amount.'" class="meal_amount float_left" />';
					//$display_sting .= '<input type="hidden" name="meal_value[]" class="meal_value" id="field_'.($i+1).'" />';
					//$display_sting .= '<div class="recipe float_left"><a href="#"><img src="'.base_url().'images/recipe_icon.png" /></a></div>';
					//$display_sting .= '<div class="delete float_left"><a href="#" class="removeclass"><img src="'.base_url().'images/trash.png" /></a></div>';
					$display_sting .= '<div class="clear"></div>';
					$display_sting .= '</li>';
					
					echo $display_sting;
					endfor; 
				$display_sting .= '</ul>';
				}
				else
				{
				?>
            	<form method="post" class="send_meals" name="send_meals" enctype="multipart/form-data" />
                <input type="hidden" value="5" name="meal_type" />
                <input type="hidden" value="<?php echo date('Y-m-d')?>" name="meal_date" />
                <input type="hidden" value="<?php echo $val_2 ?>" name="member_id" />
               
               <ul class="meal_list"  id="InputsWrapper">
                  <?php
					$display_sting = '';
					$data = $this->nestlefit->get_meals($val_2,$current_day,5);
					for($i = 0; $i<sizeof($data);$i++)
					{
						$meals = $data[$i]['nestle_fit_food_title'];
						$amount = $data[$i]['nestle_fit_meals_amount'];
						$display_sting .= '<li>';
						$display_sting .= '<input type="text" name="the_meal[]" placeholder="الصنف" id="'.($i+1).'" value="'.$meals.'" class="meal_recipe search float_left" />';
						$display_sting .= '<input type="text" name="meal_amount[]" placeholder="الكمية" id="amount_'.($i+1).'" value="'.$amount.'" class="meal_amount float_left" />';
						$display_sting .= '<input type="hidden" name="meal_value[]" class="meal_value" id="field_'.($i+1).'" />';
						$display_sting .= '<div class="recipe float_left"><a href="#"><img src="'.base_url().'images/recipe_icon.png" /></a></div>';
						$display_sting .= '<div class="delete float_left"><a href="#" class="removeclass"><img src="'.base_url().'images/trash.png" /></a></div>';
						$display_sting .= '<div class="clear"></div>';
						$display_sting .= '</li>';
					}
						echo $display_sting;
					?>
                    <li>
	                    <input type="text" name="the_meal[]" placeholder="الصنف" id="0" class="meal_recipe search float_left" />
                    	<input type="text" name="meal_amount[]" placeholder="الكمية" id="amount_0" class="meal_amount float_left" />
                        <input type="hidden" name="meal_value[]" class="meal_value" id="field_0" value="" />
                        <div class="recipe float_left"><a href="#"><img src="<?php echo base_url()?>images/recipe_icon.png" /></a></div>
                        <div class="delete float_left"><a href="#" class="removeclass"><img src="<?php echo base_url(); ?>images/trash.png" /></a></div>
                        <div class="clear"></div>
                    </li>              
              		</ul>
                    <table width="100%" border="0" class="float_left direction">
                        <tr>
                            <td>
                                <a href="#" id="AddMoreFileBox" class="meal_button"><?php echo 'اضافة وجبة';?></a>
                            </td>
                            <td>
                            	<input type="submit" class="meal_button submit_meal" data-id="1" value="Submit" />
                            </td>
                        </tr>
                    </table>
                </form>
               <?php }?>
        </div><?php */?>
    </div>
    <div class="clear"></div>
</div>



