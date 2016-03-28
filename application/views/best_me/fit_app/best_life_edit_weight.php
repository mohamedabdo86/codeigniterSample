<script>
$(document).ready(function(e) {
	
	$("#edit_weight_form").submit(function(e) {
		$.ajax({
		  type: "POST",
		  url: "<?php echo site_url("ajax/edit_nestle_fit_weight"); ?>",
		  cache: false,
		  dataType: "json",
		  data: $("#edit_weight_form").serialize(),
		  success: function(success_array)
		  {
			  $(".current_weight").html('وزنك الحالى  '+success_array.weight);
			  $(".current_date").html(' اخر تعديل عملتيه كان يوم ' + success_array.date_time);
			  parent.$.fancybox.close();
		  },
		  error: function(xhr, ajaxOptions, thrownError)
	     {
			//alert("wrong"+thrownError);
		 }
		});
		return false;
    });
	$("#weight").keyup(function()
    {
		alert(1);
	});
});
</script>
<script>
  function isNumberKey(evt)
  {
	 var charCode = (evt.which) ? evt.which : event.keyCode
	 if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;

	 return true;
  }
</script>
<form action="" method="post" id="edit_weight_form">
<input type="hidden" name="id" value="<?php echo $id; ?>" >
<p>
الوزن
<input type="text" onkeypress="return isNumberKey(event)" name="weight" id="weight" >
</p>
<input type="submit" name="submit" id="submit" >

</form>
<div id="newsletter_loadable_message"></div>

<?php

?>