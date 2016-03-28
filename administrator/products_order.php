<?php
$parent_page_title = "Brand";
$parent_page_name = "brand.php";

//Single Page Temple
$forignkey = $_GET['forignkey'];
$page_title = "Products Order";
$this_table_name = 'products'; // table name
$this_table_ID = 'products_ID'; // table primary column
$this_table_name_column = 'products_name'; // table name column
$this_table_ord = 'products_order'; // table order column

//comment where if there is no forignkey
$where = ' and products_products_brand_id = '.$forignkey;
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
	#sortable { list-style-type: none; margin: 10px; padding: 0; width: 60%; }
	#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; cursor:pointer }
	#sortable li span { position: absolute; margin-left: -1.3em; }
	.update_order { cursor:pointer;}
	</style>
<?php
$display  = $db->querySelect("select * from {$this_table_name} where 1 {$where} order by {$this_table_ord} ");
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
?>
	<li id="<?php echo $display[$i][$this_table_ID]; ?>" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><?php echo $display[$i][$this_table_name_column]; ?></li>
    <?php
	endfor;
	 ?>
	
</ul>

</article>
</section>

