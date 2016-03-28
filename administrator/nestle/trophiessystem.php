<?php
//require_once("../modules/database.php");

/*
To update the members emails,password and joined date
//Get All Data from yaf.
$display_old = $db->querySelect("select * from yaf_user order by UserID ");

//Update data
for($i= 0 ; $i< sizeof($display_old) ; $i++)
{
	unset($tobesaved);
	
	$tobesaved['members_email'] = $display_old[$i]['Email'];
	$tobesaved['members_password'] = $display_old[$i]['ProviderUserKey'];
	$tobesaved['members_addeddate'] = $display_old[$i]['Joined'];
	//echo "test here".$display_old[$i]['UserID'];
	$db->update("members" , $tobesaved , " members_ID=".$display_old[$i]['UserID']);
}
*/




$section_id = 2;
$member_id = 7990;


//$test = new Trophiessystem($section_id , $member_id);



//print_r($test->array_of_trophies);die("tst");


//$test->check_requirments_of_member();

//echo "Recipies :".$test->member_counter_of_recipes." <Br/>";
//echo "Comments :".$test->member_counter_of_reviews." <Br/>";

//Class Handler 

/*
last update by AMAKKI on 12012014
Trophie Class is still under development. 
It now can detect member and awards them the trophy when the function check_requirments_of_member is called.
It can auto detect the trophies that shuold be awareded to the member
Automatically get recipies numebers -done
Automatically get comments (reviews) numbers -done
Automatically get member videos number  -done 
Automatically get member videos total like numbers
Automatically get member articles number -( Canceled )

*/


class Trophiessystem
{
	private $db;
	
	private $array_of_trophies;
	
	public $section_ID;
	
	public $member_ID;
	
	public $member_counter_of_recipes;
	public $member_counter_of_reviews;
	public $member_counter_of_videos;
	public $member_counter_of_likes;
	public $member_counter_of_articles;
	
	public function __construct($section_id , $member_id)
	{
		global $db;
		$this->db = $db;
		
		

		//Hard init. members
		$this->section_ID = $section_id;
		$this->get_array_of_trophies();
		

		
		$this->member_ID = $member_id;
		
		$this->member_counter_of_recipes = $this->check_numbers_of_approved_recipes();
		$this->member_counter_of_reviews = $this->check_numbers_of_approved_comments();
		$this->member_counter_of_likes = 0;
		$this->member_counter_of_videos = $this->check_numbers_of_approved_videos();
		$this->member_counter_of_articles = 0;
		
	}
	
	private function get_array_of_trophies()
	{
	
		//get array of trophies according to sections
		$order_by = $this->section_ID == 2 ? "trophies_recipe_counter" : "trophies_articles_counter";
		
		//Get Trophies
		$display = $this->db->querySelect("select * from trophies where trophies_sections_ID = ".$this->section_ID." order by {$order_by} ");
		
		//return $display;
		$this->array_of_trophies = $display;
	}//End of array of trophies
	
	public function check_requirments_of_member()
	{
		
		for($i=0 ; $i < sizeof($this->array_of_trophies) ; $i++):
		
		
			//Check Every Trophy and compare with member
			unset($temp_array);
			$temp_array = array  (
				"likes"=> $this->array_of_trophies[$i]['trophies_likes_counter'] ,
				"recipes"=> $this->array_of_trophies[$i]['trophies_recipe_counter'] ,
				"reviews"=> $this->array_of_trophies[$i]['trophies_reviews_counter'] ,
				"videos"=> $this->array_of_trophies[$i]['trophies_videos_counter'] ,
				"articles"=> $this->array_of_trophies[$i]['trophies_articles_counter'] ,
				) ;
				
				$state = $this->check_single_row($temp_array);
				
				///IF False at any one, break for loop. 
				if(!$state) break;
				
				///IF True , check if awared before 
				if($state)
				{
				
					$awarded_before_flag = $this->check_awarded_before($this->array_of_trophies[$i]['trophies_ID']);
					
					////IF Awarded before, break for loop
					//if($awarded_before_flag) break;
					////IF not awareded before, award trophy and break for loop.
					if(!$awarded_before_flag)
					{
						$this->award_trophy_to_member($this->array_of_trophies[$i]['trophies_ID']);
						
						
					}
				}
				
				
				
				
				
			 
		
		
		endfor;
		
		
		
		
		
	}//end of check_requirments_of_member
	
	private function check_single_row($trophy_parms)
	{
		$all_flag = true;
		
		if( !($trophy_parms['recipes'] <= $this->member_counter_of_recipes) ) 
		{
			$all_flag = false;
		}
		if( !($trophy_parms['articles'] <= $this->member_counter_of_articles) ) 
		{
			$all_flag = false;
		}
		if( !($trophy_parms['likes'] <= $this->member_counter_of_likes) ) 
		{
			$all_flag = false;
		}
		if( !($trophy_parms['reviews'] <= $this->member_counter_of_reviews) ) 
		{
			$all_flag = false;
		}
		if( !($trophy_parms['videos'] <= $this->member_counter_of_videos) ) 
		{
			$all_flag = false;
		}		
		
		return $all_flag;
		
		
	}//end of check_single_row
	
	
	private function check_awarded_before($trophies_ID)
	{
		$boolean = NULL;
		//Check if awarded before
		$array_of_result = $this->db->numRows("select * from  trophies_awards where trophies_awards_trophies_ID={$trophies_ID} and trophies_awards_members_ID = ".$this->member_ID);
		
		if($array_of_result == 0) $boolean = false;
		if($array_of_result != 0) $boolean = true;
		
		return $boolean;
		
	}//End of check awarded before
	
	
	private function award_trophy_to_member($trophies_ID)
	{
		unset($tobesaved);
		$tobesaved['trophies_awards_trophies_ID'] = $trophies_ID;
		$tobesaved['trophies_awards_members_ID'] = $this->member_ID;
		$tobesaved['trophies_awards_awardeddate'] = date('Y-m-d');
		$state = $this->db->insert("trophies_awards" , $tobesaved);
		
		return $state;
		
	}//End of award_trophy_to_member
	
	private function check_numbers_of_approved_recipes()
	{
		$array_of_result = $this->db->numRows("select * from  members_recipes where members_recipes_approved=1 and members_recipes_members_id = ".$this->member_ID);
		return $array_of_result;
	}
	
	private function check_numbers_of_approved_comments()
	{
		//get comments of articles
		$array_of_result_articles = $this->db->numRows("select * from  comments where comments_type='articles' and comments_approve=1 and comments_members_id = ".$this->member_ID." and comments_section_id=".$this->section_ID." group by comments_foreign_id	");
		//get comments of recipies
		$array_of_result_recipes = $this->db->numRows("select * from  comments where comments_type='recipes' and comments_approve=1 and comments_members_id = ".$this->member_ID." and comments_section_id=".$this->section_ID." group by comments_foreign_id	");
		//get comments of member recipies
		$array_of_result_mrecipes = $this->db->numRows("select * from  comments where comments_type='members_recipes' and comments_approve=1 and comments_members_id = ".$this->member_ID." and comments_section_id=".$this->section_ID." group by comments_foreign_id	");
		
		return ($array_of_result_articles + $array_of_result_recipes + $array_of_result_mrecipes);	 
	}
	
	private function check_numbers_of_approved_videos()
	{
		$no_of_approved_videos = $this->db->numRows("select * from videos where videos_approved=1 and videos_member_flag=".$this->member_ID);
		
		return $no_of_approved_videos;
		
	}
	

	 
}



 
?>