<?php
require_once("modules/database.php");
require_once("modules/administrator.php");
require_once("modules/globals_settings.php");	


	  $status_error = $_GET['status'];
	  $status_message = '';
	  switch ($status_error)
	  {
		  case "error": $status_message = "<img width='15' src='images/error.png' /><span style='font-size: 15px;'>Login faild. Check the email and password and try again.</span>";break;
		  case "forgoterror": $status_message = "The entered email were not found at the system	 database";break; // has change 
		  case "recovererror": $status_message = "An error occuried when trying to recover your password, Please retry the processs. or request a new recover password";break;
		  case "recoversuccess": $status_message = "You have successfuly updated your password, Please try to login in with your new password.";break;
		  case "forgotsuccess": $status_message = "An email has been sent to your email address , please check you email to figure how to reset your password";break;
		  
	  }
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
        
		$(".show_hide").click(function(e) {
			var id = $(this).data('show'); 
			$("form").hide();
			$("#"+id+"_form").fadeIn("fast");
            
        });
    });
    </script>
    <script type="text/javascript">
	$(document).ready(function(e) {
        
		$("#login_form").submit(function(e)
		{
			$("#lstatus_error").hide();
			var boolean = true;
			if($("#password").val() == "" )
			{
				$("#lstatus_error").fadeIn("fast");
				boolean = false;	
			}
			if($("#email").val() == "" )
			{
				$("#lstatus_error").fadeIn("fast");
				boolean = false;	
				
			}
			
			return boolean;
        });
		$("#forgot_form").submit(function(e)
		{
			$("#fstatus_error").hide();
			var boolean = true;
			if($("#femail").val() == "" )
			{
				$("#fstatus_error").fadeIn("fast");
				boolean = false;	
				
			}
			
			return boolean;
        });
    });
    </script>
    
	 
</head>


<body>

<div id="login_container">

	<h1><?php echo $website_name; ?></h1>
    <p style="display:block;" id="status_message">
    
      <?php echo $status_message; ?>
    </p>
   
    <form  id="login_form"  name="login_details" method="post" action="actions/login_action.php">  
     <h2>Login Details</h2>
    <label> 
    <p>E-mail</p>
    <input type="text" placeholder="Email" name="email"  id="email" />
     </label>
     
     <label> 
     <p>Password</p>
    <input type="password" placeholder="Password" autocomplete="off" name="password" id="password" />
     </label>
      <p id="lstatus_error">All Fields are required</p>
      
      <div class="clear"></div>
      
     <input type="reset" value="Reset" />
     <input type="submit" name="submit" value="Submit" />
     
     <div class="clear"></div>
     <a data-show="forgot" class="show_hide" >Did you forgot your password?, Click here</a>
    </form>
    
    <form  id="forgot_form" style="display:none  " name="login_details" method="post" action="actions/forget_password.php">  
     <h2>Forgot Your password</h2>
    <label> 
    <p>E-mail</p>
    <input type="text" placeholder="Email" name="email" id="femail" />
     </label>
 	<p id="fstatus_error">All Fields are required</p>
     <div class="clear"></div>
     <input type="submit" value="Submit" name="forgetpassword" />
     
      <div class="clear"></div>
       <a data-show="login" class="show_hide">Back to the login form?? , click here</a>
      <div class="clear"></div>
    </form>

</div><!-- End of login ccntainer -->
</body>
</html>
