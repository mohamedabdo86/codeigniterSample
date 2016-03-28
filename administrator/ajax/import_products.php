<?php
require_once("../modules/database.php");


$display_brands  = $db->querySelect("select * from brands order by brands_name");


if( $_POST['submit_import_form'] == "Import" )
{
	require_once("../scripts/excelsheet_reader/excel_reader2.php");
	$brand_id = $_POST['brand_id'];
	
	echo "test before";
	
	$data = new Spreadsheet_Excel_Reader($_FILES['file_upload']['tmp_name']);
	$sheets = $data->dump();
	$cells = $sheets[0]['cells'];
	for($i = 1; $i <= sizeof($cells); $i++)
	{
		$tobesaved['products_brands_ID']= $brand_id;
		$tobesaved['products_name'] = $cells[$i][1]; //Product Name
		$tobesaved['products_name_ar'] = $cells[$i][2]; //Product Name Arabic
		$tobesaved['products_price'] = $cells[$i][3]; //Price
		$tobesaved['products_can_size'] = $cells[$i][4]; //Can Size
		$tobesaved['products_iswhite'] = $cells[$i][5]; //Is white
		
		$db->insert("products",$tobesaved);
		unset($tobesaved);
	}
	 
	 
	die("<script>location.href = '../manage_products.php?state=success'</script>");
	
	
}
?>
<script type="text/javascript">

$(document).ready(function(e) {
    
	$("#importproducts_form").submit(function(e) {
		
		var state = true;
        
		// get the file name, possibly with path (depends on browser)
        var filename = $("#file_upload").val();

        // Use a regular expression to trim everything before final dot
        var extension = filename.replace(/^.*\./, '');
		
		 if (extension == filename) {
            extension = '';
			} else {
            // if there is an extension, we convert to lower case
            // (N.B. this conversion will not effect the value of the extension
            // on the file upload.)
            extension = extension.toLowerCase();
        }
		
		
		if (extension != "xls")
		{
			$("#file_upload_errorid").html("File extension must be .xls");
			$("#file_upload_errorid").fadeIn("fast");
			state = false;
		}
		if(filename == "" )
		{
			$("#file_upload_errorid").html("You didn't select any file");
			$("#file_upload_errorid").fadeIn("fast");
			state = false;
		}
		
		return state;
    });
	
});

</script>
<style>
#mainwrapper
{
	width:700px;
}
.title_container
{
	width:130px;
	padding:15px;
	margin-left:15px;
	background:#ccc;
	-webkit-border-bottom-right-radius: 15px;
	-webkit-border-bottom-left-radius: 15px;
	-moz-border-radius-bottomright: 15px;
	-moz-border-radius-bottomleft: 15px;
	border-bottom-right-radius: 15px;
	border-bottom-left-radius: 15px;
	font-family: "Century Gothic",  Verdana, sans-serif;
	font-size:14px;
	font-weight:bold;
	color:#FFF;
	
}
#import_products_form_wrapper
{
	margin-left:15px;
}
#import_products_table
{
	text-align:left;
	margin:10px 0px
	
}
.error
{
	padding:7px;
	margin:0 5px;
	background-color:#B86365;
	color:#Fff;
	-webkit-border-radius: 07px;
-moz-border-radius: 07px;
border-radius: 07px;
text-indent:10px;
display:none;
}
</style>

<div id="mainwrapper">
<div class="title_container">Import Products</div>


<div id="import_products_form_wrapper" >
<form id="importproducts_form" name="importproducts_form" action="ajax/import_products.php" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="3" cellpadding="3" id="import_products_table">
  <tr>
    <th scope="row">Select Brand of the Imported Products</th>
    <td><select name="brand_id">
    <?php
	for($i=0;$i<sizeof($display_brands);$i++)
	echo '<option value="'.$display_brands[$i]['brands_ID'].'">'.$display_brands[$i]['brands_name'].'</option>';
	
	?>
    </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Excel Sheet file <br /> (must be xls format)</th>
    <td><input name="file_upload" id="file_upload" type="file" /></td>
    <td><div id="file_upload_errorid" class="error">You didn't select any file</div>;</td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td><input name="submit_import_form" type="submit" value="Import" /></td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>
</div><!-- End of import_products_form_wrapper -->


</div><!-- End of mainwrapper -->