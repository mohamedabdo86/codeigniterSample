 
<?php


	$display_data_image = $_POST['display_data_image'];
	
	
	
	$array_of_questions_id = $_POST['answer_hidden_question'];
	$array_of_answers = $_POST['answer_question'];
	$current_id = $_POST['current_id'];
	
	
$result_array = '';
$result_array .= '<div class="row"><div class="col-md-3 col-sm-6 col-xs-12 float_left">';
$result_array .= '<img class="img-responsive" src="'. base_url()."uploads/quizes/".$display_data_image .'"/>';
$result_array .= '</div>';
$result_array .= '<div class="col-md-9 col-sm-6 col-xs-12 float_left">';
$result_array .= '<h1 class="'.$current_section_color .'" style="font-size:22px;">'.$answer_data[0]['quizes_result_header'.$current_language_db_prefix].'</h1>';
$result_array .= '<p style="white-space:normal; font-size:16px;">';
$result_array .= strip_tags($answer_data[0]['quizes_result_title'.$current_language_db_prefix]);
$result_array .= '</p></div></div>';
$result_array .= '<div class="row"><div class="col-md-4 col-sm-4 col-xs-1"></div><div class="col-md-4 col-sm-4 col-xs-10">';
$result_array .= '<a href="javascript:history.go(0);" class="'.$current_section_color .' float_left" style="font-size: 17px;font-weight: bold;padding: 6px 12px;">'. lang('besttime_Perform_the_test_again') .'</a>';
$result_array .= '<div class="addthis_toolbox addthis_default_style addthis_16x16_style"  addthis:url="'.site_url($this->router->class."/quiz_inner/".$current_id).'">';
$result_array .= '<a class="addthis_button_compact submit_button float_left"><h5 style="text-align:center;padding:5px;">'.lang('globals_sharing').'</h5></a></div>';
$result_array .= '<script type="text/javascript">
			var addthis_config = {"data_track_addressbar":false};
			</script>
			<script type="text/javascript">
			var addthis_config =
			{
				services_expanded: "facebook,twitter,google_plusone_share,pinterest_share,yahoomail,blogger,delicious"
			}
			</script>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51b73a845b0a772d"></script>';

$result_array .= '</div></div>';



			 


$array_of_result['result'] = $result_array;

echo json_encode($array_of_result);


?> 