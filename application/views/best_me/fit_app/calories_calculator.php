<?php
if(!$this->members->members_id)
{
	redirect(site_url('best_me/applications/9/homepage'), 'refresh');
}
?>
<link rel="stylesheet" href="<?php echo base_url()."css/jquery-ui.css"?>">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() {	

	$('#food').change(function(e) {
        var id = $(this).val();
		if(id == "")	
		{
			$('td#calories').html('');
			$('td#protien').html('');
			$('td#fat').html('');
		}
    });
	
	$( ".search" ).autocomplete({
		
	  minLength: 2,
	  source: function( request, response ){
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
			$('#current_val').val(ui.item.id);
			$.ajax({
			  url:  "<?php echo site_url("ajax/food_calories"); ?>",
			  type: "POST",
			  data: $('#calories_calculator').serialize(),
			  cache: false,
			  dataType: "json",
			  success: function(success_array)
			  {
					$('td#calories').html(success_array.calories);
					$('td#protien').html(success_array.protien);
					$('td#fat').html(success_array.fat);
				
			  },
			  error: function(xhr, ajaxOptions, thrownError)
			  {
				//alert("wrong"+thrownError);
			  }
			  
			});// end of ajax
			
	   }
	});// end of autocomplete
				
	return false;
}); // end of document
</script>
<style>
.app_wrapper
{
	height: 310px;
	position: absolute;
	top: 428px;
	width: 452px;
	margin: 0 274px;
}
.values td 
{
	height: 35px;
	width: 50px;
	text-align: center;
}

.english .back{
 right: 240px !important;
}
.back-text
{
	font-size:15px;
}
.english .back-text{
right: 280px !important;

}
</style>
<div class="calories_calculator_page">
	<div class="app_wrapper">
   
    	<div style="margin: 5px 34px;" class="float_left">
             <h3 class="title dir" style="margin:0 40px 20px 40px;"><?php echo  lang("nestlefit_calc_calories"); ?>
                      <a class="back" style="position: relative;right: 90px;" href="<?php echo site_url('best_me/applications/9'); ?>"><img src="<?php echo base_url().'images/nestle_fit/back.png'; ?>" /></a>
                       <a  href="<?php echo site_url('best_me/applications/9'); ?>">  <span class="back-text" style="position: relative;right: 50px;top: 15px;"><?php echo  lang("nestlefit_back_btn"); ?></span></a>
             </h3>
            
            <form name="calories_calculator" id="calories_calculator" >
                <input type="hidden" id="current_val" name="current_val" value="" />
                
                <input type="text" name="food" placeholder="<?php echo lang('bestme_fitapp_food_type')." .... "; ?>" id="food" class="meal_recipe search float_left" />
                
            </form>
            <div class="clear"></div>
            
            <table width="90%" class="dir float_left" cellspacing="25px" cellpadding="5px" >
                <tr>
                    <td width="30%" class="fitapp_calories_data"><?php echo lang('bestme_fitapp_calories'); ?></td>
                    <td  width="30%" class="fitapp_calories_data"><?php echo lang('bestme_fitapp_protien'); ?></td>
                    <td width="30%" class="fitapp_calories_data"><?php echo lang('bestme_fitapp_fats'); ?></td>
                </tr>
              
                <tr class="values">
                    <td id="calories"></td>
                    <td id="protien"></td>
                    <td id="fat"></td>
                </tr>
              </table>
        <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>


</div>