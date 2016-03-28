<?php
class Productsmodel extends CI_Model
{
	
	function __construct()
    {
        parent::__construct();
    }
	
	function get_product_brand_details($id)
    {
		$this->db->select('*');
		$this->db->from('products_brand');
		$this->db->join('images', 'images_ID = products_brand_banner');
		$this->db->where('products_brand_ID' , $id);
		$query = $this->db->get();
		return $query->result_array();
    }
	
	function get_product_sub_products($id,$lang, $subproduct_id = "")
    {
		$this->db->select('*');
		$this->db->from('products');
		$this->db->join('images', 'images_ID = products_Image');
		$this->db->where('products_products_brand_id' , $id);
		$this->db->where('products_active' , 1);
		if($subproduct_id != "")
		{
			$this->db->where('products_ID' , $subproduct_id);
		}
		if($lang == "_ar")
		{
			$this->db->order_by("products_order", "DESC"); 
		}
		else
		{
			$this->db->order_by("products_order", "ASC"); 
		}
		
		$query = $this->db->get();
		return $query->result_array();
    }
	
	function get_products_details($id)
	{
		$this->db->select('*');
		$this->db->from('products');
		$this->db->join('images', 'images_ID = products_Image');
		$this->db->where('products_ID' , $id);
		
		$query = $this->db->get();
		return $query->row_array();
	}
	
	function get_product_brand($id)
	{
		$this->db->select('*');
		$this->db->from('products_brand');
		$this->db->join('images', 'images_ID = products_brand_banner');
		$this->db->where('products_brand_ID' , $id);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	function get_flavours_details($id)
    {
		$this->db->select('*');
		$this->db->from('products_flavour');
		$this->db->join('images', 'images_ID = products_flavour_image');
		$this->db->where('products_flavour_ID' , $id);
		
		$query = $this->db->get();
		return $query->result_array();
    }
	
	function get_product_flavours($id, $lang)
    {
		$this->db->select('*');
		$this->db->from('products_flavour');
		$this->db->join('images', 'images_ID = products_flavour_image');
		$this->db->where('products_flavour_products_ID' , $id);
		if($lang == "_ar")
		{
			$this->db->order_by("products_flavour_ID", "DESC"); 
		}
		else
		{
			$this->db->order_by("products_flavour_ID", "ASC"); 
		}
		$query = $this->db->get();
		return $query->result_array();
    }
	
	function get_brand_videos($id)
    {
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('videos_foreign_id' , $id);
		$this->db->where('videos_approved ' ,1);
		 //$this->db->where('videos_foreign_id' , $id);
		$this->db->where('videos_section_id' , 30);
		$query = $this->db->get();
		return $query->result_array();
    }
	
	function get_brand_videos_num_rows($id)
    {
		$this->db->select('*');
		$this->db->from('videos');
		$this->db->where('videos_foreign_id' , $id);
		$this->db->where('videos_approved' , 1);
		$query = $this->db->get();
		return $query->num_rows();
    }
	
	function get_poll_brand($id)
	{
		$this->db->select('*');
		$this->db->from('polls_question');
		$this->db->where('products_brand_ID' , $id);
		$this->db->where('polls_active' , 1);
		$query = $this->db->get();
		return $query->result_array();
	}
	
/*	function get_related_articles($id){
		$this->db->select('*');
		$this->db->from('articles');
		$this->db->like('articles_title', 'match');
		$this->db->or_like('articles_title_ar', $match); 
		$this->db->or_like('articles_body', $match); 
		$this->db->or_like('articles_body_ar', $match);  
		$query = $this->db->get();
		return $query->result_array();
	}*/
	
	function get_related_recipes($id){
		$this->db->select('*');
		$this->db->from('recipes');
		$this->db->join('recipes_products', 'recipes_products.recipes_products_ID = recipes.recipes_product_id');
		$this->db->join('images', 'images.images_ID = recipes.recipes_image');
		$this->db->where('recipes_products_products_brand_ID' , $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_recipes_with_limit($last_id, $brand_id){
		$this->db->select('*');
		$this->db->from('recipes');
		$this->db->join('recipes_products', 'recipes_products.recipes_products_ID = recipes.recipes_product_id');
		$this->db->join('images', 'images.images_ID = recipes.recipes_image');
		$this->db->where('recipes_ID >' , $last_id);
		$this->db->where('recipes_products_products_brand_ID' , $brand_id);
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_related_articles($id){
		
		$this->db->select('*');
		$this->db->from('articles_products_rel');
		$this->db->join('articles', 'articles_ID = articles_products_rel_article_id');
		$this->db->join('images', 'images.images_ID = articles.articles_image');
		$this->db->where('articles_products_rel_brand_id' , $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function add_comment($comment, $id, $member_id)
	{
		date_default_timezone_set("Egypt");
 		$date = date("Y-m-d H:i:s");
 
		$data = array(
		'comments_message' => $comment,
		'comments_foreign_id' => $id,
		'comments_type' => 'products',
		'comments_date' => $date,
		'comments_section_id' => 30,
		'comments_members_id' => $member_id
		);
		
		$insert = $this->db->insert('comments', $data);
		if($insert){
			return $insert;
		}else{
			return false;
		}
	
	}

 // Deprecated
/*	function checkVote($ip, $id){
		$this->db->select('polls_answer_ID');
		$this->db->from('polls_answer');
		$this->db->where('polls_answerer_ip' , $ip);
		$this->db->where('polls_answer_question_id' , $id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
*/
	
	function get_flavour($id){
		$this->db->select('*');
		$this->db->from('products_flavour as p');
		//$this->db->join('images as nimage', ' nimage.images_ID = p.products_flavour_nutrition_img');
		$this->db->join('images as pimage', 'pimage.images_ID = p.products_flavour_image');
		$this->db->where('products_flavour_ID' , $id);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	function get_brand_name($brand_id){
		$this->db->select('*');
		$this->db->from('products_brand');
		$this->db->where('products_brand_ID', $brand_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_product_promotions($id){
		$this->db->select('*');
		$this->db->from('products_promotions');
		$this->db->join('images', 'images_ID = products_promotions_banner');
		$this->db->where('products_promotions_product_id', $id);
		$this->db->where('products_promotions_active', 1);
		$this->db->order_by('products_promotions_ID', 'RANDOM');
	    $this->db->limit(1); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_product_comments($id){
		$this->db->select('*');
		$this->db->from('comments');
		$this->db->where('comments_foreign_id', $id);
		$this->db->where('comments_approve', 1);
		$query = $this->db->get();
		return $query->result_array();
	}
 
}

?>