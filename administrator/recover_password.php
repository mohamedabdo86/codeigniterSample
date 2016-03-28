<?php
require_once("modules/database.php");
require_once("modules/administrator.php");
require_once("modules/globals_settings.php");	

$id = $_GET['id'];
$hash = $_GET['hash'];
	
?>

<!doctype html>
<html lang="en"><head>
	<meta charset="utf-8"/>
	<title>Login Page | <?php echo $website_name; ?> | Control Panel</title>
	
	<link rel="stylesheet" href="css/login.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery-1.9.0.min.js" type="text/javascript"></script>
    
    <script type="text/javascript">
	$(document).ready(function(e) {
        
		$("#recover_password_form").submit(function(e)
		{
			$("#lstatus_error").hide();
			$("#password_match_error").hide();
			var boolean = true;
			if($("#password").val() == "" )
			{
				$("#lstatus_error").fadeIn("fast");
				boolean = false;	
			}
			if($("#repeat_password").val() == "" )
			{
				$("#lstatus_error").fadeIn("fast");
				boolean = false;	
			}
			
			if($("#password").val() != $("#repeat_password").val() && $("#repeat_password").val() != "" &&  $("#password").val() != "" )
			{
				$("#password_match_error").fadeIn("fast");
				boolean = false;	
			}
			
			return boolean;
        });
		
    });
    </script>
    
	 
</head>


<body>

<div id="login_container" style="min-height: inherit;">

	<h1>Password Recovery</h1>
    <p style="display:block;" id="status_message">
    
      <?php echo $status_message; ?>
    </p>
   
    <form  id="recover_password_form"  name="recovery_form" method="post" action="actions/recover_action.php">  
        <label> 
        <p>Password</p>
        <input type="password" placeholder="Password" name="password"  id="password" />
         </label>
         
         <label> 
         <p>Repeat Password</p>
        <input type="password" placeholder="Repeat Password" name="repeat_password" id="repeat_password" />
         </label>
          <p id="lstatus_error">All Fields are required</p>
          <p id="password_match_error">Password not match</p>
          
          <div class="clear"></div>
          <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
          <input type="hidden" id="hash" name="hash" value="<?php echo $hash; ?>" />
          
         <input type="reset" value="Reset" />
         <input type="submit" name="recovery_submit" value="Submit" />
         
         <div class="clear"></div>
    </form>
    


</div><!-- End of login ccntainer -->
</body>
</html>
