<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
   public function __construct()
   {
		parent::__construct();
		
   }
   
   public function index(){
	   exit();
	   $this->load->model("searchmodel");
	   //$cousines = $this->searchmodel->get_all_cousine();
	   $articles = $this->searchmodel->get_all_recipes();
	   for($i=0; $i<sizeof($articles); $i++):
	   		$recipes_id = $articles[$i]['articles_ID'];
	   		$keywords_en = $articles[$i]['articles_keywords'];
			$keywords_ar = $articles[$i]['articles_keywords_ar'];
			
	   		$recipes_product_id = $articles[$i]['articles_product_id'];
			$products = $this->searchmodel->get_article_product($recipes_product_id);
			
			$this->add_to_array($products, $keywords_en, $keywords_ar, $recipes_id);
	   endfor;
	   
   }
   
   public function add_to_array($products, $keywords_en, $keywords_ar, $recipes_id){
	   
	    for($i=0; $i<sizeof($products); $i++):
			$recipes_products_name = $products[$i]['articles_products_name'];
			$recipes_products_name_ar = $products[$i]['articles_products_name_ar'];
			
			$article_product_id = $products[$i]['articles_products_ID'];
			
			if($article_product_id == 6){
				
				$data['articles_ID'] = $recipes_id;
			$keywords_en = explode(',', $keywords_en);
			array_push($keywords_en, $recipes_products_name);
			$keywords_en = implode(', ', $keywords_en);
			
			$keywords_ar = explode(',', $keywords_ar);
			array_push($keywords_ar, str_replace(' ', '', $recipes_products_name_ar));
			$keywords_ar = implode(', ', $keywords_ar);
			
			//$keywords_en .= " , ".$cousine_name_en;
			$data['articles_keywords'] = $keywords_en;
	   		//$keywords_ar .= ",".$cousine_name_ar; 
			$data['articles_keywords_ar'] = $keywords_ar;
			
			echo "<pre>";
				print_r($data);
			echo "</pre>";
				$this->searchmodel->append_keywords($data);
			}
		endfor;
	   
	   //$this->searchmodel->append_keywords();
   }
   
   function mail_tests()
   {
	   $this->load->view("emails/email_nestlefit_daily");
   }
   
   function mail_tests1()
   {
	   $this->load->view("emails/email_prize_request");
   }
   function mail_tests2()
   {
	   $this->load->view("emails/email_user_upload_recipe_en");
   }
   function mail_tests3()
   {
	   $this->load->view("emails/email_welcome_en");
   }
   
   function mail_tests4()
   {
	   $this->load->view("emails/email_welcome");
   }
   
   function mail_tests5()
   {
	   $this->load->view("emails/invitation_en");
   }
   
   function mail_tests6()
   {
	   $this->load->view("emails/email_nestlefit_daily");
   }
   
   function mail_tests7()
   {
	   $this->load->view("emails/email_pregnancy_month");
   }
   
   function mail_tests8()
   {
	   $this->load->view("emails/email_prize_request");
   }
   
   function mail_tests9()
   {
	   $this->load->view("emails/email_replay_comment");
   }
   
   function mail_tests11()
   {
	   $this->load->view("emails/email_activated");
   }
   function mail_tests12()
   {
	   $this->load->view("emails/email_activated_en");
   }
   function mail_tests13()
   {
	   $this->load->view("emails/email_activation");
   }
   
   function mail_tests14()
   {
	   $this->load->view("emails/email_activation_en");
   }
   
   function mail_tests15()
   {
	   $this->load->view("emails/add_points");
   }
   
   function mail_tests16()
   {
	   $this->load->view("emails/email_bestcook");
   }
   
   function mail_tests17()
   {
	   $this->load->view("emails/email_bestcook");
   }
   
   function mail_tests18()
   {
	   $this->load->view("emails/email_comment");
   }
   
   function mail_tests19()
   {
	   $this->load->view("emails/email_contact_us");
   }
   
   function mail_tests20()
   {
	   $this->load->view("emails/email_contact_us_en");
   }
   
   function mail_tests21()
   {
	   $this->load->view("emails/email_contact_us_admin");
   }
   
   function mail_tests22()
   {
	   $this->load->view("emails/email_cooking_class");
   }
   
   function mail_tests23()
   {
	   $this->load->view("emails/email_cooking_class_en");
   }
   
   function mail_tests24()
   {
	   $this->load->view("emails/email_diet_app");
   }
   
   function mail_tests25()
   {
	   $this->load->view("emails/email_diet_app_en");
   }
   
   function mail_tests26()
   {
	   $this->load->view("emails/email_forget_password");
   }
   
   function mail_tests27()
   {
	   $this->load->view("emails/email_forget_password_en");
   }
   
   function mail_tests28()
   {
	   $this->load->view("emails/email_invitation");
   }
   
   function mail_tests29()
   {
	   $this->load->view("emails/email_invitation_en");
   }
   
   
}