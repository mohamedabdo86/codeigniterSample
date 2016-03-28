<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_us extends CI_Controller {

   public function __construct()
   {
		parent::__construct();
		
		// Your own constructor code		 
				
		//Load Languages
		$this->load->helper('language');		
		$this->lang->load('globals');
		$this->lang->load('contactus');
		$this->lang->load('mycorner');
		$this->lang->load('bestcook');
		
		//Load DB
		$this->load->model('contactusmodel');
		
		//Load staticmodel
		$this->load->model('staticmodel');
		
		//Set Section name
        $this->headers->set_second_title(lang("contactus"));
		
		//Initlize common data 
		$this->data = array();
		
		// Load Library
		$this->load->library('common');
		
		$this->load->library('session');
		
		 $this->load->helper('form');
		 
		//Apply Sections Color
		$this->data['current_section_color'] = "terms_conditions_color";
		$this->data['current_section_background_color'] = "terms_conditions_background_color";
		$this->data['current_section_border_color'] = "terms_conditions_border_color";
		$this->data['current_section_borderbottom_color'] = "terms_conditions_borderbottom_color";
		
		//Apply Languages
		$site_lang = $this->config->item('language');
		$this->data['current_language'] =  $site_lang;
		$this->data['current_language_db_prefix'] =   $site_lang == "arabic" ? "_ar" : "";
		
		//Apply Drawings
		$this->data['apply_outer_drawings'] = true;
		$this->data['header_left_outer_drawings_src'] = base_url()."images/contactus/contactus_left_drawings".$this->data['current_language_db_prefix'].".png";
		$this->data['header_right_outer_drawings_src'] = base_url()."images/contactus/contactus_right_drawings".$this->data['current_language_db_prefix'].".png";
		
	}
	
	public function index($err = null)
	{
		$success = 0;
		
		$validation_array = array(
				
		);
		 $this->data['static_desc'] = $this->staticmodel->get_all_from_static();
		 
		 $this->data['target_page'] =  "static_pages/view_contact_us" ;
		 $this->data['success'] = $success;
	  	 $this->data['get_tree_menu_array'] =  $this->treemenu->get_tree_array() ;
		 $this->data['display_city'] =  $this->contactusmodel->get_city($this->data['current_language_db_prefix']);
		 $this->data['display_respond'] =  $this->contactusmodel->get_respond($this->data['current_language_db_prefix']);
		 $this->data['display_reason'] =  $this->contactusmodel->get_reason($this->data['current_language_db_prefix']);
		 $this->data['display_reason_en'] =  $this->contactusmodel->get_reason();
		 $this->data['display_product'] =  $this->contactusmodel->get_products_brand($this->data['current_language_db_prefix']);
		  //$this->data['state']  = $state;
		 $this->load->helper('form');
	     $this->load->view('template' , $this->data);

	}
	
	public function success()
	{
		$this->load->library("form_validation");
		
		
		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules("reason_ID", lang('contactus_reason'), "required");
			$this->form_validation->set_rules("firstname", lang('contactus_firstname'), "trim|required|advanced_firstlastname");
			$this->form_validation->set_rules("lastname", lang('contactus_lastname'), "trim|required|advanced_firstlastname");
			$this->form_validation->set_rules("email", lang('contactus_email'), "trim|valid_email");
			$this->form_validation->set_rules("telephone", lang('contactus_phone'), "trim|numeric");
			$this->form_validation->set_rules("mobileno", lang('contactus_mobile'), "trim|numeric");
			$this->form_validation->set_rules("address", lang('contactus_add_address'), "trim");
							
			if($this->form_validation->run() == false)
			{
				$error = ' ';
				if(form_error('reason_ID') != false) $error .= strip_tags(form_error('reason_ID')) . ' - ';
				if(form_error('yourmsg_1') != false) $error .= strip_tags(form_error('yourmsg_1')) . ' - ';
				if(form_error('firstname') != false) $error .= strip_tags(form_error('firstname')) . ' - ';
				if(form_error('lastname') != false) $error .= strip_tags(form_error('lastname')) . ' - ';
				if(form_error('email') != false) $error .= strip_tags(form_error('email')) . ' - ';
				if(form_error('telephone') != false) $error .= strip_tags(form_error('telephone')) . ' - ';
				if(form_error('mobileno') != false) $error .= strip_tags(form_error('mobileno')) . ' - ';
				if(form_error('address') != false) $error .= strip_tags(form_error('address')) . ' - ';
				$error = trim($error);
				redirect(site_url('contact_us/index') . '?err=' . $error);
			}
			else
			{
				$reason_id = $this->input->post('reason_ID');
				$uploaded_file = $this->input->post('image_uploaded_name');
				
				$file_path = '';
				
				$tobesaved['contactus_fname'] = $this->input->post('firstname');
				$tobesaved['contactus_lname'] = $this->input->post('lastname');
				$tobesaved['contactus_email'] = $this->input->post('email');
				
				$mobile = $this->input->post('mobileno');
				$tobesaved['contactus_mobile'] = "0".$mobile; 
		
				//fix telephone bug
				$telephone_respond = $this->input->post('telephone_respond');
				$telephone = $this->input->post('telephone');
				
				if($telephone != '' && $telephone_respond == '')
				{
					$tobesaved['contactus_phone'] = "0".$telephone;
				}
				else if($telephone == '' && $telephone_respond != '')
				{
					$tobesaved['contactus_phone'] = "0".$telephone_respond;
				}
				else if($telephone != '' && $telephone_respond != '')
				{
					$tobesaved['contactus_phone'] = "0".$telephone;
				}
				///end of fixing
				
				$respond_way = $this->input->post('respond_ID');
				if(is_array($respond_way))
				{
					$result = '';
					foreach($respond_way as $respond)
					{
						$result.= $respond.',';
					}
					$result_respond = substr($result, 0, -1); // the result will be 2,3
				}
				else
				{
					$result_respond = $respond_way;// the result will be 4
				}
				
				$tobesaved['contactus_how_to_contact_method'] = $result_respond;
				
				$tobesaved['contactus_reason'] = $reason_id;
				$tobesaved['contactus_city'] = $this->input->post('city_ID');
				$tobesaved['contactus_address'] = $this->input->post('address');
				$tobesaved['contactus_products'] = $this->input->post('product_ID');
				if($reason_id == 5 || $reason_id == 6)
				{
					$tobesaved['contactus_message'] = $this->input->post('yourmsg_2');
				}
				else
				{
					$tobesaved['contactus_message'] = $this->input->post('yourmsg_1');
				}
				$tobesaved['contactus_code'] = $this->input->post('code_montag');				

				if($uploaded_file != "")
				{
					rename("./server/php/files/".$uploaded_file,"./uploads/contact_us/".$uploaded_file );
					
					$file_path = $_SERVER["DOCUMENT_ROOT"]."/uploads/contact_us/".$uploaded_file;
					
					$this->load->library("resizeclass");
					$this->resizeclass->loadimage('./uploads/contact_us/'.$uploaded_file);
					list($current_image_width, $current_image_height) = getimagesize('./uploads/contact_us/'.$uploaded_file);
						if($current_image_width > 470)
						{
						$this->resizeclass->fit_to_width(470);
						$this->resizeclass->saveImage('./uploads/contact_us/'.$uploaded_file, 80);						
						}
						$this->resizeclass->resizeImage(75,75,"crop");
						$new_image_id = $this->resizeclass->insertimagetodb($uploaded_file);
						$tobesaved['contactus_file'] = $new_image_id;
				}
				
				$tobesaved['contactus_date'] = date('Y-m-d H:i:s');
				
				$insert = $this->contactusmodel->add_to_db($tobesaved);
				
				$this->data['display_respond'] =  $this->contactusmodel->get_respond($this->data['current_language_db_prefix']);
				$this->data['display_respond_en'] = $this->contactusmodel->get_respond();
				$this->data['display_reason'] =  $this->contactusmodel->get_reason($this->data['current_language_db_prefix']);
		 		$this->data['display_reason_en'] =  $this->contactusmodel->get_reason();
				$this->data['display_city'] =  $this->contactusmodel->get_city($this->data['current_language_db_prefix']);
				$this->data['display_product'] =  $this->contactusmodel->get_products_brand($this->data['current_language_db_prefix']);
				
				if($insert)
				{
					$success = 1;
					$this->load->library('emailmanager');
					$data['firstname'] = $tobesaved['contactus_fname'];
					$data['lastname'] = $tobesaved['contactus_lname'];
					$data['name'] = $tobesaved['contactus_fname'].' '.$tobesaved['contactus_lname'];
	
					$data['message'] = $tobesaved['contactus_message'];
					$data['email'] = $tobesaved['contactus_email'];
					$data['phone'] = ($telephone ? $telephone : '');
					
					$data['mobile'] = "+20".$tobesaved['contactus_mobile'];
					if($tobesaved['contactus_city'])
					{
						$city_name =  $this->contactusmodel->get_city_by_id($tobesaved['contactus_city']);
						$data['city'] =$city_name[0]['city_title'.$this->data['current_language_db_prefix']];
					}
					else
					{
						$data['city'] = '';
					}
					
					if($tobesaved['contactus_products'])
					{
						$product =  $this->contactusmodel->get_product_by_id($tobesaved['contactus_products']);
						$data['product_name'] = $product[0]['products_brand_name'];
					}
					else
					{
						$data['product_name'] = '';
					}
					
					$data['address'] = $tobesaved['contactus_address'];
					$data['product_code'] = $tobesaved['contactus_code'];
					$data['reason'] = $this->data['display_reason_en'][$tobesaved['contactus_reason']];
					if($file_path)
					{
						$data['file_path'] = $file_path;
					}
					else
					{
						$data['file_path'] = '';
					}
					$data['date'] = $tobesaved['contactus_date'];
					
					if(is_array($respond_way))
					{	
						for($i=0;$i<sizeof($respond_way);$i++)
						{
							$respond = $respond_way[$i];
							
							$data['contact_method'.($i+1).''] = $this->data['display_respond_en'][$respond];
													
						}
					}
					else
					{
						$data['contact_method1'] = $this->data['display_respond_en'][$respond_way];
						$data['contact_method2'] = '';
					}
														
					if($this->data['current_language_db_prefix'] == "_ar")
					{
						$this->emailmanager->send_email($data['email'],"تم ارسال استفسارك",$data,'email_contact_us');
					}
					else
					{
						$this->emailmanager->send_email($data['email'],"Your request has been submitted",$data,'email_contact_us_en');
					}
					
					
					$this->emailmanager->send_contactus_admin_email("consumer.services@eg.nestle.com","New Contact Us Added",$data,'email_contactus_admin',$file_path);
					//consumer.services@eg.nestle.com
					//application.egEngage-email_test@eg.nestle.com
					
					redirect('contact_us?display_box=true&message_type=success&messagecode=1');
					
				}

			}
		
		}
		else
		{
			redirect('contact_us');
		}
	}
	
	public function set_data_session(){
		if($this->input->server('REQUEST_METHOD') == 'POST'){
				$data = array(
				  'reason_id' => $this->input->post('reason_id'),
				  'contact_message_textarea_1' => $this->input->post('contact_message_textarea_1'),
				  'contact_message_textarea_2' => $this->input->post('contact_message_textarea_2'),
				  'product_ID' => $this->input->post('product_ID'),
				  'code_montag' =>  $this->input->post('code_montag'),
				  'image_uploaded_name' => $this->input->post('image_uploaded_name'),
				);
				$this->session->set_flashdata($data);
				echo json_encode(true);
		}else
		{
			redirect('');
		}
	}
	
	
	/*
	 * Custom form string validator (only allows arabic & english letter)
	 */
	function custom_server_side_alphanumeric($string)
	{
		$string = trim($string);
		$has_error = 0;
			
		if( preg_match("#[0-9]+#", $string) )
		{
			$has_error = 1;
		}
	
		if($has_error == 1)
		{
			$this->form_validation->set_message('custom_server_side_alphanumeric', lang('alpha_numeric'));
			return false;
		}
		else
		{
			return true;
		}
	}
	
	/*
	 * Custom form string validator (Strips HTML tags)
	 */
	function custom_server_side_html_stripper($string)
	{
		$string = strip_tags($string);
		
		return $string;
	}
}

