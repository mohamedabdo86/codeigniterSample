<?php
class Membersmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->load->library('encrypt');
    }
	
	/*
	Function : insert a new member when register */
	function insert_register_form($form_data)
    {
		//Encrypt Password 
		//$form_data['members_password'] = $this->encrypt->encode($form_data['members_password']);
		$this->db->insert('members', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return $this->db->insert_id();
		}
		
		return FALSE;
    }
	
	function insert_member_image($form_data)
    {
		//Encrypt Password 
		$this->db->insert('images', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return $this->db->insert_id();
		}
		
		return FALSE;
    }
	
	/*
	Function : validate user data */
	function checksignin($form_data)
    {
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('members_email',$form_data['members_email']);

		$query = $this->db->get();
		$array_of_results = null;
		$array_of_results = $query->result();
		
		if($query->num_rows() == 0 ) return false;
		else
		{
			/*$form_password =  $form_data['members_password'];
			$database_password =   $this->encrypt->decode($array_of_results[0]->members_password);
			
			if($form_password == $database_password)
			{*/
				//Create session
				$newdata = array(
				   'userid'  => $array_of_results[0]->members_ID,
                   'name'  => $array_of_results[0]->members_first_name." ".$array_of_results[0]->members_last_name,
                   'email'     => $array_of_results[0]->members_email,
                   'logged_in' => TRUE
               );

			   $this->session->set_userdata($newdata);
			   return true;
			//}
			
		}
		
		
		return false;
    }
	
	function check_reset_password_request($member_id, $key){
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('members_ID',$member_id);
		$this->db->where('members_reset_password_requested',$key);
		$query = $this->db->get();
		
		if($query->num_rows() == 0 ){
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	function get_member_points($id) {
			
	}
	
	/*
	Function : get info  */
	function get_member_info($id)
    {
		$this->db->select('*');
		$this->db->from('members');
		//$this->db->join('images', 'images_ID = members_images');
		$this->db->where('members_ID',$id);
		
		$query = $this->db->get();
		return $query->result_array();
		
	
	}
	
	function get_member_image($id)
    {
		$this->db->select('*');
		$this->db->from('members');
		$this->db->join('images', 'images_ID = members_images');
		$this->db->where('members_ID',$id);
		
		$query = $this->db->get();
		return $query->result_array();
		
	
	}
	
	/*
	Function : get_no_of_member_recipeso  */
	function get_no_of_member_recipes($id , $all = true)
    {
		$this->db->select('*');
		$this->db->from('members_recipes');
		$this->db->where('members_recipes_members_id',$id);
		
		if(!$all)
		$this->db->where('members_recipes_approved',0);
		
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	/*
	Function : add_member_recipe  */
	function add_member_recipe($form_data)
	{
		$this->db->insert('members_recipes', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return $this->db->insert_id();
		}
		
		return FALSE;
	}
	
	function add_member_video($form_data)
	{
		$this->db->insert('videos', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return $this->db->insert_id();
		}
		
		return FALSE;
	}
	
	function update_video_url($video_url, $recipe_id){
		$data = array('videos_url' => $video_url);
		$this->db->where('videos_foreign_id', $recipe_id);
		$this->db->update('videos', $data);
		if ($this->db->affected_rows() == '1'){
			return TRUE;
		}else{
			return FALSE;
	    }
	}
	
	function unsubscribe_newsletter($id){
		$data = array('members_newsletter' => 0);
		$this->db->where('members_ID', $id);
		$this->db->update('members', $data);
		if ($this->db->affected_rows() == '1'){
			return TRUE;
		}else{
			return FALSE;
	    }
	}
	
	/*
	Function : edit_member_recipe  */
	function edit_member_recipe($form_data, $recipe_id)
	{	
		$this->db->where('members_recipes_ID', $recipe_id);
		$this->db->update('members_recipes', $form_data);
		if ($this->db->affected_rows() == '1'){
		return TRUE;
		}else{
		return FALSE;
	    }
		
	}

	function edit_profile($form_data)
	{	
		$members_id=$this->members->members_id;
		
		$this->db->where('members_ID',$members_id);
		$this->db->update('members', $form_data);
		
		return TRUE;

	}
	function second_step($form_data, $member_id)
	{	
		$this->db->where('members_ID',$member_id);
		$this->db->update('members', $form_data);
		
		return TRUE;

	} 
	/*
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}*/
		
	/*
	Function : add_ask_an_expert_question  */
	function add_ask_an_expert_question($form_data)
	{
		$this->db->insert('ask_expert', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
	

	/*
	Function : get_city  */
	function get_city($current_language_db_prefix , $export_for_select = true , $defaultvalue = "" , $id = NULL)
    {
		if($export_for_select === true)
		$this->db->select('city_ID as id, city_title'.$current_language_db_prefix.' as value');
		
		if($export_for_select === false)
		$this->db->select('*');
		
		$this->db->from('city');
		$this->db->order_by('city_ID','Desc');
		
		if($id != NULL)
		$this->db->where('city_ID' , $id);
		
		$query = $this->db->get();
		
		if($export_for_select === true)
		{
			//if($defaultvalue != "")
			//$data['']=$defaultvalue;
			
			foreach($query->result_array() as $row)
			{
           		 $data[$row['id']]=$row['value'];
        	}
			
			return $data;
		}
		return $query->result_array();
	
	}
	
	/*
	Function : get_relationship  */
	function get_relationship($current_language_db_prefix , $export_for_select = true , $defaultvalue = "" , $id = NULL)
    {
		if($export_for_select)
		$this->db->select('relationship_ID as id, relationship_title'.$current_language_db_prefix.' as value');
		
		if(!$export_for_select)
		$this->db->select('*');
		
		$this->db->from('relationship');
		$this->db->order_by('relationship_ID' ,'Desc');
		
		if($id != NULL)
		$this->db->where('relationship_ID' , $id);
		
		$query = $this->db->get();
		if($export_for_select)
		{
			if($defaultvalue != "")
			$data['']=$defaultvalue;
			
			foreach($query->result_array() as $row)
			{
           		 $data[$row['id']]=$row['value'];
        	}
			
			return $data;
		}
		return $query->result_array();
	
	}
	
	/*Function : insert_childern  */
	function insert_childern($form_data)
	{
		$this->db->insert('members_children', $form_data);
		
			return TRUE;
	}
	
	
	/*Function : get_childern  */
	function get_childern($id)
    {
		$this->db->select('*');
		$this->db->from('members_children');
		$this->db->where('members_children_members_id',$id);
		
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	/*Function : get_childern  */
	function delete_members_children($id) 
	{
		
	 	$this->db->where('members_children_members_id',$id); // I change id with book_id
		$this->db->delete('members_children');
	}

	
	/*Function : newsletter_types  */
	function get_newsletter($current_language_db_prefix , $export_for_select = true , $defaultvalue = "" , $id = NULL)
    {
		if($export_for_select)
		$this->db->select('newsletter_types_ID as id, newsletter_types_title'.$current_language_db_prefix.' as value');
		
		if(!$export_for_select)
		$this->db->select('*');
		
		$this->db->from('newsletter_types');
		$this->db->order_by('newsletter_types_ID' ,'Desc');
		
		if($id != NULL)
		$this->db->where('newsletter_types_ID' , $id);
		$this->db->where('newsletter_types_appear_at_mycorner',1);
		
		$query = $this->db->get();
		if($export_for_select)
		{
			if($defaultvalue != "")
			$data['']=$defaultvalue;
			
			foreach($query->result_array() as $row)
			{
           		 $data[$row['id']]=$row['value'];
        	}
			
			return $data;
		}
		return $query->result_array();
	
	}
	
	function get_members_trophies($member_id){
		$this->db->select('*');
		$this->db->from('trophies_awards');
		$this->db->join('trophies' , 'trophies_ID = trophies_awards_trophies_ID');
		$this->db->join('images' , 'images_ID = trophies_images');
		$this->db->where('trophies_awards_members_ID',$member_id);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_members_newsletter($email)
    {
		$this->db->select('*');
		$this->db->from('newsletter_members');
		$this->db->join('newsletter_types' , 'newsletter_types_ID = newsletter_members_newsletter_types_id');
		$this->db->where('newsletter_members_members_emails',$email);
		
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	function get_members_nonselected_newsletter($email)
    {
		$this->db->select('*');
		$this->db->from('newsletter_members');
		$this->db->join('newsletter_types' , 'newsletter_types_ID = newsletter_members_newsletter_types_id');
		$this->db->where('newsletter_members_members_emails !=',$email);
		
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	/*Function : insert_pregnancy  */
	function insert_pregnancy($form_data)
	{
		$this->db->insert('pregnancy', $form_data);
		
			return TRUE;
	}
	
	/*Function : get_pregnancy  */
	function get_pregnancy($email)
	{
		$this->db->select('*');
		$this->db->from('pregnancy');
		$this->db->where('pregnancy_members_email',$email);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	/*Function : insert_childern  */
	function insert_newsletter_members($form_data)
	{
		$this->db->insert('newsletter_members', $form_data);
		
			return TRUE;
	}
	
	function delete_newsletter_members($email) 
	{
		
	 	$this->db->where('newsletter_members_members_emails',$email); // I change id with book_id
		$this->db->delete('newsletter_members');
	}
	
	/*Function : delete_pregnancy  */ 
 	function delete_pregnancy($email) 
 	{
   	$this->db->where('pregnancy_members_email',$email); 
  	$this->db->delete('pregnancy');
 	}
	
	/*Function : insert_member_section_order  */
	function insert_member_section_order($form_array , $member_id)
	{
		for($i = 0; $i<sizeof($form_array); $i++) 
		{
			$value = $form_array[$i];
			$data = array(
			'members_section_order_members_id' => $member_id ,
			'members_section_order_section_id' => $value ,
			'members_section_order_index' => ($i+1)
			);
			
			$this->db->insert('members_section_order', $data);
		}
		return TRUE;
	}
	/*Function : delete_member_section_order  */
	function delete_member_section_order($member_id) 
	{
	 	$this->db->where('members_section_order_members_id',$member_id); 
		$this->db->delete('members_section_order');
		
		return TRUE;
	}
	
	/*Function : get_members_sections_order  */
	function get_members_sections_order($member_id)
	{
		$this->db->select('*');
		$this->db->from('members_section_order');
		$this->db->where('members_section_order_members_id',$member_id);
		$this->db->order_by('members_section_order_index' ,'Asc');	
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	/*Function : delete_member_section_order  */
	function get_members_book($member_id , $type) 
	{
	 	$this->db->select('*');
		$this->db->from('members_favorites');
		$this->db->join('sections','members_favorites_section_id = sections_ID');
		//$this->db->join('newsletter_types' , 'newsletter_types_ID = newsletter_members_newsletter_types_id');
		$this->db->where('members_favorites_members_id',$member_id);
		$this->db->where('members_favorites_type',$type);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	/*Function : get_members_section_order  */
	function get_members_section_order($member_id) 
	{
	 	$this->db->select('*');
		$this->db->from('members_section_order');
		$this->db->join('sections','sections_ID	= members_section_order_section_id');
		$this->db->where('members_section_order_members_id',$member_id);
		$this->db->order_by('members_section_order_index' ,'Asc');	
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function check_email_found($email_check = "") {
		
		$email = $this->input->post('email');
		
		if($email_check != "")
		$email = $email_check;
		
		
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('members_email', $email);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function check_valid_cooking_class_email($email_check = "") {
		
		$email = $this->input->post('email');
		
		if($email_check != "")
		$email = $email_check;
		
		
		$this->db->select('*');
		$this->db->from('cooking_classes_members');
		$this->db->where('cooking_classes_members_email', $email);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function check_valid_diet_app_email($email_check = "")
	{
		
		$email = $this->input->post('email');
		
		if($email_check != "")
		$email = $email_check;
		
		
		$this->db->select('*');
		$this->db->from('members_app');
		$this->db->where('members_app_mail', $email);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function check_valid_username($username = ""){
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('members_nickname', $username);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	public function get_all_members($no_of_records, $start_offset)
	{
		$this->db->select('*');
		$this->db->from('members');
		//$this->db->where('members_password !=' , '');
		//$this->db->or_where('members_password_new !=' , '');
		//$this->db->limit($no_of_records, $start_offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	function edit_member($id,$form_data)
	{	
		
		$this->db->where('members_ID',$id);
		$this->db->update('members', $form_data);
		
		return TRUE;

	}
	function check_email_confirmed($id,$code)
	{
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('members_ID' , $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	function approve_email_account($id)
	{
		$form_data['members_activated'] = "1";
		$this->db->where('members_ID',$id);
		$this->db->update('members', $form_data);
		return TRUE;
	}
	
	function view_user_recipe($id){
		$this->db->select('*');
		$this->db->from('members_recipes');
		$this->db->join('images', 'images_ID = members_recipes_image');
		$this->db->where('members_recipes_members_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function edit_user_recipe($recipe_id ,$id){
		$this->db->select('*');
		$this->db->from('members_recipes');
		$this->db->join('images', 'images_ID = members_recipes_image');
		$this->db->where('members_recipes_ID', $recipe_id);
		$this->db->where('members_recipes_members_id', $id);
		$query = $this->db->get();
		if($query->num_rows() == 1 ){
			return $query->result_array();
		}else{
		    return false;
		}
	}
	
	function get_recipe_video($recipe_id)
	{
		$this->db->select('videos_url');
		$this->db->from('videos');
		$this->db->where('videos_foreign_id', $recipe_id);
		$query = $this->db->get();
		$ret = $query->row();
		if($query->num_rows() == 1 )
		{
			return $url = $ret->videos_url;
		}else
		{
		    return false;
		}
	}
	
	function delete_recipe_image($image_id)
	{
		$this->db->where('images_ID', $image_id);
        $this->db->delete('images'); 
		return true;
	}
	
	function delete_members_image($image_id)
	{
		$this->db->where('images_ID', $image_id);
        $this->db->delete('images'); 
		return true;
	}
	
	function delete_user_recipe($recipe_id, $image_id){
		// Delete from member recipes
		$this->db->where('members_recipes_ID', $recipe_id);
		$this->db->delete('members_recipes'); 
		
		// Delete from favourite recipes
		$this->db->where('members_favorites_members_id', $recipe_id);
		$this->db->delete('members_favorites');
		
		// Get image file
		$this->db->select('images_src');
		$this->db->from('images');
		$this->db->where('images_ID', $image_id);
		$query = $this->db->get();
		$img_src = $query->row();
		
		$this->load->helper("file");
		$path = base_url().'/uploads/test/'.$img_src;
		delete_files($path);
		
		// Delete recipe image
		$this->db->where('images_ID', $image_id);
		$this->db->delete('images');
	}
	
	function delete_user_favourites($id){
		$this->db->where('members_favorites_ID', $id);
		$this->db->delete('members_favorites');
		
		return $this->db->affected_rows();
	}
	
	/*Function : get_awards  */
	function get_awards()
    {
		$this->db->select('*');
		$this->db->from('awards');
		$this->db->join('images', 'images_ID = awards_images');
		$this->db->order_by('awards_number');
		
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	/*Function : get_awards_packages  */
	function get_awards_packages($id)
    {
		$this->db->select('*');
		$this->db->from('awards_package');
		//$this->db->join('images', 'images_ID = awards_images');
		$this->db->where('awards_package_awards_id', $id);
		
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	/*Function : get_awards  */
	function get_members_trophies_awards($id)
    {
		$this->db->select('*');
		$this->db->from('trophies_awards');
		$this->db->where('trophies_awards_members_ID' , $id);
		
		$query = $this->db->get();
		return $query->num_rows();
		
	}


	/*Function : get_awards  */
	function get_points()
    {
		$this->db->select('*');
		$this->db->from('interaction');
		$this->db->where('interaction_show' ,1);
		
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	function check_email_invitation($member_id, $email){
		$this->db->select('*');
		$this->db->from('invitations');
		$this->db->where('invitation_user_id', $member_id);
		$this->db->where('invitation_email', $email);
		$query = $this->db->get();
		
		if($query->num_rows() == 0 )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function insert_invitation($member_id, $email, $key){
		$data = array(
		   'invitation_user_id' => $member_id ,
		   'invitation_email' => $email ,
		   'invitation_key' => $key 
		);
		
		$insert = $this->db->insert('invitations', $data);
		if($insert){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function get_member_name($member_id){
		$this->db->select('members_first_name, members_last_name');
		$this->db->from('members');
		$this->db->where('members_ID', $member_id);
		$query = $this->db->get();
		$ret = $query->row();
		$first_name = $ret->members_first_name; 
		$last_name = $ret->members_last_name;
		$name = $first_name." ".$last_name;
		return $name; 
	}
	
	function check_user_points($key){
		$this->db->select('*');
		$this->db->from('points');
		$this->db->where('points_key', $key);
		$query = $this->db->get();
		
		if($query->num_rows() == 0 )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function check_user_login_today($member_id, $points_type, $date){
			$this->db->select('points_date');
			$this->db->from('points');
			$this->db->where('points_user_id', $member_id);
			$this->db->where('points_type', $points_type);
			$this->db->where('points_date', $date);
			$query = $this->db->get();
			
			if($query->num_rows() == 0 )
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}
			 
	}
	
	function check_date_current_date($date){
		$this->db->select('*');
		$this->db->from('current_date');
		$this->db->where('current_date_date', $date);
		$query = $this->db->get();
		if($query->num_rows() == 0 ){
			 $this->db->empty_table('current_date');
			 $data = array(
			 	'current_date_date' => $date
			 );
			 $insert = $this->db->insert('current_date', $data);
			 return false;
		}else{
			return true;
		}
	}
	
	function check_current_date($date){
		$this->db->select('*');
		$this->db->from('pregnancy');
		$this->db->where('pregnancy_end_date', $date);
		$query = $this->db->get();
		if($query->num_rows() == 0 ){
			 return false;
		}else{
			return $query->result_array();
		}
	}
	
	function add_user_points($member_id, $points_type, $key=""){
		if(!$key){
			$key = md5(uniqid());
		}
		$points_number = 0;
		
		$this->db->select('*');
		$this->db->from('interaction');
		$this->db->where('interaction_define', $points_type);
		$query = $this->db->get();
		$ret = $query->row();
		$points_number = $ret->interaction_points;
	
		$data = array(
		   'points_user_id' => $member_id ,
		   'points_type' => $points_type ,
		   'points_number' => $points_number ,
		   'points_key' => $key,
		   'points_timestamp' => time(),
		   'points_date' => date('Y-m-d')
		);
		$insert = $this->db->insert('points', $data);
		
		if($insert){
			$this->db->select('points_number');
			$this->db->from('points');
			$this->db->where('points_user_id', $member_id);
			$this->db->order_by("points_id", "desc");
			$this->db->limit(1); 
			$points = $this->db->get();
			$result = $points->row();
			$total_points = $result->points_number;
			
			/*$this->db->select('points_number');
			$this->db->from('points');
			$this->db->where('points_user_id', $member_id);*/
			$this->db->select('members_points');
 			$this->db->from('members');
 			$this->db->where('members_ID', $member_id);
			$points = $this->db->get();
			$result = $points->result();
			$current_points = 0;
			foreach($result as $row){
				//$current_points += $row->points_number;
				$current_points += $row->members_points;
				//echo $current_points . "<br>";
			}
			//echo $current_points . "<br>";
			//exit();
			$data = array('members_points' => $total_points+$current_points);
			$this->db->where('members_ID', $member_id);
			$this->db->update('members', $data);
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function points_invitation($key){
		$this->db->select('invitation_user_id');
		$this->db->from('invitations');
		$this->db->where('invitation_key', $key);
		$query = $this->db->get();
		$ret = $query->row();
		return $ret->invitation_user_id;
	}
	
	function add_member_app($form_data)
	{
		$this->db->insert('members_app', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return $this->db->insert_id();
		}
		
		return FALSE;
	}
	
	function get_member_awards($member_points){
		$this->db->select('*');
		$this->db->from('awards');
		$this->db->join('images', 'images_ID = awards_icons');
		$this->db->where('awards_number <=', $member_points);
		$this->db->order_by('awards_number');
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function send_prize_email($data){
		$this->db->insert('awards_email', $data);
		
		if ($this->db->affected_rows() == '1')
		{
			return true;
		}else{
			return false;
		}
	}
	
	function display_get_prize($member_id){
		$this->db->select('*');
		$this->db->from('awards_email');
		$this->db->join('awards', 'awards_ID = awards_email_awards_id');
		//$this->db->join('members', 'members_ID = awards_email_member_id');
		$this->db->where('awards_email_member_id <=', $member_id);
		$this->db->where('awards_email_approve <=', 0);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function get_award_number($awards_id){
		$this->db->select('*');
		$this->db->from('awards');
		$this->db->where('awards_ID', $awards_id);
		$query = $this->db->get();
		$row = $query->row();
		return $row->awards_number;
	}
	
	function check_user_salt($salt){
		$this->db->select('members_ID');
		$this->db->from('members');
		$this->db->where('members_salt', $salt);
		$query = $this->db->get();
		$row = $query->row();
		if($query->num_rows() == 0 )
		{
			return false;
		}
		else
		{
			return $row->members_ID;
		}
	}
	
	function add_attempt($member_id, $ip_address, $date ,$timestamp)
	{
		$data = array(
		   'login_attempts_member_id' => $member_id ,
		   'login_attempts_ip_address' => $ip_address ,
		   'login_attempts_date' => $date ,
		   'login_attempts_timestamp' => $timestamp 
			);
		
		$insert = $this->db->insert('login_attempts', $data);
		if($insert){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function insert_lock_time($member_id, $unlockTime)
	{
		$data = array('members_login_lock_time' => $unlockTime );
		
		$this->db->where('members_ID', $member_id);
		$this->db->update('members', $data);
		
		return TRUE;
	}
	
	
	function update_member_total_attempt($member_id)
	{
		
		$this->db->where('login_attempts_member_id', $member_id);
		$this->db->from('login_attempts');
		$total = $this->db->count_all_results();

		$data = array('members_login_attempts' => $total);
		$this->db->where('members_ID', $member_id);
		$this->db->update('members', $data);
		
		return $total;
	}

	function reset_time_attempt_account($member_id)
	{	
		$data = array('members_login_lock_time' => 0 , 'members_login_attempts' => 0  );
		$this->db->where('members_ID', $member_id);
		$this->db->update('members', $data);
		
		return TRUE;
		
	}
	
	function reset_member_attempts($member_id)
	{	
		$this->db->where('login_attempts_member_id', $member_id);
		$this->db->delete('login_attempts');
		
		return TRUE;
		
	}
	
	function get_all_user_question($member_id,$section_id){
		$this->db->select('*');
		$this->db->from('ask_expert');
		$this->db->where('ask_expert_members_id' , $member_id);
		$this->db->where('ask_expert_approve' , 1);
		$this->db->where('ask_expert_section_ID' , $section_id);
		

		
		$query = $this->db->get();
		return $query->result_array();
		
		}
		
		function get_all_question($member_id){
		$this->db->select('*');
		$this->db->from('ask_expert');
		$this->db->where('ask_expert_members_id' , $member_id);
		$this->db->where('ask_expert_approve' , 1);
	
		
		$query = $this->db->get();
		return $query->result_array();
		
		}
		
	function get_section_doctor($section_id)
	{
		$this->db->select('*');
		$this->db->from('static');
		$this->db->where('static_foreign_id' , $section_id);
		$this->db->where('static_type' , 'ask_expert');
	
		
		$query = $this->db->get();
		return $query->result_array();
		
	}
	
	/*Function : insert_members_log  */
	function insert_members_log($form_data)
	{
		$this->db->insert('members_log', $form_data);
		
			return TRUE;
	}
	
	/*Function : delete_members_log  */
	function delete_members_log($id) 
	{
	 	$this->db->where('members_log_members_id',$id); 
		$this->db->delete('members_log');
	}
	
	/*Function : find_members_log   */
	function find_members_log($member_id)
	{
		$this->db->select('*');
		$this->db->from('members_log');
		$this->db->where('members_log_members_id' , $member_id);
		
		$query = $this->db->get();
		return $query->result_array();
		
	}

}
 ?>