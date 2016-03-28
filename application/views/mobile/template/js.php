<script src="<?php echo base_url_mobile("js/jquery.mobile/datepicker.js"); ?>"></script>

<script src="<?php echo base_url_mobile("js/jquery.mobile/jquery.mobile.datepicker.js"); ?>"></script>
	<script>
		$(function(){
			$( ".date-input-css" ).datepicker();
		})
	</script>
<script src="<?php echo base_url_mobile("js/slick/slick.min.js"); ?>"></script>


<script src="<?php echo base_url_mobile("js/idangerous-swiper/idangerous.swiper.js"); ?>"></script>

<script src="<?php echo base_url_mobile("js/datepicker.js"); ?>"></script>
<script src="<?php echo base_url_mobile("js/custom.js"); ?>"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>js/fancybox/jquery.fancybox.js?v=2.1.4"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<!-- Add Media helper (this is optional) -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/fancybox/helpers/jquery.fancybox-media.js?v=1.0.5"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.fancybox').fancybox();
	});
</script>

<script>
<!--Ask an expert toogle question-->
$(document).ready(function(e) {
	
		// alert("Test ready makki");
		//
		$("#main-nav-menu-toggle-button").click(function(e) {
			//alert("Test");
			$("#website-main-nav-menu").toggleClass("active");
			$('html, body').animate({
                        scrollTop: $("#website-main-nav-menu").offset().top
                    }, 1500);
			//$("#website-main-nav-menu").toggleClass("hide");
		});
		
		$("#website-main-nav-menu-close-button").click(function(e) {
			e.preventDefault();
			$("#website-main-nav-menu").toggleClass("active");
			$('html, body').animate({
                        scrollTop: $("body").offset().top
                    }, 1500);
			//$("#website-main-nav-menu").toggleClass("hide");
		});
		
		// ------------------------
		//  Mobile Nav-Menu-Events
		// ------------------------
		$("a.mob-nav-menu-parent").click(function(e) {
			if($(this).attr("mob_nav_top_section") != "products")
			{
				e.preventDefault();
				var this_id = $(this).attr("mob_nav_top_section");
				$("li[mob_nav_top_section='" + this_id + "']").children("ul:first").slideToggle();
			}
		});
		
		$(".mob-nav-menu-child li > a").click(function(e) {
			var this_id = $(this).attr("mob_nav_id");
			var count = $("ul[mob_nav_parent='" + this_id + "']").children().length;
			if(count > 0)
			{
				e.preventDefault();
				$("[mob_nav_parent='" + this_id + "']").slideToggle();
			}
		});
		
		//ashraf add this script 		
		//end contact us scripts

    	$(".ask_the_expert_all_questions li .question").click(function(e) {
		
		//Close ALl Answers 
		$(".ask_the_expert_all_questions li .answer").slideUp("fast");
		
		//Chek if current is already active
		if( $(this).parent("li").hasClass("expand")   )
		{
			$(".ask_the_expert_all_questions li").removeClass("expand");
			return false;
			
		}
		
		$(".ask_the_expert_all_questions li").removeClass("expand");
						
		//OPen Current
		var id = $(this).parent("li").data("id");
		
			$(".ask_the_expert_all_questions li[data-id="+id+"]").addClass("expand");
			$(".ask_the_expert_all_questions li[data-id="+id+"] .answer").slideDown("fast");
		
	});
	
	
	// ----- Privacy Policy Questions scroll event
	$('.privacy_top_question').click(function(o){
		if (o){
		   o.preventDefault();
		   var target = $(this).attr("href");
	   }else{
		   var target = location.hash;
	   }
		$('html, body').animate({
			scrollTop: $( target ).offset().top
		}, 1000, function(){
			location.hash = target;
		});
		$(target).css("color", "#000");
		$(target).css("background", "#EEE");
		setTimeout(function(){
		  $(target).fadeIn(3000,function(){
		  $(target).css("color", "#0d587a");
		  $(target).css("background", "#FFF");
		  });
		}, 2000);
		return false;
	});

});
</script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.qtip-1.0.0-rc3.min.js"></script>

<script src="<?php echo base_url(); ?>js/contact_us.js"></script>

<script src="<?php echo base_url_mobile("js/jquery_youtubepopup.js"); ?>"></script>

    <script type="text/javascript">
		$(function () {
			$("a.youtube").YouTubePopup({ autoplay: 0 });
		});
    </script>

<script>
function scale( width, height, padding, border ) {
    var scrWidth = $( window ).width() - 30,
        scrHeight = $( window ).height() - 30,
        ifrPadding = 2 * padding,
        ifrBorder = 2 * border,
        ifrWidth = width + ifrPadding + ifrBorder,
        ifrHeight = height + ifrPadding + ifrBorder,
        h, w;

    if ( ifrWidth < scrWidth && ifrHeight < scrHeight ) {
        w = ifrWidth;
        h = ifrHeight;
    } else if ( ( ifrWidth / scrWidth ) > ( ifrHeight / scrHeight ) ) {
        w = scrWidth;
        h = ( scrWidth / ifrWidth ) * ifrHeight;
    } else {
        h = scrHeight;
        w = ( scrHeight / ifrHeight ) * ifrWidth;
    }

    return {
        'width': w - ( ifrPadding + ifrBorder ),
        'height': h - ( ifrPadding + ifrBorder )
    };
};	
	
$( document ).on( "pagecreate", function() {
    // The window width and height are decreased by 30 to take the tolerance of 15 pixels at each side into account
    function scale( width, height, padding, border ) {
        var scrWidth = $( window ).width() - 30,
            scrHeight = $( window ).height() - 30,
            ifrPadding = 2 * padding,
            ifrBorder = 2 * border,
            ifrWidth = width + ifrPadding + ifrBorder,
            ifrHeight = height + ifrPadding + ifrBorder,
            h, w;
        if ( ifrWidth < scrWidth && ifrHeight < scrHeight ) {
            w = ifrWidth;
            h = ifrHeight;
        } else if ( ( ifrWidth / scrWidth ) > ( ifrHeight / scrHeight ) ) {
            w = scrWidth;
            h = ( scrWidth / ifrWidth ) * ifrHeight;
        } else {
            h = scrHeight;
            w = ( scrHeight / ifrHeight ) * ifrWidth;
        }
        return {
            'width': w - ( ifrPadding + ifrBorder ),
            'height': h - ( ifrPadding + ifrBorder )
        };
    };
	

});

</script>
<script>
var currentwidth;
 var slideshow;
$(document).ready(function(){
	currentwidth3=screen.availWidth;
	 
	        if(currentwidth3 <=414){
		        slidesToShow=2;
				slidesToScroll=2;
		   }else{
		        slidesToShow=4;
				slidesToScroll=4;
	       }

	$('.product-small-images').slick({
	  infinite: true,
	  slidesToShow: slidesToShow,
	  slidesToScroll: slidesToScroll,
	  arrows: true
	});

 /////////////////////////////////////////////////////////////////////////////
 currentwidth=screen.availWidth;
	 
	        if(currentwidth <=414){
		        slideshow=3;
		   }else if (currentwidth >=415 && currentwidth <=735) {
			    slideshow=4;
		   }else{
		        slideshow=5;
	       }
				
				 
			
 		var mySwiper = new Swiper('.swiper-container', {
		 slidesPerView: slideshow,
		 calculateHeight: true,
		// nextButton: '.swiper-next-button',
        // prevButton: '. swiper-prev-button',
	   
	     });
	   
	
	
	$('.arrow-right').on('click', function(e) {
        mySwiper.swipeNext();
     });
    $('.arrow-left').on('click', function(e) {
    mySwiper.swipePrev();
    });
	
	////////////////////////////////////////////////////////

	var mySwiperImages2 = new Swiper('.swiper-container-images', {
            slidesPerView: 2,
			 calculateHeight: true,
           
    });
	
	
	$('.inner-article-right').on('click', function(e) {
        mySwiperImages2.swipeNext();
     });
    $('.inner-article-left').on('click', function(e) {
    mySwiperImages2.swipePrev();
    });
	
//////////////////////////////////////////////////////////////////	
	
	 currentwidth2=screen.availWidth;
	 
	        if(currentwidth2 <=599){
		        slideshow2=1;
		   }else{
		        slideshow2=2;
	       }
	
	var mySwiperhomepage = new Swiper('.swiper-container-homepage', {
            slidesPerView: slideshow2,
			 calculateHeight: false,
           
    });
	
	//////////////////////////////////////////////////////////////////
	var mySwiperSingleItem = new Swiper('.swiper-container-single-item', {
            slidesPerView: 1,
			 calculateHeight: true,
           
    });
	////////////////////////////////////////////////////////////////////
	
	var mySwiperImages = new Swiper('.swiper-container-product', {
            slidesPerView: 2,
			 calculateHeight: true,
           
    });
	////////////////////////////////////////////////////////////////////////
	var mySwiper2 = new Swiper('.swiper-container2', {
		 slidesPerView: slideshow,
		 calculateHeight: true,
		 nextButton: '.swiper-next-button',
         prevButton: '. swiper-prev-button',
	   
	     });
		 //////////////////////////////////////////////////////////
		 
	
});
</script>
