<?php
require_once("../modules/database.php");
require_once("../modules/globals_settings.php");
require_once("twitter_auth/twitteroauth.php");
require_once("twitter_auth/twitteroauth.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>


<body>

    <?php
	function twitter()
	{
		global $twitter_search_value;
		//Twitter Auth
		
		$consumerKey = 'U53h1gmDpbeqGrtPTxmw';
		$consumerSecret = 'SEWD6jKcotRNLyxkDjKplNwrowopr8ZalMbDZMDnM';
		$oAuthToken = '270530366-Ms6BuSywQ4mRfJMXqjrVtQNB884Uh9TK5237hhce';
		$oAuthSecret = 'FZpBwt9eo6erUcoFfkEe7cRMjmovJGKtCrRkLSfqVIw';
		$tmhOAuth = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
		$code = $tmhOAuth->get("https://api.twitter.com/1.1/search/tweets.json?count=200&result_type=recent&q=".$twitter_search_value);
		//$code = $tmhOAuth->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=A__MAkki");
		$code_encoded =  json_encode($code);
		return json_decode($code_encoded,JSON_FORCE_OBJECT);
	}
	$display_tweets = twitter();

	
	
foreach($display_tweets['statuses'] as $tweet)
{
	$number_of_tweets_found = $db->numRows("select * from tweet where tweet_tweetid = '".$tweet['id']."' ");
	
	if($number_of_tweets_found != 0 ) continue;
	
	
	$tobesaved['tweet_tweetid'] = $tweet['id'];
	$tobesaved['tweet_text'] = $tweet['text'];
	$tobesaved['tweet_account'] = $tweet['user']['name'];
	$tobesaved['tweet_account_image'] = $tweet['user']['profile_image_url'];
	$tobesaved['tweet_date'] = date('Y-m-d H:i' , strtotime($tweet['created_at']));
	
	$db->insert("tweet" , $tobesaved );
	
	
	/*echo $tweet['id'];
	echo $tweet['text'];
	echo "<br />";
	echo date('Y-m-d H:i' , strtotime($tweet['created_at']));
	echo $tweet['user']['profile_image_url'];
	echo "<br />";echo "<br />";echo "<br />";*/
}

	?>
</body>
</html>