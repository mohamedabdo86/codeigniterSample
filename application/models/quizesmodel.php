<?php
class Quizesmodel extends CI_Model
{
	
	function __construct()
    {
        parent::__construct();
    }
	
	function get_quizes($type = '', $limit, $start,$current_language_db_prefix)
    {
		$this->db->select('*');
		$this->db->from('quizes');
		$this->db->join('images', 'images_ID = quizes_image'.$current_language_db_prefix);
		$this->db->order_by('quizes_ID','Desc');
		$this->db->where('quizes_active' , 1);
		$this->db->where('quizes_flag' , $type);
		
		$query = $this->db->get();
		//return $query->result_array();
		
		//$query = $this->db->get();
		//return $query->result_array();
		
		
		$total_numbers_of_rows = $query->num_rows();
		
		$get_last_generated_query = $this->db->last_query();
		$query = $this->db->query($get_last_generated_query." Limit {$start},{$limit} ");
		
		//$query = $this->db->query($query." Limit {$start},{$limit} ");
		
		return array($query->result_array() , $total_numbers_of_rows);
		
		$query = $this->db->get();
		return $query->result_array();

    }
	function get_other_quizes($type = '',$id,$current_language_db_prefix)
    {
		$this->db->select('*');
		$this->db->from('quizes');
		$this->db->join('images', 'images_ID = quizes_image'.$current_language_db_prefix);
		$this->db->order_by('quizes_ID','Desc');
		$this->db->where('quizes_active' , 1);
		$this->db->where('quizes_flag' , $type);
		$this->db->where('quizes_ID !=', $id);
		
		$query = $this->db->get();
		return $query->result_array();

    }
	
	function get_answer_details($quizes_unique_value_ID,$quizes_ID){
		$this->db->select('*');
		$this->db->from('quizes_result');
		$this->db->where('quize_result_quizes_unique_value_ID' , $quizes_unique_value_ID);
        $this->db->where('quize_result_quizes_ID' , $quizes_ID);
		
		$query = $this->db->get();
		return $query->result_array();
		}

	function get_quizes_details($id,$current_language_db_prefix)
    {
		$this->db->select('*');
		$this->db->from('quizes');
		$this->db->join('images', 'images_ID = quizes_image'.$current_language_db_prefix);
		$this->db->where('quizes_ID', $id);

		$query = $this->db->get();
		return $query->result_array();

    }
	
	function get_featured_quize($type = '',$current_language_db_prefix)
    {
		$this->db->select('*');
		$this->db->from('quizes');
		$this->db->join('images', 'images_ID = quizes_image'.$current_language_db_prefix);
		$this->db->where('quizes_featured', 1);
		$this->db->where('quizes_flag', $type);

		$query = $this->db->get();
		return $query->result_array();

    }
	
	function get_questions($id)
	{
		$this->db->select('*');
		$this->db->from('quizes_questions');
		//$this->db->join('quizes_answers' , 'quizes_questions_ID = quizes_answers_questions_ID');
		$this->db->where('quizes_questions_quizes_ID' , $id);
		//$this->db->group_by("quizes_questions_ID"); 
		$this->db->order_by('quizes_questions_ID');
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function total_question($id){
		$this->db->select('*');
		$this->db->from('quizes_questions');
		$this->db->where('quizes_questions_quizes_ID',$id);
		
		$query = $this->db->get();
		return $query->result_array();
	
		}
	function get_answers($qid)
	{
		$this->db->select('*');
		$this->db->from('quizes_answers');
		$this->db->where('quizes_answers_questions_ID',$qid);
		$this->db->order_by('quizes_answers_ID' , 'desc');
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	/*function get_question($table,$foreign_id,$member_id)
	{
		$this->db->select('*');
		$this->db->from('members_rate');
		$this->db->where('members_rate_type', $table);
		$this->db->where('members_rate_foreign_id', $foreign_id);
		$this->db->where('members_rate_members_id', $member_id);
		
		$query = $this->db->get();
		return $query->num_rows();

	}
	
	function get_answers($type,$foreign_id,$member_id)
	{
		$this->db->select('*');
		$this->db->from('members_rate');
		$this->db->where('members_rate_type', $type);
		$this->db->where('members_rate_foreign_id', $foreign_id);
		$this->db->where('members_rate_members_id', $member_id);
		  
		$query = $this->db->get();
		return $query->row_array();
		  
	}*/
	
	
	function get_all_easy_tips($limit,$start)
	{
		$this->db->select('*');
		$this->db->from('easy_ideas');
		$this->db->join('images', 'images_ID = easy_ideas_image');
		$this->db->where('easy_active',1);
		$this->db->order_by('easy_ideas_ID' , 'desc');
		
		$query = $this->db->get();
		
		$total_numbers_of_rows = $query->num_rows();
		
		$get_last_generated_query = $this->db->last_query();
		
		$query = $this->db->query($get_last_generated_query." Limit {$start},{$limit} ");
		
		return array($query->result_array() , $total_numbers_of_rows);
	}
	function get_easy_tips_details($id)
	{
		$this->db->select('*');
		$this->db->from('easy_ideas');
		 $this->db->where('easy_ideas_ID',$id);

		 
		 $query = $this->db->get();
		 return $query->result_array();
		 
	}
	
	function get_easy_tips_steps($id)
	{
		$this->db->select('*');
		$this->db->from('easy_ideas_steps');
		$this->db->where('easy_ideas_steps_easy_ideas_ID',$id);
		$this->db->join('images', 'images_ID = easy_ideas_steps_image');
 		$this->db->order_by('easy_ideas_steps_ord' , 'Asc');
		 
		$query = $this->db->get();
		return $query->result_array();
		 
	}
	
	function get_easy_tips_single_step($id)
	{
		$this->db->select('*');
		$this->db->from('easy_ideas_steps');
		$this->db->where('easy_ideas_steps_ID',$id);
		$this->db->join('images', 'images_ID = easy_ideas_steps_image');
 		$this->db->order_by('easy_ideas_steps_ord' , 'ASC');
		 
		$query = $this->db->get();
		return $query->result_array();
		 
	}

	function get_all_fashion($limit,$start)
	{
		$this->db->select('*');
		$this->db->from('fashion');
		$this->db->join('images', 'images_ID = fashion_image');
		$this->db->where('Active',1);
		$this->db->order_by('fashion_ID' , 'desc');
		
		$query = $this->db->get();
		
		$total_numbers_of_rows = $query->num_rows();
		
		$get_last_generated_query = $this->db->last_query();
		
		$query = $this->db->query($get_last_generated_query." Limit {$start},{$limit} ");
		
		return array($query->result_array() , $total_numbers_of_rows);
	}
	
	function get_fashion_details($id)
	{
		$this->db->select('*');
		$this->db->from('fashion');
		 $this->db->where('fashion_ID',$id);
		 $this->db->join('images', 'images_ID = fashion_image');

		 
		 $query = $this->db->get();
		 return $query->result_array();
		 
	}
	function get_fashion_images($id)
	{
		$this->db->select('*');
		$this->db->from('fashion_steps');
		$this->db->where('fashion_steps_fashion_ID',$id);
		$this->db->join('images', 'images_ID = fashion_steps_image');
 		$this->db->order_by('fashion_steps_steps_ord' , 'Asc');
		 
		$query = $this->db->get();
		return $query->result_array();
		 
	}
	
	function insert_life_coach($form_data)
    {
		//Encrypt Password 
		$this->db->insert('life_coach', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return $this->db->insert_id();
		}
		
		return FALSE;
    }
	
	function insert_life_coach_result($form_data)
    {
		//Encrypt Password 
		$this->db->insert('life_coach_result', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
    }
	/*function get_fashion_extra_images($id)
	{
		$this->db->select('*');
		$this->db->from('easy_ideas_steps');
		$this->db->where('easy_ideas_steps_easy_ideas_ID',$id);
		$this->db->join('images', 'images_ID = easy_ideas_steps_image');
 		$this->db->order_by('easy_ideas_steps_ord' , 'Asc');
		 
		$query = $this->db->get();
		return $query->result_array();
		 
	}*/
	
	function retrieve_games_list()
    {
		$this->db->select('*');
		$this->db->from('games');
		$this->db->where('games_subsection_ID',50);
		$this->db->where('Active',1);
		$this->db->join('images', 'images_ID = games_image');

		 
		 $query = $this->db->get();
		 return $query->result_array();
	}
	function retrieve_game_details($id)
    {
		$this->db->select('*');
		$this->db->from('games');
		$this->db->where('games_ID',$id);
		$this->db->where('games_subsection_ID',50);
		$this->db->where('Active',1);
		$this->db->join('images', 'images_ID = games_image');

		 
		 $query = $this->db->get();
		 return $query->result_array();
	}


}

?>