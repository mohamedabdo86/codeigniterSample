<?php
require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '226735490858109',
  'secret' => '0df378138d08f38ecca4118f2558c996',
));

// Get User ID
$user = $facebook->getUser();


if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
    
    if ($user)
	{
      try {

        $user_profile = $facebook->api('/me','GET');

      } catch(FacebookApiException $e) {

        $login_url = $facebook->getLoginUrl(); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      // No user, print a link for the user to login
	  $params = array(
	  'scope' => 'read_stream,email , friends_likes,user_birthday , user_location, user_work_history, user_hometown,',
	);
	
	$loginUrl = $facebook->getLoginUrl($params);
	  
	  echo '<a class="fb_reg_button" href="'.$loginUrl.'"><img src="'.base_url().'images/mycorner/fb_reg_button.png" /></a>';

    }
	
if ($user)
{
	//print_r($user_profile);
	
				$member_fb_id = $user_profile['id'];
							echo '<script type=\'text/javascript\'>';  
echo 'alert("'.$member_fb_id.'");';  
echo '</script>';  
}

?>
        
