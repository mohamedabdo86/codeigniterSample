<?php include('db.php'); ?>
    
<?php
class Create {
	/*
	Initilaize class and daatbase
	*/
	public function __construct() {
		global $db;
		$this->db = $db; 
		date_default_timezone_set("Egypt");
	}
	
	public function create_row() {
		$result = $this->db->queryExecute("ALTER TABLE `products_promotions`
									ADD `products_promotions_flag` TINYINT NOT NULL,
									ADD `products_promotions_url` VARCHAR(255) NOT NULL");
		if($result) {
			echo "Done.";			
		} else {
			echo "Error.";	
		}
	}
	
	public function rename_row() {
		echo "mmm";
		$result = $this->db->queryExecute("ALTER TABLE `slidesshow` CHANGE `slidesshow_title` `slidesshow_flag` TINYINT");	
		echo "Ok.";
		if($result) {
			echo "Done.";			
		} else {
			echo "Error.";	
		}
	}
}

$create = new Create();
$create->create_row();
$create->rename_row();
?>