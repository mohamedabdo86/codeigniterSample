<?php
require_once("modules/database.php");
require_once("modules/administrator.php");
require_once("modules/resize-class.php");
require_once("modules/globals_settings.php");
require_once("modules/notifications_messages.php");
require_once("modules/display_data.php");
require_once("modules/pages_attr_generation.php");
require_once("modules/posts_auto_generation.php");
require_once("modules/pagination.php");
require_once ('scripts/editor/fckeditor.php');	
require_once("modules/session.php");

//Set Time Zone To Cairo
date_default_timezone_set("Egypt");

if($auto_generated_post)
{
	$posts_handle = new dynamic_posts_pages($page_id);
	$page_title = $posts_handle->page_title;
	$single_term = $posts_handle->single_term;
	$plural_term = $posts_handle->plural_term;
	$this_page_name = $posts_handle->this_page_name;
	$this_table_name = $posts_handle->this_table_name;
	$this_page_name_with_varibles = $posts_handle->this_page_name_with_varibles;
}

$current_user_id = $_SESSION['current_backend_user_id']; 
$current_admin_details = new Administrator($current_user_id);
//Get Current Actions
$current_array_of_actions = $current_admin_details->get_allowed_actions();


header('Content-Type: text/html; charset=utf-8');

?>
<!doctype html>
<html lang="en"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title><?php echo $page_title; ?> | <?php echo $website_name; ?> | Control Panel</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/display_table_effects.css" type="text/css">
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery-1.9.0.min.js" type="text/javascript"></script>
    <script src="js/jquery.maxlength.min.js" type="text/javascript"></script>
    
	<script src="js/hideshow.js" type="text/javascript"></script>
	<!--<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>-->
    <link rel="stylesheet" href="css/demo_table.css" type="text/css" media="screen" />
    <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery.equalHeight.js"></script>
    
    <link rel="stylesheet" type="text/css" href="css/jquery.gritter.css" />
    <script type="text/javascript" src="js/jquery.gritter.js"></script>
    
    <script src="js/jquery.Jcrop.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
    
    <link rel="stylesheet" href="css/smartpaginator.css" type="text/css" />
    <script src="js/smartpaginator.js" type="text/javascript"></script>
    
	<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<!--<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>-->
	<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    
    
    <link rel="stylesheet" href="css/date_picker/base/jquery.ui.all.css">
    <link rel="stylesheet" href="css/date_picker/ui-lightness/jquery.ui.autocomplete.css">
    <link rel="stylesheet" href="css/dragstyles.css" type="text/css">
	 
	<script src="js/ui/jquery.ui.core.min.js"></script>
	<script src="js/ui/jquery.ui.widget.min.js"></script>
	<script src="js/ui/jquery.ui.position.min.js"></script>
	<script src="js/ui/jquery.ui.menu.min.js"></script>
    <script src="js/ui/jquery.ui.mouse.min.js"></script>
    <script src="js/ui/jquery.ui.sortable.min.js"></script>
	<script src="js/ui/jquery.ui.autocomplete.min.js"></script>
    <script type="text/javascript" src="js/ui/jquery.ui.datepicker.min.js"></script>
    <script src="js/ui/jquery.ui.draggable.min.js"></script>
	<script src="js/ui/jquery.ui.droppable.min.js"></script>
    <script type="text/javascript" src="js/dragdrop.js"></script>
    <script type="text/javascript" src="js/manage_attr.js"></script>
    <script type="text/javascript" src="js/manage_header.js"></script>
 
 
 	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="js/fancyboxv2/jquery.fancybox.js?v=2.1.4"></script>
	<link rel="stylesheet" type="text/css" href="js/fancyboxv2/jquery.fancybox.css?v=2.1.4" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="js/fancyboxv2/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="js/fancyboxv2/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="js/fancyboxv2/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="js/fancyboxv2/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="js/fancyboxv2/helpers/jquery.fancybox-media.js?v=1.0.5"></script>

   
     <link rel="stylesheet" type="text/css" href="css/jquery.fcbkcomplete.css" />
     <script type="text/javascript" src="js/jquery.fcbkcomplete.js"></script>


	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
			
	
	  $( ".datepicker" ).datepicker({changeMonth: true,
		changeYear: true,dateFormat:"yy-mm-dd"});
   	 } 
	);
	$(document).ready(function() {
	
	
	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>
<script type="text/javascript">
		$(document).ready(function() {
			
			 

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : false,
				padding:0,

				openEffect : 'elastic',
				openSpeed  : 250,

				closeEffect : 'elastic',
				closeSpeed  : 250,

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

		

		});
	</script>
<script>
$(document).ready(function(e) {
    
	//Manage Read Only
	var readonly_flag = <?php echo isset($_GET['readonly']) ? "true" : "false";  ?>;
	
	if(readonly_flag)
	{
		//Disable all form attr.
		$("form[name=handle_from] :input").attr("disabled", true);
		$("form[name=handle_from] .submit_link").hide();
		$("form[name=handle_from] .error-inner").hide();
	}
});
</script>
<script>
function update_select_options(main_select_attr,forign_select_attr,current_value,this_table_forignkey,this_table_name,table_column_id,table_column_title)
{
	//update select options
		
		//Put Forign to loading
		$(forign_select_attr).html('<option value="">Loading...</option>');
		
		//Load new city data
			$.ajax({
				  url: "ajax/update_select_options.php",
				  type: "POST",
				  data: {current_value : current_value,this_table_name:this_table_name,table_column_id:table_column_id,table_column_title:table_column_title,this_table_forignkey : this_table_forignkey },
				  cache: false,
				  dataType: "json",
				  success: function(success_array)
				  {			
				  
						$(forign_select_attr).html(success_array.data);
					
				  },
				  error: function(xhr, ajaxOptions, thrownError)
				  {
					
			 
					
					
				  }
				  
		});
}
</script>

</head>
<?php /*?><h4><?php echo $_SESSION['current_backend_user_id']; ?></h4>
<h4><?php echo date("Y-m-d H:i:s",$_SESSION['timeout']); ?></h4>
<h4><?php echo date("Y-m-d H:i:s",$_SESSION['timeout'] + 60 * 60) ; ?></h4>
<h4><?php echo date("Y-m-d H:i:s") ; ?></h4><?php */?>
<?php
	/*echo "current_backend_user_id = ". $_SESSION['current_backend_user_id'];
	echo '<br>';
	echo "timeout = ". $_SESSION['timeout'] ;
	echo '<br>';
	echo "IP_address = ". $_SESSION['IP_address'] ;*/

?>


<body>
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.php">Control Panel</a></h1>
			<h2 class="section_title"><?php echo $website_name; ?></h2><?php /*?><div class="btn_view_site"><a href="http://www.medialoot.com">View Site</a></div><?php */?>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo $current_admin_details ->get_full_name() ?> (<a href="?logout">Log Out</a>)</p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs">
            <a href="index.php">Homepage</a>
            <?php
			if($parent_page_name != "" ):
			
			$href_page_name = 'href="'.$parent_page_name.'"';
			
			?>
            <div class="breadcrumb_divider"></div> 
            <a <?php echo $href_page_name; ?> class="<?php echo $current_class ; ?>"><?php echo $parent_page_title; ?></a>
            <?php
			endif;
			?>
            
            <?php
			if($page_title != "home" ):
			$current_class = "";
			$href_page_name = 'href="'.$this_page_name_with_varibles.'"';
			if(!isset($filter)) { $current_class = "current";$href_page_name =''; }
			?>
            <div class="breadcrumb_divider"></div> 
            <a <?php echo $href_page_name; ?> class="<?php echo $current_class ; ?>"><?php echo $page_title; ?></a>
            <?php
			endif;
			?>
            <?php
			if($filter != "" ):
			$filter_type_title = $form_submit." ".$single_term;
			$current_class = "current";
			$href_page_name =''; 
			?>
            <div class="breadcrumb_divider"></div> 
            <a <?php echo $href_page_name; ?> class="<?php echo $current_class ; ?>"><?php echo $filter_type_title; ?></a>
            <?php
			endif;
			?>
            </article>	
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
    <?php
	$search_handler_toggle = "";
	$search_handler_placeholder = "Search {$plural_term}";
	if($search_headers_attr == "" ):
	$search_handler_toggle = " disabled";
	$search_handler_placeholder = "Search not available at this page.";
	endif;
	?>
		<form action="<?php echo $this_page_name ?>" name="search" class="quick_search">
			<input id="test1"  name="search_query" type="text" value="<?php echo $_GET['search_query']; ?>" placeholder="<?php echo $search_handler_placeholder ; ?>" <?php echo $search_handler_toggle; ?> >
		</form>
		<hr/>
		<h3>Slideshows</h3>
        <ul class="toggle">
             
             <?php 
			 if(in_array("can_view", $current_array_of_actions))
			 {			
             echo '<li class="icn_profile"><a href="slideshows.php">Manage Main Homepage Slideshows</a></li>';
			 echo '<li class="icn_profile"><a href="section_slideshows.php">Section\'s Homepage Slideshows</a></li>';
			 echo '<li class="icn_profile"><a href="gallery_images.php?&forignkey=2">Manage Why join Slideshows</a></li>';
			 echo '<li class="icn_profile"><a href="images_order.php?&forignkey=2">Manage Why join Images Order</a></li>';
			 }

			?>      
		</ul>
        <h3>Categories</h3>
        <ul class="toggle">
		<?php 
			 if(in_array("can_view", $current_array_of_actions))			
             echo '<li class="icn_profile"><a href="section.php">Section</a></li>';
			 
			?>      
		</ul>
        <h3>Content</h3>
        <ul class="toggle">
		<?php 
			 if(in_array("can_view", $current_array_of_actions))
			 {	
             //echo '<li class="icn_profile"><a href="section_tips.php">Manage Section\'s Homepage Tips</a></li>';
			 echo '<li class="icn_profile"><a href="articles.php">Articles</a></li>';			 
			 echo '<li class="icn_profile"><a href="ask_expert.php">Ask an Expert</a></li>';
			 echo '<li class="icn_profile"><a href="manage_applications.php">Manage Applicationss</a></li>';
			 echo '<li class="icn_profile"><a href="comments.php">Comments</a></li>';
			 echo '<li class="icn_profile"><a href="experts.php">Experts</a></li>';
			 }
			?>      
		</ul>
        
        <h3>Best Cook Section Content</h3>
        <ul class="toggle">
		<?php 
			 if(in_array("can_view", $current_array_of_actions))
			 {
			 echo '<li class="icn_profile"><a href="recipes.php">Recipes</a></li>';		
             echo '<li class="icn_profile"><a href="recipes_product.php">Recipes Product</a></li>';
			 echo '<li class="icn_profile"><a href="topics_recipes.php">Topics Recipes</a></li>';
			 echo '<li class="icn_profile"><a href="inseason_recipes.php">Inseason Recipes</a></li>';
			 echo '<li class="icn_profile"><a href="members_videos.php">Members Videos</a></li>';
			 echo '<li class="icn_profile"><a href="cuisines.php">Cuisines</a></li>';
			 echo '<li class="icn_profile"><a href="dish.php">Dishes</a></li>';
			 echo '<li class="icn_profile"><a href="selection.php">Selection</a></li>';
			 echo '<li class="icn_profile"><a href="members_recipes.php">Member Recipes</a></li>';
			 }
			?>      
		</ul>
        
        <h3>Cooking Class Content</h3>
        <ul class="toggle">
        <?php 
		if(in_array("can_view", $current_array_of_actions))
		{
		echo '<li class="icn_profile"><a href="manage_cooking_classes.php">Manage Cooking Classes</a></li>';
		echo '<li class="icn_profile"><a href="manage_class_cooking_gallery.php">Manage Cooking Classes Gallery</a></li>';
		echo '<li class="icn_profile"><a href="manage_cooking_classes_members.php">Manage Cooking Classes Members</a></li>';
		}
		?>
        </ul>
                
        <h3>Nestle Fit</h3>
        <ul class="toggle">
        <?php 
			 if(in_array("can_view", $current_array_of_actions))
			 {
			 //echo '<li class="icn_profile"><a href="all_points_users.php">Users\' Points</a></li>';
			 echo '<li class="icn_profile"><a href="nestle_fit_tips.php">Nestle Fit Tips</a></li>';	
			 echo '<li class="icn_profile"><a href="nestle_fit_food.php">Nestle Fit Food</a></li>';
			 echo '<li class="icn_profile"><a href="nestle_burn_rate_sport.php">Burn Rate Sport</a></li>';
			 echo '<li class="icn_profile"><a href="nestle_fit_option.php">Nestle Fit Option</a></li>';	
			 echo '<li class="icn_profile"><a href="nestle_fit_food_measure.php">Nestle Fit Food Measure</a></li>';	
			 echo '<li class="icn_profile"><a href="best_me_diet_app.php">Personal Diet Application</a></li>';		
			 }
		?>
        </ul>
        
        <h3>Best Time Section Content</h3>
        <ul class="toggle">
        <?php 
			 if(in_array("can_view", $current_array_of_actions))	
			 {
			 echo '<li class="icn_profile"><a href="manage_quizes.php">Manage Quizes</a></li>';	
			 echo '<li class="icn_profile"><a href="manage_easy_tips.php">Manage Easy Tips</a></li>';
			 echo '<li class="icn_profile"><a href="manage_fashion.php">Manage Fashion</a></li>';		
			 }
		?>
        </ul>
        
        <h3>Nestle Products Section Content</h3>
        <ul class="toggle">
        <?php 
		 if(in_array("can_view", $current_array_of_actions))	
		 {
			 //echo '<li class="icn_profile"><a href="products.php">Products</a></li>';		
			 //echo '<li class="icn_profile"><a href="products_tips.php">Products Tips</a></li>';		
			 echo '<li class="icn_profile"><a href="products_brand.php">Products Brand</a></li>';	
			 echo '<li class="icn_profile"><a href="promotions.php">Promotions</a></li>';
			// echo '<li class="icn_profile"><a href="polls.php">Polls</a></li>';		
		 }
		?>
     
         </ul> 
        <h3>Related</h3>
        <ul class="toggle">
		<?php 
			 if(in_array("can_view", $current_array_of_actions))			
             echo '<li class="icn_profile"><a href="videos.php">Videos</a></li>';
			// echo '<li class="icn_profile"><a href="ads.php">Ads</a></li>';
			// echo '<li class="icn_profile"><a href="trophies.php">Trophies</a></li>';
			 echo '<li class="icn_profile"><a href="interaction.php">Interaction</a></li>';
			 echo '<li class="icn_profile"><a href="awards.php">Awards</a></li>';
			 echo '<li class="icn_profile"><a href="awards_email.php">Awards E-mails</a></li>';
			 echo '<li class="icn_profile"><a href="newsletters.php">Newsletter</a></li>';
			 echo '<li class="icn_profile"><a href="newsletters_member.php">Newsletter Member</a></li>';
			 echo '<li class="icn_profile"><a href="newsletters_member_myBaby.php">My Baby Newsletter Member</a></li>';
			?>      
		</ul>
        
        <h3>Contact US </h3>
        <ul class="toggle">
		<?php 
			 if(in_array("can_view", $current_array_of_actions))			
             echo '<li class="icn_profile"><a href="contact_us.php">Contact US</a></li>';
			 echo '<li class="icn_profile"><a href="respond.php">Respond Way</a></li>';
			 echo '<li class="icn_profile"><a href="reason.php">Reason</a></li>';
			 echo '<li class="icn_profile"><a href="city.php">City</a></li>';
			 
			?>      
		</ul>
        
        <h3>My Corner</h3>
        <ul class="toggle">
		<?php 
			 if(in_array("can_view", $current_array_of_actions))			
             echo '<li class="icn_profile"><a href="relationship.php">Relationship</a></li>';
			 
			?>      
		</ul>
        
        <h3>Privacy Policy </h3>
        <ul class="toggle">
		<?php 
			 if(in_array("can_view", $current_array_of_actions))			
             echo '<li class="icn_profile"><a href="privacy_policy.php">Privacy Policy</a></li>';
			 echo '<li class="icn_profile"><a href="privacy_policy_question.php">Privacy Policy Question</a></li>';
			 echo '<li class="icn_profile"><a href="terms_conditions.php">Terms and conditions</a></li>';
			 echo '<li class="icn_profile"><a href="faq.php">FAQ</a></li>';
			 
			?>      
		</ul>
        
		<h3>Users</h3>
		<ul class="toggle">
		<?php 
		if(in_array("add_users", $current_array_of_actions))
		echo '<li class="icn_add_user"><a href="users.php?&filter=add">Add New User</a></li>';
		if(in_array("view_users", $current_array_of_actions))
		echo '<li class="icn_view_users"><a href="users.php">View Users</a></li>';
		?>	
		 <li class="icn_profile"><a href="account_edit.php">Your Profile</a></li>
		</ul>
		
		<h3>Admin</h3>
		<ul class="toggle">
        <?php 
		if(in_array("admin_pages_access", $current_array_of_actions)):
		?>
        	<li class="icn_settings"><a href="options.php">Options</a></li>
 
		<?php
        endif;
        ?>
			<li class="icn_jump_back"><a href="?logout">Logout</a></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; <?php echo date('Y'); ?> <?php echo $website_name; ?></strong></p>
			<p>Powered by <a target="_blank" href="http://www.mediaandmore-eg.com">Media & More</a></p>
		</footer>
	</aside><!-- end of sidebar -->
    <div id="error" >
    <?php
    if($_GET['state'] == 'error')
	{
	?>
	<script type="text/javascript">
	$(document).ready(
	function()
	{
		   <?php
   $message_array = Messages::get_notifications_message("");
   $error = Messages::get_error_message($_GET['error_code']);
   echo Messages::red_ballon($message_array['title'],$error);//$message_array['msg']
   
  ?>
		
	}
	);
	</script>

        <?
	}

	?>
    </div>
	