<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Members {

    public $members_id;
    public $members_fullname;
    public $members_firstname;
    public $members_lastname;
    public $members_birthday;
    public $members_email;
    public $members_language;
    public $members_mobile;
    public $members_address;
    public $members_points;
    public $members_salt;
    public $members_trophies;
    public $members_no_of_articles;
    public $members_no_of_recipes;
    public $members_no_of_articles_unapproved;
    public $members_no_of_recipes_unapproved;
    public $members_no_of_overall_posts;
    public $members_no_of_overrall_posts_unapproved;
    public $date_of_birth;
    public $members_image_id;
    public $allowed_login_attempts = 4;
    public $lock_duration = 1800; //30 min

    public function __construct() {
        // Do something with $params
        $this->members_id = false;       
        date_default_timezone_set("Egypt");
    }

    public function sign_in($email, $password) {
        $CI = & get_instance();
        $CI->load->model('membersmodel');
        $CI->load->model('globalmodel');
        $CI->load->library('encryption');
        $CI->load->library('session');
        $CI->load->library('emailmanager');
		$CI->load->library('user_agent');

        $website_application_key = $CI->config->item('encryption_key');

        //First Search By email 
        $display = $CI->membersmodel->check_email_found($email);


        if (empty($display)) {
            $display = $CI->membersmodel->check_valid_username($email);
            if (empty($display)) {
                return 0;
            }
        }
		
		//Init. member var. that request to be auth.
		$member_id = $display[0]['members_ID'];

        //Second, Check if not activated
        if ($display[0]['members_activated'] != 1)
            return 2;


        //Third, Check if account is locked
        if ($display[0]['members_login_lock_time'] != 0  )
        {
			//Check if time is passed
			if($display[0]['members_login_lock_time'] < time())
			{
				//LockDown is expired, reset.
				$CI->membersmodel->reset_time_attempt_account($member_id);
				$CI->membersmodel->reset_member_attempts($member_id);
            //$CI->membersmodel->reset_member_attempts($member_id);
				
			}
			elseif($display[0]['members_login_lock_time'] > time())
			{
				return 5;
			}
        }
         


        //Fourth , Prepare key
        $main_key_format = $password . $website_application_key . $display[0]['members_salt'];

        //Fifth , Decrypt password.
        $password_decrypt = $CI->encryption->decrypt($display[0]['members_password'], $main_key_format);


        //Sixth , if match , return true;
        if ($password_decrypt === $password)
        {
			//Password is correct, so it is safe to reset the failed login attempts
			$CI->membersmodel->reset_time_attempt_account($member_id);
			$CI->membersmodel->reset_member_attempts($member_id);
				
            $check = $CI->membersmodel->check_user_login_today($display[0]['members_ID'], 'signin', date('Y-m-d'));
            if ($check == FALSE)
            {
                $CI->membersmodel->add_user_points($display[0]['members_ID'], 'signin');
            }
            $current_date = date("Y-m-d");
            $check_date_current_date = $CI->membersmodel->check_date_current_date($current_date);
            if ($check_date_current_date == false)
            {
                $check_date_array = $CI->membersmodel->check_current_date($current_date);
                if ($check_date_array)
                {
                    $email_list = array();
                    $email_id = array();
                    for ($i = 0; $i < sizeof($check_date_array); $i++):
                        $email_list[$i] = $check_date_array[$i]['pregnancy_members_email'];
                        $email_id[$i] = $check_date_array[$i]['pregnancy_ID'];
                    endfor;

                    $CI->emailmanager->send_email_group($email_list, "Pregnancy month", $email_id, 'email_pregnancy_month');
                }
            }

           $newdata = array(
                'userid' => $display[0]['members_ID'],
                'name' => $display[0]['members_first_name'] . " " . $display[0]['members_last_name'],
                'logged_in' => TRUE,
                'members_lang' => $display[0]['members_lang'],
				'members_browser' => $CI->agent->browser(),
				'members_browser_version' => $CI->agent->version(),
				'members_is_browser' => $CI->agent->is_browser()
            );

            $this->members_language = $display[0]['members_lang'];
            $this->members_salt = $display[0]['members_salt'];
            $CI->session->set_userdata($newdata);
			
			$log = $CI->session->userdata;
			
			$form_data = array(
				'members_log_members_id' => $log['userid'],
				'members_log_browser' => $log['members_browser'],
				'members_log_browser_version' => $log['members_browser_version'],
				'members_log_ipaddress' => $log['ip_address'],
				'members_log_is_browser' => $log['members_is_browser'],
				'members_log_date' => date("Y-m-d H:i:s")
			);
			
			$CI->membersmodel->delete_members_log($log['userid']);
			$CI->membersmodel->insert_members_log($form_data);
			
            return 1;
        } else {
			//echo "--Fail-- ";
            //IF Fail , Add a login attempts to the account
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $date = date("Y-m-d H:i:s");
            $timestamp = time();
            $add_attempt = $CI->membersmodel->add_attempt($member_id, $ip_address, $date , $timestamp);
            //echo "After adding attempt ->  ".$add_attempt;
            //After adding a new attempt, calculate the new total attempts of the current memnbers
            $current_member_total_attempt = $CI->membersmodel->update_member_total_attempt($member_id);
			
            //After Getting The total attempts, lets see if the total attempts exceds number of total allowed attempts
            if($current_member_total_attempt >= $this->allowed_login_attempts) {
                //User exceeds his attempts, we need to lock the account, set a new allow timestamp 
                $new_lock_time = time() + $this->lock_duration;
                $current_member_total_attempt = $CI->membersmodel->insert_lock_time($member_id , $new_lock_time);				
				return 4;
            }
			 
			return 0;//Makki , Securit check, the return code used to be 3,  but i changed to 0 in order to have unique messages 
        }
		
    }

    public function fix_members_password($email, $password)
    {
        //echo "Test";

        $CI = & get_instance();
        $CI->load->model('membersmodel');
        $CI->load->library('encryption');


        $website_application_key = $CI->config->item('encryption_key');


        //$encryptedData = $e->encrypt($data, 'key');
        //$e2 = new Encryption(MCRYPT_BlOWFISH, MCRYPT_MODE_CBC);
        //$data2 = $e2->decrypt($encryptedData, 'key');
        //echo $data2;

        $display = $CI->membersmodel->get_all_members(500, 500);

        for ($i = 0; $i < sizeof($display); $i++):
            //unset($temp_array);
            //First , Apply Salt for all members that have passwords
            //mt_srand(microtime(true)*100000 + memory_get_usage(true));
            //$temp_array['members_salt']	= md5(uniqid(mt_rand(), true));
            //echo "salt".$temp_array['members_salt'];
            //Second, Apply the key combing the three items ( Password , salt and website server )
            $main_key_format = $display[$i]['members_password_new'] . $website_application_key . $display[$i]['members_salt'];

            //Third , Encrypt the password
            //$temp_array['members_password'] = $CI->encryption->encrypt($display[$i]['members_password_new'], $main_key_format);
            //echo "Test Encrypt".$CI->encryption->encrypt($display[$i]['members_password_new'], $main_key_format)."<Br />";
            echo "Test Descrypt-> " . $CI->encryption->decrypt($display[$i]['members_password'], $main_key_format) . "<Br />";

            //$CI->membersmodel->edit_member($display[$i]['members_ID'] , $temp_array);

        endfor;
    }

    public function fix_members_password_2()
    {
        echo "Test";

        $CI = & get_instance();
        $CI->load->model('membersmodel');
        $CI->load->library('encryption');

        $website_application_key = $CI->config->item('encryption_key');

        $display = $CI->membersmodel->get_all_members(5, 0);

        for ($i = 0; $i < sizeof($display); $i++):

            //Generate Salt for new member
            mt_srand(microtime(true) * 100000 + memory_get_usage(true));
            $array_of_data['members_salt'] = md5(uniqid(mt_rand(), true));

            //Second, Apply the key combing the three items ( Password , salt and website server )
            $member_id = $display[$i]['members_ID'];
            $password = $display[$i]['members_old_password'];
            $main_key_format = $password . $website_application_key . $array_of_data['members_salt'];

            //Encrypt Password
            $array_of_data['members_password'] = $CI->encryption->encrypt($password, $main_key_format);

            $CI->membersmodel->edit_member($member_id, $array_of_data);
        endfor;
    }

    public function sign_up($array_of_data)
    {
        $CI = & get_instance();
        $CI->load->library('encryption');
        $CI->load->library('emailmanager');
        $CI->load->model('membersmodel');

        //Generate Salt for new member
        mt_srand(microtime(true) * 100000 + memory_get_usage(true));
        $array_of_data['members_salt'] = md5(uniqid(mt_rand(), true));

        //Password 
        $password = $array_of_data['members_password'];
        unset($array_of_data['members_password']);

        //Encryption key
        $website_application_key = $CI->config->item('encryption_key');

        //Main Key
        $main_key_format = $password . $website_application_key . $array_of_data['members_salt'];

        //Encrypt Password
        $array_of_data['members_password'] = $CI->encryption->encrypt($password, $main_key_format);

        $array_of_data['members_activated'] = rand() . rand() . rand() . rand();
        $current_lang="";
        $current_member_id = $CI->membersmodel->insert_register_form($array_of_data);
        if ($array_of_data['members_lang'] == "english"){
			$current_lang="en";
			}else{
			$current_lang="ar";	
				}
        //Send Activation email
        $data['name'] = $array_of_data['members_first_name'];
        $data['url'] = site_url($current_lang."/my_corner/validate_account/" . $current_member_id . "/" . $array_of_data['members_activated']);

        if ($array_of_data['members_lang'] == "english")
        {
            $CI->emailmanager->send_email($array_of_data['members_email'], "Activation Email", $data, 'email_activation_en');
        }
        else
        {
            $CI->emailmanager->send_email($array_of_data['members_email'], "Activation Email", $data, 'email_activation');
        }
        return $current_member_id;
        //return 90;
    }

    public function reset_user_password($member_id, $password)
    {
        $CI = & get_instance();
        $CI->load->library('encryption');
        $CI->load->library('emailmanager');
        $CI->load->model('membersmodel');

        mt_srand(microtime(true) * 100000 + memory_get_usage(true));
        $salt = md5(uniqid(mt_rand(), true));

        //$display = $this->membersmodel->get_member_info($member_id);
        //Encryption key
        $website_application_key = $CI->config->item('encryption_key');

        //Main Key
        $main_key_format = $password . $website_application_key . $salt;

        //Encrypt Password
        $encrypted_password = $CI->encryption->encrypt($password, $main_key_format);


        $data = array('members_salt' => $salt, 'members_password' => $encrypted_password, 'members_reset_password_requested' => '', 'members_reset_password_active' => 0);

        //print_r($data);


        $reset = $CI->membersmodel->edit_member($member_id, $data);
        if ($reset == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function set_members_data($id) {
        $this->members_id = $id;

        if ($this->members_id == false)
            return;

        $CI = & get_instance();

        $CI->load->model('membersmodel');
        $array_of_result = $CI->membersmodel->get_member_info($id);
        if ($array_of_result)
        {
            //return;//Commtend temp by AMAKKI
            $this->members_firstname = $array_of_result[0]['members_first_name'];
            $this->members_lastname = $array_of_result[0]['members_last_name'];
            $this->members_fullname = $this->members_firstname . " " . $this->members_lastname;
            $this->members_birthday = $array_of_result[0]['members_birthdate'];
            $this->members_email = $array_of_result[0]['members_email'];
            $this->members_mobile = $array_of_result[0]['members_mobile'];
            $this->members_address = $array_of_result[0]['members_address'];
            $this->members_points = $array_of_result[0]['members_points'];
            $this->date_of_birth = $array_of_result[0]['members_birthdate'];
            $this->members_language = $array_of_result[0]['members_lang'];
            $this->members_image_id = $array_of_result[0]['members_images'];
        }
        else
        {
            $CI->session->sess_destroy();
            redirect('');
        }

        if (!$array_of_result[0]['members_images'] or $array_of_result[0]['members_images'] == 0)
        {
            $this->members_image = 'personal_img.png';
        }
        else
        {
            $image_src = $CI->membersmodel->get_member_image($id);
			$this->members_image = $image_src[0]['images_src'];
        }


        //Get Number of Recipes uploaded by member
        $this->members_no_of_recipes = $CI->membersmodel->get_no_of_member_recipes($id);
        $this->members_no_of_recipes_unapproved = $CI->membersmodel->get_no_of_member_recipes($id, false);

        //Get Number of articles uploaded by member
        $this->members_no_of_articles = 0;
        $this->members_no_of_articles_unapproved = 0;

        //Get Number of overall postsuploaded by member to be viewed at header
        $this->members_no_of_overall_posts = $this->members_no_of_recipes + $this->members_no_of_articles;
        $this->members_no_of_overrall_posts_unapproved = $this->members_no_of_recipes_unapproved + $this->members_no_of_articles_unapproved;

        //Get all Trophies for member
        $this->members_trophies = $CI->membersmodel->get_members_trophies_awards($id);
    }

    public function get_member_name_by_id($id)
    {
        $CI = & get_instance();

        $CI->load->model('membersmodel');
        $array_of_result = $CI->membersmodel->get_member_info($id);


        $this->members_firstname = $array_of_result[0]['members_first_name'];
        $this->members_lastname = $array_of_result[0]['members_last_name'];
        $this->members_fullname = $this->members_firstname . " " . $this->members_lastname;

        return $this->members_fullname;
    }

    public function confirm_account($id, $code)
    {
        $CI = & get_instance();
        $CI->load->model('membersmodel');
        $display = $CI->membersmodel->check_email_confirmed($id, $code);

        if (empty($display))
        {
            return 0;
        }

        if ($display[0]['members_activated'] == "1")
        {
            return 2;
        }
        elseif ($display[0]['members_activated'] != $code)
        {
            return 0;
        }
        elseif ($display[0]['members_activated'] == $code)
        {
            $CI->membersmodel->approve_email_account($id);
            $CI->membersmodel->add_user_points($id, 'registration');

            //Send Welcome email

            $data['name'] = $this->get_member_name_by_id($id); //$display[0]['members_first_name']." ".$display[0]['members_last_name'];
            $data['edit_profile_url'] = site_url("my_corner/edit_profile");
            $data['add_new_recipe'] = site_url("best_cook/upload_recipe");
            if ($display[0]['members_lang'] == "arabic")
            {
                $CI->emailmanager->send_email($display[0]['members_email'], "Welcome to Nestle", $data, 'email_activated');
            }
            elseif ($display[0]['members_lang'] == "english")
            {
                $CI->emailmanager->send_email($display[0]['members_email'], "Welcome to Nestle", $data, 'email_activated_en');
            }
            return 1;
        }
    }

}

/* End of file Members.php */