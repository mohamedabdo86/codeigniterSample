<?php 
//Manage fancybox details 
$display_fancybox_flag = false;
$display_box = $this->input->get('display_box');

//To show how to call the lightbox 
//redirect('?display_box=true&message_type=account_confirmed&messagecode='.$status); 

if($display_box)
{
	//get message type
	$message_type = $this->input->get('message_type');
	//get message code
	$messagecode = $this->input->get('messagecode');
	


}
if($display_box && $message_type && isset($messagecode))
{
	$display_fancybox_flag = true;
}

?><script>
$(document).ready(function() {
	
	$('#main_fancybox_hook').fancybox({width:350,height:100,padding:0});
	<?php
	if($display_fancybox_flag):
	?>
	$("#main_fancybox_hook").trigger("click");
	<?php
	endif;
	?>
});
</script>


<?php
if(isset($message_type) && isset($messagecode))
{
?>
<a id="main_fancybox_hook" style="display:none"  class="fancybox fancybox.ajax fancybox-skin" href="<?php echo site_url("mobile/lightbox/".$message_type."/".$messagecode); ?>"></a>
<?php
}
?>
