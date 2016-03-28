<?php
$page_title = "Pages";
$single_term = "attribute";
$plural_term = "attributes";

/*$parent_page_title = "Pages";
$parent_page_name = "pages.php";*/

$filter = $_GET['filter'];
$id = (int)$_GET['page_id'];

$form_submit = "Edit";

$this_page_name = "pages.php";
$this_table_name = "pages";
$this_page_name_with_varibles = "{$this_page_name}?page_id=".$id;


?>
<?php include("header.php"); ?>

<?php
$generator  = new Display($form_submit,$this_page_name,$page_title,$single_term,$plural_term);
$attr_generator  = new dynamic_attr($form_submit,$this_page_name,$page_title,$single_term,$plural_term,$id);

?>
<script type="text/javascript" >
var next_global_number_of_attr = 0;
</script>
<script type="text/javascript">
 

</script>
<section id="main" class="column">

<?php

echo $attr_generator->generate_pages_attr();
?>
</section>

