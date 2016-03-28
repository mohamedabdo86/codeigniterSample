/* Manage Social Media */
$(document).ready(function () {  
  	var top = $('#socialmedia_icons').offset().top - parseFloat($('#socialmedia_icons').css('marginTop').replace(/auto/, 0));
  $(window).scroll(function (event) {
    // what the y position of the scroll is
    var y = $(this).scrollTop();
  
    // whether that's below the form
    if (y >= top) {
      // if so, ad the fixed class
      $('#socialmedia_icons').addClass('fixed');
    } else {
      // otherwise remove it
      $('#socialmedia_icons').removeClass('fixed');
    }
  });
});
/* End of Manage Social media */


/* Manage Shortcut Positions */
$(document).ready(function () {  

	if ($('#shortcuts_sections').length > 0) { 
    
	// it exists 
	var top = $('#shortcuts_sections').offset().top - parseFloat($('#shortcuts_sections').css('marginTop').replace(/auto/, 0));
	
	$(window).scroll(function (event) {
    // what the y position of the scroll is
    var y = $(this).scrollTop();
  
    // whether that's below the form
    if (y >= top) {
      // if so, ad the fixed class
      $('#shortcuts_sections').addClass('fixed');
    } else {
      // otherwise remove it
      $('#shortcuts_sections').removeClass('fixed');
    }
  });
	
	
	}
	
  	
  
});
/* End of Shortcut Positions */

/* Manage Shortcut Scroll  */
$(document).ready(function(e) {
    
	$(".shortcut_button").click(function(event) {
		
		var scroll_to_val = $(this).data("scrollto");		
		var offet_top_scroll  = $("#"+scroll_to_val+"_line_seperator_homepage").offset().top;
		
		event.preventDefault();
		$('html, body').animate({scrollTop: offet_top_scroll-4}, 800);
		return false;
	});
	
});
/* EndShortcut Scroll  */

/*Manage Products Nestle Hover */
$(document).ready(function(e) {
    
	//
	$("li.nestle_products").hover(function()
	{
		if( $(".ballon_hover").hasClass("disable") )
		{
		}
		else
		{
			$(".ballon_hover").addClass("active");
			$(".ballon_hover").addClass("disable");
		}
		
	}
	,
	function()
	{
		
	}
	);
	
	$(".ballon_hover .close_button").click(function(e) {
        
		$(".ballon_hover").removeClass("active");
    });
	
	
});