<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Common
{
	public function limit_text($title,$number)
	{
		$short_title = mb_substr(strip_tags($title), 0, $number,'UTF-8'). (strlen(strip_tags($title)) > $number?'...':'');
		return $short_title;
	}
	public function youtube($url)
    {
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		return $my_array_of_vars['v'];
    }
	
	public function is_arabic($string)
    {
		return preg_match('/\p{Arabic}/u', $string);
    }
	
	public function youtube_views($url)
    {
		$api_key = "AIzaSyCU5erclT9Hd3sWhhrJUoR4ViXqK9x5Kkg";
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		$video_ID = $my_array_of_vars['v'];	
		
		/*$jsonURL = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id={$video_ID}&key={$api}&part=statistics");
		$json = json_decode($jsonURL);
		$views = $json->{'items'}[0]->{'statistics'}->{'viewCount'};
		return $views;*/
			
		$url_content = "https://www.googleapis.com/youtube/v3/videos?id={$video_ID}&key={$api_key}&part=statistics";
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url_content);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$contents = curl_exec($ch);
		if (curl_errno($ch)) 
		{
		  echo curl_error($ch);
		  echo "\n<br />";
		  $contents = '';
		} 
		else 
		{
		  curl_close($ch);
		}
		
		if (!is_string($contents) || !strlen($contents)) {
		echo "Failed to get contents.";
		$contents = '';
		}

		$JSON_Data = json_decode($contents);
		return $JSON_Data->{'items'}[0]->{'statistics'}->{'viewCount'};
    }
	public function arabic_numbers($number)
	{
		$pn = "";
		for ( $i=0; $i < strlen($number); $i++) {
			switch(substr($number, $i, 1)) {
				case "0":
					$pn = $pn . "٠";
					break;
				case "1":
					$pn = $pn . "١";
					break;
				case "2":
					$pn = $pn . "٢";
					break;
				case "3":
					$pn = $pn . "٣";
					break;
				case "4":
					$pn = $pn . "٤";
					break;
				case "5":
					$pn = $pn . "٥";
					break;
				case "6":
					$pn = $pn . "٦";
					break;
				case "7":
					$pn = $pn . "٧";
					break;
				case "8":
					$pn = $pn . "٨";
					break;
				case "9":
					$pn = $pn . "٩";
					break;                        
				case ",":
					$pn = $pn . "٫";
					break;                                    
				case ".":
					$pn = $pn . "/";
					break; 
				case ":":
					$pn = $pn . ":";
					break;                                
			}
		}
		return $pn;
	}
	
	public function handle_search_query($q){
		
		$q_to_array = $this->str_split_php4_utf8($q);
	  	$end_of_q = end($q_to_array);
		reset($q_to_array);
		$first_of_q = current($q_to_array);	
		
	    if($end_of_q == "ى" || $end_of_q == "ي"){
			array_pop($q_to_array);
			$q = implode("", $q_to_array);
		}
		
		if($first_of_q == "ا" || $first_of_q == "أ" || $first_of_q == "إ"){
			array_shift($q_to_array);
			$q = implode("", $q_to_array);
		}
		
		return $q;
	}
	
	public function str_split_php4_utf8($str) { 
    // place each character of the string into and array 
    $split=1; 
    $array = array(); 
    for ( $i=0; $i < strlen( $str ); ){ 
        $value = ord($str[$i]); 
        if($value > 127){ 
            if($value >= 192 && $value <= 223) 
                $split=2; 
            elseif($value >= 224 && $value <= 239) 
                $split=3; 
            elseif($value >= 240 && $value <= 247) 
                $split=4; 
        }else{ 
            $split=1; 
        } 
            $key = NULL; 
        for ( $j = 0; $j < $split; $j++, $i++ ) { 
            $key .= $str[$i]; 
        } 
        array_push( $array, $key ); 
    } 
    return $array; 
} 
	
}


/* End of file Comments.php */