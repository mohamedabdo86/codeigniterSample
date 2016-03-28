<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

// Originaly CodeIgniter i18n library by Jérôme Jaglale
// http://maestric.com/en/doc/php/codeigniter_i18n
// modification by Yeb Reitsma

/*
  in case you use it with the HMVC modular extension
  uncomment this and remove the other lines
  load the MX_Loader class */

//require APPPATH."third_party/MX/Lang.php";
//class MY_Lang extends MX_Lang {

class MY_Mcontroller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('members');
        $this->load->library('mwidgets');
        //$this->load->library('widgets');
        //Prepare Common Flags
        $this->flags['ask_an_expert'] = true;
		
		$this->load->model('sectionsmodel');
		$menu_best_cook_sub_sections = $this->sectionsmodel->get_children_sections(2) ;
		$menu_best_mom_sub_sections = $this->sectionsmodel->get_children_sections(27) ;
		$menu_best_me_sub_sections = $this->sectionsmodel->get_children_sections(10) ;
		$menu_best_time_sub_sections = $this->sectionsmodel->get_children_sections(28) ;
		
		
		$this->load->vars(array('menu_best_cook_sub_sections' => $menu_best_cook_sub_sections,
								'menu_best_mom_sub_sections' => $menu_best_mom_sub_sections,
								'menu_best_me_sub_sections' => $menu_best_me_sub_sections,
								'menu_best_time_sub_sections' => $menu_best_time_sub_sections
								));
    }
	
	public function applications($id="",$val_1="",$val_2="",$val_3="",$val_4="")
	{
		if($id != "")
		{
			$this->applications_inner($id,$val_1,$val_2,$val_3,$val_4);
			return;
		}
		
		$display_data = $this->globalmodel->get_applications_mobile($this->data['current_language_db_prefix'],$this->data['current_section_id'],$this->data['id_of_current_sub_section']);

		//Pass the Data
		$this->data['target_page'] =  "view_application_list" ;
		$this->data['display_data'] =  $display_data;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;

		$this->load->view('mobile/template' , $this->data);
		
	}
	public function applications_inner($id="",$val_1="",$val_2="",$val_3="",$val_4)
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
		//$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;

		$this->load->view('mobile/template' , $this->data);
		
	}
	
	

    public function section($id = "")
    {
		$this->get_section_data($id);
		
		//Get Sections Data
		$display_current_sections_children = $this->sectionsmodel->have_children($this->data['id_of_current_sub_section'],"articles");
		$current_section_have_children_flag =  $display_current_sections_children == false ? false : true;
		
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
		
		//Control Feat. Items
		if($current_section_have_children_flag)
		{
			//redirect();
			//get list of children IDs
			$list_of_children_ids = array();
			for($i=0 ; $i < sizeof($display_current_sections_children) ; $i++)
			$list_of_children_ids[] = $display_current_sections_children[$i]['sub_sections_ID'];
			
			$display_feat = $this->articlesmodel->get_recent_articles(6,$list_of_children_ids);
			$display_most_read_data =  $this->articlesmodel->get_recent_articles(4,$list_of_children_ids,"views");
		}
		if(!$current_section_have_children_flag)
		{			
			$display_most_read_data =  $this->articlesmodel->get_most_read_articles(4,$this->data['id_of_current_sub_section']);
		}
		
		list( $display_data , $total_rows)   = $this->articlesmodel->get_all_articles($config["per_page"],($current_page_num-1)*$config['per_page'],$this->data['id_of_current_sub_section'],false,true);
		
		//Pass the Data

		$this->data['display_sections'] = $display_sections_links;
		$this->data['display_data2'] = $display_data;
	    //print_r($display_data);
		$this->data['current_section_have_children_flag'] = $current_section_have_children_flag;
		$this->data['display_current_sections_children'] = $display_current_sections_children;
		$this->data['display_most_read_data'] = $display_most_read_data;		
		$this->data['display_other_sections'] = $this->sectionsmodel->get_other_sections($this->data['current_section_id'],$this->data['id_of_current_sub_section'],"articles");		
        $this->data['target_page'] = "view_articles";
		$this->data['common_row'] = $this->get_common_row();		 
        $this->load->view('mobile/template', $this->data);
    }
    
    public function inner_articles($id = "")
    {
		//Manage Views Counter
		$this->totalviews->add_view("articles" , $id , "articles" , "articles_views" ,$this->members->members_id);
		
		$display_article = $this->articlesmodel->get_detailed_articles($id);		
		$this->get_section_data($display_article[0]['articles_sections_ID']);		
		$display_related_articles = $this->articlesmodel->get_related_articles($id , "" , $this->data['current_language_db_prefix'] ,$display_article[0]['articles_sections_ID'] );
        
		$this->data['display_article'] =  $display_article ;
		$this->data['parent_section_display'] = $this->sectionsmodel->get_sections_details($display_article[0]['articles_sections_ID']) ;
		$this->data['display_related_articles']  = $display_related_articles;
	//	$this->data['common_row'] = $this->get_common_row();
		$this->data['display_other_sections'] = $this->sectionsmodel->get_other_sections($this->data['current_section_id'],$this->data['id_of_current_sub_section'],"articles");		
        $this->data['target_page'] = "view_articles_inner";
		$this->load->view('mobile/template', $this->data);
    }
	
	public function ask_an_expert($answer_id="")
	{
		
		if(!$this->flags['ask_an_expert'] )
		{
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
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$this->data['target_page'] = "view_ask_an_expert";
		}//End of validation->run()
		else // passed validation proceed to post success logic
		{
		 if(!$this->members->members_fullname)
		 {
			 $member_name = '';
		 }
		 else
		 {
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
				
				if($lang == '_ar') 
				{
					$send = $this->emailmanager->send_email($to, 'تم ارسال سؤالك', $data, $view_ar);
				}
				else 
				{
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
				$send = $this->emailmanager->send_admin_email($to_email, $subject, $data, 'email_ask_expert_admin');
				//$to_email
				redirect('mobile/' . $this->router->class.'/'.$this->router->method.'/'.'success');// or whatever logic needs to occur
				
			}
			else
			{
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}
			
			
		}
		
		//Handle Pagination
		$config['base_url'] = site_url_mobile('mobile/' . $this->router->class."/".$this->router->method);		

		//Get Ask an expert questions
		$display_all_questions = $this->globalmodel->get_ask_expert_questions_mobile($this->data['current_section_id'], $this->data['current_language_db_prefix'] );
		
		if($answer_id != ""){
			$$answer_id = extractSeoid($answer_id);
			$answer_id_data = $this->globalmodel->get_ask_expert_answer_id($answer_id);
			$this->data['answer_id_data'] =  $answer_id_data;
		}
		if(!is_numeric($answer_id)){
			$answer_id = "";
		}
		$this->data['answer_id'] =  $answer_id;
		
		//Get The top Banner debend on section 
		$banner = $this->globalmodel->get_ask_expert_banner($this->router->class,$this->data['current_language_db_prefix']);
		
		//Pass the Data
		$this->data['ask_an_expert_top_banner'] =  base_url().'uploads/slideshows/'.$banner[0]['images_src'] ;
		$this->data['target_page'] =  "view_ask_an_expert" ;
		$this->data['display_all_questions'] =  $display_all_questions ;
	 
		$this->load->view('mobile/template', $this->data);
		

	}//End of ask an expert
	
	protected function get_section_data($dynamic_id)
	{
		//Send ID if applicable
		//$dynamic_id = $this->uri->segment(5);//Canceled on 23/12/2014
		
		if($dynamic_id != "")
		{
			$current_section_data = $this->sectionsmodel->get_active_sub_section_data($this->router->fetch_method() , $this->data['current_section_id'],$dynamic_id,true);
			if( !empty($current_section_data) ):
				$title_of_current_section = $current_section_data[0]['sub_sections_name'.$this->data['current_language_db_prefix']];
				$id_of_current_sub_section  = $current_section_data[0]['sub_sections_ID'];
				$parent_id_of_current_sub_section  = $current_section_data[0]['sub_sections_parent'];
				$url = $current_section_data[0]['sub_sections_url']; 
				
				if($this->data['current_section_id'] != $parent_id_of_current_sub_section)
				{
					$parent_section_data = $this->sectionsmodel->get_sections_details($parent_id_of_current_sub_section);
					$title_of_parent_section  = $parent_section_data[0]['sub_sections_name'.$this->data['current_language_db_prefix']];
				}
				
				$this->headers->set_third_title( $title_of_current_section  );
				
				$this->data['id_of_current_sub_section'] = $id_of_current_sub_section;
				$this->data['parent_id_of_current_sub_section'] = $parent_id_of_current_sub_section;
			endif;
		}
	}

}

// END MY_Controller Class

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Lang.php */
