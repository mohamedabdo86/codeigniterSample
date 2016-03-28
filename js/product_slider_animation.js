$(document).ready(function(e) {
	
/**
	*Firs tab
	* structure hint
**/
$("#dalil").live("click", function() {
	$("#products_slider .slide #slide_summary").html('');
	$("#products_slider .slide #slide_summary").append('<img src="../../../images/products/img-2.png" id="slide_image" alt="" />');
	$("#dalil").attr('class', 'active');
	
});

/**
	* Second tab
	* structure hint
**/
$("#about").click( function() {
	$(document).ready(function(e) {
        $('.mnslider').bxSlider({
	 	mode: 'horizontal',
	   	slideWidth: 300,
		minSlides: 3,
		maxSlides: 3,
		moveSlides: 1,
		slideMargin: 10,
		nextText : '',
		prevText : '',
		pager: false,
		infiniteLoop:true ,
	});
    });
	
	
	
	$("#products_slider .slide #slide_summary").html('');
	
	$("#products_slider .slide #slide_summary").append('<div class="mini_summary"><p class="mini_summary_hint">كل ام تتمنى ان ترى علامات التغذية الصحية على اطفالها . التغذية السليمة تلعب دورا رئيسيا فى ظهور تلك العلاماتز لمقوى بتركيبة الفورتيجرو, هو حليب طبيعى تم تجفيفه, ثم اضيف عليه النسب الضرورية من العناصر الغذائية, حتى يؤمن لطفلك نموا صحيا</p></div><p class="products_size_header">متوفر بالاحجام التالية</p>'+'<div id="mini_slider"><ul class="mnslider" style="width: 515%; position: relative; -webkit-transition: 0s; transition: 0s; -webkit-transform: translate3d(-918px, 0px, 0px);"><li><img src="../../../images/products/n1.JPG" /><p class="gram">875جم</p></li><li><img src="../../../images/products/n2.JPG" /><p class="gram">125جم</p></li><li><img src="../../../images/products/n3.JPG" /><p class="gram">25جم</p></li></ul></div><div class="clear"></div>');
	
	$("#about").attr('class', 'active');
	
});

/**
	* Third tab
	* structure hint
**/
$("#tahdir").live("click", function() {
	$("#products_slider .slide #slide_summary").html('');
	$("#products_slider .slide #slide_summary").append('<p>نيدو +1 لين نمو الاطفال الذى يحتوى على البربيوتيك 1, خليط نستله المميز من الالياف الطبيعية , التى تساعد على الحفاظ على صحة جهاز الهضمى من اجل حمايه طفلك من البكتريا الضارة التى يمكن ان تسبب متاعب فى البطن</p>' + '<label>لتحضير كوب من الحليب نيدو</label>' + '<ul><li>استخدمى الملعة المرفقة</li><li>كوب ماء نظيف 200مل</li><li>اضيفى معيار 3 ملاعق</li><li>قلبى اللبن جيدا</li><li>اغلقى العلبه باحكام وقم بتخزينها فى مكان مغلق جيدا</li></ul>');
	$("#tahdir").attr('class', 'active');
	$("#tahdir", "#about", "#dalil").attr('class', 'active');
});

});
