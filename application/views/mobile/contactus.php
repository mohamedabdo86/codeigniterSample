<style>
    .contact-us-form
    {
        background-image: url(<?php echo base_url(); ?>images/stripe_contactus1.png);
    }
	.contact_us_success_msg{
		color: green;
		font-size: 19px !important;
		}
	
</style>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('mobile/css/recipe-style.css') ; ?>" />
    
  
        <div class="row"> 
        	<div class="col-xs-12">
            <div class="all-products">
                <div class="all-product-header" style="background-color:#13758e !important; ">
                    <div id="title" class="float_left">
                       <p><?php echo lang('contact_us_call'); ?></p>
                    </div>
                    <div id="back" class="float_right">  
                         <p><a  class="back-link" rel="external" onclick="javascript:history.go(-1)" href="javascript:void(0);"><?php echo lang('contact_us_back'); ?></a></p>
                    </div> 
                </div>  
            </div>
            </div>

            <div class="contact-us-form col-xs-12">
            	
                <?php
                        	if ($this->uri->segment(4) == "success")
								{
									//$lang = $this->data['current_language_db_prefix'];
									//if($lang == '_ar')
									if($this->uri->segment(1) == "ar")
									{
										echo "<p style='font-size: 19px !important; color: green;'>شكرا لك على تواصلك معنا, وسوف نقوم بالرد عليك قريبا</p>";
									}
									else 
									{
										echo "<p style='font-size: 19px !important; color: green;'>Thank you for contacting us. We will respond shortly</p>";				
									}
								
								}
						?>
                <p class="float_left" style="font-size:23px;"> <?php echo lang('contactus_introduction'); ?></p>  
                <!--contact form -->
                <?php
                $attributes = array('role' => 'form', 'class' => '', 'id' => 'contact_us_form', 'data-ajax' => 'false');

                echo form_open_multipart('mobile/contact_us/success', $attributes);
                ?>
                 <?php $this->load->view('mobile/contact_us/contact_us_reason');?>
                 <?php $this->load->view('mobile/contact_us/contact_us_msg');?>
                 <?php $this->load->view('mobile/contact_us/contact_us_user_info');?>
                 <?php $this->load->view('mobile/contact_us/contact_us_way');?>
            
                <?php echo form_close(); ?>


                <!--end contactus form-->
                <div class="various_title_videos terms_conditions_background_color">
                    <div class="sections_wrapper_margin">
                        <div class="title float_left" style=" line-height:20px; color: white;font-size: 22px; padding:10px;"><?php echo lang('contactus_contact_others'); ?></div>
                    </div>
                </div> 
                     <?php $this->load->view('mobile/contact_us/contact_us_another_way', $static_desc);?>  
            </div>    

        </div>