<!--Date picker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
$( document ).on( "focus", "input.datepicker", function() {
var now = new Date(Date.now());
var current_year = now.getFullYear();
var last_year = current_year - 1;
var next_year = current_year + 1;

    $( this ).datepicker({
       changeMonth: true,
      	changeYear: true,
	  	yearRange: last_year+':'+next_year,
	  	dateFormat: 'yy-mm-dd',
    });	
});
</script>