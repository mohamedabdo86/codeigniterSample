(function($) {
    $(function() {
        var jcarousel = $('.jcarousel');

        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var width = jcarousel.innerWidth();

                if (width >= 600) {
                    width = width / 3;
                } else if (width >= 350) {
                    width = width / 2;
                }

                jcarousel.jcarousel('items').css('width', width + 'px');
            })
            .jcarousel({
                wrap: 'last',
				 itemFirstOutCallback: {
            onBeforeAnimation: function(){

            },
            onAfterAnimation: function(){
                $(".jcarousel-control-prev").removeClass("jcarousel-prev-disabled");
                $(".jcarousel-control-prev").removeClass("jcarousel-prev-disabled-horizontal");
            }
        },
        itemLastOutCallback: {
            onBeforeAnimation: function(){

            },
            onAfterAnimation: function(){
                $(".jcarousel-control-next").removeClass("jcarousel-next-disabled");
                $(".jcarousel-control-next").removeClass("jcarousel-next-disabled-horizontal");
            }
        }
            });
			
			

        $('.jcarousel-control-prev')
            .jcarouselControl({
                target: '-=1'
            });

        $('.jcarousel-control-next')
            .jcarouselControl({
                target: '+=1'
            });

        $('.jcarousel-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .on('click', function(e) {
                e.preventDefault();
            })
            .jcarouselPagination({
                perPage: 1,
                item: function(page) {
                    return '<a href="#' + page + '">' + page + '</a>';
                }
            });
    });
})(jQuery);
