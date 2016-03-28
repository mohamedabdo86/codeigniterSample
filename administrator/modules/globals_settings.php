 <?php
@session_start();
include("files_handler.php");


 
$global_options_array_beforefunction = $db->querySelect("select * from options order by options_ID");
$global_options_array = get_options_attr($global_options_array_beforefunction);

//Global_settings
$landing_page = "homepage.php";
$website_name = $global_options_array['website_name'];
$twitter_search_value = $global_options_array['twitter_search_value'];



$list_per_page = 10;

//Directory in which calenders image are uploaded()
$images_dir = array();

$images_dir['news'] = "uploads/news";
$images_dir['slideshows'] = "uploads/slideshows";
$images_dir['articles'] = "uploads/articles";
$images_dir['recipes'] = "uploads/recipes";
$images_dir['users_recipes'] = "uploads/users_recipes";
$images_dir['ads'] = "uploads/ads";
$images_dir['sections'] = "uploads/sections";
$images_dir['applications'] = "uploads/applications";
$images_dir['static'] = "uploads/static";
$images_dir['products_brand'] = "uploads/products_brand";
$images_dir['products'] = "uploads/products";
$images_dir['quizes'] = "uploads/quizes";
$images_dir['easy'] = "uploads/easy";
$images_dir['fashion'] = "uploads/fashion";
$images_dir['awards'] = "uploads/awards";
$images_dir['icons'] = "uploads/icons";
$images_dir['tips'] = "uploads/tips";
$images_dir['cooking_classes'] = "uploads/cooking_classes";
$images_dir['promotions'] = "uploads/promotions";
$images_dir['contact_us'] = "uploads/contact_us";

$error_page = "index.php";


$local_path = $global_options_array['website_default_path'];
//get current Path 
if($_SERVER['HTTP_HOST'] == "localhost")
{
	$path = $global_options_array['website_default_path'];
}
else
{
	$path =$global_options_array['website_current_path'];
}






//Product Image Width
$image_width=280;
$image_height=1210;


//Product Image Width
$thumb_image_width=144;
$thumb_image_height=1106;


$aspect_ratio_w=4;
$aspect_ratio_h=3;

//Admin Listing Count Per Page
$list_per_page=20;

// Images per page:
$images_per_page_no = 24;

$empty_string_default = "N/A";


function get_dir_of_image($id)
{
	
}


function display_string($text,$empty=false)
{
	global $empty_string_default;
	
	$current_empty_text = $empty_string_default;
	
	if($empty == true) $current_empty_text = "";
	return $text=="" ? $current_empty_text : $text;
}

//Get the full path of the current page .. Added by: Mahmoud

function strleft($s1, $s2) {
	return substr($s1, 0, strpos($s1, $s2));
}

function selfURL(){
    if(!isset($_SERVER['REQUEST_URI'])){
        $serverrequri = $_SERVER['PHP_SELF'];
    }else{
        $serverrequri =    $_SERVER['REQUEST_URI'];
    }
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
    return $protocol."://".$_SERVER['SERVER_NAME'].$port.$serverrequri;

}

function selfURLp(){
    if(!isset($_SERVER['REQUEST_URI'])){
        $serverrequri = $_SERVER['PHP_SELF'];
    }else{
        $serverrequri =    $_SERVER['REQUEST_URI'];
    }
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
    if($_REQUEST['page'] != "" || $_REQUEST['filter'] != "" || $_REQUEST['type'] != "" || $_REQUEST['area'] != "" || $_REQUEST['env'] != "" || $_REQUEST['flook'] != "" || $_REQUEST['system'] != "" ){
    $full_link = $protocol."://".$_SERVER['SERVER_NAME'].$port.$serverrequri."&";
    $link = str_replace("page=", "str=", $full_link);
    return $link;
    }
    else{
	return "?";	
	}  
}

//==============================================================================================
function youtube($url){

//$vid = explode("v=", $url);
//$rtv = explode(" ", $vid[1]);
parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
return "https://img.youtube.com/vi/".$my_array_of_vars['v']."/default.jpg";
}

function alert($msg)
{
	echo "<script>alert('$msg');</script>";
}

function fix_date($date)
{
	$array_of_date = explode("-",$date);
	
	return $array_of_date[2]."-".$array_of_date[1]."-".$array_of_date[0];
}


function display_custom_date($date,$type="full")
{
	$seperate_symbol = "-";
	$new_date = '';
	if($type == "short")
	{
		$date = explode("-",$date);
		$new_date = $date[2].$seperate_symbol.$date[1].$seperate_symbol.$date[0];		
	}
	if($type == "full")
	{
		$new_date = date('l, F d Y', $date);
		
	}
	
	return $new_date;
}
function get_image_picture($id)
{
	   global $db;
	   
	   //Get Image Attr
	   $get_image = $db->querySelectSingle("select * from images where images_ID=$id");
	   $get_image['images_thumb'] = "thumb_".$get_image['images_src'];
	   
	   return $get_image;
	   
}

function get_image($id)
{
	   global $db;
	   
	   //Get Image Attr
	   $get_image = $db->querySelectSingle("select * from images where images_ID=$id");
	   $get_image['images_src'] = $get_image['images_src'];
	   $get_image['images_thumb'] = "thumb_".$get_image['images_src'];
	   
	   return $get_image;
	   
}
//create new options function handlere
function get_options_attr($array_of_options)
{
	$new_array = array();
	
	for($i=0;$i<sizeof($array_of_options);$i++):	
	$new_array[$array_of_options[$i]['options_key']]  = $array_of_options[$i]['options_value'];
	endfor;
	
	return $new_array;
	
	
}

function generatePassword ($length = 9,$numonly = false)
  {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "12346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
	
	if($numonly) $possible = "0123456789";

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

function round_to_sf($number, $sf) { 
	if($number == 0) return 0;
	// How many decimal places do we round and format to? 
	// @note May be negative. 
	$dp = floor($sf - log10(abs($number)));
	
	// Round as a regular number. 
	$numberFinal = round($number, $dp); 
	
	//If the original number it's halp up rounded, don't need the last 0 
	$arrDecimais=explode('.',$numberFinal); 
	if(strlen($number) > strlen($numberFinal) && $dp > strlen($arrDecimais[1])) { 
		$valorFinal=sprintf("%.".($dp-1)."f", $number); 
	} 
	else { 
	   //Leave the formatting to format_number(), but always format 0 to 0dp. 
		$valorFinal=str_replace(',', '', number_format($numberFinal, 0 == $numberFinal ? 0 : $dp)); 
	} 
	
	// Verify if needs to be represented in scientific notation 
	$arrDecimaisOriginal=explode('.',$number); 
	if(sizeof($arrDecimaisOriginal)>=2) { 
	  return (strlen($arrDecimaisOriginal[0])>$sf)? 
													sprintf("%.".($sf-1)."E", $valorFinal) : 
													$valorFinal; 
	} 
	else { 
	  return sprintf("%.".($sf-1)."E", $valorFinal); 
	} 
}
?>
