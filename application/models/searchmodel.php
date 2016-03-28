<?php
class Searchmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->load->library('encrypt');
    }
	
 
	function search_all_website($limit,$start,$q=""	)
    {	
		$main_query_string  = "";
		
		$where = "";
    
   	   $keywords = preg_split('/[\s]/',$q);
   	   $total_keywords = count($keywords);
   
	   foreach($keywords as $key=>$keyword){
		$where .= "`products_keywords` LIKE '%$keyword%'";
		 if($key != ($total_keywords - 1)){
			$where .= " AND ";
		 }
	   }

		//Prepare Recipe Query
		$main_query_string.="Select recipes_ID as 'id',recipes_title as 'title',recipes_title_ar as 'title_ar',recipes_image as 'image','2' as 'section_id','recipes' as 'type',recipes_directions as 'desc',recipes_directions_ar as 'desc_ar' from recipes where Active = 1 and (recipes_title Like '%{$q}%' or recipes_title_ar Like '%{$q}%' or recipes_keywords Like '%{$q}%' or recipes_keywords_ar Like '%{$q}%') ";
		//Prepare Recipe (member) query
		$main_query_string.="Union all Select members_recipes_ID as 'id',members_recipes_name as 'title',members_recipes_name as 'title_ar',members_recipes_image as 'image','2' as 'section_id','mrecipes' as 'type',members_recipes_directions as 'desc',members_recipes_directions as 'desc_ar' from members_recipes where members_recipes_approved = 1 and members_recipes_name Like '%{$q}%' ";
		//Prepare article query
		$main_query_string.="Union all Select articles_ID as 'id',articles_title as 'title',articles_title_ar as 'title_ar',articles_image as 'image',articles_sections_ID as 'section_id','articles' as 'type',articles_brief as 'desc',articles_brief_ar as 'desc_ar' from articles where Active = 1 and (articles_title Like '%{$q}%' or articles_title_ar Like '%{$q}%' or articles_keywords Like '%{$q}%' or articles_keywords_ar Like '%{$q}%') ";
		//Prepare products query 
		//$main_query_string.="Union all Select products_ID as 'id',products_name as 'title',products_name_ar as 'title_ar',products_Image as 'image','30' as 'section_id','products_details' as 'type',products_brief_text as 'desc',products_brief_text_ar as 'desc_ar' from products where products_name Like '%{$q}%' or products_name_ar Like '%{$q}%'";
		$main_query_string.="Union all Select products_ID as 'id',products_name as 'title',products_name_ar as 'title_ar',products_Image as 'image','30' as 'section_id','products_details' as 'type',products_brief_text as 'desc',products_brief_text_ar as 'desc_ar' from products where {$where}";
		//Prepare easy tips query
		//$main_query_string.="Union all Select products_ID as 'id',products_name as 'title',products_name_ar as 'title_ar',products_Image as 'image','products' as 'router','products_details' as 'method' from products where products_name Like '%{$q}%' or products_name_ar Like '%{$q}%'";
		//Prepare Fashion Query
		//Prepare personal quiz query
		
		$query = $this->db->query($main_query_string);

			
		
		//$query = $this->db->get();
		//Save Total Items before use the limit
		$total_numbers_of_rows = $query->num_rows();
		
		$get_last_generated_query = $this->db->last_query();
		
		//return $get_last_generated_query;
		
		//Apply the limit
		$query = $this->db->query($get_last_generated_query." Limit {$start},{$limit} ");

		 
		//echo "Test last query".$str;
		return array($query->result_array() , $total_numbers_of_rows);

    }/* end of get_delicious_recipes */
	
	public function get_all_recipes(){
		$this->db->select('*');
		$this->db->from('recipes');
		$this->db->where('Active' ,1);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
		public function get_recipes($id){
		$this->db->select('*');
		$this->db->from('recipes');
		$this->db->where('recipes_cuisine_id', $id);
		$this->db->where('Active' ,1);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function get_all_cousine($id){
		$this->db->select('*');
		$this->db->from('cuisines');
		$this->db->where('cuisines_ID', $id);
		$query = $this->db->get();
		
		return $query->result_array();
	}

	
	public function append_keywords($data){
		$this->db->where('articles_ID', $data['articles_ID']);
		$this->db->update('articles', $data); 
	}
	
	public function get_article_product($id){
		$this->db->select('*');
		$this->db->from('articles_products');
		$this->db->where('articles_products_products_brand_ID', $id);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
}