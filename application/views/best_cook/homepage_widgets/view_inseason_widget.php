<?php
// Bermawy 27-11-2014
//$display_inseason_topic = $this->recipesmodel->get_inseason_recipes();
$display_inseason_topic = $this->recipesmodel->get_current_inseason_recipes();

list ( $display_inseason_inner_recipes  , $total_rows) = $this->recipesmodel->get_topics_list_of_recipes($display_inseason_topic[0]['inseason_recipies_ID'],6,0);
?>
<script>
$(document).ready(function(e) {
    $(".main_class_wrapper .extended_list_wrapper .toggle_button,.main_class_wrapper .extended_list_wrapper .toggle_arrow").click(function(e) {
        
		var id = $(this).parent().parent().data("id");
		var status = $(this).parent().attr("status");
		
		if(status == "hidden")
		{
		//Fade out button 
		$(".main_class_wrapper[data-id="+id+"] .extended_list_wrapper .toggle_button").hide();
		
		//Fade in list
		$(".main_class_wrapper[data-id="+id+"] .extended_list_wrapper ul").fadeIn("fast");
		
		//Change List Status
		$(".main_class_wrapper[data-id="+id+"] .extended_list_wrapper").attr("status","visible");
		
		//Change Arrow
		$(".main_class_wrapper[data-id="+id+"] .extended_list_wrapper .toggle_arrow").html("&#x25B2;");
		}
		if(status == "visible")
		{
		
		
		//Fade in list
		$(".main_class_wrapper[data-id="+id+"] .extended_list_wrapper ul").hide();
		
		//Fade out button 
		$(".main_class_wrapper[data-id="+id+"] .extended_list_wrapper .toggle_button").show();
		
		//Change List Status
		$(".main_class_wrapper[data-id="+id+"] .extended_list_wrapper").attr("status","hidden");
		
		//Change Arrow
		$(".main_class_wrapper[data-id="+id+"] .extended_list_wrapper .toggle_arrow").html("&#x25BC;");
		}
		
		
    });
	
});
</script>
<style>
.main_class_wrapper
{
	position:relative;
}
.main_class_wrapper .extended_list_wrapper
{
	position: absolute;
	width: 200px;
	height: auto;
	top: 0px;
	left: 20px;
	/*background: rgba(248, 201, 193, 0.8);*/
	padding:5px;
	
	-webkit-border-bottom-right-radius: 10px;
-webkit-border-bottom-left-radius: 10px;
-moz-border-radius-bottomright: 10px;
-moz-border-radius-bottomleft: 10px;
border-bottom-right-radius: 10px;
border-bottom-left-radius: 10px;
}
.main_class_wrapper .extended_list_wrapper .toggle_button
{
	text-align:center;
	color:#FFF;
	cursor:pointer;
	
	
}
.main_class_wrapper .extended_list_wrapper .toggle_arrow
{
/*	position: absolute;
	bottom: -31px;
	left: 50%;*/
	cursor:pointer;
	text-align:center;
	/*display:none;*/
}
.main_class_wrapper .extended_list_wrapper ul
{
	width:100%;
	height:auto;
	display:none;
}
.main_class_wrapper .extended_list_wrapper ul li
{
	width:100%;
	height:40px;
	margin:3px 0px;
	background:#ccc;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	background: rgba(283, 283, 283, 0.8);
}
.main_class_wrapper .extended_list_wrapper ul li h3
{
	margin: 0px 5px;
	line-height: 39px;
}
</style>

<div class="container_with_extended_lists" style="margin-top:-2px;">

<?php
list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(131,$current_language_db_prefix);
$this->widgets->generate_featured_inseasontopic($subsection_id,$subsection_title,$subsection_extra,$display_inseason_topic,$display_inseason_inner_recipes,$current_section_color,$current_section_background_color,$current_section_borderbottom_color,$current_language_db_prefix);
?>



</div><!-- End of container_with_extended_lists -->