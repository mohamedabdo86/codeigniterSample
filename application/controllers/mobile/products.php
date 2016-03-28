<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class products extends MY_Mcontroller {

    public function __construct() {
        parent::__construct();

        // Your own constructor code		 
        $this->load->model("articlesmodel");
        $this->load->model("recipesmodel");
		$this->load->model("productsmodel");

        //Load Languages
        $this->load->helper('language');
        $this->lang->load('globals');
        $this->lang->load('products');
		$this->load->helper('url');


        //Set Section name
        $this->headers->set_second_title(lang("globals_nestleproducts"));


        //Initlize common data 
        $this->data = array();
        $this->data['current_section_id'] = 30;

        //Apply Drawings
        $this->data['apply_outer_drawings'] = false;
        $this->data['header_left_outer_drawings_src'] = base_url() . "images/bestcook/bestcook_left_drawings.png";
        $this->data['header_right_outer_drawings_src'] = base_url() . "images/bestcook/bestcook_right_drawings.png";

        //Apply Sections Color
        $this->data['current_section_color'] = "product_color";
        $this->data['current_section_background_color'] = "product_background_color";
        $this->data['current_section_border_color'] = "product_border_color";
        $this->data['current_section_borderbottom_color'] = "product_borderbottom_color";

        //Apply Languages
        $site_lang = $this->config->item('language');
        $this->data['current_language'] = $site_lang;
        $this->data['current_language_db_prefix'] = $site_lang == "arabic" ? "_ar" : "";

        //Apply Default Subsections ID
        $this->data['id_of_current_sub_section'] = false;
        $this->data['parent_id_of_current_sub_section'] = false;

        //Tree Menu handling (This will write first and second url)
        $this->treemenu->add_tree_page(lang("globals_home"), site_url('welcome'));
        $this->treemenu->add_tree_page(lang("globals_nestleproducts"), site_url($this->router->class));


        //Auto Manage Current Section,Manage Tree Page and Headers
        //Send ID if applicable
        $dynamic_id = $this->uri->segment(4);


        //Get Current Section Data
        $current_section_data = $this->sectionsmodel->get_active_sub_section_data($this->router->fetch_method(), $this->data['current_section_id'], $dynamic_id);
        if (!empty($current_section_data)):
            $title_of_current_section = $current_section_data[0]['sub_sections_name' . $this->data['current_language_db_prefix']];
            $id_of_current_sub_section = $current_section_data[0]['sub_sections_ID'];
            $parent_id_of_current_sub_section = $current_section_data[0]['sub_sections_parent'];

            //Add Current Page (	The Third Url)

            if ($this->data['current_section_id'] != $parent_id_of_current_sub_section) {
                $parent_section_data = $this->sectionsmodel->get_sections_details($parent_id_of_current_sub_section);
                $title_of_parent_section = $parent_section_data[0]['sub_sections_name' . $this->data['current_language_db_prefix']];

                $this->treemenu->add_tree_page($title_of_parent_section, '#');
            }

            //Set Headers
            $this->headers->set_third_title($title_of_current_section);

            $this->data['id_of_current_sub_section'] = $id_of_current_sub_section;
            $this->data['parent_id_of_current_sub_section'] = $parent_id_of_current_sub_section;

        endif;


        //Prepare Ask an Expert Banner
        $this->data['ask_an_expert_top_banner'] = base_url() . "images/bestcook/bestcook_ask_an_expert" . $this->data['current_language_db_prefix'] . ".png";
        //Prepare Ask an expert Background form
        $this->data['ask_an_expert_form_background'] = base_url() . "images/bestcook/ask_an_expert_background" . $this->data['current_language_db_prefix'] . ".png";
    }

    public function index($id= "" ) 
	{	
        
		//$id = extractSeoid($id);
        if($id == "")
		$id = 34;
		
        //Load Brand Data
		$display_brand = $this->productsmodel->get_product_brand_details($id);
		
		if(!$display_brand){
			redirect('products');
		}
		
		$title = $display_brand[0]['products_brand_name'.$this->data['current_language_db_prefix']];
		
		// Set header
		$this->headers->set_third_title($title);
		
		//Load Sub Products
		$display_subproducts = $this->productsmodel->get_product_sub_products($id,$this->data['current_language_db_prefix']);
		//print_r($display_subproducts);
		if(sizeof($display_subproducts)==1){
			$this->product_details($id,$display_subproduct[0]['products_ID']);
			return;
			//redirect('product/product_details/'.$id."/".$display_subproduct[0]['products_ID']);
			}
		//Load Promotions
		$display_promotions = $this->productsmodel->get_product_promotions($id);
		
		//Load Videos
		$display_videos = $this->productsmodel->get_brand_videos($id);
		
		//Load Videos Num of rows
		$display_videos_num_rows = $this->productsmodel->get_brand_videos_num_rows($id);
		
		//Load poll
		$display_polls = $this->productsmodel->get_poll_brand($id);
		
		// Load recipes
		$display_recipes = $this->productsmodel->get_related_recipes($id);

		// Load articles
		$display_articles = $this->productsmodel->get_related_articles($id);
		
		$only_one_product_flag = false;
		
		if(sizeof($display_subproducts) == 1) 
		$only_one_product_flag = true;
		
		//Get Logo
		$main_logo_link = base_url()."uploads/products_brand/".$this->globalmodel->get_image_src($display_brand[0]['products_brand_logo']);
		
		 
		
		//if($only_one_product_flag){
		//$this->product_details($display_brand[0]['products_brand_ID'],$display_subproducts[0]['products_ID']);
		//return;
		//}
		
        
        //Pass the Data
		$this->data['main_logo_link']  = $main_logo_link;
		$this->data['brand_id']  = $id;
		$this->data['display']  = $display_brand;
		$this->data['display_subproduct']  = $display_subproducts;
		$this->data['display_videos']  = $display_videos;
		$this->data['display_promotions']  = $display_promotions;
		$this->data['display_videos_num_rows']  = $display_videos_num_rows;
		$this->data['display_polls']  = $display_polls;
		//$this->data['display_articles']  = $display_articles;
	//	$this->data['display_recipes']  = $display_recipes;
        $this->data['get_tree_menu_array'] = $this->treemenu->get_tree_array();
       // $this->data['display_applications'] = $this->globalmodel->get_applications($this->data['current_language_db_prefix'], $this->data['current_section_id'], 180);
        $this->data['display_section_slideshow'] = $this->globalmodel->get_sections_slideshow($this->data['current_section_id']);
		$this->data['only_one_product_flag']  = $only_one_product_flag;
        $this->data['target_page'] = "products/index";
        $this->load->view('mobile/template', $this->data);
    }

    public function product_details($id = "" , $subproduct_id = "") 
	{
        //$this->load->library('widgets');
		
		if($id == "")
		$id = 34;
		
      
        //Load Brand Data
		$display_brand = $this->productsmodel->get_product_brand_details($id);
		
		if(!$display_brand){
		redirect('products');
		}
		
		$title = $display_brand[0]['products_brand_name'.$this->data['current_language_db_prefix']];
		
		// Set header
		$this->headers->set_third_title($title);
		
		if(!$subproduct_id){
		//Load Sub Products
		$display_subproducts = $this->productsmodel->get_product_sub_products($id,$this->data['current_language_db_prefix']);
		}else{
		$display_subproducts = $this->productsmodel->get_product_sub_products($id,$this->data['current_language_db_prefix'], $subproduct_id );
		if(!$display_subproducts){
			redirect('products');
		}
		}
		
		//Load Flavours
		$display_flavours = $this->productsmodel->get_product_flavours($subproduct_id, $this->data['current_language_db_prefix']);
		
		//Load Promotions
		$display_promotions = $this->productsmodel->get_product_promotions($id);
		
		//Load Videos
		$display_videos = $this->productsmodel->get_brand_videos($id);
		
		//Load Videos Num of Rows
		$display_videos_num_rows = $this->productsmodel->get_brand_videos_num_rows($id);
		
		//Load poll
		$display_polls = $this->productsmodel->get_poll_brand($id);
		
	    // Load recipes
		$display_recipes = $this->productsmodel->get_related_recipes($id);
		
		// Load articles
		$display_articles = $this->productsmodel->get_related_articles($id);
		
		//Get Main Pro
		$only_one_product_flag = false;
		
		if(sizeof($display_subproducts) == 1) 
		$only_one_product_flag = true;
		
		//Get Logo
		$main_logo_link = base_url()."uploads/products_brand/".$this->globalmodel->get_image_src($display_brand[0]['products_brand_logo']);
		
 
        
        //Pass the Data
		$this->data['main_logo_link']  = $main_logo_link;
		$this->data['brand_id']  = $id;
		$this->data['subbrand_id']  = $subproduct_id;
	 	$this->data['display']  = $display_brand;
		$this->data['display_subproduct']  = $display_subproducts;
		$this->data['display_flavours']  = $display_flavours;
		$this->data['display_videos']  = $display_videos;
		$this->data['display_promotions']  = $display_promotions;
		$this->data['display_videos_num_rows']  = $display_videos_num_rows;
		$this->data['display_polls']  = $display_polls;
	//	$this->data['display_articles']  = $display_articles;
		//$this->data['display_recipes']  = $display_recipes;
      //  $this->data['get_tree_menu_array'] = $this->treemenu->get_tree_array();
        $this->data['target_page'] = "products/inner-product";
		$this->data['only_one_product_flag']  = $only_one_product_flag;
		//$this->data['display_section_slideshow'] = $this->globalmodel->get_sections_slideshow($this->data['current_section_id']);
		
        
        $this->load->view('mobile/template', $this->data);
    }
	
	public function add_comment(){
		$id = $this->input->post('id');
		$member_id = $this->session->userdata('userid');
		$input = $this->input->post('comment_text');
		$add_answer = $this->productsmodel->add_comment($input, $id, $member_id);
		if($add_answer){
			$message = 1;
		}else{
			$message = 2;
		}
		$theHTMLResponse  = $this->load->view('mobile/products/facebook-widget', null, true);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($message));
		
	}
	
	public function get_flavour_data()
	{
		$id = $this->input->post('id');
		$brand_id = $this->input->post('brand_id');
		
		$flavour_data = $this->productsmodel->get_flavour($id);
		$brand_name = $this->productsmodel->get_brand_name($brand_id);
		
		//Get Main Pro
		$only_one_product_flag = false;
		
		if(sizeof($flavour_data) == 1) 
		$only_one_product_flag = true;
	
		$this->data['flavour_data'] = $flavour_data;
		$this->data['brand_name'] = $brand_name;
		$this->data['only_one_product_flag']  = $only_one_product_flag;
		
		$this->load->view('products/view_falvour_data', $this->data);
	}

	public function reviews($id = "")
	{
		
		       // $this->load->library('widgets');
		
		if($id == "")
		$id = 34;
		
      
        //Load Brand Data
		$display_brand = $this->productsmodel->get_product_brand_details($id);
		
		if(!$display_brand){
			redirect('products');
		}
		
		$title = $display_brand[0]['products_brand_name'.$this->data['current_language_db_prefix']];
		
		// Set header
		$this->headers->set_third_title($title);
		
		//Load Promotions
		$display_promotions = $this->productsmodel->get_product_promotions($id);
		
		// Load Comments
		$display_comments = $this->productsmodel->get_product_comments($id);
		
		//Get Logo
		$main_logo_link = base_url()."uploads/products_brand/".$this->globalmodel->get_image_src($display_brand[0]['products_brand_logo']);
		
 
        
        //Pass the Data
		$this->data['main_logo_link']  = $main_logo_link;
		$this->data['brand_id']  = $id;
		$this->data['comment_table']  = "products";
	 	$this->data['display']  = $display_brand;
		$this->data['display_promotions']  = $display_promotions;
		$this->data['display_comments']  = $display_comments;
        $this->data['get_tree_menu_array'] = $this->treemenu->get_tree_array();
		$this->data['display_section_slideshow'] = $this->globalmodel->get_sections_slideshow($this->data['current_section_id']);
		$this->data['target_page'] = "products/review-comments";
		
		$this->load->view('mobile/template', $this->data);
	}
	
	public function get_recipes(){
		$last_id = $this->input->post('last_id');
		$brand_id = $this->input->post('brand_id');
		$get_recipes = $this->productsmodel->get_recipes_with_limit($last_id, $brand_id);
		$theHTMLResponse  = $this->load->view('products/product_articles_recipes', null, true);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($get_recipes));
	}
}
