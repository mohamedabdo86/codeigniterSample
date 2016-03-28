<?php

class Administrator 
{
	private $current_member_id;
	private $current_array_of_actions;
	private $administrator_actions;
	private $limited_actions;
	
	public function __construct($member_id)
	{
		$this->current_member_id = $member_id;
		//Get What types of Accounts can do 
		$this->administrator_actions = array(
		"can_view",
		"can_add",
		"can_edit",
		"can_delete",
		"admin_pages_access",
		"admin_pages_access_add",
		"admin_pages_access_edit",
		"admin_pages_access_delete",
		"view_users",
		"add_users",
		"edit_users",
		"delete_users"
		);
		$this->limited_actions =  array(
		"can_view" 
		);
		$this->marketing_actions =  array(
		"view_reports"		
		);
		$this->dataentry_actions =  array(
		"can_view",
		"can_add",
		"can_edit",
		"can_delete"	
		);
		
	}
	public function get_full_name()
	{
		global $db;
		//Check Current User
		$display = $db->querySelectSingle("select * from users where users_ID=".$this->current_member_id);
		
		return $display['users_name'];
	}
	public function get_allowed_actions()
	{
		global $db;
		//Check Current User
		$display = $db->querySelectSingle("select * from users where users_ID=".$this->current_member_id);
		
		//Get type of current user
		$current_type = $display['users_type'];
		
		switch ($current_type)
		{
			case "Administrator": $this->current_array_of_actions = $this->administrator_actions; break;
			case "Limited": $this->current_array_of_actions = $this->limited_actions; break;
			case "Marketing": $this->current_array_of_actions = $this->marketing_actions; break;
			case "Data Entry": $this->current_array_of_actions = $this->dataentry_actions; break;
		}
		
		return $this->current_array_of_actions;
	}
	
	public static function session_login($username, $password){
		if(isset($_SESSION['current_backend_user_id']))
		{
			return true;
		}
		else
		{
			if (!$username || !$password)
			{
				return false;
			}
			
						
			if(!Administrator::validate_admin($username , $password))
			{
				
				//Display Error Message
				/*echo "<script> alert('Wrong Username or password ')</script>";*/
				return false;
			}
			$state = Administrator::validate_admin($username , $password);
			
			//$dir = $_SERVER['PHP_SELF'];
			/*echo "<script> alert('dir $dir')</script>";*/
			
				
			return $state;
		}
	
}
	
	public  static function validate_admin($username , $password)
	{
		global $db;
		
		//$num = $db->querySelectSingle("select * from users where users_email ='".$db->escape($username)."' and users_password  = '".$db->escape($password)."'");
		$num = $db->querySelectSingle("select * from users where users_active = 1 and users_email ='".$db->escape($username)."' and users_password  = '".crypt(sha1(md5($db->escape($password))), 'st')."'");
		
		if(empty($num))
		{
		
			return false;
		}
		else
		{
			session_start();
			//$_SESSION['ID']=$row['admin_ID'];
			$_SESSION['current_backend_user_id']=$num['users_ID'];
			$_SESSION['timeout'] = time();
			$_SESSION['IP_address'] = $_SERVER['REMOTE_ADDR'];
			
			//$_SESSION['password']=$password;
			 
			return true;
		}
	
	}
	
	public function password_complex($password)
	{
		if( strlen($password) < 8 ) {
			$error .= "Password too short! <br/>";
		}
		
		if( !preg_match("#[0-9]+#", $password) ) {
			$error .= "Password must include at least one Number! <br/>";
		}
		
		
		if( !preg_match("#[a-z]+#", $password) ) {
			$error .= "Password must include at least one letter! <br/>";
		}
		
		
		if( !preg_match("#[A-Z]+#", $password) ) {
			$error .= "Password must include at least one CAPS! <br/>";
		}
		
		if( !preg_match("#\W+#", $password) ) {
			$error .= "Password must include at least one symbol! <br/>";
		}
		
		return $error;
	}
	public static function logout()
	{

		unset($_SESSION['current_backend_user_id']);
		unset($_SESSION['timeout']);
		unset($_SESSION['IP_address']);
		
		session_unset();     // unset $_SESSION variable for the run-time 
    	session_destroy();   // destroy session data in storage
		
		echo"<script>location.href='login.php'</script>";
	
	}
}
?>