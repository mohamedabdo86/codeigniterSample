<!--Date picker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
$( document ).on( "focus", "input.datepicker", function() {
var now = new Date(Date.now());
var current_year = now.getFullYear();

    $( this ).datepicker({
       changeMonth: true,
      	changeYear: true,
	  	yearRange: '1950:'+current_year,
	  	dateFormat: 'yy-mm-dd',
    });	
});
</script>