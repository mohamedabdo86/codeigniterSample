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
class best_mom extends MY_Mcontroller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
       
        // Your own constructor code		 
        $this->load->model("articlesmodel");
		$this->load->model("newslettermodel");

        //Load Languages
        $this->load->helper('language');
        $this->lang->load('globals');
		$this->lang->load('bestmom');
        
		//$this->lang->load('newsletter_lang');

        //Set Section name
        $this->headers->set_second_title(lang("globals_bestmom"));

        //Initlize common data 
        $this->data = array();
        $this->data['current_section_id'] = 27;

        //Apply Languages
        $site_lang = $this->config->item('language');
        $this->data['current_language'] = $site_lang;
        $this->data['current_language_db_prefix'] = $site_lang == "arabic" ? "_ar" : "";

        //Apply Sections Color
        $this->data['current_section'] = "best-mom";
		$this->data['imageFolder'] = "bestmom";
		$this->data['current_section_color'] = "best_mom_color";

        //Apply Default Subsections ID
        $this->data['id_of_current_sub_section'] = false;
        $this->data['parent_id_of_current_sub_section'] = false;

		$this->data['display_newsletter'] = $this->newslettermodel->get_newslettertypes_section($this->data['current_section_id']);
		
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
		$this->data['section_icon'] = base_url().'images/bestcook/bestcook_inner_slideshow_logo.png';
		$this->data['ask_an_expert_top_banner'] = base_url()."images/bestmom/bestmom_ask_an_expert_bm.png";
    }

    public function index()
    {
        
		
        $this->data['target_page'] = "best_mom/homepage";
		$this->data['common_row'] = $this->get_common_row();
        $this->load->view('mobile/template', $this->data);
    }
	
	protected function get_common_row()
	{
		
		return $this->load->view('mobile/best_mom/common_row',$this->data,true);
	}

}
