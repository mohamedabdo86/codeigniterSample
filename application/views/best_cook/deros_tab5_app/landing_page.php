<link href="<?php echo base_url() ?>css/deros_tab5_styles.css" rel="stylesheet" type="text/css">

<?php

if($val_1 == "homepage" || $val_1 == "")
$this->load->view("best_cook/deros_tab5_app/homepage");

if($val_1 == "gallery" 	)
{
	$data['inner_gallery_flag'] = false;
	$this->load->view("best_cook/deros_tab5_app/gallery" , $data);
}

if($val_1 == "inner_gallery")
{
	$data['inner_gallery_flag'] = true;
	$this->load->view("best_cook/deros_tab5_app/gallery" , $data);
}

if($val_1 == "current_class")
$this->load->view("best_cook/deros_tab5_app/current_month");

?>