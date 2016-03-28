<?php
if(!$this->members->members_id)
{
   redirect(site_url('mobile/best_me/applications/9/homepage'), 'refresh');
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

<div class="row calories_calculator_container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
       <h3 class="nestlefit_inner_title"><?php echo  lang("nestlefit_calc_calories"); ?></h3>
   </div>
   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4 form-position">
     <form name="calories_calculator" id="calories_calculator" class="form-horizontal dir" role="form">
       <div class="form-group">
          <div class="col-sm-12">          
             <input type="hidden" id="current_val" name="current_val" value="" /> 
          </div>
      </div>
       <div class="form-group">
          <div class="col-sm-12">          
             <input type="text" name="food" placeholder="<?php echo lang('bestme_fitapp_food_type')." .... "; ?>" id="food" class="meal_recipe search float_left textalign" /> 
          </div>
      </div>
     </form>
   </div>
      <div class="table-responsive col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4">          
      <table class="table">
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
      </div>

</div>

<style>
table{
border:none !important;
}
.table-responsive{
border:none !important;	
}
td{
border-top:none !important;
}
.nestlefit_inner_title{
	  margin-top: 210px !important;
}

@media only screen and (width: 640px) {
.form-position{
width: 310px;
  margin-left: 20%;
}
.table-responsive{
width: 380px;
  margin-left: 115px;
}
}
@media only screen and (width: 600px) {
.form-position{
width: 310px;
  margin-left: 20%;
}
.table-responsive{
width: 380px;
  margin-left: 75px;
}
}

@media only screen and (width: 800px) {
.form-position{
width: 310px;
  margin-left: 25%;
}
.table-responsive{
  width: 420px;
  margin-left: 180px;
}
}
</style>