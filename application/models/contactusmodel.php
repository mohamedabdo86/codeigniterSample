<?php
class Contactusmodel extends CI_Model
{
	
	function __construct()
    {
        parent::__construct();
    }
	
	/*Get City*/
	function get_city_by_id($city_id){
		$this->db->select('*');
		$this->db->from('city');
		$this->db->where('city_ID', $city_id);
		$query = $this->db->get();
		return $query->result_array();
		
	}
	/*Get Product*/
	function get_product_by_id($product_id){
		$this->db->select('*');
		$this->db->from('products_brand');
		$this->db->where('products_brand_ID', $product_id);
		$query = $this->db->get();
		return $query->result_array();
		
	}
	function get_city($current_language_db_prefix , $export_for_select = true , $defaultvalue = "")
    {
		if($export_for_select)
		$this->db->select('city_ID as id, city_title'.$current_language_db_prefix.' as value');
		
		if(!$export_for_select)
		$this->db->select('*');
		
		$this->db->from('city');
		$this->db->order_by('city_title'.$current_language_db_prefix);

		
		$query = $this->db->get();
		
		if($export_for_select)
		{
			if($defaultvalue != "")
			$data['']=$defaultvalue;
			
			$data[0]=lang('mycorner_city');
			foreach($query->result_array() as $row)
			{
				
           		 $data[$row['id']]=$row['value'];
        	}
			//print_r($data);
			return $data;
		}
		
		return $query->result_array();
		
	}/* end of get_city */
	

	/*Get respond*/
	function get_respond($current_language_db_prefix = '' , $export_for_select = true , $defaultvalue = "")
    {
		if($export_for_select)
		$this->db->select('respond_ID as id, respond_title'.$current_language_db_prefix.' as value');
		
		if(!$export_for_select)
		$this->db->select('*');
		
		$this->db->from('respond');
		$this->db->order_by('respond_title'.$current_language_db_prefix);

		
		$query = $this->db->get();
		
		if($export_for_select)
		{
			if($defaultvalue != "")
			$data['']=$defaultvalue;
			
			
			foreach($query->result_array() as $row)
			{
           		 $data[$row['id']]=$row['value'];
        	}
			
			return $data;
		}
		
		return $query->result_array();
		
	}/* end of get_respond */
	
	/*Get reason*/
	function get_reason($current_language_db_prefix='' , $export_for_select = true , $defaultvalue = "")
    {
		if($export_for_select)
		$this->db->select('reason_ID as id, reason_title'.$current_language_db_prefix.' as value');
		
		if(!$export_for_select)
		$this->db->select('*');
		
		$this->db->from('reason');
		$this->db->order_by('reason_ID' , 'ASC');

		
		$query = $this->db->get();
		
		if($export_for_select)
		{
			if($defaultvalue != "")
			$data['']=$defaultvalue;
			
			
			foreach($query->result_array() as $row)
			{
           		 $data[$row['id']]=$row['value'];
        	}
			
			return $data;
		}
		
		return $query->result_array();
		
	}/* end of get_reason */
	

	/*Get products_brand*/
	function get_products_brand($current_language_db_prefix , $export_for_select = true , $defaultvalue = "")
    {
		if($export_for_select)
		$this->db->select('products_brand_ID as id, products_brand_name'.$current_language_db_prefix.' as value');
		
		if(!$export_for_select)
		$this->db->select('*');
		
		$this->db->from('products_brand');
		$this->db->order_by('products_brand_name'.$current_language_db_prefix);

		
		$query = $this->db->get();
		
		if($export_for_select)
		{
			if($defaultvalue != "")
			$data['']=$defaultvalue;
			
			foreach($query->result_array() as $row)
			{
           		 $data[$row['id']]=$row['value'];
        	}
			
			return $data;
		}
		
		return $query->result_array();
		
	}/* end of get_products_brand */
	
	function add_to_db($form_data)
    {
		 $this->db->insert('contactus', $form_data);
		 return true;
	}

}

?>