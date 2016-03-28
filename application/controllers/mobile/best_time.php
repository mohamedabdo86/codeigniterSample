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
class best_time extends MY_Mcontroller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();

        // Your own constructor code		 
        $this->load->model("articlesmodel");
		$this->load->model("quizesmodel");

        //Load Languages
        $this->load->helper('language');
        $this->lang->load('globals');
        $this->lang->load('besttime');

        //Set Section name
        $this->headers->set_second_title(lang("globals_besttime"));

        //Initlize common data 
        $this->data = array();
        $this->data['current_section_id'] = 28;
		

        //Apply Languages
        $site_lang = $this->config->item('language');
        $this->data['current_language'] = $site_lang;
        $this->data['current_language_db_prefix'] = $site_lang == "arabic" ? "_ar" : "";


        //Apply Sections Color
        $this->data['current_section'] = "best-time";
		$this->data['imageFolder'] = "besttime";
		$this->data['current_section_color'] = "best_time_color";

        //Apply Default Subsections ID
        $this->data['id_of_current_sub_section'] = false;
        $this->data['parent_id_of_current_sub_section'] = false;
    }

    public function index()
    {
        
		$this->data['display_besttime_quiz'] =  $this->quizesmodel->get_featured_quize('quiz',$this->data['current_language_db_prefix']);
		$this->data['display_all_quizes'] = $this->quizesmodel->get_featured_quize('life_coach','','',$this->data['current_language_db_prefix']);
		
        $this->data['target_page'] = "best_time/homepage";
		$this->data['common_row'] = $this->get_common_row();
        $this->load->view('mobile/template', $this->data);
    }
	
	protected function get_common_row()
	{
		
		return $this->load->view('mobile/best_time/common_row',$this->data,true);
	}
	
public function quiz($id = "")
	{
		
		if(!empty($id)){
			$this->quiz_inner($id);
			return;
		}
		

		
		//Handle Pagination
		$config['base_url'] = site_url_mobile($this->router->class."/".$this->router->method);		
		$config['per_page'] = 12; 
		
		//Current Page Number for database
		$current_page_num =1;
		if( isset($_GET['page']) && $_GET['page'] != ""  ){
			$current_page_num = (int)$_GET['page'] ;
		}
		
		//Added By Makki - Security Fix at 06/1
		$current_page_num = $current_page_num <=0 ? 1 : $current_page_num;
		
		list($this->data['display_data'], $total_rows) = $this->quizesmodel->get_quizes('quiz', $config["per_page"],($current_page_num-1)*$config['per_page'],$this->data['current_language_db_prefix']);
		$config['total_rows'] = $total_rows;
		$this->data['myroot']="uploads/quizes/thumb_";
		$this->data['myid']="quizes_ID";
		$this->data['col_name']="quizes_title";
		$this->data['flag'] = 0;
		
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(186,$this->data['current_language_db_prefix']);
		


		$this->data['subsection_title'] = $subsection_title;

		//Pass the Data
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['target_page'] =  "best_time/view_quizes_list" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('mobile/template' , $this->data);
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
		 $this->data['target_page'] =  "best_time/inner_quiz" ;
		 $this->data['display_data'] =  $display_data;
		 $this->data['display_questions'] =  $display_questions;
		 $this->data['display_answers'] =  $display_answers;
		 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		 $this->load->view('mobile/template' , $this->data);
	
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
		  //$this->data['target_page'] =  "best_time/result" ;
		  
		
		
//}else{
	// $this->data['has_data'] = 0;
	 //$this->data['nodisplay_data'] = "gggggggggggggggggg";
	//}
	    $this->load->view('mobile/best_time/result', $this->data); 
	  ////end/////
		  
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
		$this->data['display_data'] = $display_data ;
		$this->data['col_name']="easy_ideas_title";
		$this->data['myid']="easy_ideas_ID";
		
		$this->data['myroot']="uploads/easy/thumb_";	
		$config['total_rows'] = $total_rows;
		$this->data['flag'] = 0;
		
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(183,$this->data['current_language_db_prefix']);
		
		$this->data['subsection_title'] = $subsection_title;

		//Pass the Data
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['target_page'] =  "best_time/view_quizes_list" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('mobile/template' , $this->data);
	}
	public function easy_tips_inner($id)
	{
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(183,$this->data['current_language_db_prefix']);
		
		$this->data['subsection_title'] = $subsection_title;

		//Pass the Data
		$this->data['target_page'] =  "best_time/inner_easy_tips" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		$this->data['display'] = $this->quizesmodel->get_easy_tips_details($id);
		$this->data['display_steps'] = $this->quizesmodel->get_easy_tips_steps($id);
		$this->load->view('mobile/template' , $this->data);
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
		$this->data['myid']="fashion_ID";
		$this->data['col_name']="fashion_title";
		$this->data['myroot']="uploads/fashion/thumb_";
		$this->data['pagination_links'] = getPaginationString($current_page_num,$total_rows,$config['per_page'],2,$config['base_url'], "?page=",lang("globals_prev"),lang("globals_next"));
		$this->data['flag'] = 0;
		
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(184,$this->data['current_language_db_prefix']);
		
		$this->data['subsection_title'] = $subsection_title;

		//Pass the Data
		$this->data['target_page'] =  "best_time/view_quizes_list" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		
		$this->load->view('mobile/template' , $this->data);
	}
	public function fashion_inner($id)
	{
		list($subsection_id,$subsection_title,$subsection_extra) = getSectiondata(184,$this->data['current_language_db_prefix']);
		list( $display_data , $total_rows) =$this->quizesmodel->get_all_fashion(12,0);
		//Pass the Data
		$this->data['subsection_title'] = $subsection_title;
		$this->data['target_page'] =  "best_time/inner_fashion" ;
		$this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		$this->data['display'] = $this->quizesmodel->get_fashion_details($id);
		$this->data['display_data'] = $display_data;
		//$this->data['display_steps'] = $this->quizesmodel->get_easy_tips_steps($id);
		$this->data['displayImages'] = $this->quizesmodel->get_fashion_images($id);
		$this->load->view('mobile/template' , $this->data);
	}


}
