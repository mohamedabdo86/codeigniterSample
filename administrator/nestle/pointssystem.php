<?php
//require_once("../modules/database.php");

//Class Handler
class Pointssystem
{
	private $db;
	
	public $registration_points;
	public $signin_points;
	public $poll_points;
	public $tell_a_friend_points;
	public $upload_recipe_points;
	public $share_points;
	public $new_ask_question_points;
	public $new_comment_points;
	public $new_rate_points;
	
	
	
	public function __construct()
	{
		global $db;
		$this->db = $db;
		
		
		//GEt Points
		$this->registration_points = $this->get_points("registration");
		$this->signin_points = $this->get_points("signin");
		$this->poll_points = $this->get_points("poll");
		$this->tell_a_friend_points = $this->get_points("invite_friend");
		$this->friend_confirm_invitation_points = $this->get_points("confirm_invitation");
		$this->upload_recipe_points = $this->get_points("upload_recipe");
		$this->share_points = $this->get_points("share");
		$this->new_ask_question_points = $this->get_points("new_ask_question");
		$this->new_comment_points = $this->get_points("new_comment");
		$this->new_rate_points = $this->get_points("new_rate");
		$this->upload_video_points = $this->get_points("upload_video");
		
		
	}
	
	//Retrieve Points
	private function get_points($id)
	{
		//Generate SQL Query 
		$display = $this->db->querySelectSingle("select * from interaction  where interaction_define = '".$id."' ");
		
		return $display['interaction_points'];
	}
	
	//Approve Uploaded Recipe
	public function approve_action($member_id , $points_to_add,$interaction_define="",$operation_id="")
	{
		//Update Query
		$state  = $this->db->query("update members set members_points=members_points+{$points_to_add} where members_ID =  ".$member_id);
		//echo $operation_id;
		//exit();
		if ($interaction_define <>""){
			if(!$key){
				$key = md5(uniqid());
			}
			//echo $key;
			if ($operation_id<>""){
				$checkSqlQuery = "select * from `points` where `points_user_id`='" . $member_id . "' && `operation_id`='" . $operation_id . "'";
				
				$num_rows = $this->db->numRows($checkSqlQuery);
				if ($num_rows<1){
						$addPointsQuery = "insert into `points` set `points_user_id`='" . $member_id . "',`points_type`='" .$interaction_define . "',`points_number`='".$points_to_add."',`operation_id`='".$operation_id."',`points_key`='" . $key ."',`points_timestamp`='" . time() . "',`points_date`='" . date('Y-m-d') . "'";
						echo $addPointsQuery;
						//exit();
						$state1  = $this->db->query($addPointsQuery);
				}
				
			}else {
				$addPointsQuery = "insert into `points` set `points_user_id`='" . $member_id . "',`points_type`='" . $interaction_define ."',`points_key`='" . $key . "',`points_timestamp`='" . time() . "',`points_date`='" .date('Y-m-d') . "'";
				/*echo $addPointsQuery;
				exit();*/
				$state1  = $this->db->query($addPointsQuery);
			}

		}

		/*$data = array('members_points' => $points_to_add);
		$this->db->where('members_ID', $member_id);
		$this->db->update('members', $data);*/
		return $state;
		
	}
	
	//Disapprove Uploaded Recipe
	public function disapprove_action($member_id , $points_to_add)
	{
		//Update Query
		$state  = $this->db->query("update members set members_points=members_points-{$points_to_add} where members_ID =  ".$member_id);
		
		return $state;
		
	}

	 
}




?>