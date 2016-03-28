<?php
//Single Page Temple
$page_title = "Gallery Images Order";
$this_table_name = 'gallery_images'; // table name
$this_table_ID = 'gallery_images_ID'; // table primary column
$this_table_name_column = 'gallery_images_src'; // table name column
$this_table_ord = 'gallery_images_order'; // table order column
$this_table_foreign = 'gallery_images_gallery_album_ID'; // table order column


$parent_page_title = "Photo Albums";
$parent_page_name = "manage_photo_albums.php";

$forignkey = (int) $_GET['forignkey'];

if($forignkey == "" )
$forignkey = $_POST['gallery_images_gallery_album_ID'];

//Where Condition
$where_query_string = " and gallery_images_gallery_album_ID = ".$forignkey." " ;




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
$display  = $db->querySelect("select * from {$this_table_name} where 1 {$where_query_string } order by {$this_table_ord} ");
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

$image = get_image_picture($display[$i][$this_table_name_column]);
$image_src = $image['images_src'];
		
?>
	<li style=" height:80px;" id="<?php echo $display[$i][$this_table_ID]; ?>" class="ui-state-default"><span style="margin-top: 1.9em;" class="ui-icon ui-icon-arrowthick-2-n-s"></span><img style="max-height:80px;" src="<?php echo "../".$images_dir['slideshows'] .'/'.$image_src; ?>" /></li>
    <?php
	endfor;
	 ?>
	
</ul>

</article>
</section>

