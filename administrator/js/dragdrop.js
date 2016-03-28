$(function() {
        $(".item").draggable({
                revert:  function(socketObj) {
					
						// Drop was rejected, revert the helper.
						 $("#main_draggable_wrapper .style_dropin_container .drop_text").fadeOut("fast");
						return true;
					
				},
				start : function() { $("#main_draggable_wrapper .style_dropin_container .drop_text").fadeIn("fast");  },
				stop : function() {  }
        });
        $("#dropin_container ").droppable({
                tolerance: 'touch',
				accept: ".item",
                over: function() {
                       $(this).removeClass('out').addClass('over');
                },
                out: function() {
                        $(this).removeClass('over').addClass('out');
                },
                drop: function(event, ui) {
                       //var answer = confirm('Add ');
                        $(this).removeClass('over').addClass('out');
						//Add THe New Button
						add_new_attr(ui.draggable);
                }
        });
		
		
		//Another two functions for headers only!
		 $(".item_headers").draggable({
                revert:  function(socketObj) {
					
						// Drop was rejected, revert the helper.
						 $("#main_draggable_wrapper .style_dropin_container .drop_text").fadeOut("fast");
						return true;
					
				},
				start : function() { $("#main_draggable_wrapper .style_dropin_container .drop_text").fadeIn("fast");  },
				stop : function() {  }
        });
        $("#dropin_container_headers ").droppable({
                tolerance: 'touch',
				accept: ".item_headers",
                over: function() {
                       $(this).removeClass('out').addClass('over');
                },
                out: function() {
                        $(this).removeClass('over').addClass('out');
                },
                drop: function(event, ui) {
                       //var answer = confirm('Add ');
                        $(this).removeClass('over').addClass('out');
						ui.draggable.fadeOut("slow");
						//Add THe New Button
						add_new_header(ui.draggable);
                }
        });
		
		
		
	
});

 $(function() {  
        $(".style_dropin_container .dropin_items_wrapper").sortable({
            revert: true,placeholder: "ui-state-highlight-drag"
        }); 
		 
    });
