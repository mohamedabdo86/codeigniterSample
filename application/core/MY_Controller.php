<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

// Originaly CodeIgniter i18n library by Jérôme Jaglale
// http://maestric.com/en/doc/php/codeigniter_i18n
// modification by Yeb Reitsma

/*
in case you use it with the HMVC modular extension
uncomment this and remove the other lines
load the MX_Loader class */

//require APPPATH."third_party/MX/Lang.php";

//class MY_Lang extends MX_Lang {
 
class MY_Controller extends CI_Controller {
	
   
   public function __construct()
   {
		parent::__construct();
		$this->load->library('members');
		//Prepare Common Flags
		$this->flags['ask_an_expert'] = true;
		$this->load->model('staticmodel');
   }
   
   public function applications($id="",$val_1="",$val_2="",$val_3="",$val_4="")
	{
		
		
		if($id != "")
		{
			if($id == 9)
			{
				$this->load->library('nestlefit');
			}
			$this->applications_inner($id,$val_1,$val_2,$val_3,$val_4);
			return false;
		}
		
		$display_data = $this->globalmodel->get_applications($this->data['current_language_db_prefix'],$this->data['current_section_id'],$this->data['id_of_current_sub_section']);
				
		//Pass the Data
		$this->data['target_page'] =  "view_application_list" ;
		$this->data['display_data'] =  $display_data;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;

		$this->load->view('template' , $this->data);
		
	}
	public function applications_inner($id="",$val_1="",$val_2="",$val_3="",$val_4="")
	{
		$display_data = $this->globalmodel->get_application_details($id , $this->data['current_language_db_prefix']);
		
		//Set Fourth Title
		$this->headers->set_fourth_title($display_data[0]['applications_title'.$this->data['current_language_db_prefix']]);
		
		//Pass the Data
		$this->data['target_page'] =  "view_application_inner_page" ;
		$this->data['display_data'] =  $display_data;
		$this->data['val_1'] = $val_1;
		$this->data['val_2'] = $val_2;
		$this->data['val_3'] = $val_3;
		$this->data['val_4'] = $val_4;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;

		$this->load->view('template' , $this->data);
		
	}
	
	public function ask_an_expert($answer_id="") 
	{
		
		if(!$this->flags['ask_an_expert'] ) {
			redirect($this->router->class);
		}
	
		$this->lang->load('form_validation');
		 
		//Prepare Form Fields
		$this->form_validation->set_rules('ask_expert_question', lang('question'), 'required');	
		$member_id = $this->members->members_id;
		if(!$member_id){
		$this->form_validation->set_rules('ask_expert_email', 'Email', 'required|valid_email');	
		}
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
		
		$this->data['target_page'] = "view_ask_an_expert";
		if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
			$this->data['target_page'] = "view_ask_an_expert"; //End of validation->run()
		} else { // passed validation proceed to post success logic
		 if(!$this->members->members_fullname) {
			 $member_name = '';
		 } else {
			 $member_name = $this->members->members_fullname;
		 }
			$form_data = array(
				'ask_expert_question'.$this->data['current_language_db_prefix'] => set_value('ask_expert_question'),
				'ask_expert_section_ID' => $this->data['current_section_id'],
				'ask_expert_email' => $this->input->post('ask_expert_email'),
				'ask_expert_members_name' => $member_name,
				'ask_expert_members_id' => $this->members->members_id
			);
						
			// run insert model to write data to db
			if ($this->membersmodel->add_ask_an_expert_question($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				//first send mail to the user ($this->input->post('ask_expert_email'))
				$lang    = $this->data['current_language_db_prefix'];
				$to      = $this->input->post('ask_expert_email');
				$data    = "";
				$view_ar = 'email_ask_expert_ar';
				$view_en = 'email_ask_expert_en';
				
				if($lang == '_ar') {
					$send = $this->emailmanager->send_email($to, 'تم ارسال سؤالك', $data, $view_ar);
				} else {
					$send = $this->emailmanager->send_email($to, 'Your question has been submitted', $data, $view_en);
				}  

				$section_id = $this->data['current_section_id'];
				$admin_data = $this->staticmodel->get_email_admin_section($section_id);
   				$to_email = $admin_data[0]['static_mail'];

				$subject = "Ask An Expert - ".$admin_data[0]['static_text'];
				
				$data['section'] = $admin_data[0]['static_var'];
				$data['user_mail'] = $this->input->post('ask_expert_email');
				$data['message'] = $this->input->post('ask_expert_question');
				
				// send mail to the consumer
				$send = $this->emailmanager->send_admin_email($to_email, $subject, $data, 'email_ask_expert_admin.txt');
				// $to_email
				
				redirect($this->router->class.'/'.$this->router->method.'/'.'?display_box=true&message_type=success&messagecode=2');
				// redirect($this->router->class.'/'.$this->router->method.'/'.'success');   // or whatever logic needs to occur
				
			} else {
			
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}
		}
		
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);		
		$config['per_page'] = 10; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <= 0 ? 1 : $current_page_num;
		
		//Get Ask an expert questions
		list( $display_all_questions , $total_rows) = $this->globalmodel->get_ask_expert_questions($config["per_page"],($current_page_num-1)*$config['per_page'], $this->data['current_section_id'], $this->data['current_language_db_prefix'] );
		$config['total_rows'] = $total_rows;
		if($answer_id != "") {
			$$answer_id = extractSeoid($answer_id);
			$answer_id_data = $this->globalmodel->get_ask_expert_answer_id($answer_id);
			$this->data['answer_id_data'] =  $answer_id_data;
		}
		if(!is_numeric($answer_id)) {
			$answer_id = "";
		}
		$this->data['answer_id'] =  $answer_id;

		//Get The top Banner debend on section 
		$banner = $this->globalmodel->get_ask_expert_banner($this->router->class,$this->data['current_language_db_prefix']);
		
		//Pass the Data
		$this->data['ask_an_expert_top_banner'] =  base_url().'uploads/slideshows/'.$banner[0]['images_src'] ;
		$this->data['target_page'] =  "view_ask_an_expert" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		$this->data['display_all_questions'] =  $display_all_questions ;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
	 
		$this->load->view('template' , $this->data);
		

	}//End of ask an expert
	
	public function section($id = "") {
		
		//bermawy 29-01-2014
		/*$dynamic_id = $this->uri->segment(4);
		$great_parent_id = $this->data['current_section_id'];
		$check_first_level_submenu = $this->sectionsmodel->check_first_level($great_parent_id,$dynamic_id);
		*/

		
		//In case of muilti sublevels ( such as best Mom ) , check if the current section has children as well 
		$display_current_sections_children = $this->sectionsmodel->have_children($this->data['id_of_current_sub_section']);
		$current_section_have_children_flag =  $display_current_sections_children == false ? false : true;
		
		//echo $display_current_sections_children == false ? "No" : sizeof($display_current_sections_children) ;
		//print_r($display_current_sections_children);

		//Get Filters of the current section
		$display_sections_links = $this->sectionsmodel->have_children($this->data['parent_id_of_current_sub_section'],"articles");
		
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method."/".$this->data['id_of_current_sub_section']);		
		$config['per_page'] = 5;
		
	
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		//Control Feat. Items
		if($current_section_have_children_flag)
		{
			redirect();
			//get list of children IDs
			$list_of_children_ids = array();
			for($i=0 ; $i < sizeof($display_current_sections_children) ; $i++)
			$list_of_children_ids[] = $display_current_sections_children[$i]['sub_sections_ID'];
			
			$display_feat = $this->articlesmodel->get_recent_articles($config["per_page"],$list_of_children_ids);
			$display_most_read_data =  $this->articlesmodel->get_recent_articles(4,$list_of_children_ids,"views");
		}
		if(!$current_section_have_children_flag)
		{
			list( $display_feat , $total_rows_feat)   = $this->articlesmodel->get_all_articles($config["per_page"],0,$this->data['id_of_current_sub_section'],false, true, 'DESC');			
			$display_most_read_data =  $this->articlesmodel->get_most_read_articles(4,$this->data['id_of_current_sub_section']);
		}
		// Get all Articles (ASC order)
		list( $display_data , $total_rows)   = $this->articlesmodel->get_all_articles(184467440,($current_page_num-1)*$config['per_page'],$this->data['id_of_current_sub_section'], false, true, 'DESC');
		$config['total_rows'] = $total_rows;
		 
		
		//Pass the Data
		$this->data['target_page'] =  "view_articles" ;
		$this->data['display_sections'] = $display_sections_links;
		$this->data['display_feat'] = $display_feat;
		$this->data['display_data'] = $display_data;
		$this->data['current_section_have_children_flag'] = $current_section_have_children_flag;
		$this->data['display_current_sections_children'] = $display_current_sections_children;
		$this->data['display_most_read_data'] = $display_most_read_data;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
	 
		$this->load->view('template' , $this->data);
		
	}
	
	public function inner_articles($id = "")
	{
		if (strpos($id,'product-') !== false) {
    		$id_url = explode('-', $id);
			if(sizeof($id_url) == 2){
				redirect('products/index/'.$id_url[1].'/');
			}elseif(sizeof($id_url) == 3){
				redirect('products/product_details/'.$id_url[1].'/'.$id_url[2].'');
				}
		}elseif(strpos($id,'section-') !== false){
			
			$id_url = explode('-', $id);
			if(sizeof($id_url) == 2){
				redirect(''.$this->router->class.'/section/'.$id_url[1].'');
			}
		}elseif(strpos($id,'recipe-') !== false){
			
			$id_url = explode('-', $id);
			if(sizeof($id_url) == 2){
				redirect('best_cook/delicious_recipes/'.$id_url[1].'');
			}
		}
		
		
		//Fix ID
		$id = extractSeoid($id);
		$current_language_db_prefix = $this->data['current_language_db_prefix'];
		
		//Tree Menu handling
		//$this->treemenu->add_tree_page( lang("globals_home") , site_url() );		
		//$this->treemenu->add_tree_page( lang("globals_bestcook") , site_url("best_cook") );
		
		//Manage Views Counter
		$this->totalviews->add_view("articles" , $id , "articles" , "articles_views" ,$this->members->members_id);
	
		$display_article = $this->articlesmodel->get_detailed_articles($id);
		
		
		if($display_article[0]['Active'] == 1) 
		{
			//$this->view_recipe($id);
			//continue;
			$display_related_articles = $this->articlesmodel->get_related_articles($id , "" , $current_language_db_prefix ,$display_article[0]['articles_sections_ID'] );
	
			$get_array_of_sections = $this->sectionsmodel->array_of_parent_ids($display_article[0]['articles_sections_ID']);
		
	
			for($i = ( sizeof($get_array_of_sections) -1  )  ; $i >= 0  ; $i-- ):
	
				$get_section_detail = $this->sectionsmodel->get_sections_details($get_array_of_sections[$i]);
				
				if($get_section_detail[0]['sub_sections_url'] != "" )
				{
					$url = str_replace("%id%",$get_section_detail[0]['sub_sections_ID'],$get_section_detail[0]['sub_sections_url']);
					$current_url = site_url($this->router->class."/".$url);
				}
				else
				{
					$current_url = "#";
				}
				
				//$get_section_detail[0]['sub_sections_url'] != "" ? site_url(''.$this->router->class.'/'.$get_section_detail[0]['sub_sections_url'])  : "#";
				//$url = str_replace("%id%",$get_section_detail[0]['sub_sections_ID'],$get_section_detail[0]['sub_sections_url']);
					 //site_url("best_time")
				$this->treemenu->add_tree_page( $get_section_detail[0]['sub_sections_name'.$current_language_db_prefix], $current_url);//sub_sections_url
			
					
			endfor;
			
			
			//Set Page Headers
			$this->headers->set_third_title( $display_article[0]['articles_title'.$current_language_db_prefix] );
			$this->headers->set_default_image($this->config->item('articles_img_link').$display_article[0]['images_src']);
			$this->headers->set_metatag_desc( $display_article[0]['articles_brief'.$current_language_db_prefix] ) ;
			
	
			
			//Pass the Data
			$this->data['target_page'] =  "view_inner_articles" ;
			$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
			$this->data['display_article'] =  $display_article ;
			$this->data['display_related_articles']  = $display_related_articles;
			$this->data['parent_section_display'] = $this->sectionsmodel->get_sections_details($display_article[0]['articles_sections_ID']) ;
			
			 
			$this->load->view('template' , $this->data);
		} 
		else 
		{
			$preview = $this->uri->segment(5);
			if($preview == 'preview')
			{
				//$this->view_recipe($id);
				//continue;
				$display_related_articles = $this->articlesmodel->get_related_articles($id , "" , $current_language_db_prefix ,$display_article[0]['articles_sections_ID'] );
	
				$get_array_of_sections = $this->sectionsmodel->array_of_parent_ids($display_article[0]['articles_sections_ID']);
			
		
				for($i = ( sizeof($get_array_of_sections) -1  )  ; $i >= 0  ; $i-- ):
		
					$get_section_detail = $this->sectionsmodel->get_sections_details($get_array_of_sections[$i]);
					
					if($get_section_detail[0]['sub_sections_url'] != "" )
					{
						$url = str_replace("%id%",$get_section_detail[0]['sub_sections_ID'],$get_section_detail[0]['sub_sections_url']);
						$current_url = site_url($this->router->class."/".$url);
					}
					else
					{
						$current_url = "#";
					}
					
					//$get_section_detail[0]['sub_sections_url'] != "" ? site_url(''.$this->router->class.'/'.$get_section_detail[0]['sub_sections_url'])  : "#";
					//$url = str_replace("%id%",$get_section_detail[0]['sub_sections_ID'],$get_section_detail[0]['sub_sections_url']);
						 //site_url("best_time")
					$this->treemenu->add_tree_page( $get_section_detail[0]['sub_sections_name'.$current_language_db_prefix], $current_url);//sub_sections_url
				
						
				endfor;
				
				
				//Set Page Headers
				$this->headers->set_third_title( $display_article[0]['articles_title'.$current_language_db_prefix] );
				$this->headers->set_default_image($this->config->item('articles_img_link').$display_article[0]['images_src']);
				$this->headers->set_metatag_desc( $display_article[0]['articles_brief'.$current_language_db_prefix] ) ;
				
		
				
				//Pass the Data
				$this->data['target_page'] =  "view_inner_articles" ;
				$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
				$this->data['display_article'] =  $display_article ;
				$this->data['display_related_articles']  = $display_related_articles;
				$this->data['parent_section_display'] = $this->sectionsmodel->get_sections_details($display_article[0]['articles_sections_ID']) ;
				
				 
				$this->load->view('template' , $this->data);
			}
			else
			{
				
				redirect('welcome');
				//redirect(''.$this->router->class.'/delicious_recipes');
			}
		}
		
		/*if(!$display_article){
		redirect('welcome');
		}*/
		
		
	}
	
	public function view_article($id) {
		
	}

 

} 

require_once './application/core/MY_Mcontroller.php';

 
// END MY_Controller Class

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Lang.php */
