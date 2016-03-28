<?php
//Single Page Temple
$page_title = "Order Topic Recipes";
$this_table_name = 'inseason_recipies_w_recipies'; // table name
$this_table_ID = 'inseason_recipies_w_recipies_ID'; // table primary column
$this_table_name_column = 'inseason_recipies_w_recipies_recipes_ID'; // table name column
$this_table_ord = 'inseason_recipies_w_recipies_ord'; // table order column
$fkey = $_GET['fkey'];

$parent_page_title = "Topic Recipes";
$parent_page_name = "topics_recipes.php";

?>
<?php include("header.php");?> 
<script>
	$(function() {
		$( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
		
		
		$("#update_order").click(function(e) {
			
			var index_test = 0;
			var order_column = "<?php echo $this_table_ord;?>";
			var table_name = "<?php echo $this_table_name; ?>";
			var id_column = "<?php echo $this_table_ID; ?>";
			$(".ui-state-default").each(function(index, element) {
                
				id = $(this).attr("id");
				
				$.ajax({
				  url:  "ajax/update_order_list.php",
				  type: "POST",
				  data: {id : id , index: (index+1)  , order_column : order_column , table_name : table_name , id_column : id_column  },
				  cache: false,
				  dataType: "json",
				  success: function(success_array)
				  {
					
				  },
				  error: function(xhr, ajaxOptions, thrownError)
				  {
					
				  }
					  
			});
				
				
            });
			
			 <?php
					$message_array = Messages::get_notifications_message("item_updated");
					echo Messages::green_ballon($message_array['title'],$message_array['msg']);
					?>

        });
		
		
	});
	</script>
    <style>
	#sortable { list-style-type: none; margin: 10px; padding: 0; width: 98%; }
	#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; cursor:pointer }
	#sortable li span { position: absolute; margin-left: -1.3em; }
	.update_order { cursor:pointer;}
	</style>
<?php
$display  = $db->querySelect("select * from {$this_table_name} where inseason_recipies_w_recipies_inseason_recipies_ID = {$fkey} order by {$this_table_ord} ");
?>


<!-- start content-outer -->
<section id="main" class="column">
 
<article class="module width_full">
	   <header><h3 class="tabs_involved"><?php echo $page_title;?></h3>
       <div style="float:right;"> <input type="button" id="update_order" value="Save New order" /> </div>
       </header>


<ul id="sortable">
<?php
for($i=0;$i<sizeof($display);$i++):


$recipes  = $db->querySelectSingle("select * from recipes where recipes_ID =".$display[$i][$this_table_name_column]);
$recipes_title =  $recipes['recipes_title'];

?>
	<li id="<?php echo $display[$i][$this_table_ID]; ?>" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $short_title = mb_substr(strip_tags($recipes_title), 0,100, "UTF-8"). (strlen(strip_tags($recipes_title)) >100?'...':''); ?></li>
    <?php
	endfor;
	 ?>
	
</ul>

</article>
</section>

