
function add_new_header(type)
{
	 $("#dropin_container_headers .dropin_items_wrapper").append(generate_text_headers(type));
	 
	 if(next_global_number_of_headers > 0)
	 {
		if($("#main_draggable_wrapper #dropin_container_headers .button_save_header:hidden"))
		$("#main_draggable_wrapper #dropin_container_headers .button_save_header").fadeIn("slow");
	 }
/*	
	 switch(type.attr("ID"))
	 {
		 case "text": 
		
		 break;
		 case "textarea": $("#dropin_container").append(generate_text(type)); break;
		 case "date": $("#dropin_container").append(generate_text(type)); break;
		 case "select": $("#dropin_container").append(generate_text(type)); break;
	 }*/
}


function generate_text_headers(type)
{
	
	var string = '<div id="'+type.attr("ID")+'" class="input_handler small"><h2>'+type.text()+'</h2><a  id="'+type.attr("ID")+'" class="delete_button_headers" >X</a><input class="pages_header_values" type="hidden" name="pages_attr_hidden_type_'+next_global_number_of_headers+'" value="'+type.attr("ID")+'" />';
	

	

	
	string = string + '</div>';
	next_global_number_of_headers= next_global_number_of_headers+1 ;
	return string;
}


//Handle Save  
$(document).ready(function(e) {
	
	$(".delete_headers_confirmed").on("click",function() 
	{
		
		id = $(this).attr("id");
		
		//alert('test'+id);
		$("#"+id+".input_handler").addClass("delete_class").bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){ $(this).remove();
			
		
		 });
		 $("#"+id+".item_headers").fadeIn("fast");
		$.gritter.removeAll();
		//Update next_global_number_of_attr
		 
		if (typeof  next_global_number_of_headers  != 'undefined'){
		next_global_number_of_headers = next_global_number_of_headers- 1;
		if(next_global_number_of_headers <= 0) { $("#main_draggable_wrapper #dropin_container_headers .button_save_header").fadeOut("slow");  } 
		}
		
		
	} );
	
	$(".delete_button_headers").on("click",function() 
	{
		id = $(this).attr("id");
		
		$.gritter.add({
				class_name: 'notification_red_color',
				title: 'Are you sure ?!',
				text: '<a id="'+id+'" class="delete_headers_confirmed">Yes</a>',
				sticky: false,
				time: '2500',
				fade_out_speed : 1500,
				 before_open: function(){
                    if($('.gritter-item-wrapper').length == 1)
                    {
                        // Returning false prevents a new gritter from opening
                        return false;
                    }
                }
			});
			return false;
		
		
	} );
	
	$(".button_save_header").on("click",
	function()
	{
		var expected_action  = $(this).attr("action_expected");
		prepare_array = new Array();
		var id = $(this).attr("id");

		$( ".input_handler" ).each(function( index )
		 {
		  	prepare_array[index] = new Array(2);
			prepare_array[index][0] = $(this).find(".pages_header_values").val();
			prepare_array[index][1] = index;
		  });
		  
		  
		  
		  $.ajax({
			  url: "ajax/get_pages_headers.php",
			  type: "POST",
			  data: {prepare_array : prepare_array , id:id,expected_action:expected_action},
			  cache: false,
			 
			  success: function(success_array)
			  {
				   $.gritter.add({
				class_name: 'notification_green_color',
				title: 'Updated!',
				text: 'Headers are updated.',
				sticky: false,
				time: '2500',
				fade_out_speed : 1500
					});
				
								
			  },
			  error: function(xhr, ajaxOptions, thrownError)
			  {
				
				 
				 
				
			  }
				  
		});
		  
		  
	} 
	);
});