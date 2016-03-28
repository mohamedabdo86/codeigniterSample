<?php
if(!$this->members->members_id)
{
	redirect(site_url('best_me/applications/9/homepage'), 'refresh');
}
?>
<script>
    $(document).ready(function() {
    $(".various").fancybox({
    maxWidth	: 200,
            maxHeight	: 80,
            fitToView	: false,
            width		: '70%',
            height		: '70%',
            autoSize	: false,
            closeClick	: false,
            openEffect	: 'none',
            closeEffect	: 'none'
    });
});
</script>
<?php
if ($val_3 == 0)
{
    $url_date = date("Y-m-d");
}
else
{
    $date = date_create($val_3);
    $url_date = date_format($date, "Y-m-d");
}
// Get latest registered weight
$get_weight = $this->nestlefitmodel->get_user_current_weight($val_2, $url_date);

// Get registered weight
$get_latest_weight = $this->nestlefitmodel->get_user_weight($val_2);

// Get goal weight
$user_calculations_data = $this->nestlefitmodel->get_user_calculations_data($val_2);

?>
<?php
for ($i = 0; $i < sizeof($get_weight); $i++)
{
    $current_date1 = $get_weight[$i]['nestle_fit_health_weights_date'];
    $dt1 = new DateTime($current_date1);
    $today_date = $dt1->format('d-m-Y');
    //$url_date= $this->uri->segment(7,0);
    $new_date;
    $current_url;
    if ($val_3 == 0)
    {
        $new_date = $today_date;
        $current_url = current_url();
    }
    else
    {
        $new_date = $val_3;
        $delete = "/" . $val_3;
        $current_url = str_replace($delete, "", current_url());
    }
}
?>
<style>
#data_container{
	height:520px;
	background-image:url(<?php echo base_url() . "images/nestle_fit/data-background.jpg"; ?>);
}
#data_container .main_title
{
	width: 610px;
    margin:-10px 165px;
}
#data_container .back_container
{
	float: left;
    width: 17px;
    height: 60px;
	position: relative;
    top: -52px;
    left: 120px;
}
.app_register{
	height: auto;
	width: 585px;
}
.app_header_1{
	margin-top:45px;
	text-align: right;
	color: orange;
	font-weight: bold;
}
.app_header_2{
	text-align: right;
	color: orange;
	font-weight: bold;
}
.form_label{
	color:#CCC;
}
.form_input_larg{
	width: 300px;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
}
.form_input_small{
	width: 100px;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
}
.app_date{
	text-align:center;
	font-size: 23px;
	color: #CCC;
}

#new_weight
{
	position: absolute;
	right: 60px;
	bottom: 50px;
}

#new_weight_submit
{
	position: absolute;
	right: 318px;
	bottom: 50px;
}
.video_list_wrapper
{
	margin-top:-41px;
	width:100%;
	height:auto;
	position:relative;
}

#day-arrow{
	margin-top:0px !important;
}
.top_ten_dev_container {
	width:35%;
	margin: auto;
	margin-top:8px;
}

.arabic .top_ten_dev_container ul li {
	padding-right:8px;
}
.top_ten_dev_container ul li {
	height:26px;
	/*background:#F93;*/
	margin-bottom:1px;
	font-size:14px;
	padding: 1px;
	font-family:Tahoma, Geneva, sans-serif;
	line-height:26px;
	color:#FFFFFF;
	font-weight:bold;
	padding-left:8px;
}

</style>
<script type="text/jscript">
    jQuery(function(){

    jQuery("#video_list").jCarouselLite({
    btnNext: ".recentitem_next",
    btnPrev: ".recentitem_prev",
    visible:1,
    circular: false,

    });

    });
</script>
<div id="data_container">
    <?php
    $members_image = base_url() . "uploads/members/" . $this->members->members_image;
    echo '<div id="nestlefit_member_img_container" style="padding-top:6px">' . nestlefit_member_image($members_image, 135, 135) . '</div>';
    ?>
 	<div class="main_title">
        <h3 class="title dir" style="height: 60px;text-align: center;"><?php echo lang("my_data"); ?></h3>
		<div class="back_container">
            <a class="back" title="<?php echo lang('globals_back'); ?>" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>"><img alt="<?php echo lang('globals_back'); ?>" src="<?php echo base_url().'images/nestle_fit/back.png'; ?>" /></a>
    		<a class="back-title" href="<?php echo site_url('best_me/applications/9/best_life_welcome/'.$val_2); ?>">  <span><?php echo  lang("nestlefit_back_btn"); ?></span></a>
        </div>
    </div>
    
    
    

    <div class="top_ten_dev_container">
        <ul>
            <?php
            for ($i = 0; $i < sizeof($get_weight); $i++):
                $current_date = $get_weight[$i]['nestle_fit_health_weights_date'];
                $dt = new DateTime($current_date);
                $date = $dt->format('d/m/Y');
                $get_date = $dt->format('Y-m-d');
                $today = date('d/m/Y');
                $current_weight = $get_weight[$i]['nestle_fit_health_weights_weight'];
                $current_member_health_id = $get_weight[$i]['nestle_fit_health_weights_nestle_fit_health_ID'];



                $user_name = $get_weight[$i]['nestle_fit_health_name'];
                $birthday = $get_weight[$i]['nestle_fit_health_birthday'];
                $original_weight = $get_weight[$i]['nestle_fit_health_weight'];
                $height = $get_weight[$i]['nestle_fit_health_height'];


                // $age=date('Y')- $birthday;
                //print $birthday.">>".$age."fffffffffff";
                $start_date = $get_weight[$i]['nestle_fit_calculations_date'];
                $lost_weight = $get_weight[$i]['nestle_fit_calculations_weight_loss_rate'];

                if ($get_weight[$i]['nestle_fit_calculations_goal_weight'] == 0)
                {
                    $goal_weight = $get_weight[$i]['nestle_fit_health_weight'] - $get_weight[$i]['nestle_fit_health_height'];
                }
                else
                {
                    $goal_weight = $get_weight[$i]['nestle_fit_calculations_goal_weight'];
                }



                $remaining = $current_weight - $goal_weight;
				$remaining = $remaining < 0 ? 0 : $remaining;

                $last_update_weight = date_create($current_date);
                $new_last_update_weight = date_format($last_update_weight, "d/m/Y");
                ?>



                <li>
                    <p class="app_date">
                        <?php
                        $CI = & get_instance();
                        $CI->load->library('widgets');
                        $CI->widgets->nestle_fit_picker($start_date, $current_url);
                        ?>
                       <span style="margin-top: 6px;font-size: 20px; color: white;"> <?php echo lang("dayInDate")." ".$new_date?></span>
                    </p>
                    <div id="container">

                        <?php
                        $attributes = array('class' => '', 'id' => 'add_new_weight');
                        echo form_open('best_me/add_new_weight', $attributes);
                        $user_name = array(
                            'name' => 'user_name',
                            'id' => 'user_name',
                            'value' => $user_name,
                            'class' => 'nestle_fit_data_input',
                            'readonly' => true,
                            'style' => '	margin-bottom: 5px;'
                        );
                        echo form_input($user_name) . "<br/>";


                        $birthday = array(
                            'name' => 'birthday',
                            'id' => 'birthday',
                            'value' => $birthday,
                            'class' => 'nestle_fit_data_input',
                            'readonly' => true,
                        );
                        echo form_input($birthday) . "<br/>";
                         ?>
                         
                           <p><?php echo lang("fit_reg_height")." : ".$height;?></p>
                           <p><?php echo lang("fit_last_weight")." : ".$original_weight;?></p>
                          
                         <?php
                      
                        $current_weight = array(
                            'name' => 'your_current_weight',
                            'id' => 'current_weight',
                            'class' => 'nestle_fit_data_input',
                            'value' => $current_weight,
                            'readonly' => true,
                        );
                        echo form_input($current_weight) . "<br/>";
                         ?>
                          
                          
                           
                           <p><?php echo lang("fit_start_date")." : ".$start_date;?></p>
                           <p><?php echo lang("remainder")." : ".$remaining;?></p>
                         <?php 

                        

                        echo form_hidden('nestle_fit_health_member_id', $current_member_health_id);
                        echo form_hidden('url', $current_url);
                        ?>
                        <?php
                        $site_lang = $this->config->item('language');
                        // For English language appriopriate placement
                        if ($site_lang == "arabic")
                        {
                            $language_prefix = "ar";
                        }
                        else
                        {
                            $language_prefix = "en";
                        }
                        ?>

                        <?php if ($new_date==date("d-m-Y") or $new_date==date("Y-m-d"))
                        {
							
                            ?>
                            <div class="update">
                                <a href="javascript:void(0);" id="update_info" class="update_info button_style"><?php echo lang("fit_update"); ?> </a>
                                <a href="<?php echo site_url(). $language_prefix . "/"; ?>best_me/applications/9/new_register" id="start_fit" class="start_fit button_style"><?php echo lang("fit_start_again"); ?> </a>
                                <?php
                                $new_weight_submit = array(
                                    'name' => 'goal_weight',
                                    'id' => 'confirm_update_info',
                                    //'value' => 'حفظ',
                                    'style' => 'display:none;',
                                    'class' => 'confirm_update_info button_style'
                                );
                                echo form_submit($new_weight_submit,lang('fit_save_mt_data')) . "<br/>";
                                ?>
                            </div>
                        <?php } ?>

                    <?php echo form_close(); ?>
                    </div>
                </li>

<?php endfor; ?>
        </ul>

    </div>	        
</div>
<script>
$(document).ready(function(){
	$('.recentitem_prev').addClass('disabled');
	
	$("#update_info").click(function(){
		$("input").attr("readonly", false);
		$("#update_info").hide();
		$("#start_fit").hide();
		$("#confirm_update_info").show();
		
		$("#birthday").datepicker({
		changeMonth: false,
		changeYear: false,
		dateFormat:'yy-mm-dd',
		});
	});
});
</script>

 