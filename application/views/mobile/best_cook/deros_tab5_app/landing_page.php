<link rel="stylesheet" type="text/css" href="<?php echo base_url('mobile/css/recipe-style.css') ; ?>" />
<style>
#single-product-header{
	color:red;
}

</style>
<?php
$this->load->model('cookingclassmodel');
if($val_1 == "homepage" || $val_1 == "")
$this->load->view("mobile/best_cook/deros_tab5_app/homepage");

if($val_1 == "gallery" 	)
{
	$data['inner_gallery_flag'] = false;
	$this->load->view("mobile/best_cook/deros_tab5_app/gallery" , $data);
}

if($val_1 == "inner_gallery")
{
	$data['inner_gallery_flag'] = true;
	$this->load->view("mobile/best_cook/deros_tab5_app/gallery" , $data);
}


if($val_1 == "current_class")
{
	$this->load->view("mobile/best_cook/deros_tab5_app/current_month");
}

if($val_1 == "cooking_class")
{
	$this->load->view("mobile/best_cook/deros_tab5_app/current_month");
}




?>