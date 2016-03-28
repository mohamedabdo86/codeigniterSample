<script>
$(document).ready(function(e) {
	
	var id = '<?php echo $current_id; ?>';
	//alert(id);
	
    $('form#quiz_form').submit(function(e) {
		
		
		 var form = $(this);

		 $.ajax({
            url : "<?php echo site_url($this->router->class."/quiz_result/".$current_id); ?>",
            data : form.serialize(),
            type: "POST",
			cache: false,
		  	dataType: "json",
          	success : function(success_array){
			   $('.result').html(success_array.result) ;
			   $('#submit_form_button').hide();
                //$(comment).hide().insertBefore('#insertbeforMe').slideDown('slow');
            }
        })
		return false;
    });
});
</script>