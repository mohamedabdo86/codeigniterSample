function add_new_attr(type)
{
	 $("#dropin_container .dropin_items_wrapper").append(generate_text(type));
	 
	 if(next_global_number_of_attr > 0)
	 {
		 if($("#main_draggable_wrapper #dropin_container .button_save_attr:hidden"))
		$("#main_draggable_wrapper #dropin_container .button_save_attr").fadeIn("slow");
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


function generate_text(type)
{
	
	
	var string = '<div id="'+next_global_number_of_attr+'" class="input_handler"><h2>'+type.text()+'</h2><a  id="'+next_global_number_of_attr+'" class="delete_button" >X</a><input class="pages_attr_hidden_type" type="hidden" name="pages_attr_hidden_type_'+next_global_number_of_attr+'" value="'+type.attr("ID")+'" /><fieldset><label>Title: <input class="pages_attr_title" name="pages_attr_title_'+next_global_number_of_attr+'" type="text" /> </label></fieldset><fieldset><label>Attr. ID: <input class="pages_attr_valueid" name="pages_attr_valueid_'+next_global_number_of_attr+'" type="text" /> </label></fieldset><fieldset><label>Requiried : <input class="pages_attr_req" type="checkbox" value="1" name="pages_attr_req_'+next_global_number_of_attr+'" /></label></fieldset>';
	
	//Extra options
	if(type.attr("ID")=="text")
	{
	var string = string + 'Extra Options :<fieldset><label><input class="pages_attr_extra" type="radio" name="pages_attr_extra_'+next_global_number_of_attr+'" value="" checked />None</label> <label><input class="pages_attr_extra" type="radio" name="pages_attr_extra_'+next_global_number_of_attr+'" value="num_only" />Numbers only</label><label><input class="pages_attr_extra" type="radio" name="pages_attr_extra_'+next_global_number_of_attr+'" value="chars_only" />Characters only</label><label><input type="radio" class="pages_attr_extra" name="pages_attr_extra_'+next_global_number_of_attr+'" value="email_val" />Email Validation</label></fieldset>';
	}
	
	//Attached Options
	if(type.attr("ID")=="select")
	{
	//	var string = string + "<div special_id='"+next_global_number_of_attr+"' id='TextBoxesGroup_"+next_global_number_of_attr+"'><div id='TextBoxDiv1'><label>Textbox #1 : </label><input type='textbox' id='textbox1' ></div></div><input type='button' value='Add Button' id='add_button_options_"+next_global_number_of_attr+"' class='addButton'><input id='remove_button_options_"+next_global_number_of_attr+"'  type='button' value='Remove Button' class='removeButton'><input type='button' value='Get TextBox Value' id='getButtonValue'>";
		
	}
	
	string = string + '</div>';
	next_global_number_of_attr++;
	return string;
}


//Handle Save  
$(document).ready(function(e) {
	
	$(".delete_attr_confirmed").on("click",function() 
	{
		
		id = $(this).attr("id");
		//alert('test'+id);
		$("#"+id+".input_handler").addClass("delete_class").bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){ $(this).remove(); });
		$.gritter.removeAll();
		//Update next_global_number_of_attr
		if (typeof  next_global_number_of_attr  != 'undefined'){
		next_global_number_of_attr = next_global_number_of_attr- 1;
		if(next_global_number_of_attr <= 0) { $("#main_draggable_wrapper #dropin_container .button_save_attr").fadeOut("slow");  } 
		}
		
		 
		
		
	} );
	
	$(".delete_button").on("click",function() 
	{
		id = $(this).attr("id");
		
		$.gritter.add({
				class_name: 'notification_red_color',
				title: 'Are you sure ?!',
				text: '<a id="'+id+'" class="delete_attr_confirmed">Yes</a>',
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
    
	$(".button_save_attr").on("click",
	function()
	{
		
		var validate_flag  = true;
		var expected_action  = $(this).attr("action_expected");
		
		//Validate Attr.
		if(!$(".pages_attr_req:checked").length > 0)
		{
			//Show Notification message
			$.gritter.add({
				class_name: 'notification_red_color',
				title: 'Error!',
				text: 'At least one requiried checkbox should be checked.',
				sticky: false,
				time: '2500',
				fade_out_speed : 1500
			});
			validate_flag  = false;
		}
		
		$('#dropin_container').find(".pages_attr_title").each(function(){
            if($(this).val() === '') {
				 validate_flag = false; 
				 $.gritter.add({
				class_name: 'notification_red_color',
				title: 'Error!',
				text: 'All Titles should be filled.',
				sticky: false,
				time: '2500',
				fade_out_speed : 1500
			});
			
			return false; }
        });
		$('#dropin_container').find(".pages_attr_valueid").each(function(){
            if($(this).val() === '') {
				 validate_flag = false; 
				 $.gritter.add({
				class_name: 'notification_red_color',
				title: 'Error!',
				text: 'All Attr. IDs should be filled.',
				sticky: false,
				time: '2500',
				fade_out_speed : 1500
			});
			
			return false; }
        });
		
		
		
		if (!validate_flag) return false;
		
		
		prepare_array = new Array();
		var id = $(this).attr("id");

		$( ".input_handler" ).each(function( index )
		 {
		  	prepare_array[index] = new Array(6);
			prepare_array[index][0] = $(this).find(".pages_attr_title").val();
			prepare_array[index][1] = $(this).find(".pages_attr_req").attr('checked');
			prepare_array[index][2] = $(this).find(".pages_attr_extra:checked").val();
			prepare_array[index][3] = $(this).find(".pages_attr_hidden_type").val();
			prepare_array[index][4] = $(this).find(".pages_attr_valueid").val();
			prepare_array[index][5] = index;
		  });
		  
		  
		  
		  $.ajax({
			  url: "ajax/get_pages_attr.php",
			  type: "POST",
			  data: {prepare_array : prepare_array , id:id,expected_action:expected_action},
			  cache: false,
			 
			  success: function(success_array)
			  {
				   $.gritter.add({
				class_name: 'notification_green_color',
				title: 'Added!',
				text: 'New Attributes are added.',
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