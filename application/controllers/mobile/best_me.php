<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of best_me
 *
 * @author Ahmed Makki
 */
class best_me extends MY_Mcontroller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();

        // Your own constructor code		 
        $this->load->model("articlesmodel");
        //Load Languages
        $this->load->helper('language');
        $this->lang->load('globals');
        $this->lang->load('bestme');
		$this->lang->load('lightbox_messages');

        //Set Section name
        $this->headers->set_second_title(lang("globals_bestme"));

        //Initlize common data 
        $this->data = array();
        $this->data['current_section_id'] = 10;

        //Apply Languages
        $site_lang = $this->config->item('language');
        $this->data['current_language'] = $site_lang;
        $this->data['current_language_db_prefix'] = $site_lang == "arabic" ? "_ar" : "";


        //Apply Sections Color
        $this->data['current_section'] = "best-me";
		$this->data['imageFolder'] = "bestme";
		$this->data['current_section_color'] = "best_me_color";

        //Apply Default Subsections ID
        $this->data['id_of_current_sub_section'] = false;
        $this->data['parent_id_of_current_sub_section'] = false;		
		
		//Send ID if applicable
		$dynamic_id = $this->uri->segment(5);
		
		//Get Current Section Data
		$current_section_data = $this->sectionsmodel->get_active_sub_section_data($this->router->fetch_method() , $this->data['current_section_id'],$dynamic_id);

		if( !empty($current_section_data) ):
			$title_of_current_section = $current_section_data[0]['sub_sections_name'.$this->data['current_language_db_prefix']];
			$id_of_current_sub_section  = $current_section_data[0]['sub_sections_ID'];
			$parent_id_of_current_sub_section  = $current_section_data[0]['sub_sections_parent'];
			$url = $current_section_data[0]['sub_sections_url'];

			//Set Headers
			$this->headers->set_third_title( $title_of_current_section  );
			$this->data['id_of_current_sub_section'] = $id_of_current_sub_section;
			$this->data['parent_id_of_current_sub_section'] = $parent_id_of_current_sub_section;
		endif;

		
		//Set Section Icon
		$this->data['section_icon'] = base_url().'images/bestme/bestme_inner_slideshow_logo.png';
		  $this->data['ask_an_expert_top_banner'] = base_url()."images/bestme/bestme_ask_an_expert_bme.png";

    }

    public function index()
    {
      
        $this->data['display_applications'] =  $this->globalmodel->get_applications($this->data['current_language_db_prefix'],$this->data['current_section_id'],130); 
        $this->data['target_page'] = "best_me/homepage";
		$this->data['common_row'] = $this->get_common_row();
        $this->load->view('mobile/template', $this->data);
    }
	
	
	public function all_videos()
	{
		$this->load->model("videosmodel");
		//Handle Pagination
		$config['base_url'] = site_url('mobile/'. $this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		 list($display_data, $total_rows) = $this->videosmodel->get_all_section_videos(10,$config["per_page"],($current_page_num-1)*$config['per_page']);
		 $config['total_rows'] = $total_rows;
		//Pass the Data
		
		$this->data['display_data'] =  $display_data;
		$this->data['pagination_links'] = getMPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['target_page'] =  "best_me/view_videos";
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		$this->load->view('mobile/template' , $this->data);

	}
	
	public function all_video()
	{
		$this->load->model("videosmodel");
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		 list($display_data, $total_rows) = $this->videosmodel->get_all_section_videos(10,$config["per_page"],($current_page_num-1)*$config['per_page']);
		 $config['total_rows'] = $total_rows;
		//Pass the Data
		
		$this->data['display_data'] =  $display_data;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		//$this->data['target_page'] = "best_me/common_row";
		//$this->data['target_page'] =  "best_me/view_videos";
		//$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		//$this->load->view('mobile/template' , $this->data);
		$this->load->view('mobile/best_me/common_row',$this->data,true);
		return $this->data;

	}
	
	  public function add_new_weight() {


          $this->load->model("nestlefitmodel");
          $user_name = $this->input->post('user_name');
          $birthday = $this->input->post('birthday');
		  $url=$this->input->post('url');
          $current_weight = $this->input->post('your_current_weight');
          $nestle_fit_health_member_id = $this->input->post('nestle_fit_health_member_id');
		  
		  
		  
        $data = array(
            'nestle_fit_health_weights_weight' => $current_weight,
            'nestle_fit_health_weights_nestle_fit_health_ID' => $nestle_fit_health_member_id,
            'nestle_fit_health_weights_date' => date('Y-m-d'),
        );
	   
	   $data3=array(
	   'nestle_fit_health_name'=> $user_name,
	  // 'nestle_fit_health_weight'=>$last_weight,
	   'nestle_fit_health_birthday'=>$birthday,
	   );
	  
        $status = $this->nestlefitmodel->add_new_weight($data,$data3,$nestle_fit_health_member_id);
		if($status){
			redirect($url);
			}

	  
    }
	
	protected function get_common_row()
	{
		$this->data['all_video'] = $this->all_video();
		return $this->load->view('mobile/best_me/common_row',$this->data,true);
	}
	
	public function submit_app()
	{
		$this->load->model("membersmodel");
		$this->load->library("members");
		$this->load->library("emailmanager");
		if($this->input->post('register') == true)
		{
			$this->form_validation->set_rules("members_name", lang('bestme_dietapp_name'), "trim|required|advanced_firstlastname|min_length[2]");
			$this->form_validation->set_rules("members_email", lang('mycorner_email'), "trim|required|valid_email");
			$this->form_validation->set_rules("members_height", lang('bestme_dietapp_Length'), "trim|required|numeric|max_length_number[3]");
			$this->form_validation->set_rules("members_weight", lang('bestme_dietapp_wight'), "trim|required|numeric|max_length_number[3]");
			$this->form_validation->set_rules("members_mobile", lang('mycorner_mobile'), "trim|required|numeric|max_length_number[11]");
			$this->form_validation->set_rules("members_phone", lang('mycorner_mobile'), "trim|required|numeric|max_length_number[11]");
			$this->form_validation->set_rules("members_sport", lang('bestme_fitapp_type_sport'), "trim|required");
			$this->form_validation->set_rules("members_healthy", lang('bestme_dietapp_health'), "trim|required");
			$this->form_validation->set_rules("members_call_time", lang('bestme_dietapp_call_time'), "required");
			
			if($this->form_validation->run() == true)
			{
				$name = $this->input->post('members_name');
				$email = $this->input->post('members_email');
				$members_gender = $this->input->post('members_gender');
				$members_birthdate = $this->input->post('members_birthdate');
				$members_height = $this->input->post('members_height');
				$members_weight = $this->input->post('members_weight');
				$members_sport = $this->input->post('members_sport');
				$members_healthy = $this->input->post('members_healthy');
				$members_mobile = $this->input->post('members_mobile');
				$members_phone = $this->input->post('members_phone');
				$members_call_time = $this->input->post('members_call_time');
				$member_id = $this->members->members_id;
				
				$form_data = array(
			
					'members_app_name' => $name,
					'members_app_mail' => $email,
					'members_app_gender' => $members_gender,
					'members_app_birthdate' => $members_birthdate,
					'members_app_height' => $members_height,
					'members_app_weight' =>$members_weight,
					'members_app_sport' => $members_sport,
					'members_app_healthy' => $members_healthy,
					'members_app_mobile' => "0".$members_mobile,
					'members_app_phone' => "0".$members_phone,
					'members_app_call_time' => $members_call_time,
					'members_app_member_id' => $member_id
					);
								
					$currnet_member_id = $this->membersmodel->add_member_app($form_data);
					
					 // Send e-mail to member
					$data['name'] =  $name;
					$data['members_email'] =  $email;	
					$data['members_gender'] =  $members_gender;	
					$data['members_birthdate'] =  $members_birthdate;	
					$data['members_height'] =  $members_height;	
					$data['members_weight'] =  $members_weight;	
					$data['members_sport'] =  $members_sport;	
					$data['members_healthy'] =  $members_healthy;	
					$data['members_mobile'] =  $members_mobile;	
					$data['members_phone'] =  $members_phone;	
					$data['members_call_time'] =  $members_call_time;				
					if($this->members->members_language == "arabic")
					{
						$send = $this->emailmanager->send_email($email ,"رجيمك الخاص",$data,'email_diet_app');
					}
					else
					{
						$send = $this->emailmanager->send_email($email ,"Your Diet App",$data,'email_diet_app_en');
					}
					$this->emailmanager->send_admin_email('consumer.services@eg.nestle.com' ,"New Member Diet Data",$data,'email_diet_app_cons_en');
					//application.egEngage-email_test@eg.nestle.com
					//consumer.services@eg.nestle.com
					if($send)
					{
						redirect('mobile/best_me/applications/8/success');
					}
			}
			else
			{
				$this->data['target_page'] =  "mobile/best_me/diet_app/landing_page" ;
				$this->load->view('template' , $this->data);
			}
			
		}
		else
		{
			redirect('mobile/best_me/applications/8');
		}
	}
	

}
