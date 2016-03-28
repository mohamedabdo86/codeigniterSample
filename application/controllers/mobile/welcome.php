<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends MY_Mcontroller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
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

        //Load Language
        $this->load->helper('language');
        $this->lang->load('globals');
		
		//load Models
		$this->load->model('articlesmodel');
		$this->load->model('recipesmodel');
		
        //Pass the Data
        $this->data = array();
        $site_lang = $this->config->item('language');
        $this->data['current_language'] = $site_lang;
        $this->data['current_language_db_prefix'] = $site_lang == "arabic" ? "_ar" : "";
		
	}

 








    public function index()
    {
				
		
		$this->load->library('mwidgets');		
		$this->data['dataArticles_best_cook'] = $this->recipesmodel->recipe_featured_homepage_mobile(2);
		$this->data['dataArticles_best_me'] = $this->articlesmodel->articles_featured_homepage_mobile(10);
		$this->data['dataArticles_best_mom'] = $this->articlesmodel->articles_featured_homepage_mobile(27);
		$this->data['dataArticles_best_time'] = $this->articlesmodel->articles_featured_homepage_mobile(28);

		
		
		$this->data['target_page'] = "homepage/main";
		$this->data['isMainHomePage'] = true;
		
		$this->load->view('mobile/template' , $this->data); 
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */