<?php
include("../modules/database.php");
include("../modules/globals_settings.php");
include("../modules/administrator.php");
include("../modules/mailer.php");

if(!function_exists("generatePassword") )
{
function generatePassword ($length = 20)
  {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "12346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);
  
    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
      $length = $maxlength;
    }
	
    // set up a counter for how many characters are in the password so far
    $i = 0; 
    
    // add random characters to $password until $length is reached
    while ($i < $length) { 

      // pick a random character from the possible ones
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);
        
      // have we already used this character in $password?
      if (!strstr($password, $char)) { 
        // no, so it's OK to add it onto the end of whatever we've already got...
        $password .= $char;
        // ... and increase the counter by one
        $i++;
      }

    }

    // done!
    return $password;

  }

	
}
if($_POST['forgetpassword']=="Submit")
{
		$email= $_POST['email'];
		$display = $db->querySelectSingle("select * from users where users_email='".$email."' ");	
		
		if(empty($display) )
		die("<script>location.href='../login.php?status=error'</script>");
		
		//Send Email
		$name = $display['users_name'];
		$password = generatePassword();
		 
		 
		$url_code = $path."administrator/recover_password.php?id=".$display['users_ID']."&hash=".$password;
		include("../scripts/recovery_password_email_form.php");
		
		
		$email_sent = sendMail($display['users_email'],$website_name, "info@mediaandmore-eg.com", $Ccs="", $Bccs="","Password Recovery", $msg);
		
		if($email_sent)
		{
			$tobesaved['users_request_forget_password'] = $password;
			$db->update("users",$tobesaved,"users_ID=".$display['users_ID']);
			die("<script>location.href='../login.php?status=forgotsuccess'</script>");
			
		}
	
}
die("<script>location.href='../login.php?status=error'</script>");
?>