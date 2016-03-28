<div class="inner_tree_menu_wrapper global_sperator_margin_top_bottom">

<?php
/*echo "<pre>";
print_r($get_tree_menu_array);
echo "</pre>";*/
for($i = 0 ; $i < sizeof($get_tree_menu_array); $i++):
echo'<div class="float_left light_gray"><a href="'.$get_tree_menu_array[$i]['page_url'].'">'.$get_tree_menu_array[$i]['page_name'].'</a></div>';
if( $i < (sizeof($get_tree_menu_array) -1 ) ) echo '<div class="float_left light_gray">-</div>';
endfor;
?>

</div><!-- End of inner_tree_menu_wrapper-->