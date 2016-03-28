<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Best_time extends MY_Controller {

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
	
   //private $data ;	 
   public function __construct()
   {
		parent::__construct();
		
		// Your own constructor code		 
		$this->load->model("articlesmodel");
		$this->load->model("quizesmodel");
		$this->load->model("recipesmodel");
		
		//Load Languages
		$this->load->helper('language');		
		$this->lang->load('globals');
		$this->lang->load('besttime');
		
		$this->load->library('session');
		//Set Section name
		$this->headers->set_second_title( lang("globals_besttime") );
		
		
		//Initlize common data 
		$this->data = array();
		$this->data['current_section_id'] =  28;
		
		//Apply Languages
		$site_lang = $this->config->item('language');
		$this->data['current_language'] =  $site_lang;
		$this->data['current_language_db_prefix'] =   $site_lang == "arabic" ? "_ar" : "";

		
		//Apply Drawings
		$this->data['apply_outer_drawings'] = true;
		$this->data['header_left_outer_drawings_src'] = base_url()."images/besttime/besttime_left_drawings".$this->data['current_language_db_prefix'].".png";
		$this->data['header_right_outer_drawings_src'] = base_url()."images/besttime/besttime_right_drawings".$this->data['current_language_db_prefix'].".png";
		
		//Apply Sections Color
		$this->data['current_section_color'] = "best_time_color";
		$this->data['current_section_background_color'] = "best_time_background_color";
		$this->data['current_section_border_color'] = "best_time_border_color";
		$this->data['current_section_borderbottom_color'] = "best_time_borderbottom_color";
		
		
		//Apply Default Subsections ID
		$this->data['id_of_current_sub_section'] =  false;
		$this->data['parent_id_of_current_sub_section'] =  false;
		
		//Tree Menu handling (This will write first and second url)
		$this->treemenu->add_tree_page( lang("globals_home") , site_url('welcome') );		
		$this->treemenu->add_tree_page( lang("globals_besttime") , site_url($this->router->class) );
		
		
		//Auto Manage Current Section,Manage Tree Page and Headers
		
		//Send ID if applicable
		$dynamic_id = $this->uri->segment(4);
		
		
		//Get Current Section Data
		$current_section_data = $this->sectionsmodel->get_active_sub_section_data($this->router->fetch_method() , $this->data['current_section_id'],$dynamic_id);
		if( !empty($current_section_data) ):
			$title_of_current_section = $current_section_data[0]['sub_sections_name'.$this->data['current_language_db_prefix']];
			$id_of_current_sub_section  = $current_section_data[0]['sub_sections_ID'];
			$parent_id_of_current_sub_section  = $current_section_data[0]['sub_sections_parent'];
			$url = $current_section_data[0]['sub_sections_url']; 
			
			//Add Current Page (	The Third Url)	
			//echo $this->data['current_section_id']."<br/>".$parent_id_of_current_sub_section;
			if($this->data['current_section_id'] != $parent_id_of_current_sub_section)
			{
				$parent_section_data = $this->sectionsmodel->get_sections_details($parent_id_of_current_sub_section);
				$title_of_parent_section  = $parent_section_data[0]['sub_sections_name'.$this->data['current_language_db_prefix']];
				
				$this->treemenu->add_tree_page( $title_of_parent_section , '#');
			}
			if (strpos($url,'id')){
				$this->treemenu->add_tree_page( $title_of_current_section , site_url($this->router->class."/".$this->router->fetch_method()."/".$id_of_current_sub_section) );
			}else{
				$this->treemenu->add_tree_page( $title_of_current_section , site_url($this->router->class."/".$this->router->fetch_method()."/") );
			}
			//Set Headers
			$this->headers->set_third_title( $title_of_current_section  );
			 
			$this->data['id_of_current_sub_section'] = $id_of_current_sub_section;
			$this->data['parent_id_of_current_sub_section'] = $parent_id_of_current_sub_section;
		
		endif;
	 
		
		///Disable Flags for ask_an_expert for this section
		$this->flags['ask_an_expert'] = false;
		
		
		
   }
 
	public function index()
	{
		
		$this->load->library('widgets');
		
		//list($display_ask_an_expert , $total_rows) = $this->globalmodel->get_ask_expert_questions(2,0,$this->data['current_section_id']);
		list( $display_fdata , $total_rows) =$this->quizesmodel->get_all_fashion(1,0);
		list( $display_edata , $total_rows) =$this->quizesmodel->get_all_easy_tips(1,0);
		//Pass the Data
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		$this->data['target_page'] =  "best_time/view_besttime_homepage" ;
		$this->data['display_feautre_games'] =  $this->globalmodel->get_games($this->data['current_language_db_prefix'],50);
		$this->data['display_feautre_wake_up_for_life'] =  $this->articlesmodel->get_feautred_articles(47);
		$this->data['display_feautre_your_time'] =  $this->articlesmodel->get_feautred_articles(49);
		$this->data['display_feautre_fashion'] =  $this->articlesmodel->get_feautred_articles(184);
		$this->data['display_feautre_fitness'] =  $this->articlesmodel->get_feautred_articles(14);
		$this->data['display_feautre_coach'] =  $this->articlesmodel->get_feautred_articles(187);
		$this->data['display_section_slideshow'] =  $this->globalmodel->get_sections_slideshow($this->data['current_section_id'],$this->data['current_language_db_prefix']);
		//$this->data['display_recent_articles'] =  $this->articlesmodel->get_recent_articles(2 , array(19 , 20 ));
		$this->data['display_section_tips'] =  $this->globalmodel->get_sections_tips($this->data['current_section_id']);
		$this->data['display_besttime_quiz'] =  $this->quizesmodel->get_featured_quize('quiz',$this->data['current_language_db_prefix']);
		$this->data['display_fdata'] = $display_fdata;
		$this->data['display_edata'] = $display_edata;
		
		$this->load->view('template' , $this->data); 

	} 
	
	public function best_movies()
	{	
		//Pass the Data
		 $this->data['target_page'] =  "best_time/view_best_movies" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		 $this->load->view('template' , $this->data);
		
		
		
	}
	public function quiz($id = "")
	{
		
		if(!empty($id)){
			$this->quiz_inner($id);
			return;
		}
		

		
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		list($this->data['display_all_quizes'], $total_rows) = $this->quizesmodel->get_quizes('quiz', $config["per_page"],($current_page_num-1)*$config['per_page'],$this->data['current_language_db_prefix']);
		$config['total_rows'] = $total_rows;
		$this->data['flag'] = 0;
		
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(186,$this->data['current_language_db_prefix']);
		


		$this->data['subsection_title'] = $subsection_title;

		//Pass the Data
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['target_page'] =  "best_time/view_quizes_list" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);
	}
	public function quiz_inner($id)
	{
		//Fix ID
		$id = extractSeoid($id);
		$current_language_db_prefix = $this->data['current_language_db_prefix'];
		$display_data = $this->quizesmodel->get_quizes_details($id,$this->data['current_language_db_prefix']);
		$display_questions = $this->quizesmodel->get_questions($id);
		$display_answers = $this->quizesmodel->get_answers($display_questions[0]['quizes_questions_ID']);
		
		$this->data['display_all_quizes'] = $this->quizesmodel->get_other_quizes('quiz',$id,$this->data['current_language_db_prefix']);
		
		//ashraf add it 
		$this->headers->set_third_title( $display_data[0]['quizes_title'.$current_language_db_prefix] );
		$this->headers->set_default_image(base_url()."uploads/quizes/".$display_data[0]['images_src']);
		$this->headers->set_metatag_desc( lang('besttime_get_gifts_not_housed')." ".lang('besttime_answers') ) ;
		 //Pass the Data
		 $this->data['current_id'] =  $id;
		 $this->data['target_page'] =  "best_time/view_quiz" ;
		 $this->data['display_data'] =  $display_data;
		 $this->data['display_questions'] =  $display_questions;
		 $this->data['display_answers'] =  $display_answers;
		 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		 $this->load->view('template' , $this->data);
	
	}
	public function quiz_result($id)
	{
//ashraf add this 
$array_of_answers = $_POST['answer_question'];
	$choice_1 ="";
	$choice_2 ="";
	$choice_3 ="";
	$choice_4 ="";
	
for($i=0; $i<sizeof($array_of_answers); $i++)
	{
		if($array_of_answers[$i] == 'A')
		{
			$choice_1 += 1;
		}
		else if($array_of_answers[$i] == 'B')
		{
			$choice_2 += 1;
		}
		else if($array_of_answers[$i] == 'C')
		{
			$choice_3 += 1;
		}
		else if($array_of_answers[$i] == 'D')
		{
			$choice_4 += 1;
		}
	}
	
	$result = "";
	
	
	if($choice_1 >= $choice_2 && $choice_1 >= $choice_3 && $choice_1 >= $choice_4)
	{
		$result = 'A';
	}
	else if($choice_2 >= $choice_1 && $choice_2 >= $choice_3 && $choice_2 >= $choice_4)
	{
		$result = 'B';
	}
	else if($choice_3 >= $choice_1 && $choice_3 >= $choice_2 && $choice_3 >= $choice_4)
	{
		$result = 'C';
	}
	else if($choice_4 >= $choice_1 && $choice_4 >= $choice_2 && $choice_4 >= $choice_3)
	{
		$result = 'D';
	}

//$this->data['answer_data']=$array_of_answers; 
//$total_question =$this->quizesmodel->total_question($id);
//if(sizeof($array_of_answers) ==sizeof($total_question)){
		  $answer_data =$this->quizesmodel->get_answer_details($result,$id);

	      $this->data['answer_data']=$answer_data;
		   $display_data = $this->quizesmodel->get_quizes_details($id,$this->data['current_language_db_prefix']);
		  $this->data['display_data'] = $display_data;
		  $this->data['has_data'] = 1;
		  
		
		
//}else{
	// $this->data['has_data'] = 0;
	 //$this->data['nodisplay_data'] = "gggggggggggggggggg";
	//}
	    $this->load->view('best_time/view_result', $this->data);	  
	  ////end/////
		  
	}
	
	public function life_coach()
	{
		$this->data['display_all_quizes'] = $this->quizesmodel->get_quizes('life_coach','','',$this->data['current_language_db_prefix']);
		$this->data['flag'] = 0;
		
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(187,$this->data['current_language_db_prefix']);
		
		$this->data['subsection_title'] = $subsection_title;

		//Pass the Data
		$this->data['target_page'] =  "best_time/view_quizes_list" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);
	}
	
	public function life_coach_result()
	{
		
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(187,$this->data['current_language_db_prefix']);
		
		$this->data['subsection_title'] = $subsection_title;

		//Pass the Data
		$this->data['target_page'] =  "best_time/life_coach_result" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);
	}
	
	public function life_coach_inner($id)
	{
		//Fix ID
		$id = extractSeoid($id);
		$display_data = $this->quizesmodel->get_quizes_details($id,$this->data['current_language_db_prefix']);
		$display_questions = $this->quizesmodel->get_questions($id);
		$display_answers = $this->quizesmodel->get_answers($display_questions[0]['quizes_questions_ID']);
		
		 if($this->input->post('submit') == true)
		 {
			 
			 $form_data = array(
			 	'life_coach_quiz_id' => $this->input->post('current_id'),
				'life_coach_name' => $this->input->post('ask_expert_name'),
				'life_coach_email' => $this->input->post('ask_expert_email'),
				'life_coach_question' => $this->input->post('ask_expert_question'),						
				);
				
			$life_coach_id = $this->quizesmodel->insert_life_coach($form_data);
			
			$array_of_questions_id =  $this->input->post('answer_hidden_question');
			$array_of_answers = $this->input->post('answer_question');
			
			for($i = 0; $i<sizeof($array_of_questions_id) ; $i++)
			 {
				$question = $array_of_questions_id[$i];
				$answer = $array_of_answers[$i];
				 
				$form_array = array(
				'life_coach_result_question' => $question,
				'life_coach_result_answer' => $answer,
				'life_coach_result_member' => $life_coach_id,
				);
				
				$this->quizesmodel->insert_life_coach_result($form_array);
			 }
			 
			
			redirect('best_time/life_coach_result'); 
			

			/*if ($this->quizesmodel->edit_profile($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('best_time/life_coach');   // or whatever logic needs to occur
			}
			else
			{
				echo 'An error occurred saving your information. Please try again later';
				// Or whatever error handling is necessary
			}*/		
		 }
				
		 //Pass the Data
		 $this->data['current_id'] =  $id;
		 $this->data['target_page'] =  "best_time/view_life_coach" ;
		 $this->data['display_data'] =  $display_data;
		 $this->data['display_questions'] =  $display_questions;
		 $this->data['display_answers'] =  $display_answers;
		 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		 $this->load->view('template' , $this->data);
	
	}
	
	public function easy_tips($id = "")
	{
		if($id != "")
		{
			$this->easy_tips_inner($id);
			return;
		}
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		list( $display_data , $total_rows) =$this->quizesmodel->get_all_easy_tips($config["per_page"],($current_page_num-1)*$config['per_page']);
		$this->data['display_all_tips'] = $display_data ;
		$config['total_rows'] = $total_rows;
		$this->data['flag'] = 0;
		
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(183,$this->data['current_language_db_prefix']);
		
		$this->data['subsection_title'] = $subsection_title;

		//Pass the Data
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['target_page'] =  "best_time/view_easy_list" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);
	}
	public function easy_tips_inner($id)
	{
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(183,$this->data['current_language_db_prefix']);
		
		$this->data['subsection_title'] = $subsection_title;

		//Pass the Data
		$this->data['target_page'] =  "best_time/view_inner_easy" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		$this->data['display'] = $this->quizesmodel->get_easy_tips_details($id);
		$this->data['display_steps'] = $this->quizesmodel->get_easy_tips_steps($id);
		$this->load->view('template' , $this->data);
	}

	public function best_videos()
	{
		//Pass the Data
		 $this->data['target_page'] =  "best_time/view_videos_besttime" ;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
	     $this->load->view('template' , $this->data);
	}
	public function video_all()
	{
		//Pass the Data
		$this->data['target_page'] =  "best_time/view_videos_all_best_time" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);

	}
	public function fashion($id = "")
	{
		if($id != "")
		{
			$this->fashion_inner($id);
			return;
		}
		//Handle Pagination
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		list( $display_data , $total_rows) =$this->quizesmodel->get_all_fashion($config["per_page"],($current_page_num-1)*$config['per_page']);
		$this->data['display_data'] = $display_data ;
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['flag'] = 0;
		
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(184,$this->data['current_language_db_prefix']);
		
		$this->data['subsection_title'] = $subsection_title;

		//Pass the Data
		$this->data['target_page'] =  "best_time/view_fashion_list" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);
	}
	public function fashion_inner($id)
	{
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(184,$this->data['current_language_db_prefix']);
		list( $display_data , $total_rows) =$this->quizesmodel->get_all_fashion(12,0);
		//Pass the Data
		$this->data['subsection_title'] = $subsection_title;
		$this->data['target_page'] =  "best_time/view_fashion_beauty.php" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		$this->data['display'] = $this->quizesmodel->get_fashion_details($id);
		$this->data['display_data'] = $display_data;
		//$this->data['display_steps'] = $this->quizesmodel->get_easy_tips_steps($id);
		$this->data['displayImages'] = $this->quizesmodel->get_fashion_images($id);
		$this->load->view('template' , $this->data);
	}
	
	public function games($id = "")
	{
		if($id != "")
		{
			$this->games_inner($id);
			return;
		}
		$display_data = $this->quizesmodel->retrieve_games_list();
		//$this->data['display_all_tips'] = $display_data ;
		$config['base_url'] = site_url($this->router->class."/".$this->router->method);	
		
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(50,$this->data['current_language_db_prefix']);
		
		$this->data['subsection_title'] = $subsection_title;
		$this->data['display_data'] = $display_data;
	
		//Pass the Data
		$this->data['target_page'] =  "best_time/view_games_list" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);
	}
	public function games_inner($id = "")
	{
		$display_data = $this->quizesmodel->retrieve_game_details($id);
		
		//Pass the Data
		$this->data['display_data'] = $display_data;
		$this->data['target_page'] =  "best_time/view_games_inner" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('template' , $this->data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
