<?php
if(!$this->members->members_id)
{
	redirect(site_url('mobile/best_me/applications/9/homepage'), 'refresh');
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

<div class="row nestle-fit-data">

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<?php
        $members_image = base_url() . "uploads/members/" . $this->members->members_image;
		echo '<div id="nestlefit_member_img_container" style="padding-top: 16px;">'.nestlefit_member_image($members_image,115,115).'</div>';
	?>
</div>
 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
       <h3 class="nestlefit_inner_title"><?php echo lang('my_data'); ?></h3>
   </div>
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
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xs-pull-4 col-sm-pull-4 col-md-pull-5 col-lg-pull-4" style="margin-top:20px;"> 
 
  <?php
      $CI = & get_instance();
      $CI->load->library('widgets');
     $CI->widgets->nestle_fit_picker($start_date, $current_url);
         ?>
      <span style="color:white;"> <?php echo lang('dayInDate'); ?> <?php echo $new_date;?> </span>
   </div> 
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4 form-position">
    <?php
       $attributes = array('class' => 'form-horizontal dir', 'id' => 'add_new_weight' , 'role'=>'form', 'data-ajax'=>'false');
      echo form_open('mobile/best_me/add_new_weight', $attributes);
						?>
    <div class="form-group">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <?php
	    $user_name = array(
         'name' => 'user_name',
         'id' => 'user_name',
         'value' => $user_name,
         'class' => 'nestle_fit_data_input',
         'readonly' => true,
            );
        echo form_input($user_name);
	  ?>
         
      </div>
    </div>
    
     <div class="form-group">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <?php
	   $birthday = array(
         'name' => 'birthday',
         'id' => 'birthday',
         'value' => $birthday,
         'class' => 'nestle_fit_data_input',
         'readonly' => true,
             );
       echo form_input($birthday);
	  ?>
         
      </div>
    </div>
     <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"> <p><?php echo lang("fit_reg_height")." : ".$height;?></p></div>
     <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"><p><?php echo lang("fit_last_weight")." : ".$original_weight;?></p></div>
     
     <div class="form-group">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <?php
	  $current_weight = array(
       'name' => 'your_current_weight',
       'id' => 'current_weight',
       'class' => 'nestle_fit_data_input',
       'value' => $current_weight,
       'readonly' => true,
           );
       echo form_input($current_weight);
	  ?>
         
      </div>
    </div>
  <div class="col-xs-7 col-sm-7">  <p><?php echo lang("fit_start_date")." : ".$start_date;?></p></div>
  <div class="col-xs-5 col-sm-5">  <p><?php echo lang("remainder")." : ".$remaining;?></p></div>
   <?php
   echo form_hidden('nestle_fit_health_member_id', $current_member_health_id);
                        echo form_hidden('url', $current_url);
                        
                       
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
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                             <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <a href="javascript:void(0);" id="update_info" class="update_info button_style"><?php echo lang("fit_update"); ?> </a>
                             </div>   
                              <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">  
                                <a href="<?php echo site_url(). $language_prefix . "/"; ?>mobile/best_me/applications/9/new_register" id="start_fit" class="start_fit button_style" rel="external"><?php echo lang("fit_start_again"); ?> </a>
                               </div> 
                              
                         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
                                <?php
                                $new_weight_submit = array(
                                    'name' => 'goal_weight',
                                    'id' => 'confirm_update_info',
                                    //'value' => 'حفظ',
                                    'style' => 'display:none;',
                                    'class' => 'confirm_update_info'
                                );
                                echo form_submit($new_weight_submit,lang('fit_save_mt_data')) . "<br/>";
                                ?>
                                </div>
                            </div>
                        <?php } ?>
   </form>
   </div>

<?php endfor; ?>
</div><!--end row -->

   <script>
         $(document).ready(function(){
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
    
  <style>

  
  p{
	  color:white;
	   margin: 0;
  padding: 0 !important;
	 }
	 
.start_fit:hover {
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff) );
	background: -moz-linear-gradient( center top, #378de5 5%, #79bbff 100% );
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff');
	background-color: #378de5;
}
.start_fit {
	-moz-box-shadow: inset 0px -1px 0px -3px #bbdaf7;
	-webkit-box-shadow: inset 0px -1px 0px -3px #bbdaf7;
	box-shadow: inset 0px -1px 0px -3px #bbdaf7;
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5) );
	background: -moz-linear-gradient( center top, #79bbff 5%, #378de5 100% );
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5');
	background-color: #79bbff;
}
.update_info:hover {

}
#confirm_update_info:hover {
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #e86835), color-stop(1, #f6b33d) );
	background: -moz-linear-gradient( center top, #e86835 5%, #f6b33d 100% );
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e86835', endColorstr='#f6b33d');
	background-color: #e86835;
}
.update_info {
	-moz-box-shadow: inset 0px -1px 0px -3px #e97042;
	-webkit-box-shadow: inset 0px -1px 0px -3px #e97042;
	box-shadow: inset 0px -1px 0px -3px #e97042;
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #e97042), color-stop(1, #e97042) );
	background: -moz-linear-gradient( center top, #e97042 5%, #e97042 100% );
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e97042', endColorstr='#e97042');
	background-color: #e97042;
}
#confirm_update_info {
	-moz-box-shadow: inset 0px -1px 0px -3px #e97042;
	-webkit-box-shadow: inset 0px -1px 0px -3px #e97042;
	box-shadow: inset 0px -1px 0px -3px #e97042;
	background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #e97042), color-stop(1, #e97042) );
	background: -moz-linear-gradient( center top, #e97042 5%, #e97042 100% );
 filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e97042', endColorstr='#e97042');
	background-color: #e97042;
}
.nestle_fit_data_input{
color: #e7612d !important;
text-align:right !important;
text-indent: 9px !important;
}	
.english .nestle_fit_data_input
{
text-align:left !important;
text-indent: 9px !important;	
} 
.button_style{
  padding: 10px 9px !important;
  text-align: center !important;
  margin-top: 7px !important;
}
  </style>  